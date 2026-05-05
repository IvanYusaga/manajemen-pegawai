@extends('layouts.admin')

@section('title', 'Data Pegawai')

@push('styles')
<style>
    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: var(--transition);
        border: none;
        text-decoration: none;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 0.8rem;
    }

    .btn-outline {
        background: transparent;
        border: 1px solid var(--border-color);
        color: var(--text-main);
    }

    .btn-outline:hover {
        background: #f8fafc;
        border-color: var(--text-muted);
    }

    .btn-danger {
        background: #fee2e2;
        color: #ef4444;
    }

    .btn-danger:hover {
        background: #fecaca;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th {
        text-align: left;
        padding: 16px 24px;
        background: #f8fafc;
        color: var(--text-muted);
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid var(--border-color);
    }

    .data-table td {
        padding: 16px 24px;
        border-bottom: 1px solid var(--border-color);
        font-size: 0.95rem;
        color: var(--text-main);
        vertical-align: middle;
    }

    .data-table tr:last-child td {
        border-bottom: none;
    }

    .data-table tr:hover {
        background: #f1f5f9;
    }

    .badge {
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .badge-blue { background: #eef2ff; color: #6366f1; }
    .badge-gray { background: #f1f5f9; color: #64748b; }

    .pagination-wrapper {
        padding: 20px 24px;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: flex-end;
    }
</style>
@endpush

@section('content')
<div class="page-container">
    <div class="welcome-section" style="display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <h1>Data Pegawai</h1>
            <p>Kelola semua data pegawai dalam sistem ini.</p>
        </div>
        <a href="{{ route('admin.pegawai.create') }}" class="btn btn-primary">
            <i data-lucide="plus"></i>
            Tambah Pegawai
        </a>
    </div>

    @if (session('success'))
        <div style="background: #f0fdf4; border-left: 4px solid #22c55e; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="width: 32px; height: 32px; background: #22c55e; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                <i data-lucide="check" style="width: 18px; height: 18px;"></i>
            </div>
            <div>
                <p style="color: #166534; font-weight: 600; font-size: 0.95rem;">Berhasil!</p>
                <p style="color: #15803d; font-size: 0.9rem;">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h2>Daftar Pegawai</h2>
        </div>
        <div style="overflow-x: auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Pendidikan</th>
                        <th>Tanggal Lahir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pegawai as $index => $item)
                        <tr>
                            <td>{{ $pegawai->firstItem() + $index }}</td>
                            <td style="font-weight: 600;">{{ $item->nama }}</td>
                            <td>
                                <span class="badge {{ $item->jenis_kelamin == 'Laki-laki' ? 'badge-blue' : 'badge-gray' }}">
                                    {{ $item->jenis_kelamin }}
                                </span>
                            </td>
                            <td>{{ $item->pendidikan }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.pegawai.edit', $item->id) }}" class="btn btn-outline btn-sm" title="Edit">
                                        <i data-lucide="edit-3" style="width: 14px; height: 14px;"></i>
                                    </a>
                                    <form action="{{ route('admin.pegawai.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pegawai {{ $item->nama }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                            <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 48px; color: var(--text-muted);">
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 12px;">
                                    <i data-lucide="users" style="width: 48px; height: 48px; opacity: 0.2;"></i>
                                    <p>Belum ada data pegawai.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($pegawai->hasPages())
            <div class="pagination-wrapper">
                {{ $pegawai->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

