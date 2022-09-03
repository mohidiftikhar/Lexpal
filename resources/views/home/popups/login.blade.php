<div class="modal login fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-md">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fal icon-cross-circle"></i></button>
            <div class="modal-body">
                <h1>{{$setting->login_heading}}</h1>
                <p>{!! $setting->login_description !!}</p>
                <div class="btn-group">
                    <a href="{{url('/auth/redirect/google')}}" class="btn">
                        <div class="icon-box">
                            <img src="{{asset('images/google.svg')}}" alt="">
                        </div>
                        Sign in with Google
                        </a>
                    <a href="{{url('/auth/redirect/azure')}}" class="btn">
                        <div class="icon-box">
                            <img src="{{asset('images/microsoft.svg')}}" alt="">
                        </div>
                        Sign in with Microsoft
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
