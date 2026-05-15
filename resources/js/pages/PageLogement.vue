<template>
    <!-- Navbar -->
    <nav class="bg-[#36465c] text-white shadow-lg">

        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <h1 class="text-3xl font-bold">
                HotelBooking
            </h1>

            <ul class="flex gap-6">

                <li>
                    <a href="/services" class="hover:text-gray-300">
                        Services
                    </a>
                </li>

                <li>
                    <a href="/logement" class="hover:text-gray-300">
                        Logements
                    </a>
                </li>

            </ul>

        </div>

    </nav>

    <!-- Main -->
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 lg:grid-cols-4 gap-6">

        <!-- Filter -->
        <div class="bg-white rounded-2xl shadow-lg p-6 h-fit">

            <h2 class="text-2xl font-bold mb-6">
                Filtres
            </h2>

            <div class="space-y-4">

                <input
                    type="text"
                    placeholder="Recherche..."
                    class="w-full border rounded-xl p-3"
                >

                <select class="w-full border rounded-xl p-3">
                    <option>Prix</option>
                </select>

                <select class="w-full border rounded-xl p-3">
                    <option>Type logement</option>
                </select>

                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-xl">
                    Filtrer
                </button>

            </div>

        </div>

        <!-- Content -->
        <div class="lg:col-span-3">

            <!-- Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Card -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300">

                    <img
                        src="https://images.unsplash.com/photo-1566073771259-6a8506099945"
                        class="w-full h-60 object-cover"
                    >

                    <div class="p-5">

                        <div class="flex justify-between items-center mb-2">

                            <h2 class="text-2xl font-bold">
                                Hotel Paradise
                            </h2>

                            <span class="text-yellow-500">
                                ⭐ 4.8
                            </span>

                        </div>

                        <p class="text-gray-500 mb-4">
                            Antananarivo
                        </p>

                        <div class="flex justify-between items-center">

                            <h3 class="text-blue-500 text-xl font-bold">
                                120 000 Ar / nuit
                            </h3>

                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl">
                                Réserver
                            </button>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Popular -->
            <section class="mt-14">

                <h2 class="text-3xl font-bold mb-6">
                    Logements populaires
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        ⭐ Hôtel Premium
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        ⭐ Villa Luxe
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        ⭐ Appartement VIP
                    </div>

                </div>

            </section>

        </div>

    </div>
</template>