<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create NavigationBar') }}
        </h2>
    </x-slot>
    <x-slot name="cardClass"></x-slot>
    <x-slot name="cardHeader">
        <div class="btn-group float-end" role="group" aria-label="Basic example">
            <a href="{!! route('navigation.index') !!}" class="btn btn-primary">All Navigation</a>
        </div>
    </x-slot>
    <div class="form">
        @if(!empty(session('warning')))
            <div class="alert alert-warning mt-2 mb-2">{!! session('warning') !!}</div>
        @endif
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form action="{!! route('navigation.store') !!}" method="post" id="form" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{old('name')}}"><br>
            </div>
            <div class="form-group">
                <label for="url">URL</label>
                <input type="text" class="form-control" name="url" id="url" placeholder="Enter url" value="{{old('url')}}"><br>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" id="" class="form-select">
                    <option value="active" selected>Active</option>
                    <option value="deactive">In Active</option>
                </select>
            </div>
            <br>
            <button class="btn btn-primary upload_btn" type="submit">Save</button>
        </form>

    </div>
</x-app-layout>
