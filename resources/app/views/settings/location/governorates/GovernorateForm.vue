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
            @change="clearInput('country_id')"
            :model="governorate"
            :myOptions="this.countries"
            :errors="formErrors"
            label-field="name_localized"
            value-field="id"
        />
        <hr class="mt-2" />
        <div class="row align-items-end">
            <div class="col-12 col-md-5">
                <form-input
                    label="pages.governorate_ar"
                    type="text"
                    :model="this.governorate.name"
                    name="ar"
                    :errors="formErrors"
                    error_key="name.ar"
                    @clearErrors="clearInput('name.ar')"
                />
            </div>
            <div class="col-9 col-md-5">
                <form-input
                    label="pages.governorate_en"
                    type="text"
                    :model="this.governorate.name"
                    name="en"
                    :errors="formErrors"
                    error_key="name.en"
                    @clearErrors="clearInput('name.en')"
                />
            </div>
            <div class="col-3 col-md-2 d-flex justify-content-end">
                <button
                    :hidden="
                        this.$parent.isAddGovernorate
                            ? false
                            : this.$parent.hidden
                    "
                    @click="addRow"
                    type="button"
                    class="btn btn-icon btn-light-babyblue text-white mb-3 p-0"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    :title="$t('pages.add')"
                >
                    <font-awesome-icon icon="fa-solid fa-circle-plus" />
                </button>
            </div>
        </div>
        <div
            class="row align-items-end"
            v-for="(row, index) in governorate.rows"
            :key="index"
        >
            <div class="col-12 col-md-5">
                <form-input
                    label="pages.governorate_ar"
                    :showLabel="false"
                    type="text"
                    :model="this.governorate.rows[index]"
                    name="ar"
                    :errors="formErrors"
                    error_key="name.ar"
                    @clearErrors="clearInput(`rows.${index}.ar`)"
                />
            </div>
            <div class="col-9 col-md-5">
                <form-input
                    label="pages.governorate_en"
                    :showLabel="false"
                    type="text"
                    :model="this.governorate.rows[index]"
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
                    <font-awesome-icon icon="fa-solid fa-circle-minus" />
                </button>
            </div>
        </div>
    </form-modal>
</template>

<script>
import { useToast } from "vue-toastification";
import CountryApi from "@api/country.api";
import GovernorateApi from "@api/governorate.api";
import {ref} from "vue";

export default {
    name: "GovernorateForm",
    data() {
        return {
            countries: [],
        };
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
        governorate: {
            type: Object,
        },
        title: {
            type: String,
            default: "pages.add_governorate",
        },
    },
    methods: {
        addRow: function () {
            this.governorate.rows.push({
                ar: "",
                en: "",
                status: ref(true),
            });
        },
        removeElement: function (index) {
            this.governorate.rows.splice(index, 1);
        },
        clearForm() {
            this.clearErrors();
            this.resetForm(this.governorate);
        },

        update() {
            this.submitFormDisabled = true;
            $("#addGovernorateModal").modal("hide");
            GovernorateApi.update(this.governorate)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    $("#updateGovernorateModal").modal("hide");
                    this.afterModalUpdateActions(
                        this.governorate,
                        this.$parent.governorates,
                        data.data,
                        this.governorate.id
                    );
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
        add() {
            this.governorate.status = true;
            this.submitFormDisabled = true;
            GovernorateApi.store(this.governorate)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    this.submitFormDisabled = false;
                    $("#addGovernorateModal").modal("hide");
                    this.afterModalAddActions(
                        this.governorate,
                        this.$parent.governorates,
                        data.data
                    );
                    this.governorate.status=true;
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },

        submit() {
            if (this.governorate.id === undefined) {
                this.add();
            } else {
                this.update();
            }
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
    },
    created() {
        this.getCountries();
    },
};
</script>

<style scoped></style>
