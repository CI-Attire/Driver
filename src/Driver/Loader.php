<?php
namespace Attire\Driver;

/**
 *
 */
class Loader extends \Twig_Loader_Filesystem
{
  use \Attire\Traits\File\Extension;

  public function __construct($paths, $file_ext, $root_path = NULL)
  {
    $this->setFileExt($file_ext);
    is_null($root_path) && $root_path = APPPATH;
    parent::__construct($paths, $root_path);
  }
}

/* End of file File_Component.php */
/* Location: ./application/libraries/Attire/src/File_Component.php */
