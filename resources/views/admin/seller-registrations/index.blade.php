@extends('layouts.admin')

@section('title', 'Pendaftaran Penjual')
@section('page-heading', 'Pendaftaran Penjual')

@section('content')
<div class="page-title">
    <h1>Pengajuan Pendaftaran Penjual</h1>
    <p>Periksa informasi pemohon dan tinjau pengajuan toko yang masuk ke PinTa.</p>
</div>

@if(session('success'))
    <div class="alert alert-success"><span class="material-symbols-outlined" style="font-size:17px;vertical-align:middle;margin-right:5px">check_circle</span>{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger"><span class="material-symbols-outlined" style="font-size:17px;vertical-align:middle;margin-right:5px">error</span>{{ session('error') }}</div>
@endif

<section class="panel">
    <div class="panel-heading">
        <div><h2>Daftar Pengajuan</h2><p>Informasi pendaftaran penjual yang tersimpan di sistem.</p></div>
        <span class="status status-pending">{{ $registrations->total() }} Pengajuan</span>
    </div>

    <div class="table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Pemohon</th>
                    <th>Nama Toko</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registrations as $registration)
                    <tr>
                        <td>{{ $loop->iteration + $registrations->firstItem() - 1 }}</td>
                        <td>
                            <div class="person-name">{{ $registration->user->name }}</div>
                            <div class="subtext">{{ $registration->user->email }}</div>
                        </td>
                        <td><span class="person-name">{{ $registration->store_name }}</span></td>
                        <td>{{ $registration->created_at->format('d M Y') }}<div class="subtext">{{ $registration->created_at->format('H:i') }} WIB</div></td>
                        <td>
                            @if($registration->status === 'pending')
                                <span class="status status-pending">Menunggu</span>
                            @elseif($registration->status === 'approved')
                                <span class="status status-approved">Disetujui</span>
                            @else
                                <span class="status status-rejected">Ditolak</span>
                            @endif
                        </td>
                        <td><a class="text-link" href="{{ route('admin.seller-registrations.show', $registration->id) }}">Lihat detail <span aria-hidden="true">→</span></a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <span class="material-symbols-outlined">inbox</span>
                                <div style="font-weight:800;color:#514a44">Belum ada pengajuan</div>
                                <div class="subtext">Pengajuan pendaftaran penjual akan muncul di halaman ini.</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">{{ $registrations->links() }}</div>
</section>
@endsection
