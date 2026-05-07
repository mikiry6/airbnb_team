<script setup >

    import { useForm } from '@inertiajs/vue3';
    import Swal from 'sweetalert2';

    // -----form.processing ->methode dans useform sur form
    const form = useForm({
        title:""
    })

    // -------------Soumission Formulaire
    const handleSubmit = ()=>{

        form.post('/admin/categ/ajout',{
            onSuccess:()=>{
                // console.log(form.title);
                // form.title=""
                Swal.fire({
                    position:'center',
                    title: "Good job!",
                    text: "You clicked the button!",
                    icon: "success",
                    timer:3000
                });
                form.reset();
            },
            onError:()=>{

            }
        })

    }

</script>

<template>

    <form action="" @submit.prevent="handleSubmit"
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
            
            <button 
            
                :disabled="form.processing"
                class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded-lg transition"
            >
                <span v-if="form.processing">
                    ...loading
                </span>
                <span v-else="" >
                    Valider
                </span>
                
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