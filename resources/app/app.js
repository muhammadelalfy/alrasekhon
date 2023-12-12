import './bootstrap';
import {createApp} from 'vue';

import App from "@/App.vue";
import router from "@/router";
import store from "@/store";

import i18n from "@/lang";
import MainPlugin from "@/plugins";
import BaseComponents from '@/components';

import {useAuthUserStore} from "./store/user";
import {useLoaderStore} from "./store/loader";

const app = createApp(App);
//mixins
app.mixin({
    data() {
        return {
            publicPath: import.meta.env.VITE_VUE_APP_ROOT + '/UI',
            publicUrl: import.meta.env.VITE_VUE_APP_ROOT,
        }
    }
});
//registered components
BaseComponents.register(app);
//state management with pinia
app.use(store);
app.config.globalProperties.$store = {
    userStore: useAuthUserStore(),
    loaderStore: useLoaderStore()
}
//translation
app.use(i18n);
//app plugins
app.use(MainPlugin);
//router
app.use(router);

app.mount('#app');
