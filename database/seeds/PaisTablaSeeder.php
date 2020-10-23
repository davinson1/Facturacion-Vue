<?php

use Illuminate\Database\Seeder;
use App\Models\Paises;

class PaisTablaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Paises::create([
        'nombre' => 'Colombia',
      ]);
      Paises::create([
        'nombre' => 'Perú',
      ]);
      Paises::create([
        'nombre' => 'Ecuador',
      ]);
      Paises::create([
        'nombre' => 'Argentina',
      ]);
    }
}
