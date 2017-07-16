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
 * Attire Loader class
 *
 * @package    CodeIgniter
 * @category   Driver
 * @author     David Sosa Valdes
 * @link       https://github.com/CI-Attire/Driver
 */
class Loader extends \Twig_Loader_Filesystem
{
    use Traits\FileKit;
    use Traits\Extractor;

    /**
     * @var string Root path (default: APPPATH)
     */
    private static $root_path = APPPATH;

    /**
     * Class constructor
     *
     * @param array $options Class arguments (paths, file_ext, root_path)
     * @return void
     */
     public function __construct(array $options = [])
     {
         extract(self::intersect('paths', 'file_ext', 'root_path', $options));

         self::setFileExtension($file_ext);
         self::setRootPath($root_path);

         $cleanPaths = function($path){
           return ltrim($path,'/');
         };

         parent::__construct(array_map($cleanPaths, $paths), self::$root_path);
     }

    /**
     * Get the root path
     *
     * @param string $path New path
     * @return void
     */
    public static function setRootPath($path)
    {
        (! is_null($path)) && self::$root_path = $path;
    }

    /**
     * Get the root path
     *
     * @return string Get root path
     */
    public static function getRootPath()
    {
        return self::$root_path;
    }
}

/* End of file File_Component.php */
/* Location: ./application/libraries/Attire/src/File_Component.php */
