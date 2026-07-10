<script setup >

    import { Link } from '@inertiajs/vue3';
    import { defineProps } from 'vue';
    import { router } from '@inertiajs/vue3';

    const destroy = (id) => {

        if (confirm('Supprimer cet hôtel ?')) {
            router.delete(`/user/hotel/delete/${id}`)
        }

    }

    const props = defineProps([

        'hotels'
        // hotels:Object

    ])

</script>

<template>

    <div class="space-y-10">

        <!-- HEADER -->

        <div
            class="
                flex
                flex-col
                md:flex-row
                md:items-center
                md:justify-between
                gap-6
            "
        >

            <div>

                <h1
                    class="
                        text-4xl
                        font-bold
                        bg-gradient-to-r
                        from-cyan-300
                        to-blue-500
                        bg-clip-text
                        text-transparent
                    "
                >
                    Mes Hôtels
                </h1>

                <p
                    class="
                        text-slate-400
                        mt-2
                    "
                >
                    Gérez vos établissements et vos logements
                </p>

            </div>

            <!-- BUTTON -->

            <Link
                href="/user/hotel/create"
                class="
                    inline-flex
                    items-center
                    justify-center
                    gap-2
                    rounded-2xl
                    px-6
                    py-3
                    text-sm
                    font-semibold
                    text-white
                    bg-gradient-to-r
                    from-cyan-500
                    to-blue-600
                    hover:from-cyan-400
                    hover:to-blue-500
                    transition-all
                    duration-300
                    shadow-[0_0_25px_rgba(34,211,238,0.35)]
                "
            >

                <span class="text-lg">+</span>

                Ajouter un hôtel

            </Link>

        </div>

        <!-- GRID -->

        <div
            class="
                grid
                grid-cols-1
                md:grid-cols-2
                xl:grid-cols-3
                gap-8
            "
        >

            <!-- CARD -->

            <div
                v-for="hotel in hotels"
                :key="hotel.id"
                class="
                    group
                    relative
                    overflow-hidden
                    rounded-3xl
                    border
                    border-white/10
                    bg-white/5
                    backdrop-blur-2xl
                    shadow-[0_0_30px_rgba(0,0,0,0.25)]
                    transition-all
                    duration-500
                    hover:-translate-y-2
                    hover:border-cyan-400/30
                    hover:shadow-[0_0_45px_rgba(34,211,238,0.12)]
                "
            >

                <!-- IMAGE -->

                <div
                    class="
                        relative
                        h-56
                        overflow-hidden
                    "
                >

                    <img
                        :src="'/storage/' + hotel.image_principale"
                        alt="Hotel"
                        class="
                            w-full
                            h-full
                            object-cover
                            transition-transform
                            duration-700
                            group-hover:scale-110
                        "
                    >

                    <!-- OVERLAY -->

                    <div
                        class="
                            absolute
                            inset-0
                            bg-gradient-to-t
                            from-slate-950/90
                            via-slate-900/20
                            to-transparent
                        "
                    ></div>

                    <!-- BADGE -->

                    <div
                        class="
                            absolute
                            top-4
                            right-4
                            px-3
                            py-1
                            rounded-full
                            text-xs
                            font-semibold
                            bg-cyan-500/15
                            border
                            border-cyan-400/20
                            text-cyan-300
                            backdrop-blur-md
                        "
                    >
                        Hôtel
                    </div>

                </div>

                <!-- CONTENT -->

                <div class="p-6 space-y-5">

                    <!-- TITLE -->

                    <div>

                        <h2
                            class="
                                text-2xl
                                font-bold
                                text-white
                            "
                        >
                            {{ hotel.nom }}
                        </h2>

                        <div
                            class="
                                h-[2px]
                                w-14
                                mt-3
                                rounded-full
                                bg-gradient-to-r
                                from-cyan-400
                                to-blue-500
                            "
                        ></div>

                    </div>

                    <!-- DESCRIPTION -->

                    <p
                        class="
                            text-slate-400
                            leading-relaxed
                            line-clamp-3
                        "
                    >
                        Magnifique établissement moderne avec prestations haut de gamme,
                        localisation idéale et expérience premium pour les voyageurs.
                    </p>

                    <!-- ACTIONS -->

                    <div
                        class="
                            flex
                            flex-col
                            sm:flex-row
                            gap-3
                            pt-2
                        "
                    >

                        <!-- DETAIL -->

                        <Link
                            :href="`/user/hotel/show/${hotel.id}`"
                            class="
                                flex-1
                                text-center
                                rounded-2xl
                                px-4
                                py-3
                                text-sm
                                font-semibold
                                text-white
                                bg-gradient-to-r
                                from-cyan-500
                                to-blue-600
                                hover:from-cyan-400
                                hover:to-blue-500
                                transition-all
                                duration-300
                                shadow-[0_0_18px_rgba(34,211,238,0.25)]
                            "
                        >
                            Voir plus
                        </Link>

                        <!-- EDIT -->

                        <Link
                            href="/"
                            class="
                                flex-1
                                text-center
                                rounded-2xl
                                px-4
                                py-3
                                text-sm
                                font-semibold
                                border
                                border-white/10
                                bg-white/5
                                text-slate-200
                                hover:bg-white/10
                                hover:border-cyan-400/20
                                transition-all
                                duration-300
                            "
                        >
                            Modifier
                        </Link>

                        <!-- DELETE -->

                        <button
                            @click="destroy(hotel.id)"
                            class="
                                flex-1
                                cursor-pointer
                                rounded-2xl
                                px-4
                                py-3
                                text-sm
                                font-semibold
                                text-white
                                bg-red-500/80
                                hover:bg-red-500
                                transition-all
                                duration-300
                                shadow-[0_0_15px_rgba(239,68,68,0.25)]
                            "
                        >
                            Supprimer
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</template>
