<script setup>

    import { defineProps } from 'vue';
    import { router } from '@inertiajs/vue3';

    const props = defineProps([

        'chambres'

    ]);

    const destroy = (chambre_id)=>{

         if (confirm('Supprimer cette chambre ?')) {
            router.delete(`/user/hotel/${chambre_id}/chambre/delete`)
        }

    }

    // console.log(props.chambres);

</script>

<template>

    <h1 class="text-center text-white text-2xl">Liste des chambres</h1>

    <!-- ---------Listage -->

    <table>
        <thead class="w-full">

            <tr>
                <td>image</td>
                <td>titre</td>
                <td>Is Free</td>
                <td>Options</td>
            </tr>

        </thead>
        <tbody>
            <tr
                v-for="chambre in chambres"
             >
                <td>
                    <img 
                        class="w-20 h-15 object-cover"
                        :src="'/storage/'+chambre.image_logement.image_principale" alt=""
                    >

                </td>
                <td>{{ chambre.titre }}</td>
                <td>{{ chambre.is_free }}</td>
                <td class="space-x-2">

                    <button class="btn_primary text-white ">Voir Plus</button>


                    <button 
                        @click="destroy(chambre.id)"
                        class="btn_danger text-white"
                    >
                        Supprimer
                    </button>
                    
                </td>
            </tr>
        </tbody>
    </table>
</template>