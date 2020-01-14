<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- SIDEBAR library imports -->
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href={{asset('css/sidebar.css')}}>
    <link rel="stylesheet" type="text/css" href={{asset('css/media-queries.css')}}>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/media-queries.css">

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    <title>MemeBook</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            color: #fff;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #fff;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .nav-link > a:hover, .nav-link > a:focus {
            background-color: #FFFF00;
            color: #FFC0CB;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-dark navbar-expand-md bg-dark fixed-top">
    <a class="navbar-brand text-white" href="#">MemeBook</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link text-white" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ url('/memes/create') }}">Upload meme</a>
            </li>
        </ul>
    </div>

    <div class="p-2 float-right">
        @if (Route::has('login'))
            @auth
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->username }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @else
                <a class="btn btn-outline-primary" href="{{ route('login') }}">Login</a>
                @if (Route::has('register'))
                    <a class="btn btn-outline-danger" href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        @endif
    </div>
</nav>

<!-- Wrapper -->
<div class="wrapper" style="background-color:gray">
    <!-- Sidebar -->
    <nav class="sidebar">
        <!-- close sidebar menu -->
        <div class="dismiss">
            <i class="fas fa-arrow-left"></i>
        </div>
        <div style="padding: 40px 20px">
            <h3><a href="index.html">MemeBook</a></h3>
        </div>
        <ul class="list-unstyled menu-elements">
            <li class="active">
                <a class="scroll-link" href="#top-content"><i class="fas fa-home"></i> My Profile</a>
            </li>

            <li>
                <a class="scroll-link" href="#section-6"><i class="fas fa-envelope"></i> Contact us</a>
            </li>
            <li>
                <a href="#otherSections" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="otherSections">
                    <i class="fab fa-buffer"></i>Meme categories
                </a>
                <ul class="collapse list-unstyled" id="otherSections">
                    @foreach($categories as $category)
                        <li>
                            <a class="scroll-link" href="#section-3">{{$category->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
        <div class="to-top">
            <a class="btn btn-primary btn-customized-3" href="#" role="button">
                <i class="fas fa-arrow-up"></i> Top
            </a>
        </div>
        <div class="dark-light-buttons">
            <a class="btn btn-primary btn-customized-4 btn-customized-dark" href="#" role="button">Dark</a>
            <a class="btn btn-primary btn-customized-4 btn-customized-light" href="#" role="button">Light</a>
        </div>
    </nav>
    <!-- End sidebar -->

    <!-- Dark overlay -->
    <div class="overlay"></div>

    <!-- Content -->
    <div class="content">

        <!-- open sidebar menu -->
        <a class="btn btn-primary btn-customized open-menu" style="margin-top: 60px" href="#" role="button">
            <i class="fas fa-align-left"></i> <span>Menu</span>
        </a>
        @foreach($memes as $meme)
            <div class="meme" style="background-color:black; margin: 0 auto; width:50%; padding-top:100px; color: black">

                <a href="#">
                    <img style="width: 600px;" src="images/memes/{{$meme->image}}" alt="">
                </a>
                <div class="row">
                    <div class="row" style="color:whitesmoke">
                        <h2>
                            <a class="btn" href="#" role="button">
                                <i class="fas fa-arrow-circle-up" style="font-size: 2.5em;"></i>
                            </a>
                            {{$meme->up_vote}}
                        </h2>
                        <h2>
                            <a class="btn" href="#" role="button">
                                <i class="fas fa-arrow-circle-down" style="font-size: 2.5em;"></i>
                            </a>
                            {{$meme->down_vote}}
                        </h2>
                    </div>
                </div>
                <div class="col-sm pt-1" style="color: aliceblue">
                    <h2><b>{{$meme->title}}</b></h2>
                    <h4>{{$meme->text}}</h4>
                    <br/>

                </div>
                <div style="color: white">
                    <h3>Posted by: <a href="#" role="button">{{$meme->user->username}}</a></h3>
                </div>

{{--                <h4>{{$meme->text}}</h4>--}}
{{--                <h3>Posted by: <a href="#" role="button">{{$meme->user->username}}</a></h3>--}}
            </div>
            <div  style="background-color: gray; height: 100px;"><br/></div>
    @endforeach
    <!-- ... -->

        <!-- here is the page's content (not shown here) -->

        <!-- ... -->

    </div>
    <!-- End content -->

</div>
<!-- End wrapper -->

<!-- Javascript -->
<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/jquery-migrate-3.0.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="assets/js/jquery.backstretch.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/jquery.waypoints.min.js"></script>
<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="assets/js/scripts.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/sidebar.js') }}"></script>
</body>
</html>
