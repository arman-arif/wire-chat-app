@section('title', 'Chat')

@push('styles:before')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css" rel="stylesheet" />
@endpush
@push('styles:after')
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card chat-app">
                <div id="plist" class="people-list">
                    <x-chat.search />
                    <x-chat.contacts />
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
                    <x-chat.form />
                </div>
            </div>
        </div>
    </div>
</div>
