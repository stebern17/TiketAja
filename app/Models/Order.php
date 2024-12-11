<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Menentukan primary key yang digunakan
    protected $primaryKey = 'id_order';

    // Kolom yang bisa diisi
    protected $fillable = [
        'id_user',           // Menyimpan ID user yang melakukan pemesanan
        'id_event',          // Menyimpan ID event yang dipesan
        'ticket_code',       // Kode tiket yang dipesan
        'payment_proof',     // Bukti pembayaran
        'status',            // Status pesanan
        'quantity',          // Jumlah tiket yang dipesan
        'total_price',       // Total harga tiket
        'transaction',       // ID transaksi
    ];

    // Relasi dengan Ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_code', 'id_ticket');
    }

    // Relasi dengan Event
    public function event()
    {
        return $this->belongsTo(Event::class, 'id_event', 'id_event');
    }

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
