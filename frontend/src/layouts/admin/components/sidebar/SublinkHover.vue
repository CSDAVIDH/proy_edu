<script setup>
import { computed } from "vue";
import { useAdminLayoutStore } from "@/stores/layouts/app";


defineProps({
    link: Object,
    hover: Boolean,
});

const layout = useAdminLayoutStore();

const sidebar = computed(() => {
    return layout.sidebar;
})
</script>
<template>
    <router-link :to="{ name: link.route }" class="hover_link" :class="(hover ? 'dropdown_view' : '') +
        ' ' ">
        {{ link.name }}
    </router-link>
</template>
<style scoped>
.hover_link {
    width: 100%;
    text-decoration: none;
    display: none;
    color: #dad2c7;
    font-size: 12px;
    padding: 7px 10px;
    z-index: 100;
    transition: all 0.3s ease-in-out;
}

.hover_link:hover {
    background-color: #5f7386;
}

.hover_link.dropdown_view {
    display: flex;
}

.sublink_hover .router-link-exact-active{
    pointer-events: none;
    background-color: #8aaceb93;
}



@media (max-width: 999px) {}
</style>
