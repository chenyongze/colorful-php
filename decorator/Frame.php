<?php
namespace colorful\decorator;

use colorful\Decorator;

class Frame implements Decorator
{
    public function decorate($renderText, $originalText)
    {
        echo $renderText;
        echo $originalText;
        exit;
    }
}