@extends('layouts.adminLayout')

@section('title', 'Ticket Validation')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 fw-bold" style="color: #4A5568;">Ticket Validation</h1>

    <!-- Alert Messages -->
    @if (session('status') === 'qr.success')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> QR Code berhasil diverifikasi!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session('status') === 'qr.error')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle-fill"></i> QR Code gagal diverifikasi!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Validation Form -->
    <form id="validationForm" method="POST" action="{{ route('admin.ticketValidation.validate') }}" style="background: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        @csrf

        <!-- QR Code Scanner -->
        <div class="container mt-4">
            <h2 class="text-xl font-semibold mb-4">Scan QR Code</h2>
            <div id="qr-reader" style="width: 500px; border: 1px solid #ddd; padding: 10px; border-radius: 8px;"></div>
            <div id="qr-reader-results" class="mt-3"></div>
            <div id="verification-status" class="mt-4"></div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const qrReader = new Html5Qrcode("qr-reader");

        // Fungsi untuk memulai scanner
        function startScanner() {
            Html5Qrcode.getCameras().then(devices => {
                if (devices && devices.length) {
                    const cameraId = devices[0].id; // Pilih kamera pertama
                    qrReader.start(
                        cameraId,
                        { fps: 10, qrbox: 300 },
                        onScanSuccess,
                        onScanFailure
                    ).catch(error => {
                        console.error("Error starting scanner:", error);
                        document.getElementById('qr-reader').innerHTML = `<p class="text-danger">Unable to access the camera. Please check your browser settings and permissions.</p>`;
                    });
                } else {
                    document.getElementById('qr-reader').innerHTML = `<p class="text-danger">No cameras available. Please check your device.</p>`;
                }
            }).catch(error => {
                console.error("Error getting cameras:", error);
                document.getElementById('qr-reader').innerHTML = `<p class="text-danger">Unable to access the camera. Please check your browser settings and permissions.</p>`;
            });
        }

        // Fungsi untuk menangani hasil scan QR code
        function onScanSuccess(decodedText, decodedResult) {
            const statusDiv = document.getElementById('verification-status');
            statusDiv.innerHTML = `<p class="text-info">Verifying QR Code... <span class="spinner-border spinner-border-sm"></span></p>`;

            // Kirim QR code ke server untuk verifikasi
            fetch('{{ route('admin.ticketValidation.validate') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ qr_code: decodedText })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Tampilkan notifikasi sukses
                    statusDiv.innerHTML = `<p class="text-success"><i class="bi bi-check-circle-fill"></i> QR Code berhasil diverifikasi!</p>`;
                    alert('QR Code berhasil diverifikasi!');
                } else {
                    // Tampilkan notifikasi gagal
                    statusDiv.innerHTML = `<p class="text-danger"><i class="bi bi-exclamation-circle-fill"></i> QR Code gagal diverifikasi: ${data.message}</p>`;
                    alert(`QR Code gagal diverifikasi: ${data.message}`);
                }
            })
            .catch(error => {
                console.error('Error verifying QR code:', error);
                statusDiv.innerHTML = `<p class="text-danger"><i class="bi bi-exclamation-circle-fill"></i> Terjadi kesalahan saat memverifikasi QR Code.</p>`;
                alert('Terjadi kesalahan saat memverifikasi QR Code.');
            });
        }

        // Fungsi untuk menangani kegagalan scan QR code
        function onScanFailure(error) {
            console.warn(`QR Code scan failed: ${error}`);
        }

        // Mulai scanner
        startScanner();
    });
</script>
@endsection
