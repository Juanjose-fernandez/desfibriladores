<?php

namespace Tests;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\Exception;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class BaseRepoTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFindOrFailSuccess()
    {
        $model = factory($this->testClass)->create();
        $this->assertNotEmpty($this->repo->findOrFail($model->getId()));
    }

    public function testFindOrFailError()
    {
        $this->expectException(ModelNotFoundException::class);
        $model = factory($this->testClass)->create();
        $this->repo->findOrFail($model->getId()+2);
    }

    /*
   * Obtener todos los Objetos de ese Model
   * @param int id Del modelo indicado
   * @var Model Objeto Eloquent
   */

    public function testAllSuccess()
    {
        $this->assertTrue(sizeof($this->repo->all()) == $this->repo->getModel()->count());
    }

}
