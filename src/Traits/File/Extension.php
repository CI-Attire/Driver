<?php
namespace Attire\Traits\File;

/**
 * Attire File Class
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
	private $ext = '.twig';

	/**
	 * Check if file have extension
	 *
	 * @param  string  $file Filename
	 * @return boolean       TRUE if the file have extension defined and is valid else FALSE
	 */
	public function haveExt($file)
	{
		$info = new \SplFileInfo($file);
		$ext = $info->getExtension();
		return (! empty($ext)); #&& $this->isValidExt($ext);
	}

	/**
	 * Check if the file have a valid extension
	 *
	 * @param  string  $ext File extension
	 * @return boolean      TRUE if is valid
	 */
	public function isValidExt($ext)
	{
		return preg_match('/^.*\.(twig|php|php.twig|html|html.twig)$/i', $ext);
	}

	/**
	 * Set a new file extension
	 *
	 * @param string $ext Set it if is valid
	 */
	public function setFileExt($ext)
	{
		return $this->isValidExt($ext) && $this->ext = $ext;
	}

	/**
	 * Get current file extension
	 *
	 * @return string File extension
	 */
	public function getFileExt()
	{
		return $this->ext;
	}
}

/* End of file File_Component.php */
/* Location: ./application/libraries/Attire/src/File_Component.php */
