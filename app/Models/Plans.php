<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Players ;
use App\Models\Matches ;

class Plans extends Model
{
    use HasFactory;
    protected $table = 'plans';

protected $fillable = [
    'uuid',
    'Players_id',
    'Matches_id',
    'status',
    
] ;
 
 

    public function player()
    {
        return $this->belongsTo(Players::class,'Players_id') ;
    }

    public function match()
    {
        return $this->belongsTo(Matches::class) ;
    }

}
