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
                    data-bs-target="#formGovernorates"
                    aria-expanded="false"
                    aria-controls="formGovernorates"
                >
                    <font-awesome-icon icon="fa-solid fa-filter" />
                </button>
            </div>
            <button
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#addGovernorateModal"
                class="btn ripple btn-babyblue text-white"
                @click="isAddGovernorate = true"
            >
                <font-awesome-icon icon="fa-solid fa-plus" class="me-1" />
                {{ $t("pages.add_governorate") }}
            </button>
        </div>

        <div id="formGovernorates" class="collapse multi-collapse px-3">
            <filters @submit="getGovernorates" :model="filtersGovernorates">
                <div class="col-md-4 col-lg-3">
                    <form-select
                        title="pages.country"
                        label="name"
                        name="country"
                        collapse-tags
                        collapse-tags-tooltip
                        :model="filtersGovernorates"
                        :myOptions="countries"
                        valueField="id"
                        labelField="name_localized"
                    />
                </div>
            </filters>
        </div>
        <Card class="pt-3" v-if="governorates.length">
            <DataTable id="governorate-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ $t("pages.governorate") }}</th>
                        <th>{{ $t("pages.country") }}</th>
                        <th>{{ $t("pages.last_update") }}</th>
                        <th>{{ $t("pages.status") }}</th>
                        <th>{{ $t("global.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(governorate, index) in governorates">
                        <td>{{ index + 0 }}</td>
                        <td>{{ governorate.name_localized }}</td>
                        <td>{{ governorate.country_name_localized }}</td>
                        <td>{{ governorate.updated_at }}</td>
                        <td>
                            <form-switcher
                                id="status"
                                :model="governorate"
                                name="status"
                                :errors="formErrors"
                                @clearErrors="clearInput"
                                @toggle="toggle(governorate)"
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
                                        data-bs-target="#addgovernorateModal"
                                        @click="
                                            isAddGovernorate = false;
                                            groupForm(governorate);
                                            hidden = true;
                                        "
                                    >
                                        <font-awesome-icon
                                            icon="fa-solid fa-pen-to-square"
                                        />
                                    </button>
                                </div>
                                <delete-button
                                    v-if="
                                        hasPermission('delete', 'Governorate')
                                    "
                                    @del-model="
                                        delGovernorate(governorate, index)
                                    "
                                />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </DataTable>
            <spinner v-if="this.$store.loaderStore.loading"></spinner>
            <pagination :pagination="pagination" @paginate="getGovernorates" />
            </Card>
        </div>


    <!-- Modal -->
    <GovernorateForm
        :governorate="governorate"
        :showButton="false"
        :title="
            isAddGovernorate
                ? $t('pages.add_governorate')
                : $t('pages.edit_governorate')
        "
        aria-labelledby="addGovernorateModalLabel"
        :id="
            isAddGovernorate ? 'addGovernorateModal' : 'updateGovernorateModal'
        "
        modal-dialog-centered="true"
        :modal-lg="true"
        :countryOptions="this.countries"
    />
</template>

<script>
import Card from "@/components/Card.vue";
import GovernorateForm from "@/views/settings/location/governorates/GovernorateForm.vue";
import { ref, reactive, onMounted } from "vue";
import { useToast } from "vue-toastification";
import GovernorateApi from "@api/governorate.api";
import CountryApi from "@api/country.api";

export default {
    name: "GovernorateIndex",
    components: {
        Card,
        GovernorateForm,
    },
    setup() {
        const isAddGovernorate = ref(true);
        const hidden = ref(false);

        const governorate = reactive({
            name: {
                ar: "",
                en: "",
            },
            country_id: "",
            rows: [],
            status:true

        });

        onMounted(() => {
            $("#addGovernorateModal").on("click", function () {
                isAddGovernorate.value = true;
            });
        });

        return {
            isAddGovernorate,
            governorate,
            hidden,
        };
    },

    data() {
        return {
            statusAction: {
                status: false,
            },
            filtersGovernorates: {
                page: 1,
            },
            governorates: {},
            countries: {},
            pagination: {},
        };
    },

    methods: {
        getGovernorates(page = 1) {
            this.filtersGovernorates.page = page;
            GovernorateApi.list(this.filtersGovernorates)
                .then(({ data }) => {
                    this.governorates = data.data;
                    this.pagination = data.meta;
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

        groupForm(governorate = {}) {
            if (governorate.id) {
                this.title = "pages.edit_country";
                this.governorate = _.cloneDeep(governorate);
            } else {
                this.title = "pages.add_country";
            }
            $("#addGovernorateModal").modal("show");
        },
        clearForm() {
            this.clearErrors();
        },
        delGovernorate(governorate, index) {
            GovernorateApi.delete(governorate).then((resp) => {
                this.governorates.splice(index, 1);
                useToast().success(resp.data.message);
            });
        },
        toggle(governorateObj = {}) {
            GovernorateApi.changeStatus(governorateObj).then((resp) => {
                useToast().success(resp.data.message);
            });
        },
    },

    created() {
        this.getGovernorates();
        this.getCountries();
    },
};
</script>
