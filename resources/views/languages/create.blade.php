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
        <form action="{!! route('languages.store') !!}" method="post" id="form" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">From Language</label>
                <select name="lang_1" id="" class="form-select">
                    <option value="">Select a Language 1</option>
                    @foreach($langs as $row)
                        <option value="{!! $row->id !!}">{!! $row->lang_name !!}</option>
                    @endforeach
                </select>
               {{-- <input name="from" type="text" class="form-control">--}}
                @error('lang_1')
                <div class="text-danger m-1">{!! $message !!}</div>
                @enderror
            </div>
           {{-- <div class="mb-3">
                <label for="from_file" class="form-label">From  File</label>
                <input  name="from_file" class="form-control" type="file" id="from_file">
                @error('from_file')
                <div class="text-danger m-1">{!! $message !!}</div>
                @enderror
            </div>--}}
            <div class="mb-3">
                <label class="form-label">To Language</label>
                <select name="lang_2" id="" class="form-select">
                    <option value="">Select a Language 2</option>
                    @foreach($langs as $row)
                        <option value="{!! $row->id !!}">{!! $row->lang_name !!}</option>
                    @endforeach
                </select>
               {{-- <input name="to" type="text" class="form-control">--}}
                @error('lang_2')
                <div class="text-danger m-1">{!! $message !!}</div>
                @enderror
            </div><br>
          {{--  <div class="mb-3">
                <label for="to_file" class="form-label">To File</label>
                <input name="to_file" class="form-control" type="file" id="to_file">
                @error('to_file')
                <div class="text-danger m-1">{!! $message !!}</div>
                @enderror
            </div>--}}

            <button class="btn btn-primary upload_btn" type="submit">Save</button>
        </form>

    </div>
    <script>
        $(document).ready(function(){

        });
    </script>
</x-app-layout>
