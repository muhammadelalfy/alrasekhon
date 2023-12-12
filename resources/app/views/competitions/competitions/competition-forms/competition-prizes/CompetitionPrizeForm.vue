<template #body>
    <form>
        <div
            v-for="(competitionLevel, index) in this.prize"
            :key="index"
            class="row align-items-end"
        >
            <div class="col-md-4">
                <form-input
                    label="pages.competition_level"
                    type="text"
                    :model="this.prize[index]"
                    :name="`competition_levels_names`"
                    :errors="formErrors"
                    @clearErrors="clearInput"
                />
            </div>
            <ul>
                <li
                    v-if="
                        formErrors.hasOwnProperty(
                            `competition_levels_names.${index}`
                        )
                    "
                    class="invalid-feedback"
                >
                    {{ formErrors[`competition_levels_names.${index}`][0] }}
                </li>
            </ul>
            <div class="col-12">
                <table
                    class="table-data dt-responsive table w-100 table-borderless"
                >
                    <thead>
                        <tr>
                            <th>
                                {{ $t("pages.winner_ranking") }}
                            </th>
                            <th>
                                {{ $t("pages.value_financial") }}
                            </th>
                            <th>
                                {{ $t("pages.certificates_honors") }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="bg-white"
                            v-for="(competitorsCount, cadIndex) in this.prize[
                                index
                            ].winners_counts"
                        >
                            <td>
                                <form-input
                                    label="pages.winner_ranking"
                                    type="text"
                                    :showLabel="false"
                                    :margin="false"
                                    :model="
                                        this.prize[index]['winners_rankings']
                                    "
                                    :name="[cadIndex]"
                                    :errors="formErrors"
                                    @clearErrors="clearInput"
                                />
                                <ul>
                                    <li
                                        v-if="
                                            formErrors.hasOwnProperty(
                                                `winners_rankings`
                                            )
                                        "
                                        class="invalid-feedback"
                                    >
                                        {{ formErrors[`winners_rankings`][0] }}
                                    </li>
                                    <li
                                        v-if="
                                            formErrors.hasOwnProperty(
                                                `winners_ranking.${index}`
                                            )
                                        "
                                        class="invalid-feedback"
                                    >
                                        {{
                                            formErrors[
                                                `winners_ranking.${index}`
                                            ][0]
                                        }}
                                    </li>
                                </ul>
                            </td>

                            <td>
                                <form-input
                                    label="pages.value_financial"
                                    type="number"
                                    :showLabel="false"
                                    :margin="false"
                                    :model="
                                        this.prize[index][
                                            'financials_awards_values'
                                        ]
                                    "
                                    :name="[cadIndex]"
                                    :errors="formErrors"
                                    @clearErrors="clearInput"
                                />
                                <ul>
                                    <li
                                        v-if="
                                            formErrors.hasOwnProperty(
                                                `financials_awards_values`
                                            )
                                        "
                                        class="invalid-feedback"
                                    >
                                        {{
                                            formErrors[
                                                `financials_awards_values`
                                            ][0]
                                        }}
                                    </li>
                                    <li
                                        v-if="
                                            formErrors.hasOwnProperty(
                                                `financials_awards_value.${index}`
                                            )
                                        "
                                        class="invalid-feedback"
                                    >
                                        {{
                                            formErrors[
                                                `financials_awards_value.${index}`
                                            ][0]
                                        }}
                                    </li>
                                </ul>
                            </td>

                            <td>
                                <form-input
                                    label="pages.certificates_honors"
                                    type="text"
                                    :showLabel="false"
                                    :margin="false"
                                    :model="
                                        this.prize[index][
                                            'certificates_and_honors'
                                        ]
                                    "
                                    :name="[cadIndex]"
                                    :errors="formErrors"
                                    @clearErrors="clearInput"
                                />
                                <ul>
                                    <li
                                        v-if="
                                            formErrors.hasOwnProperty(
                                                `certificates_and_honors`
                                            )
                                        "
                                        class="invalid-feedback"
                                    >
                                        {{
                                            formErrors[
                                                `certificates_and_honors`
                                            ][0]
                                        }}
                                    </li>
                                    <li
                                        v-if="
                                            formErrors.hasOwnProperty(
                                                `certificates_and_honor.${index}`
                                            )
                                        "
                                        class="invalid-feedback"
                                    >
                                        {{
                                            formErrors[
                                                `certificates_and_honor.${index}`
                                            ][0]
                                        }}
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr class="mt-0" />
            </div>
        </div>
        <ul>
            <li
                v-if="formErrors.hasOwnProperty(`competition_prizes`)"
                class="invalid-feedback"
            >
                {{ formErrors[`competition_prizes`][0] }}
            </li>
        </ul>
        <div class="d-flex align-items-cenetr my-4 justify-content-end">
            <button
                @click="saveAndNext"
                type="button"
                class="btn btn-light-babyblue text-white fw-bold"
            >
                {{ $t("forms.save_next") }}
            </button>
            <button
                @click="save"
                type="button"
                class="btn btn-babyblue text-white fw-bold mx-2"
            >
                {{ $t("forms.save") }}
            </button>
            <cancel-button />
        </div>
    </form>
</template>

<script>
import Card from "@/components/Card.vue";
import { onMounted, reactive } from "vue";
import { useToast } from "vue-toastification";
import CompetitionsApi from "@api/competitions.api";

export default {
    components: {
        Card,
    },
    data() {
        return {
            prize: {
                competition_id: this.$route.params.id,
                competition_levels_names: [],
                winners_counts: [],
                winners_rankings: [],
                financials_awards_values: [],
                certificates_and_honors: [],
            },
            buttonClickedType: "",
        };
    },
    props: {
        competition: Object,
    },
    methods: {
        saveAndNext: function () {
            this.buttonClickedType = "save_and_next";
            this.addUpdatePrizes();
        },
        save: function () {
            this.buttonClickedType = "save";
            this.addUpdatePrizes();
        },

        addUpdatePrizes() {
            this.prize.competition_id = this.$route.params.id;
            CompetitionsApi.addUpdatePrizes(this.prize)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    if (this.buttonClickedType === "save") {
                        this.$router.push({
                            name: "competitions",
                        });
                    }
                    if (this.buttonClickedType === "save_and_next") {
                        this.$router.push({
                            name: "standards-conditions",
                            params: { id: data.data.id },
                        });
                    }
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
    },
    setup() {
        const mainForm = reactive({});

        onMounted(() => {
            /*basic responsive Datatable*/
            $(".table-data").DataTable({
                lengthChange: false,
                searching: false,
                paging: false,
                info: false,
                ordering: false,
                order: [],
            });
        });
        return {
            mainForm,
        };
    },

    created() {
        this.prize = this.competition.prize;
    },
};
</script>
