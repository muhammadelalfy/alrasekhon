<template>
    <!-- <button
        @click="delRow(row, index)"
        id="bDel"
        type="button"
        :class="`btn btn-${size} btn-danger`"
        data-bs-toggle="tooltip"
        data-bs-placement="top"
        :title="$t('forms.delete')"
    >
        <span v-if="icon" class="fa fa-trash"> </span>
        <span v-if="btnText"> Delete</span>
    </button> -->
    <button
        v-if="icon"
        @click="delRow(row, index)"
        id="bDel"
        type="button"
        class="btn btn-light-danger text-white"
        data-bs-toggle="tooltip"
        data-bs-placement="top"
        :title="$t('forms.delete')"
    >
        <font-awesome-icon icon="fa-solid fa-trash" />
    </button>
</template>

<script>
export default {
    name: "delete-button",
    props: {
        icon: {
            type: Boolean,
            default: true,
        },
        btnText: {
            type: Boolean,
            default: false,
        },
        size: {
            type: String,
            default: "sm",
        },
    },
    methods: {
        delRow(row, index) {
            this.$swal
                .fire({
                    customClass: {
                        confirmButton: "btn btn-success m-2",
                        cancelButton: "btn btn-danger",
                    },
                    buttonsStyling: false,
                    title: this.$t("messages.Are_you_sure"),
                    text: this.$t("messages.Do_you_want_to_delete_this_item"),
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: this.$t("messages.Yes_delete_it"),
                    cancelButtonText: this.$t("messages.No_cancel"),
                    reverseButtons: true,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        this.$emit("del-model");
                    }
                });
        },
    },
};
</script>
