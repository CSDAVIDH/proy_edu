<script setup>
import { computed } from "vue";
import { useAdminLayoutStore } from "@/stores/layouts/app";

defineProps({
    link: Object,
});

const layout = useAdminLayoutStore();

const sidebar = computed(() => {
    return layout.sidebar;
})

</script>
<template>
    <router-link :to="{ name: link.route }" class="sidebar_link" :class="(sidebar ? 'sidebar' : '')">
        <i :class="link.icon"></i>
        <span>{{ link.name }}</span>
    </router-link>
</template>
<style scoped>
.sidebar_link {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    padding: 10px 15px;
    font-size: 10px;
    text-align: center;
    font-family: Arial, Helvetica, sans-serif;
    background-color: #2A3F54;
    color: #f2f5f7;
    text-decoration: none;
}

.sidebar_link.sidebar {
    flex-direction: row;
    font-size: 14px;
    text-align: left;
    background-color: #2d4357;
}

.sidebar_link i {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    font-size: 22px;
    transition: all 0.5s ease-in-out;
}

.sidebar_link.sidebar i {
    min-width: 25px;
    font-size: 16px;
}



.sidebar_links .router-link-exact-active{
    background-color: #4e6a86;
    color: #fff;
    border-width: 0px 5px 0px 0px;
    border-color: #1abb9c;
    border-style: solid;
}


@media (max-width: 999px) {
    .sidebar_link.sidebar {
        flex-direction: column;
        font-size: 10px;
        text-align: center;
    }

    .sidebar_link.sidebar i {
        min-width: 40px;
        font-size: 22px;
    }
}
</style>
