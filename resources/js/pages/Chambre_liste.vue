<script  setup>

    import Footer from '@/components/Layout/Footer.vue';
import Navbar from '@/components/Layout/Navbar.vue';
import { defineProps } from 'vue';

    const props = defineProps([

        'chambres'
    ])


</script>

<template>

    <Navbar/>

    <div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <h2 class="text-3xl font-bold leading-7 text-gray-900 sm:text-4xl sm:truncate">
                    Nos Chambres Disponibles
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Trouvez l'espace parfait pour votre séjour parmi nos chambres prêtes à vous accueillir.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100 flex flex-col">
                <div class="relative h-50 bg-gray-200">
                    <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=800&q=80" alt="Chambre Standard Cozie" class="w-full h-full object-cover">
                    <span class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-indigo-900 font-semibold px-3 py-1 rounded-full text-sm shadow-sm">
                        85€ <span class="text-xs text-gray-500 font-normal">/ nuit</span>
                    </span>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-xl font-bold text-gray-900">Chambre Double Cosy</h3>
                            <span class="px-2 py-1 text-xs font-medium bg-green-50 text-green-700 rounded-md">Disponible</span>
                        </div>
                        <p class="text-gray-600 text-sm line-clamp-2 mb-4">
                            Parfaite pour les couples ou les voyageurs en solo. Un nid douillet avec tout le confort moderne.
                        </p>
                        <div class="flex flex-wrap gap-4 text-xs text-gray-500 mb-6">
                            <span class="flex items-center gap-1"><i data-lucide="square" class="w-4 h-4 text-indigo-500"></i> 22 m²</span>
                            <span class="flex items-center gap-1"><i data-lucide="users" class="w-4 h-4 text-indigo-500"></i> 2 Pers.</span>
                            <span class="flex items-center gap-1"><i data-lucide="wifi" class="w-4 h-4 text-indigo-500"></i> Wi-Fi Gratuit</span>
                        </div>
                    </div>
                    <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-4 rounded-xl transition-colors duration-200 text-sm">
                        Réserver maintenant
                    </button>
                </div>
            </div>


        </div>
    </div>

    <Footer/>
    
</template>