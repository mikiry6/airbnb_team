<script setup>

import { Link, useForm } from '@inertiajs/vue3'
import Swal from 'sweetalert2'
import ServiceMap from '@/components/ServiceMap.vue'

defineProps({
    services: Array
});


const form = useForm({})

const handleDelete = (id) => {

    Swal.fire({

        title: 'Supprimer ?',
        text: 'Cette action est irréversible',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Oui',
        cancelButtonText: 'Annuler'

    }).then((result) => {

        if (result.isConfirmed) {

            form.delete(`/services/${id}`)
        }
    })
}

</script>

<template>

<div class="min-h-screen bg-gray-100 p-10">

    <div class="max-w-7xl mx-auto">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-10">

            <div>

                <h1 class="text-4xl font-bold text-[#36465c]">
                    Dashboard Prestataire
                </h1>

                <p class="text-gray-500 mt-2">
                    Gestion des services
                </p>

            </div>

            <Link
                href="/prestataire/services/create"
                class="bg-[#36465c] text-white px-6 py-4 rounded-2xl"
            >
                Ajouter Service
            </Link>

        </div>

        <!-- LISTE SERVICES -->
        <div class="grid md:grid-cols-3 gap-8">

            <div
                v-for="service in services.data"
                :key="service.id"
                class="bg-white rounded-3xl overflow-hidden shadow-xl"
            >

                <!-- IMAGE -->
                <img
                    :src="`/storage/${service.image}`"
                    class="w-full h-60 object-cover"
                >

                <!-- CONTENU -->
                <div class="p-6">

                    <div class="flex justify-between items-center mb-4">

                        <h2 class="text-2xl font-bold">
                            {{ service.title }}
                        </h2>

                        <span
                            class="bg-gray-200 px-3 py-1 rounded-full text-sm"
                        >
                            {{ service.country }}
                        </span>

                    </div>

                    <p class="text-gray-500 mb-6">
                        {{ service.description }}
                    </p>

                    <!-- ACTIONS -->
                    <div class="flex flex-wrap gap-3">

                        <Link
                            :href="`/services/${service.id}`"
                            class="px-4 py-2 bg-[#36465c] text-white rounded-xl"
                        >
                            Détail
                        </Link>

                        <Link
                            :href="`/prestataire/services/${service.id}/edit`"
                            class="px-4 py-2 bg-yellow-500 text-white rounded-xl"
                        >
                            Modifier
                        </Link>

                        <button
                            @click="handleDelete(service.id)"
                            class="px-4 py-2 bg-red-500 text-white rounded-xl"
                        >
                            Supprimer
                        </button>

                    </div>

                </div>

            </div>

                <div class="flex justify-center mt-8 gap-2">

                    <Link
                        v-for="link in services.links"
                        :key="link.label"
                        :href="link.url"
                        v-html="link.label"
                        class="px-4 py-2 border rounded"
                        :class="{
                            'bg-blue-500 text-white': link.active,
                            'text-gray-400': !link.url
                        }"
                    />

                </div>
        </div>

    </div>

    <div class="mt-12">

        <h2 class="text-3xl font-bold mb-6">

            Carte des services

        </h2>

        <ServiceMap
            :services="services"
        />

    </div>
</div>

</template>