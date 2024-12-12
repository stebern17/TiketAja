@extends('layouts/userLayout')

@section('content')
    <form action="{{ route('order.confirm') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_ticket" value="{{ $checkoutData['id_ticket'] ?? '' }}">
        <input type="hidden" name="id_event" value="{{ $checkoutData['id_event'] }}">
        <input type="hidden" name="quantity" value="{{ $checkoutData['quantity'] ?? '' }}">
        <input type="hidden" name="total_price" value="{{ $checkoutData['total_price'] ?? '' }}">

        <h2 class="text-xl font-bold mb-4">Checkout</h2>
        <p>Tiket: {{ $checkoutData['ticket_type'] ?? 'N/A' }}</p>
        <p>Harga per Tiket: Rp {{ number_format($checkoutData['ticket_price'] ?? 0, 0, ',', '.') }}</p>
        <p>Jumlah: {{ $checkoutData['quantity'] ?? 0 }}</p>
        <p>Total Harga: Rp {{ number_format($checkoutData['total_price'] ?? 0, 0, ',', '.') }}</p>

        <label for="payment_proof" class="block mt-4 font-medium text-gray-700">Unggah Bukti Pembayaran</label>
        <input type="file" name="payment_proof" id="payment_proof" accept="image/*"
            class="block w-full mt-2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            required>

        <button type="submit" class="mt-4 w-full py-2 px-4 text-center text-white rounded-lg border border-primary-900 bg-blue-900 hover:bg-primary-950 duration-200">
            Konfirmasi Pembayaran
        </button>
    </form>
@endsection