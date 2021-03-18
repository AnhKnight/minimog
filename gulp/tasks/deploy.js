'use strict';
var gulp       = require( 'gulp' ),
    spawn      = require( 'child_process' ).spawn,
	remote     = require( '../config.json' ).deploy.remote,
    localPath  = require( '../config.json' ).deploy.local,
	remotePath = remote.user + '@thememove.com:/var/www/' + remote.subDomain + '.thememove.com/htdocs/',
	data       = 'data/',
	themes     = 'wp-content/themes/',
	uploads    = 'wp-content/uploads/',
	plugins    = 'wp-content/plugins/',
    paths      = {
		local: {
			data: 'data/',
			themes: 'src/',
			uploads: localPath + uploads,
			plugins: localPath + plugins
		},
		remote: {
			data: remotePath + data,
			themes: remotePath + themes,
			uploads: remotePath + uploads,
			plugins: remotePath + plugins
		}
	};

gulp.task( 'push:themes', function( done ) {
	spawn( 'rsync', [ '-avzhe', 'ssh', '--delete', '-L', paths.local.themes, paths.remote.themes ], { stdio: 'inherit' } );
	done();
} );

gulp.task( 'push:uploads', function( done ) {
	spawn( 'rsync', [ '-avzhe', 'ssh', '--delete', '-L', paths.local.uploads, paths.remote.uploads ], { stdio: 'inherit' } );
	done();
} );

gulp.task( 'push:plugins', function( done ) {
	spawn( 'rsync', [ '-avzhe', 'ssh', '--delete', '-L', paths.local.plugins, paths.remote.plugins ], { stdio: 'inherit' } );
	done();
} );

gulp.task( 'push:data', function( done ) {
	spawn( 'rsync', [ '-avzhe', 'ssh', '--delete', '-L', paths.local.data, paths.remote.data ], { stdio: 'inherit' } );
	done();
} );

gulp.task( 'push:all', gulp.series( 'push:themes', 'push:uploads', 'push:plugins', 'push:data' ) );

/*gulp.task( 'pull:themes', function( done ) {
	spawn( 'rsync', [ '-avzhe', 'ssh', '--delete', '-L', paths.remote.themes, paths.local.themes ], { stdio: 'inherit' } );
	done();
} );

gulp.task( 'pull:uploads', function( done ) {
	spawn( 'rsync', [ '-avzhe', 'ssh', '--delete', '-L', paths.remote.uploads, paths.local.uploads ], { stdio: 'inherit' } );
	done();
} );

gulp.task( 'pull:plugins', function( done ) {
	spawn( 'rsync', [ '-avzhe', 'ssh', '--delete', '-L', paths.remote.plugins, paths.local.plugins ], { stdio: 'inherit' } );
	done();
} );

gulp.task( 'pull:data', function( done ) {
	spawn( 'rsync', [ '-avzhe', 'ssh', '--delete', '-L', paths.remote.data, paths.local.data ], { stdio: 'inherit' } );
	done();
} );*/
