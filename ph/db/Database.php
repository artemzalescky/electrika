<?php

namespace ph\db;

use ph\exception\DatabaseException;

class Database {
    private static $instance = null;

    private $connection;

    private function __construct() { }

    function __destruct() {
        $this->connection = null;
    }

    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function connect($dialect, $host, $port, $user, $password, $databaseName, $charset) {
        try {
            $dsn = $dialect . ':host=' . $host . ';port=' . $port . ';dbname=' . $databaseName;
            $this->connection = new \PDO($dsn, $user, $password);
            $this->connection->exec('set names ' . $charset);
            return $this->connection;
        } catch (\Exception $e) {
            throw new DatabaseException("Database connection failure (host = {$host}, user = {$user}, database = {$databaseName})", 0, $e);
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}
