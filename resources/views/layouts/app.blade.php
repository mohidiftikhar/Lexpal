<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head><base href="">
    <title>Lexpal</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{asset('plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{asset('plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.ckeditor.com/4.19.0/standard-all/ckeditor.js"></script>

    <!--end::Global Stylesheets Bundle-->

</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
@include('layouts.aside')
@include('layouts.navigation1')
<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
<!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
    <!-- Page Content -->
    <main id="main" class="mt-5">
        <div class="container-fluid">
            <div class="card {{$cardClass??''}}">
                @if(!empty($cardHeader))
                    <div class="card-header">
                        {{$cardHeader??'' }}
                    </div>
                @endif
                <div class="card-body">
                    {{ $slot }}
                </div>
                @if(!empty($cardFooter))
                    <div class="card-footer">
                        {{$cardFooter??''}}
                    </div>
                @endif
            </div>
        </div>
        <div class="modal" id="default_modal" tabindex="-1"  data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">

                </div>
            </div>
        </div>
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="Notification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Bootstrap</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body"></div>
            </div>
        </div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{asset('plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{asset('plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{asset('js/widgets.bundle.js')}}"></script>
<script src="{{asset('js/custom/widgets.js')}}"></script>
<script src="{{asset('js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('js/custom/utilities/modals/create-app.js')}}"></script>
<script src="{{asset('js/custom/utilities/modals/users-search.js')}}"></script>
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
