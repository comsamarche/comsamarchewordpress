'use strict';
var gulp = require('gulp'),
	plumber = require('gulp-plumber'),
	gutil = require('gulp-util'),
	rename = require('gulp-rename'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	imagemin = require('gulp-imagemin'),
	sass = require('gulp-sass'),
	sourcemaps = require('gulp-sourcemaps'),
	wait = require('gulp-wait'),
	ftp = require('gulp-ftp'),
	postCSS = require('gulp-postcss'),
	autoprefixer = require('autoprefixer'),
	cssnano = require('cssnano'),
	browserSync = require('browser-sync').create();


// ROOTS
var paths = {
   serveur: ['./'],
   images: ['./assets/img/'],
   dircss: ['./assets/css/'],
   css: ['./assets/css/*.css'],
   main: ['./assets/css/main.css'],
   map:['./assets/css/main.css.map'],
   sass: ['./assets/sass/*.scss'],
   scss: [ './assets/sass/**/*.scss'],
   php: ['./**.php','./**.html'],
   oscss: ['./assets/*.scss','!./assets/main.scss'],
   temp: ['./temp/*']
};


// DEV
// var serveur = {
//   type      : "ftp",
//   host      : "comsamarche.com",
//   user      : "it-lmdss",
//   password  : "iK5w!7x5",
//   port      : "21",
//   serveur   : "/dev.lamaisondesaintsa.com/",
//   path      : "/wp-content/themes",
//   themename : "/themecg/"
// };

// PROD
// var serveur = {
//   type      : "ftp",
//   host      : "comsamarche.com",
//   user      : "u60361224",
//   password  : "marche32",
//   port      : "21",
//   serveur   : "/christineguinaudeau-fr/",
//   path      : "/wp-content/themes",
//   themename : "/themecg/"
// };



//SASS option
var sassOptions = {
  errLogToConsole: true,
 // outputStyle: 'expanded'
  outputStyle: 'compact'
  //includePaths: [paths.sass].concat(neat)
};

gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: "http://www.christineguinaudeau.fr/"
    });
});

gulp.task('bs-reload', function () {
  browserSync.reload();
});



gulp.task('images', function(){
  gulp.src('src/images/**/*')
    .pipe(cache(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true })))
    .pipe(gulp.dest('dist/images/'));
});


// WORDPRESS Style.css TASK
gulp.task('styles', function(){
  var processors = [
      autoprefixer({
          browsers: ['last 5 versions'],
      }),
      cssnano(),
  ];
  gulp.src(paths.sass)
    .pipe(plumber({
      errorHandler: function (error) {
        console.log(error.message);
        this.emit('end');
    }}))
    .pipe(sourcemaps.init())
    .pipe(sass.sync(sassOptions).on('error', sass.logError))
    .pipe(postCSS(processors))
    .pipe(sourcemaps.write("./"))
    .pipe(gulp.dest("./assets/css/"))
    .pipe(browserSync.reload({stream:true}));
});



gulp.task('scripts', function(){
  return gulp.src('src/scripts/**/*.js')
    .pipe(plumber({
      errorHandler: function (error) {
        console.log(error.message);
        this.emit('end');
    }}))
    .pipe(concat('main.js'))
    .pipe(gulp.dest('js/'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('js/'))
    .pipe(browserSync.reload({stream:true}))
});


// DEPLOY SERVEUR TASK
gulp.task('deploy', function () {
    return gulp.src([paths.main, paths.map])     // Prend en entrée les fichiers
        .pipe(ftp({
          host: serveur.host,
          user: serveur.user,
          pass: serveur.password,
          port: serveur.port,
          remotePath: serveur.serveur + serveur.path + serveur.themename
        }))
        .pipe(gutil.noop())
        .pipe(browserSync.stream());
});

gulp.task('livereloadcss', ['deploy'], function () {
    return gulp.src(paths.css)     // Prend en entrée les fichiers
        .pipe(livereload());       // recharge de serveur
});

gulp.task('livereload', ['deploy'], function () {
    return gulp.src(paths.php)     // Prend en entrée les fichiers
        .pipe(wait(2000))         // Met un délai de 2s
        .pipe(livereload());       // recharge de serveur
});


gulp.task('default',['browser-sync', 'styles'], function(){
      gulp.watch( paths.scss , ['styles']);
      gulp.watch( paths.css , ['deploy']);
      gulp.watch( paths.php ).on('change', browserSync.reload);
});


gulp.task('watch',['styles'], function(){
      browserSync.init({
          proxy: "http://local.wp/"
      });
      gulp.watch( paths.scss , ['styles']);
      gulp.watch( paths.php ).on('change', browserSync.reload);
});


gulp.task('build', function(callback) {
  runSequence('browser-sync',
              'styles',
              'deploy',
              callback);
});
