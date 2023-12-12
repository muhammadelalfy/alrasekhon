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
            {{ $t("global.resetPass") }}
        </h4>
        <form>
            <form-input
                id="pass"
                label="pages.password"
                type="password"
                :model="form"
                name="pass"
                :errors="formErrors"
                @clearErrors="clearInput"
                @click="showInfoBlock1"
            />
            <form-input
                id="pass_confirmation"
                label="pages.password_confirm"
                type="password"
                :model="form"
                name="pass_confirmation"
                :errors="formErrors"
                @clearErrors="clearInput"
                @click="showInfoBlock2"
            />

            <div
                v-if="
                    form.pass.length &&
                    form.pass_confirmation.length &&
                    form.pass != form.pass_confirmation
                "
                class="invalid-feedback mb-3"
            >
                {{ $t("global.passNotMatch") }}
            </div>
            <div v-if="showInfo1" class="bg-lightPrimary p-3 mb-5 info-block">
                <div
                    class="d-flex align-items-center flex-wrap text-primary fw-bold"
                >
                    <img
                        :src="`${publicPath}/assets/images/notifcation.svg`"
                        class="icon-info me-2"
                        alt="info"
                    />
                    {{ $t("global.passContain") }}
                </div>
                <div class="mt-3 text-grayClr">
                    <div class="d-flex align-items-center flex-wrap mb-3 fs-13">
                        <img
                            :src="`${publicPath}/assets/images/check.svg`"
                            class="icon-info me-2"
                            :class="form.pass.length < 8 && 'opacity-30'"
                            alt="check"
                        />
                        {{ $t("global.not8less") }}
                    </div>
                    <div class="d-flex align-items-center flex-wrap mb-3 fs-13">
                        <img
                            :src="`${publicPath}/assets/images/check.svg`"
                            class="icon-info me-2"
                            :class="
                                form.pass.search(/[A-Z]/) < 1 &&
                                !/[A-Z]/.test(form.pass[0]) &&
                                'opacity-30'
                            "
                            alt="check"
                        />
                        {{ $t("global.containUppercase") }}
                    </div>
                    <div class="d-flex align-items-center flex-wrap mb-3 fs-13">
                        <img
                            :src="`${publicPath}/assets/images/check.svg`"
                            class="icon-info me-2"
                            :class="
                                form.pass.search(/[0-9]/) < 0 && 'opacity-30'
                            "
                            alt="check"
                        />
                        {{ $t("global.containNum") }}
                    </div>
                    <div class="d-flex align-items-center flex-wrap mb-3 fs-13">
                        <img
                            :src="`${publicPath}/assets/images/check.svg`"
                            class="icon-info me-2"
                            :class="
                                form.pass.search(/[!@#$%^&*]/) < 0 &&
                                'opacity-30'
                            "
                            alt="check"
                        />
                        {{ $t("global.containSign") }}
                    </div>
                </div>
            </div>

            <div v-if="showInfo2" class="bg-lightPrimary p-3 mb-5 info-block">
                <div
                    class="d-flex align-items-center flex-wrap text-primary fw-bold"
                >
                    <img
                        :src="`${publicPath}/assets/images/notifcation.svg`"
                        class="icon-info me-2"
                        alt="info"
                    />
                    {{ $t("global.passContain") }}
                </div>
                <div class="mt-3 text-grayClr">
                    <div class="d-flex align-items-center flex-wrap mb-3 fs-13">
                        <img
                            :src="`${publicPath}/assets/images/check.svg`"
                            class="icon-info me-2"
                            :class="
                                form.pass_confirmation.length < 8 &&
                                'opacity-30'
                            "
                            alt="check"
                        />
                        {{ $t("global.not8less") }}
                    </div>
                    <div class="d-flex align-items-center flex-wrap mb-3 fs-13">
                        <img
                            :src="`${publicPath}/assets/images/check.svg`"
                            class="icon-info me-2"
                            :class="
                                form.pass_confirmation.search(/[A-Z]/) < 1 &&
                                !/[A-Z]/.test(form.pass_confirmation[0]) &&
                                'opacity-30'
                            "
                            alt="check"
                        />
                        {{ $t("global.containUppercase") }}
                    </div>
                    <div class="d-flex align-items-center flex-wrap mb-3 fs-13">
                        <img
                            :src="`${publicPath}/assets/images/check.svg`"
                            class="icon-info me-2"
                            :class="
                                form.pass_confirmation.search(/[0-9]/) < 0 &&
                                'opacity-30'
                            "
                            alt="check"
                        />
                        {{ $t("global.containNum") }}
                    </div>
                    <div class="d-flex align-items-center flex-wrap mb-3 fs-13">
                        <img
                            :src="`${publicPath}/assets/images/check.svg`"
                            class="icon-info me-2"
                            :class="
                                form.pass_confirmation.search(/[!@#$%^&*]/) <
                                    0 && 'opacity-30'
                            "
                            alt="check"
                        />
                        {{ $t("global.containSign") }}
                    </div>
                </div>
            </div>

            <button
                type="submit"
                class="btn ripple btn-babyblue w-100 text-white"
                :disabled="!activeSubmit"
                @click.prevent="changePassword"
            >
                {{ $t("global.resetPass") }}
            </button>
        </form>
    </div>
</template>

<script>
import { reactive, ref, computed } from "vue";
import { useRouter, useRoute } from "vue-router";
import { useToast } from "vue-toastification";
// import CustomInput from "@/components/form/CustomInput.vue";
// import useAuth from "@/store/user";
import AuthApi from "@api/auth.api";

export default {
    name: "Reset",
    components: {
        // CustomInput,
    },
    data() {
        return {
            forgetForm: {
                email: "",
            },
            error: "",
        };
    },
    methods: {
        async changePassword() {
            // console.log( this.$route.query.email);

            return await AuthApi.changePassword(this.form)
                .then((response) => {
                    useToast().success(response.data.message);
                    this.$router.push({
                        path: "/login",
                    });
                })
                .catch((error) => {
                    this.error = error.response.data.errors;
                });
        },
    },
    setup() {
        const route = useRoute();
        const router = useRouter();
        const showInfo1 = ref(true);
        const showInfo2 = ref(false);
        const form = reactive({
            email: route.query.email,
            pass: "",
            pass_confirmation: "",
        });

        const activeSubmit = computed(() => {
            return (
                form.pass.length >= 8 &&
                form.pass.search(/[A-Z]/) > 0 &&
                !/[A-Z]/.test(form.pass[0]) &&
                form.pass.search(/[0-9]/) >= 0 &&
                form.pass.search(/[!@#$%^&*]/) > 0 &&
                form.pass_confirmation.length >= 8 &&
                form.pass_confirmation.search(/[A-Z]/) > 0 &&
                !/[A-Z]/.test(form.pass_confirmation[0]) &&
                form.pass_confirmation.search(/[0-9]/) >= 0 &&
                form.pass_confirmation.search(/[!@#$%^&*]/) > 0 &&
                form.pass === form.pass_confirmation
            );
        });

        function showInfoBlock1() {
            showInfo1.value = true;
            showInfo2.value = false;
        }

        function showInfoBlock2() {
            showInfo2.value = true;
            showInfo1.value = false;
        }

        return {
            showInfo1,
            showInfo2,
            showInfoBlock1,
            showInfoBlock2,
            form,
            activeSubmit,
        };
    },
};
</script>
