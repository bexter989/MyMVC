<?php

class Request
{
    protected $url;
    protected $action;
    protected $method;
    protected $params;

    public function __construct(){
        $this->setup();
    }

    private function setup(){
        $this->url = $this->parse($_SERVER['REQUEST_URI'], function($url){
            $url = parse_url(trim($url, '/'), PHP_URL_PATH);
            if ($url === "") {$url = '/'; }
            return $url;
        });

        $this->method = $_SERVER['REQUEST_METHOD'];

        $this->action = $this->parse($this->url, function($action){
            $action = explode('/', $action);
            return $this->ifExists($action, 0, '/');
        });

        $this->params = $this->parse($this->url, function($params){
            $params = explode('/', $params);
            return array_slice($params, 1);
        });
        var_dump($this);
    }

    public function getParam($index)
    {
        return $this->ifExists($this->params, $index);
    }

    private function ifExists($array, $index, $default = null)
    {
        if (!isset($array[$index]) || $array[$index] === "") {
            return $default;
        }
        return $array[$index];
    }

    private function parse($item, callable $func)
    {
        return $func($item);
    }
}