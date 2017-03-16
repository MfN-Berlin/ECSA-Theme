module.exports = function (gulp, plugins) {
    return function () {
  	  return gulp.src('bundle/styles.css')
	    .pipe(plugins.bless({force : true}))
	    .pipe(gulp.dest('bundle'));
	};
}