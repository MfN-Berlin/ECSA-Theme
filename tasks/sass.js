module.exports = function (gulp, plugins,opts) {
    return function () {
		var paths = ['styles'];
		gulp.src('scss/styles.scss')
			.pipe(plugins.plumber())
		    .pipe(plugins.sass({
		      includePaths: opts.sass.includePaths,
		      sourceComments : true,
		      onError : function (err) {
		    	  var msg = {
		    		  message :"\nFile: " + err.file + "\nLine: " + err.line + " \nColumn: " + err.column+ "\nMessage: " + err.message ,
		    		  title : 'Sass error'
		    	  };
		    	  return plugins.notify().write(plugins.util.colors.red(msg.message)) ;
		      }
	    }))
	    .pipe(gulp.dest('bundle/'))
	    .pipe(plugins.livereload())
	    .pipe(plugins.notify({ message: 'Styles task complete' }));
	};
}