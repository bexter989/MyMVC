<?php

namespace lib;

interface ConnectionString
{
    public function dsn();
    public function user();
    public function pass();
}
