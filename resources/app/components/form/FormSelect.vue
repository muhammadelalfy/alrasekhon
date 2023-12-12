<template>
    <div class="mb-3">
        <label v-if="title" class="form-label">
            {{ $t(title) }}
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
        <el-select
            class="w-100"
            :multiple="multiple"
            v-model="model[name]"
            :clearable="true"
            :filterable="true"
            :collapse-tags="collapseTags"
            :collapse-tags-tooltip="collapseTagsTooltip"
            @change="
                clearError;
                this.$emit('change');
            "
            :placeholder="$t('forms.select')"
        >
            <el-option
                v-for="(item, index) in myOptions"
                :key="item.id"
                :label="item[labelField]"
                :value="item[valueField]"
            >
                <img
                    v-if="labelImage"
                    :src="`${publicPath}/assets/images/text-file.webp`"
                    class="me-2"
                    width="25"
                    height="25"
                />
                {{ item[labelField] }}
            </el-option>
        </el-select>
        <ul v-if="errors[name]">
            <li v-for="error in errors[name]" class="invalid-feedback">
                {{ error }}
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    name: "FormSelect",
    emits: ["clearErrors"],
    props: {
        title: {
            type: String,
            default: "",
        },
        label: {
            type: String,
            default: "",
        },
        name: {
            type: String,
            default: "",
        },
        labelField: {
            type: String,
            default: "label",
        },
        IsSelected: {
            type: String,
            default: "label",
        },
        valueField: {
            type: String,
            default: "value",
        },
        myOptions: {
            type: Array,
            default() {
                return [];
            },
        },
        modelValue: {
            type: [String, Number],
            default: "",
        },
        model: {
            type: [Array, Object],
        },
        errors: {
            type: [Array, Object],
            default: [],
        },
        multiple: {
            type: Boolean,
            default: false,
        },
        collapseTags: {
            type: Boolean,
            default: false,
        },
        collapseTagsTooltip: {
            type: Boolean,
            default: false,
        },
        labelIcon: {
            type: Boolean,
            default: false,
        },
        labelImage: {
            type: Boolean,
            default: false,
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
    },
};
</script>
