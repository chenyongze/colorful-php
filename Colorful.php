<?php
namespace colorful;

include_once __DIR__ . DIRECTORY_SEPARATOR . 'Decorator.php';

/**
 * Class Colorful
 * @package Style
 *
 * @example :
 * Colorful::apply('Hi~ Success', 'success');
 * Colorful::apply('PHP Warning: file_get_contents failed to open stream: no suitable wrapper could be found.', 'warn');
 * Colorful::apply('PHP Fatal error: Call to undefined function mb_detect_encoding() ', 'fatal');
 * Colorful::apply('https://github.com/yinggaozhen/colorful-php', 'hyperlink');
 *
 */
class Colorful
{

    private static $availableForegroundColors = [
        'black'   => ['set' => 30, 'unset' => 39],
        'red'     => ['set' => 31, 'unset' => 39],
        'green'   => ['set' => 32, 'unset' => 39],
        'yellow'  => ['set' => 33, 'unset' => 39],
        'blue'    => ['set' => 34, 'unset' => 39],
        'magenta' => ['set' => 35, 'unset' => 39],
        'cyan'    => ['set' => 36, 'unset' => 39],
        'white'   => ['set' => 37, 'unset' => 39],
    ];
    private static $availableBackgroundColors = [
        'black'   => ['set' => 40, 'unset' => 49],
        'red'     => ['set' => 41, 'unset' => 49],
        'green'   => ['set' => 42, 'unset' => 49],
        'yellow'  => ['set' => 43, 'unset' => 49],
        'blue'    => ['set' => 44, 'unset' => 49],
        'magenta' => ['set' => 45, 'unset' => 49],
        'cyan'    => ['set' => 46, 'unset' => 49],
        'white'   => ['set' => 47, 'unset' => 49],
    ];
    private static $availableOptions = [
        'bold'       => ['set' => 1, 'unset' => 22],
        'dark'       => ['set' => 2, 'unset' => 22],
        'italic'     => ['set' => 3, 'unset' => 23],
        'underscore' => ['set' => 4, 'unset' => 24],
        'blink'      => ['set' => 5, 'unset' => 25],
        'reverse'    => ['set' => 7, 'unset' => 27],
        'conceal'    => ['set' => 8, 'unset' => 28],
        'delete'     => ['set' => 9, 'unset' => 29],
    ];
    private static $availableTheme = [
        'success'   => ['green', null, []],
        'warn'      => ['black', 'yellow', []],
        'fatal'     => ['black', 'red', []],
        'hyperlink' => ['blue', null, ['underscore', 'italic']]
    ];

    protected function __construct()
    {
    }

    /**
     * @param string|null $color
     * @return null|array
     * @throws \Exception
     */
    protected static function getForeground($color = null)
    {
        if (null === $color) {
            return null;
        }

        if (!isset(static::$availableForegroundColors[$color])) {
            throw new \Exception(sprintf('Invalid foreground color specified: "%s". Expected one of (%s)', $color, implode(', ', array_keys(static::$availableForegroundColors))));
        }

        return static::$availableForegroundColors[$color];
    }

    /**
     * @param string|null $color
     * @return null|array
     * @throws \Exception
     */
    protected static function getBackground($color = null)
    {
        if (null === $color) {
            return null;
        }

        if (!isset(static::$availableBackgroundColors[$color])) {
            throw new \Exception(sprintf('Invalid background color specified: "%s". Expected one of (%s)', $color, implode(', ', array_keys(static::$availableBackgroundColors))));
        }

        return static::$availableBackgroundColors[$color];
    }

    /**
     * @param array $options
     * @return array
     * @throws \Exception
     */
    protected static function getOptions(array $options)
    {
        $optionsResult = [];

        if (!empty($options)) {
            foreach ($options as $option) {
                if (!isset(static::$availableOptions[$option])) {
                    throw new \Exception(sprintf('Invalid option specified: "%s". Expected one of (%s)', $option, implode(', ', array_keys(static::$availableOptions))));
                }

                $optionsResult[] = static::$availableOptions[$option];
            }
        }

        return $optionsResult;
    }

    /**
     * @param string $theme
     * @return null|array
     * @throws \Exception
     */
    protected static function getTheme($theme)
    {
        if (null === $theme) {
            return null;
        }

        if (!isset(static::$availableTheme[$theme])) {
            throw new \Exception(sprintf('Invalid theme specified: "%s". Expected one of (%s)', $theme, implode(', ', array_keys(static::$availableTheme))));
        }

        return static::$availableTheme[$theme];
    }

    /**
     * @param string $text
     * @param string $theme
     * @param Decorator $decorator
     * @return string
     * @throws \Exception
     */
    public static function apply($text, $theme, Decorator $decorator = null)
    {
        $setCodes   = [];
        $unsetCodes = [];

        list($availableForeground, $availableBackground, $availableOptions) = is_array($theme) ? $theme : self::getTheme($theme);
        if ($foreground = static::getForeground($availableForeground)) {
            $setCodes[]   = $foreground['set'];
            $unsetCodes[] = $foreground['unset'];
        }
        if ($background = static::getBackground($availableBackground)) {
            $setCodes[]   = $background['set'];
            $unsetCodes[] = $background['unset'];
        }

        if ($options = static::getOptions($availableOptions)) {
            foreach ($options as $option) {
                $setCodes[]   = $option['set'];
                $unsetCodes[] = $option['unset'];
            }
        }

        if (0 === count($setCodes)) {
            return $text;
        }

        if ($decorator !== null) {
            $decoratorText = $decorator->decorate($text);
            return sprintf("\033[%sm%s\033[%sm", implode(';', $setCodes), $decoratorText, implode(';', $unsetCodes));
        }
        return sprintf("\033[%sm%s\033[%sm", implode(';', $setCodes), $text, implode(';', $unsetCodes));
    }

    /**
     * @param array $themes
     */
    public static function importTheme(array $themes)
    {
        static::$availableTheme = static::$availableTheme + $themes;
    }
}