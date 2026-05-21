<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';

defineOptions({
    layout: {
     
    },
});

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();
</script>

<template>
    <Head title="Log in" />

    <div
        class="min-h-screen  primary_color flex items-center justify-center px-4"
    >
        <div
            class="w-full max-w-md bg-white/90 backdrop-blur-sm shadow-2xl rounded-3xl border border-slate-200 p-8"
        >
            <!-- Header -->
            <div class="mb-8 text-center">
                <div
                    class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-700 shadow-lg"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8 text-white"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h5M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z"
                        />
                    </svg>
                </div>

                <h1 class="text-3xl font-bold text-slate-800">
                    Connexion
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Accédez à votre espace de réservation
                </p>
            </div>

            <!-- Status -->
            <div
                v-if="status"
                class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-center text-sm font-medium text-green-700"
            >
                {{ status }}
            </div>

            <!-- Form -->
            <Form
                v-bind="store.form()"
                :reset-on-success="['password']"
                v-slot="{ errors, processing }"
                class="space-y-6"
            >
                <!-- Email -->
                <div class="space-y-2">
                    <Label
                        for="email"
                        class="text-sm font-semibold text-slate-700"
                    >
                        Adresse email
                    </Label>

                    <Input
                        id="email"
                        type="email"
                        name="email"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="email"
                        placeholder="email@example.com"
                        class="h-12 rounded-xl border-slate-300 bg-slate-50 transition focus:border-blue-400 focus:ring-2 focus:ring-blue-200"
                    />

                    <InputError :message="errors.email" />
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <Label
                            for="password"
                            class="text-sm font-semibold text-slate-700"
                        >
                            Mot de passe
                        </Label>

                        <TextLink
                            v-if="canResetPassword"
                            :href="request()"
                            class="text-sm text-blue-500 hover:text-blue-600"
                            :tabindex="5"
                        >
                            Mot de passe oublié ?
                        </TextLink>
                    </div>

                    <PasswordInput
                        id="password"
                        name="password"
                        required
                        :tabindex="2"
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="h-12 rounded-xl border-slate-300 bg-slate-50 transition focus:border-blue-400 focus:ring-2 focus:ring-blue-200"
                    />

                    <InputError :message="errors.password" />
                </div>

                <!-- Remember -->
                <div class="flex items-center justify-between">
                    <Label
                        for="remember"
                        class="flex items-center gap-3 text-sm text-slate-600"
                    >
                        <Checkbox
                            id="remember"
                            name="remember"
                            :tabindex="3"
                            class="border-slate-400 data-[state=checked]:bg-blue-500 data-[state=checked]:border-blue-500"
                        />

                        <span>Se souvenir de moi</span>
                    </Label>
                </div>

                <!-- Submit -->
                <Button
                    type="submit"
                    class="mt-2 h-12 w-full rounded-xl btn_default text-base font-semibold text-white shadow-lg transition-all duration-300 hover:bg-slate-800 hover:shadow-xl"
                    :tabindex="4"
                    :disabled="processing"
                    data-test="login-button"
                >
                    <Spinner v-if="processing" class="mr-2" />

                    {{ processing ? 'Connexion...' : 'Se connecter' }}
                </Button>

                <!-- Register -->
                <div
                    class="pt-2 text-center text-sm text-slate-500"
                    v-if="canRegister"
                >
                    Vous n'avez pas encore de compte ?

                    <TextLink
                        :href="register()"
                        :tabindex="5"
                        class="font-semibold text-blue-500 hover:text-blue-600"
                    >
                        Créer un compte
                    </TextLink>
                </div>
            </Form>
        </div>
    </div>
</template>
