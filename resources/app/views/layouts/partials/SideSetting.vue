<template>
    <div class="sideSetting sidebar-right sidebar-animate">
        <div class="cog-icon">
            <font-awesome-icon icon="fa-solid fa-gear" />
        </div>
        <div class="form_holder">
            <!--      <h4>{{ $t("switchLang") }}</h4>-->
            <!--      <div class="px-1">-->
            <!--        <button-->
            <!--          type="button"-->
            <!--          class="btn btn-babyblue w-100 text-white"-->
            <!--          @click="switchLocale('ar')"-->
            <!--        >-->
            <!--          {{ $t("ar") }}-->
            <!--        </button>-->
            <!--        <button-->
            <!--          type="button"-->
            <!--          class="btn btn-grayClr w-100 mt-2 text-white"-->
            <!--          @click="switchLocale('en')"-->
            <!--        >-->
            <!--          {{ $t("en") }}-->
            <!--        </button>-->
            <!--      </div>-->

            <h4>{{ $t("menu") }}</h4>
            <div class="menu-mode px-1">
                <a
                    href="javascript:void(0)"
                    class="hor-menu btn btn-babyblue w-100 text-white"
                    @click="switchMenu('horizontal')"
                >
                    {{ $t("horizontal") }}
                </a>
                <a
                    href="javascript:void(0)"
                    class="vertical-menu btn btn-grayClr w-100 mt-2 text-white"
                    @click="switchMenu('vertical')"
                >
                    {{ $t("vertical") }}
                </a>
            </div>
        </div>
    </div>
</template>

<!-- eslint-disable no-undef -->
<script>
import { onMounted } from "vue";
export default {
    name: "SideSetting",
    setup() {
        function switchLocale(locale) {
            localStorage.setItem("locale", locale);
            window.location.reload();
        }

        function switchMenu(menu) {
            localStorage.setItem("menu", menu);
        }

        onMounted(() => {
            // for language
            // if (localStorage.locale == "en") {
            //   document.body.classList.remove("rtl");
            //   document.body.removeAttribute("dir");
            //   document.documentElement.setAttribute("lang", "en");
            //   $(
            //     "link[href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css']"
            //   ).remove();
            // } else {
            //   document.body.classList.add("rtl");
            //   document.body.setAttribute("dir", "rtl");
            //   document.documentElement.setAttribute("lang", "ar");
            //   $(
            //     "link[href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css']"
            //   ).remove();
            // }

            // for menu
            if (localStorage.menu == "horizontal") {
                $(".main-body").removeClass("main-sidebar-hide");
                $(".main-header").removeClass("with-side-menu");
                $(".main-navbar").removeClass("side-menu main-sidebar-sticky");
                $(".main-content").removeClass("side-content");
            } else {
                $(".main-header").addClass("with-side-menu");
                $(".main-navbar").addClass("side-menu main-sidebar-sticky");
                $(".main-content").addClass("side-content");
                $(".side-menu").unbind("hover");
            }
        });

        return {
            switchLocale,
            switchMenu,
        };
    },
};
</script>
