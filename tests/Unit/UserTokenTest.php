<?php

namespace Tests\Unit;

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
    public function testGenerateUniqueToken()
    {
      $token = UserToken::GetUniqueToken();
      $tokens = UserToken::all();
      foreach ($tokens as $iten) {
        $this->assertFalse($iten->token==$token);
      }
    }

    public function testCreateUserToken()
    {
      $token = UserToken::create(['name'=>'Diego','email'=>'contato@diegomatias.com.br']);
      $this->assertTrue($token->name=='Diego');
      $this->assertTrue($token->email=='contato@diegomatias.com.br');
      $this->assertTrue(isset($token->token));
    }
}
