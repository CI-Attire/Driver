module.exports = require('gulp-module').define('attire', function (gulp, runSequence, options) {

	var gutil 	= require('gulp-util');
	var php 	 	= require('gulp-connect-php');
	var browser = require('browser-sync');

	var config = {
		paths : {
			assets : 'assets',
			js		 : 'scripts',
			css		 : 'styles',
			root	 : '.'
		}
	};
	gulp.task('reload', browser.reload);

	// Watch Task
  // TODO: Redefine this task
	gulp.task('watch', function() {
		gulp.watch(config.paths.js + '/**/*.js', {cwd: config.paths.assets}, ['reload']);
		gulp.watch(options.stylesPath + '/**/*.+{css|scss|sass}', {cwd: config.paths.assets}, ['reload']);
	});

	gulp.task('serve', ['compile'], function() {
		php.server({ base: config.paths.root, port: 8010, keepalive: true});
	});

	gulp.task('sync', ['serve', 'watch'], function() {
		browser({
			proxy: '127.0.0.1:8010',
			port: 8080,
			open: true,
			notify: true
		});
	});
});
