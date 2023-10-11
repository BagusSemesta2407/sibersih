@extends('landingPage.bases')

@section('content-lp')

    <head>
        <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">

        <style>
            /* Gaya CSS untuk latar belakang hijau */
            .green-background {
                background-color: rgb(69, 238, 69);
                color: white;
                animation: fadeInUp 0.5s ease-in-out;
                /* Animasi untuk peringkat 1 dan 2 */
            }

            /* Gaya CSS untuk latar belakang merah */
            .red-background {
                background-color: rgb(240, 82, 82);
                color: white;
                animation: fadeInUp 0.5s ease-in-out;
                /* Animasi untuk peringkat 2 terbawah */
            }

            /* Gaya CSS untuk latar belakang kuning */
            .yellow-background {
                background-color: rgb(230, 230, 76);
                animation: fadeInUp 0.5s ease-in-out;
                /* Animasi untuk peringkat 3 hingga 6 */
            }

            /* Animasi CSS */
            @keyframes fadeInUp {
                0% {
                    opacity: 0;
                    transform: translateY(20px);
                }

                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    </head>
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">
                            <img src="/sibersih-logo.png" alt="" width="100" height="100">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#about">Tentang</a></li>
                            <li class="scroll-to-section"><a href="#services">Jadwal & Informasi</a></li>
                            <li class="scroll-to-section"><a href="#portfolio">Dokumentasi</a></li>
                            <li class="scroll-to-section"><a href="#blog">Kegiatan Terbaru</a></li>
                            <li class="scroll-to-section">
                                @if (Route::has('login'))
                                    @auth
                                        <a href="/home">
                                            Dashboard
                                        </a>
                                    @else
                                        <a href="/login">
                                            Login
                                        </a>
                                    @endauth
                                @endif
                            </li>
                            <li class="scroll-to-section">
                            </li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 align-self-center">
                            <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s"
                                data-wow-delay="1s">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h6>Platform Informasi Kegiatan Kebersihan</h6>
                                        <h2>SIBERSIH</h2>
                                        <small>SISTEM INFORMARSI KEBERSIHAN KECAMATAN SUBANG</small>
                                        <p>Bersama Menuju Kecamatan Subang yang Bersih, dan Indah</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="border-first-button scroll-to-section">
                                            <a href="#about">Selengkapnya ..</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                                <img src="/kecamatan-subang.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about" class="about section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="about-left-image  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                                <img src="/sibersih-logo.png" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6 align-self-center  wow fadeInRight" data-wow-duration="1s"
                            data-wow-delay="0.5s">
                            <div class="about-right-content">
                                <div class="section-heading">
                                    <h6>Tentang</h6>
                                    <h4>SIBERSIH</h4>
                                    <div class="line-dec"></div>
                                </div>
                                <p>SIBERSIH adalah akronim dari Sistem Informasi Kebersihan Kecamatan Subang, sebuah
                                    platform yang menyajikan informasi mengenai aktivitas pemeliharaan kebersihan di
                                    Kecamatan Subang, bertujuan untuk mewujudkan lingkungan Kecamatan Subang yang bersih dan
                                    indah.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="subang" class="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="section-heading">
                        <h6>Kegiatan Terbaru</h6>
                        <h4>Kegiatan Kebersihan</h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="blog-post">
                        <div class="down-content">
                            <div id="carouselExample" class="carousel slide">
                                <div class="carousel-inner">
                                    @foreach ($imageSubangActivity as $key => $imgSubang)
                                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                            <img src="{{ $imgSubang->file_url }}" class="d-block w-100" alt="...">
                                        </div>
                                    @endforeach
                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="blog-posts">
                        <div class="row">
                            @forelse ($subangActivity as $value)
                                <div class="col-lg-12">
                                    <div class="post-item">
                                        <div class="thumb">
                                            <a href="#">
                                                <img src="{{ $value->imageSubangActivity->first()->file_url }}"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="right-content">
                                            <a href="#">
                                                <h4>{{ $value->name }}</h4>
                                            </a>
                                            <p>
                                                {{ Str::limit($value['description'], 50) }}
                                                <a href="{{ route('detail-subang-activity', $value) }}">
                                                    Selengkapnya ...
                                                </a>
                                            </p>
                                            <br>
                                            <p>{{ \Carbon\Carbon::parse($value->date)->translatedFormat('d F Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-lg-12">
                                    <div class="post-item">
                                        <div class="thumb">
                                            <a href="#">
                                                <img src="/sibersih-logo.png" alt="" width="280"
                                                    height="280">
                                            </a>
                                        </div>
                                        <div class="right-content">
                                            <p>Belum Ada Kegiatan Kebersihan</p>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                            <div class="col-lg-12">
                                <div class="border-first-button scroll-to-section float-end">
                                    <a href="{{ route('subang-activity') }}">Kegiatan Lebih Lengkap .. </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="services" class="services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
                        <h6>Jadwal dan Informasi</h6>
                        <h4>Jadwal Kegiatan <em>SIBERSIH</em></h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="naccs">
                        <div class="grid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="nacc">
                                        <li class="active">
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-md-12 align-self-center">
                                                            <div class="left-text">
                                                                <h4>Jadwal Kegiatan SIBERSIH</h4>
                                                                <table class="table" id="table1">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>No</th>
                                                                            <th>Tanggal Kegiatan</th>
                                                                            <th>Lokasi Kegiatan</th>
                                                                            <th>Titik Lokasi Yang Perlu Dibersihkan</th>
                                                                            <th>Aksi</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @forelse ($scheduleActivity as $item)
                                                                            <tr>
                                                                                <td>{{ $loop->iteration }}</td>
                                                                                <td>
                                                                                    {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}
                                                                                </td>
                                                                                <td>
                                                                                    {{ $item->village->name }},
                                                                                    {{ $item->address_details }}
                                                                                </td>
                                                                                <td>
                                                                                    {{ $item->describe_point_location }}
                                                                                </td>
                                                                                <td>
                                                                                    <a
                                                                                        href="{{ route('schedule-information-detail', $item->id) }}">Detail</a>
                                                                                </td>
                                                                            </tr>
                                                                        @empty
                                                                            <tr>
                                                                                <td colspan="5" class="text-center">
                                                                                    Belum Ada Jadwal Kegiatan</td>
                                                                            </tr>
                                                                        @endforelse
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="portfolio" class="our-portfolio section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-heading wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
                        <h6>Kegiatan Kami</h6>
                        <h4>Dokumentasi Kegiatan</h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid wow fadeIn" data-wow-duration="1s" data-wow-delay="0.7s">
            <div class="row">
                <div class="col-lg-12">
                    <div class="loop owl-carousel">
                        @forelse ($imageAcitvityDetail as $item)
                            @if (str_contains($item, '.jpg') || str_contains($item, '.jpeg') || str_contains($item, '.png'))
                                <div class="item">
                                    {{-- <a href="#"> --}}
                                    <div class="portfolio-item">
                                        <div class="thumb">
                                            <img src="{{ $item->file_url }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="item">
                                <div class="portfolio-item">
                                    <div class="thumb">
                                        <img src="/sibersih-logo.png" alt="">
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="blog" class="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="section-heading">
                        <h6>Kegiatan Terbaru</h6>
                        <h4>Kegiatan Kebersihan</h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="blog-post">
                        <div class="down-content">
                            <h5>Informasi Kelurahan Teladan</h5>
                            <br>
                            <table class="table bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Kelurahan</th>
                                        <th class="text-center">Jumlah Kegiatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($rankCountVillages as $dataCount)
                                        @php
                                            $rankClass = '';
                                            if ($loop->iteration <= 2) {
                                                $rankClass = 'green-background'; // Peringkat 1 dan 2 diberi warna hijau
                                            } elseif ($loop->iteration >= count($rankCountVillages) - 1) {
                                                $rankClass = 'red-background'; // Peringkat 2 terbawah diberi warna merah
                                            } elseif ($loop->iteration >= 3 && $loop->iteration <= 6) {
                                                $rankClass = 'yellow-background'; // Peringkat 3 hingga 6 diberi warna kuning
                                            }
                                        @endphp
                                        <tr class="{{ $rankClass }}">
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $dataCount->name }}</td>
                                            <td class="text-center">{{ $dataCount->activity_count }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Tidak Ada Aktivitas</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="blog-posts">
                        <div class="row">
                            @forelse ($activityDetail as $value)
                                <div class="col-lg-12">
                                    <div class="post-item">
                                        <div class="thumb">
                                            <a href="#">
                                                @if (str_contains($value->imageActivityDetail, '.jpg') ||
                                                        str_contains($value->imageActivityDetail, '.jpeg') ||
                                                        str_contains($value->imageActivityDetail, '.png'))
                                                    <img src="{{ $value->imageActivityDetail->first()->file_url }}"
                                                        alt="">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="right-content">
                                            <a href="#">
                                                <h4>{{ $value->activity->name }}</h4>
                                            </a>
                                            <p>
                                                {{ Str::limit($value['description'], 50) }}
                                                <a href="{{ route('detail-activity', $value) }}">
                                                    Selengkapnya ...
                                                </a>
                                            </p>
                                            <br>
                                            <p>{{ \Carbon\Carbon::parse($value->date)->translatedFormat('d F Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-lg-12">
                                    <div class="post-item">
                                        <div class="thumb">
                                            <a href="#">
                                                <img src="/sibersih-logo.png" alt="" width="280"
                                                    height="280">
                                            </a>
                                        </div>
                                        <div class="right-content">
                                            <p>Belum Ada Kegiatan Kebersihan</p>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                            <div class="col-lg-12">
                                <div class="border-first-button scroll-to-section float-end">
                                    <a href="{{ route('index-activity') }}">Kegiatan Lebih Lengkap .. </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script>
        if ($('#table1').length) {
            // Simple Datatable
            let table1 = document.querySelector('#table1');
            let dataTable = new simpleDatatables.DataTable(table1);
        }
    </script>
@endsection
