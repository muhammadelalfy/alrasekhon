import i18n from "../../lang";
import Login from "@views/Auth/Login.vue";
import ForgetPassword from "@views/Auth/ForgetPassword.vue";
import Reset from "@views/Auth/Reset.vue";

const t = () => i18n;

export default [
    {
        path: "/login",
        name: "login",
        component: Login,
        meta: {
            requiresAuth: true,
            title: t("messages.login"),
        },
    },
    {
        path: "/forget-password",
        name: "forgetPassword",
        component: ForgetPassword,
        meta: {
            title: "Forget password",
        },
    },
    {
        path: "/reset",
        name: "reset",
        component: Reset,
        meta: {
            title: "Reset Password",
        },
    },
];
