<?php

namespace Attire;

use Attire\Lexer;
use Attire\Theme;
use Attire\Views;

use Attire\Exceptions\Environment as EnvironmentException;

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
 * Attire Environment Class
 *
 * @category  Driver
 *
 * @author    David Sosa Valdes
 *
 * @see      https://github.com/CI-Attire/Driver
 */
class Environment extends \Twig_Environment
{
    use Traits\FileKit;
    use Traits\Extractor;

    /**
     * Class constructor.
     *
     * @param \Attire\Loader $loader
     * @param array          $options Class arguments
     */
    public function __construct(Loader $loader, array $options = [])
    {
        parent::__construct($loader, $options);
    }

    /**
     * Class constructor.
     *
     * @param \Attire\Lexer $lexer
     */
    public function setValidLexer(Lexer $lexer)
    {
        if (! $lexer->isValid()) {
            throw new EnvironmentException('Lexer is not Valid');
        }
        parent::setLexer($lexer);
    }

    public function loadTheme(Theme $theme, $views)
    {
        return parent::loadTemplate((
            ! ($theme->isDisabled() && is_string($views))
                ? sprintf('@%s/%s', $theme->getNamespace(), $theme->getTemplate())
                : Views::parse($views)
        ));
    }
}
