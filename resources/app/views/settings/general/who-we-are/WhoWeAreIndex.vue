<template>
    <div class="card-body">
        <form>
            <div class="mb-3">
                <label class="form-label">
                    {{ $t("pages.who_are_we") }} (AR)
                </label>
                <FormQuillEditor
                    :model="this.who_are_we"
                    name="who_are_we_ar"
                    id="ar"
                />
            </div>
            <div class="mb-3">
                <label class="form-label">
                    {{ $t("pages.who_are_we") }} (EN)
                </label>
                <FormQuillEditor
                    :model="this.who_are_we"
                    name="who_are_we_en"
                    id="en"
                />
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
            who_are_we: {
                who_are_we_ar: "",
                who_are_we_en: "",
            },
            params: ["who_are_we_ar", "who_are_we_en"],
        };
    },
    methods: {
        update() {
            const ar_content = new Quill("#ar");
            const en_content = new Quill("#en");
            this.who_are_we.who_are_we_ar = ar_content.root.innerHTML;
            this.who_are_we.who_are_we_en = en_content.root.innerHTML;
            Settings.updateSetting({ keys: this.who_are_we }).then(
                ({ data }) => {
                    useToast().success(data.message);
                }
            );
        },
        index() {
            Settings.list({ params: this.params }).then(({ data }) => {
                this.who_are_we.who_are_we_ar = data.who_are_we_ar;
                this.who_are_we.who_are_we_en = data.who_are_we_en;
            });
        },
    },
    created() {
        this.index();
    },
    mounted() {},
};
</script>
