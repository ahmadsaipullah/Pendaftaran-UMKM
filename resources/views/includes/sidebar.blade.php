  <!-- Main Sidebar Container -->
  <style>
    .sidebar-red {
    background-color: #1b1c3c; /* Warna merah */
}

.sidebar-red .nav-link {
    color: #ffffff; /* Warna teks putih */
}

.sidebar-red .nav-link:hover {
    background-color: #1b1c3c; /* Warna merah tua saat hover */
}

.sidebar-red .brand-link {
    border-bottom: 1px solid #1b1c3c; /* Garis bawah merah tua */
}
  </style>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-red elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/img/logoft.png') }}" alt="Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light text-white">Sepatan UMKM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (Auth()->user()->image)
                    <img src="{{Storage::url(Auth()->user()->image) }}" alt="gambar"
                        width="120px" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;" class="img-fluid">
                @else
                    <img src="{{ asset('assets/img/user_default.png') }}" class="img-circle elevation-2"
                        alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{ route('profile.index', encrypt(auth()->user()->id)) }}"
                    class="d-block text-white">{{ Auth()->user()->name }}</a>
                <span class="text-white text-xs"><i class="fa fa-circle text-success"></i> Online</span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{ route('dashboard') }}" class="nav-link @yield('dashboard')">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> Dashboard</p>
                    </a>
                </li>
                @if (auth()->user()->level_id == 3)
                <li class="nav-header">Menu</li>

                <li class="nav-item">
                    <a href="{{ route('userpermohonan.index') }}" class="nav-link @yield('permohonan')">
                        <i class="nav-icon ion ion-home"></i>
                        <p>Permohonan</p>
                    </a>
                </li>

                @php
                    $userId = auth()->id();
                    $disetujui = \App\Models\Permohonan::where('user_id', $userId)
                                ->where('status', 'Disetujui')
                                ->exists();
                @endphp

                <li class="nav-item mt-4">
                    @if ($disetujui)
                        <a href="{{route('userdokumen.index')}}" class="nav-link @yield('dokumen')">
                            <i class="nav-icon ion ion-document-text"></i>
                            <p>Upload Dokumen</p>
                        </a>
                    @else
                        <a href="javascript:void(0);" class="nav-link disabled" style="pointer-events: none; opacity: 0.6;">
                            <i class="nav-icon ion ion-document-text"></i>
                            <p>Upload Dokumen <small class="text-danger">(Menunggu Persetujuan)</small></p>
                        </a>
                    @endif
                </li>
            @endif


                @if (auth()->user()->level_id == 2)
                    <li class="nav-header">Menu</li>
                @endif
                @if (auth()->user()->level_id == 1)
                <li class="nav-header">Admin Super</li>

                <!-- Admin -->
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link @yield('admin')">
                        <i class="nav-icon ion ion-person-stalker"></i> <!-- Icon Admin -->
                        <p>Admin</p>
                    </a>
                </li>

                <!-- UMKM -->
                <li class="nav-item">
                    <a href="{{ route('umkm.index') }}" class="nav-link @yield('umkm')">
                        <i class="nav-icon ion ion-briefcase"></i> <!-- Ganti ke briefcase (Usaha/UMKM) -->
                        <p>UMKM</p>
                    </a>
                </li>

                <!-- Permohonan -->
                <li class="nav-item">
                    <a href="{{ route('permohonan.index') }}" class="nav-link @yield('permohonan')">
                        <i class="nav-icon ion ion-clipboard"></i> <!-- Ganti ke clipboard (Permohonan) -->
                        <p>Permohonan</p>
                    </a>
                </li>

                <!-- Dokumen -->
                <li class="nav-item">
                    <a href="{{ route('dokumen.index') }}" class="nav-link @yield('dokumen')">
                        <i class="nav-icon ion ion-document"></i> <!-- Ganti ke document (Dokumen) -->
                        <p>Data Dokumen</p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="{{ route('logs.index') }}" class="nav-link @yield('logs')">
                        <i class="nav-icon ion ion-home"></i> <!-- Basic Ionicon -->
                        <p>Log Status</p>
                    </a>
                </li>
            @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
