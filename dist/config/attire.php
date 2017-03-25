<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Loader
|--------------------------------------------------------------------------
|
| Loaders are responsible for loading templates from a resource.
|
| Here you may specify the directory paths to your stored views (relative
| to your application path).
|
*/
$config['loader'] = [
	'paths' 		=> ['views/'],
	'file_ext'  => '.twig',
];

/*
|--------------------------------------------------------------------------
| Theme
|--------------------------------------------------------------------------
|
| Here you may specify the directory path to your stored themes (relative
| to your application path).
|
*/
$config['theme'] = [
	'name' => FALSE,
	'path' => 'themes/'
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
| Asset Manager
|--------------------------------------------------------------------------
|
| Path to the assets defined with a simple key. Example:
|
| JSON file:
| 	$config['assets'] = 'attire.config.json' (relative to the root path)
|
| Array:
| 	$config['assets'] = [
|			'bootstrap.min.css' => './bower/<bootstrap/dist/css/bootstrap.min.css'
| 	];
|
*/
$config['assets'] = [];

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
| Functions
|--------------------------------------------------------------------------
|
| Allows to add Codeigniter functionality in Twig Environment that come
| from other libraries or helpers.
|
| Example:
| 	$config['functions'] = array(
|			'base_url' => function($path = ""){
|				return base_url($path);
|			},
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
|			'base_url' => function($path = ""){
|				return base_url($path);
|			},
| 	);
|
| Call the functions in the template:
|
|	{{ 'foo_fighters' | base_url }}
|
*/
$config['filters'] = [];
