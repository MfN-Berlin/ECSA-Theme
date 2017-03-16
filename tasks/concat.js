module.exports = function (gulp, plugins , opts ) {
    return function () {
    		  files = [] ;
    		  
    		  var files = plugins.mainBowerFiles('**/*.js');
    		  
    		  for ( a in opts.gulp.js.paths ) {
    			  files.push(opts.gulp.js.paths[a] + "/**/*.js" );
    			  //console.log("Add external path " + opts.gulp.js.paths[a] + "/**/*.js")
    		  }
    		  files.unshift('js/script.js');
	    	  return gulp.src(files)
	    	    .pipe(plugins.concat('scripts.js'))
	    	    .pipe(gulp.dest('./bundle'));
	    };
}