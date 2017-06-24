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

/**
 * Attire Loader
 *
 * @package    CodeIgniter
 * @subpackage Drivers
 * @category   Driver
 * @author     David Sosa Valdes
 * @link       https://github.com/davidsosavaldes/Attire
 */
class Loader extends \Twig_Loader_Filesystem
{
    use Traits\FileKit;
    use Traits\Extractor;

    /**
     * @var {String} Root Path (default: APPPATH)
     */
    private static $root_path = APPPATH;

    /**
     * Class constructor
     *
     * @param ---
     */
    public function __construct(array $options = [])
    {
        extract(self::intersect('paths', 'file_ext', 'root_path', $options));

        self::setFileExtension($file_ext);
        self::setRootPath($root_path);

        parent::__construct($paths, self::$root_path);
    }

    /**
     * Get the root path
     *
     * @param {String} $path New path
     * @return {boolean} The root path
     */
    public static function setRootPath($path)
    {
        (! is_null($path)) && self::$root_path = $path;
        return self::$root_path;
    }

    /**
     * Get the root path
     *
     * @return {String} The root path
     */
    public static function getRootPath()
    {
        return self::$root_path;
    }
}

/* End of file File_Component.php */
/* Location: ./application/libraries/Attire/src/File_Component.php */
