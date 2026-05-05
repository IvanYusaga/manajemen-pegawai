@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="page-container">
    <div class="welcome-section">
        <h1>Halo, Ivan! 👋</h1>
        <p>Selamat datang kembali di dashboard manajemen pegawai Anda.</p>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon bg-blue">
                <i data-lucide="users"></i>
            </div>
            <div class="stat-info">
                <h3>Total Pegawai</h3>
                <div class="value">1,284</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-green">
                <i data-lucide="user-check"></i>
            </div>
            <div class="stat-info">
                <h3>Hadir Hari Ini</h3>
                <div class="value">1,120</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-purple">
                <i data-lucide="clock"></i>
            </div>
            <div class="stat-info">
                <h3>Cuti/Izin</h3>
                <div class="value">42</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-orange">
                <i data-lucide="briefcase"></i>
            </div>
            <div class="stat-info">
                <h3>Karyawan Baru</h3>
                <div class="value">12</div>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <div class="card">
            <div class="card-header">
                <h2>Statistik Kehadiran Mingguan</h2>
            </div>
            <div class="chart-container">
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Aktivitas Terakhir</h2>
            </div>
            <div style="padding: 24px;">
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div style="display: flex; gap: 16px;">
                        <div style="width: 8px; height: 8px; background: var(--primary); border-radius: 50%; margin-top: 6px;"></div>
                        <div>
                            <p style="font-size: 0.9rem; font-weight: 500;">Presensi Alex Johnson</p>
                            <p style="font-size: 0.75rem; color: var(--text-muted);">2 menit yang lalu</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 16px;">
                        <div style="width: 8px; height: 8px; background: #22c55e; border-radius: 50%; margin-top: 6px;"></div>
                        <div>
                            <p style="font-size: 0.9rem; font-weight: 500;">Payroll April Selesai</p>
                            <p style="font-size: 0.75rem; color: var(--text-muted);">1 jam yang lalu</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 16px;">
                        <div style="width: 8px; height: 8px; background: #f97316; border-radius: 50%; margin-top: 6px;"></div>
                        <div>
                            <p style="font-size: 0.9rem; font-weight: 500;">Pengajuan Cuti Sarah</p>
                            <p style="font-size: 0.75rem; color: var(--text-muted);">3 jam yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Attendance Chart
    const ctx = document.getElementById('attendanceChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                label: 'Kehadiran',
                data: [1100, 1150, 1120, 1180, 1140, 400, 350],
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: '#6366f1'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { display: false }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
</script>
@endpush
