'use strict';
var gulp = require( 'gulp' );

//require( './gulp/tasks/bower' );
require( './gulp/tasks/sync' );
require( './gulp/tasks/linting' );
require( './gulp/tasks/domain' );
require( './gulp/tasks/general' );
require( './gulp/tasks/deploy' );
require( './gulp/tasks/translate' );
require( './gulp/tasks/sass' );
require( './gulp/tasks/rtl' );
require( './gulp/tasks/browser-sync' );
require( './gulp/tasks/javascript' );
require( './gulp/tasks/watch' );
require( './gulp/tasks/zip' );
require( './gulp/tasks/package' );

gulp.task( 'default', gulp.series( 'todo', gulp.parallel( 'bs', 'sass', 'watch:main' ) ) );

gulp.task( 'default:remote', gulp.parallel( 'bs:remote', 'sass', 'watch:main' ) );

gulp.task( 'default:document', gulp.parallel( 'bs:document' ) );

gulp.task( 'default:rtl', gulp.series( 'todo', gulp.parallel( 'bs', 'sass', 'watch:main:rtl' ) ) );

gulp.task( 'default:childDemo', gulp.series( 'todo', gulp.parallel( 'bs:childDemo', 'sass:childDemo', 'watch:childDemo' ) ) );
