'use strict';
var gulp        = require( 'gulp' ),
    $           = require( 'gulp-load-plugins' )(),
    paths       = require( '../paths' ),
    processors  = require( '../processors' ),
    reportError = require( '../report-bug' );

// Build SASS.
gulp.task( 'sass', function() {
	return gulp.src( paths.sass.main.generate )
	           .pipe( $.plumber( { errorHandler: reportError } ) )
	           .pipe( $.sourcemaps.init() )
	           .pipe( $.sass() )
	           .pipe( $.sourcemaps.write( 'assets/scss/sourcemap/', {
		           includeContent: false,
		           sourceRoot: '../../scss/'
	           } ) )
	           .pipe( $.lineEndingCorrector() )
	           .pipe( gulp.dest( paths.root.main ) );
} );

// Build SASS final.
gulp.task( 'sass:full', function() {
	return gulp.src( paths.sass.main.generate )
	           .pipe( $.plumber( { errorHandler: reportError } ) )
	           .pipe( $.sourcemaps.init() )
	           .pipe( $.sass( { outputStyle: 'expanded' } ) )
	           .pipe( $.postcss( processors.modules ) )
	           .pipe( $.stripCssComments() )
	           //.pipe( $.cssnano( processors.nano ) )
	           .pipe( $.sourcemaps.write( 'assets/scss/sourcemap/', {
		           addComment: false,
		           includeContent: false,
		           sourceRoot: '../../scss/'
	           } ) )
	           .pipe( $.lineEndingCorrector() )
	           .pipe( gulp.dest( paths.root.main ) );
} );

// Build SASS admin.
gulp.task( 'sass:admin', function() {
	return gulp.src( paths.sass.admin.generate )
	           .pipe( $.plumber( { errorHandler: reportError } ) )
	           .pipe( $.sourcemaps.init() )
	           .pipe( $.sass() )
	           .pipe( $.lineEndingCorrector() )
	           .pipe( gulp.dest( paths.root.adminCss ) )
	           .pipe( $.rename( { suffix: '.min' } ) )
	           .pipe( $.postcss( processors.modules ) )
	           .pipe( $.cssnano( processors.nano ) )
	           .pipe( $.sourcemaps.write( '/sourcemap', {
		           includeContent: false,
		           sourceRoot: '../scss/'
	           } ) )
	           .pipe( $.lineEndingCorrector() )
	           .pipe( gulp.dest( paths.root.adminCss ) );
} );

// Combine sass for child theme demo.
gulp.task( 'sass:childDemo', function() {
	return gulp.src( paths.sass.childDemo )
	           .pipe( $.plumber( { errorHandler: reportError } ) )
	           .pipe( $.sourcemaps.init() )
	           .pipe( $.sass() )
	           .pipe( $.postcss( processors.modules ) )
	           .pipe( $.cssnano( processors.nano ) )
	           .pipe( $.sourcemaps.write( 'assets/scss/sourcemap/', {
		           includeContent: false,
		           sourceRoot: '../../scss/'
	           } ) )
	           .pipe( $.lineEndingCorrector() )
	           .pipe( gulp.dest( paths.root.childDemo ) );
} );
