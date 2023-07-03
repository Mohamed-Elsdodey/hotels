<meta charset="utf-8" />
<title>{{setting()->app_name}} -@yield('title') </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesbrand" name="author" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- App favicon -->
<link rel="shortcut icon" href="{{get_file($settings->fave_icon)}}">

<!-- jsvectormap css -->
{{--<link href="{{url('assets')}}/dashboard/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />--}}

<!--Swiper slider css-->
{{--<link href="{{url('assets')}}/dashboard/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />--}}

<!-- Layout config Js -->
<script src="{{url('assets')}}/dashboard/js/layout.js"></script>
<!-- Bootstrap Css -->
@if(app()->getLocale()=='ar')
    <link href="{{url('assets')}}/dashboard/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />

@else
    <link href="{{url('assets')}}/dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

@endif
<!-- Icons Css -->
<link href="{{url('assets')}}/dashboard/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
@if(app()->getLocale()=='ar')

<link href="{{url('assets')}}/dashboard/css/app-rtl.min.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets')}}/dashboard/css/custom-rtl.min.css" rel="stylesheet" type="text/css" />

@else

    <link href="{{url('assets')}}/dashboard/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('assets')}}/dashboard/css/custom.min.css" rel="stylesheet" type="text/css" />

@endif

<!-- custom Css-->
<link href="{{url('assets')}}/dashboard/css/jquery.fancybox.min.css" rel="stylesheet" type="text/css" />

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .nav-link{
        position: relative;
    }
    .newAlert{
        position: absolute;
        display: none;
        right: 20px;
        top: 10px;
        height: 10px;
        min-width:10px;
        background-color:#E5AD4C;
        border-radius: 100px;
        /*display: inline-block;*/
        transition: all .3s ease-in-out;
        box-shadow: 0px 0px 0px 10px #E5AD4C70;
        animation: mohamedGamal infinite 1s;
    }
    .newAlertLeft{
        position: absolute;
        display: none;
        left: 20px;
        top: 10px;
        height: 10px;
        min-width:10px;
        background-color: #E5AD4C;
        border-radius: 100px;
        /*display: inline-block;*/
        transition: all .3s ease-in-out;
        box-shadow: 0px 0px 0px 10px #E5AD4C70;
        animation: mohamedGamal infinite 1s;
    }
    .newAlertDiv{
        position: relative;
    }
    .newAlertDiv .newAlert{
        top: 30px;

    }
    @keyframes mohamedGamal {
        0% {
            box-shadow: 0px 0px 0px 0px #E5AD4C70;
        }
        50%{
            box-shadow: 0px 0px 0px 10px #E5AD4C70;
        }
        100%{
            box-shadow: 0px 0px 0px 0px #E5AD4C70;
        }
    }
     .red-star {
         color: red;
     }
</style>

@yield('css')
{{--include loader css--}}
@include('layouts.loader.loaderCss')
{{-- end include loader css--}}
