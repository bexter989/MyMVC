<?php

class Router {
    private $routes = ['GET' => [], 'POST' => []];
    private $matched_route;
    private $request;

    public function __construct(Request $request) {
        $this->request = $request;
        $this->loadRoutes()->boot();
    }

    public function boot() {
        $this->match()->dispatch();
    }

    private function dispatch() {

    }

    private function match() {
        $method = $this->request->method();
        $url    = $this->request->url();
        if (!array_key_exists($url, $this->routes[$method])) {
            header("HTTP/1.1 404 Not Found");
            throw new Exception("Route not defined");
        }
        header("HTTP/1.1 404 Not Found");
        $this->matched_route = $this->routes[$method][$url];
        return $this;
    }

    private function loadRoutes() {
        $route = $this;
        require config()->routes;
        return $route;
    }

    private function get($path, $handle) {
        $this->routes['GET'][$path] = $handle;
    }

    private function post($path, $handle) {
        $this->routes['POST'][$path] = $handle;
    }

}