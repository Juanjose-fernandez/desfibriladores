<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $client1  = \App\Client::firstOrCreate([
            'business_name'      => 'MEDILATE',
            'address'            => 'Calle Secoya, nº 14, 2.º D',
            'postcode'           => 28044,
            'municipality'       => 'España',
            'province'           => 'Madrid',
            'created_at'         => new DateTime,
            'updated_at'         => new DateTime,
        ]);
    }
}
