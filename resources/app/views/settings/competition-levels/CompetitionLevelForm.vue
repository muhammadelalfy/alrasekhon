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
                    :model="this.competitionLevel"
                    name="competitionLevelAr"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <div class="col-md-6">
                <form-input
                    label="pages.level_en"
                    type="text"
                    :model="this.competitionLevel"
                    name="competitionLevelEn"
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
                    :options="saveAmountOptions"
                    :model="this.competitionLevel"
                    name="saveAmount"
                >
                </form-radio-group>
            </div>
        </div>
        <form-input
            v-if="competitionLevel.saveAmount == 'other'"
            label="pages.conservation_level"
            type="text"
            :model="this.competitionLevel"
            name="conservationLevel"
            :errors="formErrors"
            @clearErrors="clearInput"
        />
        <div class="mb-3" v-if="competitionLevel.saveAmount == 'other'">
            <div class="control-bg d-md-flex align-items-center flex-wrap">
                <form-radio-group
                    :options="otherOptions"
                    :model="this.competitionLevel"
                    name="otherType"
                >
                </form-radio-group>
            </div>
            <div class="row mt-3" v-if="competitionLevel.otherType == 'juz'">
                <div class="col-md-4">
                    <form-input
                        label="pages.from_juz"
                        type="number"
                        :model="this.competitionLevel"
                        name="fromJuz"
                        :errors="formErrors"
                        @clearErrors="clearInput"
                    />
                </div>
                <div class="col-md-4">
                    <form-input
                        label="pages.to_juz"
                        type="number"
                        :model="this.competitionLevel"
                        name="toJuz"
                        :errors="formErrors"
                        @clearErrors="clearInput"
                    />
                </div>
            </div>
            <div class="row mt-3" v-if="competitionLevel.otherType == 'hizb'">
                <div class="col-md-4">
                    <form-input
                        label="pages.from_hizb"
                        type="number"
                        :model="this.competitionLevel"
                        name="fromHizb"
                        :errors="formErrors"
                        @clearErrors="clearInput"
                    />
                </div>
                <div class="col-md-4">
                    <form-input
                        label="pages.to_hizb"
                        type="number"
                        :model="this.competitionLevel"
                        name="toHizb"
                        :errors="formErrors"
                        @clearErrors="clearInput"
                    />
                </div>
            </div>
            <div class="row mt-3" v-if="competitionLevel.otherType == 'surah'">
                <div class="col-md-4">
                    <form-input
                        label="pages.from_surah"
                        type="text"
                        :model="this.competitionLevel"
                        name="fromSurah"
                        :errors="formErrors"
                        @clearErrors="clearInput"
                    />
                </div>
                <div class="col-md-4">
                    <form-input
                        label="pages.to_surah"
                        type="text"
                        :model="this.competitionLevel"
                        name="toSurah"
                        :errors="formErrors"
                        @clearErrors="clearInput"
                    />
                </div>
            </div>
            <div class="row mt-3" v-if="competitionLevel.otherType == 'ayah'">
                <div class="col-md-4">
                    <form-select
                        title="pages.surah"
                        label="name"
                        name="surah"
                        @clearErrors="clearInput"
                        :model="this.competitionLevel"
                        :myOptions="surahOptions"
                        :errors="formErrors"
                    />
                </div>
                <div class="col-md-4">
                    <form-input
                        label="pages.from_ayah"
                        type="number"
                        :model="this.competitionLevel"
                        name="fromAyah"
                        :errors="formErrors"
                        @clearErrors="clearInput"
                    />
                </div>
                <div class="col-md-4">
                    <form-input
                        label="pages.to_ayah"
                        type="number"
                        :model="this.competitionLevel"
                        name="toAyah"
                        :errors="formErrors"
                        @clearErrors="clearInput"
                    />
                </div>
            </div>
        </div>
        <hr class="mt-2" />
        <div class="mb-3">
            <label class="form-label"> {{ $t("pages.other_controls") }}</label>
            <div class="control-bg d-md-flex align-items-center flex-wrap">
                <form-check-group
                    :options="otherControlsOptions"
                    :model="this.competitionLevel"
                    name="otherControls"
                >
                </form-check-group>
            </div>
        </div>
        <div v-if="competitionLevel.otherControls.indexOf('other') !== -1">
            <div class="row align-items-end">
                <div class="col-9 col-md-10 col-lg-11">
                    <form-input
                        label="pages.control_name"
                        type="text"
                        :model="this.competitionLevel"
                        name="controlName"
                        :errors="formErrors"
                        @clearErrors="clearInput"
                    />
                </div>
                <div class="col-3 col-md-2 col-lg-1 d-flex justify-content-end">
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
                v-for="(row, index) in competitionLevel.rows"
                :key="index"
            >
                <div class="col-9 col-md-10 col-lg-11">
                    <form-input
                        label="pages.control_name"
                        :showLabel="false"
                        type="text"
                        :model="this.competitionLevel.rows[index]"
                        name="title"
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
        <div class="mb-3">
            <label class="form-label"
                >{{ $t("pages.desc") }} (AR)
                <span class="ms-1 text-grayClr"
                    >( {{ $t("pages.optional") }} )</span
                ></label
            >
            <FormQuillEditor :model="this.competitionLevel" name="descAr" />
        </div>
        <div class="mb-3">
            <label class="form-label"
                >{{ $t("pages.desc") }} (EN)
                <span class="ms-1 text-grayClr"
                    >( {{ $t("pages.optional") }} )</span
                ></label
            >
            <FormQuillEditor :model="this.competitionLevel" name="descEn" />
        </div>
    </form-modal>
</template>

<script>
import { useToast } from "vue-toastification";

import { useI18n } from "vue-i18n";
export default {
    name: "CompetitionLevelForm",
    setup() {
        const { t } = useI18n();
        const saveAmountOptions = [
            {
                name: "whole_quran",
                label: t("pages.whole_quran"),
            },
            {
                name: "other",
                label: t("pages.other"),
            },
        ];
        const otherOptions = [
            {
                name: "juz",
                label: t("pages.juz"),
            },
            {
                name: "hizb",
                label: t("pages.hizb"),
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
        const otherControlsOptions = [
            {
                name: "tajweed",
                label: t("pages.tajweed_provisions"),
            },
            {
                name: "reading",
                label: t("pages.good_reading"),
            },
            {
                name: "other",
                label: t("pages.other"),
            },
        ];

        const surahOptions = [
            {
                value: "surah1",
                label: "الفاتحة",
            },
            {
                value: "surah2",
                label: "البقرة",
            },
        ];

        return {
            t,
            saveAmountOptions,
            otherOptions,
            surahOptions,
            otherControlsOptions,
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
    methods: {
        addRow: function () {
            this.competitionLevel.rows.push({
                title: "",
            });
        },
        removeElement: function (index) {
            this.competitionLevel.rows.splice(index, 1);
        },

        clearForm() {
            this.clearErrors();
        },
        // update() {
        //     this.submitFormDisabled = true;
        //     GovernorateApi.update(this.governorate)
        //         .then(({ data }) => {
        //             useToast().success(this.$t("messages.success"));
        //             this.submitFormDisabled = false;
        //             $("#governorateForm").modal("hide");

        //             this.afterModalUpdateActions(
        //                 this.governorate,
        //                 this.$parent.governorates,
        //                 data.data,
        //                 this.governorate.id
        //             );
        //         })
        //         .catch((error) => {
        //             console.log(error);
        //             this.submitFormDisabled = false;
        //             this.formErrors = error.response.data.errors;
        //         });
        // },
        // add() {
        //     this.submitFormDisabled = true;
        //     GovernorateApi.store(this.governorate)
        //         .then(({ data }) => {
        //             useToast().success(this.$t("messages.success"));
        //             this.submitFormDisabled = false;
        //             $("#governorateForm").modal("hide");
        //             this.afterModalAddActions(
        //                 this.governorate,
        //                 this.$parent.governorates,
        //                 data.data
        //             );
        //         })
        //         .catch((error) => {
        //             console.log(error);
        //             this.formErrors = error.response.data.errors;
        //         });
        // },
        // submit() {
        //     if (this.governorate.id === undefined) {
        //         console.log(this.governorate.id);
        //         this.add();
        //     } else {
        //         console.log(this.governorate.id);
        //         this.update();
        //     }
        // },
    },
};
</script>

<style scoped></style>
