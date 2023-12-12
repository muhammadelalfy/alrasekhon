<script>
export default {
    name: "filters",
    emits: ["submit"],
    props: {
        model: {
            type: [Array, Object],
        },
        enableKeyword: {
            type: Boolean,
            default: true,
        },
        enableSubmit: {
            type: Boolean,
            default: true,
        },
        keyword: {
            type: String,
            default: "global.search",
        },
    },
    methods: {
        submit() {
            this.$emit("submit");
        },
        hitSearch() {
            this.$refs.filterSubmitBtn.click();
        },
    },
};
</script>

<template>
    <form class="row align-items-end" @keydown.enter.prevent="submit">
        <div class="col-md-4 col-lg-3" v-if="enableKeyword">
            <form-input
                label="global.search"
                type="text"
                name="keyword"
                :model="model"
                id="inputBox"
                is-search
            />
            <!-- <div class="mb-3">
                <label class="form-label">{{ $t(keyword) }}</label>
                <input
                    type="text"
                    v-model="model['keyword']"
                    class="form-control"
                    id="inputBox"
                    :placeholder="$t(keyword)"
                />
            </div> -->
        </div>
        <slot></slot>
        <div class="col-md-4 col-lg-3">
            <div class="mb-3">
                <button
                    type="button"
                    ref="filterSubmitBtn"
                    class="btn ripple btn-babyblue text-white"
                    @click.prevent="submit"
                    :disabled="!this.enableSubmit"
                >
                    {{ $t("global.search") }}
                </button>
            </div>
        </div>
    </form>
</template>
