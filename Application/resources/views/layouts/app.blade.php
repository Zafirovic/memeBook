<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>@yield('title')</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Bootstrap and fa -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <!-- Layout css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/layout/applayout.css') }}">
        <!-- User style -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/user/user-profile.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/user/avatar.css') }}">
        <!-- Meme style -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/meme/memes.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/meme/create.meme.css') }}">
        <!-- File input style -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/upload-files/file-input.css') }}">
        <!-- Helpers style -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/helpers/toastr.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/helpers/sidebar.css') }}">
        <!-- Animations -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/animations/CreateMemeAnimation.css') }}">
        <!-- Notifications -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/notifications/notifications.css') }}">
        <!-- Toast css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.2/toastr.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.2/toastr.css">

        <!-- Csrf token available -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
        <!-- This makes the current user's id available in javascript -->
        @if(!auth()->guest())
            <script>
                window.Laravel.userId = <?php echo auth()->user()->id; ?>
            </script>
        @endif
    </head>
    <body>
        <div id="app">
            <!-- Main Navbar -->
            @yield('navbar')
            <!-- Sidebar -->
            @yield('sidebar')
            <!-- Content -->
            @yield('content')
            <!-- End content -->

            @if (session('flashType'))
                <toast type="{{ session('flashType') }}"
                       title="{{ session('flashTitle') }}"
                       message="{{ session('flashMessage') }}"
                >
                </toast>
            @endif
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
                crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.5/waypoints.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>
        <script type="text/javascript" src="{{ asset('js/Dropdown.js') }}"></script>

        <!-- App scripts in child views -->
        @yield('scripts')
    </body>
</html>

