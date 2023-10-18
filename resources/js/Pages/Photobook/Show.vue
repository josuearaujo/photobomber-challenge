<template>
    <Head title="Photobook" />
    <div v-if="openSelectPhotos" @click="openSelectPhotos=false" class="absolute w-[100%] h-[100%] z-20 bg-slate-50 opacity-70"></div>

    <BreezeAuthenticatedLayout>
        <div v-if="openSelectPhotos" class="absolute left-[10%] w-[80%] h-[90%] z-50 shadow-xl bg-white">
<!--            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">-->
<!--                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">-->
                    <div class="p-10">
                        <div v-if="!userPhotos.length" class="flex justify-center">
                            <span> There is nothing here yet! Please upload your first photo! </span>
                        </div>
                        <div class="grid grid-cols-3 gap-5 items-stretch justify-items-center">
                            <template v-for="photo in userPhotos">
                                <ImageSquare :imgId="photo.id" @click="handleSelection(photo)"/>
                            </template>
                        </div>
                    </div>
<!--                </div>-->
<!--            </div>-->
        </div>

        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Photobook
                </h2>

                <div class="px-2 cursor-pointer rounded-sm hover:duration-500 hover:shadow-lg hover:bg-slate-100 flex items-center"
                     @click="openSelectPhotos=true"
                >
                    <svg width="24px" height="24px" viewBox="0 0 24 24">
                        <path d="M20 13h-7v7h-2v-7H4v-2h7V4h2v7h7v2z"></path>
                    </svg>
                    <span class="ml-1">Select photos</span>
                </div>

                <div class="flex w-[60%] justify-between">
                    <AlbumInformation :album="album"/>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col justify-center items-center">

                <div class="mb-10">
                    <div class="h-[400px] w-[400px] bg-white border-b border-gray-200 shadow-lg rounded-md flex justify-center items-center">
                        <strong class="text-2xl">{{album.title}}</strong>
                    </div>
                </div>

                <div class="mb-10 flex">
                    <div class="h-[400px] w-[400px] bg-white border-b border-gray-200 shadow-lg rounded-md flex justify-center items-center">
                        <strong class="text-2xl">{{album.title}}</strong>
                    </div>
                    <div class="h-[400px] w-[400px] bg-white border-b border-gray-200 shadow-lg rounded-md flex justify-center items-center">
                        <strong class="text-2xl">{{album.title}}</strong>
                    </div>
                </div>

                <div class="mb-10 flex">
                    <div class="h-[400px] w-[400px] bg-white border-b border-gray-200 shadow-lg rounded-md flex justify-center items-center">
                        <strong class="text-2xl">{{album.title}}</strong>
                    </div>
                </div>


            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/vue3';
import axios from "axios";
import AlbumInformation from "@/Pages/Photobook/Partials/AlbumInformation.vue";
import {ref} from "vue";
import ImageSquare from "@/Components/ImageSquare.vue";

const props = defineProps({album: Object, albumPhotos: Array, userPhotos: Array, token: String});

const openSelectPhotos = ref(false);

const handleSelection = async (photo) => {
    try {
        const idx = props.albumPhotos.findIndex(albumPhoto => albumPhoto.id === photo.id);
        const url = `/api/albums/${props.album.id}/photos/${photo.id}`;
        if(idx !== -1) {
            await axios.delete(url);
            props.albumPhotos.splice(idx, 1);
        } else {
            await axios.post(url);
            props.albumPhotos.push(photo);
        }
    } catch(err) {
        console.log('ERROR WHILE DELETING OR ADDING ALBUM PHOTO!');
    }
}

axios.defaults.headers.common['Authorization'] = `Bearer ${props.token}`;
</script>
