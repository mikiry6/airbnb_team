<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { login } from '@/routes';
import { store } from '@/routes/register';

defineOptions({
    layout: {
       
    },
});
</script>

<template>
    <Head title="Register" />

    <div class="min-h-screen flex items-center justify-center px-4 primary_color">

        <!-- Card -->
        <div class="w-full max-w-md bg-white/90 backdrop-blur-sm shadow-2xl rounded-3xl border border-slate-200 p-8">

            <!-- Form -->
            <Form
                v-bind="store.form()"
                :reset-on-success="['password', 'password_confirmation']"
                v-slot="{ errors, processing }"
                class="flex flex-col gap-6"
            >

                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold text-slate-800">
                        Créer un compte
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Rejoignez notre agence de réservation
                    </p>
                </div>

                <div class="grid gap-6">

                    <!-- Name -->
                    <div class="grid gap-2">
                        <Label for="name">Nom complet</Label>
                        <Input
                            id="name"
                            type="text"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="name"
                            name="name"
                            placeholder="Full name"
                            class="h-12 rounded-xl border-slate-300 bg-slate-50 focus:border-blue-400 focus:ring-2 focus:ring-blue-200"
                        />
                        <InputError :message="errors.name" />
                    </div>

                    <!-- Email -->
                    <div class="grid gap-2">
                        <Label for="email">Adresse email</Label>
                        <Input
                            id="email"
                            type="email"
                            required
                            :tabindex="2"
                            autocomplete="email"
                            name="email"
                            placeholder="email@example.com"
                            class="h-12 rounded-xl border-slate-300 bg-slate-50 focus:border-blue-400 focus:ring-2 focus:ring-blue-200"
                        />
                        <InputError :message="errors.email" />
                    </div>

                    <!-- Password -->
                    <div class="grid gap-2">
                        <Label for="password">Mot de passe</Label>
                        <PasswordInput
                            id="password"
                            required
                            :tabindex="3"
                            autocomplete="new-password"
                            name="password"
                            placeholder="••••••••"
                            class="h-12 rounded-xl border-slate-300 bg-slate-50 focus:border-blue-400 focus:ring-2 focus:ring-blue-200"
                        />
                        <InputError :message="errors.password" />
                    </div>

                    <!-- Confirm password -->
                    <div class="grid gap-2">
                        <Label for="password_confirmation">Confirmation</Label>
                        <PasswordInput
                            id="password_confirmation"
                            required
                            :tabindex="4"
                            autocomplete="new-password"
                            name="password_confirmation"
                            placeholder="••••••••"
                            class="h-12 rounded-xl border-slate-300 bg-slate-50 focus:border-blue-400 focus:ring-2 focus:ring-blue-200"
                        />
                        <InputError :message="errors.password_confirmation" />
                    </div>

                    <!-- Submit -->
                    <Button
                        type="submit"
                        class="mt-2 h-12 w-full rounded-xl bg-slate-700 text-white font-semibold shadow-lg hover:bg-slate-800 transition"
                        tabindex="5"
                        :disabled="processing"
                        data-test="register-user-button"
                    >
                        <Spinner v-if="processing" class="mr-2" />
                        {{ processing ? 'Création...' : 'Créer un compte' }}
                    </Button>

                </div>

                <!-- Login link -->
                <div class="text-center text-sm text-slate-500 mt-4">
                    Déjà un compte ?
                    <TextLink
                        :href="login()"
                        class="text-blue-500 font-semibold hover:text-blue-600"
                        :tabindex="6"
                    >
                        Se connecter
                    </TextLink>
                </div>

            </Form>
        </div>
    </div>
</template>
