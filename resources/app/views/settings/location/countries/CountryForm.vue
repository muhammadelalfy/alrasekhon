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
        <form-input
            label="pages.country_ar"
            type="text"
            :model="this.country.name"
            name="ar"
            :errors="formErrors"
            error_key="name.ar"
            @clearErrors="clearInput('name.ar')"
        />

        <form-input
            label="pages.country_en"
            type="text"
            :model="this.country.name"
            name="en"
            :errors="formErrors"
            error_key="name.en"
            @clearErrors="clearInput('name.en')"
        />

    </form-modal>
</template>
<script>

import {useToast} from "vue-toastification";
import countryApi from "@api/country.api";

export default {
    name: "CountryForm",
    data() {},
    emits: ['toggle'],
    props:{
        id: {
            type: String,
            default: "addCountryModal",
        },
        ariaLabelledby: String,
        dataBsBackdrop: String,
        dataBskeyboard: String,
        modalDialogScrollable: Boolean,
        modalDialogCentered: Boolean,
        modalLg: Boolean,
        modalFullscreen: Boolean,
        country:{
            type:Object
        },
        title:{
            type:String,
            default:'pages.add_country'
        }
    },
    methods: {
        clearForm()
        {
            this.clearErrors();
            this.resetForm(this.country)
        },
        update()
        {
            this.submitFormDisabled = true;
            countryApi.update(this.country)
                .then(({data}) => {
                    useToast().success(this.$t('messages.success'))
                    this.submitFormDisabled = false;
                    $('#addCountryModal').modal('hide');

                    this.afterModalUpdateActions(this.country, this.$parent.countries, data.data, this.country.id)
                })
                .catch(error => {
                    this.submitFormDisabled = false;
                    this.formErrors = error.response.data.errors;
                })
        },
        add()
        {
            this.submitFormDisabled = true;
            countryApi.store(this.country)
                .then(({data}) => {
                    useToast().success(this.$t('messages.success'))
                    this.submitFormDisabled = false;
                    $('#addCountryModal').modal('hide');
                    this.afterModalAddActions(this.country, this.$parent.countries, data.data)
                    this.country.status=true;
                })
                .catch(error => {
                    this.formErrors = error.response.data.errors;
                })
        },
        submit(){
            if (this.country.id === undefined){
                this.add()
            }else{
                this.update()
            }
        },
    }
}
</script>

<style scoped></style>
