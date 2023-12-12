<template>
    <div id="formFilter" class="collapse multi-collapse">
        <card>
            <template #body>
                <filters @submit="getContestants" :model="filters">
                    <div class="col-md-4 col-lg-3">
                        <form-select
                            title="pages.level"
                            label="name"
                            name="level"
                            multiple
                            collapse-tags
                            collapse-tags-tooltip
                            @clearErrors="clearInput"
                            :model="filters"
                            :myOptions="levels"
                            :errors="formErrors"
                            valueField="id"
                            labelField="name_localized"
                        />
                    </div>
                    <!--                    <div class="col-md-4 col-lg-3">-->
                    <!--                        <form-select-->
                    <!--                            title="pages.competition"-->
                    <!--                            label="name"-->
                    <!--                            name="competition"-->
                    <!--                            collapse-tags-->
                    <!--                            collapse-tags-tooltip-->
                    <!--                            @clearErrors="clearInput"-->
                    <!--                            :model="filters"-->
                    <!--                            :myOptions="competitionOptions"-->
                    <!--                            :errors="formErrors"-->
                    <!--                        />-->
                    <!--                    </div>-->
                    <div class="col-md-4 col-lg-3">
                        <form-select
                            title="pages.country"
                            label="name"
                            name="country"
                            multiple
                            collapse-tags
                            collapse-tags-tooltip
                            @clearErrors="clearInput"
                            :model="filters"
                            :myOptions="countries"
                            :errors="formErrors"
                            valueField="id"
                            labelField="name_localized"
                            @change="getCities"
                        />
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <form-select
                            title="pages.city"
                            label="name"
                            name="city"
                            multiple
                            collapse-tags
                            collapse-tags-tooltip
                            @clearErrors="clearInput"
                            :model="filters"
                            :myOptions="cities"
                            :errors="formErrors"
                            valueField="id"
                            labelField="name_localized"
                        />
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <form-select
                            title="pages.status"
                            label="name"
                            name="status"
                            @clearErrors="clearInput"
                            :model="filters"
                            :myOptions="statusOptions"
                            :errors="formErrors"
                        />
                    </div>
                </filters>
            </template>
        </card>
    </div>

    <Card class="pt-3" v-if="contestants.length">
        <template #default>
            <DataTable>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ $t("pages.name") }}</th>
                        <th>{{ $t("pages.level") }}</th>
                        <th>{{ $t("pages.email") }}</th>
                        <th>{{ $t("pages.phone") }}</th>
                        <th>{{ $t("pages.country") }}</th>
                        <th>{{ $t("pages.governorate") }}</th>
                        <th>{{ $t("pages.city") }}</th>
                        <th>{{ $t("pages.status") }}</th>
                        <th>{{ $t("global.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(contestant, index) in contestants">
                        <td>{{ index + 1 }}</td>
                        <td>
                            {{
                                contestant.first_name +
                                " " +
                                contestant.second_name +
                                " " +
                                contestant.last_name
                            }}
                        </td>
                        <td>{{ contestant.levels }}</td>
                        <td>{{ contestant.email }}</td>
                        <td>{{ contestant.phone }}</td>
                        <td>{{ contestant.country }}</td>
                        <td>{{ contestant.governorate }}</td>
                        <td>{{ contestant.city }}</td>
                        <td>
                            <form-switcher
                                id="status"
                                :model="contestant"
                                name="status"
                                :errors="formErrors"
                                @clearErrors="clearInput"
                                @toggle="toggle(contestant)"
                            >
                            </form-switcher>
                        </td>
                        <td>
                            <div class="btn-list d-inline-flex">
                                <router-link
                                    :to="{
                                        name: 'contestant-show',
                                        params: { id: contestant.id },
                                    }"
                                    class="btn btn-light-babyblue text-white me-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    :title="$t('forms.view')"
                                >
                                    <font-awesome-icon icon="fa-solid fa-eye" />
                                </router-link>
                                <router-link
                                    :to="`/contestants/edit/${contestant.id}`"
                                    class="btn btn-light-secondary text-white me-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    :title="$t('forms.edit')"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-pen-to-square"
                                    />
                                </router-link>
                                <!-- <delete-button /> -->
                            </div>
                        </td>
                    </tr>
                </tbody>
            </DataTable>
        </template>
    </Card>
</template>

<script>
import Card from "@/components/Card.vue";
import ContestantForm from "@views/contestants/ContestantForm.vue";
import ContestantView from "@views/contestants/ContestantView.vue";
import { useI18n } from "vue-i18n";
import ContestantsApi from "@api/contestants.api";
import CountryApi from "@api/country.api";
import CityApi from "@api/city.api";
import ContestantLevelsApi from "@api/contestant-levels.api";
import { useToast } from "vue-toastification";
import { ref } from "vue";

export default {
    components: {
        ContestantView,
        ContestantForm,
        Card,
    },

    setup() {},

    data() {
        const { t } = useI18n();
        return {
            statusAction: {
                status: false,
            },
            filters: {
                page: 1,
            },
            contestants: [],
            levels: [],
            countries: [],
            cities: [],
            statusOptions: [
                {
                    value: "",
                    label: t("pages.all"),
                },
                {
                    value: "1",
                    label: t("pages.active"),
                },
                {
                    value: "0",
                    label: t("pages.notActive"),
                },
            ],
            competitions: [
                {
                    value: "competition1",
                    label: "مسابقة 1",
                },
                {
                    value: "competition2",
                    label: "مسابقة 2",
                },
                {
                    value: "competition3",
                    label: "مسابقة 3",
                },
            ],
        };
    },

    methods: {
        getContestants(page = 1) {
            this.filters.page = page;
            ContestantsApi.list(this.filters)
                .then(({ data }) => {
                    this.contestants = data.data;
                    this.pagination = data.meta;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getlevels() {
            ContestantLevelsApi.list()
                .then(({ data }) => {
                    this.levels = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getCountries() {
            let requestData = {
                list_all_without_pagination: true
            }
            CountryApi.list(requestData)
                .then(({ data }) => {
                    this.countries = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getCities() {
            // Set country id to use it in check user country selection
            this.country_id = this.filters.country;
            let data = { country: this.filters.country };
            CityApi.list(data)
                .then(({ data }) => {
                    this.cities = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        toggle(contestantObj = {}) {
            ContestantsApi.changeStatus(contestantObj).then((resp) => {
                useToast().success(resp.data.message);
            });
        },
    },

    mounted() {
        this.getContestants();
        this.getlevels();
        this.getCountries();
    },
};
</script>
