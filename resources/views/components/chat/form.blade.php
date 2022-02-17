<div class="chat-message clearfix">
    <form enctype="multipart/form-data" wire:submit.prevent="sendMessage" x-data="{ isInputEmpty: true }"  x-on:submit="isInputEmpty = true">
        <div class="input-group mb-0">
            <button class="btn btn-lg btn-dark" id="uploadAttachment"><i class="fas fa-paperclip"></i></button>
            <input type="file" id="attachment" hidden class="totally-hidden">
            <input x-on:keyup="isInputEmpty = $el.value != '' ? false : true" wire:model.defer="message" id="message" class="form-control" placeholder="Type your message">
            <button type="submit" class="btn btn-lg" x-bind:class="isInputEmpty ? 'btn-secondary disabled' : 'btn-primary'"><i class="fas fa-paper-plane"></i></button>
        </div>
    </form>
</div>
