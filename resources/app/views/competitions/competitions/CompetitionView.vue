<template>
    <Card>
        <template #default>
            <el-tabs v-model="activeName">
                <el-tab-pane
                    :label="$t('pages.competition_data')"
                    name="competition"
                >
                    <CompetitionData />
                </el-tab-pane>
                <el-tab-pane
                    :label="$t('pages.subscriptions')"
                    name="subscriptions"
                    lazy
                >
                    <div class="card-body">
                        {{ $t("pages.subscriptions") }}
                    </div>
                </el-tab-pane>
                <el-tab-pane
                    :label="$t('sidebar.contestants')"
                    name="contestants"
                    lazy
                >
                    <div class="card-body">
                        {{ $t("sidebar.contestants") }}
                    </div>
                </el-tab-pane>
            </el-tabs>
        </template>
    </Card>
</template>

<script>
import { ref } from "vue";
import CompetitionData from "@/views/competitions/competitions/CompetitionData.vue";

export default {
    components: {
        CompetitionData,
    },
    setup() {
        const activeName = ref("competition");
        return {
            activeName,
        };
    },
};
</script>
