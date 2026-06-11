<script setup>

    import { defineProps } from 'vue';

    const props = defineProps([

        'hotel'
    ])

</script>

<template>

    <h1>
        {{ hotel.nom }}
    </h1>

</template>