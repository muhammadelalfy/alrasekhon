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
        <form-input
            label="pages.contract_sample_name_ar"
            type="text"
            :model="this.sample.name"
            name="ar"
            :errors="formErrors"
            error_key="name.ar"
            @clearErrors="clearInput('name.ar')"
        />
        <form-input
            label="pages.contract_sample_name_en"
            type="text"
            :model="this.sample.name"
            name="en"
            :errors="formErrors"
            error_key="name.en"
            @clearErrors="clearInput('name.en')"
        />

        <form-select
            title="pages.category"
            label="name"
            name="contract_category"
            collapse-tags
            collapse-tags-tooltip
            @change="clearInput('contract_category')"
            :model="this.sample"
            :myOptions="categoryOptions"
            :errors="formErrors"
        />

        <div class="mb-3">
            <label class="form-label">{{
                $t("pages.attached_contract")
            }}</label>
            <el-upload
                name="attachment"
                accept="doc,docx,pdf"
                @file-uploaded="getUploadedData($event)"
                ref="uploadRef"
                class="upload-demo"
                :http-request="handleUpload"
                :auto-upload="true"
                :before-remove="beforeRemoveFunc"
                :limit="1"
                :size="5"
                @click="clearInput('attachment'); clearInput('fileId')"
            >
                <ul>
                    <li v-if="formErrors.attachment" class="invalid-feedback">{{formErrors.attachment[0]}}</li>
                </ul>
                <template #trigger>
                    <div
                        class="align-items-center control-bg d-flex flex-wrap justify-content-end w-100"
                    >
                        <font-awesome-icon icon="fa-solid fa-upload" />
                    </div>
                </template>
            </el-upload>
        </div>
    </form-modal>
</template>

<script>
import { useToast } from "vue-toastification";
import {useI18n} from "vue-i18n";
import {ref} from "vue";
import SamplesApi from "@api/samples.api";
import {ElMessage} from "element-plus";

export default {
    name: "SampleForm",
    data(){
        const { t } = useI18n();
      return {
          categoryOptions: [
              {
                  value: "arbitrator",
                  label: t('pages.contract_arbitrator'),
              },
              {
                  value: "sponsor",
                  label: t('pages.contract_sponsor'),
              },
              {
                  value: "service_provider",
                  label: t('pages.contract_service_provider'),
              }
          ],
          file:{
              filePreview: '',
              fileName: '',
          },
      }
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
        sample: {
            type: Object,
        },
        title: {
            type: String,
            default: "pages.add_contract",
        },
        data: {
            type: Array,
            default: () => []
        },
    },
    methods: {
        clearForm()
        {
            this.clearErrors();
            this.resetForm(this.sample)
        },

        update() {
            this.submitFormDisabled = true;
            SamplesApi.update(this.sample)
                .then(({ data }) => {
                    this.sample.attachment = ''
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    $("#MainAddModal").modal("hide");

                    this.afterModalUpdateActions(
                        this.sample,
                        this.$parent.samples,
                        data.data,
                        this.sample.id
                    );

                    this.clearFiles()
                })
                .catch((error) => {
                    this.formErrors = error.response.data.errors;
                });
        },
        add() {
            this.submitFormDisabled = true;
            SamplesApi.store(this.sample)
                .then(({ data }) => {
                    this.sample.attachment = ''
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    $("#MainAddModal").modal("hide");
                    this.afterModalAddActions(
                        this.sample,
                        this.$parent.samples,
                        data.data
                    );
                    this.clearFiles()
                })
                .catch((error) => {
                    this.formErrors = error.response.data.errors;
                });
        },
        submit() {
            if (this.sample.id === '') {
                this.add();
            } else {
                this.update();
            }
        },
        getUploadedData($event) {
            this.file.filePreview = $event.previewBase64;
            this.file.fileName = $event.name;
        },
        async handleUpload(event) {
            let formData = new FormData();
            formData.append('type', 'contract_sample');
            formData.append('attachment', event.file);

            if (this.sample.id === '') {
                SamplesApi.store(formData)
                    .then(({data}) => {
                        this.sample.fileId = data.id;
                        this.sample.attachment = 'attached';
                    })
                    .catch(error => {
                        this.formErrors = error.response.data.errors;
                    })
            } else {
                SamplesApi.update(formData)
                    .then(({data}) => {
                        this.sample.fileId = data.id;
                        this.sample.attachment = 'attached';})
                    .catch(error => {
                        this.formErrors = error.response.data.errors;
                    })
            }
        },
        // It's for clear file upload preview after add successfully
        clearFiles() {
            this.$refs.uploadRef.clearFiles();
        },
    },
}
</script>

<style scoped></style>
