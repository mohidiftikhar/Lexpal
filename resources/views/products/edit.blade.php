<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create License') }}
        </h2>
    </x-slot>
    <x-slot name="cardClass"></x-slot>
    <x-slot name="cardHeader">
        <div class="btn-group float-end" role="group" aria-label="Basic example">
            <a href="{!! route('products.index') !!}" class="btn btn-primary">All Products</a>
        </div>
    </x-slot>
    <div class="form">
        @if(!empty(session('warning')))
            <div class="alert alert-warning mt-2 mb-2">{!! session('warning') !!}</div>
        @endif
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form action="{!! route('products.update',$products->id) !!}" method="post" id="form" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{$products->name??old('name')}}"><br>
            </div>
                <div class="form-group">
                    <label class="form-label">Device</label>
                    <select name="type" id="" class="form-select">
                        <option value="web" @if($products->type == 'web') selected @endif>Web Browser</option>
                        <option value="android" @if($products->type == 'android') selected @endif>Android</option>
                        <option value="ios" @if($products->type == 'ios') selected @endif>IOS</option>
                        <option value="chrome" @if($products->type == 'chrome') selected @endif>Chrome Extension</option>
                    </select>
                </div>
                <br>
                <button class="btn btn-primary upload_btn" type="submit">Save</button>
            </form>

    </div>
    <script>
        $(document).ready(function(){

        });
    </script>
</x-app-layout>
