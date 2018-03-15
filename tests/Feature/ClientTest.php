<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
{
  use WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {

      $response = $this->json('POST', 'api/user/giveAccess', ['name' => 'Diego','email' => 'dm.diego.bh@gmail.com']);
      var_dump($response->content());
      $response->assertStatus(200);
    }
}
