<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class AddUserDefaultSeeder extends Seeder
{

    public function run()
    {
        if(User::count() == 0)
        {
            User::create([
                'type' => 0,
                'name' => 'Administrador',
                'email' => "demo@backofficesolucoes.io",
                'telephone' => "(31) 99999-9999",
                'cpf' => '000.000.000-00',
                'bank' => '--',
                'agency' => '0',
                'account' => '0',
                'account_type' => '0',
                'function' => "Analista",
                'location_work' => 'Belo Horizonte',
                'password' => Hash::make('12345678'),
                'api_token' => "",
                'status' => 0,
            ]);
        }
    }

}
