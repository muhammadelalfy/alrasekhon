<template>
    <form-modal
        :id="id"
        :aria-labelledby="ariaLabelledby"
        :modal-dialog-centered="modalDialogCentered"
        :modal-lg="modalLg"
        @clearForm="clearForm"
        @submit="addWorkExperience"
        :buttonDisabled="submitFormDisabled"
        :title="title"
    >

        <form-input
            label="pages.company_name"
            type="text"
            :model="workExperienceData"
            name="company_name"
            :errors="formErrors"
            @clearErrors="clearInput('company_name')"
        />
        <ul class="text-danger" v-if="this.errorMessage.hasOwnProperty('company_name')">
            <li>{{this.errorMessage.company_name[0]}}</li>
        </ul>
        <FormCheckbox
            :label="$t('pages.still_working')"
            input-id="stillWorking"
            :model="workExperienceData"
            name="still_working"
            :errors="formErrors"
            @clearErrors="clearInput('still_working')"
        />
        <ul class="text-danger" v-if="this.errorMessage.hasOwnProperty('still_working')">
            <li>{{this.errorMessage.still_working[0]}}</li>
        </ul>

        <div v-if="workExperienceData.still_working">
            <form-select
                title="pages.workplace"
                label="name"
                name="work_place_type"
                :model="workExperienceData"
                :myOptions="workplaceOptions"
                :errors="formErrors"
                @clearErrors="clearInput('work_place_type')"
            />
            <ul class="text-danger" v-if="this.errorMessage.hasOwnProperty('work_place_type')">
                <li>{{this.errorMessage.work_place_type[0]}}</li>
            </ul>
            <div class="mb-3">
                <label class="form-label">{{
                    $t("pages.proof_attachments")
                }}</label>
                <FormImageUploader
                    name="work_place_proof_attachment"
                    accept="png,jpg,jpeg,pdf"
                    @file-uploaded="getUploadedData($event)"
                    :src="this.file.filePreview ? this.file.filePreview : this.workExperienceData.attach_url"
                    :size="5"
                    :limi="1"
                    width="w-100"
                />

                <ul class="text-danger" v-if="this.errorMessage.hasOwnProperty('work_place_proof_attach_id')">
                    <li>{{this.errorMessage.work_place_proof_attach_id[0]}}</li>
                </ul>
            </div>
        </div>
    </form-modal>
</template>

<script>
import {reactive} from "vue";
import {useToast} from "vue-toastification";
import ArbitratorsApi from "@api/arbitrators.api";

export default {
    emits:['afterAddWorkExperience'],
    name: "WorkExperienceForm",
    data() {
        return {
            file: {
                filePreview: "",
                fileName: "",
            },
            errorMessage: [],
        }
    },
    props: {
        arbitrator: Object,
        workExperienceData: Object,
        afterAddWorkExperience: Function,
        submitFormDisabled: {
            type:Boolean,
            default: false
        },
        formErrors: {
            type: [Object,Array]
        },
        clearInput: {
            type: [Object,Array]
        },
        id: {
            type: String,
            default: "workExpModal",
        },
        ariaLabelledby: String,
        dataBsBackdrop: String,
        dataBskeyboard: String,
        modalDialogScrollable: Boolean,
        modalDialogCentered: Boolean,
        modalLg: Boolean,
        modalFullscreen: Boolean,
        title: {
            type: String,
            default: "pages.add_Work_experience",
        },
        isAdd: Boolean
    },
    methods: {
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
            formData.append('work_place_proof_attachment', imageFile);
            formData.append("type", 'work_place_proof_attachment');
            formData.append("old_attach_id", this.workExperienceData.old_attach_id);
            ArbitratorsApi.upload(formData)
                .then(({ data }) => {
                    this.arbitrator.work_place_proof_attach_id = data.id;
                    this.arbitrator.work_place_proof_attach_url = data.url;
                    this.workExperienceData.work_place_proof_attach_id = data.id;
                    this.workExperienceData.attach_url = data.url;
                    this.workExperienceData.attach_updated = true;
                    console.log(data);
                })
                .catch((error) => {
                    console.log(error);
                });

        },

        addWorkExperience() {
            ArbitratorsApi.addWorkExperience(this.workExperienceData)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    this.$emit('afterAddWorkExperience', data.data)
                    this.arbitrator.company_name = this.workExperienceData.company_name;
                    this.workExperienceData.still_working = 0;
                    this.workExperienceData.work_place_type = '';
                    this.workExperienceData.work_place_proof_attach_id = '';
                    this.workExperienceData.attach_url = '';
                    this.workExperienceData.work_experiences_index = '';
                    this.workExperienceData.attach_updated = false;
                    this.file.filePreview = '';

                    $("#workExpModal").modal("hide");
                })
                .catch((error) => {
                    this.errorMessage = error.response.data.errors
                    this.formErrors = error.response.data.errors;
                });
        },


        clearForm() {
            this.clearErrors();
        },
    },
    setup() {
        const workplaceOptions = [
            {
                value: "eligibility",
                label: "مؤسسات اهلية",
            },
            {
                value: "government",
                label: "مؤسسات حكومية",
            },
            {
                value: "memorization",
                label: "مكتب تحفيظ",
            },
        ];

        const file = reactive({
            attachFilePreview: "",
            attachFileName: "",
        });

        function getUploadedAttach($event) {
            file.attachFilePreview = $event.previewBase64;
            file.attachFileName = $event.name;
        }
        return {
            file,
            workplaceOptions,
            getUploadedAttach,
        };
    },
};
</script>

<style scoped></style>
