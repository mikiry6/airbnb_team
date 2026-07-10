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

    <div class="space-y-6 text-white relative">

        <div class="backdrop-blur-xl bg-white/5 border border-white/10 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(0,149,255,0.05)]">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">
                        {{ hotel.nom }}
                    </h1>

                    <p class="text-slate-400 mt-1 text-sm">
                        Gestion du logement
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-4">

                    <Link
                        :href="`/user/hotel/${hotel.id}/chambre/create`"
                        class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-white/5 border border-white/10 text-white font-medium hover:bg-cyan-500/20 hover:border-cyan-500/30 hover:shadow-[0_0_15px_rgba(34,211,238,0.2)] transition duration-300 cursor-pointer"
                    >
                        + Ajouter une chambre
                    </Link>

                    <Link
                        :href="`/user/hotel/${hotel.id}/chambre/liste`"
                        class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-blue-600/60 border border-blue-500/30 text-white font-medium hover:bg-blue-500/80 hover:shadow-[0_0_15px_rgba(59,130,246,0.4)] transition duration-300 cursor-pointer"
                    >
                        Voir liste
                    </Link>

                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">

                <div class="backdrop-blur-md bg-blue-500/5 border border-blue-500/20 rounded-xl p-4 shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]">
                    <p class="text-sm text-slate-400">
                        Total chambres
                    </p>

                    <h2 class="text-3xl font-bold text-blue-400 mt-1 drop-shadow-[0_0_10px_rgba(96,165,250,0.3)]">
                        {{ hotel.chambres.length }}
                    </h2>
                </div>

                <div class="backdrop-blur-md bg-emerald-500/5 border border-emerald-500/20 rounded-xl p-4 shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]">
                    <p class="text-sm text-slate-400">
                        Chambres disponibles
                    </p>

                    <h2 class="text-3xl font-bold text-emerald-400 mt-1 drop-shadow-[0_0_10px_rgba(52,211,153,0.3)]">
                        {{ nb_chambre_free }}
                    </h2>
                </div>

                <div class="backdrop-blur-md bg-rose-500/5 border border-rose-500/20 rounded-xl p-4 shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]">
                    <p class="text-sm text-slate-400">
                        Chambres occupées
                    </p>

                    <h2 class="text-3xl font-bold text-rose-400 mt-1 drop-shadow-[0_0_10px_rgba(251,113,133,0.3)]">
                        {{ nb_chambre_occupied }}
                    </h2>
                </div>

            </div>

        </div>

        <div class="backdrop-blur-xl bg-white/5 border border-white/10 rounded-2xl p-4 shadow-[0_8px_32px_0_rgba(0,149,255,0.05)]">

            <h2 class="text-xl font-semibold mb-4 text-slate-200">
                Galerie
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <img
                    :src="hotel.image_principale"
                    class="h-64 w-full object-cover rounded-xl border border-white/10 shadow-lg hover:scale-[1.02] hover:border-cyan-500/40 transition-all duration-300"
                >

                <img
                    :src="hotel.image_1"
                    class="h-64 w-full object-cover rounded-xl border border-white/10 shadow-lg hover:scale-[1.02] hover:border-cyan-500/40 transition-all duration-300"
                >

                <img
                    :src="hotel.image_2"
                    class="h-64 w-full object-cover rounded-xl border border-white/10 shadow-lg hover:scale-[1.02] hover:border-cyan-500/40 transition-all duration-300"
                >

            </div>

        </div>

        <div class="backdrop-blur-xl bg-white/5 border border-white/10 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(0,149,255,0.05)]">

            <h2 class="text-xl font-semibold mb-3 text-slate-200">
                Description
            </h2>

            <p class="text-slate-300 leading-relaxed">
                {{ hotel.description }}
            </p>

        </div>

        <div class="backdrop-blur-xl bg-white/5 border border-white/10 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(0,149,255,0.05)]">

            <h2 class="text-xl font-semibold mb-4 text-slate-200">
                Localisation
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <div
                    id="map"
                    class="w-full h-[350px] rounded-2xl overflow-hidden border border-white/10 bg-slate-900/40 balance"
                ></div>

                <div class="space-y-4">

                    <div>
                        <label class="block mb-2 text-sm font-medium text-slate-400">
                            Localisation
                        </label>

                        <input
                            :value="hotel.localisation.localisation"
                            readonly
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none"
                        >
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-slate-400">
                            Pays
                        </label>

                        <input
                            :value="hotel.pays.pays"
                            readonly
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none"
                        >
                    </div>

                    <div class="grid grid-cols-2 gap-4">

                        <div class="bg-white/5 border border-white/5 rounded-xl p-4">
                            <p class="text-sm text-slate-400">
                                Latitude
                            </p>

                            <p class="font-semibold text-slate-200 mt-1">
                                {{ hotel.latitude }}
                            </p>
                        </div>

                        <div class="bg-white/5 border border-white/5 rounded-xl p-4">
                            <p class="text-sm text-slate-400">
                                Longitude
                            </p>

                            <p class="font-semibold text-slate-200 mt-1">
                                {{ hotel.longitude }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    
</template>