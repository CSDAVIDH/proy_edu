export const links = [
    {
        name: 'Dashboard',
        route: 'admin.index',
        icon: 'fa-solid fa-house',
    },
    {
        name: 'Usuarios',
        routes: ['admin.administrativos.index', 'admin.docentes.index', 'admin.estudiantes.index'],
        icon: 'fa-solid fa-users',
        sublinks: [
            {
                name: 'Administrativos',
                route: 'admin.administrativos.index',
            },
            {
                name: 'Docentes',
                route: 'admin.docentes.index'
            },
            {
                name: 'Estudiantes',
                route: 'admin.estudiantes.index'
            }
        ]
    },
    {
        name: 'Materias',
        routes: ['admin.materia.index', 'admin.paralelo.index'],
        icon: 'fa-solid fa-layer-group',
        sublinks: [
            {
                name: 'Materias',
                route: 'admin.materia.index',
            },
            {
                name: 'Paralelos',
                route: 'admin.paralelo.index'
            },
            {
                name:'Grados',
                route:'admin.grado.index'
            },
            {
                name:'Especialidades',
                route:'admin.especialidad.index'
            }
        ]
    },
    {
        name: 'Inscripciones',
        routes: ['admin.incripciones.index'],
        icon: 'fa-solid fa-desktop',
        sublinks: [
            {
                name: 'Inscripciones Estudiantes',
                route: 'admin.incripciones.index',
            },
            {
                name: 'Inscripciones Grado Academico',
                route: 'admin.incripciones.grados',
            },
        ]
    },
    {
        name: 'Notas',
        route: 'admin.notas.index',
        icon: 'fa-solid fa-book',
    },
    {
        name: 'Boletines',
        route: 'admin.boletines.index',
        icon: 'fa-solid fa-ticket',
    },
    {
        name: 'Mensajes',
        route: 'admin.mensajes.index',
        icon: 'fa-solid fa-message',
    },
    {
        name: 'Tareas',
        route: 'admin.tareas.index',
        icon: 'fa-solid fa-list-check',
    },
    {
        name: 'Horarios',
        route: 'admin.horarios.index',
        icon: 'fa-solid fa-calendar-days',
    },
    // {  
    //     name: 'About',
    //     route: 'admin.index',
    //     icon: 'fa-solid fa-house',
    // },
    // {
    //     name: 'Inicio',
    //     routes: ['admin.index', 'admin.alianzas', 'admin.portadas.slider'],
    //     icon: 'fa-solid fa-indent',
    //     sublinks: [
    //         {
    //             name: 'Portadas',
    //             route: 'admin.index',
    //         },
    //         {
    //             name: 'Slider Portada',
    //             route: 'admin.index'
    //         },
    //         {
    //             name: 'Nuestros Clientes',
    //             route: 'admin.index',
    //         }
    //     ]
    // }, 
];