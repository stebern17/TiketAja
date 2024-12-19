@extends('layouts.adminLayout')

@section('title', 'Ticket Validation')
@section('content')
<div class="container mt-5">
    <h2>Ticket Validation</h2>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <!-- Event Selection Dropdown -->
    <form id="validationForm" method="POST" action="{{ route('admin.ticketValidation.validate') }}">
        @csrf
        <div class="mb-3">
            <label for="eventSelection" class="form-label">Select Event</label>
            <select class="form-select" id="eventSelection" name="id_event" required>
                <option value="" disabled selected>Choose an event</option>
                @foreach($events as $event)
                <option value="{{ $event->id_event }}">{{ $event->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_ticket" class="form-label">Ticket ID</label>
            <input type="text" class="form-control" id="id_ticket" name="id_ticket" placeholder="Scan Ticket" readonly>
        </div>
        <div class="mb-3">
            <label for="id_order" class="form-label">Order ID</label>
            <input type="text" class="form-control" id="id_order" name="id_order" placeholder="Scan Order" readonly>
        </div> --}}

        <!-- Input for Order Detail ID (manual input when QR code cannot be scanned) -->
        <div class="mb-3">
            <label for="id_order_detail" class="form-label">Order Detail ID (manual input)</label>
            <input type="text" class="form-control" id="id_order_detail" name="id_order_detail"
                placeholder="Enter Order Detail ID" value="{{ old('id_order_detail') }}" required>

        </div>

        <!-- Scan Button (Now it's a submit button) -->
        <button type="submit" id="scanButton" class="btn btn-primary">Validate Ticket</button>
    </form>

</div>

<script>
    document.getElementById('id_order_detail').addEventListener('change', async function() {
        const idOrderDetail = this.value;

        // Reset previous values
        document.getElementById('id_ticket').value = '';
        document.getElementById('id_order').value = '';

        // Disable button during fetch
        const scanButton = document.getElementById('scanButton');
        scanButton.disabled = true;

        if (idOrderDetail) {
            try {
                // Call API to fetch data
                const response = await fetch('{{ route("admin.ticketValidation.fetchTicketData") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        id_order_detail: idOrderDetail
                    }),
                });

                const result = await response.json();

                if (result.success) {
                    // Populate fields with fetched data
                    document.getElementById('id_ticket').value = result.data.id_ticket;
                    document.getElementById('id_order').value = result.data.id_order;

                } else {
                    // Show alert for error messages
                    alert(result.message);
                }
            } catch (error) {
                // Show alert for fetch errors
                alert('Failed to fetch ticket data. Please try again.');
            }
        }

        // Re-enable the button after the fetch is completed
        scanButton.disabled = false;
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alertElements = document.querySelectorAll('.alert');
        alertElements.forEach(alert => {
            setTimeout(() => {
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 500);
            }, 5000); // Menghilang setelah 5 detik
        });
    });
</script>
@endsection