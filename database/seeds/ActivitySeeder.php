<?php

use Illuminate\Database\Seeder;
use App\Helpers\OwnerHelpers;
class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados = [
            ["name"=> "Finanças e contabilidade" ],
            ["name"=> "Restauração, hotelaria e turismo" ],
            ["name"=> "Saúde" ],
            ["name"=> "Compras, logística e comércio" ],
            ["name"=> "Ensino, formação e línguas" ],
            ["name"=> "Engenharia" ],
            ["name"=> "Pesquisa e Desenvolvimento" ],
            ["name"=> "Actividade agrícola" ],
            ["name"=> "Banca, seguros" ],
            ["name"=> "Petróleos – Técnico especializado" ],
            ["name"=> "Gestão e executivo" ],
            ["name"=> "Informática e TI" ],
            ["name"=> "Imobiliário e construção" ],
            ["name"=> "Jurídico" ],
            ["name"=> "Marketing, comunicação e relações públicas" ],
            ["name"=> "Moda e espectáculo" ],
            ["name"=> "Qualidade, Higiene, Segurança e Ambiente" ],
            ["name"=> "Restauração, hotelaria e turismo" ],
            ["name"=> "Profissionais, operários e ofícios" ],
            ["name"=> "Vendas e atendimento ao cliente" ],
            ["name"=> "Ciências" ],
            ["name"=> "Indústria editorial" ],
            ["name"=> "Recursos Humanos" ],
            ["name"=> "Administração e apoio de escritório" ],
            ["name"=> "Beleza, fitness e desporto" ],
            ["name"=> "Consultoria, auditoria e estratégia empresarial" ],
        ];

        foreach ($dados as $key => $value) {
        	(OwnerHelpers::activity)::create($value);
        }
    }
}
