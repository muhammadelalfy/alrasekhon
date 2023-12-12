<template>
    <div>
        <div class="row">
            <div class="col-md-4">
                <form-select
                    title="pages.country"
                    label="name"
                    name="country_id"
                    @clearErrors="clearInput"
                    :model="arbitrator"
                    :myOptions="countries"
                    label-field="name_localized"
                    value-field="id"
                    @change="getGovernorates"
                    :errors="formErrors"
                />
            </div>
            <div class="col-md-4">
                <form-select
                    title="pages.governorate"
                    label="name"
                    name="governorate_id"
                    @clearErrors="clearInput"
                    :model="arbitrator"
                    :myOptions="governorates"
                    label-field="name_localized"
                    value-field="id"
                    @change="getCities"
                    :errors="formErrors"
                />
            </div>
            <div class="col-md-4">
                <form-select
                    title="pages.city"
                    label="name"
                    name="city_id"
                    @clearErrors="clearInput"
                    :model="arbitrator"
                    :myOptions="cities"
                    label-field="name_localized"
                    value-field="id"
                    :errors="formErrors"
                />
            </div>
            <div class="col-md-4">
                <form-text-area
                    id="main-address"
                    label="pages.main_address"
                    :model="arbitrator"
                    name="main_address"
                    :rows="4"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <div class="col-md-4">
                <form-text-area
                    id="alternative-address"
                    label="pages.alternative_address"
                    :model="arbitrator"
                    name="additional_address"
                    :rows="4"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
        </div>
        <div class="d-flex align-items-cenetr pt-4 justify-content-end">
            <button
                @click.prevent="wizardCompleted()"
                type="button"
                class="btn btn-babyblue text-white fw-bold"
            >
                {{ $t("forms.save") }}
            </button>
            <button
                type="button"
                class="btn btn-light text-grayClr fw-bold ms-2"
                @click.prevent="onBackTab(2, 3)"
            >
                {{ $t("pagination.prev") }}
            </button>
        </div>
    </div>
</template>

<script>
import CountryApi from "@api/country.api";
import GovernorateApi from "@api/governorate.api";
import CityApi from "@api/city.api";

export default {
    name: "StepFour",
    data() {
        return {
            countries: [],
            governorates: [],
            cities: [],
            countryFilters: {
                page: 1,
            },
            governorateFilters: {
                page: 1,
            },
            cityFilters: {
                page: 1,
            },
        };
    },
    props: [
        "arbitrator",
        "onNextTab",
        "onBackTab",
        "wizardCompleted",
        "formErrors",
        "clearInput",
    ],
    methods: {
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
                list_all_without_pagination: true, country: this.arbitrator.country_id
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
                list_all_without_pagination: true, governorate: this.arbitrator.governorate_id,
            };
            CityApi.list(data)
                .then(({ data }) => {
                    this.cities = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
    },

    mounted() {
        this.getCountries();
        if (this.$route.params.id && this.arbitrator.governorate_id && this.arbitrator.country_id) {
            this.getGovernorates();
            this.getCities();
        }
    },
};
</script>

<style scoped></style>
