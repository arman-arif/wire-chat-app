<li class="clearfix {{ $is_active }}">
    <img src="{{ $image_url  }}" alt="avatar">
    <div class="about">
        <div class="name">{{ $full_name }}</div>
        <div class="status">
            <i class="fa fa-circle {{ $is_online }}"></i> {{ $active_status }}
        </div>
    </div>
</li>
