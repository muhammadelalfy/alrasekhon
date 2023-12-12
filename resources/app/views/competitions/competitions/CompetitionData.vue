<template>
    <div class="btn-list px-3 d-flex justify-content-end">
        <el-tooltip
            class="box-item"
            effect="dark"
            content="pdf"
            placement="bottom"
        >
            <button type="button" class="btn btn-icon btn-danger me-2 fs-6">
                <font-awesome-icon icon="fa-solid fa-file-pdf" />
            </button>
        </el-tooltip>
        <el-tooltip
            class="box-item"
            effect="dark"
            content="print"
            placement="bottom"
        >
            <button type="button" class="btn btn-icon btn-lightGray me-2 fs-6">
                <font-awesome-icon icon="fa-solid fa-print" />
            </button>
        </el-tooltip>
    </div>
    <el-collapse v-model="activeName" accordion @change="handleChange">
        <el-collapse-item :title="$t('pages.main_data')" name="1" class="mb-3">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.competition_name") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray"
                        >اهل الرضوان
                    </span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.competition_type") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray">قراءات</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.competition_start_date") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray">09/07/1995</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.competition_end_date") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray">09/07/1995</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.registration_start_date") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray">09/07/1995</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.registration_end_date") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray">09/07/1995</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.contestants_max_num") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray">95</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.competition_budget") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray">95</span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.age_group") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray d-block"
                        >فئة الشباب : من 20 - 25 سنه</span
                    >
                    <span class="fs-14 fw-bold text-darkGray d-block"
                        >فئة الاطفال : من 20 - 25 سنه</span
                    >
                </div>
            </div>
        </el-collapse-item>
        <el-collapse-item
            :title="$t('pages.competition_levels')"
            name="2"
            class="mb-3"
        >
            <div class="row">
                <div class="col-12 mb-3 table-responsive">
                    <table
                        class="table-data dt-responsive table w-100 table-borderless"
                    >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ $t("pages.level_name") }}</th>
                                <th>{{ $t("pages.level_rules") }}</th>
                                <th>{{ $t("pages.contestants_num") }}</th>
                                <th>{{ $t("pages.winners_num") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>القرآن الكريم كاملا</td>
                                <td>القرآن كاملا</td>
                                <td>55</td>
                                <td>22</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>القرآن الكريم كاملا</td>
                                <td>القرآن كاملا</td>
                                <td>55</td>
                                <td>22</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>القرآن الكريم كاملا</td>
                                <td>القرآن كاملا</td>
                                <td>55</td>
                                <td>22</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </el-collapse-item>
        <el-collapse-item
            :title="$t('sidebar.competition_stages')"
            name="3"
            class="mb-3"
        >
            <div class="row">
                <div class="col-12 mb-3 table-responsive">
                    <table
                        class="table-data dt-responsive table w-100 table-borderless"
                    >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ $t("pages.stage_name") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>المرحلة الاولي</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>المرحلة الاولي</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>المرحلة الاولي</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </el-collapse-item>
        <el-collapse-item
            :title="$t('pages.competition_place')"
            name="4"
            class="mb-3"
        >
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.country") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">مصر </span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.governorate") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">الجيزة </span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.city") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">عين شمس </span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.competition_place") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray"
                        >مسجد عمرو بن العاص
                    </span>
                </div>
            </div>
        </el-collapse-item>
        <el-collapse-item
            :title="$t('pages.arbitration_committees')"
            name="5"
            class="mb-3"
        >
            <div class="row">
                <div class="col-12 mb-3 table-responsive">
                    <table
                        class="table-data dt-responsive table w-100 table-borderless"
                    >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ $t("pages.committee_name") }}</th>
                                <th>{{ $t("pages.competition_level") }}</th>
                                <th>{{ $t("pages.competition_stage") }}</th>
                                <th>{{ $t("pages.arbitrators_num") }}</th>
                                <th>{{ $t("pages.committee_members") }}</th>
                                <th>{{ $t("pages.committee_chairman") }}</th>
                                <th>
                                    {{ $t("pages.vice_committee_chairman") }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>اهل الرضوان</td>
                                <td>القرآن كاملا</td>
                                <td>مرحلة التصفيات</td>
                                <td>5</td>
                                <td>
                                    <div class="d-flex align-items-start less">
                                        <a
                                            class="me-1 px-2 bg-primary fs-11 wh-20px text-white d-inline-flex align-items-center justify-content-center btn-collapse"
                                            href="javascript:void(0)"
                                        >
                                            <span class="view-more">
                                                <font-awesome-icon
                                                    icon="fa-solid fa-plus"
                                                />
                                            </span>
                                            <span class="d-none view-less">
                                                <font-awesome-icon
                                                    icon="fa-solid fa-minus"
                                                />
                                            </span>
                                        </a>
                                        <span class="list">
                                            <div>اماني قاسم</div>
                                            <div>اماني قاسم</div>
                                            <div>اماني قاسم</div>
                                            <div>اماني قاسم</div>
                                        </span>
                                    </div>
                                </td>
                                <td>اماني قاسم</td>
                                <td>اماني قاسم</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>اهل الرضوان</td>
                                <td>القرآن كاملا</td>
                                <td>مرحلة التصفيات</td>
                                <td>5</td>
                                <td>
                                    <div class="d-flex align-items-start less">
                                        <a
                                            class="me-1 px-2 bg-primary fs-11 wh-20px text-white d-inline-flex align-items-center justify-content-center btn-collapse"
                                            href="javascript:void(0)"
                                        >
                                            <span class="view-more">
                                                <font-awesome-icon
                                                    icon="fa-solid fa-plus"
                                                />
                                            </span>
                                            <span class="d-none view-less">
                                                <font-awesome-icon
                                                    icon="fa-solid fa-minus"
                                                />
                                            </span>
                                        </a>
                                        <span class="list">
                                            <div>اماني قاسم</div>
                                            <div>اماني قاسم</div>
                                            <div>اماني قاسم</div>
                                            <div>اماني قاسم</div>
                                        </span>
                                    </div>
                                </td>
                                <td>اماني قاسم</td>
                                <td>اماني قاسم</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </el-collapse-item>
        <el-collapse-item
            :title="$t('pages.honoring_ceremony')"
            name="6"
            class="mb-3"
        >
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.country") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">مصر </span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.governorate") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">الجيزة </span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">{{ $t("pages.city") }}</h6>
                    <span class="fs-14 fw-bold text-darkGray">عين شمس </span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.competition_place") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray"
                        >مسجد عمرو بن العاص
                    </span>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-grayClr">
                        {{ $t("pages.ceremony_date") }}
                    </h6>
                    <span class="fs-14 fw-bold text-darkGray">09/07/1995</span>
                </div>
            </div>
        </el-collapse-item>
        <el-collapse-item
            :title="$t('pages.competition_prizes')"
            name="7"
            class="mb-3"
        >
            <div class="row">
                <div class="col-12 mb-3 table-responsive">
                    <table
                        class="table-data dt-responsive table w-100 table-borderless"
                    >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ $t("pages.competition_level") }}</th>
                                <th>{{ $t("pages.winner_ranking") }}</th>
                                <th>{{ $t("pages.value_financial") }}</th>
                                <th>{{ $t("pages.certificates_honors") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>المستوي</td>
                                <td>1</td>
                                <td>10000</td>
                                <td>الشهادات والأوسمة</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>المستوي</td>
                                <td>1</td>
                                <td>10000</td>
                                <td>الشهادات والأوسمة</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>المستوي</td>
                                <td>1</td>
                                <td>10000</td>
                                <td>الشهادات والأوسمة</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </el-collapse-item>
        <el-collapse-item
            :title="$t('pages.standards_conditions')"
            name="8"
            class="mb-3"
        >
            <div class="row">
                <div class="col-12 mb-3">
                    <span class="fs-14 fw-bold text-darkGray">
                        المعايير والشروط المعايير والشروط المعايير والشروط
                        المعايير والشروط المعايير والشروط المعايير والشروط
                        المعايير والشروط المعايير والشروط المعايير والشروط
                        المعايير والشروط المعايير والشروط المعايير والشروط
                        المعايير والشروط المعايير والشروط المعايير والشروط
                        المعايير والشروط المعايير والشروط المعايير والشروط
                        المعايير والشروط المعايير والشروط
                    </span>
                </div>
            </div>
        </el-collapse-item>
        <el-collapse-item
            :title="$t('pages.advertising_form')"
            name="9"
            class="mb-3"
        >
            <div class="row">
                <div class="col-md-4 mb-3">
                    <card class="shadow p-2">
                        <template #default>
                            <div class="video-container" id="video-container">
                                <img
                                    :src="`${publicPath}/assets/images/authBg.png`"
                                    :data-src="`${publicPath}/assets/images/authBg.png`"
                                    alt="sample"
                                />
                            </div>
                            <h6
                                class="text-grayClr fs-14 mb-1 mt-2 text-center"
                            >
                                اسم النموذج
                            </h6>
                        </template>
                    </card>
                </div>
            </div>
        </el-collapse-item>
    </el-collapse>
</template>

<script lang="ts" setup>
import { ref, onMounted } from "vue";
const activeName = ref("1");
const handleChange = (val: string[]) => {
    console.log(val);
};
onMounted(() => {
    /*basic responsive Datatable*/
    $(".table-data").DataTable({
        lengthChange: false,
        searching: false,
        paging: false,
        info: false,
        ordering: false,
        order: [],
        responsive: true,
    });

    function btnPlusCollapse() {
        $(this).parent().toggleClass("less");
        if ($(this).parent().hasClass("less")) {
            $(this).find(".view-more").removeClass("d-none");
            $(this).find(".view-less").addClass("d-none");
        } else {
            $(this).find(".view-less").removeClass("d-none");
            $(this).find(".view-more").addClass("d-none");
        }
    }

    $(".btn-collapse").on("click", btnPlusCollapse);
    $(".table-data tbody").on("click", "td.dtr-control", function () {
        $(".dtr-data .btn-collapse").on("click", btnPlusCollapse);
    });
});
</script>
