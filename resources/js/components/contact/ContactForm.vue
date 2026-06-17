<template>
  <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-8">

    <h2 class="text-2xl font-bold text-slate-800 mb-6">
      Envoyer un message
    </h2>

    <form @submit.prevent="submitForm" class="space-y-4">

      <input v-model="form.name" placeholder="Nom" class="input" />
      <input v-model="form.email" placeholder="Email" class="input" />
      <input v-model="form.subject" placeholder="Sujet" class="input" />

      <textarea v-model="form.message" placeholder="Message" class="input h-32"></textarea>

      <p v-if="errorMessage" class="text-red-500 text-sm">
        {{ errorMessage }}
      </p>

      <p v-if="successMessage" class="text-blue-600 text-sm">
        {{ successMessage }}
      </p>

      <button class="btn">
        {{ loading ? 'Envoi...' : 'Envoyer' }}
      </button>

    </form>

  </div>
</template>

<script setup>
import { ref } from 'vue'

const form = ref({ name:'', email:'', subject:'', message:'' })
const loading = ref(false)
const successMessage = ref('')
const errorMessage = ref('')

const submitForm = () => {
  errorMessage.value = ''
  successMessage.value = ''

  const name = form.value.name.trim()
  const email = form.value.email.trim()
  const subject = form.value.subject.trim()
  const message = form.value.message.trim()

  // NOM
  if (name.length < 3) {
    errorMessage.value = "Le nom doit avoir au moins 3 caractères"
    return
  }

  if (name.length > 50) {
    errorMessage.value = "Le nom ne doit pas dépasser 50 caractères"
    return
  }

  // EMAIL
  if (!email.includes('@')) {
    errorMessage.value = "Email invalide"
    return
  }

  // SUJET
  if (subject.length > 40) {
    errorMessage.value = "Le sujet ne doit pas dépasser 40 caractères"
    return
  }

  // MESSAGE
  if (!message) {
    errorMessage.value = "Le message est obligatoire"
    return
  }

  loading.value = true

  setTimeout(() => {
    successMessage.value = "Message envoyé ✔"

    form.value = {
      name: '',
      email: '',
      subject: '',
      message: ''
    }

    loading.value = false
  }, 800)
}
</script>

<style scoped>
.input {
  width: 100%;
  padding: 12px;
  border-radius: 12px;
  border: 1px solid #e2e8f0;
  background: #f8fafc;
  transition: 0.2s;
}

.input:focus {
  outline: none;
  border-color: #3b82f6;
  background: white;
  box-shadow: 0 0 0 4px rgba(59,130,246,0.1);
}

.btn {
  width: 100%;
  padding: 12px;
  border-radius: 12px;
  background: #3b82f6;
  color: white;
  font-weight: bold;
  transition: 0.2s;
}

.btn:hover {
  background: #2563eb;
}
</style>