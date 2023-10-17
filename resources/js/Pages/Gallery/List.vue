<template>
    <Head title="Gallery" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Gallery
                </h2>

                <div class="px-2 cursor-pointer rounded-sm hover:duration-500 hover:shadow-lg hover:bg-slate-100 flex items-center"
                    @click="openFileInput"
                >
                        <input type="file" class="hidden" @change="handleFileChange" ref="fileInputRef"/>
                        <svg width="20px" height="20px" viewBox="0 0 24 24">
                            <path d="M4 15h2v3h12v-3h2v3c0 1.1-.9 2-2 2H6c-1.1 0-2-.9-2-2m4.41-7.59L11 7.83V16h2V7.83l2.59 2.59L17 9l-5-5-5 5 1.41 1.41z"></path>
                        </svg>
                        <span class="ml-1">Upload</span>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div v-if="!photos.length" class="flex justify-center">
                            <span> There is nothing here yet! Please upload your first photo! </span>
                        </div>
                        <div class="grid grid-cols-3 gap-5 items-stretch justify-items-center">
                            <template v-for="photo in photos">
                                <ImageSquare :imgId="photo.id" @deletePhoto="deletePhoto"/>
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
    import ImageSquare from '../../Components/ImageSquare';

    import axios from 'axios';
    import { ref} from "vue";

    const fileInputRef = ref(null);
    const props = defineProps({ photos: Array, token: String });

    axios.defaults.headers.common['Authorization'] = `Bearer ${props.token}`;

    const openFileInput = () => {
        fileInputRef.value.click();
    }

    const deletePhoto = async (imgId) => {
        try{
            await axios.delete(`api/photos/${imgId}`);
            const idx = props.photos.findIndex(photo => photo.id === imgId);
            props.photos.splice(idx, 1);
        } catch (err) {
            console.log('ERROR WHILE DELETING PHOTO!');
        }
    }

    const handleFileChange = async (event) => {
        const selectedFile = event.target.files[0];
        if (selectedFile) {
            let formData = new FormData();
            formData.append('photo', selectedFile);
            event.target.value = '';

            try {
                const response = await axios.post('api/photos', formData);
                props.photos.unshift(response.data);
            } catch (err) {
                console.log('ERROR WHILE UPLOADING PHOTO!');
            }
        }
    }
</script>
