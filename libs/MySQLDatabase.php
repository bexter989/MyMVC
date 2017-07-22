<?php

namespace lib;

class MySQLDatabase implements ConnectionString
{
    public function dsn()
    {
        return config()->mysqlDSN;
    }

    public function user()
    {
        return config()->mysqlUser;
    }

    public function pass()
    {
        return config()->mysqlPass;
    }
}
