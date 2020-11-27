import VueRouter from 'vue-router';


let routes = [
    {
        path: '/index',
        name: 'Index',
        component: () => import(/* webpackChunkName: "ApplicationEdit" */ './components/UserPanelLists.vue'),
    },
    {
        path: '/archive',
        name: 'Archive',
        component: () => import(/* webpackChunkName: "ApplicationEdit" */ './components/UserPanelArchive.vue'),
    },
]

export default new VueRouter({
    // mode: 'history',
    routes
})
