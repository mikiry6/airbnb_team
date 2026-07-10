<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';


const page = usePage();
const currentUrl = computed(() => page.url);


const navItems = [
  { href: '/user/statistiques', label: 'Tableau de Bord', icon: 'M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z' },
  { href: '/user/dashParticulier', label: 'Logement existant', icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6' },
  { href: '/user/form', label: 'Ajouter un logement', icon: 'M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z' },
  { href: '/user/résérvations', label: 'Réservations', icon: 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z' },
  { href: '/user/profile', label: 'Profil', icon: 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z' },
];
</script>

<template>
  <aside class="w-64 hidden md:flex flex-col bg-slate-900 border-r border-slate-800 text-slate-200 min-h-screen">
    
   
    <div class="p-6 flex items-center gap-3 border-b border-slate-800/60">
      <div class="p-1.5 bg-slate-800 rounded-xl border border-slate-700/50 shadow-inner">
        <img 
          src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" 
          class="w-7 h-7 object-contain animate-pulse"
          alt="Logo"
        >
      </div>
      <div>
        <span class="text-xl font-black tracking-wider bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 to-blue-500">
          MyApp
        </span>
        <p class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest -mt-0.5">Espace Client</p>
      </div>
    </div>

    
    <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
      <ul class="space-y-1">
        <li v-for="item in navItems" :key="item.href">
          <Link 
            :href="item.href"
            :class="[
              'flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group',
              currentUrl === item.href
                ? 'bg-gradient-to-r from-cyan-500/10 to-blue-500/5 text-cyan-400 border border-cyan-500/20 shadow-md shadow-cyan-500/[0.02]'
                : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/60 border border-transparent'
            ]"
          >
          
            <svg 
              xmlns="http://w3.org" 
              :class="[
                'h-5 w-5 transition-transform duration-200 group-hover:scale-105',
                currentUrl === item.href ? 'text-cyan-400' : 'text-slate-500 group-hover:text-slate-300'
              ]" 
              fill="none" 
              viewBox="0 0 24 24" 
              stroke="currentColor"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="item.icon" />
            </svg>
            
            <span>{{ item.label }}</span>
          </Link>
        </li>
      </ul>
    </nav>

    <div class="p-4 border-t border-slate-800/60 bg-slate-950/20">
      <div class="flex items-center gap-3 p-2 rounded-xl bg-slate-800/30 border border-slate-800">
        <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-cyan-500 to-blue-500 flex items-center justify-center font-bold text-xs text-slate-950">
          U
        </div>
        <div class="truncate">
          <p class="text-xs font-bold text-slate-300 truncate">Utilisateur</p>
          <span class="text-[10px] text-slate-500 font-mono">Session active</span>
        </div>
      </div>
    </div>

  </aside>
</template>
