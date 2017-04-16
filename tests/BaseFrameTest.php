<?php
include dirname(__DIR__) . '/Colorful.php';

echo colorful\Colorful::apply('Hi~ Success', 'success') . PHP_EOL;
echo colorful\Colorful::apply('PHP Warning: file_get_contents failed to open stream: no suitable wrapper could be found.', 'warn') . PHP_EOL;
echo colorful\Colorful::apply('PHP Fatal error: Call to undefined function mb_detect_encoding() ', 'fatal') . PHP_EOL;
echo colorful\Colorful::apply('https://github.com/yinggaozhen/colorful-php', 'hyperlink') . PHP_EOL;