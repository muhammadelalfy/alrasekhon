<template>
    <div class="page-header inner">
        <div
            class="d-flex flex-column header-bg justify-content-center text-white w-100 p-4"
        >
            <img
                class="trans-180Deg"
                alt="bg"
                :src="`${publicPath}/assets/images/user_bg.png`"
            />
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <img
                        class="user-img position-relative"
                        alt="user image"
                        :src="`${publicPath}/assets/images/girl.svg`"
                    />
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5 class="mb-2">{{ user.first_name }}</h5>
                    <span class="d-block fw-light mb-3">{{
                        user.main_job
                    }}</span>
                    <router-link
                        :to="$route.meta.addNewBtn.name"
                        class="btn ripple btn-babyblue text-white px-4 fw-bold"
                    >
                        {{ $t("pages.edit_information") }}
                    </router-link>
                </div>
            </div>
        </div>
    </div>

    <el-collapse v-model="activeName" accordion>
        <el-collapse-item
            :title="$t('pages.user_main_info')"
            name="1"
            class="mb-3"
        >
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.dob") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{
                        user.birth_date
                    }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.national_iD") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{
                        user.national_id
                    }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.type") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{
                        user.gender_localized
                    }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.nationality") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{
                        user.nationality
                    }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.email") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{
                        user.email
                    }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.email_status") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{
                        user.email_status
                    }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.country") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{
                        user.country
                    }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.educational_qualification") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray">{{
                        user.qualifications
                    }}</span>
                </div>
            </div>
        </el-collapse-item>
        <el-collapse-item
            :title="$t('pages.address_info')"
            name="2"
            class="mb-3"
        >
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.phone") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{
                        user.phone
                    }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.phone_status") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{
                        user.phone_status
                    }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.lang") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{
                        user.lang_localized
                    }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.status") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">{{
                        user.status
                    }}</span>
                </div>
            </div>
        </el-collapse-item>
        <el-collapse-item :title="$t('pages.password')" name="3" class="mb-3">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.password") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">******</span>
                </div>
            </div>
        </el-collapse-item>
    </el-collapse>
</template>

<script>
import { ref } from "vue";
import userApi from "@api/user.api";

export default {
    data() {
        return {
            filters: {
                page: 1,
            },
            pagination: {},
            user: {},
            activeName: ref("1"),
        };
    },

    methods: {
        getUser() {
            userApi
                .get(this.$route.params.id, null, null)
                .then(({ data }) => {
                    console.log(data);
                    this.user = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
    },

    mounted() {
        this.getUser();
    },
};
</script>
