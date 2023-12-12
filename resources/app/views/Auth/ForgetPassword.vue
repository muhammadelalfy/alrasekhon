<script>
import { useToast } from "vue-toastification";

export default {
    name: "ForgetPassword",
    data() {
        return {
            forgetForm: {
                email: "",
            },
            error: "",
        };
    },
    methods: {
        handleForget() {
            this.$store.userStore
                .resetPassword({}, this.forgetForm)
                .then((response) => {
                    this.$router.push({
                        path: "/login",
                    });
                })
                .catch((error) => {
                    // console.log(error);
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
            {{ $t("global.forget_password") }}
        </h4>
        <form method="POST" action="#">
            <form-input
                id="email"
                label="pages.email"
                type="email"
                :model="forgetForm"
                name="email"
                :errors="formErrors"
                @clearErrors="clearInput"
            />
            <button
                class="btn ripple btn-babyblue w-100 text-white"
                @click.prevent="handleForget"
            >
                {{ $t("forms.send") }}
            </button>
            <div class="d-flex align-items-center justify-content-center my-3">
                <router-link :to="{ name: 'login' }" class="black-link fw-bold">{{
                    $t("global.sign_in")
                }}</router-link>
            </div>
        </form>
    </div>
</template>
