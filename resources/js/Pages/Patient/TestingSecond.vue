<script setup>


import { useForm } from '@inertiajs/vue3'
import {reactive, watch} from "vue";
import RightEyeClose from "@/Components/Testing/RightEyeClose.vue";


let props = defineProps({params: Object})


const form = useForm({
    all_dots: null,
    pressed_dots: null,
    patient_id: null,
    eye: 'right'
})


const data = reactive({
    seconds: -2,
    left_eye: true,
    right_eye: false,
    timeout: 1000,
    next: true,
    start_dot: false,
});
let divElement;
setTimeout(function() {
    divElement = document.getElementById('sector')

}, 500);




setInterval(setTime, data.timeout);

function setTime() {
    ++data.seconds;
}

let sector = 1 * props.params.sectors;

let all_dots = []
let pressed_dots = []
let items = [
    'red', 'white', 'blue' , 'green'
];

function in_circle(cx, cy, x, y, rad) {
    return (x - cx) * (x - cx) +
        (y - cy) * (y - cy) < rad * rad ;
}


function getOffset(el) {
    const rect = el.getBoundingClientRect();
    return {
        x: rect.left + window.scrollX,
        y: rect.top + window.scrollY
    };
}

watch(()=> data.seconds, () =>{
    if (data.seconds >= 4){
        data.left_eye = false
        data.start_dot = true
        if (sector > 0){
            let item = items[Math.floor(Math.random()*items.length)];
            const point = document.createElement("div");
            point.classList.add("point");
            point.id = 'point_' + sector
            point.style.background = item

            const divWidth = divElement.offsetWidth;
            const divHeight = divElement.offsetHeight;

            let x = Math.random() * divWidth;
            let y = Math.random() * divHeight;


            if (data.seconds % 2){
                const divCenter = document.getElementById('center_dot')
                const center_dot = getOffset(divCenter)

                let dist = in_circle(center_dot.x, center_dot.y, x, y, divHeight/2)
                let res = {
                    dist: 0,
                    cx: center_dot.x,
                    cy: center_dot.y,
                    r: divHeight / 2,
                    x: x,
                    y: y,
                    inside: dist,
                }

                if (!dist){
                    console.log(`new x${x}`)
                    x = Math.random() * divWidth;
                    y = Math.random() * divHeight;
                    let dist2 = in_circle(center_dot.x, center_dot.y, x, y, divHeight/2)
                    if (!dist2){
                        console.log(`second level new x${x}`)
                        x = Math.random() * divWidth;
                        y = Math.random() * divHeight;

                    }
                }
                point.style.left = `${x}px`;
                point.style.top = `${y}px`;
                console.log(res)
                console.log(dist)

                all_dots[sector] = [x, y]

                divElement.appendChild(point)

                sector--;
            }
            setTimeout(function() {
                point.remove();
            }, 1500);

            window.onkeydown = function () {
                pressed_dots[sector] = [x, y]
            }
        }

        if (sector <= 0){
            form.all_dots = all_dots
            form.pressed_dots = pressed_dots
            form.patient_id = props.params.patient_id
            form.post(route('patient.testing.submit'))
            window.location = route('patient.testing.result', props.params.patient_id)
        }

    }
})


</script>

<template>
    <div class="">
        <div id="sector" class="relative flex box-border justify-center items-center h-screen bg-black rounded-full border border-l-white" style="width: 980px">
            <right-eye-close v-if="data.left_eye" ></right-eye-close>
            <div id="center_dot" class="bg-white p-1 rounded" v-if="data.start_dot"></div>
        </div>
    </div>
</template>
<style>
body{
    background: black;
}

.point{
    padding: 5px;
    border-radius: 10px;
    position: absolute;
}

</style>
