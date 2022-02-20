<div class="chat-header clearfix">
    <div class="row">
        <div class="col-lg-6">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                <img src="{{ asset('storage/' . $user['image']) }}" alt="avatar">
            </a>
            <div class="chat-about">
                <h6 class="m-b-0">{{ $user['name'] }}</h6>
                <small>
                    {{-- @if ($user['is_online']) --}}
                    @if (isOnline($user['id']))
                        <span class="text-success">Online</span>
                    @else
                        Last seen: {{ Carbon\Carbon::parse($user['last_active'])->diffForHumans() }}
                    @endif
                </small>
            </div>
        </div>
    </div>
</div>
