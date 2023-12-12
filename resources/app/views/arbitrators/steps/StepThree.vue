<template>
    <div>
        <div class="row align-items-end">
            <div class="col-12">
                <h6 class="fw-bold mb-3">
                    {{ $t("pages.exquisiteReadings") }}
                </h6>
            </div>
            <div class="col-9 col-md-4">
                <form-select
                    title="pages.method"
                    label="name"
                    name="method_id"
                    collapse-tags
                    collapse-tags-tooltip
                    @clearErrors="clearInput"
                    :model="this.arbitrator"
                    :myOptions="methods"
                    label-field="name_localized"
                    value-field="id"
                    :errors="formErrors"
                    @change="getReadings"
                />
            </div>
            <div class="col-9 col-md-4">
                <form-select
                    title="pages.reading"
                    label="name"
                    name="readings"
                    multiple
                    collapse-tags
                    collapse-tags-tooltip
                    @clearErrors="clearInput"
                    :model="this.arbitrator"
                    :myOptions="readings"
                    label-field="name_localized"
                    value-field="id"
                    :errors="formErrors"
                    @change="appendReadingsINfo"
                />
            </div>
            <div class="col-3 col-md-2 col-lg-1 d-flex">
                <button
                    @click="addReading"
                    type="button"
                    class="btn btn-icon btn-light-babyblue text-white mb-3 p-0"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    :title="$t('pages.add')"
                >
                    <font-awesome-icon icon="fa-solid fa-circle-plus" />
                </button>
            </div>

            <div class="col-12 mb-3" v-if="formErrors.methods_readings_ids">
                <ul>
                    <li class="text-danger">
                        {{ formErrors.methods_readings_ids[0] }}
                    </li>
                </ul>
            </div>

            <div class="col-md-9">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>{{ $t("pages.methods") }}</th>
                                <th>{{ $t("pages.readings") }}</th>
                                <th>{{ $t("pages.delete") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="text-center"
                                v-for="(methodReading, index) in this.arbitrator
                                    .append_method_readings_names"
                                :key="index"
                            >
                                <td>{{ index + 1 }}</td>
                                <td>{{ methodReading.method_name }}</td>
                                <td>
                                    <span
                                        class="me-2"
                                        v-for="(
                                            reading, readingIndex
                                        ) in methodReading.readings"
                                        :key="readingIndex"
                                    >
                                        {{
                                            readingIndex +
                                            1 +
                                            "-" +
                                            reading +
                                            " "
                                        }}
                                    </span>
                                </td>
                                <td>
                                    <button
                                        @click.stop="
                                            removeReading(
                                                index,
                                                methodReading.method_id
                                            )
                                        "
                                        type="button"
                                        class="btn btn-icon btn-light-danger text-white p-0"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        :title="$t('forms.delete')"
                                    >
                                        <font-awesome-icon
                                            icon="fa-solid fa-circle-minus"
                                        />
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!--            <div class="col-md-4">-->
            <!--                <form-select-->
            <!--                    title="pages.novel"-->
            <!--                    label="name"-->
            <!--                    name="novels"-->
            <!--                    multiple-->
            <!--                    collapse-tags-->
            <!--                    collapse-tags-tooltip-->
            <!--                    @clearErrors="clearInput"-->
            <!--                    :model="this.arbitrator"-->
            <!--                    :myOptions="novelOptions"-->
            <!--                    :errors="formErrors"-->
            <!--                />-->
            <!--            </div>-->
            <div class="col-12 d-flex align-items-center flex-wrap">
                <h6 class="fw-bold mb-3 me-2">
                    {{ $t("pages.vacations_bonds") }}
                </h6>
                <button
                    @click="addRowBonds"
                    type="button"
                    class="btn btn-icon btn-light-babyblue text-white mb-3 p-0"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    :title="$t('pages.add')"
                >
                    <font-awesome-icon icon="fa-solid fa-circle-plus" />
                </button>
            </div>

            <div class="col-12">
                <!-- <div class="row"> -->
                <!--                    <div class="col-9 col-md-4">-->
                <!--                        <form-input-->
                <!--                            label="pages.vacation_bond"-->
                <!--                            :showLabel="false"-->
                <!--                            type="text"-->
                <!--                            :model="authorizationBonds"-->
                <!--                            name="authorizations"-->
                <!--                            :errors="formErrors"-->
                <!--                            @clearErrors="clearInput"-->
                <!--                        />-->
                <!--                    </div>-->
                <!--                    <div class="col-9 col-md-4">-->
                <!--                        <div class="mb-3">-->
                <!--&lt;!&ndash;                            :http-request="handleUpload"&ndash;&gt;-->
                <!--                            <el-upload-->
                <!--                                name="vocation_bonds_attachments"-->
                <!--                                accept="jpeg,jpg,png,pdf"-->
                <!--                                @file-uploaded="getUploadedData($event)"-->
                <!--                                ref="uploadRefBond"-->
                <!--                                class="upload-demo"-->
                <!--                                :http-request="handleUpload"-->
                <!--                                :auto-upload="false"-->
                <!--                                :limit="1"-->
                <!--                                :size="5"-->
                <!--                                @click="clearInput('vocation_bonds_attachments')"-->
                <!--                            >-->
                <!--                                <el-alert v-if="formErrors.vocation_bonds_attachments" :title="formErrors.vocation_bonds_attachments[0]" type="error" show-icon/>-->
                <!--                                <template #trigger>-->
                <!--                                    <div-->
                <!--                                        class="align-items-center control-bg d-flex flex-wrap justify-content-end w-100"-->
                <!--                                    >-->
                <!--                                        <font-awesome-icon-->
                <!--                                            icon="fa-solid fa-upload"-->
                <!--                                        />-->
                <!--                                    </div>-->
                <!--                                </template>-->
                <!--                            </el-upload>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!-- <div class="col-9 col-md-8"> -->
                <!-- <label class="form-label mb-3">{{
                            $t("pages.vacation_bond")
                        }}</label> -->
                <!-- </div>
                    <div class="col-3 col-md-2 col-lg-1 d-flex"> -->
                <!-- <button
                            @click="addRowBonds"
                            type="button"
                            class="btn btn-icon btn-light-babyblue text-white mb-3 p-0"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            :title="$t('pages.add')"
                        >
                            <font-awesome-icon icon="fa-solid fa-circle-plus" />
                        </button> -->
                <!-- </div>
                </div> -->
                <div
                    class="row align-items-end"
                    v-for="(row, index) in this.arbitrator.authorizations"
                    :key="index"
                >
                    <div class="col-9 col-md-4">
                        <!--                        :model="this.authorizationBonds.rows[index]"-->
                        <form-input
                            label="pages.vacation_bond"
                            :showLabel="true"
                            type="text"
                            :model="this.arbitrator.authorizations"
                            :name="index"
                            :errors="formErrors"
                            @clearErrors="clearInput"
                            @change="getUploadedData"
                        />
                    </div>
                    <div class="col-9 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">{{
                                $t("pages.attached_contract")
                            }}</label>
                            <el-upload
                                :name="index"
                                accept="jpeg,jpg,png,pdf"
                                @file-uploaded="getUploadedData($event)"
                                ref="`uploadRefBond${{ index }}`"
                                class="upload-demo"
                                :http-request="handleUpload"
                                :auto-upload="true"
                                :limit="1"
                                :size="5"
                                @click="clearInput('vocation_bonds_attaches')"
                            >
                                <template #trigger>
                                    <div
                                        class="align-items-center control-bg d-flex flex-wrap justify-content-end w-100"
                                    >
                                        <font-awesome-icon
                                            icon="fa-solid fa-upload"
                                        />
                                    </div>
                                </template>
                            </el-upload>
                        </div>
                    </div>

                    <div class="col-3 col-md-2 col-lg-1 d-flex">
                        <button
                            @click.stop="removeElementBonds(index)"
                            type="button"
                            class="btn btn-icon btn-light-danger text-white mb-3 p-0"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            :title="$t('forms.delete')"
                        >
                            <font-awesome-icon
                                icon="fa-solid fa-circle-minus"
                            />
                        </button>
                    </div>
                    <div
                        class="col-8 mb-3"
                        v-if="formErrors.vocation_bonds_attaches"
                    >
                        <el-alert
                            :title="formErrors.vocation_bonds_attaches[0]"
                            type="error"
                            show-icon
                        />
                    </div>
                    <div class="col-8 mb-3" v-if="formErrors.authorizations">
                        <el-alert
                            :title="formErrors.authorizations[0]"
                            type="error"
                            show-icon
                        />
                    </div>
                    <div class="col-8 mb-3" v-if="formErrors.authorization">
                        <el-alert
                            :title="formErrors.authorization[0]"
                            type="error"
                            show-icon
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-cenetr pt-4 justify-content-end">
            <button
                type="button"
                @click.prevent="onNextTab(3, 2)"
                class="btn btn-babyblue text-white fw-bold"
            >
                {{ $t("pagination.next") }}
            </button>
            <button
                type="button"
                class="btn btn-light text-grayClr fw-bold ms-2"
                @click.prevent="onBackTab(1, 2)"
            >
                {{ $t("pagination.prev") }}
            </button>
        </div>
    </div>
</template>

<script>
import ArbitratorsApi from "@api/arbitrators.api";
import MethodsApi from "@api/methods.api";
import ReadingsApi from "@api/readings.api";
import { useToast } from "vue-toastification";

export default {
    name: "StepThree",
    data() {
        return {
            methods: [],
            readings: [],
            authorizationBonds: {
                rows: [],
            },
            file: {
                filePreview: "",
                fileName: "",
            },

            vocation_bonds_attachments: [],
            appended_methods: [],
            appended_readings: [],
        };
    },
    props: ["arbitrator", "onNextTab", "onBackTab", "formErrors", "clearInput"],

    methods: {
        addRowBonds: function () {
            // this.authorizationBonds.rows.push({
            //     "authorizations[]": "",
            // });
            this.arbitrator.authorizations.push("");
        },
        removeElementBonds: function (index) {
            // this.authorizationBonds.rows.splice(index, 1);
            this.arbitrator.authorizations.splice(index, 1);
            this.arbitrator.vocation_bonds_attaches.splice(index, 1);
            this.arbitrator.vocation_bonds_attach_urls.splice(index, 1);
        },

        getUploadedData($event) {
            this.file.filePreview = $event.previewBase64;
            this.file.fileName = $event.name;
        },

        async handleUpload(event) {
            let formData = new FormData();
            formData.append("vocation_bonds_attaches", event.file);
            formData.append("type", "vocation_bonds_attaches");

            ArbitratorsApi.upload(formData)
                .then(({ data }) => {
                    let index = event.filename;
                    this.arbitrator.vocation_bonds_attaches[index] = data.id;
                    this.arbitrator.vocation_bonds_attach_urls[index] =
                        data.url;
                    this.arbitrator.file_type.push(data.type);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        getMethods() {
            MethodsApi.list()
                .then(({ data }) => {
                    this.methods = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },

        getReadings() {
            this.readings = [];
            let params = {
                methodId: this.arbitrator.method_id,
            };

            this.arbitrator.method_name = event.target.innerText;
            this.arbitrator.readings_names = [];

            ReadingsApi.list(params)
                .then(({ data }) => {
                    this.readings = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },

        appendReadingsINfo() {
            if (
                event.target.className !==
                "el-select-dropdown__item selected hover"
            ) {
                if (event.target.innerText !== undefined) {
                    this.arbitrator.readings_names.push(event.target.innerText);
                }
            } else {
                let elementIndex = this.arbitrator.readings_names.indexOf(
                    event.target.innerText
                );
                this.arbitrator.readings_names.splice(elementIndex, 1);
            }

            this.arbitrator.methods_readings_ids[this.arbitrator.method_id] =
                this.arbitrator.readings;

            if (!this.arbitrator.readings.length) {
                this.arbitrator.readings_names = [];
            }
        },

        addReading() {
            // Prevent add if user not select method and readings
            if (
                this.arbitrator.method_id === undefined ||
                this.arbitrator.method_id === "" ||
                !this.arbitrator.readings_names.length
            ) {
                return false;
            }

            this.arbitrator.methods_readings_ids[this.arbitrator.method_id] =
                this.arbitrator.readings;

            for (
                let i = 0;
                i < this.arbitrator.append_method_readings_names.length;
                i++
            ) {
                if (
                    this.arbitrator.append_method_readings_names[i]
                        .method_name === this.arbitrator.method_name
                ) {
                    this.arbitrator.append_method_readings_names[i] = {
                        method_id: this.arbitrator.method_id,
                        method_name: this.arbitrator.method_name,
                        readings: this.arbitrator.readings_names,
                    };
                    return false;
                }
            }

            this.arbitrator.append_method_readings_names.push({
                method_id: this.arbitrator.method_id,
                method_name: this.arbitrator.method_name,
                readings: this.arbitrator.readings_names,
            });

            // return false;
            // let params = {
            //     arbitrator_id: this.arbitrator.id,
            //     method_id: this.arbitrator.method_id,
            //     readings: this.arbitrator.readings,
            // };
            //
            // ArbitratorsApi.addReading(params)
            //     .then(({data}) => {
            //         this.readings = data.data;
            //     })
            //     .catch((errors) => {
            //         console.log(errors);
            //     });
        },

        removeReading(index, method_id) {
            this.arbitrator.append_method_readings_names.splice(index, 1);
            delete this.arbitrator.methods_readings_ids[method_id];
        },
    },

    mounted() {
        this.getMethods();
    },
};
</script>

<style scoped></style>
