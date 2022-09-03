<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Page') }}
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
        <form action="{!! route('pages.store') !!}" method="post" enctype="multipart/form-data" id="form">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" placeholder="Enter page name" name="name" id="name" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="heading">Heading</label>
                <input type="text" class="form-control" placeholder="Enter page Heading" name="heading" id="heading" value="{{old('heading')}}">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" placeholder="Enter page content" id="editor">{{old('content')}}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Header:</label>
                <select name="header" id="" class="form-select">
                    <option value="active" selected>Enable</option>
                    <option value="deactive">Disable</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Footer:</label>
                <select name="footer" id="" class="form-select">
                    <option value="active" selected>Enable</option>
                    <option value="deactive">Disable</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Background:</label>
                <select name="bg" id="" class="form-select">
                    <option value="active" selected>Enable</option>
                    <option value="deactive">Disable</option>
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


