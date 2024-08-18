<script setup>
import { ref, onMounted, computed } from "vue";
import { useAdminLayoutStore } from "@/stores/layouts/app";

import SublinkLink from "./SublinkLink.vue";
import SublinkHover from "./SublinkHover.vue";

const props = defineProps({
    link: Object,
    template: Object,
    idlink: Number,
});

const layout = useAdminLayoutStore();

const sidebar = computed(() => {
    return layout.sidebar;
})

const dropdown = ref(false);
const hover = ref(false);
const button_sublink = ref(null);
const sublink_main = ref(null);
const sublink_hover = ref(null);

onMounted(() => {
    const button_aux = "#sublink_" + props.idlink;
    const main_aux = "#sublink_main_" + props.idlink;
    const sublink_hover_aux = "#hover_links_" + props.idlink;
    button_sublink.value = document.querySelector(button_aux);
    sublink_main.value = document.querySelector(main_aux);
    sublink_hover.value = document.querySelector(sublink_hover_aux);
});

const toogleDropdown = () => {
    const width_sidebar = document.documentElement.clientWidth;
    if (width_sidebar > 982) {
        if (sidebar.value) {
            dropdown.value = !dropdown.value;
        } else {
            hover.value = !hover.value;
        }
    } else {
        hover.value = !hover.value;
    }
};

window.addEventListener("click", function (e) {
    if (props.template.contains(e.target)) {
        if (button_sublink.value.id != e.target.id) {
            if (!sublink_main.value.contains(e.target)) {
                if (sidebar.value) {
                    dropdown.value = false;
                }
            }
        }
    }
    if (!button_sublink.value.contains(e.target)) {
        if (!sublink_hover.value.contains(e.target)) {
            hover.value = false;
        }
    }
});

const position_top = () => {
    if (button_sublink.value) {
        const { y } = button_sublink.value.getBoundingClientRect();
        return y;
    }
    return 0;
};

</script>
<template>
    <div
        class="sublink_hover"
        :class="sidebar ? 'sidebar' : ''"
        :id="'hover_links_' + idlink"
        :style="`top: ${position_top()}px`"
    >
        <template v-for="(item, index) in link.sublinks" :key="index">
            <SublinkHover :link="item" :hover="hover" />
        </template>
    </div>
    <div
        class="sublink_main"
        :class="(dropdown ? 'dropdown' : '') + ' ' + (sidebar ? 'sidebar' : '')"
        :id="'sublink_main_' + idlink"
    >
        <button
            class="sublink_button"
            @click="toogleDropdown"
            :class="
                (sidebar ? 'sidebar' : '') +
                ' ' +
                (link.routes.includes($route.name)? 'active' : '')
            "
            :id="'sublink_' + idlink"
        >
            <div class="button_text" :class="sidebar ? 'sidebar' : ''">
                <i :class="link.icon"></i>
                <span>{{ link.name }}</span>
            </div>
            <div class="button_down" :class="sidebar ? 'sidebar' : ''">
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        </button>
        <div class="sublink_links" :class="sidebar ? 'sidebar' : ''">
            <template v-for="(item, index) in link.sublinks" :key="index">
                <SublinkLink :link="item" :idSublink="index" :dropdown="dropdown" />
            </template>
        </div>
    </div>
</template>
<style scoped>
.sublink_main {
    width: 100%;
    border: none;
    transition: all 0.5s ease-in-out;
}
.sublink_main.dropdown.sidebar {
    border-width: 0px 5px 0px 0px;
    border-color: #1abb9c;
    border-style: solid;
}
.sublink_main.dropdown {
    border-width: 0px 0px 0px 0px;
}

.sublink_main button:focus {
    border: 2px solid #8584848c;
}
.sublink_button {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 10px 15px;
    text-decoration: none;
    border: none;
    color: #f2f5f7;
    z-index: 1;
    background-color: #2a3f54;
}
.sublink_button.sidebar {
    justify-content: space-between;
    background-color: #2d4357;
}
.sublink_button .button_down {
    display: none;
}
.sublink_button.sidebar .button_down {
    display: block;
}
.button_text {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    font-size: 10px;
    text-align: center;
    font-family: Arial, Helvetica, sans-serif;
}
.button_text.sidebar {
    flex-direction: row;
    font-size: 14px;
    text-align: left;
}

.button_text i {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    font-size: 22px;
    transition: all 0.5s ease-in-out;
}

.button_text.sidebar i {
    min-width: 25px;
    font-size: 16px;
}
.sublink_links {
    display: none;
    flex-direction: column;
    overflow: hidden;
    transition: all 500ms ease-in-out;
}
.sublink_links.sidebar {
    display: flex;
}
.sublink_hover {
    width: 170px;
    display: flex;
    flex-direction: column;
    border-radius: 0px 5px 5px 0px;
    position: absolute;
    top: 20px;
    left: 70px;
    z-index: 100;
    z-index: 2;
    background-color: #3e5367;
}
.sublink_hover.sidebar {
    display: none;
}

@media (max-width: 999px) {
    .button_text.sidebar {
        flex-direction: column;
        font-size: 10px;
        text-align: center;
    }
    .button_text.sidebar i {
        min-width: 40px;
        font-size: 22px;
    }
    .sublink_links.sidebar {
        display: none;
    }
    .sublink_main.dropdown.sidebar {
        border-width: 0px 0px 0px 0px;
    }
    .sublink_hover.sidebar {
        display: flex;
    }
}

.sublink_button.active{
    background-color: #4e6a86;
    border-width: 0px 5px 0px 0px;
    border-color: #1abb9c;
    border-style: solid;
}


.sublink_button.active {
    background-color: #4e6a86;
    border-width: 0px 5px 0px 0px;
    border-color: #1abb9c;
    border-style: solid;
}
</style>
