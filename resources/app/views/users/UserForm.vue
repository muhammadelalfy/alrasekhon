<template>
    <Wizard
        :startIndex="currentTabIndex"
        :next-button="{
            text: $t('pagination.next'),
            icon: 'check',
            hideIcon: true,
            hideText: false,
        }"
        :back-button="{
            text: $t('pagination.prev'),
            hideIcon: true,
            hideText: false,
        }"
        :done-button="{
            text: $t('forms.save'),
            hideIcon: true,
        }"
        hideButtons
        :custom-tabs="[
            {
                title: $t('pages.mod_main_info'),
            },
            {
                title: $t('pages.address_info'),
            },
        ]"
        @change="onChangeCurrentTab"
    >
        <form>
            <div
                v-if="
                    currentTabIndex === 0 &&
                    (this.User.step_no === 1 || this.User.step_no === null)
                "
            >
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">{{
                            $t("pages.profile_pic")
                        }}</label>
                        <FormImageUploader
                            name="profile_photo"
                            accept="png,jpg,jpeg"
                            @file-uploaded="getUploadedData($event)"
                            :src="
                                this.file.filePreview
                                    ? this.file.filePreview
                                    : this.User.file_url
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
                            :model="User"
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
                            :model="User"
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
                            :model="User"
                            name="last_name"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-date-select
                            label="pages.dob"
                            :model="User"
                            name="birth_date"
                            :errors="formErrors"
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
                                    :model="User"
                                    name="identity_proof"
                                >
                                </form-radio-group>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-md-4"
                        v-if="User.identity_proof === 'national_id'"
                    >
                        <form-input
                            id="national_id"
                            label="pages.national_iD"
                            type="number"
                            :model="User"
                            name="national_id"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>
                    <div
                        class="col-md-4"
                        v-if="User.identity_proof === 'passport'"
                    >
                        <form-input
                            id="passport"
                            label="pages.passport"
                            type="text"
                            :model="User"
                            name="passport"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-select
                            title="pages.type"
                            label="name"
                            name="gender"
                            @clearErrors="clearInput"
                            :model="User"
                            :myOptions="typeOptions"
                            :errors="formErrors"
                            label-field="label"
                            value-field="value"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-input
                            id="nationality"
                            label="pages.nationality"
                            type="text"
                            :model="User"
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
                            :model="User"
                            name="email"
                            value-field="value"
                            label-field="label"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-input
                            id="educational-qualification"
                            label="pages.educational_qualification"
                            type="text"
                            :model="User"
                            name="qualifications"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>

                    <div class="col-md-4">
                        <form-select
                            title="pages.email_status"
                            label="name"
                            name="email_status"
                            @clearErrors="clearInput"
                            :model="User"
                            :myOptions="emailStatusOptions"
                            :errors="formErrors"
                            label-field="label"
                            value-field="value"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-input
                            id="basic-job"
                            label="pages.basic_job"
                            type="text"
                            :model="User"
                            name="main_job"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-input
                            id="phone"
                            label="pages.phone"
                            value="+"
                            type="tel"
                            :model="User"
                            name="phone"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-select
                            title="pages.phone_status"
                            label="name"
                            name="phone_status"
                            @clearErrors="clearInput"
                            :model="User"
                            :myOptions="phoneStatusOptions"
                            label-field="label"
                            value-field="value"
                            :errors="formErrors"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-input
                            id="password"
                            label="pages.password"
                            type="password"
                            :model="User"
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
                            :model="User"
                            name="password_confirmation"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-select
                            title="pages.lang"
                            label="name"
                            name="lang"
                            @clearErrors="clearInput"
                            :model="User"
                            :myOptions="langOptions"
                            :errors="formErrors"
                            value-field="value"
                            label-field="label"
                        />
                    </div>
                    <div class="col-md-4">
                        <div
                            class="mb-3 d-flex align-items-center flex-wrap h-100"
                        >
                            <label class="form-label me-2">{{
                                $t("pages.status")
                            }}</label>
                            <form-switcher
                                id="status"
                                :model="User"
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
            <div v-if="currentTabIndex === 1 || this.User.step_no === 2">
                <div class="row">
                    <div class="col-md-4">
                        <form-select
                            title="pages.country"
                            label="name"
                            label-field="name_localized"
                            name="country_id"
                            @clearErrors="clearInput"
                            :model="User"
                            :myOptions="this.countries"
                            value-field="id"
                            :errors="formErrors"
                            @change="getGovernorates"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-select
                            title="pages.governorate"
                            label="name"
                            label-field="name_localized"
                            value-field="id"
                            name="governorate_id"
                            @clearErrors="clearInput"
                            :model="User"
                            :myOptions="this.governorates"
                            :errors="formErrors"
                            @change="getCities"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-select
                            title="pages.city"
                            label="name"
                            label-field="name_localized"
                            value-field="id"
                            name="city_id"
                            @clearErrors="clearInput"
                            :model="User"
                            :myOptions="this.cities"
                            :errors="formErrors"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-text-area
                            id="main-address"
                            label="pages.main_address"
                            :model="User"
                            name="address"
                            :rows="4"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-text-area
                            id="alternative-address"
                            label="pages.alternative_address"
                            :model="User"
                            name="alternative_address"
                            :rows="4"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>
                </div>
                <div class="d-flex align-items-cenetr pt-4 justify-content-end">
                    <button
                        @click.prevent="wizardCompleted()"
                        type="button"
                        class="btn btn-babyblue text-white fw-bold"
                    >
                        {{ $t("forms.save") }}
                    </button>
                    <button
                        type="button"
                        class="btn btn-light text-grayClr fw-bold ms-2"
                        @click.prevent="onBackTab(0, 1)"
                    >
                        {{ $t("pagination.prev") }}
                    </button>
                </div>
            </div>
        </form>
    </Wizard>
</template>

<script>
import "form-wizard-vue3/dist/form-wizard-vue3.css";
import Wizard from "form-wizard-vue3";
import { useI18n } from "vue-i18n";
import CountryApi from "@api/country.api";
import { useToast } from "vue-toastification";
import GovernorateApi from "@api/governorate.api";
import CityApi from "@api/city.api";
import FormRadioGroup from "@/components/form/FormRadioGroup.vue";
import usersApi from "@api/user.api";
import { ref } from "vue";

export default {
    components: {
        FormRadioGroup,
        Wizard,
    },

    data() {
        const { t } = useI18n();
        return {
            currentTabIndex: 0,
            is_last_step: false,
            User: {
                id: "",
                first_name: "",
                second_name: "",
                last_name: "",
                gender: "",
                email_status: 1,
                phone_status: 1,
                nationality: "",
                email: "",
                qualifications: "",
                main_job: "",
                phone: "",
                password: "",
                password_confirmation: "",
                lang: "",
                identity_proof: "national_id",
                status: true,
                country_id: "",
                governorate: "",
                city_id: "",
                address: "",
                file_id: "",
                file_url: "",
                alternative_address: "",
                birth_date: "",
                type: "",
                step_no: 1,
            },
            file: {
                filePreview: "",
                fileName: "",
            },

            identityProofOptions: [
                {
                    name: "national_id",
                    label: t("pages.national_iD"),
                    check: this.User
                        ? this.User.identity_proof === "national_id"
                        : false,
                },
                {
                    name: "passport",
                    label: t("pages.passport"),
                    check: this.User
                        ? this.User.identity_proof === "passport"
                        : false,
                },
            ],

            langOptions: [
                {
                    value: "ar",
                    label: t("ar"),
                    selected: this.User ? this.User.lang === "ar" : false,
                },
                {
                    value: "en",
                    label: t("en"),
                    selected: this.User ? this.User.lang === "en" : false,
                },
            ],
            phoneStatusOptions: [
                {
                    value: 1,
                    label: t("pages.active"),
                    selected: this.User ? this.User.phone_status === 1 : false,
                },

                {
                    value: 0,
                    label: t("pages.notActive"),
                    selected: this.User ? this.User.phone_status === 0 : false,
                },
            ],
            typeOptions: [
                {
                    value: "male",
                    label: t("pages.male"),
                    selected: this.User ? this.User.gender === "male" : false,
                },
                {
                    value: "female",
                    label: t("pages.female"),
                    selected: this.User ? this.User.gender === "female" : false,
                },
            ],
            emailStatusOptions: [
                {
                    value: 1,
                    label: t("pages.active"),
                    selected: this.User ? this.User.email_status === 1 : false,
                },

                {
                    value: 0,
                    label: t("pages.notActive"),
                    selected: this.User ? this.User.email_status === 0 : false,
                },
            ],

            countries: [],
            governorates: [],
            cities: [],
        };
    },

    methods: {
        onChangeCurrentTab(index) {
            this.currentTabIndex = index;
        },
        onNextTab(index) {
            this.createOrUpdate(this.User, index);
        },
        onBackTab(index) {
            this.currentTabIndex = index;
            this.User.is_last_step = false;
            this.User.step_no = this.User.step_no - 1;
            setTimeout(function () {
                $(".fw-list-progress")
                    .not(".fw-list-progress-active")
                    .parent()
                    .next()
                    .find(".fw-list-wrapper-icon")
                    .removeClass("fw-step-active");
            }, 100);
        },
        wizardCompleted() {
            this.User.is_last_step = true;
            this.createOrUpdate(this.User, 2);
        },

        createOrUpdate(model, index) {
            if (index === 1) {
                if (this.User.id === "") {
                    usersApi
                        .store(this.User)
                        .then(({ data }) => {
                            useToast().success(this.$t("messages.success"));
                            this.currentTabIndex = index;
                            this.User.step_no = index + 1;
                            this.User.id = data.data.id;
                            setTimeout(function () {
                                if (
                                    $(".fw-list-progress").hasClass(
                                        "fw-list-progress-active"
                                    )
                                ) {
                                    $(".fw-list-progress-active")
                                        .parent("li")
                                        .next("li")
                                        .find(".fw-list-wrapper-icon")
                                        .addClass("fw-step-active");
                                }
                            }, 100);
                        })
                        .catch((error) => {
                            console.log(error);
                            this.formErrors = error.response.data.errors;
                        });
                }
                if (this.User.id !== "") {
                    usersApi
                        .update(this.User)
                        .then(({ data }) => {
                            useToast().success(this.$t("messages.success"));
                            this.currentTabIndex = index;
                            this.User.step_no = index + 1;
                        })
                        .catch((error) => {
                            this.formErrors = error.response.data.errors;
                        });
                }
            }
            if (index === 2) {
                usersApi
                    .updateStep(this.User)
                    .then(({ data }) => {
                        useToast().success(this.$t("messages.success"));
                        if (!data.step_no) {
                            this.$router.push({
                                path: "/users",
                            });
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                        this.formErrors = error.response.data.errors;
                    });
            }
        },
        checkActiveStep() {
            if (this.currentTabIndex === 1 || this.User.step_no === 2) {
                this.currentTabIndex = 2;
                setTimeout(function () {
                    if (
                        $(".fw-list-progress").hasClass(
                            "fw-list-progress-active"
                        )
                    ) {
                        $(".fw-list-progress-active")
                            .parent("li")
                            .next("li")
                            .find(".fw-list-wrapper-icon")
                            .addClass("fw-step-active");
                    }
                }, 100);
            }
        },

        getCountries() {
            CountryApi.list()
                .then(({ data }) => {
                    this.countries = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getGovernorates() {
            let data = { country: this.User.country_id };
            GovernorateApi.list(data)
                .then(({ data }) => {
                    this.governorates = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getCities() {

            let data = { governorate: this.User.governorate_id };
            CityApi.list(data)
                .then(({ data }) => {
                    this.cities = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getUser() {
            if (this.$route.params.id) {
                usersApi
                    .get(this.$route.params.id, null, null)
                    .then(({ data }) => {
                        this.User = data.data;
                        this.User.file.filePreview = data.data.file_url;
                        console.log(this.User);
                    })
                    .catch((errors) => {
                        console.log(errors);
                    });
            }
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
            usersApi
                .upload(formData)
                .then(({ data }) => {
                    this.User.file_id = data.id;
                    this.User.file_type = data.type;
                    console.log(data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },

    computed: {
        mappedIdentityProofOptions() {
            return this.identityProofOptions.map((option) => {
                // console.log(option)
                return {
                    ...option,
                    check: option.name === this.User.identity_proof,
                };
            });
        },
    },
    mounted() {
        this.getCountries();
        this.$route.params.id ? this.getGovernorates() : [];
        this.$route.params.id ? this.getCities() : [];
        this.$route.params.id ? this.getUser() : [];
        this.checkActiveStep();
    },
};
</script>
<style lang="scss">
.form-wizard-vue {
    .fw-step-checked {
        border: 1px solid #b59357;
        background: #b59357 !important;
        color: #fff !important;
    }

    .fw-step-active {
        background: #b59357 !important;
    }

    .fw-step-title {
        margin-top: 10px;
        color: var(--sideBarColor);
    }

    .fw-body-list {
        .fw-list-progress-active {
            background: #b59357 !important;
        }

        li {
            .fw-list-wrapper-icon {
                color: var(--sideBarColor);
                width: 38px;
                height: 38px;

                i {
                    font-style: normal !important;
                }
            }
        }
    }
}
</style>
