@extends('layouts.userLayout')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container mt-4">
    <h1 class="text-2xl font-semibold mb-4">Detail Pesanan Anda</h1>

    <div class="card">
        <div class="card-body px-5">
            <img src="" alt="">
            <h2 class="card-title fs-1 fw-bold">{{ $order->event->name }}</h2>
            <div class="grid grid-cols-2">
                <div>
                    <p class="fs-4"><strong>Tipe Tiket:</strong> {{ $orderDetail->ticket->type }}</p>
                    <p class="fs-4"><strong>Jumlah Tiket:</strong> {{ $orderDetail->order->quantity }}</p>
                    <p class="fs-4"><strong>Total Harga:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                </div>

                <div class="ms-auto">
                    <p><strong>QR Code:</strong> <img src="{{ $qrCodePath }}" alt="QR Code" style="width: 200px; height: 200px;"></p>
                    <p class="text-center"><strong>Order id:</strong> {{ $orderDetail->id_order_detail }}</p>
                    <p><strong>Status Pesanan:</strong>
                        @if ($isTicketValid)
                        <span class="badge bg-success">Verified</span>
                        @elseif ($order->status == 'approved')
                        <span class="badge bg-info">Receipt Sent</span>
                        @else
                        <span class="badge bg-warning">Pending</span>
                        @endif
                    </p>

                </div>

            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('user.orders.index') }}" class="btn btn-secondary">Kembali ke Pesanan</a>
    </div>
</div>
@endsection