@extends ('layouts.adminLayout')

@section ('title', 'Orders Management')

@section ('content')
<div class="container my-5">
    <h1 class="text-center fw-bold mb-4" style="color: #4A5568;">Orders Management</h1>

    <!-- Search and Export -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Search Form -->
        <form action="{{ route('admin.orders.index') }}" method="GET" class="d-flex flex-grow-1 me-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search orders" name="search" value="{{ request('search') }}">
                <button class="btn btn-secondary ms-2" type="submit">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
        </form>

        <!-- Export Button -->
        <a href="{{ route('admin.orders.export') }}" class="btn btn-success ms-3">
            <i class="bi bi-download"></i> Export Orders
        </a>
    </div>


    <!-- Alerts -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Orders Table -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table text-center">
                <tr>
                    <th>#</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Event</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Payment</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $order->user->name_user }}</td>
                    <td>{{ $order->user->email_user }}</td>
                    <td>{{ $order->event->name }}</td>
                    <td class="text-center">{{ $order->quantity }}</td>
                    <td class="text-end">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('admin.orders.updateStatus', $order->id_order) }}" method="POST">
                            @csrf
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $order->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </form>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.orders.showPaymentProof', $order->id_order) }}" target="_blank" class="btn btn-primary btn-sm">
                            <i class="bi bi-eye"></i> View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
</div>


@endsection
