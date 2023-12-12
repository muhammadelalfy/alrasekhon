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
                    <span class="fs-14 fw-bold text-darkGray">{{ arbitrator.first_name }} </span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.last_name") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ arbitrator.last_name }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.dob") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ arbitrator.birth_date }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.identity_proof") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray" >{{ arbitrator.passport ?? arbitrator.national_id }}</span
                    >
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.type") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ arbitrator.gender_localized }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.nationality") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ arbitrator.nationality }}</span>

                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.level") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ arbitrator.levels }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.email") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ arbitrator.email }}</span
                    >
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.phone") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ arbitrator.phone }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.status") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ arbitrator.status_localized }}</span>

                </div>
                <div class="col-md-2 mb-3" v-if="arbitrator.profile_photo">
                    <h6 class="text-grayClr">
                        {{ $t("pages.profile_photo") }}
                    </h6>
                    <div class="fs-14 d-flex align-items-center">
                        <a :href="arbitrator.profile_photo" :download="arbitrator.profile_photo" class="btn btn-icon btn-lightGray text-grayClr me-2" >
                            <!--                            <img :src="arbitrator.profile_photo" alt="" class="w-100">-->
                            <font-awesome-icon icon="fa-solid fa-file" />
                        </a>
                    </div>
                </div>
                <div class="col-md-2 mb-3" v-if="arbitrator.contract_attach">
                    <h6 class="text-grayClr">
                        {{ $t("pages.contract_attach") }}
                    </h6>
                    <div class="fs-14 d-flex align-items-center">
                        <a :href="arbitrator.contract_attach" :download="arbitrator.contract_attach" class="btn btn-icon btn-lightGray text-grayClr me-2" >
                            <!--                            <img :src="arbitrator.profile_photo" alt="" class="w-100">-->
                            <font-awesome-icon icon="fa-solid fa-file" />
                        </a>
                    </div>
                </div>
            </div>
        </el-collapse-item>
        <el-collapse-item
            :title="$t('pages.experiences')"
            name="2"
            class="mb-3"
        >
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.educational_qualification") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray"
                        >{{ arbitrator.qualification }}</span
                    >
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.basic_job") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ arbitrator.job }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.quran_memorization") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ arbitrator.is_teacher_localized }}</span>
                </div>
                <div class="col-12 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.institutions_he_worked") }}
                    </h6>
                    <div class="table-responsive">
                        <table
                            class="table-data dt-responsive table w-100 table-borderless"
                        >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ $t("pages.company_type") }}</th>
                                    <th>{{ $t("pages.company_name") }}</th>
                                    <th>{{ $t("pages.attachments") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="this.arbitrator.work_experiences_length" v-for="(workExperience, index) in this.arbitrator.work_experiences" :key="index">
                                    <td>{{ (index+1) }}</td>
                                    <td>{{ workExperience.work_place_type ? $t('pages.' + workExperience.work_place_type) : $t('pages.no_data') }}</td>
                                    <td>{{ workExperience.company_name }}</td>
                                    <td>
                                        <div v-if="workExperience.attach_url" class="btn-list d-inline-flex">
                                            <a :href="workExperience.attach_url" :download="workExperience.attach_url" class="btn btn-icon btn-lightGray text-grayClr me-1">
                                                <font-awesome-icon icon="fa-solid fa-file" />
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="alert alert-secondary text-center">
                                    <td colspan="5" class="text-danger">{{ $t('pages.no_data') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table-data dt-responsive table w-100 table-borderless"
                        >
                            <thead>
                                <tr>
                                    <th>
                                        {{ $t("pages.practical_experiences") }}
                                    </th>
                                    <th>{{ $t("pages.skills_tooltip") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>مسابقة أهل الرضوان</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </el-collapse-item>
        <el-collapse-item
            :title="$t('pages.exquisiteReadings')"
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
                                <th>{{ $t("pages.method") }}</th>
                                <th>{{ $t("pages.reading") }}</th>
                                <th>{{ $t("pages.novel") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr v-if="arbitrator.methods_count" v-for="(method, index) in arbitrator.methods" :key="index">
                            <td>{{ (index+1) }}</td>
                            <td>{{ method }}</td>
                            <td>{{ arbitrator.readings[index] }}</td>
                            <td>{{ arbitrator.novels[index] }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </el-collapse-item>
        <el-collapse-item
            :title="$t('pages.vacations_bonds')"
            name="4"
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
                                <th>{{ $t("pages.vacation_bond") }}</th>
                                <th>{{ $t("pages.attachments") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="arbitrator.authorizations_count" v-for="(authorization, index) in arbitrator.authorizations" :key="index">
                                <td>{{(index+1)}}</td>
                                <td>{{ authorization.authorization }}</td>
                                <td>
                                    <div class="btn-list d-inline-flex">
                                        <a :href="authorization.attach_url" :download="authorization.attach_url" class="btn btn-icon btn-lightGray text-grayClr me-1" >
                                            <font-awesome-icon icon="fa-solid fa-file" />
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </el-collapse-item>
        <el-collapse-item
            :title="$t('pages.address_info')"
            name="5"
            class="mb-3"
        >
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.country") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ arbitrator.country }}</span>

                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.governorate") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ arbitrator.governorate }}</span>

                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.city") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray">{{ arbitrator.city }}</span>

                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.main_address") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray"
                    >{{ arbitrator.main_address }}</span
                    >
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.alternative_address") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray"
                    >{{ arbitrator.additional_address }}</span
                    >
                </div>
            </div>
        </el-collapse-item>
    </el-collapse>
</template>

<script>
    import {ref} from "vue";
    import ArbitratorsApi from "@api/arbitrators.api";

    export default {
        data(){
            return{
                filters: {
                    page: 1,
                },
                pagination: {},
                arbitrator: {},
                activeName: ref('1'),
            }

        },

        methods: {
            getArbitrator(){
                ArbitratorsApi.get(this.$route.params.id, null, null).then(({data}) => {
                    this.arbitrator = data.data;
                    console.log(this.arbitrator)
                })
                    .catch((errors) => {
                        console.log(errors);
                    });
            }
        },

        mounted() {
            this.getArbitrator();
        }
    }
</script>

<!--<script lang="ts" setup>-->
<!--import { ref, onMounted } from "vue";-->

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
