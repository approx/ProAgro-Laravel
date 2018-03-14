@extends('mail.base')

@section('title','Pro Agro')

@section('style')
  <style media="screen">
    .button{
      position: absolute;
      left: 50%;
      transform: translate(-50%,50%);
      bottom: 83px;
      background-color: #4a8233;
      border-radius: 16px;
      color: white;
      text-decoration: none;
      padding: 8px;
    }
  </style>
@endsection

@section('content')
  <h1>Olá {{$name}}</h1>
  <h3>Você acaba de receber acesso ao sistema da ProAgro, para que você possa acessar o nosso sistema primeiro você vai precisar de uma senha de acesso ao clicar no botão de cadastrar a senha você sera redirecionado a uma pagina para que sua senha seja cadastrada.</h3>
  <a href="#" class="button">Cadastrar senha</a>
@endsection
