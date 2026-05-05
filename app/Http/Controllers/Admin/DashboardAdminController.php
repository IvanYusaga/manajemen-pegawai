<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // 1. Statistik Jenis Kelamin
        $genderStats = Pegawai::selectRaw('jenis_kelamin, COUNT(*) as total')
            ->groupBy('jenis_kelamin')
            ->get();

        $lakiLaki = $genderStats->where('jenis_kelamin', 'laki-laki')->first()?->total ?? 0;
        $perempuan = $genderStats->where('jenis_kelamin', 'perempuan')->first()?->total ?? 0;
        $total = $lakiLaki + $perempuan;

        // Hitung Persentase (untuk visualisasi chart batang)
        $pLaki = $total > 0 ? ($lakiLaki / $total) * 100 : 0;
        $pPerempuan = $total > 0 ? ($perempuan / $total) * 100 : 0;

        // 2. Statistik Umur (Distribusi Umur)
        $ageDistribution = Pegawai::selectRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) as age, COUNT(*) as count')
            ->groupBy('age')
            ->orderBy('age')
            ->get();

        // Cari jumlah terbanyak untuk skala tinggi chart
        $maxAgeCount = $ageDistribution->max('count') ?: 1;

        // 3. Statistik Pendidikan
        $educationDistribution = Pegawai::selectRaw('pendidikan, COUNT(*) as count')
            ->groupBy('pendidikan')
            ->get();

        // Cari jumlah terbanyak untuk skala tinggi chart
        $maxEduCount = $educationDistribution->max('count') ?: 1;

        return view('admin.dashboard-admin', compact(
            'lakiLaki',
            'perempuan',
            'total',
            'pLaki',
            'pPerempuan',
            'ageDistribution',
            'maxAgeCount',
            'educationDistribution',
            'maxEduCount'
        ));
    }
}
