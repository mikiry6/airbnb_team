<script setup>

    import UserHotelSideBar from '@/components/Layout/UserHotelSideBar.vue';

    import UserSimpleSideBar from '@/components/Layout/UserSimpleSideBar.vue';
    import UserPrestataireSideBar from '@/components/Layout/UserPrestataireSideBar.vue';
    import { Head, usePage } from '@inertiajs/vue3';

    const page = usePage();
    // utilisateur connecté
    const user = page.props.auth.user;

</script>

<template>

    <!-- -------- -->
  <div class="flex h-screen overflow-hidden bg-">

    <!-- ---------Affichage des sideBar Selon le Role -->
    <user-simple-side-bar v-if="user.role === 'simple'"></user-simple-side-bar>
    <user-hotel-side-bar v-if="user.role === 'hotel'" ></user-hotel-side-bar>

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