<script setup>

import { useForm } from '@inertiajs/vue3'
import Swal from 'sweetalert2'
import { defineProps } from 'vue'


const props = defineProps([
    'pays'
])
const form = useForm({

    title: '',
    description: '',
    country: '',
    image: null
    // latitude: '',
    // longitude: ''
})

const handleSubmit = () => {

    form.post('/services/store', {

        forceFormData: true,

        onSuccess: () => {

            Swal.fire({

                title: 'Succès',
                text: 'Le service a été ajouté avec succès.',
                icon: 'success',
                confirmButtonText: 'OK'
            })

            form.reset()
        }
    })
}

</script>

<template>

<div class="max-w-3xl mx-auto p-8">

    <h1 class="text-3xl font-bold mb-8">
        Ajouter un service
    </h1>

    <form
        @submit.prevent="handleSubmit"
        class="space-y-5"
    >

        <input
            v-model="form.title"
            type="text"
            placeholder="Titre"
            class="w-full border p-3 rounded-xl"
        >

        <textarea
            v-model="form.description"
            placeholder="Description"
            class="w-full border p-3 rounded-xl"
        ></textarea>

        <select
            v-model="form.country"
            name="country"
            class="w-full border p-3 rounded-xl"
        >
            <option value="">Choisir un pays</option>
            <option
             v-for=" p in pays"
             :value="p.id"
            >
                {{ p.nom }}
            </option>
        </select>

        <input
            type="file"
            @change="form.image = $event.target.files[0]"
            class="w-full"
        >

        <button
            type="submit"
            class="bg-[#36465c] text-white px-6 py-3 rounded-xl"
        >
            Ajouter
        </button>

    </form>

</div>

</template>