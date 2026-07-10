```vue
<script setup>
import Footer from '@/components/Layout/Footer.vue';
import Navbar from '@/components/Layout/Navbar.vue';
import { Link } from '@inertiajs/vue3';

import { defineProps } from 'vue';

const props = defineProps([
    'logements'
])
</script>

<template>

    <!-- GLOBAL -->
    <div
        class="
            min-h-screen
            bg-gradient-to-br
            from-slate-950
            via-slate-900
            to-slate-950
            text-white
            relative
            overflow-hidden
        "
    >

        <!-- BACKGROUND GLOW -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">

            <div
                class="
                    absolute
                    top-0
                    left-[-10%]
                    w-[500px]
                    h-[500px]
                    bg-cyan-500/10
                    blur-[140px]
                    rounded-full
                "
            ></div>

            <div
                class="
                    absolute
                    bottom-0
                    right-[-10%]
                    w-[500px]
                    h-[500px]
                    bg-blue-600/10
                    blur-[160px]
                    rounded-full
                "
            ></div>

        </div>

        <!-- NAVBAR -->
        <Navbar/>

        <!-- MAIN -->
        <div
            class="
                relative
                z-10
                max-w-7xl
                mx-auto
                px-4
                mt-20
                md:px-6
                py-10
                grid
                grid-cols-1
                lg:grid-cols-4
                gap-8
            "
        >

            <!-- FILTRES -->
            <aside
                class="
                    lg:sticky
                    lg:top-24
                    h-fit
                    rounded-3xl
                    border
                    border-white/10
                    bg-white/5
                    backdrop-blur-xl
                    p-6
                    shadow-[0_0_40px_rgba(0,0,0,0.25)]
                "
            >

                <h2
                    class="
                        text-2xl
                        font-bold
                        mb-6
                        bg-gradient-to-r
                        from-cyan-400
                        to-blue-500
                        bg-clip-text
                        text-transparent
                    "
                >
                    Filtres
                </h2>

                <div class="space-y-4">

                    <!-- RECHERCHE -->
                    <input
                        type="text"
                        placeholder="Recherche..."
                        class="
                            w-full
                            rounded-2xl
                            border
                            border-white/10
                            bg-white/5
                            px-4
                            py-3
                            text-white
                            placeholder:text-slate-400
                            backdrop-blur-lg
                            focus:outline-none
                            focus:border-cyan-400/40
                            focus:ring-2
                            focus:ring-cyan-400/20
                            transition-all
                        "
                    >

                    <!-- PIECES -->
                    <input
                        type="number"
                        placeholder="Nombre de pièces"
                        class="
                            w-full
                            rounded-2xl
                            border
                            border-white/10
                            bg-white/5
                            px-4
                            py-3
                            text-white
                            placeholder:text-slate-400
                            backdrop-blur-lg
                            focus:outline-none
                            focus:border-cyan-400/40
                            focus:ring-2
                            focus:ring-cyan-400/20
                            transition-all
                        "
                    >

                    <!-- PRIX -->
                    <div class="flex gap-3">

                        <input
                            type="number"
                            placeholder="Prix min"
                            class="
                                w-full
                                rounded-2xl
                                border
                                border-white/10
                                bg-white/5
                                px-4
                                py-3
                                text-white
                                placeholder:text-slate-400
                                backdrop-blur-lg
                                focus:outline-none
                                focus:border-cyan-400/40
                            "
                        >

                        <input
                            type="number"
                            placeholder="Prix max"
                            class="
                                w-full
                                rounded-2xl
                                border
                                border-white/10
                                bg-white/5
                                px-4
                                py-3
                                text-white
                                placeholder:text-slate-400
                                backdrop-blur-lg
                                focus:outline-none
                                focus:border-cyan-400/40
                            "
                        >

                    </div>

                    <!-- ETOILES -->
                    <!-- TYPE -->
                    <select
                        class="
                            w-full
                            rounded-2xl
                            border
                            border-white/10
                            bg-white/5
                            px-4
                            py-3
                            text-white
                            backdrop-blur-lg
                            focus:outline-none
                            focus:border-cyan-400/40
                        "
                    >
                        <option class="bg-slate-900">
                            Type de logement
                        </option>
                    </select>

                    <!-- PAYS -->
                    <select
                        class="
                            w-full
                            rounded-2xl
                            border
                            border-white/10
                            bg-white/5
                            px-4
                            py-3
                            text-white
                            backdrop-blur-lg
                            focus:outline-none
                            focus:border-cyan-400/40
                        "
                    >
                        <option class="bg-slate-900">
                            Pays
                        </option>
                    </select>

                    <!-- BTN -->
                    <button
                        class="
                            w-full
                            py-3
                            rounded-2xl
                            bg-gradient-to-r
                            from-cyan-500
                            to-blue-600
                            font-semibold
                            shadow-lg
                            shadow-cyan-500/20
                            hover:scale-[1.02]
                            hover:shadow-cyan-500/40
                            transition-all
                            duration-300
                        "
                    >
                        Filtrer
                    </button>

                </div>

            </aside>

            <!-- LOGEMENTS -->
            <section class="lg:col-span-3">

                <!-- TITLE -->
                <div
                    class="
                        flex
                        flex-col
                        md:flex-row
                        md:items-center
                        md:justify-between
                        gap-4
                        mb-8
                    "
                >

                    <div>

                        <h1
                            class="
                                text-4xl
                                font-bold
                                bg-gradient-to-r
                                from-cyan-400
                                to-blue-500
                                bg-clip-text
                                text-transparent
                            "
                        >
                            Hébergements
                        </h1>

                        <p class="text-slate-400 mt-2">
                            Découvrez des logements uniques partout dans le monde.
                        </p>

                    </div>

                </div>

                <!-- GRID -->
                <div
                    class="
                        grid
                        grid-cols-1
                        sm:grid-cols-2
                        xl:grid-cols-3
                        gap-6
                    "
                >

                    <div
                        v-for="hebergement in logements"
                        :key="hebergement.type + '-' + hebergement.id"
                        class="
                            group
                            rounded-3xl
                            overflow-hidden
                            border
                            border-white/10
                            bg-white/5
                            backdrop-blur-xl
                            hover:border-cyan-400/30
                            hover:-translate-y-2
                            transition-all
                            duration-500
                            shadow-[0_10px_40px_rgba(0,0,0,0.25)]
                        "
                    >

                        <!-- IMAGE -->
                        <div class="relative overflow-hidden">

                            <img
                                :src="'storage/' + hebergement.image"
                                :alt="'image ' + hebergement.nom"
                                class="
                                    w-full
                                    h-47.5
                                    object-cover
                                    group-hover:scale-110
                                    transition-transform
                                    duration-700
                                "
                            >

                            <!-- OVERLAY -->
                            <div
                                class="
                                    absolute
                                    inset-0
                                    bg-gradient-to-t
                                    from-black/70
                                    via-transparent
                                    to-transparent
                                "
                            ></div>

                            <!-- TYPE -->
                            <span
                                class="
                                    absolute
                                    top-4
                                    left-4
                                    text-xs
                                    font-semibold
                                    px-3
                                    py-1
                                    rounded-full
                                    backdrop-blur-lg
                                    border
                                "
                                :class="
                                    hebergement.type === 'hotel'
                                    ? 'bg-amber-400/20 text-amber-300 border-amber-400/20'
                                    : 'bg-cyan-400/20 text-cyan-300 border-cyan-400/20'
                                "
                            >
                                {{
                                    hebergement.type === 'hotel'
                                    ? 'Hôtel'
                                    : 'Logement'
                                }}
                            </span>

                        </div>

                        <!-- CONTENT -->
                        <div class="p-5">

                            <h3
                                class="
                                    text-xl
                                    font-bold
                                    text-white
                                    group-hover:text-cyan-300
                                    transition-colors
                                "
                            >
                                {{ hebergement.nom }}
                            </h3>

                            <p
                                class="
                                    text-slate-400
                                    text-sm
                                    mt-2
                                    line-clamp-2
                                "
                            >
                                {{ hebergement.description }}
                            </p>

                            <!-- FOOT -->
                            <div
                                class="
                                    mt-6
                                    flex
                                    items-center
                                    justify-between
                                    gap-3
                                "
                            >

                                <div>

                                    <span
                                        v-if="hebergement.prix"
                                        class="
                                            text-2xl
                                            font-bold
                                            text-cyan-300
                                        "
                                    >
                                        {{ hebergement.prix }} €
                                    </span>

                                    <p
                                        v-if="hebergement.prix"
                                        class="
                                            text-xs
                                            text-slate-500
                                        "
                                    >
                                        par nuit
                                    </p>

                                    <span
                                        v-else
                                        class="
                                            text-amber-300
                                            font-semibold
                                        "
                                    >
                                        Voir les chambres
                                    </span>

                                </div>

                                <!-- BTN -->
                                <Link
                                    v-if="hebergement.type == 'hotel'"
                                    :href="`/logement/hotel/detail/${hebergement.id}`"
                                    class="
                                        px-4
                                        py-2
                                        rounded-xl
                                        bg-white/10
                                        border
                                        border-white/10
                                        hover:bg-cyan-500/20
                                        hover:border-cyan-400/30
                                        hover:text-cyan-300
                                        transition-all
                                        duration-300
                                    "
                                >
                                    Détails
                                </Link>

                                <Link
                                    v-else
                                    :href="`/logement/maison/detail/${hebergement.id}`"
                                    class="
                                        px-4
                                        py-2
                                        rounded-xl
                                        bg-white/10
                                        border
                                        border-white/10
                                        hover:bg-cyan-500/20
                                        hover:border-cyan-400/30
                                        hover:text-cyan-300
                                        transition-all
                                        duration-300
                                    "
                                >
                                    Détails
                                </Link>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </div>

        <!-- FOOTER -->
        <Footer/>

    </div>

</template>
