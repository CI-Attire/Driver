<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Attire\Driver\Environment;
use Attire\Driver\Filter;
use Attire\Driver\Functions;
use Attire\Driver\Globals;
use Attire\Driver\Lexer;
use Attire\Driver\Loader;
use Attire\Driver\Theme;
use Attire\Driver\Views;

/**
 *
 */
class Attire
{

  private $loader;

  function __construct(array $options = [])
  {
    if (isset($options['loader']))
    {
      extract(self::options('paths','file_ext','root_path', $options['loader']))
        && $this->loader = new Loader($paths, $file_ext, $root_path);
    }

    // if (isset($options['environment']))
    // {
    //   $this->environment = new Environment($this->loader, $options['environment']);
    // }
    //
    // var_dump($this->loader);
  }

  private static function options(...$params)
  {
    try
    {
      $keys = [];
      $values = array_pop($params);
      foreach ($params as $key)
      {
        $keys[] = $key;
        (! key_exists($key, $values)) && $values[$key] = NULL;
      }
    }
    catch (Exception $e)
    {

    }
    return array_intersect_key($values, array_flip($keys));
  }

  public function setLoader(Loader $loader)
  {
    $this->loader = $loader;
    return $this;
  }

  public function render($view = NULL, array $params = []){}
}
