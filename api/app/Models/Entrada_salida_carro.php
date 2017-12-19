<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada_salida_carro extends Model
{
    protected $table= 'entrada_salida_carros';
    protected $primarykey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'placa','estado'
    ];
}
