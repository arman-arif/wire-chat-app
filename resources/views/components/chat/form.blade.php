<div class="chat-message clearfix">
    <form enctype="multipart/form-data" wire:submit.prevent="sendMessage">
        <div class="input-group mb-0">
            <button class="btn btn-lg btn-dark" id="uploadAttachment"><i class="fas fa-paperclip"></i></button>
            <input type="file" id="attachment" hidden class="totally-hidden">
            {{-- <input type="hidden" wire:model='user_id' value="{{ $userid }}">
            <input type="hidden" wire:model='username' value="{{ $username }}"> --}}
            <input wire:model.debounce="message" id="message" class="form-control" placeholder="Type your message">
            @error('message') <span class="error">{{ $message }}</span> @enderror
            @if ($msgBody != "")
                <button type="submit" class="btn btn-lg btn-primary"><i class="fas fa-paper-plane"></i></button>
            @else
                <button type="submit" class="btn btn-lg btn-secondary disabled" disabled><i class="fas fa-paper-plane"></i></button>
            @endif
        </div>
    </form>
</div>
