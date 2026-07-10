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
        <h1 class="sr-only">Profile settings</h1>
    <div class="mx-auto max-w-5xl overflow-hidden rounded-3xl border border-slate-800/80 bg-slate-950 shadow-2xl shadow-cyan-950/20 grid grid-cols-1 lg:grid-cols-12">
        
        <div class="p-6 md:p-10 lg:col-span-7 flex flex-col justify-center relative">
            <div class="absolute -top-20 -left-20 h-72 w-72 rounded-full bg-cyan-500/5 blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col space-y-8">
                <div class="border-b border-slate-900 pb-5">
                    <Heading
                        variant="small"
                        title="Profile information"
                        description="Update your name and email address"
                        class="text-slate-100 [&_h2]:text-2xl [&_h2]:font-bold [&_h2]:tracking-tight [&_p]:text-slate-400"
                    />
                </div>

                <Form
                    v-bind="ProfileController.update.form()"
                    class="space-y-6"
                    v-slot="{ errors, processing }"
                >

                    <div class="grid gap-2">
                        <Label for="name" class="text-sm font-semibold tracking-wide text-slate-400">Name</Label>
                        <div class="group relative">
                            <Input
                                id="name"
                                class="block w-full rounded-xl border-slate-800 bg-slate-900/30 px-4 py-3 text-slate-100 placeholder-slate-600 transition-all duration-300 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-950/40 group-hover:border-slate-700"
                                name="name"
                                :default-value="user.name"
                                required
                                autocomplete="name"
                                placeholder="Full name"
                            />
                        </div>
                        <InputError class="mt-1 text-xs font-medium text-rose-400" :message="errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email" class="text-sm font-semibold tracking-wide text-slate-400">Email address</Label>
                        <div class="group relative">
                            <Input
                                id="email"
                                type="email"
                                class="block w-full rounded-xl border-slate-800 bg-slate-900/30 px-4 py-3 text-slate-100 placeholder-slate-600 transition-all duration-300 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-950/40 group-hover:border-slate-700"
                                name="email"
                                :default-value="user.email"
                                required
                                autocomplete="username"
                                placeholder="Email address"
                            />
                        </div>
                        <InputError class="mt-1 text-xs font-medium text-rose-400" :message="errors.email" />
                    </div>

                    <div v-if="mustVerifyEmail && !user.email_verified_at" class="rounded-xl border border-cyan-500/10 bg-cyan-950/20 p-4">
                        <p class="text-sm text-cyan-300/90">
                            Your email address is unverified.
                            <Link
                                :href="send()"
                                as="button"
                                class="ml-1 font-semibold text-cyan-400 underline decoration-cyan-400/20 underline-offset-4 transition-colors hover:text-cyan-300"
                            >
                                Resend verification email
                            </Link>
                        </p>
                        <div v-if="status === 'verification-link-sent'" class="mt-2 text-xs font-medium text-emerald-400 flex items-center gap-1.5">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            Link sent! Check your inbox.
                        </div>
                    </div>

                    <div class="pt-2">
                        <Button 
                            :disabled="processing" 
                            data-test="update-profile-button"
                            class="relative w-full sm:w-auto rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 px-8 py-3 font-bold text-slate-950 shadow-lg shadow-cyan-500/10 transition-all duration-300 hover:from-cyan-400 hover:to-blue-500 hover:shadow-cyan-400/30 hover:scale-[1.01] active:scale-99 disabled:opacity-50"
                        >
                            Save settings
                        </Button>
                    </div>
                </Form>
            </div>
        </div>

        <div class="hidden lg:block lg:col-span-5 relative bg-slate-900 border-l border-slate-800/80 overflow-hidden">
         
            <div class="absolute inset-0 z-10 bg-gradient-to-t from-slate-950 via-transparent to-slate-950/50 pointer-events-none"></div>
            <div class="absolute inset-0 z-10 bg-gradient-to-r from-slate-950 via-transparent to-transparent pointer-events-none"></div>
            
            <img 
                src="/design_img/original.gif" 
                alt="Cyber space animation" 
                class="absolute inset-0 h-full w-full object-cover opacity-40 mix-blend-screen scale-105 select-none"
            />

            <div class="absolute bottom-6 right-6 z-20 rounded-full border border-cyan-500/30 bg-slate-950/80 px-4 py-1.5 backdrop-blur-md">
                <span class="text-xs font-bold tracking-widest text-cyan-400 uppercase flex items-center gap-2">
                    <span class="h-1.5 w-1.5 rounded-full bg-cyan-400 animate-ping"></span>
                    Secure System
                </span>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-5xl mt-6 rounded-3xl border border-rose-950/40 bg-slate-950 p-6 md:p-8 shadow-xl">
        <DeleteUser />
    </div>
</template>
