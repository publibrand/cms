"use strict";

var gulp = require('gulp');

var concat = require('gulp-concat');
var stylus = require('gulp-stylus');
var uglify = require('gulp-uglify'); 
var livereload = require('gulp-livereload');
var rename = require('gulp-rename');

// ---- Concat ---- //

gulp.task('css', function() {
    gulp.src("public/dev/stylus/**.styl")
        .pipe(stylus({
            compress: true,
        }))
        .pipe(rename('style.min.css'))
        .pipe(gulp.dest('public/assets/css'))
        .pipe(livereload());
});

// ---- Concat and Minify ---- //

gulp.task('js', function() {
    gulp.src('public/dev/js/**/*.js')
      .pipe(concat('scripts.min.js'))
      .pipe(uglify())
      .pipe(gulp.dest('public/assets/js'))
      .pipe(livereload());
});

gulp.task('default', ['js', 'css']);

gulp.task('watch', function() {
    livereload.listen();
    gulp.watch('public/assets/js/**/*.js', ['js']);
    gulp.watch('public/assets/css/**/*.css', ['css']);
});