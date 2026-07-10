
<script setup>

    import { defineProps} from 'vue';

    const props = defineProps([

        services
    ])

</script>

<template>

    <div
        class="
            grid
            gap-8
            md:grid-cols-2
            xl:grid-cols-3
        "
    >

        <div
            v-for="service in services"
            :key="service.id"
            class="
                group
                overflow-hidden
                rounded-3xl
                border
                border-white/10
                bg-white/5
                backdrop-blur-xl
                transition-all
                duration-300
                hover:-translate-y-2
                hover:border-cyan-400/30
                hover:shadow-[0_0_40px_rgba(34,211,238,.15)]
            "
        >

            <!-- IMAGE -->

            <div class="relative h-56 overflow-hidden">

                <img
                    :src="'/storage/' + service.image"
                    class="
                        h-full
                        w-full
                        object-cover
                        duration-500
                        group-hover:scale-110
                    "
                >

                <div
                    class="
                        absolute
                        inset-0
                        bg-gradient-to-t
                        from-slate-950
                        via-transparent
                        to-transparent
                    "
                ></div>

                <!-- Pays -->

                <span
                    class="
                        absolute
                        top-4
                        left-4
                        rounded-full
                        bg-cyan-500/90
                        px-4
                        py-2
                        text-sm
                        font-semibold
                        text-white
                    "
                >
                    {{ service.country.pays }}
                </span>

                <!-- Prix -->

                <span
                    class="
                        absolute
                        bottom-4
                        right-4
                        rounded-full
                        bg-blue-600
                        px-4
                        py-2
                        font-bold
                        text-white
                    "
                >
                    {{ service.prix }} Ar
                </span>

            </div>

            <!-- CONTENT -->

            <div class="space-y-5 p-6">

                <h2
                    class="
                        text-2xl
                        font-bold
                        text-white
                    "
                >
                    {{ service.title }}
                </h2>

                <p
                    class="
                        line-clamp-3
                        text-slate-300
                    "
                >
                    {{ service.description }}
                </p>

                <!-- INFO -->

                <div
                    class="
                        flex
                        items-center
                        justify-between
                        rounded-2xl
                        border
                        border-white/10
                        bg-white/5
                        px-5
                        py-4
                    "
                >

                    <div>

                        <p class="text-xs text-slate-400">
                            Maximum
                        </p>

                        <p class="font-semibold text-white">
                            {{ service.max_pers }} personnes
                        </p>

                    </div>

                    <div>

                        <p class="text-xs text-slate-400">
                            Tarif
                        </p>

                        <p class="font-semibold text-cyan-400">
                            {{ service.prix }} Ar
                        </p>

                    </div>

                </div>

                <!-- BUTTONS -->

                <div
                    class="
                        flex
                        gap-3
                    "
                >

                    <Link
                        :href="`/user/prestataire/services/${service.id}`"
                        class="
                            flex-1
                            rounded-2xl
                            border
                            border-cyan-400/30
                            bg-cyan-500/10
                            py-3
                            text-center
                            font-semibold
                            text-cyan-300
                            transition
                            hover:bg-cyan-500/20
                        "
                    >
                        Voir
                    </Link>

                    <Link
                        :href="`/user/prestataire/services/${service.id}/edit`"
                        class="
                            flex-1
                            rounded-2xl
                            border
                            border-blue-400/30
                            bg-blue-500/10
                            py-3
                            text-center
                            font-semibold
                            text-blue-300
                            transition
                            hover:bg-blue-500/20
                        "
                    >
                        Modifier
                    </Link>

                    <button
                        class="
                            flex-1
                            rounded-2xl
                            border
                            border-red-400/30
                            bg-red-500/10
                            py-3
                            font-semibold
                            text-red-300
                            transition
                            hover:bg-red-500/20
                        "
                    >
                        Supprimer
                    </button>

                </div>

            </div>

        </div>

    </div>
</template>