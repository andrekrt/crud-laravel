<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // indiciar nome da tabela
    protected $table = 'roles';

    // indicar colunas que pode ser cadastradas
    protected $fillable = ['id', 'name', 'guard_name'];
}
