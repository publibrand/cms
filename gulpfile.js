"use strict";

var gulp = require('gulp');

var concat = require('gulp-concat');
var stylus = require('gulp-stylus');
var uglify = require('gulp-uglify'); 
var livereload = require('gulp-livereload');
var rename = require('gulp-rename');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');

// ---- Compile Stylus ---- //

gulp.task('stylus', function() {
    gulp.src("public/dev/stylus/**.styl")
        .pipe(stylus({
            sourcemaps: true,
            compress: true,
        }))
        .pipe(autoprefixer({
            browsers: ['last 100 versions'],
            cascade: false
        }))
        .pipe(rename('style.min.css'))
        .pipe(gulp.dest('public/assets/css'))
        .pipe(livereload());
});

// ---- Concat and Minify JS ---- //

gulp.task('js', function() {
    gulp.src('public/dev/js/**/*.js')
      .pipe(sourcemaps.init())
      .pipe(concat('scripts.min.js'))
      .pipe(uglify())
      .pipe(sourcemaps.write( '.' ))
      .pipe(gulp.dest('public/assets/js'))
      .pipe(livereload());
});

gulp.task('default', ['js', 'stylus']);

gulp.task('watch', function() {
    livereload.listen();
    gulp.watch('public/dev/js/**/*.js', ['js']);
    gulp.watch('public/dev/stylus/**/*.styl', ['stylus']);
});