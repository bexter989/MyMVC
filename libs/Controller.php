<?php

class Controller {

  // Properties
  public $load;
  public $model;
  public $error;

  public function __construct() {
    $this->load  = new Load();
    $this->model = new Model();
    $this->error = new Error();
    echo "From the main Controller <br />";
  }
}

/*
  End of Controller class
*/
