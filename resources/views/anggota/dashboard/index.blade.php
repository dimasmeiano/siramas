<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'SIRAMAS' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap Icons (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">

<div class="flex h-screen">
    
    @include('layouts.anggota.sidebar')

    <div class="flex-1 flex flex-col">
        
        @include('layouts.anggota.header')

        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>

        @include('layouts.anggota.footer')

    </div>
</div>

</body>
</html>