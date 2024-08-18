<script setup>

const props = defineProps({
    link: Object,
    dropdown: Boolean,
    idSublink: Number,
});
</script>
<template>
    <router-link :to="{ name: link.route }"
        class="sublink_link"
        :class="
            (dropdown ? 'dropdown' : '')
        "
    >
        <svg
            height="34"
            width="10"
            style="display: flex; flex-direction: column"
        >
            <line
                x1="5"
                y1="0"
                x2="5"
                y2="34"
                stroke="#849EB5"
                stroke-width="1"
            ></line>
            <circle
                cx="5"
                cy="17"
                r="3"
                stroke="#849EB5"
                fill="#849EB5"
            ></circle>
        </svg>
        <span>{{ link.name }}</span>
    </router-link>
</template>
<style scoped>
.sublink_link {
    width: 100%;
    max-height: 0px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 12px;
    text-decoration: none;
    color: #dbe3e7;
    padding: 0px 15px 0px 25px;
    overflow: hidden;
    opacity: 0;
    transition: all 0.5s ease-in-out;
}
.sublink_link.dropdown {
    max-height: 60px;
    opacity: 1;
}
.subactive {
    pointer-events: none;
    background-color: #8aaceb93;
}

.sublink_links .router-link-exact-active{
    pointer-events: none;
    background-color: #8aaceb93;
}
</style>
