<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 
    @livewireStyles
    <style>
        .square-btn {
            width: 175px;
            height: 175px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-weight: bold;
            box-shadow: 2px 10px 10px rgba(0, 0, 0, 0.2);
        }

        .square-btn:hover {
            background-color: #22D8E6;
        }

        .icon-size {
            font-size: 2.5rem;
        }

        .label-size {
            font-size: 1.2rem;
            font-weight: bold;
            margin-top: 5px;
        }
    </style>
</head>
<body class="d-block d-md-flex flex-nowrap min-vh-100">
    <x-sidebar/>

    <x-sidebarHorizontal/>

    <main class="container-fluid p-4 bg-light" style="height: 100vh; overflow: hidden;">

        @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="bg-white p-5 shadow h-100 d-flex flex-column">
            <div class="content-scrollable flex-grow-1 overflow-auto">
                @yield('content')
            </div>
        </div>
    </main>

    @livewireScripts
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
