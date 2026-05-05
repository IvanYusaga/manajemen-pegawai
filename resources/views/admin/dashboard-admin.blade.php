@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('subtitle')
<p class="text-base-muted">Monitor Statistik Pegawai.</p>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-2xl border border-base-border shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-base-border">
                <h2 class="text-lg font-semibold">Statistik Jenis Kelamin</h2>
            </div>
            <div class="p-6 h-[400px]">
                <div class="flex items-end justify-around h-full gap-8 pt-10 px-10">
                    <div class="flex flex-col items-center gap-4 flex-1 h-full justify-end">
                        <div class="w-24 bg-gradient-to-t from-indigo-600 to-indigo-400 rounded-t-2xl transition-all duration-700 shadow-lg shadow-indigo-100" style="height: {{ $pLaki }}%"></div>
                        <span class="text-sm font-bold text-indigo-700">Laki-laki</span>
                        <span class="text-xs text-base-muted font-medium">{{ $lakiLaki }} Pegawai</span>
                    </div>
                    <div class="flex flex-col items-center gap-4 flex-1 h-full justify-end">
                        <div class="w-24 bg-gradient-to-t from-rose-600 to-rose-400 rounded-t-2xl transition-all duration-700 shadow-lg shadow-rose-100" style="height: {{ $pPerempuan }}%"></div>
                        <span class="text-sm font-bold text-rose-700">Perempuan</span>
                        <span class="text-xs text-base-muted font-medium">{{ $perempuan }} Pegawai</span>
                    </div>
                </div>
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
                        <span class="font-bold">{{ $total }}</span>
                    </div>
                    <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden flex">
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
                <div class="flex items-end h-full gap-3 pt-10 overflow-x-auto pb-4 px-2">
                    @forelse($ageDistribution as $data)
                        <div class="flex flex-col items-center gap-3 min-w-[50px] flex-1 h-full justify-end group">
                            <div class="w-full bg-gradient-to-t from-emerald-600 to-emerald-400 rounded-t-xl transition-all duration-500 relative shadow-md shadow-emerald-50 hover:-translate-y-1 hover:shadow-lg" 
                                style="height: {{ ($data->count / $maxAgeCount) * 100 }}%">
                                <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[11px] px-2.5 py-1.5 rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-200 shadow-xl z-10 whitespace-nowrap">
                                    {{ $data->count }} Pegawai
                                    <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-slate-900 rotate-45"></div>
                                </div>
                            </div>
                            <span class="text-[11px] text-base-muted font-bold whitespace-nowrap">{{ $data->age }} Thn</span>
                        </div>
                    @empty
                        <div class="w-full h-full flex items-center justify-center text-base-muted">Tidak ada data</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="lg:col-span-3 bg-white rounded-2xl border border-base-border shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-base-border">
                <h2 class="text-lg font-semibold">Statistik Pendidikan Pegawai</h2>
            </div>
            <div class="p-6 h-[400px]">
                <div class="flex items-end h-full gap-6 pt-10 overflow-x-auto pb-4 px-2">
                    @forelse($educationDistribution as $data)
                        <div class="flex flex-col items-center gap-3 min-w-[80px] flex-1 h-full justify-end group">
                            <div class="w-full bg-gradient-to-t from-indigo-600 to-indigo-400 rounded-t-xl transition-all duration-500 relative shadow-md shadow-indigo-50 hover:-translate-y-1 hover:shadow-lg" 
                                style="height: {{ ($data->count / $maxEduCount) * 100 }}%">
                                <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[11px] px-2.5 py-1.5 rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-200 shadow-xl z-10 whitespace-nowrap">
                                    {{ $data->count }} Pegawai
                                    <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-slate-900 rotate-45"></div>
                                </div>
                            </div>
                            <span class="text-[11px] text-base-muted font-bold whitespace-nowrap">{{ $data->pendidikan }}</span>
                        </div>
                    @empty
                        <div class="w-full h-full flex items-center justify-center text-base-muted">Tidak ada data</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
