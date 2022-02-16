require('jquery');
// window.$ = window.jQuery = jQuery;

const chatHistory = document.getElementById('chatHistory');
chatHistory.scrollTop = chatHistory.scrollHeight;

$(function() {
    const scrollToLatestMessage = () => {
        const chatHistory = document.getElementById('chatHistory');
        const $chatHistory = $('#chatHistory');
        $chatHistory.animate({ scrollTop: chatHistory.scrollHeight }, 500);
    }

    Livewire.on('sendMessage', message => {
        scrollToLatestMessage();
    })

    window.Echo.channel('chat').listen('.MessageSent', (e) => {
        // scrollToLatestMessage();
        var refKey = e.message.id.toString();
        refKey = refKey.replace(/-/g, '');
        $(`[data-key="${refKey}"]`).addClass('sent');
        console.log();
    });
});