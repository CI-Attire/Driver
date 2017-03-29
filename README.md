<!-- **Documentation for Attire is available at [http://davidsosavaldes.github.io/Attire/](<!--http://davidsosavaldes.github.io/Attire/).** -->

# Attire

Attire Driver supports template inheritance using **Twig** template engine in CodeIgniter.

<!--
## Tests

To run the tests you need to first clone the repository and install the dependencies. You do this via composer with the following command:

	php composer --dev install

Once that is done you need to create an application test environment using symlinks:

Create an environment:

git clone https://github.com/CI-Attire/Driver
cd Driver
ln -s ~/path/to/Driver/vendor tests/integration
ln -s ~/path/to/Driver/dist/config/attire.php tests/integration/application/config/attire.php
mkdir tests/integration/application/libraries/attire
ln -s ~/path/to/Driver/Attire.php tests/integration/application/libraries/attire/Attire.php

	mkdir -p tests/_application/libraries/
	ln -s ~/full/path/to/Attire tests/_application/libraries/Attire
	ln -s ~	full/path/to/Attire/dist/config tests/_application/config

And finnally in `drivers/Attire_theme.php` driver class we need to change the default theme path:

	# From:
	private $_path = APPPATH.'libraries/Attire/dist/';
	# To:
	private $_path = TESTPATH.'libraries/Attire/dist/';

Also check if the directory paths used in the `tests/unit/_bootstrap.php` file are correct:

	$system_path        = 'vendor/codeigniter/framework/system';
	$application_folder = 'vendor/codeigniter/framework/application';
	$composer_autoload  = 'vendor/autoload.php';
	$test_path          = 'tests/_application';

And finally run the tests with codeception

	php vendor/bin/codecept run

-->


### Other Twig Implementations for Codeigniter

* [https://github.com/kenjis/codeigniter-ss-twig](https://github.com/kenjis/codeigniter-ss-twig)
