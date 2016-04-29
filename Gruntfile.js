var webpack = require( 'webpack' );
var webpackConfig = require( './webpack.config' );

module.exports = function( grunt ) {

	'use strict';

	grunt.initConfig({

		pkg:    grunt.file.readJSON( 'package.json' ),

		sass: {
			options: {
				sourceComments: false
			},
			compile: {
				files: {
					'assets/css/style.css' : 'assets/css/scss/style.scss',
					'assets/css/admin.css' : 'assets/css/scss/admin.scss',
				}
			}
		},

		postcss: {
			options: {
				processors: [
					require('autoprefixer')(),
				]
			},
			dist: {
				src: 'assets/css/*.css'
			}
		},

		webpack: {
			options: webpackConfig,
			build: {
				plugins: webpackConfig.plugins.concat(
					new webpack.optimize.DedupePlugin()
				),
				output: {
					path: "assets/dist/"
				}
			}
		},

		mochaTest: {
			test: {
				options: {
					reporter: 'spec'
				},
				src: ['assets/dist/js-tests.js']
			}
		}

	});

	grunt.loadNpmTasks('grunt-sass');
	grunt.loadNpmTasks('grunt-postcss');
	grunt.loadNpmTasks('grunt-webpack');
	grunt.loadNpmTasks('grunt-mocha-test');

	grunt.registerTask( 'default', [ 'styles', 'scripts' ] );
	grunt.registerTask( 'styles', [ 'sass', 'postcss' ] );
	grunt.registerTask( 'scripts', [ 'webpack', 'mochaTest' ] );
	grunt.registerTask( 'test', [ 'mochaTest' ] );

	grunt.util.linefeed = '\n';

}
