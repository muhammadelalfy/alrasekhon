<template>
    <div class="card-body px-0">
        <div
            class="d-flex flex-wrap align-items-center justify-content-end px-3"
        >
            <div
                data-bs-toggle="tooltip"
                data-bs-placement="bottom"
                :title="$t('forms.filter')"
            >
                <button
                    type="button"
                    class="btn btn-grayClr text-white me-1"
                    data-bs-toggle="collapse"
                    data-bs-target="#formCities"
                    aria-expanded="false"
                    aria-controls="formCities"
                >
                    <font-awesome-icon icon="fa-solid fa-filter" />
                </button>
            </div>
            <button
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#addCityModal"
                class="btn ripple btn-babyblue text-white"
                @click="isAddCity = true"
            >
                <font-awesome-icon icon="fa-solid fa-plus" class="me-1" />
                {{ $t("pages.add_city") }}
            </button>
        </div>

        <div id="formCities" class="collapse multi-collapse px-3">
            <filters @submit="getCities" :model="filtersCities">
                <div class="col-md-4 col-lg-3">
                    <form-select
                        title="pages.country"
                        label="name"
                        name="country"
                        collapse-tags
                        collapse-tags-tooltip
                        @clearErrors="clearInput"
                        :model="filtersCities"
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
                        collapse-tags
                        collapse-tags-tooltip
                        :model="filtersCities"
                        :myOptions="governorates"
                        valueField="id"
                        labelField="name_localized"
                    />
                </div>
            </filters>
        </div>

        <div class="pt-3" v-if="cities.length">
            <DataTable id="city-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ $t("pages.city") }}</th>
                        <th>{{ $t("pages.country") }}</th>
                        <th>{{ $t("pages.governorate") }}</th>
                        <th>{{ $t("pages.last_update") }}</th>
                        <th>{{ $t("pages.status") }}</th>
                        <th>{{ $t("global.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(city, index) in cities">
                        <td>{{ index + 1 }}</td>
                        <td>{{ city.name_localized }}</td>
                        <td>{{ city.country_name_localized }}</td>
                        <td>{{ city.governorate_name_localized }}</td>
                        <td>{{ city.updated_at }}</td>
                        <td>
                            <form-switcher
                                id="status"
                                :model="city"
                                name="status"
                                :errors="formErrors"
                                @clearErrors="clearInput"
                                @toggle="toggle(city)"
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
                                        data-bs-target="#addCityModal"
                                        @click="
                                            isAddCity = false;
                                            groupForm(city);
                                            hidden = true;
                                        "
                                        v-if="hasPermission('update', 'City')"
                                    >
                                        <font-awesome-icon
                                            icon="fa-solid fa-pen-to-square"
                                        />
                                    </button>
                                </div>

                                <delete-button
                                    v-if="hasPermission('delete', 'City')"
                                    @del-model="delCity(city, index)"
                                />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </DataTable>
        </div>
    </div>

    <!-- Modal -->
    <CityForm
        :city="city"
        :showButton="false"
        :title="isAddCity ? $t('pages.add_city') : $t('pages.edit_city')"
        id="addCityModal"
        aria-labelledby="addCityModalLabel"
        :modal-dialog-centered="true"
        :modal-lg="true"
    />
</template>

<script>
import Card from "@/components/Card.vue";
import CityForm from "@/views/settings/location/cities/CityForm.vue";
import { ref, reactive } from "vue";
import { useToast } from "vue-toastification";
import CityApi from "@api/city.api";
import GovernorateApi from "@api/governorate.api";
import CountryApi from "@api/country.api";

export default {
    name: "CityIndex",
    components: {
        Card,
        CityForm,
    },
    setup() {
        const city = ref({
            name: {
                ar: "",
                en: "",
            },
            governorate_id: "",
            country_id: "",
            rows: [],
        });
        const isAddCity = ref(true);
        const hidden = ref(false);
        const cityNewForm = reactive({
            rows: [],
        });

        return {
            isAddCity,
            hidden,
            cityNewForm,
            city,
        };
    },
    data() {
        return {
            statusAction: {
                status: false,
            },
            filtersCities: {
                page: 1,
            },
            countries: [],
            governorates: [],
            cities: {},
            country_id: null,
        };
    },
    methods: {
        getCities(page = 1) {
            this.filtersCities.page = page;
            CityApi.list(this.filtersCities)
                .then(({ data }) => {
                    this.cities = data.data;
                    this.pagination = data.meta;

                    // Check if user select different country or not
                    if (
                        this.filtersCities.country &&
                        this.filtersCities.country !== this.country_id
                    ) {
                        this.getGovernorates();
                    }
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },

        getGovernorates() {
            // Set country id to use it in check user country selection
            this.country_id = this.filtersCities.country;
            let data = { country: this.filtersCities.country };
            GovernorateApi.list(data)
                .then(({ data }) => {
                    this.governorates = data.data;
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
        groupForm(city = {}) {
            console.log(city);
            if (city.id) {
                this.title = "pages.edit_country";
                this.city = _.cloneDeep(city);
            } else {
                this.title = "pages.add_country";
            }
            $("#addCityModal").modal("show");
        },
        clearForm() {
            this.clearErrors();
        },

        toggle(cityObj = {}) {
            CityApi.changeStatus(cityObj).then((resp) => {
                useToast().success(resp.data.message);
            });
        },
    },

    created() {
        this.getCities();
        this.getCountries();
        // this.getGovernorates();
    },
};
</script>
