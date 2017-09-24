<?php

namespace Attire;

use Attire\Exceptions\Theme as ThemeException;

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * @package   CodeIgniter
 * @author    EllisLab Dev Team
 * @copyright Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license   http://opensource.org/licenses/MIT	MIT License
 * @link      http://codeigniter.com
 * @since     Version 1.0.0
 */

/**
 * Attire Theme Class
 *
 * @category  Driver
 *
 * @author    David Sosa Valdes
 *
 * @see       https://github.com/CI-Attire/Driver
 */
class Theme
{
    use Traits\FileKit;
    use Traits\Extractor;

    /**
     * Theme directory used as name.
     *
     * @var string
     */
    private static $name = 'attire';

    /**
     * Themes default path.
     *
     * @var string
     */
    private static $path = 'themes/';

    /**
     * Master template rendered.
     *
     * @var string
     */
    private static $template = 'master.twig';

    /**
     * Slave layout if exists.
     *
     * @var string
     */
    private static $layout = 'layouts/default.twig';

    /**
     * Disable the theme.
     *
     * @var bool
     */
    private static $disabled = false;

    /**
     * Identifier of the main namespace.
     *
     * @var string
     */
    const MAIN_NAMESPACE = 'theme';

    /**
     * Identifier of the main theme name.
     *
     * @var string
     */
    const MAIN_THEMENAME = 'attire';

    /**
     * Class constructor.
     *
     * @param array $options Class arguments (name, path, tehmplate, layout)
     */
    public function __construct(array $options = [])
    {
        if (!empty($options)) {
            extract(self::intersect('name', 'path', 'template', 'layout', $options));

            self::setFileExtension(Loader::getFileExtension());
            self::setName($name);
            self::setPath($path);
            self::setTemplate($template);
            self::setLayout($layout);
        } else {
            self::$disabled = true;
        }
    }

    /**
     * Get Namespace.
     *
     * @return string
     */
    public static function getNamespace()
    {
        return self::MAIN_NAMESPACE;
    }

    /**
     * Get main theme path.
     *
     * @return string
     */
    public static function getMainThemePath()
    {
        return sprintf(
            '%s/%s',
            self::rtrim(rtrim(self::getPath(), self::$name)),
            self::MAIN_THEMENAME
        );
    }

    /**
     * Get theme name.
     *
     * @return string
     */
    public static function getName()
    {
        return  (!is_null(self::$name)) ? self::$name : self::MAIN_THEMENAME;
    }

    /**
     * Set the theme name.
     *
     * @param string $name Theme name
     */
    public static function setName($name)
    {
        if (is_null($name) || (!$name)) {
            throw new ThemeException('Name is not defined');
        } else {
            self::$name = $name;
        }
    }

    /**
     * Set theme default path (without name).
     *
     * @param string $path Theme path
     */
    public static function setPath($path)
    {
        if (!is_null($path)) {
            $abs_path = sprintf('%s%s', Loader::getRootPath(), $path);
            if (!is_dir($abs_path)) {
                throw new ThemeException(sprintf(
                    'Cannot find the theme directory: (%s) inside: (%s)',
                    $path,
                    Loader::getRootPath()
                ));
            }

            self::$path = self::rtrim($path);
        }
    }

    /**
     * Get theme default path.
     *
     * @return string Theme path
     */
    public static function getPath()
    {
        return sprintf(
            '%s/%s/%s',
            self::rtrim(Loader::getRootPath()),
            self::$path,
            self::$name
        );
    }

    /**
     * Set the master template.
     *
     * @param string $template Template name, ignore if not string
     */
    public static function setTemplate($template)
    {
        if (!is_null($template)) {
            if (!self::haveExtension($template)) {
                $template .= self::getFileExtension();
            }

            self::$template = $template;
        }
    }

    /**
     * Get the current template.
     *
     * @return string|bool Return the actual path if exist else FALSE
     */
    public static function getTemplate()
    {
        // return self::$template;
        $layout = self::getLayout();

        return (bool) $layout ? $layout : self::$template;
    }

    /**
     * Set a new layout.
     *
     * @param string $layout Layout filename path
     */
    public static function setLayout($layout)
    {
        if ((bool) $layout) {
            $path = self::getPath();

            if (!self::haveExtension($layout)) {
                $layout .= self::getFileExtension();
            }

            if (!file_exists(sprintf('%s/%s', $path, $layout))) {
                throw new ThemeException(sprintf(
                    'Cannot find theme layout: (%s) inside: (%s)',
                    $layout,
                    $path
                ));
            }

            self::$layout = $layout;
        }
    }

    /**
     * Get the current layout.
     *
     * @return string|bool Return the actual path if exist else FALSE
     */
    public static function getLayout()
    {
        return self::$layout;
    }

    /**
     * Disable the theme.
     */
    public static function disable($flag = true)
    {
        self::$disabled = (bool) $flag;
    }

    /**
     * Check if the theme is disabled.
     *
     * @return bool
     */
    public static function isDisabled()
    {
        return self::$disabled;
    }
}
