<template #body>
    <form>
        <div class="row align-items-end">
            <div class="col-md-6">
                <form-date-select
                    label="pages.receipt_awards_date"
                    :model="this.concert_honoring"
                    name="date"
                    @clearErrors="date"
                    :errors="formErrors"
                />
            </div>
            <div class="col-md-6">
                <form-select
                    title="pages.country"
                    label="name"
                    name="country_id"
                    @clearErrors="country_id"
                    :model="this.concert_honoring"
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
                    @clearErrors="governorate_id"
                    :model="this.concert_honoring"
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
                    @clearErrors="city_id"
                    :model="this.concert_honoring"
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
                    :model="this.concert_honoring"
                    name="competition_place"
                    :errors="formErrors"
                    @clearErrors="competiton_place"
                />
            </div>
            <div class="col-md-6">
                <form-input
                    label="pages.location"
                    type="text"
                    :model="this.concert_honoring"
                    name="location"
                    :errors="formErrors"
                    @clearErrors="location"
                />
            </div>
        </div>
        <div class="d-flex align-items-cenetr my-4 justify-content-end">
            <button
                type="button"
                class="btn btn-light-babyblue text-white fw-bold"
                @click="saveAndNext"
            >
                {{ $t("forms.save_next") }}
            </button>
            <button
                type="button"
                class="btn btn-babyblue text-white fw-bold mx-2"
                @click="addUpdateConcertHonoring"
            >
                {{ $t("forms.save") }}
            </button>
            <cancel-button />
        </div>
    </form>
</template>

<script>
import Card from "@/components/Card.vue";
import CountryApi from "@api/country.api";
import GovernorateApi from "@api/governorate.api";
import CityApi from "@api/city.api";
import { useToast } from "vue-toastification";
import CompetitionsApi from "@api/competitions.api";

export default {
    components: {
        Card,
    },
    props: {
        competition: Object,
    },
    data() {
        return {
            countries: [],
            governorates: [],
            cities: [],
            concert_honoring: {
                competition_id: this.$route.params.id,
                country_id: "",
                city_id: "",
                governorate_id: "",
                date: "",
                competition_place: "",
                location: "",
            },

            // concert_honoring: {
            //     competition_id: this.$route.params.id,
            //     country_id: "",
            //     governorate_id: "",
            //     location: "",
            //     date: "",
            //     competition_place: "",
            //     city_id: ""
            // },
            // competition: {},
            buttonClickedType: "save",
        };
    },

    methods: {
        saveAndNext: function () {
            this.buttonClickedType = "save_and_next";
            this.addUpdateConcertHonoring();
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
                country: this.concert_honoring.country_id,
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
            let data = {
                governorate: this.concert_honoring.governorate_id,
            };
            CityApi.list(data)
                .then(({ data }) => {
                    this.cities = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        clearForm() {
            this.clearErrors();
            this.resetForm(this.concert_honoring);
        },
        addUpdateConcertHonoring() {
            CompetitionsApi.addUpdateConcertHonoring(this.concert_honoring)
                .then(({ data }) => {
                    console.log(data);
                    useToast().success(this.$t("messages.success"));
                    if (this.buttonClickedType === "save") {
                        this.$router.push({
                            name: "honoring-ceremony",
                        });
                    }
                    if (this.buttonClickedType === "save_and_next") {
                        this.$router.push({
                            name: "competition-prizes",
                            params: { id: this.$route.params.id },
                        });
                    }
                })
                .catch((error) => {
                    console.log(error);
                    // this.formErrors = error.response.data.errors;
                });
        },
    },

    mounted() {
        this.getCountries();
        if (this.$route.params.id) {
            this.concert_honoring = this.competition.concert_honoring
                ? this.competition.concert_honoring
                : this.concert_honoring;
            console.log(this.concert_honoring);
        }
        if (this.$route.params.id && this.concert_honoring.country_id) {
            this.getGovernorates();
        }
        if (this.$route.params.id && this.concert_honoring.governorate_id) {
            this.getCities();
        }
    },
};
</script>
