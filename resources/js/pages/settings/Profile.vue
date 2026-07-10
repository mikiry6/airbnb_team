<script setup lang="ts">
import { Form, Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import ProfileController from '@/actions/App/Http/Controllers/Settings/ProfileController';
import DeleteUser from '@/components/DeleteUser.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { edit } from '@/routes/profile';
import { send } from '@/routes/verification';

type Props = {
    mustVerifyEmail: boolean;
    status?: string;
};

defineProps<Props>();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Profile settings',
                href: edit(),
            },
        ],
    },
});

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>


<template>

    <Head title="Profile settings" />

    <div
        class="
            relative
            min-h-screen
            overflow-hidden
            text-white
        "
    >

        <!-- BACKGROUND GLOW -->

        <div class="absolute inset-0 pointer-events-none">

            <div
                class="
                    absolute
                    top-0
                    left-0
                    w-[350px]
                    h-[350px]
                    bg-cyan-500/10
                    blur-[120px]
                    rounded-full
                "
            ></div>

            <div
                class="
                    absolute
                    bottom-0
                    right-0
                    w-[300px]
                    h-[300px]
                    bg-blue-600/10
                    blur-[120px]
                    rounded-full
                "
            ></div>

        </div>

        <!-- CONTENT -->

        <div
            class="
                relative
                z-10
                max-w-4xl
                mx-auto
                px-4
                md:px-6
                py-10
            "
        >

            <!-- HEADER -->

            <div class="mb-10">

                <h1
                    class="
                        text-4xl
                        md:text-5xl
                        font-bold
                        bg-gradient-to-r
                        from-cyan-300
                        to-blue-400
                        bg-clip-text
                        text-transparent
                    "
                >
                    Paramètres du profil
                </h1>

                <p
                    class="
                        text-slate-400
                        mt-3
                        text-sm
                        md:text-base
                    "
                >
                    Gérez vos informations personnelles et votre compte
                </p>

            </div>

            <!-- PROFILE CARD -->

            <div
                class="
                    rounded-3xl
                    border
                    border-white/10
                    bg-white/5
                    backdrop-blur-xl
                    p-6
                    md:p-8
                    shadow-[0_0_50px_rgba(0,150,255,0.08)]
                "
            >

                <!-- USER INFO -->

                <div
                    class="
                        flex
                        flex-col
                        md:flex-row
                        md:items-center
                        gap-6
                        mb-10
                        pb-8
                        border-b
                        border-white/10
                    "
                >

                    <div
                        class="
                            w-24
                            h-24
                            rounded-full
                            bg-gradient-to-br
                            from-cyan-400
                            to-blue-600
                            flex
                            items-center
                            justify-center
                            text-3xl
                            font-bold
                            shadow-[0_0_25px_rgba(34,211,238,0.35)]
                        "
                    >
                        {{ user.name.charAt(0) }}
                    </div>

                    <div>

                        <h2
                            class="
                                text-2xl
                                font-bold
                            "
                        >
                            {{ user.name }}
                        </h2>

                        <p class="text-slate-400 mt-1">
                            {{ user.email }}
                        </p>

                    </div>

                </div>

                <!-- FORM -->

                <Form
                    v-bind="ProfileController.update.form()"
                    class="space-y-8"
                    v-slot="{ errors, processing }"
                >

                    <!-- NAME -->

                    <div class="space-y-3">

                        <Label
                            for="name"
                            class="
                                text-slate-300
                                text-sm
                            "
                        >
                            Nom complet
                        </Label>

                        <Input
                            id="name"
                            name="name"
                            :default-value="user.name"
                            required
                            autocomplete="name"
                            placeholder="Votre nom complet"
                            class="
                                h-12
                                rounded-2xl
                                border
                                border-white/10
                                bg-white/5
                                backdrop-blur-md
                                text-white
                                placeholder:text-slate-500
                                focus:border-cyan-400/40
                                focus:ring-0
                            "
                        />

                        <InputError
                            class="text-red-400"
                            :message="errors.name"
                        />

                    </div>

                    <!-- EMAIL -->

                    <div class="space-y-3">

                        <Label
                            for="email"
                            class="
                                text-slate-300
                                text-sm
                            "
                        >
                            Adresse email
                        </Label>

                        <Input
                            id="email"
                            type="email"
                            name="email"
                            :default-value="user.email"
                            required
                            autocomplete="username"
                            placeholder="Votre adresse email"
                            class="
                                h-12
                                rounded-2xl
                                border
                                border-white/10
                                bg-white/5
                                backdrop-blur-md
                                text-white
                                placeholder:text-slate-500
                                focus:border-cyan-400/40
                                focus:ring-0
                            "
                        />

                        <InputError
                            class="text-red-400"
                            :message="errors.email"
                        />

                    </div>

                    <!-- EMAIL VERIFY -->

                    <div
                        v-if="mustVerifyEmail && !user.email_verified_at"
                        class="
                            rounded-2xl
                            border
                            border-amber-400/20
                            bg-amber-500/10
                            p-5
                        "
                    >

                        <p
                            class="
                                text-sm
                                text-amber-200
                            "
                        >
                            Votre adresse email n’est pas vérifiée.
                        </p>

                        <Link
                            :href="send()"
                            as="button"
                            class="
                                mt-3
                                inline-flex
                                text-cyan-300
                                hover:text-cyan-200
                                transition-colors
                            "
                        >
                            Renvoyer l’email de vérification
                        </Link>

                        <div
                            v-if="status === 'verification-link-sent'"
                            class="
                                mt-4
                                text-sm
                                text-green-300
                            "
                        >
                            Un nouveau lien de vérification a été envoyé.
                        </div>

                    </div>

                    <!-- BUTTON -->

                    <div class="pt-4">

                        <Button
                            :disabled="processing"
                            data-test="update-profile-button"
                            class="
                                h-12
                                px-8
                                rounded-2xl
                                border-0
                                bg-gradient-to-r
                                from-cyan-500
                                to-blue-600
                                hover:from-cyan-400
                                hover:to-blue-500
                                text-white
                                shadow-[0_0_25px_rgba(34,211,238,0.35)]
                                transition-all
                                duration-300
                            "
                        >
                            Sauvegarder
                        </Button>

                    </div>

                </Form>

            </div>

            <!-- DELETE ACCOUNT -->

            <div class="mt-8">

                <div
                    class="
                        rounded-3xl
                        border
                        border-red-500/10
                        bg-red-500/5
                        backdrop-blur-xl
                        p-6
                    "
                >

                    <DeleteUser />

                </div>

            </div>

        </div>

    </div>

</template>


