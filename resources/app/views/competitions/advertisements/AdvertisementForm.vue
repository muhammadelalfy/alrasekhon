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
            label="pages.sample_name"
            type="text"
            :model="this.advertisement"
            name="name"
            :errors="formErrors"
            @clearErrors="clearInput"
        />
        <div class="mb-3">
            <label class="form-label"> {{ $t("pages.medial_type") }}</label>
            <div class="control-bg d-md-flex align-items-center flex-wrap">
                <form-radio-group
                    :options="mediaTypeOptions"
                    :model="this.advertisement"
                    name="media_type"
                >
                </form-radio-group>
            </div>
            <ul>
                <li v-if="formErrors.hasOwnProperty('media_type')"  class="invalid-feedback">{{formErrors.media_type[0]}}</li>
            </ul>
        </div>
        <div v-if="this.advertisement.media_type === 'link'">
            <form-input
                id="national-iD"
                label="pages.video_link"
                type="text"
                :model="this.advertisement"
                name="url"
                :errors="formErrors"
                @clearErrors="clearInput"
            />
        </div>
        <div v-if="this.advertisement.media_type === 'video' || this.advertisement.media_type === 'image'">
            <div class="mb-3">
                <label class="form-label">{{
                    $t("pages.ready_sample")
                }}</label>
                <el-upload
                    name="sample_attach"
                    accept="jpg,jpeg,png,mp4"
                    @file-uploaded="getUploadedData($event)"
                    ref="uploadRefContract"
                    class="upload-demo"
                    :http-request="handleUpload"
                    :auto-upload="true"
                    :src="this.file.filePreview ? this.file.filePreview : this.advertisement.url"
                    :limit="1"
                    :size="50"
                >
                    <ul>
                        <li v-if="formErrors.hasOwnProperty('url')"  class="invalid-feedback">{{formErrors.url[0]}}</li>
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
        </div>
        <div class="mb-3">
            <label class="form-label">
                {{ $t("pages.desc") }}
            </label>
            <FormQuillEditor :model="this.advertisement" name="description" />
            <ul>
                <li v-if="formErrors.hasOwnProperty('description')"  class="invalid-feedback">{{formErrors.description[0]}}</li>
            </ul>
        </div>
    </form-modal>
</template>

<script>
import AdvertisementsApi from "@api/advertisements.api";
import { useI18n } from "vue-i18n";
import {useToast} from "vue-toastification";
export default {
    name: "AdvertisementForm",
    data() {
        const { t } = useI18n();
        return {
            mediaTypeOptions: [
                {
                    name: "link",
                    label: t("pages.link"),
                },
                {
                    name: "video",
                    label: t("pages.video"),
                },
                {
                    name: "image",
                    label: t("pages.img"),
                },
            ],
            file:{
                filePreview: '',
                fileName: '',
            },
            filtersCountries: {
                page: 1,
            },
        };
    },

    props: {
        id: {
            type: String,
            default: "addSampleModal",
        },
        ariaLabelledby: String,
        dataBsBackdrop: String,
        dataBskeyboard: String,
        modalDialogScrollable: Boolean,
        modalDialogCentered: Boolean,
        modalLg: Boolean,
        modalFullscreen: Boolean,
        advertisement: Object,
        title: {
            type: String,
            default: "pages.add_sample",
        },
    },
    methods: {
        clearForm() {
            this.clearErrors();
        },
        update() {
            this.submitFormDisabled = true;
            AdvertisementsApi.update(this.advertisement)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    $("#addSampleModal").modal("hide");
                    this.afterModalUpdateActions(
                        this.advertisement,
                        this.$parent.advertisements,
                        data.data,
                        this.advertisement.id
                    );
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
        add() {
            this.submitFormDisabled = true;
            AdvertisementsApi.store(this.advertisement)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    $("#addSampleModal").modal("hide");
                    this.afterModalAddActions(
                        this.advertisement,
                        this.$parent.advertisements,
                        data.data
                    );
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
        submit() {
            if (this.advertisement.id === '') {
                this.add();
            } else {
                this.update();
            }
        },
        async handleUpload(event) {
            let formData = new FormData();
            formData.append('type', 'advertise_sample_attach');
            formData.append('advertise_sample_attach', event.file);

            AdvertisementsApi.upload(formData)
                .then(({ data }) => {
                    this.advertisement.ready_sample_id = data.id;
                    this.advertisement.url = data.url;
                    this.advertisement.advertise_sample_attach = data.url;
                    console.log(data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getUploadedData($event) {
            this.filePreview = $event.previewBase64;
            this.file.fileName = $event.name;
        },
    },
};
</script>

<style scoped></style>
