@extends('landingPage.bases')
@section('content-lp')

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
            integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
        </script>
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
                        <h4>{{ $activityDetail->activity->name }}</h4>
                    </div>
                </div>
                <div class="col-lg-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="blog-posts">
                        <div class="row">
                            <p class="text-dark">
                                Kategori Kegiatan : {{ $activityDetail->activity->activityCategory->name }}
                            </p>

                            <p class="text-dark">
                                Nama Kegiatan : {{ $activityDetail->activity->name }}
                            </p>

                            <p class="text-dark">
                                Tanggal Kegiatan :
                                {{ \Carbon\Carbon::parse($activityDetail->activity->date)->translatedFormat('d F Y') }}
                            </p>

                            <p class="text-dark">
                                Kelurahan Kegiatan : {{ $activityDetail->activity->village->name }}
                            </p>

                            <p class="text-dark">
                                Lokasi Lengkap Kegiatan : {{ $activityDetail->activity->address_details }}
                            </p>
                            <p class="text-dark">
                                Foto Lokasi :
                            </p>
                            <div class="card">
                                <div class="row row-cols-1 row-cols-md-4 g-1" data-masonry='{"percentPosition": true }'>
                                    @forelse ($imageActivity as $item)
                                        <div class="col">
                                            <div class="card">
                                                <a href="{{ $item->image_url }}" data-fancybox="gallery"
                                                    data-caption="{{ $item->caption }}">
                                                    <img src="{{ $item->image_url }}" class="card-img-top"
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
                            <p class="text-dark">
                                Bukti Kegiatan
                            </p>
                            <small class="text-muted">Foto</small>
                            <div class="row row-cols-1 row-cols-md-6 g-1" data-masonry='{"percentPosition": true }'>
                                @forelse ($imageActivityDetail as $file)
                                    @if (str_contains($file, '.jpg') || str_contains($file, '.jpeg') || str_contains($file, '.png'))
                                        <div class="col">
                                            <div class="card">
                                                <a href="{{ $file->file_url }}" data-fancybox="gallery"
                                                    data-caption="{{ $file->caption }}">
                                                    <img src="{{ $file->file_url }}" class="card-img-top"
                                                        alt="{{ $file->caption }}">
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <div class="col text-center">
                                        <p>Tidak ada dokumentasi lokasi</p>
                                    </div>
                                @endforelse
                            </div>
                            <small class="text-muted">Video</small>
                            <div class="row row-cols-1 row-cols-md-6 g-1">
                                @forelse ($imageActivityDetail as $files)
                                    @if (str_contains($files, '.mp4') || str_contains($files, '.avi'))
                                        <video controls>
                                            <source src="{{ $files->file_url }}" type="video/mp4">
                                        </video>
                                    @endif
                                @empty
                                    <p>Tidak ada Vidio Dokumentasi</p>
                                @endforelse
                            </div>
                            {{-- </div> --}}
                            <p class="text-dark">
                                Deskripsi :
                            </p>
                            <p class="text-dark">
                                {{ $activityDetail->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('[data-fancybox="gallery"]').fancybox();
        });
    </script>
@endsection
