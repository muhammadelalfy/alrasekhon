<template>
    <div class="page-header">
        <div
            class="d-flex flex-column header-bg justify-content-center text-white w-100 p-4"
        >
            <img
                class="trans-180Deg"
                alt="bg"
                :src="`${publicPath}/assets/images/header_bg.png`"
            />
            <h1>{{ $t("pages.hello_admin") }}</h1>
            <span>{{ $t("pages.welcome_dashboard") }}</span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 mb-4">
            <Card class="mb-0">
                <router-link
                    :to="{ name: 'contestants' }"
                    class="d-flex align-items-center justify-content-between p-3"
                >
                    <div>
                        <h6 class="text-grayClr mb-3">
                            {{ $t("sidebar.contestants") }}
                        </h6>
                        <h3 class="fw-bold">{{ this.contestantsCount }}</h3>
                    </div>
                    <img
                        class="trans-180Deg card-vector"
                        alt="contestants"
                        :src="`${publicPath}/assets/images/contestants.svg`"
                    />
                </router-link>
            </Card>
        </div>
        <div class="col-md-3 mb-4">
            <Card class="mb-0">
                <router-link
                    :to="{ name: 'arbitrators' }"
                    class="d-flex align-items-center justify-content-between p-3"
                >
                    <div>
                        <h6 class="text-grayClr mb-3">
                            {{ $t("sidebar.arbitrators") }}
                        </h6>
                        <h3 class="fw-bold">{{ this.arbitratorCount }}</h3>
                    </div>
                    <img
                        class="trans-180Deg card-vector"
                        alt="arbitrators"
                        :src="`${publicPath}/assets/images/arbitrators.svg`"
                    />
                </router-link>
            </Card>
        </div>
        <div class="col-md-3 mb-4">
            <Card class="mb-0">
                <router-link
                    :to="{ name: 'users' }"
                    class="d-flex align-items-center justify-content-between p-3"
                >
                    <div>
                        <h6 class="text-grayClr mb-3">
                            {{ $t("sidebar.moderators") }}
                        </h6>
                        <h3 class="fw-bold">{{ this.moderatorCount }}</h3>
                    </div>
                    <img
                        class="trans-180Deg card-vector"
                        alt="users"
                        :src="`${publicPath}/assets/images/moderators.svg`"
                    />
                </router-link>
            </Card>
        </div>
        <div class="col-md-3 mb-4">
            <Card class="mb-0">
                <router-link
                    :to="{ name: 'competitions' }"
                    class="d-flex align-items-center justify-content-between p-3"
                >
                    <div>
                        <h6 class="text-grayClr mb-3">
                            {{ $t("sidebar.contests") }}
                        </h6>
                        <h3 class="fw-bold">{{ this.competitionCount }}</h3>
                    </div>
                    <img
                        class="trans-180Deg card-vector"
                        alt="contests"
                        :src="`${publicPath}/assets/images/contests.svg`"
                    />
                </router-link>
            </Card>
        </div>
    </div>
<!--    <Card>-->
<!--        <template #default>-->
<!--            <h6 class="fw-bold mb-0 p-3">{{ $t("pages.best_contestants") }}</h6>-->
<!--            <table class="table-data dt-responsive table w-100 table-borderless">-->
<!--                <thead>-->
<!--                    <tr>-->
<!--                        <th>#</th>-->
<!--                        <th>{{ $t("pages.image") }}</th>-->
<!--                        <th>{{ $t("pages.contestant_name") }}</th>-->
<!--                        <th>{{ $t("pages.email") }}</th>-->
<!--                        <th>{{ $t("pages.time") }}</th>-->
<!--                    </tr>-->
<!--                </thead>-->
<!--                <tbody>-->
<!--                    <tr>-->
<!--                        <td>1</td>-->
<!--                        <td>-->
<!--                            <img-->
<!--                                class="table-img"-->
<!--                                alt="avatar"-->
<!--                                :src="`${publicPath}/assets/images/girl.svg`"-->
<!--                            />-->
<!--                        </td>-->
<!--                        <td>اماني قاسم</td>-->
<!--                        <td>amany@gmail.com</td>-->
<!--                        <td>منذ دقيقه واحده</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td>2</td>-->
<!--                        <td>-->
<!--                            <img-->
<!--                                class="table-img"-->
<!--                                alt="avatar"-->
<!--                                :src="`${publicPath}/assets/images/girl.svg`"-->
<!--                            />-->
<!--                        </td>-->
<!--                        <td>اماني قاسم</td>-->
<!--                        <td>amany@gmail.com</td>-->
<!--                        <td>منذ دقيقه واحده</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td>3</td>-->
<!--                        <td>-->
<!--                            <img-->
<!--                                class="table-img"-->
<!--                                alt="avatar"-->
<!--                                :src="`${publicPath}/assets/images/girl.svg`"-->
<!--                            />-->
<!--                        </td>-->
<!--                        <td>اماني قاسم</td>-->
<!--                        <td>amany@gmail.com</td>-->
<!--                        <td>منذ دقيقه واحده</td>-->
<!--                    </tr>-->
<!--                </tbody>-->
<!--            </table>-->
<!--        </template>-->
<!--    </Card>-->
</template>

<!-- eslint-disable no-undef -->
<script>
import Card from "@/components/Card.vue";
import ContestantsApi from "@api/contestants.api";
import ArbitratorsApi from "@api/arbitrators.api";
import UserApi from "@api/user.api";
import CompetitionsApi from "@api/competitions.api";
export default {
    name: "DashBoard",
    components: {
        Card,
    },

    data(){
      return {
          contestantsCount: 0,
          arbitratorCount: 0,
          moderatorCount: 0,
          competitionCount: 0,
      }
    },

    methods: {
        getContestants() {
            let requestData = {
                get_for_statistics: true
            }
            ContestantsApi.list(requestData)
                .then(({data}) => {
                    this.contestantsCount = data;
                })
                .catch((errors) => {
                    console.log(errors);
                });

        },
        getArbitrators() {
            let requestData = {
                get_for_statistics: true
            }
            ArbitratorsApi.list(requestData)
                .then(({data}) => {
                    this.arbitratorCount = data;
                })
                .catch((errors) => {
                    console.log(errors);
                });

        },
        getModerators(){
            let requestData = {
                get_for_statistics: true
            }
            UserApi.list(requestData)
                .then(({data}) => {
                    this.moderatorCount = data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },

        getCompetitions(){
            let requestData = {
                get_for_statistics: true
            }
            CompetitionsApi.list(requestData)
                .then(({data}) => {
                    this.competitionCount = data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        }
    },
    mounted() {

        this.getContestants()
        this.getArbitrators()
        this.getModerators()
        this.getCompetitions()


        /*basic responsive Datatable*/
        $(".table-data").DataTable({
            lengthChange: false,
            searching: false,
            paging: false,
            info: false,
            ordering: false,
            order: [],
        });
    },
};
</script>
