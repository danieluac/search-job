<?php

use Illuminate\Database\Seeder;
use App\Helpers\OwnerHelpers;
class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados = [
            [
                "name"=> "Verde - Telemocunicações",
                "nif"=> 3430123,
                "address"=> "Ruas dos comandos em Angola",
                "description"=> "Ruas dos comandos em Angola",
                "activity_id"=> 1,
            ],
            [
                "name"=> "Escola Primaria",
                "nif"=> 635230123,
                "address"=> "Ruas dos comandos em Angola",
                "description"=> "Ruas dos comandos em Angola",
                "activity_id"=> 2,
            ],
            [
                "name"=> "TECT - Comércio Gerla",
                "nif"=> 54980123,
                "address"=> "Ruas dos comandos em Angola",
                "description"=> "Ruas dos comandos em Angola",
                "activity_id"=> 10,
            ],
        ];
        foreach ($dados as $key => $value) {
        	(OwnerHelpers::company_type)::create($value);
        }
    }
}
