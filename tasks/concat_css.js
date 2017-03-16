module.exports = function (gulp, plugins,opts) {
    return function () {
    	  var files = plugins.mainBowerFiles('**/*.css');
    	  for ( a in opts.gulp.css.paths ) {
			  files.push(opts.gulp.js.paths[a] + "/**/*.css" );
			  //console.log("Add external path " + opts.gulp.js.paths[a] + "/**/*.css")
		  }
    	  return gulp.src(files)
    	  	.pipe(plugins.concat("bundles.css"))
    	    .pipe(plugins.minifyCSS("bundles.css"))
    	    .pipe(gulp.dest('bundle/'));
	};
}