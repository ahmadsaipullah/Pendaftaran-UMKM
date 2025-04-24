<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile UMKM Sepatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    @include('includes.style');
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
            background-color: #f7f7f7;
        }
        .hero {
            background: linear-gradient(to bottom, rgba(255, 182, 193, 0.8), rgba(255, 99, 71, 0.8)), url('{{ asset('assets/img/hero.jpg') }}') no-repeat center center; background-size: cover;"
            background-size: cover;
            height: 100vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
        }
        .hero .content {
            position: relative;
            z-index: 1;
            max-width: 80%;
            margin: 0 auto;
        }
        .hero h1 {
            font-size: 4rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }
        .hero p {
            font-size: 1.5rem;
            font-weight: 600;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }
        .nav-link {
            font-weight: 500;
            text-transform: uppercase;
        }
        .nav-link:hover {
            color: #ff6347;
            transition: 0.3s;
        }
        .section-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: #2a2a2a;
        }
        .card:hover {
            transform: translateY(-5px);
            transition: 0.3s;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .btn-primary-custom {
            background-color: #ff6347;
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 25px;
            font-size: 1.1rem;
            border-radius: 5px;
            text-transform: uppercase;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .btn-primary-custom:hover {
            background-color: #ff4500;
        }
        .card-body p {
            font-size: 1.1rem;
            color: #555;
        }
        .section-title {
            color: #007bff;
        }
        .bg-light {
            background-color: #f8f9fa !important;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 15px 0;
        }
        .footer a {
            color: #ffc107;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .transition-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 15px;
}

.transition-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.btn-primary-custom {
    background-color: #ff6b6b;
    color: white;
    padding: 8px 16px;
    border-radius: 8px;
    text-decoration: none;
    display: inline-block;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.btn-primary-custom:hover {
    background-color: #e04b4b;
    color: white;
}
#about img {
    max-height: 400px;
    object-fit: cover;
}
.gallery-img {
    transition: transform 0.3s ease;
}
.gallery-img:hover {
    transform: scale(1.05);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
}
.navbar .nav-link {
    font-weight: 500;
    transition: all 0.2s ease-in-out;
}
.navbar .nav-link:hover {
    color: #FFD700 !important;
}

    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm fixed-top py-3">
    <div class="container">
        <!-- Logo & Brand -->
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{route('/')}}">
            <img src="{{ asset('assets/img/logoft.png') }}" alt="Logo UMKM Sepatan" class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
            <span class="d-none d-md-inline">UMKM Sepatan</span>
        </a>

        <!-- Toggle Button -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Nav Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#about"><i class="fas fa-info-circle me-1"></i> Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#services"><i class="fas fa-cogs me-1"></i> Layanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#gallery"><i class="fas fa-image me-1"></i> Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#contact"><i class="fas fa-phone-alt me-1"></i> Kontak</a>
                </li>

                @guest
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm px-3" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-light btn-sm px-3">
                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>



<!-- Hero Section -->
<section class="hero">
    <div class="content text-white text-center animate__animated animate__fadeIn">
        <h1 class="animate__animated animate__fadeInDown">UMKM Sepatan Kabupaten Tangerang</h1>
        <p class="lead animate__animated animate__fadeInUp">Pusat Informasi dan Pelayanan Izin Usaha Mikro dan Kecil</p>
    </div>
</section>

<!-- Tentang Kami -->
<section id="about" class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <!-- Gambar atau ilustrasi -->
            <div class="col-md-6 mb-4 mb-md-0 animate__animated animate__fadeInLeft">
                <img src="{{ asset('assets/img/tentang.jpg') }}" alt="Tentang UMKM" class="img-fluid rounded shadow">
            </div>
            <!-- Teks Tentang Kami -->
            <div class="col-md-6 text-md-start text-center animate__animated animate__fadeInRight">
                <h2 class="fw-bold text-primary mb-4">Tentang Kami</h2>
                <p class="lead text-muted mb-3">
                    <strong>UMKM Sepatan Tangerang</strong> hadir sebagai mitra strategis bagi pelaku usaha kecil dan menengah di wilayah Sepatan dan sekitarnya.
                </p>
                <p class="text-muted">
                    Kami membantu pelaku UMKM dalam pengurusan <strong>perizinan usaha</strong>, memberikan <strong>akses informasi</strong> untuk pengembangan bisnis, dan menyediakan <strong>pendampingan profesional</strong> agar usaha mereka semakin maju, mandiri, dan berdaya saing tinggi.
                </p>
                <a href="#umkm" class="btn btn-primary mt-3 px-4 py-2 rounded-pill"><i class="fas fa-briefcase"></i> Jelajahi UMKM</a>
            </div>
        </div>
    </div>
</section>

<!-- Layanan Kami -->
<section id="services" class="bg-white py-5">
    <div class="container">
        <h2 class="section-title text-center text-primary fw-bold mb-5 animate__animated animate__fadeInDown">Layanan Kami</h2>
        <div class="row g-4">
            <!-- Konsultasi UMKM -->
            <div class="col-md-4 animate__animated animate__fadeInLeft">
                <div class="card border-0 shadow h-100 p-3 hover-shadow">
                    <img src="{{ asset('assets/img/konsultasi.jpg') }}" class="card-img-top rounded mb-3" alt="Konsultasi UMKM">
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-2">Konsultasi UMKM</h5>
                        <p class="text-muted">Bimbingan pengembangan usaha dari ide hingga strategi bisnis yang berkelanjutan.</p>
                    </div>
                </div>
            </div>
            <!-- Pengurusan Izin Usaha -->
            <div class="col-md-4 animate__animated animate__fadeInUp">
                <div class="card border-0 shadow h-100 p-3 hover-shadow">
                    <img src="{{ asset('assets/img/pengurusan.jpeg') }}" class="card-img-top rounded mb-3" alt="Izin Usaha">
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-2">Pengurusan Izin Usaha</h5>
                        <p class="text-muted">Membantu pelaku UMKM mendapatkan legalitas seperti NIB, SIUP, dan lainnya dengan mudah.</p>
                    </div>
                </div>
            </div>
            <!-- Pendampingan Digital -->
            <div class="col-md-4 animate__animated animate__fadeInRight">
                <div class="card border-0 shadow h-100 p-3 hover-shadow">
                    <img src="{{ asset('assets/img/digital.jpg') }}" class="card-img-top rounded mb-3" alt="Digital Marketing">
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-2">Pendampingan Digital</h5>
                        <p class="text-muted">Transformasi digital melalui pelatihan, branding, dan pemasaran online.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Daftar UMKM -->
<section id="umkm" class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center text-primary fw-bold mb-5 animate__animated animate__fadeInDown">Daftar UMKM</h2>
        <div class="row g-4">
            @foreach ($umkms as $umkm)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow transition-card">
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-dark mb-3"><i class="fas fa-store text-primary me-2"></i>{{ $umkm->nama_umkm }}</h5>
                            <ul class="list-unstyled text-muted small">
                                <li><i class="fas fa-briefcase me-2 text-secondary"></i><strong>Jenis:</strong> {{ $umkm->jenis_usaha }}</li>
                                <li><i class="fas fa-map-marker-alt me-2 text-secondary"></i><strong>Alamat:</strong> {{ $umkm->alamat_umkm }}</li>
                                <li><i class="fas fa-map-pin me-2 text-secondary"></i><strong>Kelurahan:</strong> {{ $umkm->kelurahan }}</li>
                                <li><i class="fas fa-map me-2 text-secondary"></i><strong>Kecamatan:</strong> {{ $umkm->kecamatan }}</li>
                                <li><i class="fas fa-city me-2 text-secondary"></i><strong>Kabupaten:</strong> {{ $umkm->kabupaten }}</li>
                                <li><i class="fas fa-flag me-2 text-secondary"></i><strong>Provinsi:</strong> {{ $umkm->provinsi }}</li>
                            </ul>
                            <div class="d-grid gap-2 mt-4">
                                <!-- Button to trigger modal -->
                                <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#umkmModal{{ $umkm->id }}"><i class="fas fa-eye me-1"></i> Lihat Detail</a>
                                <a href="{{route('userpermohonan.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-edit me-1"></i> Daftar UMKM</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@foreach ($umkms as $umkm)
<div class="modal fade" id="umkmModal{{ $umkm->id }}" tabindex="-1" aria-labelledby="umkmModalLabel{{ $umkm->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header" style="background: linear-gradient(45deg, #007bff, #6610f2); color: white;">
                <h5 class="modal-title" id="umkmModalLabel{{ $umkm->id }}"><i class="fas fa-store me-2"></i> Detail UMKM: {{ $umkm->nama_umkm }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6 class="fw-bold text-primary">Informasi UMKM</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-briefcase me-2 text-warning"></i><strong>Jenis Usaha:</strong> {{ $umkm->jenis_usaha }}</li>
                            <li><i class="fas fa-map-marker-alt me-2 text-success"></i><strong>Alamat:</strong> {{ $umkm->alamat_umkm }}</li>
                            <li><i class="fas fa-map-pin me-2 text-info"></i><strong>Kelurahan:</strong> {{ $umkm->kelurahan }}</li>
                            <li><i class="fas fa-map me-2 text-danger"></i><strong>Kecamatan:</strong> {{ $umkm->kecamatan }}</li>
                            <li><i class="fas fa-city me-2 text-primary"></i><strong>Kabupaten:</strong> {{ $umkm->kabupaten }}</li>
                            <li><i class="fas fa-flag me-2 text-secondary"></i><strong>Provinsi:</strong> {{ $umkm->provinsi }}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">Kontak & Deskripsi</h6>
                        <p><strong>Deskripsi:</strong> UMKM ini bergerak di bidang makanan dengan berbagai produk olahan yang dapat memuaskan selera masyarakat. Kami fokus pada kualitas bahan baku dan pelayanan pelanggan yang ramah dan profesional.</p>
                        <p><strong>Kontak:</strong>
                            <ul>
                                <li><i class="fas fa-phone me-2"></i> Telepon: (021) 12345678</li>
                                <li><i class="fas fa-envelope me-2"></i> Email: info@umkm.com</li>
                                <li><i class="fas fa-globe me-2"></i> Website: www.umkm.com</li>
                            </ul>
                        </p>
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach





<!-- Galeri -->

<section id="gallery" class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center animate__animated animate__fadeInDown text-primary fw-bold mb-5">Galeri Kegiatan</h2>
        <div class="row g-4">
            <div class="col-md-4 animate__animated animate__zoomIn">
                <img src="{{ asset('assets/img/kegiatan1.jpg') }}" class="img-fluid rounded shadow-sm w-100" alt="Galeri 1">
            </div>
            <div class="col-md-4 animate__animated animate__zoomIn">
                <img src="{{ asset('assets/img/kegiatan2.jpg') }}" class="img-fluid rounded shadow-sm w-100" alt="Galeri 2">
            </div>
            <div class="col-md-4 animate__animated animate__zoomIn">
                <img src="{{ asset('assets/img/kegiatan3.jpeg') }}" class="img-fluid rounded shadow-sm w-100" alt="Galeri 3">
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4 animate__animated animate__zoomIn">
                <img src="{{ asset('assets/img/kegiatan4.jpg') }}" class="img-fluid rounded shadow-sm w-100" alt="Galeri 1">
            </div>
            <div class="col-md-4 animate__animated animate__zoomIn">
                <img src="{{ asset('assets/img/kegiatan5.jpg') }}" class="img-fluid rounded shadow-sm w-100" alt="Galeri 2">
            </div>
            <div class="col-md-4 animate__animated animate__zoomIn">
                <img src="{{ asset('assets/img/kegiatan6.jpg') }}" class="img-fluid rounded shadow-sm w-100" alt="Galeri 3">
            </div>
        </div>
    </div>
</section>




<!-- Kontak -->
<section id="contact" class="bg-dark text-white py-5">
    <div class="container">
        <h2 class="section-title text-center animate__animated animate__fadeInDown mb-4">Hubungi Kami</h2>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <p><i class="fas fa-envelope me-2 text-warning"></i>Email: <a href="mailto:umkmsepatan@tangerangkab.go.id" class="text-warning text-decoration-none">umkmsepatan@tangerangkab.go.id</a></p>
                <p><i class="fas fa-phone me-2 text-warning"></i>Telp: (021) 1234567</p>
                <p><i class="fas fa-map-marker-alt me-2 text-warning"></i>Alamat: Kantor Kecamatan Sepatan, Jl. Raya Mauk KM.10, Kabupaten Tangerang</p>
            </div>
        </div>
    </div>
</section>


<!-- Footer -->
<footer class="footer text-center py-3 bg-dark border-top mt-0">
    <small class=" d-block">&copy; 2025 UMKM Sepatan. All Rights Reserved.</small>
    <small class="">Designed with ❤️ by <a href="#" class="text-decoration-none text-primary fw-semibold">Ilham</a></small>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
