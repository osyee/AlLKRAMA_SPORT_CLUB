<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Clubs ;
use App\Models\Sessions;

class Standings extends Model
{
    use HasFactory;
    protected $fillable = ['uuid',	'win',	'lose',	'draw',	'+/-',	'point',	'play',	'Clubs_id',	'sessions_id'];

    public function club()
    {
        return $this->belongsTo(Clubs::class,'Clubs_id') ;
    }

    public function session()
    {
        return $this->belongsTo(Sessions::class,'sessions_id') ;
    }


}
