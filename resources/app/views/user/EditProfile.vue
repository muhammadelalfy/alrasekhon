<template>
    <page-header title="sidebar.profile" :active="false">
        <li class="breadcrumb-item active" aria-current="page">
            {{ $t("pages.edit_profile") }}
        </li>
    </page-header>
    <Card>
        <template #body>
            <form class="d-flex flex-column">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <form-input
                            label="pages.name"
                            type="text"
                            :model="user"
                            name="name"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>

                    <div class="col-md-4">
                        <form-input
                            label="pages.email"
                            type="email"
                            :model="user"
                            name="email"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-input
                            label="pages.password"
                            type="password"
                            :model="user"
                            name="password"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-input
                            label="pages.password_confirm"
                            type="password"
                            :model="user"
                            name="password_confirmation"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-input
                            label="pages.phone"
                            type="number"
                            :model="user"
                            name="phone"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>
                </div>
                <div
                    class="btn-group mt-4"
                    role="group"
                    aria-label="Basic example"
                >
                    <button
                        class="btn ripple btn-babyblue me-2 text-white"
                        :disabled="submitFormDisabled"
                        @click.prevent="submit"
                    >
                        {{ $t("forms.save") }}
                    </button>
                    <cancel-button />
                </div>
            </form>
        </template>
    </Card>
</template>
<script>
import { useToast } from "vue-toastification";
import UserApi from "@api/user.api";

export default {
    name: "edit-profile",
    data() {
        return {
            user: {},
        };
    },
    created() {
        this.user = this.$store.userStore.getUserData;
    },
    methods: {
        submit() {
            UserApi.update(this.user)
                .then((resp) => {
                    this.$store.userStore.setUserData(resp.data.data);
                    useToast().success(this.$t("messages.success"));
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.formErrors = error.response.data.errors;
                    }
                });
        },
    },
};
</script>
