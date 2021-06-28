<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  public $timestamps = false;
  protected $fillable = ['nome', 'rg', 'cpf', 'dt_nascimento', 'logradouro', 'bairro', 'municipio', 'uf', 'numero', 'foto'];
}
