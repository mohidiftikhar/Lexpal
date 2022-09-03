<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>
    <x-slot name="cardClass"></x-slot>

    <x-slot name="cardHeader">
        Edit Profile
    </x-slot>

    <div class="form">
        @if(!empty(session('danger')))
            <div class="alert alert-danger mt-2 mb-2">{!! session('danger') !!}</div>
        @endif
        @if(!empty(session('success')))
            <div class="alert alert-success mt-2 mb-2" id="success-alert">{!! session('success') !!}</div>
        @endif

        <form action="{!! route('auth.profile.store') !!}" method="post" enctype="multipart/form-data" id="form">
            @csrf
            <div class="mb-3">
                <img src="{{asset($user->images)}}" style="height: 100px; width: 150px"><br>
                <label class="form-label">Image</label>
                <input type="file" class="form-control" name="image" id="from_file">
                @error('image')
                <div class="text-danger m-1">{!! $message !!}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input name="name" type="text" class="form-control" value="{!! auth()->user()->name !!}">
                @error('name')
                <div class="text-danger m-1">{!! $message !!}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="text" class="form-control" value="{!! auth()->user()->email !!}">
                @error('email')
                <div class="text-danger m-1">{!! $message !!}</div>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-secondary">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
<script>
    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
    });
</script>
