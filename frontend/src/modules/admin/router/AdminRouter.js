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
  ]
}