<?php
namespace colorful\decorator;

use colorful\Decorator;

/**
 * <边框>装饰主题
 * Class Frame
 *
 * @package colorful\decorator
 */
class Frame extends Decorator
{
    /**
     * 主题装饰类
     *
     * @param string $originalText 初始文本
     * @return mixed
     */
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

    /**
     * 绘制边框
     *
     * @param array $wraps
     * @param string $col
     * @return string
     */
    protected function drawFrame($wraps, $col)
    {
        $frame = [];

        $decorate = $this->params['decorate'] !== null ? $this->params['decorate'] : '*';
        $frame[] = str_repeat($decorate, $col);
        foreach ($wraps as $wrap) {
            $spec = str_repeat($this->params['spec'] ?: '', ($col - mb_strlen($wrap)) / 2);
            $frame[] = "{$spec}{$wrap}{$spec}";
        }
        $frame[] = str_repeat($decorate, $col);

        return implode($frame, PHP_EOL);
    }
}