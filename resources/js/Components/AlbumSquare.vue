<template>
    <div class="relative" @mouseover="hover=true" @mouseleave="hover=false">
        <div v-if="hover" class="absolute right-0 top-0 cursor-pointer p-2 bg-slate-100 shadow-md rounded-full z-60" @click="emit('deleteAlbum', album.id)">
            <svg width="24px" height="24px" viewBox="0 0 24 24" class="fill-red-400">
                <path d="M15 4V3H9v1H4v2h1v13c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V6h1V4h-5zm2 15H7V6h10v13zM9 8h2v9H9zm4 0h2v9h-2z"></path>
            </svg>
        </div>
        <Link :href="route('album.show', {album: album.id})" class="h-[400px] w-[100%] flex flex-col items-center shadow-lg"
        >
            <div class="w-[80%] h-[70%] mt-[5%] flex justify-center items-center">
                <img v-if="album.photos.length" :src="'/photos/' + album.photos[0]?.id" alt=""/>
                <img v-else src="/NoPhoto.png" alt="No photo"/>
            </div>
            <div class="h-[20%] w-[80%] mt-1 flex flex-col justify-center items-center">
                <div class="flex flex-col items-center">
                    <span class="text-xs">Title</span>
                    <strong>{{album.title}}</strong>
                </div>
                <div class="flex justify-between w-[100%]">
                    <div class="flex flex-col items-center">
                        <span class="text-xs">Photo count</span>
                        <span>{{album.photos.length}}</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-xs">Status</span>
                        <span>TBD</span>
                    </div>
                </div>
            </div>
        </Link>
    </div>


</template>

<script setup>
    import {Link} from "@inertiajs/vue3";
    import {ref} from "vue";

    const hover = ref(false);
    const emit = defineEmits(['deleteAlbum']);

    defineProps({album: Object});
</script>
