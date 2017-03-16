module.exports = function (gulp, plugins) {
    return function () {
   	  var files = plugins.mainBowerFiles(['**/*.eot','**/*.svg','**/*.ttf','**/*.woff','**/*.woff2']);
	  return gulp.src(files)
	    .pipe(plugins.copy("fonts",{prefix : 4}));
	};
}