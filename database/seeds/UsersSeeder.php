<?php

use Illuminate\Database\Seeder;
use App\Helpers\OwnerHelpers;
class UsersSeeder extends Seeder
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
                'name' => (OwnerHelpers::company_type)::find(1)->name,
                'email' => "company1@app.com",
                'password' => Hash::make("password"),
                "type" => "Company",
                "owner_type" => OwnerHelpers::company_type,
                "owner_id" => 1,
            ],
            [
                'name' => (OwnerHelpers::company_type)::find(3)->name,
                'email' => "company2@app.com",
                'password' => Hash::make("password"),
                "type" => "Company",
                "owner_type" => OwnerHelpers::company_type,
                "owner_id" => 3,
            ],
            [
                'name' => (OwnerHelpers::company_type)::find(2)->name,
                'email' => "company3@app.com",
                'password' => Hash::make("password"),
                "type" => "Company",
                "owner_type" => OwnerHelpers::company_type,
                "owner_id" => 2,
            ],
            [
                'name' => "Fernanda Pedro",
                'email' => (OwnerHelpers::seeker_type)::find(1)->email,
                'password' => Hash::make("password"),
                "type" => "Seekers",
                "owner_type" => OwnerHelpers::seeker_type,
                "owner_id" => 1,
            ],
            [
                'name' => "Grilho Haerse",
                'email' => (OwnerHelpers::seeker_type)::find(2)->email,
                'password' => Hash::make("password"),
                "type" => "Seekers",
                "owner_type" => OwnerHelpers::seeker_type,
                "owner_id" => 2,
            ],
            [
                'name' => "Manuel Augusto",
                'email' => (OwnerHelpers::seeker_type)::find(3)->email,
                'password' => Hash::make("password"),
                "type" => "Seekers",
                "owner_type" => OwnerHelpers::seeker_type,
                "owner_id" => 3,
            ],
        ];
        foreach ($dados as $key => $value) {
            if((OwnerHelpers::user)::where('email','=',$value['email'])->count()){
                $usuario = (OwnerHelpers::user)::where('email','=',$value['email'])->first();
                $usuario->update($value);
            }else
                (OwnerHelpers::user)::create($value);
        }
    }
}
