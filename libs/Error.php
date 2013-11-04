<?php

// Requirements
require_once 'Load.php';

class Error {

  public function __construct() {
    $this->load = new Load();
  }

  public function show($url) {
    $data = array(
      'pageTitle' => 'Error: Page not Found',
      'msg'       => 'The page at <strong>[ ' . $url . ' ]</strong> dosent exist<br />'
    );
    $this->load->view('Errors/error_v', $data);
  }
}

/*
	End of Error class
*/