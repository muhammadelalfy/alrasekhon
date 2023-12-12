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
            label="pages.stage_ar"
            type="text"
            :model="stage.name"
            name="ar"
            :errors="formErrors"
            error_key="name.ar"
            @clearErrors="clearInput('name.ar')"
        />

        <form-input
            label="pages.stage_en"
            type="text"
            :model="stage.name"
            name="en"
            :errors="formErrors"
            error_key="name.en"
            @clearErrors="clearInput('name.en')"
        />

        <div class="mb-3">
            <label class="form-label"
                >{{ $t("pages.desc") }} (AR)
                <span class="ms-1 text-grayClr"
                    >( {{ $t("pages.optional") }} )</span
                ></label
            >
            <FormQuillEditor :model="stage.description" name="ar" @click="clearInput('description.ar')"/>
            <form-validation-errors :errors="formErrors" name="description.ar" />
        </div>
        <div class="mb-3">
            <label class="form-label"
                >{{ $t("pages.desc") }} (EN)
                <span class="ms-1 text-grayClr"
                    >( {{ $t("pages.optional") }} )</span
                ></label
            >
            <FormQuillEditor :model="stage.description" name="en" @click="clearInput('description.en')"/>
            <form-validation-errors :errors="formErrors" name="description.en" />
        </div>
    </form-modal>
</template>

<script>
import { useToast } from "vue-toastification";
import StagesApi from "@api/stages.api";
export default {
    name: "StageForm",
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
        stage: {
            type: Object,
        },
        title: {
            type: String,
            default: "pages.add_stage",
        },
    },
    methods: {
        clearForm() {
            this.clearErrors();
            this.resetForm(this.stage);
        },
        update() {
            this.submitFormDisabled = true;
            StagesApi.update(this.stage)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    $("#MainAddModal").modal("hide");

                    this.afterModalUpdateActions(
                        this.stage,
                        this.$parent.stages,
                        data.data,
                        this.stage.id
                    );
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
        add() {
            this.submitFormDisabled = true;
            StagesApi.store(this.stage)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    $("#MainAddModal").modal("hide");
                    this.afterModalAddActions(
                        this.stage,
                        this.$parent.stages,
                        data.data
                    );
                })
                .catch((error) => {
                    this.formErrors = error.response.data.errors;
                });
        },
        submit() {
            if (this.stage.id === undefined) {
                this.add();
            } else {
                this.update();
            }
        },
    },
};
</script>

<style scoped></style>
