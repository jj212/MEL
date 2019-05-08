import bearer from '@websanova/vue-auth/drivers/auth/bearer'
import axios from '@websanova/vue-auth/drivers/http/axios.1.x'
import router from '@websanova/vue-auth/drivers/router/vue-router.2.x'
// Auth base configuration some of this options
// can be override in method calls
const config = {
    auth: bearer,
    http: axios,
    router: router,
    tokenDefaultName: 'mAndE',
    tokenStore: ['localStorage'],
    rolesVar: 'role',
    //registerData: {url: 'auth/register', method: 'POST', redirect: '/login'},
    loginData: {url: 'login', method: 'POST', redirect: '/dashboard', fetchUser: true},
    logoutData: {url: 'logout', method: 'POST', redirect: '/login', makeRequest: true},
    fetchData: {url: 'me', method: 'GET', enabled: true},
    refreshData: {url: 'refresh', method: 'GET', enabled: true, interval: 30},
    authRedirect: {path: '/login'},
    //notFoundRedirect: {path: '/login'},
    parseUserData: (data) => {
        return data || {}
    },
}
export default config