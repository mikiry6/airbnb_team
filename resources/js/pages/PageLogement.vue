<script setup>
    import Footer from '@/components/Layout/Footer.vue';
    import Navbar from '@/components/Layout/Navbar.vue';
import { Link } from '@inertiajs/vue3';

    import { defineProps } from 'vue';

    const props = defineProps([
        
        'logements'
    ])

</script>

<template>

    <!-- Navbar -->
    <Navbar/>
    <!-- Main -->
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 lg:grid-cols-4 gap-6">

        <!------------------------------ FILTREAGE  ----------------------------->
        <div class="bg-white rounded-2xl shadow-lg p-6 h-fit">

            <h2 class="text-2xl font-bold mb-6">
                Filtres
            </h2>

            <div class="space-y-4">

                <!-- VILLE ET PAYS -->
                <input
                    type="text"
                    placeholder="Recherche..."
                    class="w-full border rounded-xl p-3"
                >
                <!-- PIECE -->
                <input
                    type="Number"
                    placeholder="Nbr Piece"
                    class="w-full border rounded-xl p-3"
                >
                <!-- PRIX -->
                <div
                    class="  flex gap-1 w-full "
                >
                    <input class="w-full border rounded-xl p-3" type="number" placeholder="prix min...">
                    <input class="w-full border rounded-xl p-3" type="number"  placeholder="prix max..." >

                </div>

                 <select class="w-full border rounded-xl p-3">
                    <option value="">Nbr Etoiles</option>
                    <optgroup>
                        <option value="">⭐</option>
                        <option value="">⭐⭐</option>
                        <option value="">⭐⭐⭐</option>
                        <option value="">⭐⭐⭐⭐</option>
                    </optgroup>
                </select>

                <select class="w-full border rounded-xl p-3">
                    <option>Type logement</option>
                </select>

                <select class="w-full border rounded-xl p-3">
                    <option>Pays</option>
                </select>

                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-xl">
                    Filtrer
                </button>

            </div>

        </div>

        <!-- -----------------------BOUCLAGE DES LOGEMENTS -------------- -->
        <div class="lg:col-span-3">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

                <div 
                    v-for="hebergement in logements" 
                    :key="hebergement.type + '-' + hebergement.id"
                    class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300">

                    <img
                        :src="'storage/'+hebergement.image"
                        :alt="'image ' + hebergement.nom"
                        class="w-full h-60 object-cover"
                    >

                    <div class="p-5">
                        <span 
                            class="text-xs font-semibold px-2 py-1 rounded"
                            :class="hebergement.type === 'hotel' ? 'bg-amber-100 text-amber-800' : 'bg-green-100 text-green-800'"
                        >
                            {{ hebergement.type === 'hotel' ? 'Hôtel' : 'Logement' }}
                        </span>

                        <h3 class="text-xl font-bold mt-2">{{ hebergement.nom }}</h3>
                        <p class="text-gray-600 text-sm line-clamp-2 mt-1">{{ hebergement.description }}</p>

                        <div class="mt-4 flex justify-between items-center">
                            <span v-if="hebergement.prix" class="font-bold text-blue-600">
                                {{ hebergement.prix }} € / nuit
                            </span>
                            <span v-else class="font-bold text-amber-600 text-sm">
                                Voir les chambres
                            </span>

                            <Link
                                v-if="hebergement.type == 'hotel'"
                                :href="`/logement/hotel/detail/${hebergement.id}`"
                                class="text-sm bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-lg"
                            >
                                Détails
                            </Link>
                            <Link
                                v-else
                                :href="`/logement/maison/detail/${hebergement.id}`"
                                class="text-sm bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-lg"
                            >
                                Détails
                            </Link>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <Footer/>

</template>