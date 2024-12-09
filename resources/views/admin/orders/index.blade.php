@extends ('layouts.adminLayout')

@section ('title', 'Orders Management')

@section ('content')
<div class="container">
    <h1>Manage Orders</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-striped mt-3 shadow rounded">
        <thead>
            <tr>
                <th>No</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Event</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Payment Proof</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->user->name_user }}</td>
                <td>{{ $order->user->email_user }}</td>
                <td>{{ $order->event->name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>Rp. {{ $order->total_price }}</td>
                <td>
                    <form action="{{ route('admin.orders.updateStatus', $order->id_order) }}" method="POST">
                        @csrf
                        <select name="status" class="form-control" onchange="this.form.submit()">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $order->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </form>
                </td>
                <td>
                    <a href="{{ route('admin.orders.showPaymentProof', $order->id_order) }}" target="_blank">
                        <button type="button" class="btn btn-primary">
                            Payment Proof
                        </button>
                    </a>
                </td>
                <td>
                    <button class="btn btn-warning">
                        Send Reciept
                    </button>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection