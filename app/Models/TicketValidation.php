<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketValidation extends Model
{
    use HasFactory;

    protected $table = 'ticket_validation';

    protected $fillable = [
        'id_order',
        'id_ticket',
        'validation_date',
    ];

    protected $casts = [
        'validation_date' => 'datetime', // Cast the validation_date as a datetime
    ];

    // Relationship with the Order model
    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order', 'id_order');
    }

    // Relationship with the Ticket model
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'id_ticket', 'id_ticket');
    }

    // Relationship with the OrderDetail model one-to-one
    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class, 'id_order_detail', 'id_order_detail');
    }
}
