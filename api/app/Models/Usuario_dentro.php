<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario_dentro extends Model
{
    protected $table= 'usuarios_dentro';
    protected $primarykey = 'id_usuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_usuario'
    ];
}
