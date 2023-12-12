<template>
    <div
        :id="modalId"
        class="modal fade"
        tabindex="-1"
        :aria-labelledby="ariaLabelledby"
        :data-bs-backdrop="dataBsBackdrop"
        :data-bs-keyboard="dataBskeyboard"
        aria-hidden="true"
    >
        <div
            class="modal-dialog"
            :class="{
                'modal-dialog-scrollable': modalDialogScrollable,
                'modal-dialog-centered': modalDialogCentered,
                'modal-lg': modalLg,
                'modal-fullscreen': modalFullscreen,
            }"
        >
            <div class="modal-content">
                <div class="modal-header border-0 py-2">
                    <h5 :id="ariaLabelledby" class="modal-title">
                        <slot name="title">
                            {{ title }}
                        </slot>
                    </h5>
                    <button
                        type="button"
                        class="close-btn"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                         @click="close"
                    >
                        <font-awesome-icon icon="fa-solid fa-circle-xmark" />
                    </button>
                </div>
                <div class="modal-body">
                    <slot name="body"></slot>
                </div>
                <div v-if="$slots.footer" class="modal-footer">
                    <slot name="footer"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Modal",
    emits: ["clearForm", "openModal"],
    props: {
        modalId: String,
        ariaLabelledby: String,
        dataBsBackdrop: String,
        dataBskeyboard: String,
        modalDialogScrollable: Boolean,
        modalDialogCentered: Boolean,
        modalLg: Boolean,
        modalFullscreen: Boolean,
        title: String,
    },
    methods: {
        close() {
            //in case of form
            this.$emit("clearForm");
        },
    },
};
</script>
