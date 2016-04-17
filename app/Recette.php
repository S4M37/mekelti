<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
     protected $table = 'recette';

    protected $primaryKey = 'id_Recette';
	protected $fillable = [
        'label', 'description', 'type',
    ];
    public $timestamps=false;

}
