import UserService from '@services/user'
import {useAuthUserStore} from "../../store/user";

const whiteList = ['/auth', '/login', '/auth-redirect', '/forget-password' , '/rest']; // no redirect whitelist
const noCheckAbilityList = whiteList.concat(['/403', ':pathMatch(.*)*', '/dashboard', '/']);

export function checkAccessMiddleware(to, from, next) {
    // set page title
    document.title = 'Rasekhon';
    let hasAbility = useAuthUserStore().hasPermission(to.meta.action, to.meta.module)
    if (!hasAbility && !noCheckAbilityList.includes(to.path)){
        return next();
        // return next({
        //     path: '/403'
        // });
    }
    // determine whether the user has logged in
    const isUserLogged = UserService.isLogged();
    if (isUserLogged) {
        if (to.path === '/login') {
            // if is logged in, redirect to the home page
            next({
                path: '/'
            });
        } else {
            next();
        }
    } else {
        /* has no token*/
        if (whiteList.indexOf(to.matched[0] ? to.matched[0].path : '') !== -1) {
            // in the free login whitelist, go directly
            next();
        } else {
            // other pages that do not have permission to access are redirected to the login page.
            next(`/login?redirect=${to.path}`);
        }
    }
}
