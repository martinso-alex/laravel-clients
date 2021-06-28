<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientesController extends Controller
{
  public function index(Request $request)
  {
    $query = Cliente::query();

    if ($request->nome) $query->orWhere('nome', $request->nome);
    if ($request->cpf) $query->orWhere('cpf', $request->cpf);
    if ($request->rg) $query->orWhere('rg', $request->rg);

    $clientes = $query->orderBy('nome')->get();

    $mensagem = $request->session()->get('mensagem');

    return view('clientes.index', compact('clientes', 'mensagem'));
  }

  public function show(Request $request)
  {
    $cliente = Cliente::find($request->id);
    $cliente->foto = Storage::url($cliente->foto);
    $cliente->fraudador = false;

    $primeiroDigitoCpf = intval($cliente->cpf[0]);
    $dtNascimento = DateTime::createFromFormat('d/m/Y', $cliente->dt_nascimento);

    if (is_int($primeiroDigitoCpf) && $dtNascimento) {
      $anoNascimento = intval($dtNascimento->format('Y'));
      switch ($primeiroDigitoCpf) {
        case $primeiroDigitoCpf >= 0 && $primeiroDigitoCpf <= 3 && $anoNascimento > 1950:
          $cliente->fraudador = true;
          break;
        case $primeiroDigitoCpf >= 4 && $primeiroDigitoCpf <= 6 && $anoNascimento > 2000:
          $cliente->fraudador = true;
          break;
        case $primeiroDigitoCpf >= 7 && $primeiroDigitoCpf <= 9 && $anoNascimento < 2001:
          $cliente->fraudador = true;
          break;
      }
    }

    return view('clientes.show', compact('cliente'));
  }

  public function create()
  {
    return view('clientes.create');
  }

  public function store(Request $request)
  {
    $foto = null;

    if ($request->hasFile('foto'))
      $foto = $request->file('foto')->store('clientes');

    $cliente = Cliente::create([
      'nome' => $request->nome,
      'rg' => $request->rg,
      'cpf' => $request->cpf,
      'dt_nascimento' => $request->dt_nascimento,
      'logradouro' => $request->logradouro,
      'bairro' => $request->bairro,
      'municipio' => $request->municipio,
      'uf' => $request->uf,
      'numero' => $request->numero,
      'foto' => $foto
    ]);

    $request->session()->flash(
      'mensagem',
      "Cliente com o id {$cliente->id} criado: {$cliente->nome}"
    );

    return redirect('/clientes');
  }
}
