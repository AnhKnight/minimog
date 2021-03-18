'use strict';
var gulp   = require( 'gulp' ),
    spawn  = require( 'child_process' ).spawn;

gulp.task( 'bower:copy', function( done ) {
	spawn( 'bower-installer', { stdio: 'inherit' } );
	done();
} );
