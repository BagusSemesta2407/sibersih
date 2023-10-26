@extends('layouts.base')
@section('content')

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
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Detail Data Kegiatan</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="readonlyInput">Kategori Kegiatan</label>
                            <input type="text" class="form-control" id="readonlyInput" readonly="readonly"
                                value="{{ $subangActivity->activityCategory->name }}">
                        </div>
                        <div class="form-group">
                            <label for="readonlyInput">Nama Kegiatan</label>
                            <input type="text" class="form-control" id="readonlyInput" readonly="readonly"
                                value="{{ $subangActivity->name }}">
                        </div>

                        <div class="form-group">
                            <label for="readonlyInput">Alamat Lengkap</label>
                            <input type="text" class="form-control" id="readonlyInput" readonly="readonly"
                                value="{{ $subangActivity->address_details }}">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="readonlyInput">Waktu Kegiatan</label>
                            <input type="text" class="form-control" id="readonlyInput" readonly="readonly"
                                value="{{ \Carbon\Carbon::parse($subangActivity->date)->translatedFormat('d F Y') }}">
                        </div>
                    </div>

                    <div class="card">
                        <label for="first-name-vertical">Dokumentasi Lokasi</label>
                        <div class="row row-cols-1 row-cols-md-6 g-1" data-masonry='{"percentPosition": true }'>
                            @forelse ($subangActivity->imageSubangActivity as $item)
                                <div class="col">
                                    <div class="card">
                                        <a href="{{ $item->file_url }}" data-fancybox="gallery"
                                            data-caption="{{ $item->caption }}">
                                            <img src="{{ $item->file_url }}" class="card-img-top"
                                                alt="{{ $item->caption }}">
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="col text-center">
                                    {{-- <img src="{{ asset('empty.jpg') }}" alt="" width="280" height="280"> --}}
                                    <p>Tidak ada dokumentasi lokasi</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('[data-fancybox="gallery"]').fancybox();
        });
    </script>
@endsection
