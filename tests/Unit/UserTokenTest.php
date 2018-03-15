<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\UserToken;

class UserTokenTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGenerateUniqueToken()
    {
      UserToken::create(['name'=>'Diego','email'=>'contato@diegomatias.com.br']);
      $token = UserToken::GetUniqueToken();
      $tokens = UserToken::all();
      foreach ($tokens as $iten) {
        $this->assertFalse($iten->token==$token);
      }
    }

    public function testCreateUserToken()
    {
      $token = UserToken::create(['name'=>'Diego','email'=>'contato@diegomatias.com.br']);
      $this->assertDatabaseHas('user_tokens',['name'=>'Diego','email'=>'contato@diegomatias.com.br']);
    }
}
