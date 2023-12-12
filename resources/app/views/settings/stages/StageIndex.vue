<template>
    <div id="formFilter" class="collapse multi-collapse">
        <card>
            <template #body>
                <filters @submit="getStages" :model="filters">
                </filters>
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
                        <th>{{ $t("pages.status") }}</th>
                        <th>{{ $t("global.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                <tr v-for="(stage, index) in stages" :key="stage.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ stage.name_localized }}</td>
                        <td>
                            <p>
                                {{ stage.description_localized }}
                            </p>
                        </td>
                        <td>
                            <form-switcher
                                id="status"
                                :model="stage"
                                name="status"
                                :errors="formErrors"
                                @clearErrors="clearInput"
                                @toggle="toggle(stage)"
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
                                        @click="isAdd = false ;  groupForm(stage)"
                                    >
                                        <font-awesome-icon icon="fa-solid fa-pen-to-square" />
                                    </button>
                                </div>
                                <delete-button  v-if="hasPermission('delete', 'Stage')" @del-model="delStage(stage,index)" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </DataTable>
        </template>
    </Card>

    <!-- Modal -->
    <StageForm
        :stage="stage"
        :showButton="false"
        :title="isAdd ? $t('pages.add_stage') : $t('pages.edit_stage')"
        id="MainAddModal"
        aria-labelledby="MainAddModalLabel"
        :modal-dialog-centered="true"
        :modal-lg="true"
    />
</template>

<script>
import Card from "@/components/Card.vue";
import StageForm from "@/views/settings/stages/StageForm.vue";
import { ref, reactive, onMounted } from "vue";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import {useToast} from "vue-toastification";
import StagesApi from "@api/stages.api";

export default {
    components: {
        Card,
        QuillEditor,
        StageForm,
    },
    setup() {
        const isAdd = ref(true);
        const stage = reactive({
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
            stage,
        };
    },
    methods:{
        toggle(stageObj = {}){
            StagesApi.changeStatus(stageObj).then((resp) => {
                useToast().success(resp.data.message);
            })  .catch((errors) => {
                console.log(errors);
            });
        },

        delStage(stage, index) {
            StagesApi.delete(stage).then((resp) => {
                this.stages.splice(index, 1);
                useToast().success(resp.data.message);
            });
        },

        getStages(page = 1) {
            this.filters.page = page;
            StagesApi.list(this.filters)
                .then(({data}) => {
                    this.stages = data.data;
                    this.pagination = data.meta;
                })
                .catch((errors) => {
                    console.log(errors);
                });

        },

        groupForm(stage = {}) {
            if (stage.id) {
                this.title = "pages.edit_country";
                this.stage = _.cloneDeep(stage);
            } else {
                this.title = "pages.add_country";
            }
            $("#MainAddModal").modal("show");
        },

    },
    created() {
        this.getStages()
    },
    data() {
        return {
            statusAction: {
                status: false,
            },
            filters: {
                page: 1,
            },
            stages: [],
        };
    },
};
</script>
