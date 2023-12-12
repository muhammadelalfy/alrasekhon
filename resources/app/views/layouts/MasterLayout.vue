<script>
import TopBar from "@views/layouts/partials/TopBar.vue";
import SideBar from "@views/layouts/partials/SideBar.vue";
import FooterBar from "@views/layouts/partials/FooterBar.vue";
import mainScript from "@views/layouts/partials/MainScript.vue";
import sideSetting from "@views/layouts/partials/SideSetting.vue";
import Scroll from "@views/layouts/partials/Scroll.vue";
import BreadCrumb from "@views/layouts/partials/BreadCrumb.vue";

export default {
    name: "master-layout",
    components: {
        FooterBar,
        TopBar,
        SideBar,
        sideSetting,
        Scroll,
        BreadCrumb,
    },
    mounted() {
        mainScript.main();
    },
};
</script>

<template>
    <top-bar />
    <side-setting />
    <side-bar />

    <div class="main-content side-content">
        <div class="container">
            <BreadCrumb />
            <router-view :key="$route.fullPath"></router-view>
        </div>
    </div>

    <footer-bar />
    <Scroll />
</template>
