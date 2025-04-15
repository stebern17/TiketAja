@extends('layouts.userLayout')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container mt-4">
    <h1 class="text-2xl font-semibold mb-4">Detail Pesanan Anda</h1>

    <div class="card">
        <div class="card-body px-5">
            <!-- Gambar Event -->
            @if ($order->event->image ?? false)
                <img src="{{ asset('storage/' . $order->event->image) }}" alt="Gambar Event" class="img-fluid mb-4">
            @else
                <img src="{{ asset('assets/img/placeholder.png') }}" alt="Gambar Tidak Tersedia" class="img-fluid mb-4">
            @endif

            <h2 class="card-title fs-1 fw-bold">{{ $order->event->name ?? 'Nama Event Tidak Tersedia' }}</h2>
            <div class="grid grid-cols-2">
                <div>
                    <p class="fs-4"><strong>Tipe Tiket:</strong> {{ $orderDetail->ticket->type ?? 'Tidak Tersedia' }}</p>
                    <p class="fs-4"><strong>Jumlah Tiket:</strong> {{ $orderDetail->order->quantity ?? '0' }}</p>
                    <p class="fs-4"><strong>Total Harga:</strong> Rp {{ number_format($order->total_price ?? 0, 0, ',', '.') }}</p>
                </div>

                <div class="ms-auto">
                    <p><strong>QR Code:</strong></p>
                    @if ($qrCodePath ?? false)
                        <img src="{{ $qrCodePath }}" alt="QR Code" style="width: 200px; height: 200px;">
                    @else
                        <p class="text-muted">QR Code Tidak Tersedia</p>
                    @endif

                    <p class="text-center"><strong>Order ID:</strong> {{ $orderDetail->id_order_detail ?? 'Tidak Tersedia' }}</p>
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
