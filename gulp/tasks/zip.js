'use strict';
var gulp  = require( 'gulp' ),
    $     = require( 'gulp-load-plugins' )(),
    time  = require( 'dateformat' )( new Date(), 'yyyy-mm-dd_HH-MM' ),
    paths = require( '../paths' );

// Zip main theme.
gulp.task( 'zip', function() {
	return gulp.src( paths.root.main + '**', { base: 'src/' } )
			   .pipe( $.zip( paths.mainTheme + '_' + time + '.zip' ) )
			   .pipe( gulp.dest( 'dist/themes/' ) );
} );

// Zip main theme without scss and zip files.
gulp.task( 'zip:mini', function() {
	return gulp.src( paths.zipMini, { base: 'src/' } )
			   .pipe( $.zip( paths.mainTheme + '_mini_' + time + '.zip' ) )
			   .pipe( gulp.dest( 'dist/themes/' ) );
} );

// Zip child theme.
gulp.task( 'zip:child', function() {
	return gulp.src( paths.root.child + '**', { base: 'src/' } )
			   .pipe( $.zip( paths.childTheme + '.zip' ) )
			   .pipe( gulp.dest( 'dist/themes/' ) );
} );

// Zip child theme for demo purpose.
gulp.task( 'zip:childDemo', function() {
	return gulp.src( paths.root.childDemo + '**', { base: 'src/' } )
			   .pipe( $.zip( paths.childThemeDemo + '_' + time + '.zip' ) )
			   .pipe( gulp.dest( 'dist/' ) );
} );

// Zip for envato.
gulp.task( 'zip:envato', function() {
	return gulp.src( 'dist/**' )
			   .pipe( $.zip( paths.mainTheme + '_package_' + time + '.zip' ) )
			   .pipe( gulp.dest( 'dist/' ) );
} );
