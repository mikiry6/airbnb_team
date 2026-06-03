<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { login, register } from '@/routes';
import { ref, onMounted } from 'vue';

import Globe from '@/components/3D/Globe.vue';


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
            <div
                class="max-w-7xl mx-auto px-6 py-5"
            >

                <nav
                    class="flex items-center justify-between"
                >

                    <!-- LOGO -->

                    <Link
                        href="/"
                        class="text-2xl font-bold text-white"
                    >
                        StayFinder
                    </Link>

                    <!-- MENU -->

                    <div
                        class="hidden md:flex items-center gap-8 text-slate-200"
                    >

                        <a
                            href="#"
                            class="hover:text-white transition"
                        >
                            Hébergements
                        </a>

                        <a
                            href="#"
                            class="hover:text-white transition"
                        >
                            Activités
                        </a>

                        <a
                            href="#"
                            class="hover:text-white transition"
                        >
                            Destinations
                        </a>

                        <a
                            href="#"
                            class="hover:text-white transition"
                        >
                            À propos
                        </a>

                    </div>

                    <!-- AUTH -->

                    <div
                        class="flex items-center gap-3"
                    >

                        <Link
                            v-if="$page.props.auth.user"
                            href="/user"
                            class="px-5 py-2 rounded-xl bg-white text-slate-900 font-medium hover:bg-slate-100 transition"
                        >
                            Dashboard
                        </Link>

                        <template v-else>

                            <Link
                                :href="login()"
                                class="text-slate-200 hover:text-white transition"
                            >
                                Connexion
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="register()"
                                class="px-5 py-2 rounded-xl bg-white text-slate-900 font-medium hover:bg-slate-100 transition"
                            >
                                Inscription
                            </Link>

                        </template>

                    </div>

                </nav>

            </div>
        </header>
        <!-- HERO -->

        <!-- HERO -->

        <section
            class="relative min-h-screen overflow-hidden bg-gradient-to-b from-slate-900 to-slate-800 text-white"
        >

            <!-- GLOBE EN ARRIÈRE PLAN -->

            <div
                class="absolute inset-0 translate-x-[20%]"
            >
                <Globe />
            </div>
            
            <!-- ----Halo Effect -->
            <div
                class="
                    absolute
                    top-1/2
                    right-0
                    -translate-y-1/2
                    w-[800px]
                    h-[800px]
                    rounded-full
                    bg-blue-500/20
                    blur-3xl
                "
            ></div>

            <!-- OVERLAY SOMBRE -->

            <div
                class="absolute inset-0 bg-slate-900/60"
            ></div>

            <!-- EFFET LUMIÈRE -->

            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(59,130,246,0.20),transparent_60%)]"
            ></div>

            <!-- CONTENU -->

            <div
                class="relative z-10 max-w-7xl mx-auto px-6 min-h-screen flex items-center"
            >

                <div
                    class="max-w-3xl"
                >

                    <h1
                        class="text-5xl lg:text-7xl font-bold leading-tight"
                    >
                        Trouvez votre prochaine destination
                    </h1>

                    <p
                        class="mt-6 text-xl text-slate-300"
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

                    <div
                        class="flex gap-8 mt-10 text-slate-300"
                    >

                        <div>

                            <span
                                class="text-2xl font-bold text-white"
                            >
                                2 500+
                            </span>

                            <p
                                class="text-sm"
                            >
                                Logements
                            </p>

                        </div>

                        <div>

                            <span
                                class="text-2xl font-bold text-white"
                            >
                                120+
                            </span>

                            <p
                                class="text-sm"
                            >
                                Destinations
                            </p>

                        </div>

                        <div>

                            <span
                                class="text-2xl font-bold text-white"
                            >
                                500+
                            </span>

                            <p
                                class="text-sm"
                            >
                                Activités
                            </p>

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

        <!-- LOGEMENTS POPULAIRES -->

        <section
            class="max-w-7xl mx-auto px-6 py-16"
        >

            <div
                class="flex justify-between items-center mb-8"
            >

                <h2
                    class="text-3xl font-bold"
                >
                    Hébergements populaires
                </h2>

            </div>

            <div
                class="grid md:grid-cols-2 lg:grid-cols-4 gap-6"
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

        <footer
            class="relative overflow-hidden bg-slate-900 text-slate-300 mt-16"
        >

            <!-- HALO -->

            <div
                class="
                    absolute
                    bottom-0
                    left-1/2
                    -translate-x-1/2
                    w-[600px]
                    h-[600px]
                    rounded-full
                    bg-blue-500/10
                    blur-3xl
                "
            ></div>

            <div
                class="relative max-w-7xl mx-auto px-6 py-16"
            >

                <div
                    class="grid md:grid-cols-4 gap-10"
                >

                    <!-- LOGO -->

                    <div>

                        <h3
                            class="text-2xl font-bold text-white"
                        >
                            StayFinder
                        </h3>

                        <p
                            class="mt-4 text-slate-400 leading-relaxed"
                        >
                            Découvrez des hébergements uniques,
                            des expériences locales et les meilleures
                            destinations partout dans le monde.
                        </p>

                    </div>

                    <!-- EXPLORER -->

                    <div>

                        <h4
                            class="font-semibold text-white mb-4"
                        >
                            Explorer
                        </h4>

                        <ul
                            class="space-y-3"
                        >

                            <li>
                                <a
                                    href="#"
                                    class="hover:text-white transition"
                                >
                                    Hébergements
                                </a>
                            </li>

                            <li>
                                <a
                                    href="#"
                                    class="hover:text-white transition"
                                >
                                    Activités
                                </a>
                            </li>

                            <li>
                                <a
                                    href="#"
                                    class="hover:text-white transition"
                                >
                                    Destinations
                                </a>
                            </li>

                        </ul>

                    </div>

                    <!-- ENTREPRISE -->

                    <div>

                        <h4
                            class="font-semibold text-white mb-4"
                        >
                            Entreprise
                        </h4>

                        <ul
                            class="space-y-3"
                        >

                            <li>
                                <a
                                    href="#"
                                    class="hover:text-white transition"
                                >
                                    À propos
                                </a>
                            </li>

                            <li>
                                <a
                                    href="#"
                                    class="hover:text-white transition"
                                >
                                    Contact
                                </a>
                            </li>

                            <li>
                                <a
                                    href="#"
                                    class="hover:text-white transition"
                                >
                                    Blog
                                </a>
                            </li>

                        </ul>

                    </div>

                    <!-- NEWSLETTER -->

                    <div>

                        <h4
                            class="font-semibold text-white mb-4"
                        >
                            Newsletter
                        </h4>

                        <p
                            class="text-slate-400 mb-4"
                        >
                            Recevez nos meilleures offres de voyage.
                        </p>

                        <div
                            class="flex"
                        >

                            <input
                                type="email"
                                placeholder="Votre email"
                                class="
                                    flex-1
                                    px-4
                                    py-3
                                    rounded-l-xl
                                    bg-slate-800
                                    border
                                    border-slate-700
                                    text-white
                                    outline-none
                                "
                            >

                            <button
                                class="
                                    px-5
                                    bg-blue-600
                                    hover:bg-blue-700
                                    rounded-r-xl
                                    transition
                                "
                            >
                                OK
                            </button>

                        </div>

                    </div>

                </div>

                <!-- SEPARATEUR -->

                <div
                    class="border-t border-slate-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center gap-4"
                >

                    <p
                        class="text-sm text-slate-500"
                    >
                        © 2026 StayFinder. Tous droits réservés.
                    </p>

                    <div
                        class="flex gap-6 text-sm"
                    >

                        <a
                            href="#"
                            class="hover:text-white transition"
                        >
                            Conditions
                        </a>

                        <a
                            href="#"
                            class="hover:text-white transition"
                        >
                            Confidentialité
                        </a>

                        <a
                            href="#"
                            class="hover:text-white transition"
                        >
                            Cookies
                        </a>

                    </div>

                </div>

            </div>

        </footer>

    </div>
    
</template>



