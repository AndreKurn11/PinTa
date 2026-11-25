
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Detail Pengajuan Penjual</h1>

    <p><strong>Nama Pemohon:</strong> {{ $registration->user->name }}</p>
    <p><strong>Email:</strong> {{ $registration->user->email }}</p>
    <p><strong>Nama Toko:</strong> {{ $registration->store_name }}</p>
    <p><strong>Deskripsi:</strong> {{ $registration->description ?? '-' }}</p>
    <p><strong>Nomor Telepon:</strong> {{ $registration->phone }}</p>
    <p><strong>Alamat Toko:</strong> {{ $registration->address }}</p>

    <p>
        <strong>Status:</strong>
        {{ ucfirst($registration->status) }}
    </p>

    @if($registration->status === 'rejected')
        <p>
            <strong>Alasan Penolakan:</strong>
            {{ $registration->rejection_reason ?? '-' }}
        </p>
    @endif

    @if($registration->reviewer)
        <p>
            <strong>Diproses oleh:</strong>
            {{ $registration->reviewer->name }}
        </p>
        <p>
            <strong>Waktu diproses:</strong>
            {{ $registration->reviewed_at?->format('d-m-Y H:i') ?? '-' }}
        </p>
    @endif

    <hr>

    @if($registration->status === 'pending')
        <h3>Setujui Pengajuan</h3>

        <form
            action="{{ route('admin.seller-registrations.approve', $registration->id) }}"
            method="POST"
            onsubmit="return confirm('Yakin ingin menyetujui pengajuan ini?')"
        >
            @csrf
            <button type="submit">
                Setujui Pengajuan
            </button>
        </form>

        <hr>

        <h3>Tolak Pengajuan</h3>

        <form
            action="{{ route('admin.seller-registrations.reject', $registration->id) }}"
            method="POST"
        >
            @csrf

            <label for="rejection_reason">
                Alasan Penolakan
            </label>

            <textarea
                name="rejection_reason"
                id="rejection_reason"
                rows="4"
                required
                style="display:block; width:100%; margin:10px 0;"
            >{{ old('rejection_reason') }}</textarea>

            @error('rejection_reason')
                <p style="color:red;">{{ $message }}</p>
            @enderror

            <button
                type="submit"
                onclick="return confirm('Yakin ingin menolak pengajuan ini?')"
            >
                Tolak Pengajuan
            </button>
        </form>
    @else
        <p>Pengajuan ini sudah diproses dan tidak dapat diubah lagi.</p>
    @endif

    <br>

    <a href="{{ route('admin.seller-registrations.index') }}">
        ← Kembali ke Daftar Pengajuan
    </a>
</div>
@endsection
