# Colorful-PHP

[TOC]

## Preface
在写[Nold文档示例生成小工具](https://github.com/yinggaozhen/nold)以及的时候，想要加入一个Console Helper类用于界面友好的命令行输出展示，其中需要对输出的文档进行适当美化。虽然这个东西并不复杂，但是考虑到这个可集成到目前自己所写绝大部分的工具或者框架(譬如现在正在写的Nold文档生成小工具以及Zaor)，所以便单独抽出来花了点时间写一下.

## Application
Let's console to be Colorful~:satisfied:

## Usage
> 大体用法是通过Cololrful::apply传入要渲染的文本以及主题，其中主题包括内置基础主题和内置高级主题(可通过参数进一步调节).当然也可以通过Cololrful::import导入主题.

_ _ _
```php
echo Colorful::apply('Hi~ Success', 'success') . PHP_EOL;
echo Colorful::apply('PHP Warning: file_get_contents failed to open stream: no suitable wrapper could be found.', 'warn') . PHP_EOL;
echo Colorful::apply('PHP Fatal error: Call to undefined function mb_detect_encoding() ', 'fatal') . PHP_EOL;
echo Colorful::apply('https://github.com/yinggaozhen/colorful-php', 'hyperlink') . PHP_EOL;
```
_ _ _
![stdoutput](colorful.png)

### Theme List
| Theme List | Params |
|--------|--------|
|  success      |    /    |
|  warn      |    /    |
|  fatal      |    /    |
|  hyperlink      |    /    |