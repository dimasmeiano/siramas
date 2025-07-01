<div class="flex h-screen overflow-hidden">
    <div class="w-80 border-r">
        @livewire('anggota.chat-sidebar')
    </div>

    <div class="flex-1 bg-gray-50">
        @if($selectedChatId)
            @livewire('anggota.chat-room', ['chatId' => $selectedChatId], key($selectedChatId))
        @else
            <div class="flex items-center justify-center h-full text-gray-400">
                Pilih percakapan di sebelah kiri.
            </div>
        @endif
    </div>
</div>