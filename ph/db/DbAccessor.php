<?php

namespace ph\db;

use ph\exception\DAOException;
use ph\utils\StringUtil;

class DbAccessor {
    protected $connection;
    private $preparedStatements = [];

    public function __construct($dbConnection = null) {
        if (empty($dbConnection)) {
            $this->connection = Database::getInstance()->getConnection();
        } else {
            $this->connection = $dbConnection;
        }
    }

    public function select($sql, $convert2CamelCase = true) {
        $extracted = $this->connection->query($sql);
        if ($extracted === false) {
            throw new DAOException($sql);
        }
        $res = [];
        while ($row = $extracted->fetch(\PDO::FETCH_ASSOC)) {
            $res[] = $row;
        }
        if ($convert2CamelCase) {
            $res = $this->convertExtracted2CamelCase($res);
        }
        return $res;
    }

    public function execute($sql) {
        $res = $this->connection->exec($sql);
        if ($res === false) {
            throw new DAOException($sql);
        }
        return $res;
    }

    // ----------------- Prepared Statements -----------------

    public function selectFromPrepared($stmt, $params = null, $convert2CamelCase = true) {
        $this->prepare($stmt);
        $prepared = $this->preparedStatements[$stmt];
        if ($prepared->execute($params) === false) {
            throw new DAOException("Failed to execute prepared statement '{$stmt}'");
        }
        $extracted = [];
        while ($row = $prepared->fetch(\PDO::FETCH_ASSOC)) {
            $extracted[] = $row;
        }
        if ($convert2CamelCase) {
            $extracted = $this->convertExtracted2CamelCase($extracted);
        }
        return $extracted;
    }

    public function prepare($stmt, $stmtName = null) {
        if ($stmtName === null) {
            $stmtName = $stmt;
        }
        if (!isset($this->preparedStatements[$stmtName])) {
            $prepared = $this->connection->prepare($stmt);
            if ($prepared === false) {
                throw new DAOException("Failed to prepare statement '{$stmt}'");
            }
            $this->preparedStatements[$stmtName] = $prepared;
        }
    }

    public function executePrepared($stmt, $params = null) {
        $this->prepare($stmt);
        $prepared = $this->preparedStatements[$stmt];
        $res = $prepared->execute($params);
        if ($res === false) {
            throw new DAOException("Failed to execute prepared statement '{$stmt}'");
        }
        return $res;
    }

    private function convertExtracted2CamelCase($extractedList) {
        $res = [];
        foreach ($extractedList as $extractedObject) {
            $converted = [];
            foreach ($extractedObject as $key => $value) {
                $converted[StringUtil::underscore2Camel($key)] = $value;
            }
            $res[] = $converted;
        }
        return $res;
    }
}
