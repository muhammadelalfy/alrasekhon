<template>
    <form-modal
        :id="id"
        :aria-labelledby="ariaLabelledby"
        :modal-dialog-centered="modalDialogCentered"
        :modal-lg="modalLg"
        @clearForm="clearForm"
        @submit="submit"
        :buttonDisabled="submitFormDisabled"
        :title="title"
    >
        <div class="row">
            <div class="col-md-6">
                <form-input
                    label="pages.level_ar"
                    type="text"
                    :model="this.competitionLevel.name"
                    name="ar"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <div class="col-md-6">
                <form-input
                    label="pages.level_en"
                    type="text"
                    :model="this.competitionLevel.name"
                    name="en"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
        </div>
        <hr class="mt-2" />
        <h4 class="modal-form-title mb-3">
            {{ $t("pages.level_rules_conditions") }}
        </h4>
        <div class="mb-3">
            <label class="form-label"> {{ $t("pages.save_amount") }}</label>
            <div class="control-bg d-md-flex align-items-center flex-wrap">
                <form-radio-group
                    :options="save_amountOptions"
                    :model="this.competitionLevel"
                    name="save_amount"
                >
                </form-radio-group>
            </div>
        </div>
        <div class="mb-3">
            <div class="row mt-3" v-if="competitionLevel.save_amount == 'guz'">
                <div class="col-md-6">
                    <form-select
                        title="pages.from_juz"
                        label="name"
                        name="from"
                        @clearErrors="clearInput"
                        :model="this.competitionLevel"
                        :myOptions="juzOptions"
                        :errors="formErrors"
                        labelField="name"
                        valueField="id"
                    />
                </div>
                <div class="col-md-6">
                    <form-select
                        title="pages.to_juz"
                        label="name"
                        name="to"
                        @clearErrors="clearInput"
                        :model="this.competitionLevel"
                        :myOptions="juzOptions"
                        :errors="formErrors"
                        labelField="name"
                        valueField="id"
                    />
                </div>
            </div>
            <div
                class="row mt-3"
                v-if="competitionLevel.save_amount == 'surah'"
            >
                <div class="col-md-6">
                    <form-select
                        title="pages.from_surah"
                        label="name"
                        name="fromSurah"
                        @clearErrors="clearInput"
                        :model="this.competitionLevel"
                        :myOptions="surahOptions"
                        :errors="formErrors"
                        labelField="name"
                        valueField="id"
                    />
                </div>
                <div class="col-md-6">
                    <form-select
                        title="pages.to_surah"
                        label="name"
                        name="toSurah"
                        @clearErrors="clearInput"
                        :model="this.competitionLevel"
                        :myOptions="surahOptions"
                        :errors="formErrors"
                        labelField="name"
                        valueField="id"
                    />
                </div>
            </div>
            <div class="row mt-3" v-if="competitionLevel.save_amount == 'ayah'">
                <div class="col-md-6">
                    <label class="form-label">
                        {{ $t("pages.from") }}
                    </label>
                    <div class="row border rounded p-2 pb-0 mx-0">
                        <div class="col-md-6">
                            <form-select
                                title="pages.surah"
                                label="name"
                                name="fromSurahOption"
                                @clearErrors="clearInput"
                                @change="getStartAya('fromSurahOption')"
                                :model="this.competitionLevel"
                                :myOptions="surahOptions"
                                :errors="formErrors"
                                labelField="name"
                                valueField="id"
                            />
                        </div>
                        <div class="col-md-6">
                            <form-select
                                title="pages.ayah"
                                label="name"
                                name="fromAyah"
                                @clearErrors="clearInput"
                                :model="this.competitionLevel"
                                :myOptions="this.ayahOptions"
                                :errors="formErrors"
                                labelField="name"
                                valueField="name"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">
                        {{ $t("pages.to") }}
                    </label>
                    <div class="row border rounded p-2 pb-0 mx-0">
                        <div class="col-md-6">
                            <form-select
                                title="pages.surah"
                                label="name"
                                name="toSurahOption"
                                @clearErrors="clearInput"
                                :model="this.competitionLevel"
                                @change="getStartAya('toSurahOption')"
                                :myOptions="surahOptions"
                                :errors="formErrors"
                                labelField="name"
                                valueField="id"
                            />
                        </div>
                        <div class="col-md-6">
                            <form-select
                                title="pages.ayah"
                                label="name"
                                name="toAyah"
                                @clearErrors="clearInput"
                                :model="this.competitionLevel"
                                :myOptions="ayahOptions"
                                :errors="formErrors"
                                labelField="name"
                                valueField="id"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mt-2" />
        <div class="mb-3">
            <label class="form-label"> {{ $t("pages.other_controls") }}</label>
            <div class="control-bg d-md-flex align-items-center flex-wrap">
                <form-check-group
                    :options="other_controlsOptions"
                    :model="competitionLevel"
                    name="other_controls"
                >
                </form-check-group>
            </div>
        </div>
        <div v-if="competitionLevel.other_controls.indexOf('other') !== -1">
            <div class="d-flex align-items-center flex-wrap">
                <h6 class="fw-bold mb-3 me-2">
                    {{ $t("pages.control_name") }}
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
                <!-- <div class="col-9 col-md-10 col-lg-11"> -->
                <!--                    <form-input-->
                <!--                        label="pages.controlName"-->
                <!--                        type="text"-->
                <!--                        multiple="multiple"-->
                <!--                        :model="this.competitionLevel"-->
                <!--                        name="controlName"-->
                <!--                        :errors="formErrors"-->
                <!--                        @clearErrors="clearInput"-->
                <!--                    />-->
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
                        <font-awesome-icon icon="fa-solid fa-circle-plus"/>
                    </button>
                </div> -->
            </div>
            <div
                class="row align-items-end"
                v-for="(row, index) in competitionLevel.controlName"
                :key="index"
            >
                <div class="col-9 col-md-10 col-lg-11">
                    <form-input
                        label="pages.control_name"
                        :showLabel="true"
                        type="text"
                        :model="this.competitionLevel.controlName"
                        :name="index"
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
        </div>
        <div class="row">
            <div class="col-md-6">
                <form-input
                    label="pages.winners_num"
                    type="number"
                    :model="this.competitionLevel"
                    name="winners_count"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
        </div>
    </form-modal>
</template>

<script>
import { useToast } from "vue-toastification";
import SuraApi from "@api/sura.api";
import JuzApi from "@api/juz.api";
import { useI18n } from "vue-i18n";
import { reactive, watch } from "vue";
import CompetitionsApi from "@api/competitions.api";

export default {
    name: "CompetitionLevelForm",
    setup() {
        const { t } = useI18n();
        const save_amountOptions = [
            {
                name: "the_hole_quran",
                label: t("pages.whole_quran"),
            },
            {
                name: "guz",
                label: t("pages.juz"),
            },
            {
                name: "surah",
                label: t("pages.surah"),
            },
            {
                name: "ayah",
                label: t("pages.ayah"),
            },
        ];
        const other_controlsOptions = [
            {
                name: "tagweed_provisions",
                label: t("pages.tajweed_provisions"),
            },
            {
                name: "good_reading",
                label: t("pages.good_reading"),
            },
            {
                name: "other",
                label: t("pages.other"),
            },
        ];

        return {
            t,
            save_amountOptions,
            other_controlsOptions,
        };
    },

    props: {
        id: {
            type: String,
            default: "MainAddModal",
        },
        ariaLabelledby: String,
        dataBsBackdrop: String,
        dataBskeyboard: String,
        modalDialogScrollable: Boolean,
        modalDialogCentered: Boolean,
        modalLg: Boolean,
        modalFullscreen: Boolean,
        competitionLevel: {
            type: Object,
        },
        title: {
            type: String,
            default: "pages.add_level",
        },
    },
    data() {
        return {
            ayahOptions: [],
            surahOptions: [],
            juzOptions: [],
        };
    },
    methods: {
        clearForm() {
            this.clearErrors();
            this.resetForm(this.competitionLevel);
        },

        addRow: function () {
            this.competitionLevel.controlName.push("");
        },
        removeElement: function (index) {
            this.competitionLevel.controlName.splice(index, 1);
        },

        getSuras: function () {
            SuraApi.list()
                .then(({ data }) => {
                    this.surahOptions = data.data;
                })
                .catch((error) => {
                    this.formErrors = error.response.data.errors;
                });
        },
        getJuz: function () {
            JuzApi.list()
                .then(({ data }) => {
                    this.juzOptions = data.data;
                })
                .catch((error) => {
                    this.formErrors = error.response.data.errors;
                });
        },
        getStartAya: function (key) {
            let data = { id: this.competitionLevel[key] }; //send id of sura to fetch the number of ayat elsura
            SuraApi.get(data)
                .then(({ data }) => {
                    this.ayahOptions = Array.from(
                        { length: data.data.ayas },
                        (_, index) => {
                            return {
                                id: index + 1,
                                name: index + 1,
                            };
                        }
                    );
                })
                .catch((error) => {
                    this.formErrors = error.response.data.errors;
                });
        },

        UpdateCompetitionLevel() {
            this.competitionLevel.competition_id = this.$route.params.id;
            CompetitionsApi.updateCompetitionLevel(this.competitionLevel)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    console.log(data.data);
                    $("#MainAddModal").modal("hide");
                    if (this.competitionLevel.id) {
                        this.afterModalUpdateActions(
                            this.competitionLevel,
                            this.$parent.competitionlevels,
                            data.data,
                            this.competitionLevel.id
                        );
                    } else {
                        this.afterModalAddActions(
                            this.competitionLevel,
                            this.$parent.competitionlevels,
                            data.data
                        );
                    }
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
        submit() {
            this.UpdateCompetitionLevel();
        },
    },

    mounted() {
        this.getSuras();
        this.getJuz();
    },
};
</script>

<style scoped></style>
