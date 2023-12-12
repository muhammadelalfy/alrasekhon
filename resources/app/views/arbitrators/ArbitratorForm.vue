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
                title: $t('pages.arbitrator_main_info'),
            },
            {
                title: $t('pages.scientific_practical'),
            },
            {
                title: $t('pages.readings_vacations'),
            },
            {
                title: $t('pages.address_info'),
            },
        ]"
        @change="onChangeCurrentTab"
    >
<!--        :before-change="disableTabSwitching"-->
        <form>
            <div v-if="currentTabIndex === 0">
                <StepOne
                    :arbitrator="arbitrator"
                    :onNextTab="onNextTab"
                    :onBackTab="onBackTab"
                    :formErrors="formErrors"
                    :clearInput="clearInput"
                />
            </div>
            <div v-if="currentTabIndex === 1">
                <StepTwo
                    :arbitrator="arbitrator"
                    :onNextTab="onNextTab"
                    :onBackTab="onBackTab"
                    :formErrors="formErrors"
                    :clearInput="clearInput"
                />
            </div>
            <div v-if="currentTabIndex === 2">
                <StepThree
                    :arbitrator="arbitrator"
                    :onNextTab="onNextTab"
                    :onBackTab="onBackTab"
                    :formErrors="formErrors"
                    :clearInput="clearInput"
                />
            </div>
            <div v-if="currentTabIndex === 3">
                <StepFour
                    :arbitrator="arbitrator"
                    :onNextTab="onNextTab"
                    :onBackTab="onBackTab"
                    :wizardCompleted="wizardCompleted"
                    :formErrors="formErrors"
                    :clearInput="clearInput"
                />
            </div>
        </form>
    </Wizard>

    <!-- Modal -->
<!--    <WorkExperienceForm-->
<!--        :arbitrator="arbitrator"-->
<!--        :showButton="true"-->
<!--        :title="isAdd ? $t('pages.add_Work_experience') : $t('pages.edit_Work_experience')"-->
<!--        id="workExpModal"-->
<!--        aria-labelledby="workExpModalLabel"-->
<!--        :modal-dialog-centered="true"-->
<!--        :modal-lg="true"-->
<!--        :formErrors="formErrors"-->
<!--        :clearInput="clearInput"-->
<!--    />-->
</template>

<script>
import "form-wizard-vue3/dist/form-wizard-vue3.css";
import Wizard from "form-wizard-vue3";
import StepOne from "@views/arbitrators/steps/StepOne.vue";
import StepTwo from "@views/arbitrators/steps/StepTwo.vue";
import StepThree from "@views/arbitrators/steps/StepThree.vue";
import StepFour from "@views/arbitrators/steps/StepFour.vue";
import { ref } from "vue";
import ArbitratorsApi from "@api/arbitrators.api";
import { useToast } from "vue-toastification";
import GovernorateApi from "@api/governorate.api";
import CityApi from "@api/city.api";

export default {
    components: {
        Wizard,
        StepOne,
        StepTwo,
        StepThree,
        StepFour,
    },

    setup() {
        const disableTabSwitching = (event) => {
            // prevent tab switching when user taps on the tab
            if (this.currentTabIndex === 1){
                return false;
            }
        }
        return {
            disableTabSwitching,
        };
    },
    data() {

        return {
            currentTabIndex: 0,
            is_last_step: false,
            arbitrator: {
                id: "",
                first_name: "",
                second_name: "",
                last_name: "",
                birth_date: "",
                identity_proof: "national_id",
                national_id: "",
                passport: "",
                gender: "",
                nationality: "",
                email: "",
                country_code: "",
                phone: "",
                password: "",
                password_confirmation: "",
                status: true,
                qualification: "",
                job: "",
                is_teacher: ref(0),
                work_experiences: [],
                practical_experiences: [""],
                company_name: "",
                still_working: false,
                work_place_type: "",
                arbitrator_level_ids: "",
                method_id: '',
                method_name: '',
                readings: [],
                methods_readings_ids: [],
                readings_names: [],
                append_method_readings_names: [],
                authorizations: [],
                vocation_bonds_attaches: [],
                vocation_bonds_attach_urls: [],
                country_id: "",
                governorate_id: "",
                city_id: "",
                main_address: "",
                additional_address: "",
                file_type: [],
                profile_photo_id: '',
                contract_attachment_id: '',
                work_place_proof_attach_id: '',
                work_place_proof_attach_url: '',
                step_no: 1,
            },
        };
    },
    methods: {
        onChangeCurrentTab(index, oldIndex) {
            this.currentTabIndex = index;
        },
        onNextTab(index, oldIndex) {
            // this.currentTabIndex = index;
            // // this.arbitrator.step_no = (index+1)
            // // this.arbitrator.id = data.data.id
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

            this.createOrUpdate(this.arbitrator, index);
        },
        onBackTab(index) {
            this.currentTabIndex = index;
            this.is_last_step = false;
            this.arbitrator.step_no = (this.arbitrator.step_no-1);

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
            this.createOrUpdate(this.arbitrator, 2);

        },
        createOrUpdate(model, index){

            // First step
            if (index === 1){
                // when arbitrator create in first time
                if (this.arbitrator.id === ''){
                    ArbitratorsApi.store(this.arbitrator)
                        .then(({ data }) => {
                            useToast().success(this.$t("messages.success"));
                            this.currentTabIndex = index;
                            this.arbitrator.step_no = (index+1)
                            this.arbitrator.id = data.data.id
                            // this.arbitrator = data.data
                            setTimeout(function () {
                                if (
                                    $(".fw-list-progress").hasClass("fw-list-progress-active")
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
                            console.log(error)
                            this.formErrors = error.response.data.errors;
                        });
                }
                // when arbitrator created and user click back button to update info
                if (this.arbitrator.id !== ''){
                    ArbitratorsApi.update(this.arbitrator)
                        .then(({ data }) => {
                            useToast().success(this.$t("messages.success"));
                            // this.arbitrator = data.data
                            this.currentTabIndex = index;
                            this.arbitrator.step_no = (index+1)
                        })
                        .catch((error) => {
                            console.log(error);
                            this.formErrors = error.response.data.errors;
                        });
                }
            }
            // All remaining steps
            if (index !== 1){
                ArbitratorsApi.updateStep(this.arbitrator)
                    .then(({ data }) => {
                        useToast().success(this.$t("messages.success"));
                        if (data.data.step_no === null){
                            this.$router.push({
                                path: '/arbitrators'
                            })
                        }

                        this.currentTabIndex = index;
                        this.arbitrator.step_no = (index+1)
                        setTimeout(function () {
                            if (
                                $(".fw-list-progress").hasClass("fw-list-progress-active")
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
        },
        getArbitrator(){
            if (this.$route.params.id){
                ArbitratorsApi.get(this.$route.params.id, null, null)
                    .then(({ data }) => {
                        this.arbitrator = data.data;
                        this.currentTabIndex = this.arbitrator.step_no ? (this.arbitrator.step_no-1) : 0;
                        // this.getGovernorates();
                        // this.getCities();
                    })
                    .catch((errors) => {
                        console.log(errors);
                    });
            }

        },
        checkActiveStep() {
            if (this.$route.params.id){
                setTimeout(function () {
                    if (
                        $(".fw-list-progress").hasClass("fw-list-progress-active")
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
        getGovernorates() {
            let requestData = {
                list_all_without_pagination: true, country: this.arbitrator.country_id
            };
            GovernorateApi.list(requestData)
                .then(({ data }) => {
                    this.governorates = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getCities() {
            let requestData = {
                list_all_without_pagination: true, governorate: this.arbitrator.governorate_id,
            };
            CityApi.list(requestData)
                .then(({ data }) => {
                    this.cities = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },

    },
    mounted() {
        this.$route.params.id ? this.getArbitrator() : [];
        if (this.$route.params.id){
            this.checkActiveStep()
        }
    }
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
