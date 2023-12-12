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
            label="pages.contestant_level_ar"
            type="text"
            :model="this.contestantLevel.name"
            name="ar"
            :errors="formErrors"
            error_key="name.ar"
            @clearErrors="clearInput('name.ar')"
        />

        <form-input
            label="pages.contestant_level_en"
            type="text"
            :model="this.contestantLevel.name"
            name="en"
            :errors="formErrors"
            error_key="name.en"
            @clearErrors="clearInput('name.en')"
        />

        <div class="mb-3">
            <label class="form-label">{{ $t("pages.desc") }} (AR)
                <span class="ms-1 text-grayClr">( {{ $t("pages.optional") }} )</span>
            </label>
            <FormQuillEditor :model="this.contestantLevel.description" name="ar" @click="clearInput('description.ar')"/>
            <form-validation-errors :errors="formErrors" name="description.ar" />
        </div>
        <div class="mb-3">
            <label class="form-label">{{ $t("pages.desc") }} (EN)
                <span class="ms-1 text-grayClr">( {{ $t("pages.optional") }} )</span>
            </label>
            <FormQuillEditor :model="this.contestantLevel.description" name="en" @click="clearInput('description.en')"/>
            <form-validation-errors :errors="formErrors" name="description.en" />
        </div>
    </form-modal>
</template>

<script>
import { useToast } from "vue-toastification";
import ContestantLevelsApi from "@api/contestant-levels.api";

export default {
    name: "ContestantLevelForm",
    data() {},
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
        contestantLevel: {
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
            this.resetForm(this.contestantLevel);
        },

        add() {
            this.submitFormDisabled = true;
            ContestantLevelsApi.store(this.contestantLevel)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    $("#MainAddModal").modal("hide");
                    this.afterModalAddActions(
                        this.contestantLevel,
                        this.$parent.contestantLevels,
                        data.data
                    );

                    this.clearEditorContent()
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
        update() {
            this.submitFormDisabled = true;
            ContestantLevelsApi.update(this.contestantLevel)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    $("#MainAddModal").modal("hide");

                    this.afterModalUpdateActions(
                        this.contestantLevel,
                        this.$parent.contestantLevels,
                        data.data,
                        this.contestantLevel.id
                    );

                    this.clearEditorContent()
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
        submit() {
            if (this.contestantLevel.id === undefined) {
                this.add();
            } else {
                this.update();
            }
        },

        clearEditorContent() {
            $('.ql-editor').html('')
        },
    },
};
</script>

<style scoped></style>
