@extends('layouts.app') {{-- Pastikan meng-extend layout utama yang berisi sidebar --}}

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Data Staff</h1>
    </div>

    <div class="row">
        <!-- Tabel Daftar Staff -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Akun Karyawan</h6>
                    <a href="{{ route('admin.staff.create') }}" class="btn btn-primary btn-sm shadow-sm">
                        <i class="fas fa-user-plus fa-sm text-white-50"></i> Tambah Staff
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge {{ $user->role == 'admin' ? 'bg-danger' : 'bg-success' }}">
                                            {{ strtoupper($user->role) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if(Auth::id() !== $user->id)
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mencabut akses staff ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                        @else
                                        <span class="text-muted small italic">Akun Anda</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Histori Login (Audit Trail) -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-dark">
                    <h6 class="m-0 font-weight-bold text-white">Log Aktivitas (Offline)</h6>
                </div>
                <div class="card-body">
                    <div class="timeline" style="max-height: 400px; overflow-y: auto;">
                        @foreach($histories as $log)
                        <div class="mb-3 border-bottom pb-2">
                            <div class="small text-muted">{{ $log->login_at->format('d M, H:i') }}</div>
                            <div class="font-weight-bold text-dark">{{ $log->name }}</div>
                            <div class="small text-primary">
                                <i class="fas fa-mobile-alt"></i> {{ Str::limit($log->user_agent, 30) }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection