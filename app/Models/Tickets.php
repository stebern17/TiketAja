<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    // Primary key (opsional jika primary key menggunakan id)
    protected $primaryKey = 'id_ticket';

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'id_event',
        'type',
        'price',
        'quantity',
    ];

    /**
     * Relasi ke model Event (One-to-Many inverse / belongsTo)
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'id_event', 'id_event');
    }
}
