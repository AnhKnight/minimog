'use strict';
var gulp  = require( 'gulp' ),
    del   = require( 'del' ),
    paths = require( '../paths' );

// Clean dist folder.
gulp.task( 'clean:dist', function() {
	return del( [ 'dist/**' ] );
} );

// Clean dist after build package.
gulp.task( 'clean:dist:after', function() {
	return del( [ 'dist/**/*', '!dist/*.zip' ] );
} );

// Copy documentation, plugins and license.
gulp.task( 'copy:tf', function() {
	return gulp.src( 'themeforest/**', { base: 'themeforest/' } )
			   .pipe( gulp.dest( 'dist/' ) );
} );

// Copy changelog to dist folder
gulp.task( 'copy:changelog', function() {
	return gulp.src( paths.root.main + 'readme.txt', { base: paths.root.main } )
			   .pipe( gulp.dest( 'dist/' ) );
} );

// Package main theme.
gulp.task( 'package:main', gulp.series( 'translate', 'rtl', 'sass:full', 'zip', 'size', 'todo' ) );

// Package main theme without scss and zip files.
gulp.task( 'package:mini', gulp.series( 'translate', 'rtl', 'sass:full', 'zip:mini', 'size', 'todo' ) );

// Package.
gulp.task( 'package', gulp.series( 'translate', 'rtl', 'sass:full', 'zip', 'zip:mini', 'zip:child', 'size', 'todo' ) );

// Package for envato.
gulp.task( 'envato', gulp.series( 'clean:dist', 'pull:tf', 'translate', 'rtl', 'sass:full', 'zip', 'zip:mini', 'zip:child', 'copy:tf', 'zip:envato', 'clean:dist:after', 'copy:changelog', 'sync:dist', 'size', 'todo' ) );
