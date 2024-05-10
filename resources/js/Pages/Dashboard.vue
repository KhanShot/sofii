<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";

const users = () => {

}

let props = defineProps({patients: Object})

function click(url) {
    window.location = url
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header >
            <div class="flex justify-between flex-row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight w-0">Пациенты</h2>
                <primary-button @click="click(route('patient.create'))" > Добавить </primary-button>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ФИО
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Пол
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Дата рождения
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Дата проведения тестирования
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Заметки
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Действие
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                            v-for="(patient, index) in props.patients">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{patient.id}}
                            </th>
                            <td class="px-6 py-4">
                                {{patient.name ?? ''}}
                            </td>
                            <td class="px-6 py-4">
                                {{patient.gender ?? ''}}
                            </td>
                            <td class="px-6 py-4">
                                {{patient.birthday}}
                            </td>

                            <td class="px-6 py-4">
                                {{ new Date(patient.created_at).toLocaleDateString('ru-RU') }}
                            </td>
                            <td class="px-6 py-4">
                                {{patient.notes}}
                            </td>
                            <td class="px-6 py-4 text-right flex">
                                <a :href="route('patient.testing.result', patient.id)" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-indigo-500 rounded-lg hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Результаты</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
