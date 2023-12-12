<template>
    <div class="card-body">
        <form>
            <div class="mb-3">
                <label class="form-label"> {{ $t("pages.help") }} (AR) </label>
                <FormQuillEditor :model="this.keys" name="help_ar" id="ar" />
            </div>
            <div class="mb-3">
                <label class="form-label"> {{ $t("pages.help") }} (EN) </label>
                <FormQuillEditor :model="this.keys" name="help_en" id="en" />
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
import { Quill } from "@vueup/vue-quill";

export default {
    name: "WhoWeAreIndex",

    data() {
        return {
            keys: {
                help_ar: "",
                help_en: "",
            },
            params: ["help_ar", "help_en"],
        };
    },
    methods: {
        update() {
            const ar_content = new Quill("#ar");
            const en_content = new Quill("#en");
            this.keys.help_ar = ar_content.root.innerHTML;
            this.keys.help_ar = en_content.root.innerHTML;
            Settings.updateSetting({ keys: this.keys }).then(({ data }) => {
                useToast().success(data.message);
            });
        },
        index() {
            Settings.list({ params: this.params }).then(({ data }) => {
                this.keys.help_ar = data.help_ar;
                this.keys.help_en = data.help_en;
            });
        },
    },
    created() {
        this.index();
    },
};
</script>
