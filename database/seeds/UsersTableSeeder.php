<?php


use App\Plan;
use App\Subscription;
use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        //
        $webmaster  = User::firstOrCreate([
            'username'           => 'jcaro',
            'name'               => 'webmaster',
            'surname'            => 'webmaster',
            'phone'              => '666252108',
            'birth_date'         => '1994-05-14',
            'email'              => 'jcaro@10code.es',
            'password'           => bcrypt('jcaro'),
            'email_verified_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at'         => new DateTime,
            'updated_at'         => new DateTime,
        ]);

        $webmaster->assignRole('webmaster');

        $technical1  = User::firstOrCreate([
            'username'           => 'technical1',
            'name'               => 'Técnico 1',
            'surname'            => 'De Prueba',
            'email'              => 'tecnico1@desfirbiladores.es',
            'password'           => bcrypt('tech1'),
            'email_verified_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at'         => new DateTime,
            'updated_at'         => new DateTime,

        ]);
        $technical1->assignRole('technical');


       $this->command->info('Users seeded :-)');

    }

}
