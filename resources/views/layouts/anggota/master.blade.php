<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'SIRAMAS' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen flex flex-col">
        
        {{-- Sidebar + Header --}}
        <div class="flex flex-1 overflow-hidden">
            @include('layouts.anggota.sidebar')

            <div class="flex-1 flex flex-col">

                <main class="flex-1 overflow-y-auto">
                    @yield('content')
                </main>

                @include('layouts.anggota.footer')
            </div>
        </div>
    </div>
    @livewire('notification-bell')

    @livewireScripts
    @stack('scripts')
</body>
</html>