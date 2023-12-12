<template>
    <form class="d-flex flex-column">
        <card>
            <template #body>
                <form-input
                    label="pages.name"
                    type="text"
                    :model="form"
                    name="name"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />

                <div class="form-check bg-controlBg p-2 rounded mb-2">
                    <input
                        class="form-check-input me-2 ms-0 select_all_permissions"
                        type="checkbox"
                        :id="`selectAll`"
                        :checked="isAllSelected"
                        @click="selectAllPermission($event)"
                    />
                    <label
                        class="form-check-label text-secondary fw-bold"
                        :for="`selectAll`"
                    >
                        {{ $t(`role_permissions.select_all`) }}
                    </label>
                </div>
            </template>
        </card>

        <div class="mb-3 row">
            <div
                class="col-md-4"
                v-for="(model_permissions, index) in this.system_permissions"
                :key="index"
            >
                <permission-card
                    :permissions="model_permissions"
                    :group-title="index"
                    v-model="form.role_permissions"
                    :update-form="isUpdateForm"
                >
                </permission-card>
            </div>
        </div>

        <div class="d-flex align-items-cenetr pt-4 justify-content-end mb-4">
            <button
                type="button"
                @click.prevent="submit"
                class="btn btn-babyblue text-white fw-bold"
            >
                {{ $t("forms.save") }}
            </button>
            <cancel-button />
        </div>
    </form>
</template>

<script>
import RoleApi from "@api/role.api";
import PermissionApi from "@api/permission.api";
import PermissionCard from "./PermissionCardComponent.vue";
import { useToast } from "vue-toastification";
import CancelButton from "@/components/CancelButton.vue";
export default {
    name: "RoleForm",
    components: {
        CancelButton,
        PermissionCard,
    },

    data() {
        return {
            isUpdateForm: !!this.$route.params.id,
            isReadonly: false,
            form: {
                name: "",
                role_permissions: {},
            },
            system_permissions: [],
            userRolePermissionCounts: 0,
            allRolesPermissionsCounts: [],
        };
    },

    methods: {
        getRole() {
            return RoleApi.get({
                id: this.$route.params.id,
            }).then((resp) => {
                const role = resp.data.data.role;
                this.form.id = role.id;
                this.form.name = role.name;
                this.form.role_permissions = role.permissions;
                this.userRolePermissionCounts = role.permissions_counts;
                if (role.id == 1 || role.id == 2) this.isReadonly = true;
            });
        },
        getSystemPermissions() {
            return PermissionApi.list().then((resp) => {
                this.system_permissions = resp.data;
                for (const perm in resp.data) {
                    this.allRolesPermissionsCounts.push(perm);
                }
            });
        },
        submit() {
            if (this.isUpdateForm) {
                return RoleApi.update(this.form)
                    .then((response) => {
                        useToast().success(response.data.message);
                        this.$router.back();
                    })
                    .catch((error) => {
                        this.formErrors = error.response.data.errors;
                    });
            }

            return RoleApi.store(this.form)
                .then((response) => {
                    useToast().success(response.data.message);
                    this.$router.back();
                })
                .catch((error) => {
                    this.formErrors = error.response.data.errors;
                });
        },

        selectAllPermission(event) {
            if (event.target.checked) {
                $(".group_title_checkboxes").each(function () {
                    if (!$(this).prop("checked")) {
                        $(this).trigger("click");
                        $(this).prop("checked", true);
                    } else {
                        $(this).prop("checked", true);
                    }
                });
            } else {
                $(".group_title_checkboxes").each(function () {
                    $(this).trigger("click");
                    $(this).prop("checked", false);
                });
            }
        },


    },

    mounted() {
        if (this.isUpdateForm) {
            this.getRole();
        }
        this.getSystemPermissions();
    },

    computed: {
        isAllSelected() {
            return (
                this.userRolePermissionCounts ===
                this.allRolesPermissionsCounts.length
            );
        },
    },
};
</script>
