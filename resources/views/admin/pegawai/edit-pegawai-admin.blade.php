@extends('layouts.admin')

@section('title', 'Edit Pegawai')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.pegawai.index') }}" class="inline-flex items-center justify-center p-2 rounded-xl bg-white border border-base-border text-base-text hover:bg-slate-50 transition-all">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <h1 class="text-3xl font-bold tracking-tight">Edit Data Pegawai</h1>
        </div>
        <p class="text-base-muted">Perbarui informasi pegawai <strong>{{ $pegawai->nama }}</strong> melalui formulir di bawah ini.</p>
    </div>

    <div class="max-w-3xl mx-auto">
        <form action="{{ route('admin.pegawai.update', $pegawai->id) }}" method="POST" class="bg-white rounded-2xl border border-base-border overflow-hidden shadow-sm">
            @csrf
            <div class="px-6 py-5 border-b border-base-border">
                <h2 class="text-lg font-semibold">Informasi Pribadi</h2>
            </div>
            
            <div class="p-6 space-y-5">
                <div>
                    <label for="nama" class="block text-sm font-semibold mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" 
                        class="w-full px-4 py-3 rounded-xl border border-base-border text-[0.95rem] focus:outline-none focus:ring-4 focus:ring-indigo-50 focus:border-primary transition-all @error('nama') border-red-500 @enderror" 
                        placeholder="Masukkan nama lengkap" value="{{ old('nama', $pegawai->nama) }}" required>
                    @error('nama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-semibold mb-2">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" 
                            class="w-full px-4 py-3 rounded-xl border border-base-border text-[0.95rem] focus:outline-none focus:ring-4 focus:ring-indigo-50 focus:border-primary transition-all @error('jenis_kelamin') border-red-500 @enderror" required>
                            <option value="" disabled>Pilih jenis kelamin</option>
                            <option value="laki-laki" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="perempuan" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-semibold mb-2">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" 
                            class="w-full px-4 py-3 rounded-xl border border-base-border text-[0.95rem] focus:outline-none focus:ring-4 focus:ring-indigo-50 focus:border-primary transition-all @error('tanggal_lahir') border-red-500 @enderror" 
                            value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir) }}" required>
                        @error('tanggal_lahir')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="pendidikan" class="block text-sm font-semibold mb-2">Pendidikan Terakhir</label>
                    <input type="text" name="pendidikan" id="pendidikan" 
                        class="w-full px-4 py-3 rounded-xl border border-base-border text-[0.95rem] focus:outline-none focus:ring-4 focus:ring-indigo-50 focus:border-primary transition-all @error('pendidikan') border-red-500 @enderror" 
                        placeholder="Contoh: S1 Teknik Informatika" value="{{ old('pendidikan', $pegawai->pendidikan) }}" required>
                    @error('pendidikan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="px-6 py-5 bg-slate-50 border-t border-base-border flex justify-end gap-3">
                <a href="{{ route('admin.pegawai.index') }}" class="px-6 py-2.5 rounded-xl font-semibold text-[0.95rem] bg-white border border-base-border text-base-text hover:bg-slate-100 transition-all">Batal</a>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl font-semibold text-[0.95rem] bg-primary text-white hover:bg-primary-hover hover:-translate-y-0.5 hover:shadow-lg hover:shadow-indigo-200 transition-all duration-200">
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Perbarui Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
