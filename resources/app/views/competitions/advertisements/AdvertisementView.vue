<template>
    <Modal
        :id="id"
        :aria-labelledby="ariaLabelledby"
        :modal-dialog-centered="modalDialogCentered"
        :modal-lg="modalLg"
        :title="title"
    >
        <template v-slot:body>
            <div class="mb-3">
                <h6 class="text-grayClr">{{ $t("pages.sample_name") }}</h6>
                <span class="fs-14 fw-bold text-darkGray">{{ this.advertisement.name}}</span>
            </div>
            <div class="mb-3">
                <h6 class="text-grayClr mb-3">{{ $t("pages.sample") }}</h6>
                <card v-if="this.advertisement.media_type === 'image'" class="shadow p-2">
                    <template #default>
                        <div class="video-container h-230px" id="video-container">
                            <img
                                :src="this.advertisement.file_url"
                                :data-src="this.advertisement.file_url"
                                alt="sample"
                            />
                        </div>
                    </template>
                </card>
                <card v-if="this.advertisement.media_type === 'link'" class="shadow p-2">
                    <template #default>
                        <div class="video-container h-230px" id="video-container">
                            <iframe
                                id="video"
                                :src="this.advertisement.url"
                                frameborder="0"
                                allowfullscreen
                            ></iframe>
                        </div>
                    </template>
                </card>
                <card v-if="this.advertisement.media_type === 'video'" class="shadow p-2">
                    <template #default>
                        <!-- for vedio upload -->

                        <div class="video-container h-230px" id="video-container">
                            <video
                                id="uploadedVideo"
                                controls="controls"
                                preload="none"
                                width="100%"
                                height="100%"
                                :poster="this.advertisement.file_url"
                            >
                                <source
                                    v-if="this.advertisement.file_url.endsWith('.mp4')"
                                    id="mp4"
                                    :src="this.advertisement.file_url"
                                    type="video/mp4"
                                />
                                <source
                                    v-if="this.advertisement.file_url.endsWith('.webm')"
                                    id="webm"
                                    :src="this.advertisement.file_url"
                                    type="video/webm"
                                />
                                <source
                                    v-if="this.advertisement.file_url.endsWith('.ogv')"
                                    id="ogv"
                                    :src="this.advertisement.file_url"
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

                                <p>{{this.advertisement.description}}</p>
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
                    </template>
                </card>
            </div>
            <div class="mb-3">
                <h6 class="text-grayClr">{{ $t("pages.desc") }}</h6>
                <span class="fs-14 fw-bold text-darkGray">{{this.advertisement.description}}</span>
            </div>
            <div class="d-flex align-items-cenetr pt-4 justify-content-end">
                <button
                    type="button"
                    class="btn btn-light fw-bold ms-2"
                    data-bs-dismiss="modal"
                    @click="close"
                >
                    {{ $t("forms.cancel") }}
                </button>
            </div>
        </template>
    </Modal>
</template>

<script>
import Card from "@/components/Card.vue";
import { onMounted, reactive } from "vue";
export default {
    components: {
        Card,
    },
    name: "AdvertisementView",
    props: {
        id: String,
        ariaLabelledby: String,
        dataBsBackdrop: String,
        dataBskeyboard: String,
        modalDialogScrollable: Boolean,
        modalDialogCentered: Boolean,
        modalLg: Boolean,
        modalFullscreen: Boolean,
        title: String,
        advertisement: Object,
    },
    setup() {
        onMounted(() => {
            //vedio

            const video = document.getElementById("uploadedVideo");
            const circlePlayButton = document.getElementById("circle-play-b");

            function togglePlay() {
                if (video.paused || video.ended) {
                    video.play();
                } else {
                    video.pause();
                }
            }

            if (circlePlayButton){
                circlePlayButton.addEventListener("click", togglePlay);
                video.addEventListener("playing", function () {
                    circlePlayButton.style.opacity = 0;
                });
                video.addEventListener("pause", function () {
                    circlePlayButton.style.opacity = 1;
                });
            }

        });
        return {};
    },
};
</script>

<style scoped></style>
