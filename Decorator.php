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

    /**
     * 主题装饰类
     *
     * @param string $originalText 初始文本
     * @return mixed
     */
    abstract function decorate($originalText);
}