<script>
    export default {
        name: 'cancel-button',
    }

</script>

<template>
<!--    btn ripple btn-secondary-->
    <a href="#" @click.prevent="$router.back()" class="btn btn-light fw-bold ms-2">{{ $t('forms.cancel') }}</a>
</template>
