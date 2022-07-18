<?php

namespace Hexablog\Sql;

use Doctrine\DBAL\DriverManager;

class Mysql
{
    private $conn;

    public function __construct(array $configs)
    {
        $this->conn = DriverManager::getConnection($configs);
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->conn, $name], $arguments);
    }
}
