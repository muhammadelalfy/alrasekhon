<template>
    <div>
        <div class="row align-items-end">
            <div class="col-md-6">
                <form-input
                    id="qualification"
                    label="pages.educational_qualification"
                    type="text"
                    :model="this.arbitrator"
                    name="qualification"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <div class="col-md-6">
                <form-input
                    id="basic-job"
                    label="pages.basic_job"
                    type="text"
                    :model="this.arbitrator"
                    name="job"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">{{
                        $t("pages.quran_memorization")
                    }}</label>
                    <div
                        class="control-bg d-md-flex align-items-center flex-wrap"
                    >
                        <form-radio-group
                            :options="quranMemorizationOptions"
                            :model="this.arbitrator"
                            name="is_teacher"
                        >
                        </form-radio-group>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div
                    v-if="this.arbitrator.is_teacher"
                    class="d-flex align-items-center mb-3"
                >
                    <label class="form-label fw-bold mb-0">
                        {{ $t("pages.Work_experience") }}
                    </label>

                    <button
                        type="button"
                        class="btn btn-icon btn-light-babyblue text-white p-0 ms-2"
                        data-bs-toggle="modal"
                        data-bs-target="#workExpModal"
                        @click="
                            isAdd = true;
                            this.workExperienceData.work_experiences_index = '';
                        "
                    >
                        <font-awesome-icon icon="fa-solid fa-circle-plus" />
                    </button>
                </div>
                <ul
                    v-if="
                        formErrors.company_name || formErrors.work_experiences
                    "
                >
                    <li class="text-danger">
                        {{ $t("pages.work_experiences_required") }}
                    </li>
                </ul>
                <div
                    v-for="(workExperience, index) in this.workExperiences
                        .length
                        ? this.workExperiences
                        : this.arbitrator.work_experiences"
                    :key="index"
                    class="control-bg row align-items-center py-2 mb-3"
                >
                    <div class="col-md-3 mb-2 mb-md-0">
                        <b>{{ workExperience.company_name }}</b>
                    </div>
                    <div class="col-md-3 mb-2 mb-md-0">
                        {{ workExperience.work_place_type }}
                    </div>
                    <div class="col-md-3 mb-2 mb-md-0">
                        {{
                            workExperience.still_working
                                ? "Still working"
                                : "Not working"
                        }}
                    </div>
                    <div class="col-md-3 mb-2 mb-md-0">
                        <div class="d-inline-flex justify-content-md-end w-100">
                            <el-tooltip
                                class="box-item"
                                effect="dark"
                                :content="$t('forms.edit')"
                                placement="top"
                            >
                                <button
                                    type="button"
                                    class="btn btn-lightGray text-grayClr btn-icon rounded-circle fs-6"
                                    @click="groupForm(workExperience, index)"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-pen-to-square"
                                    />
                                </button>
                            </el-tooltip>
                            <el-tooltip
                                class="box-item"
                                effect="dark"
                                :content="$t('forms.delete')"
                                placement="top"
                            >
                                <button
                                    @click="
                                        deleteWorkExperience(
                                            workExperience.arbitrator_id,
                                            index
                                        )
                                    "
                                    type="button"
                                    class="btn btn-light-danger text-white btn-icon rounded-circle fs-6 ms-3"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-trash"
                                    />
                                </button>
                            </el-tooltip>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <hr class="my-3" />

                <div class="row align-items-end">
                    <div class="col-12 col-md-10 col-lg-11">
                        <div
                            class="alert alert-secondary bg-white text-danger"
                            v-if="formErrors.practical_experiences"
                        >
                            {{ formErrors.practical_experiences[0] }}
                        </div>
                        <!--                        <form-input-->
                        <!--                            label="pages.practical_experiences"-->
                        <!--                            tooltip="pages.skills_tooltip"-->
                        <!--                            type="text"-->
                        <!--                            :model="this.arbitrator.practical_experiences"-->
                        <!--                            name="0"-->
                        <!--                            disabled-->
                        <!--                            :errors="formErrors"-->
                        <!--                            @clearErrors="clearInput('practical_experiences')"-->
                        <!--                            :label-icon="true"-->
                        <!--                        />-->

                        <div class="d-flex align-items-center flex-wrap">
                            <h6 class="fw-bold mb-3 me-2">
                                {{ $t("pages.practical_experiences") }}
                                <el-tooltip
                                    class="box-item"
                                    effect="dark"
                                    :content="$t('pages.skills_tooltip')"
                                    placement="top"
                                >
                                    <span
                                        class="align-items-center bg-grayClr d-inline-flex info-icon justify-content-center ms-2 text-white"
                                    >
                                        <font-awesome-icon
                                            icon="fa-solid fa-info"
                                        />
                                    </span>
                                </el-tooltip>
                            </h6>
                            <button
                                @click="addRow"
                                type="button"
                                class="btn btn-icon btn-light-babyblue text-white mb-3 p-0"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                :title="$t('pages.add')"
                            >
                                <font-awesome-icon
                                    icon="fa-solid fa-circle-plus"
                                />
                            </button>
                        </div>
                    </div>
                    <!-- <div
                        class="col-3 col-md-2 col-lg-1 d-flex justify-content-end"
                    >
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
                <!--                v-for="(row, index) in this.arbitrator.practical_experiences"-->
                <div
                    class="row align-items-end"
                    v-for="(row, index) in this.arbitrator
                        .practical_experiences"
                    :key="index"
                >
                    <div class="col-12 col-md-10 col-lg-11">
                        <form-input
                            label="pages.practical_experiences"
                            :showLabel="true"
                            type="text"
                            :label-icon="false"
                            :model="this.arbitrator.practical_experiences"
                            :name="index"
                            :errors="formErrors"
                            @clearErrors="clearInput('practical_experiences')"
                        />
                    </div>
                    <!-- <div class="col-9 col-md-5">
                        <form-input
                            label="pages.arbitrator_level"
                            :showLabel="false"
                            type="text"
                            :model="this.experiences.rows[index]"
                            name="arbitratorLevel"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                        />
                    </div> -->

                    <div
                        class="col-3 col-md-2 col-lg-1 d-flex justify-content-end"
                    >
                        <button
                            @click.stop="removeElement(index)"
                            type="button"
                            class="btn btn-icon btn-light-danger text-white mb-3 p-0"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            :title="$t('forms.delete')"
                        >
                            <font-awesome-icon
                                icon="fa-solid fa-circle-minus"
                            />
                        </button>
                    </div>
                    <ul v-if="formErrors.practical_experience" class="mb-3">
                        <li class="invalid-feedback">
                            {{ formErrors.practical_experience[0] }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-cenetr pt-4 justify-content-end">
            <button
                type="button"
                @click.prevent="onNextTab(2, 1)"
                class="btn btn-babyblue text-white fw-bold"
            >
                {{ $t("pagination.next") }}
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

    <!-- Modal -->
    <WorkExperienceForm
        :arbitrator="arbitrator"
        :workExperienceData="workExperienceData"
        :showButton="true"
        :isAdd="isAdd"
        :title="
            isAdd
                ? $t('pages.add_Work_experience')
                : $t('pages.edit_Work_experience')
        "
        id="workExpModal"
        aria-labelledby="workExpModalLabel"
        :modal-dialog-centered="true"
        :modal-lg="true"
        :formErrors="formErrors"
        :clearInput="clearInput"
        @afterAddWorkExperience="afterAddWorkExperience"
    />
</template>

<script>
import { ref } from "vue";
import { useI18n } from "vue-i18n";
import WorkExperienceForm from "@/views/arbitrators/WorkExperienceForm.vue";
import ArbitratorsApi from "@api/arbitrators.api";
import { useToast } from "vue-toastification";

export default {
    components: {
        WorkExperienceForm,
    },

    name: "StepTwo",
    data() {
        const { t } = useI18n();
        return {
            isAdd: ref(true),
            experiences: {
                rows: [],
            },
            workExperiences: {},
            workExperienceData: {
                arbitrator_id: this.arbitrator.id,
                company_name: "",
                still_working: false,
                work_place_type: "",
                attach_url: "",
                work_place_proof_attach_id: "",
                old_attach_id: "",
                attach_updated: false,
                work_experiences_index: "",
            },
            quranMemorizationOptions: [
                {
                    name: this.$route.params.id ? true : 1,
                    label: t("global.yes"),
                },
                {
                    name: this.$route.params.id ? false : 0,
                    label: t("global.no"),
                },
            ],
        };
    },
    props: ["arbitrator", "onNextTab", "onBackTab", "formErrors", "clearInput"],
    methods: {
        addRow: function () {
            // this.experiences.rows.push({
            //     practical_experiences: "",
            // });
            this.arbitrator.practical_experiences.push("");
        },
        removeElement: function (index) {
            // this.experiences.rows.splice(index, 1);
            this.arbitrator.practical_experiences.splice(index, 1);
        },

        groupForm(workExperience = {}, index) {
            // this.resetForm(this.workExperience)
            this.workExperienceData = _.cloneDeep(workExperience);
            this.workExperienceData.work_experiences_index = index;
            this.workExperienceData.old_attach_id =
                workExperience.work_place_proof_attach_id;
            this.isAdd = workExperience.still_working;
            $("#workExpModal").modal("show");
        },

        deleteWorkExperience(arbitrator, index) {
            let requestData = { arbitrator: arbitrator, index: index };
            ArbitratorsApi.deleteWorkExperience(requestData).then((data) => {
                this.workExperiences = data.data.data.work_experiences;
                this.arbitrator.work_experiences =
                    data.data.data.work_experiences;
                useToast().success(data.data.message);
            });
        },

        // resetForm(){
        //     this.isAdd = true
        //     this.resetForm(this.workExperience)
        // },
        // getWorkExperiences(index){
        //     this.workExperience = this.workExperiences[index]
        //     console.log(this.workExperience)
        //     console.log(this.workExperience.hasOwnProperty('arbitrator_id'))
        //     $("#workExpModal").modal("show")
        //     // let data = {index: index}
        //     // ArbitratorsApi.getWorkExperiences(this.arbitrator, data)
        //     //     .then(({ data }) => {
        //     //         console.log(data)
        //     //         $("#workExpModal").modal("show");
        //     //     })
        // },

        afterAddWorkExperience(data) {
            this.workExperiences = data.work_experiences;
            this.arbitrator.work_experiences = data.work_experiences;

            console.log(this.workExperiences);
            console.log(this.arbitrator.work_experiences);
        },
    },
};
</script>

<style scoped></style>
