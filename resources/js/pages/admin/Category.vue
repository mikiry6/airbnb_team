<script setup >

    import Modal from '@/components/app_componnent/Modal.vue';
    import { defineProps, ref } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import Category_form from './Category_form.vue';
    import Swal from 'sweetalert2';
    import Category_update_form from './Category_update_form.vue';

    const props = defineProps([
        'categories'
    ])

    // -----------------FORM USE
    // const form = useForm()
    
    // ----------------MODAL ET AJOUT ET MODIF
    const isAjout = ref(false)  
    // const isUpdate =ref(null)

    const andrana = ref(null)
    console.log(andrana.value);
    
    const handle_manakatona_updateForm = (data) =>{
        
        isUpdate.value = data
        // console.log('ito'+isUpdate.value);
        
    }

    const handleAjoute = ()=>{

        isAjout.value =true
        console.log(isAjout.value);
        
    }

    // ----------------------------METHODE 2
    const isModif = ref(null)
    // const title_temporaire = ref(null)
    const form =useForm({
        title:''
    })

    const handle_isModif = (categ)=>{

        isModif.value = categ
        // title_temporaire.value = categ.title
        form.title = categ.title
        form.errors.title = null
        console.log(form.title );
        // console.log(isModif.value);
    }

    const doModif = (id)=>{
        
        // console.log(form.title);
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
                isModif.value =false
            },
            onError:()=>{

            }
        })
    }

    const handle_cancel_modif = ()=>{

        isModif.value = false
        form.errors.title = null
                
    }

    
    // ----------------------------------------------------------------------------
    // ----------A mettre su button modifier
    // @click="handleUpdate(categ)"
    // const handleUpdate = (data)=>{

    //     isUpdate.value =data
    //     // console.log(isUpdate.value);
    //     // console.log(data);     
        
    // }

    const handleCloseModal = (data)=>{
        console.log(data);
        isAjout.value = data
        isUpdate.value = data
        
    }
    //  ----------------SUPPRESSION
    const handleDelete = (id)=>{

        Swal.fire({
            title: "Etes vous sur??",
            text: "Cette action est irrevocable",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed){
                form.delete(`/admin/categ/delete/${id}`,{
                    onSuccess:()=>{
                
                        Swal.fire({

                            title: "Supprimer!",
                            text: "Suppression reussie",
                            icon: "success"
                        });
                        
                    }
                })
            } 
        });
        
        // console.log('en cours de suppression');
    }
     
</script>


<template>

    <h1 class="text-center mt-5 text-2xl text-white" >Liste Category</h1>

    <!-- ------------------- -->
    <button 
        @click="handleAjoute"
        class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded-lg transition">
        Ajouter
    </button>
    <!-- -------------------- -->

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-xl shadow-md overflow-hidden opacity-70">
            <thead class="bg-gray-100">
            <tr>
                <th class="text-center px-6 py-3 text-sm font-semibold text-gray-600 uppercase tracking-wider">
                Name
                </th>
                <th class="text-center px-6 py-3 text-sm font-semibold text-gray-600 uppercase tracking-wider">
                Slug
                </th>
                <th class="text-center px-6 py-3 text-sm font-semibold text-gray-600 uppercase tracking-wider">
                Option
                </th>
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
            <tr v-for="categ in categories" :key="categ.id" class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-gray-800">
                    <span v-if="isModif?.id == categ.id">
                        <input 
                        
                            class = "bg-blue-200 p-2 text-center w-full"
                            type="text"
                            name="title"
                            v-model ="form.title"
                        >
                        <!-- -------------Affichage Erreur -->
                        <div 
                            v-if="form.errors.title "
                            class="p-1 text-white bg-red-500 w-full"
                         >
                            {{ form.errors.title }}
                        </div>
                    </span>
                    <span v-else>
                        {{ categ.title }}
                    </span>
                </td>
                <td class="px-6 py-4 text-gray-800">
                    {{ categ.slug }}
                </td>
                <td 
                    v-if="isModif?.id == categ.id"
                    class="px-6 py-4 flex justify-center gap-2"
                >
                     <button
                        @click="handle_cancel_modif"
                        type="button"
                        class="bg-gray-400 hover:bg-gray-500 text-white text-sm px-4 py-2 rounded-lg transition"
                    >
                        Annuler
                    </button>

                    <button
                        @click="doModif(categ.id)"
                        type="button"
                        class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded-lg transition"
                    >
                        valider
                    </button>
                   
                </td>
                <!-- ---------------------------------------------------------- -->
                <td 
                    v-else
                    class="px-6 py-4 flex justify-center gap-2"
                >
                    <button
                        type="button"
                        @click.prevent="handleDelete(categ.id)"
                        class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-2 rounded-lg transition"
                    >
                        Supprimer
                    </button>
                    
                    <button 
                        @click="handle_isModif(categ)"
                        class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded-lg transition">
                        Modifier
                    </button>
                </td>
                <!-- --MODAL Modif -->
                <!-- <Modal v-if="isUpdate?.id == categ.id" @close-modal="handleCloseModal">
                    <Category_update_form
                        @close-update="handle_manakatona_updateForm"
                        :categ_title="`${categ.title}`"
                        :id="`${categ.id}`"
                    />
                </Modal> -->
            </tr>
            </tbody>
        </table>
    </div>

        <!-----------------MODAL Ajout -->
        <Modal v-if="isAjout" @close-modal="handleCloseModal">
            <Category_form/>
        </Modal>
        
</template>