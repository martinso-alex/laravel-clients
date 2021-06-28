@extends('layout')

@section('cabecalho')
<h1>Dados do Cliente</h1>
@endsection

@section('conteudo')
<div class="container">
  <div class="row">
    <div class="col">
      <img src="{{ $cliente->foto }}" class="img-thumbnail" height="400px" width="400px">
    </div>

    <div class="col mt-4">
      <p><b>Nome:</b> {{ $cliente->nome }} </p>
      <p><b>RG:</b> {{ $cliente->rg }}</p>
      <p><b>CPF:</b> {{ $cliente->cpf }}</p>
      <p><b>Data de Nascimento:</b> {{ $cliente->dt_nascimento }}</p>
      <p><b>Logradouro:</b> {{ $cliente->logradouro }}</p>
      <p><b>Numero:</b> {{ $cliente->numero }}</p>
      <p><b>Bairro:</b> {{ $cliente->bairro }}</p>
      <p><b>Município:</b> {{ $cliente->municipio }}</p>
      <p><b>UF:</b> {{ $cliente->uf }}</p>
      <p style="color: red"><b>{{ $cliente->fraudador? "(Possível cliente fraudador)" : "" }}</b></p>
    </div>
  </div>
</div>
@endsection