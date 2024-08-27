<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Persona;
class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        Persona::create(['nombre'=>'Administrador', 'paterno'=>'Admin', 'materno'=>'Admin', 'ci'=>'999999', 'expedido'=>'LP', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>1,]);
        Persona::create(['nombre'=>'Gregorio ', 'paterno'=>'Mamani ', 'materno'=>'Cutili', 'ci'=>'913365', 'expedido'=>'LP', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>2,]);
        Persona::create(['nombre'=>'Gustabo ', 'paterno'=>'Mamani ', 'materno'=>'Parraga', 'ci'=>'913366', 'expedido'=>'SZ', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>3,]);
        Persona::create(['nombre'=>'Ruben Leonardo ', 'paterno'=>'Aruquipa ', 'materno'=>'Limachi', 'ci'=>'913367', 'expedido'=>'CB', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>4,]);
        Persona::create(['nombre'=>'Esteban ', 'paterno'=>'Mamani ', 'materno'=>'Quispe', 'ci'=>'913368', 'expedido'=>'OR', 'estado_civil'=>'casado',  'genero'=>'masculino', 'user_id'=>5,]);
        Persona::create(['nombre'=>'Julio ', 'paterno'=>'Cesar ', 'materno'=>'Blanco', 'ci'=>'913369', 'expedido'=>'TJ', 'estado_civil'=>'casado',  'genero'=>'masculino', 'user_id'=>6,]);
        Persona::create(['nombre'=>'Faustino', 'paterno'=>'Mendoza', 'materno'=>'Quispe', 'ci'=>'913370', 'expedido'=>'BN', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>7,]);
        Persona::create(['nombre'=>'Jhony ', 'paterno'=>'Alarcon ', 'materno'=>'Fernandez', 'ci'=>'913371', 'expedido'=>'LP', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>8,]);
        Persona::create(['nombre'=>'Marta VIrginia ', 'paterno'=>'Choque ', 'materno'=>'Mamani', 'ci'=>'913372', 'expedido'=>'SZ', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>9,]);
        Persona::create(['nombre'=>'Margarita ', 'paterno'=>'Catari ', 'materno'=>'Alanoca', 'ci'=>'913373', 'expedido'=>'CB', 'estado_civil'=>'casado',  'genero'=>'femenino', 'user_id'=>10,]);
        Persona::create(['nombre'=>'Mary Lucre ', 'paterno'=>'Arispe ', 'materno'=>'Rojas', 'ci'=>'913374', 'expedido'=>'OR', 'estado_civil'=>'casado',  'genero'=>'femenino', 'user_id'=>11,]);
        Persona::create(['nombre'=>'Franz ', 'paterno'=>'Flores ', 'materno'=>'Huayhua', 'ci'=>'913375', 'expedido'=>'TJ', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>12,]);
        Persona::create(['nombre'=>'Yerson ', 'paterno'=>'Gomez ', 'materno'=>'Alaniz', 'ci'=>'913376', 'expedido'=>'BN', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>13,]);
        Persona::create(['nombre'=>'Octavio ', 'paterno'=>'Idelfonso', 'materno'=>'Rojas', 'ci'=>'913377', 'expedido'=>'LP', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>14,]);
        Persona::create(['nombre'=>'Jorge ', 'paterno'=>'Luis ', 'materno'=>'Oscamaita', 'ci'=>'913378', 'expedido'=>'SZ', 'estado_civil'=>'casado',  'genero'=>'masculino', 'user_id'=>15,]);
        Persona::create(['nombre'=>'Sheyla Scarlett ', 'paterno'=>'Flores ', 'materno'=>'Ramos', 'ci'=>'913379', 'expedido'=>'CB', 'estado_civil'=>'casado',  'genero'=>'femenino', 'user_id'=>16,]);
        Persona::create(['nombre'=>'Gerardo Diego ', 'paterno'=>'Mamani', 'materno'=>'Flores ', 'ci'=>'913380', 'expedido'=>'OR', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>17,]);
        Persona::create(['nombre'=>'Victor ', 'paterno'=>'Sarniento', 'materno'=>'Flores', 'ci'=>'913381', 'expedido'=>'TJ', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>18,]);
        Persona::create(['nombre'=>'Elizabeth', 'paterno'=>'Ibañez ', 'materno'=>'Parra', 'ci'=>'913382', 'expedido'=>'BN', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>19,]);
        Persona::create(['nombre'=>'Arnold Ruben ', 'paterno'=>'Saavedra ', 'materno'=>'Flores', 'ci'=>'913383', 'expedido'=>'LP', 'estado_civil'=>'casado',  'genero'=>'masculino', 'user_id'=>20,]);
        Persona::create(['nombre'=>'Maruja ', 'paterno'=>'Pinto ', 'materno'=>'Mamani', 'ci'=>'913384', 'expedido'=>'SZ', 'estado_civil'=>'casado',  'genero'=>'femenino', 'user_id'=>21,]);
        Persona::create(['nombre'=>'Luis', 'paterno'=>'Manzaneda ', 'materno'=>'Paucara', 'ci'=>'913385', 'expedido'=>'CB', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>22,]);
        Persona::create(['nombre'=>'Fernado dino', 'paterno'=>'Paucara', 'materno'=>'Pinto', 'ci'=>'913386', 'expedido'=>'OR', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>23,]);
        Persona::create(['nombre'=>'Raul Gabriel', 'paterno'=>'Loza ', 'materno'=>'Pinto', 'ci'=>'913387', 'expedido'=>'TJ', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>24,]);
        Persona::create(['nombre'=>'Valdimir', 'paterno'=>'Pinto ', 'materno'=>'Chopque', 'ci'=>'913388', 'expedido'=>'BN', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>25,]);
        Persona::create(['nombre'=>'Ivana', 'paterno'=>'Yugar ', 'materno'=>'Mamani', 'ci'=>'913389', 'expedido'=>'LP', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>26,]);
        Persona::create(['nombre'=>'Belen', 'paterno'=>'Yanarico', 'materno'=>'Huallpa', 'ci'=>'913390', 'expedido'=>'SZ', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>27,]);
        Persona::create(['nombre'=>'Dan Cruz', 'paterno'=>'Huascar ', 'materno'=>'Huyanca', 'ci'=>'913391', 'expedido'=>'CB', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>28,]);
        Persona::create(['nombre'=>'Cesar ', 'paterno'=>'Huianca ', 'materno'=>'Clemente', 'ci'=>'913392', 'expedido'=>'OR', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>29,]);
        Persona::create(['nombre'=>'kate', 'paterno'=>'Clemente ', 'materno'=>'Huallpa', 'ci'=>'913393', 'expedido'=>'TJ', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>30,]);
        Persona::create(['nombre'=>'Katerin', 'paterno'=>'Gyr ', 'materno'=>'Huanca', 'ci'=>'913394', 'expedido'=>'BN', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>31,]);
        Persona::create(['nombre'=>'Carla', 'paterno'=>'Yoson ', 'materno'=>'Yercos', 'ci'=>'913395', 'expedido'=>'LP', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>32,]);
        Persona::create(['nombre'=>'Judith', 'paterno'=>'Fernandez ', 'materno'=>'Mamani', 'ci'=>'913396', 'expedido'=>'SZ', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>33,]);
        Persona::create(['nombre'=>'Ruth', 'paterno'=>'Folres ', 'materno'=>'Mamani', 'ci'=>'913397', 'expedido'=>'CB', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>34,]);
        Persona::create(['nombre'=>'Lili', 'paterno'=>'Ibaña ', 'materno'=>'Mamani', 'ci'=>'913398', 'expedido'=>'OR', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>35,]);
        Persona::create(['nombre'=>'Ydira', 'paterno'=>'Parra ', 'materno'=>'sarniento', 'ci'=>'913399', 'expedido'=>'TJ', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>36,]);
        Persona::create(['nombre'=>'Naira', 'paterno'=>'Saaverdra ', 'materno'=>'chpoque', 'ci'=>'913400', 'expedido'=>'BN', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>37,]);
        Persona::create(['nombre'=>'Maira', 'paterno'=>'Choquehuanca ', 'materno'=>'Mamani', 'ci'=>'913401', 'expedido'=>'LP', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>38,]);
        Persona::create(['nombre'=>'Angeliza', 'paterno'=>'Guanca  ', 'materno'=>'hismar', 'ci'=>'913402', 'expedido'=>'SZ', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>39,]);
        Persona::create(['nombre'=>'Angie', 'paterno'=>'paulinas ', 'materno'=>'Parra', 'ci'=>'913403', 'expedido'=>'CB', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>40,]);
        Persona::create(['nombre'=>'Mabel', 'paterno'=>'Cutili ', 'materno'=>'Parra', 'ci'=>'913404', 'expedido'=>'OR', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>41,]);
        Persona::create(['nombre'=>'Mariana', 'paterno'=>'Cutili ', 'materno'=>'mamani', 'ci'=>'913405', 'expedido'=>'TJ', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>42,]);
        Persona::create(['nombre'=>'Marcos', 'paterno'=>'Huyallhua ', 'materno'=>'mamani', 'ci'=>'913406', 'expedido'=>'BN', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>43,]);
        Persona::create(['nombre'=>'Jennife', 'paterno'=>'Copa ', 'materno'=>'Mamani', 'ci'=>'913407', 'expedido'=>'LP', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>44,]);
        Persona::create(['nombre'=>'Carolina ', 'paterno'=>'Folres ', 'materno'=>'Herbas', 'ci'=>'913408', 'expedido'=>'SZ', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>45,]);
        Persona::create(['nombre'=>'Catherine', 'paterno'=>'Folres ', 'materno'=>'Pinto', 'ci'=>'913409', 'expedido'=>'CB', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>46,]);
        Persona::create(['nombre'=>'Carmen', 'paterno'=>'Atea', 'materno'=>'mamni', 'ci'=>'913410', 'expedido'=>'OR', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>47,]);
        Persona::create(['nombre'=>'Roda', 'paterno'=>'Tirado ', 'materno'=>'Mamni', 'ci'=>'913411', 'expedido'=>'TJ', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>48,]);
        Persona::create(['nombre'=>'Rosmery', 'paterno'=>'Rico ', 'materno'=>'Choque', 'ci'=>'913412', 'expedido'=>'BN', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>49,]);
        Persona::create(['nombre'=>'fanny', 'paterno'=>'Reyes ', 'materno'=>'Atea', 'ci'=>'913413', 'expedido'=>'LP', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>50,]);
        Persona::create(['nombre'=>'silviua', 'paterno'=>'Quispe ', 'materno'=>'Mamni', 'ci'=>'913414', 'expedido'=>'SZ', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>51,]);
        Persona::create(['nombre'=>'Gary', 'paterno'=>'Tarantino ', 'materno'=>'Mamni', 'ci'=>'913415', 'expedido'=>'CB', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>52,]);
        Persona::create(['nombre'=>'Julio ', 'paterno'=>'tarantino ', 'materno'=>'Hunc', 'ci'=>'913416', 'expedido'=>'OR', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>53,]);
        Persona::create(['nombre'=>'Carlos ', 'paterno'=>'Reyes ', 'materno'=>'paucara', 'ci'=>'913417', 'expedido'=>'TJ', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>54,]);
        Persona::create(['nombre'=>'Juan Marco', 'paterno'=>'Yucra', 'materno'=>'paucara', 'ci'=>'913418', 'expedido'=>'BN', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>55,]);
        Persona::create(['nombre'=>'Cristal ', 'paterno'=>'Loza ', 'materno'=>'paucara', 'ci'=>'913419', 'expedido'=>'LP', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>56,]);
        Persona::create(['nombre'=>'Cristel ', 'paterno'=>'lazarte ', 'materno'=>'Quispe', 'ci'=>'913420', 'expedido'=>'SZ', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>57,]);
        Persona::create(['nombre'=>'Jovanna ', 'paterno'=>'Calle ', 'materno'=>'pinto', 'ci'=>'913421', 'expedido'=>'CB', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>58,]);
        Persona::create(['nombre'=>'Yohanna', 'paterno'=>'Calle ', 'materno'=>'Mamani', 'ci'=>'913422', 'expedido'=>'OR', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>59,]);
        Persona::create(['nombre'=>'Pamela', 'paterno'=>'caaviri ', 'materno'=>'Huanca', 'ci'=>'913423', 'expedido'=>'TJ', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>60,]);
        Persona::create(['nombre'=>'Erika Carla', 'paterno'=>'Arispe ', 'materno'=>'Rojas', 'ci'=>'913424', 'expedido'=>'BN', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>61,]);
        Persona::create(['nombre'=>'Alison', 'paterno'=>'Flores ', 'materno'=>'Huayhua', 'ci'=>'913425', 'expedido'=>'LP', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>62,]);
        Persona::create(['nombre'=>'Lucero Belen', 'paterno'=>'Gomez ', 'materno'=>'Alaniz', 'ci'=>'913426', 'expedido'=>'SZ', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>63,]);
        Persona::create(['nombre'=>'Juan Pablo', 'paterno'=>'Idelfonso', 'materno'=>'Alaniz', 'ci'=>'913427', 'expedido'=>'CB', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>64,]);
        Persona::create(['nombre'=>'Yerson ', 'paterno'=>'Luis ', 'materno'=>'Oscamaita', 'ci'=>'913428', 'expedido'=>'OR', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>65,]);
        Persona::create(['nombre'=>'Juan Gabriel', 'paterno'=>'Flores ', 'materno'=>'Ramos', 'ci'=>'913429', 'expedido'=>'TJ', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>66,]);
        Persona::create(['nombre'=>'Ruben Leonardo ', 'paterno'=>'Mamani', 'materno'=>'Ramos', 'ci'=>'913430', 'expedido'=>'BN', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>67,]);
        Persona::create(['nombre'=>'Victor Juan', 'paterno'=>'Sarniento', 'materno'=>'Ramos', 'ci'=>'913431', 'expedido'=>'LP', 'estado_civil'=>'soltero',  'genero'=>'na', 'user_id'=>68,]);
        Persona::create(['nombre'=>'Richard ', 'paterno'=>'Ibañez ', 'materno'=>'Parra', 'ci'=>'913432', 'expedido'=>'SZ', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>69,]);
        Persona::create(['nombre'=>'Gregorio ', 'paterno'=>'Saavedra ', 'materno'=>'Flores', 'ci'=>'913433', 'expedido'=>'CB', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>70,]);
        Persona::create(['nombre'=>'Gustabo ', 'paterno'=>'Pinto ', 'materno'=>'Mamani', 'ci'=>'913434', 'expedido'=>'OR', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>71,]);
        Persona::create(['nombre'=>'Ruben Leonardo ', 'paterno'=>'Manzaneda ', 'materno'=>'Saavedra ', 'ci'=>'913435', 'expedido'=>'TJ', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>72,]);
        Persona::create(['nombre'=>'Esteban ', 'paterno'=>'Paucara', 'materno'=>'Saavedra ', 'ci'=>'913436', 'expedido'=>'BN', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>73,]);
        Persona::create(['nombre'=>'Agosto', 'paterno'=>'Loza ', 'materno'=>'Pinto', 'ci'=>'913437', 'expedido'=>'LP', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>74,]);
        Persona::create(['nombre'=>'Faustino', 'paterno'=>'Pinto ', 'materno'=>'Chopque', 'ci'=>'913438', 'expedido'=>'SZ', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>75,]);
        Persona::create(['nombre'=>'Jhony ', 'paterno'=>'Yugar ', 'materno'=>'Mamani', 'ci'=>'913439', 'expedido'=>'CB', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>76,]);
        Persona::create(['nombre'=>'Marta VIrginia ', 'paterno'=>'Yanarico', 'materno'=>'Mamani', 'ci'=>'913440', 'expedido'=>'OR', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>77,]);
        Persona::create(['nombre'=>'Margarita ', 'paterno'=>'Huascar ', 'materno'=>'Huyanca', 'ci'=>'913441', 'expedido'=>'TJ', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>78,]);
        Persona::create(['nombre'=>'Mary Lucre ', 'paterno'=>'Huianca ', 'materno'=>'Clemente', 'ci'=>'913442', 'expedido'=>'BN', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>79,]);
        Persona::create(['nombre'=>'Franz ', 'paterno'=>'Clemente ', 'materno'=>'Huallpa', 'ci'=>'913443', 'expedido'=>'LP', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>80,]);
        Persona::create(['nombre'=>'Yerson ', 'paterno'=>'Gyr ', 'materno'=>'Huanca', 'ci'=>'913444', 'expedido'=>'SZ', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>81,]);
        Persona::create(['nombre'=>'Octavio ', 'paterno'=>'Yoson ', 'materno'=>'Yercos', 'ci'=>'913445', 'expedido'=>'CB', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>82,]);
        Persona::create(['nombre'=>'Jorge ', 'paterno'=>'Fernandez ', 'materno'=>'Mamani', 'ci'=>'913446', 'expedido'=>'OR', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>83,]);
        Persona::create(['nombre'=>'Sheyla Scarlett ', 'paterno'=>'Folres ', 'materno'=>'Mamani', 'ci'=>'913447', 'expedido'=>'TJ', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>84,]);
        Persona::create(['nombre'=>'Gerardo Diego ', 'paterno'=>'Ibaña ', 'materno'=>'Mamani', 'ci'=>'913448', 'expedido'=>'BN', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>85,]);
        Persona::create(['nombre'=>'Victor ', 'paterno'=>'Parra ', 'materno'=>'sarniento', 'ci'=>'913449', 'expedido'=>'LP', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>86,]);
        Persona::create(['nombre'=>'Elizabeth', 'paterno'=>'Saaverdra ', 'materno'=>'chpoque', 'ci'=>'913450', 'expedido'=>'LP', 'estado_civil'=>'soltero',  'genero'=>'femenino', 'user_id'=>87,]);
        // padre de familia 
        Persona::create(['nombre'=>'Elizabeth', 'paterno'=>'Saaverdra ', 'materno'=>'choque', 'ci'=>'913451', 'expedido'=>'LP', 'estado_civil'=>'casado',  'genero'=>'femenino', 'user_id'=>88,]);
        Persona::create(['nombre'=>'Favio', 'paterno'=>'Contreras ', 'materno'=>'Mamani', 'ci'=>'913452', 'expedido'=>'LP', 'estado_civil'=>'viudo',  'genero'=>'masculino', 'user_id'=>89,]);
        Persona::create(['nombre'=>'Juan Pablo', 'paterno'=>'Teran ', 'materno'=>'Huallpa', 'ci'=>'913453', 'expedido'=>'LP', 'estado_civil'=>'soltero',  'genero'=>'masculino', 'user_id'=>90,]);
        
    }
}
