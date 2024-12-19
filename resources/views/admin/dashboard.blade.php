@extends('layouts.adminLayout')

@section('content')
<div class="container mt-5">
    <h3>Sales Graph Bulanan</h3>

    <!-- Dropdown untuk memilih tahun dan bulan -->
    <div class="mb-3">
        <form method="GET" action="{{ route('admin.dashboard') }}">
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
            <div class="row">
                <!-- Pilihan Tahun -->
                <div class="col-md-3">
                    <label for="yearFilter" class="form-label">Pilih Tahun:</label>
                    <select id="yearFilter" name="year" class="form-control">
                        <option value="">Pilih Tahun</option>
                        @foreach($years as $year)
                        <option value="{{ $year->year }}" {{ request()->get('year') == $year->year ? 'selected' : '' }}>
                            {{ $year->year }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Pilihan Bulan -->
                <div class="col-md-3">
                    <label for="monthFilter" class="form-label">Pilih Bulan:</label>
                    <select id="monthFilter" name="month" class="form-control">
                        <option value="">Pilih Bulan</option>
                        @foreach($months as $month)
                        <option value="{{ $month }}" {{ request()->get('month') == $month ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- <!-- Pilihan Event -->
                <div class="col-md-3">
                    <label for="eventFilter" class="form-label">Pilih Event:</label>
                    <select id="eventFilter" name="eventFilter" class="form-control">
                        <option value="">Semua Event</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id_event }}" {{ request()->get('eventFilter') == $event->id_event ? 'selected' : '' }}>
                {{ $event->name }}
                </option>
                @endforeach
                </select>
            </div> --}}

            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Tampilkan</button>
            </div>
    </div>
    </form>

    <!-- Grafik Penjualan Harian -->
    <div class="mt-2">
        <h4>Grafik Penjualan Harian</h4>
        <canvas id="dailySalesGraph" width="400" height="200"></canvas>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const salesData = @json($salesData); // Data penjualan per hari
        const labels = salesData.map(data => new Date(data.date).toLocaleDateString()); // Mengambil tanggal
        const dataValues = salesData.map(data => data.total_sales); // Mengambil total penjualan

        const ctx = document.getElementById('dailySalesGraph').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Penjualan Harian (Rp)',
                    data: dataValues,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total Penjualan (Rp)'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }
                }
            }
        });
    </script>

    <!-- Grafik Popularitas Event -->
    <div>
        <h4>Grafik Popularitas Event</h4>
        <canvas id="eventPopularityGraph" width="400" height="200"></canvas>

    </div>


    <script>
        const eventPopularityData = @json($eventPopularity); // Data popularitas event
        const eventLabels = eventPopularityData.map(item => item.event_name); // Nama event
        const eventCounts = eventPopularityData.map(item => item.event_count); // Jumlah pembelian per event

        const ctx2 = document.getElementById('eventPopularityGraph').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: eventLabels,
                datasets: [{
                    label: 'Popularitas Event (Jumlah Pembelian)',
                    data: eventCounts,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Pembelian'
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1 // Set step size ke 1 agar angka di sumbu Y adalah angka bulat
                        }
                    }
                }
            }
        });
    </script>

    @endsection