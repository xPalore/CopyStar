<?php

class Database
{
    private $link;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $config = require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

        $dsn = 'mysql:host =' . $config['host'] . ';dbname=' . $config['db_name'] . ';charset=' . $config['charset'];

        $this->link = new PDO($dsn, $config['username'], $config['password']);

        return $this;
    }

    public function execute(string $sql, array $param) : void
    {
        $sth = $this->link->prepare($sql);
         $sth->execute($param);
    }

    public function lastId()
    {
        return $this->link->lastInsertId();
    }

    public function query(string $sql, array $param = null) : array
    {
        $sth = $this->link->prepare($sql);
        $sth->execute($param);

        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false) {
            return [];
        }
        return $result;
    }
}
