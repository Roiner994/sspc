<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carro_dentro extends Model
{
    protected $table= 'carros_dentro';
    protected $primarykey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','placa'
    ];
}
