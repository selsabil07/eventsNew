<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function EventManager()
    {
        return $this->belongsTo(EventManager::class);
    }

    public function Exposants()
    {
        return $this->belongsToMany(Exposant::class);
    }
    

    protected $fillable = [
        'EventManager_id',
        'eventTitle' ,
        'country',
        'sector',
        'photo',
        'tags',
        'summary',
        'description',
        'approved',
        'startingDate',
        'endingDate',
    ];
}
