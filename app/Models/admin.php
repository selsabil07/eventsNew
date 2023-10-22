<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class admin extends Model
{
    use HasFactory,HasApiTokens;
    
    public function EventManagers()
{
    return $this->hasMany(EventManager::class);
}


    protected $fillable = [
        'AdminName' ,
        'password' ,
    ];
}
