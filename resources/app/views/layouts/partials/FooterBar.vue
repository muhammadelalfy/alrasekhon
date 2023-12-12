<template>
    <div class="main-footer text-center">
        <div class="container">
            <div class="fw-bold"
            >
                <span>{{$t('pages.version_no')}} - {{$t('pages.copy_right')}} </span>
                <a href="https://www.roqay.com/"> - {{ $t('pages.roqay') }}</a>
                <span> &copy; {{new Date().getFullYear()}}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "footer-bar",
};
</script>
