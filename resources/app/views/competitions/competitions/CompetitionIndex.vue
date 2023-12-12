<template>
    <div class="card-body px-0">
        <div class="row align-items-end justify-content-between mx-0 px-3">
            <div class="col-md-10 p-0">
                <div class="d-flex align-items-center">
                    <font-awesome-icon
                        icon="fa-solid fa-filter"
                        class="text-grayClr me-3 fs-3"
                    />
                    <form-select
                        title="pages.choose_field"
                        label="name"
                        name="field"
                        multiple
                        collapse-tags
                        collapse-tags-tooltip
                        @clearErrors="clearInput"
                        :model="filterForm"
                        :myOptions="filterForm.fieldOptions"
                        :errors="formErrors"
                    />
                </div>
            </div>
            <div class="col-md-2 d-flex justify-content-end p-0">
                <router-link
                    to="/competitions/create"
                    class="btn ripple btn-babyblue text-white mb-3"
                >
                    <font-awesome-icon icon="fa-solid fa-plus" class="me-1" />
                    {{ $t("pages.add_competition") }}
                </router-link>
            </div>
        </div>

        <div class="px-3" v-if="filterForm.field.length > 0">
            <form class="row align-items-end">
                <div
                    class="col-md-4 col-lg-3"
                    v-if="filterForm.field.indexOf('competition') !== -1"
                >
                    <form-select
                        title="pages.competition"
                        label="name"
                        name="competition_ids"
                        multiple
                        collapse-tags
                        collapse-tags-tooltip
                        @clearErrors="clearInput"
                        :model="this.competition"
                        :myOptions="this.competitionsForFilter"
                        label-field="name"
                        value-field="id"
                        :errors="formErrors"
                    />
                </div>
                <div
                    class="col-md-4 col-lg-3"
                    v-if="filterForm.field.indexOf('concertPlace') !== -1"
                >
                    <form-input
                        label="pages.concert_place"
                        type="text"
                        name="concert_honoring"
                        :model="this.competition"
                        @clearErrors="clearInput"
                        :errors="formErrors"
                    />
                </div>
                <!--                <div-->
                <!--                    class="col-md-4 col-lg-3"-->
                <!--                    v-if="filterForm.field.indexOf('sponsors') !== -1"-->
                <!--                >-->
                <!--                    <form-select-->
                <!--                        title="pages.sponsors"-->
                <!--                        label="name"-->
                <!--                        name="sponsors"-->
                <!--                        multiple-->
                <!--                        collapse-tags-->
                <!--                        collapse-tags-tooltip-->
                <!--                        @clearErrors="clearInput"-->
                <!--                        :model="filterForm"-->
                <!--                        :myOptions="filterForm.sponsorsOptions"-->
                <!--                        :errors="formErrors"-->
                <!--                    />-->
                <!--                </div>-->
                <!--                <div-->
                <!--                    class="col-md-4 col-lg-3"-->
                <!--                    v-if="filterForm.field.indexOf('supportingEntities') !== -1"-->
                <!--                >-->
                <!--                    <form-select-->
                <!--                        title="pages.supporting_entities"-->
                <!--                        label="name"-->
                <!--                        name="supportingEntities"-->
                <!--                        multiple-->
                <!--                        collapse-tags-->
                <!--                        collapse-tags-tooltip-->
                <!--                        @clearErrors="clearInput"-->
                <!--                        :model="filterForm"-->
                <!--                        :myOptions="filterForm.supportingEntitiesOptions"-->
                <!--                        :errors="formErrors"-->
                <!--                    />-->
                <!--                </div>-->
                <div
                    class="col-md-4 col-lg-3"
                    v-if="filterForm.field.indexOf('level') !== -1"
                >
                    <form-select
                        title="pages.level"
                        label="name"
                        name="competition_level_ids"
                        multiple
                        collapse-tags
                        collapse-tags-tooltip
                        @clearErrors="clearInput"
                        :model="this.competition"
                        :myOptions="this.competitionLevels"
                        label-field="name_localized"
                        value-field="id"
                        :errors="formErrors"
                    />
                </div>
                <div
                    class="col-md-4 col-lg-3"
                    v-if="filterForm.field.indexOf('type') !== -1"
                >
                    <form-select
                        title="pages.type"
                        label="name"
                        name="competition_type_ids"
                        multiple
                        collapse-tags
                        collapse-tags-tooltip
                        @clearErrors="clearInput"
                        :model="this.competition"
                        :myOptions="competitionTypes"
                        label-field="name_localized"
                        value-field="id"
                        :errors="formErrors"
                    />
                </div>
                <div
                    class="col-md-4 col-lg-3"
                    v-if="filterForm.field.indexOf('country') !== -1"
                >
                    <form-select
                        title="pages.country"
                        label="name"
                        name="country_id"
                        collapse-tags
                        collapse-tags-tooltip
                        @clearErrors="clearInput"
                        :model="this.competition"
                        :myOptions="countries"
                        label-field="name_localized"
                        value-field="id"
                        :errors="formErrors"
                        @change="getGovernorates"
                    />
                </div>
                <div
                    class="col-md-4 col-lg-3"
                    v-if="filterForm.field.indexOf('governorate') !== -1"
                >
                    <form-select
                        title="pages.governorate"
                        label="name"
                        name="governorate_ids"
                        multiple
                        collapse-tags
                        collapse-tags-tooltip
                        @clearErrors="clearInput"
                        :model="this.competition"
                        :myOptions="governorates"
                        label-field="name_localized"
                        value-field="id"
                        :errors="formErrors"
                        @change="getCities"
                    />
                </div>
                <div
                    class="col-md-4 col-lg-3"
                    v-if="filterForm.field.indexOf('city') !== -1"
                >
                    <form-select
                        title="pages.city"
                        label="name"
                        name="city_ids"
                        multiple
                        collapse-tags
                        collapse-tags-tooltip
                        @clearErrors="clearInput"
                        :model="this.competition"
                        :myOptions="cities"
                        label-field="name_localized"
                        value-field="id"
                        :errors="formErrors"
                    />
                </div>
                <div
                    class="col-md-4 col-lg-3"
                    v-if="filterForm.field.indexOf('competitionPlace') !== -1"
                >
                    <form-input
                        label="pages.competition_place"
                        type="text"
                        name="competition_place"
                        :model="this.competition"
                        @clearErrors="clearInput"
                        :errors="formErrors"
                    />
                </div>
                <div
                    class="col-md-4 col-lg-3"
                    v-if="filterForm.field.indexOf('status') !== -1"
                >
                    <form-select
                        title="pages.status"
                        label="name"
                        name="status"
                        collapse-tags
                        collapse-tags-tooltip
                        @clearErrors="clearInput"
                        :model="this.competition"
                        :myOptions="filterForm.statusOptions"
                        label-field="label"
                        value-field="value"
                        :errors="formErrors"
                    />
                </div>
                <div
                    class="col-md-4 col-lg-3"
                    v-if="filterForm.field.indexOf('competitionDate') !== -1"
                >
                    <form-date-select
                        label="pages.competition_date"
                        :model="this.competition"
                        type="daterange"
                        name="competition_start_date"
                        :range-separator="$t('pages.to')"
                        :start-placeholder="$t('pages.start_date')"
                        :end-placeholder="$t('pages.end_date')"
                        :errors="formErrors"
                    />
                </div>
                <div
                    class="col-md-4 col-lg-3"
                    v-if="filterForm.field.indexOf('competitionEnd') !== -1"
                >
                    <form-date-select
                        label="pages.competition_end"
                        :model="this.competition"
                        type="daterange"
                        name="competition_end_date"
                        :range-separator="$t('pages.to')"
                        :start-placeholder="$t('pages.start_date')"
                        :end-placeholder="$t('pages.end_date')"
                        :errors="formErrors"
                    />
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="mb-3">
                        <button
                            @click="getCompetitions"
                            type="button"
                            class="btn ripple btn-babyblue text-white"
                        >
                            {{ $t("global.search") }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="pt-3">
            <DataTable>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ $t("pages.competition_name") }}</th>
                        <th>{{ $t("pages.competition_type") }}</th>
                        <th>{{ $t("pages.start_date") }}</th>
                        <th>{{ $t("pages.end_date") }}</th>
                        <th>{{ $t("pages.age_group") }}</th>
                        <th>{{ $t("pages.address") }}</th>
                        <th>{{ $t("pages.country") }}</th>
                        <th>{{ $t("pages.governorate") }}</th>
                        <th>{{ $t("pages.city") }}</th>
                        <th>{{ $t("pages.status") }}</th>
                        <th>{{ $t("global.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(competition, index) in this.competitions">
                        <td>{{ index + 1 }}</td>
                        <td>
                            <router-link
                                :to="{
                                    name: 'competition-show',
                                    params: { id: competition.id },
                                }"
                                class="text-info text-underline"
                            >
                                {{ competition.name }}
                            </router-link>
                        </td>
                        <td>{{ competition.competition_type_name }}</td>
                        <td>{{ competition.competition_start_date }}</td>
                        <td>{{ competition.competition_end_date }}</td>

                        <td class="d-flex flex-column align-items-center">
                            <span
                                class="border-bottom"
                                v-for="(
                                    ageGroup, ageIndex
                                ) in competition.ageGroups"
                                :key="ageIndex"
                                >{{ ageGroup }}</span
                            >
                        </td>
                        <td>{{ competition.competition_address }}</td>
                        <td>{{ competition.country }}</td>
                        <td>{{ competition.governorate }}</td>
                        <td>{{ competition.city }}</td>
                        <td>
                            <form-switcher
                                id="status"
                                :model="competition"
                                name="status"
                                :errors="formErrors"
                                @clearErrors="clearInput"
                                @toggle="toggle(competition)"
                            >
                            </form-switcher>
                        </td>
                        <td>
                            <div class="btn-list d-inline-flex">
                                <router-link
                                    :to="{
                                        name: 'competition-create',
                                        params: { id: competition.id },
                                    }"
                                    class="btn btn-light-secondary text-white me-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    :title="$t('forms.edit')"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-pen-to-square"
                                    />
                                </router-link>

                                <div class="dropdown me-1">
                                    <button
                                        class="btn btn-light-babyblue text-white dropdown-toggle"
                                        type="button"
                                        id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                    >
                                        <div
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            :title="$t('forms.quick_add')"
                                        >
                                            <font-awesome-icon
                                                icon="fa-solid fa-file-circle-plus"
                                            />
                                        </div>
                                    </button>
                                    <ul
                                        class="dropdown-menu"
                                        aria-labelledby="dropdownMenuButton1"
                                    >
                                        <li>
                                            <router-link
                                                :to="`/competitions/competition-levels/${competition.id}`"
                                                class="dropdown-item"
                                            >
                                                {{
                                                    $t(
                                                        "pages.competition_levels"
                                                    )
                                                }}
                                            </router-link>
                                        </li>
                                        <li>
                                            <router-link
                                                :to="`/competitions/competition-stages/${competition.id}`"
                                                class="dropdown-item"
                                            >
                                                {{
                                                    $t(
                                                        "sidebar.competition_stages"
                                                    )
                                                }}
                                            </router-link>
                                        </li>
                                        <li>
                                            <router-link
                                                :to="`/competitions/competition-place/${competition.id}`"
                                                class="dropdown-item"
                                            >
                                                {{
                                                    $t(
                                                        "pages.competition_place"
                                                    )
                                                }}
                                            </router-link>
                                        </li>
                                        <li>
                                            <router-link
                                                :to="`/competitions/arbitration-committees/${competition.id}`"
                                                class="dropdown-item"
                                            >
                                                {{
                                                    $t(
                                                        "pages.arbitration_committees"
                                                    )
                                                }}
                                            </router-link>
                                        </li>
                                        <li>
                                            <router-link
                                                :to="`/competitions/honoring-ceremony/${competition.id}`"
                                                class="dropdown-item"
                                            >
                                                {{
                                                    $t(
                                                        "pages.honoring_ceremony"
                                                    )
                                                }}
                                            </router-link>
                                        </li>
                                        <li>
                                            <router-link
                                                :to="`/competitions/competition-prizes/${competition.id}`"
                                                class="dropdown-item"
                                            >
                                                {{
                                                    $t(
                                                        "pages.competition_prizes"
                                                    )
                                                }}
                                            </router-link>
                                        </li>
                                        <li>
                                            <router-link
                                                :to="`/competitions/standards-conditions/${competition.id}`"
                                                class="dropdown-item"
                                            >
                                                {{
                                                    $t(
                                                        "pages.standards_conditions"
                                                    )
                                                }}
                                            </router-link>
                                        </li>
                                        <li>
                                            <router-link
                                                :to="`/competitions/advertising-form/${competition.id}`"
                                                class="dropdown-item"
                                            >
                                                {{
                                                    $t("pages.advertising_form")
                                                }}
                                            </router-link>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </DataTable>
        </div>
    </div>
</template>

<script>
import Card from "@/components/Card.vue";
import { reactive } from "vue";
import { useI18n } from "vue-i18n";
import { useToast } from "vue-toastification";
import CompetitionsApi from "@api/competitions.api";
import CountryApi from "@api/country.api";
import CompetitionLevelsApi from "@api/competition-levels.api";
import CompetitionTypesApi from "@api/competition-types.api";
import GovernorateApi from "@api/governorate.api";
import CityApi from "@api/city.api";

export default {
    name: "CompetitionIndex",
    components: {
        Card,
    },
    setup() {
        const { t } = useI18n();
        const filterForm = reactive({
            field: [],
            fieldOptions: [
                {
                    value: "competition",
                    label: t("pages.competition"),
                },
                {
                    value: "concertPlace",
                    label: t("pages.concert_place"),
                },
                // {
                //     value: "sponsors",
                //     label: t("pages.sponsors"),
                // },
                // {
                //     value: "supportingEntities",
                //     label: t("pages.supporting_entities"),
                // },
                {
                    value: "level",
                    label: t("pages.level"),
                },
                {
                    value: "type",
                    label: t("pages.type"),
                },
                {
                    value: "country",
                    label: t("pages.country"),
                },
                {
                    value: "governorate",
                    label: t("pages.governorate"),
                },
                {
                    value: "city",
                    label: t("pages.city"),
                },
                {
                    value: "competitionPlace",
                    label: t("pages.competition_place"),
                },
                {
                    value: "status",
                    label: t("pages.status"),
                },
                {
                    value: "competitionDate",
                    label: t("pages.competition_date"),
                },
                {
                    value: "competitionEnd",
                    label: t("pages.competition_end"),
                },
            ],
            sponsorsOptions: [
                {
                    value: "sponsor1",
                    label: "الراعي 1",
                },
                {
                    value: "sponsor2",
                    label: "الراعي 2",
                },
            ],
            supportingEntitiesOptions: [
                {
                    value: "entity1",
                    label: "جهة 1",
                },
                {
                    value: "entity2",
                    label: "جهة 2",
                },
            ],
            statusOptions: [
                {
                    value: "",
                    label: t("pages.all"),
                },
                {
                    value: "draft",
                    label: t("forms.draft_comp"),
                },
                {
                    value: "announced",
                    label: t("forms.announced_comp"),
                },
                {
                    value: "in_progress",
                    label: t("forms.in_progress_comp"),
                },
                {
                    value: "finished",
                    label: t("forms.finished_comp"),
                },
            ],
        });
        return {
            t,
            filterForm,
        };
    },
    data() {
        return {
            competition: {
                page: 1,
                competition_ids: [],
                concert_honoring: "",
                competition_level_ids: [],
                competition_type_ids: [],
                country_id: [],
                governorate_ids: [],
                city_ids: [],
                competition_place: "",
                status: "",
                competition_start_date: [],
                competition_end_date: [],
            },
            competitions: [],
            competitionsForFilter: [],
            concertHonoring: [],
            competitionLevels: [],
            competitionTypes: [],
            countries: [],
            governorates: [],
            cities: [],
            statusAction: {
                status: false,
            },
            filters: {
                page: 1,
            },
            pagination: {},
        };
    },

    methods: {
        getCompetitions() {
            CompetitionsApi.list(this.competition)
                .then(({ data }) => {
                    this.competitions = data.data;
                    this.pagination = data.meta;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getCompetitionsForFilter() {
            let requestData = {
                get_for_filter: true,
            };
            CompetitionsApi.list(requestData)
                .then(({ data }) => {
                    this.competitionsForFilter = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },

        getCompetitionLevels() {
            CompetitionLevelsApi.list()
                .then(({ data }) => {
                    this.competitionLevels = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getCompetitionTypes() {
            CompetitionTypesApi.list()
                .then(({ data }) => {
                    this.competitionTypes = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getCountries() {
            CountryApi.list()
                .then(({ data }) => {
                    this.countries = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getGovernorates() {
            let requestData = {
                country: this.competition.country_id,
            };
            GovernorateApi.list(requestData)
                .then(({ data }) => {
                    this.governorates = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getCities() {
            let requestData = {
                governorate: this.competition.governorate_ids,
            };
            CityApi.list(requestData)
                .then(({ data }) => {
                    this.cities = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },

        toggle(competition = {}) {
            CompetitionsApi.changeStatus(competition).then((resp) => {
                useToast().success(resp.data.message);
            });
        },
    },
    mounted() {
        this.getCompetitions();
        this.getCountries();
        this.getCompetitionLevels();
        this.getCompetitionsForFilter();
        this.getCompetitionTypes();
    },
};
</script>
