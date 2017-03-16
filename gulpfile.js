var opts = {pattern: ['gulp-*', 'gulp.*','main-bower-files','livereload','ini']} ;

var gulp = require('gulp');
var fs = require('fs');
var ini = require('ini');
var plugins = require('gulp-load-plugins')(opts);
var del = require('del') ;
var path = require('path') ;

var paths = ['styles'] ;


var config = {
	gulp : {
		modernizr : {
			
		},
		js : {
			paths: []
		},
		css : {
			paths : []
		},
		sass : {
			paths: [],
			node : [],
			includePaths : []
		},
		livereload : {
			enabled : true
		}
	},
	
};

plugins.minifyCSS = require('gulp-minify-css') ;
plugins.notifier = require('node-notifier');
plugins.merge = require('merge') ;

var configFile = __dirname.substr(__dirname.lastIndexOf(path.sep)) + ".info";
configFile = '.' + configFile ;

if ( fs.existsSync(configFile) ) {
  plugins.merge.recursive(config,ini.parse(fs.readFileSync(configFile, 'utf-8')));
} else {
	console.log("No config file found") ;
}

for ( include in config.gulp.sass.paths  ) {
	if ( fs.existsSync(config.gulp.sass.paths[include]) ) {
		paths = paths.concat(config.gulp.sass.paths[include]);
	} else {
		console.log("Include path not found " + config.gulp.sass.paths[include])
	}
}

plugins.mainBowerFiles('**/*.scss').forEach(function(v){
	paths = paths.concat(path.dirname(v)) ;
})

plugins.mainBowerFiles('**/*.sass').forEach(function(v){
	paths = paths.concat(path.dirname(v)) ;
})

config.sass = {
	includePaths : paths 
};

gulp.task('sass', require('./tasks/sass')(gulp, plugins,config));
gulp.task('concat', require('./tasks/concat')(gulp, plugins,config));
gulp.task('concat_css', require('./tasks/concat_css')(gulp, plugins,config));
gulp.task('jshint', require('./tasks/jshint')(gulp, plugins,config));
gulp.task('fonts', require('./tasks/fonts')(gulp, plugins,config));
gulp.task('bless', require('./tasks/bless')(gulp, plugins,config));
gulp.task('minify', require('./tasks/minify')(gulp, plugins,config));
gulp.task('uglify', ['concat'], require('./tasks/uglify')(gulp, plugins,config));
gulp.task('slint', ['concat'], require('./tasks/scss-lint')(gulp, plugins,config));

gulp.task('clean', function (cb) {
	del(['bundle/**/*.css','bundle/**/*.js'], cb);
});

gulp.task('watch', function() {
  plugins.livereload.listen();
  gulp.watch(['scss/**/*.scss'], ['sass','concat_css']);
  gulp.watch(['js/**/*.js'], ['jshint','concat']);
});


gulp.task('default',['fonts','sass', 'concat','concat_css','watch'], function() {
})

gulp.task('build',['clean','fonts','sass','concat','concat_css','bless'], function() {
})

gulp.task('beautify-scss', function () {
  gulp.src('scss/**/*.scss')
    .pipe(plugins.sassbeautify())
    .pipe(gulp.dest('scss'))
})

gulp.task('clean',['clean'], function() {
})
