<template>
    <div id="formFilter" class="collapse multi-collapse">
        <card>
            <template #body>
                <filters :model="filters" @submit="getRoles"> </filters>
            </template>
        </card>
    </div>

    <Card class="pt-3" v-if="roles.length">
        <template #default>
            <DataTable id="new-edit">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ $t("pages.role") }}</th>
                        <th>{{ $t("pages.status") }}</th>
                        <th>{{ $t("global.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(role, index) in roles" :key="role.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ role.name }}</td>
                        <td>
                            <form-switcher
                                id="status"
                                :model="role"
                                name="status"
                                :errors="formErrors"
                                @clearErrors="clearInput"
                                @toggle="toggle(role)"
                            >
                            </form-switcher>
                        </td>
                        <td>
                            <div class="btn-list d-inline-flex">
                                <!-- <button
                                    type="button"
                                    class="btn btn-light-babyblue text-white me-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    :title="$t('forms.view')"
                                    @click="
                                        viewPermissions(role.permissions_names)
                                    "
                                >
                                    <font-awesome-icon icon="fa-solid fa-eye" />
                                </button> -->
                                <router-link
                                    :to="`/roles/edit/${role.id}`"
                                    class="btn btn-light-babyblue text-white me-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    :title="$t('forms.view')"
                                >
                                    <font-awesome-icon icon="fa-solid fa-eye" />
                                </router-link>
                                <router-link
                                    v-if="hasPermission('update', 'Role')"
                                    :to="`/roles/edit/${role.id}`"
                                    id="bEdit"
                                    class="btn btn-light-secondary text-white me-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    :title="$t('forms.edit')"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-pen-to-square"
                                    />
                                </router-link>
                                <delete-button
                                    v-if="hasPermission('delete', 'Role')"
                                    @del-model="delRole(role, index)"
                                />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </DataTable>
            <modal
                :showButton="false"
                title="pages.permissions"
                id="viewPermissions"
            >
                <template v-slot:body>
                    <span
                        v-for="permission in permissions"
                        class="badge bg-success m-1"
                    >
                        {{ permission }}
                    </span>
                </template>
            </modal>
            <spinner v-if="this.$store.loaderStore.loading"></spinner>
            <pagination :pagination="pagination" @paginate="getRoles" />
        </template>
    </Card>

    <!-- <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-header rounded-bottom-0 my-3">
                    <div class="card-body">
                        <filters @submit="getRoles" :model="filters"></filters>
                        <div class="table-responsive">
                            <table
                                class="table table-bordered border text-nowrap mb-0"
                                id="new-edit"
                                v-if="roles.length"
                            >
                                <thead>
                                    <tr>
                                        <th>{{ $t("global.name") }}</th>
                                        <th>{{ $t("pages.permissions") }}</th>
                                        <th name="bstable-actions">
                                            {{ $t("global.actions") }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(role, index) in roles"
                                        :key="role.id"
                                    >
                                        <td>{{ role.name }}</td>
                                        <td>
                                            <button
                                                class="btn btn-sm btn-babyblue text-white"
                                                @click="
                                                    viewPermissions(
                                                        role.permissions_names
                                                    )
                                                "
                                            >
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </td>
                                        <td name="bstable-actions">
                                            <div class="btn-list">
                                                <router-link
                                                    v-if="
                                                        hasPermission(
                                                            'update',
                                                            'Role'
                                                        )
                                                    "
                                                    :to="`/roles/edit/${role.id}`"
                                                    id="bEdit"
                                                    type="button"
                                                    class="btn btn-sm btn-babyblue text-white m-1"
                                                >
                                                    <span
                                                        class="fa fa-edit"
                                                    ></span>
                                                </router-link>
                                                <delete-button
                                                    v-if="
                                                        hasPermission(
                                                            'delete',
                                                            'Role'
                                                        )
                                                    "
                                                    @del-model="
                                                        delRole(role, index)
                                                    "
                                                />
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <modal
                            :showButton="false"
                            title="pages.permissions"
                            id="viewPermissions"
                        >
                            <template v-slot:body>
                                <span
                                    v-for="permission in permissions"
                                    class="badge bg-success m-1"
                                >
                                    {{ permission }}
                                </span>
                            </template>
                        </modal>
                        <spinner
                            v-if="this.$store.loaderStore.loading"
                        ></spinner>
                        <pagination
                            :pagination="pagination"
                            @paginate="getRoles"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</template>

<script>
import { useToast } from "vue-toastification";
import RoleApi from "@api/role.api";

export default {
    name: "role-index",
    components: {},

    data() {
        return {
            statusAction: {
                status: false,
            },
            roles: [],
            role: {},
            filters: {
                page: 1,
                embed: "permissions",
            },
            permissions: [],
            pagination: {},
        };
    },
    created() {
        this.getRoles();
    },
    methods: {
        getRoles(page = 1) {Role
            this.filters.page = page;
            RoleApi.list(this.filters)
                .then(({ data }) => {
                    this.roles = data.data;
                    this.pagination = data.meta;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        delRole(role, index) {
            RoleApi.delete(role).then((resp) => {
                this.roles.splice(index, 1);
                useToast().success(resp.data.message);
            });
        },
        viewPermissions(permissions) {
            this.permissions = permissions;
            $("#viewPermissions").modal("show");
        },
        toggle(roleObject = {}) {
            RoleApi.changeStatus(roleObject).then((resp) => {
                useToast().success(resp.data.message);
            });
        },
    },
};
</script>
