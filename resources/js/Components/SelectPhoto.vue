<template>
    <div class="relative w-[100%] max-w-[360px] max-h-[360px] flex items-center justify-center bg-slate-50
        p-2 border-2 border-white hover:border-gray-300 hover:duration-1000 rounded-md"
         @mouseover="hover=true" @mouseleave="hover=false"
    >
        <div v-if="isSelected" class="absolute right-2 top-2 w-[24px] h-[24px] cursor-pointer rounded-full z-40 border-2 border-blue-400 flex justify-center items-center">
            <svg width="24px" height="24px" viewBox="0 0 24 24" id="selectedPhoto" class="fill-blue-400">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
            </svg>
        </div>

        <div v-else class="absolute right-2 top-2 w-[24px] h-[24px] cursor-pointer rounded-full z-40 border-2 border-gray-400 flex justify-center items-center">
            <svg width="24px" height="24px" viewBox="0 0 24 24" id="selectedPhoto" class="fill-gray-400" :class="hover ? 'block' : 'hidden'">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
            </svg>
        </div>
        <img :src="'/photos/'+imgId" class="object-cover max-h-[100%]" :class="hover ? 'opacity-50' : ''" alt=""/>
    </div>
</template>

<script setup>
    import {ref} from "vue";

    const hover = ref(false);
    const {imgId, isSelected} = defineProps({imgId: Number, isSelected: Boolean});
    const emit = defineEmits(['deletePhoto']);
</script>
