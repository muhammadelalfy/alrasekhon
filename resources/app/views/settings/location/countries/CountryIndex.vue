<template>
    <card>
        <template #default>
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
                            data-bs-target="#formCountries"
                            aria-expanded="false"
                            aria-controls="formCountries"

                        >
                            <font-awesome-icon icon="fa-solid fa-filter"/>
                        </button>
                    </div>
                    <button
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#addCountryModal"
                        class="btn ripple btn-primary text-white"
                        @click="isAddCountry = true"
                    >
                        <font-awesome-icon icon="fa-solid fa-plus" class="me-1"/>
                        {{ $t("pages.add_country") }}
                    </button>
                </div>

                <div id="formCountries" class="collapse multi-collapse px-3">
                    <filters @submit="getCountries" :model="filtersCountries"></filters>
                </div>

                <Card class="pt-3" v-if="countries.length">
                    <template #default>
                    <DataTable id="country-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ $t("pages.country") }}</th>
                            <th>{{ $t("pages.last_update") }}</th>
                            <th>{{ $t("pages.status") }}</th>
                            <th>{{ $t("global.actions") }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="(  country , index ) in countries"
                            :key="country.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ country.name_localized }}</td>
                            <td>{{ country.updated_at }}</td>
                            <td>
                                <form-switcher
                                    id="status"
                                    :model="country"
                                    name="status"
                                    :errors="formErrors"
                                    @clearErrors="clearInput"
                                    @toggle="toggle(country)"

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
                                            data-bs-target="#addCountryModal"
                                            @click="isAddCountry = false ; groupForm(country)"
                                            v-if="hasPermission('update', 'Country')"
                                        >
                                            <font-awesome-icon icon="fa-solid fa-pen-to-square"/>
                                        </button>
                                    </div>
                                    <delete-button v-if="hasPermission('delete','Country')"
                                                   @del-model="delCountry(country,index)"
                                    />
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </DataTable>
                        <spinner v-if="this.$store.loaderStore.loading"></spinner>
                        <pagination :pagination="pagination" @paginate="getCountries" />
                    </template>
                </Card>
            </div>

        </template>
    </card>

    <!-- Modal -->
    <!--    <pagination :pagination="pagination" @paginate="getRoles" />-->
    <CountryForm
        :country="country"
        :showButton="false"
        :title="isAddCountry ? $t('pages.add_country') : $t('pages.edit_country')"
        id="addCountryModal"
        aria-labelledby="addCountryModalLabel"
        :modal-dialog-centered="true"
        :modal-lg="true"
    />
</template>


<script>
import Card from "@/components/Card.vue";
import CountryForm from "@/views/settings/location/countries/CountryForm.vue";
import {ref, reactive} from "vue";
import CountryApi from "@api/country.api";
import {useToast} from "vue-toastification";

export default {
    components: {
        Card,
        CountryForm,
    },
    // setup() {
    //     const isAddCountry = reactive(true);
    //     // const country = ref({
    //     //     name: {
    //     //         ar: '',
    //     //         en: '',
    //     //     },
    //     // });
    //     return {
    //         isAddCountry,
    //     };
    // },
    data() {
        return {
            isAddCountry:true,
            country: {
                status:true,
                name: {
                    ar: '',
                    en: '',
                }
            },
            statusAction: {
                status: false,
            },
            filtersCountries: {
                page: 1,
            },
            pagination: {},
            countries: [],
        };
    },
    methods: {

        getCountries(page = 1) {
            this.filtersCountries.page = page;
            CountryApi.list(this.filtersCountries)
                .then(({data}) => {
                    this.countries = data.data;
                    this.pagination = data.meta;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },

        groupForm(country = {}) {
            if (country.id) {
                this.title = "pages.edit_country";
                this.country = _.cloneDeep(country);
            } else {
                this.title = "pages.add_country";
            }
            $("#addCountryModal").modal("show");
        },

        clearForm() {
            this.clearErrors();
        },
        delCountry(country, index) {
            CountryApi.delete(country).then((resp) => {
                this.countries.splice(index, 1);
                useToast().success(resp.data.message);
            });
        },
        toggle(countryObj = {}) {
            CountryApi.changeStatus(countryObj).then((resp) => {
                useToast().success(resp.data.message);
            });
        },
    },
    created() {
        this.getCountries();
    },
};
</script>
