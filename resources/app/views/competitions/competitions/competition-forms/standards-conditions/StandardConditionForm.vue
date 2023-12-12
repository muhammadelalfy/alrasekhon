<template #body>
    <form>
        <div class="mb-3">
            <label class="form-label">
                {{ $t("pages.standards_conditions") }}
            </label>
            <FormQuillEditor
                :model="this.competition"
                name="standard_condition_description"
            />
            <ul class="d-flex">
                <li
                    class="invalid-feedback"
                    v-if="
                        formErrors.hasOwnProperty(
                            `standard_condition_description`
                        )
                    "
                >
                    {{ formErrors[`standard_condition_description`][0] }}
                </li>
            </ul>
            <ul class="d-flex">
                <li
                    class="invalid-feedback"
                    v-if="
                        formErrors.hasOwnProperty(
                            `standard_condition_description_validation`
                        )
                    "
                >
                    {{
                        formErrors[
                            `standard_condition_description_validation`
                        ][0]
                    }}
                </li>
            </ul>
        </div>
        <div class="d-flex align-items-cenetr my-4 justify-content-end">
            <button
                @click="saveAndNext"
                type="button"
                class="btn btn-light-babyblue text-white fw-bold"
            >
                {{ $t("forms.save_next") }}
            </button>
            <button
                @click="save"
                type="button"
                class="btn btn-babyblue text-white fw-bold mx-2"
            >
                {{ $t("forms.save") }}
            </button>
            <cancel-button />
        </div>
    </form>
</template>

<script>
import Card from "@/components/Card.vue";
import { onMounted, reactive } from "vue";
import { useToast } from "vue-toastification";
import CompetitionsApi from "@api/competitions.api";

export default {
    components: {
        Card,
    },
    props: {
        competition: Object,
    },
    data() {
        return {
            buttonClickedType: "",
        };
    },
    methods: {
        saveAndNext: function () {
            this.buttonClickedType = "save_and_next";
            this.addUpdateStages();
        },
        save: function () {
            this.buttonClickedType = "save";
            this.addUpdateStages();
        },

        addUpdateStages() {
            CompetitionsApi.addUpdateCondition(this.competition)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    if (this.buttonClickedType === "save") {
                        this.$router.push({
                            name: "competitions",
                        });
                    }
                    if (this.buttonClickedType === "save_and_next") {
                        this.$router.push({
                            name: "advertising-form",
                            params: { id: data.data.id },
                        });
                    }
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
    },
    setup() {
        const mainForm = reactive({
            standardsConditions: "",
        });

        onMounted(() => {
            /*basic responsive Datatable*/
            $(".table-data").DataTable({
                lengthChange: false,
                searching: false,
                paging: false,
                info: false,
                ordering: false,
                order: [],
            });
        });
        return {
            mainForm,
        };
    },
};
</script>
