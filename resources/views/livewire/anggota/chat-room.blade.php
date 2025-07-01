<div class="flex flex-col h-full" wire:poll.5s>
    @if($chats)
        <div class="p-4 border-b bg-white font-semibold">
            {{ $chats->is_group ? $chats->group_name : ($chats->members->where('id', '!=', $user->id)->first()?->member->nama_lengkap ?? 'Tanpa Nama') }}
        </div>

        <div class="flex-1 overflow-y-auto p-4 space-y-2 bg-gray-100">
            @foreach($chats->messages as $msg)
                <div class="flex {{ $msg->sender_id === $user->id ? 'justify-end' : 'justify-start' }}">
                    <div class="p-2 rounded {{ $msg->sender_id === $user->id ? 'bg-blue-500 text-white' : 'bg-white' }}">
                        <div class="text-xs text-gray-600 mb-1">
                            {{ $msg->sender->member->nama_lengkap ?? 'Tanpa Nama' }}
                        </div>
                        {{ $msg->message }}
                    </div>
                </div>
            @endforeach
        </div>

        <form wire:submit.prevent="sendMessage" class="p-4 bg-white border-t flex gap-2">
            <input wire:model.defer="message" type="text" class="w-full border p-2 rounded" placeholder="Ketik pesan...">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Kirim</button>
        </form>
    @else
        <div class="flex items-center justify-center h-full text-gray-400">
            Pilih percakapan di sebelah kiri.
        </div>
    @endif
</div>
    @auth
        @push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectedChatId = @json($chatId); // dari Livewire mount

        Echo.private('chat.' + selectedChatId)
            .listen('MessageSent', (e) => {
                Livewire.dispatch('newMessageReceived');

                // hanya tandai read jika chat sedang dibuka
                axios.post('/api/chat/' + selectedChatId + '/mark-as-read');
            });
    });
</script>
@endpush
    @endauth