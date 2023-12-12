<template>
    <FormCheckbox
        v-for="(option, index) in options"
        :option="option.name"
        :label="option.label"
        :key="option"
        :model="model"
        :name="name"
        :class="index !== 0 && 'ms-md-5'"
        :input-id="option.name"
    />
</template>

<script>
export default {
    name: "FormCheckGroup",
    props: {
        options: {
            required: true,
            type: Array,
        },
        name: {
            required: true,
            type: String,
            default: "",
        },
        model: {
            type: [Array, Object],
        },
    },
};
</script>
