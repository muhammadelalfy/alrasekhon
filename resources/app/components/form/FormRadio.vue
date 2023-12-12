<template>
    <div class="align-items-cenetr d-flex form-check mb-0">
        <input
            class="form-check-input"
            type="radio"
            :value="option"
            :id="option"
            v-model="model[name]"
            :name="name"
        />
        <label class="form-check-label ms-3" :for="option">
            {{ label }}
        </label>
    </div>
</template>

<script>
export default {
    name: "FormRadio",
    props: {
        option: {
            required: true,
            type: String,
        },
        label: {
            required: true,
            type: String,
        },
        model: {
            type: [Array, Object],
        },
        name: {
            type: String,
            default: "",
        },
    },
};
</script>
