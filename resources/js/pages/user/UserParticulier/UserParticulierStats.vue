<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  user: {
    type: Object,
    required: true
  }
})

// const formulaire = useForm({
//   name: props.user.name,
//   email: props.user.email,
//   phone: props.user.phone,
//   adresse: props.user.adresse,
//   biographie: props.user.biographie,
// })

// const emit = defineEmits(['sauvegarder'])

// const mettreAJourProfil = () => {
//   emit('sauvegarder', formulaire.data())
// }
</script>

<template>
  <div class="min-h-screen bg-[#b1bac7] p-4 sm:p-8 space-y-6 font-sans text-[#36465c]">
    <div class="max-w-4xl mx-auto space-y-6">
      
      <!-- 1. En-tête du Profil -->
      <div class="bg-white rounded-2xl shadow-md p-6 relative overflow-hidden flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="absolute top-0 left-0 right-0 h-3 bg-[#36465c] opacity-90 z-0"></div>
        
        <div class="relative z-10 text-center sm:text-left space-y-1 mt-2 flex-1">
          <h2 class="text-2xl font-black text-[#36465c]">Name</h2>
          <div class="flex flex-wrap justify-center sm:justify-start gap-2 items-center text-xs">
            <span class="bg-[#36465c] text-white px-2.5 py-1 rounded-full font-bold uppercase tracking-wider">
             role
            </span>
            <span class="text-[#6d7f99] font-medium">📍 addresse</span>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      
        <div class="md:col-span-2 bg-white rounded-2xl shadow-md p-6">
          <h3 class="text-lg font-bold border-b border-gray-100 pb-3 mb-4 flex items-center gap-2">
            ⚙️ Informations Générales
          </h3>
          
          <form @submit.prevent="mettreAJourProfil" class="space-y-4">
            
       
            <div>
              <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Nom complet</label>
              <input 
           
                type="text" 
                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#36465c] text-black" 
                required
              />
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <!-- Email -->
              <div>
                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Adresse Email</label>
                <input 
                  
                  type="email" 
                  class="w-full border border-gray-300 rounded-xl px-4 py-2.5 bg-gray-50 text-gray-500 cursor-not-allowed" 
                  disabled
                />
              </div>

             
              <div>
                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Téléphone</label>
                <input 
                 
                  type="text" 
                  class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#36465c] text-black" 
                />
              </div>
            </div>

     
            <div>
              <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Adresse physique</label>
              <input 
                
                type="text" 
                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#36465c] text-black" 
              />
            </div>

          
            <div>
              <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Biographie / Présentation</label>
              <textarea 
             
                rows="4" 
                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#36465c] text-black resize-none"
              ></textarea>
            </div>

            <div class="flex justify-end pt-2">
              <button 
                type="submit" 
                
                class="bg-[#36465c] text-white font-bold px-6 py-2.5 rounded-xl hover:bg-opacity-90 transition disabled:opacity-50 text-sm shadow"
              >
                Enregistrer les modifications
              </button>
            </div>

          </form>
        </div>
  
        <div class="space-y-6">
          
      
          <div class="bg-white rounded-2xl shadow-md p-6 space-y-4">
            <h3 class="text-base font-bold border-b border-gray-100 pb-2 text-[#36465c]">
              📊 Activité Compte
            </h3>
            <div class="space-y-3">
              <div class="flex justify-between items-center text-xs">
                <span class="text-[#6d7f99] font-medium">Logements en ligne</span>
                <span class="font-black bg-gray-100 px-2.5 py-1 rounded-md text-[#36465c]">
                 logement
                </span>
              </div>
              <div class="flex justify-between items-center text-xs">
                <span class="text-[#6d7f99] font-medium">Statut du compte</span>
                <span class="font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md">
                 Statut
                </span>
              </div>
              <div class="flex justify-between items-center text-xs">
                <span class="text-[#6d7f99] font-medium">Membre depuis</span>
                <span class="text-gray-700 font-semibold">
                 date d inscription
                </span>
              </div>
            </div>
          </div>

      
          <div class="bg-white rounded-2xl shadow-md p-6 space-y-3">
            <h3 class="text-base font-bold text-[#36465c]">
              🔒 Sécurité
            </h3>
            <p class="text-xs text-[#6d7f99] leading-relaxed">
              Maintenez la sécurité de votre compte en mettant régulièrement à jour vos accès.
            </p>
            <button class="w-full text-center text-xs font-bold text-[#36465c] border border-[#36465c] border-opacity-30 rounded-xl py-2.5 hover:bg-gray-50 transition-colors">
              Modifier le mot de passe
            </button>
          </div>

        </div>

      </div>

    </div>
  </div>
</template>
