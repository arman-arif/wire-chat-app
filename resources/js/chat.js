import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

$(function() {
    const $chatHistory = $('#chatHistory');
    $chatHistory.animate({ scrollTop: $chatHistory.scrollHeight }, 500)
});