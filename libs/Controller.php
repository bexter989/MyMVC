<?php

namespace libs;

class Controller
{

    protected $model;
    protected $load;

    public function __construct(Model $model, Load $load)
    {
        $this->model = $model;
        $this->load  = $load;
    }
}
