@extends('landingPage.bases')
@section('content-lp')

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
            integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
        </script>

        <style>
            .card-img-top {
                width: 100%;
                height: 20vw;
                object-fit: cover;
            }

            @media (max-width: 768px) {
                .card-img-top {
                    height: 50vw;
                    /* Sesuaikan tinggi untuk tampilan mobile */
                }
            }
        </style>
    </head>
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">
                            <img src="/sibersih-logo.png" alt="" width="100" height="100">
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <div id="blog" class="blog">
        <div class="container">
            <a href="{{ route('beranda') }}" class="wow fadeInUp">
                Kembali
            </a>

            <div class="row">
                <div class="col-lg-4 offset-lg-4  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="section-heading">
                        <h6>Jadwal & Informasi</h6>
                        <h4>Informasi Kegiatan <em>SIBERSIH</em> </h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <div class="col-lg-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="blog-posts">
                        <div class="row">
                            <p class="text-dark">
                                Kategori Kegiatan : {{ $scheduleActivity->activityCategory->name }}
                            </p>

                            <p class="text-dark">
                                Nama Kegiatan : {{ $scheduleActivity->name }}
                            </p>

                            <p class="text-dark">
                                Tanggal Kegiatan :
                                {{ \Carbon\Carbon::parse($scheduleActivity->date)->translatedFormat('d F Y') }}
                            </p>

                            <p class="text-dark">
                                Kelurahan Kegiatan : {{ $scheduleActivity->village->name }}
                            </p>

                            <p class="text-dark">
                                Lokasi Lengkap Kegiatan : {{ $scheduleActivity->address_details }}
                            </p>

                            <p class="text-dark">
                                Titik Lokasi Yang Perlu Dibersihkan : {{ $scheduleActivity->describe_point_location }}
                            </p>
                            <p class="text-dark">
                                Foto Lokasi :
                            </p>
                            <div class="card">
                                <div class="row row-cols-1 row-cols-md-4 g-1" data-masonry='{"percentPosition": true }'>
                                    @forelse ($imageScheduleActivity as $item)
                                        <div class="col">
                                            <div class="card">
                                                <a href="{{ $item->image_url }}" data-fancybox="gallery"
                                                    data-caption="{{ $item->caption }}">
                                                    <img src="{{ $item->image_url }}" class="card-img-top img-fluid"
                                                        alt="{{ $item->caption }}">
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col text-center">
                                            <p>Belum Ada Data Album</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="disqus_thread"></div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('[data-fancybox="gallery"]').fancybox();
        });
    </script>
@endsection
