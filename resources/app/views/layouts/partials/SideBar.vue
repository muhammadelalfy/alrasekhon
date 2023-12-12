<template>
    <div class="main-navbar side-menu main-sidebar-sticky">
        <div class="sidemenu-logo d-none">
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
        <div class="container main-sidemenu">
            <div class="main-sidebar-body">
                <ul class="nav">
                    <li
                        class="nav-item"
                        :class="{ active: $route.name == 'dashboard' }"
                    >
                        <router-link to="/dashboard" class="nav-link">
                            <span class="icon-dashbored-menu fs-5 me-3"></span>
                            <span class="sidemenu-label">{{
                                $t("sidebar.dashboard")
                            }}</span>
                        </router-link>
                    </li>
                    <!-- v-if="hasPermission('read', 'User')" -->
                    <li
                        class="nav-item"
                        :class="{
                            active:
                                $route.name == 'users' ||
                                $route.meta.parent == 'users',
                        }"

                    >
                        <router-link to="/users" class="nav-link">
                            <span class="icon-users-menu fs-5 me-3"></span>
                            <span class="sidemenu-label">{{
                                $t("sidebar.users")
                            }}</span>
                        </router-link>
                    </li>
                    <!-- v-if="hasPermission('read', 'Role')" -->
                    <li
                        class="nav-item"
                        :class="{
                            active:
                                $route.name == 'roles' ||
                                $route.meta.parent == 'roles',
                        }"

                    >
                        <router-link to="/roles" class="nav-link">
                            <span class="icon-permission-menu fs-5 me-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span></span>
                            <span class="sidemenu-label">{{
                                $t("sidebar.roles")
                            }}</span>
                        </router-link>
                    </li>

                    <li
                        class="nav-item"
                        :class="{
                            active:
                                $route.name == 'contestants' ||
                                $route.meta.parent == 'contestants',
                        }"
                    >
                        <router-link to="/contestants" class="nav-link">
                            <span class="icon-contestants-menu fs-5 me-3"></span>
                            <span class="sidemenu-label">{{
                                $t("sidebar.contestants")
                            }}</span>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        :class="{
                            active:
                                $route.name == 'arbitrators' ||
                                $route.meta.parent == 'arbitrators',
                        }"
                    >
                        <router-link to="/arbitrators" class="nav-link">
                            <span class="icon-judgment-menu fs-5 me-3"></span>
                            <span class="sidemenu-label">{{
                                $t("sidebar.arbitrators")
                            }}</span>
                        </router-link>
                    </li>

                    <!-- for legan l t7kem link -->
                    <!-- <span class="icon-legan-menu"></span> -->

                    <li
                        class="nav-item"
                        :class="{ active: $route.name == 'competitions' }"
                    >
                        <router-link to="/competitions" class="nav-link">
                            <span class="icon-competitions-menu fs-5 me-3"></span>
                            <span class="sidemenu-label">{{
                                $t("sidebar.comp_adv")
                            }}</span>
                        </router-link>
                    </li>

                    <!-- <li
                        class="nav-item"
                        :class="{ active: $route.name == 'governorates' }"
                        v-if="hasPermission('read', 'Governorate')"
                    >
                        <router-link to="/governorates" class="nav-link">
                            <font-awesome-icon icon="fa-solid fa-tv" />
                            <span class="sidemenu-label">{{
                                $t("sidebar.governorates")
                            }}</span>
                        </router-link>
                    </li> -->

                    <!-- <li
                        class="nav-item"
                        :class="{ active: $route.name == 'countries' }"
                        v-if="hasPermission('read', 'Country')"
                    >
                        <router-link to="/countries" class="nav-link">
                            <font-awesome-icon icon="fa-solid fa-tv" />
                            <span class="sidemenu-label">{{
                                $t("sidebar.countries")
                            }}</span>
                        </router-link>
                    </li> -->

                     <!-- v-if="hasPermission('read', 'ActivityLog')" -->
                    <li
                        class="nav-item"

                        :class="{ show: $route.meta.parent == 'settings' }"
                    >
                        <a class="nav-link subMenu with-sub" href="#">
                            <span class="icon-setting-menu fs-5 me-3"></span>
                            <span class="sidemenu-label">{{
                                $t("sidebar.settings")
                            }}</span>
                        </a>
                        <ul class="nav-sub">
                            <li
                                class="nav-sub-item"
                                :class="{
                                    active: $route.name == 'competition-types',
                                }"
                            >
                                <router-link
                                    to="/settings/competition-types"
                                    class="nav-sub-link"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-circle"
                                        class="me-2 fs-6px"
                                    />
                                    {{ $t("sidebar.competition_types") }}
                                </router-link>
                            </li>
                            <li
                                class="nav-sub-item"
                                :class="{
                                    active: $route.name == 'contestant-levels',
                                }"
                            >
                                <router-link
                                    to="/settings/contestant-levels"
                                    class="nav-sub-link"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-circle"
                                        class="me-2 fs-6px"
                                    />
                                    {{ $t("sidebar.contestants_levels") }}
                                </router-link>
                            </li>
                            <li
                                class="nav-sub-item"
                                :class="{
                                    active: $route.name == 'arbitrator-levels',
                                }"
                            >
                                <router-link
                                    to="/settings/arbitrator-levels"
                                    class="nav-sub-link"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-circle"
                                        class="me-2 fs-6px"
                                    />
                                    {{ $t("sidebar.arbitrators_levels") }}
                                </router-link>
                            </li>
<!--                            <li-->
<!--                                class="nav-sub-item"-->
<!--                                :class="{-->
<!--                                    active: $route.name == 'stages',-->
<!--                                }"-->
<!--                            >-->
<!--                                <router-link-->
<!--                                    to="/settings/stages"-->
<!--                                    class="nav-sub-link"-->
<!--                                >-->
<!--                                    <font-awesome-icon-->
<!--                                        icon="fa-solid fa-circle"-->
<!--                                        class="me-2 fs-6px"-->
<!--                                    />-->
<!--                                    {{ $t("sidebar.competition_stages") }}-->
<!--                                </router-link>-->
<!--                            </li>-->
<!--                            <li-->
<!--                                class="nav-sub-item"-->
<!--                                :class="{-->
<!--                                    active: $route.name == 'competition-levels2',-->
<!--                                }"-->
<!--                            >-->
<!--                                <router-link-->
<!--                                    to="/settings/competition-levels2"-->
<!--                                    class="nav-sub-link"-->
<!--                                >-->
<!--                                    <font-awesome-icon-->
<!--                                        icon="fa-solid fa-circle"-->
<!--                                        class="me-2 fs-6px"-->
<!--                                    />-->
<!--                                    {{ $t("sidebar.competition_levels") }}-->
<!--                                </router-link>-->
<!--                            </li>-->
                            <li
                                class="nav-sub-item"
                                :class="{
                                    active: $route.name == 'sample',
                                }"
                            >
                                <router-link
                                    to="/settings/samples"
                                    class="nav-sub-link"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-circle"
                                        class="me-2 fs-6px"
                                    />
                                    {{ $t("sidebar.contract_forms") }}
                                </router-link>
                            </li>
                            <li
                                class="nav-sub-item"
                                :class="{
                                    active: $route.name == 'places',
                                }"
                            >
                                <router-link
                                    to="/settings/places"
                                    class="nav-sub-link"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-circle"
                                        class="me-2 fs-6px"
                                    />
                                    {{ $t("sidebar.places") }}
                                </router-link>
                            </li>
                            <li
                                class="nav-sub-item"
                                :class="{
                                    active: $route.name == 'logs',
                                }"
                                v-if="hasPermission('read', 'ActivityLog')"
                            >
                                <router-link
                                    to="/settings/logs"
                                    class="nav-sub-link"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-circle"
                                        class="me-2 fs-6px"
                                    />
                                    {{ $t("sidebar.logs") }}
                                </router-link>
                            </li>
                            <li
                                class="nav-sub-item"
                                v-if="hasPermission('read', 'GeneralSettings')"
                                :class="{
                                    active: $route.name == 'general_settings',
                                }"
                            >
                                <router-link
                                    to="/settings/general"
                                    class="nav-sub-link"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-circle"
                                        class="me-2 fs-6px"
                                    />
                                    {{ $t("sidebar.general_settings") }}
                                </router-link>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "side-bar",
};
</script>
