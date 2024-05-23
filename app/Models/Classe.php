<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use \OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Classe extends Model implements Auditable
{
    use HasFactory, AuditingAuditable;

    //Indica o nome da tebela
    protected $table = 'classes';

    //indicar quais colunas podem ser cadastradas
    protected $fillable = ['name', 'description', 'order_classe', 'course_id'];

    //Criar o relacionamento entre um e muitos
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
