<script setup lang="ts">

import { ref, onMounted } from 'vue';
import Globe from '@/components/3D/Globe.vue';
import Navbar from '@/components/Layout/Navbar.vue';
import Footer from '@/components/Layout/Footer.vue';
const activitesPopulaires = ref([
    { titre: 'Tour', description: 'Explorez le monde.', image: '' },
    { titre: 'Tour', description: 'Explorez le monde.', image: ''},
    { titre: 'Tour', description: 'Explorez le monde.', image: ''},
    { titre: 'Tour', description: 'Explorez le monde.', image: '' },
]);

const gridContainer = ref<HTMLElement | null>(null);
const animationTimers = ref<number[]>([]);

onMounted(() => {
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1 
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            const cards = entry.target.querySelectorAll('.animate-card');

            if (entry.isIntersecting) {
                cards.forEach((card, index) => {
                    const timer = window.setTimeout(() => {
                        card.classList.remove('opacity-0', 'translate-y-8');
                        card.classList.add('opacity-100', 'translate-y-0');
                    }, index * 120);
                    
                    animationTimers.value.push(timer);
                });
            } else {
                animationTimers.value.forEach(timer => clearTimeout(timer));
                animationTimers.value = [];

                cards.forEach((card) => {
                    card.classList.remove('opacity-100', 'translate-y-0');
                    card.classList.add('opacity-0', 'translate-y-8');
                });
            }
        });
    }, observerOptions);

    if (gridContainer.value) {
        observer.observe(gridContainer.value);
    }
});

const paysActifIndex = ref(0)
const paysList = ref([
    {
        id: 1,
        nom: 'Japon',
        code: 'JPN',
        nombreLogements: 342,
        image: '',
    },
    {
        id: 2,
        nom: 'Islande',
        code: 'ISL',
        nombreLogements: 89,
        image: '',
    },
    {
        id: 3,
        nom: 'États-Unis',
        code: 'USA',
        nombreLogements: 512,
        image: '',
    },
    {
        id: 4,
        nom: 'France',
        code: 'FRA',
        nombreLogements: 421,
        image: '',
    }
])

// /**
//  * 
//  * @param {Object} pays 
//  */
// const initialiserRecherche = (pays) => {
//     console.log(`[RADAR] Navigation verrouillée sur le secteur : ${pays.nom}`)
// }


interface Pays {
    id: number;
    pays: string;
    latitude: number;
    longitude: number;
}

const props = withDefaults(
    defineProps<{
        canRegister: boolean;
        pays: Pays[];
    }>(),
    {
        canRegister: true,
    },
);
// console.log(props.pays);
console.log(props.pays)
const search = ref('')

const categories = [

    {
        id: 1,
        nom: 'Hôtels',
        icon: '🏨'
    },

    {
        id: 2,
        nom: 'Villas',
        icon: '🏡'
    },

    {
        id: 3,
        nom: 'Chambres',
        icon: '🛏️'
    },

    {
        id: 4,
        nom: 'Activités',
        icon: '🌊'
    }

]

const logementsPopulaires = [
    {},
    {},
    {},
    {}
]




</script>

<template>
    
    <div class="min-h-screen bg-slate-950 text-slate-100 antialiased selection:bg-cyan-500/30 selection:text-cyan-200">

        <header
            class="absolute top-0 left-0 w-full z-50"
        >
            <Navbar/>
        </header>
        <!-- HERO -->

        <section class="relative min-h-screen overflow-hidden bg-slate-950 text-slate-100 border-b border-slate-900 flex items-center">

        <!-- lueurs  -->
            <div class="absolute -top-40 -left-40 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[140px] pointer-events-none"></div>
            <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-cyan-500/10 rounded-full blur-[160px] pointer-events-none"></div>

            <!-- Grille -->
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#1e293b_1px,transparent_1px),linear-gradient(to_bottom,#1e293b_1px,transparent_1px)] bg-[size:4rem_4rem] opacity-[0.02] pointer-events-none"></div>

            <div class="relative z-10 max-w-7xl mx-auto px-6 w-full py-24 lg:py-32">
                <div class="grid grid-cols-1 lg:grid-cols-[40%_60%] gap-12 lg:gap-8 items-center w-full">

                    <!-- COLONNE GAUCHE  -->
                    <div class="max-w-2xl space-y-8 relative z-20">

                    <!-- Titre  -->
                    <div class="space-y-4">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-light tracking-tight leading-[1.1] text-white">
                            Trouvez votre <br />
                            <span class="font-black uppercase bg-clip-text text-transparent bg-gradient-to-r from-white via-slate-200 to-cyan-400">
                                prochaine destination
                            </span>
                        </h1>

                        <p class="text-base md:text-lg text-slate-400 leading-relaxed max-w-lg">
                            Réservez des hôtels, villas uniques et chambres exclusives. Explorez des activités indexées et sélectionnées partout dans le monde.
                        </p>
                    </div>
                            <!-- //xxxxxxxxx -->
                    <div class="pt-4 grid grid-cols-3 gap-4 border-t border-slate-900/60 font-mono">
                        <div>
                            <div class="text-xl font-bold text-white">120+</div>
                            <div class="text-[10px] text-slate-500 uppercase tracking-wider">Destinations</div>
                        </div>
                        <div>
                            <div class="text-xl font-bold text-cyan-400">12k+</div>
                            <div class="text-[10px] text-slate-500 uppercase tracking-wider">Hôtels</div>
                        </div>
                        <div>
                            <div class="text-xl font-bold text-white">99.4%</div>
                            <div class="text-[10px] text-slate-500 uppercase tracking-wider">Fiabilité</div>
                        </div>
                    </div>

                    </div>

                    <!-- COLONNE DROITE -->
                    <div
                    class="
                        relative
                        h-[450px]
                        md:h-[550px]
                        lg:h-[700px]
                        flex
                        items-center
                        justify-center
                        lg:translate-x-10
                    "
                    >

                    <!--  GLOBE  -->
                    <div
                        class="
                            absolute
                            w-[350px]
                            h-[350px]
                            md:w-[500px]
                            md:h-[500px]
                            lg:w-[750px]
                            lg:h-[750px]
                            rounded-full
                            bg-gradient-to-tr from-blue-500/15 to-cyan-500/10
                            blur-[100px]
                            pointer-events-none
                        "
                    ></div>

                    <div class="absolute w-[300px] h-[300px] md:w-[450px] md:h-[450px] lg:w-[580px] lg:h-[580px] border border-slate-800/40 rounded-full pointer-events-none animate-[spin_80s_linear_infinite]"></div>
                    <div class="absolute w-[340px] h-[340px] md:w-[500px] md:h-[500px] lg:w-[640px] lg:h-[640px] border border-dashed border-slate-800/20 rounded-full pointer-events-none animate-[spin_120s_linear_infinite_reverse]"></div>

                    <div
                        class="
                            relative
                            z-10
                            w-full
                            h-full
                            scale-100
                            lg:scale-105
                            flex
                            items-center
                            justify-center
                        "
                    >
                        <div class="w-full h-full flex items-center justify-center p-4">
                            <Globe 
                                :pays="props.pays"
                                class="w-full h-full object-contain"
                            />
                        </div>
                    </div>

                    </div>

                </div>
            </div>

        </section>


        <!-- CATEGORIES -->

        <section class="mx-auto px-6 py-16 bg-slate-950 text-slate-100 rounded-3xl border border-slate-900 my-8 relative overflow-hidden">
            
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-cyan-500/10 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px] pointer-events-none"></div>

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-12 relative z-10">
                <div class="space-y-1">
                    <div class="flex items-center gap-2 text-xs font-mono tracking-[0.4em] text-cyan-400 uppercase">
                        <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-ping"></span>
                        Navigation
                    </div>
                    <h2 class="text-2xl font-light tracking-wide text-white uppercase">
                        Explorer les <span class="font-semibold text-cyan-400">Catégories</span>
                    </h2>
                </div>
                <div class="h-[1px] flex-1 bg-gradient-to-r from-slate-800 to-transparent hidden sm:block mx-6"></div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 relative z-10">

                <div
                    v-for="(categorie, index) in categories"
                    :key="categorie.id"
                    class="
                        group
                        relative
                        bg-gradient-to-b from-slate-900/60 to-slate-900/20
                        backdrop-blur-md
                        rounded-2xl
                        p-8
                        border border-slate-800/60
                        hover:border-cyan-500/30
                        transition-all
                        duration-500
                        cursor-pointer
                        overflow-hidden
                        flex
                        flex-col
                        justify-between
                        h-[220px]
                    "
                    :class="{
                        'sm:col-span-2 lg:col-span-2': index === 0
                    }"
                >
                    <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                    <div class="absolute -right-4 -bottom-4 text-8xl opacity-[0.03] group-hover:opacity-[0.07] group-hover:scale-110 transition-all duration-700 pointer-events-none select-none font-sans">
                        {{ categorie.icon }}
                    </div>

                    <div class="space-y-3 relative z-10">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-mono text-slate-500 group-hover:text-cyan-500/70 transition-colors duration-300">
                                0{{ index + 1 }}
                            </span>
                            <div class="text-2xl transform group-hover:-translate-y-1 transition-transform duration-300">
                                {{ categorie.icon }}
                            </div>
                        </div>
                        <div class="space-y-1 overflow-hidden">
                            <h3 class="font-medium tracking-wide text-slate-200 group-hover:text-cyan-400 transition-all duration-500 group-hover:-translate-y-0.5 text-lg">
                                {{ categorie.nom }}
                            </h3>
                            
                            <p v-if="index === 0" class="text-xs text-slate-400 line-clamp-2 max-w-md transition-all duration-500 delay-75 group-hover:-translate-y-0.5 group-hover:text-slate-300">
                                Découvrez nos destinations vedettes sélectionnées par notre algorithme.
                            </p>
                            
                            <p v-else class="text-xs text-slate-500 line-clamp-2 transition-all duration-500 delay-75 group-hover:-translate-y-0.5 group-hover:text-slate-400">
                                Accéder aux ressources et modules de la section {{ categorie.nom }}.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 text-slate-400 group-hover:text-cyan-400 transition-all duration-500 delay-150 group-hover:-translate-y-0.5 text-xs font-mono mt-4 relative z-10">
                        <span class="tracking-wider uppercase text-[10px] opacity-60 group-hover:opacity-100 transition-opacity">Découvrir</span>
                        <svg xmlns="http://w3.org" class="h-3 w-3 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    
                </div>
            
                <div class="bg-gradient-to-b from-slate-900/40 to-slate-950 rounded-2xl p-8 border border-slate-800/40 flex flex-col justify-between h-[220px] relative overflow-hidden">
                    <div class="space-y-2">
                        <span class="text-[10px] font-mono tracking-widest text-cyan-500/70 uppercase block">Statut Réseau</span>
                        <div class="text-3xl font-black tracking-tight text-white font-mono flex items-baseline gap-1">
                            94.2<span class="text-xs text-cyan-400 font-normal">%</span>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <div class="text-xs font-medium text-slate-300">Systèmes opérationnels</div>
                        <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-cyan-500 h-full w-[94.2%] rounded-full shadow-[0_0_10px_rgba(6,182,212,0.5)]"></div>
                        </div>
                    </div>
                </div>

            </div>

        </section>

      <!-- ACTIVITES -->

        <section class="bg-slate-950 py-20 border-t border-slate-900 relative overflow-hidden">
            
            <div class="absolute top-1/2 left-1/4 w-96 h-96 bg-blue-600/5 rounded-full blur-[130px] pointer-events-none"></div>
            <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-cyan-500/5 rounded-full blur-[120px] pointer-events-none"></div>

            <div class="max-w-7xl mx-auto px-6 relative z-10">

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-12">
                    <div class="space-y-1">
                        <div class="text-xs font-mono tracking-[0.3em] text-cyan-500/70 uppercase">Expériences</div>
                        <h2 class="text-2xl md:text-3xl font-light tracking-wide text-white uppercase">
                            Activités à <span class="font-semibold text-cyan-400">découvrir</span>
                        </h2>
                    </div>
                    <div class="h-[1px] flex-1 bg-gradient-to-r from-slate-900 via-slate-800 to-transparent hidden sm:block mx-8"></div>
                </div>

                <div ref="gridContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    <div
                        v-for="(item, index) in activitesPopulaires"
                        :key="index"
                        class="
                            animate-card
                            opacity-0
                            translate-y-8
                            group
                            relative
                            bg-gradient-to-b from-slate-900/50 to-slate-900/10
                            backdrop-blur-md
                            rounded-2xl
                            overflow-hidden
                            border border-slate-800/80
                            hover:border-cyan-500/30
                            transition-all
                            duration-700
                            ease-out
                            cursor-pointer
                            flex
                            flex-col
                            h-[380px]
                        "
                    >
                        <div class="h-48 w-full bg-slate-900 relative overflow-hidden border-b border-slate-800/50 flex-shrink-0">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent z-10 opacity-60"></div>
                            <div class="w-full h-full bg-slate-800 group-hover:scale-105 transition-transform duration-700 ease-out">
                                <img v-if="item.image" :src="item.image" :alt="item.titre" class="w-full h-full object-cover">
                            </div>
                            <div class="absolute top-4 left-4 z-20 px-2.5 py-1 rounded-md bg-slate-950/80 border border-slate-800 text-[10px] font-mono tracking-wider text-cyan-400 uppercase">
                                Premium
                            </div>
                        </div>

                        <div class="p-5 flex-1 flex flex-col justify-between relative z-20">
                            <div class="space-y-2">
                                <h3 class="font-medium tracking-wide text-slate-200 group-hover:text-cyan-400 transition-colors duration-300 text-base line-clamp-1">
                                    {{ item.titre }}
                                </h3>
                                <p class="text-xs text-slate-400 line-clamp-3 leading-relaxed">
                                    {{ item.description }}
                                </p>
                            </div>

                            <div class="pt-4 border-t border-slate-900/80 flex items-center justify-between font-mono text-xs text-slate-500">
                                <div>
                                    <span class="text-slate-400 font-bold text-sm text-white">45€</span>
                                    <span class="text-[10px] text-slate-600">/pers</span>
                                </div>
                                <div class="flex items-center gap-1 text-cyan-500 opacity-0 group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0 transition-all duration-300">
                                    <span>Réserver</span>
                                    <svg xmlns="http://w3.org" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="absolute inset-0 bg-[linear-gradient(to_right,#1e293b_1px,transparent_1px),linear-gradient(to_bottom,#1e293b_1px,transparent_1px)] bg-[size:14px_24px] opacity-0 group-hover:opacity-[0.03] transition-opacity pointer-events-none"></div>
                    </div>

                </div>

            </div>
        </section>

      <!-- PAYS POPULAIRES -->

        <section class="mx-auto px-6 py-24 bg-slate-950 text-slate-100 relative overflow-hidden">
            
            <div class="absolute top-1/2 left-0 -translate-y-1/2 w-[800px] h-[800px] border border-cyan-500/[0.02] rounded-full pointer-events-none flex items-center justify-center">
                <div class="w-[600px] h-[600px] border border-dashed border-cyan-500/[0.04] rounded-full"></div>
                <div class="w-[400px] h-[400px] border border-blue-500/[0.03] rounded-full absolute"></div>
            </div>
            
            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
                <div class="lg:col-span-5 space-y-4">
                    
                    <div class="mb-10">
                        <span class="font-mono text-xs text-cyan-500 tracking-[0.3em] uppercase block mb-1">WAIT</span>
                        <h2 class="text-3xl font-black uppercase tracking-tight">Secteurs géographiques</h2>
                    </div>

                    <div class="relative border-l border-slate-900 pl-6 space-y-6">
                        <div
                            v-for="(pays, index) in paysList"
                            :key="pays.id"
                            @mouseenter="paysActifIndex = index"
                            @click="initialiserRecherche(pays)"
                            class="group relative cursor-pointer py-2 transition-all duration-300"
                        >

                            <div 
                                class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-2 h-2 rounded-full border bg-slate-950 transition-all duration-300"
                                :class="paysActifIndex === index ? 'border-cyan-400 scale-150 bg-cyan-400 shadow-[0_0_10px_#06b6d4]' : 'border-slate-800 group-hover:border-slate-500'"
                            ></div>

                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="font-mono text-[10px] tracking-wider transition-colors" :class="paysActifIndex === index ? 'text-cyan-400' : 'text-slate-600 group-hover:text-slate-400'">
                                        TOP{{ index + 1 }} && {{ pays.code }}
                                    </span>
                                    <h3 class="text-2xl font-bold tracking-wide transition-all duration-300" :class="paysActifIndex === index ? 'text-white translate-x-2' : 'text-slate-400 group-hover:text-slate-200'">
                                        {{ pays.nom }}
                                    </h3>
                                </div>
                                
                                <span class="font-mono text-xs text-slate-600 group-hover:text-cyan-500/50 transition-colors">
                                    {{ pays.nombreLogements }} NbLog
                                </span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="lg:col-span-7 lg:col-start-6">
                    <div class="relative w-full aspect-[16/10] bg-slate-900/20 border border-slate-900 rounded-3xl overflow-hidden p-3 shadow-[20px_0_50px_-20px_rgba(6,182,212,0.05)]">
                        
                        <div class="absolute inset-0 border border-cyan-500/10 rounded-2xl pointer-events-none z-20 m-4">
                            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-cyan-500/30"></div>
                            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-cyan-500/30"></div>
                            <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-cyan-500/30"></div>
                            <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-cyan-500/30"></div>
                        </div>

                        <div class="absolute inset-0 bg-[linear-gradient(rgba(18,24,38,0)_96%,rgba(6,182,212,0.04)_96%)] bg-[size:100%_8px] z-10 pointer-events-none"></div>

                        <div class="w-full h-full bg-slate-950 rounded-2xl overflow-hidden relative">
                            <transition name="fade" mode="out-in">
                                <img 
                                    :key="paysActifIndex"
                                    src="/design_img/df.gif"  
                                    :alt="paysList[paysActifIndex].nom" 
                                    class="w-full h-full object-cover opacity-50 animate-[pulse_6s_infinite]"
                                />
                            </transition>

                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-slate-950/30"></div>

                            <div class="absolute bottom-6 left-6 right-6 z-20 backdrop-blur-md bg-slate-950/70 border border-slate-900 p-4 rounded-xl flex justify-between items-center">
                                <div>
                                    <span class="text-[10px] font-mono text-cyan-400 block tracking-widest">STATUS: OPTIMAL</span>
                                    <span class="text-xs text-slate-400">Prêt pour l'initialisation du saut quantique vers le secteur {{ paysList[paysActifIndex].code }}.</span>
                                </div>
                                <button class="px-4 py-2 bg-cyan-500/10 hover:bg-cyan-500/20 border border-cyan-500/30 rounded-lg text-cyan-400 font-mono text-xs tracking-wider uppercase transition-all duration-300">
                                    Lancer
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </section>

        <!-- POURQUOI NOUS -->

        <section class="bg-slate-950 text-slate-100 max-w-5xl mx-auto px-6 py-20 border border-slate-900 my-8 rounded-3xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-12 min-h-[520px]">

            <div class="absolute -top-40 -right-40 w-96 h-96 bg-cyan-500/10 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px] pointer-events-none"></div>
            
            <div class="space-y-4 max-w-sm relative z-10 text-center md:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-cyan-500/30 bg-cyan-500/5 text-xs font-semibold uppercase tracking-wider text-cyan-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                    Pourquoi nous ?
                </div>
                <h2 class="text-3xl font-black tracking-tight leading-none text-white">
                    Lorem <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">ipsum dolor.</span>
                </h2>
                <p class="text-xs text-slate-400">
                   Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illo iusto velit nostrum ad aliquam adipisci magnam animi. Rem, molestiae voluptate.
                </p>
            </div>

            <div class="relative w-[320px] h-[320px] sm:w-[380px] sm:h-[380px] lg:w-[400px] lg:h-[400px] flex items-center justify-center flex-shrink-0">
                
                <div class="absolute w-14 h-14 flex items-center justify-center z-20">
                    
                    <div class="absolute inset-0 rounded-full border-2 border-cyan-400 pointer-events-none animate-ping-ring-1"></div>

                    <div class="absolute inset-0 rounded-full border-2 border-cyan-500 pointer-events-none animate-ping-ring-2"></div>

                    <div class="absolute inset-0 bg-gradient-to-tr from-cyan-500 to-blue-600 rounded-full flex items-center justify-center shadow-[0_0_35px_rgba(6,182,212,0.5)] border border-cyan-300/30 animate-pulse">
                        <span class="text-[10px] font-mono font-bold tracking-wider text-white"></span>
                    </div>
                </div>

                <div class="absolute w-[160px] h-[160px] rounded-full border border-slate-800/60 pointer-events-none"></div>
                <div class="absolute w-[160px] h-[160px] rounded-full animate-orbit-1 z-10">

                    <div class="absolute -top-5 left-1/2 -translate-x-1/2 animate-counter-1">
                        <div class="group relative flex items-center gap-2.5 p-2 rounded-xl bg-slate-900/95 border border-slate-800 hover:border-cyan-500/50 shadow-lg backdrop-blur-sm transition-all duration-300 w-[145px]">
                            <div class="w-7 h-7 rounded-lg bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 flex-shrink-0">
                                <svg xmlns="http://w3.org" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 100-18 9 9 0 000 18z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M3 12h18M12 3a13.5 13.5 0 013 9 13.5 13.5 0 01-3 9M12 3a13.5 13.5 0 00-3 9 13.5 13.5 0 003 9"/></svg>
                            </div>
                            <div>
                                <h4 class="text-[11px] font-bold text-white group-hover:text-cyan-400 transition-colors">Mondial</h4>
                                <p class="text-[9px] text-slate-400 line-clamp-1">Recherche globale</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="absolute w-[280px] h-[280px] rounded-full border border-slate-800/40 pointer-events-none"></div>
                <div class="absolute w-[280px] h-[280px] rounded-full animate-orbit-2 z-10">

                    <div class="absolute top-1/2 -left-5 -translate-y-1/2 animate-counter-2">
                        <div class="group relative flex items-center gap-2.5 p-2 rounded-xl bg-slate-900/95 border border-slate-800 hover:border-cyan-500/50 shadow-lg backdrop-blur-sm transition-all duration-300 w-[145px]">
                            <div class="w-7 h-7 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 flex-shrink-0">
                                <svg xmlns="http://w3.org" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            </div>
                            <div>
                                <h4 class="text-[11px] font-bold text-white group-hover:text-blue-400 transition-colors">Logements</h4>
                                <p class="text-[9px] text-slate-400 line-clamp-1">Hébergements</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="absolute w-[400px] h-[400px] rounded-full border border-slate-900 pointer-events-none hidden sm:block"></div>
                <div class="absolute w-[320px] sm:w-[400px] h-[320px] sm:w-[400px] rounded-full animate-orbit-3 z-10">

                    <div class="absolute bottom-4 right-4 sm:bottom-5 sm:right-5 animate-counter-3">
                        <div class="group relative flex items-center gap-2.5 p-2 rounded-xl bg-slate-900/95 border border-slate-800 hover:border-cyan-500/50 shadow-lg backdrop-blur-sm transition-all duration-300 w-[145px]">
                            <div class="w-7 h-7 rounded-lg bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 flex-shrink-0">
                                <svg xmlns="http://w3.org" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14a2 2 0 100-4 2 2 0 000 4z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 2a10 10 0 100 20 10 10 0 000-20z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 6a6 6 0 100 12 6 6 0 000-12z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-[11px] font-bold text-white group-hover:text-emerald-400 transition-colors">Activités</h4>
                                <p class="text-[9px] text-slate-400 line-clamp-1">Expériences locales</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>

        <!-- FOOTER -->
         <Footer/>

    </div>
    
</template>
   <style scoped>
        .animate-orbit-1 { animation: spin-slow 20s linear infinite; }
        .animate-orbit-2 { animation: spin-slow 35s linear infinite; }
        .animate-orbit-3 { animation: spin-slow 50s linear infinite; }
        .animate-counter-1 { animation: spin-reverse 20s linear infinite; }
        .animate-counter-2 { animation: spin-reverse 35s linear infinite; }
        .animate-counter-3 { animation: spin-reverse 50s linear infinite; }
        @keyframes spin-slow { 100% { transform: rotate(360deg); } }
        @keyframes spin-reverse { 100% { transform: rotate(-360deg); } }

        .animate-ping-ring-1 {
          animation: pingRing 3s cubic-bezier(0.25, 0, 0, 1) infinite;
        }
        .animate-ping-ring-2 {
            animation: pingRing 3s cubic-bezier(0.25, 0, 0, 1) infinite;
            animation-delay: 6s; 
        }

        @keyframes pingRing {
            0% {
                transform: scale(0.8);
                opacity: 0.8;
                border-width: 4px;
            }
            50% {
                opacity: 0.4;
            }
            100% {
                transform: scale(2.4); 
                opacity: 0;
                border-width: 1px;
            }
        }
    </style>

<!-- <style scoped>

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.4s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style> -->

