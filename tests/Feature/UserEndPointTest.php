<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\UserToken;

class UserEndPointTest extends TestCase
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

      $response = $this->json('POST', 'api/user/giveAccess', ['name' => 'Diego','email' => 'dm.diego.bh@gmail.com','url'=>'http://localhost:8080/user/new/']);
      $response->assertStatus(200);
    }

    public function testGiveAcessWithoutLogin($value='')
    {
      $response = $this->json('POST', 'api/user/giveAccess', ['name' => 'Diego','email' => 'dm.diego.bh@gmail.com']);
      $response->assertStatus(401);
    }

    /**
     * @dataProvider provider
     */
    public function testRegisterUser($userData)
    {
      $token = UserToken::create(["name"=>"Diego","email"=>"dm.diego.bh@gmail.com"])->token;
      $response = $this->json('POST','api/user/register',$userData+["token"=>$token]);
      $response->assertStatus(200);

      $this->assertDatabaseHas('addresses',[
        "city_id"=>$userData["city_id"],
        "street_name"=>$userData["street_name"],
        "street_number"=>$userData["street_number"],
        "CEP"=>$userData["CEP"]
      ]);

      unset($userData["email_confirmation"]);
      unset($userData["password_confirmation"]);
      unset($userData["city_id"]);
      unset($userData["street_name"]);
      unset($userData["street_number"]);
      unset($userData["CEP"]);

      $this->assertDatabaseHas('users',$userData);
      $this->assertDatabaseMissing('user_tokens',['token'=>$token]);
    }

    /**
     * @dataProvider provider
     */
    public function testRegisterUserWithoutToken($userData)
    {
      $response = $this->json('POST','api/user/register',$userData);
      $response->assertStatus(422);
    }

    /**
     * @dataProvider provider
     */
    public function testRegisterUserWithInvalidToken($userData)
    {
      $userData["token"]="invalidToken";
      $response = $this->json('POST','api/user/register',$userData);
      $response->assertStatus(422);
    }

    public function provider()
    {
      $token = "sdfsd";
      return [
        [[
          "name"=>"Diego",
          "email"=>"dm.diego.bh@gmail.com",
          "email_confirmation"=>"dm.diego.bh@gmail.com",
          "password"=>"123456",
          "password_confirmation"=>"123456",
          "CPF"=>"12345678912",
          "phone"=>"3112345678",
          "city_id"=>"1",
          "street_name"=>"nome da rua",
          "street_number"=>"253",
          "CEP"=>"12345678",
          "role_id"=>"1"
        ]]
      ];
    }
}
