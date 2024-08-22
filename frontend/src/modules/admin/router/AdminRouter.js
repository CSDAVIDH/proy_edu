import MateriasRoute from '../materias/router/MateriasRoute';

import UsuariosRoute from '../usuarios/router/UsuariosRoute';
import InscripcionesRoute from '../inscripciones/routes/InscripcionesRoute';
import GradosRoute from '../grados/routes/GradosRoute';
import EspecialidadesRoute from '../especialidades/routes/EspecialidadesRoute';

export default {
  name: '',
  component: () => import('@/layouts/AppLayout.vue'),
  children: [
    {
      path: '',
      name: 'admin.index',
      component: () => import('@/modules/admin/dashboard/Dashboard.vue'),
    },
    {
      path: 'materias',
      ...MateriasRoute
    },
    {
      path: 'usuarios',
      ...UsuariosRoute
    },
    {
      path: 'incripciones',
      ...InscripcionesRoute
    },
    {
      path:'grados',
      ...GradosRoute
    },
    
    {
      path:'especialidades',
      ...EspecialidadesRoute
    },    
    {
      path: 'notas',
      name: 'admin.notas.index',
      component: () => import('@/modules/admin/notas/pages/IndexNotas.vue'),
    },
    {
      path: 'boletines',
      name: 'admin.boletines.index',
      component: () => import('@/modules/admin/boletines/pages/IndexBoletines.vue'),
    }, 
    {
      path: 'mensajes',
      name: 'admin.mensajes.index',
      component: () => import('@/modules/admin/mensajes/pages/IndexMensajes.vue'),
    }, 
    {
      path: 'tareas',
      name: 'admin.tareas.index',
      component: () => import('@/modules/admin/tareas/pages/IndexTareas.vue'),
    }, 
    {
      path: 'horarios',
      name: 'admin.horarios.index',
      component: () => import('@/modules/admin/horarios/pages/IndexHorarios.vue'),
    }, 
    {
      path: 'galeria',
      name: 'admin.galeria.index',
      component: () => import('@/modules/admin/galeria/pages/IndexGaleria.vue'),
    }, 
  ]
}