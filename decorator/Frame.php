<?php
namespace colorful\decorator;

use colorful\Decorator;

class Frame extends Decorator
{
    public function decorate($originalText)
    {
        $replacement = preg_replace('/(.{70})/u', "$1" . PHP_EOL, $originalText);
        $wraps = explode(PHP_EOL, $replacement);

        $col = array_reduce($wraps, function($col, $wrap) {
            $len = mb_strlen($wrap);
            return $col < $len ? $len : $col;
        }, 0);

        return $this->drawFrame($wraps, $col);
    }

    protected function drawFrame($wraps, $col)
    {
        $frame = [];

        $decorator = $this->params['decorate'] !== null ? $this->params['decorate'] : '*';
        $frame[] = str_repeat($decorator, $col);
        foreach ($wraps as $wrap) {
            $spec = str_repeat($this->params['spec'] ?: '', ($col - mb_strlen($wrap)) / 2);
            $frame[] = "{$spec}{$wrap}{$spec}";
        }
        $frame[] = str_repeat($decorator, $col);

        return implode($frame, PHP_EOL);
    }
}