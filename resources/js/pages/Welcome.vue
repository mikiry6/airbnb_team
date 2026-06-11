<script setup lang="ts">

import { ref, onMounted } from 'vue';

import Globe from '@/components/3D/Globe.vue';
import Navbar from '@/components/Layout/Navbar.vue';
import Footer from '@/components/Layout/Footer.vue';

interface Pays {
    id: number;
    pays: string;
    latitude: number;
    longitude: number;
}

const props = withDefaults(
    defineProps<{
        canRegister: boolean;
        pays: Pays[];
    }>(),
    {
        canRegister: true,
    },
);
// console.log(props.pays);
console.log(props.pays)
const search = ref('')

const categories = [

    {
        id: 1,
        nom: 'Hôtels',
        icon: '🏨'
    },

    {
        id: 2,
        nom: 'Villas',
        icon: '🏡'
    },

    {
        id: 3,
        nom: 'Chambres',
        icon: '🛏️'
    },

    {
        id: 4,
        nom: 'Activités',
        icon: '🌊'
    }

]

const logementsPopulaires = [
    {},
    {},
    {},
    {}
]

const activitesPopulaires = [
    {},
    {},
    {},
    {}
]


</script>

<template>
    
    <div class="min-h-screen bg-slate-50">

        <header
            class="absolute top-0 left-0 w-full z-50"
        >
            <Navbar/>
        </header>
        <!-- HERO -->

        <section
            class="relative min-h-screen overflow-hidden bg-gradient-to-b from-slate-900 to-slate-800 text-white"
        >

            <!-- EFFET LUMIÈRE GLOBAL -->

            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(59,130,246,0.15),transparent_60%)]"
            ></div>

            <div
                class="relative z-10 max-w-7xl mx-auto px-6 min-h-screen flex items-center py-24"
            >

                <div
                    class="
                        grid
                        grid-cols-1
                        lg:grid-cols-[35%_65%]
                        gap-10
                        items-center
                        w-full
                    "
                >

                    <!-- TEXTE -->

                    <div
                        class="max-w-2xl"
                    >

                        <h1
                            class="text-4xl md:text-5xl lg:text-7xl font-bold leading-tight"
                        >
                            Trouvez votre prochaine destination
                        </h1>

                        <p
                            class="mt-6 text-lg md:text-xl text-slate-300"
                        >
                            Réservez des hôtels, villas, chambres et découvrez
                            des activités uniques partout dans le monde.
                        </p>

                        <!-- RECHERCHE -->

                        <div
                            class="mt-8 bg-white rounded-2xl p-3 flex flex-col sm:flex-row gap-3 shadow-2xl"
                        >

                            <input
                                v-model="search"
                                type="text"
                                placeholder="Ville, pays, activité..."
                                class="flex-1 px-4 py-3 text-black outline-none rounded-xl"
                            >

                            <button
                                class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 transition whitespace-nowrap"
                            >
                                Rechercher
                            </button>

                        </div>

                        <!-- STATS -->

                    </div>

                    <!-- GLOBE -->

                    <div
                        class="
                            relative
                            h-[400px]
                            md:h-[550px]
                            lg:h-[650px]
                            flex
                            items-center
                            justify-center
                        "
                    >

                        <!-- HALO -->

                        <div
                            class="
                                absolute
                                w-[400px]
                                h-[400px]
                                md:w-[600px]
                                md:h-[600px]
                                lg:w-[900px]
                                lg:h-[900px]
                                rounded-full
                                bg-blue-500/20
                                blur-[120px]
                            "
                        ></div>

                        <!-- GLOBE -->

                        <div
                            class="
                                relative
                                z-10
                                w-full
                                h-full
                                scale-100
                                lg:scale-110
                            "
                            
                        >
                            <Globe 
                               
                                :pays = "props.pays"
                            />
                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- CATEGORIES -->

        <section
            class="max-w-7xl mx-auto px-6 py-16"
        >

            <h2
                class="text-3xl font-bold mb-8"
            >
                Explorer
            </h2>

            <div
                class="grid grid-cols-2 md:grid-cols-4 gap-6"
            >

                <div
                    v-for="categorie in categories"
                    :key="categorie.id"
                    class="
                        bg-white
                        rounded-2xl
                        p-6
                        border
                        shadow-sm
                        hover:-translate-y-1
                        hover:shadow-xl
                        transition-all
                        duration-300
                        cursor-pointer
                    "
                >

                    <div
                        class="text-4xl"
                    >
                        {{ categorie.icon }}
                    </div>

                    <div
                        class="mt-4 font-semibold"
                    >
                        {{ categorie.nom }}
                    </div>

                </div>

            </div>

        </section>

        <!-- PAYS POPULAIRES -->

        <section
            class="max-w-7xl mx-auto px-6 py-16"
        >

            <!-- PAYS -->
            <div
                class="flex justify-between items-center mb-8"
            >

                <h2
                    class="text-3xl font-bold"
                >
                    Pays 
                </h2>

            </div>

            <div
                class=" mb-10g grid md:grid-cols-2 lg:grid-cols-4 gap-6"
            >

                <div
                    v-for="(item,index) in logementsPopulaires"
                    :key="index"
                    class="bg-white rounded-2xl overflow-hidden shadow-sm"
                >

                    <div
                        class="h-52 bg-slate-200"
                    ></div>

                    <div
                        class="p-4"
                    >

                        <h3
                            class="font-semibold"
                        >
                            Nom du logement
                        </h3>

                        <p
                            class="text-sm text-slate-500"
                        >
                            Ville
                        </p>

                        <div
                            class="mt-3 font-bold"
                        >
                            120 € / nuit
                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- ACTIVITES -->

        <section
            class="bg-white py-16"
        >

            <div
                class="max-w-7xl mx-auto px-6"
            >

                <h2
                    class="text-3xl font-bold mb-8"
                >
                    Activités à découvrir
                </h2>

                <div
                    class="grid md:grid-cols-2 lg:grid-cols-4 gap-6"
                >

                    <div
                        v-for="(item,index) in activitesPopulaires"
                        :key="index"
                        class="rounded-2xl overflow-hidden shadow-sm border"
                    >

                        <div
                            class="h-52 bg-slate-200"
                        ></div>

                        <div
                            class="p-4"
                        >

                            <h3
                                class="font-semibold"
                            >
                                Activité
                            </h3>

                            <p
                                class="text-sm text-slate-500"
                            >
                                Description
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- POURQUOI NOUS -->

        <section
        class="max-w-7xl mx-auto px-6 py-16"
    >

        <h2
            class="text-3xl font-bold text-center mb-12"
        >
            Pourquoi nous choisir ?
        </h2>

        <div
            class="grid md:grid-cols-3 gap-8"
        >

            <div
                class="bg-white rounded-2xl p-8 text-center shadow-sm"
            >

                <div class="text-5xl">
                    🌍
                </div>

                <h3
                    class="font-bold mt-4"
                >
                    Recherche mondiale
                </h3>

            </div>

            <div
                class="bg-white rounded-2xl p-8 text-center shadow-sm"
            >

                <div class="text-5xl">
                    🏡
                </div>

                <h3
                    class="font-bold mt-4"
                >
                    Hébergements variés
                </h3>

            </div>

            <div
                class="bg-white rounded-2xl p-8 text-center shadow-sm"
            >

                <div class="text-5xl">
                    🎯
                </div>

                <h3
                    class="font-bold mt-4"
                >
                    Activités locales
                </h3>

            </div>

        </div>

        </section>

        <!-- FOOTER -->
         <Footer/>

    </div>
    
</template>



