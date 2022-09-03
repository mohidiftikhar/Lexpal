@php
    $navigations = \App\Models\NavigationBar::all();
@endphp
<footer id="footer">
    <div class="container footer">
        <ul class="social-links">
            <li><a href="{!!$setting->linkedin_url!!}" target="_blank"><i class="icon-linkdin"></i></a></li>
            <li><a href="{!!$setting->twitter_url!!}" target="_blank"><i class="icon-twitter"></i></a></li>
            <li><a href="{!!$setting->fb_url!!}" target="_blank"><i class="icon-facebook"></i></a></li>
            <li><a href="{!!$setting->instagram_url!!}"target="_blank"><i class="icon-instagram"></i></a></li>
            <li><a href="{!!$setting->tik_tok_url!!}"target="_blank"><i class="fa-brands fa-tiktok"></i></a></li>
        </ul>
        <div class="copyright">©@php echo date('Y') @endphp Lexpal.com</div>
        <nav id="nav">
            <ul>
                <li><a href="/">Home</a></li>
                @foreach($navigations as $navigation)
                    @if($navigation->status == 'active')
                        @if($navigation->url == '#Apps')
                            <li><a href="{!! $navigation->url !!}">{!! $navigation->name !!}</a></li>
                        @elseif($navigation->url == '#FAQ')
                            <li><a href="{!! $navigation->url !!}">{!! $navigation->name !!}</a></li>
                        @elseif($navigation->url == '#Support')
                            <li><a href="{!! $navigation->url !!}">{!! $navigation->name !!}</a></li>
                        @elseif($navigation->url == '#Price')
                            <li><a href="{!! $navigation->url !!}">{!! $navigation->name !!}</a></li>
                        @elseif($navigation->url == '#OurPolicy')
                            <li><a href="{!! $navigation->url !!}">{!! $navigation->name !!}</a></li>
                        @else
                            <li><a href="{!!route('slug',$navigation->url)!!}">{!! $navigation->name !!}</a></li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>
</footer>
