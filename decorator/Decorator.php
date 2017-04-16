<?php
namespace colorful;

interface Decorator
{
    public function decorate($renderText, $originalText);
}