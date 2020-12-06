<?php

use Illuminate\Database\Seeder;
use App\Helpers\OwnerHelpers;
class SeekerSeeder extends Seeder
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
                "date_birth" => '1998-04-23',
                "telephone" => '209391',
                "email" => 'seeker2@app.com',
            ],
            [
                "date_birth" => '1999-02-12',
                "telephone" => '214343',
                "email" => 'seeker3@app.com',
            ],
            [
                "date_birth" => '2000-02-02',
                "telephone" => '21212323',
                "email" => 'seeker1@app.com',
            ],
        ];
        foreach ($dados as $key => $value) {
        	(OwnerHelpers::seeker_type)::create($value);
        }
    }
}
