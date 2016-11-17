<?php
namespace Attire\Traits\File;

/**
 * Attire File Extension Trait
 *
 * @package    Attire
 * @subpackage Drivers
 * @category   Driver
 * @author     David Sosa Valdes
 * @link       https://github.com/davidsosavaldes/Attire
 */
trait Extension
{
	/**
	 * File extension
	 * @var string
	 */
	private static $ext = '.twig';

	/**
	 * Check if file have extension
	 *
	 * @param  string  $file Filename
	 * @return boolean       TRUE if the file have extension defined and is valid else FALSE
	 */
	public static function haveExtension($file)
	{
		$info = new \SplFileInfo($file);
		$ext = $info->getExtension();
		return (! empty($ext));
	}

	/**
	 * Check if the file have a valid extension
	 *
	 * @param  string  $ext File extension
	 * @return boolean      TRUE if is valid
	 */
	public static function isValidFileExtension($ext)
	{
		return preg_match('/^.*\.(twig|php|php.twig|html|html.twig)$/i', $ext);
	}

	/**
	 * Set a new file extension
	 *
	 * @param string $ext Set it if is valid
	 */
	public static function setFileExtension($ext)
	{
		return self::isValidFileExtension($ext) && self::$ext = $ext;
	}

	/**
	 * Get current file extension
	 *
	 * @return string File extension
	 */
	public static function getFileExtension()
	{
		return self::$ext;
	}
}

/* End of file File_Component.php */
/* Location: ./application/libraries/Attire/src/File_Component.php */
