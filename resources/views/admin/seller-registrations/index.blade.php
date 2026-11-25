
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Pengajuan Pendaftaran Penjual</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table width="100%" border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Pemohon</th>
                <th>Email</th>
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
                    <td>{{ $registration->user->name }}</td>
                    <td>{{ $registration->user->email }}</td>
                    <td>{{ $registration->store_name }}</td>
                    <td>{{ $registration->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        @if($registration->status === 'pending')
                            <span style="color: orange;">Menunggu</span>
                        @elseif($registration->status === 'approved')
                            <span style="color: green;">Disetujui</span>
                        @else
                            <span style="color: red;">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.seller-registrations.show', $registration->id) }}">
                            Lihat Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" align="center">
                        Belum ada pengajuan pendaftaran penjual.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $registrations->links() }}
    </div>
</div>
@endsection
