<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGiveAcess()
    {
      $this->withoutMiddleware();

      $response = $this->json('POST', 'api/user/giveAccess', ['name' => 'Diego','email' => 'dm.diego.bh@gmail.com']);
      $response->assertStatus(200);
    }

    public function testGiveAcessWithoutLogin($value='')
    {
      $response = $this->json('POST', 'api/user/giveAccess', ['name' => 'Diego','email' => 'dm.diego.bh@gmail.com']);
      $response->assertStatus(401);
    }

    public function testGiveAcessWithoutLogin($value='')
    {
      $response = $this->json('POST', 'api/user/giveAccess', ['name' => 'Diego','email' => 'dm.diego.bh@gmail.com']);
      $response->assertStatus(401);
    }
}
