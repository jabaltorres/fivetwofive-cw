const { src, dest, watch, series } = require('gulp'),
    sass                           = require('gulp-sass'),
    Fiber                          = require('fibers'),
    postcss                        = require('gulp-postcss'),
    autoprefixer                   = require('autoprefixer'),
    cssnano                        = require('cssnano'),
    sourcemaps                     = require('gulp-sourcemaps'),
    jshint                         = require('gulp-jshint'),
    rename                         = require('gulp-rename'),
    uglify                         = require('gulp-uglify'),
    concat                         = require('gulp-concat'),
    imagemin                       = require('gulp-imagemin'),
    log                            = require('fancy-log'),
    browserSync                    = require("browser-sync").create();

sass.compiler = require('sass');

const paths = {
    style: {
        src: "assets/src/sass/**/*.scss",
        dest: "./"
    },
    scripts:{
        src: "assets/src/js/*.js",
        dest: "assets/dist/js",
        hintfile: "assets/src/js/.jshintrc"
    },
    maps:{
        dest: "./assets/dist/maps"
    },
    images:{
        src: "assets/src/images/*",
        dest: "assets/dist/images"
    }
};

/**
 * @task style
 * Compile files from scss src, run postcss, write sourcemap, send to dest, and refresh browser
 */
const style = () => src(paths.style.src)
    .pipe(sourcemaps.init())
    .pipe(sass({fiber: Fiber})
    .on('error', sass.logError))
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write(paths.maps.dest))
    .pipe(dest(paths.style.dest))
    .pipe(browserSync.stream());

/**
 * @task lint
 * Detects errors and potential problems in JavaScript code
 */
const lint = () => src(paths.scripts.src)
    .pipe(jshint(paths.scripts.hintfile))
    .pipe(jshint.reporter('jshint-stylish'));

/**
 * @task scripts
 * Concatenate, minify, and send scripts
 * `scripts` depends on `lint`
 */
const scripts = () => src(paths.scripts.src)
    .pipe(sourcemaps.init())
    .pipe(concat('scripts.js'))
    .pipe(dest(paths.scripts.dest))
    .pipe(rename('scripts.min.js'))
    .pipe(uglify().on('error', (e) => { log(e); }))
    .pipe(sourcemaps.write(paths.maps.dest))
    .pipe(dest(paths.scripts.dest))
    .pipe(browserSync.stream())
    .on('end', () => { log('Scripts Done!'); });

/**
 * @task minify
 * Minify PNG, JPEG, GIF and SVG images with imagemin
 */
const imageminify = () => src(paths.images.src)
    .pipe(imagemin([
        imagemin.gifsicle({interlaced: true}),
        imagemin.jpegtran({progressive: true}),
        imagemin.optipng({optimizationLevel: 5}),
        imagemin.svgo({
            plugins: [
                {removeViewBox: true},
                {cleanupIDs: false}
            ]
        })
    ]))
    .pipe(gulp.dest(paths.images.dest));

// Add browsersync initialization at the start of the watch task
// We don't have to expose the reload function
// It's currently only useful in other functions
const serve = () => {
    browserSync.init({
        proxy: "https://fivetwofive.local/"
    });

    watch(paths.style.src, style);
    watch(paths.scripts.src, series(lint, scripts));
    // We should tell gulp which files to watch to trigger the reload
    // This can be html or whatever you're using to develop your website
    // Note -- you can obviously add the path to the Paths object
    // gulp.watch("path/to/html/*.html", reload);
    log('Watch function completed');
}

/**
 * Default test task, running just `gulp` will
 * compile Sass files, launch Browsersync & watch files.
 */
exports.default = (cb) => {
    cb();
    serve();
};

// Function are exported to be public and can be run with the `gulp` command.
exports.serve       = serve;
exports.imageminify = imageminify;
exports.style       = style;
exports.scripts     = series(lint, scripts);