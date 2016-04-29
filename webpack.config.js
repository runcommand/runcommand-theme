var path = require('path'),
	glob = require('glob');

module.exports = {
	// webpack options
	cache: true,
	entry: {
		"app": "./assets/js/app.js",
		"js-tests": glob.sync( './js-tests/**/*.js' )
	},
	output: {
		path: "assets/dist/",
		filename: "[name].js",
		sourceMapFilename: '[name].map',
		publicPath: '/js/'
	},

	stats: {
		// Configure the console output
		colors: true,
		modules: true,
		reasons: true
	},
	module: {
		loaders: [
			{
				test: /\.jsx?$/,
				exclude: /(node_modules|bower_components)/,
				loaders: ['babel']
			},
			{
				test: /\.json$/,
				loader: "json-loader"
			}
		]
	},

	plugins: [

	],

	externals: {
		//don't bundle the 'react' npm package with our bundle.js
		//but get it from a global 'React' variable
		//'react': 'React',
		//'react/addons' : 'React',
		// fix issues with using enzyme
		jsdom: 'window',
		'react/lib/ExecutionEnvironment': true,
		'react/lib/ReactContext': 'window',
		'text-encoding': 'window'
	},
	// stats: false disables the stats output

	progress: false, // Don't show progress
	// Defaults to true

	failOnError: false, // don't report error to grunt if webpack find errors
	// Use this if webpack errors are tolerable and grunt should continue

	watch: false, // use webpacks watcher
	// You need to keep the grunt process alive

	keepalive: false, // don't finish the grunt task
	// Use this in combination with the watch option
}
