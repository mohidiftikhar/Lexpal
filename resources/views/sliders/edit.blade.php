<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Slider') }}
        </h2>
    </x-slot>
    <x-slot name="cardClass"></x-slot>
    <x-slot name="cardHeader">
        <div class="btn-group float-end" role="group" aria-label="Basic example">
            <a href="{!! route('sliders.index') !!}" class="btn btn-primary">All Sliders</a>
        </div>
    </x-slot>
    <div class="form">
        @if(!empty(session('warning')))
            <div class="alert alert-warning mt-2 mb-2">{!! session('warning') !!}</div>
        @endif
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form action="{!! route('sliders.update',$slider->id) !!}" method="post" enctype="multipart/form-data" id="form">
            @csrf
            <div class="form-group">
                <img src="{!! asset($slider->image) !!}" style="height: 150px;width: 200px"><br>
                <label for="from_file">Select Image</label>
                <input type="file" class="form-control" name="image" id="from_file">
                <small class="form-text text-muted">Image size must be 460 X 630</small>
            </div>
            <div class="form-group">
                <label for="heading">Heading</label>
                <input type="text" class="form-control" name="heading" id="heading" value="{{$slider->heading??old('heading')}}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" placeholder="Description" id="editor">{{$slider->description??old('description')}}</textarea>
            </div>
            <div class="form-group">
                <label for="app_links">App Links</label>
                <select name="app_link_id[]" id="app_links" class="form-select js-example-basic-multiple" multiple="multiple" >
                @foreach($app as $row)
                        <option value="{!! $row->id !!}"
                                @foreach($app_links as $app_link )
                                    @if($row->id == $app_link->app_link_id)
                                        selected="selected"
                                    @endif
                                @endforeach>
                            {!! $row->heading !!}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <button class="btn btn-primary upload_btn" type="submit">Save</button>
        </form>

    </div>

</x-app-layout>
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>


