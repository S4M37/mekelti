<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    protected $table = 'recette';

    protected $primaryKey = 'id_Recette';
    protected $fillable = [
        'label', 'description', 'type', 'img', 'link'
    ];
    public $timestamps = false;

}
