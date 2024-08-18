export default {
    name: 'admin.especialidad',
    children: [        
      {
        path: '',
        name: 'admin.especialidad.index',
        component: () => import(/* webpackChunkName: "incripciones" */ '@/modules/admin/especialidades/pages/IndexEspecialidades.vue'),
      },  
    ] 
}