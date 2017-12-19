<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    protected $table= 'carros';
    protected $primarykey = ['usuario_id','placa'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id','placa','marca','modelo'
    ];
}
