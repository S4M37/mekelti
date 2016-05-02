<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProposedRecette extends Model
{
    protected $table = 'proposed_recette';

    protected $primaryKey = 'id_Proposed';
    protected $fillable = [
        'id_User', 'valid'
    ];
    public $timestamps = false;
}
