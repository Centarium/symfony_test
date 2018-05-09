webpackJsonp([2],{

/***/ "./assets/js/app.js":
/*!**************************!*\
  !*** ./assets/js/app.js ***!
  \**************************/
/*! dynamic exports provided */
/*! all exports used */
/***/ (function(module, exports, __webpack_require__) {

// assets/js/app.js
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
var greet = __webpack_require__(/*! ./greet */ "./assets/js/greet.js");

$(document).ready(function () {
    $('#root_top').append('<h1>' + greet('list') + '</h1>');
});

/***/ }),

/***/ "./assets/js/greet.js":
/*!****************************!*\
  !*** ./assets/js/greet.js ***!
  \****************************/
/*! dynamic exports provided */
/*! all exports used */
/***/ (function(module, exports) {

module.exports = function (name) {
    return "Invoice " + name;
};

/***/ })

},["./assets/js/app.js"]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9ncmVldC5qcyJdLCJuYW1lcyI6WyIkIiwicmVxdWlyZSIsImdyZWV0IiwiZG9jdW1lbnQiLCJyZWFkeSIsImFwcGVuZCIsIm1vZHVsZSIsImV4cG9ydHMiLCJuYW1lIl0sIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7O0FBQUE7QUFDQSxJQUFJQSxJQUFJLG1CQUFBQyxDQUFRLG9EQUFSLENBQVI7QUFDQSxJQUFJQyxRQUFRLG1CQUFBRCxDQUFRLHFDQUFSLENBQVo7O0FBRUFELEVBQUVHLFFBQUYsRUFBWUMsS0FBWixDQUFrQixZQUFXO0FBQ3pCSixNQUFFLFdBQUYsRUFBZUssTUFBZixDQUFzQixTQUFPSCxNQUFNLE1BQU4sQ0FBUCxHQUFxQixPQUEzQztBQUNILENBRkQsRTs7Ozs7Ozs7Ozs7O0FDSkFJLE9BQU9DLE9BQVAsR0FBaUIsVUFBU0MsSUFBVCxFQUFlO0FBQzVCLHdCQUFrQkEsSUFBbEI7QUFDSCxDQUZELEMiLCJmaWxlIjoianMvYXBwLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gYXNzZXRzL2pzL2FwcC5qc1xudmFyICQgPSByZXF1aXJlKCdqcXVlcnknKTtcbnZhciBncmVldCA9IHJlcXVpcmUoJy4vZ3JlZXQnKTtcblxuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XG4gICAgJCgnI3Jvb3RfdG9wJykuYXBwZW5kKCc8aDE+JytncmVldCgnbGlzdCcpKyc8L2gxPicpO1xufSk7XG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIC4vYXNzZXRzL2pzL2FwcC5qcyIsIm1vZHVsZS5leHBvcnRzID0gZnVuY3Rpb24obmFtZSkge1xuICAgIHJldHVybiBgSW52b2ljZSAke25hbWV9YDtcbn07XG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIC4vYXNzZXRzL2pzL2dyZWV0LmpzIl0sInNvdXJjZVJvb3QiOiIifQ==