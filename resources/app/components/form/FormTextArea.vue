<template>
    <div class="mb-3">
        <label :for="id" class="form-label">{{ $t(label) }}</label>
        <textarea
            :id="id"
            :rows="rows"
            v-model="model[name]"
            class="form-control"
            :class="{ 'is-invalid': errors[name] }"
            :placeholder="$t('placeholder') + $t(label)"
            @keydown.stop="clearError"
        ></textarea>
        <form-validation-errors :errors="errors" :name="name" />
    </div>
</template>

<script>
export default {
    name: "FormTextArea",
    emits: ["clearErrors"],
    props: {
        id: {
            type: String,
            default: "",
        },
        label: {
            type: String,
            default: "",
        },
        rows: {
            type: Number,
            default: 3,
        },
        model: {
            type: [Array, Object, String],
        },
        name: {
            type: String,
            default: "",
        },
        errors: {
            type: [Array, Object],
            default: [],
        },
    },
    methods: {
        clearError() {
            this.$emit("clearErrors", this.name);
        },
    },
};
</script>

<style scoped></style>
