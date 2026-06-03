<script setup>

import { onMounted } from 'vue'
import L from 'leaflet'
import 'leaflet/dist/leaflet.css'

const props = defineProps({

    services: Array
})

onMounted(() => {

    const map = L.map('map').setView([-18.8792, 47.5079], 5)

    L.tileLayer(
        'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            attribution: '&copy; OpenStreetMap'
        }
    ).addTo(map)

    props.services.forEach(service => {

        if(service.latitude && service.longitude){

            L.marker([
                service.latitude,
                service.longitude
            ])
            .addTo(map)
            .bindPopup(`
                <b>${service.title}</b>
                <br>
                ${service.country}
            `)
        }

    })

})

</script>

<template>

<div
    id="map"
    class="w-full h-[500px] rounded-3xl shadow-lg"
></div>

</template>