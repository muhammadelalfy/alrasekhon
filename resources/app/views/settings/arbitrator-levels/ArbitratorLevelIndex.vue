<template>
    <div id="formFilter" class="collapse multi-collapse">
        <card>
            <template #body>
                <filters @submit="getArbitratorLevels" :model="filters"> </filters>
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
                <tr v-for="(arbitratorLevel, index) in arbitratorLevels" :key="arbitratorLevel.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ arbitratorLevel.name_localized }}</td>
                    <td>
                        <p>{{ arbitratorLevel.description_localized }}</p>
                    </td>
                    <td>{{ arbitratorLevel.last_update }}</td>
                    <td>
                        <form-switcher
                            id="status"
                            :model="arbitratorLevel"
                            name="status"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                            @toggle="toggle(arbitratorLevel)"
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
                                    @click="isAdd = false; groupForm(arbitratorLevel)"
                                    v-if="hasPermission('update', 'ArbitratorLevel')"
                                >
                                    <font-awesome-icon icon="fa-solid fa-pen-to-square"/>
                                </button>
                            </div>
                            <delete-button  v-if="hasPermission('delete', 'ArbitratorLevel')" @del-model="delArbitratorLevel(arbitratorLevel, index)" />
                        </div>
                    </td>
                </tr>
                </tbody>
            </DataTable>
        </template>
    </Card>

    <!-- Modal -->
    <ArbitratorLevelForm
        :arbitratorLevel="arbitratorLevel"
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
import ArbitratorLevelForm from "@views/settings/arbitrator-levels/ArbitratorLevelForm.vue";
import { ref, onMounted } from "vue";

import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import ArbitratorLevelsApi from "@api/arbitrator-levels.api";
import {useToast} from "vue-toastification";

export default {
    components: {
        Card,
        QuillEditor,
        ArbitratorLevelForm,
    },
    setup() {
        onMounted(() => {
            $("#modal-btn").on("click", function () {
                this.isAdd = true;
            });
        });
    },
    data() {
        return {
            isAdd: ref(true),
            statusAction: {
                status: false,
            },
            filters: {
                page: 1,
            },
            pagination: {},
            arbitratorLevel: {
                name: {
                    ar: "",
                    en: ""
                },
                description: {
                    ar: "",
                    en: ""
                },
            },
            arbitratorLevels: [],
        };
    },

    methods: {
        getArbitratorLevels(page = 1) {
            this.filters.page = page;
            ArbitratorLevelsApi.list(this.filters)
                .then(({ data }) => {
                    this.arbitratorLevels = data.data;
                    this.pagination = data.meta;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        groupForm(arbitratorLevel = {}) {
            if (arbitratorLevel.id) {
                this.title = "pages.edit_type";
                this.arbitratorLevel = _.cloneDeep(arbitratorLevel);
            } else {
                this.title = "pages.add_type";
            }
            $("#MainAddModal").modal("show");
        },

        clearForm() {
            this.clearErrors();
        },
        delArbitratorLevel(arbitratorLevel, index) {
            ArbitratorLevelsApi.delete(arbitratorLevel).then((resp) => {
                this.arbitratorLevels.splice(index, 1);
                useToast().success(resp.data.message);
            });
        },

        toggle(arbitratorLevelObj = {}){
            ArbitratorLevelsApi.changeStatus(arbitratorLevelObj).then((resp) => {
                useToast().success(resp.data.message);
            });
        },
    },
    created() {
        this.getArbitratorLevels();
    },
};
</script>
