<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";

import { useForm } from '@inertiajs/vue3'
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

const form = useForm({
    name: null,
    gender: null,
    notes: null,
    birthday: null,
})
function click(url) {
    window.location = url
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header >
            <div class="flex justify-between flex-row">
                <h2 class="font-semibold text-xl text-gray-800 ">Добавить пациента</h2>
                <primary-button @click="click(route('dashboard'))"> Назад </primary-button>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <form @submit.prevent="form.post(route('patient.store'))" method="post" class="p-4 space-y-6">
                            <div>
                                <InputLabel for="name" value="ФИО" />
                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div>
                                <InputLabel for="email" value="Пол" />

                                <select class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="form.gender" required>
                                    <option value="Мужской">Мужской</option>
                                    <option value="Женский">Женский</option>
                                </select>

                                <InputError class="mt-2" :message="form.errors.gender" />
                            </div>

                            <div>
                                <InputLabel for="birthday" value="Дата рождение" />
                                <TextInput
                                    id="birthday"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.birthday"
                                    required
                                    autofocus
                                    autocomplete="birthday"
                                />

                                <InputError class="mt-2" :message="form.errors.birhtday" />
                            </div>

                            <div>
                                <InputLabel for="notes" value="Заметки" />
                                <TextInput
                                    id="notes"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.notes"
                                    autofocus
                                    autocomplete="notes"
                                />

                                <InputError class="mt-2" :message="form.errors.notes" />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Сохранить</PrimaryButton>

                                <Transition
                                    enter-active-class="transition ease-in-out"
                                    enter-from-class="opacity-0"
                                    leave-active-class="transition ease-in-out"
                                    leave-to-class="opacity-0"
                                >
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                                </Transition>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
