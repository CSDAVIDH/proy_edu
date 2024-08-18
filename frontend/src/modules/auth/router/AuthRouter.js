export default {
    name: '',
    component: () => import(/* webpackChunkName: "auth" */ '@/layouts/AuthLayout.vue'),
    children: [        
      {
        path: 'login',
        name: 'auth-login',
        component: () => import(/* webpackChunkName: "Login" */ '@/modules/auth/pages/Login.vue'),
      },
    ] 
}