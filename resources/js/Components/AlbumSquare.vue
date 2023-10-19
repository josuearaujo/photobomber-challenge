<template>
    <div class="relative w-[100%]" @mouseover="hover=true" @mouseleave="hover=false">
        <div v-if="hover" class="absolute right-0 top-0 cursor-pointer p-2 bg-slate-100 shadow-md rounded-full z-60" @click="emit('deleteAlbum', album.id)">
            <svg width="24px" height="24px" viewBox="0 0 24 24" class="fill-red-400">
                <path d="M15 4V3H9v1H4v2h1v13c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V6h1V4h-5zm2 15H7V6h10v13zM9 8h2v9H9zm4 0h2v9h-2z"></path>
            </svg>
        </div>
        <Link :href="url" class="h-[400px] w-[100%] flex flex-col items-center shadow-lg" :class="!url ? 'cursor-not-allowed' : ''"
        >
            <div class="w-[80%] h-[70%] mt-[5%] flex justify-center items-center">
                <img v-if="album.photos.length" :src="'/photos/' + album.photos[0]?.id" alt="" class="max-h-[100%]"/>
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
                        <span>{{toUpperCase(album.status)}}</span>
                    </div>
                </div>
            </div>
        </Link>
    </div>
</template>

<script setup>
    import {Link} from "@inertiajs/vue3";
    import {onUnmounted, ref} from "vue";
    import {toUpperCase} from "uri-js/dist/esnext/util";
    import axios from "axios";
    import Swal from "sweetalert2";

    const {album} = defineProps({album: Object});

    const url = ref('');

    url.value = ['draw','failed'].includes(album.status) ? route('album.show', {album: album.id}) : '';

    let timer = undefined;

    if(album.status === 'pending'){
        timer = setInterval(async () => {
            const response = await axios.get(route('album.check-compilation', {album: album.id}));
            if(response.data.status !== 'pending') {
                clearInterval(timer);
                album.status = response.data.status;
                url.value = ['draw','failed'].includes(album.status) ? route('album.show', {album: album.id}) : '';

                const icon = response.data.status === 'failed' ? 'error' : 'success';

                const text = response.data.message ?
                                `Compilation ${response.data.status}: ${response.data.message}` :
                                `Compilation ${response.data.status}`;

                await Swal.fire({
                    title: album.title,
                    text,
                    icon,
                    timer: 8000
                })
            }
        }, 10000)
    }

    onUnmounted(() => {
       clearInterval(timer);
    });

    const hover = ref(false);
    const emit = defineEmits(['deleteAlbum']);
</script>
