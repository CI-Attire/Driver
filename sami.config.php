<?php

use Sami\Sami;
use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('tests')
    ->exclude('api')
    ->exclude('vendor')
    ->in($dir = __DIR__.'/../')
;

// Version collection
$versions = GitVersionCollection::create($dir)
  // ->addFromTags('v1.0.1')
  ->add('master', 'master branch')
;

return new Sami($iterator, array(
    'versions'             => $versions,
    'title'                => 'Attire API',
    'build_dir'            => __DIR__.'/build/%version%',
    'cache_dir'            => __DIR__.'/cache/%version%',
    'remote_repository'    => new GitHubRemoteRepository('CI-Attire/Driver', $dir),
    'default_opened_level' => 1,
));
