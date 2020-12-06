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
            ["name"=> "Sem Preferência" ],
            ["name"=> "Ensino Secundário" ],
            ["name"=> "Frequência Universitária" ],
            ["name"=> "Licenciado" ],
            ["name"=> "Mestrado" ],
            ["name"=> "Doutorado" ],
        ];

        foreach ($dados as $key => $value) {
        	(OwnerHelpers::degrees)::create($value);
        }
    }
}
