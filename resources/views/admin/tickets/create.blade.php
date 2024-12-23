@extends('layouts.adminLayout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Tiket Baru</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
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
                                <div class="row gap-1">
                                    <input type="number" name="prices[Regular]" id="price_regular" class="form-control ticket-price col" style="display:none;" min="0" placeholder="Masukkan harga" disabled>
                                    <input type="number" name="quantity[Regular]" id="quantity_regular" class="form-control ticket-quantity col" style="display:none;" min="1" placeholder="Masukkan kuantitas" disabled>

                                </div>

                            </div>

                            <div class="form-check">
                                <input type="checkbox" name="types[]" value="VIP" id="type_vip" class="form-check-input">
                                <label for="type_vip" class="form-check-label">VIP</label>
                                <div class="row gap-1">
                                    <input type="number" name="prices[VIP]" id="price_vip" class="form-control ticket-price col" style="display:none;" min="0" placeholder="Masukkan harga" disabled>
                                    <input type="number" name="quantity[VIP]" id="quantity_vip" class="form-control ticket-quantity col" style="display:none;" min="1" placeholder="Masukkan kuantitas" disabled>
                                </div>

                            </div>

                            <div class="form-check">
                                <input type="checkbox" name="types[]" value="VVIP" id="type_vvip" class="form-check-input">
                                <label for="type_vvip" class="form-check-label">VVIP</label>
                                <div class="row gap-1">
                                    <input type="number" name="prices[VVIP]" id="price_vvip" class="form-control ticket-price col" style="display:none;" min="0" placeholder="Masukkan harga" disabled>
                                    <input type="number" name="quantity[VVIP]" id="quantity_vvip" class="form-control ticket-quantity col" style="display:none;" min="1" placeholder="Masukkan kuantitas" disabled>
                                </div>
                            </div>
                        </div>


                        <!-- Tombol Submit -->
                        <div class="d-grid gap">
                            <button type="submit" class="btn btn-ticket">Buat Tiket</button>
                        </div>

                    </form>
                    <div class="d-grid mt-3">
                        <a href="{{ route('events.index') }}" class="btn btn-back">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.form-check-input');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const ticketType = this.value.toLowerCase();
                    const priceInput = document.getElementById(`price_${ticketType}`);
                    const quantityInput = document.getElementById(`quantity_${ticketType}`);

                    priceInput.style.display = this.checked ? 'block' : 'none';
                    priceInput.disabled = !this.checked;
                    quantityInput.style.display = this.checked ? 'block' : 'none';
                    quantityInput.disabled = !this.checked;

                    if (!this.checked) {
                        priceInput.value = '';
                        quantityInput.value = '';
                    }
                });
            });
        });
    </script>
</div>
@endsection
