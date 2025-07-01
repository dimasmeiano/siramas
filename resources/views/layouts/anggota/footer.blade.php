<footer class="bg-white border-t p-4 text-center text-sm text-gray-500">
  @push('scripts')
    <script>
        Livewire.on('messageSent', () => {
            setTimeout(() => {
                const container = document.querySelector('[wire\\:id] .overflow-y-auto');
                if (container) container.scrollTop = container.scrollHeight;
            }, 100);
        });
    </script>
  @endpush
Copyright © {{ now()->year }} SIRAMAS.
</footer>