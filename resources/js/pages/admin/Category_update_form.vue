<script setup >

    import { useForm } from '@inertiajs/vue3';
    import Swal from 'sweetalert2';
    import { defineProps } from 'vue';
    import { defineEmits } from 'vue';

    const emit = defineEmits(['close-update'])

    const handleClose = ()=>{
        emit('close-update', null)  
    }

    // -----------------------------------
    const props = defineProps([
        'categ_title',
        'id'
    ])
    
    const form = useForm({

        title:props.categ_title 
    })

    // -------------Soumission Formulaire
    const handleModif = (id) => {

        // console.log(id);
        
        form.put(`/admin/categ/update/${id}`,{
            onSuccess:()=>{
                // console.log(form.title);
                // form.title=""
                Swal.fire({
                    position:'center',
                    title: "Modifiier",
                    text: "Modification reussie",
                    icon: "success",
                });
                form.reset();
                handleClose();
            },
            onError:()=>{

            }
        })

    }

</script>

<template>

    <form action="" @submit.prevent="handleModif(props.id)"
          class="p-2"
    >

        <div class="space-x-2">
            <label for="title" class="block">Name</label>
            <input 
                class="border px-2 py-1 bg-amber-50 w-[80%]"
                id="title"
                name="title"
                type="text" 
                v-model="form.title"
            >
            
            <button class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded-lg transition">
                Valider
            </button>

            <!-- Affichage erreur -->
             <div  
                v-if="form.errors.title"
                class="p-1 bg-red-400 mt-3 rounded-md text-center text-white">
                {{ form.errors.title }}
             </div>

        </div>
        
    </form>

</template>