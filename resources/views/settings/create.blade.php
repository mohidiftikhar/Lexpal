<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Settings') }}
        </h2>
    </x-slot>
    <x-slot name="cardHeader">
        <div class="btn-group float-end" role="group" aria-label="Basic example">
            <a href="{!! route('admin.dashboard') !!}" class="btn btn-primary">Go Back</a>
        </div>
    </x-slot>
    <x-slot name="cardClass"></x-slot>
    <div class="form">
        @if(!empty(session('warning')))
            <div class="alert alert-warning mt-2 mb-2">{!! session('warning') !!}</div>
        @endif
            @if(!empty(session('success')))
                <div class="alert alert-success mt-2 mb-2" id="success-alert">{!! session('success') !!}</div>
            @endif
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form action="{!! route('settings.update') !!}" method="post" enctype="multipart/form-data" id="form">
            @csrf
            <h2>General Information</h2> <br>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" id="address" value="{{$setting->address??old('address')}}">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" value="{{$setting->phone??old('phone')}}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{$setting->email??old('email')}}">
            </div>
            <div class="form-group">
                <label for="fb_url">Facebook URL</label>
                <input type="url" class="form-control" name="fb_url" id="fb_url" value="{{$setting->fb_url??old('fb_url')}}">
            </div>
            <div class="form-group">
                <label for="instagram_url">Instagram URL</label>
                <input type="url" class="form-control" name="instagram_url" id="instagram_url" value="{{$setting->instagram_url??old('instagram_url')}}">
            </div>
            <div class="form-group">
                <label for="twitter_url">Twitter URL</label>
                <input type="url" class="form-control" name="twitter_url" id="twitter_url" value="{{$setting->twitter_url??old('twitter_url')}}">
            </div>
            <div class="form-group">
                <label for="linkedin_url">Linkedin URL</label>
                <input type="url" class="form-control" name="linkedin_url" id="linkedin_url" value="{{$setting->linkedin_url??old('linkedin_url')}}">
            </div>
            <div class="form-group">
                <label for="tik_tok_url">Tik Tok URL</label>
                <input type="url" class="form-control" name="tik_tok_url" id="tiktok_url" value="{{$setting->tik_tok_url??old('tik_tok_url')}}">
            </div>
            <h2>Login Section</h2> <br>
            <div class="form-group">
                <label for="login_heading">Heading</label>
                <input type="text" class="form-control" name="login_heading" id="login_heading" value="{{$setting->login_heading??old('login_heading')}}">
            </div>
            <div class="form-group">
                <label for="login_description">Description</label>
                <textarea name="login_description" placeholder="Description" id="login_description">{{$setting->login_description??old('login_description')}}</textarea>
            </div>
            <h2>Header Section</h2> <br>
            <div class="form-group">
                <label for="header_heading">Heading</label>
                <input type="text" class="form-control" name="header_heading" id="header_heading" value="{{$setting->header_heading??old('header_heading')}}">
            </div>
            <div class="form-group">
                <label for="header_description">Description</label>
                <textarea name="header_description" placeholder="Description" id="header_description">{{$setting->header_description??old('header_description')}}</textarea>
            </div>
            <h2>Get In Touch</h2><br>
            <div class="form-group">
                <label for="get_in_touch_description">Description</label>
                <textarea name="get_in_touch_description" placeholder="Description" id="get_in_touch_description">{{$setting->get_in_touch_description??old('get_in_touch_description')}}</textarea>
            </div>
            <h2>Contact Us</h2><br>
            <div class="form-group">
                <label for="contact_us_description">Description</label>
                <textarea name="contact_us_description" placeholder="Description" id="contact_us_description">{{$setting->contact_us_description??old('contact_us_description')}}</textarea>
            </div>
            <h2>Policy</h2><br>
            <div class="form-group">
                <label for="policy_heading">Policy Heading</label>
                <input type="text" class="form-control" name="policy_heading" id="policy_heading" value="{{$setting->policy_heading??old('policy_heading')}}">
            </div>
            <div class="form-group">
                <label for="policy_description">Description</label>
                <textarea name="policy_description" placeholder="Description" id="policy_description">{{$setting->policy_description??old('policy_description')}}</textarea>
            </div>
            <div class="form-group">
                <label for="policy">Our Policy</label>
                <textarea name="policy" placeholder="Our Policy" id="policy">{{$setting->policy??old('policy')}}</textarea>
            </div>
            <br>
            <button class="btn btn-primary upload_btn" type="submit">Save</button>
        </form>

    </div>

</x-app-layout>
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#header_description' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#get_in_touch_description' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#contact_us_description' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#policy' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#policy_description' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#login_description' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
<script>
    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
    });
</script>

