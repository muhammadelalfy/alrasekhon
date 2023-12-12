<script>
import { useToast } from "vue-toastification";
import AdminApi from "@api/admin.api";
import Filters from "@views/layouts/partials/Filters.vue";

export default {
    name: "admin-index",

    components: {
        Filters,
    },

    data() {
        return {
            admins: [],
            filters: { page: 1, allAdmins: true },
            pagination: {},
        };
    },

    created() {
        this.getAdmins();
    },

    methods: {
        getAdmins(page = 1) {
            this.filters.page = page;

            AdminApi.list(this.filters)
                .then(({ data }) => {
                    this.admins = data.data;
                    this.pagination = data.meta;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        delAdmin(admin, index) {
            AdminApi.delete(admin).then((resp) => {
                this.admins.splice(index, 1);
                useToast().success(resp.data.message);
            });
        },
        statusAdmin(admin, index) {
            AdminApi.changeStatus(admin).then((resp) => {
                this.getAdmins();
                useToast().success(resp.data.message);
            });
        },
    },
};
</script>

<template>
    <section class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between flex-wrap">
                <h4 class="font-weight-bold bordered-title">
                    <span>{{ $t("sidebar.admins") }}</span>
                </h4>
                <div class="d-flex flex-wrap" v-if="$can('create', 'User')">
                    <router-link
                        :to="{
                            path: '/new-admin',
                            query: { form_type: 'exist' },
                        }"
                        class="btn btn-secondary mt-0"
                    >
                        <svg class="ico-svg ml-2">
                            <use xlink:href="#ico-plus" />
                        </svg>
                        {{ $t("messages.add_employee_admin") }}
                    </router-link>

                    <router-link
                        :to="{
                            path: '/new-admin',
                            query: { form_type: 'new' },
                        }"
                        class="btn btn-secondary mt-0"
                    >
                        <svg class="ico-svg ml-2">
                            <use xlink:href="#ico-plus" />
                        </svg>
                        {{ $t("messages.add_new_admin") }}
                    </router-link>
                </div>
            </div>

            <div class="py-2 mt-4">
                <filters @submit="getAdmins" :model="filters"></filters>

                <div class="table-responsive">
                    <table class="table table-borderless text-center">
                        <thead>
                            <tr class="bg-lightblue rounded">
                                <th>#</th>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>رقم الهاتف</th>
                                <th>الصلاحيات</th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="!admins.length">
                                <td colspan="100%">
                                    {{ $t("messages.no_data") }}
                                </td>
                            </tr>

                            <transition-group name="fade">
                                <tr
                                    class="bg-white rounded"
                                    v-for="(admin, index) in admins"
                                    :key="admin.id"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ admin.name }}</td>
                                    <td>{{ admin.email }}</td>
                                    <td>{{ admin.mobile }}</td>
                                    <td>
                                        <ul
                                            v-for="(
                                                roleName, index
                                            ) in admin.roles"
                                            :key="index"
                                        >
                                            <li>{{ roleName }}</li>
                                        </ul>
                                    </td>
                                    <td>{{ admin.status_value }}</td>
                                    <td
                                        class="d-flex align-items-center justify-content-center flex-wrap"
                                    >
                                        <router-link
                                            :to="`/edit-admin/${admin.id}`"
                                            class="btn btn-light-babyblue btn-icon rounded p-0 mx-1"
                                            v-if="$can('update', 'User')"
                                        >
                                            <i
                                                class="fas fa-edit darkPrimaryClr"
                                            ></i>
                                        </router-link>

                                        <!--
                                    <button type="button" class="btn btn-light-secondary btn-icon rounded p-0 mx-1"
                                            @click="statusAdmin(admin, index)" v-show="(admin.id !== 1)"
                                            v-if="$can('update', 'User')">
                                        <i class="fas fa-ban redClr"></i>
                                    </button>
-->

                                        <button
                                            type="button"
                                            class="btn btn-light-danger btn-icon rounded p-0 mx-1"
                                            @click="delAdmin(admin, index)"
                                            v-show="admin.id !== 1"
                                            v-if="$can('delete', 'User')"
                                        >
                                            <svg class="ico-svg">
                                                <use xlink:href="#ico-trash" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </transition-group>
                        </tbody>
                    </table>
                </div>

                <pagination :pagination="pagination" @paginate="getAdmins" />
            </div>
        </div>
    </section>
</template>
