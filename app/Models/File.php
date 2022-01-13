<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'file_path',
        'local',
        'user_id',
        'versao_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id')->withTrashed();
    }

    public function version()
    {
        return $this->belongsTo(Versao::class,'versao_id', 'id');
        
    }

}
