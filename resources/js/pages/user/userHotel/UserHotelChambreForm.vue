<script setup>

    import { usePage } from '@inertiajs/vue3';
    import { useForm } from '@inertiajs/vue3';
    import { onMounted } from 'vue';
    import { defineProps } from 'vue';

    const page = usePage();
    const user = page.props.auth.user;

    const props = defineProps([

       'logement',
       'hotel_id'
    ])

  //  console.log(props.hotel_id);
   
    const form = useForm({
      
      titre: props.logement?.titre ?? '',
      type_logement: props.logement?.type_logement ?? '',
      description: props.logement?.description ?? '',
      prix: props.logement?.prix ?? '',
      nb_chambre: props.logement?.nb_chambre ?? '',
      nb_douche: props.logement?.nb_douche ?? '',
      nb_wc: props.logement?.nb_wc ?? '',
      image_principale:null,
      image_1:null,
      image_2:null,
      image_3:null
  })

  const handleSubmit = ()=>{


      form.post(`/user/hotel/${props.hotel_id}/chambre/create`,{
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
            Création Chambre 
          </h1>
          <p class="text-gray-200 mt-2">
            Ajouter une Chambre  à la plateforme
          </p>
        </div>

        <!-- FORMULAIRE -->
        <form class="p-8 space-y-6" @submit.prevent="handleSubmit" enctype="multipart/form-data" >

          <!-- TYPE LOGEMENT -->
          <div>
            <label class="block mb-2 font-semibold text-gray-700">
              Type Logement
            </label>
            <select

              v-model="form.type_logement"
              name="type_logement"
              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c]"
            >
              <option value="cabane">Cabane</option>
              <option value="chambre">Chambre</option>
              <option value="appartement">Appartement</option>
              <option value="bungalow">Bungalow</option>
              <option value="villa">villa</option>
              <option value="autre">Autre</option>

            </select>
          </div>

          <!-- TITRE -->
          <div>
            <label class="block mb-2 font-semibold text-gray-700">
              Titre
            </label>
            <input
              name="titre"
              v-model="form.titre"
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

              <input
                name="image_3"
                @change = "form.image_3 = $event.target.files[0]"
                type="file"
                class="w-full border border-gray-300 rounded-lg p-3"
              />
            </div>
          </div>

          <!-- CHAMBRE DOUCHE WC -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div>
              <label class="block mb-2 font-semibold text-gray-700">
                Nombre de chambres
              </label>

              <input
                name="nb_chambre"
                v-model="form.nb_chambre"
                type="number"
                min="0"
                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c]"
              />
            </div>

            <div>
              <label class="block mb-2 font-semibold text-gray-700">
                Douche
              </label>

              <input
                name="nb_douche"
                v-model="form.nb_douche"
                type="number"
                min="0"
                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c]"
              />
            </div>

            <div>
              <label class="block mb-2 font-semibold text-gray-700">
                WC
              </label>

              <input
                name="nb_wc"
                v-model="form.nb_wc"
                type="number"
                min="0"
                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c]"
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

         <!-- PRIX -->
          <div>
            <label class="block mb-2 font-semibold text-gray-700">
              Prix
            </label>

            <input
              name="prix"
              v-model="form.prix"
              type="number"
              placeholder="Ex: 120000"
              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#36465c]"
            />
          </div>

          <!-- LATITUDE LONGITUDE LOCALISATION -->       

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