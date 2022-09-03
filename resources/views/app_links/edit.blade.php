<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create App Link') }}
        </h2>
    </x-slot>
    <x-slot name="cardClass"></x-slot>
    <x-slot name="cardHeader">
        <div class="btn-group float-end" role="group" aria-label="Basic example">
            <a href="{!! route('app_links.index') !!}" class="btn btn-primary">All App Links</a>
        </div>
    </x-slot>
    <div class="form">
        @if(!empty(session('warning')))
            <div class="alert alert-warning mt-2 mb-2">{!! session('warning') !!}</div>
        @endif
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form action="{!! route('app_links.update',$record->id) !!}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <img src="{!! asset($record->icon) !!}" style="height: 150px;width: 200px"><br>
                <label for="icon">Select Icon</label>
                <input type="file" class="form-control" name="icon" id="icon">
                <small class="form-text text-muted">Image size must be 42 X 42</small>
            </div>
            <div class="form-group">
                <label for="short_heading">Short Heading</label>
                <input type="text" class="form-control" name="short_heading" id="short_heading" value="{!! $record->short_heading !!}">
            </div>
            <div class="form-group">
                <label for="heading">Short Heading</label>
                <input type="text" class="form-control" name="heading" id="heading" value="{!! $record->heading !!}">
            </div>
            <div class="form-group">
                <label for="url">URL</label>
                <input type="text" class="form-control" name="url" id="url" value="{!! $record->url !!}">
            </div>
            <br>
            <button class="btn btn-primary upload_btn" type="submit">Save</button>
        </form>

    </div>

</x-app-layout>
