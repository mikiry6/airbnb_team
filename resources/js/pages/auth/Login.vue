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
import Footer from '@/components/Layout/Footer.vue';
import Navbar from '@/components/Layout/Navbar.vue';

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

    <div class="min-h-screen flex items-center justify-center px-4 bg-gradient-to-br from-indigo-950 via-slate-900 to-cyan-950 bg-cover bg-center">
        
   
        <div class="w-full max-w-md bg-slate-950/40 backdrop-blur-xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.6)] rounded-3xl border border-white/10 p-8 relative overflow-hidden before:absolute before:inset-0 before:bg-gradient-to-tr before:from-transparent before:via-white/5 before:to-transparent before:pointer-events-none">
            
            
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-32 bg-cyan-500/10 blur-2xl rounded-full pointer-events-none"></div>

           
            <div class="mb-8 text-center relative z-10">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-900/80 border border-white/10 shadow-lg text-cyan-400">
                    <svg
                        xmlns="http://w3.org"
                        class="h-6 w-6 animate-pulse"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                        />
                    </svg>
                </div>

                <h1 class="text-3xl font-extrabold tracking-tight text-white bg-gradient-to-r from-white via-slate-200 to-cyan-200 bg-clip-text text-transparent">
                    Connexion
                </h1>

                <p class="mt-2 text-sm text-slate-400 font-medium">
                    Accédez à votre espace de réservation
                </p>
            </div>

         
            <div
                v-if="status"
                class="mb-6 rounded-xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-center text-sm font-medium text-emerald-400 backdrop-blur-sm"
            >
                {{ status }}
            </div>

       
            <Form
                v-bind="store.form()"
                :reset-on-success="['password']"
                v-slot="{ errors, processing }"
                class="space-y-5 relative z-10"
            >
            
                <div class="space-y-2">
                    <Label
                        for="email"
                        class="text-xs font-semibold uppercase tracking-wider text-slate-400"
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
                        placeholder="nom@exemple.com"
                        class="h-12 rounded-xl border-white/10 bg-slate-900/50 text-white placeholder-slate-500 focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/10 transition-all duration-300"
                    />

                    <InputError :message="errors.email" />
                </div>

             
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <Label
                            for="password"
                            class="text-xs font-semibold uppercase tracking-wider text-slate-400"
                        >
                            Mot de passe
                        </Label>

                        <TextLink
                            v-if="canResetPassword"
                            :href="request()"
                            class="text-xs font-semibold text-cyan-400 hover:text-cyan-300 transition-colors"
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
                        class="h-12 rounded-xl border-white/10 bg-slate-900/50 text-white placeholder-slate-500 focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/10 transition-all duration-300"
                    />

                    <InputError :message="errors.password" />
                </div>

               
                <div class="flex items-center justify-between pt-1">
                    <Label
                        for="remember"
                        class="flex items-center gap-3 text-sm text-slate-300 cursor-pointer group"
                    >
                        <Checkbox
                            id="remember"
                            name="remember"
                            :tabindex="3"
                            class="border-white/20 bg-slate-900/50 data-[state=checked]:bg-cyan-500 data-[state=checked]:border-cyan-500 rounded-md transition-all group-hover:border-cyan-500/50"
                        />

                        <span class="text-xs text-slate-400 group-hover:text-slate-300 transition-colors">Se souvenir de moi</span>
                    </Label>
                </div>

              
                <Button
                    type="submit"
                    class="mt-2 h-12 w-full rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold tracking-wide shadow-[0_4px_20px_rgba(6,182,212,0.35)] hover:opacity-95 hover:shadow-[0_4px_25px_rgba(6,182,212,0.5)] active:scale-[0.98] transition-all duration-200"
                    :tabindex="4"
                    :disabled="processing"
                    data-test="login-button"
                >
                    <Spinner v-if="processing" class="mr-2 text-white" />
                    {{ processing ? 'Connexion...' : 'Se connecter' }}
                </Button>

               
                <div
                    class="pt-2 text-center text-sm text-slate-400"
                    v-if="canRegister"
                >
                    Vous n'avez pas encore de compte ?
                    <TextLink
                        :href="register()"
                        :tabindex="5"
                        class="font-bold text-cyan-400 hover:text-cyan-300 transition-colors ml-1"
                    >
                        Créer un compte
                    </TextLink>
                </div>
            </Form>
        </div>
    </div>
</template>
