<?php

namespace libs;

class Router
{
    private $routes = ['GET' => [], 'POST' => []];
    private $matched_route;
    private $request;
    private $url;
    private $method;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->url     = $this->request->url();
        $this->method  = $this->request->method();
        $this->boot();
    }

    private function boot()
    {
        $this->loadRoutes();
        $this->match();
    }

    public function dispatch()
    {
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

        $directive  = explode('@', $this->matched_route);
        $controller = $directive[0];
        $method     = $directive[1];

        $this->loadClass($controller);
        $controllerNamespace = 'App\Controllers';
        $fqnController = $controllerNamespace .'\\'. $controller;
        $class = new $fqnController;
        $this->checkMethodExists($class, $method);
        $class->$method();
    }

    private function checkMethodExists($class, $method)
    {
        if (!method_exists($class, $method)) {
            throw new Exception("Method {$method} dosen't exist in {$class}");
        }
        return true;
    }

    private function loadClass($class)
    {
        $class_path = config()->controllers_dir . $class . '.php';
        if (!file_exists($class_path)) {
            throw new \Exception("Class {$class} dosen't exist");
        }
        require $class_path;
    }

    private function match()
    {
        // TODO: replace this matcher with a regex matcher
        if (!array_key_exists($this->url, $this->routes[$this->method])) {
            header("HTTP/1.1 404 Not Found");
            throw new \Exception("Route not defined");
        }
        header("HTTP/1.1 200 OK");
        $this->matched_route = $this->routes[$this->method][$this->url];
    }

    private function loadRoutes()
    {
        $route = $this;
        require config()->routes;
    }

    private function get($path, $handle)
    {
        $this->routes['GET'][$path] = $handle;
    }

    private function post($path, $handle)
    {
        $this->routes['POST'][$path] = $handle;
    }
}
