<script setup>
    import { ref, computed } from 'vue'

// 1. Structure de données initiale pour simuler la base de données
const initialReservations = [
  {
    id: 1,
    client: 'Alexandre Martin',
    date: '10/06/2026',
    confirmedAt: null,
    details: 'Formule Premium',
    amount: 250,
    status: 'unconfirmed'
  },
  {
    id: 2,
    client: 'Sophie Dubois',
    date: '09/06/2026',
    confirmedAt: null,
    details: 'Option Coaching',
    amount: 120,
    status: 'unconfirmed'
  },
  {
    id: 3,
    client: 'Lucas Bernard',
    date: '08/06/2026',
    confirmedAt: '09/06/2026',
    details: 'Accès Standard',
    amount: 85,
    status: 'confirmed'
  },
  {
    id: 4,
    client: 'Émilie Petit',
    date: '05/06/2026',
    confirmedAt: '06/06/2026',
    details: 'Pack Immersion',
    amount: 450,
    status: 'confirmed'
  }
]

// 2. État réactif principal
const reservations = ref(initialReservations)

// 3. Propriétés calculées (Computed) pour filtrer dynamiquement les listes
const unconfirmedReservations = computed(() => {
  return reservations.value.filter(res => res.status === 'unconfirmed')
})

const confirmedReservations = computed(() => {
  return reservations.value.filter(res => res.status === 'confirmed')
})

// 4. Fonction d'action pour confirmer une réservation
const confirmReservation = (id) => {
  const reservation = reservations.value.find(res => res.id === id)
  
  if (reservation) {
    // Changement de statut
    reservation.status = 'confirmed'
    
    // Génération automatique de la date du jour pour la validation
    const today = new Date()
    reservation.confirmedAt = today.toLocaleDateString('fr-FR', {
      day: '2-digit',
      month: '2-digit',
      year: 'numeric'
    })
  }
}

</script>

<template>
    <div class="min-h-screen bg-slate-950 text-slate-100 font-sans p-6 sm:p-12">
  <div class="max-w-6xl mx-auto space-y-8">
    
    <!-- En-tête de la Page -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-800 pb-6">
      <div>
        <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">
          Gestion des Réservations
        </h1>
        <p class="text-sm text-slate-400 mt-1">Suivi en temps réel des statuts de confirmation</p>
      </div>
      
      <!-- Compteurs rapides -->
      <div class="flex gap-3 text-xs font-semibold">
        <div class="bg-slate-900 border border-slate-800 px-4 py-2 rounded-xl flex items-center gap-2">
          <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
          <span class="text-slate-400">À valider :</span>
          <span class="text-amber-400 font-mono">{{ unconfirmedReservations.length }}</span>
        </div>
        <div class="bg-slate-900 border border-slate-800 px-4 py-2 rounded-xl flex items-center gap-2">
          <span class="w-2 h-2 rounded-full bg-cyan-500"></span>
          <span class="text-slate-400">Confirmées :</span>
          <span class="text-cyan-400 font-mono">{{ confirmedReservations.length }}</span>
        </div>
      </div>
    </div>

    <!-- SECTION 1 : RÉSERVATIONS NON CONFIRMÉES (EN HAUT) -->
    <section class="bg-slate-900 rounded-2xl p-6 border border-slate-800 shadow-xl">
      <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-3">
          <div class="p-2 rounded-lg bg-amber-500/10 text-amber-500">
            <!-- Icône Horloge / Alerte -->
            <svg xmlns="http://w3.org" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <div>
            <h2 class="text-lg font-bold text-slate-200">En attente de confirmation</h2>
            <p class="text-xs text-slate-400">Demandes nécessitant une validation immédiate</p>
          </div>
        </div>
      </div>

      <!-- Tableau Non Confirmées -->
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
          <thead>
            <tr class="border-b border-slate-800 text-slate-400 text-xs uppercase tracking-wider">
              <th class="py-3 px-4 font-semibold">Client</th>
              <th class="py-3 px-4 font-semibold">Date demande</th>
              <th class="py-3 px-4 font-semibold">Service / Option</th>
              <th class="py-3 px-4 font-semibold text-right">Montant</th>
              <th class="py-3 px-4 text-center font-semibold">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-800/60">
            <tr v-for="res in unconfirmedReservations" :key="res.id" class="hover:bg-slate-800/30 transition-colors duration-150">
              <td class="py-3.5 px-4 font-medium text-slate-200">{{ res.client }}</td>
              <td class="py-3.5 px-4 text-slate-400 font-mono text-xs">{{ res.date }}</td>
              <td class="py-3.5 px-4 text-slate-300">
                <span class="px-2 py-0.5 rounded bg-slate-800 text-xs border border-slate-700/50">{{ res.details }}</span>
              </td>
              <td class="py-3.5 px-4 text-right text-amber-400 font-semibold font-mono">{{ res.amount }} €</td>
              <td class="py-3.5 px-4 text-center">
                <button @click="confirmReservation(res.id)" class="px-3 py-1 bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-400 hover:to-blue-400 text-slate-950 font-bold text-xs rounded-lg transition shadow-md shadow-cyan-500/10">
                  Confirmer
                </button>
              </td>
            </tr>
            <tr v-if="unconfirmedReservations.length === 0">
              <td colspan="5" class="py-8 text-center text-slate-500 italic">
                Aucune réservation en attente de confirmation.
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- SECTION 2 : RÉSERVATIONS CONFIRMÉES (EN BAS) -->
    <section class="bg-slate-900 rounded-2xl p-6 border border-slate-800 shadow-xl">
      <div class="flex items-center gap-3 mb-4">
        <div class="p-2 rounded-lg bg-cyan-500/10 text-cyan-400">
          <!-- Icône Check / Validation -->
          <svg xmlns="http://w3.org" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <div>
          <h2 class="text-lg font-bold text-slate-200">Réservations validées</h2>
          <p class="text-xs text-slate-400">Historique des dossiers confirmés pour cette période</p>
        </div>
      </div>

      <!-- Tableau Confirmées -->
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
          <thead>
            <tr class="border-b border-slate-800 text-slate-400 text-xs uppercase tracking-wider">
              <th class="py-3 px-4 font-semibold">Client</th>
              <th class="py-3 px-4 font-semibold">Date validation</th>
              <th class="py-3 px-4 font-semibold">Service / Option</th>
              <th class="py-3 px-4 font-semibold text-right">Montant</th>
              <th class="py-3 px-4 text-center font-semibold">Statut</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-800/60">
            <tr v-for="res in confirmedReservations" :key="res.id" class="hover:bg-slate-800/20 transition-colors duration-150">
              <td class="py-3.5 px-4 font-medium text-slate-300">{{ res.client }}</td>
              <td class="py-3.5 px-4 text-slate-500 font-mono text-xs">{{ res.confirmedAt }}</td>
              <td class="py-3.5 px-4 text-slate-400">{{ res.details }}</td>
              <td class="py-3.5 px-4 text-right text-cyan-400 font-semibold font-mono">{{ res.amount }} €</td>
              <td class="py-3.5 px-4 text-center">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-cyan-500/10 text-cyan-400 border border-cyan-500/20">
                  <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                  Confirmé
                </span>
              </td>
            </tr>
            <tr v-if="confirmedReservations.length === 0">
              <td colspan="5" class="py-8 text-center text-slate-500 italic">
                Aucune réservation confirmée pour le moment.
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

  </div>
</div>


</template>