
export default {
    name: 'admin.usuarios',
    children: [        
      {
        path: '',
        name: 'admin.administrativos.index',
        component: () => import('@/modules/admin/usuarios/pages/IndexAdministrativo.vue'),
      },    
      {
        path: 'docentes',
        name: 'admin.docentes.index',
        component: () => import( '@/modules/admin/usuarios/pages/IndexDocente.vue'),
      },    
      {
        path: 'estudiantes',
        name: 'admin.estudiantes.index',
        component: () => import('@/modules/admin/usuarios/pages/IndexEstudiante.vue'),
      },      
      {
        path: 'padres',
        name: 'admin.padres.index',
        component: () => import('@/modules/admin/usuarios/pages/IndexPadre.vue'),
      },  
    ] 
}