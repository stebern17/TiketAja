@extends('layouts.adminLayout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Buat Tiket Baru</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('tickets.store') }}" method="POST">
                        @csrf
                        {{-- @dd($event->id_event ); --}}
                        <!-- Pilihan Event -->
                        <input type="hidden" name="id_event" value="{{ $event->id_event }}">



                        <!-- Jenis Tiket -->
                        <div class="mb-3">
                            <label class="form-label">Pilih Jenis Tiket</label><br>

                            <!-- Checkbox untuk tiket -->
                            <div class="form-check">
                                <input type="checkbox" name="types[]" value="Regular" id="type_regular" class="form-check-input">
                                <label for="type_regular" class="form-check-label">Regular</label>
                                <input type="number" name="prices[Regular]" id="price_regular" class="form-control ticket-price" style="display:none;" min="0" placeholder="Masukkan harga" disabled>
                                <input type="number" name="quantity[Regular]" id="quantity_regular" class="form-control ticket-quantity" style="display:none;" min="1" placeholder="Masukkan kuantitas" disabled>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" name="types[]" value="VIP" id="type_vip" class="form-check-input">
                                <label for="type_vip" class="form-check-label">VIP</label>
                                <input type="number" name="prices[VIP]" id="price_vip" class="form-control ticket-price" style="display:none;" min="0" placeholder="Masukkan harga" disabled>
                                <input type="number" name="quantity[VIP]" id="quantity_vip" class="form-control ticket-quantity" style="display:none;" min="1" placeholder="Masukkan kuantitas" disabled>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" name="types[]" value="VVIP" id="type_vvip" class="form-check-input">
                                <label for="type_vvip" class="form-check-label">VVIP</label>
                                <input type="number" name="prices[VVIP]" id="price_vvip" class="form-control ticket-price" style="display:none;" min="0" placeholder="Masukkan harga" disabled>
                                <input type="number" name="quantity[VVIP]" id="quantity_vvip" class="form-control ticket-quantity" style="display:none;" min="1" placeholder="Masukkan kuantitas" disabled>
                            </div>
                        </div>

                        <!-- QR Code -->
                        <div class="mb-3">
                            <label for="qr_code" class="form-label">QR Code</label>
                            <input type="text" name="qr_code" id="qr_code" class="form-control" maxlength="255" required>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Buat Tiket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ambil elemen checkbox dan input harga & kuantitas
            const checkboxes = document.querySelectorAll('.form-check-input');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const ticketType = this.value; // Regular, VIP, VVIP
                    const priceInput = document.getElementById(`price_${ticketType.toLowerCase()}`);
                    const quantityInput = document.getElementById(`quantity_${ticketType.toLowerCase()}`);

                    if (this.checked) {
                        // Tampilkan input harga dan kuantitas jika checkbox dicentang
                        priceInput.style.display = 'block';
                        quantityInput.style.display = 'block';
                        priceInput.disabled = false; // Aktifkan input harga
                        quantityInput.disabled = false; // Aktifkan input kuantitas
                    } else {
                        // Sembunyikan input harga dan kuantitas jika checkbox tidak dicentang
                        priceInput.style.display = 'none';
                        quantityInput.style.display = 'none';
                        priceInput.disabled = true; // Nonaktifkan input harga
                        quantityInput.disabled = true; // Nonaktifkan input kuantitas
                        priceInput.value = ''; // Kosongkan nilai input harga
                        quantityInput.value = ''; // Kosongkan nilai input kuantitas
                    }
                });
            });
        });
    </script>
</div>
@endsection
