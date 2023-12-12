<template>
    <div :class="{ 'mb-3': margin }">
        <label v-if="showLabel" class="form-label">
            {{ $t(label) }}
            <el-tooltip
                v-if="labelIcon"
                class="box-item"
                effect="dark"
                :content="$t(tooltip)"
                placement="top"
            >
                <span
                    class="align-items-center bg-grayClr d-inline-flex info-icon justify-content-center ms-2 text-white"
                >
                    <font-awesome-icon icon="fa-solid fa-info" />
                </span>
            </el-tooltip>
        </label>
        <div class="position-relative">
            <input
                :id="id"
                class="form-control"
                :class="{ 'is-invalid': errors[name], 'pe-4': isSearch }"
                :type="
                    type == 'password' ? (showPass ? 'text' : 'password') : type
                "
                v-model="model[name]"
                :placeholder="
                    label == 'global.search'
                        ? $t(label)
                        : $t('placeholder') + $t(label)
                "
                @keydown.stop="clearError"
                :readonly="disabled"
            />
            <font-awesome-icon
                v-if="type == 'password'"
                class="toggle-password"
                :icon="showPass ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"
                @click.prevent="showPass = !showPass"
            />
            <font-awesome-icon
                v-if="isSearch"
                class="input-icon"
                icon="fa-solid fa-magnifying-glass"
            />
        </div>
        <form-validation-errors :errors="errors" :name="getErrorKey()" />
    </div>
</template>
<script>
import { ref } from "vue";
export default {
    name: "FormInput",
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
        type: {
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
        error_key: {
            type: String,
            default: "",
        },
        errors: {
            type: [Array, Object],
            default: [],
        },
        disabled: {
            type: Boolean,
            default: false,
        },
        isSearch: {
            type: Boolean,
            default: false,
        },
        showLabel: {
            type: Boolean,
            default: true,
        },
        labelIcon: {
            type: Boolean,
            default: false,
        },
        margin: {
            type: Boolean,
            default: true,
        },
        tooltip: {
            type: String,
            default: "",
        },
    },
    methods: {
        clearError() {
            this.$emit("clearErrors", this.name);
        },
        getErrorKey() {
            return this.error_key ? this.error_key : this.name;
        },
    },
    setup() {
        const showPass = ref(false);
        return { showPass };
    },
};
</script>
