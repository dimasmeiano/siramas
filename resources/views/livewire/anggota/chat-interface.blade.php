<div class="flex h-screen w-screen overflow-hidden" x-data>

    {{-- SIDEBAR --}}
    <aside class="hidden md:flex flex-col w-[28%] max-w-sm bg-white border-r overflow-y-auto relative">
        {{-- Header --}}
        <div class="p-4 flex items-center justify-between border-b">
            <span class="font-semibold">Percakapan</span>
            <div class="dropdown dropdown-bottom dropdown-end">
                <label tabindex="0" class="btn btn-sm btn-circle btn-ghost text-primary"><i class="bi bi-plus-lg"></i></label>
                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-white rounded-box w-40 z-50">
                    <li><a wire:click="openNewMessageModal">Pesan Baru</a></li>
                    <li><a wire:click="openCreateGroupModal">Grup Baru</a></li>
                </ul>
            </div>
        </div>

        {{-- Daftar Chat --}}
        @foreach ($chats as $c)
            <div 
                wire:click="selectChat({{ $c->id }})"
                class="flex items-center gap-3 px-4 py-3 hover:bg-gray-100 cursor-pointer transition 
                       {{ $chat && $chat->id === $c->id ? 'bg-gray-200' : '' }}">
                
                <img src="{{ asset('dist/assets/img/user2-160x160.jpg') }}" class="h-10 w-10 rounded-full object-cover border" />
                
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-sm truncate flex items-center gap-1">
                        @if ($c->is_group)
                            <i class="bi bi-people-fill text-primary text-xs"></i>
                            {{ $c->group_name }}
                        @else
                            {{ $c->members->where('id', '!=', Auth::id())->first()?->member->nama_lengkap ?? 'Tanpa Nama' }}
                        @endif
                    </p>
                    <p class="text-xs text-gray-500 truncate">
                        {{ $c->messages->last()?->message ?? 'Belum ada pesan' }}
                    </p>
                </div>

                @if ($c->unread_count > 0)
                    <span class="badge badge-error badge-sm text-white text-xs">{{ $c->unread_count }}</span>
                @endif
            </div>
        @endforeach
    </aside>

    {{-- CHAT ROOM --}}
    <div class="flex-1 flex flex-col bg-gray-50">
        @if ($chat)
            {{-- Header Chat --}}
            <div class="sticky top-0 z-10 bg-white p-4 border-b font-semibold text-sm flex items-center justify-between">
                <div class="flex items-center gap-2">
                    @if ($chat->is_group)
                        <i class="bi bi-people-fill text-primary"></i>
                        {{ $chat->group_name }}
                    @else
                        {{ $chat->members->firstWhere('user_id', '!=', Auth::id())?->member->nama_lengkap ?? '-' }}
                    @endif
                </div>

                @if ($chat->is_group)
                    <button class="btn btn-sm ml-auto" wire:click="openManageGroupModal">
                        <i class="bi bi-gear"></i> Kelola Grup
                    </button>
                @endif
            </div>

            {{-- Pesan --}}
            <div id="chat-messages" class="flex-1 overflow-y-auto px-4 py-2 space-y-2">
                @foreach ($chat->messages as $msg)
                    <div class="flex {{ $msg->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                        <div class="chat {{ $msg->sender_id === Auth::id() ? 'chat-end' : 'chat-start' }}">
                            <div class="chat-header text-xs font-semibold text-gray-600">
                                {{ $msg->sender->member->nama_lengkap ?? 'Tanpa Nama' }}
                            </div>
                            <div class="chat-bubble {{ $msg->sender_id === Auth::id() ? 'chat-bubble-primary' : 'bg-gray-200' }}">
                                {{ $msg->message }}
                                @if ($msg->file_path)
                                    <div class="mt-2">
                                        <a href="{{ Storage::url($msg->file_path) }}" target="_blank" class="text-blue-600 underline text-sm">
                                            📎 Unduh File
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="chat-footer opacity-50 text-xs">
                                {{ $msg->created_at->format('H:i') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Input --}}
            <form wire:submit.prevent="sendMessage" class="sticky bottom-0 bg-white p-4 border-t flex gap-2" enctype="multipart/form-data">
                <input wire:model="message" type="text" class="input input-bordered w-full" placeholder="Tulis pesan...">
                
                <input wire:model="file" type="file" class="file-input file-input-bordered w-40" />

                <button class="btn btn-primary">Kirim</button>
            </form>
        @else
            {{-- Kosong --}}
            <div class="flex-1 flex flex-col items-center justify-center text-gray-400">
                <img src="https://cdn-icons-png.flaticon.com/512/1828/1828778.png" class="w-20 h-20 mb-4 opacity-30" />
                <p>Pilih percakapan untuk mulai chatting.</p>
            </div>
        @endif
    </div>

    {{-- Modal Tambah Pesan --}}
    @if ($showNewMessageModal)
        <div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md shadow">
                <h3 class="font-bold text-lg mb-4">Pilih Anggota</h3>

                <select wire:model="selectedUserId" class="select select-bordered w-full mb-4">
                    <option value="">-- Pilih anggota --</option>
                    @foreach ($availableUsers as $user)
                        <option value="{{ $user->id }}">{{ $user->member?->nama_lengkap ?? $user->username }}</option>
                    @endforeach
                </select>

                <div class="flex justify-end gap-2">
                    <button class="btn" wire:click="closeNewMessageModal">Batal</button>
                    <button class="btn btn-primary" wire:click="startNewChat" :disabled="!selectedUserId">
                        Mulai
                    </button>
                </div>
            </div>
        </div>
    @endif
    {{-- Modal Buat Grup --}}
    @if ($isCreatingGroup)
        <div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md shadow">
                <h3 class="font-bold text-lg mb-4">Buat Grup</h3>
    
                <input type="text" wire:model.defer="groupName" class="input input-bordered w-full mb-4" placeholder="Nama Grup">
    
                <div class="mb-4 max-h-40 overflow-y-auto space-y-2">
                    @foreach ($availableUsers as $user)
                        <label class="flex items-center gap-2">
                            <input type="checkbox" wire:model="groupMembers" value="{{ $user->id }}" class="checkbox checkbox-sm" />
                            <span>{{ $user->member->nama_lengkap ?? $user->username }}</span>
                        </label>
                    @endforeach
                </div>
    
                <div class="flex justify-end gap-2">
                    <button class="btn" wire:click="$set('isCreatingGroup', false)">Batal</button>
                    <button class="btn btn-primary" wire:click="createGroup">Buat</button>
                </div>
            </div>
        </div>
    @endif
    @if ($showManageGroupModal)
    <div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-xl">
            <h3 class="font-bold text-lg mb-4">Kelola Grup</h3>

            {{-- Nama Grup --}}
            <div class="mb-4">
                <label class="block text-sm mb-1">Nama Grup</label>
                <input wire:model="newGroupName" type="text" class="input input-bordered w-full" />
                <button wire:click="updateGroupName" class="btn btn-primary mt-2">Ubah Nama</button>
            </div>

            {{-- Anggota --}}
            <div class="mb-4">
                <label class="block text-sm mb-1">Pilih Anggota</label>
                <select wire:model="groupMemberIds" multiple class="select select-bordered w-full h-40">
                    {{-- Jangan beri option kosong --}}
                    @foreach ($allUsers as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->member?->nama_lengkap ?? $user->username }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-between">
                <div class="space-x-2">
                   @if ($chat && $chat->is_group && $chat->created_by === Auth::id())
                        <button wire:click="deleteGroup" class="btn btn-error btn-sm">Hapus Grup</button>
                    @else
                        <button onclick="confirmLeaveGroup()" class="btn btn-warning btn-sm">
                            <i class="bi bi-box-arrow-left"></i> Keluar Grup
                        </button>
                    @endif
                </div>
                <div class="space-x-2">
                    <button wire:click="$set('showManageGroupModal', false)" class="btn btn-sm">Batal</button>
                    <button wire:click="updateGroupMembers" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
