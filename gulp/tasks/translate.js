'use strict';
var gulp   = require( 'gulp' ),
    $      = require( 'gulp-load-plugins' )(),
    config = require( '../config.json' ).translate,
    path   = require( '../paths' ).root.main;

// Update Pot file.
gulp.task( 'translate', function() {
	return gulp.src( path + '**/*.php' )
			   .pipe( $.sort() )
			   .pipe( $.wpPot( {
				   domain: config.textDomain,
				   bugReport: config.bugReport,
				   team: config.team
			   } ) )
			   .pipe( gulp.dest( path + '/languages/' ) );
} );
