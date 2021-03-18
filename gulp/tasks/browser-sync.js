'use strict';
var gulp       = require( 'gulp' ),
    bs         = require( 'browser-sync' ).create(),
    bsReuseTab = require( 'browser-sync-reuse-tab' )( bs ),
    proxy      = require( '../config.json' ).proxy,
    paths      = require( '../paths' ),
    bsNotify   = require( '../bs-notify' );

gulp.task( 'bs', function() {
	bs.init( {
		files: paths.code.main,
		notify: bsNotify,
		ghostMode: {
			clicks: false,
			forms: false,
			scroll: false
		}
	} );
} );

gulp.task( 'bs:remote', function() {
	bs.init( {
		proxy: proxy.remote,
		files: paths.code.main,
		notify: bsNotify,
		open: false,
		serveStatic: [
			{
				route: '/wp-content/themes/' + paths.mainTheme, // remote path
				dir: paths.root.main  // local path
			}
		]
	}, bsReuseTab );
} );

gulp.task( 'bs:childDemo', function() {
	bs.init( {
		proxy: proxy.local,
		files: paths.code.childDemo,
		open: false,
		notify: bsNotify
	}, bsReuseTab );
} );

gulp.task( 'bs:document', function() {
	bs.init( {
		server: paths.root.document,
		notify: bsNotify,
		open: false,
		plugins: [
			{
				module: 'bs-html-injector',
				options: { files: paths.code.document }
			}
		]
	}, bsReuseTab );
} );
