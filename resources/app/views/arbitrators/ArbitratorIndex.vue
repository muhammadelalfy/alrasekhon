<template>
    <div id="formFilter" class="collapse multi-collapse">
        <card>
            <template #body>
                <filters @submit="getArbitrators" :model="filters">
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
                            valueField="id"
                            labelField="name_localized"
                            :errors="formErrors"
                        />
                    </div>
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
                            valueField="id"
                            labelField="name_localized"
                            :errors="formErrors"
                            @change="getGovernorates"
                        />
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <form-select
                            title="pages.governorate"
                            label="name"
                            name="governorate"
                            multiple
                            collapse-tags
                            collapse-tags-tooltip
                            @clearErrors="clearInput"
                            :model="filters"
                            :myOptions="governorates"
                            valueField="id"
                            labelField="name_localized"
                            :errors="formErrors"
                        />
                    </div>
                    <!--                    <div class="col-md-4 col-lg-3">-->
                    <!--                        <form-select-->
                    <!--                            title="pages.competition"-->
                    <!--                            label="name"-->
                    <!--                            name="competition"-->
                    <!--                            multiple-->
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

    <Card class="pt-3">
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
                        <th>{{ $t("pages.status") }}</th>
                        <th>{{ $t("global.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(arbitrator, index) in this.arbitrators"
                        :key="index"
                    >
                        <td>{{ index + 1 }}</td>
                        <td>{{ arbitrator.full_name }}</td>
                        <td>{{ arbitrator.levles }}</td>
                        <td>{{ arbitrator.email }}</td>
                        <td>{{ arbitrator.phone }}</td>
                        <td>{{ arbitrator.country }}</td>
                        <td>{{ arbitrator.governorate }}</td>
                        <td>
                            <form-switcher
                                id="status"
                                :model="arbitrator"
                                name="status"
                                :errors="formErrors"
                                @clearErrors="clearInput"
                                @toggle="toggle(arbitrator)"
                            >
                            </form-switcher>
                        </td>
                        <td>
                            <div class="btn-list d-inline-flex">
                                <router-link
                                    :to="{
                                        name: 'arbitrator-show',
                                        params: { id: arbitrator.id },
                                    }"
                                    class="btn btn-light-babyblue text-white me-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    :title="$t('forms.view')"
                                >
                                    <font-awesome-icon icon="fa-solid fa-eye" />
                                </router-link>
                                <router-link
                                    :to="`/arbitrators/edit/${arbitrator.id}`"
                                    class="btn btn-light-secondary text-white me-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    :title="$t('forms.edit')"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-pen-to-square"
                                    />
                                </router-link>
                                <delete-button
                                    v-if="hasPermission('delete', 'Arbitrator')"
                                    @del-model="
                                        delArbitrator(arbitrator, index)
                                    "
                                />
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
import { ref } from "vue";
import { useI18n } from "vue-i18n";
import ArbitratorsApi from "@api/arbitrators.api";
import ArbitratorLevelsApi from "@api/arbitrator-levels.api";
import CityApi from "@api/city.api";
import CountryApi from "@api/country.api";
import GovernorateApi from "@api/governorate.api";
import { useToast } from "vue-toastification";

export default {
    components: {
        Card,
    },
    data() {
        const { t } = useI18n();
        return {
            arbitrators: [],
            levels: [],
            countries: [],
            governorates: [],
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
            statusAction: {
                status: false,
            },
            filters: {
                page: 1,
            },
        };
    },

    methods: {
        getArbitrators(page = 1) {
            this.filters.page = page;
            ArbitratorsApi.list(this.filters)
                .then(({ data }) => {
                    this.arbitrators = data.data;
                    this.pagination = data.meta;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getArbitratorLevels() {
            let requestData = {list_all_without_pagination: true}
            ArbitratorLevelsApi.list(requestData)
                .then(({ data }) => {
                    this.levels = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getCountries() {
            let requestData = {list_all_without_pagination: true}
            CountryApi.list(requestData)
                .then(({ data }) => {
                    this.countries = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getGovernorates() {
            let data = {
                list_all_without_pagination: true, country: this.filters.country
            };
            GovernorateApi.list(data)
                .then(({ data }) => {
                    this.governorates = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        delArbitrator(arbitrator, index) {
            ArbitratorsApi.delete(arbitrator).then((resp) => {
                this.arbitrators.splice(index, 1);
                useToast().success(resp.data.message);
            });
        },
        toggle(arbitrator = {}) {
            ArbitratorsApi.changeStatus(arbitrator).then((resp) => {
                useToast().success(resp.data.message);
            });
        },
    },

    mounted() {
        this.getArbitrators();
        this.getArbitratorLevels();
        this.getCountries();
    },
};
</script>
