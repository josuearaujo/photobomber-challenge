<template>
    <div class="flex flex-col items-center justify-center">
        <div class="h-[400px] w-[400px] bg-white border-b border-gray-200 shadow-2xl rounded-md m-auto flex justify-center items-center">
            <div :class="getGridClass()" class="w-[370px]">
                <div v-for="photo in photos" class="p-1">
                    <div class="flex justify-center items-center w-[100%] h-[100%]">
                        <img :src="'/photos/' + photo.id" alt="" class="max-h-[100%]">
                    </div>
                </div>
            </div>
        </div>
        <span class="text-md mt-1 text-gray-500">{{pageNumber}}</span>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({ photos: Array, layout: Number, pageNumber: Number });

const getGridClass = () => {
    if (props.layout === 2) {
        // For layout 2, two columns
        return 'h-[370px] grid grid-cols-2 grid-rows-1';
    } else if (props.layout === 4) {
        // For layout 4, four columns
        return 'h-[370px] grid grid-cols-2 grid-rows-2';
    } else {
        // For layout 1, one column
        return 'h-[370px] grid grid-cols-1 grid-rows-1';
    }
};
</script>
