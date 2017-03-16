module.exports = function (gulp, plugins,opts) {
    return function () {
  	  return gulp.src('js/scripts.js')
	    .pipe(plugins.uglify())
	    .pipe(gulp.dest('js/'));
	};
}