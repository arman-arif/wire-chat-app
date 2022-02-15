<div class="chat-message clearfix">
    <form enctype="multipart/form-data" wire:submit.prevent="sendMessage">
        <div class="input-group mb-0">
            <button class="btn btn-lg btn-dark"><i class="fas fa-paperclip"></i></button>
            <input type="file" name="attachment" id="attachment" hidden class="visibility-hidden">
            <input wire:model.debounce="message" name="message" id="message" class="form-control" placeholder="Type your message">
            <button class="btn btn-lg btn-primary"><i class="fas fa-paper-plane"></i></button>
        </div>
    </form>
</div>
