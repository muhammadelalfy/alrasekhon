<template>
    <div v-if="$route.meta.title && $route.meta.breadcrumb" class="page-header">
        <div>
            <h2 class="main-content-title mb-0">
                {{ $t($route.meta.title) }}
            </h2>
            <nav aria-label="breadcrumb">
                <ol v-if="$route.meta.breadcrumb" class="breadcrumb">
                    <li
                        v-for="(bread, index) in $route.meta.breadcrumb"
                        :key="index"
                        class="breadcrumb-item"
                        :aria-current="bread.name == $route.name && 'page'"
                        :class="bread.name == $route.name && 'active'"
                    >
                        <template v-if="bread.name == $route.name">
                            {{ $t(bread.title) }}
                        </template>
                        <router-link v-else :to="{ name: bread.name }">
                            {{ $t(bread.title) }}
                        </router-link>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="d-flex flex-wrap align-items-center">
            <div v-if="$route.meta.export" class="btn-list d-inline-flex">
                <el-tooltip
                    class="box-item"
                    effect="dark"
                    content="pdf"
                    placement="bottom"
                >
                    <button
                        type="button"
                        class="btn btn-icon btn-danger me-2 fs-6"
                    >
                        <font-awesome-icon icon="fa-solid fa-file-pdf" />
                    </button>
                </el-tooltip>
                <el-tooltip
                    class="box-item"
                    effect="dark"
                    content="print"
                    placement="bottom"
                >
                    <button
                        type="button"
                        class="btn btn-icon btn-lightGray me-2 fs-6"
                    >
                        <font-awesome-icon icon="fa-solid fa-print" />
                    </button>
                </el-tooltip>
            </div>
            <div
                v-if="$route.meta.filter"
                data-bs-toggle="tooltip"
                data-bs-placement="bottom"
                :title="$t('forms.filter')"
            >
                <button
                    type="button"
                    class="btn btn-grayClr text-white me-1"
                    data-bs-toggle="collapse"
                    data-bs-target="#formFilter"
                    aria-expanded="false"
                    aria-controls="formFilter"
                >
                    <font-awesome-icon icon="fa-solid fa-filter" />
                </button>
            </div>

            <router-link
                v-if="
                    $route.meta.addNewBtn.status && !$route.meta.addNewBtn.modal
                "
                :to="$route.meta.addNewBtn.name"
                class="btn ripple btn-babyblue text-white"
            >
                <font-awesome-icon icon="fa-solid fa-plus" class="me-1" />
                {{ $t($route.meta.addNewBtn.title) }}
            </router-link>
            <button
                v-if="
                    $route.meta.addNewBtn.status && $route.meta.addNewBtn.modal
                "
                id="modal-btn"
                type="button"
                class="btn ripple btn-babyblue text-white"
                data-bs-toggle="modal"
                data-bs-target="#MainAddModal"
            >
                <font-awesome-icon icon="fa-solid fa-plus" class="me-1" />
                {{ $t($route.meta.addNewBtn.title) }}
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "BreadCrumb",
};
</script>
