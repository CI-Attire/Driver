var gulp = require('gulp');
var gutil = require('gulp-util');
// var concat = require('gulp-concat');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');
// var jshint = require('gulp-jshint');
// var pump = require('pump');
var php = require('gulp-connect-php');
var browserSync = require('browser-sync');
var yaml = require('yamljs');
var path = require('path');
var argv = require('yargs').argv;

var app_path = path.parse((argv.appPath)? argv.appPath : './application').base;
var assets = yaml.load(app_path + '/config/attire.yml').assets;
var base_path = path.parse(assets.base_path).base;
var scripts = path.parse(assets.scripts).base;
var styles = path.parse(assets.styles).base;

// Compile/Process Styles
gulp.task('styles', function() {
  gulp.src(base_path + '/' + styles + '/**/*.+{css|scss|sass}')
    .pipe(sass())
    .pipe(gulp.dest('public/assets'));
});

// Minify Scripts
gulp.task('scripts', function() {
  gulp.src(base_path + '/' + scripts + '/**/*.js')
    .pipe(uglify())
    .pipe(gulp.dest('public/assets'));
});

gulp.task('reload', browserSync.reload);

// Watch Task
gulp.task('watch', function() {
  gulp.watch([app_path + '/**/*.+(php|twig|php.twig)'], ['reload']);
  gulp.watch([base_path + '/' + scripts + '/**/*.js'], ['scripts', 'reload']);
  gulp.watch([base_path + '/' + styles + '/**/*.+{css|scss|sass}'], ['styles', 'reload']);
});

gulp.task('php-serve', ['scripts', 'styles'], function() {
  php.server({ base: '.', port: 8010, keepalive: true});
});

gulp.task('browser-sync',['php-serve'], function() {
  browserSync({
    proxy: '127.0.0.1:8010',
    port: 8080,
    open: true,
    notify: true
  });
});

gulp.task('default', ['browser-sync', 'watch']);
