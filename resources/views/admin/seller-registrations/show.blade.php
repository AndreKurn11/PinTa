@extends('layouts.admin')

@section('title', 'Detail Pengajuan Penjual')
@section('page-heading', 'Detail Pengajuan')

@section('content')
<div class="page-title">
    <h1>Detail Pengajuan Penjual</h1>
    <p>Tinjau data pemohon sebelum menyetujui atau menolak pendaftaran toko.</p>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<section class="panel">
    <div class="panel-heading">
        <div><h2>Informasi Pemohon &amp; Toko</h2><p>Data yang dikirimkan saat pendaftaran penjual.</p></div>
        @if($registration->status === 'pending')
            <span class="status status-pending">Menunggu</span>
        @elseif($registration->status === 'approved')
            <span class="status status-approved">Disetujui</span>
        @else
            <span class="status status-rejected">Ditolak</span>
        @endif
    </div>

    <div class="detail-grid">
        <div class="detail-item"><div class="detail-label">Nama Pemohon</div><div class="detail-value">{{ $registration->user->name }}</div></div>
        <div class="detail-item"><div class="detail-label">Email</div><div class="detail-value">{{ $registration->user->email }}</div></div>
        <div class="detail-item"><div class="detail-label">Nama Toko</div><div class="detail-value">{{ $registration->store_name }}</div></div>
        <div class="detail-item"><div class="detail-label">Nomor Telepon</div><div class="detail-value">{{ $registration->phone }}</div></div>
        <div class="detail-item full"><div class="detail-label">Deskripsi Toko</div><div class="detail-value" style="font-weight:500;line-height:1.7">{{ $registration->description ?? '-' }}</div></div>
        <div class="detail-item full"><div class="detail-label">Alamat Toko</div><div class="detail-value">{{ $registration->address }}</div></div>
        @if($registration->status === 'rejected')
            <div class="detail-item full"><div class="detail-label">Alasan Penolakan</div><div class="detail-value">{{ $registration->rejection_reason ?? '-' }}</div></div>
        @endif
        @if($registration->reviewer)
            <div class="detail-item"><div class="detail-label">Diproses Oleh</div><div class="detail-value">{{ $registration->reviewer->name }}</div></div>
            <div class="detail-item"><div class="detail-label">Waktu Diproses</div><div class="detail-value">{{ $registration->reviewed_at?->format('d-m-Y H:i') ?? '-' }}</div></div>
        @endif
    </div>

    @if($registration->status === 'pending')
        <div class="action-grid">
            <div class="action-card">
                <h3>Setujui Pengajuan</h3>
                <p>Jika data pemohon dan toko sudah sesuai, setujui pendaftaran ini.</p>
                <form action="{{ route('admin.seller-registrations.approve', $registration->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menyetujui pengajuan ini?')">
                    @csrf
                    <button class="btn" type="submit"><span class="material-symbols-outlined" style="font-size:17px">check_circle</span>Setujui Pengajuan</button>
                </form>
            </div>

            <div class="action-card">
                <h3>Tolak Pengajuan</h3>
                <p>Isi alasan penolakan agar keputusan dapat dipahami pemohon.</p>
                <form action="{{ route('admin.seller-registrations.reject', $registration->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menolak pengajuan ini?')">
                    @csrf
                    <label class="field-label" for="rejection_reason">Alasan Penolakan</label>
                    <textarea class="field-input" name="rejection_reason" id="rejection_reason" rows="4" required>{{ old('rejection_reason') }}</textarea>
                    @error('rejection_reason')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                    <button class="btn btn-danger" style="margin-top:11px" type="submit"><span class="material-symbols-outlined" style="font-size:17px">cancel</span>Tolak Pengajuan</button>
                </form>
            </div>
        </div>
    @else
        <div class="alert" style="margin-top:20px;margin-bottom:0;background:#faf8f5;color:#716960;border:1px solid #eee7e0">
            Pengajuan ini sudah diproses dan tidak dapat diubah lagi.
        </div>
    @endif

    <div style="margin-top:22px;padding-top:17px;border-top:1px solid #f0ebe6">
        <a class="text-link" href="{{ route('admin.seller-registrations.index') }}">← Kembali ke Daftar Pengajuan</a>
    </div>
</section>
@endsection
