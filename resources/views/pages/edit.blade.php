<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Page') }}
        </h2>
    </x-slot>
    <x-slot name="cardClass"></x-slot>
    <x-slot name="cardHeader">
        <div class="btn-group float-end" role="group" aria-label="Basic example">
            <a href="{!! route('pages.index') !!}" class="btn btn-primary">All Pages</a>
        </div>
    </x-slot>
    <div class="form">
        @if(!empty(session('warning')))
            <div class="alert alert-warning mt-2 mb-2">{!! session('warning') !!}</div>
        @endif
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form action="{!! route('pages.update',$page->id) !!}" method="post" enctype="multipart/form-data" id="form">
            @csrf
            <input type="hidden" class="form-control" name="id" id="id" value="{{$page->id}}">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" placeholder="Enter page name" name="name" id="name" value="{{$page->name??old('name')}}">
            </div>
            <div class="form-group">
                <label for="heading">Heading</label>
                <input type="text" class="form-control" placeholder="Enter page Heading" name="heading" id="heading" value="{{$page->heading??old('heading')}}">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" placeholder="Enter page content" id="editor">{!! $page->content ??old('content') !!}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Header:</label>
                <select name="header" class="form-select">
                    <option value="active" @if($page->header == 'active') selected @endif>Enable</option>
                    <option value="deactive" @if($page->header == 'deactive') selected @endif>Disable</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Footer:</label>
                <select name="footer" class="form-select">
                    <option value="active" @if($page->footer == 'active') selected @endif>Enable</option>
                    <option value="deactive" @if($page->footer == 'deactive') selected @endif>Disable</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Background:</label>
                <select name="bg" class="form-select">
                    <option value="active" @if($page->bg == 'active') selected @endif>Enable</option>
                    <option value="deactive" @if($page->bg == 'deactive') selected @endif>Disable</option>
                </select>
            </div>
            <br>
            <button class="btn btn-primary upload_btn" type="submit">Save</button>
        </form>

    </div>

</x-app-layout>
<script>
    CKEDITOR.replace('editor', {
        filebrowserUploadUrl: '{{route('ckeditor.upload',['_token' => csrf_token()])}}',
        filebrowserUploadMethod: 'form',
        removeButtons: 'PasteFromWord'
    });
</script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>


