<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public function EventManager()
    {
        return $this->hasMany(EventManager::class);
    }

    protected $fillable = [
        'title',
        'service',
        'price'

    ];
}
