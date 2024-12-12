@extends('layouts/userLayout')

@section('content')
<div class="container mt-4">
    <h1 class="text-2xl font-semibold mb-4">Tiketku</h1>

    @if($order->isEmpty())
        <p class="text-muted">Belum ada pesanan.</p>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($order as $order)
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="card-title">{{ $order->ticket->type }} Ticket</h2>
                            <p class="card-text"><strong>Event:</strong> {{ $order->event->name ?? 'Tidak tersedia' }}</p>
                            <p class="card-text"><strong>Jumlah:</strong> {{ $order->quantity }}</p>
                            <p class="card-text"><strong>Total Harga:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            <p class="card-text"><strong>Status:</strong>
                                @if ($order->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif ($order->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </p>
                            <p class="mt-2"><strong>Bukti Pembayaran:</strong></p>
                            @if($order->payment_proof)
                                <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran" class="img-fluid rounded mt-2">
                            @else
                                <span class="text-muted">Tidak tersedia</span>
                            @endif

                            <!-- Button for event details and ticket details -->
                            <div class="mt-3 d-flex gap-2">

                                <a href="#" class="btn btn-primary btn-sm w-100">
                                    Lihat Event
                                </a>

                                <a href="# " class="btn btn-secondary btn-sm w-100">
                                    Lihat Tiket
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
