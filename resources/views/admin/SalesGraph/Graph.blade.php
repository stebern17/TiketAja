@extends('layouts.adminLayout')

@section('content')
<div class="container mt-5">
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
