<script>
import AdminApi from '@api/admin.api';
import RoleApi from '@api/role.api';
import EmployeeApi from '@api/employee.api';

export default {
    name: 'admin-form',

    data() {
        return {
            isUpdateForm: !!this.$route.params.id,
            form_type: !this.$route.query.form_type ? 'edit' : this.$route.query.form_type,
            add_form_title: '',
            form: {
                first_name: '',
                middle_name: '',
                last_name: '',
                email: '',
                mobile: '',
                password: '',
                password_confirmation: '',
                roles: [],
                user_id: '',
            },
            system_roles: [],
            system_employees: [],
            error: ''
        }
    },

    created() {
        this.add_form_title = (this.form_type == 'new') ? 'messages.add_new_admin' : 'messages.add_employee_admin';
        if (this.isUpdateForm) {
            this.getAdmin();
        }
        this.getSystemRoles();
        if (this.form_type == 'exist') this.getEmployees();
    },

    methods: {
        getAdmin() {
            return AdminApi.get({
                id: this.$route.params.id,
            })
                .then(resp => {
                    // console.log('emp');
                    const admin = resp.data.data.admin;

                    this.form.id = admin.id;
                    this.form.first_name = admin.first_name;
                    this.form.middle_name = admin.middle_name;
                    this.form.last_name = admin.last_name;
                    this.form.email = admin.email;
                    this.form.mobile = admin.mobile;
                    this.form.roles = admin.roles_ids
                    // console.log(this.form);
                });
        },
        getSystemRoles() {
            return RoleApi.list({
                type: this.form_type
            })
                .then(resp => {
                    this.system_roles = resp.data.data.map(role => {
                        return {
                            id: role.id,
                            text: role.name
                        }
                    });
                });
        },
        getEmployees() {
            return EmployeeApi.list({
                limit: 0,
                page: 0,
                employee: true
            })
                .then(resp => {
                    this.system_employees = resp.data.data.map(emp=>{
                        return {
                            id:emp.id,
                            text:emp.full_name
                        }
                    });
                });
        },
        submit() {
            if (this.isUpdateForm) {
                return AdminApi.update(this.form)
                    .then((response) => {
                        this.$router.back();
                    }).catch((error) => {
                        this.error = error.response.data.errors;
                    });
            }

            return AdminApi.store(this.form)
                .then((response) => {
                    this.$router.back();
                }).catch((error) => {
                    this.error = error.response.data.errors;
                });
        }
    }
}

</script>

<template>
    <section class="content">
        <div class="container-fluid">
            <h4 class="font-weight-bold bordered-title ">
                <back-button/>
                <span>{{ $t('sidebar.admins') }}</span>
            </h4>

            <h6 class="text-secondary font-weight-semibold mt-3">
                {{ isUpdateForm ? $t('messages.edit_admin') : $t(this.add_form_title) }}
            </h6>

            <div class="py-2">
                <div class="card rounded border-0 shadow-sm mt-4">
                    <div class="card-body">
                        <form action="#">
                            <div class="form-row" v-if="(form_type=='new') || (form_type=='edit')">

                                <div class="form-group col-lg-4 col-md-6">
                                    <label for="firstName">الإسم الأول </label>
                                    <input type="text" class="form-control" name="firstName" id="firstName"
                                           placeholder=" الإسم الأول " v-model="form.first_name">
                                    <small class="text-danger"
                                           v-if="error['first_name']">{{ error['first_name'][0] }}</small>
                                </div>

                                <div class="form-group col-lg-4 col-md-6">
                                    <label for="middleName">الإسم الأوسط </label>
                                    <input type="text" class="form-control" name="middleName" id="middleName"
                                           placeholder=" الإسم الأوسط " v-model="form.middle_name">
                                    <small class="text-danger"
                                           v-if="error['middle_name']">{{ error['middle_name'][0] }}</small>
                                </div>

                                <div class="form-group col-lg-4 col-md-6">
                                    <label for="lastName">الإسم الأخير </label>
                                    <input type="text" class="form-control" name="lastName" id="lastName"
                                           placeholder=" الإسم الأخير " v-model="form.last_name">
                                    <small class="text-danger"
                                           v-if="error['last_name']">{{ error['last_name'][0] }}</small>
                                </div>

                                <div class="form-group col-lg-4 col-md-6">
                                    <label for="email">البريد الإلكتروني </label>
                                    <input type="email" class="form-control" name="email" id="email"
                                           placeholder=" البريد الإلكتروني " v-model="form.email">
                                    <small class="text-danger" v-if="error['email']">{{ error['email'][0] }}</small>
                                </div>

                                <div class="form-group col-lg-4 col-md-6">
                                    <label for="phoneNumber">رقم الهاتف </label>
                                    <input type="text" class="form-control" name="phoneNumber" id="phoneNumber"
                                           placeholder=" رقم الهاتف " v-model="form.mobile">
                                    <small class="text-danger" v-if="error['mobile']">{{ error['mobile'][0] }}</small>
                                </div>

                                <div class="form-group  col-md-6">
                                    <label for="pass">كلمة المرور </label>
                                    <input type="password" class="form-control" name="pass" id="pass"
                                           placeholder=" ********* " v-model="form.password"
                                           autocomplete="new-password">
                                    <small class="text-danger"
                                           v-if="error['password']">{{ error['password'][0] }}</small>
                                </div>

                                <div class="form-group  col-md-6">
                                    <label for="confirmPass">تأكيد كلمة المرور</label>
                                    <input type="password" class="form-control" name="confirmPass" id="confirmPass"
                                           placeholder=" ********* " v-model="form.password_confirmation">
                                    <small class="text-danger" v-if="error['password_confirmation']">
                                        {{ error['password_confirmation'][0] }}
                                    </small>
                                </div>
                            </div>

                            <div class="form-row" v-else>
                                <div class="form-group col-md-6">
                                    <label for="user_id">اسم الموظف </label>
                                    <Select2 :options="system_employees"
                                             :settings="{ placeholder: $t('messages.select_employee')}"
                                             v-model="form.user_id"/>
<!--                                    <select id="user_id" class="form-control" v-model="">
                                        <option value="" selected>اختر أحد الموظفين</option>
                                        <option v-for="(employee, index) in system_employees" v-bind:key="index"
                                                :value="employee.id">
                                            {{ employee.full_name }}
                                        </option>
                                    </select>-->
                                    <small class="text-danger" v-if="error['user_id']">
                                        {{ error['user_id'][0] }}
                                    </small>
                                </div>

                            </div>
                            <hr/>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="roles">الصلاحيات </label>
                                    <Select2 :options="system_roles"
                                             :settings="{ placeholder: $t('sidebar.roles'), allowClear: true,multiple: true }"
                                              v-model="form.roles"/>
<!--                                    <select id="roles" class="form-control" v-model="form.roles[0]" multiple>
                                        <option v-for="(role, index) in system_roles" v-bind:key="index"
                                                :value="role.id">
                                            {{ role.name }}
                                        </option>
                                    </select>-->
                                    <small class="text-danger" v-if="error['roles']">
                                        {{ error['roles'][0] }}
                                    </small>
                                </div>
                            </div>

                            <button class="btn btn-secondary" @click.prevent="submit"> حفظ</button>
                            <cancel-button/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
