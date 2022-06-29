import gulp from 'gulp'
import uglify from 'gulp-uglify'
import concat from 'gulp-concat'
import babel from 'gulp-babel'
import pkg from './package.json'
import header from 'gulp-header'

const banner = [
  '/*! ',
  '<%= package.name %> ',
  'v<%= package.version %> | ',
  '(c) ' + new Date().getFullYear() + ' <%= package.author %> |',
  ' <%= package.homepage %>',
  ' */',
  '\n'
].join('')


const cherryScripts = [
  'resources/js/src/login.js',
  'resources/js/src/update.js',
  'resources/js/src/smiley.js',
  'resources/js/src/auth.js',
  'resources/js/src/wpie.js'
]

gulp.task('js', () => {
  gulp.src(cherryScripts)
    .pipe(babel({
      presets: ['@babel/env']
    }))
    .on('error', (err) => {
      console.log(err.toString())
    })
    .pipe(concat('cherry.min.js'))
    .pipe(uglify())
    .pipe(header(banner, {
      package: pkg
    }))
    .pipe(gulp.dest('assets/js'))
})

gulp.task('default', ['js'], () => {
  gulp.watch('resources/js/src/**/*.js', ['js'])
})
