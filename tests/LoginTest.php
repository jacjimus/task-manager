<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUrl()
    {
        $response = $this->call('GET' , url('/'));
        $this->assertEquals(200, $response->status());
    }
    
    public function testBlankFields()
    {
        $this->visit(url('/'))
                ->press('Login')
                ->seePageIs(url('/'));
    }
    public function testWrongValues()
    {
        $this->visit(url('/'))
                ->type('makau@gmail.com', 'email')
                ->type('makau2017', 'password')
                ->press('Login')
                ->seePageIs(url('/'));
    }
    public function testMismatchData()
    {
        $this->visit(url('/'))
                ->type('jacjimus@gmail.com', 'email')
                ->type('makau2017', 'password')
                ->press('Login')
                ->seePageIs(url('/'));
    }
    public function testCorrectdata()
    {
        $this->visit(url('/'))
                ->type('jacjimus@gmail.com', 'email')
                ->type('makau', 'password')
                ->press('Login')
                ->seePageIs(url('/dashboard'));
    }
}
