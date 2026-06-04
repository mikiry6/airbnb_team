<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps([
  'logements'
])
const a =ref(null)

console.log(props.logements);

const logementSelectionne = ref(null)

const ouvrirDetails = (logement) => {
  logementSelectionne.value = logement
   a.value= logement.image_logement.image_principale

  
}

const fermerDetails = () => {
  logementSelectionne.value = null
}

const formaterPrix = (p) => {
  return p ? p.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') : '0'
}

const editerLogement = (id) => {
  router.get(`/user/logements/${id}/edit`) 
}

const supprimerLogement = (id) => {
  if (confirm("Supprimer définitivement ce logement du catalogue ?")) {
    router.delete(`/user/logements/${id})`, {
      preserveScroll: true,
      onSuccess: () => {
       
        if (logementSelectionne.value && logementSelectionne.value.id === id) {
          fermerDetails()
        }
      }
    })
  }
}
</script>

<template>
  <div class="min-h-screen bg-[#b1bac7] p-4 sm:p-8 space-y-6 font-sans text-[#36465c]">
    <div class="max-w-5xl mx-auto space-y-6">
      
<<<<<<< HEAD
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
=======
      <div class="bg-white p-5 rounded-2xl shadow-md flex justify-between items-center">
        <div>
          <h2 class="text-xl font-bold tracking-wide">Catalogue Logements</h2>
          <p class="text-xs text-[#6d7f99]">Visualisation et gestion en temps réel avec Laravel</p>
        </div>
        <span class="bg-[#36465c] text-white text-xs font-bold px-3 py-1.5 rounded-full">
          {{ logements.length }} Logements disponibles
        </span>
      </div>

   
      <div v-if="logements.length === 0" class="text-center p-12 bg-white rounded-2xl shadow-sm">
        <p class="font-medium text-[#6d7f99]">Aucun logement n'est enregistré pour le moment.</p>
>>>>>>> 224b138 (part view particular)
      </div>

      
      <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div 
<<<<<<< HEAD
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
=======
          v-for="logement in logements" 
          :key="logement.id" 
          class="bg-white rounded-2xl shadow-md overflow-hidden flex flex-col justify-between transform hover:shadow-lg transition-shadow duration-200"
        >
         
     
          <div class="relative h-48 bg-gray-100">
            <img 
              :src="'/storage/'+logement.image_logement.image_principale" 
              class="w-full h-full object-cover" 
            />


            <span class="absolute bottom-2 right-2 bg-[#36465c] text-white px-2 py-1 text-xs font-bold rounded">
              {{ formaterPrix(logement.prix) }} Ar
            </span>
          </div>

    
          <div class="p-4 space-y-4 flex-1 flex flex-col justify-between">
            <div>
              <h4 class="font-bold text-base text-[#36465c] line-clamp-1 mt-0.5">{{ logement.titre }}</h4>
              <p class="text-xs text-gray-500 line-clamp-2 mt-1">{{ logement.description }}</p>
            </div>

        
            <div class="grid grid-cols-3 text-center text-[11px] py-2 border-t border-b border-[#b1bac7] border-opacity-40 text-[#6d7f99]">
              <div>🛏️ <strong>{{ logement.nb_chambre }}</strong> ch.</div>
              <div>🚿 <strong>{{ logement.nb_douche }}</strong> douche(s)</div>
              <div>🚽 <strong>{{ logement.nb_wc }}</strong> wc</div>
            </div>

        
            <div class="grid grid-cols-3 gap-2 pt-1">
              <button 
                @click="ouvrirDetails(logement)"
>>>>>>> 224b138 (part view particular)
                class="flex items-center justify-center gap-1 py-1.5 text-xs font-medium text-white bg-[#6d7f99] rounded-md hover:opacity-90 transition-opacity"
              >
                👁️ Voir
              </button>
              
<<<<<<< HEAD
            
              <button 
                @click="quickEdit(house)"
                class="flex items-center justify-center gap-1 py-1.5 text-xs font-medium text-[#36465c] bg-[#b1bac7] bg-opacity-40 rounded-md hover:bg-opacity-70 transition-all"
              >
                ✏️ Modifier
              </button>

          
              <button 
                @click="deleteHouse(house.id)"
=======
             
              <button 
                @click="editerLogement(logement.id)"
                class="flex items-center justify-center gap-1 py-1.5 text-xs font-medium text-white bg-amber-600 rounded-md hover:bg-amber-700 transition-colors"
              >
                ✏️ Éditer
              </button>


              <button 
                @click="supprimerLogement(logement.id)"
>>>>>>> 224b138 (part view particular)
                class="flex items-center justify-center gap-1 py-1.5 text-xs font-medium text-white bg-red-600 rounded-md hover:bg-red-700 transition-colors"
              >
                🗑️ Supprimer
              </button>
            </div>

          </div>
        </div>
      </div>

    </div>

<<<<<<< HEAD

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
=======
    
    <div 
      v-if="logementSelectionne" 
      class="fixed inset-0 bg-[#36465c] bg-opacity-70 flex items-center justify-center p-4 z-50 backdrop-blur-sm"
      @click.self="fermerDetails"
    >
      <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden max-h-[90vh] flex flex-col">
        
    
        <div class="relative h-64 bg-gray-100 flex-shrink-0">
          <img 
             :src="`/storage/${a}`" 
            class="w-full h-full object-cover" 
          />
          <button @click="fermerDetails" class="absolute top-3 right-3 bg-white text-[#36465c] w-8 h-8 rounded-full font-bold shadow-md hover:bg-gray-200">✕</button>
        </div>
        
       
        <div class="p-6 overflow-y-auto space-y-4">
          <div class="border-b border-[#b1bac7] pb-3">
            <h3 class="text-xl font-extrabold text-[#36465c]">{{ logementSelectionne.titre }}</h3>
            <p class="text-xl font-black mt-1 text-[#36465c]">{{ formaterPrix(logementSelectionne.prix) }} Ar</p>
          </div>

          <div class="grid grid-cols-3 gap-2 text-center bg-gray-50 p-3 rounded-xl border border-gray-100">
            <div><p class="text-lg">🛏️</p><p class="text-xs font-bold">{{ logementSelectionne.nb_chambre }} Chambres</p></div>
            <div><p class="text-lg">🚿</p><p class="text-xs font-bold">{{ logementSelectionne.nb_douche }} Douches</p></div>
            <div><p class="text-lg">🚽</p><p class="text-xs font-bold">{{ logementSelectionne.nb_wc }} WC</p></div>
>>>>>>> 224b138 (part view particular)
          </div>

          <div>
            <h4 class="text-xs font-bold uppercase tracking-wider mb-1">Description</h4>
<<<<<<< HEAD
            <p class="text-xs text-gray-700 leading-relaxed whitespace-pre-line bg-gray-50 p-3 rounded-lg">{{ selectedHouse.description }}</p>
          </div>
=======
            <p class="text-xs text-gray-700 leading-relaxed whitespace-pre-line bg-gray-50 p-3 rounded-lg">{{ logementSelectionne.description }}</p>
          </div>

       
          <div>
              <h4 class="text-xs font-bold uppercase tracking-wider mb-2">Images de détails</h4>
              <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                
                  <div 
                      v-for="cle in ['image_1', 'image_2', 'image_3', 'image_4'] " 
                      :key="cle"
                      class="h-20 bg-gray-100 rounded-lg overflow-hidden border border-gray-200"
                      >
                      <img 
                      :src="`/storage/${logementSelectionne.image_logement[cle]}`" 
                      class="w-full h-full object-cover" 
                      />
                  </div>
              </div>
          </div>


>>>>>>> 224b138 (part view particular)
        </div>
      </div>
    </div>

  </div>
</template>
<<<<<<< HEAD


=======
>>>>>>> 224b138 (part view particular)
