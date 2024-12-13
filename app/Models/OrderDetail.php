<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_detail';  // Menentukan nama tabel

    protected $primaryKey = 'id_order_detail';  // Menentukan primary key

    public $timestamps = true;  // Menggunakan timestamps otomatis

    // make fillabel
    protected $fillable = [
        'id_order',
        'id_ticket',
        'qr_code',
    ];

    // Relasi dengan tabel Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order', 'id_order');
    }

    // Relasi dengan tabel Ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'id_ticket', 'id_ticket');
    }

    // Relasi dengan tabel TicketValidation
    public function ticketValidation()
    {
        return $this->hasOne(TicketValidation::class, 'id_order_detail', 'id_order_detail');
    }
}
