<?php

class LoginController extends Controller
{
    private $login;

    public function __construct() {
        parent::__construct();
        $this->login = $this->model->load('Login');
    }

    public function index()
    {
    }

    public function login()
    {
        echo "Implement Login logic";
    }
}