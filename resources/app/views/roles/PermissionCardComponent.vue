<template>
    <card class="p-2">
        <template #default>
            <div class="form-check bg-controlBg p-2 rounded mb-2">
                <input
                    class="form-check-input me-2 ms-0 group_title_checkboxes"
                    type="checkbox"
                    :id="`${groupTitle}-checkbox`"
                    :checked="allSelected"
                    @click="selectAll($event)"
                />
                <label
                    class="form-check-label text-secondary fw-bold"
                    :for="`${groupTitle}-checkbox`"
                >
                    {{ $t(`role_permissions.${groupTitle}`) }}
                </label>
            </div>
            <div class="px-2">
                <div
                    class="form-check"
                    v-for="(permission, index) in permissions"
                    :key="index"
                >
                    <input
                        class="form-check-input me-2 permission_checkbox"
                        type="checkbox"
                        v-model="modelValue[groupTitle]"
                        :id="`checkbox-${permission.id}`"
                        :value="permission.id"
                        @click="checkIfSelectAll('.permission_checkbox')"
                    />
                    <label
                        class="form-check-label"
                        :for="`checkbox-${permission.id}`"
                    >
                        <span v-if="groupTitle !== `Report`">{{ $t(`role_permissions.${permission.name.split('_')[0]}`) }} {{ $t(`role_permissions.${groupTitle}`) }}</span>
                        <span v-if="groupTitle === `Report`">{{ $t(`role_permissions.${permission.name}`) }} </span>
                    </label>
                </div>
            </div>
        </template>
    </card>
</template>

<script>
export default {
    name: "PermissionCard",
    props: {
        modelValue: {
            type: [Object],
            required: true,
        },
        permissions: {
            type: Array,
            default: [],
        },
        groupTitle: {
            type: String,
            default: null,
        },
        selectedPermissions: {
            type: Array,
            default: [],
        },
    },

    data() {},

    computed: {
        allSelected() {
            return (
                this.modelValue !== undefined &&
                this.modelValue[this.groupTitle] &&
                this.modelValue[this.groupTitle].length ===
                this.permissions.length
            );
        },
    },

    created() {
        if (this.modelValue !== undefined && !this.modelValue[this.groupTitle]){
            this.modelValue[this.groupTitle] = [];
        }
    },

    methods: {
        selectAll(ev) {
            if (ev.target.checked) {
                return this.permissions.forEach((perm) =>
                    this.modelValue[this.groupTitle].push(perm.id)
                );

            } else {
                $('.select_all_permissions').prop('checked', false)
            }

            this.modelValue[this.groupTitle] = [];

            this.checkIfSelectAll('.group_title_checkboxes')

        },
        checkIfSelectAll(selector){


            $(selector).click(function() {
                let allChecked = $(selector+':checked').length === $(selector).length;
                if (allChecked){
                    $('.select_all_permissions').prop('checked', true)
                } else {
                    $('.select_all_permissions').prop('checked', false)
                }
            });
        }
    },
};
</script>
