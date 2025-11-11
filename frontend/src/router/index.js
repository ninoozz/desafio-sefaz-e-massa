import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../stores/auth'

const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('../views/HomeView.vue')
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('../views/auth/LoginView.vue'),
    meta: { guest: true }
  },
  {
    path: '/register',
    name: 'register',
    component: () => import('../views/auth/RegisterView.vue'),
    meta: { guest: true }
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    redirect: '/',
    meta: { requiresAuth: true }
  },
  {
    path: '/programas',
    name: 'programas.index',
    component: () => import('../views/programas/IndexView.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/programas/create',
    name: 'programas.create',
    component: () => import('../views/programas/CreateView.vue'),
    meta: { requiresAuth: true, requiresAdmin: true }
  },
  {
    path: '/programas/:id/edit',
    name: 'programas.edit',
    component: () => import('../views/programas/EditView.vue'),
    meta: { requiresAuth: true, requiresAdmin: true }
  },
  {
    path: '/profile',
    name: 'profile.edit',
    component: () => import('../views/profile/EditView.vue'),
    meta: { requiresAuth: true }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach(async (to, from, next) => {
  const authStore = useAuthStore()
  
  if (to.meta.requiresAuth && !authStore.isAuthenticated) {
    next('/login')
  } else if (to.meta.guest && authStore.isAuthenticated) {
    next('/')
  } else if (to.meta.requiresAdmin && !authStore.isAdmin) {
    next('/')
  } else {
    next()
  }
})

export default router

