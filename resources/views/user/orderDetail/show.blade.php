@extends('layouts.userLayout')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container mt-4">
    <h1 class="text-2xl font-semibold mb-4">Detail Pesanan Anda</h1>

    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ $order->event->name }}</h2>
            <p><strong>Tipe Tiket:</strong> {{ $orderDetail->ticket->type }}</p>
            <p><strong>Jumlah Tiket:</strong> {{ $orderDetail->order->quantity }}</p>
            <p><strong>QR Code:</strong> <img src="data:image/png;base64, {{ $orderDetail->qr_code }}" alt="QR Code" /></p>

            <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>

            <p><strong>Status Pesanan:</strong>
                @if ($order->status == 'approved')
                <span class="badge bg-info">Receipt Sent</span>
                @else
                <span class="badge bg-warning">Pending</span>
                @endif
            </p>

            <p><strong>Bukti Pembayaran:</strong></p>
            @if ($order->payment_proof)
            <img src="{{ asset('storage/' . $order->payment_proof) }}" class="img-fluid rounded mt-2" alt="Payment Proof">
            @else
            <p class="text-muted">Bukti pembayaran belum tersedia.</p>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('user.orders.index') }}" class="btn btn-secondary">Kembali ke Pesanan</a>
    </div>
</div>
@endsection