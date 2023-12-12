<template>
    <Modal
        :id="id"
        :aria-labelledby="ariaLabelledby"
        :modal-dialog-centered="modalDialogCentered"
        :modal-lg="modalLg"
        @clearForm="this.$emit('clearForm')"
        @openModal="this.$emit('openModal')"
        :title="title"
    >
        <template v-slot:title-button v-if="titleButton">
            <button
                :title="$t('pages.save')"
                :disabled="buttonDisabled"
                type="button"
                class="btn text-success fs-5 ms-auto"
                @click.prevent="save"
            >
                <span class="fa fa-check"></span>
            </button>
        </template>
        <template v-slot:body>
            <form>
                <slot></slot>
                <div class="d-flex align-items-cenetr pt-4 justify-content-end">
                    <button
                        type="button"
                        :disabled="buttonDisabled"
                        @click.prevent="save"
                        class="btn btn-babyblue fw-bold text-white"
                    >
                        {{ $t("forms.save") }}
                    </button>
                    <button
                        type="button"
                        class="btn btn-light fw-bold ms-2"
                        data-bs-dismiss="modal"
                        @click="close"
                    >
                        {{ $t("forms.cancel") }}
                    </button>
                </div>
            </form>
        </template>
    </Modal>
</template>

<script>
export default {
    name: "FormModal",
    emits: ["submit", "clearForm", "openModal"],
    props: {
        id: String,
        ariaLabelledby: String,
        dataBsBackdrop: String,
        dataBskeyboard: String,
        modalDialogScrollable: Boolean,
        modalDialogCentered: Boolean,
        modalLg: Boolean,
        modalFullscreen: Boolean,
        title: String,
        buttonDisabled: {
            type: Boolean,
            default: true,
        },
        titleButton: {
            type: Boolean,
            default: false,
        },
    },
    methods: {
        save() {
            this.$emit("submit");
        },
        close() {
            //in case of form
            this.$emit("clearForm");
            // this.$emit("resetEditor");
        },
    },
};
</script>

<style scoped></style>
