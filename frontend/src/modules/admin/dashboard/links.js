import message from '@/assets/image/sobre.png';
import boletin from '@/assets/image/prueba.png';
import notas from '@/assets/image/birrete.png';
import tareas from '@/assets/image/libro.png';
import horario from '@/assets/image/reloj.png';
import galeria from '@/assets/image/fotografia.png';
export const links = [
    {
        id: 1,
        nombre: 'Mensajes',
        route: 'admin.mensajes.index',
        image: message,
    },
    {
        id: 2,
        nombre: 'Boletines',
        route: 'admin.boletines.index',
        image: boletin,
    },
    {
        id: 3,
        nombre: 'Notas',
        route: 'admin.notas.index',
        image: notas,
    },
    {
        id: 4,
        nombre: 'Tareas',
        route: 'admin.tareas.index',
        image: tareas,
    },
    {
        id: 5,
        nombre: 'Horario',
        route: 'admin.horarios.index',
        image: horario,
    },
    {
        id: 6,
        nombre: 'Galeria',
        route: 'admin.galeria.index',
        image: galeria,
    },
]
