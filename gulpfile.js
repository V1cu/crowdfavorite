// Gulp
const gulp = require('gulp');

// Plugins
const plugins = require('gulp-load-plugins')({
  pattern      : ['gulp-*', 'gulp.*', 'postcss-url', 'cssnano'],
  replaceString: /\bgulp[\-.]/,
});

// Compress CSS
gulp.task('compress:css', () =>
{
  const postCssPlugins = [
    plugins.cssnano({
      preset         : [
        'default', {
          discardComments: {
            removeAll: true,
          },
        }],
      discardComments: {removeAll: true},
      zindex         : false,
      reduceIdents   : false,
    }),
  ];

  return gulp.src(['./assets/scss/style.scss'])
             .pipe(plugins.sass({
               outputStyle    : 'compressed',
               precision      : 10,
               errLogToConsole: true,
             }))
             .pipe(plugins.postcss(postCssPlugins))
             .pipe(plugins.concat('style.css'))
             .pipe(gulp.dest('./'));
});

// Compress JS
gulp.task('compress:js', function()
{
  return gulp.src([
    './assets/js/vendor/main/*.js',
    './node_modules/popper.js/dist/umd/popper.min.js',
    './node_modules/bootstrap/dist/js/bootstrap.min.js',
    './node_modules/magnific-popup/dist/jquery.magnific-popup.min.js',
    './node_modules/slick-carousel/slick/slick.min.js',
    './assets/js/vendor/other/*.js',
    './assets/js/*.js',
  ])
             .pipe(plugins.uglify())
             .pipe(plugins.concat('scripts.js'))
             .pipe(gulp.dest('./'));
});

// Default task (compress both CSS & JS)
gulp.task('default', gulp.series('compress:css', 'compress:js'));
