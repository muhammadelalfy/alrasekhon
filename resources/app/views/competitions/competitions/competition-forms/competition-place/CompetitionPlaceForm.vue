<template>
    <form>
        <div class="row align-items-end">
            <div class="col-md-6">
                <form-select
                    title="pages.country"
                    label="name"
                    name="country_id"
                    @clearErrors="clearInput"
                    :model="this.competition"
                    :myOptions="countries"
                    label-field="name_localized"
                    value-field="id"
                    @change="getGovernorates"
                    :errors="formErrors"
                />
            </div>
            <div class="col-md-6">
                <form-select
                    title="pages.governorate"
                    label="name"
                    name="governorate_id"
                    @clearErrors="clearInput"
                    :model="this.competition"
                    :myOptions="governorates"
                    label-field="name_localized"
                    value-field="id"
                    @change="getCities"
                    :errors="formErrors"
                />
            </div>
            <div class="col-md-6">
                <form-select
                    title="pages.city"
                    label="name"
                    name="city_id"
                    @clearErrors="clearInput"
                    :model="this.competition"
                    :myOptions="cities"
                    label-field="name_localized"
                    value-field="id"
                    :errors="formErrors"
                />
            </div>
            <div class="col-md-6">
                <form-input
                    label="pages.competition_place"
                    type="text"
                    :model="this.competition"
                    name="competition_address"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <div class="col-md-6">
                <form-input
                    label="pages.location"
                    type="text"
                    :model="this.competition"
                    name="location"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
        </div>
        <div class="d-flex align-items-cenetr my-4 justify-content-end">
            <button
                @click="saveAndNext"
                type="button"
                class="btn btn-light-babyblue text-white fw-bold"
            >
                {{ $t("forms.save_next") }}
            </button>
            <button
                @click="addUpdatePlace"
                type="button"
                class="btn btn-babyblue text-white fw-bold mx-2"
            >
                {{ $t("forms.save") }}
            </button>
            <cancel-button />
        </div>
    </form>
</template>

<script>
import CountryApi from "@api/country.api";
import GovernorateApi from "@api/governorate.api";
import CityApi from "@api/city.api";
import CompetitionsApi from "@api/competitions.api";
import { useToast } from "vue-toastification";
import { ref, reactive } from "vue";

export default {
    components: {},
    props: {
        competition: Object,
    },
    data() {
        return {
            countries: [],
            governorates: [],
            cities: [],
            buttonClickedType: "save",
        };
    },

    methods: {
        saveAndNext: function () {
            this.buttonClickedType = "save_and_next";
            this.addUpdatePlace();
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
        getGovernorates() {
            let data = {
                list_all_without_pagination: true, country: this.competition.country_id,
            };
            GovernorateApi.list(data)
                .then(({ data }) => {
                    this.governorates = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getCities() {
            let data = {
                list_all_without_pagination: true, governorate: this.competition.governorate_id,
            };
            CityApi.list(data)
                .then(({ data }) => {
                    this.cities = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        addUpdatePlace() {
            CompetitionsApi.addUpdatePlace(this.competition)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    if (this.buttonClickedType === "save") {
                        this.$router.push({
                            name: "competitions",
                        });
                    }
                    if (this.buttonClickedType === "save_and_next") {
                        this.$router.push({
                            name: "arbitration-committees",
                            params: { id: data.data.id },
                        });
                    }
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
    },

    created() {
        this.getCountries();
        if (this.$route.params.id) {
            this.getGovernorates();
            this.getCities();
        }
    },
};
</script>
