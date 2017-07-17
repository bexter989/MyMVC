<?php

class Request {
    protected $url    = "";
    protected $action = "";
    protected $method = "";
    protected $params;

    public function __construct() {
        $this->setup();
    }

    private function setup() {
        $this->url = $this->parse($_SERVER['REQUEST_URI'], function ($url) {
            $url = parse_url(trim($url, '/'), PHP_URL_PATH);
            if ($url === "") {
                $url = '/';}
            return $url;
        });

        $this->method = $_SERVER['REQUEST_METHOD'];

        $this->action = $this->parse($this->url, function ($action) {
            $action = explode('/', $action);
            return $this->ifExists($action, 0, '/');
        });

        $this->params = $this->parse($this->url, function ($params) {
            $params = explode('/', $params);
            $params = array_slice($params, 1);
            return $params;
        });
    }

    /**
     * Gets a sngle param from the url segments.
     * Zero based index
     * @param  integer $index
     * @return string
     */
    public function getParam($index) {
        return $this->ifExists($this->params, $index);
    }

    /**
     * Atempts to return an array index if it exists
     * Will return a default value if it is set or specified
     * via a third parameter
     * @param  mixed|array $array   The array
     * @param  integer $index   The key
     * @param  mixed $default The user supplied default value
     * @return mixed|array
     */
    private function ifExists($array, $index, $default = null) {
        if (!isset($array[$index]) || $array[$index] === "") {
            return $default;
        }
        return $array[$index];
    }

    /**
     * Parse an item with a closure
     * @param  mixed|string|array   $item Item to parse
     * @param  callable $func Custom function to use for on Items
     * @return mixed   Result of the closure
     */
    private function parse($item, callable $func) {
        return $func($item);
    }

    /**
     * Returns an array of parameters if they are present in the url
     * @return array
     */
    public function params() {
        return $this->params;
    }

    /**
     * Returns the current url
     * @return string
     */
    public function url() {
        return $this->url;
    }

    /**
     * Returns the first segment of the url string
     * Defaults to / if nothing in the url
     * @return string
     */
    public function action() {
        return $this->action;
    }

    /**
     * Returns the current request method
     * @return string
     */
    public function method() {
        return $this->method;
    }
}