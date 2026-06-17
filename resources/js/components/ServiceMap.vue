<script setup>

import { onMounted } from 'vue'
import L from 'leaflet'
import 'leaflet/dist/leaflet.css'

const props = defineProps({

    services: Array

})

onMounted(() => {

    console.log(props.services)

    const map = L.map('map').setView(
        [-18.8792, 47.5079],
        5
    )

    L.tileLayer(
        'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            attribution: '&copy; OpenStreetMap'
        }
    ).addTo(map)

    const serviceIcon = L.icon({

        iconUrl:
            'https://cdn-icons-png.flaticon.com/512/684/684908.png',

        iconSize: [40, 40],

        iconAnchor: [20, 40],

        popupAnchor: [0, -40]

    })

    props.services.forEach(service => {

        if (
            service.latitude &&
            service.longitude
        ) {

            L.marker(
                [
                    Number(service.latitude),
                    Number(service.longitude)
                ],
                {
                    icon: serviceIcon
                }
            )
            .addTo(map)

            .bindTooltip(
                service.pays?.nom ?? 'Pays inconnu',
                {
                    permanent: true,
                    direction: 'top'
                }
            )

            .bindPopup(`
                <div class="text-center">

                    <h3 style="font-weight:bold">
                        ${service.title}
                    </h3>

                    <p>
                        📍 ${service.pays?.nom ?? ''}
                    </p>

                    ${
                        service.image
                        ?
                        `<img
                            src="/storage/${service.image}"
                            style="
                                width:180px;
                                border-radius:10px;
                                margin-top:10px;
                            "
                        >`
                        : ''
                    }

                </div>
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