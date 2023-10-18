<template>
    <div>
        <div
            class="text-sm truncate w-30"
            @mouseenter="showTooltip = true"
            @mouseleave="showTooltip = false"
        >
            {{ truncatedText }}
        </div>
        <div
            v-if="showTooltip"
            class="absolute bg-white p-2 shadow border border-gray-300 rounded-lg"
        >
            {{ text }}
        </div>
    </div>
</template>

<script setup>
import {ref} from 'vue';

const props = defineProps({text: String});
const showTooltip = ref(false);

const truncatedText = props.text.slice(0, 30) + (props.text.length > 30 ? '...' : '');
</script>
