<template>
    <div class="card-body">
        <form>
            <div class="mb-3">
                <label class="form-label">
                    {{ $t("pages.privacy") }} (AR)
                </label>
                <FormQuillEditor :model="this.keys" name="privacy_ar" id="ar" />
            </div>
            <div class="mb-3">
                <label class="form-label">
                    {{ $t("pages.privacy") }} (EN)
                </label>
                <FormQuillEditor :model="this.keys" name="privacy_en" id="en" />
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
                privacy_ar: "",
                privacy_en: "",
            },
            params: ["privacy_ar", "privacy_en"],
        };
    },
    methods: {
        update() {
            const ar_content = new Quill("#ar");
            const en_content = new Quill("#en");
            this.keys.privacy_ar = ar_content.root.innerHTML;
            this.keys.privacy_en = en_content.root.innerHTML;
            Settings.updateSetting({ keys: this.keys }).then(({ data }) => {
                useToast().success(data.message);
            });
        },
        index() {
            Settings.list({ params: this.params }).then(({ data }) => {
                this.keys.privacy_ar = data.privacy_ar;
                this.keys.privacy_en = data.privacy_en;
            });
        },
    },
    created() {
        this.index();
    },
};
</script>
