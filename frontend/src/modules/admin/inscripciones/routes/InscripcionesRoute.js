
export default {
    name: 'admin.incsripciones',
    children: [        
      {
        path: '',
        name: 'admin.incripciones.index',
        component: () => import(/* webpackChunkName: "incripciones" */ '@/modules/admin/inscripciones/pages/IndexIncripciones.vue'),
      },  
      {
        path: 'grados',
        name: 'admin.incripciones.grados',
        component: () => import(/* webpackChunkName: "incripciones_grados" */ '@/modules/admin/inscripciones/pages/IndesInscripcionesGrados.vue'),
      },      
      {
        path: 'grado/:grado_id',
        name: 'admin.incripciones.grado.id',
        component: () => import(/* webpackChunkName: "incripciones_grado_id" */ '@/modules/admin/inscripciones/pages/GradoInscripcion.vue'),
        props: ( route ) => {
          const { grado_id } = route.params;
          return {id: Number(grado_id)};
        }
      },  
    ] 
}