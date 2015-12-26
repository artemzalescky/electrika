<?php

namespace ph\db;

abstract class DbDataAccessObject extends DbAccessor {
    protected $tableName;

    public function __construct($tableName, $dbConnection = null) {
        parent::__construct($dbConnection);
        $this->tableName = $tableName;
    }

    protected function get() {
        return $this->getBy();
    }

    protected function getBy($fieldsMap = null) {
        $sql = $this->getSelectSql($fieldsMap);
        $stmtName = $this->getPreparedStmtName('GET_BY_', $fieldsMap);
        $placeholderMap = $this->getPlaceHolderMap($fieldsMap);

        $this->prepare($sql, $stmtName);
        return $this->selectFromPrepared($stmtName, $placeholderMap);
    }

    protected function add($fieldsMap) {
        $sql = $this->getInsertSql($fieldsMap);
        $stmtName = $this->getPreparedStmtName('UPDATE_', $fieldsMap);
        $placeholderMap = $this->getPlaceHolderMap($fieldsMap);

        $this->prepare($sql, $stmtName);
        return $this->executePrepared($stmtName, $placeholderMap);
    }

    protected function update($updateFieldsMap, $whereFieldsMap = null) {
        $sql = $this->getUpdateSql($updateFieldsMap, $whereFieldsMap);
        $stmtName = $this->getPreparedStmtName('UPDATE_', $updateFieldsMap);
        $placeholderMap = array_merge(
            $this->getPlaceHolderMap($updateFieldsMap),
            $this->getPlaceHolderMap($whereFieldsMap, 'where')
        );

        $this->prepare($sql, $stmtName);
        return $this->executePrepared($stmtName, $placeholderMap);
    }

    protected function delete() {
        return $this->deleteBy();
    }

    protected function deleteBy($fieldsMap = null) {
        $sql = $this->getDeleteSql($fieldsMap);
        $stmtName = $this->getPreparedStmtName('DELETE_BY_', $fieldsMap);
        $placeholderMap = $this->getPlaceHolderMap($fieldsMap);

        $this->prepare($sql, $stmtName);
        return $this->executePrepared($stmtName, $placeholderMap);
    }

    private function getSelectSql($fieldsMap = null) {
        $sql = 'SELECT * FROM ' . $this->tableName;
        if (!empty($fieldsMap)) {
            $sql .= ' WHERE ' . $this->combineFields($fieldsMap);
        }
        return $sql;
    }

    private function getInsertSql($fieldsMap) {
        $sql = 'INSERT INTO ' . $this->tableName . ' (';
        foreach ($fieldsMap as $columnName => $value) {
            $sql .= $columnName . ',';
        }
        $sql = substr($sql, 0, -1) . ') VALUES (';
        foreach ($fieldsMap as $columnName => $value) {
            $sql .= ':' . $columnName . ',';
        }
        return substr($sql, 0, -1) . ')';
    }

    private function getUpdateSql($updateFieldsMap, $whereFieldsMap = null) {
        $sql = 'UPDATE ' . $this->tableName . ' SET ';
        $sql .= $this->combineFields($updateFieldsMap, ',');
        if (!empty($whereFieldsMap)) {
            $sql .= ' WHERE ' . $this->combineFields($whereFieldsMap, 'AND', 'where');
        }
        return $sql;
    }

    private function getDeleteSql($fieldsMap = null) {
        $sql = 'DELETE FROM ' . $this->tableName;
        if (!empty($fieldsMap)) {
            $sql .= ' WHERE ' . $this->combineFields($fieldsMap);
        }
        return $sql;
    }

    private function combineFields($fieldsMap, $separator = ' AND ', $prefix = '') {
        $res = '';
        foreach ($fieldsMap as $columnName => $value) {
            $res .= $columnName . ' = :' . $prefix . $columnName .  $separator;
        }
        return substr($res, 0, -strlen($separator));
    }

    private function getPreparedStmtName($prefix, $fieldsMap) {
        return is_array($fieldsMap) ? $prefix . implode('_', array_keys($fieldsMap)) : $prefix;
    }

    private function getPlaceHolderMap($fieldsMap = null, $prefix = '') {
        $placeholderMap = [];
        if (is_array($fieldsMap)) {
            foreach ($fieldsMap as $columnName => $value) {
                $placeholderMap[':' . $prefix . $columnName] = $value;
            }
        }
        return $placeholderMap;
    }
}
