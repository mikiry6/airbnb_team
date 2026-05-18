<template>
  <div class="min-h-screen bg-[#b1bac7] p-4 sm:p-8 space-y-8 font-sans">
    
    <!-- CONTENEUR DU FORMULAIRE -->
    <div class="w-full max-w-2xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
      
      <!-- En-tête -->
      <div class="bg-[#36465c] text-white p-6 text-center">
        <h2 class="text-2xl font-bold tracking-wide">Ajouter une Nouvelle Maison</h2>
        <p class="text-sm text-[#b1bac7] mt-1">Simulateur d'insertion en mode Front-End</p>
      </div>

      <!-- Formulaire -->
      <form @submit.prevent="handleSubmit" class="p-6 sm:p-8 space-y-6">
        
        <!-- Titre & Prix -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-semibold text-[#36465c] mb-2">Titre de l'annonce</label>
            <input 
              v-model="form.title" 
              type="text" 
              placeholder="Ex: Belle villa contemporaine" 
              class="w-full px-4 py-2 border border-[#b1bac7] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6d7f99] focus:border-transparent"
              required
            />
          </div>
          <div>
            <label class="block text-sm font-semibold text-[#36465c] mb-2">Prix (€)</label>
            <input 
              v-model.number="form.price" 
              type="number" 
              placeholder="Ex: 250000" 
              class="w-full px-4 py-2 border border-[#b1bac7] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6d7f99] focus:border-transparent"
              required
            />
          </div>
        </div>

        <!-- Description -->
        <div>
          <label class="block text-sm font-semibold text-[#36465c] mb-2">Description du bien</label>
          <textarea 
            v-model="form.description" 
            rows="3" 
            placeholder="Décrivez les atouts de la maison..." 
            class="w-full px-4 py-2 border border-[#b1bac7] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6d7f99] focus:border-transparent resize-none"
            required
          ></textarea>
        </div>

        <!-- Caractéristiques (Chambres, Salles de bain, Surface) -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 bg-[#b1bac7] bg-opacity-20 p-4 rounded-xl">
          <div>
            <label class="block text-xs font-bold text-[#36465c] uppercase mb-1">Chambres</label>
            <input 
              v-model.number="form.bedrooms" 
              type="number" 
              min="0"
              class="w-full px-3 py-2 bg-white border border-[#b1bac7] rounded-md text-sm text-[#36465c]"
            />
          </div>
          <div>
            <label class="block text-xs font-bold text-[#36465c] uppercase mb-1">Salles de bain</label>
            <input 
              v-model.number="form.bathrooms" 
              type="number" 
              min="0"
              class="w-full px-3 py-2 bg-white border border-[#b1bac7] rounded-md text-sm text-[#36465c]"
            />
          </div>
          <div>
            <label class="block text-xs font-bold text-[#36465c] uppercase mb-1">Surface (m²)</label>
            <input 
              v-model.number="form.surface" 
              type="number" 
              min="0"
              class="w-full px-3 py-2 bg-white border border-[#b1bac7] rounded-md text-sm text-[#36465c]"
              required
            />
          </div>
        </div>

        <!-- Localisation & URL Image -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-semibold text-[#36465c] mb-2">Adresse / Ville</label>
            <input 
              v-model="form.location" 
              type="text" 
              placeholder="Ex: Paris (75011)" 
              class="w-full px-4 py-2 border border-[#b1bac7] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6d7f99] focus:border-transparent"
              required
            />
          </div>
          <div>
            <label class="block text-sm font-semibold text-[#36465c] mb-2">URL de l'image</label>
            <input 
              v-model="form.imageUrl" 
              type="url" 
              placeholder="https://unsplash.com..." 
              class="w-full px-4 py-2 border border-[#b1bac7] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6d7f99] focus:border-transparent"
            />
          </div>
        </div>

        <!-- Aperçu de l'image dynamique (uniquement si l'URL est remplie) -->
        <div v-if="form.imageUrl" class="mt-2">
          <p class="text-xs font-semibold text-[#6d7f99] mb-1">Aperçu de l'image :</p>
          <img :src="form.imageUrl" alt="Aperçu" class="w-full h-48 object-cover rounded-lg border border-[#b1bac7]" @error="handleImageError" />
        </div>

        <!-- Boutons d'action -->
        <div class="flex items-center justify-end space-x-4 pt-4 border-t border-[#b1bac7]">
          <button 
            type="button" 
            @click="resetForm"
            class="px-6 py-2.5 text-sm font-medium text-[#6d7f99] bg-transparent border border-[#6d7f99] rounded-lg hover:bg-[#6d7f99] hover:text-white transition-colors duration-200"
          >
            Vider les champs
          </button>
          <button 
            type="submit" 
            class="px-6 py-2.5 text-sm font-medium text-white bg-[#36465c] rounded-lg hover:bg-[#6d7f99] transition-colors duration-200 shadow-md"
          >
            Insérer localement
          </button>
        </div>
      </form>
    </div>

    <!-- LISTE DES MAISONS AJOUTÉES (VISUALISATION FRONT) -->
    <div class="w-full max-w-4xl mx-auto mt-12">
      <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold text-[#36465c]">Maisons enregistrées ({{ houses.length }})</h3>
        <button v-if="houses.length > 0" @click="clearAll" class="text-xs font-semibold text-[#36465c] underline hover:text-[#6d7f99]">
          Tout effacer
        </button>
      </div>
      
      <div v-if="houses.length === 0" class="text-center p-8 bg-white rounded-xl text-[#6d7f99] border border-dashed border-[#b1bac7]">
        Aucune maison insérée pour le moment. Remplissez le formulaire ci-dessus.
      </div>

      <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div v-for="(house, index) in houses" :key="index" class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col justify-between">
          <img 
            :src="house.imageUrl || 'https://unsplash.com1580587771525-78b9dba3b914?auto=format&fit=crop&w=600&q=80'" 
            alt="Maison" 
            class="w-full h-48 object-cover"
          />
          <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
            <div>
              <div class="flex justify-between items-start">
                <h4 class="text-lg font-bold text-[#36465c] line-clamp-1">{{ house.title }}</h4>
                <span class="text-lg font-extrabold text-[#36465c]">{{ house.price }} €</span>
              </div>
              <p class="text-xs text-[#6d7f99] mt-1">📍 {{ house.location }}</p>
              <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{ house.description }}</p>
            </div>
            
            <div class="flex justify-between items-center pt-3 border-t border-[#b1bac7] text-xs font-medium text-[#36465c]">
              <span>🛏️ {{ house.bedrooms }} ch.</span>
              <span>🛁 {{ house.bathrooms }} sdb.</span>
              <span>📐 {{ house.surface }} m²</span>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const initialFormState = {
  title: '',
  price: null,
  description: '',
  bedrooms: 0,
  bathrooms: 0,
  surface: null,
  location: '',
  imageUrl: ''
}

const form = ref({ ...initialFormState })
const houses = ref([])

// Charger les données stockées au démarrage
onMounted(() => {
  const savedHouses = localStorage.getItem('mock_houses')
  if (savedHouses) {
    houses.value = JSON.parse(savedHouses)
  }
})

// Validation et insertion locale
const handleSubmit = () => {
  houses.value.unshift({ ...form.value })
  localStorage.setItem('mock_houses', JSON.stringify(houses.value))
  resetForm()
}

const resetForm = () => {
  form.value = { ...initialFormState }
}

const clearAll = () => {
  houses.value = []
  localStorage.removeItem('mock_houses')
}

// Remplacer l'image par défaut si le lien saisi est mort
const handleImageError = (e) => {
  e.target.src = 'https://unsplash.com1580587771525-78b9dba3b914?auto=format&fit=crop&w=600&q=80'
}
</script>
