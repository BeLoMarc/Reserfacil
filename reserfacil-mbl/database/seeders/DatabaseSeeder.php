<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        /*
|--------------------------------------------------------------------------
| Seeder Localidades
|--------------------------------------------------------------------------
*/
        DB::table('localidad')->insert([

            'nombre' => 'Ciudad Real',
            'cantidadRestaurantes' => 10,
        ]);
        DB::table('localidad')->insert([

            'nombre' => 'Albacete',
            'cantidadRestaurantes' => 7,
        ]);
        DB::table('localidad')->insert([

            'nombre' => 'Toledo',
            'cantidadRestaurantes' => 10,
        ]);
        DB::table('localidad')->insert([

            'nombre' => 'Cuenca',
            'cantidadRestaurantes' => 10,
        ]);
        DB::table('localidad')->insert([

            'nombre' => 'Guadalajara',
            'cantidadRestaurantes' => 10,
        ]);
        /*
|--------------------------------------------------------------------------
| Seeder categorias
|--------------------------------------------------------------------------
*/
        DB::table('categorias')->insert([
            'nombre' => 'casero',
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'italiano',
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'oriental',
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'vegano',
        ]);

        /*
|--------------------------------------------------------------------------
| Seeder Gerentes
|--------------------------------------------------------------------------
*/
        DB::table('users')->insert([
            'nombre' => 'gerente1',
            'apellido1' => 'Apellido 1 gerente 1',
            'apellido2' => 'apellido 2 gerente 1',
            'DNI' => '11111111A',
            'email' => 'gerente1@gerente.com',
            'password' => Hash::make(1234),
            'direccion' => 'Direccion del gerente 1',
            'telefono' => '111111119',
            'isAdmin' => 1,
        ]);
        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => '\App\Models\User',
            'model_id' => 1
        ]);
        DB::table('users')->insert([
            'nombre' => 'gerente2',
            'apellido1' => 'Apellido 1 gerente 2',
            'apellido2' => 'apellido 2 gerente 2',
            'DNI' => '11111112A',
            'email' => 'gerente2@gerente.com',
            'password' => Hash::make(1234),
            'direccion' => 'Direccion del gerente 2',
            'telefono' => '211111119',
            'isAdmin' => 1,
        ]);
        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => '\App\Models\User',
            'model_id' => 2
        ]);

        /*
|--------------------------------------------------------------------------
| Seeder Clientes
|--------------------------------------------------------------------------

        $cliente1 = \App\Models\User::create([
            'nombre' => 'cliente 1',
            'email' => 'Cliente1@soycliente.com',
            'password' => Hash::make(1234),
            'telefono' => '111111139',

        ]);
        $cliente1->assignRole('cliente');
        $cliente2 = \App\Models\User::create([
            'nombre' => 'cliente2',
            'email' => 'Cliente2@soycliente.com',
            'password' => Hash::make(1234),
            'telefono' => '111111149',
        ]);
        $cliente2->assignRole('cliente');

   */
        /*
|--------------------------------------------------------------------------
| Seeder Restaurantes
|--------------------------------------------------------------------------
*//*
        DB::table('restaurantes')->insert([
            'id' => 1,
            'nombre' => 'Malenia',
            'carta' => 'carta-de-malenia.jpg',
            'foto' => 'malenia.jpg',
            'banner' => 'banner-de-malenia.jpg',
            'direccion' => 'Arbol hieratico de miquella',
            'descripcion' => 'Descendiente del circulo',
            'telefono' => '123456789'
        ]);
        DB::table('restaurantes')->insert([
            'id' => 2,
            'nombre' => 'Cocifacil',
            'carta' => 'carta-de-cocifacil.jpg',
            'foto' => 'cocifacil.jpg',
            'banner' => 'banner-de-cocifacil.jpg',
            'direccion' => 'Aqui comeran los justos',
            'descripcion' => 'Come por lo que es tuyo',
            'telefono' => '123456777'
        ]);
        *//*
|--------------------------------------------------------------------------
| Seeder Restaurante_categorias
|--------------------------------------------------------------------------
*/
        DB::table('restaurante_categorias')->insert([
            'codigoRes' => 1,
            'codigoCat' => 2,
            //       'nombreCat' => 'italiano',
        ]);

        DB::table('restaurante_categorias')->insert([
            'codigoRes' => 2,
            'codigoCat' => 1,
            //       'nombreCat' => 'casero',
        ]);

        DB::table('restaurante_categorias')->insert([
            'codigoRes' => 2,
            'codigoCat' => 2,
            //         'nombreCat' => 'italiano',
        ]);
        /*
|--------------------------------------------------------------------------
| Seeder Restaurante_localidad
|--------------------------------------------------------------------------
*/
        DB::table('restaurante_localidad')->insert([
            'codigoRes' => 1,
            'codigoLoc' => 2,
            //           'nombre' => 'Albacete',

        ]);

        DB::table('restaurante_localidad')->insert([
            'codigoRes' => 2,
            'codigoLoc' => 1,
            //     'nombre' => 'Ciudad Real',
        ]);

        DB::table('restaurante_localidad')->insert([
            'codigoRes' => 2,
            'codigoLoc' => 2,
            //          'nombre' => 'Albacete',

        ]);
    }
}
