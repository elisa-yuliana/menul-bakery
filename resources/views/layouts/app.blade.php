<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menul Bakery</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
</head>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block navbar sidebar min-vh-100 p-3">
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <!-- Judul di sebelah kiri -->
                    <h4 class="text-white mb-0">Menul Bakery</h4>

                    <!-- Container ikon di sebelah kanan -->
                    <ul class="navbar-nav">
                        <li class="nav-item position-relative">
                            <a class="nav-link" href="{{ route('dashboard.index') }}">
                                {{-- Perbaikan kurung pada asset dan penghapusan spasi/backslash extra --}}
                                <img src="{{ asset('img/icons/bell-fill.svg') }}" class="icon-putih" style="width: 24px;">
                                
                                @if($totalNotifikasi > 0)
                                    <span class="badge badge-danger" 
                                        style="position: absolute; top: -5px; right: -5px; font-size: 10px; border-radius: 50%;">
                                        {{ $totalNotifikasi }}
                                    </span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>
                <hr class="text-white">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->is('/') ? ' active' : '' }}" href="{{ route('dashboard.index') }}">
                            <img src="{{ asset('img\icons\house-fill.svg') }}" class="me-2 icon-putih"> Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->is('bahan') ? ' active' : '' }}" href="{{ route('bahan.index') }}">
                            <img src="{{ asset('img\icons\cart-fill.svg') }}" class="me-2 icon-putih"> Bahan
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->is('bahanMasuk') ? ' active' : '' }}" href="{{ route('bahan_masuk.index') }}">
                            <img src="{{ asset('img\icons\cart-plus-fill.svg') }}" class="me-2 icon-putih"> Bahan Masuk
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->is('bahanKeluar') ? ' active' : '' }}" href="{{ route('bahan_keluar.index') }}">
                            <img src="{{ asset('img\icons\cart-dash-fill.svg') }}" class="me-2 icon-putih"> Bahan Keluar
                        </a>
                    </li>
                    @if (auth()->user()->role === 'admin')
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->is('laporan') ? ' active' : '' }}" href="{{ route('laporan.index') }}">
                            <img src="{{ asset('img\icons\file-earmark-bar-graph-fill.svg') }}" class="me-2 icon-putih"> Laporan
                        </a>
                    </li>

                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->is('admin/kelola-staff') ? ' active' : '' }}" href="{{ route('admin.users.index') }}">
                            <img src="{{ asset('img\icons\person-circle.svg') }}" class="me-2 icon-putih"> User Management
                        </a>
                    </li>
                    @endif
                    <li class="nav-item mb-2">
                        <!-- Ubah onclick agar memicu modal Bootstrap -->
                        <a class="nav-link text-white {{ request()->is('logout') ? ' active' : '' }}" 
                        href="#" 
                        data-bs-toggle="modal" 
                        data-bs-target="#logoutModal">
                            <img src="{{ asset('img/icons/box-arrow-left.svg') }}" class="me-2 icon-putih"> logout
                        </a>

                        <!-- Form tetap disembunyikan di sini -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                                    <!-- Logout Modal -->
                    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin keluar dari aplikasi?
                                </div>
                                <div class="modal-content p-3 d-flex flex-row justify-content-end gap-2" style="border-top: 1px solid #dee2e6;">
                                    <!-- Tombol Batal -->
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    
                                    <!-- Tombol Yakin (Akan memicu form logout) -->
                                    <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Ya, Logout
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </ul>
            </nav>
            <main class="col-md-10 ms-sm-auto px-md-4 py-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    @stack('scripts') 
</body>

</html>