<?php

use Illuminate\Database\Seeder;
use App\MensajesPredeterminados;
class MensajePredeterminadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MensajesPredeterminados::create([
        'Mensaje'=>'Bienvenido a nuestro servicio de asistencia en línea de BAC Credomatic ¿Cómo le podemos ayudar el día de hoy? ',
        'tipo'=>'Saludo'
        ]);
        MensajesPredeterminados::create([
            'Mensaje'=>'Buenas tardes Sr.(a) ',
            'tipo'=>'Saludo'
            ]);
        MensajesPredeterminados::create([
                'Mensaje'=>'Tiene alguna consulta adicional? ',
                'tipo'=>'Pregunta'
                ]);
      
        MensajesPredeterminados::create([
                    'Mensaje'=>'Gracias por utilizar nuestro servicio en línea. 
                    Esperando que hayamos resuelto sus dudas, estamos a la orden para servirle en un 
                    horario de 8:00 a.m a 5:30 p.m. de lunes a viernes y sábados de 8:00 a.m. a 13:30 m.d.
                     También en el 210-4652 las 24 horas del día. Gracias por contactarnos por medio
                      de nuestros canales electrónicos',
                    'tipo'=>'Despedida'
                    ]);
 
                
    }
}
