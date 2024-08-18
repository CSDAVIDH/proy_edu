
export default {
    name: 'admin.materias',
    children: [        
      {
        path: '',
        name: 'admin.materia.index',
        component: () => import(/* webpackChunkName: "materia" */ '@/modules/admin/materias/pages/IndexMaterias.vue'),
      },    
      {
        path: 'paralelos',
        name: 'admin.paralelo.index',
        component: () => import(/* webpackChunkName: "paralelos" */ '@/modules/admin/materias/pages/IndexParalelos.vue'),
      },   
    ] 
}