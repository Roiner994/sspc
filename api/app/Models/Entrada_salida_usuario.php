<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada_salida_usuario extends Model
{
    protected $table= 'entrada_salida_usuarios';
    protected $primarykey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_usuario','estado'
    ];
}
