export default {
    name: 'admin.grado',
    children: [        
      {
        path: '',
        name: 'admin.grado.index',
        component: () => import(/* webpackChunkName: "incripciones" */ '@/modules/admin/grados/pages/IndexGrados.vue'),
      },  
    ] 
}