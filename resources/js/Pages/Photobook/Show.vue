<template>
    <Head title="Photobook" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Photobook
                </h2>

                <div class="flex w-[60%] justify-between">
                    <div class="flex flex-col justify-center items-center w-1/3 break-words">
                        <span class="text-xs">Title</span>
                        <strong><TextWithTooltip :text="album.title"/></strong>
                    </div>

                    <div class="flex flex-col justify-center items-center w-1/3 break-words">
                        <span class="text-xs">Description</span>
                        <span><TextWithTooltip :text="album.description"/></span>
                    </div>

                    <div class="flex flex-col justify-center items-center w-1/4">
                        <span class="text-xs">Layout</span>
                        <span>{{album.layout}}</span>
                    </div>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Show info!
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
import TextWithTooltip from "@/Components/TextWithTooltip.vue";

const props = defineProps({album: Object, token: String});

axios.defaults.headers.common['Authorization'] = `Bearer ${props.token}`;
</script>
