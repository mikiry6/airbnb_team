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

<template class="min-h-screen bg-slate-950 p-8">

        <!-- HEADER -->

        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-3xl font-bold text-white">
                    Liste des chambres
                </h1>

                <p class="text-slate-400 mt-1">
                    {{ chambres.length }} chambre(s)
                </p>
            </div>

        </div>

        <!-- TABLE -->

        <div
            class="overflow-hidden rounded-3xl
            border border-slate-800
            bg-slate-900/70
            backdrop-blur-md
            shadow-2xl"
        >

            <table class="w-full">

                <thead>

                    <tr
                        class="bg-slate-800/50
                        border-b border-slate-700
                        text-slate-300"
                    >
                        <th class="text-left p-5 font-semibold">
                            Chambre
                        </th>

                        <th class="text-left p-5 font-semibold">
                            Statut
                        </th>

                        <th class="text-right p-5 font-semibold">
                            Actions
                        </th>
                    </tr>

                </thead>

                <tbody>

                    <tr
                        v-for="chambre in chambres"
                        :key="chambre.id"
                        class="border-b border-slate-800
                        hover:bg-slate-800/40
                        transition"
                    >

                        <!-- CHAMBRE -->

                        <td class="p-5">

                            <div class="flex items-center gap-4">

                                <img
                                    :src="'/storage/' + chambre.image_logement.image_principale"
                                    class="w-16 h-16 rounded-xl object-cover"
                                    alt=""
                                >

                                <div>

                                    <h3 class="font-semibold text-white">
                                        {{ chambre.titre }}
                                    </h3>

                                    <p class="text-slate-400 text-sm">
                                        Chambre #{{ chambre.id }}
                                    </p>

                                </div>

                            </div>

                        </td>

                        <!-- STATUS -->

                        <td class="p-5">

                            <span
                                v-if="chambre.is_free"
                                class="px-3 py-1 rounded-full
                                bg-emerald-500/15
                                text-emerald-400
                                text-sm font-medium"
                            >
                                Disponible
                            </span>

                            <span
                                v-else
                                class="px-3 py-1 rounded-full
                                bg-red-500/15
                                text-red-400
                                text-sm font-medium"
                            >
                                Occupée
                            </span>

                        </td>

                        <!-- ACTIONS -->

                        <td class="p-5">

                            <div class="flex justify-end gap-3">

                                <button
                                    class="px-4 py-2 rounded-xl
                                    bg-cyan-600
                                    hover:bg-cyan-500
                                    text-white
                                    font-medium
                                    transition"
                                >
                                    Voir
                                </button>

                                <button
                                    @click="destroy(chambre.id)"
                                    class="px-4 py-2 rounded-xl
                                    bg-red-500/15
                                    border border-red-500/20
                                    text-red-400
                                    hover:bg-red-500
                                    hover:text-white
                                    transition"
                                >
                                    Supprimer
                                </button>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

    </div>
</template>
