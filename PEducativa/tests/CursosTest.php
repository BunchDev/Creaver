<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CursosTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCursosLista()
    {
    	$response = $this->call('GET','cursos');
    	$this->assertResponseOk();
       
    //	$this->assertEquals('Esto es el listado de cursos :) ',$response->getContent());
    }
    public function testCursoClick()
    {

        $this->visit('/cursos')
            ->click("pAprobado")
            ->seePage('irCurso/1');

    }
    
}
