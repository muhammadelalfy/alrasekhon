<script>
import { useToast } from "vue-toastification";

export default {
    name: "login",
    data() {
        return {
            loginForm: {
                email: "",
                password: "",
                rememberMe: false,
            },
        };
    },
    methods: {
        handleLogin() {
            this.$store.userStore
                .login(this.loginForm)
                .then((response) => {
                    useToast().success(this.$t("messages.success"));
                    this.$router.push({
                        path: "/dashboard",
                    });
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
    },
};
</script>

<template>
    <div class="authForm mx-auto">
        <div class="text-center">
            <img
                :src="`${publicPath}/assets/images/authLogo.svg`"
                class="header-brand-img mb-4"
                alt="logo"
            />
        </div>

        <h4 class="title-border text-center fs-20">
            {{ $t("global.sign_in") }}
        </h4>
        <form method="POST" action="#">
            <form-input
                id="email"
                label="pages.email"
                type="email"
                :model="loginForm"
                name="email"
                :errors="formErrors"
                @clearErrors="clearInput"
            />
            <form-input
                id="password"
                label="pages.password"
                type="password"
                :model="loginForm"
                name="password"
                :errors="formErrors"
                @clearErrors="clearInput"
            />
            <div class="d-flex align-items-center justify-content-between">
                <FormCheckbox
                    :label="$t('forms.rememberMe')"
                    input-id="rememberMe"
                    :model="loginForm"
                    name="rememberMe"
                />
                <p class="mb-3">
                    <router-link :to="{ name: 'forgetPassword' }">{{
                        $t("global.forget_password")
                    }}</router-link>
                </p>
            </div>
            <button
                type="submit"
                @click.prevent="handleLogin"
                class="btn ripple btn-babyblue w-100 text-white"
            >
                {{ $t("global.sign_in") }}
            </button>
        </form>
    </div>
</template>
