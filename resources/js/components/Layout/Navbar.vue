<script setup lang="ts">

  import { Head, Link } from '@inertiajs/vue3';
  import { login, register } from '@/routes';
  
  withDefaults(

    defineProps<{
        canRegister: boolean;
        }>(),
        {
            canRegister: true,
        },
    );

</script>

<template>
    <div
                class=" mx-auto px-20 py-5  bg-slate-900"
            >

                <nav
                    class="flex items-center justify-between"
                >

                    <!-- LOGO -->

                    <Link
                        href="/"
                        class="text-2xl font-bold text-white"
                    >
                        StayFinder
                    </Link>

                    <!-- MENU -->

                    <div
                        class="hidden md:flex items-center gap-8 text-slate-200"
                    >

                        <Link
                            href="/logement"
                            class="hover:text-white transition"
                        >
                            Logements
                        </Link>

                        <a
                            href="#"
                            class="hover:text-white transition"
                        >
                            Activités
                        </a>

                        <a
                            href="#"
                            class="hover:text-white transition"
                        >
                            Destinations
                        </a>

                        <a
                            href="#"
                            class="hover:text-white transition"
                        >
                            À propos
                        </a>

                    </div>

                    <!-- AUTH -->

                    <div
                        class="flex items-center gap-3"
                    >

                        <Link
                            v-if="$page.props.auth.user"
                            href="/user"
                            class="px-5 py-2 rounded-xl bg-white text-slate-900 font-medium hover:bg-slate-100 transition"
                        >
                            Dashboard
                        </Link>

                        <template v-else>

                            <Link
                                :href="login()"
                                class="text-slate-200 hover:text-white transition"
                            >
                                Connexion
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="register()"
                                class="px-5 py-2 rounded-xl bg-white text-slate-900 font-medium hover:bg-slate-100 transition"
                            >
                                Inscription
                            </Link>

                        </template>

                    </div>

                </nav>

            </div>
</template>