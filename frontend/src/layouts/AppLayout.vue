<script setup>
import { ref, onMounted, computed } from "vue";
import { useAdminLayoutStore } from "@/stores/layouts/app";
import { links } from "./admin/LinksAdmin";

import SidebarLogo from "./admin/components/sidebar/SidebarLogo.vue";
import SidebarFooter from "./admin/components/sidebar/SidebarFooter.vue";
import SidebarProfile from "./admin/components/sidebar/SidebarProfile.vue";
import SidebarSublink from "./admin/components/sidebar/SidebarSublink.vue";
import SidebarLinks from "./admin/components/sidebar/SidebarLinks.vue";
import NavProfile from "./admin/components/navbar/NavProfile.vue";

const menu_links = ref(null);
const layout = useAdminLayoutStore();
const { toogleSidebar } = layout;

const sidebar = computed(() => {
    return layout.sidebar;
})

onMounted(() => {
    menu_links.value = document.querySelector('#sidebar_menu_links');
});

</script>
<template>
    <div>
        <div class="admin_main">
            <div class="sidebar_admin" :class="sidebar ? 'sidebar' : ''">
                <SidebarLogo />
                <div class="scroll_sidebar sidebar_menu" :class="sidebar ? 'sidebar' : ''">
                    <SidebarProfile />
                    <div class="sidebar_links" id="sidebar_menu_links">
                        <template v-for="(link, index) in links" :key="index">
                            <template v-if="link.sublinks">
                                <SidebarSublink :link="link" :template="menu_links" :idlink="index" />
                            </template>
                            <template v-else>
                                <SidebarLinks :link="link" />
                            </template>
                        </template>
                    </div>
                </div>
                <SidebarFooter />
            </div>
            <div class="nav_admin" :class="sidebar ? 'sidebar' : ''">
                <button class="btn_nav" @click="toogleSidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="nav_cards">
                    <button class="nav_cards_conf">
                        <i class="fa-solid fa-gear"></i>
                        <span>Configuración</span>
                    </button>
                    <NavProfile />
                </div>
            </div>
        </div>
        <div class="admin_espaciado_navbar"></div>
        <!-- Page Content -->
        <main class="container_main" :class="sidebar ? 'sidebar' : ''">

            <router-view />
            <div>

            </div>
        </main>
    </div>
</template>
<style scoped>
@import "@/assets/css/layouts/admin/styles.css";
@import "@/assets/css/layouts/admin/nav_admin.css";
@import "@/assets/css/layouts/admin/sidebar.css";
</style>