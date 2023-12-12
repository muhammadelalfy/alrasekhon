<template>
    <div class="card-body px-0">
        <div
            class="d-flex flex-wrap align-items-center justify-content-end px-3"
        >
            <div
                data-bs-toggle="tooltip"
                data-bs-placement="bottom"
                :title="$t('forms.filter')"
            >
                <button
                    type="button"
                    class="btn btn-grayClr text-white me-1"
                    data-bs-toggle="collapse"
                    data-bs-target="#formAds"
                    aria-expanded="false"
                    aria-controls="formAds"
                >
                    <font-awesome-icon icon="fa-solid fa-filter" />
                </button>
            </div>
            <button
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#addSampleModal"
                class="btn ripple btn-babyblue text-white"
                @click="isAddAdv = true"
            >
                <font-awesome-icon icon="fa-solid fa-plus" class="me-1" />
                {{ $t("pages.add_sample") }}
            </button>
        </div>

        <div id="formAds" class="collapse multi-collapse px-3">
            <filters @submit="getAdvertisements" :model="filters"> </filters>
        </div>

        <div class="pt-3">
            <DataTable id="governorate-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ $t("pages.sample_name") }}</th>
                        <th>{{ $t("pages.sample") }}</th>
                        <th>{{ $t("global.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(advertisement, index) in this.advertisements"
                        :key="index"
                    >
                        <td>{{ index + 1 }}</td>
                        <td>{{ advertisement.name }}</td>
                        <td>
                            <img
                                class="wh-50px rounded"
                                alt="avatar"
                                :src="
                                    advertisement.media_type === 'image'
                                        ? advertisement.file_url
                                        : '/UI/assets/images/icons/youtube.png'
                                "
                            />
                        </td>
                        <td>
                            <div class="btn-list d-inline-flex">
                                <div
                                    @click="groupForm(advertisement, 'view')"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    :title="$t('forms.view')"
                                >
                                    <button
                                        type="button"
                                        class="btn btn-light-babyblue text-white me-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewSampleModal"
                                    >
                                        <font-awesome-icon
                                            icon="fa-solid fa-eye"
                                        />
                                    </button>
                                </div>
                                <div
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    :title="$t('forms.edit')"
                                >
                                    <button
                                        type="button"
                                        class="btn btn-light-secondary text-white me-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#addSampleModal"
                                        @click="
                                            isAddAdv = false;
                                            groupForm(advertisement, 'edit');
                                        "
                                    >
                                        <font-awesome-icon
                                            icon="fa-solid fa-pen-to-square"
                                        />
                                    </button>
                                </div>
                                <delete-button
                                    v-if="
                                        hasPermission('delete', 'Advertisement')
                                    "
                                    @del-model="
                                        delAdvertisement(advertisement, index)
                                    "
                                />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </DataTable>
        </div>
    </div>
    <!-- Modal -->
    <AdvertisementForm
        :advertisement="advertisement"
        :showButton="false"
        :title="isAddAdv ? $t('pages.add_sample') : $t('pages.edit_sample')"
        id="addSampleModal"
        aria-labelledby="addSampleModalLabel"
        :modal-dialog-centered="true"
        :modal-lg="true"
    />
    <AdvertisementView
        :advertisement="advertisement"
        :title="$t('pages.sample')"
        id="viewSampleModal"
        aria-labelledby="viewSampleModalLabel"
        :modal-dialog-centered="true"
        :modal-lg="true"
    />
</template>

<script>
import Card from "@/components/Card.vue";
import AdvertisementForm from "@/views/competitions/advertisements/AdvertisementForm.vue";
import AdvertisementView from "@/views/competitions/advertisements/AdvertisementView.vue";
import { ref, reactive } from "vue";
import ArbitrationCommitteesApi from "@api/arbitration-committees.api";
import { useToast } from "vue-toastification";
import AdvertisementsApi from "@api/advertisements.api";

export default {
    name: "AdvertisementIndex",
    components: {
        Card,
        AdvertisementForm,
        AdvertisementView,
    },
    data() {
        return {
            advertisements: [],
            advertisement: {
                id: "",
                name: "",
                description: "",
                media_type: "",
                url: "",
                ready_sample_id: "",
            },
            isAddAdv: ref(true),
            statusAction: {
                status: false,
            },
            filters: {
                page: 1,
            },
        };
    },
    methods: {
        getAdvertisements(page = 1) {
            this.filters.page = page;
            AdvertisementsApi.list(this.filters)
                .then(({ data }) => {
                    this.advertisements = data.data;
                    this.pagination = data.meta;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        groupForm(advertisement = {}, type) {
            if (advertisement.id) {
                this.advertisement = _.cloneDeep(advertisement);
            }
            if (type === "edit") {
                $("#addSampleModal").modal("show");
            }
            if (type === "view") {
                $("#viewSampleModal").modal("show");
            }
        },
        clearForm() {
            this.clearErrors();
        },
        resetForm() {
            console.log(this.isAddAdv);
            alert("");
            // this.resetForm(this.advertisement)
            //   console.log(this.advertisement)
        },
        delAdvertisement(advertisement, index) {
            AdvertisementsApi.delete(advertisement).then((resp) => {
                this.advertisements.splice(index, 1);
                useToast().success(resp.data.message);
            });
        },
    },
    mounted() {
        this.getAdvertisements();
    },
};
</script>
