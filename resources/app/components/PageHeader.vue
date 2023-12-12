<template>
    <div class="page-header">
        <div>
            <h2 class="main-content-title">{{ $t(title) }}</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <router-link to="/">
                            {{ $t('sidebar.dashboard') }}
                        </router-link>
                    </li>
                    <li :class="active ? 'breadcrumb-item active' : 'breadcrumb-item'" aria-current="page">
                        <span v-if="active">{{ $t(title) }}</span>
                        <a v-else @click="$router.back()">{{ $t(title) }}</a>
                    </li>
                    <slot></slot>
                </ol>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    name: "PageHeader",
    props:{
        title:{
            type:String,
            default:''
        },
        active:{
            type:Boolean,
            default:true
        }
    }
}
</script>

<style scoped>

</style>
