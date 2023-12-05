<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exposant extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',

    ];
    public function Events()
    {
        return $this->belongsToMany(Event::class);
    }
    
}
