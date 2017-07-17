<?php

class Router {
    private $routes = ['GET' => [], 'POST' => []];
    private $matched_route;
    private $request;
    private $url;
    private $method;

    public function __construct(Request $request) {
        $this->request = $request;
        $this->url = $this->request->url();
        $this->method = $this->request->method();
        $this->loadRoutes();
        $this->boot();
    }

    public function boot() {
        $this->match();
        $this->dispatch();
    }

    private function dispatch() {
        // if closure
        if (is_callable($this->matched_route)) {
            // Dose it need a parameter?
                // get the parameter
                // call the closure with the parameter
            // if it dosent
                // call the closure
                $closure = $this->matched_route;
                return $closure();
        }

        // explode $matched_url
        $directive = explode('@', $this->matched_route);
        // set the class name
        $controller = $directive[0];
        // set the method name
        $method = $directive[1];
        // load the class
        $this->loadClass($controller);
        // check the method exists in the class
        $class = new $controller;
        $this->checkMethodExists($class, $method);
        // call the class and method
        $class->$method();
    }

    private function checkMethodExists($class, $method)
    {
        if (! method_exists($class, $method)) {
            throw new Exception("Method {$method} dosen't exist in {$class}");
        }
        return true;
    }

    private function loadClass($class)
    {
        $class_path = config()->controllers_dir . $class . '.php';
        if (! file_exists($class_path)) {
            throw new Exception("Class {$class} dosen't exist");
        }
        require $class_path;
    }

    private function match() {
        // TODO: replace this matcher with a route regex matcher
        if (!array_key_exists($this->url, $this->routes[$this->method])) {
            header("HTTP/1.1 404 Not Found");
            throw new Exception("Route not defined");
        }
        header("HTTP/1.1 200 OK");
        $this->matched_route = $this->routes[$this->method][$this->url];
    }

    private function loadRoutes() {
        $route = $this;
        require config()->routes;
    }

    private function get($path, $handle) {
        $this->routes['GET'][$path] = $handle;
    }

    private function post($path, $handle) {
        $this->routes['POST'][$path] = $handle;
    }

}