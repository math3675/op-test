const { src, dest, watch, series } = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const prefix = require("gulp-autoprefixer");
const minify = require("gulp-clean-css");

//compile, prefix, and min scss
function compilescss() {
  return src("assets/scss/*.scss") // change to your source directory
    .pipe(sass())
    .pipe(prefix("last 2 versions"))
    .pipe(minify())
    .pipe(dest("assets/css")); // change to your final/public directory
}

//watchtask
function watchTask() {
  watch("assets/scss/*.scss", compilescss);
}

// Default Gulp task
exports.default = series(compilescss, watchTask);
