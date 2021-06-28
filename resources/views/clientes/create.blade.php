@extends('layout')

@section('cabecalho')
<h1>Adicionar Cliente</h1>
@endsection

@section('conteudo')
<form method="post" enctype="multipart/form-data">
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

  <div class="row">
    <div class="col">
      <div class="form-group">
        <label for="dt_nascimento">Data de Nascimento</label>
        <input type="text" class="form-control" name="dt_nascimento">
      </div>
    </div>

    <div class="col">
      <div class="form-group">
        <label for="cep">CEP</label>
        <input type="text" class="form-control" name="cep" id="cep" onblur="pesquisacep(this.value);">
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="logradouro">Logradouro</label>
    <input type="text" class="form-control" name="logradouro" id="logradouro">
  </div>

  <div class="row">
    <div class="col">
      <div class="form-group">
        <label for="bairro">Bairro</label>
        <input type="text" class="form-control" name="bairro" id="bairro">
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label for="municipio">Município</label>
        <input type="text" class="form-control" name="municipio" id="municipio">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-group">
        <label for="uf">UF</label>
        <input type="text" class="form-control" name="uf" id="uf">
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label for="numero">Número</label>
        <input type="text" class="form-control" name="numero" id="numero">
      </div>
    </div>
  </div>

  <div class="form-group">
    <label foto="uf">Foto</label>
    <input type="file" class="form-control" name="foto">
  </div>

  <button class="btn btn-primary">Adicionar</button>
</form>
@endsection

<script>
  function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById('logradouro').value = ("");
    document.getElementById('bairro').value = ("");
    document.getElementById('municipio').value = ("");
    document.getElementById('uf').value = ("");
  }

  function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
      //Atualiza os campos com os valores.
      document.getElementById('logradouro').value = (conteudo.logradouro);
      document.getElementById('bairro').value = (conteudo.bairro);
      document.getElementById('municipio').value = (conteudo.localidade);
      document.getElementById('uf').value = (conteudo.uf);
    } //end if.
    else {
      //CEP não Encontrado.
      limpa_formulário_cep();
      alert("CEP não encontrado.");
    }
  }

  function pesquisacep(valor) {

    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

      //Expressão regular para validar o CEP.
      var validacep = /^[0-9]{8}$/;

      //Valida o formato do CEP.
      if (validacep.test(cep)) {

        //Preenche os campos com "..." enquanto consulta webservice.
        document.getElementById('logradouro').value = "...";
        document.getElementById('bairro').value = "...";
        document.getElementById('municipio').value = "...";
        document.getElementById('uf').value = "...";

        //Cria um elemento javascript.
        var script = document.createElement('script');

        //Sincroniza com o callback.
        script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

        //Insere script no documento e carrega o conteúdo.
        document.body.appendChild(script);

      } //end if.
      else {
        //cep é inválido.
        limpa_formulário_cep();
        alert("Formato de CEP inválido.");
      }
    } //end if.
    else {
      //cep sem valor, limpa formulário.
      limpa_formulário_cep();
    }
  };
</script>