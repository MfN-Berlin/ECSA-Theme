module.exports = function (gulp, plugins) {
    return function () {
  	  return gulp.src('css/styles.css')
	    .pipe(plugins.minifyCss())
	    .pipe(gulp.dest('css/'));
	};
}