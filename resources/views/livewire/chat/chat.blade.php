@section('title', 'Chat')

@push('styles:after')
    <link rel="stylesheet" href="{{ asset(mix('css/chat.css')) }}">
@endpush


    <div class="card chat-app dark" style="height: 100vh !important; min-height: 500px">
        <div id="plist" class="people-list">
            <x-chat.search />
            <x-chat.contacts>
                @foreach ($users as $people)
                    <x-chat.people :user="$people" :active="$user"/>
                @endforeach
            </x-chat.contacts>
        </div>
        <div class="chat">
            <x-chat.topbar />
            <x-chat.history>
                @forelse ($messages as $messageDate)
                    <x-chat.message :message-data="$messageDate" />
                @empty
                    <p>No messages yet</p>
                @endforelse
            </x-chat.history>
            <x-chat.form :msgBody="$message" />
            {{-- :username="$username" :userid="$user_id"/> --}}
            {{ $user_id }}
        </div>
    </div>
</div>



@push('scripts')
    <script src="{{ asset(mix('js/chat.js')) }}" defer></script>
    {{-- <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
@endpush
