
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
  <!-- Conteneur principal avec effet de flou et dégradé sombre en arrière-plan -->
  <div class="w-full max-w-4xl bg-[#0b131a]/60 backdrop-blur-md rounded-2xl border border-slate-800/80 shadow-2xl shadow-cyan-950/20 m-auto overflow-hidden">
    
    <!-- En-tête avec lueur Cyan et texte épuré -->
    <div class="border-b border-slate-800/60 p-6 bg-gradient-to-r from-slate-950 to-[#0b131a]">
      <h1 class="text-2xl font-bold tracking-wider uppercase text-white flex items-center gap-2">
        <span class="h-2 w-2 rounded-full bg-[#00ffff] shadow-[0_0_8px_#00ffff]"></span>
        {{ estEdition ? 'Modification Logement' : 'Création Logement' }}
      </h1>
      <p class="text-xs text-slate-400 mt-1">
        {{ estEdition ? 'Modifier les informations du logement en temps réel' : 'Ajouter une nouvelle infrastructure à la plateforme' }}
      </p>
    </div>

    <!-- Formulaire principal -->
    <form @submit.prevent="soumettreFormulaire" class="p-6 md:p-8 space-y-6">

      <input type="hidden" name="user_id" :value="user.id">

      <!-- Sélecteur de Type -->
      <div>
        <label class="block mb-2 text-xs font-bold uppercase tracking-widest text-slate-400">
          Type Logement
        </label>
        <div class="relative">
          <select
            v-model="formulaire.type_logement"
            class="w-full bg-[#111f2b]/40 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 placeholder-slate-600 focus:outline-none focus:border-[#00ffff]/60 focus:ring-4 focus:ring-cyan-950/30 transition-all duration-300 appearance-none"
          >
            <option value="cabane" class="bg-[#0b131a]">Cabane</option>
            <option value="appartement" class="bg-[#0b131a]">Appartement</option>
            <option value="bungalow" class="bg-[#0b131a]">Bungalow</option>
            <option value="villa" class="bg-[#0b131a]">Villa</option>
            <option value="autre" class="bg-[#0b131a]">Autre</option>
          </select>
          <!-- Flèche personnalisée pour le select -->
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
            <svg class="fill-current h-4 w-4" xmlns="http://w3.org" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
          </div>
        </div>
      </div>

      <!-- Champ Titre -->
      <div>
        <label class="block mb-2 text-xs font-bold uppercase tracking-widest text-slate-400">
          Titre du bien
        </label>
        <input
          v-model="formulaire.titre"
          type="text"
          placeholder="Ex: Appartement moderne à Ivandry"
          class="w-full bg-[#111f2b]/40 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 placeholder-slate-600 focus:outline-none focus:border-[#00ffff]/60 focus:ring-4 focus:ring-cyan-950/30 transition-all duration-300"
          required
        />
      </div>

            <!-- Champ Description -->
      <div>
        <label class="block mb-2 text-xs font-bold uppercase tracking-widest text-slate-400">
          Description générale
        </label>
        <textarea
          v-model="formulaire.description"
          rows="5"
          placeholder="Décrivez les spécificités du logement..."
          class="w-full bg-[#111f2b]/40 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 placeholder-slate-600 resize-none focus:outline-none focus:border-[#00ffff]/60 focus:ring-4 focus:ring-cyan-950/30 transition-all duration-300"
          required
        ></textarea>
      </div>

      <!-- Champ Prix -->
      <div>
        <label class="block mb-2 text-xs font-bold uppercase tracking-widest text-slate-400">
          Prix (Ar)
        </label>
        <div class="relative">
          <input
            v-model="formulaire.prix"
            type="number"
            placeholder="Ex: 120000"
            class="w-full bg-[#111f2b]/40 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 placeholder-slate-600 focus:outline-none focus:border-[#00ffff]/60 focus:ring-4 focus:ring-cyan-950/30 transition-all duration-300 pr-12"
            required
          />
          <span class="absolute inset-y-0 right-4 flex items-center text-xs font-bold text-slate-500">AR</span>
        </div>
      </div>

      <!-- Grille Triple pour les Caractéristiques -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label class="block mb-2 text-xs font-bold uppercase tracking-widest text-slate-400">
            Nombre de chambres
          </label>
          <input
            v-model="formulaire.nb_chambre"
            type="number"
            min="0"
            class="w-full bg-[#111f2b]/40 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-[#00ffff]/60 focus:ring-4 focus:ring-cyan-950/30 transition-all duration-300"
            required
          />
        </div>

        <div>
          <label class="block mb-2 text-xs font-bold uppercase tracking-widest text-slate-400">
            Nombre de douches
          </label>
          <input
            v-model="formulaire.nb_douche"
            type="number"
            min="0"
            class="w-full bg-[#111f2b]/40 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-[#00ffff]/60 focus:ring-4 focus:ring-cyan-950/30 transition-all duration-300"
            required
          />
        </div>

        <div>
          <label class="block mb-2 text-xs font-bold uppercase tracking-widest text-slate-400">
            Nombre de WC
          </label>
          <input
            v-model="formulaire.nb_wc"
            type="number"
            min="0"
            class="w-full bg-[#111f2b]/40 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-[#00ffff]/60 focus:ring-4 focus:ring-cyan-950/30 transition-all duration-300"
            required
          />
        </div>
      </div>

            <!-- Section Téléchargement d'Images -->
      <div class="space-y-4 border-t border-slate-900 pt-6">
        <div>
          <label class="block mb-2 text-xs font-bold uppercase tracking-widest text-slate-400">
            Image principale du catalogue
          </label>
          <div class="relative group">
            <input
              name="image_principale"
              @change="formulaire.image_principale = $event.target.files[0]"
              type="file"
              accept="image/*"
              class="w-full bg-[#111f2b]/20 border border-slate-800 rounded-xl p-3 text-xs text-slate-400 file:mr-4 file:py-1.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#111f2b] file:text-[#00ffff] hover:file:bg-slate-900 transition-all group-hover:border-slate-700"
            />
          </div>
        </div>

        <div>
          <label class="block mb-3 text-xs font-bold uppercase tracking-widest text-slate-500">
            Images secondaires (Galerie de détails)
          </label>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input
              @change="formulaire.image_1 = $event.target.files[0]"
              name="image_1"
              type="file"
              accept="image/*"
              class="w-full bg-[#111f2b]/20 border border-slate-800 rounded-xl p-3 text-xs text-slate-400 file:mr-4 file:py-1.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#111f2b] file:text-slate-200 transition-all"
            />

            <input
              name="image_2"
              @change="formulaire.image_2 = $event.target.files[0]"
              type="file"
              accept="image/*"
              class="w-full bg-[#111f2b]/20 border border-slate-800 rounded-xl p-3 text-xs text-slate-400 file:mr-4 file:py-1.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#111f2b] file:text-slate-200 transition-all"
            />

            <input
              name="image_3"
              @change="formulaire.image_3 = $event.target.files[0]"
              type="file"
              accept="image/*"
              class="w-full bg-[#111f2b]/20 border border-slate-800 rounded-xl p-3 text-xs text-slate-400 file:mr-4 file:py-1.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#111f2b] file:text-slate-200 transition-all"
            />

            <input
              name="image_4"
              @change="formulaire.image_4 = $event.target.files[0]"
              type="file"
              accept="image/*"
              class="w-full bg-[#111f2b]/20 border border-slate-800 rounded-xl p-3 text-xs text-slate-400 file:mr-4 file:py-1.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#111f2b] file:text-slate-200 transition-all"
            />
          </div>
        </div>
      </div>

            <!-- Section Géolocalisation (Carte + Coordonnées) -->
      <div class="border-t border-slate-900 pt-6 space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <!-- Carte interactive Leaflet / Mapbox -->
          <div
            id="map"
            class="w-full h-48 rounded-xl border border-slate-800/80 bg-slate-950 overflow-hidden shadow-inner"
          ></div>

          <!-- Champs Adresse et Pays -->
          <div class="flex flex-col justify-between gap-3">
            <div>
              <label class="block mb-1.5 text-xs font-bold uppercase tracking-widest text-slate-400">
                Localisation / Ville
              </label>
              <input
                name="localisation"
                v-model="formulaire.localisation"
                type="text"
                placeholder="Ivandry"
                class="w-full bg-[#111f2b]/40 border border-slate-800 rounded-xl px-4 py-2.5 text-slate-200 placeholder-slate-600 focus:outline-none focus:border-[#00ffff]/60 focus:ring-4 focus:ring-cyan-950/30 transition-all duration-300"
              />
            </div>
          
            <div>
              <label class="block mb-1.5 text-xs font-bold uppercase tracking-widest text-slate-400">
                Pays
              </label>
              <input
                name="pays"
                v-model="formulaire.pays"
                type="text"
                placeholder="Madagascar"
                class="w-full bg-[#111f2b]/40 border border-slate-800 rounded-xl px-4 py-2.5 text-slate-200 placeholder-slate-600 focus:outline-none focus:border-[#00ffff]/60 focus:ring-4 focus:ring-cyan-950/30 transition-all duration-300"
              />
            </div>
          </div>
        </div>

        <!-- Coordonnées précises (Latitude / Longitude) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-[#111f2b]/20 p-4 rounded-xl border border-slate-900">
          <div>
            <label class="block mb-1 text-[10px] font-bold uppercase tracking-widest text-slate-500">
              Latitude
            </label>
            <input
              name="latitude"
              v-model="formulaire.latitude"
              type="text"
              placeholder="-18.8792"
              class="w-full bg-slate-950/40 border border-slate-800/60 rounded-lg px-4 py-2 text-xs text-slate-200 placeholder-slate-700 focus:outline-none focus:border-[#00ffff]/50"
            />
          </div>

          <div>
            <label class="block mb-1 text-[10px] font-bold uppercase tracking-widest text-slate-500">
              Longitude
            </label>
            <input
              name="longitude"
              v-model="formulaire.longitude"
              type="text"
              placeholder="47.5079"
              class="w-full bg-slate-950/40 border border-slate-800/60 rounded-lg px-4 py-2 text-xs text-slate-200 placeholder-slate-700 focus:outline-none focus:border-[#00ffff]/50"
            />
          </div>
        </div>
      </div>

      <!-- Pied de formulaire : Actions -->
      <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-900">
        <button
          @click="formulaire.reset()"
          type="button"
          class="px-5 py-2.5 rounded-xl border border-slate-800 text-xs font-semibold text-slate-400 hover:text-white hover:border-slate-600 transition-all"
        >
          Annuler
        </button>

        <button
          type="submit"
          :disabled="formulaire.processing"
          class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 text-slate-950 font-bold text-xs uppercase tracking-wider rounded-xl hover:from-cyan-400 hover:to-blue-500 transition-all duration-300 disabled:opacity-50 disabled:pointer-events-none shadow-lg shadow-cyan-500/10"
        >
          {{ estEdition ? 'Mettre à jour le logement' : 'Enregistrer le logement' }}
        </button>
      </div>

    </form>
  </div>
</template>

