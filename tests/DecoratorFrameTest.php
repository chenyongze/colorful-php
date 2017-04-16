<?php
include dirname(__DIR__) . '/Colorful.php';
include dirname(__DIR__) . '/decorator/Frame.php';

$longtext = "message\n\n    The exception message\ncode\n\n    The exception code\nfile\n\n    The filename where the exception was created\nline\n\n    The line where the exception was created";
$frame = new \colorful\decorator\Frame([
    'spec' => '',
    'decorate' => '='
]);
echo colorful\Colorful::apply($longtext, ['yellow', null, []], $frame) . PHP_EOL;