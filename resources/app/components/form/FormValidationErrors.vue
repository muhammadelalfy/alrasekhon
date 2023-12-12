<template>
    <ul v-if="errors[name]">
        <li v-for="error in errors[name]" class="invalid-feedback">
            {{ error }}
        </li>
    </ul>
</template>

<script>
export default {
    name: "FormValidationErrors",
    props: {
        errors: {
            type: [Array, Object],
            default: [],
        },
        name: {
            type: String,
            default: "",
        },
    },
};
</script>

<style scoped></style>
