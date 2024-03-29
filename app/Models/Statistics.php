<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Matches ;

class Statistics extends Model
{
    use HasFactory;
    protected $table = 'statistics';
    protected $fillable = [
        'uuid',
        'name',
        'vaalue',
        'matches_id',
    ] ;
     protected $casts = [
        'vaalue'=>'json'
     ] ;
     protected $hidden = [] ;

    public function match()
    {
        return $this->belongsTo(Matches::class) ;
    }
    public function information()
    {
      return $this->morphMany(Information::class,'information_able');
    }
}
