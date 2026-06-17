<script setup>

import { Link } from '@inertiajs/vue3'
import ServiceMap from '@/components/ServiceMap.vue'

defineProps({

    services: Array,
    totalServices: Number,
    totalCountries: Number,
    servicesThisMonth: Number,
    lastService: Object

})

</script>

<template>

<div class="min-h-screen bg-gray-100">

    <!-- HEADER -->
    <div class="bg-[#36465c] text-white p-8 shadow-lg">

        <h1 class="text-4xl font-bold">
            Dashboard Prestataire
        </h1>

        <p class="mt-2 text-gray-200">
            Gestion complète de vos services
        </p>

    </div>

    <div class="p-8">

        <!-- STATISTIQUES -->
        <div class="grid md:grid-cols-4 gap-6 mb-10">

            <div class="bg-white p-6 rounded-3xl shadow-lg">

                <h3 class="text-gray-500">
                    Total Services
                </h3>

                <p class="text-4xl font-bold text-[#36465c] mt-3">
                    {{ totalServices }}
                </p>

            </div>

            <div class="bg-white p-6 rounded-3xl shadow-lg">

                <h3 class="text-gray-500">
                    Pays Disponibles
                </h3>

                <p class="text-4xl font-bold text-green-500 mt-3">
                    {{ totalCountries }}
                </p>

            </div>

            <div class="bg-white p-6 rounded-3xl shadow-lg">

                <h3 class="text-gray-500">
                    Services du Mois
                </h3>

                <p class="text-4xl font-bold text-blue-500 mt-3">
                    {{ servicesThisMonth }}
                </p>

            </div>

            <div class="bg-white p-6 rounded-3xl shadow-lg">

                <h3 class="text-gray-500">
                    Dernier Service
                </h3>

                <p class="text-lg font-bold text-orange-500 mt-3">

                    {{ lastService ? lastService.title : 'Aucun service' }}

                </p>

            </div>

        </div>

        <!-- ACTIONS RAPIDES -->
        <div class="grid md:grid-cols-3 gap-6 mb-10">

            <div class="bg-white p-6 rounded-3xl shadow-lg">

                <h2 class="text-xl font-bold mb-5">
                    Actions Rapides
                </h2>

                <div class="space-y-3">

                    <Link
                        href="/prestataire/services/create"
                        class="block text-center bg-blue-500 text-white py-3 rounded-xl"
                    >
                        Ajouter Service
                    </Link>

                    <Link
                        href="/prestataire/dashboard"
                        class="block text-center bg-green-500 text-white py-3 rounded-xl"
                    >
                        Voir Services
                    </Link>

                </div>

            </div>

            <!-- ACTIVITE -->
            <div class="bg-white p-6 rounded-3xl shadow-lg md:col-span-2">

                <h2 class="text-xl font-bold mb-5">
                    Résumé
                </h2>

                <div class="space-y-3">

                    <div class="flex justify-between border-b pb-3">

                        <span>Total des services enregistrés</span>

                        <span class="font-bold">
                            {{ totalServices }}
                        </span>

                    </div>

                    <div class="flex justify-between border-b pb-3">

                        <span>Pays représentés</span>

                        <span class="font-bold">
                            {{ totalCountries }}
                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span>Services ajoutés ce mois</span>

                        <span class="font-bold">
                            {{ servicesThisMonth }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

        <!-- SERVICES RECENTS -->
        <div class="mb-10">

            <h2 class="text-2xl font-bold mb-6">

                Services Récents

            </h2>

            <div class="grid md:grid-cols-3 gap-6">

                <div
                    v-for="service in services.slice(0,3)"
                    :key="service.id"
                    class="bg-white rounded-3xl overflow-hidden shadow-lg"
                >

                    <img
                        :src="`/storage/${service.image}`"
                        class="w-full h-56 object-cover"
                    >

                    <div class="p-5">

                        <h3 class="font-bold text-xl">

                            {{ service.title }}

                        </h3>

                        <p class="text-gray-500 mt-2">

                            {{ service.description }}

                        </p>

                        <p class="text-blue-500 mt-3">

                            📍 {{ service.pays?.nom }}

                        </p>

                    </div>

                </div>

            </div>

        </div>

        <!-- CARTE -->
        <div>

            <h2 class="text-3xl font-bold mb-6">

                Carte des Services

            </h2>

            <ServiceMap
                :services="services"
            />

        </div>

    </div>

</div>

</template>