"use strict";

var gulp = require('gulp');

var concat = require('gulp-concat');
var minifycss = require('gulp-minify-css');
var uglify = require('gulp-uglify'); 
var livereload = require('gulp-livereload');

// ---- Concat ---- //

gulp.task('css', function() {
    gulp.src(["public/assets/css/*.css", "!public/assets/css/style.min.css"])
        .pipe(minifycss())
        .pipe(concat('style.min.css'))
        .pipe(gulp.dest('public/assets/css'))
        .pipe(livereload());
});

// ---- Concat and Minify ---- //

gulp.task('js', function() {
    gulp.src(['public/assets/js/**/*.js', "!public/assets/js/scripts.min.js"])
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