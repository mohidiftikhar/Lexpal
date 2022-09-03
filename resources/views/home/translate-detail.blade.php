@extends('home.layouts.app')

@section('content')
    <main id="main">
        <section class="section bg-sky-blue translate-section">
            <div class="container">
                <div class="search-box">
                    <div class="dropdown language-dropdown">
                        <button class="btn dropdown-toggle" type="button" id="languageMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{asset('images/england.svg')}}" alt="">
                        </button>
                        <ul class="dropdown-menu select-language" aria-labelledby="languageMenu">
                            @foreach($data as $item)
                                <li><a href="#"><img src="{{asset($item['languageFromUrl'])}}" alt=""> {{$item['languageFrom']}} to {{$item['languageTo']}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="dropdown translate-dropdown w-100">
                        <input type="search" placeholder="Add Text here" id="translateMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        <ul class="dropdown-menu translate-menu show" aria-labelledby="translateMenu">
                            <li>
                                <div class="float-start">
                                    <span>habit</span>
                                    <span class="text-primary">substantiv</span>
                                    <span class="text-capitalize text-gray">Example senetnce here</span>
                                </div>
                                <div class="float-end d-flex flex-column">
                                    <span>habit</span>
                                    <span class="text-primary">substantiv</span>
                                    <span class="text-capitalize text-gray">Example senetnce here</span>
                                </div>
                            </li>
                            <li> habit is the main</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
