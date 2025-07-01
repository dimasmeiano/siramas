<div wire:poll.10s>
    <a href="{{ route('anggota.chat.index') }}" class="text-sm text-gray-700 relative">
    Chat
    @if ($unreadCount > 0)
        <span class="ml-1 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">
            {{ $unreadCount }}
        </span>
    @endif
</a>
</div>
