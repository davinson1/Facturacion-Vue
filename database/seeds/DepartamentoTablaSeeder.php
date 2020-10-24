<?php

use Illuminate\Database\Seeder;
use App\Models\Departamentos;

class DepartamentoTablaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Departamentos::create([
      'id_pais' => '1',
      'nombre' => 'Huila',
    ]);
    Departamentos::create([
      'id_pais' => '2',
      'nombre' => 'Lima',
    ]);
    Departamentos::create([
      'id_pais' => '3',
      'nombre' => 'Pichincha',
    ]);
    Departamentos::create([
      'id_pais' => '4',
      'nombre' => 'Corrientes',
    ]);
  }
}
