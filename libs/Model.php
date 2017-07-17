<?php

class Model
{
    protected $db;

    public function __construct()
    {
        $defaultDBMS = config()->defaultDBMS;
        $this->db = new Database(new $defaultDBMS);
    }

    public function load($model)
    {
        $model_path = config()->models_dir . $model . '.php';
        if (! file_exists($model_path)) {
            throw new Exception("The model: {$model} could not be located");
        }
        require $model_path;
        new $model;
    }
}