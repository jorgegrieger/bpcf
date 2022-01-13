<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Versao extends Model
{
    protected $fillable = ['id', 'nome'];
    public $timestamps = false;

    
    public function version()
    {
        return $this->belongsToMany(Versao::class,'versao_id', 'id');
        
    }
}
