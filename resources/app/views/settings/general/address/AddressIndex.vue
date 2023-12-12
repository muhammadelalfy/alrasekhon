<template>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-6">
                    <form-input
                        label="pages.address_ar"
                        type="text"
                        :model="this.keys"
                        name="address_ar"
                        :errors="formErrors"
                        @clearErrors="clearInput"
                    />
                </div>
                <div class="col-md-6">
                    <form-input
                        label="pages.address_en"
                        type="text"
                        :model="this.keys"
                        name="address_en"
                        :errors="formErrors"
                        @clearErrors="clearInput"
                    />
                </div>
                <div class="col-md-6">
                    <form-input
                        label="pages.website_link"
                        type="text"
                        :model="this.keys"
                        name="website_link"
                        :errors="formErrors"
                        @clearErrors="clearInput"
                    />
                </div>
                <div class="col-md-6">
                    <form-input
                        label="pages.embed_map"
                        type="text"
                        :model="this.keys"
                        name="embed_map"
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
                embed_map: "",
                address_ar: "",
                address_en: "",
                website_link: "",
            },
            params: ["embed_map", "address_ar", "address_en", "website_link"],
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
                this.keys.address_ar = data.address_ar;
                this.keys.address_en = data.address_en;
                this.keys.website_link = data.website_link;
                this.keys.embed_map = data.embed_map;
            });
        },
    },
    created() {
        this.index();
    },
};
</script>
