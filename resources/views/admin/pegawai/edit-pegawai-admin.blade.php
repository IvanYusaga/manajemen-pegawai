@extends('layouts.admin')

@section('title', 'Edit Data Pegawai')

@section('subtitle')
<p class="text-base-muted">Perbarui informasi pegawai <strong>{{ $pegawai->nama }}</strong> melalui formulir di bawah ini.</p>
@endsection

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.pegawai.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl font-semibold bg-white border border-base-border text-base-text hover:bg-slate-100 transition-all">
            <img src="{{ asset('style/assets/img/kembali-icon.png') }}" alt="Kembali" class="w-5 h-5 object-contain">
            Kembali
        </a>
    </div>

    <div>
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
                            class="w-full px-4 py-3 rounded-xl border border-base-border text-[0.95rem] focus:outline-none focus:ring-4 focus:ring-indigo-50 focus:border-primary transition-all @error('jenis_kelamin') border-red-500 @enderror cursor-pointer" required>
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
                            class="w-full px-4 py-3 rounded-xl border border-base-border text-[0.95rem] focus:outline-none focus:ring-4 focus:ring-indigo-50 focus:border-primary transition-all @error('tanggal_lahir') border-red-500 @enderror cursor-pointer" 
                            value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir) }}" required>
                        @error('tanggal_lahir')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="pendidikan" class="block text-sm font-semibold mb-2">Pendidikan Terakhir</label>
                    <select name="pendidikan" id="pendidikan" 
                        class="w-full px-4 py-3 rounded-xl border border-base-border text-[0.95rem] focus:outline-none focus:ring-4 focus:ring-indigo-50 focus:border-primary transition-all @error('pendidikan') border-red-500 @enderror cursor-pointer" required>
                        <option value="" disabled>Pilih pendidikan terakhir</option>
                        @foreach(['SD', 'SMP', 'SMA', 'D3', 'D4', 'S1', 'S2'] as $p)
                            <option value="{{ $p }}" {{ old('pendidikan', $pegawai->pendidikan) == $p ? 'selected' : '' }}>{{ $p }}</option>
                        @endforeach
                    </select>
                    @error('pendidikan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="px-6 py-5 bg-slate-50 border-t border-base-border flex justify-end gap-3">
                <a href="{{ route('admin.pegawai.index') }}" class="px-6 py-2.5 rounded-xl font-semibold text-[0.95rem] bg-white border border-base-border text-base-text hover:bg-slate-100 transition-all cursor-pointer">Batal</a>
                <button type="submit" class="inline-flex items-center gap-3 px-6 py-2.5 rounded-xl font-semibold text-[0.95rem] bg-primary text-white hover:bg-primary-hover hover:-translate-y-0.5 hover:shadow-lg hover:shadow-indigo-200 transition-all duration-200 cursor-pointer">
                    <img src="{{ asset('style/assets/img/simpan-icon.png') }}" alt="Simpan" class="w-5 h-5 object-contain">
                    Perbarui Data
                </button>
            </div>
        </form>
    </div>
@endsection
