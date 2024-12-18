@extends('layouts/userLayout')

@section('content')
<div class="container mt-4">
    <h1 class="text-2xl font-semibold mb-4">Tiketku</h1>

    @if($order->isEmpty())
    <p class="text-muted">Belum ada pesanan.</p>
    @else
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($order as $orderItem)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <!-- Card Image -->
                <div class="d-flex justify-content-center align-items-center" style="height: 200px; overflow: hidden;">
                    @if($orderItem->event->image)
                    <img src="{{ asset('storage/' . $orderItem->event->image) }}"
                        alt="Event Image"
                        class="img-fluid"
                        style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                    <span class="text-muted">Bukti Pembayaran Tidak Tersedia</span>
                    @endif
                </div>

                <!-- Card Body -->
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $orderItem->ticket->type }} Ticket</h5>
                    <p class="card-text mb-1"><strong>Event:</strong> {{ $orderItem->event->name ?? 'Tidak tersedia' }}</p>
                    <p class="card-text mb-1"><strong>Jumlah:</strong> {{ $orderItem->quantity }}</p>
                    <p class="card-text mb-1"><strong>Total Harga:</strong> Rp {{ number_format($orderItem->total_price, 0, ',', '.') }}</p>
                    <p class="card-text mb-1"><strong>Status:</strong>
                        @if ($orderItem->status == 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                        @elseif ($orderItem->status == 'approved')
                        <span class="badge bg-success">Approved</span>
                        @else
                        <span class="badge bg-danger">Rejected</span>
                        @endif
                    </p>

                    <!-- Buttons -->
                    <div class="mt-auto d-flex gap-2">
                        <a href="{{ route('order.ShowEventOrder', ['id_order' => $orderItem->id_order]) }}"
                            class="btn btn-primary btn-sm flex-fill">
                            Lihat Event
                        </a>

                        @foreach($orderItem->orderDetails as $orderDetail)
                        <a href="{{ route('user.orderDetail.show', $orderDetail->id_order_detail) }}"
                            class="btn btn-success btn-sm flex-fill">
                            Lihat Tiket
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @endif
</div>
@endsection