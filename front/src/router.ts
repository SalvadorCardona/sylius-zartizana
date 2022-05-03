import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import UserPage from '@/modules/user/pages/UserPage.vue'
import HomePage from '@/modules/home/pages/HomePage.vue'

enum MainPageList {
    HOME_PAGE = 'home-page',
    USER_PAGE = 'user-page',
}

export const PageList = { ...MainPageList }

const routes: RouteRecordRaw[] = [
    {
        path: '/',
        component: HomePage,
        name: MainPageList.HOME_PAGE,
    },
    {
        path: '/user',
        component: UserPage,
        name: MainPageList.USER_PAGE,
    },
]

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: 'current-route',
    routes,
})

export default router
