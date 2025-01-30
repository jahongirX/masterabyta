var gulp = require('gulp'),
    sass = require('gulp-sass'),
    browserSync = require('browser-sync'),
    cache = require('gulp-cache'),
    autoprefixer = require('gulp-autoprefixer');



/*   --- Препроцессинг с помощью Gulp ---   */
gulp.task('sass', function(){
  return gulp.src('_scss/**/*.scss')
    .pipe(sass({
      outputStyle: 'compressed'
      // outputStyle: 'expanded'
    }).on('error', sass.logError))       // Конвертируем Sass в CSS с помощью gulp-sass  

    .pipe(autoprefixer({                 // Добавление вендорных префиксов 
        browsers: ['last 9 versions'],
        cascade: false
    }))
    .pipe(gulp.dest('styles'))

    .pipe(browserSync.reload({           // позволяет Browser Sync вставлять новые стили в страницу браузера (обновлять CSS)
      stream: true
    }))
});



// Отслеживание изменений в файлах
gulp.task('watch', ['browserSync', 'sass'], function(){
  gulp.watch('_scss/**/*.scss', ['sass']);
  // Обновляем браузер при любых изменениях в HTML
  gulp.watch('*.html', browserSync.reload);
});



/*   --- Перезагрузка с помощью Browser Sync ---   */
gulp.task('browserSync', function() {
  browserSync({
    server: {
      baseDir: './'
    },
  })
});



/*  --- Дефолтный gulp ---  */
gulp.task('default', ['watch']);



/* --- очистка кэша gulp --- */
gulp.task('clear', function () {
  return cache.clearAll();
});

