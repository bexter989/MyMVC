<?php

return [
    'app_name' => 'MyMvc',
    'controllers_dir' => '../application/controllers/',
    'models_dir' => '../application/models/',
    'views_dir' => '../application/views/',
    'routes' => '../application/routes.php',
    'sqliteDSN' => 'sqlite:../database/database.sqlite',
    'mysqlDSN' => 'mysql:host=localhost;dbname=mymvc',
    'mysqlUser' => 'mymvc_admin',
    'mysqlPass' => 'alpha',

    // Options are MySQLDatabase and SQLiteDatabase for now
    'defaultDBMS' => 'SQLiteDatabase',
];