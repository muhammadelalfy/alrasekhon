<template>
    <div class="form-check form-switch">
        <input
            class="form-check-input form-check-md"
            type="checkbox"
            v-model="model[name]"
            @input="clearError"
            :id="id"
            @change="toggle"
        />
        <label class="form-check-label" :for="id"></label>
    </div>
    <form-validation-errors :errors="errors" :name="name" />
</template>

<script>
export default {
    name: "FormSwitcher",
    emits: ["clearErrors" , "toggle"],
    props: {
        id: {
            type: String,
            default: "",
        },
        title: {
            type: String,
            default: "",
        },
        label: {
            type: String,
            default: "",
        },
        model: {
            type: [Array, Object],
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
        toggle() {
            this.$emit("toggle");
        },

    },
};
</script>

<style scoped></style>
