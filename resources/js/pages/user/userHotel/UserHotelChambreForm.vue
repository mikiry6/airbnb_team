<script setup>

    import { usePage } from '@inertiajs/vue3';
    import { useForm } from '@inertiajs/vue3';
    import { onMounted } from 'vue';
    import { defineProps } from 'vue';
    import { ref } from 'vue'

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

  // -----------------Preview Image
  const previews = ref([
  null,
  null,
  null,
  null
])

const imageFields = [
  'image_principale',
  'image_1',
  'image_2',
  'image_3'
]

const handleImageChange = (event, index) => {

  const file = event.target.files[0]

  if (!file) return

  // stockage dans inertia form
  form[imageFields[index]] = file

  // preview image
  previews.value[index] = URL.createObjectURL(file)
}



  // ----------------------------
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

  <div
    class="
      relative
      overflow-hidden
      rounded-[32px]
      border
      border-white/10
      bg-white/5
      backdrop-blur-2xl
      shadow-[0_0_50px_rgba(0,0,0,0.35)]
    "
  >

    <!-- BACKGROUND EFFECT -->

    <div class="absolute inset-0 pointer-events-none">

      <div
        class="
          absolute
          -top-24
          -right-20
          w-[320px]
          h-[320px]
          rounded-full
          bg-cyan-500/10
          blur-[120px]
        "
      ></div>

      <div
        class="
          absolute
          bottom-0
          left-0
          w-[260px]
          h-[260px]
          rounded-full
          bg-blue-700/10
          blur-[120px]
        "
      ></div>

    </div>

    <!-- HEADER -->

    <div
      class="
        relative
        z-10
        border-b
        border-white/10
        bg-white/5
        px-6
        py-6
        md:px-8
      "
    >

      <h1
        class="
          text-3xl
          font-bold
          text-white
        "
      >
        Création Chambre
      </h1>

      <p
        class="
          mt-2
          text-slate-300
        "
      >
        Ajouter un nouveau logement à la plateforme
      </p>

    </div>

    <!-- FORM -->

    <form
      class="
        relative
        z-10
        space-y-8
        p-6
        md:p-8
      "
      @submit.prevent="handleSubmit"
      enctype="multipart/form-data"
    >

      <!-- TYPE LOGEMENT -->

      <div>

        <label
          class="
            mb-3
            block
            font-medium
            text-slate-200
          "
        >
          Type de logement
        </label>

        <select
          v-model="form.type_logement"
          name="type_logement"
          class="
            w-full
            rounded-2xl
            border
            border-white/10
            bg-white/5
            px-5
            py-4
            text-white
            backdrop-blur-lg
            transition-all
            duration-300
            focus:border-cyan-400/40
            focus:bg-white/10
            focus:outline-none
            focus:ring-2
            focus:ring-cyan-400/20
          "
        >
          <option class="bg-slate-900" value="cabane">Cabane</option>
          <option class="bg-slate-900" value="chambre">Chambre</option>
          <option class="bg-slate-900" value="appartement">Appartement</option>
          <option class="bg-slate-900" value="bungalow">Bungalow</option>
          <option class="bg-slate-900" value="villa">Villa</option>
          <option class="bg-slate-900" value="autre">Autre</option>
        </select>

      </div>

      <!-- TITRE -->

      <div>

        <label
          class="
            mb-3
            block
            font-medium
            text-slate-200
          "
        >
          Titre
        </label>

        <input
          name="titre"
          v-model="form.titre"
          type="text"
          placeholder="Ex: Appartement moderne à Ivandry"
          class="
            w-full
            rounded-2xl
            border
            border-white/10
            bg-white/5
            px-5
            py-4
            text-white
            placeholder:text-slate-400
            backdrop-blur-lg
            transition-all
            duration-300
            focus:border-cyan-400/40
            focus:bg-white/10
            focus:outline-none
            focus:ring-2
            focus:ring-cyan-400/20
          "
        />

      </div>

       <!-- IMAGES -->

        <div>

          <label>Images du logement</label>

          <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

              <label
                v-for="(label,index) in [
                  'Image principale',
                  'Image secondaire',
                  'Galerie 1',
                  'Galerie 2'
                ]"
                :key="index"
                class="
                  group
                  relative
                  flex
                  h-52
                  cursor-pointer
                  flex-col
                  items-center
                  justify-center
                  overflow-hidden
                  rounded-2xl
                  border
                  border-dashed
                  border-white/15
                  bg-white/5
                  transition-all
                  duration-300
                  hover:border-cyan-400/40
                  hover:bg-white/10
                "
              >

                <!-- PREVIEW IMAGE -->

                <img
                  v-if="previews[index]"
                  :src="previews[index]"
                  class="
                    absolute
                    inset-0
                    h-full
                    w-full
                    object-cover
                  "
                >

                <!-- OVERLAY -->

                <div
                  class="
                    absolute
                    inset-0
                    bg-gradient-to-t
                    from-slate-950/80
                    via-slate-900/20
                    to-transparent
                  "
                ></div>

                <!-- CONTENT -->

                <div
                  class="
                    relative
                    z-10
                    text-center
                    px-3
                  "
                >

                  <div
                    class="
                      text-5xl
                      mb-3
                      transition-all
                      duration-300
                      group-hover:scale-110
                    "
                  >
                    🖼️
                  </div>

                  <p
                    class="
                      text-sm
                      text-slate-200
                      font-medium
                    "
                  >
                    {{ label }}
                  </p>

                  <p
                    class="
                      mt-2
                      text-xs
                      text-slate-400
                    "
                  >
                    Cliquez pour ajouter une image
                  </p>

                </div>

                <!-- INPUT -->

                <input
                  hidden
                  type="file"
                  accept="image/*"
                  :name="imageFields[index]"
                  @change="handleImageChange($event,index)"
                />

              </label>


          </div>

        </div>


      <!-- INFOS -->

      <div
        class="
          grid
          grid-cols-1
          md:grid-cols-3
          gap-6
        "
      >

        <!-- CHAMBRE -->

        <div>

          <label
            class="
              mb-3
              block
              font-medium
              text-slate-200
            "
          >
            Chambres
          </label>

          <input
            name="nb_chambre"
            v-model="form.nb_chambre"
            type="number"
            min="0"
            class="
              w-full
              rounded-2xl
              border
              border-white/10
              bg-white/5
              px-5
              py-4
              text-white
              backdrop-blur-lg
              transition-all
              duration-300
              focus:border-cyan-400/40
              focus:bg-white/10
              focus:outline-none
              focus:ring-2
              focus:ring-cyan-400/20
            "
          />

        </div>

        <!-- DOUCHE -->

        <div>

          <label
            class="
              mb-3
              block
              font-medium
              text-slate-200
            "
          >
            Douches
          </label>

          <input
            name="nb_douche"
            v-model="form.nb_douche"
            type="number"
            min="0"
            class="
              w-full
              rounded-2xl
              border
              border-white/10
              bg-white/5
              px-5
              py-4
              text-white
              backdrop-blur-lg
              transition-all
              duration-300
              focus:border-cyan-400/40
              focus:bg-white/10
              focus:outline-none
              focus:ring-2
              focus:ring-cyan-400/20
            "
          />

        </div>

        <!-- WC -->

        <div>

          <label
            class="
              mb-3
              block
              font-medium
              text-slate-200
            "
          >
            WC
          </label>

          <input
            name="nb_wc"
            v-model="form.nb_wc"
            type="number"
            min="0"
            class="
              w-full
              rounded-2xl
              border
              border-white/10
              bg-white/5
              px-5
              py-4
              text-white
              backdrop-blur-lg
              transition-all
              duration-300
              focus:border-cyan-400/40
              focus:bg-white/10
              focus:outline-none
              focus:ring-2
              focus:ring-cyan-400/20
            "
          />

        </div>

      </div>

      <!-- DESCRIPTION -->

      <div>

        <label
          class="
            mb-3
            block
            font-medium
            text-slate-200
          "
        >
          Description
        </label>

        <textarea
          name="description"
          v-model="form.description"
          rows="6"
          placeholder="Décrivez le logement..."
          class="
            w-full
            resize-none
            rounded-2xl
            border
            border-white/10
            bg-white/5
            px-5
            py-4
            text-white
            placeholder:text-slate-400
            backdrop-blur-lg
            transition-all
            duration-300
            focus:border-cyan-400/40
            focus:bg-white/10
            focus:outline-none
            focus:ring-2
            focus:ring-cyan-400/20
          "
        ></textarea>

      </div>

      <!-- PRIX -->

      <div>

        <label
          class="
            mb-3
            block
            font-medium
            text-slate-200
          "
        >
          Prix
        </label>

        <input
          name="prix"
          v-model="form.prix"
          type="number"
          placeholder="Ex: 120000"
          class="
            w-full
            rounded-2xl
            border
            border-white/10
            bg-white/5
            px-5
            py-4
            text-white
            placeholder:text-slate-400
            backdrop-blur-lg
            transition-all
            duration-300
            focus:border-cyan-400/40
            focus:bg-white/10
            focus:outline-none
            focus:ring-2
            focus:ring-cyan-400/20
          "
        />

      </div>

      <!-- ACTIONS -->

      <div
        class="
          flex
          flex-col
          sm:flex-row
          sm:justify-end
          gap-4
          pt-4
        "
      >

        <button
          type="reset"
          class="
            rounded-2xl
            border
            border-white/10
            bg-white/5
            px-6
            py-4
            font-medium
            text-white
            backdrop-blur-lg
            transition-all
            duration-300
            hover:bg-white/10
          "
        >
          Annuler
        </button>

        <button
          type="submit"
          class="
            rounded-2xl
            bg-gradient-to-r
            from-cyan-500
            to-blue-600
            px-6
            py-4
            font-semibold
            text-white
            shadow-[0_0_25px_rgba(34,211,238,0.35)]
            transition-all
            duration-300
            hover:scale-[1.02]
            hover:shadow-[0_0_40px_rgba(34,211,238,0.5)]
          "
        >
          Enregistrer
        </button>

      </div>

    </form>

  </div>

</template>