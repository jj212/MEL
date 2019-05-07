import VueRouter from 'vue-router';

import Login from './components/Login';


let routes = [
    {
        path: '/',
        redirect: '/login'
    }, {
        path: '/login',
        name: 'login',
        component: Login
    }

];

export default new VueRouter({
    mode: 'history',
    routes,
    base: '/'
    //linkActiveClass: 'nav-active'
});