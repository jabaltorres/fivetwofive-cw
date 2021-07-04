import { src, dest, watch, series } from 'gulp';
import sass from 'sass';
import gulpSass from 'gulp-sass';
import sourcemaps from 'gulp-sourcemaps';
import fibers from 'fibers';
import cssnano from 'cssnano';
import autoprefixer from 'autoprefixer';
import postcss from 'gulp-postcss';
import rename from 'gulp-rename';
import uglify from 'gulp-uglify';
import concat from 'gulp-concat';
import eslint from 'gulp-eslint';
import imagemin from 'gulp-imagemin';
import log from 'fancy-log';
import browserSync from 'browser-sync';

gulpSass.compiler = sass;

const paths = {
	styles: {

		// By using styles/**/*.sass we're telling gulp to check all folders for any sass file
		src: 'src/scss/**/*.scss',

		// Compiled files will end up in whichever folder it's found in (partials are not compiled)
		dest: 'dist/css'
	},
	scripts: {
		src: 'src/js/*.js',
		dest: 'dist/js'
	},
	maps: {
		dest: './../../maps'
	},
	images: {
		src: 'src/images/*',
		dest: 'dist/images'
	}
};

/**
 * @task styles
 * Compile files from scss src, run postcss, write sourcemap, send to dest, and refresh browser
 */
const styles = () => src( paths.styles.src )
	.pipe( sourcemaps.init() )
	.pipe( gulpSass({fiber: fibers})
	.on( 'error', gulpSass.logError ) )
	.pipe( postcss([ autoprefixer(), cssnano() ]) )
	.pipe( sourcemaps.write( paths.maps.dest ) )
	.pipe( dest( paths.styles.dest ) )
	.pipe( browserSync.stream() );

/**
 * @task lint
 * Detects errors and potential problems in JavaScript code
 */
const lint = () => src( paths.scripts.src )
	.pipe( eslint() )
	.pipe( eslint.format() )
    .pipe( eslint.format( 'compact' ) );

/**
 * @task scripts
 * Concatenate, minify, and send scripts
 * `scripts` depends on `lint`
 */
const scripts = () => src( paths.scripts.src )
	.pipe( sourcemaps.init() )
	.pipe( concat( 'scripts.js' ) )
	.pipe( dest( paths.scripts.dest ) )
	.pipe( rename( 'scripts.min.js' ) )
	.pipe( uglify().on( 'error', ( e ) => log( e ) ) )
	.pipe( sourcemaps.write( paths.maps.dest ) )
	.pipe( dest( paths.scripts.dest ) )
	.pipe( browserSync.stream() )
	.on( 'end', () => log( 'Scripts Done!' ) );

/**
 * @task minify
 * Minify PNG, JPEG, GIF and SVG images with imagemin
 */
const images = () => src( paths.images.src )
    .pipe( imagemin([
        imagemin.gifsicle({interlaced: true}),
		imagemin.mozjpeg({quality: 75, progressive: true}),
        imagemin.optipng({optimizationLevel: 5}),
        imagemin.svgo({
            plugins: [
                {removeViewBox: true},
                {cleanupIDs: false}
            ]
        })
    ]) )
    .pipe( dest( paths.images.dest ) );

// Add browsersync initialization at the start of the watch task
// We don't have to expose the reload function
// It's currently only useful in other functions
const serve = () => {
    browserSync.init({
        proxy: `https://fivetwofive.test:8000/`
    });

    watch(paths.styles.src, styles);
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

exports.images = images;
exports.styles = styles;
exports.scripts = series( lint, scripts );