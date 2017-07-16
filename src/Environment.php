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
 * Attire Environment class
 *
 * @package    CodeIgniter
 * @category   Driver
 * @author     David Sosa Valdes
 * @link       https://github.com/CI-Attire/Driver
 */
class Environment extends \Twig_Environment
{
    use Traits\FileKit;
    use Traits\Extractor;

    /**
     * Class constructor
     *
     * @param \Attire\Loader $loader
     * @param array $options Class arguments
     * @return void
     */
    public function __construct(Loader $loader, array $options = [])
    {
        parent::__construct($loader, $options);
    }
}
