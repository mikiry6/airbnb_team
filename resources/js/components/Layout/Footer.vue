<template>
    <footer
        class="relative overflow-hidden bg-slate-900 text-slate-300 mt-16"
    >

        <!-- HALO -->

        <div
            class="
                absolute
                bottom-0
                left-1/2
                -translate-x-1/2
                w-[600px]
                h-[600px]
                rounded-full
                bg-blue-500/10
                blur-3xl
            "
        ></div>

        <div
            class="relative max-w-7xl mx-auto px-6 py-16"
        >

            <div
                class="grid md:grid-cols-4 gap-10"
            >

                <!-- LOGO -->

                <div>

                    <h3
                        class="text-2xl font-bold text-white"
                    >
                        StayFinder
                    </h3>

                    <p
                        class="mt-4 text-slate-400 leading-relaxed"
                    >
                        Découvrez des hébergements uniques,
                        des expériences locales et les meilleures
                        destinations partout dans le monde.
                    </p>

                </div>

                <!-- EXPLORER -->

                <div>

                    <h4
                        class="font-semibold text-white mb-4"
                    >
                        Explorer
                    </h4>

                    <ul
                        class="space-y-3"
                    >

                        <li>
                            <a
                                href="#"
                                class="hover:text-white transition"
                            >
                                Hébergements
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                class="hover:text-white transition"
                            >
                                Activités
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                class="hover:text-white transition"
                            >
                                Destinations
                            </a>
                        </li>

                    </ul>

                </div>

                <!-- ENTREPRISE -->

                <div>

                    <h4
                        class="font-semibold text-white mb-4"
                    >
                        Entreprise
                    </h4>

                    <ul
                        class="space-y-3"
                    >

                        <li>
                            <a
                                href="#"
                                class="hover:text-white transition"
                            >
                                À propos
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                class="hover:text-white transition"
                            >
                                Contact
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                class="hover:text-white transition"
                            >
                                Blog
                            </a>
                        </li>

                    </ul>

                </div>

                <!-- NEWSLETTER -->

                <div>

                    <h4
                        class="font-semibold text-white mb-4"
                    >
                        Newsletter
                    </h4>

                    <p
                        class="text-slate-400 mb-4"
                    >
                        Recevez nos meilleures offres de voyage.
                    </p>

                    <div
                        class="flex"
                    >

                        <input
                            type="email"
                            placeholder="Votre email"
                            class="
                                flex-1
                                px-4
                                py-3
                                rounded-l-xl
                                bg-slate-800
                                border
                                border-slate-700
                                text-white
                                outline-none
                            "
                        >

                        <button
                            class="
                                px-5
                                bg-blue-600
                                hover:bg-blue-700
                                rounded-r-xl
                                transition
                            "
                        >
                            OK
                        </button>

                    </div>

                </div>

            </div>

            <!-- SEPARATEUR -->

            <div
                class="border-t border-slate-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center gap-4"
            >

                <p
                    class="text-sm text-slate-500"
                >
                    © 2026 StayFinder. Tous droits réservés.
                </p>

                <div
                    class="flex gap-6 text-sm"
                >

                    <a
                        href="#"
                        class="hover:text-white transition"
                    >
                        Conditions
                    </a>

                    <a
                        href="#"
                        class="hover:text-white transition"
                    >
                        Confidentialité
                    </a>

                    <a
                        href="#"
                        class="hover:text-white transition"
                    >
                        Cookies
                    </a>

                </div>

            </div>

        </div>

    </footer>
</template>