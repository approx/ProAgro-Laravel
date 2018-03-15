<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\UserToken;

class UserTokenTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testValidToken()
    {
        $token = UserToken::create(['name'=>'Diego','email'=>'contato@diegomatias.com.br']);
        $response = $this->get('/api/user_token/'.$token->token);
        $response->assertStatus(200);
        $token->delete();
    }

    public function testInvaliValidToken()
    {
        $response = $this->get('/api/user_token/invalidtoken');
        $response->assertStatus(404);
    }
}
