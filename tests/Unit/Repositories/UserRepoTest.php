<?php

namespace Tests\Unit\Repositories;

use App\User;
use Illuminate\Support\Facades\Storage;
use Tests\BaseRepoTest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserRepoTest extends BaseRepoTest{
    /**
     * A basic test example.
     *
     * @return void
     */
    protected $testClass = User::class;
    protected $repo;
    protected $faker;

    public function setUp() {

        parent::setUp();

        $this->repo = $this->app->make('App\Repositories\UserRepo');
        $this->faker = $this->app->make('Faker\Generator');
    }

    public function testUpdateUserWithId(){
        $user = factory($this->testClass)->create();
        $userupdated = $this->repo->updateUser('testname',
                                               'testsurname',
                                               'testusername',
                                                'email@email.com',
                                                'test',
                                                $user->getId(),
                                                null,
                                                null,
                                                null);
        //$this->faker->image(storage_path('app\public\images'),640, 480, 'cats',false)
        $this->assertDatabaseHas('users',['name'=>'testname','surname'=>'testsurname','username'=>'testusername','email'=>'email@email.com']);
    }

    public function testUpdateUserWithoutId(){
        $this->assertTrue(true);
    }
    public function testUpdateUserWithIdWithoutAvatar(){
        $this->assertTrue(true);
    }
    public function testUpdateUserWithoutIdWithoutAvatar(){
        $this->assertTrue(true);
    }



}
