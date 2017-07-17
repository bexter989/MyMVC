<?php

class PagesController extends Controller {

    public function index() {
        $this->load->view('home/home_v');
    }

    public function about() {
        $title = 'About Page';
        return view('home/about', compact('title'));
    }

}
