<?php

namespace Attire;

use Attire\Environment;

/**
 * CodeIgniter.
 *
 * An open source application development framework for PHP
 *
 * @author    EllisLab Dev Team
 * @copyright Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license   http://opensource.org/licenses/MIT	MIT License
 *
 * @see      http://codeigniter.com
 * @since     Version 1.0.0
 */

/**
 * Attire Lexer Class
 *
 * @category   Driver
 *
 * @author     David Sosa Valdes
 *
 * @see       https://github.com/CI-Attire/Driver
 */
class Lexer extends \Twig_Lexer
{
    /**
     * @var \Attire\Environment
     */
    private static $_environment;

    /**
     * \Twig_Lexer arguments
     * @var array
     */
    private static $_options = [];

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(self::$_environment, self::$_options);
    }

    /**
     * Initialize
     *
     * @param Environment $environment
     * @param array       $options      \Twig_Lexer arguments
     */
    public static function initialize(Environment $environment, array $options)
    {
        self::$_environment = $environment;
        self::$_options = $options;
    }

    /**
     * Checks if is valid the declaration of arguments
     *
     * @return bool
     */
    public static function isValid(): bool
    {
        return ! empty(self::$_options);
    }
}
