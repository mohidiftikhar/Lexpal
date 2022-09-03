<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Question') }}
        </h2>
    </x-slot>
    <x-slot name="cardClass"></x-slot>
    <x-slot name="cardHeader">
        <div class="btn-group float-end" role="group" aria-label="Basic example">
            <a href="{!! route('question.index') !!}" class="btn btn-primary">All Questions</a>
        </div>
    </x-slot>
    <div class="form">
        @if(!empty(session('warning')))
            <div class="alert alert-warning mt-2 mb-2">{!! session('warning') !!}</div>
        @endif
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form action="{!! route('question.store') !!}" method="post" enctype="multipart/form-data" id="form">
            @csrf
            <div class="form-group">
                <label for="question">Question</label>
                <textarea name="question" placeholder="Question" id="QuestionEditor">{{old('question')}}</textarea>
            </div>
            <div class="form-group">
                <label for="answer">Answer</label>
                <textarea name="answer" placeholder="Answer" id="editor" >{{old('answer')}}</textarea>
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
    ClassicEditor
        .create( document.querySelector( '#QuestionEditor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>



