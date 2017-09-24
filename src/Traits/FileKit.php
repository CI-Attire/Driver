<?php

namespace Attire\Traits;

/**
 * Filekit.
 *
 * Used to define the file relative paths and extensions
 *
 * @category  Traits
 * @author    David Sosa Valdes
 * @see       https://github.com/CI-Attire/Driver
 */
trait FileKit
{
    /**
     * File extension.
     *
     * @var string
     */
    private static $ext = '.twig';

    /**
     * Right trim a file path.
     *
     * @param string $path      File path
     * @param string $delimiter Path delimiter
     *
     * @return bool Cleaned path
     */
    public static function rtrim($path, $delimiter = '/')
    {
        return rtrim($path, $delimiter);
    }

    /**
     * Check if file have extension.
     *
     * @param string $file Filename
     *
     * @return bool TRUE if the file have extension defined and is valid else FALSE
     */
    public static function haveExtension($file)
    {
        $info = new \SplFileInfo($file);
        $ext = $info->getExtension();

        return !empty($ext);
    }

    /**
     * Check if the file have a valid extension.
     *
     * @param string $ext File extension
     *
     * @return bool TRUE if is valid
     */
    public static function isValidFileExtension($ext)
    {
        return preg_match('/^.*\.(twig|php|php.twig|html|html.twig)$/i', $ext);
    }

    /**
     * Set a new file extension.
     *
     * @param string $ext Set it if is valid
     */
    public static function setFileExtension($ext)
    {
        return self::isValidFileExtension($ext) && self::$ext = $ext;
    }

    /**
     * Get current file extension.
     *
     * @return string File extension
     */
    public static function getFileExtension()
    {
        return self::$ext;
    }
}
