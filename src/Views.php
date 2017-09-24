<?php

namespace Attire;

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
 * @see       http://codeigniter.com
 * @since     Version 1.0.0
 */

/**
 * Attire Views Class
 *
 * @category  Driver
 *
 * @author    David Sosa Valdes
 *
 * @see       https://github.com/CI-Attire/Driver
 */
class Views
{
    use Traits\FileKit;

    /**
     * Set of views stored.
     *
     * @var array
     */
    private $store = [];

    /**
     * Class constructor.
     */
    public function __construct()
    {
        self::setFileExtension(Loader::getFileExtension());
    }

    /**
     * Get stored views.
     *
     * @return array Set of stored views with their respective params
     */
    public function getStored()
    {
        return $this->store;
    }

    /**
     * Add a view.
     *
     * @param string $view   View filename
     * @param array  $params View parameters
     *
     * @return self
     */
    public function add($view, array $params = [])
    {
        if (!self::haveExtension($view)) {
            $view .= $this->getFileExtension();
        }

        $this->store[$view] = $params;

        return $this;
    }

    /**
     * Parse a view with Attire preferences.
     *
     * @param string $view View filename
     *
     * @return string
     */
    public function parse($view)
    {
        if (!self::haveExtension($view)) {
            $view .= $this->getFileExtension();
        }

        return $view;
    }

    /**
     * Remove specific view.
     *
     * @param string $view View filename
     *
     * @return self
     */
    public function remove($view)
    {
        if (!$this->haveExtension($view)) {
            $view .= $this->getFileExtension();
        }

        unset($this->store[$view]);

        return $this;
    }

    /**
     * Clear all the stored views.
     *
     * @return self
     */
    public function reset()
    {
        $this->store = [];

        return $this;
    }
}
