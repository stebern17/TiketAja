@extends('layouts.adminLayout')

@section('title', 'Ticket Validation')
@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 fw-bold" style="color: #4A5568;">Ticket Validation</h1>

    <!-- Alert Messages -->
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

    <!-- Validation Form -->
    <form id="validationForm" method="POST" action="{{ route('admin.ticketValidation.validate') }}" style="background: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        @csrf
        <!-- Event Selection -->
        <div class="mb-4">
            <label for="eventSelection" class="form-label" style="font-weight: bold; color: #333;">Select Event</label>
            <select class="form-select" id="eventSelection" name="id_event" required>
                <option value="" disabled selected style="color: #999;">Choose an event</option>
                @foreach($events as $event)
                <option value="{{ $event->id_event }}" style="color: #333;">{{ $event->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Ticket ID -->
        <div class="mb-4">
            <label for="id_ticket" class="form-label" style="font-weight: bold; color: #333;">Ticket ID</label>
            <input type="text" class="form-control" id="id_ticket" name="id_ticket" placeholder="Scan Ticket" readonly style="background: #e9ecef;">
        </div>

        <!-- Order ID -->
        <div class="mb-4">
            <label for="id_order" class="form-label" style="font-weight: bold; color: #333;">Order ID</label>
            <input type="text" class="form-control" id="id_order" name="id_order" placeholder="Scan Order" readonly style="background: #e9ecef;">
        </div>

        <!-- Order Detail ID -->
        <div class="mb-4">
            <label for="id_order_detail" class="form-label" style="font-weight: bold; color: #333;">Order Detail ID (manual input)</label>
            <input type="text" class="form-control" id="id_order_detail" name="id_order_detail" placeholder="Enter Order Detail ID" value="{{ old('id_order_detail') }}" required>
        </div>

        <!-- Validate Button -->
        <button type="submit" id="scanButton" class="btn btn-primary w-100" style="background-color: #5F9EA0; border: none; font-weight: bold;">Validate Ticket</button>
    </form>
</div>

<!-- JavaScript -->
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
                    alert(result.message);
                }
            } catch (error) {
                alert('Failed to fetch ticket data. Please try again.');
            }
        }

        scanButton.disabled = false;
    });

    document.addEventListener('DOMContentLoaded', function() {
        const alertElements = document.querySelectorAll('.alert');
        alertElements.forEach(alert => {
            setTimeout(() => {
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });
    });
</script>
@endsection