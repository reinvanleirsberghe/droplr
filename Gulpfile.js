var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var minifyCSS = require('gulp-minify-css');
var rename = require('gulp-rename');
var order = require('gulp-order');

gulp.task('scss', function(){
    gulp.src('app/assets/sass/**/*.scss')
        .pipe(sass())
        .pipe(autoprefixer('last 10 version'))
        .pipe(gulp.dest('public/css'))
        .pipe(concat('main.css'))
        .pipe(gulp.dest('public/css'))
        .pipe(minifyCSS())
        .pipe(rename('all.min.css'))
        .pipe(gulp.dest('public/css'));
});

gulp.task('js', function() {
    gulp.src('app/assets/scripts/**/*.js')
        .pipe(sourcemaps.init())
        .pipe(uglify())
        .pipe(concat('all.min.js'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('public/scripts'))
});

gulp.task('watch', function(){
    gulp.watch('app/assets/sass/**/*.scss', ['scss']);
    gulp.watch('app/assets/scripts/**/*.js', ['js']);
});

gulp.task('default', ['watch']);