<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Di sini kamu dapat mendaftarkan semua channel broadcasting yang aplikasi kamu gunakan.
| Laravel Echo akan mengecek channel ini sebelum mengizinkan akses.
|
*/

Broadcast::channel('chat.{chatId}', function ($user, $chatId) {
    return true; // Tambahkan logic autentikasi jika perlu
});