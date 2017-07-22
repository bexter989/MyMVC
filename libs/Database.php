<?php

namespace libs;

class Database extends PDO
{
    public function __construct(ConnectionString $con)
    {
        try {
            parent::__construct($con->dsn(), $con->user(), $con->pass());
        } catch (Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }
}
