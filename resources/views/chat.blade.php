@extends('layouts.app')

@push('styles:before')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @isset($activeId)
                    <livewire:chat.chat :activeId="$activeId" />
                @else
                    <livewire:chat.chat :activeId="0" />
                @endisset
            </div>
        </div>
    @endsection

    @push('scripts:before')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
