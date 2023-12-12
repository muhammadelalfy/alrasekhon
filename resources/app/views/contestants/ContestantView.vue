<template>
    <el-collapse v-model="activeName" accordion>
        <el-collapse-item
            :title="$t('pages.main_data')"
            name="1"
            class="mb-3"
        >
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.first_name") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{contestant.first_name}}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.last_name") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ contestant.last_name }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.dob") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ contestant.birth_date }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.identity_proof") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ contestant.passport ?? contestant.national_id }}</span
                    >
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.type") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ contestant.gender_localized }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.nationality") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ contestant.nationality }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.educational_qualification") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ contestant.qualification }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.basic_job") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ contestant.job }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.level") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ contestant.levels }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.email") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ contestant.email }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.phone") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ contestant.phone }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.status") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ contestant.status_localized }}</span>
                </div>
            </div>
        </el-collapse-item>
        <el-collapse-item
            :title="$t('pages.address_info')"
            name="2"
            class="mb-3"
        >
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.country") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ contestant.country }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.governorate") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ contestant.governorate }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.city") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ contestant.city }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.main_address") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray"
                        >{{ contestant.main_address }}</span
                    >
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.alternative_address") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray"
                        >{{ contestant.additional_address }}</span
                    >
                </div>
            </div>
        </el-collapse-item>
        <el-collapse-item
            :title="$t('pages.competitions_history')"
            name="3"
            class="mb-3"
        >
            <div class="row">
                <div class="col-12 mb-3 table-responsive">
                    <table
                        class="table-data dt-responsive table w-100 table-borderless"
                    >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ $t("pages.competition_name") }}</th>
                                <th>{{ $t("pages.date") }}</th>
                                <th>{{ $t("pages.contestant_ranking") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>أهل الرضوان</td>
                                <td>10-10-2010</td>
                                <td>المركز الاول</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>أهل الرضوان</td>
                                <td>10-10-2010</td>
                                <td>المركز الاول</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>أهل الرضوان</td>
                                <td>10-10-2010</td>
                                <td>المركز الاول</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </el-collapse-item>
    </el-collapse>
</template>


<script>

import {ref} from "vue";
import ContestantsApi from "@api/contestants.api";

    export default {
        data(){
            return{
                filters: {
                    page: 1,
                },
                pagination: {},
                contestant: {},
                activeName: ref('1'),
            }

        },


        methods:{
          getContestant(){
            ContestantsApi.get(this.$route.params.id, null, null)
                .then(({ data }) => {
                    this.contestant = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
          }
        },

        mounted() {
            this.getContestant()
        }


    }

</script>

<!--<script lang="ts" setup>-->
<!--import { ref, onMounted } from "vue";-->
<!--import {method} from "lodash";-->

<!--const activeName = ref("1");-->

<!--onMounted(() => {-->

<!--    /*basic responsive Datatable*/-->
<!--    $(".table-data").DataTable({-->
<!--        lengthChange: false,-->
<!--        searching: false,-->
<!--        paging: false,-->
<!--        info: false,-->
<!--        ordering: false,-->
<!--        order: [],-->
<!--    });-->
<!--});-->
<!--</script>-->
