<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Change Password') }}
        </h2>
    </x-slot>
    <x-slot name="cardClass"></x-slot>

    <x-slot name="cardHeader">
        Change Password
    </x-slot>

    <div class="form">
        @if(!empty(session('danger')))
            <div class="alert alert-danger mt-2 mb-2">{!! session('danger') !!}</div>
        @endif
        @if(!empty(session('success')))
            <div class="alert alert-success mt-2 mb-2">{!! session('success') !!}</div>
        @endif

        <form action="{!! route('auth.change-password.store') !!}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Old Password</label>
                <input name="old_password" type="password" class="form-control">
                @error('old_password')
                <div class="text-danger m-1">{!! $message !!}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">New Password</label>
                <input name="password" type="password" class="form-control">
                @error('password')
                <div class="text-danger m-1">{!! $message !!}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input name="password_confirmation" type="password" class="form-control">
                @error('password_confirmation')
                <div class="text-danger m-1">{!! $message !!}</div>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-secondary">Change Password</button>
            </div>
        </form>
    </div>
</x-app-layout>
