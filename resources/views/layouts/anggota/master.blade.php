<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'SIRAMAS' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- Styles --}}
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
</head>
<body class="bg-gray-100 text-gray-900 h-screen overflow-hidden">

    <div class="flex h-screen">
        {{-- Sidebar --}}
        @include('layouts.anggota.sidebar')

        {{-- Komponen Chat Full --}}
            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

        {{-- Chat Interface --}}
        <livewire:anggota.chat-interface />
    </div>

    {{-- Footer (opsional) --}}
    @include('layouts.anggota.footer')

    {{-- Notifikasi --}}
    @livewire('notification-bell')

    {{-- Scripts --}}
@livewireScripts

<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    Livewire.on('chatSelected', chatId => {
        const channel = Echo.private('chat.' + chatId);
        channel.listen('MessageSent', (e) => {
            Livewire.dispatch('refreshChat');
            Livewire.dispatch('refreshSidebar');
        });
    });

    function confirmLeaveGroup() {
        Swal.fire({
            title: 'Keluar dari grup?',
            text: "Anda tidak akan bisa menerima pesan dari grup ini lagi.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#eab308',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, keluar',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('leaveGroupRequest');
            }
        });
    }

    Livewire.on('showSuccess', (message) => {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: message,
            timer: 2500,
            showConfirmButton: false,
        });
    });

    Livewire.on('showError', (message) => {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: message,
        });
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            Livewire.dispatch('exitChat');
        }
    });
</script>
</body>
</html>