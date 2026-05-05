@extends('layouts.admin')

@section('title', 'Data Pegawai')

@section('subtitle')
<p class="text-base-muted">Kelola semua data pegawai dalam sistem ini.</p>
@endsection

@section('content')
    <div class="mb-8 flex justify-end">
        <a href="{{ route('admin.pegawai.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold bg-primary text-white hover:bg-primary-hover hover:-translate-y-0.5 hover:shadow-lg hover:shadow-indigo-200 transition-all duration-200">
            <img src="{{ asset('style/assets/img/tambah-icon.png') }}" alt="Dashboard" class="w-5 h-5 object-contain">
            Tambah Pegawai
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 flex items-center gap-4 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-xl shadow-sm animate-in fade-in slide-in-from-top-4 duration-300">
            <div>
                <p class="font-bold text-emerald-900">Berhasil!</p>
                <p class="text-emerald-700 text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-base-border shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-base-border flex items-center justify-between bg-slate-50/50">
            <h2 class="text-lg font-semibold">Daftar Pegawai</h2>
            <span class="px-3 py-1 bg-white border border-base-border rounded-lg text-xs font-medium text-base-muted">
                Total: {{ $pegawai->total() }}
            </span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-6 py-4 text-xs font-bold text-base-muted uppercase tracking-wider border-b border-base-border">No</th>
                        <th class="px-6 py-4 text-xs font-bold text-base-muted uppercase tracking-wider border-b border-base-border">Nama</th>
                        <th class="px-6 py-4 text-xs font-bold text-base-muted uppercase tracking-wider border-b border-base-border">Jenis Kelamin</th>
                        <th class="px-6 py-4 text-xs font-bold text-base-muted uppercase tracking-wider border-b border-base-border">Pendidikan</th>
                        <th class="px-6 py-4 text-xs font-bold text-base-muted uppercase tracking-wider border-b border-base-border">Tanggal Lahir</th>
                        <th class="px-6 py-4 text-xs font-bold text-base-muted uppercase tracking-wider border-b border-base-border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-base-border">
                    @forelse ($pegawai as $index => $item)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-base-muted">{{ $pegawai->firstItem() + $index }}</td>
                            <td class="px-6 py-4 font-semibold text-base-text">{{ $item->nama }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold {{ $item->jenis_kelamin == 'laki-laki' ? 'bg-indigo-50 text-indigo-600' : 'bg-rose-50 text-rose-600' }}">
                                    {{ ucfirst($item->jenis_kelamin) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-base-text">{{ $item->pendidikan }}</td>
                            <td class="px-6 py-4 text-sm text-base-text">{{ \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.pegawai.edit', $item->id) }}" 
                                        class="p-2 rounded-lg bg-white border border-base-border text-slate-400 hover:text-primary hover:border-primary hover:bg-indigo-50 transition-all shadow-sm" 
                                        title="Edit">
                                        <img src="{{ asset('style/assets/img/edit-icon.png') }}" alt="Edit" class="w-5 h-5 object-contain">
                                    </a>
                                    <form action="{{ route('admin.pegawai.destroy', $item->id) }}" method="POST" 
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pegawai {{ $item->nama }}?')"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="p-2 rounded-lg bg-white border border-base-border text-slate-400 hover:text-red-600 hover:border-red-200 hover:bg-red-50 transition-all shadow-sm" 
                                            title="Hapus">
                                            <img src="{{ asset('style/assets/img/delete-icon.png') }}" alt="Delete" class="w-5 h-5 object-contain">
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-200">
                                        <img src="{{ asset('style/assets/img/empty-employee-icon.png') }}" alt="Empty Employee" class="w-24 h-24 object-contain">
                                    </div>
                                    <p class="text-base-muted font-medium">Belum ada data pegawai.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($pegawai->hasPages())
            <div class="px-6 py-4 bg-slate-50/50 border-t border-base-border">
                {{ $pegawai->links() }}
            </div>
        @endif
    </div>
@endsection

