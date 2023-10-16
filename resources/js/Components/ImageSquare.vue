<template>
    <div class="w-[360px] h-[360px] flex justify-center align-center">                                                       
        <img :src=imgSrc class="h-[100%] object-contain" @load="onLoadImg"/>
    </div>
</template>

<script setup>
    defineProps({imgSrc: String});

    const onLoadImg = (e) => {
        const image = e.currentTarget;
        const height = image.naturalHeight;
        const width = image.naturalWidth;
        
        if (height > width) {
            image.classList.add('h-[100%]');
            image.classList.remove('w-[100%]');
        } else {
            image.classList.add('w-[100%]');
            image.classList.remove('h-[100%]');
        }
    };
</script>
