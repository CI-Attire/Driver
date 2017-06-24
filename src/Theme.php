<?php
namespace Attire;

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
 use \Attire\Exceptions\Theme as ThemeException;

 /**
 * Attire Theme
 *
 * @package    CodeIgniter
 * @subpackage Drivers
 * @category   Driver
 * @author     David Sosa Valdes
 * @link       https://github.com/davidsosavaldes/Attire
 */
class Theme
{
    use Traits\FileKit;
    use Traits\Extractor;

    /**
    * Theme directory used as name
    * @var string
    */
    private static $name = 'attire';

    /**
    * Themes default path
    * @var string
    */
    private static $path = 'themes/';

    /**
    * Master template rendered
    * @var string
    */
    private static $template = 'master.twig';

    /**
    * Slave layout if exists
    * @var string
    */
    private static $layout = 'layouts/default.twig';

    /**
    * Identifier of the main namespace.
    */
    const MAIN_NAMESPACE = 'theme';

    /**
    * Identifier of the main theme name.
    */
    const MAIN_THEMENAME = 'attire';

    /**
    * Class constructor
    *
    * @param  string $name      Theme name.
    * @param  string $path      Default path as a string.
    * @param  string $template  Master template.
    * @param  string $layout    Slave layout.
    */
    public function __construct(array $options = [])
    {
        extract(self::intersect('name', 'path', 'template', 'layout', $options));

        self::setFileExtension(Loader::getFileExtension());
        self::setName($name);
        self::setPath($path);
        self::setTemplate($template);
        self::setLayout($layout);
    }

    /**
     *
     */
    public static function getNamespace()
    {
        return self::MAIN_NAMESPACE;
    }

    /**
     *
     */
    public static function getMainThemePath()
    {
        return sprintf(
          '%s%s',
          rtrim(self::getPath(), self::$name),
          self::MAIN_THEMENAME
        );
    }

    /**
     * Get the theme name
     *
     * @return string Theme name
     */
    public static function setName($name)
    {
        self::$name = ! is_null($name)? $name : self::MAIN_THEMENAME;
    }

    /**
     * Set theme default path (without name)
     *
     * @param string $path Theme path
     */
    public static function setPath($path)
    {
        if (! is_dir($abs_path = sprintf('%s%s', Loader::getRootPath(), $path))) {
            throw new ThemeException(sprintf(
              'Cannot find the theme directory: (%s) inside: (%s)',
              $path,
              Loader::getRootPath()
            ));
        }

        self::$path = self::rtrim($path).DIRECTORY_SEPARATOR;
    }

    /**
     * Get theme default path
     *
     * @return string Theme path
     */
    public static function getPath()
    {
        return sprintf('%s%s%s', Loader::getRootPath(), self::$path, self::$name);
    }

    /**
     * Set the master template
     *
     * @param string $template Template name, ignore if not string
     */
    public static function setTemplate($template)
    {
        if ($template !== null) {
            (! self::haveExtension($template)) && $template .= self::getFileExtension();
            self::$template = $template;
        }
    }

    /**
     * Get the current template
     *
     * @return string Return the actual path if exist else FALSE
     */
    public static function getTemplate()
    {
        return self::$template;
    }

    /**
     * Set a new layout
     *
     * @param string $layout    Layout filename path
     * @param string $directory Directory where the layout is stored (relative to theme path)
     *
     */
    public static function setLayout($layout)
    {
        if ($layout !== null) {
            if ($layout !== false) {
                $path = self::getPath();

                (! self::haveExtension($layout))
                  && $layout .= self::getFileExtension();

                $layout_file = sprintf('%s/%s', $path, $layout);

                if (! file_exists($layout_file)) {
                    throw new ThemeException(sprintf(
                      'Cannot find theme layout: (%s) inside: (%s)',
                      $layout,
                      $path
                    ));
                }
            }

            self::$layout = $layout;
        }
    }

    /**
     * Get the current layout
     *
     * @return boolean|string Return the actual path if exist else FALSE
     */
    public static function getLayout()
    {
        return self::$layout;
    }
}
