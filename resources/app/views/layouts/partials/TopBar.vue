<script>
import LangSwitcher from "@/views/layouts/partials/LangSwitcher.vue";
import Cookies from "js-cookie";

import { mapState } from "pinia";
import { useAuthUserStore } from "@/store/user";

export default {
    name: "top-bar",

    components: {
        LangSwitcher,
    },
    data() {
        return {
            CurrentLang: localStorage.getItem("lang") ?? "en",
        };
    },
    created() {},
    computed: {
        ...mapState(useAuthUserStore, {
            username: (state) => state.user.name,
            roles: (state) => state.user.roles,
        }),
    },
    mounted: function () {
        // $('.main-header .dropdown > a').on('click', function (e) {
        //     e.preventDefault();
        //     $(this).parent().toggleClass('show');
        //     $(this).parent().siblings().removeClass('show');
        // });
    },
    methods: {
        submit(e) {
            this.disable = true;
            Cookies.set("lang", e);
            localStorage.setItem("lang", e);

            axios.get("/api/v1/changeLocale/" + e).then((response) => {
                this.$i18n.locale = e;
            });
            axios.defaults.headers.common["Accept-Language"] = e;
            window.location.reload();
        },

        logout() {
            this.$store.userStore
                .logout()
                .then((response) => {
                    this.$router.push({
                        path: "/login",
                    });
                })
                .catch((error) => {
                    console.log(error.response.data.errors);
                });
        },
    },
};
</script>

<template>
    <div class="main-header hor-header with-side-menu">
        <!-- class="with-side-menu" -->
        <div class="container">
            <div class="main-header-left">
                <a
                    class="main-header-menu-icon d-lg-none"
                    href="javascript:void(0)"
                    id="mainNavShow"
                    ><span></span
                ></a>
                <router-link :to="{ name: 'dashboard' }" class="main-logo">
                    <img
                        :src="`${publicPath}/assets/images/logo.png`"
                        class="header-brand-img desktop-logo"
                        alt="logo"
                    />
                    <img
                        :src="`${publicPath}/assets/images/icon.png`"
                        class="header-brand-img icon-logo"
                        alt="logo"
                    />
                </router-link>
            </div>

            <div class="main-header-right">
                <div class="dropdown d-md-flex">
                    <a class="nav-link icon full-screen-link">
                        <font-awesome-icon
                            icon="fa-solid fa-expand"
                            class="fullscreen-button"
                        />
                    </a>
                </div>
<!--                <div class="dropdown main-header-notification">-->
<!--                    <a class="nav-link icon" href="">-->
<!--                        <font-awesome-icon icon="fa-solid fa-bell" />-->
<!--                        <span class="pulse bg-danger"></span>-->
<!--                    </a>-->
<!--                    <div class="dropdown-menu">-->
<!--                        <p class="main-headNav-text text-center p-3">-->
<!--                            You have 1 unread notification-->
<!--                            <span-->
<!--                                class="badge rounded-pill bg-primary ms-3 text-white"-->
<!--                                >{{  $t("pages.view_all")  }}</span-->
<!--                            >-->
<!--                        </p>-->
<!--                        <ul class="main-notification-list">-->
<!--                            <li class="media d-flex">-->
<!--                                <div class="flex-shrink-0 main-img-user online">-->
<!--                                    <img-->
<!--                                        :src="`${publicPath}/assets/images/girl.svg`"-->
<!--                                        alt="avatar"-->
<!--                                    />-->
<!--                                </div>-->
<!--                                <div class="flex-grow-1 ms-3 media-body">-->
<!--                                    <p>-->
<!--                                        Congratulate-->
<!--                                        <strong>Olivia James</strong> for New-->
<!--                                        template start-->
<!--                                    </p>-->
<!--                                    <span>Oct 15 12:32 pm</span>-->
<!--                                </div>-->
<!--                            </li>-->

<!--                            <li class="media d-flex">-->
<!--                                <div class="flex-shrink-0 main-img-user online">-->
<!--                                    <img-->
<!--                                        :src="`${publicPath}/assets/images/girl.svg`"-->
<!--                                        alt="avatar"-->
<!--                                    />-->
<!--                                </div>-->
<!--                                <div class="flex-grow-1 ms-3 media-body">-->
<!--                                    <p>-->
<!--                                        Congratulate-->
<!--                                        <strong>Olivia James</strong> for New-->
<!--                                        template start-->
<!--                                    </p>-->
<!--                                    <span>Oct 15 12:32 pm</span>-->
<!--                                </div>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                        <div class="noti-footer text-center">-->
<!--                            <a href="" class="text-primary">{{-->
<!--                                $t("pages.view_all") -->
<!--                            }}</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="d-md-flex">
                    <form action="#">
                        <a
                            v-if="CurrentLang === 'en'"
                            class="nav-link icon"
                            @click.prevent="submit('ar')"
                        >
                            AR
                        </a>

                        <a
                            v-if="CurrentLang === 'ar'"
                            class="nav-link icon"
                            @click.prevent="submit('en')"
                        >
                            EN
                        </a>
                    </form>
                </div>
                <!--                <div class="dropdown main-header-notification">-->
                <!--                    <a class="nav-link icon" href="">-->
                <!--                        <font-awesome-icon icon="fa-solid fa-bell" />-->
                <!--                        <span class="pulse bg-danger"></span>-->
                <!--                    </a>-->
                <!--                    <div class="dropdown-menu">-->
                <!--                        <p class="main-headNav-text text-center p-3">-->
                <!--                            You have 1 unread notification-->
                <!--                            <span class="badge rounded-pill bg-primary ms-3 text-white">View all</span>-->
                <!--                        </p>-->
                <!--                        <ul class="main-notification-list">-->

                <!--                            <li class="media d-flex">-->
                <!--                                <div class="flex-shrink-0 main-img-user online">-->
                <!--                                    <img alt="avatar" :src="`${publicPath}/assets/images/5.jpg`">-->
                <!--                                </div>-->
                <!--                                <div class="flex-grow-1 ms-3 media-body">-->
                <!--                                    <p>Congratulate <strong>Olivia James</strong> for New template start</p>-->
                <!--                                    <span>Oct 15 12:32 pm</span>-->
                <!--                                </div>-->
                <!--                            </li>-->

                <!--                            <li class="media d-flex">-->
                <!--                                <div class="flex-shrink-0 main-img-user online">-->
                <!--                                    <img alt="avatar" :src="`${publicPath}/assets/images/5.jpg`">-->
                <!--                                </div>-->
                <!--                                <div class="flex-grow-1 ms-3 media-body">-->
                <!--                                    <p>Congratulate <strong>Olivia James</strong> for New template start</p>-->
                <!--                                    <span>Oct 15 12:32 pm</span>-->
                <!--                                </div>-->
                <!--                            </li>-->

                <!--                        </ul>-->
                <!--                        <div class="noti-footer text-center">-->
                <!--                            <a href="" class="text-primary">View All Notifications</a>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->

                <div class="dropdown main-profile-menu">
                    <a class="main-img-user" href="">
                        <img
                            alt="avatar"
                            :src="`${publicPath}/assets/images/girl.svg`"
                        />
                    </a>
                    <div class="dropdown-menu">
                        <div class="header-navheading text-center">
                            <h6 class="main-headNav-title">{{ username }}</h6>
                            <p class="main-headNav-text">{{ roles }}</p>
                        </div>
                        <ul class="profileMenu">
                            <li class="dropdown-item">
                                <router-link to="/edit-profile">
                                    <font-awesome-icon
                                        icon="fa-solid fa-user"
                                    />
                                    {{ $t("pages.profile") }}
                                </router-link>
                            </li>
                            <li class="dropdown-item">
                                <a href="#" @click.prevent="logout">
                                    <font-awesome-icon
                                        icon="fa-solid fa-power-off"
                                    />
                                    {{ $t("pages.sign_out") }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
