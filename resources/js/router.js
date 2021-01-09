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
    {
        path: '/search/:value',
        name: 'Search',
        props: true,
        component: () => import(/* webpackChunkName: "ApplicationEdit" */ './components/UserPanelSearch.vue'),
    },
]

export default new VueRouter({
    // mode: 'history',
    routes
})
