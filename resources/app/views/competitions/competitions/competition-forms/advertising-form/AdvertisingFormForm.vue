<template #body>
    <form>
        <form-select
            title="pages.advertising_form"
            label="name"
            name="advertisement_id"
            @clearErrors="clearInput"
            :model="this.competition"
            :myOptions="this.advertisements"
            label-field="name"
            value-field="id"
            :errors="formErrors"
            @change="showMedia"
        />

        <div class="row mt-4">
            <div
                v-if="this.selectedAdvertisement.media_type === 'image'"
                class="col-md-4"
            >
                <card class="shadow p-2">
                    <template #default>
                        <div class="video-container" id="video-container">
                            <img
                                :src="this.selectedAdvertisement.file_url"
                                :data-src="this.selectedAdvertisement.file_url"
                                alt="sample"
                            />
                        </div>
                        <h6 class="text-grayClr fs-14 mb-1 mt-2 text-center">
                            {{ this.selectedAdvertisement.name }}
                        </h6>
                    </template>
                </card>
            </div>
            <div
                v-if="this.selectedAdvertisement.media_type === 'link'"
                class="col-md-4"
            >
                <card class="shadow p-2">
                    <template #default>
                        <div class="video-container" id="video-container">
                            <iframe
                                id="video"
                                :src="this.selectedAdvertisement.url"
                                frameborder="0"
                                allowfullscreen
                            ></iframe>
                        </div>
                        <h6 class="text-grayClr fs-14 mb-1 mt-2 text-center">
                            {{ this.selectedAdvertisement.name }}
                        </h6>
                    </template>
                </card>
            </div>
            <div
                v-if="this.selectedAdvertisement.media_type === 'video'"
                class="col-md-4"
            >
                <card class="shadow p-2">
                    <template #default>
                        <div class="video-container" id="video-container">
                            <video
                                id="uploadedVideo"
                                controls="controls"
                                preload="none"
                                width="100%"
                                height="100%"
                                :poster="`${publicPath}/assets/images/authBg.png`"
                            >
                                <source
                                    v-if="
                                        this.selectedAdvertisement.file_url.endsWith(
                                            '.mp4'
                                        )
                                    "
                                    id="mp4"
                                    :src="this.selectedAdvertisement.file_url"
                                    type="video/mp4"
                                />
                                <source
                                    v-if="
                                        this.selectedAdvertisement.file_url.endsWith(
                                            '.webm'
                                        )
                                    "
                                    id="webm"
                                    :src="this.selectedAdvertisement.file_url"
                                    type="video/webm"
                                />
                                <source
                                    v-if="
                                        this.selectedAdvertisement.file_url.endsWith(
                                            '.ogv'
                                        )
                                    "
                                    id="ogv"
                                    :src="this.selectedAdvertisement.file_url"
                                    type="video/ogg"
                                />
                                <track
                                    kind="subtitles"
                                    label="English subtitles"
                                    src="subtitles_en.vtt"
                                    srclang="en"
                                    default
                                />
                                <track
                                    kind="subtitles"
                                    label="Deutsche Untertitel"
                                    src="subtitles_de.vtt"
                                    srclang="de"
                                />

                                <p>
                                    Your user agent does not support the HTML5
                                    Video element.
                                </p>
                            </video>

                            <div class="play-button-wrapper">
                                <div
                                    title="Play video"
                                    class="play-gif"
                                    id="circle-play-b"
                                >
                                    <img
                                        :src="`${publicPath}/assets/images/play.svg`"
                                        :data-src="`${publicPath}/assets/images/play.svg`"
                                        alt="play"
                                    />
                                </div>
                            </div>
                        </div>
                        <h6 class="text-grayClr fs-14 mb-1 mt-2 text-center">
                            {{ this.selectedAdvertisement.name }}
                        </h6>
                    </template>
                </card>
            </div>
        </div>

        <div class="d-flex align-items-cenetr my-4 justify-content-end">
            <button
                @click="addUpdateStages"
                type="button"
                class="btn btn-babyblue text-white fw-bold mx-2"
            >
                {{ $t("forms.save") }}
            </button>
            <cancel-button />
        </div>

        <div class="d-flex justify-content-center my-4">
            <el-switch
                v-if="this.competition.is_show_announce_button"
                v-model="this.competition.is_announced"
                class="mb-2"
                :active-text="$t('forms.announced')"
                :inactive-text="$t('forms.un_announced')"
            />
        </div>
    </form>
</template>

<script>
import Card from "@/components/Card.vue";
import { onMounted, reactive, ref } from "vue";
import CompetitionsApi from "@api/competitions.api";
import { useToast } from "vue-toastification";
import CompetitionLevelsApi from "@api/competition-levels.api";
import AdvertisementsApi from "@api/advertisements.api";

export default {
    emits: ["change"],
    components: {
        Card,
    },
    props: {
        competition: Object,
    },
    data() {
        return {
            advertisements: [],
            selectedAdvertisement: { media_type: "" },
            buttonClickedType: "",
        };
    },
    methods: {
        // saveAndNext: function() {
        //     this.buttonClickedType = 'save_and_next'
        //     this.addUpdateStages()
        // },
        // save: function() {
        //     this.buttonClickedType = 'save'
        //     this.addUpdateStages()
        // },

        showMedia() {
            // this.selectedAdvertisement = this.advertisements.filter(value => {value.id === this.competition.advertisement_id ? this.selectedAdvertisement = value : null;})
            this.selectedAdvertisement = this.advertisements.find(
                (value) => value.id === this.competition.advertisement_id
            );
        },

        getAdvertisement() {
            let requestData = { get_for_competition: true };
            AdvertisementsApi.list(requestData)
                .then(({ data }) => {
                    this.advertisements = data.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        addUpdateStages() {
            CompetitionsApi.addUpdateAdvertisement(this.competition)
                .then(({ data }) => {
                    useToast().success(this.$t("messages.success"));
                    this.$router.push({
                        name: "competitions",
                    });
                    // if (this.buttonClickedType === 'save'){
                    //     this.$router.push({
                    //         name: "competitions",
                    //     });
                    // }
                    // if (this.buttonClickedType === 'save_and_next'){
                    //     this.$router.push({
                    //         name: 'advertising-form',
                    //         params: {id: data.data.id},
                    //     });
                    // }
                })
                .catch((error) => {
                    console.log(error);
                    this.formErrors = error.response.data.errors;
                });
        },
    },
    mounted() {
        this.getAdvertisement();
    },

    setup() {
        onMounted(() => {
            //video
            const video = document.getElementById("uploadedVideo");
            const circlePlayButton = document.getElementById("circle-play-b");

            function togglePlay() {
                if (video.paused || video.ended) {
                    video.play();
                } else {
                    video.pause();
                }
            }

            if (circlePlayButton) {
                circlePlayButton.addEventListener("click", togglePlay);
                video.addEventListener("playing", function () {
                    circlePlayButton.style.opacity = 0;
                });
                video.addEventListener("pause", function () {
                    circlePlayButton.style.opacity = 1;
                });
            }
        });
    },
};
</script>
