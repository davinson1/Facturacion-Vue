<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      // $this->call(UserSeeder::class);
    	$this->call(TipoDocumentoTablaSeeder::class);
      $this->call(PaisTablaSeeder::class);
      $this->call(DepartamentoTablaSeeder::class);
      $this->call(MunicipioTablaSeeder::class);
      // $this->call(PermisosTablaSeeder::class);
      $this->call(UsuarioTablaSeeder::class);
    }
}
