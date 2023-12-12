<template>
    <div>
        <div class="d-flex flex-wrap align-items-center justify-content-end">
            <button
                type="button"
                class="btn ripple btn-babyblue text-white"
                id="modal-btn"
                data-bs-toggle="modal"
                data-bs-target="#MainAddModal"
            >
                <font-awesome-icon icon="fa-solid fa-plus" class="me-1" />
                {{ $t("pages.add_level") }}
            </button>
        </div>
        <div class="pt-3">
            <table
                class="table-data dt-responsive table w-100 table-borderless"
            >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ $t("pages.level_name") }}</th>
                        <th>{{ $t("pages.level_rules") }}</th>
                        <th>
                            {{ $t("pages.contestants_num") }}
                        </th>
                        <th>{{ $t("global.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(competitionLevel, index) in competitionlevels">
                        <td>{{ index + 1 }}</td>
                        <td>{{ competitionLevel.name_localized }}</td>
                        <td>{{ competitionLevel.save_amount }}</td>
                        <td>{{ competitionLevel.winners_count }}</td>
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
                                        @click="
                                            isAdd = false;
                                            groupForm(competitionLevel);
                                        "
                                        v-if="
                                            hasPermission(
                                                'update',
                                                'CompetitionLevel'
                                            )
                                        "
                                    >
                                        <font-awesome-icon
                                            icon="fa-solid fa-pen-to-square"
                                        />
                                    </button>
                                </div>
                                <delete-button
                                    v-if="hasPermission('delete', 'City')"
                                    @del-model="
                                        delCompetitionLevel(
                                            competitionLevel,
                                            index
                                        )
                                    "
                                />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

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
import CompetitionLevelForm from "@/views/competitions/competitions/competition-forms/competition-levels/CompetitionLevelForm.vue";
import { useToast } from "vue-toastification";
import CompetitionLevelsApi from "@api/competition-levels.api";

export default {
    components: {
        Card,
        CompetitionLevelForm,
    },
    props: {
        competition: Object,
        cancelAdd: Function,
    },
    data() {
        return {
            isAdd: true,
            levelForm: {
                name: {
                    ar: "",
                    en: "",
                },
                other_controls: [],
                winners_count: "",
                save_amount: "whole_quran",
                controlName: [],
                competition_id: "",
            },
            competitionlevels: [],
        };
    },
    methods: {
        getCompetitionlevels() {
            CompetitionLevelsApi.list({ competition_id: this.$route.params.id })
                .then(({ data }) => {
                    this.competitionlevels = data.data;
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
        delCompetitionLevel(CompetitionLevel, index) {
            CompetitionLevelsApi.delete(CompetitionLevel).then((resp) => {
                this.competitionlevels.splice(index, 1);
                useToast().success(resp.data.message);
            });
        },
        groupForm(CompetitionLevel = {}) {
            if (CompetitionLevel.id) {
                this.levelForm = _.cloneDeep(CompetitionLevel);
                console.log(this.levelForm);
            }
        },
    },

    created() {
        this.getCompetitionlevels();
    },
    mounted() {
        $("#modal-btn").on("click", function () {
            this.isAdd = true;
        });
        /*basic responsive Datatable*/
        $(".table-data").DataTable({
            lengthChange: false,
            searching: false,
            paging: false,
            info: false,
            ordering: false,
            order: [],
        });
    },
};
</script>
