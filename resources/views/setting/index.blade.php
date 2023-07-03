<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ADHMN </title>
    <link rel="icon" type="image/x-icon" href="{{get_file($settings->favicon)}}">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="{{asset('landingPage')}}/css/style.css">
    <link rel="stylesheet" media="all" href="{{asset('landingPage')}}/cute-alert-master/style.css"/>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <style>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: bold;
            margin: 24px 0 12px !important;
        }

        p {
            color: #555;
            margin-bottom: 10px !important;
            line-height: 26px;
        }

        ol,
        ul {
            list-style: persian;
            margin-bottom: 24px !important;
            padding-right: 24px;
        }

        li {
            margin-bottom: 12px !important;
            color: #777;
            line-height: 26px;
        }

        .container {
            padding: 50px 0;
        }

        .logo {
            text-align: center;
            margin-bottom: 50px;
        }

        .logo img {
            height: 100px;
            object-fit: contain;
            width: 100%;
        }
        @media (max-width: 768px) {
            .logo img {
                height: 70px;
            }
        }
        .terms{
            background: #fff;
            padding: 32px 24px;
            border-radius: 16px;
            margin: auto;
            width: min(100% - 20px , 992px);
            border: 2px dashed #d6d6d6;
        }
    </style>
</head>


<body>
<!--////////////////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////   nav-bar   /////////////////////////////////////////-->
<!--////////////////////////////////////////////////////////////////////////////////-->


<div class="container">
    <div class="logo">
        <img src="{{get_file($settings->header_logo)}}" alt="">
    </div>
    <div class="terms">
        {!! $text !!}
    </div>
</div>


</body>

</html>
