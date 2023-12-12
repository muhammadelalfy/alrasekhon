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
                {{ $t("pages.add_arbitration_committee") }}
            </button>
        </div>

        <div class="pt-3">
            <table
                class="table-data dt-responsive table w-100 table-borderless"
            >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>
                            {{ $t("pages.committee_name") }}
                        </th>
                        <th>
                            {{ $t("pages.competition_level") }}
                        </th>
                        <th>
                            {{ $t("pages.competition_stage") }}
                        </th>
                        <th>
                            {{ $t("pages.arbitrators_num") }}
                        </th>
                        <th>
                            {{ $t("pages.committee_members") }}
                        </th>
                        <th>
                            {{ $t("pages.committee_chairman") }}
                        </th>
                        <th>
                            {{ $t("pages.vice_committee_chairman") }}
                        </th>
                        <th>{{ $t("global.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(arbitrationCommittee, index) in this
                            .arbitrationCommittees"
                        :key="index"
                    >
                        <td>{{ index + 1 }}</td>
                        <td>{{ arbitrationCommittee.name_localized }}</td>
                        <td>
                            <div class="d-flex align-items-start less">
                                <a
                                    class="me-1 px-2 bg-primary fs-11 wh-20px text-white d-inline-flex align-items-center justify-content-center btn-collapse"
                                    href="javascript:void(0)"
                                >
                                    <span class="view-more">
                                        <font-awesome-icon
                                            icon="fa-solid fa-plus"
                                        />
                                    </span>
                                    <span class="d-none view-less">
                                        <font-awesome-icon
                                            icon="fa-solid fa-minus"
                                        />
                                    </span>
                                </a>
                                <span class="list">
                                    <div
                                        v-for="(
                                            competitionLevel,
                                            competitionLevelIndex
                                        ) in arbitrationCommittee.competition_levels"
                                        :key="competitionLevelIndex"
                                    >
                                        {{ competitionLevel.name_localized }}
                                    </div>
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-start less">
                                <a
                                    class="me-1 px-2 bg-primary fs-11 wh-20px text-white d-inline-flex align-items-center justify-content-center btn-collapse"
                                    href="javascript:void(0)"
                                >
                                    <span class="view-more">
                                        <font-awesome-icon
                                            icon="fa-solid fa-plus"
                                        />
                                    </span>
                                    <span class="d-none view-less">
                                        <font-awesome-icon
                                            icon="fa-solid fa-minus"
                                        />
                                    </span>
                                </a>
                                <span class="list">
                                    <div
                                        v-for="(
                                            stage, stageIndex
                                        ) in arbitrationCommittee.stages"
                                        :key="stageIndex"
                                    >
                                        {{ stage.name }}
                                    </div>
                                </span>
                            </div>
                        </td>
                        <td>{{ arbitrationCommittee.arbitrators_number }}</td>
                        <td>
                            <div class="d-flex align-items-start less">
                                <a
                                    class="me-1 px-2 bg-primary fs-11 wh-20px text-white d-inline-flex align-items-center justify-content-center btn-collapse"
                                    href="javascript:void(0)"
                                >
                                    <span class="view-more">
                                        <font-awesome-icon
                                            icon="fa-solid fa-plus"
                                        />
                                    </span>
                                    <span class="d-noآne view-less">
                                        <font-awesome-icon
                                            icon="fa-solid fa-minus"
                                        />
                                    </span>
                                </a>
                                <span class="list">
                                    <div
                                        v-for="(
                                            member, memberIndex
                                        ) in arbitrationCommittee.committee_members"
                                        :key="memberIndex"
                                    >
                                        {{ member.name_localized }}
                                    </div>
                                </span>
                            </div>
                        </td>
                        <td>{{ arbitrationCommittee.committee_chairman }}</td>
                        <td>
                            {{ arbitrationCommittee.vice_committee_chairman }}
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
                                        @click="
                                            isAdd = false;
                                            groupForm(arbitrationCommittee);
                                        "
                                    >
                                        <font-awesome-icon
                                            icon="fa-solid fa-pen-to-square"
                                        />
                                    </button>
                                </div>
                                <delete-button
                                    v-if="
                                        hasPermission(
                                            'delete',
                                            'ArbitrationCommittee'
                                        )
                                    "
                                    @del-model="
                                        delArbitrationCommittee(
                                            arbitrationCommittee,
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

    <ArbitrationCommitteeForm
        :arbitrationCommittee="arbitrationCommittee"
        :showButton="false"
        :title="
            isAdd
                ? $t('pages.add_arbitration_committee')
                : $t('pages.edit_arbitration_committee')
        "
        id="MainAddModal"
        aria-labelledby="MainAddModalLabel"
        :modal-dialog-centered="true"
        :modal-lg="true"
    />
</template>

<script>
import Card from "@/components/Card.vue";
import ArbitrationCommitteeForm from "@/views/competitions/competitions/competition-forms/arbitration-committees/ArbitrationCommitteeForm.vue";
import { ref, reactive, onMounted } from "vue";
import { useToast } from "vue-toastification";
import ArbitrationCommitteesApi from "@api/arbitration-committees.api";

export default {
    components: {
        Card,
        ArbitrationCommitteeForm,
    },

    data() {
        return {
            arbitrationCommittee: {
                id: "",
                competition_id: this.$route.params.id,
                name: {
                    ar: "",
                    en: "",
                },
                committee_chairman_id: "",
                vice_committee_chairman_id: "",
                arbitrators_number: "",
                competition_level_ids: [],
                stage_ids: [],
                committee_member_ids: [],
            },
            filters: {
                page: 1,
            },
            pagination: {},
            arbitrationCommittees: [],
        };
    },
    methods: {
        getArbitrationCommittees(page = 1) {
            this.filters.page = page;
            let requestData = {
                page: page,
                competition_id: this.$route.params.id,
            };
            ArbitrationCommitteesApi.list(requestData)
                .then(({ data }) => {
                    this.arbitrationCommittees = data.data;
                    this.pagination = data.meta;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        groupForm(arbitrationCommittee = {}) {
            if (arbitrationCommittee.id) {
                this.arbitrationCommittee = _.cloneDeep(arbitrationCommittee);
            }
            $("#MainAddModal").modal("show");
        },
        clearForm() {
            this.clearErrors();
        },
        delArbitrationCommittee(arbitrationCommittee, index) {
            ArbitrationCommitteesApi.delete(arbitrationCommittee).then(
                (resp) => {
                    this.arbitrationCommittees.splice(index, 1);
                    useToast().success(resp.data.message);
                }
            );
        },
    },
    setup() {
        const isAdd = ref(true);
        const committeeForm = reactive({
            name: {
                ar: "",
                en: "",
            },
            competitionLevel: "",
            competitionStage: "",
            arbitratorsNum: "",
            committeeMembers: "",
            committeeChairman: "",
            viceCommitteeChairman: "",
        });

        onMounted(() => {
            $("#modal-btn").on("click", function () {
                isAdd.value = true;
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
        });

        return {
            isAdd,
            committeeForm,
        };
    },

    mounted() {
        this.getArbitrationCommittees();

        function btnPlusCollapse() {
            $(this).parent().toggleClass("less");
            if ($(this).parent().hasClass("less")) {
                $(this).find(".view-more").removeClass("d-none");
                $(this).find(".view-less").addClass("d-none");
            } else {
                $(this).find(".view-less").removeClass("d-none");
                $(this).find(".view-more").addClass("d-none");
            }
        }
        $(document).on("click", ".btn-collapse", btnPlusCollapse);
        $(".btn-collapse").on("click", btnPlusCollapse);
        $(document).on(
            "click",
            ".table-data tbody td.dtr-control",
            function () {
                $(document).on(
                    "click",
                    ".dtr-data .btn-collapse",
                    btnPlusCollapse
                );
            }
        );
    },
};
</script>
