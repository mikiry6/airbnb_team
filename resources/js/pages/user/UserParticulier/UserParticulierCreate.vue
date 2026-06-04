<script setup>
    import { usePage, useForm } from '@inertiajs/vue3';
    import { onMounted } from 'vue'; 
    import L from 'leaflet'
    import 'leaflet/dist/leaflet.css'
    import { computed } from 'vue'; 

    const props = defineProps([
     'logements'
    ])


    onMounted(() => {
        const map = L.map('map').setView([-18.8792, 47.5079], 13)

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map)

        let marker = null

        map.on('click', async (e) => {
            const lat = e.latlng.lat
            const lng = e.latlng.lng

         
            formulaire.latitude = Math.round(lat)
            formulaire.longitude = Math.round(lng)

            if(marker){
                map.removeLayer(marker)
            }

            marker = L.marker([lat, lng]).addTo(map)

          
        })
    })

    const page = usePage();
    const user = page.props.auth.user;

    const estEdition = computed(() => !!props.logements);

    const formulaire = useForm({
        user_id: user.id,
        pays: props.logements?.pays?.nom || '',            
        localisation_id: props.logements?.localisation_id || null,   
        image_logement_id: props.logements?.image_logement_id || null,  
        type_logement: props.logements?.type_logement || 'villa', 
        titre: props.logements?.titre || '',
        description: props.logements?.description || '',
        prix: props.logements?.prix || null,
        nb_chambre: props.logements?.nb_chambre || 0,
        nb_douche: props.logements?.nb_douche || 0,
        nb_wc: props.logements?.nb_wc || 0,
        longitude: props.logements?.longitude || '',            
        latitude: props.logements?.latitude || '',   
        localisation: props.logements?.localisation?.localisation || '',         
        
        image_principale: null,
        image_1: null, image_2: null, image_3: null, image_4: null,
        _method: estEdition.value ? 'PUT' : 'POST'
    });

    const soumettreFormulaire = () => {
        if (estEdition.value) {
            formulaire.post(`/user/logements/${props.logements.id}`, {
                forceFormData: true, 
            });
        } else {
            formulaire.post('/user/logements', {
                forceFormData: true, 
                onSuccess: () => formulaire.reset(),
            });
        }
    };
  

</script>

<template>

      <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl m-auto overflow-hidden">
        
        <div class="primary_color p-6">
          <h1 class="text-3xl font-bold text-white">
            {{ estEdition ? 'Modification Logement' : 'Création Logement' }}
          </h1>
          <p class="text-gray-200 mt-2">
            {{ estEdition ? 'Modifier les informations du logement' : 'Ajouter un Logement à la plateforme' }}
          </p>
        </div>

        <!-- formulaire -->
        <form @submit.prevent="soumettreFormulaire" class="p-8 space-y-6">

          <input type="hidden" name="user_id" :value="user.id">

          <div>
            <label class="block mb-2 font-semibold text-gray-700">
              Type Logement
            </label>
            <select
              v-model="formulaire.type_logement"
              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c] text-black"
            >
              <option value="cabane">Cabane</option>
              <option value="appartement">Appartement</option>
              <option value="bungalow">Bungalow</option>
              <option value="villa">Villa</option>
              <option value="autre">Autre</option>
            </select>
          </div>

          <div>
            <label class="block mb-2 font-semibold text-gray-700">
              Titre
            </label>
            <input
              v-model="formulaire.titre"
              type="text"
              placeholder="Ex: Appartement moderne à Ivandry"
              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c] text-black"
              required
            />
          </div>

   
          <div>
            <label class="block mb-2 font-semibold text-gray-700">
              Description
            </label>
            <textarea
              v-model="formulaire.description"
              rows="5"
              placeholder="Décrivez le logement..."
              class="w-full border border-gray-300 text-black rounded-lg px-4 py-3 resize-none focus:outline-none focus:ring-2 focus:ring-[#36465c]"
              required
            ></textarea>
          </div>

          <div>
            <label class="block mb-2 font-semibold text-gray-700">
              Prix
            </label>
            <input
              v-model="formulaire.prix"
              type="number"
              placeholder="Ex: 120000"
              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c] text-black"
              required
            />
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div>
              <label class="block mb-2 font-semibold text-gray-700">
                Nombre de chambres
              </label>
              <input
                v-model="formulaire.nb_chambre"
                type="number"
                min="0"
                class="w-full border text-black border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c]"
                required
              />
            </div>

            <div>
              <label class="block mb-2 font-semibold text-gray-700">
                Nombre de douches
              </label>
              <input
                v-model="formulaire.nb_douche"
                type="number"
                min="0"
                class="w-full border text-black border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c]"
                required
              />
            </div>

            <div>
              <label class="block mb-2 font-semibold text-gray-700">
                Nombre de WC
              </label>
              <input
                v-model="formulaire.nb_wc"
                type="number"
                min="0"
                class="w-full border text-black border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c]"
                required
              />
            </div>

          </div>

     
          <div>
            <label class="block mb-2 font-semibold text-gray-700">
              Image principale
            </label>
            <input
            name="image_principale"
              @change="formulaire.image_principale = $event.target.files[0]"
              type="file"
              accept="image/*"
              class="w-full border text-black border-gray-300 rounded-lg p-3"
              
            />
          </div>

       
          <div>
            <label class="block mb-4 font-semibold text-gray-700">
             
            </label>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <input
                @change="formulaire.image_1 = $event.target.files[0]"
                name="image_1"
                type="file"
                accept="image/*"
                class="w-full border text-black border-gray-300 rounded-lg p-3"
              />

              <input
                name="image_2"
                @change="formulaire.image_2 = $event.target.files[0]"
                type="file"
                accept="image/*"
                class="w-full border text-black border-gray-300 rounded-lg p-3"
              />

              <input
                name="image_3"
                @change="formulaire.image_3 = $event.target.files[0]"
                type="file"
                accept="image/*"
                class="w-full border text-black border-gray-300 rounded-lg p-3"
              />

              <input
                name="image_4"
                @change="formulaire.image_4 = $event.target.files[0]"
                type="file"
                accept="image/*"
                class="w-full border text-black border-gray-300 rounded-lg p-3"
              />
            </div>
          </div>


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
              v-model="formulaire.localisation"
              type="text"
              placeholder="Ivandry"
              class="w-full border text-black border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c]"
            />

          </div>
        
          <div>
            <label class="block mb-2 font-semibold text-gray-700">
               Pays
            </label>

            <input
              name= "pays"
              v-model="formulaire.pays"
              type="text"
              placeholder="Madagascar"
              class="w-full border text-black border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c]"
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
                v-model="formulaire.latitude"
                type="text"
                placeholder="-18.8792"
                class="w-full border text-black border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c]"
              />
            </div>

            <div>
              <label class="block mb-2 font-semibold text-gray-700">
                Longitude
              </label>

              <input
                name="longitude"
                v-model="formulaire.longitude"
                type="text"
                placeholder="47.5079"
                class="w-full border text-black border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c]"
              />
            </div>

          </div>


          <div class="flex items-center justify-end gap-4 pt-4">

            <button
              @click="formulaire.reset()"
              type="button"
              class="btn_default text-white"
            >
              Annuler
            </button>

            <button
              type="submit"
              :disabled="formulaire.processing"
              class="px-6 py-3 bg-[#36465c] text-white font-bold rounded-lg hover:bg-opacity-90 transition-colors disabled:opacity-50"
            >
              {{ estEdition ? 'Mettre à jour le logement' : 'Enregistrer le logement' }}
            </button>

          </div>

        </form>
      </div>

</template>
