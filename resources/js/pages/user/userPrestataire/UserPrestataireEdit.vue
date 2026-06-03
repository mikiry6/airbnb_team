<script setup>

import { useForm } from '@inertiajs/vue3'
import { defineProps } from 'vue';
import Swal from 'sweetalert2'

const props = defineProps({
    service: Object,
    pays: Object
})

// const props = defineProps([

//     'service',
//     'pays'

// ])
// console.log(pays);



const handleUpdate = () => {

    form.put(
        `/services/${props.service.id}`,
        {
            forceFormData: true,

            onSuccess: () => {

                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: 'Service modifié avec succès'
                })
            }
        }
    )
}

const form = useForm({

    title: props.service.title,

    description: props.service.description,

    country: props.service.country,

    image: null
})


</script>

<template>

<div class="p-10">

    <h1 class="text-3xl font-bold mb-8">

        Modifier Service

    </h1>

    <form
        @submit.prevent="handleUpdate"
        class="space-y-5"
    >

        <input
            type="text"
            v-model="form.title"
            class="w-full border p-3 rounded-xl"
        >

        <textarea
            v-model="form.description"
            class="w-full border p-3 rounded-xl"
        ></textarea>

        <select
            v-model="form.country"
            name="country"
            class="w-full border p-3 rounded-xl"
        >
            <option value="">Choisir un pays</option>

            <option
                v-for="p in props.pays"
                :key="p.id"
                :value="p.id"
            >
                {{ p.nom }}
            </option>
        </select>

        <input
            type="file"
            name="image"
            @change="form.image = $event.target.files[0]"
        >

        <button
            class="bg-blue-500 text-white px-6 py-3 rounded-xl"
        >
            Modifier
        </button>

    </form>

</div>

</template>