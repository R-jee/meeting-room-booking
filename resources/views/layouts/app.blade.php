<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Meeting Room Booking System')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>

@include('layouts.nav')
<main class="py-4">
    <div class="container">
        @yield('content')
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

@stack('scripts')
</body>
</html>
