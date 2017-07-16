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
 * Attire Lexer class
 *
 * @package    CodeIgniter
 * @category   Driver
 * @author     David Sosa Valdes
 * @link       https://github.com/CI-Attire/Driver
 */
class Lexer extends \Twig_Lexer
{
    /**
     * Class constructor
     *
     * @param \Twig\Environment $environment
     * @param null|array $options \Twig_Lexer arguments
     */
    public function __construct(Environment $environment, $options = null)
    {
      if (is_array($options)) {
          parent::__construct($environment, $options);
      }
    }
}
