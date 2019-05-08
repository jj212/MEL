import VueRouter from 'vue-router';

import Login from './components/Login';
import Dashboard from './components/Dashboard';


let routes = [
    {
        path: '/',
        redirect: '/login'
    }, {
        path: '/login',
        name: 'login',
        component: Login
    }
    , {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: {auth: true}
    }

];

export default new VueRouter({
    mode: 'history',
    routes,
    base: '/'
    //linkActiveClass: 'nav-active'
});