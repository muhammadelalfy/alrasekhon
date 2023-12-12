<template>
    <div id="formFilter" class="collapse multi-collapse">
        <card>
            <template #body>
                <filters @submit="getSamples" :model="filters">
                    <div class="col-md-4 col-lg-3">
                        <form-select
                            title="pages.category"
                            label="name"
                            name="category"
                            collapse-tags
                            collapse-tags-tooltip
                            :model="filters"
                            :myOptions="categoryOptions"
                            valueField="value"
                            labelField="label"
                        />
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <form-date-select
                            label="pages.date"
                            :model="filters"
                            type="daterange"
                            name="SearchDate"
                            :range-separator="$t('pages.to')"
                            :start-placeholder="$t('pages.start_date')"
                            :end-placeholder="$t('pages.end_date')"
                        />
                    </div>
                </filters>
            </template>
        </card>
    </div>

    <Card class="pt-3" v-if="samples.length">
        <template #default>
            <DataTable id="new-edit">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ $t("pages.name") }}</th>
                        <th>{{ $t("pages.category") }}</th>
                        <th>{{ $t("pages.last_update") }}</th>
                        <th>{{ $t("pages.date") }}</th>
                        <th>{{ $t("global.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                <tr v-for="(sample, index) in samples" :key="sample.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ sample.name_localized }}</td>
                    <td>{{ sample.contract_category_localized }}</td>
                    <td>{{ sample.last_update }}</td>
                    <td>{{ sample.created_at }}</td>

                        <td>
                            <div class="btn-list d-inline-flex">
                                <router-link
                                    to=""
                                    class="btn btn-light-babyblue text-white me-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    :title="$t('forms.view')"
                                >
                                    <font-awesome-icon icon="fa-solid fa-eye" />
                                </router-link>
                                <a
                                    :href="sample.file_url"
                                    type="button"
                                    class="btn btn-light-info text-white me-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    :title="$t('forms.download')"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-download"
                                    />
                                </a>
                                <button
                                    type="button"
                                    class="btn btn-light-success text-white me-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    :title="$t('forms.print')"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-print"
                                    />
                                </button>
                                <delete-button
                                    v-if="hasPermission('delete', 'Sample')"
                                    @del-model="delSample(sample, index)"
                                />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </DataTable>
        </template>
    </Card>

    <!-- Modal -->
    <SampleForm
        :sample="sample"
        :showButton="false"
        :title="isAdd ? $t('pages.add_contract') : $t('pages.edit_contract')"
        id="MainAddModal"
        aria-labelledby="MainAddModalLabel"
        :modal-dialog-centered="true"
        :modal-lg="true"
    />
</template>

<script>
import Card from "@/components/Card.vue";
import SampleForm from "@/views/settings/samples/SampleForm.vue";
import { ref, onMounted } from "vue";

import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import SamplesApi from "@api/samples.api";
import { useToast } from "vue-toastification";
import { useI18n } from "vue-i18n";

export default {
    components: {
        Card,
        QuillEditor,
        SampleForm,
    },
    data() {
        const { t } = useI18n();
        return {
            statusAction: {
                status: false,
            },
            filters: {
                page: 1,
            },
            pagination: {},
            samples: [],
            categoryOptions: [
                {
                    value: "arbitrator",
                    label: t("pages.contract_arbitrator"),
                },
                {
                    value: "sponsor",
                    label: t("pages.contract_sponsor"),
                },
                {
                    value: "service_provider",
                    label: t("pages.contract_service_provider"),
                },
            ],
            isAdd: ref(true),
            sample: {
                id: "",
                name: {
                    ar: "",
                    en: "",
                },
                contract_category: "",
                attachment: "",
                fileId: "",
            },
        };
    },

    methods: {
        getSamples(page = 1) {
            this.filters.page = page;
            SamplesApi.list(this.filters)
                .then(({ data }) => {
                    this.samples = data.data;
                    this.pagination = data.meta;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },

        clearForm() {
            this.clearErrors();
        },
        delSample(sample, index) {
            SamplesApi.delete(sample).then((resp) => {
                this.samples.splice(index, 1);
                useToast().success(resp.data.message);
            });
        },
    },
    created() {
        this.getSamples();
    },
};
</script>
