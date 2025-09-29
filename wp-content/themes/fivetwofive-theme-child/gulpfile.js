require('dotenv').config();
const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const cleanCSS = require('gulp-clean-css');
const browserSync = require('browser-sync').create();
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');

// Paths
const paths = {
    styles: {
        src: 'assets/src/sass/**/*.scss',
        dest: 'assets/dist/css'
    },
    scripts: {
        src: 'assets/src/js/**/*.js',
        dest: 'assets/dist/js'
    },
    vendor: {
        src: [
            'node_modules/gsap/dist/gsap.min.js',
            'node_modules/gsap/dist/ScrollTrigger.min.js'
        ],
        dest: 'assets/dist/js/vendor'
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

// Add JavaScript processing function
function scripts() {
    return gulp.src(paths.scripts.src)
        .pipe(sourcemaps.init())
        .pipe(concat('main.js'))
        .pipe(uglify())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(paths.scripts.dest))
        .pipe(browserSync.stream());
}

// Add vendor copy function
function vendor() {
    return gulp.src(paths.vendor.src)
        .pipe(gulp.dest(paths.vendor.dest));
}

// Watch files
function watch() {
    gulp.watch(paths.styles.src, styles);
}

// Watch files with browserSync
function watchFiles() {
    gulp.watch(paths.styles.src, styles);
    gulp.watch(paths.scripts.src, scripts);
    gulp.watch('**/*.php').on('change', browserSync.reload);
}

// Define tasks
exports.styles = styles;
exports.scripts = scripts;
exports.vendor = vendor;
exports.watch = watch;
exports.build = gulp.series(styles, scripts, vendor);
exports.default = gulp.series(styles, scripts, vendor, browserSyncInit, watchFiles); 