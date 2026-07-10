<script setup>

import { useForm } from '@inertiajs/vue3'
import { defineProps,ref } from 'vue'


const props = defineProps([

    'pays',
    'service'
])
const form = useForm({

    title: '',
    description: '',
    prix: '',
    max_pers: '',
    pays_id: props.pays?.pays?? '',
    image: null

})

// -----------Previsualisation Image
const previews = ref({

    image: props.service?.image
        ? `/storage/${props.service.image}`
        : null,

})

const handleImagePreview = (event, field) => {

    const file = event.target.files[0]

    if (!file) return

    form[field] = file

    previews.value[field] = URL.createObjectURL(file)

}


// ----------------------------------

const handleSubmit = () => {

    form.post('/user/prestataire/services/store', {

        forceFormData: true,

        onError: (errors) => {

            console.log(errors)

        },

        onSuccess: () => {

        }
    })
}

</script>

<template>

<div
    class="
        relative
        overflow-hidden
        backdrop-blur-2xl
        shadow-[0_0_50px_rgba(0,0,0,0.35)]
    "
>

    <!-- Background -->

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
                w-[250px]
                h-[250px]
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
            px-8
            py-6
        "
    >

        <h1 class="text-3xl font-bold text-white">
            Ajouter un service
        </h1>

        <p class="mt-2 text-slate-300">
            Décrivez votre prestation afin qu'elle soit visible par les voyageurs.
        </p>

    </div>

    <!-- FORM -->

    <form
        @submit.prevent="handleSubmit"
        class="
            relative
            z-10
            space-y-7
            p-8
        "
    >

        <!-- TITRE -->

        <div>

            <label class="mb-3 block font-medium text-slate-200">
                Titre
            </label>

            <input
                v-model="form.title"
                name = "title"
                type="text"
                placeholder="Ex : Excursion en Quad"
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
                    transition
                    focus:border-cyan-400/40
                    focus:ring-2
                    focus:ring-cyan-400/20
                    focus:outline-none
                "
            >

        </div>

        <!-- DESCRIPTION -->

        <div>

            <label class="mb-3 block font-medium text-slate-200">
                Description
            </label>

            <textarea
                v-model="form.description"
                name="description"
                rows="6"
                placeholder="Décrivez votre service..."
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
                    transition
                    focus:border-cyan-400/40
                    focus:ring-2
                    focus:ring-cyan-400/20
                    focus:outline-none
                "
            ></textarea>

        </div>

        <!-- PRIX + PERSONNES -->

        <div class="grid md:grid-cols-2 gap-6">

            <div>

                <label class="mb-3 block font-medium text-slate-200">
                    Prix (Ar)
                </label>

                <input
                    v-model="form.prix"
                    name="prix"
                    type="number"
                    placeholder="50000"
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
                        transition
                        focus:border-cyan-400/40
                        focus:ring-2
                        focus:ring-cyan-400/20
                        focus:outline-none
                    "
                >

            </div>

            <div>

                <label class="mb-3 block font-medium text-slate-200">
                    Nombre maximum de personnes
                </label>

                <input
                    v-model="form.max_pers"
                    name="max_pers"
                    type="number"
                    min="1"
                    placeholder="10"
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
                        transition
                        focus:border-cyan-400/40
                        focus:ring-2
                        focus:ring-cyan-400/20
                        focus:outline-none
                    "
                >

            </div>

        </div>

        <!-- PAYS -->

        <div>

            <label class="mb-3 block font-medium text-slate-200">
                Pays
            </label>

            <select
                v-model="form.pays_id"
                name="pays_id"
                class="
                    w-full
                    rounded-2xl
                    border
                    border-white/10
                    bg-white/5
                    px-5
                    py-4
                    text-white
                    backdrop-blur-lg
                    transition
                    focus:border-cyan-400/40
                    focus:ring-2
                    focus:ring-cyan-400/20
                    focus:outline-none
                "
            >

                <option class="bg-slate-900" value="">
                    Choisir un pays
                </option>

                <option
                    class="bg-slate-900"
                    v-for="p in pays"
                    :key="p.id"
                    :value="p.id"
                >
                    {{ p.pays }}
                </option>

            </select>

        </div>

        <!-- IMAGE -->

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
                v-if="previews.image"
                :src="previews.image"
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

            <div class="relative z-10 text-center">

                <div class="text-5xl mb-4">
                    🏕️
                </div>

                <p class="text-white font-medium">
                    Image du service
                </p>

            </div>

            <input
                name="image"
                hidden
                type="file"
                accept="image/*"
                @change="handleImagePreview($event,'image')"
            >

        </label>

        <!-- ACTIONS -->

        <div
            class="
                flex
                justify-end
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
                    font-medium
                    text-white
                    transition
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
                    px-8
                    py-4
                    font-semibold
                    text-white
                    shadow-[0_0_25px_rgba(34,211,238,0.35)]
                    transition-all
                    duration-300
                    hover:scale-[1.02]
                    hover:shadow-[0_0_40px_rgba(34,211,238,0.45)]
                "
            >
                Ajouter le service
            </button>

        </div>

    </form>

</div>

</template>