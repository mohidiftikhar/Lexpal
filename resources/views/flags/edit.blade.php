<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Language') }}
        </h2>
    </x-slot>
    <x-slot name="cardClass"></x-slot>
    <x-slot name="cardHeader">
        <div class="btn-group float-end" role="group" aria-label="Basic example">
            <a href="{!! route('languages.index') !!}" class="btn btn-primary">All Languages</a>
        </div>
    </x-slot>
    <div class="form">
        @if(!empty(session('warning')))
            <div class="alert alert-warning mt-2 mb-2">{!! session('warning') !!}</div>
        @endif
        <form action="{!! route('flags.update',$lang_flag->id) !!}" method="post" id="form" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Language Name</label>
                <input name="lang_name" type="text" class="form-control" value="{!! $lang_flag->lang_name !!}">
                @error('lang_name')
                <div class="text-danger m-1">{!! $message !!}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="from_file" class="form-label">From  File</label>
                <input  name="image_url" class="form-control" type="file" id="from_file">
                <img style="width: 40px" src="{!! url($lang_flag->image_url) !!}" alt="">
                @error('image_url')
                <div class="text-danger m-1">{!! $message !!}</div>
                @enderror
            </div>

            <button class="btn btn-primary upload_btn" type="submit">Update</button>
        </form>

    </div>
    <script>
        $(document).ready(function(){

        });
    </script>
</x-app-layout>
