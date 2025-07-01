<div class="flex flex-col h-full">
    <div class="p-3 border-b bg-white">
        <input type="text" placeholder="Cari..." class="w-full border px-2 py-1 rounded">
    </div>

    <div class="overflow-y-auto flex-1">
        @livewire('anggota.chat-notification')
        @foreach($chats as $chat)
            @php
                $lastMessage = $chat->messages->last();
                $name = $chat->is_group
                    ? $chat->group_name
                    : optional($chat->members->where('id', '!=', $user->id)->first()->member)->nama_lengkap ?? 'Tanpa Nama';
            @endphp

            <div wire:click="selectChat({{ $chat->id }})" class="px-4 py-3 hover:bg-gray-100 border-b cursor-pointer">
                <div class="font-semibold text-sm">{{ $name }}</div>
                <div class="text-xs text-gray-500 truncate">{{ $lastMessage->message ?? 'Belum ada pesan' }}</div>
                @if($chat->unread_count)
                <div class="text-xs text-red-600 font-semibold">({{ $chat->unread_count }}) Pesan baru</div>
            @endif
            </div>
        @endforeach
    </div>
</div>