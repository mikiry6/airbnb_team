<script setup >
    
</script>

<template>
    
    <div class="min-h-screen ">

        <!-- HEADER -->
        <div class="mb-10">

            <h1
                class="
                    text-3xl
                    md:text-5xl
                    font-bold
                    bg-gradient-to-r
                    from-cyan-300
                    to-blue-400
                    bg-clip-text
                    text-transparent
                "
            >
                Dashboard Prestataire
            </h1>

            <p
                class="
                    text-slate-400
                    mt-3
                    text-sm
                    md:text-base
                "
            >
                Vue d’ensemble de votre activité
            </p>

        </div>

        <div class="p-8">

            <!-- STATISTIQUES -->
            <div class="grid md:grid-cols-4 gap-6 mb-10">

                <div
                    class="
                        group
                        relative
                        overflow-hidden
                        rounded-3xl
                        border
                        border-white/10
                        bg-white/5
                        backdrop-blur-xl
                        p-6
                        transition-all
                        duration-500
                        hover:-translate-y-2
                        hover:border-cyan-400/40
                    "
                >

                    <div
                        class="
                            absolute
                            inset-0
                            bg-gradient-to-br
                            from-cyan-500/5
                            to-transparent
                            opacity-0
                            group-hover:opacity-100
                            transition-all
                            duration-500"
                    >
                    </div>

                    <div class="relative z-10 flex justify-between items-center">

                        <div>

                            <p class="text-4xl">
                                
                            </p>

                            <h2 class=" text-white text-2xl font-bold mt-3">
                                Total services
                            </h2>

                        </div>

                        <span
                            class="
                                text-5xl
                                font-bold
                                text-cyan-300
                            "
                        >
                            
                        </span>

                    </div>

                </div>

                <div
                    class="
                        group
                        relative
                        overflow-hidden
                        rounded-3xl
                        border
                        border-white/10
                        bg-white/5
                        backdrop-blur-xl
                        p-6
                        transition-all
                        duration-500
                        hover:-translate-y-2
                        hover:border-cyan-400/40
                    "
                >

                    <div
                        class="
                            absolute
                            inset-0
                            bg-gradient-to-br
                            from-cyan-500/5
                            to-transparent
                            opacity-0
                            group-hover:opacity-100
                            transition-all
                            duration-500"
                    >
                    </div>

                    <div class="relative z-10 flex justify-between items-center">

                        <div>

                            <p class="text-4xl">
                                
                            </p>

                            <h2 class=" text-white text-2xl font-bold mt-3">
                                Pays disponibles
                            </h2>

                        </div>

                        <span
                            class="
                                text-5xl
                                font-bold
                                text-cyan-300
                            "
                        >
                            
                        </span>

                    </div>

                </div>

            </div>

            <!-- ACTIONS RAPIDES -->
            <div class="grid md:grid-cols-3 gap-6 mb-10">

                <div 
                    class=" overflow-hidden
                        rounded-3xl
                        border
                        border-white/10
                        bg-white/5
                        backdrop-blur-xl
                         p-6 shadow-lg
                    "
                >

                    <h2 class="text-xl text-cyan-300 font-bold mb-5">
                        Actions Rapides
                    </h2>

                    <div class="space-y-3">

                        <Link
                            href="/prestataire/services/create"
                            class="block text-center bg-blue-500 text-white py-3 rounded-xl"
                        >
                            Ajouter Service
                        </Link>

                        <Link
                            href="/prestataire/dashboard"
                            class="block text-center bg-green-500 text-white py-3 rounded-xl"
                        >
                            Voir Services
                        </Link>

                    </div>

                </div>

                <!-- ACTIVITE -->
                <div class="
                        border-white/10
                        bg-white/5
                        backdrop-blur-xl
                         p-6 shadow-lgp-6 rounded-3xl shadow-lg md:col-span-2"
                >

                    <h2 class=" text-gray-100 text-xl font-bold mb-5">
                        Résumé
                    </h2>

                    <div class="space-y-3">

                        <div class="flex justify-between border-b pb-3">

                            <span class="text-gray-100" >Total des services enregistrés</span>

                            <span class="font-bold">
                                
                            </span>

                        </div>

                        <div class="flex justify-between border-b pb-3">

                            <span class="text-gray-100" >Pays représentés</span>

                            <span class="font-bold">
                                
                            </span>

                        </div>

                        <div class="flex justify-between">

                            <span class="text-gray-100" >Services ajoutés ce mois</span>

                            <span class="font-bold">
                               
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</template>