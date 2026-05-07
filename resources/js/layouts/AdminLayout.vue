<script setup>

    import { Link, usePage } from '@inertiajs/vue3';
    import {ref} from 'vue';
    
</script>

<template>
    
  <!-- -------- -->
  <div class="flex h-screen overflow-hidden bg-">

    <!-- Sidebar -->
    <aside class="bg-gray-300 w-64 hidden md:flex flex-col shadow-lg">
      <div class="p-6 text-2xl font-bold">
          <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" class="w-8 h-8 inline-block mr-2">
          <span class="font-bold">MyApp</span>
      </div>

      <nav class="flex-1 px-4 space-y-2">
        <Link 
            href="/admin">
          <i class="fas fa-house-user"></i>
           Dashboard
        </Link>

        <Link 
            href="/admin/categ">
          <i class="fas fa-box"></i>
           Category
        </Link>
      </nav>
    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col">

      <!-- Topbar -->
      <header class="bg-white shadow p-4 flex justify-between items-center">

        <h1 class="text-xl font-semibold">Dashboard</h1>

        <div class="flex items-center gap-4">
          <input type="text" placeholder="Search..."
            class="hidden md:block px-3 py-2 border rounded-lg focus:outline-none">

          <i data-feather="bell" class="cursor-pointer"></i>
          <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/6.png" class="rounded-full w-12 h-12">
        </div>
      </header>

      <!-- Content -->
      <main class="p-6 space-y-6 overflow-y-auto bg-[url('https://wallpapercg.com/media/ts_orig/12454.webp')] bg-cover bg-center h-screen" >

          <slot/>

      </main>

    </div>

  </div>

</template>