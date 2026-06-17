<script  setup>
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <!-- Sidebar -->
    <aside class="bg-gray-300 w-64 hidden md:flex flex-col shadow-lg">
      <div class="p-6 text-2xl font-bold">
          <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" class="w-8 h-8 inline-block mr-2">
          <span class="font-bold">MyApp</span>
      </div>

      <nav class="flex-1 px-4 space-y-2">
        User Simple
      </nav>

      <ul>

        <Link
            href="/simple/profile"
            class="block bg-white p-4 rounded-xl hover:bg-[#36465c] hover:text-white transition"
        >

            Profile

        </Link>

      </ul>
    </aside>
</template>

