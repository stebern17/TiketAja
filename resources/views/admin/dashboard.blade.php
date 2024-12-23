@extends('layouts.adminLayout')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="fw-bold text-center" style="color: #4A5568;">Sales Graph Bulanan</h1>

    <!-- Dropdown untuk memilih tahun dan bulan -->
    <div class=" mb-3 bg-white shadow p-4 rounded">
        <form method="GET" action="{{ route('admin.dashboard') }}">
            <div class="d-flex justify-content-center mb-4">
                <div style="flex: 1; max-width: 300px; margin: 0 10px;">
                    <div style="background-color: #4CAF50; border-radius: 8px; color: white; padding: 20px; text-align: center;">
                        <h5 style="font-size: 1.25rem; margin-bottom: 1rem; font-weight: bold;">Total Users</h5>
                        <p style="font-size: 2.5rem; font-weight: bold;">{{ $userCount }}</p>
                    </div>
                </div>
                <div style="flex: 1; max-width: 300px; margin: 0 10px;">
                    <div style="background-color: #FF9800; border-radius: 8px; color: white; padding: 20px; text-align: center;">
                        <h5 style="font-size: 1.25rem; margin-bottom: 1rem; font-weight: bold;">Total Events</h5>
                        <p style="font-size: 2.5rem; font-weight: bold;">{{ $eventCount }}</p>
                    </div>
                </div>
                <div style="flex: 1; max-width: 300px; margin: 0 10px;">
                    <div style="background-color: #2196F3; border-radius: 8px; color: white; padding: 20px; text-align: center;">
                        <h5 style="font-size: 1.25rem; margin-bottom: 1rem; font-weight: bold;">Total Orders</h5>
                        <p style="font-size: 2.5rem; font-weight: bold;">{{ $orderCount }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Pilihan Tahun -->
                <div class="col-md-3">
                    <label for="yearFilter" style="display: block; font-weight: bold; margin-bottom: 5px; color: #333;">Pilih Tahun:</label>
                    <select id="yearFilter" name="year" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
                        <option value="" style="color: #999;">Pilih Tahun</option>
                        @foreach($years as $year)
                        <option value="{{ $year->year }}" style="color: #333;" {{ request()->get('year') == $year->year ? 'selected' : '' }}>
                            {{ $year->year }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Pilihan Bulan -->
                <div class="col-md-3">
                    <label for="monthFilter" style="display: block; font-weight: bold; margin-bottom: 5px; color: #333;">Pilih Bulan:</label>
                    <select id="monthFilter" name="month" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
                        <option value="" style="color: #999;">Pilih Bulan</option>
                        @foreach($months as $month)
                        <option value="{{ $month }}" style="color: #333;" {{ request()->get('month') == $month ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px; font-weight: bold; background-color: #333; border: none;">Tampilkan</button>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <a href="{{ route('admin.exportSalesReport') }}" target="_blank" class="btn btn-danger" style="width: 100%; padding: 10px; font-weight: bold; background-color: #d9534f; border: none;">
                        Export PDF
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Grafik Penjualan Harian -->
    <div class="mt-4 bg-white shadow p-4 rounded">
        <h4 style="color: #333; font-weight: bold; margin-bottom: 1rem;">Grafik Penjualan Harian</h4>
        <canvas class="chart-container" style="position: relative; height:40vh; width:80vw" id="dailySalesGraph"></canvas>
    </div>

    <!-- Grafik Popularitas Event -->
    <div class="mt-4 bg-white shadow p-4 rounded">
        <h4 style="color: #333; font-weight: bold; margin-bottom: 1rem;">Grafik Popularitas Event</h4>
        <canvas class="chart-container" style="position: relative; height:40vh; width:80vw" id="eventPopularityGraph"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data Grafik Penjualan Harian
        const salesData = @json($salesData);
        const dailyLabels = salesData.map(data => new Date(data.date).toLocaleDateString());
        const dailyValues = salesData.map(data => data.total_sales);

        const dailyCtx = document.getElementById('dailySalesGraph').getContext('2d');
        new Chart(dailyCtx, {
            type: 'line',
            data: {
                labels: dailyLabels,
                datasets: [{
                    label: 'Total Penjualan Harian (Rp)',
                    data: dailyValues,
                    borderColor: '#4CAF50',
                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#333'
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal',
                            color: '#333'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total Penjualan (Rp)',
                            color: '#333'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }
                }
            }
        });

        // Data Grafik Popularitas Event
        const eventPopularityData = @json($eventPopularity);
        const eventLabels = eventPopularityData.map(item => item.event_name);
        const eventCounts = eventPopularityData.map(item => item.event_count);

        const eventCtx = document.getElementById('eventPopularityGraph').getContext('2d');
        new Chart(eventCtx, {
            type: 'bar',
            data: {
                labels: eventLabels,
                datasets: [{
                    label: 'Popularitas Event (Jumlah Pembelian)',
                    data: eventCounts,
                    backgroundColor: 'rgba(33, 150, 243, 0.2)',
                    borderColor: '#2196F3',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#333'
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Nama Event',
                            color: '#333'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Pembelian',
                            color: '#333'
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
</div>
@endsection