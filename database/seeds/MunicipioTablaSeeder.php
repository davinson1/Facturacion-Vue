<?php

use Illuminate\Database\Seeder;
use App\Models\Municipios;

class MunicipioTablaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Municipios::create([
        'id_departamento' => '1',
        'nombre' => 'Pitalito',
      ]);
      Municipios::create([
        'id_departamento' => '2',
        'nombre' => 'Lima',
      ]);
      Municipios::create([
        'id_departamento' => '3',
        'nombre' => 'Quito',
      ]);
      Municipios::create([
        'id_departamento' => '4',
        'nombre' => 'Mercedes',
      ]);
    }
}
