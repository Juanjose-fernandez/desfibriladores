<?php

namespace Tests\Browser\Site\Users;

use App\Permission;
use App\Role;
use App\User;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = factory(User::class)->create([
            'username'           => 'w3bm@st3r',
            'name'               => 'webmaster',
            'surname'            => 'webmaster',
            'email'              => 'webmaster@10code.es',
            'password'           => bcrypt('code.1010!'),
            'confirmed'          => 1,
            'confirmation_code'  => md5(microtime().Config::get('app.key')),
            'created_at'         => new DateTime,
            'updated_at'         => new DateTime,
        ])->each(function ($user) {
            $user->roles()->save(factory(Role::class)->make([
                'name' => 'webmaster',
                'display_name' => 'Webmaster',
                'guard_name' => 'web'
            ]));
            factory(Permission::class)->create([
                'name' => 'user_management',
                'display_name' => 'User management',
                'guard_name' => 'web'

            ]);

            $user->givePermissionTo('user_management');
        });
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->type('username', 'w3bm@st3r')
                    ->type('password', 'code.1010!')
                    ->press('Iniciar sesión')
                    ->assertPathIs($this->instalation_folder.'/', null);

        });
    }
}
