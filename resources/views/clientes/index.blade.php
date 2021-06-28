@extends('layout')

@section('cabecalho')
<h1>Clientes</h1>
@endsection

@section('conteudo')

@if(!empty($mensagem))
<div class="alert alert-success">
  {{ $mensagem }}
</div>
@endif

<div class="mb-2">
  <form method="post" id="my_form">
    @csrf
    <div class="form-group">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" name="nome">
    </div>

    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="rg">RG</label>
          <input type="text" class="form-control" name="rg">
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="cpf">CPF</label>
          <input type="text" class="form-control" name="cpf">
        </div>
      </div>
    </div>
  </form>
</div>

<a href="/clientes/adicionar" class="btn btn-primary mb-4">Adicionar</a>
<a href="javascript:{document.getElementById('my_form').submit()}" class="btn btn-success mb-4">Pesquisar</a>

<ul class="list-group">
  @foreach($clientes as $cliente)
  <li class="list-group-item d-flex justify-content-between align-items-center">
    {{ $cliente->nome }}

    <span class="d-flex">
      <a href="/clientes/{{ $cliente->id }}" class="btn btn-info btn-sm">
        <i class="fas fa-external-link-alt"></i>
      </a>
    </span>
  </li>
  @endforeach
</ul>
@endsection