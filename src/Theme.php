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
 * Attire Theme class
 *
 * @package    CodeIgniter
 * @category   Driver
 * @author     David Sosa Valdes
 * @link       https://github.com/CI-Attire/Driver
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
    * @var string
    */
    const MAIN_NAMESPACE = 'theme';

    /**
    * Identifier of the main theme name.
    * @var string
    */
    const MAIN_THEMENAME = 'attire';

    /**
    * Class constructor
    *
    * @param  array $options Class arguments (name, path, tehmplate, layout)
    * @return void
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
     * Get Namespace
     *
     * @return string
     */
    public static function getNamespace()
    {
        return self::MAIN_NAMESPACE;
    }

    /**
     * Get main theme path
     *
     * @return string
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
     * Set the theme name
     *
     * @param string $name Theme name
     * @return void
     */
    public static function setName($name)
    {
        self::$name = ! is_null($name)? $name : self::MAIN_THEMENAME;
    }

    /**
     * Set theme default path (without name)
     *
     * @param string $path Theme path
     * @return void
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
        return sprintf(
          '%s%s%s',
          Loader::getRootPath(), self::$path, self::$name
        );
    }

    /**
     * Set the master template
     *
     * @param string $template Template name, ignore if not string
     */
    public static function setTemplate($template)
    {
        if ($template !== null) {
            (! self::haveExtension($template))
              && $template .= self::getFileExtension();
            self::$template = $template;
        }
    }

    /**
     * Get the current template
     *
     * @return string|boolean Return the actual path if exist else FALSE
     */
    public static function getTemplate()
    {
        return self::$template;
    }

    /**
     * Set a new layout
     *
     * @param string $layout  Layout filename path
     * @return void
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
     * @return string|boolean Return the actual path if exist else FALSE
     */
    public static function getLayout()
    {
        return self::$layout;
    }
}
