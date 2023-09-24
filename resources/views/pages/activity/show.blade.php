@extends('layouts.base')
@section('content')

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
            integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
        </script>
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
                                value="{{ $activity->activityCategory->name }}">
                        </div>
                        <div class="form-group">
                            <label for="readonlyInput">Nama Kegiatan</label>
                            <input type="text" class="form-control" id="readonlyInput" readonly="readonly"
                                value="{{ $activity->name }}">
                        </div>

                        <div class="form-group">
                            <label for="readonlyInput">Kelurahan</label>
                            <input type="text" class="form-control" id="readonlyInput" readonly="readonly"
                                value="{{ $activity->village->name }}">
                        </div>

                        <div class="form-group">
                            <label for="readonlyInput">Alamat Lengkap</label>
                            <input type="text" class="form-control" id="readonlyInput" readonly="readonly"
                                value="{{ $activity->address_details }}">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="readonlyInput">Waktu Kegiatan</label>
                            <input type="text" class="form-control" id="readonlyInput" readonly="readonly"
                                value="{{ \Carbon\Carbon::parse($activity->date)->translatedFormat('d F Y') }}">
                        </div>

                        <div class="form-group">
                            <label for="disabledInput">Status</label>
                            <div>
                                @if ($activity->status == 'on progress')
                                    <span class="badge bg-warning">On Progress</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <label for="first-name-vertical">Dokumentasi Lokasi</label>
                        <div class="row row-cols-1 row-cols-md-6 g-1" data-masonry='{"percentPosition": true }'>
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
                                    <p>Tidak ada dokumentasi lokasi</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="card">
                        <label for="first-name-vertical">Bukti Kegiatan</label>
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
                                    {{-- <img src="{{ asset('empty.jpg') }}" alt="" width="280" height="280"> --}}
                                    <p>Tidak ada dokumentasi lokasi</p>
                                </div>
                            @endforelse
                        </div>
                        <small class="text-muted">Video</small>
                        <div class="row row-cols-1 row-cols-md-6 g-1">
                            @foreach ($imageActivityDetail as $files)
                                @if (str_contains($files, '.mp4') || str_contains($files, '.avi'))
                                    <video controls>
                                        <source src="{{ $files->file_url }}" type="video/mp4">
                                    </video>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        {{-- @foreach ($imageActivityDetail as $file)
                            <div class="row row-cols-1 row-cols-md-4 g-1 border" data-masonry='{"percentPosition": true }'>
                                @if (str_contains($file, '.jpg') || str_contains($file, '.jpeg') || str_contains($file, '.png'))
                                    <img src="{{ $file->file_url }}" alt="Preview">
                                @elseif (str_contains($file, '.mp4') || str_contains($file, '.avi'))
                                    <video controls>
                                        <source src="{{ $file->file_url }}" type="video/mp4">
                                    </video>
                                @else
                                    tidak ada
                                @endif
                            </div>
                        @endforeach --}}
                        <div class="form-group">
                            <label for="disabledInput">Deskripsi</label>
                            <textarea class="form-control" readonly>{{ $activityDetail->description }}</textarea>
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
