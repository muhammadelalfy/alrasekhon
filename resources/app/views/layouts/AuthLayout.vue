<template>
    <side-setting />
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 bg-white p-md-0">
                <div
                    class="d-flex flex-column align-items-center justify-content-center min-vh-100"
                >
                    <router-view></router-view>
                </div>
            </div>
            <div class="col-md-7 p-md-0 d-none d-md-block">
                <img
                    :src="`${publicPath}/assets/images/authBg.png`"
                    class="auth-bg"
                    alt="background"
                />
            </div>
        </div>
    </div>
</template>

<script>
// @ is an alias to /src
import mainScript from "@views/layouts/partials/MainScript.vue";
import sideSetting from "@views/layouts/partials/SideSetting.vue";

export default {
    name: "AuthLayout",
    components: {
        sideSetting,
    },
    mounted() {
        mainScript.main();
    },
};
</script>
