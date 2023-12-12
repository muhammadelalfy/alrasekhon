<template>
    <div id="formFilter" class="collapse multi-collapse">
        <card>
            <template #body>
                <filters :model="filters"> </filters>
            </template>
        </card>
    </div>

    <Card class="pt-3">
        <template #default>
            <DataTable>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ $t("pages.name") }}</th>
                        <th>{{ $t("pages.level_rules") }}</th>
                        <th>{{ $t("pages.status") }}</th>
                        <th>{{ $t("global.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>المستوي الأول</td>
                        <td>القرآن كاملا</td>
                        <td>
                            <form-switcher
                                id="status"
                                :model="statusAction"
                                name="status"
                                :errors="formErrors"
                                @clearErrors="clearInput"
                            >
                            </form-switcher>
                        </td>
                        <td>
                            <div class="btn-list d-inline-flex">
                                <div
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    :title="$t('forms.edit')"
                                >
                                    <button
                                        type="button"
                                        class="btn btn-light-secondary text-white me-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#MainAddModal"
                                        @click="isAdd = false"
                                    >
                                        <font-awesome-icon
                                            icon="fa-solid fa-pen-to-square"
                                        />
                                    </button>
                                </div>
                                <delete-button />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </DataTable>
        </template>
    </Card>

    <!-- Modal -->
    <CompetitionLevelForm
        :competitionLevel="levelForm"
        :showButton="false"
        :title="isAdd ? $t('pages.add_level') : $t('pages.edit_level')"
        id="MainAddModal"
        aria-labelledby="MainAddModalLabel"
        :modal-dialog-centered="true"
        :modal-lg="true"
    />
</template>

<script>
import Card from "@/components/Card.vue";
import CompetitionLevelForm from "@/views/settings/competition-levels/CompetitionLevelForm.vue";
import { ref, reactive, onMounted } from "vue";

import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

export default {
    components: {
        Card,
        QuillEditor,
        CompetitionLevelForm,
    },
    setup() {
        const isAdd = ref(true);
        const levelForm = reactive({
            competitionLevelAr: "",
            competitionLevelEn: "",
            descAr: "",
            descEn: "",
            saveAmount: "whole_quran",
            otherType: "juz",
            otherControls: [],
            rows: [],
        });

        onMounted(() => {
            $("#modal-btn").on("click", function () {
                isAdd.value = true;
            });
        });

        return {
            isAdd,
            levelForm,
        };
    },
    data() {
        return {
            statusAction: {
                status: false,
            },
            filters: {
                page: 1,
            },
        };
    },
};
</script>
