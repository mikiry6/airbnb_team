<script setup>

    import { defineProps } from 'vue';
    import { onMounted } from 'vue';
    import { Link } from '@inertiajs/vue3';
    import L from 'leaflet'
    import 'leaflet/dist/leaflet.css'

    const props = defineProps([
        'hotel'
    ])

    // --------------------CHAMBRE LIBRE ET OCCUPER CALCUL 
    let nb_chambre_free = 0;
    let nb_chambre_occupied = 0;

    for (let i = 0; i < props.hotel.chambres.length; i++){
    
        if (props.hotel.chambres[i].is_free === 1){

            nb_chambre_free += 1
        }
        
    }
    nb_chambre_occupied = props.hotel.chambres.length - nb_chambre_free
    // ---------------------------------------------------

    console.log(props.hotel.chambres );
    

    onMounted(() => {

        // coordonnées venant de la base
        const latitude = props.hotel.latitude
        const longitude = props.hotel.longitude

        // création map
        const map = L.map('map').setView([latitude, longitude], 13)

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

            attribution: '&copy; OpenStreetMap contributors'

        }).addTo(map)

        // marker sur la position
        L.marker([latitude, longitude])
        .addTo(map)
        .bindPopup(props.hotel.nom)

    })
    
</script>

<template>

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white rounded-2xl shadow-sm border p-6">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    {{ hotel.nom }}
                </h1>

                <p class="text-gray-500 mt-1">
                    Gestion du logement
                </p>
            </div>

            <div class="space-x-5">

                <Link
                :href="`/user/hotel/${hotel.id}/chambre/create`"
                class=" inline-flex items-center justify-center px-5 py-3 rounded-xl bg-[#36465c] text-white font-medium hover:bg-[#2c394b] transition cursor-pointer"
                >
                    + Ajouter une chambre
                </Link>

                <Link
                    :href="`/user/hotel/${hotel.id}/chambre/liste`"
                    class=" cursor-poinnter inline-flex items-center justify-center px-5 py-3 rounded-xl bg-[#0d65e1] text-white font-medium hover:bg-[#166fec] transition cursor-pointer"
                >
                    Voir liste
                </Link>

            </div>


        </div>

        <!-- STATS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">

            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                <p class="text-sm text-gray-500">
                    Total chambres
                </p>

                <h2 class="text-3xl font-bold text-blue-600">
                    {{ hotel.chambres.length  }}
                </h2>
            </div>

            <div class="bg-green-50 border border-green-100 rounded-xl p-4">
                <p class="text-sm text-gray-500">
                    Chambres disponibles
                </p>

                <h2 class="text-3xl font-bold text-green-600">
                    {{ nb_chambre_free }}
                </h2>
            </div>

            <div class="bg-red-50 border border-red-100 rounded-xl p-4">
                <p class="text-sm text-gray-500">
                    Chambres occupées
                </p>

                <h2 class="text-3xl font-bold text-red-600">
                    {{ nb_chambre_occupied }}
                </h2>
            </div>

        </div>

    </div>

    <!-- GALERIE -->
    <div class="bg-white rounded-2xl shadow-sm border p-4">

        <h2 class="text-xl font-semibold mb-4">
            Galerie
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <img
                :src="hotel.image_principale"
                class="h-64 w-full object-cover rounded-xl shadow hover:scale-[1.02] transition"
            >

            <img
                :src="hotel.image_1"
                class="h-64 w-full object-cover rounded-xl shadow hover:scale-[1.02] transition"
            >

            <img
                :src="hotel.image_2"
                class="h-64 w-full object-cover rounded-xl shadow hover:scale-[1.02] transition"
            >

        </div>

    </div>

    <!-- DESCRIPTION -->
    <div class="bg-white rounded-2xl shadow-sm border p-6">

        <h2 class="text-xl font-semibold mb-3">
            Description
        </h2>

        <p class="text-gray-600 leading-relaxed">
            {{ hotel.description }}
        </p>

    </div>

    <!-- LOCALISATION -->
    <div class="bg-white rounded-2xl shadow-sm border p-6">

        <h2 class="text-xl font-semibold mb-4">
            Localisation
        </h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div
                id="map"
                class="w-full h-[350px] rounded-2xl overflow-hidden border"
            ></div>

            <div class="space-y-4">

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Localisation
                    </label>

                    <input
                        :value="hotel.localisation.localisation"
                        readonly
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3"
                    >
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Pays
                    </label>

                    <input
                        :value="hotel.pays.pays"
                        readonly
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3"
                    >
                </div>

                <div class="grid grid-cols-2 gap-4">

                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500">
                            Latitude
                        </p>

                        <p class="font-semibold">
                            {{ hotel.latitude }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500">
                            Longitude
                        </p>

                        <p class="font-semibold">
                            {{ hotel.longitude }}
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</template>