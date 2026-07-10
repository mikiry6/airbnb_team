<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps([
  'logements'
])

const a = ref(null)
const logementSelectionne = ref(null)

const ouvrirDetails = (logement) => {
  logementSelectionne.value = logement
  a.value = logement.image_logement.image_principale
}

const fermerDetails = () => {
  logementSelectionne.value = null
}

const changerImagePrincipale = (path) => {
  a.value = path
}

const formaterPrix = (p) => {
  return p ? p.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') : '0'
}

const editerLogement = (id) => {
  router.get(`/user/logements/${id}/edit`) 
}

const supprimerLogement = (id) => {
  if (confirm("Supprimer définitivement ce logement du catalogue ?")) {
    router.delete(`/user/logements/${id}`, {
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
  <div class="space-y-6 font-sans text-slate-200">
    <div class="max-w-6xl mx-auto space-y-8">
      
      <!-- HEADER DU CATALOGUE -->
      <div class="bg-[#0b131a]/60 backdrop-blur-md p-6 rounded-2xl border border-[#00ffff]/10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 shadow-xl">
        <div>
          <h2 class="text-xl font-bold tracking-wider uppercase text-white flex items-center gap-2">
            <span class="h-2 w-2 rounded-full bg-[#00ffff] shadow-[0_0_8px_#00ffff]"></span>
            Catalogue Logements
          </h2>
          <p class="text-xs text-slate-400 mt-0.5">Visualisation et gestion en temps réel de vos infrastructures</p>
        </div>
        <span class="bg-[#111f2b] border border-[#00ffff]/20 text-[#00ffff] text-xs font-bold px-4 py-2 rounded-xl shadow-[0_0_15px_rgba(0,255,255,0.05)]">
          {{ logements.length }} Logements en ligne
        </span>
      </div>

   
      <div v-if="logements.length === 0" class="text-center p-16 bg-[#0b131a]/40 rounded-2xl border border-dashed border-slate-800">
        <p class="font-medium text-slate-400">Aucun logement n'est enregistré dans votre base de données.</p>
      </div>

      <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div 
          v-for="logement in logements" 
          :key="logement.id" 
          class="bg-[#0b131a]/60 backdrop-blur-md rounded-2xl border border-slate-800/80 overflow-hidden flex flex-col justify-between group hover:border-[#00ffff]/30 hover:shadow-xl hover:shadow-[#00ffff]/5 transition-all duration-300"
        >
    
          <div class="relative h-48 bg-slate-950 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0b131a] to-transparent z-10 pointer-events-none"></div>
            <img 
              :src="'/storage/'+logement.image_logement.image_principale" 
              class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-80 group-hover:opacity-100" 
              alt="Logement"
            />
            <span class="absolute bottom-3 right-3 z-20 bg-slate-950/80 backdrop-blur-md border border-[#00ffff]/30 text-[#00ffff] px-3 py-1 text-xs font-bold rounded-lg tracking-wide shadow-md">
              {{ formaterPrix(logement.prix) }} Ar
            </span>
          </div>

          <div class="p-5 space-y-4 flex-1 flex flex-col justify-between">
            <div>
              <h4 class="font-bold text-base text-white tracking-wide line-clamp-1 group-hover:text-[#00ffff] transition-colors duration-300">{{ logement.titre }}</h4>
              <p class="text-xs text-slate-400 line-clamp-2 mt-1.5 leading-relaxed">{{ logement.description }}</p>
            </div>

            <div class="grid grid-cols-3 text-center text-[11px] py-3 bg-[#111f2b]/50 rounded-xl border border-slate-900 text-slate-300">
              <div class="border-r border-slate-800/60">
                <span class="block text-slate-500 mb-0.5 uppercase text-[9px] tracking-wider">Chambres</span>
                <strong class="text-white text-xs font-semibold">{{ logement.nb_chambre }}</strong>
              </div>
              <div class="border-r border-slate-800/60">
                <span class="block text-slate-500 mb-0.5 uppercase text-[9px] tracking-wider">Douches</span>
                <strong class="text-white text-xs font-semibold">{{ logement.nb_douche }}</strong>
              </div>
              <div>
                <span class="block text-slate-500 mb-0.5 uppercase text-[9px] tracking-wider">Toilettes</span>
                <strong class="text-white text-xs font-semibold">{{ logement.nb_wc }}</strong>
              </div>
            </div>

            <div class="grid grid-cols-3 gap-2 pt-1">
              <button 
                @click="ouvrirDetails(logement)"
                class="flex items-center justify-center py-2 text-xs font-semibold text-white bg-slate-900 border border-slate-800 rounded-xl hover:border-[#00ffff]/40 hover:text-[#00ffff] transition-all duration-200"
              >
                Détails
              </button>

              <button 
                @click="editerLogement(logement.id)"
                class="flex items-center justify-center py-2 text-xs font-semibold text-slate-950 bg-gradient-to-r from-amber-500 to-amber-600 rounded-xl hover:from-amber-400 hover:to-amber-500 transition-all duration-200 shadow-md shadow-amber-900/10"
              >
                Éditer
              </button>

              <button 
                @click="supprimerLogement(logement.id)"
                class="flex items-center justify-center py-2 text-xs font-semibold text-white bg-rose-950/40 border border-rose-900/40 rounded-xl hover:bg-rose-900/60 hover:border-rose-500 transition-all duration-200"
              >
                Supprimer
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

       
    <div 
      v-if="logementSelectionne" 
      class="fixed inset-0 bg-slate-950/80 flex items-center justify-center p-4 z-50 backdrop-blur-md overflow-y-auto"
      @click.self="fermerDetails"
    >
      <div class="bg-[#0b131a] w-full max-w-2xl rounded-2xl border border-slate-800 shadow-2xl shadow-cyan-950/30 overflow-hidden flex flex-col my-8">
        
        
        <div class="relative h-72 bg-slate-950 flex-shrink-0 border-b border-slate-900">
          <div class="absolute inset-0 bg-gradient-to-t from-[#0b131a] to-transparent z-10 pointer-events-none"></div>
          <img 
            :src="`/storage/${a}`" 
            class="w-full h-full object-cover opacity-90" 
            alt="Vue principale"
          />
          <button 
            @click="fermerDetails" 
            class="absolute top-4 right-4 z-20 bg-slate-900/80 backdrop-blur-md border border-slate-800 text-white w-9 h-9 rounded-xl font-bold shadow-md hover:border-cyan-500/50 hover:text-[#00ffff] transition-all flex items-center justify-center text-sm"
          >
            ✕
          </button>
        </div>

     
        <div class="p-6 space-y-6">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-900 pb-4">
            <div>
              <span class="text-[10px] font-bold tracking-widest text-[#00ffff] uppercase">Fiche technique</span>
              <h3 class="text-xl font-bold text-white tracking-wide mt-0.5">{{ logementSelectionne.titre }}</h3>
            </div>
            <p class="text-xl font-black text-[#00ffff] tracking-tight">{{ formaterPrix(logementSelectionne.prix) }} <span class="text-xs font-semibold text-slate-400">Ar</span></p>
          </div>

        
          <div class="grid grid-cols-3 gap-3 text-center bg-[#111f2b]/40 p-4 rounded-xl border border-slate-900">
            <div>
              <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider text-[10px]">Chambres</p>
              <p class="text-lg font-bold text-white mt-1">{{ logementSelectionne.nb_chambre }}</p>
            </div>
            <div class="border-x border-slate-800/60">
              <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider text-[10px]">Douches</p>
              <p class="text-lg font-bold text-white mt-1">{{ logementSelectionne.nb_douche }}</p>
            </div>
            <div>
              <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider text-[10px]">Toilettes (WC)</p>
              <p class="text-lg font-bold text-white mt-1">{{ logementSelectionne.nb_wc }}</p>
            </div>
          </div>

       
          <div class="space-y-1.5">
            <h4 class="text-[10px] font-bold uppercase tracking-widest text-slate-500">Présentation du bien</h4>
            <p class="text-xs text-slate-300 leading-relaxed whitespace-pre-line bg-[#111f2b]/20 border border-slate-900 p-4 rounded-xl">
              {{ logementSelectionne.description }}
            </p>
          </div>

       
          <div class="space-y-2">
            <h4 class="text-[10px] font-bold uppercase tracking-widest text-slate-500">Galerie photo</h4>
            <div class="grid grid-cols-5 gap-3">
              <div 
                v-for="cle in ['image_principale', 'image_1', 'image_2', 'image_3', 'image_4']" 
                :key="cle"
              >
                <button 
                  v-if="cle === 'image_principale' || (logementSelectionne.image_logement && logementSelectionne.image_logement[cle])"
                  @click="changerImagePrincipale(cle === 'image_principale' ? logementSelectionne.image_logement.image_principale : logementSelectionne.image_logement[cle])"
                  class="w-full h-14 bg-slate-950 rounded-xl overflow-hidden border transition-all duration-200 block"
                  :class="[
                    a === (cle === 'image_principale' ? logementSelectionne.image_logement.image_principale : logementSelectionne.image_logement[cle])
                      ? 'border-[#00ffff] shadow-[0_0_10px_rgba(0,255,255,0.2)] scale-95' 
                      : 'border-slate-800 hover:border-slate-600'
                  ]"
                >
                  <img 
                    :src="`/storage/${cle === 'image_principale' ? logementSelectionne.image_logement.image_principale : logementSelectionne.image_logement[cle]}`" 
                    class="w-full h-full object-cover" 
                    alt="Miniature"
                  />
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>
