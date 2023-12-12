<template>
    <div id="formFilter" class="collapse multi-collapse">
        <card>
            <template #body>
                <filters :model="filters" @submit="getUsers">
                    <div class="col-md-4 col-lg-3">
                        <form-select
                            title="pages.role"
                            label="name"
                            name="role"
                            multiple
                            collapse-tags
                            collapse-tags-tooltip
                            @clearErrors="clearInput"
                            :model="filters"
                            :myOptions="roles"
                            :errors="formErrors"
                            label-field="label"
                            value-field="value"
                        />
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <form-select
                            title="pages.status"
                            label="name"
                            name="status"
                            @clearErrors="clearInput"
                            :model="filters"
                            :myOptions="statusOptions"
                            :errors="formErrors"
                            label-field="label"
                            value-field="value"
                        />
                    </div>
                </filters>
            </template>
        </card>
    </div>

    <Card class="pt-3" v-if="users.length">
        <template #default>
            <DataTable id="new-edit">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ $t("pages.name") }}</th>
                        <th>{{ $t("pages.email") }}</th>
                        <th>{{ $t("pages.role") }}</th>
                        <th>{{ $t("pages.status") }}</th>
                        <th>{{ $t("global.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) in users" :key="user.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ user.first_name + " " + user.second_name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.roles }}</td>
                        <td>
                            <form-switcher
                                id="status"
                                :model="user"
                                name="status"
                                :errors="formErrors"
                                @clearErrors="clearInput"
                                @toggle="toggle(user)"
                            >
                            </form-switcher>
                        </td>
                        <td>
                            <div class="btn-list d-inline-flex">
                                <router-link
                                    :to="{
                                        name: 'user-show',
                                        params: { id: user.id },
                                    }"
                                    class="btn btn-light-babyblue text-white me-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    :title="$t('forms.view')"
                                >
                                    <font-awesome-icon icon="fa-solid fa-eye" />
                                </router-link>
                                <router-link
                                    :to="`/users/edit/${user.id}`"
                                    class="btn btn-light-secondary text-white me-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    :title="$t('forms.edit')"
                                    v-if="hasPermission('update', 'User')"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-pen-to-square"
                                    />
                                </router-link>
                                <delete-button
                                    v-if="hasPermission('delete', 'User')"
                                    @del-model="delUser(user, index)"
                                />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </DataTable>
            <spinner v-if="this.$store.loaderStore.loading"></spinner>
            <pagination :pagination="pagination" @paginate="getUsers" />
        </template>
    </Card>
</template>

<script>
import { useToast } from "vue-toastification";
import userApi from "@api/user.api";
import RoleApi from "@api/role.api";
import Card from "@/components/Card.vue";
import { useI18n } from "vue-i18n";
import ContestantsApi from "@api/contestants.api";
import userForm from "@views/users/UserForm.vue";

export default {
    components: {
        Card,
        userForm,
    },
    name: "user-index",
    setup() {
        const { t } = useI18n();
        const statusOptions = [
            {
                value: "1",
                label: t("pages.active"),
            },
            {
                value: "0",
                label: t("pages.notActive"),
            },
            {
                value: "all",
                label: t("pages.all"),
            },
        ];
        return {
            t,
            statusOptions,
        };
    },
    data() {
        return {
            statusAction: {
                status: false,
            },
            filters: {
                page: 1,
            },
            users: [],
            roles: [],
            isLoading: false,
            pagination: {},
            user: {},
            title: "pages.add_new_user",
        };
    },
    created() {
        this.getUsers();
        this.getRoles();
    },
    methods: {
        getUsers(page = 1) {
            this.users = [];
            this.isLoading = true;
            this.filters.page = page;
            userApi
                .list(this.filters)
                .then(({ data }) => {
                    this.isLoading = false;
                    this.users = data.data;
                })
                .catch((error) => {
                    this.isLoading = false;
                    console.log(error);
                });
        },
        getRoles() {
            RoleApi.list()
                .then(({ data }) => {
                    let roles = [];
                    $.each(data.data, function (i, data) {
                        roles.push({ value: data.id, label: data.name });
                    });
                    console.log(roles);
                    this.roles = roles;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        toggle(userObject = {}) {
            userApi.changeStatus(userObject).then((resp) => {
                useToast().success(resp.data.message);
            });
        },
        delUser(user, index) {
            userApi.delete(user).then((resp) => {
                this.users.splice(index, 1);
                useToast().success(resp.data.message);
            });
        },
        userForm(user = {}) {
            if (user.id) {
                this.title = "pages.edit_user";
                this.user = _.cloneDeep(user);
            } else {
                this.title = "pages.add_new_user";
            }
            $("#userForm").modal("show");
        },
    },
};
</script>
