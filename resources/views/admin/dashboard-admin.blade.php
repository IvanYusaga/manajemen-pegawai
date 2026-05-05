@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="page-container">
    <div class="welcome-section">
        <h1>Dashboard Statistik Pegawai 👋</h1>
        <p>Monitor komposisi pegawai berdasarkan jenis kelamin secara real-time.</p>
    </div>

    <div class="content-grid">
        <div class="card" style="grid-column: span 2;">
            <div class="card-header">
                <h2>Statistik Jenis Kelamin</h2>
            </div>
            <div class="chart-container" style="height: 400px; padding: 20px;">
                <canvas id="genderChart"></canvas>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h2>Ringkasan Data</h2>
            </div>
            <div style="padding: 24px;">
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background: rgba(99, 102, 241, 0.1); border-radius: 12px; border: 1px solid rgba(99, 102, 241, 0.2);">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 12px; height: 12px; background: #6366f1; border-radius: 3px;"></div>
                            <span style="font-weight: 600; color: var(--text-main);">Laki-laki</span>
                        </div>
                        <span style="font-size: 1.25rem; font-weight: 700; color: #6366f1;">{{ $lakiLaki }}</span>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background: rgba(236, 72, 153, 0.1); border-radius: 12px; border: 1px solid rgba(236, 72, 153, 0.2);">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 12px; height: 12px; background: #ec4899; border-radius: 3px;"></div>
                            <span style="font-weight: 600; color: var(--text-main);">Perempuan</span>
                        </div>
                        <span style="font-size: 1.25rem; font-weight: 700; color: #ec4899;">{{ $perempuan }}</span>
                    </div>

                    <div style="margin-top: 10px; padding-top: 20px; border-top: 1px border-dashed #e2e8f0;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span style="color: var(--text-muted);">Total Pegawai</span>
                            <span style="font-weight: 600;">{{ $lakiLaki + $perempuan }}</span>
                        </div>
                        <div style="width: 100%; height: 8px; background: #f1f5f9; border-radius: 10px; overflow: hidden; display: flex;">
                            @php
                                $total = $lakiLaki + $perempuan;
                                $pLaki = $total > 0 ? ($lakiLaki / $total) * 100 : 0;
                                $pPerempuan = $total > 0 ? ($perempuan / $total) * 100 : 0;
                            @endphp
                            <div style="width: {{ $pLaki }}%; background: #6366f1;"></div>
                            <div style="width: {{ $pPerempuan }}%; background: #ec4899;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Age Distribution Card -->
        <div class="card" style="grid-column: span 3;">
            <div class="card-header">
                <h2>Statistik Umur Pegawai</h2>
            </div>
            <div class="chart-container" style="height: 400px; padding: 20px;">
                <canvas id="ageChart"></canvas>
            </div>
        </div>

        <!-- Education Distribution Card -->
        <div class="card" style="grid-column: span 3;">
            <div class="card-header">
                <h2>Statistik Pendidikan Pegawai</h2>
            </div>
            <div class="chart-container" style="height: 400px; padding: 20px;">
                <canvas id="educationChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('genderChart').getContext('2d');
        
        // Create gradient
        const blueGradient = ctx.createLinearGradient(0, 0, 0, 400);
        blueGradient.addColorStop(0, '#6366f1');
        blueGradient.addColorStop(1, '#818cf8');
        
        const pinkGradient = ctx.createLinearGradient(0, 0, 0, 400);
        pinkGradient.addColorStop(0, '#ec4899');
        pinkGradient.addColorStop(1, '#f472b6');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    label: 'Jumlah Pegawai',
                    data: [{{ $lakiLaki }}, {{ $perempuan }}],
                    backgroundColor: [blueGradient, pinkGradient],
                    borderRadius: 8,
                    borderSkipped: false,
                    barThickness: 60,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 },
                        cornerRadius: 8,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            color: '#64748b'
                        },
                        grid: {
                            color: '#f1f5f9',
                            drawBorder: false
                        }
                    },
                    x: {
                        ticks: {
                            color: '#64748b',
                            font: { weight: '600' }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Age Distribution Chart
        const ageCtx = document.getElementById('ageChart').getContext('2d');
        const ageLabels = {!! json_encode($ageDistribution->pluck('age')) !!};
        const ageData = {!! json_encode($ageDistribution->pluck('count')) !!};

        const greenGradient = ageCtx.createLinearGradient(0, 0, 0, 400);
        greenGradient.addColorStop(0, '#10b981');
        greenGradient.addColorStop(1, '#34d399');

        new Chart(ageCtx, {
            type: 'bar',
            data: {
                labels: ageLabels.map(age => age + ' Tahun'),
                datasets: [{
                    label: 'Jumlah Pegawai',
                    data: ageData,
                    backgroundColor: greenGradient,
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0, color: '#64748b' },
                        grid: { color: '#f1f5f9', drawBorder: false }
                    },
                    x: {
                        ticks: { color: '#64748b' },
                        grid: { display: false }
                    }
                }
            }
        });

        // Education Distribution Chart
        const eduCtx = document.getElementById('educationChart').getContext('2d');
        const eduLabels = {!! json_encode($educationDistribution->pluck('pendidikan')) !!};
        const eduData = {!! json_encode($educationDistribution->pluck('count')) !!};

        const purpleGradient = eduCtx.createLinearGradient(0, 0, 0, 400);
        purpleGradient.addColorStop(0, '#8b5cf6');
        purpleGradient.addColorStop(1, '#a78bfa');

        new Chart(eduCtx, {
            type: 'bar',
            data: {
                labels: eduLabels,
                datasets: [{
                    label: 'Jumlah Pegawai',
                    data: eduData,
                    backgroundColor: purpleGradient,
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0, color: '#64748b' },
                        grid: { color: '#f1f5f9', drawBorder: false }
                    },
                    x: {
                        ticks: { color: '#64748b' },
                        grid: { display: false }
                    }
                }
            }
        });
    });
</script>
@endpush
