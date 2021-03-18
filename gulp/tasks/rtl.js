'use strict';
var gulp  = require( 'gulp' ),
    $     = require( 'gulp-load-plugins' )(),
    path  = require( '../paths' ).root.main;

// Build rtl.css.
gulp.task( 'rtl', function() {
	return gulp.src( path + 'style.css' )
			   .pipe( $.rtlcss() )
			   .pipe( $.rename( 'rtl.css' ) )
			   .pipe( gulp.dest( path ) );
} );
