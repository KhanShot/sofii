<script setup>


import { useForm } from '@inertiajs/vue3'

window.onload = function (e) {
    const divElement = document.getElementById('sector_left')
    divElement.style.width = '490px'
    divElement.style.height = '490px'

    const divRight = document.getElementById('sector_right')
    divRight.style.width = '490px'
    divRight.style.height = '490px'


}

function print() {
    window.print();
}

let props = defineProps({result: Object, patient: Object})
console.log(props.result.right)
const form = useForm({
    all_dots: null,
    pressed_dots: null,
    patient_id: null,
    eye: 'right'
})


const divider = 2;
</script>
<template>
    <div class="flex justify-between ml-20">
        <div class="flex justify-center">
            <div class="flex flex-col">
                <div class="flex flex-row items-center">
                    <div id="sector_left"  class="relative flex box-border justify-center items-center h-screen bg-black rounded-full border border-l-white">
                        <div class="bg-white p-1 rounded"></div>
                        <div class="point" v-for="dot in props.result.left.unpressed_dots" :style="'left:'+dot[0]/divider +'px' + '; top:' +dot[1]/divider+'px' "></div>
                        <div class="point_green" v-for="dot in props.result.left.pressed_dots" :style="'left:'+dot[0]/divider+'px' + '; top:' +dot[1]/divider+'px' "></div>
                    </div>
                    <div class="ml-5 text-3xl">Правый глаз</div>
                </div>

                <div class="flex flex-row items-center">
                    <div id="sector_right"  class="relative flex box-border justify-center items-center h-screen bg-black rounded-full border border-l-white">
                        <div class="bg-white p-1 rounded"></div>
                        <div class="point" v-for="dot in props.result.right.unpressed_dots" :style="'left:'+dot[0]/divider +'px' + '; top:' +dot[1]/divider+'px'"></div>
                        <div class="point_green" v-for="dot in props.result.right.pressed_dots" :style="'left:'+dot[0]/divider+'px' + '; top:' +dot[1]/divider+'px'"></div>
                    </div>
                    <div class="ml-5 text-3xl">Левый глаз</div>
                </div>

            </div>
            <div class="p-1 rounded mx-10 h-screen bg-gray-400"></div>
            <div class="">
                <div class="max-w-md mt-20 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Результаты:</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        <label>ФИО: </label>
                        <span>{{props.patient.name}}</span>
                    </p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        <label>Пол: </label>
                        <span>{{props.patient.gender}}</span>
                    </p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        <label>Дата рождение: </label>
                        <span>{{props.patient.birthday}}</span>
                    </p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        <label>Дата проведение: </label>
                        <span>{{ new Date(props.patient.created_at).toLocaleDateString('ru-RU') }}</span>
                    </p>

                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        <label>Заметки: </label>
                        <span>{{props.patient.notes}}</span>
                    </p>
                    <div class="flex justify-between">
                        <a href="#" @click="print" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-indigo-500 rounded-lg hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Печать
                        </a>
                        <a :href="route('dashboard')"  class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-gray-500 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Закрыть
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</template>
<style>

.point{
    filter: blur(20px);
    background: rgba(255, 0, 0);
    padding: 20px;
    border-radius: 10px;
    position: absolute;
}

.point_green{
    filter: blur(20px);
    background: green;
    padding: 20px;
    border-radius: 10px;
    position: absolute;
}

</style>
