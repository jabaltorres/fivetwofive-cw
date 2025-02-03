require('dotenv').config();
const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const cleanCSS = require('gulp-clean-css');
const browserSync = require('browser-sync').create();

// Paths
const paths = {
    styles: {
        src: 'assets/src/sass/**/*.scss',
        dest: 'assets/dist/css'
    }
};

// Initialize browserSync
function browserSyncInit(done) {
    browserSync.init({
        proxy: process.env.PROXY_URL || "localhost", // Fallback to localhost if not set
        notify: false
    });
    done();
}

// Reload browserSync
function browserSyncReload(done) {
    browserSync.reload();
    done();
}

// Compile SCSS
function styles() {
    return gulp.src(paths.styles.src)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(cleanCSS())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(paths.styles.dest))
        .pipe(browserSync.stream());
}

// Watch files
function watch() {
    gulp.watch(paths.styles.src, styles);
}

// Watch files with browserSync
function watchFiles() {
    gulp.watch(paths.styles.src, styles);
    gulp.watch('**/*.php').on('change', browserSync.reload);
}

// Define tasks
exports.styles = styles;
exports.watch = watch;
exports.build = gulp.series(styles);
exports.default = gulp.series(styles, browserSyncInit, watchFiles); 