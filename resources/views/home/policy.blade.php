@extends('home.layouts.app')

@section('content')
    <main id="main">
        <section class="section bg-sky-blue vh-100">
            <div class="container">
                <div class="policy-box1">
                    <h2 class="text-center">Our Policy</h2>
                    <hr>
                    <p class="mb-3">
                        {!! $setting->policy !!}
                    </p>
                </div>
            </div>
        </section>
    </main>

@endsection
@section('footer')
    @include('home.common.footer')
@endsection
