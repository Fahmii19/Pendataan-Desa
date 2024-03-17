<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="title" content="Peta Perizinan dan Investasi DKI Jakarta">
    <meta name="description" content="Peta Perizinan dan Investasi oleh DKI Jakarta bekerja sama dengan DPMPTSP DKI Jakarta ">
    <meta name="og:title" content="Peta Perizinan dan Investasi DKI Jakarta">
    <meta name="og:description" content="Peta Perizinan dan Investasi oleh DKI Jakarta bekerja sama dengan DPMPTSP DKI Jakarta ">
    <meta name="twitter:title" content="Peta Perizinan dan Investasi DKI Jakarta">
    <meta name="twitter:description" content="Peta Perizinan dan Investasi oleh DKI Jakarta bekerja sama dengan DPMPTSP DKI Jakarta ">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pintoinvest</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" /> --}}
    <link href="{{ asset('assets/admin/img/favicon.png') }}" rel="icon">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">


    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" />

    <style type="text/tailwindcss">
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Open+Sans&display=swap");

        body {
            font-family: "Montserrat", sans-serif;
        }

        .gradient_card {
            background: linear-gradient(158deg,
                    rgba(119, 91, 41, 1) 31%,
                    rgba(7, 69, 91, 1) 71%);
        }

        .btn_masuk {
            background: linear-gradient(90deg,
                    rgba(255, 123, 0, 0.9925012241224614) 48%,
                    rgba(247, 148, 29, 1) 63%);
        }

        .slogan {
            background-color: #0956c6;
        }

        .padding_slogan {
            padding-bottom: 2%;
        }

        .title_slogan {
            font-size: 11px
        }

        video {
            filter: brightness(80%);
        }

        /* konten responsive login mobile */

        @media (max-width: 768px) and (min-width: 349px) {

            /* .bg_test
            {
                @apply bg-red-500;
            } */

            .login_responsive_mobile {
                @apply h-full max-w-full flex flex-col overflow-y-auto md:flex-row;
            }

            .hide_video {
                @apply hidden;
            }

            .hide_scrollbar{
                @apply w-full h-full overflow-hidden;
            }

            .footer_login {
                @apply mt-auto mb-20 text-center text-xs text-gray-300
            }
        }

        @media (max-width: 1024px) and (min-width: 768px) {

            /* .bg_test
            {
                @apply bg-yellow-500;
            } */

            .login_responsive_mobile {
                @apply flex flex-row min-h-screen;
            }

            .hide_video {
                @apply w-7/12 block;
            }

            .hide_scrollbar{
                @apply h-full w-5/12;
            }

            .footer_login {
                @apply mt-auto mb-12 text-center text-xs text-gray-300;
            }

            #bg-video {
                @apply w-full h-full object-cover;
            }
        }

        @media (min-width: 1024px) {
            /* .bg_test{
                @apply bg-green-500;
            } */

            .login_responsive_mobile {
                @apply flex flex-row min-h-screen;
            }

            .hide_video {
                @apply w-9/12 block;
            }

            .hide_scrollbar{
                @apply h-full w-3/12;
            }

            .footer_login {
                @apply mt-auto mb-12 text-center text-xs text-gray-300;
            }
        }


    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    spacing: {
                        13: "3.25rem"
                    , }
                    , fontFamily: {
                        family: ["Family"]
                    , }
                , }
            , }
        , };

    </script>

</head>

<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
    </nav> --}}

    <main>
        @yield('content')
    </main>
    </div>
</body>


<script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>


<script>
    // $("#btn_toggle_login").click(function() {
    //     $(".konten_toggle_login").toggle();
    // });
    const video = () => {
        let index = Math.floor(1 + Math.random() * 5);
        $("#bg-video").attr('src', `/v1/login-assets/video${index}.mp4`)
        console.log(index);
    }
    $(window).on('load', () => {
        video()
    })

    $("#bg-video").on("ended", () => {
        video()
    });

</script>

</html>


<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"></script>
