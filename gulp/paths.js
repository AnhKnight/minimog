'use strict';
var glob           = require( 'glob' ),
    files          = glob( 'src/*', { sync: true } ),
    mainTheme      = files[0].replace( 'src/', '' ),
    childTheme     = files[1].replace( 'src/', '' ),
    childThemeDemo = files[2].replace( 'src/', '' );

module.exports = {
	mainTheme: mainTheme,
	childTheme: childTheme,
	childThemeDemo: childThemeDemo,
	taskDone: [
		'src/**/*.php',
		'gulp/**/*.js'
	],
	root: {
		main: 'src/' + mainTheme + '/',
		child: 'src/' + childTheme + '/',
		childDemo: 'src/' + childThemeDemo + '/',
		document: 'themeforest/documentation/',
		adminCss: 'src/' + mainTheme + '/assets/admin/css/',
	},
	javascript: {
		src: 'src/' + mainTheme + '/assets/js/modules/**/*.js',
		dist: 'src/' + mainTheme + '/assets/js/'
	},
	sass: {
		main: {
			watch: 'src/' + mainTheme + '/assets/scss/**/*.scss',
			generate: 'src/' + mainTheme + '/assets/scss/*.scss'
		},
		admin: {
			watch: 'src/' + mainTheme + '/assets/admin/scss/**/*.scss',
			generate: 'src/' + mainTheme + '/assets/admin/scss/*.scss'
		},
		childDemo: 'src/' + childThemeDemo + '/assets/scss/*.scss'
	},
	images: [
		'src/' + mainTheme + '/assets/images/*.{JPG,jpg,png,gif}',
		'data/*.{JPG,jpg,png,gif}'
	],
	code: {
		main: [
			'src/' + mainTheme + '/style.css',
			'src/' + mainTheme + '/style-rtl.css',
			'src/' + mainTheme + '/woocommerce.css',
			'src/' + mainTheme + '/**/*.php',
			'src/' + mainTheme + '/assets/js/*.js',
			'src/' + mainTheme + '/assets/libs/**/**/*.js'
		],
		admin: {
			outputCss: 'src/' + mainTheme + '/assets/admin/css/',
		},
		childDemo: [
			'src/' + childThemeDemo + '/style.css',
			'src/' + childThemeDemo + '/**/*.php',
			'src/' + childThemeDemo + '/assets/js/*.js'
		],
		document: 'themeforest/documentation/*.html'
	},
	zipMini: [
		'src/' + mainTheme + '/**/*',
		'!src/' + mainTheme + '/plugins/**',
		'!src/' + mainTheme + '/assets/scss/**',
		'!src/' + mainTheme + '/assets/import/**'
	],
	linting: {
		js: 'src/' + mainTheme + '/assets/js/',
		scss: 'src/' + mainTheme + '/assets/scss/**/*.scss',
		phpcs: [
			'**/*.php',
			'!**/class-detect.php',
			'!**/class-kirki.php',
			'!**/class-thumbs.php',
			'!**/demo-options/**',
			'!wpcs',
			'!wpcs/**'
		]
	}
};
