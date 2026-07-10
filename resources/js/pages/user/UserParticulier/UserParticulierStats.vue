<script setup>
import { ref, computed , watch} from 'vue'
import { router } from '@inertiajs/vue3'


const props = defineProps({
  user: Object,
  totalLogements: {
    type: Number,
    required: true
  }
});

const selectedMonth = ref(null);


const selectMonth = (point) => {
  selectedMonth.value = point;
};

const logementsList = ref([
  { id: 1, titre: "Villa Contemporaine avec Piscine - Cannes", reservations_count: 42 },
  { id: 2, titre: "Appartement Cosy Centre-Ville - Paris", reservations_count: 28 },
  { id: 3, titre: "Chalet Typique en Bois - Chamonix", reservations_count: 19 },
]);
const dataset = ref({
  '2026': [
    { label: 'Jan', value: 30 },
    { label: 'Fév', value: 45 },
    { label: 'Mar', value: 35 },
    { label: 'Avr', value: 65 },
    { label: 'Mai', value: 55 },
    { label: 'Juin', value: 85 },
    { label: 'Juil', value: 70 },
    { label: 'Aoû', value: 95 },
  ],
  '2025': [
    { label: 'Jan', value: 20 },
    { label: 'Fév', value: 25 },
    { label: 'Mar', value: 40 },
    { label: 'Avr', value: 38 },
    { label: 'Mai', value: 50 },
    { label: 'Juin', value: 62 },
    { label: 'Juil', value: 58 },
    { label: 'Aoû', value: 75 },
  ],
  '2024': [
    { label: 'Jan', value: 15 },
    { label: 'Fév', value: 18 },
    { label: 'Mar', value: 22 },
    { label: 'Avr', value: 30 },
    { label: 'Mai', value: 28 },
    { label: 'Juin', value: 40 },
    { label: 'Juil', value: 45 },
    { label: 'Aoû', value: 50 },
  ]
})

// Année actuellement sélectionnée (par défaut la plus récente)
const selectedYear = ref('2026')

// Extraire dynamiquement la liste des années disponibles pour le filtre
const availableYears = computed(() => Object.keys(dataset.value).sort((a, b) => b - a))

// Récupérer les données filtrées selon l'année choisie
const currentData = computed(() => dataset.value[selectedYear.value] || [])

// Calcul du taux d'évolution global pour l'année sélectionnée
const growthRate = computed(() => {
  if (currentData.value.length < 2) return '0%'
  const first = currentData.value[0].value
  const last = currentData.value[currentData.value.length - 1].value
  const rate = ((last - first) / first) * 100
  return `${rate > 0 ? '+' : ''}${rate.toFixed(1)}%`
})

// Dimensions du graphique SVG
const width = 500
const height = 200
const padding = 20

// Trouver les valeurs minimales et maximales globales pour garder une échelle fixe et cohérente
const allValues = computed(() => Object.values(dataset.value).flat().map(d => d.value))
const maxValue = computed(() => Math.max(...allValues.value))
const minValue = computed(() => Math.min(...allValues.value))

// Générer les coordonnées (X, Y) pour chaque point du SVG
const points = computed(() => {
  if (currentData.value.length === 0) return []
  const xSpan = (width - padding * 2) / (currentData.value.length - 1)
  const ySpan = height - padding * 2
  
  return currentData.value.map((d, index) => {
    const x = padding + index * xSpan
    const y = height - padding - ((d.value - minValue.value) / (maxValue.value - minValue.value)) * ySpan
    return { x, y, label: d.label, value: d.value }
  })
})

// Créer le chemin (Path) SVG de la courbe de Bézier
const linePath = computed(() => {
  if (points.value.length === 0) return ''
  return points.value.reduce((path, point, index) => {
    if (index === 0) return `M ${point.x} ${point.y}`
    
    const prev = points.value[index - 1]
    const cpX1 = prev.x + (point.x - prev.x) / 2
    const cpY1 = prev.y
    const cpX2 = prev.x + (point.x - prev.x) / 2
    const cpY2 = point.y
    
    return `${path} C ${cpX1} ${cpY1}, ${cpX2} ${cpY2}, ${point.x} ${point.y}`
  }, '')
})

// Créer le chemin pour le dégradé sous la courbe
const areaPath = computed(() => {
  if (points.value.length === 0) return ''
  const first = points.value[0]
  const last = points.value[points.value.length - 1]
  return `${linePath.value} L ${last.x} ${height - padding} L ${first.x} ${height - padding} Z`
})

// État pour le survol d'un point (Tooltip)
const activePoint = ref(null)
</script>

<template>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-6xl mx-auto">
  <div class="relative group overflow-hidden rounded-2xl border border-slate-800/80 bg-[#0b131a]/40 backdrop-blur-md p-8 transition-all duration-500 hover:border-[#00ffff]/40 hover:shadow-2xl hover:shadow-[#00ffff]/5">

    <div class="absolute -top-24 -right-24 h-48 w-48 rounded-full bg-[#00ffff]/10 blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

    <div class="relative z-10 flex flex-col justify-between h-full space-y-6">
      
      <div class="flex items-center justify-between">
        <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest">
          Total des logements
        </h2>
        <span class="flex h-2 w-2 rounded-full bg-[#00ffff] shadow-[0_0_8px_#00ffff]"></span>
      </div>

      <div class="flex items-baseline gap-2">
        <p class="text-6xl font-black tracking-tight text-white group-hover:text-[#00ffff] transition-colors duration-300">
          {{ totalLogements }}
        </p>
        <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Actifs</span>
      </div>

      <div class="w-full h-[1px] bg-gradient-to-r from-[#00ffff]/20 via-slate-800 to-transparent"></div>
    </div>
  </div>

  <div class="relative group overflow-hidden rounded-2xl border border-slate-800/80 bg-[#0b131a]/40 backdrop-blur-md p-8 transition-all duration-500 hover:border-blue-500/40 hover:shadow-2xl hover:shadow-blue-500/5">
    
 
    <div class="absolute -top-24 -right-24 h-48 w-48 rounded-full bg-blue-500/10 blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

    <div class="relative z-10 flex flex-col justify-between h-full space-y-6">
      
      <div class="flex items-center justify-between">
        <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest">
          Total des réservations
        </h2>
        <span class="flex h-2 w-2 rounded-full bg-blue-500 shadow-[0_0_8px_#3b82f6] animate-pulse"></span>
      </div>
      
      <div class="flex items-baseline gap-2">
        <p class="text-6xl font-black tracking-tight text-white group-hover:text-blue-400 transition-colors duration-300">
        0
        </p>
        <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Enregistrées</span>
      </div>

      <div class="w-full h-[1px] bg-gradient-to-r from-blue-500/20 via-slate-800 to-transparent"></div>
    </div>
  </div>
</div>

  <div class="max-w-5xl mx-auto my-8 p-6 bg-slate-900 text-white rounded-2xl shadow-xl border border-slate-800">
  <!-- En-tête avec Titre et Filtre -->
  <div class="flex justify-between items-start mb-6">
    <div>
      <p class="text-sm font-medium text-slate-400 tracking-wide uppercase">Performances Annuelles</p>
      <h3 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 transition-all duration-300">
        {{ growthRate }}
      </h3>
    </div>
    
    <!-- Bouton de filtre d'année moderne -->
    <div class="flex bg-slate-800 p-1 rounded-xl border border-slate-700/50">
      <button 
        v-for="year in availableYears" 
        :key="year"
        @click="selectedYear = year"
        :class="[
          'px-3 py-1.5 text-xs font-semibold rounded-lg transition-all duration-200',
          selectedYear === year 
            ? 'bg-cyan-500 text-slate-900 shadow-md shadow-cyan-500/20 font-bold' 
            : 'text-slate-400 hover:text-white hover:bg-slate-700/50'
        ]"
      >
        {{ year }}
      </button>
    </div>
  </div>

  <!-- Disposition en Grille : Graphique à gauche, Carte à droite -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
    
    <!-- Zone du Graphique (prend 2 colonnes sur 3) -->
    <div class="md:col-span-2">
      <div class="relative w-full overflow-visible">
        <svg :viewBox="`0 0 ${width} ${height}`" class="w-full h-auto overflow-visible">
          <defs>
            <linearGradient id="areaGradient" x1="0" y1="0" x2="0" y2="1">
              <stop offset="0%" stop-color="#06b6d4" stop-opacity="0.25" />
              <stop offset="100%" stop-color="#06b6d4" stop-opacity="0.0" />
            </linearGradient>
            
            <linearGradient id="lineGradient" x1="0" y1="0" x2="1" y2="0">
              <stop offset="0%" stop-color="#22d3ee" />
              <stop offset="100%" stop-color="#3b82f6" />
            </linearGradient>
          </defs>

          <!-- Lignes de grille horizontales -->
          <line v-for="i in 3" :key="i" 
            :x1="padding" :y1="padding + (i - 1) * ((height - padding * 2) / 2)" 
            :x2="width - padding" :y2="padding + (i - 1) * ((height - padding * 2) / 2)" 
            class="stroke-slate-800" stroke-width="1" stroke-dasharray="4" />

          <!-- Zone remplie -->
          <path :d="areaPath" fill="url(#areaGradient)" class="transition-all duration-500 ease-in-out" />

          <!-- Ligne de la courbe principale -->
          <path :d="linePath" fill="none" stroke="url(#lineGradient)" stroke-width="3" stroke-linecap="round" class="transition-all duration-500 ease-in-out" />

          <!-- Points interactifs -->
          <g v-for="(point, index) in points" :key="index">
            <!-- Zone invisible élargie (Ajout de @click ici) -->
            <circle :cx="point.x" :cy="point.y" r="12" fill="transparent" class="cursor-pointer"
              @mouseenter="activePoint = point" 
              @mouseleave="activePoint = null"
              @click="selectMonth(point)" 
            />
            
            <!-- Point visible animé -->
            <circle 
              :cx="point.x" 
              :cy="point.y" 
              :r="activePoint?.label === point.label || selectedMonth?.label === point.label ? 6 : 3" 
              :class="[
                'transition-all duration-500 ease-in-out pointer-events-none',
                selectedMonth?.label === point.label ? 'fill-emerald-400 stroke-white scale-125' :
                activePoint?.label === point.label ? 'fill-pink-500 stroke-white' : 'fill-cyan-400 stroke-slate-900'
              ]"
              stroke-width="2" 
            />
          </g>
        </svg>

        <!-- Tooltip Dynamique -->
        <div v-if="activePoint" 
          class="absolute z-10 p-2 bg-slate-800 border border-slate-700 rounded-lg shadow-lg text-xs pointer-events-none transition-all duration-150"
          :style="{ left: `${(activePoint.x / width) * 100}%`, top: `${(activePoint.y / height) * 100 - 20}%`, transform: 'translate(-50%, -100%)' }">
          <div class="font-semibold text-slate-300">{{ activePoint.label }}</div>
          <div class="font-bold text-cyan-400">{{ activePoint.value }} K</div>
        </div>
      </div>

      <!-- Légende de l'axe X -->
      <div class="flex justify-between px-2 mt-4 text-xs font-medium text-slate-500">
        <span v-for="point in points" :key="point.label">{{ point.label }}</span>
      </div>
    </div>

    <!-- Petite Card Latérale Droite (prend 1 colonne sur 3) -->
    <div class="bg-slate-800/50 border border-slate-700/60 rounded-xl p-4 h-full flex flex-col justify-between min-h-[180px] transition-all duration-300">
      <div v-if="selectedMonth">
        <span class="text-xs font-bold text-emerald-400 uppercase tracking-wider bg-emerald-500/10 px-2 py-1 rounded-md">
          Détails : {{ selectedMonth.label }}
        </span>
        <h4 class="text-slate-400 text-xs font-medium mt-4">Revenu du mois</h4>
        <p class="text-2xl font-bold text-white mt-1">{{ selectedMonth.value }} K€</p>
        
        <h4 class="text-slate-400 text-xs font-medium mt-3">Moyenne quotidienne estimée</h4>
        <!-- Calcul simple : Valeur du mois divisée par 30 jours -->
        <p class="text-xl font-semibold text-cyan-400 mt-1">
          {{ (selectedMonth.value / 30).toFixed(2) }} K€ <span class="text-xs text-slate-500">/ jour</span>
        </p>
      </div>
      
      <!-- État vide si aucun mois n'est cliqué -->
      <div v-else class="flex flex-col items-center justify-center text-center h-full my-auto text-slate-500">
        <svg xmlns="http://w3.org" class="h-8 w-8 mb-2 stroke-current" fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
        </svg>
        <p class="text-xs font-medium px-4">Cliquez sur un point du graphique pour voir les détails mensuels.</p>
      </div>
    </div>

  </div>
</div>

<div class="mt-8 bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden max-w-5xl mx-auto">
  <!-- En-tête du mini-tableau -->
  <div class="px-6 py-4 border-b border-slate-800 bg-slate-800/30 flex justify-between items-center">
    <div>
      <h4 class="text-base font-bold text-white">Classement des Logements</h4>
      <p class="text-xs text-slate-400 mt-0.5">Nombre total de réservations enregistrées</p>
    </div>
    <!-- Badge avec la taille du tableau fictif -->
    <span class="text-xs font-semibold px-2.5 py-1 bg-indigo-500/10 text-indigo-400 rounded-lg border border-indigo-500/20">
      {{ logementsList.length }} Actifs
    </span>
  </div>

  <!-- Corps du tableau / Liste -->
  <div class="divide-y divide-slate-800/60 max-h-64 overflow-y-auto custom-scrollbar">
    <!-- Ligne dynamique -->
    <div 
      v-for="(logement, index) in logementsList" 
      :key="logement.id"
      class="flex items-center justify-between px-6 py-3.5 hover:bg-slate-800/20 transition-colors duration-150"
    >
      <!-- Colonne Gauche : Rang & Titre -->
      <div class="flex items-center space-x-3 min-w-0">
        <!-- Index / Position numérique stylisée -->
        <span class="flex-shrink-0 w-6 h-6 rounded-md flex items-center justify-center text-xs font-bold"
          :class="[
            index === 0 ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' :
            index === 1 ? 'bg-slate-400/10 text-slate-300 border border-slate-400/20' :
            'bg-slate-800 text-slate-500'
          ]"
        >
          {{ index + 1 }}
        </span>
        
        <!-- Titre du logement -->
        <p class="text-sm font-medium text-slate-200 truncate pr-4">
          {{ logement.titre }}
        </p>
      </div>

      <!-- Colonne Droite : Nombre de réservations -->
      <div class="flex items-center space-x-2 flex-shrink-0">
        <span class="text-sm font-bold text-cyan-400 bg-cyan-500/5 px-2.5 py-1 rounded-md border border-cyan-500/10">
          {{ logement.reservations_count }}
        </span>
        <span class="text-xs text-slate-500 hidden sm:inline">résas</span>
      </div>
    </div>
  </div>
</div>


</template>
