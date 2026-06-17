<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-50 via-white to-slate-100 px-6 py-16">

    <!-- Header -->
    <div class="text-center mb-14 animate-fade">
      <h1 class="text-5xl font-bold text-slate-800">
        Contactez-nous
      </h1>

      <p class="text-slate-500 mt-3">
        Une équipe disponible pour vous répondre rapidement
      </p>
    </div>

    <!-- Content -->
    <div class="grid lg:grid-cols-2 gap-10 max-w-6xl mx-auto">

      <div class="animate-up">
        <ContactInfo />
      </div>

      <div class="animate-up delay">
        <ContactForm />
      </div>

    </div>

  </div>
</template>

<script setup>
import ContactForm from '../../components/contact/ContactForm.vue'
import ContactInfo from '../../components/contact/ContactInfo.vue'
</script>

<style>
@keyframes fade {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes up {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

.animate-fade {
  animation: fade 0.6s ease;
}

.animate-up {
  animation: up 0.7s ease;
}

.delay {
  animation-delay: 0.2s;
}
</style>