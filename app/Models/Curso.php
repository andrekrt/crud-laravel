<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;



class Curso extends Model implements Auditable
{
    use HasFactory, AuditingAuditable, HasFactory;

    // indicar nome da tabela
    protected $table = "cursos";

    // indicar quais colunas podem ser cadastradas
    protected $fillable = ['name', 'price'];

    // criar relacionamento de um para muitos
    public function aula(){
        return $this->hasMany(Aula::class);
    }
}
