<template>
    <div>
        <div class="row">
            <div class="col-md-4">
                <label class="form-label">{{ $t("pages.profile_pic") }}</label>
                <FormImageUploader
                    name="profile_photo"
                    accept="png,jpg,jpeg"
                    @file-uploaded="getUploadedData($event)"
                    :src="
                        this.file.filePreview
                            ? this.file.filePreview
                            : this.arbitrator.profile_photo
                    "
                    :size="2"
                    :limit="1"
                    width="w-100"
                />
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <form-input
                    id="first-name"
                    label="pages.first_name"
                    type="text"
                    :model="this.arbitrator"
                    name="first_name"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <div class="col-md-4">
                <form-input
                    id="second-name"
                    label="pages.second_name"
                    type="text"
                    :model="this.arbitrator"
                    name="second_name"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <div class="col-md-4">
                <form-input
                    id="last-name"
                    label="pages.last_name"
                    type="text"
                    :model="this.arbitrator"
                    name="last_name"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <div class="col-md-4">
                <form-date-select
                    label="pages.dob"
                    :model="this.arbitrator"
                    name="birth_date"
                    type="date"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">
                        {{ $t("pages.identity_proof") }}</label
                    >
                    <div
                        class="control-bg d-md-flex align-items-center flex-wrap"
                    >
                        <form-radio-group
                            :options="identityProofOptions"
                            :model="this.arbitrator"
                            name="identity_proof"
                        >
                        </form-radio-group>
                    </div>
                </div>
            </div>
            <div
                class="col-md-4"
                v-if="this.arbitrator.identity_proof === 'national_id'"
            >
                <form-input
                    id="national-iD"
                    label="pages.national_iD"
                    type="number"
                    :model="this.arbitrator"
                    name="national_id"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <div
                class="col-md-4"
                v-if="this.arbitrator.identity_proof === 'passport'"
            >
                <form-input
                    id="passport"
                    label="pages.passport"
                    type="text"
                    :model="this.arbitrator"
                    name="passport"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <div class="col-md-4">
                <form-select
                    title="pages.type"
                    label="gender"
                    name="gender"
                    @clearErrors="clearInput"
                    :model="this.arbitrator"
                    :myOptions="genderOptions"
                    :errors="formErrors"
                />
            </div>
            <div class="col-md-4">
                <form-select
                    title="pages.level"
                    label="name"
                    name="arbitrator_level_ids"
                    multiple
                    :model="this.arbitrator"
                    :myOptions="arbitratorLevels"
                    label-field="name_localized"
                    value-field="id"
                    @clearErrors="clearInput"
                    :errors="formErrors"
                />
            </div>
            <div class="col-md-4">
                <form-input
                    id="nationality"
                    label="pages.nationality"
                    type="text"
                    :model="this.arbitrator"
                    name="nationality"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <div class="col-md-4">
                <form-input
                    id="email"
                    label="pages.email"
                    type="email"
                    :model="this.arbitrator"
                    name="email"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <div class="col-md-4">
                <form-select
                    title="pages.country_code"
                    label="name"
                    name="country_code"
                    :model="this.arbitrator"
                    :myOptions="countryCodeOptions"
                    label-field="label"
                    value-field="value"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <div class="col-md-4">
                <form-input
                    id="phone"
                    label="pages.phone"
                    type="tel"
                    :model="this.arbitrator"
                    name="phone"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <div class="col-md-4">
                <form-input
                    id="password"
                    label="pages.password"
                    type="password"
                    :model="this.arbitrator"
                    name="password"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <div class="col-md-4">
                <form-input
                    id="password-confirm"
                    label="pages.password_confirmation"
                    type="password"
                    :model="this.arbitrator"
                    name="password_confirmation"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">{{
                        $t("pages.attached_contract")
                    }}</label>
                    <el-upload
                        name="contract_attachment"
                        accept="jpg,jpeg,png,pdf"
                        ref="uploadRefContract"
                        class="upload-demo"
                        :http-request="handleUpload"
                        :auto-upload="true"
                        :limit="1"
                        :size="60"
                    >
                        <!--                        <el-alert-->
                        <!--                            v-if="formErrors.contract_attachment"-->
                        <!--                            :title="formErrors.contract_attachment[0]"-->
                        <!--                            type="error"-->
                        <!--                            show-icon-->
                        <!--                        />-->
                        <template #trigger>
                            <div
                                class="align-items-center control-bg d-flex flex-wrap justify-content-end w-100"
                            >
                                <font-awesome-icon icon="fa-solid fa-upload" />
                            </div>
                        </template>
                    </el-upload>
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3 d-flex align-items-center flex-wrap h-100">
                    <label class="form-label me-2">{{
                        $t("pages.status")
                    }}</label>
                    <form-switcher
                        id="status"
                        :model="this.arbitrator"
                        name="status"
                        :errors="formErrors"
                        @clearErrors="clearInput"
                    >
                    </form-switcher>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-cenetr pt-4 justify-content-end">
            <button
                type="button"
                @click.prevent="onNextTab(1, 0)"
                class="btn btn-babyblue text-white fw-bold"
            >
                {{ $t("pagination.next") }}
            </button>
        </div>
    </div>
</template>

<script>
import ArbitratorsApi from "@api/arbitrators.api";
import ArbitratorLevelsApi from "@api/arbitrator-levels.api";
import { useI18n } from "vue-i18n";

export default {
    name: "StepOne",
    data() {
        const { t } = useI18n();
        return {
            arbitratorLevels: [],
            countryCodeOptions: [
                {
                    value: "+20",
                    label: "+20",
                },
                {
                    value: "+965",
                    label: "+965",
                },
                {
                    value: "+966",
                    label: "+966",
                },
            ],
            genderOptions: [
                {
                    value: "male",
                    label: t("pages.male"),
                    check: this.arbitrator
                        ? this.arbitrator.gender === "male"
                        : false,
                },
                {
                    value: "female",
                    label: t("pages.female"),
                    check: this.arbitrator
                        ? this.arbitrator.gender === "female"
                        : false,
                },
            ],
            identityProofOptions: [
                {
                    name: "national_id",
                    label: t("pages.national_iD"),
                    check: this.arbitrator
                        ? this.arbitrator.identity_proof === "national_id"
                        : false,
                },
                {
                    name: "passport",
                    label: t("pages.passport"),
                    check: this.arbitrator
                        ? this.arbitrator.identity_proof === "passport"
                        : false,
                },
            ],
            file: {
                filePreview: "",
                fileName: "",
            },
        };
    },
    props: ["arbitrator", "onNextTab", "onBackTab", "formErrors", "clearInput"],

    methods: {
        getArbitratorLevels() {
            ArbitratorLevelsApi.list()
                .then(({ data }) => {
                    this.arbitratorLevels = data.data;
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
            formData.append("profile_photo", imageFile);
            formData.append("type", "profile_photo");
            ArbitratorsApi.upload(formData)
                .then(({ data }) => {
                    this.arbitrator.profile_photo_id = data.id;
                    this.arbitrator.file_type.push(data.type);
                    console.log(data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async handleUpload(event) {
            let formData = new FormData();
            formData.append("contract_attachment", event.file);
            formData.append("type", "contract_attachment");

            ArbitratorsApi.upload(formData)
                .then(({ data }) => {
                    this.arbitrator.contract_attachment_id = data.id;
                    this.arbitrator.file_type.push(data.type);
                    console.log(data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },

    created() {
        this.getArbitratorLevels();
    },
};
</script>

<style scoped></style>
