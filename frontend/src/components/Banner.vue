<script setup>

defineProps({
    title: {
        type: String,
        required: true,
    }
});
</script>

<template>
    <div class="banner_main">
        <h1>{{ title }}</h1>
    </div>
</template>
<style scoped>
.banner_main{
    width: 100%;
    padding: 10px 10px 10px 20px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
}

.banner_main h1{
    font-size: 18px;
    text-transform: uppercase;
    font-weight: bold;
}

</style>