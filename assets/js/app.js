// assets/js/app.js
var $ = require('jquery');
var greet = require('./greet');

$(document).ready(function() {
    $('#root_top').append('<h1>'+greet('list')+'</h1>');
});