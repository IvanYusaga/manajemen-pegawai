<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $lakiLaki = Pegawai::where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan = Pegawai::where('jenis_kelamin', 'Perempuan')->count();
        
        // Calculate age distribution
        $ageDistribution = Pegawai::selectRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) as age, COUNT(*) as count')
            ->groupBy('age')
            ->orderBy('age')
            ->get();

        // Calculate education distribution
        $educationDistribution = Pegawai::selectRaw('pendidikan, COUNT(*) as count')
            ->groupBy('pendidikan')
            ->get();

        return view('admin.dashboard-admin', compact('lakiLaki', 'perempuan', 'ageDistribution', 'educationDistribution'));
    }
}
