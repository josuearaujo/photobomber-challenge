<template>
    <div class="flex flex-col justify-center items-center w-1/3 break-words">
        <span class="text-xs">Title</span>
        <strong><TextWithTooltip :text="album.title"/></strong>
    </div>

    <div class="flex flex-col justify-center items-center w-1/3 break-words">
        <span class="text-xs">Description</span>
        <span><TextWithTooltip v-if="album.description" :text="album.description"/></span>
        <span v-if="!album.description">-</span>
    </div>

    <div class="flex flex-col justify-center items-center w-1/4">
        <span class="text-xs">Layout</span>
        <span>{{album.layout}}</span>
    </div>
</template>

<script setup>
import TextWithTooltip from "@/Components/TextWithTooltip.vue";

defineProps({album: Object});
</script>
