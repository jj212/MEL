import VueRouter from 'vue-router';

import Login from './components/Login';
import Dashboard from './components/Dashboard';
import DocumentCreate from './components/Documents/Create';


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
    , {
        path: '/documents/create',
        name: 'documents-create',
        component: DocumentCreate,
        meta: {auth: true}
    }

];

export default new VueRouter({
    mode: 'history',
    routes,
    base: '/',
    linkActiveClass: 'active'
});