<template>
    <form-modal
        :id="id"
        :aria-labelledby="ariaLabelledby"
        :modal-dialog-centered="modalDialogCentered"
        :modal-lg="modalLg"
        @clearForm="clearForm"
        @submit="submit"
        :buttonDisabled="submitFormDisabled"
        :title="title"
    >
        <div class="row">
            <div class="col-md-6">
                <form-input
                    label="pages.committee_name_ar"
                    type="text"
                    :model="this.arbitrationCommittee.name"
                    name="ar"
                    :errors="formErrors"
                    @clearErrors="clearInput('name.ar')"
                    error_key="name.ar"
                />
            </div>
            <div class="col-md-6">
                <form-input
                    label="pages.committee_name_en"
                    type="text"
                    :model="this.arbitrationCommittee.name"
                    name="en"
                    :errors="formErrors"
                    @clearErrors="clearInput('name.en')"
                    error_key="name.en"
                />
            </div>
            <div class="col-md-6">
                <form-select
                    title="pages.competition_level"
                    label="name"
                    name="competition_level_ids"
                    multiple
                    collapse-tags
                    collapse-tags-tooltip
                    @clearErrors="clearInput('competition_level_ids')"
                    :model="this.arbitrationCommittee"
                    :myOptions="competitionLevels"
                    label-field="name_localized"
                    value-field="id"
                    :errors="formErrors"
                    error_key="competition_level_ids"

                />
            </div>
            <div class="col-md-6">
                <form-select
                    title="pages.competition_stage"
                    label="name"
                    name="stage_ids"
                    multiple
                    collapse-tags
                    collapse-tags-tooltip
                    @clearErrors="clearInput(('stage_ids'))"
                    :model="this.arbitrationCommittee"
                    :myOptions="stages"
                    label-field="name"
                    value-field="id"
                    :errors="formErrors"
                    error_key="stage_ids"
                />
            </div>
            <div class="col-md-6">
                <form-input
                    label="pages.arbitrators_num"
                    type="number"
                    :model="this.arbitrationCommittee"
                    name="arbitrators_number"
                    :errors="formErrors"
                    @clearErrors="clearInput('arbitrators_number')"
                    error_key="arbitrators_number"
                />
            </div>
            <div class="col-md-6">
                <form-select
                    title="pages.committee_members"
                    label="name"
                    name="committee_member_ids"
                    multiple
                    collapse-tags
                    collapse-tags-tooltip
                    @clearErrors="clearInput('committee_member_ids')"
                    :model="this.arbitrationCommittee"
                    :myOptions="committeeMembers"
                    label-field="name_localized"
                    value-field="id"
                    :errors="formErrors"
                    error_key="committee_member_ids"
                />
            </div>
            <div class="col-md-6">
                <form-select
                    title="pages.committee_chairman"
                    label="name"
                    name="committee_chairman_id"
                    @clearErrors="clearInput('committee_chairman_id')"
                    :model="this.arbitrationCommittee"
                    :myOptions="committeeChairman"
                    label-field="name_localized"
                    value-field="id"
                    :errors="formErrors"
                    error_key="committee_chairman_id"

                />
            </div>
            <div class="col-md-6">
                <form-select
                    title="pages.vice_committee_chairman"
                    label="name"
                    name="vice_committee_chairman_id"
                    @clearErrors="clearInput('vice_committee_chairman_id')"
                    :model="this.arbitrationCommittee"
                    :myOptions="viceCommitteeChairman"
                    label-field="name_localized"
                    value-field="id"
                    :errors="formErrors"
                    error_key="vice_committee_chairman_id"

                />
            </div>
        </div>
    </form-modal>
</template>

<script>
import { useToast } from "vue-toastification";
import CompetitionLevelsApi from "@api/competition-levels.api";
import StagesApi from "@api/stages.api";
import CommitteeMembersApi from "@api/committee-members.api";
import CommitteeChairmanApi from "@api/committee-chairman.api";
import ViceCommitteeChairmanApi from "@api/vice-committee-chairman.api";
import ArbitratorLevelsApi from "@api/arbitrator-levels.api";
import ArbitrationCommitteesApi from "@api/arbitration-committees.api";
import {runInContext as ArbitrationComm} from "lodash";
import CompetitionStagesApi from "@api/base.api";
export default {
    name: "ArbitrationCommitteeForm",
    data(){
      return {
          competitionLevels: [],
          stages: [],
          committeeMembers: [],
          committeeChairman: [],
          viceCommitteeChairman: [],
      }
    },

    props: {
        id: {
            type: String,
            default: "MainAddModal",
        },
        ariaLabelledby: String,
        dataBsBackdrop: String,
        dataBskeyboard: String,
        modalDialogScrollable: Boolean,
        modalDialogCentered: Boolean,
        modalLg: Boolean,
        modalFullscreen: Boolean,
        arbitrationCommittee: Object,
        title: {
            type: String,
            default: "pages.add_arbitration_committee",
        },
    },
    methods: {
        // addRow: function () {
        //     this.arbitrationCommittee.rows.push({
        //         title: "",
        //     });
        // },
        // removeElement: function (index) {
        //     this.arbitrationCommittee.rows.splice(index, 1);
        // },

        getCompetitionLevels() {
            CompetitionLevelsApi.list()
                .then(({ data }) => {
                    this.competitionLevels = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getStages() {
            let requestData = {
                competition_id: this.$route.params.id
            }
            StagesApi.list(requestData)
                .then(({ data }) => {
                    this.stages = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getCommitteeMembers() {
            CommitteeMembersApi.list()
                .then(({ data }) => {
                    this.committeeMembers = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getCommitteeChairman() {
            CommitteeChairmanApi.list()
                .then(({ data }) => {
                    this.committeeChairman = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getViceCommitteeChairman() {
            ViceCommitteeChairmanApi.list()
                .then(({ data }) => {
                    this.viceCommitteeChairman = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },

        clearForm() {
            this.clearErrors();
            this.resetForm(this.arbitrationCommittee);
        },
        update() {
            this.submitFormDisabled = true;
            ArbitrationCommitteesApi.update(this.arbitrationCommittee)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    $("#MainAddModal").modal("hide");

                    this.afterModalUpdateActions(
                        this.arbitrationCommittee,
                        this.$parent.arbitrationCommittees,
                        data.data,
                        this.arbitrationCommittee.id
                    );
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
        add() {
            this.submitFormDisabled = true;
            ArbitrationCommitteesApi.store(this.arbitrationCommittee)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    $("#MainAddModal").modal("hide");
                    this.afterModalAddActions(
                        this.arbitrationCommittee,
                        this.$parent.arbitrationCommittees,
                        data.data
                    );
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
        submit() {
            console.log(this.arbitrationCommittee.id)
            if (this.arbitrationCommittee.id === '') {
                this.add();
            } else {
                this.update();
            }
        },
    },

    mounted() {
        this.getStages();
        this.getCompetitionLevels();
        this.getCommitteeMembers();
        this.getCommitteeChairman();
        this.getViceCommitteeChairman();
    }
};
</script>

<style scoped></style>
