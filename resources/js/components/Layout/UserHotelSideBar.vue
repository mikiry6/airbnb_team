<script setup>
    import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 text-white relative">
        
        <div class="absolute inset-0 pointer-events-none z-0">
            <div class="absolute -top-10 -left-10 w-[350px] h-[350px] bg-cyan-500/10 blur-[100px] rounded-full"></div>
            <div class="absolute bottom-10 left-20 w-[300px] h-[300px] bg-blue-600/10 blur-[120px] rounded-full"></div>
        </div>

        <aside 
            class="
                relative
                z-10
                w-64 
                hidden 
                md:flex 
                flex-col 
                backdrop-blur-xl 
                bg-blue-950/10 
                border-r 
                border-white/10
                shadow-[5px_0_25px_-5px_rgba(0,149,255,0.05)]
            "
        >
            <div class="p-6 text-2xl font-bold flex items-center border-b border-white/5">
                <img 
                    src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" 
                    class="w-8 h-8 inline-block mr-3 drop-shadow-[0_0_8px_rgba(34,211,238,0.5)]"
                >
                <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">
                    MyApp
                </span>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                <ul class="space-y-2">
                    
                    <li>
                        <Link 
                            href="/user/hotel"
                            class="
                                flex 
                                px-4 
                                py-3 
                                rounded-xl 
                                text-slate-300 
                                hover:text-white 
                                bg-white/0 
                                hover:bg-blue-500/10 
                                border 
                                border-transparent 
                                hover:border-blue-500/20 
                                transition-all 
                                duration-300
                            "
                        >
                            Tableau de Bord
                        </Link>
                    </li>

                    <li>
                        <Link 
                            href="/user/hotel/liste"
                            class="
                                flex 
                                px-4 
                                py-3 
                                rounded-xl 
                                text-slate-300 
                                hover:text-white 
                                bg-white/0 
                                hover:bg-blue-500/10 
                                border 
                                border-transparent 
                                hover:border-blue-500/20 
                                transition-all 
                                duration-300
                            "
                        >
                            Liste Hôtel
                        </Link>
                    </li>

                    <li>
                        <Link 
                            href="/settings/profile"
                            class="
                                flex 
                                px-4 
                                py-3 
                                rounded-xl 
                                text-slate-300 
                                hover:text-white 
                                bg-white/0 
                                hover:bg-blue-500/10 
                                border 
                                border-transparent 
                                hover:border-blue-500/20 
                                transition-all 
                                duration-300
                            "
                        >
                            Profil
                        </Link>
                    </li>

                </ul>
            </nav>
        </aside>

    </div>
</template>