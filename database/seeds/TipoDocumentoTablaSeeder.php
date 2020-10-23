<?php

use Illuminate\Database\Seeder;
use App\Models\TipoDocumento;

class TipoDocumentoTablaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDocumento::create([
          'nombre' => 'Cédula',
        ]);

        TipoDocumento::create([
          'nombre' => 'Tarjeta de identidad',
        ]);
    }
}
