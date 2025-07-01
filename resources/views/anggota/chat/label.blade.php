@extends('layouts.anggota.master')

@section('content')
<div class="p-6 max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Chat Labels</h1>

    <ul class="space-y-3">
        @foreach([
            ['label' => 'All Chats', 'count' => 3, 'icon' => '💬'],
            ['label' => 'Unread', 'count' => 2, 'icon' => '📩'],
            ['label' => 'Mentioned', 'count' => 1, 'icon' => '🔔'],
            ['label' => 'For Later', 'count' => 0, 'icon' => '📌'],
            ['label' => 'Private', 'count' => 0, 'icon' => '🔒'],
            ['label' => 'Threads', 'count' => 0, 'icon' => '🧵'],
        ] as $item)
        <li class="flex items-center justify-between bg-white px-4 py-3 rounded shadow hover:bg-gray-100">
            <div class="flex items-center space-x-2">
                <span class="text-xl">{{ $item['icon'] }}</span>
                <span class="text-sm font-medium text-gray-800">{{ $item['label'] }}</span>
            </div>
            @if($item['count'] > 0)
                <span class="bg-blue-600 text-white text-xs font-semibold px-2 py-0.5 rounded-full">
                    {{ $item['count'] }}
                </span>
            @endif
        </li>
        @endforeach
    </ul>
</div>
@endsection