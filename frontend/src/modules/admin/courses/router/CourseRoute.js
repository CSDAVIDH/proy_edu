
export default {
    name: 'admin.cursos',
    children: [        
      {
        path: '',
        name: 'admin.cursos.index',
        component: () => import(/* webpackChunkName: "cursos" */ '@/modules/admin/courses/pages/IndexCourses.vue'),
      },      
    ] 
}