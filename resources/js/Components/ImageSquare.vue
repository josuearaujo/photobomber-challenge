<template>
    <div class="relative w-[100%] max-h-[360px] flex items-center justify-center bg-slate-50
        p-2 border-2 border-white hover:border-gray-300 hover:duration-1000 rounded-md"
        @mouseover="hover=true" @mouseleave="hover=false"
    >

        <div v-if="hover" class="absolute right-0 top-0 cursor-pointer p-2 bg-slate-100 shadow-md rounded-full z-40" @click="emit('deletePhoto', imgId)">
            <svg width="24px" height="24px" viewBox="0 0 24 24" class="fill-red-400">
                <path d="M15 4V3H9v1H4v2h1v13c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V6h1V4h-5zm2 15H7V6h10v13zM9 8h2v9H9zm4 0h2v9h-2z"></path>
            </svg>
        </div>

        <img :src="'photos/'+imgId" class="object-cover max-h-[100%]" :class="hover ? 'opacity-50' : ''"/>
    </div>
</template>

<script setup>
    import {ref} from "vue";

    const {imgId} = defineProps({imgId: Number});
    const emit = defineEmits(['deletePhoto']);

    const hover = ref(false);
</script>
