'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var cssnano = require('gulp-cssnano');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');

gulp.task('default', async function () {
    gulp.src('./src/sass/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            cascade: false
        }))
        .pipe(cssnano())
        .pipe(sourcemaps.write('./'))

        .pipe(gulp.dest('./assets/css/'))
});


//gulp.task('watch', function () {
//    gulp.watch('./src/sass/**/*.scss', gulp.series('styles'));
//});

//gulp.task('default', gulp.parallel('styles', 'watch'));

