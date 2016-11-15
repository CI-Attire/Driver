<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Loader
|--------------------------------------------------------------------------
|
| Loaders are responsible for loading templates from a resource
|
*/
$config['loader'] = [
	'paths' 		=> ['views/'],
	'file_ext'  => '.twig',
];

/*
|--------------------------------------------------------------------------
| Environment
|--------------------------------------------------------------------------
|
| The following options are available:
|
| * charset             : The charset used by the templates.
| * base_template_class : The base template class to use for generated templates.
| * cache               : An absolute path where to store the compiled templates, or false to disable caching.
| * auto_reload         : When developing with Twig, it's useful to recompile the template whenever the source code changes.
| * strict_variables    : If set to false, Twig will silently ignore invalid variables and replace them with a null value.
| * autoescape          : HTML auto-escaping will be enabled by default for all templates .
| * debug               : Enable debug mode.
|
*/
$config['environment'] = [
	'charset'             => 'UTF-8',
	'base_template_class' => 'Twig_Template',
	'cache'               => FALSE,
	'auto_reload'         => FALSE,
	'strict_variables'    => FALSE,
	'autoescape'          => 'html',
	'debug'               => FALSE
];

/*
|--------------------------------------------------------------------------
| Lexer
|--------------------------------------------------------------------------
|
| Check the twig syntax settings:
| 	http://twig.sensiolabs.org/doc/recipes.html#customizing-the-syntax
|
| $lexer = [
|    'tag_comment'   => array('{#', '#}'),
|    'tag_block'     => array('{%', '%}'),
|    'tag_variable'  => array('{{', '}}'),
|    'interpolation' => array('#{', '}'),
| ];
*/
$config['lexer'] = NULL;

/*
|--------------------------------------------------------------------------
| Theme
|--------------------------------------------------------------------------
|
| Here you may specify the directory path to your attire themes folder.
| Typically, it will be within your application path.
|
*/
$config['theme'] = [
	'name'     => 'attire',
	'template' => 'master',
	'layout'   => 'layouts/default',
	'path'     => APPPATH.'themes/'
];

/*
|--------------------------------------------------------------------------
| Assets
|--------------------------------------------------------------------------
|
| Path to your assets folders.
|
*/
$config['assets'] = [
	'js'   => 'javascripts',
	'css'  => 'stylesheets',
	'img'  => 'images',
	'font' => 'fonts'
];

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Allows to add Codeigniter functionality in Twig Environment that come
| from other libraries or helpers.
|
| Example:
|
| 	$config['functions'] = array(
|		'base_url' => function($path = ""){
|			return base_url($path);
|		},
| 	);
|
| Call the functions in Twig environment:
|
|	{{ base_url('foo_fighters') }}
|
| Remember to load/autoload the library or helper bafore the render method.
|
*/
$config['functions'] = [];

/*
|--------------------------------------------------------------------------
| Global Variables
|--------------------------------------------------------------------------
|
| Global variables can be registered in the Twig environment. Same as
| declare a function:
|
| $config['global_vars'] = array(
| 	'some' => 'hello world',
| );
|
| Call the functions in the template:
|
|	{{ some }}
|
*/
$config['globals'] = [];


/*
|--------------------------------------------------------------------------
| Filters
|--------------------------------------------------------------------------
|
| Variables can be modified by filters. Filters are separated from the
| variable by a pipe symbol (|) and may have optional arguments in parentheses.
|
| Multiple filters can be chained. The output of one filter is applied to the next.
|
| Example:
|
| 	$config['filters'] = array(
|		'base_url' => function($path = ""){
|			return base_url($path);
|		},
| 	);
|
| Call the functions in the template:
|
|	{{ 'foo_fighters' | base_url }}
|
*/
$config['filters'] = [];
