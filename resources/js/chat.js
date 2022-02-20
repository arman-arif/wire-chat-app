require('jquery');
const toastr = require('toastr');
window.toastr = toastr;
// window.$ = window.jQuery = jQuery;

const chatHistory = document.getElementById('chatHistory');
chatHistory.scrollTop = chatHistory.scrollHeight;

$(function() {
    const scrollToLatestMessage = (duration = 500) => {
        const chatHistory = document.getElementById('chatHistory');
        const $chatHistory = $('#chatHistory');
        $chatHistory.animate({ scrollTop: chatHistory.scrollHeight }, duration);
    }

    // document.addEventListener('livewire:load', function() {
    // });

    Livewire.on('sendMessage', scrollToLatestMessage);
    Livewire.on('receivedMessage', scrollToLatestMessage);
    Livewire.on('messageLoaded', scrollToLatestMessage);
    Livewire.on('notifyForMessage', (event) => toastr.info(event.message, event.title));

    Livewire.on('userUpdated', (param) => history.pushState(null, null, param));

    window.Echo.channel('chat').listen('.MessageSent', (e) => Livewire.emit('incomeingMessage', e));
    window.Echo.channel('chat').listen('.UserLoggedOut', (e) => Livewire.emit('userLoggedOut', e));
    window.Echo.channel('chat').listen('.UserLoggedIn', (e) => Livewire.emit('userLoggedIn', e));
});