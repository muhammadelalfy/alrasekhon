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
        <form-select
            title="pages.country"
            label="name"
            name="country_id"
            @change="clearInput('country_id');getGovernorates(this.city.country_id)"
            :model="city"
            :myOptions="this.countries"
            :errors="formErrors"
            label-field="name_localized"
            value-field="id"
        />
        <form-select
            title="pages.governorate"
            label="name"
            name="governorate_id"
            @change="clearInput('governorate_id')"
            @clearErrors="formErrors"
            :model="this.city"
            :myOptions="this.governoratesEdit"
            :errors="formErrors"
            label-field="name_localized"
            value-field="id"
        />
        <hr class="mt-2"/>
        <div class="row align-items-end">
            <div class="col-12 col-md-5">
                <form-input
                    label="pages.city_ar"
                    type="text"
                    :model="this.city.name"
                    name="ar"
                    :errors="formErrors"
                    error_key="name.ar"
                    @clearErrors="clearInput('name.ar')"
                />
            </div>
            <div class="col-9 col-md-5">
                <form-input
                    label="pages.city_en"
                    type="text"
                    :model="this.city.name"
                    name="en"
                    :errors="formErrors"
                    error_key="name.en"
                    @clearErrors="clearInput('name.en')"
                />
            </div>
            <div class="col-3 col-md-2 d-flex justify-content-end">
                <button
                    :hidden="this.$parent.isAddCity ? false : this.$parent.hidden "
                    @click="addRow"
                    type="button"
                    class="btn btn-icon btn-light-babyblue text-white mb-3 p-0"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    :title="$t('pages.add')"
                >
                    <font-awesome-icon icon="fa-solid fa-circle-plus"/>
                </button>
            </div>
        </div>
        <div
            class="row align-items-end"
            v-for="(row, index) in city.rows"
            :key="index"
        >
            <div class="col-12 col-md-5">
                <form-input
                    label="pages.city_ar"
                    :showLabel="false"
                    type="text"
                    :model="this.city.rows[index]"
                    name="ar"
                    :errors="formErrors"
                    error_key="name.ar"
                    @clearErrors="clearInput(`rows.${index}.ar`)"
                />
            </div>
            <div class="col-9 col-md-5">
                <form-input
                    label="pages.city_en"
                    :showLabel="false"
                    type="text"
                    :model="this.city.rows[index]"
                    name="en"
                    :errors="formErrors"
                    error_key="name.en"
                    @clearErrors="clearInput(`rows.${index}.en`)"
                />
            </div>

            <div class="col-3 col-md-2 d-flex justify-content-end">
                <button
                    @click.stop="removeElement(index)"
                    type="button"
                    class="btn btn-icon btn-light-danger text-white mb-3 p-0"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    :title="$t('forms.delete')"
                >
                    <font-awesome-icon icon="fa-solid fa-circle-minus"/>
                </button>
            </div>
        </div>
    </form-modal>
</template>

<script>
import {useToast} from "vue-toastification";
import GovernorateApi from "@api/governorate.api";
import CountryApi from "@api/country.api";
import CityApi from "@api/city.api";


export default {
    name: "CityForm",
    data() {
        return {
            countries: [],
            cities: [],
            governorates: {},
            filtersCountries: {
                page: 1,
            },
            governoratesEdit:[]
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
        city: {
            type: Object,
        },
        countries: {
            type: Array,
        },
        governorates: {
            type: Array,
        },
        title: {
            type: String,
            default: "pages.add_city",
        },
    },
    methods: {
        addRow: function () {
            this.city.rows.push({
                    'ar': '',
                    'en': ''

            });
        },

        removeElement: function (index) {
            this.city.rows.splice(index, 1);
        },
        clearForm() {
            this.clearErrors();
            this.resetForm(this.city)
        },
        getGovernorates(id) {
            let data = {country:id}
            GovernorateApi.list(data)
                .then(({data}) => {
                    this.submitFormDisabled = false
                    this.clearInput('country_id')
                    this.governoratesEdit = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getGovernorateForEdit() {
          let data = {list_all_without_pagination:true,country:this.city.country_id}
            GovernorateApi.list(data)
                .then(({data}) => {
                    this.governoratesEdit = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        getCountries() {
            let data = {list_all_without_pagination:true}
            CountryApi.list(data)
                .then(({data}) => {
                    this.countries = data.data;
                    // this.pagination = data.meta;
                })
                .catch((errors) => {
                    console.log(errors);
                });
            console.log(this.countries);

        },
        update() {
            this.submitFormDisabled = true;
            CityApi.update(this.city)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    $("#addCityModal").modal("hide");

                    this.afterModalUpdateActions(
                        this.city,
                        this.$parent.cities,
                        data.data,
                        this.city.id
                    );
                })
                .catch((error) => {
                    console.log(error);
                    this.submitFormDisabled = false;
                    this.formErrors = error.response.data.errors;
                });
        },
        add() {
            this.submitFormDisabled = true;
            CityApi.store(this.city)
                .then(({data}) => {
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    $("#addCityModal").modal("hide");
                    this.afterModalAddActions(
                        this.city,
                        this.$parent.cities,
                        data.data
                    );
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },



        submit() {
            if (this.city.id === undefined) {
                this.add();
            } else {

                this.update();
            }
        },
    },
    created() {
        this.getCountries();
        this.getGovernorateForEdit();
        this.$parent.isAddCity ? this.governorates : this.getGovernorates();
    },
};
</script>

<style scoped></style>
