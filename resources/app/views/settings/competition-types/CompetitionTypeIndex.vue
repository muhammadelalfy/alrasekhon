<template>
    <div id="formFilter" class="collapse multi-collapse">
        <card>
            <template #body>
                <filters @submit="getCompetitionTypes" :model="filters"> </filters>
            </template>
        </card>
    </div>

    <Card class="pt-3" v-if="competitionTypes.length">
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
                <tr v-for="(competitionType, index) in competitionTypes" :key="competitionType.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ competitionType.name_localized }}</td>
                        <td>
                            <p>{{ competitionType.description_localized }}</p>
                        </td>
                        <td>{{ competitionType.last_update }}</td>
                        <td>
                            <form-switcher
                                id="status"
                                :model="competitionType"
                                name="status"
                                :errors="formErrors"
                                @clearErrors="clearInput"
                                @toggle="toggle(competitionType)"
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
                                        @click="isAdd = false; groupForm(competitionType)"
                                        v-if="hasPermission('update', 'CompetitionType')"
                                    >
                                        <font-awesome-icon icon="fa-solid fa-pen-to-square"/>
                                    </button>
                                </div>
                                <delete-button v-if="hasPermission('delete', 'CompetitionType')"  @del-model="delCompetitionType(competitionType, index)" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </DataTable>
        </template>
    </Card>

    <!-- Modal -->
    <CompetitionTypeForm
        :competitionType="competitionType"
        :showButton="false"
        :title="isAdd ? $t('pages.add_type') : $t('pages.edit_type')"
        id="MainAddModal"
        aria-labelledby="MainAddModalLabel"
        :modal-dialog-centered="true"
        :modal-lg="true"
    />
</template>

<script>
import Card from "@/components/Card.vue";
import CompetitionTypeForm from "@/views/settings/competition-types/CompetitionTypeForm.vue";
import { ref, onMounted } from "vue";

import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import CompetitionTypesApi from "@api/competition-types.api";
import {useToast} from "vue-toastification";

export default {
    components: {
        Card,
        QuillEditor,
        CompetitionTypeForm,
    },
    setup() {
        const isAdd = ref(true);
        const competitionType = ref({
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
            competitionType,
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
            competitionTypes: [],
        };
    },

    methods: {
        getCompetitionTypes(page = 1) {
            this.filters.page = page;
            CompetitionTypesApi.list(this.filters)
                .then(({ data }) => {
                    this.competitionTypes = data.data;
                    this.pagination = data.meta;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        groupForm(competitionType = {}) {
            if (competitionType.id) {
                this.title = "pages.edit_type";
                this.competitionType = _.cloneDeep(competitionType);
            } else {
                this.title = "pages.add_type";
            }
            $("#MainAddModal").modal("show");
        },

        clearForm() {
            this.clearErrors();
        },

        delCompetitionType(competitionType, index) {
            CompetitionTypesApi.delete(competitionType).then((resp) => {
                this.competitionTypes.splice(index, 1);
                useToast().success(resp.data.message);
            });
        },
        toggle(competitionTypeObj = {}){
            CompetitionTypesApi.changeStatus(competitionTypeObj).then((resp) => {
                useToast().success(resp.data.message);
            });
        },
    },
    created() {
        this.getCompetitionTypes();
    },
};
</script>
