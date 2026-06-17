<script setup>

import { Link } from '@inertiajs/vue3'

</script>

<template>

<aside class="bg-gray-300 w-64 hidden md:flex flex-col shadow-lg">

    <!-- LOGO -->
    <div class="p-6 text-2xl font-bold flex items-center gap-3">

        <img
            src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png"
            class="w-8 h-8"
        >

        <span>

            MyApp

        </span>

    </div>

    <!-- MENU -->
    <nav class="flex-1 px-4 py-6">

        <ul class="space-y-4">

            <!-- DASHBOARD -->
            <li>

                <Link
                    href="/prestataire/tableau-de-board"
                    class="block bg-white p-4 rounded-xl hover:bg-[#36465c] hover:text-white transition"
                >

                    Tableau de board

                </Link>

            </li>

            <!-- CREATE -->
            <li>

                <Link
                    href="/prestataire/services/create"
                    class="block bg-white p-4 rounded-xl hover:bg-[#36465c] hover:text-white transition"
                >

                    Créer Service

                </Link>

            </li>

            <!-- LIST -->
            <li>

                <Link
                    href="/prestataire/dashboard"
                    class="block bg-white p-4 rounded-xl hover:bg-[#36465c] hover:text-white transition"
                >

                    Liste Services

                </Link>

            </li>

            <li>

                <Link
                    href="/settings/profile"
                    class="block bg-white p-4 rounded-xl hover:bg-[#36465c] hover:text-white transition"
                >

                    Profile

                </Link>

            </li>

        </ul>

    </nav>

</aside>

</template>