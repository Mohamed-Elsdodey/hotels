<meta charset="utf-8" />
<title>@yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesbrand" name="author" />
<!-- App favicon -->
<link rel="shortcut icon" href="{{get_file($settings->fave_icon)}}">

<!-- Layout config Js -->
<script src="{{url('assets')}}/dashboard/js/layout.js"></script>
<!-- Bootstrap Css -->
<link href="{{url('assets')}}/dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{url('assets')}}/dashboard/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{url('assets')}}/dashboard/css/app.min.css" rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href="{{url('assets')}}/dashboard/css/custom.min.css" rel="stylesheet" type="text/css" />
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css" />

{{--include loader css--}}
@include('layouts.loader.loaderCss')
{{-- end include loader css--}}
