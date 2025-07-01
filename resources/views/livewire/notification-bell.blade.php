<div
    class="fixed top-4 right-4 z-50 bg-white rounded-full shadow-md p-3 flex items-center space-x-2 border border-gray-200"
    wire:poll.10s="checkUnread"
>
    <i class="bi bi-bell text-xl text-gray-700"></i>
    @if ($unreadCount > 0)
        <span class="bg-red-600 text-white text-xs rounded-full px-2 py-0.5 animate-pulse">
            {{ $unreadCount }}
        </span>
    @else
        <span class="text-sm text-gray-500">0</span>
    @endif
</div>