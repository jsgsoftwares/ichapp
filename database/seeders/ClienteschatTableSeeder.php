<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\clientes_chat;
class ClienteschatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        clientes_chat::create(
        [

        /* 'user_id'=>'1', */
            'firstname'=>'Johnny',
            'lastname'=>'Gonzalez',
            'tipo_nip_id'=>'1',
            'nip'=>'8-801-1402',
            'pais_id'=>'22',
            'genero_id'=>'1',
            'profesion'=>'Software developers',
            'nacimiento'=>'1985-08-21 12:00:24',
            'correo'=>'jhonny_sg10@hotmail.com',
            'companie_id'=>3,

        ]
        );
        clientes_chat::create(
        [

        /* 'user_id'=>'1', */
            'firstname'=>'Maria',
            'lastname'=>'Alvarez',
            'tipo_nip_id'=>'2',
            'nip'=>'145074261',
            'pais_id'=>'232',
            'genero_id'=>'2',
            'profesion'=>'Maestra preescolar',
            'nacimiento'=>'1985-08-21 12:00:24',
            'correo'=>'maria@hotmail.com',
            'companie_id'=>3,


        ]
        );
        clientes_chat::create(
        [

            /* 'user_id'=>'1', */
            'firstname'=>'Jose',
            'lastname'=>'Alvarez',
            'tipo_nip_id'=>'2',
            'nip'=>'145074234',
            'pais_id'=>'232',
            'genero_id'=>'1',
            'profesion'=>'Gestion de cobros',
            'nacimiento'=>'1985-08-21 12:00:24',
            'correo'=>'jose@hotmail.com',
            'companie_id'=>3,


        ]
        );
        clientes_chat::create(
        [

            /* 'user_id'=>'1', */
            'firstname'=>'mery',
            'lastname'=>'Alvarez',
            'tipo_nip_id'=>'2',
            'nip'=>'145074245',
            'pais_id'=>'232',
            'genero_id'=>'2',
            'profesion'=>'Finanzas',
            'nacimiento'=>'1985-08-21 12:00:24',
            'correo'=>'mery@hotmail.com',
            'companie_id'=>3,

        ]
        );
        clientes_chat::create(
            [
    
                /* 'user_id'=>'1', */
                'firstname'=>'Carlos',
                'lastname'=>'Santos',
                'tipo_nip_id'=>'2',
                'nip'=>'8-746-203',
                'pais_id'=>'22',
                'genero_id'=>'1',
                'profesion'=>'Capacitador',
                'nacimiento'=>'1985-08-21 12:00:24',
                'correo'=>'carlos@hotmail.com',
                'companie_id'=>2,
    
            ]
            );
        clientes_chat::create(
            [
    
                /* 'user_id'=>'1', */
                'firstname'=>'Christian',
                'lastname'=>'Sentman',
                'tipo_nip_id'=>'1',
                'nip'=>'8-746-2223',
                'pais_id'=>'22',
                'genero_id'=>'1',
                'profesion'=>'Diseñador grafico',
                'nacimiento'=>'1985-08-21 12:00:24',
                'correo'=>'carlos@hotmail.com',
                'companie_id'=>2,
    
            ]
            );
    }
}
