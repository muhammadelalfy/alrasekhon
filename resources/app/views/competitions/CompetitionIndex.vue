<template>
    <Card>
        <template #default>
            <el-tabs v-model="activeName">
                <el-tab-pane :label="$t('sidebar.contests')" name="contests">
                    <CompetitionIndex />
                </el-tab-pane>
                <el-tab-pane
                    :label="$t('pages.adv')"
                    name="adv"
                    lazy
                >
                    <AdvertisementIndex />
                </el-tab-pane>
            </el-tabs>
        </template>
    </Card>
</template>

<script>
import { ref } from "vue";
import CompetitionIndex from "@/views/competitions/competitions/CompetitionIndex.vue";
import AdvertisementIndex from "@/views/competitions/advertisements/AdvertisementIndex.vue";

export default {
    components: {
        CompetitionIndex,
        AdvertisementIndex,
    },
    setup() {
        const activeName = ref("contests");
        return {
            activeName,
        };
    },
};
</script>
