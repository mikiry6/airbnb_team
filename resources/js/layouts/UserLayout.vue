<script setup>
    
    import UserHotelSideBar from '@/components/Layout/UserHotelSideBar.vue';
    import UserParticulierSideBar from '@/components/Layout/UserParticulierSideBar.vue';
  import UserPrestataireSideBar from '@/components/Layout/UserPrestataireSideBar.vue';
    import UserSimpleSideBar from '@/components/Layout/UserSimpleSideBar.vue';
  
    import { Head, usePage } from '@inertiajs/vue3';
    

    const page = usePage();
    
    const user = page.props.auth.user;
</script>

<template>
  <div class="flex h-screen overflow-hidden bg-[#050b11]">

    <!-- ---------Affichage des sideBar Selon le Role -->
    <user-simple-side-bar v-if="user.role === 'simple'"></user-simple-side-bar>
    <user-hotel-side-bar v-if="user.role === 'hotel'" ></user-hotel-side-bar>
    <user-particulier-side-bar v-if="user.role === 'particulier'"  ></user-particulier-side-bar>
    <user-prestataire-side-bar v-if="user.role === 'prestataire'" ></user-prestataire-side-bar>
    

    <!-- Main -->
    <div class="flex-1 flex flex-col">
      
      <header class="bg-[#0b131a]/80 backdrop-blur-md border-b border-[#00ffff]/20 px-6 py-4 flex justify-between items-center shadow-[0_4px_30px_rgba(0,255,255,0.05)] sticky top-0 z-50">
        <div class="flex items-center gap-3">
          <div class="w-3 h-3 rounded-full bg-[#00ffff] animate-pulse shadow-[0_0_10px_#00ffff]"></div>
          <h1 class="text-xl font-medium tracking-wider text-white font-sans">
             DASHBOARD<span class="text-[#00ffff]">.</span>
          </h1>
        </div>
  
        <div class="flex items-center gap-6">
            <div class="relative hidden md:block">
              <input 
                  type="text" 
                  placeholder="Rechercher..."
                  class="w-64 px-4 py-2 bg-[#111f2b] text-white placeholder-slate-400 border border-[#00ffff]/10 rounded-xl focus:outline-none focus:border-[#00ffff]/50 focus:ring-1 focus:ring-[#00ffff]/50 transition-all duration-300 text-sm"
                >
            </div>

            <button class="relative p-2 text-slate-400 hover:text-[#00ffff] transition-colors duration-300 group">
              <i data-feather="bell" class="w-5 h-5"></i>
              <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-[#00ffff] rounded-full group-hover:animate-ping"></span>
            </button>

            <div class="relative p-[2px] rounded-full bg-gradient-to-br from-[#00ffff] to-[#0a4b5c] shadow-[0_0_15px_rgba(0,255,255,0.2)] hover:scale-105 transition-transform duration-300 cursor-pointer">
                <div class="bg-[#0b131a] rounded-full p-1">
              
                  <img 
                    src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/6.png" 
                    alt="Avatar" 
                    class="w-10 h-10 object-contain"
                  >
                </div>
            </div>
        </div>
      </header> 

     
      <main class="custom-scrollbar p-6 space-y-6 overflow-y-auto bg-gradient-to-br from-indigo-950 via-slate-900 to-cyan-950 bg-cover bg-center h-screen">
          <slot/>
      </main>

    </div>
  </div>
</template>


<style scoped>

.custom-scrollbar::-webkit-scrollbar {
  width: 8px;
}

.custom-scrollbar::-webkit-scrollbar-track {
  background: rgba(11, 19, 26, 0.5);
  backdrop-filter: blur(4px);
}

.custom-scrollbar::-webkit-scrollbar-thumb {
  background: linear-gradient(to bottom, #00ffff, #0a4b5c);
  border-radius: 9999px;
  border: 1px solid rgba(0, 255, 255, 0.2);
  box-shadow: inset 0 0 6px rgba(0, 255, 255, 0.3);
}


.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: #00ffff;
  box-shadow: 0 0 10px #00ffff, inset 0 0 6px rgba(255, 255, 255, 0.5);
}

.custom-scrollbar {
  scrollbar-width: thin;
  scrollbar-color: #00ffff rgba(11, 19, 26, 0.5);
}
</style>