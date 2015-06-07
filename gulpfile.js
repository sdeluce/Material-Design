var gulp = require('gulp');
var sass = require('gulp-sass');
var please = require('gulp-pleeease');
var coffee = require('gulp-coffee');
var gutil = require('gulp-util');
var concat = require('gulp-concat');
var rename = require("gulp-rename");
var jshint = require("gulp-jshint");
var uglify = require("gulp-uglify");

var browserSync = require('browser-sync').create();

var reload = browserSync.reload();

var SassOptions = {
	errLogToConsole: true
};

var PleeeaseOptions = {
	sourcemaps: false,
	filters: true,
	rem: ['14px'],
	pseudoElements: true,
	removeAllComments: true,
	opacity: true,
	minifier: true,
	mqpacker: true,
	autoprefixer: {
		browsers: ['> 5%', 'last 10 versions', 'ie 9']
	}
};

var fonts = [
	'./bower_components/Materialize/font/**/*.*'
];

var uglifySrc = [
	/** Modernizr */
	"./bower_components/modernizr/modernizr.js",
	/** jQuery */
	"./bower_components/jquery/dist/jquery.js",
	/** materialdesign */
	"./bower_components/Materialize/dist/js/materialize.js",
	/** FastClick */
	"./bower_components/fastclick/lib/fastclick.js",
	/** Page scripts */
	//"./js/app/customizer.js",
	"./js/app/materialize.js"
];

gulp.task('sass', function () {
	return gulp.src('./sass/*.scss')
		.pipe( sass( SassOptions ))
		.on( "error", function( e ) {
			console.error( e );
		})
		.pipe(gulp.dest('./sass/css'));
});

gulp.task('css', ['sass'], function () {
	return gulp.src('./sass/css/style.css')
		.pipe( please( PleeeaseOptions ) )
		.pipe(rename({
			suffix: '.min',
			extname: '.css'
		}))
		.pipe(gulp.dest('./sass/css'));
});

gulp.task('concat', ['css'], function() {
	return gulp.src(['./sass/css/header.css', './sass/css/style.min.css'])
		.pipe(concat('style.css'))
		.pipe(gulp.dest('./'));
});

gulp.task( 'jshint', function () {
	/** Test all `js` files exclude those in the `lib` folder */
	return gulp.src( "./js/app/*.js" )
		.pipe( jshint() )
		.pipe(jshint.reporter('default', { verbose: true }));
});

gulp.task( 'uglify', ['jshint'], function() {
	return gulp.src( uglifySrc )
		.pipe( concat( "app.min.js" ) )
		.pipe( uglify() )
		.pipe( gulp.dest('js') );
});

gulp.task('font', function(){
	return gulp.src(fonts, { base: './bower_components/Materialize/' })
		.pipe(gulp.dest(''));
});

gulp.task('watch', ['concat', 'uglify'],function() {
	browserSync.init({
		proxy: "localhost/bacasable/"
	});

	gulp.watch([ "sass/**/*.scss" ], ['concat']);
	gulp.watch([ "js/app/**/*.js" ], ['uglify']);

	gulp.watch([
		"js/*.js",
		"**/*.php",
		"*.css"
	]).on( "change", function( file ) {
		console.log( file.path );
		browserSync.reload();
	});
});