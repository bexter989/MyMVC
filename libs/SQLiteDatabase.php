<?php

class SQLiteDatabase implements ConnectionString
{
    public function dsn()
    {
        return config()->sqliteDSN;
    }

    public function user()
    {
        return null;
    }

    public function pass()
    {
        return null;
    }
}