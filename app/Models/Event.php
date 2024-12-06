<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_event'; // Menggunakan id_event sebagai primary key
    protected $fillable = [
        'name',
        'date',
        'image',
        'location',
        'description',
        'capacity',
        'status',
    ];
    public function tickets()
    {
        return $this->hasMany(Tickets::class, 'id_event', 'id_event');
    }
}
