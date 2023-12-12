<template>
    <QuillEditor
        v-model:content="model[name]"
        contentType="html"
        theme="snow"
        class="w-100"
        toolbar="full"
        :placeholder="$t('placeholder')"
        :options="editorOptions"
    />
</template>

<script>
import {QuillEditor} from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

export default {
    name: "FormSwitcher",
    components: {
        QuillEditor,
    },
    props: {
        model: {
            type: [Array, Object],
        },
        name: {
            type: String,
            default: "",
        },
    },
    data() {
        return {
            editorOptions: {
                modules: {
                    toolbar: [
                        // Define your toolbar options here
                    ]
                },
                clipboard: {
                    matchVisual: false
                }
            }
        };
    }

};
</script>

<style scoped></style>
