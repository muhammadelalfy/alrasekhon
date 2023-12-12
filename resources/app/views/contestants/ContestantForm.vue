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
                title: $t('pages.contestant_main_info'),
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
                    (this.contestant.step_no === 1 ||
                        this.contestant.step_no === null)
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
                                    : this.contestant.file_url
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
                            :model="this.contestant"
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
                            :model="contestant"
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
                            :model="contestant"
                            name="last_name"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-date-select
                            label="pages.dob"
                            :model="contestant"
                            name="birth_date"
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
                                    :model="contestant"
                                    name="identity_proof"
                                >
                                </form-radio-group>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-md-4"
                        v-if="contestant.identity_proof === 'national_id'"
                    >
                        <form-input
                            id="national_id"
                            label="pages.national_iD"
                            type="number"
                            :model="contestant"
                            name="national_id"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>
                    <div
                        class="col-md-4"
                        v-if="contestant.identity_proof === 'passport'"
                    >
                        <form-input
                            id="passport"
                            label="pages.passport"
                            type="text"
                            :model="contestant"
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
                            :model="contestant"
                            :myOptions="genderOptions"
                            :errors="formErrors"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-select
                            title="pages.level"
                            label="name"
                            name="contestant_level_ids"
                            multiple
                            @clearErrors="clearInput"
                            :model="contestant"
                            :myOptions="contestantLevels"
                            label-field="name_localized"
                            value-field="id"
                            :errors="formErrors"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-input
                            id="nationality"
                            label="pages.nationality"
                            type="text"
                            :model="contestant"
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
                            :model="contestant"
                            name="email"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-input
                            id="educational-qualification"
                            label="pages.educational_qualification"
                            type="text"
                            :model="contestant"
                            name="qualification"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-input
                            id="basic-job"
                            label="pages.basic_job"
                            type="text"
                            :model="contestant"
                            name="job"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-select
                            title="pages.country_code"
                            label="name"
                            name="country_code"
                            @clearErrors="clearInput"
                            :model="contestant"
                            :myOptions="countryCodeOptions"
                            label-field="label"
                            value-field="value"
                            :errors="formErrors"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-input
                            id="phone"
                            label="pages.phone"
                            type="tel"
                            :model="contestant"
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
                            :model="contestant"
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
                            :model="contestant"
                            name="password_confirmation"
                            :errors="formErrors"
                            @clearErrors="clearInput"
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
                                :model="contestant"
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
            <div v-if="currentTabIndex === 1 || this.contestant.step_no === 2">
                <div class="row">
                    <div class="col-md-4">
                        <form-select
                            title="pages.country"
                            label="name"
                            name="country_id"
                            @clearErrors="clearInput"
                            :model="contestant"
                            :myOptions="countries"
                            :errors="formErrors"
                            label-field="name_localized"
                            value-field="id"
                            @change="getGovernorates"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-select
                            title="pages.governorate"
                            label="name"
                            name="governorate_id"
                            @clearErrors="clearInput"
                            :model="contestant"
                            :myOptions="governorates"
                            :errors="formErrors"
                            label-field="name_localized"
                            value-field="id"
                            @change="getCities"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-select
                            title="pages.city"
                            label="name"
                            name="city_id"
                            @clearErrors="clearInput"
                            :model="contestant"
                            :myOptions="cities"
                            :errors="formErrors"
                            label-field="name_localized"
                            value-field="id"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-text-area
                            id="main-address"
                            label="pages.main_address"
                            :model="contestant"
                            name="main_address"
                            :rows="4"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div>
                    <div class="col-md-4">
                        <form-text-area
                            id="alternative-address"
                            label="pages.alternative_address"
                            :model="contestant"
                            name="additional_address"
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
                        class="btn btn-babyblue text-white fw-bold last_step"
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
import { ref, reactive } from "vue";
import { useI18n } from "vue-i18n";
import ContestantLevelsApi from "@api/contestant-levels.api";
import CountryApi from "@api/country.api";
import GovernorateApi from "@api/governorate.api";
import CityApi from "@api/city.api";
import ContestantsApi from "@api/contestants.api";
import { useToast } from "vue-toastification";

export default {
    components: {
        Wizard,
    },
    setup() {},
    data() {
        const { t } = useI18n();
        return {
            currentTabIndex: 0,
            is_last_step: false,
            contestant: {
                id: "",
                first_name: "",
                second_name: "",
                last_name: "",
                birth_date: "",
                identity_proof: "national_id",
                national_id: "",
                passport: "",
                gender: "",
                contestant_level_ids: "",
                nationality: "",
                email: "",
                qualification: "",
                job: "",
                phone: "",
                password: "",
                confirmPassword: "",
                status: true,
                country_id: "",
                governorate_id: "",
                city_id: "",
                main_address: "",
                additional_address: "",
                file_type: "profile_photo",
                file_id: "",
                step_no: 1,
            },
            file: {
                filePreview: "",
                fileName: "",
            },
            contestantLevels: [],
            countries: [],
            governorates: [],
            cities: [],
            identityProofOptions: [
                {
                    name: "national_id",
                    label: t("pages.national_iD"),
                    check: this.contestant
                        ? this.contestant.identity_proof === "national_id"
                        : false,
                },
                {
                    name: "passport",
                    label: t("pages.passport"),
                    check: this.contestant
                        ? this.contestant.identity_proof === "passport"
                        : false,
                },
            ],
            genderOptions: [
                {
                    value: "male",
                    label: t("pages.male"),
                    check: this.contestant
                        ? this.contestant.gender === "male"
                        : false,
                },
                {
                    value: "female",
                    label: t("pages.female"),
                    check: this.contestant
                        ? this.contestant.gender === "female"
                        : false,
                },
            ],
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
        };
    },
    methods: {
        onChangeCurrentTab(index) {
            this.currentTabIndex = index;
        },
        onNextTab(index) {
            // console.log('onNextTab Index =>>> ' + index)
            // console.log('onNextTab step_no =>>> ' + this.contestant.step_no)
            this.createOrUpdate(this.contestant, index);
        },
        onBackTab(index) {
            this.currentTabIndex = index;
            this.is_last_step = false;
            this.contestant.step_no = this.contestant.step_no - 1;
            // console.log('onBackTab Index =>>> ' + index)
            // console.log('onBackTab step_no =>>> ' + this.contestant.step_no)
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
            this.is_last_step = true;
            this.createOrUpdate(this.contestant, 2);
        },

        getContestantLevels() {
            ContestantLevelsApi.list()
                .then(({ data }) => {
                    this.contestantLevels = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getCountries() {
            let requestData = {
                list_all_without_pagination: true
            }
            CountryApi.list(requestData)
                .then(({ data }) => {
                    this.countries = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getGovernorates() {
            let data = { list_all_without_pagination: true, country: this.contestant.country_id };
            GovernorateApi.list(data)
                .then(({ data }) => {
                    this.governorates = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getCities() {
            let data = { list_all_without_pagination: true, governorate: this.contestant.governorate_id };
            CityApi.list(data)
                .then(({ data }) => {
                    this.cities = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getContestant() {
            if (this.$route.params.id) {
                ContestantsApi.get(this.$route.params.id, null, null)
                    .then(({ data }) => {
                        this.contestant = data.data;
                        this.getGovernorates()
                        this.getCities()
                        // this.contestant.file.filePreview = data.data.file_url;
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
            ContestantsApi.upload(formData)
                .then(({ data }) => {
                    this.contestant.file_id = data.id;
                    this.contestant.file_type = data.type;
                    console.log(data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        createOrUpdate(model, index) {
            if (index === 1) {
                if (this.contestant.id === "") {
                    ContestantsApi.store(this.contestant)
                        .then(({ data }) => {
                            useToast().success(this.$t("messages.success"));
                            this.currentTabIndex = index;
                            this.contestant.step_no = index + 1;
                            this.contestant.id = data.data.id;
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
                if (this.contestant.id !== "") {
                    ContestantsApi.update(this.contestant)
                        .then(({ data }) => {
                            useToast().success(this.$t("messages.success"));
                            this.currentTabIndex = index;
                            this.contestant.step_no = index + 1;
                            // setTimeout(function () {
                            //     if (
                            //         $(".fw-list-progress").hasClass("fw-list-progress-active")
                            //     ) {
                            //         $(".fw-list-progress-active")
                            //             .parent("li")
                            //             .next("li")
                            //             .find(".fw-list-wrapper-icon")
                            //             .addClass("fw-step-active");
                            //     }
                            // }, 100);
                        })
                        .catch((error) => {
                            console.log(error);
                            this.formErrors = error.response.data.errors;
                        });
                }
            }
            if (index === 2) {
                ContestantsApi.updateStep(this.contestant)
                    .then(({ data }) => {
                        useToast().success(this.$t("messages.success"));
                        this.$router.push({
                            path: "/contestants",
                        });
                    })
                    .catch((error) => {
                        console.log(error);
                        this.formErrors = error.response.data.errors;
                    });
            }
        },
        checkActiveStep() {
            if (this.currentTabIndex === 1 || this.contestant.step_no === 2) {
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
    },

    mounted() {
        this.$route.params.id ? this.getContestant() : [];
        this.getContestantLevels();
        this.getCountries();
        this.checkActiveStep();
    },

    computed: {
        mappedIdentityProofOptions() {
            return this.identityProofOptions.map((option) => {
                // console.log(option)
                return {
                    ...option,
                    check: option.name === this.contestant.identity_proof,
                };
            });
        },
        mappedGenderOptions() {
            return this.genderOptions.map((option) => {
                return {
                    ...option,
                    check: option.value === this.contestant.gender,
                };
            });
        },
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
