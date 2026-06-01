<script setup lang="ts">
import Footer from '@/components/Layout/Footer.vue';
import Navbar from '@/components/Layout/Navbar.vue';

</script>

<template>
    <!-- Navbar -->
    <Navbar/>

    <!-- Hero Section -->
    <section
        class="relative h-[600px] bg-cover bg-center flex items-center justify-center"
        style="background-image: url('https://images.unsplash.com/photo-1566073771259-6a8506099945');"
    >

        <div class="absolute inset-0 bg-black/50"></div>

        <div class="relative z-10 text-center text-white px-6">

            <h1 class="text-5xl md:text-6xl font-bold mb-6">
                Trouvez votre hôtel idéal
            </h1>

            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Découvrez des logements modernes et luxueux
                pour vos vacances et voyages.
            </p>

            <button class="px-6 py-3 bg-blue-500 hover:bg-blue-600 rounded-xl">
                Réserver maintenant
            </button>

        </div>

    </section>

    <!-- Search Form -->

    <!-- Services -->
    <section class="max-w-7xl mx-auto px-6 py-20">

        <div class="text-center mb-14">

            <h2 class="text-4xl font-bold mb-4">
                Nos Services
            </h2>

            <p class="text-gray-500">
                Découvrez nos meilleurs services et logements.
            </p>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300">

                <img
                    src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa"
                    class="w-full h-56 object-cover"
                >

                <div class="p-5">

                    <h2 class="text-2xl font-bold mb-3">
                        Hôtel de Luxe
                    </h2>

                    <p class="text-gray-500 mb-5">
                        Profitez d’un confort exceptionnel.
                    </p>

                    <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-xl">
                        Voir plus
                    </button>

                </div>

            </div>

            <!-- Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300">

                <img
                    src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267"
                    class="w-full h-56 object-cover"
                >

                <div class="p-5">

                    <h2 class="text-2xl font-bold mb-3">
                        Appartement Moderne
                    </h2>

                    <p class="text-gray-500 mb-5">
                        Appartements spacieux et modernes.
                    </p>

                    <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-xl">
                        Voir plus
                    </button>

                </div>

            </div>

        </div>

    </section>
    <Footer/>
</template>