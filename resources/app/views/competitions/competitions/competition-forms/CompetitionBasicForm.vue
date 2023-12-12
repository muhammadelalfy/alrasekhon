<template>
    <form>
        <div class="row">
            <div class="col-md-6">
                <label class="form-label">{{
                    $t("pages.competition_logo")
                }}</label>
                <FormImageUploader
                    name="competition_photo"
                    accept="jpg,jpeg,png,gif,pdf"
                    @file-uploaded="getUploadedData($event)"
                    :src="
                        this.file.filePreview
                            ? this.file.filePreview
                            : this.competition.competition_photo
                    "
                    :size="5"
                    :limit="1"
                    width="w-100"
                />
            </div>
        </div>
        <div class="row align-items-end">
            <div class="col-md-6">
                <form-input
                    id="competition-name"
                    label="pages.competition_name"
                    type="text"
                    :model="this.competition"
                    name="name"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <div class="col-md-6">
                <form-select
                    title="pages.type"
                    label="name"
                    name="competition_type_id"
                    @clearErrors="clearInput"
                    :model="this.competition"
                    :myOptions="competitionTypes"
                    label-field="name_localized"
                    value-field="id"
                    :errors="formErrors"
                />
            </div>
            <div class="col-md-6">
                <form-date-select
                    label="pages.competition_date"
                    :model="this.competition"
                    type="daterange"
                    name="competition_date"
                    :range-separator="$t('pages.to')"
                    :start-placeholder="$t('pages.start_date')"
                    :end-placeholder="$t('pages.end_date')"
                    :errors="formErrors"
                />
                <ul class="d-flex mb-3">
                    <li
                        class="invalid-feedback"
                        v-if="formErrors.hasOwnProperty('competition_date.0')"
                    >
                        {{ formErrors["competition_date.0"][0] }}
                    </li>
                    <li
                        class="invalid-feedback"
                        v-if="formErrors.hasOwnProperty('competition_date.1')"
                    >
                        {{ formErrors["competition_date.1"][0] }}
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <form-date-select
                    label="pages.registration_date"
                    :model="this.competition"
                    type="daterange"
                    name="registration_date"
                    :range-separator="$t('pages.to')"
                    :start-placeholder="$t('pages.start_date')"
                    :end-placeholder="$t('pages.end_date')"
                    :errors="formErrors"
                />
                <ul class="d-flex mb-3">
                    <li
                        class="invalid-feedback"
                        v-if="formErrors.hasOwnProperty('registration_date.0')"
                    >
                        {{ formErrors["registration_date.0"][0] }}
                    </li>
                    <li
                        class="invalid-feedback"
                        v-if="formErrors.hasOwnProperty('registration_date.1')"
                    >
                        {{ formErrors["registration_date.1"][0] }}
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <form-input
                    label="pages.contestants_max_num"
                    type="number"
                    :model="this.competition"
                    name="competitors_max_num"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <div class="col-md-6">
                <form-input
                    label="pages.competition_budget"
                    type="number"
                    :model="this.competition"
                    name="competition_budget"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
        </div>

        <div class="row">
            <!-- <div class="col-12 col-md-4 col-lg-5"> -->
            <!--                <form-input-->
            <!--                    label="pages.age_group"-->
            <!--                    type="text"-->
            <!--                    :model="this.competition.age_group"-->
            <!--                    :name="0"-->
            <!--                    :errors="formErrors"-->
            <!--                    @clearErrors="clearInput"-->
            <!--                />-->
            <!--                <ul class="d-flex">-->
            <!--                    <li class="invalid-feedback" v-if="formErrors.hasOwnProperty('age_group_validation')">{{formErrors['age_group_validation'][0]}}</li>-->
            <!--                    <li class="invalid-feedback" v-if="formErrors.hasOwnProperty('age_group')">{{formErrors['age_group'][0]}}</li>-->
            <!--                </ul>-->
            <!-- </div>
            <div class="col-12 col-md-3"> -->
            <!--                <label class="form-label">-->
            <!--                    {{ $t("pages.age") }}-->
            <!--                </label>-->
            <!--                <form-input-->
            <!--                    label="pages.from"-->
            <!--                    :showLabel="false"-->
            <!--                    type="number"-->
            <!--                    :model="this.competition.age_from"-->
            <!--                    :name="0"-->
            <!--                    :errors="formErrors"-->
            <!--                    @clearErrors="clearInput"-->
            <!--                />-->
            <!--                <ul class="d-flex">-->
            <!--                    <li class="invalid-feedback" v-if="formErrors.hasOwnProperty('age_from_validation') ">{{formErrors['age_from_validation'][0]}}</li>-->
            <!--                    <li class="invalid-feedback" v-if="formErrors.hasOwnProperty('age_from')">{{formErrors['age_from'][0]}}</li>-->
            <!--                </ul>-->
            <!-- </div>
            <div class="col-12 col-md-3"> -->
            <!--                <form-input-->
            <!--                    label="pages.to"-->
            <!--                    :showLabel="false"-->
            <!--                    type="number"-->
            <!--                    :model="this.competition.age_to"-->
            <!--                    :name="0"-->
            <!--                    :errors="formErrors"-->
            <!--                    @clearErrors="clearInput"-->
            <!--                />-->
            <!--                <ul class="d-flex">-->
            <!--                    <li class="invalid-feedback" v-if="formErrors.hasOwnProperty('age_to_validation')">{{formErrors['age_to_validation'][0]}}</li>-->
            <!--                    <li class="invalid-feedback" v-if="formErrors.hasOwnProperty('age_to')">{{formErrors['age_to'][0]}}</li>-->
            <!--                </ul>-->
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

            <div class="col-12 d-flex align-items-center flex-wrap">
                <h6 class="fw-bold mb-3 me-2">
                    {{ $t("pages.age_group") }}
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
        </div>
        <div
            class="row align-items-end"
            v-for="(row, index) in this.competition.age_group"
            :key="index"
        >
            <div class="col-12 col-md-4 col-lg-5">
                <form-input
                    label="pages.age_group"
                    :showLabel="true"
                    type="text"
                    :model="this.competition.age_group"
                    :name="index"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
                <ul class="d-flex">
                    <li
                        class="invalid-feedback mb-3"
                        v-if="formErrors.hasOwnProperty('age_group_validation')"
                    >
                        {{ formErrors["age_group_validation"][0] }}
                    </li>
                    <li
                        class="invalid-feedback mb-3"
                        v-if="formErrors.hasOwnProperty('age_group')"
                    >
                        {{ formErrors["age_group"][0] }}
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-3">
                <form-input
                    label="pages.from"
                    :showLabel="true"
                    type="number"
                    :model="this.competition.age_from"
                    :name="index"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
                <ul class="d-flex">
                    <li
                        class="invalid-feedback mb-3"
                        v-if="formErrors.hasOwnProperty('age_from_validation')"
                    >
                        {{ formErrors["age_from_validation"][0] }}
                    </li>
                    <li
                        class="invalid-feedback mb-3"
                        v-if="formErrors.hasOwnProperty('age_from')"
                    >
                        {{ formErrors["age_from"][0] }}
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-3">
                <form-input
                    label="pages.to"
                    :showLabel="true"
                    type="number"
                    :model="this.competition.age_to"
                    :name="index"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
                <ul class="d-flex">
                    <li
                        class="invalid-feedback mb-3"
                        v-if="formErrors.hasOwnProperty('age_to_validation')"
                    >
                        {{ formErrors["age_to_validation"][0] }}
                    </li>
                    <li
                        class="invalid-feedback mb-3"
                        v-if="formErrors.hasOwnProperty('age_to')"
                    >
                        {{ formErrors["age_to"][0] }}
                    </li>
                </ul>
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

        <div class="d-flex align-items-cenetr my-4 justify-content-end">
            <button
                type="button"
                class="btn btn-light-babyblue text-white fw-bold"
                @click="saveAndNext()"
            >
                {{ $t("forms.save_next") }}
            </button>
            <button
                type="button"
                class="btn btn-babyblue text-white fw-bold mx-2"
                @click="submit"
            >
                {{ $t("forms.save") }}
            </button>

            <cancel-button />
            <!--            <button type="button" class="btn btn-light fw-bold" @click="cancelAdd">-->
            <!--                {{ $t("forms.cancel") }}-->
            <!--            </button>-->
        </div>
    </form>
</template>

<script>
import Card from "@/components/Card.vue";
import { reactive } from "vue";
import CompetitionsApi from "@api/competitions.api";
import { useToast } from "vue-toastification";
import CompetitionTypesApi from "@api/competition-types.api";

export default {
    components: {
        Card,
    },

    data() {
        return {
            competitionTypes: [],
            file: {
                filePreview: "",
                fileName: "",
            },
            buttonClickedType: "save",
        };
    },

    props: {
        competition: Object,
    },

    methods: {
        saveAndNext: function () {
            this.buttonClickedType = "save_and_next";
            this.submit();
        },
        addRow: function () {
            // this.mainForm.compAgeGroup.rows.push({
            //     ageGroup: "",
            //     from: "",
            //     to: "",
            // });

            this.competition.age_group.push("");
            this.competition.age_from.push("");
            this.competition.age_to.push("");
        },
        removeElement: function (index) {
            // this.mainForm.compAgeGroup.rows.splice(index, 1);
            this.competition.age_group.splice(index, 1);
            this.competition.age_from.splice(index, 1);
            this.competition.age_to.splice(index, 1);
        },
        getCompetitionType() {
            CompetitionTypesApi.list({ get_for_competition: true })
                .then(({ data }) => {
                    this.competitionTypes = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getUploadedData($event) {
            this.file.filePreview = $event.previewBase64;
            this.file.fileName = $event.name;

            let formData = new FormData();
            var arr = $event.previewBase64.split(","),
                mime = arr[0].match(/:(.*?);/)[1],
                bstr = atob(arr[1]),
                n = bstr.length,
                u8arr = new Uint8Array(n);

            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }
            let imageFile = new File([u8arr], $event.name, { type: mime });
            formData.append("competition_photo", imageFile);
            formData.append("type", "competition_photo");
            CompetitionsApi.upload(formData)
                .then(({ data }) => {
                    this.competition.competition_photo_id = data.id;
                    // this.competition.file_type.push(data.type);
                    console.log(data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        addCompetition() {
            CompetitionsApi.store(this.competition)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    this.$parent.competition = data.data;

                    if (this.buttonClickedType === "save") {
                        this.$router.push({
                            name: "competitions",
                        });
                    }
                    if (this.buttonClickedType === "save_and_next") {
                        this.$router.push({
                            name: "competition-levels",
                            params: { id: data.data.id },
                        });
                    }
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
        updateCompetition() {
            CompetitionsApi.update(this.competition)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    this.$parent.competition = data.data;

                    if (this.buttonClickedType === "save") {
                        this.$router.push({
                            name: "competitions",
                        });
                    }
                    if (this.buttonClickedType === "save_and_next") {
                        this.$router.push({
                            name: "competition-levels",
                            params: { id: data.data.id },
                        });
                    }
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },

        submit() {
            if (this.$route.params.id) {
                this.updateCompetition();
            } else {
                this.addCompetition();
            }
        },
    },

    mounted() {
        this.getCompetitionType();
    },
};
</script>
