<template>
    <div class="h-[400px] w-[100%] flex flex-col items-center shadow-lg">
        <div class="w-[80%] h-[70%] mt-[5%] bg-black"></div>

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
    </div>


</template>

<script setup>
    import {ref} from "vue";

    const {album} = defineProps({album: Object});

    console.log(album);

    const hover = ref(false);
</script>
