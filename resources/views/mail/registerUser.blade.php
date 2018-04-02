@extends('mail.base')

@section('title','Pro Agro')

@section('content')
  <div class="" style="height:60%">
    <h1>Olá {{$name}}</h1>
    <h3 style="margin-top: 80px;">Você acaba de receber acesso ao sistema da ProAgro, para que você possa acessar o nosso sistema primeiro você vai precisar de uma senha de acesso ao clicar no botão de cadastrar a senha você sera redirecionado a uma pagina para que sua senha seja cadastrada.</h3>
  </div>
  <a href="{{$url.$token}}" style="background-color: #4a8233;border-radius: 16px;color: white;text-decoration: none;padding: 8px;display:block;margin: 0px 50px;margin-bottom:10px;" class="button">Cadastrar senha</a>
@endsection
