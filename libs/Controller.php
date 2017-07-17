<?php

class Controller {

    protected $model;
    protected $load;

    public function __construct() {
        $this->model = new Model;
        $this->load = new Load;
    }
}
