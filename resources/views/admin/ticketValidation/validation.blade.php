@extends('layouts.adminLayout')

@section('title', 'Ticket Validation')
@section('content')
<div class="container mt-5">
    <h2>Ticket Validation</h2>

    <!-- Event Selection Dropdown -->
    <div class="mb-3">
        <label for="eventSelection" class="form-label">Select Event</label>
        <select class="form-select" id="eventSelection" name="id_event">
            <option value="" disabled selected>Choose an event</option>
            @foreach($events as $event)
            <option value="{{ $event->id }}">{{ $event->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Displaying Video Feed from Camera -->
    <div class="mb-3">
        <video id="videoElement" autoplay></video>
    </div>

    <form id="validationForm" method="POST" action="{{ route('admin.ticketValidation.validate') }}">
        @csrf
        <div class="mb-3">
            <label for="id_ticket" class="form-label">Ticket ID</label>
            <input type="text" class="form-control" id="id_ticket" name="id_ticket" placeholder="Scan Ticket" readonly>
        </div>
        <div class="mb-3">
            <label for="id_order" class="form-label">Order ID</label>
            <input type="text" class="form-control" id="id_order" name="id_order" placeholder="Scan Order" readonly>
        </div>

        <button type="button" id="scanButton" class="btn btn-primary">Validate Ticket</button>
    </form>

    <div id="validationMessage" class="mt-3"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@zxing/library@0.18.6/umd/index.min.js"></script>
<script>
    // Access the camera
    let video = document.getElementById("videoElement");
    let selectedEventId = null;

    // Handle event selection
    document.getElementById("eventSelection").addEventListener("change", function() {
        selectedEventId = this.value;
    });

    // Request the user's camera
    navigator.mediaDevices.getUserMedia({
            video: true
        })
        .then((stream) => {
            video.srcObject = stream;
        })
        .catch((err) => {
            console.error("Error accessing the camera: ", err);
        });

    // Barcode scanner setup
    const codeReader = new ZXing.BrowserMultiFormatReader();
    codeReader.listVideoInputDevices()
        .then((videoInputDevices) => {
            const firstDeviceId = videoInputDevices[0].deviceId;
            codeReader.decodeFromVideoDevice(firstDeviceId, 'videoElement', (result, err) => {
                if (result) {
                    // Scan successful, set ticket and order ID
                    let scannedData = result.getText().split('|'); // Assuming barcode is a combination of ticket and order IDs
                    if (scannedData.length == 2) {
                        document.getElementById("id_ticket").value = scannedData[0];
                        document.getElementById("id_order").value = scannedData[1];
                    }
                }
            });
        })
        .catch((err) => {
            console.error("Error accessing video devices: ", err);
        });

    // Validate ticket on form submission
    document.getElementById("scanButton").addEventListener("click", function() {
        let ticketId = document.getElementById("id_ticket").value;
        let orderId = document.getElementById("id_order").value;

        if (!selectedEventId) {
            alert("Please select an event before validating tickets.");
            return;
        }

        if (!ticketId || !orderId) {
            alert("Please scan both ticket and order ID.");
            return;
        }

        // Send data to the server for validation
        fetch("{{ route('admin.ticketValidation.validate') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}" // CSRF token for security
                },
                body: JSON.stringify({
                    id_ticket: ticketId,
                    id_order: orderId,
                    id_event: selectedEventId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById("validationMessage").innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                } else {
                    document.getElementById("validationMessage").innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                }
            })
            .catch(error => {
                document.getElementById("validationMessage").innerHTML = `<div class="alert alert-danger">An error occurred. Please try again later.</div>`;
            });
    });
</script>
@endsection