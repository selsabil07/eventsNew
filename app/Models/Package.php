<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public function Admin()
    {
        return $this->belongsTo(Admin::class);
    }

    protected $fillable = [
        'title',
        'service',
        'price'

    ];
}
