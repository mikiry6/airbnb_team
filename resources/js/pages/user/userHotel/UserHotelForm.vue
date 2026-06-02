<script setup>

    import { usePage } from '@inertiajs/vue3';
    import { useForm } from '@inertiajs/vue3';
    import { onMounted } from 'vue';
    import { defineProps } from 'vue';
    import L from 'leaflet'
    import 'leaflet/dist/leaflet.css'

    // const page = usePage();
    // const user = page.props.auth.user;

    onMounted(() => {

      const map = L.map('map').setView([-18.8792, 47.5079], 13)

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

          attribution: '&copy; OpenStreetMap contributors'

      }).addTo(map)

      let marker = null

      map.on('click', async (e) => {

          const lat = e.latlng.lat
          const lng = e.latlng.lng

          form.latitude = lat
          form.longitude = lng

          if(marker){

              map.removeLayer(marker)
          }

          marker = L.marker([lat, lng]).addTo(map)

          // Reverse geocoding
          const response = await fetch(

              `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`

          )

          const data = await response.json()

          form.localisation =
              data.address.city ||
              data.address.town ||
              data.address.village ||
              ''

          form.pays = data.address.country || ''
      })
  })

    const props = defineProps([

       'hotel'
    ])

    const form = useForm({
      
      nom: props.hotel?.nom ?? '',
      description: props.hotel?.description ?? '',
      longitude: props.hotel?.longitude ?? '',
      latitude: props.hotel?.latitude ?? '',
      image_principale:null,
      image_1:null,
      image_2:null,
      localisation: props.hotel?.localisation ?? '',
      pays: props.hotel?.pays ?? ''

  })

  const handleSubmit = ()=>{


      form.post('/user/hotel/create',{
        forceFormData: true,
        onSuccess:()=>{

        },
        onError:()=>{

        }
      })

      
  }

</script>

<template>

      <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl m-auto overflow-hidden">
        
        <!-- HEADER -->
        <div class="primary_color p-6">
          <h1 class="text-3xl font-bold text-white">
            Création Hotel
          </h1>
          <p class="text-gray-200 mt-2">
            Ajouter une Chambre  à la plateforme
          </p>
        </div>

        <!-- FORMULAIRE -->
        <form class="p-8 space-y-6" @submit.prevent="handleSubmit" enctype="multipart/form-data" >

          <!-- TITRE -->
          <div>
            <label class="block mb-2 font-semibold text-gray-700">
              Titre
            </label>
            <input
              name="nom"
              v-model="form.nom"
              type="text"
              placeholder="Ex: Appartement moderne à Ivandry"
              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c]"
            />
          </div>

          <!-- IMAGE -->
          <div>
            <label class="block mb-4 font-semibold text-gray-700">
              Images du logement
            </label>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <input
                name="image_principale"
                @change = "form.image_principale = $event.target.files[0]"
                type="file"
                class="w-full border border-gray-300 rounded-lg p-3"
              />

              <input
                name="image_1"
                @change = "form.image_1 = $event.target.files[0]"
                type="file"
                class="w-full border border-gray-300 rounded-lg p-3"
              />

              <input
                name="image_2"
                @change = "form.image_2 = $event.target.files[0]"
                type="file"
                class="w-full border border-gray-300 rounded-lg p-3"
              />

            </div>
          </div>

          <!-- DESCRIPTION -->
          <div>
            <label class="block mb-2 font-semibold text-gray-700">
              Description
            </label>

            <textarea
              name="description"
              v-model="form.description"
              rows="5"
              placeholder="Décrivez le logement..."
              class="w-full border border-gray-300 rounded-lg px-4 py-3 resize-none focus:outline-none focus:ring-2 focus:ring-[#36465c]"
            ></textarea>
          </div>

          <!-- LATITUDE LONGITUDE LOCALISATION -->
           <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div
                id="map"
                class="w-full h-[100] rounded-xl"
            ></div>

            <div>
              <div>
                <label class="block mb-2 font-semibold text-gray-700">
                  Localisation
                </label>

                <input
                  name="localisation"
                  v-model="form.localisation"
                  type="text"
                  placeholder="Ivandry"
                  class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c]"
                />

              </div>
              <!-- -------------------------------------------------------------------------------------------------------------------- -->
            <div>
                 <label class="block mb-2 font-semibold text-gray-700">
                  Pays
                </label>

                <input
                  name= "pays"
                  v-model="form.pays"
                  type="text"
                  placeholder="Madagascar"
                  class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c]"
                />
            </div>
            </div>
           
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
              <label class="block mb-2 font-semibold text-gray-700">
                Latitude
              </label>

              <input
                name="latitude"
                v-model="form.latitude"
                type="text"
                placeholder="-18.8792"
                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c]"
              />
            </div>

            <div>
              <label class="block mb-2 font-semibold text-gray-700">
                Longitude
              </label>

              <input
                name="longitude"
                v-model="form.longitude"
                type="text"
                placeholder="47.5079"
                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c]"
              />
            </div>

          </div>

          <!-- BUTTON -->
          <div class="flex items-center justify-end gap-4 pt-4">

            <button
              type="reset"
              class="btn_default text-white"
            >
              Annuler
            </button>

            <button
              type="submit"
              class="btn_success text-white"
            >
              Enregistrer
            </button>

          </div>

        </form>
      </div>
    

</template>