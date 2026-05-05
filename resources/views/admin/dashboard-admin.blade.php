@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Dashboard Statistik Pegawai 👋</h1>
        <p class="text-base-muted">Monitor komposisi pegawai berdasarkan jenis kelamin secara real-time.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-2xl border border-base-border shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-base-border">
                <h2 class="text-lg font-semibold">Statistik Jenis Kelamin</h2>
            </div>
            <div class="p-6 h-[400px]">
                <canvas id="genderChart"></canvas>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl border border-base-border shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-base-border">
                <h2 class="text-lg font-semibold">Ringkasan Data</h2>
            </div>
            <div class="p-6 space-y-5">
                <div class="flex justify-between items-center p-4 bg-indigo-50 border border-indigo-100 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 bg-indigo-500 rounded-full"></div>
                        <span class="font-semibold">Laki-laki</span>
                    </div>
                    <span class="text-2xl font-bold text-indigo-600">{{ $lakiLaki }}</span>
                </div>
                
                <div class="flex justify-between items-center p-4 bg-rose-50 border border-rose-100 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 bg-rose-500 rounded-full"></div>
                        <span class="font-semibold">Perempuan</span>
                    </div>
                    <span class="text-2xl font-bold text-rose-600">{{ $perempuan }}</span>
                </div>

                <div class="mt-2 pt-5 border-t border-dashed border-base-border">
                    <div class="flex justify-between mb-2">
                        <span class="text-base-muted text-sm font-medium">Total Pegawai</span>
                        <span class="font-bold">{{ $lakiLaki + $perempuan }}</span>
                    </div>
                    <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden flex">
                        @php
                            $total = $lakiLaki + $perempuan;
                            $pLaki = $total > 0 ? ($lakiLaki / $total) * 100 : 0;
                            $pPerempuan = $total > 0 ? ($perempuan / $total) * 100 : 0;
                        @endphp
                        <div class="h-full bg-indigo-500" style="width: {{ $pLaki }}%"></div>
                        <div class="h-full bg-rose-500" style="width: {{ $pPerempuan }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3 bg-white rounded-2xl border border-base-border shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-base-border">
                <h2 class="text-lg font-semibold">Statistik Umur Pegawai</h2>
            </div>
            <div class="p-6 h-[400px]">
                <canvas id="ageChart"></canvas>
            </div>
        </div>

        <div class="lg:col-span-3 bg-white rounded-2xl border border-base-border shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-base-border">
                <h2 class="text-lg font-semibold">Statistik Pendidikan Pegawai</h2>
            </div>
            <div class="p-6 h-[400px]">
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
