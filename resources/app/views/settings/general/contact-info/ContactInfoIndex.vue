<template>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-6">
                    <form-input
                        label="pages.whatsapp"
                        type="text"
                        :model="this.keys"
                        name="whatsapp"
                        :errors="formErrors"
                        @clearErrors="clearInput"
                    />
                </div>

                <div class="col-md-6">
                    <form-input
                        label="pages.telegram"
                        type="text"
                        :model="this.keys"
                        name="telegram"
                        :errors="formErrors"
                        @clearErrors="clearInput"
                    />
                </div>

                <div class="col-md-6">
                    <form-input
                        label="pages.facebook"
                        type="text"
                        :model="this.keys"
                        name="facebook"
                        :errors="formErrors"
                        @clearErrors="clearInput"
                    />
                </div>

                <div class="col-md-6">
                    <form-input
                        label="pages.twitter"
                        type="text"
                        :model="this.keys"
                        name="twitter"
                        :errors="formErrors"
                        @clearErrors="clearInput"
                    />
                </div>
                <div class="col-md-6">
                    <form-input
                        label="pages.instagram"
                        type="text"
                        :model="this.keys"
                        name="instagram"
                        :errors="formErrors"
                        @clearErrors="clearInput"
                    />
                </div>
            </div>

            <div class="d-flex align-items-cenetr pt-4 justify-content-end">
                <button
                    type="button"
                    class="btn btn-babyblue text-white fw-bold"
                    @click.prevent="update"
                >
                    {{ $t("forms.save") }}
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import Settings from "@/api/general-settings.api";
import { useToast } from "vue-toastification";

export default {
    name: "WhoWeAreIndex",

    data() {
        return {
            keys: {
                facebook: "",
                twitter: "",
                instagram: "",
                whatsapp: "",
                telegram: "",
            },
            params: [
                "facebook",
                "twitter",
                "instagram",
                "whatsapp",
                "telegram",
            ],
        };
    },
    methods: {
        update() {
            Settings.updateSetting({ keys: this.keys }).then(({ data }) => {
                useToast().success(data.message);
            });
        },
        index() {
            Settings.list({ params: this.params }).then(({ data }) => {
                this.keys.facebook = data.facebook;
                this.keys.twitter = data.twitter;
                this.keys.whatsapp = data.whatsapp;
                this.keys.telegram = data.telegram;
                this.keys.instagram = data.instagram;
            });
        },
    },
    created() {
        this.index();
    },
};
</script>
