<?php

use Illuminate\Database\Seeder;
use App\Helpers\OwnerHelpers;
class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados = [
            ["name"=> "Sem Preferência", "level" => 0],
            ["name"=> "Ensino Secundário", "level" => 1],
            ["name"=> "Frequência Universitária", "level" => 2],
            ["name"=> "Licenciado", "level" => 3],
            ["name"=> "Mestrado", "level" => 4],
            ["name"=> "Doutorado", "level" => 5],
        ];

        foreach ($dados as $key => $value) {
        	(OwnerHelpers::degrees)::create($value);
        }
    }
}
