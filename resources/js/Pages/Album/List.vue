<template>
    <Head title="Albums" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Albums
                </h2>

                <div class="px-2 cursor-pointer rounded-sm hover:duration-500 hover:shadow-lg hover:bg-slate-100 flex items-center"
                     @click="openCreateForm=true"
                >
                    <svg width="24px" height="24px" viewBox="0 0 24 24">
                        <path d="M20 13h-7v7h-2v-7H4v-2h7V4h2v7h7v2z"></path>
                    </svg>
                    <span class="ml-1">New Album</span>
                </div>
                <CreateAlbumModal v-if="openCreateForm" @close="openCreateForm=false"></CreateAlbumModal>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div v-if="!albums.length" class="flex justify-center">
                            <span> There is nothing here yet! Please create your first album! </span>
                        </div>
                        <div class="grid grid-cols-3 gap-5 items-stretch justify-items-center">
                            <template v-for="album in albums">
                                <AlbumSquare :album="album" @deleteAlbum="deleteAlbum"/>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/vue3';
import AlbumSquare from "@/Components/AlbumSquare.vue";
import {ref} from "vue";
import CreateAlbumModal from "@/Pages/Album/Partials/CreateAlbumModal.vue";
import axios from "axios";

const props = defineProps({albums: Array});

const deleteAlbum = async (albumId) => {
    try{
        await axios.delete(route('album.destroy', {album: albumId}));
        const idx = props.albums.findIndex(album => album.id === albumId);
        props.albums.splice(idx, 1);
    } catch (err) {
        console.log('ERROR WHILE DELETING ALBUM!');
    }
}

const openCreateForm = ref(false);
</script>
