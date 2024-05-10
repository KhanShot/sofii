<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";

import { useForm } from '@inertiajs/vue3'
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

const queryString = window.location.search;

const urlParams = new URLSearchParams(queryString);
const patient_id = urlParams.get('patient')
console.log(patient_id);

const form = useForm({
    duration: null,
    sectors: null,
    size: null,
    dot_size: null,
    patient_id: patient_id ?? null
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
                <h2 class="font-semibold text-xl text-gray-800">Параметры тестирование</h2>
                <primary-button @click="click(route('patient.create'))"> Назад </primary-button>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <form @submit.prevent="form.post(route('patient.storeParams'))" method="post" class="p-4 space-y-6">
                            <div>
                                <InputLabel for="duration" value="Длительность стимула(сек)" />
                                <TextInput
                                    id="duration"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.duration"
                                    required
                                    autofocus
                                    autocomplete="duration"
                                />

                                <InputError class="mt-2" :message="form.errors.duration" />
                            </div>
                            <div>
                                <InputLabel for="sectors" value="Кол-во секторов" />

                                <select class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="form.sectors" required>
                                    <option value="">Не выбрано</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>

                                <InputError class="mt-2" :message="form.errors.sectors" />
                            </div>

                            <div>
                                <InputLabel for="size" value="Размер стимула" />
                                <TextInput
                                    id="size"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.size"
                                    required
                                    autofocus
                                    autocomplete="size"
                                />

                                <InputError class="mt-2" :message="form.errors.size" />
                            </div>

                            <div>
                                <InputLabel for="dot_size" value="Размер фиксации точкии" />
                                <TextInput
                                    id="dot_size"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.dot_size"
                                    autofocus
                                    autocomplete="dot_size"
                                />

                                <InputError class="mt-2" :message="form.errors.dot_size" />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Далее</PrimaryButton>

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
