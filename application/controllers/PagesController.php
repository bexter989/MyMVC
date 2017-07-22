<?php

use libs\Controller;

class PagesController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->load->view('pages/home');
    }

    public function about()
    {
        $title = 'About Page';
        return view('pages/about', compact('title'));
    }
}
