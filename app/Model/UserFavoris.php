<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserFavoris extends Model
{
    protected $table = 'user_favoris';

    protected $primaryKey = 'id_Favoris';
    protected $fillable = [
        'id_User', 'id_Recette'
    ];
    public $timestamps = false;
}
