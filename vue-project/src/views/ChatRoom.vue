<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'
import Echo from 'laravel-echo'
import Pusher from 'pusher-js'

window.Pusher = Pusher

const echo = new Echo({
  broadcaster: 'reverb',
  key: 'local',
  wsHost: 'localhost',
  wsPort: 6001,
  forceTLS: false,
  disableStats: true,
})

onMounted(() => {
  loadMessages()

  echo.channel(`chat.${chatId}`).listen('MessageSent', (e) => {
    messages.value.push(e.message)
  })
})

const route = useRoute()
const chatId = route.params.id
const messages = ref([])
const newMessage = ref('')

const api = axios.create({
  baseURL: 'http://localhost:8000/api', // ganti jika beda
  headers: {
    Accept: 'application/json',
    Authorization: `Bearer ${localStorage.getItem('token')}`
  }
})

// GET pesan dari API
const sendMessage = async () => {
  console.log('Mengirim pesan:', newMessage.value)

  if (!newMessage.value) {
    console.log('Pesan kosong, tidak dikirim.')
    return
  }

  try {
    const res = await api.post(`/chats/${chatId}/messages`, {
      message: newMessage.value,
      type: 'text',
    })
    console.log('Berhasil:', res.data)
    newMessage.value = ''
  } catch (err) {
    console.error('Gagal kirim pesan:', err.response?.data || err.message)
  }
}

</script>

<template>
  <div>
    <h2>Chat Room #{{ chatId }}</h2>

    <ul>
      <li v-for="msg in messages" :key="msg._id">
        <strong>{{ msg.sender_id }}:</strong> {{ msg.message }}
      </li>
    </ul>

    <input v-model="newMessage" @keyup.enter="sendMessage" placeholder="Tulis pesan..." />
<button @click="sendMessage">Kirim</button>
  </div>
</template>