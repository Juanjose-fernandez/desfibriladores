<?php

use Illuminate\Database\Seeder;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');



        //Permisos Superusuario / Webmaster
        Permission::firstOrCreate([
            'name' => 'webmaster',
            'display_name' => 'Permisos de los webmasters'
        ]);

        //Permisos Técnico
        Permission::firstOrCreate([
            'name' => 'technical',
            'display_name' => 'Permisos de los técnicos'
        ]);


        //WEBMASTER--------------------------------------------------------------------------
        $webmaster=Role::firstOrCreate([
            'name' => 'webmaster',
            'display_name' => 'Webmaster'
        ]);

        $webmaster->givePermissionTo('webmaster');


        //TÉCNICO--------------------------------------------------------------------------
        $customer=Role::create([
            'name' => 'technical',
            'display_name' => 'Técnico'
        ]);

        $customer->givePermissionTo('technical');


        $this->command->info('Permissions and Roles seeded :-)');
    }

}
