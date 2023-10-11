@extends('landingPage.bases')
@section('content-lp')

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
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
                        <h6>Kegiatan Kantor Kecamatan Subang</h6>
                        <h4>Kegiatan Kebersihan</h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <div class="col-lg-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="blog-posts">
                        <div class="row">
                            @forelse ($subangActivity as $value)
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <div class="row g-0">
                                            <div class="post-item">
                                                <div class="col-md-4">
                                                    <div class="thumb">
                                                        <a href="{{ route('detail-subang-activity', $value) }}">
                                                            <img src="{{ $value->imageSubangActivity->first()->file_url }}"
                                                                alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="right-content">
                                                        <a href="{{ route('detail-subang-activity', $value) }}">
                                                            <h4>{{ $value->name }}</h4>
                                                        </a>
                                                        <p class="card-text text-justify">
                                                            {{ Str::limit($value['description'], 50) }}
                                                            <a href="{{ route('detail-subang-activity', $value) }}">
                                                                Selengkapnya ...
                                                            </a>
                                                        </p>
                                                        <p>{{ \Carbon\Carbon::parse($value->date)->translatedFormat('d F Y') }}
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="post-item">
                                        <div class="thumb">
                                            
                                        </div>
                                        <div class="right-content">
                                            
                                        </div>
                                    </div> --}}
                                </div>
                            @empty
                                <div class="col-lg-12">
                                    <div class="post-item">
                                        <div class="thumb">
                                            <a href="#">
                                                <img src="/sibersih-logo.png" alt="" width="280"
                                                    height="280"></a>
                                        </div>
                                        <div class="right-content">
                                            <p>Belum Ada Kegiatan Kebersihan</p>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                            <div class="text-center">
                                <nav class="d-inline-block">
                                    <div class="p-2">
                                        {{ $subangActivity->onEachSide(5)->links() }}
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
