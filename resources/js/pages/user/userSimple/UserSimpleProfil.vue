<script setup>

const reservations = [
    {
        id: 1,
        service: 'Hôtel Luxe',
        date: '10 Juin 2026',
        status: 'Confirmée'
    },
    {
        id: 2,
        service: 'Guide Touristique',
        date: '15 Juin 2026',
        status: 'En attente'
    }
]

</script>

<template>

<div class="min-h-screen bg-gray-100 p-8">

    <div class="max-w-7xl mx-auto">

        <div class="grid lg:grid-cols-4 gap-8">

            <!-- PROFIL -->
            <div class="lg:col-span-1">

                <div class="bg-white rounded-3xl shadow-lg p-6">

                    <div class="flex flex-col items-center">

                        <img
                            src="https://i.pravatar.cc/200"
                            class="w-32 h-32 rounded-full border-4 border-blue-500"
                        >

                        <h2 class="text-2xl font-bold mt-4">
                            John Doe
                        </h2>

                        <p class="text-gray-500">
                            john@gmail.com
                        </p>

                    </div>

                    <div class="mt-8 space-y-4">

                        <div>
                            <span class="font-semibold">
                                Téléphone :
                            </span>
                            <p class="text-gray-500">
                                +261 34 00 000 00
                            </p>
                        </div>

                        <div>
                            <span class="font-semibold">
                                Pays :
                            </span>
                            <p class="text-gray-500">
                                Madagascar
                            </p>
                        </div>

                        <div>
                            <span class="font-semibold">
                                Inscription :
                            </span>
                            <p class="text-gray-500">
                                Juin 2026
                            </p>
                        </div>

                    </div>

                    <button
                        class="w-full mt-6 bg-blue-500 text-white py-3 rounded-xl"
                    >
                        Modifier Profil
                    </button>

                </div>

            </div>

            <!-- CONTENU -->
            <div class="lg:col-span-3">

                <!-- STATS -->
                <div class="grid md:grid-cols-3 gap-6 mb-8">

                    <div class="bg-white rounded-3xl p-6 shadow-lg">

                        <h3 class="text-gray-500">
                            Réservations
                        </h3>

                        <p class="text-4xl font-bold text-blue-500 mt-3">
                            12
                        </p>

                    </div>

                    <div class="bg-white rounded-3xl p-6 shadow-lg">

                        <h3 class="text-gray-500">
                            Demandes
                        </h3>

                        <p class="text-4xl font-bold text-orange-500 mt-3">
                            4
                        </p>

                    </div>

                    <div class="bg-white rounded-3xl p-6 shadow-lg">

                        <h3 class="text-gray-500">
                            Favoris
                        </h3>

                        <p class="text-4xl font-bold text-green-500 mt-3">
                            8
                        </p>

                    </div>

                </div>

                <!-- RESERVATIONS -->
                <div class="bg-white rounded-3xl shadow-lg p-6 mb-8">

                    <h2 class="text-2xl font-bold mb-6">
                        Mes Réservations
                    </h2>

                    <div
                        v-for="reservation in reservations"
                        :key="reservation.id"
                        class="border-b py-4 flex justify-between items-center"
                    >

                        <div>

                            <h3 class="font-semibold">
                                {{ reservation.service }}
                            </h3>

                            <p class="text-gray-500">
                                {{ reservation.date }}
                            </p>

                        </div>

                        <span
                            class="bg-green-100 text-green-600 px-4 py-2 rounded-full"
                        >
                            {{ reservation.status }}
                        </span>

                    </div>

                </div>

                <!-- DEMANDES -->
                <div class="bg-white rounded-3xl shadow-lg p-6">

                    <h2 class="text-2xl font-bold mb-6">
                        Mes Demandes
                    </h2>

                    <div class="space-y-4">

                        <div
                            class="p-4 border rounded-2xl"
                        >

                            <h3 class="font-semibold">
                                Demande de réservation Hôtel Luxe
                            </h3>

                            <p class="text-gray-500 mt-2">
                                En attente de validation du prestataire.
                            </p>

                        </div>

                        <div
                            class="p-4 border rounded-2xl"
                        >

                            <h3 class="font-semibold">
                                Demande Guide Touristique
                            </h3>

                            <p class="text-gray-500 mt-2">
                                Réponse reçue.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</template>