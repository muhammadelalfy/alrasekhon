<template>
    <div class="error-bg main-error-wrapper min-vh-100">
        <div class="row align-items-center d-flex flex-row">
            <div class="col-lg-6 text-end pe-lg-4">
                <h1 class="mb-0"><span class="fa fa-ban"></span>403</h1>
            </div>
            <div class="col-lg-6">
                <h2>
                    Oops.The Page you are looking for you don't have permission
                    to it..
                </h2>
                <h6>
                    You may have mistyped the address or the page may have
                    moved. Try searching below or contact system Adminstrator.
                </h6>
                <router-link
                    class="btn ripple btn-babyblue text-white text-center text-white w-fit-content"
                    to="/"
                    >Back to Home</router-link
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Forbidden",
};
</script>

<style scoped></style>
