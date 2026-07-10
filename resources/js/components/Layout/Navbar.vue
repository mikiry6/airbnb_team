<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { login, register } from '@/routes';

withDefaults(
  defineProps<{
    canRegister: boolean;
  }>(),
  {
    canRegister: true,
  }
);


const isMobileMenuOpen = ref(false);
</script>

<template>

  <div class="fixed top-4 left-1/2 -translate-x-1/2 w-[calc(100%-2rem)] max-w-7xl z-50">
    <div class="px-6 py-4 bg-slate-950/70 backdrop-blur-xl border border-slate-800/50 rounded-2xl shadow-2xl shadow-slate-950/50 transition-all duration-300">
      
      <nav class="flex items-center justify-between">
        <Link
          href="/"
          class="text-2xl font-black tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-slate-400 hover:scale-102 transition-transform"
        >
          StayFinder<span class="text-indigo-500">.</span>
        </Link>

        <div class="hidden md:flex items-center gap-1 text-sm font-medium text-slate-400">
          <Link href="/logement" class="px-4 py-2 rounded-lg hover:text-white hover:bg-slate-900/60 transition-all duration-200">
            Logements
          </Link>
          <a href="#" class="px-4 py-2 rounded-lg hover:text-white hover:bg-slate-900/60 transition-all duration-200">
            Activités
          </a>
          <a href="#" class="px-4 py-2 rounded-lg hover:text-white hover:bg-slate-900/60 transition-all duration-200">
            Destinations
          </a>
          <a href="#" class="px-4 py-2 rounded-lg hover:text-white hover:bg-slate-900/60 transition-all duration-200">
            À propos
          </a>
        </div>

        <div class="hidden md:flex items-center gap-4 text-sm font-medium">
          <template v-if="$page.props.auth.user">
            <Link
              href="/user"
              class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white hover:bg-indigo-500 shadow-lg shadow-indigo-600/20 hover:shadow-indigo-500/30 hover:-translate-y-0.5 transition-all duration-200"
            >
              Dashboard
            </Link>
          </template>
          <template v-else>
            <Link
              :href="login()"
              class="text-slate-300 hover:text-white transition-colors duration-200"
            >
              Connexion
            </Link>
            <Link
              v-if="canRegister"
              :href="register()"
              class="px-5 py-2.5 rounded-xl bg-white text-slate-950 hover:bg-slate-100 shadow-lg shadow-white/10 hover:-translate-y-0.5 transition-all duration-200"
            >
              Inscription
            </Link>
          </template>
        </div>

        <button 
          @click="isMobileMenuOpen = !isMobileMenuOpen"
          class="md:hidden p-2 text-slate-400 hover:text-white rounded-lg hover:bg-slate-900 transition-colors"
          aria-label="Menu"
        >
          <svg v-if="!isMobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
          <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </nav>

      <div 
        v-if="isMobileMenuOpen" 
        class="md:hidden mt-4 pt-4 border-t border-slate-900 flex flex-col gap-3 text-base font-medium animate-fadeIn"
      >
        <Link href="/logement" class="px-3 py-2 text-slate-400 hover:text-white hover:bg-slate-900 rounded-xl transition-all">Logements</Link>
        <a href="#" class="px-3 py-2 text-slate-400 hover:text-white hover:bg-slate-900 rounded-xl transition-all">Activités</a>
        <a href="#" class="px-3 py-2 text-slate-400 hover:text-white hover:bg-slate-900 rounded-xl transition-all">Destinations</a>
        <a href="#" class="px-3 py-2 text-slate-400 hover:text-white hover:bg-slate-900 rounded-xl transition-all">À propos</a>
        
        <div class="h-px bg-slate-900 my-2"></div>

        <template v-if="$page.props.auth.user">
          <Link href="/user" class="w-full text-center px-5 py-3 rounded-xl bg-indigo-600 text-white font-semibold">Dashboard</Link>
        </template>
        <template v-else>
          <Link :href="login()" class="w-full text-center px-5 py-3 text-slate-300 hover:text-white rounded-xl hover:bg-slate-900 transition-all">Connexion</Link>
          <Link v-if="canRegister" :href="register()" class="w-full text-center px-5 py-3 rounded-xl bg-white text-slate-950 font-semibold">Inscription</Link>
        </template>
      </div>

    </div>
  </div>
</template>

<style scoped>
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
  animation: fadeIn 0.2s ease-out forwards;
}
</style>
