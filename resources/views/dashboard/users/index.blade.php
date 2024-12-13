@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="card mt-5 mb-5 ">
        <div class="card-title">
            <div class="flex justify-between">
                <h6 class="p-4 text-lg text-gray-500 font-semibold">Selamat Datang, {{ Auth::user()->name }}!</h6>
            </div>
        </div>
        <div class="card-body grid grid-cols-1 lg:grid-cols-3 lg:gap-x-6 gap-x-0 lg:gap-y-0 gap-y-6">
            <!-- Card Sedang Dikirim -->
            {{-- @if ($kkSending === 0 && $ktpSending === 0 && $akteSending === 0)
            @else --}}
            <div class="card">
                <div class="card-title">
                    <h2 class="p-3 text-center font-bold">Sedang Dikirim</h2>
                </div>
                <div class="card-body flex justify-center">
                    <canvas id="sendingChart"></canvas>
                </div>
            </div>
            {{-- @endif --}}

            <!-- Card Sedang Diproses -->
            <div class="card">
                <div class="card-title">
                    <h2 class="p-3 text-center font-bold">Sedang Diproses</h2>
                </div>
                <div class="card-body flex justify-center">
                    <canvas id="pendingChart"></canvas>
                </div>
            </div>
            <div class="card">
                <div class="card-title">
                    <h2 class="p-3 text-center font-bold">Disetujui</h2>
                </div>
                <div class="card-body flex justify-center">
                    <canvas id="acceptsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data untuk Sedang Dikirim
        const sendingCtx = document.getElementById('sendingChart').getContext('2d');
        new Chart(sendingCtx, {
            type: 'pie',
            data: {
                labels: ['Layanan KK', 'Layanan KTP', 'Layanan Akte'],
                datasets: [{
                    label: 'Jumlah Layanan Sedang Dikirim',
                    data: [{{ $kkSending }}, {{ $ktpSending }}, {{ $akteSending }}],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                    borderColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false, // Matikan responsif agar ukurannya tetap kecil
                plugins: {
                    legend: {
                        position: 'bottom' // Letakkan legenda di bawah
                    }
                }
            }
        });

        // Data untuk Sedang Diproses
        const pendingCtx = document.getElementById('pendingChart').getContext('2d');
        new Chart(pendingCtx, {
            type: 'pie',
            data: {
                labels: ['Layanan KK', 'Layanan KTP', 'Layanan Akte'],
                datasets: [{
                    label: 'Jumlah Layanan Sedang Diproses',
                    data: [{{ $kkPending }}, {{ $ktpPending }}, {{ $aktePending }}],
                    backgroundColor: ['#4BC0C0', '#9966FF', '#FF9F40'],
                    borderColor: ['#4BC0C0', '#9966FF', '#FF9F40'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false, // Matikan responsif agar ukurannya tetap kecil
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        const acceptCtx = document.getElementById('acceptsChart').getContext('2d');
        new Chart(acceptCtx, {
            type: 'pie',
            data: {
                labels: ['Layanan KK', 'Layanan KTP', 'Layanan Akte'],
                datasets: [{
                    label: 'Jumlah Layanan Disetujui',
                    data: [{{ $kkAccept }}, {{ $ktpAccept }}, {{ $akteAccept }}],
                    backgroundColor: ['#9C27B0', '#FF9800', '#4CAF50'], // Warna baru
                    borderColor: ['#9C27B0', '#FF9800', '#4CAF50'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false, // Matikan responsif agar ukurannya tetap kecil
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
@endpush
