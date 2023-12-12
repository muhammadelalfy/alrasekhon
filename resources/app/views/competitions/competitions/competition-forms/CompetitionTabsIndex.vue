<template>
    <card>
        <template #body>
            <el-steps
                :space="200"
                :active="this.competition.step_status_tabs"
                finish-status="success"
                class="d-flex justify-content-center"
                align-center
            >
                <el-step :title="$t('pages.preparing_draft')"/>
                <el-step :title="$t('pages.announced')"/>
                <el-step :title="$t('pages.in_progress')"/>
                <el-step :title="$t('pages.completed')"/>
            </el-steps>
        </template>
    </card>
    <div class="row">
        <div class="col-lg-3">
            <card>
                <template #body>
                    <ul class="side-links">
                        <li :class="`d-flex align-items-center ${checkActiveLink(`/competitions/create/${this.$route.params.id}`)}`">
                            <div class="form-check me-2 mb-0">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="check1"
                                    :checked="this.competition.steps_numbers && this.competition.steps_numbers.includes(1)"
                                    :disabled="this.competition.steps_numbers && this.competition.steps_numbers.includes(1)"
                                />
                            </div>
                            <router-link
                                :to="`/competitions/create/${this.$route.params.id}`"
                                class="inner-link"
                            >
                                {{ $t("pages.main_data") }}
                            </router-link>
                        </li>
                        <li :class="`d-flex align-items-center ${checkActiveLink(`/competitions/competition-levels/${this.$route.params.id}`)}`">
                        <div class="form-check me-2 mb-0">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="check2"
                                    :checked="this.competition.steps_numbers && this.competition.steps_numbers.includes(2)"
                                    :disabled="this.competition.steps_numbers && this.competition.steps_numbers.includes(2)"
                                />
                            </div>
                            <router-link
                                :to="this.$route.params.id ? `/competitions/competition-levels/${this.$route.params.id}` : '/competitions/create' "
                                class="inner-link"
                            >
                                {{ $t("pages.competition_levels") }}
                            </router-link>
                        </li>
                        <li :class="`d-flex align-items-center ${checkActiveLink(`/competitions/competition-stages/${this.$route.params.id}`)}`">
                        <div class="form-check me-2 mb-0">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="check3"
                                    :checked="this.competition.steps_numbers && this.competition.steps_numbers.includes(3)"
                                    :disabled="this.competition.steps_numbers && this.competition.steps_numbers.includes(3)"
                                />
                            </div>
                            <router-link
                                :to="this.$route.params.id ? `/competitions/competition-stages/${this.$route.params.id}` : '/competitions/create' "
                                class="inner-link"
                            >
                                {{ $t("sidebar.competition_stages") }}
                            </router-link>
                        </li>
                        <li :class="`d-flex align-items-center ${checkActiveLink(`/competitions/competition-place/${this.$route.params.id}`)}`">
                        <div class="form-check me-2 mb-0">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="check4"
                                    :checked="this.competition.steps_numbers && this.competition.steps_numbers.includes(4)"
                                    :disabled="this.competition.steps_numbers && this.competition.steps_numbers.includes(4)"
                                />
                            </div>
                            <router-link
                                :to="this.$route.params.id ? `/competitions/competition-place/${this.$route.params.id}` : '/competitions/create' "
                                class="inner-link"
                            >
                                {{ $t("pages.competition_place") }}
                            </router-link>
                        </li>
                        <li :class="`d-flex align-items-center ${checkActiveLink(`/competitions/arbitration-committees/${this.$route.params.id}`)}`">
                            <div class="form-check me-2 mb-0">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="check5"
                                    :checked="this.competition.steps_numbers && this.competition.steps_numbers.includes(5)"
                                    :disabled="this.competition.steps_numbers && this.competition.steps_numbers.includes(5)"
                                />
                            </div>
                            <router-link
                                :to="this.$route.params.id ? `/competitions/arbitration-committees/${this.$route.params.id}` : '/competitions/create' "
                                class="inner-link"
                            >
                                {{ $t("pages.arbitration_committees") }}
                            </router-link>
                        </li>
                        <li :class="`d-flex align-items-center ${checkActiveLink(`/competitions/honoring-ceremony/${this.$route.params.id}`)}`">
                            <div class="form-check me-2 mb-0">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="check6"
                                    :checked="this.competition.steps_numbers && this.competition.steps_numbers.includes(6)"
                                    :disabled="this.competition.steps_numbers && this.competition.steps_numbers.includes(6)"
                                />
                            </div>
                            <router-link
                                :to="this.$route.params.id ? `/competitions/honoring-ceremony/${this.$route.params.id}` : '/competitions/create' "
                                class="inner-link"
                            >
                                {{ $t("pages.honoring_ceremony") }}
                            </router-link>
                        </li>
                        <li :class="`d-flex align-items-center ${checkActiveLink(`/competitions/competition-prizes/${this.$route.params.id}`)}`">
                            <div class="form-check me-2 mb-0">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="check7"
                                    :checked="this.competition.steps_numbers && this.competition.steps_numbers.includes(7)"
                                    :disabled="this.competition.steps_numbers && this.competition.steps_numbers.includes(7)"
                                />
                            </div>
                            <router-link
                                :to="this.$route.params.id ? `/competitions/competition-prizes/${this.$route.params.id}` : '/competitions/create' "
                                class="inner-link"
                            >
                                {{ $t("pages.competition_prizes") }}
                            </router-link>
                        </li>
                        <li :class="`d-flex align-items-center ${checkActiveLink(`/competitions/standards-conditions/${this.$route.params.id}`)}`">
                            <div class="form-check me-2 mb-0">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="check8"
                                    :checked="this.competition.steps_numbers && this.competition.steps_numbers.includes(8)"
                                    :disabled="this.competition.steps_numbers && this.competition.steps_numbers.includes(8)"
v                                />
                            </div>
                            <router-link
                                :to="this.$route.params.id ? `/competitions/standards-conditions/${this.$route.params.id}` : '/competitions/create' "
                                class="inner-link"
                            >
                                {{ $t("pages.standards_conditions") }}
                            </router-link>
                        </li>
                        <li :class="`d-flex align-items-center ${checkActiveLink(`/competitions/advertising-form/${this.$route.params.id}`)}`">
                            <div class="form-check me-2 mb-0">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="check9"
                                    :checked="this.competition.steps_numbers && this.competition.steps_numbers.includes(9)"
                                    :disabled="this.competition.steps_numbers && this.competition.steps_numbers.includes(9)"
                                />
                            </div>
                            <router-link
                                :to="this.$route.params.id ? `/competitions/advertising-form/${this.$route.params.id}` : '/competitions/create' "
                                class="inner-link"
                            >
                                {{ $t("pages.advertising_form") }}
                            </router-link>
                        </li>
                    </ul>
                </template>
            </card>
        </div>
        <div class="col-lg-9">
            <card>
                <template #body>
                    <component :is="currentStep" :competition="competition"></component>
                    <!--                    <CompetitionBasicForm />-->
                </template>
            </card>
        </div>
    </div>
</template>

<script>
import Card from "@/components/Card.vue";
import CompetitionBasicForm from "@/views/competitions/competitions/competition-forms/CompetitionBasicForm.vue";
import CompetitionLevelIndex from "@views/competitions/competitions/competition-forms/competition-levels/CompetitionLevelIndex.vue";
import CompetitionStageForm from "@views/competitions/competitions/competition-forms/competition-stages/CompetitionStageForm.vue";
import CompetitionPlaceForm from "@views/competitions/competitions/competition-forms/competition-place/CompetitionPlaceForm.vue";
import ArbitrationCommitteeIndex from "@views/competitions/competitions/competition-forms/arbitration-committees/ArbitrationCommitteeIndex.vue";
import HonoringCeremonyForm from "@views/competitions/competitions/competition-forms/honoring-ceremony/HonoringCeremonyForm.vue";
import CompetitionPrizeForm from "@views/competitions/competitions/competition-forms/competition-prizes/CompetitionPrizeForm.vue";
import StandardConditionForm from "@views/competitions/competitions/competition-forms/standards-conditions/StandardConditionForm.vue";
import AdvertisingFormForm from "@views/competitions/competitions/competition-forms/advertising-form/AdvertisingFormForm.vue";
import { ref } from 'vue'
import CompetitionsApi from "@api/competitions.api";

export default {
    data() {
        return {
            id: null,
            competition: {
                id: '',
                name: '',
                competition_type_id: '',
                competition_date: '',
                registration_date: '',
                competitors_max_num: '',
                competition_budget: '',
                age_group: [""],
                age_from: [""],
                age_to: [""],
                stages: [
                    {name: ''}
                ],
                concert_honoring: {
                    competition_id: '',
                    country_id: '',
                    city_id: '',
                    governorate_id: '',
                    date: '',
                    competition_place: '',
                    location: '',
                },
                prize: {
                    competition_levels_names: [],
                    winners_counts: [],
                    winners_rankings: [],
                    financials_awards_values: [],
                    certificates_and_honors: [],
                },
                standard_condition_description: '',
                advertisement_id: '',
                competition_photo_id: '',
                country_id: '',
                governorate_id: '',
                city_id: '',
                competition_address: '',
                location: '',
                is_announced: ref(true),
            },
            currentStep: "",
        };
    },
    components: {
        Card,
        CompetitionBasicForm,
        CompetitionLevelIndex,
        CompetitionStageForm,
        CompetitionPlaceForm,
        ArbitrationCommitteeIndex,
        HonoringCeremonyForm,
        CompetitionPrizeForm,
        StandardConditionForm,
        AdvertisingFormForm,
    },

    methods:{
         getCompetition(){
             CompetitionsApi.get(this.$route.params.id,null,null).then(({ data }) => {
                this.competition = data.data
                // useToast().success(this.$t("messages.success"));
                this.updateStep();
            })
                .catch((error) => {
                    this.formErrors = error.response.data.errors;
                });
         },
        updateStep(){
            let currentRoute = this.$route.name;
            if (currentRoute === "competition-create") {
                this.currentStep = "CompetitionBasicForm";
            } else if (currentRoute === "competition-levels") {
                this.currentStep = "CompetitionLevelIndex";
            } else if (currentRoute === "competition-stages") {
                this.currentStep = "CompetitionStageForm";
            } else if (currentRoute === "competition-place") {
                this.currentStep = "CompetitionPlaceForm";
            } else if (currentRoute === "arbitration-committees") {
                this.currentStep = "ArbitrationCommitteeIndex";
            } else if (currentRoute === "honoring-ceremony") {
                this.currentStep = "HonoringCeremonyForm";
            } else if (currentRoute === "competition-prizes") {
                this.currentStep = "CompetitionPrizeForm";
            } else if (currentRoute === "standards-conditions") {
                this.currentStep = "StandardConditionForm";
            } else if (currentRoute === "advertising-form") {
                this.currentStep = "AdvertisingFormForm";
            }
        },
        checkActiveLink(link){
            let active = null,
                routePath = this.$route.path;
            const regex = /[0-9]+/;
            const containsId = regex.test(link);

            if (!containsId && link.endsWith('/')){
                link = link.slice(0, -1)
            }
            if (!containsId && routePath.endsWith('/')){
                routePath = routePath.slice(0, -1)
            }
            active  = routePath === link ? `active` : ``;
            return active;
        },
    },


    created() {
        if (this.$route.params.id) {
            this.getCompetition(this.$route.params.id)
        }else{
            this.updateStep();
        }
    },


};
</script>
