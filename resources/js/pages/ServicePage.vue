<script setup>

defineProps({

    services: Array
})

</script>

<template>

<div class="min-h-screen bg-gray-100 p-10">

    <div class="max-w-7xl mx-auto">

        <div class="flex justify-between items-center mb-10">

            <h1 class="text-4xl font-bold">

                Tous les Services

            </h1>

            <Link
                href="/prestataire/services/create"
                class="bg-[#36465c] text-white px-6 py-3 rounded-xl"
            >
                Ajouter Service
            </Link>

        </div>

        <div class="grid md:grid-cols-3 gap-8">

            <div
                v-for="service in services"
                :key="service.id"
                class="bg-white rounded-3xl overflow-hidden shadow-xl"
            >

                <img
                    :src="`/storage/${service.image}`"
                    class="w-full h-60 object-cover"
                >

                <div class="p-6">

                    <h2 class="text-2xl font-bold mb-4">

                        {{ service.title }}

                    </h2>

                    <p class="text-gray-500 mb-5">

                        {{ service.description }}

                    </p>

                    <Link
                        :href="`/services/${service.id}`"
                        class="bg-[#36465c] text-white px-5 py-3 rounded-xl inline-block"
                    >
                        Voir détail
                    </Link>

                </div>

            </div>

        </div>

    </div>

</div>

</template>