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
import Footer from '@/components/Layout/Footer.vue';
import Navbar from '@/components/Layout/Navbar.vue';

defineOptions({
    layout: {
       
    },
});
</script>

<template>

    <Head title="Register" />

    <div class="min-h-screen flex items-center justify-center px-4 bg-gradient-to-br from-indigo-950 via-slate-900 to-cyan-950 bg-cover bg-center">

   
        <div class="w-full max-w-xl bg-slate-950/40 backdrop-blur-xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.5)] rounded-3xl border border-white/10 p-8 sm:p-10 relative overflow-hidden before:absolute before:inset-0 before:bg-gradient-to-tr before:from-transparent before:via-white/5 before:to-transparent before:pointer-events-none">

        
            <Form
                v-bind="store.form()"
                :reset-on-success="['password', 'password_confirmation']"
                v-slot="{ errors, processing }"
                class="flex flex-col gap-6 relative z-10"
            >

            
                <div class="text-center mb-2">
                    <h1 class="text-3xl font-extrabold tracking-tight text-white bg-gradient-to-r from-white via-slate-200 to-cyan-200 bg-clip-text text-transparent">
                        Créer un compte
                    </h1>
                    <p class="mt-2 text-sm text-slate-400 font-medium">
                        Rejoignez notre agence de réservation
                    </p>
                </div>

                <div class="grid gap-5">

                   
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        <div class="grid gap-2">
                            <Label for="name" class="text-xs font-semibold uppercase tracking-wider text-slate-400">Nom complet</Label>
                            <Input
                                id="name"
                                type="text"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="name"
                                name="name"
                                placeholder="John Doe"
                                class="h-12 rounded-xl border-white/10 bg-slate-900/50 text-white placeholder-slate-500 focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/10 transition-all duration-300"
                            />
                            <InputError :message="errors.name" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="email" class="text-xs font-semibold uppercase tracking-wider text-slate-400">Adresse email</Label>
                            <Input
                                id="email"
                                type="email"
                                required
                                :tabindex="2"
                                autocomplete="email"
                                name="email"
                                placeholder="nom@exemple.com"
                                class="h-12 rounded-xl border-white/10 bg-slate-900/50 text-white placeholder-slate-500 focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/10 transition-all duration-300"
                            />
                            <InputError :message="errors.email" />
                        </div>
                        
                    </div>

                  
                    <div class="grid gap-2">
                        <Label for="role" class="text-xs font-semibold uppercase tracking-wider text-slate-400">Choisir Type</Label>
                        <div class="relative">
                            <select
                                id="role"
                                required
                                :tabindex="3"
                                name="role"
                                class="w-full h-12 px-3 rounded-xl border border-white/10 bg-slate-900/50 text-slate-200 focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/10 transition-all duration-300 appearance-none outline-none"
                            >
                                <option value="simple" class="bg-slate-900 text-white">Simple</option>
                                <option value="hotel" class="bg-slate-900 text-white">Hôtel</option>
                                <option value="prestataire" class="bg-slate-900 text-white">Prestataire</option>
                                <option value="particulier" class="bg-slate-900 text-white">Particulier</option>
                            </select>
              
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        <InputError :message="errors.role" />
                    </div>

                   
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        <div class="grid gap-2">
                            <Label for="password" class="text-xs font-semibold uppercase tracking-wider text-slate-400">Mot de passe</Label>
                            <PasswordInput
                                id="password"
                                required
                                :tabindex="4"
                                autocomplete="new-password"
                                name="password"
                                placeholder="••••••••"
                                class="h-12 rounded-xl border-white/10 bg-slate-900/50 text-white placeholder-slate-500 focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/10 transition-all duration-300"
                            />
                            <InputError :message="errors.password" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="password_confirmation" class="text-xs font-semibold uppercase tracking-wider text-slate-400">Confirmation</Label>
                            <PasswordInput
                                id="password_confirmation"
                                required
                                :tabindex="5"
                                autocomplete="new-password"
                                name="password_confirmation"
                                placeholder="••••••••"
                                class="h-12 rounded-xl border-white/10 bg-slate-900/50 text-white placeholder-slate-500 focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/10 transition-all duration-300"
                            />
                            <InputError :message="errors.password_confirmation" />
                        </div>
                        
                    </div>

                    <Button
                        type="submit"
                        class="mt-4 h-12 w-full rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold tracking-wide shadow-[0_4px_20px_rgba(6,182,212,0.35)] hover:opacity-95 hover:shadow-[0_4px_25px_rgba(6,182,212,0.5)] active:scale-[0.98] transition-all duration-200"
                        tabindex="6"
                        :disabled="processing"
                        data-test="register-user-button"
                    >
                        <Spinner v-if="processing" class="mr-2 text-white" />
                        {{ processing ? 'Création...' : 'Créer un compte' }}
                    </Button>

                </div>


                <div class="text-center text-sm text-slate-400 mt-2">
                    Déjà un compte ?
                    <TextLink
                        :href="login()"
                        class="text-cyan-400 font-bold hover:text-cyan-300 transition-colors ml-1"
                        :tabindex="7"
                    >
                        Se connecter
                    </TextLink>
                </div>

            </Form>
        </div>
    </div>

</template>
