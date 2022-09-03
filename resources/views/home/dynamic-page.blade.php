@extends('home.layouts.app')
        @foreach($pages as $page )
            @section('content')
                @if($page->header == 'deactive')
            <script>
                document.getElementById('header').style.display = 'none';
            </script>
        @endif

        <main id="main">
            <section class="section bg-sky-blue vh-100">
                <div class="container">
                    <div @if($page->bg == 'active') class="policy-box1" @endif>
                        <p class="mb-3">
                            {!! $page->content !!}
                        </p>
                    </div>
                </div>
            </section>
        </main>
            @endsection
            @section('footer')
                @if($page->footer == 'active')
                    @include('home.common.footer')
                @endif
            @endsection
        @endforeach
