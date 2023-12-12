<template>
    <Card>
        <template #default>
            <el-tabs v-model="activeName">
                <el-tab-pane :label="$t('pages.countries')" name="country">
                    <CountryIndex />
                </el-tab-pane>
                <el-tab-pane
                    :label="$t('pages.governorates')"
                    name="governorate"
                    lazy
                >
                    <GovernorateIndex />
                </el-tab-pane>
                <el-tab-pane :label="$t('pages.cities')" name="city" lazy>
                    <CityIndex />
                </el-tab-pane>
            </el-tabs>
        </template>
    </Card>
</template>

<script>
import { ref } from "vue";
import CountryIndex from "@/views/settings/location/countries/CountryIndex.vue";
import GovernorateIndex from "@/views/settings/location/governorates/GovernorateIndex.vue";
import CityIndex from "@/views/settings/location/cities/CityIndex.vue";

export default {
    components: {
        CountryIndex,
        GovernorateIndex,
        CityIndex,
    },
    setup() {
        const activeName = ref("country");
        return {
            activeName,
        };
    },
};
</script>
