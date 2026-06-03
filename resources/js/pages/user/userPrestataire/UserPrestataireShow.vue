<script setup>

defineProps({

    service: Object
})

</script>

<template>

<div class="min-h-screen bg-gray-100 p-10">

    <div class="max-w-5xl mx-auto bg-white rounded-3xl overflow-hidden shadow-xl">

        <img
            :src="`/storage/${service.image}`"
            class="w-full h-[500px] object-cover"
        >

        <div class="p-10">

            <div class="flex justify-between items-center mb-6">

                <h1 class="text-4xl font-bold">

                    {{ service.title }}

                </h1>

                <span class="bg-gray-200 px-4 py-2 rounded-full">

                    {{ service.country }}

                </span>

            </div>

            <p class="text-gray-600 leading-relaxed text-lg">

                {{ service.description }}

            </p>

        </div>

    </div>

</div>

</template>