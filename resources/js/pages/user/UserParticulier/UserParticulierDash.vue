<script setup>
import { ref, onMounted } from 'vue'

const defaultImage = 'https://unsplash.com'
const houses = ref([])
const selectedHouse = ref(null)


const mockData = [
  {
    id: 1,
    title: "Villa Contemporaine Lumineuse",
    price: 420000,
    description: "Superbe villa d'architecte offrant de grands volumes, un salon cathédrale baigné de lumière et des prestations haut de gamme.",
    bedrooms: 4,
    bathrooms: 2,
    surface: 165,
    location: "Bordeaux (33)",
    imageUrl: "https://unsplash.com"
  },
  {
    id: 2,
    title: "Maison de Charme en Pierre",
    price: 295000,
    description: "Authentique maison rénovée avec goût combinant le charme de l'ancien avec poutres apparentes et le confort moderne.",
    bedrooms: 3,
    bathrooms: 1,
    surface: 110,
    location: "Nantes (44)",
    imageUrl: "https://unsplash.com"
  },
  {
    id: 3,
    title: "Propriété Moderne avec Piscine",
    price: 680000,
    description: "Magnifique demeure sans aucun vis-à-vis, dotée d'une grande terrasse en bois exotique et d'un espace de vie extérieur idyllique.",
    bedrooms: 5,
    bathrooms: 3,
    surface: 210,
    location: "Aix-en-Provence (13)",
    imageUrl: "https://unsplash.com"
  }
]


onMounted(() => {
  const saved = localStorage.getItem('crud_houses')
  if (saved && JSON.parse(saved).length > 0) {
    houses.value = JSON.parse(saved)
  } else {
    loadMockData()
  }
})

const loadMockData = () => {
  houses.value = [...mockData]
  saveToLocalStorage()
}

// Action : Voir
const openDetails = (house) => {
  selectedHouse.value = house
}

const closeDetails = () => {
  selectedHouse.value = null
}


const quickEdit = (house) => {
  const newTitle = prompt("Modifier le titre :", house.title)
  if (newTitle === null) return 

  const newPrice = prompt("Modifier le prix (€) :", house.price)
  if (newPrice === null) return

  const index = houses.value.findIndex(h => h.id === house.id)
  if (index !== -1) {
    houses.value[index].title = newTitle || house.title
    houses.value[index].price = Number(newPrice) || house.price
    saveToLocalStorage()
  }
}


const deleteHouse = (id) => {
  if (confirm("Supprimer définitivement cette maison du catalogue ?")) {
    houses.value = houses.value.filter(h => h.id !== id)
    saveToLocalStorage()
  }
}


const saveToLocalStorage = () => {
  localStorage.setItem('crud_houses', JSON.stringify(houses.value))
}

const formatPrice = (p) => {
  return p ? p.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') : '0'
}
</script>

<template>
  <div class="min-h-screen bg-[#b1bac7] p-4 sm:p-8 space-y-6 font-sans text-[#36465c]">
    <div class="max-w-5xl mx-auto space-y-6">
      
      <!-- BARRE D'EN-TÊTE -->
      <div class="bg-white p-5 rounded-2xl shadow-md flex justify-between items-center">
        <div>
          <h2 class="text-xl font-bold tracking-wide">Catalogue Immobilier</h2>
          <p class="text-xs text-[#6d7f99]">Visualisation et gestion en mode Front-End pur</p>
        </div>
        <span class="bg-[#36465c] text-white text-xs font-bold px-3 py-1.5 rounded-full">
          {{ houses.length }} Biens disponibles
        </span>
      </div>

     
      <div v-if="houses.length === 0" class="text-center p-12 bg-white rounded-2xl shadow-sm">
        <p class="font-medium text-[#6d7f99]">Aucune maison n'est enregistrée.</p>
        <button 
          @click="loadMockData" 
          class="mt-4 px-4 py-2 bg-[#36465c] text-white text-xs font-semibold rounded-lg hover:bg-[#6d7f99] transition-colors"
        >
          Réinitialiser avec les données de démonstration
        </button>
      </div>

      
      <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div 
          v-for="house in houses" 
          :key="house.id" 
          class="bg-white rounded-2xl shadow-md overflow-hidden flex flex-col justify-between transform hover:shadow-lg transition-shadow duration-200"
        >
         
          <div class="relative h-48 bg-gray-100">
            <img :src="house.imageUrl || defaultImage" alt="Maison" class="w-full h-full object-cover" />
            <span class="absolute bottom-2 right-2 bg-[#36465c] text-white px-2 py-1 text-xs font-bold rounded">
              {{ formatPrice(house.price) }} €
            </span>
          </div>

          <!-- Informations -->
          <div class="p-4 space-y-4 flex-1 flex flex-col justify-between">
            <div>
              <p class="text-[10px] font-bold text-[#6d7f99] uppercase tracking-wider">📍 {{ house.location }}</p>
              <h4 class="font-bold text-base text-[#36465c] line-clamp-1 mt-0.5">{{ house.title }}</h4>
              <p class="text-xs text-gray-500 line-clamp-2 mt-1">{{ house.description }}</p>
            </div>

           
            <div class="grid grid-cols-3 text-center text-[11px] py-2 border-t border-b border-[#b1bac7] border-opacity-40 text-[#6d7f99]">
              <div>🛏️ <strong>{{ house.bedrooms }}</strong> ch.</div>
              <div>🛁 <strong>{{ house.bathrooms }}</strong> sdb.</div>
              <div>📐 <strong>{{ house.surface }}</strong> m²</div>
            </div>

           
            <div class="grid grid-cols-3 gap-2 pt-1">
           
              <button 
                @click="openDetails(house)"
                class="flex items-center justify-center gap-1 py-1.5 text-xs font-medium text-white bg-[#6d7f99] rounded-md hover:opacity-90 transition-opacity"
              >
                👁️ Voir
              </button>
              
            
              <button 
                @click="quickEdit(house)"
                class="flex items-center justify-center gap-1 py-1.5 text-xs font-medium text-[#36465c] bg-[#b1bac7] bg-opacity-40 rounded-md hover:bg-opacity-70 transition-all"
              >
                ✏️ Modifier
              </button>

          
              <button 
                @click="deleteHouse(house.id)"
                class="flex items-center justify-center gap-1 py-1.5 text-xs font-medium text-white bg-red-600 rounded-md hover:bg-red-700 transition-colors"
              >
                🗑️ Supprimer
              </button>
            </div>

          </div>
        </div>
      </div>

    </div>


    <div 
      v-if="selectedHouse" 
      class="fixed inset-0 bg-[#36465c] bg-opacity-70 flex items-center justify-center p-4 z-50 backdrop-blur-sm"
      @click.self="closeDetails"
    >
      <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden max-h-[90vh] flex flex-col">
        <div class="relative h-64 bg-gray-100 flex-shrink-0">
          <img :src="selectedHouse.imageUrl || defaultImage" alt="Détails" class="w-full h-full object-cover" />
          <button @click="closeDetails" class="absolute top-3 right-3 bg-white text-[#36465c] w-8 h-8 rounded-full font-bold shadow-md hover:bg-gray-200">✕</button>
        </div>
        
        <div class="p-6 overflow-y-auto space-y-4">
          <div class="border-b border-[#b1bac7] pb-3">
            <span class="text-xs font-bold text-[#6d7f99] uppercase">📍 {{ selectedHouse.location }}</span>
            <h3 class="text-xl font-extrabold text-[#36465c]">{{ selectedHouse.title }}</h3>
            <p class="text-xl font-black mt-1 text-[#36465c]">{{ formatPrice(selectedHouse.price) }} €</p>
          </div>

          <div class="grid grid-cols-3 gap-2 text-center bg-gray-50 p-3 rounded-xl border border-gray-100">
            <div><p class="text-lg">🛏️</p><p class="text-xs font-bold">{{ selectedHouse.bedrooms }} Chambres</p></div>
            <div><p class="text-lg">🛁</p><p class="text-xs font-bold">{{ selectedHouse.bathrooms }} Salles de bain</p></div>
            <div><p class="text-lg">📐</p><p class="text-xs font-bold">{{ selectedHouse.surface }} m² Surface</p></div>
          </div>

          <div>
            <h4 class="text-xs font-bold uppercase tracking-wider mb-1">Description</h4>
            <p class="text-xs text-gray-700 leading-relaxed whitespace-pre-line bg-gray-50 p-3 rounded-lg">{{ selectedHouse.description }}</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>


