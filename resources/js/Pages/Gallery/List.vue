<template>
    <Head title="Gallery" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gallery
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        List all photos! {{ photoCount }}

                        <div class="grid grid-cols-3 gap-2">
                            <ImageSquare imgSrc="/photos/10"/>
                            <ImageSquare imgSrc="/photos/13"/>
                            <ImageSquare imgSrc="/photos/8"/>

                            <ImageSquare imgSrc="/photos/10"/>
                            <ImageSquare imgSrc="/photos/8"/>
                            <ImageSquare imgSrc="/photos/10"/>

                            <ImageSquare imgSrc="/photos/8"/>
                            <ImageSquare imgSrc="/photos/11"/>
                            <ImageSquare imgSrc="/photos/12"/>
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

defineProps({ photos: Array, photoCount: Number });
</script>
