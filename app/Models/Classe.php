<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    //Indica o nome da tebela
    protected $table = 'classes';

    //indicar quais colunas podem ser cadastradas
    protected $fillable = ['name', 'description', 'course_id'];
}
