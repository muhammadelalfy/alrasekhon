<template>
    <div id="formFilter" class="collapse multi-collapse">
        <card>
            <template #body>
                <filters @submit="getContestantLevels" :model="filters"> </filters>
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
                        <th>{{ $t("pages.desc") }}</th>
                        <th>{{ $t("pages.last_update") }}</th>
                        <th>{{ $t("pages.status") }}</th>
                        <th>{{ $t("global.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                <tr v-for="(contestantLevel, index) in contestantLevels" :key="contestantLevel.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ contestantLevel.name_localized }}</td>
                        <td>
                            <p>{{ contestantLevel.description_localized }}</p>
                        </td>
                        <td>{{ contestantLevel.last_update }}</td>
                        <td>
                            <form-switcher
                                id="status"
                                :model="contestantLevel"
                                name="status"
                                :errors="formErrors"
                                @clearErrors="clearInput"
                                @toggle="toggle(contestantLevel)"
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
                                        @click="isAdd = false; groupForm(contestantLevel)"
                                        v-if="hasPermission('update', 'ContestantLevel')"
                                    >
                                        <font-awesome-icon icon="fa-solid fa-pen-to-square"/>
                                    </button>
                                </div>
                                <delete-button v-if="hasPermission('delete', 'ContestantLevel')"  @del-model="delContestantLevel(contestantLevel, index)" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </DataTable>
        </template>
    </Card>

    <!-- Modal -->
    <ContestantLevelForm
        :contestantLevel="contestantLevel"
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
import ContestantLevelForm from "@views/settings/contestant-levels/ContestantLevelForm.vue";
import { ref, onMounted } from "vue";

import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import ContestantLevelsApi from "@api/contestant-levels.api";
import {useToast} from "vue-toastification";

export default {
    components: {
        Card,
        QuillEditor,
        ContestantLevelForm,
    },
    setup() {
        const isAdd = ref(true);
        const contestantLevel = ref({
            name: {
                ar: "",
                en: ""
            },
            description: {
                ar: "",
                en: ""
            },
        });

        onMounted(() => {
            $("#modal-btn").on("click", function () {
                isAdd.value = true;
            });
        });

        return {
            isAdd,
            contestantLevel,
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
            pagination: {},
            contestantLevels: [],
        };
    },

    methods: {
        getContestantLevels(page = 1) {
            this.filters.page = page;
            ContestantLevelsApi.list(this.filters)
                .then(({ data }) => {
                    this.contestantLevels = data.data;
                    this.pagination = data.meta;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        groupForm(contestantLevel = {}) {
            if (contestantLevel.id) {
                this.title = "pages.edit_type";
                this.contestantLevel = _.cloneDeep(contestantLevel);
            } else {
                this.title = "pages.add_type";
            }
            $("#MainAddModal").modal("show");
        },

        clearForm() {
            this.clearErrors();
        },
        delContestantLevel(contestantLevel, index) {
            ContestantLevelsApi.delete(contestantLevel).then((resp) => {
                this.contestantLevels.splice(index, 1);
                useToast().success(resp.data.message);
            });
        },

        toggle(contestantLevelObj = {}){
            ContestantLevelsApi.changeStatus(contestantLevelObj).then((resp) => {
                useToast().success(resp.data.message);
            });
        },
    },
    created() {
        this.getContestantLevels();
    },
};
</script>
