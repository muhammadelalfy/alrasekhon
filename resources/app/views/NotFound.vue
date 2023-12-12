<script>
export default {
    name: "not-found",
};
</script>

<template>
    <div class="error-bg main-error-wrapper min-vh-100">
        <div class="row align-items-center d-flex flex-row">
            <div class="col-lg-6 text-end pe-lg-4">
                <h1 class="mb-0">404</h1>
            </div>
            <div class="col-lg-6">
                <h2>{{ $t("global.not_exist") }}</h2>
                <h6>
                    {{ $t("global.misstyped") }}
                </h6>
                <router-link
                    class="btn ripple btn-babyblue text-white text-center text-white w-fit-content"
                    to="/"
                    >{{ $t("global.back_home") }}</router-link
                >
            </div>
        </div>
    </div>
</template>
