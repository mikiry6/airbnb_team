<script setup>

    import { ref, computed , defineProps} from 'vue'

    const selectedYear = ref('2026')
    const props = defineProps([

        'hotels',
        'chambres'

    ])
    console.log(props.chambres,props.hotels);
    

    // ----------Caracteristique    
    const nb_hotel = props.hotels.length 
    const nb_chambre = props.chambres.length
    
    const revenus = {
        2024: [1200, 1800, 2200, 2600, 2900, 3100, 2800, 3400, 3900, 4200, 4600, 5000],
        2025: [2100, 2500, 3000, 3700, 4200, 4700, 5200, 6100, 6800, 7200, 7900, 8500],
        2026: [3200, 3900, 4500, 5100, 6200, 7000, 0, 0, 0, 0, 0, 0]
    }

    const mois = [
        'Jan',
        'Fév',
        'Mar',
        'Avr',
        'Mai',
        'Juin',
        'Juil',
        'Août',
        'Sep',
        'Oct',
        'Nov',
        'Déc'
    ]

    const reservations = ref([
        {
            client: 'Jean Dupont',
            chambre: 'Suite Deluxe',
            date: '03/06/2026',
            statut: 'Confirmée'
        },
        {
            client: 'Sarah Martin',
            chambre: 'Chambre Standard',
            date: '02/06/2026',
            statut: 'En attente'
        },
        {
            client: 'Paul Robert',
            chambre: 'Suite Vue Mer',
            date: '01/06/2026',
            statut: 'Confirmée'
        }
    ])

    const maxValue = computed(() => {
        return Math.max(...revenus[selectedYear.value])
    })

    const currentMonthRevenue = computed(() => {

        const currentMonth = new Date().getMonth()

        return revenus[selectedYear.value][currentMonth]

    })

    const yearlyRevenue = computed(() => {

        return revenus[selectedYear.value]
            .reduce((sum, value) => sum + value, 0)

    })

</script>

```vue
<template>

<div
    class="
        min-h-screen
        p-4
        md:p-6
        text-white
        relative
        overflow-hidden
    "
>

    <!-- BACKGROUND GLOW -->

    <div class="absolute inset-0 pointer-events-none">

        <div
            class="
                absolute
                top-0
                left-0
                w-[400px]
                h-[400px]
                bg-cyan-500/10
                blur-[120px]
                rounded-full
            "
        ></div>

        <div
            class="
                absolute
                bottom-0
                right-0
                w-[350px]
                h-[350px]
                bg-blue-600/10
                blur-[120px]
                rounded-full
            "
        ></div>

    </div>

    <!-- CONTENT -->

    <div class="relative z-10">

        <!-- HEADER -->

        <div class="mb-10">

            <h1
                class="
                    text-3xl
                    md:text-5xl
                    font-bold
                    bg-gradient-to-r
                    from-cyan-300
                    to-blue-400
                    bg-clip-text
                    text-transparent
                "
            >
                Dashboard Hôtel
            </h1>

            <p
                class="
                    text-slate-400
                    mt-3
                    text-sm
                    md:text-base
                "
            >
                Vue d’ensemble de votre activité
            </p>

        </div>

        <!-- STATS -->

        <div
            class="
                grid
                grid-cols-1
                sm:grid-cols-2
                xl:grid-cols-3
                gap-6
            "
        >

            <!-- CARD -->

            <div
                class="
                    group
                    relative
                    overflow-hidden
                    rounded-3xl
                    border
                    border-white/10
                    bg-white/5
                    backdrop-blur-xl
                    p-6
                    transition-all
                    duration-500
                    hover:-translate-y-2
                    hover:border-cyan-400/40
                "
            >

                <div
                    class="
                        absolute
                        inset-0
                        bg-gradient-to-br
                        from-cyan-500/5
                        to-transparent
                        opacity-0
                        group-hover:opacity-100
                        transition-all
                        duration-500
                    "
                ></div>

                <div class="relative z-10 flex justify-between items-center">

                    <div>

                        <p class="text-4xl">
                            🏨
                        </p>

                        <h2 class="text-2xl font-bold mt-3">
                            Hôtels
                        </h2>

                    </div>

                    <span
                        class="
                            text-5xl
                            font-bold
                            text-cyan-300
                        "
                    >
                        {{ nb_hotel }}
                    </span>

                </div>

            </div>

            <!-- CARD -->

            <div
                class="
                    group
                    relative
                    overflow-hidden
                    rounded-3xl
                    border
                    border-white/10
                    bg-white/5
                    backdrop-blur-xl
                    p-6
                    transition-all
                    duration-500
                    hover:-translate-y-2
                    hover:border-blue-400/40
                "
            >

                <div class="relative z-10 flex justify-between items-center">

                    <div>

                        <p class="text-4xl">
                            🛏️
                        </p>

                        <h2 class="text-2xl font-bold mt-3">
                            Chambres
                        </h2>

                    </div>

                    <span
                        class="
                            text-5xl
                            font-bold
                            text-blue-300
                        "
                    >
                        {{ nb_chambre }}
                    </span>

                </div>

            </div>

            <!-- CARD -->

            <div
                class="
                    group
                    relative
                    overflow-hidden
                    rounded-3xl
                    border
                    border-white/10
                    bg-white/5
                    backdrop-blur-xl
                    p-6
                    transition-all
                    duration-500
                    hover:-translate-y-2
                    hover:border-purple-400/40
                "
            >

                <div class="relative z-10 flex justify-between items-center">

                    <div>

                        <p class="text-4xl">
                            📅
                        </p>

                        <h2 class="text-2xl font-bold mt-3">
                            Réservations
                        </h2>

                    </div>

                    <span
                        class="
                            text-5xl
                            font-bold
                            text-purple-300
                        "
                    >
                        0
                    </span>

                </div>

            </div>

        </div>

        <!-- REVENUS -->

        <div
            class="
                mt-10
                grid
                grid-cols-1
                xl:grid-cols-4
                gap-6
            "
        >

            <!-- CHART -->

            <div
                class="
                    xl:col-span-3
                    rounded-3xl
                    border
                    border-white/10
                    bg-white/5
                    backdrop-blur-xl
                    p-6
                    md:p-8
                    shadow-[0_0_50px_rgba(0,150,255,0.08)]
                "
            >

                <div
                    class="
                        flex
                        flex-col
                        md:flex-row
                        md:items-center
                        md:justify-between
                        gap-4
                        mb-10
                    "
                >

                    <div>

                        <h2 class="text-2xl font-bold">
                            Revenus mensuels
                        </h2>

                        <p class="text-slate-400 mt-1">
                            Évolution du chiffre d’affaires
                        </p>

                    </div>

                    <select
                        v-model="selectedYear"
                        class="
                            bg-slate-900/80
                            border
                            border-white/10
                            rounded-xl
                            px-4
                            py-3
                            text-sm
                            focus:outline-none
                            focus:border-cyan-400/40
                        "
                    >
                        <option>2024</option>
                        <option>2025</option>
                        <option>2026</option>
                    </select>

                </div>

                <!-- BAR CHART -->

                <div
                    class="
                        h-80
                        flex
                        items-end
                        justify-between
                        gap-2
                    "
                >

                    <div
                        v-for="(value,index) in revenus[selectedYear]"
                        :key="index"
                        class="
                            flex
                            flex-col
                            items-center
                            flex-1
                        "
                    >

                        <span
                            class="
                                text-xs
                                text-slate-400
                                mb-3
                            "
                        >
                            {{ value }}€
                        </span>

                        <div
                            class="
                                w-full
                                max-w-[18px]
                                rounded-full
                                bg-gradient-to-t
                                from-blue-700
                                via-cyan-500
                                to-cyan-200
                                shadow-[0_0_20px_rgba(34,211,238,0.6)]
                                transition-all
                                duration-500
                                hover:scale-105
                            "
                            :style="{
                                height: `${(value / maxValue) * 220}px`
                            }"
                        ></div>

                        <span
                            class="
                                text-xs
                                text-slate-500
                                mt-3
                            "
                        >
                            {{ mois[index] }}
                        </span>

                    </div>

                </div>

            </div>

            <!-- REVENU CARD -->

            <div
                class="
                    rounded-3xl
                    border
                    border-white/10
                    bg-white/5
                    backdrop-blur-xl
                    p-6
                    shadow-[0_0_50px_rgba(0,150,255,0.08)]
                    flex
                    flex-col
                    justify-between
                "
            >

                <div>

                    <span
                        class="
                            text-slate-400
                            uppercase
                            tracking-widest
                            text-xs
                        "
                    >
                        Revenu du mois
                    </span>

                    <h2
                        class="
                            text-5xl
                            font-bold
                            mt-5
                            text-cyan-300
                        "
                    >
                        {{ currentMonthRevenue }} €
                    </h2>

                    <div
                        class="
                            mt-5
                            inline-flex
                            items-center
                            px-4
                            py-2
                            rounded-full
                            bg-green-500/10
                            border
                            border-green-400/20
                            text-green-300
                            text-sm
                        "
                    >
                        +12% vs mois précédent
                    </div>

                </div>

                <div
                    class="
                        mt-10
                        pt-6
                        border-t
                        border-white/10
                    "
                >

                    <span class="text-slate-400 text-sm">
                        Total {{ selectedYear }}
                    </span>

                    <h3
                        class="
                            text-4xl
                            font-bold
                            mt-3
                            text-blue-300
                        "
                    >
                        {{ yearlyRevenue }} €
                    </h3>

                </div>

            </div>

        </div>

        <!-- TABLE -->

        <div
            class="
                mt-10
                rounded-3xl
                border
                border-white/10
                bg-white/5
                backdrop-blur-xl
                overflow-hidden
                shadow-[0_0_50px_rgba(0,150,255,0.08)]
            "
        >

            <div
                class="
                    px-6
                    py-5
                    border-b
                    border-white/10
                "
            >

                <h2 class="text-2xl font-bold">
                    Dernières réservations
                </h2>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full min-w-[700px]">

                    <thead
                        class="
                            bg-white/5
                            text-slate-300
                        "
                    >

                        <tr>

                            <th class="text-left p-5">
                                Client
                            </th>

                            <th class="text-left p-5">
                                Chambre
                            </th>

                            <th class="text-left p-5">
                                Date
                            </th>

                            <th class="text-left p-5">
                                Statut
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr
                            v-for="reservation in reservations"
                            :key="reservation.client"
                            class="
                                border-t
                                border-white/5
                                hover:bg-white/5
                                transition-all
                            "
                        >

                            <td class="p-5">
                                {{ reservation.client }}
                            </td>

                            <td class="p-5 text-slate-300">
                                {{ reservation.chambre }}
                            </td>

                            <td class="p-5 text-slate-400">
                                {{ reservation.date }}
                            </td>

                            <td class="p-5">

                                <span
                                    class="
                                        px-4
                                        py-2
                                        rounded-full
                                        text-sm
                                        bg-green-500/10
                                        border
                                        border-green-400/20
                                        text-green-300
                                    "
                                >
                                    {{ reservation.statut }}
                                </span>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</template>
