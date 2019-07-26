'use strict';

import plugins from 'gulp-load-plugins';
import yargs from 'yargs';
import gulp from 'gulp';
import sass from 'gulp-sass';
import cmq from 'gulp-combine-mq';
import concat from 'gulp-concat';
import uglify from 'gulp-uglify';
import pump from 'pump';
import rename from 'gulp-rename';
import babel from 'gulp-babel';
import Plyr from 'plyr';

// Load all Gulp plugins into one variable
const $ = plugins();

// Check for --production flag
const PRODUCTION = !!(yargs.argv.production);

// Load settings from settings.yml
const COMPATIBILITY = ['last 2 versions', 'ie >= 9'];

const pathPrefix = './assets/';
const path = {
    js: {
        src: pathPrefix + 'src/js/',
        dest: pathPrefix + 'dist/js/'
    },
    css: {
        src: pathPrefix + 'src/scss/',
        dest: pathPrefix + 'dist/css/'
    }

};

// Build the "dist" folder by running all of the below tasks
gulp.task('build',
    gulp.series(
        gulp.parallel(compileSass),
        gulp.parallel(compileScripts),
        gulp.parallel(compileVendorJS),
        gulp.parallel(compileVendorCSS)
    )
);

// Build the site, watch for file changes
gulp.task('default',
    gulp.series('build', watch));

// Compile Sass into CSS
// In production, the CSS is compressed
function compileSass() {
    return gulp.src([
        path.css.src + 'app.scss',
        path.css.src + 'holder.scss'
    ]).pipe(
        sass({}).on('error', sass.logError)
    )
        .pipe($.sourcemaps.init())
        .pipe($.autoprefixer({
            browsers: COMPATIBILITY
        }))
        .pipe(cmq({
            beautify: true
        }))
        .pipe($.if(!PRODUCTION, $.sourcemaps.write()))
        .pipe($.if(PRODUCTION, $.cssnano()))
        .pipe(gulp.dest(path.css.dest));
}

//Compile main script file
function compileScripts(cb) {
    pump([gulp.src([
            path.js.src + 'app.js',
            path.js.src + 'holder.js'
        ]).pipe(babel({
            presets: ['env']
        })),
            $.if(PRODUCTION, uglify()),
            gulp.dest(path.js.dest)
        ],
        cb
    );
}

//Compile vendor script file
function compileVendorJS(cb) {
    pump([gulp.src([
            './node_modules/jquery-lazy/jquery.lazy.js'
        ]).pipe(babel({
            presets: ['env']
        })).pipe(concat('vendor.js')),
            uglify(),
            gulp.dest(path.js.dest)
        ],
        cb
    );
    gulp.src([
        './node_modules/jquery/dist/jquery.min.js',
        './node_modules/popper.js/dist/umd/popper.min.js',
        './node_modules/bootstrap/dist/js/bootstrap.min.js',
        './node_modules/slick-carousel/slick/slick.js',
        './node_modules/sticky-sidebar/dist/jquery.sticky-sidebar.min.js'
    ]).pipe(
        gulp.dest(path.js.dest)
    );
}

//Compile vendor css file
function compileVendorCSS() {
    return gulp.src(path.css.src + 'vendor.scss')
        .pipe(
            sass({}).on('error', sass.logError)
        )
        .pipe($.cssnano())
        .pipe(gulp.dest(path.css.dest))
        /*.pipe(
            gulp.src([]).pipe(gulp.dest(path.css.dest))
        )*/;

}


// Watch for changes to static assets, pages, Sass, and JavaScript
function watch() {
    gulp.watch(path.css.src + '**/*.scss').on('change', gulp.series(compileSass));
    gulp.watch(path.js.src + '*.js').on('change', gulp.series(compileScripts));
}