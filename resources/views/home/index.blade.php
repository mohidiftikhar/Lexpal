@extends('home.layouts.app')

@section('content')
    <div class="banner" style="background-image: url({{asset('images/banner-bg.jpg')}})">
            <div class="container">
                <div class="banner-box">
                    <h1>{{$setting->header_heading}}</h1>
                    <p>{!!$setting->header_description!!}</p>
                    <div class="search-box">
                        <div class="dropdown language-dropdown">
                            <a class="btn dropdown-toggle" type="button" id="languageMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                <img id="img_1" src="{{asset('uploads/images/from_1632919560.png')}}" alt="">-&nbsp;<img id="img_2" src="{{asset('uploads/images/to_1632919560.png')}}" alt="">
                            </a>
                            <ul class="dropdown-menu select-language" aria-labelledby="languageMenu">
                                @foreach($data as $item)
                                <li><a onclick="selectLanguages('{{json_encode($item)}}')"><img src="{{asset($item['languageFromUrl'])}}" alt=""> {{$item['languageFrom']}} <i class="fal fa-long-arrow-right"></i> <img src="{{asset($item['languageToUrl'])}}" alt=""> {{$item['languageTo']}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="dropdown translate-dropdown w-100">
                            <input type="search" placeholder="Add Text here" id="search_field" aria-expanded="false">
                            <input type="hidden"  id="languageId" value="1">
                            <input type="hidden"  id="languageType" value="0">
                            <input type="hidden"  id="languageFrom" value="Danish">
                            <input type="hidden"  id="languageTo" value="English">
                            <input type="hidden"  id="page" value="1">
                            <ul class="dropdown-menu translate-menu scroll-color search_result" aria-labelledby="translateMenu">

                            </ul>
                        </div>
                            @guest
                                <div class="count">{{$guest->tries ?? 5}}</div>
                            @endguest
                            <div class="dropdown translate-dropdown">
                                @guest
                                <button class="btn translate-btn" onclick="checkRemainingCount()" type="button" id="translateMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="icon-translate"></i>
                                </button>
                                @endguest
                                @auth
                                        <button class="btn translate-btn" onclick="getTranslation()" type="button" id="translateMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="icon-translate"></i>
                                        </button>
                                    @endauth
                            </div>
                    </div>
                </div>
            </div>
    </div>
    <main id="main">
        @foreach($navigations as $navigation)
            @if($navigation->url == '#Apps')
                @if($navigation->status == 'active')
        <section id="Apps" class="section apps">
            <div class="container">
                <div class="app-slider">
                @foreach($sliders as $slider)
                <div class="row d-flex m-0">
                    <div class="col-md-6 reveal top">
                        <div class="img-box app-img">

                            <img src="{{asset($slider['image'])}}" alt="" accept="image/*">
                        </div>
                    </div>
                    <div class="col-md-6 reveal right">
                        <h2>{{$slider['heading']}}</h2>
                        <p>{!! $slider['description'] !!}</p>
                            <div class="app-btn">
                                @foreach($sliderLink as $sliderApp)
                                    @if($slider['id'] == $sliderApp['slider_id'])
                                        @foreach($app as $appLink)
                                            @if($sliderApp['app_link_id']==$appLink['id'])
                                                <a href="{{$appLink['url']}}" class="btn" target="_blank">
                                                    <div class="icon-box">
                                                        <img src="{{asset($appLink['icon'])}}" alt="" accept="image/*">
                                                    </div>
                                                    <div class="btn-text">
                                                        <span class="font-10">{{$appLink['short_heading']}}</span>
                                                        <h6 class="text-white m-0">{{$appLink['heading']}}</h6>
                                                    </div>
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
        </section>
                @endif
                @endif
                    @endforeach

            @foreach($navigations as $navigation)
                @if($navigation->url == '#Price')
                    @if($navigation->status == 'active')
        <section id="Price" class="section section-contact price">
            <div class="container">
            <div class="center-slider">
                @foreach($plans as $plan)
                    @if($plan->status == 'active')
                    <div>
                        <div class="price-heading">
                            <h1>{{$plan->currency}}{{$plan->price}}</h1><br>
                            <span>{{$plan->plan_duration}} {{$plan->duration_period}}</span>
                        </div>

                        <div class="price-content">
                            <h3>{{$plan->name}}</h3>
                            {!! $plan->content !!}
                        </div>
                    </div>
                    @endif
                @endforeach
                </div>
            </div>
        </section>
                    @endif
                @endif
            @endforeach
        @foreach($navigations as $navigation)
            @if($navigation->url == '#FAQ')
                @if($navigation->status == 'active')
        <section id="FAQ" class="section bg-gray faq">
            <div class="container">
                <div class="faq-box">
                    <h2>Frequently Asked Questions</h2>
                    <p>Need help? Here are the top questions asked by our Subscribers</p>
                    <ul class="accordion">
                        @foreach($questions as $question)
                        <li>
                            <a class="opener" href="#">{!! ($question['question']) !!}</a>
                            <div class="slide">
                                <p>{!! ($question['answer']) !!}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
                @endif
            @endif
        @endforeach

            @foreach($navigations as $navigation)
                @if($navigation->url == '#Support')
                    @if($navigation->status == 'active')
        <section id="Support" class="section section-contact">
            <div class="container">
                <div class="contact-row">
                    <div class="col">
                        <div class="contact-box">
                            <h2>Get in Touch</h2>
                            <p>{!!$setting->get_in_touch_description!!}</p>
                            <ul class="contact-list vertical">
                                <li>
                                    <span class="text-primary font-14">Address</span>
                                    <span class="font-14">{!!$setting->address!!}</span>
                                </li>
                                <li>
                                    <span class="text-primary font-14">Phones:</span>
                                    <a href="">{!!$setting->phone!!}</a>
                                </li>
                                <li>
                                    <span class="text-primary font-14">Email:</span>
                                    <a href="">{!!$setting->email!!}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-box">
                            <div class="text-box">
                                <h2>Contact Us</h2>
                                <p>{!!$setting->contact_us_description!!}</p>
                            </div>
                            <form id="form">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name" name="name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" name="email">
                                </div>
                                <div class="form-group">
                                    <textarea name="description" placeholder="Description"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn w-100">Send an Inquiry</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
                    @endif
                    @endif
                        @endforeach

            @foreach($navigations as $navigation)
                @if($navigation->url == '#OurPolicy')
                    @if($navigation->status == 'active')
        <section id="OurPolicy" class="section policy">
            <div class="container">
                <div class="policy-box">
                    <div class="col">
                        <h2>{!!$setting->policy_heading!!}</h2>
                        <p>{!!$setting->policy_description!!}</p>
                    </div>
                    <div class="col text-end" style="background-image: url({{asset('images/circle-lines.png')}})">
                        <a href="{{route('policy')}}" class="btn white">See Our Policy</a>
                    </div>
                </div>
            </div>
        </section>
                    @endif
                    @endif
                        @endforeach
    </main>
@endsection
@section('footer')
    @include('home.common.footer')
@endsection



