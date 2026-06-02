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
  <h1 class="text-white text-center text-3xl">
    Mes Hotels
  </h1>
  <Link  
    class="btn_primary text-white"
    href="/user/hotel/create"
  > 
       + Ajouter
  </Link>
  

  <!-- ----------------BOUCLAGE DES CARDS --------------- -->
   
   <div 
        v-for="hotel in hotels"
        class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 w-full max-w-sm">

      <!-- IMAGE -->
      <div class="h-40 overflow-hidden">
          <img
              :src= "'/storage/'+hotel.image_principale"
              alt="Hotel"
              class="w-full h-full object-cover hover:scale-105 transition duration-300"
          >
      </div>

      <!-- CONTENT -->
      <div class="p-5 space-y-4">

          <!-- TITLE -->
          <h2 class="text-2xl font-bold text-gray-800">
              {{ hotel.nom }}
          </h2>

          <!-- DESCRIPTION -->
          <p class="text-gray-600 line-clamp-3">
              Magnifique villa moderne avec piscine et vue panoramique.
              Située dans un quartier calme et sécurisé proche du centre-ville.
          </p>
          
          <!-- BUTTONS -->
          <div class="flex items-center justify-between gap-3 pt-2">

              <Link
                  
                  :href="`/user/hotel/show/${hotel.id}`"
                  class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center font-semibold py-2.5 rounded-xl transition"
              >
                  Voir plus
             </Link>

              <button
                  @click="destroy(hotel.id)"
                  class="flex-1 bg-red-500 hover:bg-red-600 text-white  text-center font-semibold py-2.5 rounded-xl transition cursor-pointer"
              >
                  Supprimer
              </button>

          </div>
      </div>
  </div>
  
</template>