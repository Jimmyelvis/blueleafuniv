const gulp = require('gulp'),
settings = require('./settings'),
sass = require('gulp-sass'),
webpack = require('webpack'),
cssbeautify = require('gulp-cssbeautify'),
browserSync = require('browser-sync').create();


gulp.task('styles', function() {
  return gulp.src('./wp-content/themes/fictional-university-theme/sass/**/*.scss')
  .pipe(sass())
  .pipe(cssbeautify()).pipe(cssbeautify())
  .pipe(gulp.dest(settings.themeLocation))
});

gulp.task('scripts', function(callback) {
  webpack(require('./webpack.config.js'), function(err, stats) {
    if (err) {
      console.log(err.toString());
    }

    console.log(stats.toString());
    callback();
  });
});

gulp.task('watch', function(done) {
  browserSync.init({
    notify: false,
    proxy: settings.urlToPreview,
    ghostMode: false
  });

  gulp.watch('./**/*.php', function(done) {
    browserSync.reload();
    done();
  });
  gulp.watch('./wp-content/themes/fictional-university-theme/sass/**/*.scss', gulp.parallel('waitForStyles'));
  gulp.watch([settings.themeLocation + 'js/modules/*.js', settings.themeLocation + 'js/scripts.js'], gulp.parallel('waitForScripts'));
});

gulp.task('waitForStyles', gulp.series('styles', function() {
  return gulp.src(settings.themeLocation + 'style.css')
    .pipe(browserSync.stream());
}))

gulp.task('waitForScripts', gulp.series('scripts', function(cb) {
  browserSync.reload();
  cb()
}))
