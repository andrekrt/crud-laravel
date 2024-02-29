<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditingAuditable;

class Aula extends Model implements Auditable
{
    use HasFactory, AuditingAuditable;

    // indicar o nome da tabela
    protected $table = 'aulas';

    // indicar quais colunas podem ser cadastradas
    protected $fillable=['name','descricao', 'ordem', 'curso_id'];

    // criar relacionamento de um para muitos
    public function curso(){
        return $this->belongsTo(Curso::class);
    }
}
