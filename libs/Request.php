<?php

namespace libs;

class Request
{
    protected $url    = "";
    protected $action = "";
    protected $method = "";
    protected $params;

    public function __construct()
    {
        $url       = parse_url(trim($_SERVER['REQUEST_URI'], '/'), PHP_URL_PATH);
        $this->url = ($url ? $url : "/");

        $parts = explode("/", $url);

        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->action = ifExists($parts, 0, '/');
        $this->params = array_slice($parts, 1);
    }

    /**
     * Gets a sngle param from the url segments.
     * Zero based index
     * @param  integer $index
     * @return string
     */
    public function getParam($index)
    {
        return $this->ifExists($this->params, $index);
    }

    /**
     * Returns an array of parameters if they are present in the url
     * @return array
     */
    public function params()
    {
        return $this->params;
    }

    /**
     * Returns the current url
     * @return string
     */
    public function url()
    {
        return $this->url;
    }

    /**
     * Returns the first segment of the url string
     * @return string
     */
    public function action()
    {
        return $this->action;
    }

    /**
     * Returns the current request method
     * @return string
     */
    public function method()
    {
        return $this->method;
    }
}
