@extends('layouts.adminLayout')

@section('title', 'Tiketku Dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mx-auto mb-4">Selamat datang di Admin Dashboard!</h1>

    <!-- Statistik -->
    <div class="row text-center mb-4">
        <div class="col-md-4">
            <div class="card border-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text display-4">{{ $userCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-success">
                <div class="card-body">
                    <h5 class="card-title">Total Events</h5>
                    <p class="card-text display-4">{{ $eventCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-warning">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text display-4">{{ $orderCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Graph -->
    <h3>Sales Graph Bulanan</h3>
    <canvas id="salesGraph" width="400" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const salesData = @json($salesData); // Data yang diambil dari controller

    // Persiapkan data bulan dan total penjualan
    const labels = salesData.map(data => `${data.year}-${data.month < 10 ? '0' : ''}${data.month}`);
    const dataValues = salesData.map(data => data.total_sales);

    // Membuat grafik menggunakan Chart.js
    const ctx = document.getElementById('salesGraph').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line', // Jenis grafik (bisa juga 'bar' atau 'pie')
        data: {
            labels: labels, // Label sumbu x (Bulan-Tahun)
            datasets: [{
                label: 'Total Penjualan (Rp)',
                data: dataValues, // Data total penjualan
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true, // Isi area di bawah grafik
                tension: 0.4 // Mengatur kelengkungan garis
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Bulan-Tahun'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Total Penjualan (Rp)'
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString(); // Format angka dengan Rp
                        }
                    }
                }
            }
        }
    });
</script>
@endsection