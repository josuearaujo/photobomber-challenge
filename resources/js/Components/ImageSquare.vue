<template>
    <div class="w-[360px] h-[360px] p-5 text-center">                                                       
        <img :src=imgSrc class="h-[100%]" @load="onLoadImg"/>
    </div>
</template>

<script setup>
const onLoadImg = (e) => {console.log('Carregou!', e.currentTarget, e.returnValue, e.target, e)};
defineProps({imgSrc: String});
</script>
