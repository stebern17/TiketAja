@extends('layouts.adminLayout')

@section('title', 'Ticket Validation')
@section('content')
<div class="container mt-5">
    <h2>Ticket Validation</h2>

    <!-- Event Selection Dropdown -->
    <form id="validationForm" method="POST" action="{{ route('admin.ticketValidation.validate') }}">
        @csrf
        <div class="mb-3">
            <label for="eventSelection" class="form-label">Select Event</label>
            <select class="form-select" id="eventSelection" name="id_event">
                <option value="" disabled selected>Choose an event</option>
                @foreach($events as $event)
                <option value="{{ $event->id_event }}">{{ $event->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Displaying Video Feed from Camera -->
        <!-- <div class="mb-3">
            <video id="videoElement" autoplay></video>
        </div> -->

        <div class="mb-3">
            <label for="id_ticket" class="form-label">Ticket ID</label>
            <input type="text" class="form-control" id="id_ticket" name="id_ticket" placeholder="Scan Ticket" readonly>
        </div>
        <div class="mb-3">
            <label for="id_order" class="form-label">Order ID</label>
            <input type="text" class="form-control" id="id_order" name="id_order" placeholder="Scan Order" readonly>
        </div>

        <!-- Input for Order Detail ID (manual input when QR code cannot be scanned) -->
        <div class="mb-3">
            <label for="id_order_detail" class="form-label">Order Detail ID (manual input)</label>
            <input type="text" class="form-control" id="id_order_detail" name="id_order_detail" placeholder="Enter Order Detail ID">
        </div>

        <button type="button" id="scanButton" class="btn btn-primary">Validate Ticket</button>
    </form>

    <!-- Message Box for Validation Feedback -->
    <div id="validationMessage" class="mt-3"></div>
</div>

<script>
    document.getElementById('id_order_detail').addEventListener('change', async function() {
        const idOrderDetail = this.value;

        // Reset previous values
        document.getElementById('id_ticket').value = '';
        document.getElementById('id_order').value = '';

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
                console.error('Error fetching ticket data:', error);
                alert('Failed to fetch ticket data. Please try again.');
            }
        }
    });
</script>


<!-- <script src="https://cdn.jsdelivr.net/npm/@zxing/library@0.18.6/umd/index.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const video = document.getElementById("videoElement");
        const validationMessage = document.getElementById("validationMessage");
        const eventSelection = document.getElementById("eventSelection");
        const orderDetailInput = document.getElementById("id_order_detail"); // Manual input for order detail
        let scannedQRCodes = new Set();

        // Access the camera
        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                console.error("Error accessing the camera: ", err);
                validationMessage.innerHTML = `<div class="alert alert-danger">Cannot access camera. Please check permissions.</div>`;
            });

        // Initialize the barcode scanner
        const codeReader = new ZXing.BrowserMultiFormatReader();
        codeReader.listVideoInputDevices()
            .then(videoInputDevices => {
                if (videoInputDevices.length === 0) {
                    throw new Error("No video input devices found.");
                }

                const firstDeviceId = videoInputDevices[0].deviceId;

                codeReader.decodeFromVideoDevice(firstDeviceId, 'videoElement', (result, err) => {
                    if (result) {
                        const scannedData = result.getText();

                        // Prevent processing the same QR code multiple times
                        if (!scannedQRCodes.has(scannedData)) {
                            scannedQRCodes.add(scannedData);

                            const [ticketId, orderId] = scannedData.split('|');

                            if (ticketId && orderId) {
                                sendValidationRequest(ticketId, orderId);
                            } else {
                                showMessage("Invalid QR Code format.", "danger");
                            }
                        }
                    }

                    if (err && !(err instanceof ZXing.NotFoundException)) {
                        console.error(err);
                        showMessage("Error scanning QR code.", "danger");
                    }
                });
            })
            .catch(err => {
                console.error("Error accessing video devices: ", err);
                validationMessage.innerHTML = `<div class="alert alert-danger">Error accessing video devices.</div>`;
            });

        // Function to send validation request to the server
        function sendValidationRequest(ticketId, orderId) {
            const selectedEvent = eventSelection.value;
            const orderDetailId = orderDetailInput.value; // Using manual input if QR code isn't scanned

            if (!selectedEvent) {
                showMessage("Please select an event before scanning QR codes.", "warning");
                return;
            }

            // Disable the scan button to prevent multiple clicks
            document.getElementById("scanButton").disabled = true;

            const requestBody = {
                id_event: selectedEvent,
                id_ticket: ticketId,
                id_order: orderId,
            };

            // If manual input is provided for order detail, add it to the request
            if (orderDetailId) {
                requestBody.id_order_detail = orderDetailId;
            }

            // Send the request
            fetch("{{ route('admin.ticketValidation.validate') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(requestBody)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showMessage(data.message, "success");
                    } else {
                        showMessage(data.message, "danger");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    showMessage("An error occurred while validating the ticket.", "danger");
                })
                .finally(() => {
                    // Re-enable the scan button after processing
                    document.getElementById("scanButton").disabled = false;
                });
        }

        // Function to display messages
        function showMessage(message, type) {
            validationMessage.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
            // Optionally, remove the message after a few seconds
            setTimeout(() => {
                validationMessage.innerHTML = "";
            }, 5000);
        }

        // Handle the click event of the 'Validate Ticket' button
        document.getElementById("scanButton").addEventListener("click", () => {
            // Check if either QR code was scanned or id_order_detail is filled manually
            const orderDetailId = orderDetailInput.value;

            if (orderDetailId) {
                // If orderDetailId is filled manually, validate ticket directly
                sendValidationRequest(null, null); // No need for ticketId and orderId if we're validating via order detail
            } else {
                // If no order detail entered, try scanning the QR code
                scannedQRCodes.clear();
                showMessage("You can now scan a new QR code or manually enter Order Detail ID.", "info");
            }
        });
    });
</script> -->
@endsection