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

<template>

<div class="p-6  min-h-screen">

    <!-- TITRE -->

    <div class="mb-8">

        <h1 class="text-3xl font-bold text-slate-800">
            Dashboard Hôtel
        </h1>

        <p class="text-slate-500 mt-2">
            Vue d'ensemble de votre activité
        </p>

    </div>

    <!-- STATS -->
    <div
        class="
            grid
            grid-cols-1
            sm:grid-cols-2
            lg:grid-cols-3
            gap-6
        "
    >
        <!-- nb hotels -->

        <div
            class="
                bg-white
                rounded-2xl
                p-6
                shadow-sm
                border
                border-slate-200
            "
        >

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-slate-500 text-3xl">
                       🚀
                    </p>

                    <h2 class="text-3xl font-bold mt-2">
                        Hotel
                    </h2>

                </div>

                <span class="text-4xl">
                    {{ nb_hotel}}
                </span>

            </div>

        </div>

        <!-- nb chambres -->

        <div
            class="
                bg-white
                rounded-2xl
                p-6
                shadow-sm
                border
                border-slate-200
            "
        >

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-slate-500 text-3xl">
                       🚀
                    </p>

                    <h2 class="text-3xl font-bold mt-2">
                        Chambre
                    </h2>

                </div>

                <span class="text-4xl">
                    {{ nb_chambre }}
                </span>

            </div>

        </div>

        <!-- nb reservations en attente -->
         <div
            class="
                bg-white
                rounded-2xl
                p-6
                shadow-sm
                border
                border-slate-200
            "
        >

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-slate-500 text-3xl">
                       🚀
                    </p>

                    <h2 class="text-3xl font-bold mt-2">
                        Reservation
                    </h2>

                </div>

                <span class="text-4xl">
                    0
                </span>

            </div>

        </div>

    </div>
        

    <!-- REVENUS -->

    <div
        class="
            mt-8
            grid
            grid-cols-1
            xl:grid-cols-4
            gap-6
        "
    >

        <!-- GRAPHIQUE -->

        <div
            class="
                xl:col-span-3
                rounded-3xl
                border
                border-slate-600
                bg-slate-700
                shadow-2xl
                p-8
                text-white
            "
        >

            <div class="flex justify-between items-center mb-8">

                <div>

                    <h2 class="text-xl font-semibold">
                        Revenus mensuels
                    </h2>

                    <p class="text-slate-400 text-sm mt-1">
                        Évolution du chiffre d'affaires
                    </p>

                </div>

                <select
                    v-model="selectedYear"
                    class="
                        bg-slate-800
                        border
                        border-slate-700
                        rounded-xl
                        px-4
                        py-2
                        text-sm
                    "
                >
                    <option>2024</option>
                    <option>2025</option>
                    <option>2026</option>
                </select>

            </div>

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
                            mb-2
                        "
                    >
                        {{ value }}€
                    </span>

                    <div
                        class="
                            w-3
                            rounded-full
                            bg-gradient-to-t
                            from-blue-700
                            via-blue-500
                            to-cyan-300
                            shadow-[0_0_18px_rgba(59,130,246,0.6)]
                            transition-all
                            duration-500
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

        <!-- CARTE REVENU -->

        <div
            class="
                rounded-3xl
                border
                 border-slate-600
                bg-slate-700
                shadow-2xl
                p-6
                text-white
                flex
                flex-col
                justify-between
                min-h-[430px]
            "
        >

            <div>

                <span
                    class="
                        text-slate-400
                        text-sm
                        uppercase
                        tracking-wider
                    "
                >
                    Revenu du mois
                </span>

                <h2
                    class="
                        text-5xl
                        font-bold
                        mt-4
                    "
                >
                    {{ currentMonthRevenue }} €
                </h2>

                <div
                    class="
                        mt-4
                        inline-flex
                        items-center
                        px-3
                        py-1
                        rounded-full
                        bg-green-500/20
                        text-green-400
                        text-sm
                    "
                >
                    +12% vs mois précédent
                </div>

                <p
                    class="
                        text-slate-400
                        mt-4
                    "
                >
                    Mois actuel
                </p>

            </div>

            <div
                class="
                    border-t
                    border-slate-700
                    pt-6
                "
            >

                <span
                    class="
                        text-slate-400
                        text-sm
                    "
                >
                    Total {{ selectedYear }}
                </span>

                <h3
                    class="
                        text-3xl
                        font-bold
                        mt-2
                        text-cyan-400
                    "
                >
                    {{ yearlyRevenue }} €
                </h3>

            </div>

        </div>

    </div>

    <!-- DERNIERES RESERVATIONS -->

    <div
        class="
            mt-8
            bg-white
            rounded-2xl
            border
            border-slate-200
            shadow-sm
            overflow-hidden
        "
    >

        <div class="p-6 border-b">

            <h2 class="font-semibold text-lg">
                Dernières réservations
            </h2>

        </div>

        <table class="w-full">

            <thead class="bg-slate-50">

                <tr>

                    <th class="text-left p-4">
                        Client
                    </th>

                    <th class="text-left p-4">
                        Chambre
                    </th>

                    <th class="text-left p-4">
                        Date
                    </th>

                    <th class="text-left p-4">
                        Statut
                    </th>

                </tr>

            </thead>

            <tbody>

                <tr
                    v-for="reservation in reservations"
                    :key="reservation.client"
                    class="border-t"
                >

                    <td class="p-4">
                        {{ reservation.client }}
                    </td>

                    <td class="p-4">
                        {{ reservation.chambre }}
                    </td>

                    <td class="p-4">
                        {{ reservation.date }}
                    </td>

                    <td class="p-4">

                        <span
                            class="
                                px-3
                                py-1
                                rounded-full
                                text-sm
                                bg-green-100
                                text-green-700
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

</template>