<template>
    <Card>
        <template #default>
            <el-tabs v-model="activeName">
                <el-tab-pane :label="$t('pages.who_are_we')" name="who_are_we">
                    <WhoWeAreIndex />
                </el-tab-pane>
                <el-tab-pane :label="$t('pages.address')" name="address" lazy>
                    <AddressIndex />
                </el-tab-pane>
                <el-tab-pane
                    :label="$t('pages.contact_info')"
                    name="contact_info"
                    lazy
                >
                    <ContactInfoIndex />
                </el-tab-pane>
                <el-tab-pane :label="$t('pages.help')" name="help" lazy>
                    <HelpIndex />
                </el-tab-pane>
                <el-tab-pane :label="$t('pages.privacy')" name="privacy" lazy>
                    <PrivacyIndex />
                </el-tab-pane>
                <el-tab-pane
                    :label="$t('pages.terms_conditions')"
                    name="terms_conditions"
                    lazy
                >
                    <TermConditionIndex />
                </el-tab-pane>
            </el-tabs>
        </template>
    </Card>
</template>

<script>
import { ref } from "vue";
import TermConditionIndex from "@/views/settings/general/terms-conditions/TermConditionIndex.vue";
import PrivacyIndex from "@/views/settings/general/privacy/PrivacyIndex.vue";
import AddressIndex from "@/views/settings/general/address/AddressIndex.vue";
import HelpIndex from "@/views/settings/general/help/HelpIndex.vue";
import WhoWeAreIndex from "@/views/settings/general/who-we-are/WhoWeAreIndex.vue";
import ContactInfoIndex from "@/views/settings/general/contact-info/ContactInfoIndex.vue";

export default {
    components: {
        TermConditionIndex,
        PrivacyIndex,
        AddressIndex,
        HelpIndex,
        WhoWeAreIndex,
        ContactInfoIndex,
    },
    setup() {
        const activeName = ref("who_are_we");
        return {
            activeName,
        };
    },
};
</script>

<!-- <template>
    <page-header title="sidebar.settings" :active="false">
        <li class="breadcrumb-item active" aria-current="page">{{ $t('sidebar.general_settings') }}</li>
    </page-header>
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-header rounded-bottom-0 my-3">
                    <div class="card-body">
                        <form class="d-flex flex-column">
                            <div class="row">
                                <div class="col-lg-6 ">
                                    <form-input label="pages.on_hold_order_time" type="text"
                                                :model="settings" name="on_hold_order_time" :errors="formErrors"
                                                @clearErrors="clearInput"/>
                                </div>
                                <div class="col-lg-6 ">
                                    <form-input label="pages.max_driver_orders_count" type="text"
                                                :model="settings" name="max_driver_orders_count" :errors="formErrors"
                                                @clearErrors="clearInput"/>
                                </div>

                                <div class="col-lg-6 ">
                                    <form-input label="pages.driver_max_time_to_accept_order" type="number"
                                                :model="settings" name="driver_max_time_to_accept_order"
                                                :errors="formErrors" @clearErrors="clearInput"/>
                                </div>
                                <div class="col-lg-6 ">
                                    <form-input label="pages.driver_max_time_to_pick_up_order" type="number"
                                                :model="settings" name="driver_max_time_to_pick_up_order"
                                                :errors="formErrors" @clearErrors="clearInput"/>
                                </div>
                                <div class="col-lg-6 ">
                                    <form-input label="pages.driver_max_time_to_deliver_an_order" type="number"
                                                :model="settings" name="driver_max_time_to_deliver_an_order"
                                                :errors="formErrors" @clearErrors="clearInput"/>
                                </div>
                                <div class="col-lg-6 ">
                                    <form-input label="pages.driver_max_time_to_move_after_accepting_order"
                                                type="number"
                                                :model="settings" name="driver_max_time_to_move_after_accepting_order"
                                                :errors="formErrors" @clearErrors="clearInput"/>
                                </div>
                                <div class="col-lg-6 ">
                                    <form-input label="pages.driver_max_time_to_move_after_picking_up_order"
                                                type="number"
                                                :model="settings" name="driver_max_time_to_move_after_picking_up_order"
                                                :errors="formErrors" @clearErrors="clearInput"/>
                                </div>
                                <div class="col-lg-6 ">
                                    <form-input label="pages.driver_max_time_to_spend_at_the_pickup_location"
                                                type="number"
                                                :model="settings" name="driver_max_time_to_spend_at_the_pickup_location"
                                                :errors="formErrors" @clearErrors="clearInput"/>
                                </div>
                                <div class="col-lg-6 ">
                                    <form-input label="pages.driver_max_time_to_spend_in_the_delivery_location"
                                                type="number"
                                                :model="settings"
                                                name="driver_max_time_to_spend_in_the_delivery_location"
                                                :errors="formErrors" @clearErrors="clearInput"/>
                                </div>
                                <div class="col-lg-6 ">
                                    <form-input label="pages.driver_max_time_order_to_be_assigned" type="number"
                                                :model="settings" name="driver_max_time_order_to_be_assigned"
                                                :errors="formErrors" @clearErrors="clearInput"/>
                                </div>
                            </div>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button class="btn ripple btn-babyblue text-white me-2" :disabled="submitFormDisabled"
                                        @click.prevent="submit">{{ $t('forms.save') }}
                                </button>
                                <cancel-button/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template> -->

<!-- <script>
import GeneralSettingsApi from "@api/general-settings.api";
import {useToast} from "vue-toastification";

export default {
    name: "GeneralSettings",
    data() {
        return {
            settings: {}
        }
    },
    methods: {
        getSettings() {
            GeneralSettingsApi.list()
                .then(({data}) => {
                    this.settings = data
                })
        },
        submit() {
            GeneralSettingsApi.update(this.settings)
                .then(({data}) => {
                    console.log(data)
                    useToast().success(this.$t('messages.success'))
                })
                .catch(error => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                })
        }
    },
    created() {
        this.getSettings()
    }
}
</script> -->
