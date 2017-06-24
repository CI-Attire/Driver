<?php defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Debug
|--------------------------------------------------------------------------
|
| Enable debug mode.
|
*/
$config['debug'] = false;

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
    'cache'               => false,
    'auto_reload'         => false,
    'strict_variables'    => false,
    'autoescape'          => 'html',
    'debug'               => $config['debug'] ?? false
];

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
    'paths'    => ['/views'],
    'file_ext' => '.twig',
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
    'name' => false,
    'path' => '/themes'
];

/*
|--------------------------------------------------------------------------
| Asset Manager
|--------------------------------------------------------------------------
|
| The following options are available:
|
| * autoload: include all your extra assets directly in your layout
| * manifest: if you're implementing versioned assets, the manifest is used
| 						by the attire() function to intercept the actual path of all
| 						your asset files.
| * namespace: prefix of your assets path (default: NULL)
|
| Examples:
|
|		# autoload
|		$config['assets']['autoload'] = [
|			'scripts' => [
|				'js/foo.js'
|			]
|		];
|
| 	# manifest as array
| 	$config['assets']['manifest'] = [
|			'bootstrap.min.css' => 'dist/css/bootstrap.min.css', # different path
|			'jquery.min.js' => 'scripts/jquery98787Ah.min.js', # versioned files
| 		'foo.js' => 'scripts/bar.js' # renamed files
| 	];
|
|		# manifest as file (format: json)
|		$config['assets']['manifest'] = FCPATH.'attire.manifest.json'
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
$config['lexer'] = null;

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
