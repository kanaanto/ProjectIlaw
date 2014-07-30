var gulp = require('gulp');
var sass = require('gulp-ruby-sass');
var jshint = require('gulp-jshint');

var paths = {
	sass_dir: 'app/assets/sass/*.scss',
	build_css: 'public/css/',
	js_dir: 'app/assets/js/*.js'
};

gulp.task('css',function(){
	return(gulp.src(paths.sass_dir))
	.pipe(sass({sourcemap: true, sourcemapPath: '../scss'}))
	.pipe(gulp.dest(paths.build_css));
});

gulp.task('lint',function(){
	return(gulp.src(paths.js_dir))
	.pipe(jshint())
	.pipe(jshint.reporter('default'));
});

gulp.task('watch',function(){
	gulp.watch(paths.sass_dir,['css']);
	gulp.watch(paths.js_dir,['lint']);
});

gulp.task('default',['lint','css','watch']);
