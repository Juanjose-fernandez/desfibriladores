<?php

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->delete();
        DB::table('provinces')->insert([

            ['id'=>1,  'country_id'=>48  ,   'name'=>  'Álava'     				        ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>2,  'country_id'=>48  ,   'name'=> 'Albacete'   		                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>3,  'country_id'=>48  ,   'name'=>  'Alicante'  		                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>4,  'country_id'=>48  ,   'name'=> 'Almería'    		                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>5,  'country_id'=>48  ,   'name'=> 'Ávila'      		                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>6,  'country_id'=>48  ,   'name'=>  'Badajoz'   		                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>7,  'country_id'=>48  ,   'name'=> 'Balears, Illes'	                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>8,  'country_id'=>48  ,   'name'=> 'Barcelona'			                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>9,  'country_id'=>48  ,   'name'=> 'Burgos'			                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>10, 'country_id'=>48  ,   'name'=>  'Cáceres'			                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>11, 'country_id'=>48 ,   'name'=> 'Cádiz'				                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>12, 'country_id'=>48 ,   'name'=>  'Castellón'		                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>13, 'country_id'=>48 ,   'name'=> 'Ciudad Real'		                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>14, 'country_id'=>48 ,   'name'=> 'Córdoba'			                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>15, 'country_id'=>48 ,   'name'=>  'Coruña, A'		                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>16, 'country_id'=>48 ,   'name'=> 'Cuenca'			                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>17, 'country_id'=>48 ,   'name'=> 'Girona'			                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>18, 'country_id'=>48 ,   'name'=> 'Granada'			                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>19, 'country_id'=>48 ,   'name'=> 'Guadalajara'		                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>20, 'country_id'=>48 ,   'name'=>  'Gipuzkoa'			                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>21, 'country_id'=>48 ,   'name'=> 'Huelva'			                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>22, 'country_id'=>48 ,   'name'=> 'Huesca'			                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>23, 'country_id'=>48 ,   'name'=> 'Jaén'				                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>24, 'country_id'=>48 ,   'name'=> 'León'				                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>25, 'country_id'=>48 ,   'name'=> 'Lleida'			                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>26, 'country_id'=>48 ,   'name'=>  'Rioja, La'		                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>27, 'country_id'=>48 ,   'name'=>  'Lugo'				                ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>28, 'country_id'=>48 ,   'name'=>  'Madrid'							,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>29, 'country_id'=>48 ,   'name'=> 'Málaga'							,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>30, 'country_id'=>48 ,   'name'=>  'Murcia'							,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>31, 'country_id'=>48 ,   'name'=>  'Navarra'							,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>32, 'country_id'=>48 ,   'name'=>  'Ourense'							,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>33, 'country_id'=>48 ,   'name'=> 'Asturias'							,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>34, 'country_id'=>48 ,   'name'=> 'Palencia'							,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>35, 'country_id'=>48 ,   'name'=> 'Palmas, Las'						,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>36, 'country_id'=>48 ,   'name'=>  'Pontevedra'						,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>37, 'country_id'=>48 ,   'name'=> 'Salamanca'							,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>38, 'country_id'=>48 ,   'name'=> 'Santa Cruz de Tenerife'			,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>39, 'country_id'=>48 ,   'name'=> 'Cantabria'							,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>40, 'country_id'=>48 ,   'name'=> 'Segovia'							,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>41, 'country_id'=>48 ,   'name'=> 'Sevilla'							,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>42, 'country_id'=>48 ,   'name'=> 'Soria'							    ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>43, 'country_id'=>48 ,   'name'=> 'Tarragona'							,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>44, 'country_id'=>48 ,   'name'=> 'Teruel'							,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>45, 'country_id'=>48 ,   'name'=> 'Toledo'							,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>46, 'country_id'=>48 ,   'name'=>  'Valencia'							,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>47, 'country_id'=>48 ,   'name'=> 'Valladolid'						,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>48, 'country_id'=>48 ,   'name'=>  'Bizkaia'							,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>49, 'country_id'=>48 ,   'name'=> 'Zamora'							,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>50, 'country_id'=>48 ,   'name'=> 'Zaragoza'							,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>51, 'country_id'=>48 ,   'name'=>  'Ceuta'							,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>52, 'country_id'=>48 ,   'name'=>  'Melilla'					        ,'created_at' => new DateTime, 'updated_at' => new DateTime ],
            ['id'=>53, 'country_id'=>48 ,   'name'=>  'Desconocida'					        ,'created_at' => new DateTime, 'updated_at' => new DateTime ]
        ]);

        $this->command->info('provinces seeded :-)');
    }
}
