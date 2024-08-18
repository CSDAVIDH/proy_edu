import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth/auth'

// rutas hijas 
import AuthRouter from '@/modules/auth/router/AuthRouter'
import AdminRouter from '@/modules/admin/router/AdminRouter'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      redirect: '/auth/login' 
    },
    {
      path: '/auth',
      ...AuthRouter
    },
    {
      path: '/admin',
      ...AdminRouter
    },
  ]
})

router.beforeEach( async (to) => {
  const publicPage = ['/auth/login'];
  const authRequired = !publicPage.includes(to.path)
  const auth = useAuthStore()
  if(authRequired && !auth.token){
    auth.returnUrl = to.fullPath
    return 'auth/login';
  }
})

export default router