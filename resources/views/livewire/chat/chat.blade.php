@section('title', 'Chat')

@push('styles:after')
    <link rel="stylesheet" href="{{ asset(mix('css/chat.css')) }}">
@endpush

<div class="card chat-app dark" style="height: 100vh !important; min-height: 500px">
    <div id="plist" class="people-list">
        <x-chat.search />
        <x-chat.contacts>
            @forelse ($users as $people)
                <x-chat.people :user="$people" :active="$user" :wire:key="$user['id']" />
            @empty
                <p>No contact found for chat</p>
            @endforelse
        </x-chat.contacts>
    </div>
    <div class="chat">
        <x-chat.topbar :user="$user" />
        <x-chat.history>
            @if ($user['id'] != 0)
                @forelse ($messages as $messageData)
                    <x-chat.message :message-data="$messageData" :wire:key="$messageData['id']" />
                @empty
                    <p class="text-center text-muted mt-5">No messages yet</p>
                @endforelse
            @else
                <p class="text-center text-muted mt-5">Select a contact to start the chat</p>
            @endif
        </x-chat.history>
        <livewire:chat.composer :message="$message" />
    </div>
</div>



@push('scripts')
    <script defer>
        const authId = @js($authId);
    </script>
    <script src="{{ asset(mix('js/chat.js')) }}" defer></script>
@endpush
