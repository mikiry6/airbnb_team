<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { useTemplateRef } from 'vue';
import ProfileController from '@/actions/App/Http/Controllers/Settings/ProfileController';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { Label } from '@/components/ui/label';

const passwordInput = useTemplateRef('passwordInput');
</script>

<template>

    <div class="space-y-6">

        <Heading
            variant="small"
            title="Supprimer le compte"
            description="Supprime définitivement votre compte et toutes vos données"
        />

        <div
            class="
                relative
                overflow-hidden
                rounded-3xl
                border
                border-red-400/20
                bg-red-500/5
                backdrop-blur-2xl
                p-6
                shadow-[0_0_40px_rgba(239,68,68,0.08)]
            "
        >

            <!-- Glow -->
            <div
                class="
                    absolute
                    -top-20
                    -right-20
                    w-52
                    h-52
                    bg-red-500/10
                    blur-[100px]
                    rounded-full
                    pointer-events-none
                "
            ></div>

            <div class="relative z-10">

                <!-- Warning -->
                <div
                    class="
                        flex
                        items-start
                        gap-4
                        rounded-2xl
                        border
                        border-red-400/10
                        bg-white/5
                        p-5
                        backdrop-blur-xl
                    "
                >

                    <div
                        class="
                            flex
                            items-center
                            justify-center
                            w-14
                            h-14
                            rounded-2xl
                            bg-red-500/15
                            text-3xl
                            shrink-0
                        "
                    >
                        ⚠️
                    </div>

                    <div>

                        <h3
                            class="
                                text-lg
                                font-semibold
                                text-red-300
                            "
                        >
                            Attention
                        </h3>

                        <p
                            class="
                                mt-2
                                text-sm
                                leading-relaxed
                                text-slate-300
                            "
                        >
                            Cette action est irréversible.
                            Toutes vos données,
                            logements,
                            réservations
                            et informations associées
                            seront supprimés définitivement.
                        </p>

                    </div>

                </div>

                <!-- Button -->
                <div class="mt-6">

                    <Dialog>

                        <DialogTrigger as-child>

                            <Button
                                variant="destructive"
                                data-test="delete-user-button"
                                class="
                                    rounded-2xl
                                    px-6
                                    py-6
                                    text-sm
                                    font-semibold
                                    bg-gradient-to-r
                                    from-red-500
                                    to-red-600
                                    hover:from-red-400
                                    hover:to-red-500
                                    shadow-[0_0_25px_rgba(239,68,68,0.35)]
                                    transition-all
                                    duration-300
                                "
                            >
                                Supprimer mon compte
                            </Button>

                        </DialogTrigger>

                        <!-- MODAL -->
                        <DialogContent
                            class="
                                border
                                border-white/10
                                bg-slate-950/95
                                backdrop-blur-2xl
                                text-white
                                rounded-3xl
                                shadow-[0_0_60px_rgba(0,0,0,0.6)]
                            "
                        >

                            <Form
                                v-bind="ProfileController.destroy.form()"
                                reset-on-success
                                @error="() => passwordInput?.focus()"
                                :options="{
                                    preserveScroll: true,
                                }"
                                class="space-y-6"
                                v-slot="{ errors, processing, reset, clearErrors }"
                            >

                                <DialogHeader class="space-y-4">

                                    <div
                                        class="
                                            flex
                                            items-center
                                            justify-center
                                            w-20
                                            h-20
                                            rounded-full
                                            bg-red-500/10
                                            mx-auto
                                            text-5xl
                                        "
                                    >
                                        🗑️
                                    </div>

                                    <DialogTitle
                                        class="
                                            text-center
                                            text-2xl
                                            font-bold
                                            text-white
                                        "
                                    >
                                        Confirmer la suppression
                                    </DialogTitle>

                                    <DialogDescription
                                        class="
                                            text-center
                                            text-slate-400
                                            leading-relaxed
                                        "
                                    >
                                        Une fois votre compte supprimé,
                                        toutes vos données seront définitivement perdues.
                                        Veuillez entrer votre mot de passe
                                        pour confirmer cette action.
                                    </DialogDescription>

                                </DialogHeader>

                                <!-- PASSWORD -->
                                <div class="grid gap-3">

                                    <Label
                                        for="password"
                                        class="text-slate-300"
                                    >
                                        Mot de passe
                                    </Label>

                                    <PasswordInput
                                        id="password"
                                        name="password"
                                        ref="passwordInput"
                                        placeholder="Votre mot de passe"
                                        class="
                                            h-12
                                            rounded-2xl
                                            border
                                            border-white/10
                                            bg-white/5
                                            text-white
                                            placeholder:text-slate-500
                                            focus:border-red-400/40
                                            focus:ring-red-500/20
                                        "
                                    />

                                    <InputError
                                        :message="errors.password"
                                    />

                                </div>

                                <!-- ACTIONS -->
                                <DialogFooter
                                    class="
                                        gap-3
                                        pt-4
                                    "
                                >

                                    <DialogClose as-child>

                                        <Button
                                            variant="secondary"
                                            class="
                                                rounded-2xl
                                                bg-white/5
                                                border
                                                border-white/10
                                                text-slate-300
                                                hover:bg-white/10
                                            "
                                            @click="
                                                () => {
                                                    clearErrors();
                                                    reset();
                                                }
                                            "
                                        >
                                            Annuler
                                        </Button>

                                    </DialogClose>

                                    <Button
                                        type="submit"
                                        variant="destructive"
                                        :disabled="processing"
                                        data-test="confirm-delete-user-button"
                                        class="
                                            rounded-2xl
                                            bg-gradient-to-r
                                            from-red-500
                                            to-red-600
                                            hover:from-red-400
                                            hover:to-red-500
                                            shadow-[0_0_20px_rgba(239,68,68,0.4)]
                                        "
                                    >
                                        Supprimer définitivement
                                    </Button>

                                </DialogFooter>

                            </Form>

                        </DialogContent>

                    </Dialog>

                </div>

            </div>

        </div>

    </div>

</template>

