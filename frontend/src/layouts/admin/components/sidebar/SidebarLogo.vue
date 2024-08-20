<script setup>
import { computed } from "vue";
import { useAdminLayoutStore } from "@/stores/layouts/app";
import logo from "@/assets/image/logo.png";
const layout = useAdminLayoutStore();

const sidebar = computed(() => {
  return layout.sidebar;
})


</script>
<template>
  <router-link :to="{ name: 'admin.index' }" class="logo_main">
    <div class="logo_esc"><img :src="logo" alt="logo" /></div>
  </router-link>
</template>
<style scoped>
.logo_main {
  width: 100%;
  height: 60px;
  text-decoration: none;
  border: none;
  position: sticky;
  top: 0;
  display: flex;
  align-items: center;
  padding: 0px 0px 0px 10px;
  gap: 15px;
  overflow-x: hidden;
  margin-bottom: 20px;
  transition: all 0.5s ease-in-out;
}

.logo_esc img {
  height: 50px;
}
</style>
