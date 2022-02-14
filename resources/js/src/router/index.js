import Vue from 'vue'
import VueRouter from 'vue-router'

import page from './routes/page'
import error from './routes/error'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    scrollBehavior() {
        return { x: 0, y: 0 }
    },
    routes: [
        {
            path: '/',
            name: 'home',
            component: () => import('../components/todoTable.vue'),
        },
        {
            path: '/second-page',
            name: 'second-page',
            component: () => import('../components/addTask.vue'),
        },
        {
            path: '/sidebar-page',
            name: 'sidebar-page',
            component: () => import('../components/todoLeftSidebar.vue'),
        },
        {
            path: '/error-404',
            name: 'error-404',
            component: () => import('../error-pages/error-404.vue'),
            meta: {
                layout: 'full',
            },
        },
        {
            path: '*',
            redirect: 'error-404',
        },
    ],
})

// ? For splash screen
// Remove afterEach hook if you are not using splash screen
router.afterEach(() => {
    // Remove initial loading
    const appLoading = document.getElementById('loading-bg')
    if (appLoading) {
        appLoading.style.display = 'none'
    }
})

export default router