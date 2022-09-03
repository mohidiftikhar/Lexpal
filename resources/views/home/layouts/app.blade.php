@php
    $navigations = \App\Models\NavigationBar::all();
@endphp
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}">
    <title>Lexpal</title>
{{--    <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="498fb50f-205a-4504-a769-a96181e62733" data-blockingmode="auto" type="text/javascript"></script>    <link rel="preconnect" href="https://fonts.googleapis.com">--}}
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
{{--
    <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="581e35d6-4485-4755-8d0e-abaea03bd309" data-blockingmode="auto" type="text/javascript"></script>
--}}
{{--    <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="581e35d6-4485-4755-8d0e-abaea03bd309" data-blockingmode="auto" type="text/javascript"></script>--}}
{{--    <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="581e35d6-4485-4755-8d0e-abaea03bd309" data-blockingmode="auto" type="text/javascript"></script>--}}
    @notifyCss
    <link media="all" rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}" />

    <style>
        .notify{
            z-index: 99999 !important;
        }
        .notify button{
            background: transparent !important;
            height: auto !important;
            line-height: 20px !important;
            border: none !important;
        }
    </style>
</head>

<body>
{{--@include('cookieConsent::index')--}}
<div id="wrapper">
    <x:notify-messages />
    @include('home.common.header')
    @yield('content')
    @include('home.popups.login')
{{--    <script id="CookieDeclaration" src="https://consent.cookiebot.com/498fb50f-205a-4504-a769-a96181e62733/cd.js" type="text/javascript" async></script>--}}
    @yield('footer')
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('js/slick.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script>
    window.addEventListener('scroll',reveal);

    function reveal(){
        var reveal = document.querySelectorAll('.reveal');

        for(var i=0; i< reveal.length; i++){
            var windowheight = window.innerHeight;
            var revealtop = reveal[i].getBoundingClientRect().top;
            var revealpoint =150;

            if(revealtop< windowheight - revealpoint){
                reveal[i].classList.add('active');
            }
            else{
                reveal[i].classList.remove('active');
            }
        }
    }
</script>

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<script>
    $(document).click(function(e) {
        if (!$(e.target).is(".search_result")) {
            if ($('.search_result').is(':visible')) {
                $('.search_result').removeClass('show');
            }
        }
    });
    function copyToClipboard(text) {
        var sampleTextarea = document.createElement("textarea");
        document.body.appendChild(sampleTextarea);
        sampleTextarea.value = text; //save main text in it
        sampleTextarea.select(); //select textarea contenrs
        document.execCommand("copy");
        document.body.removeChild(sampleTextarea);

        toastr.success('Copied Successfully!');

    }
    function checkRemainingCount() {
        jQuery.ajax({
            url: '{{route('check-count')}}',
            data: {},
            type: 'GET',
            success:function (result){

                if(result.tries === true){
                    getTranslation();
                    $('.count').text(result.remaining_tries);
                }else{
                    toastr.error("Your free tries ended, login to continue!");
                }
            },
            error:function (error) {
                console.log(error);

                toastr.error(JSON.parse(error.responseText).message);
            }
        })

    }
    function getTranslation() {

        var languageFrom = $('#languageFrom').val();
        var languageTo = $('#languageTo').val();
        var search = $('#search_field').val();
        if(search !== '' && search !== undefined) {

            jQuery.ajax({
                url: 'https://nlp.lexpal.dk/api/translate',
                data: {
                    source: languageFrom,
                    target: languageTo,
                    input: search,
                },
                type: 'GET',
                success: function (result) {
                    $('.search_result').html('');
                    if(result.data) {
                        var html = '';
                        html += '<li><a><div class="float-start">';
                        html += '<span>' + result.data + '</span>';
                        html += '<span class="text-primary">' + result.data + '</span>';
                        html += '</div>';
                        html += '<div class="float-end">';
                        html += '<a class="copy" onclick="copyToClipboard(`' + result.data + '`)"><i class="icon-copy"></i> </a>';
                        html += '</div> </a> </li>';
                    }else{
                        html += '<center><b>No Record Found</b></center>';
                    }

                    $('.search_result').append(html);


                    $('#page').val();
                    $('.search_result').collapse('show');

                },
                error: function (error) {
                    console.log(error);
                    $('.search_result').html('');
                    $('.search_result').removeClass('show');
                    toastr.error(JSON.parse(error.responseText).message);
                }
            })
        }else{
            toastr.error("Type something to translate");
        }

    }
    function selectLanguages(item) {
        item =  JSON.parse(item);
         $('#languageId').val(item.languageId);
         $('#languageType').val(item.newKey);
         $('#languageFrom').val(item.languageFrom);
         $('#languageTo').val(item.languageTo);
         $('#search_field').val('');
         $('#img_1').attr('src',item.languageFromUrl)
         $('#img_2').attr('src',item.languageToUrl)
    }

    function showDetail(ids) {
        search_field.style.display = 'block'
        search_field.focus();
        var languageId = $('#languageId').val();
        var languageType = $('#languageType').val();
        var page = $('#page').val();

        jQuery.ajax({
            url: '{{route('search-language')}}',
            data: {
                languageId:languageId,
                languageType:languageType,
                ids:ids,
                page:page,
                tries:false
            },
            type: 'GET',
            success:function (result){
                $('.search_result').html('');

                if(result.data.length > 0) {
                    $.each(result.data, function (key, value) {
                        var html = '';
                        html += '<li><a><div class="float-start">';
                        html += '<span class="fw-bold">' + value.inflactedform  + '</span>';
                        html += '<span class="font-10">' +  value.pos  + '</span>';
                        html += '<span class="font-14 fst-italic text-gray">' +  value.l1_sentence + '</span>';
                        // html += '<span>' + (languageType ===0) ? value.inflactedform : value.inflactedform_1 + '</span><br>';
                        // html += '<span class="text-primary">' + (languageType ===0) ? value.inflactedform_1 : value.inflactedform + '</span>';
                        html += '</div>';
                        html += '<div class="float-end">';
                        html += '<span class="fw-bold text-primary">' + value.inflactedform_1+ '</span>';
                        html += '<span class="font-10">' + value.pos_1 + '</span>';
                        html += '<span class="font-14 fst-italic text-gray">' +  value.l2_sentence  + '</span>';
                        // html += '<span class="text-capitalize text-gray">' + (languageType ===0) ? value.pos : value.pos_1 + '</span>';
                        // html += '<span class="text-capitalize text-gray">' + (languageType ===0) ? value.l1_sentence : value.l2_sentence + '</span>';
                        html += '</div> </a> </li>';

                        $('.search_result').append(html);

                    });
                    $('.search_result').collapse('show');

                }else{
                    getTranslation();
                }


            },
            error:function (error) {
                console.log(error);
                $('.search_result').html('');
                $('.search_result').removeClass('show');
                toastr.error(JSON.parse(error.responseText).message);
            }
        })



    }
    var timer = null;

    $('#search_field').on('keyup',function(){

        clearTimeout(timer);
        timer = setTimeout(getResults, 1000)
    });

    function getResults() {
        var search = $('#search_field').val();
        var languageId = $('#languageId').val();
        var languageType = $('#languageType').val();
        var page = $('#page').val();

        jQuery.ajax({
            url: '{{route('search-language')}}',
            data: {
                languageId:languageId,
                languageType:languageType,
                search:search,
                page:page,
                tries:true

            },
            type: 'GET',
            success:function (result){
                $('.search_result').html('');
                if(result.tries === true){
                    $('.count').text(result.remaining_tries);
                }

                if(result.data.length > 0 && result.remaining_tries >0) {
                    $.each(result.data, function (key, value) {
                        var html = '';
                        html += '<li><a onclick="showDetail(`' + value.ids + '`)"><div class="float-start">';
                        html += '<span>' + value.inflactedform + '</span>';
                        html += '<span class="text-primary">' + value.inflactedform_1 + '</span>';
                        html += '</div>';
                        html += '<div class="float-end">';
                        html += '<span class="text-capitalize text-gray">' + value.pos_1 + '</span>';
                        html += '</div> </a> </li>';

                        $('.search_result').append(html);

                    });
                    $('.search_result').collapse('show');

                }else{
                    getTranslation();
                }


            },
            error:function (error) {
                console.log(error);
                $('.search_result').html('');
                $('.search_result').removeClass('show');
                toastr.error(JSON.parse(error.responseText).message);
            }
        })

    }
    jQuery('#form').submit(function (e){
        e.preventDefault();
        jQuery.ajax({
            url: '{!! route('contact') !!}',
            data: jQuery('#form').serialize(),
            type: 'post',
            success:function (result){
                alert('Email sent')
                },
            error:function (error) {
                alert('Email not sent')
            }
        })
    })
</script>
<script type="text/javascript" src="{{asset('js/main.js')}}"></script>
@notifyJs
</body>

</html>

