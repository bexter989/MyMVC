<?php

class Home Extends Controller {

  public function __construct() {
    parent::__construct();
    echo 'From the Home controller <br />';
  }

  public function index() {
    echo "From the index method <br />";
    $data = array(
      'pageTitle' => 'Homepage'
    );
    $this->load->view('home/home_v', $data);
  }

}

/*
  End of Home Controller class
*/