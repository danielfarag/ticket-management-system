<template>
    <span class="color text-center" :style="{ backgroundColor: color }"></span>
</template>

<script>
export default {
    props:{
        color: String,
    }

}
</script>


<style scoped>
    .color{
        display: inline-block;
        height: 30px;
        width: 110px;
    }
</style>