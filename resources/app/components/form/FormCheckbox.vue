<!-- eslint-disable vue/no-mutating-props -->
<template>
    <div class="form-check mb-0" :class="!option && 'mb-3'">
        <input
            :id="inputId"
            :value="option"
            v-model="model[name]"
            class="form-check-input"
            type="checkbox"
        />
        <label
            class="form-check-label"
            :class="option && 'ms-3'"
            :for="inputId"
        >
            {{ label }}
        </label>
    </div>
</template>

<script>
export default {
    name: "FormCheckbox",
    props: {
        inputId: {
            required: true,
            type: String,
        },
        label: {
            required: true,
            type: String,
        },
        model: {
            type: [Object, Array],
        },
        name: {
            type: String,
            default: "",
        },
        option: {
            type: String,
            default: "",
        },
    },
};
</script>
