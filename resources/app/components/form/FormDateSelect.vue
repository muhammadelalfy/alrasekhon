<template>
    <div class="mb-3">
        <label class="form-label">{{ $t(label) }}</label>
        <el-config-provider :locale="locale">
            <el-date-picker
                v-model="model[name]"
                :type="type"
                :placeholder="$t(label)"
                class="w-100"
                :range-separator="rangeSeparator"
                :start-placeholder="startPlaceholder"
                :end-placeholder="endPlaceholder"
            />
        </el-config-provider>
        <form-validation-errors :errors="errors" :name="name" />
    </div>
</template>
<script>
import ar from "element-plus/dist/locale/ar.mjs";
import en from "element-plus/dist/locale/en.mjs";
import { computed } from "vue";
export default {
    name: "FormDateSelect",
    emits: ["clearErrors"],
    props: {
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
        type: {
            type: String,
            default: "date",
        },
        rangeSeparator: {
            type: String,
            default: "",
        },
        startPlaceholder: {
            type: String,
            default: "",
        },
        endPlaceholder: {
            type: String,
            default: "",
        },
        errors: {
            type: [Array, Object],
            default: [],
        },
    },
    setup() {
        const locale = computed(() =>
            localStorage.getItem("lang") == "ar" ? ar : en
        );
        return {
            locale,
        };
    },
};
</script>
