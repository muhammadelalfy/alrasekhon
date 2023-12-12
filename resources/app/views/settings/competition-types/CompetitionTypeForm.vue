<template>
    <form-modal
        :id="id"
        :aria-labelledby="ariaLabelledby"
        :modal-dialog-centered="modalDialogCentered"
        :modal-lg="modalLg"
        @clearForm="clearForm"
        @resetForm="resetForm"
        @submit="submit"
        :buttonDisabled="submitFormDisabled"
        :title="title"
    >
        <form-input
            label="pages.competition_type_ar"
            type="text"
            :model="this.competitionType.name"
            name="ar"
            :errors="formErrors"
            error_key="name.ar"
            @clearErrors="clearInput('name.ar')"
        />

        <form-input
            label="pages.competition_type_en"
            type="text"
            :model="this.competitionType.name"
            name="en"
            :errors="formErrors"
            error_key="name.en"
            @clearErrors="clearInput('name.en')"
        />

        <div class="mb-3">
            <label class="form-label">{{ $t("pages.desc") }} (AR)
                <span class="ms-1 text-grayClr">( {{ $t("pages.optional") }} )</span>
            </label>

            <FormQuillEditor :model="this.competitionType.description" name="ar" ref="description_ar" @click="clearInput('description.ar')" id="ar"/>
            <form-validation-errors :errors="formErrors" name="description.ar" />

        </div>
        <div class="mb-3">
            <label class="form-label">{{ $t("pages.desc") }} (EN)
                <span class="ms-1 text-grayClr">( {{ $t("pages.optional") }} )</span>
            </label>

            <FormQuillEditor :model="this.competitionType.description" name="en" ref="description_en" @click="clearInput('description.en')" id="en"/>
            <form-validation-errors :errors="formErrors" name="description.en" />

        </div>
    </form-modal>
</template>

<script>
import {useToast} from "vue-toastification";
import CompetitionTypesApi from "@api/competition-types.api";
import {Quill} from "@vueup/vue-quill";

export default {
    name: "CompetitionTypeForm",
    data() {

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
        competitionType: {
            type: Object,
        },
        title: {
            type: String,
            default: "pages.add_type",
        },
    },
    methods: {
        clearForm() {
            this.clearErrors();
            this.resetForm(this.competitionType)
        },
        resetEditor() {
            this.$refs.formQuillEditor.resetEditor()
        },

        add() {
            this.submitFormDisabled = true;
            CompetitionTypesApi.store(this.competitionType)
                .then(({data}) => {
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    $("#MainAddModal").modal("hide");
                    this.afterModalAddActions(
                        this.competitionType,
                        this.$parent.competitionTypes,
                        data.data
                    );

                    this.clearEditorContent()
                })
                .catch((error) => {
                    this.formErrors = error.response.data.errors;
                });
        },
        update() {
            this.submitFormDisabled = true;
            CompetitionTypesApi.update(this.competitionType)
                .then(({data}) => {
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    $("#MainAddModal").modal("hide");

                    this.afterModalUpdateActions(
                        this.competitionType,
                        this.$parent.competitionTypes,
                        data.data,
                        this.competitionType.id
                    );

                    this.clearEditorContent()
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
        submit() {
            if (this.competitionType.id === undefined) {
                this.add();
            } else {
                this.update();
            }
        },

        clearEditorContent() {
            const ar_content = new Quill("#ar");
            const en_content = new Quill("#en");
            ar_content.root.innerHTML='';
            en_content.root.innerHTML='';
        },
    },
};
</script>

<style scoped></style>
