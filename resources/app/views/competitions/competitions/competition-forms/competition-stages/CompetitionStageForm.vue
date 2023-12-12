<template #body>
    <form>
        <div class="row align-items-end">
            <!-- <div class="col-12 col-md-10 col-lg-11"> -->
            <!--                <form-input-->
            <!--                    label="pages.stage_name"-->
            <!--                    type="text"-->
            <!--                    :model="this.competition.stages[0]"-->
            <!--                    name="name"-->
            <!--                    :errors="formErrors"-->
            <!--                    @clearErrors="clearInput"-->
            <!--                />-->
            <div class="d-flex align-items-center flex-wrap">
                <h6 class="fw-bold mb-3 me-2">
                    {{ $t("pages.stage_name") }}
                </h6>
                <button
                    @click="addRow"
                    type="button"
                    class="btn btn-icon btn-light-babyblue text-white mb-3 p-0"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    :title="$t('pages.add')"
                >
                    <font-awesome-icon icon="fa-solid fa-circle-plus" />
                </button>
            </div>

            <ul class="d-flex">
                <li
                    class="invalid-feedback"
                    v-if="formErrors.hasOwnProperty(`stages`)"
                >
                    {{ formErrors[`stages`][0] }}
                </li>
            </ul>
            <!-- </div> -->
            <!-- <div class="col-3 col-md-2 col-lg-1 d-flex justify-content-end">
                <button
                    @click="addRow"
                    type="button"
                    class="btn btn-icon btn-light-babyblue text-white mb-3 p-0"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    :title="$t('pages.add')"
                >
                    <font-awesome-icon icon="fa-solid fa-circle-plus" />
                </button>
            </div> -->
        </div>
        <div v-for="(row, index) in this.competition.stages" :key="index">
            <div class="row align-items-end">
                <div class="col-12 col-md-10 col-lg-11">
                    <form-input
                        label="pages.stage_name"
                        :showLabel="true"
                        type="text"
                        :model="this.competition.stages[index]"
                        name="name"
                        :errors="formErrors"
                        @clearErrors="clearInput"
                    />
                </div>

                <div class="col-3 col-md-2 col-lg-1 d-flex justify-content-end">
                    <button
                        @click.stop="removeElement(index)"
                        type="button"
                        class="btn btn-icon btn-light-danger text-white mb-3 p-0"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        :title="$t('forms.delete')"
                    >
                        <font-awesome-icon icon="fa-solid fa-circle-minus" />
                    </button>
                </div>
            </div>
            <ul class="d-flex">
                <li
                    class="invalid-feedback mb-3"
                    v-if="formErrors.hasOwnProperty(`stages.${index}.name`)"
                >
                    {{ formErrors[`stages.${index}.name`][0] }}
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
import CompetitionsApi from "@api/competitions.api";
import { useToast } from "vue-toastification";

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
            CompetitionsApi.addUpdateStages(this.competition)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    if (this.buttonClickedType === "save") {
                        this.$router.push({
                            name: "competitions",
                        });
                    }
                    if (this.buttonClickedType === "save_and_next") {
                        this.$router.push({
                            name: "competition-place",
                            params: { id: data.data.id },
                        });
                    }
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
        addRow: function () {
            // this.mainForm.stage.rows.push({
            //     stageName: "",
            // });

            this.competition.stages.push({ name: "" });
        },
        removeElement: function (index) {
            // this.mainForm.stage.rows.splice(index, 1);
            this.competition.stages.splice(index, 1);
        },
    },
};
</script>
