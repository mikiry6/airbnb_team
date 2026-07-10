

<script setup>

import { useForm } from '@inertiajs/vue3'
import { onMounted, ref } from 'vue'
import { defineProps } from 'vue'

import L from 'leaflet'
import 'leaflet/dist/leaflet.css'

const props = defineProps([
    'hotel'
])

/* ---------------- FORM ---------------- */

const form = useForm({

    nom: props.hotel?.nom ?? '',
    description: props.hotel?.description ?? '',

    longitude: props.hotel?.longitude ?? '',
    latitude: props.hotel?.latitude ?? '',

    image_principale: null,
    image_1: null,
    image_2: null,

    localisation: props.hotel?.localisation ?? '',
    pays: props.hotel?.pays ?? ''

})

/* ---------------- PREVIEW IMAGES ---------------- */

const previews = ref({

    image_principale: props.hotel?.image_principale
        ? `/storage/${props.hotel.image_principale}`
        : null,

    image_1: props.hotel?.image_1
        ? `/storage/${props.hotel.image_1}`
        : null,

    image_2: props.hotel?.image_2
        ? `/storage/${props.hotel.image_2}`
        : null

})

const handleImagePreview = (event, field) => {

    const file = event.target.files[0]

    if (!file) return

    form[field] = file

    previews.value[field] = URL.createObjectURL(file)

}

/* ---------------- LEAFLET ---------------- */

onMounted(() => {

    const map = L.map('map').setView(
        [-18.8792, 47.5079],
        13
    )

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            attribution: '&copy; OpenStreetMap contributors'
        }
    ).addTo(map)

    let marker = null

    map.on('click', async (e) => {

        const lat = e.latlng.lat
        const lng = e.latlng.lng

        form.latitude = lat
        form.longitude = lng

        if (marker) {

            map.removeLayer(marker)

        }

        marker = L.marker([lat, lng]).addTo(map)

        const response = await fetch(

            `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`

        )

        const data = await response.json()

        form.localisation =
            data.address.city ||
            data.address.town ||
            data.address.village ||
            ''

        form.pays =
            data.address.country || ''

    })

})

/* ---------------- SUBMIT ---------------- */

const handleSubmit = () => {

    form.post('/user/hotel/create', {

        forceFormData: true,

        onSuccess: () => {

            console.log('success')

        },

        onError: () => {

            console.log('error')

        }

    })

}

</script>

<template>

<div
    class="
        relative
        overflow-hidden
        rounded-[32px]
        border
        border-white/10
        bg-white/5
        backdrop-blur-2xl
        shadow-[0_0_50px_rgba(0,0,0,0.35)]
    "
>

```
<!-- BACKGROUND -->

<div class="absolute inset-0 pointer-events-none">

    <div
        class="
            absolute
            -top-24
            -right-20
            w-[320px]
            h-[320px]
            rounded-full
            bg-cyan-500/10
            blur-[120px]
        "
    ></div>

    <div
        class="
            absolute
            bottom-0
            left-0
            w-[260px]
            h-[260px]
            rounded-full
            bg-blue-700/10
            blur-[120px]
        "
    ></div>

</div>

<!-- HEADER -->

<div
    class="
        relative
        z-10
        border-b
        border-white/10
        bg-white/5
        px-6
        py-6
        md:px-8
    "
>

    <h1
        class="
            text-3xl
            font-bold
            text-white
        "
    >
        Création Hôtel
    </h1>

    <p
        class="
            mt-2
            text-slate-300
        "
    >
        Ajouter un nouvel établissement à la plateforme
    </p>

</div>

<!-- FORM -->

<form
    class="
        relative
        z-10
        space-y-8
        p-6
        md:p-8
    "
    @submit.prevent="handleSubmit"
    enctype="multipart/form-data"
>

    <!-- TITRE -->

    <div>

        <label
            class="
                mb-3
                block
                font-medium
                text-slate-200
            "
        >
            Titre
        </label>

        <input
            v-model="form.nom"
            type="text"
            placeholder="Ex: Hôtel moderne à Nosy Be"
            class="
                w-full
                rounded-2xl
                border
                border-white/10
                bg-white/5
                px-5
                py-4
                text-white
                placeholder:text-slate-400
                backdrop-blur-lg
                transition-all
                duration-300
                focus:border-cyan-400/40
                focus:bg-white/10
                focus:outline-none
                focus:ring-2
                focus:ring-cyan-400/20
            "
        />

    </div>

    <!-- IMAGES -->

    <div>

        <label
            class="
                mb-4
                block
                font-medium
                text-slate-200
            "
        >
            Images du logement
        </label>

        <div
            class="
                grid
                grid-cols-1
                md:grid-cols-3
                gap-5
            "
        >

            <!-- IMAGE PRINCIPALE -->

            <label
                class="
                    group
                    relative
                    overflow-hidden
                    flex
                    min-h-[260px]
                    cursor-pointer
                    flex-col
                    items-center
                    justify-center
                    rounded-3xl
                    border
                    border-dashed
                    border-white/15
                    bg-white/5
                    transition-all
                    duration-300
                    hover:border-cyan-400/40
                    hover:bg-white/10
                "
            >

                <img
                    v-if="previews.image_principale"
                    :src="previews.image_principale"
                    class="
                        absolute
                        inset-0
                        h-full
                        w-full
                        object-cover
                    "
                >

                <div
                    class="
                        absolute
                        inset-0
                        bg-gradient-to-t
                        from-black/70
                        via-black/20
                        to-transparent
                    "
                ></div>

                <div
                    class="
                        relative
                        z-10
                        text-center
                    "
                >

                    <div class="text-5xl mb-4">
                        🏨
                    </div>

                    <p class="text-white font-medium">
                        Image principale
                    </p>

                </div>

                <input
                    hidden
                    type="file"
                    accept="image/*"
                    @change="handleImagePreview($event, 'image_principale')"
                />

            </label>

            <!-- IMAGE 1 -->

            <label
                class="
                    group
                    relative
                    overflow-hidden
                    flex
                    min-h-[260px]
                    cursor-pointer
                    flex-col
                    items-center
                    justify-center
                    rounded-3xl
                    border
                    border-dashed
                    border-white/15
                    bg-white/5
                    transition-all
                    duration-300
                    hover:border-cyan-400/40
                    hover:bg-white/10
                "
            >

                <img
                    v-if="previews.image_1"
                    :src="previews.image_1"
                    class="
                        absolute
                        inset-0
                        h-full
                        w-full
                        object-cover
                    "
                >

                <div
                    class="
                        absolute
                        inset-0
                        bg-gradient-to-t
                        from-black/70
                        via-black/20
                        to-transparent
                    "
                ></div>

                <div
                    class="
                        relative
                        z-10
                        text-center
                    "
                >

                    <div class="text-5xl mb-4">
                        📸
                    </div>

                    <p class="text-white font-medium">
                        Galerie 1
                    </p>

                </div>

                <input
                    hidden
                    type="file"
                    accept="image/*"
                    @change="handleImagePreview($event, 'image_1')"
                />

            </label>

            <!-- IMAGE 2 -->

            <label
                class="
                    group
                    relative
                    overflow-hidden
                    flex
                    min-h-[260px]
                    cursor-pointer
                    flex-col
                    items-center
                    justify-center
                    rounded-3xl
                    border
                    border-dashed
                    border-white/15
                    bg-white/5
                    transition-all
                    duration-300
                    hover:border-cyan-400/40
                    hover:bg-white/10
                "
            >

                <img
                    v-if="previews.image_2"
                    :src="previews.image_2"
                    class="
                        absolute
                        inset-0
                        h-full
                        w-full
                        object-cover
                    "
                >

                <div
                    class="
                        absolute
                        inset-0
                        bg-gradient-to-t
                        from-black/70
                        via-black/20
                        to-transparent
                    "
                ></div>

                <div
                    class="
                        relative
                        z-10
                        text-center
                    "
                >

                    <div class="text-5xl mb-4">
                        🌍
                    </div>

                    <p class="text-white font-medium">
                        Galerie 2
                    </p>

                </div>

                <input
                    hidden
                    type="file"
                    accept="image/*"
                    @change="handleImagePreview($event, 'image_2')"
                />

            </label>

        </div>

    </div>

    <!-- DESCRIPTION -->

    <div>

        <label
            class="
                mb-3
                block
                font-medium
                text-slate-200
            "
        >
            Description
        </label>

        <textarea
            v-model="form.description"
            rows="6"
            placeholder="Décrivez le logement..."
            class="
                w-full
                resize-none
                rounded-2xl
                border
                border-white/10
                bg-white/5
                px-5
                py-4
                text-white
                placeholder:text-slate-400
                backdrop-blur-lg
                transition-all
                duration-300
                focus:border-cyan-400/40
                focus:bg-white/10
                focus:outline-none
                focus:ring-2
                focus:ring-cyan-400/20
            "
        ></textarea>

    </div>

    <!-- MAP -->

    <div
        id="map"
        class="
            h-[350px]
            overflow-hidden
            rounded-3xl
            border
            border-white/10
        "
    ></div>

    <!-- INFOS -->

    <div
        class="
            grid
            grid-cols-1
            md:grid-cols-2
            gap-6
        "
    >

        <input
            v-model="form.localisation"
            type="text"
            placeholder="Localisation"
            class="
                w-full
                rounded-2xl
                border
                border-white/10
                bg-white/5
                px-5
                py-4
                text-white
                placeholder:text-slate-400
            "
        />

        <input
            v-model="form.pays"
            type="text"
            placeholder="Pays"
            class="
                w-full
                rounded-2xl
                border
                border-white/10
                bg-white/5
                px-5
                py-4
                text-white
                placeholder:text-slate-400
            "
        />

    </div>

    <!-- LAT LNG -->

    <div
        class="
            grid
            grid-cols-1
            md:grid-cols-2
            gap-6
        "
    >

        <input
            v-model="form.latitude"
            type="text"
            placeholder="Latitude"
            class="
                w-full
                rounded-2xl
                border
                border-white/10
                bg-white/5
                px-5
                py-4
                text-white
            "
        />

        <input
            v-model="form.longitude"
            type="text"
            placeholder="Longitude"
            class="
                w-full
                rounded-2xl
                border
                border-white/10
                bg-white/5
                px-5
                py-4
                text-white
            "
        />

    </div>

    <!-- BUTTONS -->

    <div
        class="
            flex
            flex-col
            sm:flex-row
            sm:justify-end
            gap-4
            pt-4
        "
    >

        <button
            type="reset"
            class="
                rounded-2xl
                border
                border-white/10
                bg-white/5
                px-6
                py-4
                text-white
                transition-all
                duration-300
                hover:bg-white/10
            "
        >
            Annuler
        </button>

        <button
            type="submit"
            class="
                rounded-2xl
                bg-gradient-to-r
                from-cyan-500
                to-blue-600
                px-6
                py-4
                font-semibold
                text-white
                shadow-[0_0_25px_rgba(34,211,238,0.35)]
                transition-all
                duration-300
                hover:scale-[1.02]
            "
        >
            Enregistrer
        </button>

    </div>

</form>

</div>

</template>

