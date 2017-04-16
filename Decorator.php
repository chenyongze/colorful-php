<?php
namespace colorful;

abstract class Decorator
{
    public $params = [];

    function __construct($params = [])
    {
        $this->params = $params;
    }

    function setParams($params)
    {
        $this->params = $params;
    }

    abstract function decorate($originalText);
}