@extends('layouts.base')
@section('content')

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
            integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
        </script>

        <link rel="stylesheet" href="/multiple-image-vidio/multiple-image-video(MIV).css">
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.6.0/darkly/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
    </head>
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            Upload Bukti Kegiatan
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    {{-- {{ $errors }} --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Kategori Kegiatan</label>
                                            <input type="text" id="first-name-vertical"
                                                class="form-control @error('name')
                                            is-invalid
                                        @enderror"
                                                name="name" placeholder="Masukkan Nama Kategori Kegiatan"
                                                value="{{ $activity->activityCategory->name }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="first-name-vertical">Nama Kegiatan</label>
                                            <input type="text" id="first-name-vertical"
                                                class="form-control @error('name')
                                            is-invalid
                                        @enderror"
                                                name="name" placeholder="Masukkan Nama Kategori Kegiatan"
                                                value="{{ $activity->name }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="first-name-vertical">Kelurahan</label>
                                            <input type="text" id="first-name-vertical"
                                                class="form-control @error('name')
                                            is-invalid
                                        @enderror"
                                                name="name" placeholder="Masukkan Nama Kategori Kegiatan"
                                                value="{{ $activity->village->name }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name-vertical">Alamat Lengkap</label>
                                            <input type="text" id="first-name-vertical"
                                                class="form-control @error('name')
                                            is-invalid
                                        @enderror"
                                                name="name" placeholder="Masukkan Nama Kategori Kegiatan"
                                                value="{{ $activity->address_details }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="first-name-vertical">Waktu Kegiatan</label>
                                            <p>
                                                {{ \Carbon\Carbon::parse($activity->date)->translatedFormat('d F Y') }}
                                            </p>
                                        </div>

                                        <div class="form-group">
                                            <label for="first-name-vertical">Status</label>
                                            <div class="col-md-12">
                                                @if ($activity->status == 'on progress')
                                                    <span class="badge bg-warning">On Progress</span>
                                                @else
                                                    <span class="badge bg-success">Selesai</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="card">
                                            <label for="first-name-vertical">Dokumentasi Lokasi</label>
                                            <div class="row row-cols-1 row-cols-md-4 g-1"
                                                data-masonry='{"percentPosition": true }'>
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
                                                        {{-- <img src="{{ asset('empty.jpg') }}" alt="" width="280" height="280"> --}}
                                                        <p>Belum Ada Data Album</p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @if (@$activityDetail->exists)
                                <form class="form form-vertical" enctype="multipart/form-data" method="POST"
                                    action="{{ route('operator.activity-categories.update', $activityCategory) }}"
                                    id="form">
                                    @method('PUT')
                                @else
                                    <form class="form form-vertical" enctype="multipart/form-data" method="POST"
                                        action="{{ route('pengguna.post-activity', $activity) }}" id="form">
                            @endif
                            {{ csrf_field() }}
                            <h5>Form Upload Bukti Kegiatan</h5>
                            <div class="form-body">
                                <div class="row">
                                    {{-- {{ $errors }} --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Kategori Kegiatan</label>
                                            <div class="col-md-12 mb-3">
                                                <a class="cam" href="javascript:void(0)">
                                                    <span class="badge bg-primary">
                                                        <i class="bi bi-camera"></i>
                                                    </span>
                                                </a>
                                                <a class="vid" href="javascript:void(0)">
                                                    <span class="badge bg-primary">
                                                        <i class="bi bi-camera-video"></i>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="gallery">
                                                    
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-vertical">Deskripsi</label>
                                        <textarea name="description" id="description" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-outline-primary me-1 mb-1" id="btnSubmit">
                {{-- {{ $aksi }} --}}
                Upload
                <span class="spinner-border ml-2 d-none" id="loader" style="width: 1rem; height: 1rem;" role="status">
                </span>
            </button>
        </div>
        </form>
        </form>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('[data-fancybox="gallery"]').fancybox();
        });
    </script>

    <script src="/multiple-image-vidio/multiple-image-video(MIV).js"></script>
    <script type="text/javascript">
        $('.gallery').miv({
            image: '.cam',
            video: '.vid'
        });
    </script>
@endsection
