'use strict';
var gulp  = require( 'gulp' ),
    paths = require( '../paths' ),
	bs         = require( 'browser-sync' ).create(),
	reload = bs.reload;

gulp.task( 'watch:main', function() {
	gulp.watch( paths.sass.main.watch, gulp.series( 'sass' ) );
	gulp.watch( paths.sass.admin.watch, gulp.series( 'sass:admin') );
	gulp.watch( paths.javascript.src, gulp.series( 'javascript' ) );
} );

gulp.task( 'watch:main:rtl', function() {
	gulp.watch( paths.sass.main.watch, gulp.series( 'sass', 'rtl' ) );
	gulp.watch( paths.javascript.src, gulp.series( 'javascript' ) );
} );

gulp.task( 'watch:childDemo', function() {
	gulp.watch( paths.sass.childDemo, gulp.series( 'sass:childDemo' ) );
} );
