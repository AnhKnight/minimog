'use strict';
var gulp   = require( 'gulp' ),
    spawn  = require( 'child_process' ).spawn,
    folder = require( '../config.json' ).syncFolder,
	dist   = folder + 'dist/',
	forest = folder + 'themeforest/';

gulp.task( 'sync:dist', function( done ) {
	spawn( 'rsync', [ '-avz', '--delete', 'dist/', dist ], { stdio: 'inherit' } );
	done();
} );

gulp.task( 'push:tf', function( done ) {
	spawn( 'rsync', [ '-avz', '--delete', 'themeforest/', forest ], { stdio: 'inherit' } );
	done();
} );

gulp.task( 'pull:tf', function( done ) {
	spawn( 'rsync', [ '-avz', '--delete', forest, 'themeforest/' ], { stdio: 'inherit' } );
	done();
} );
