<template>
    <form-modal
        :permission="hasPermission('create', 'User')"
        @openModal="openModal"
        @clearForm="clearForm"
        @submit="submit"
        id="userForm"
        :buttonDisabled="submitFormDisabled"
        class_name="btn btn-babyblue text-white mb-4"
        :title="title"
    >
        <div class="mb-3">
            <form-input
                label="pages.name"
                type="text"
                :model="user"
                name="name"
                :errors="formErrors"
                @clearErrors="clearInput"
            />
        </div>
        <div class="mb-3">
            <form-input
                label="pages.email"
                type="email"
                :model="user"
                name="email"
                :errors="formErrors"
                @clearErrors="clearInput"
            />
        </div>
        <div class="mb-3">
            <form-input
                label="pages.password"
                type="password"
                :model="user"
                name="password"
                :errors="formErrors"
                @clearErrors="clearInput"
            />
        </div>
        <div class="mb-3">
            <form-input
                label="pages.password_confirm"
                type="password"
                :model="user"
                name="password_confirmation"
                :errors="formErrors"
                @clearErrors="clearInput"
            />
        </div>
        <div class="mb-3">
            <form-input
                label="pages.phone"
                type="text"
                :model="user"
                name="phone"
                :errors="formErrors"
                @clearErrors="clearInput"
            />
        </div>
        <div class="mb-3">
            <form-select
                title="pages.role"
                label="name"
                name="role_id"
                @clearErrors="clearInput"
                :model="user"
                :myOptions="this.$parent.roles"
                :errors="formErrors"
            />
        </div>
    </form-modal>
</template>

<script>
import UserApi from "@api/user.api";
import { useToast } from "vue-toastification";

export default {
    name: "user-form",
    emits: ["openModal"],
    props: {
        user: {
            type: Object,
        },
        title: {
            type: String,
            default: "pages.add_new_user",
        },
    },
    methods: {
        submit() {
            this.submitFormDisabled = true;
            let id = this.user.id;
            if (id) {
                this.updateUser();
            } else {
                this.saveUser();
            }
        },
        saveUser() {
            UserApi.store(this.user)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    $("#userForm").modal("hide");
                    this.afterModalAddActions(
                        this.user,
                        this.$parent.users,
                        data.data
                    );
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
        updateUser() {
            UserApi.update(this.user)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    $("#userForm").modal("hide");
                    this.afterModalUpdateActions(
                        this.user,
                        this.$parent.users,
                        data.data,
                        this.user.id
                    );
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
        clearForm() {
            this.resetForm(this.user);
            this.clearErrors();
        },
        openModal() {
            this.$emit("openModal");
        },
    },
};
</script>

<style scoped></style>
