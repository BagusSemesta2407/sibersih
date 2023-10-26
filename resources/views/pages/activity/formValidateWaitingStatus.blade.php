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

                        <div class="form-group">
                            <label for="readonlyInput">Titik Yang Akan Dibersihkan</label>
                            <textarea name="" id="" class="form-control">{{ $activity->describe_point_location }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="readonlyInput">Waktu Kegiatan</label>
                            <input type="text" class="form-control" id="readonlyInput" readonly="readonly"
                                value="{{ \Carbon\Carbon::parse($activity->date)->translatedFormat('d F Y') }}">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <h5>Form Konfirmasi Kegiatan</h5>
                        <form action="{{ route('operator.post-validate-waiting-status', $activity) }}"
                            enctype="multipart/form-data" class="form form-vertical" method="POST" id="form">
                            {{-- @method('PUT') --}}
                            @csrf
                            <div class="form-group">
                                <label for="disabledInput">Konfirmasi Kegiatan</label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <select name="status" id="element-option-confirm"
                                            class="form-control select2 @error('status') is-invalid @enderror">
                                            <option value="" selected="" disabled="">
                                                Konfirmasi Kegiatan
                                            </option>
                                            <option value="on progress" id="disetujui"
                                                {{ $activity->status == 'on progress' ? 'selected' : '' }}>
                                                Disetujui
                                            </option>
                                            <option value="disagree" id="ditolak"
                                                {{ $activity->status == 'disagree' ? 'selected' : '' }}>
                                                Belum Disetujui
                                            </option>
                                        </select>
                                    </div>
                                    @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" id="reason_diagree_element">
                                <label for="disabledInput">Alasan Ditolak</label>
                                <textarea class="form-control" name="disgree_reason">{{ $activity->diagree_reason }}</textarea>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-primary me-1 mb-1" id="btnSubmit">
                                    {{-- {{ $aksi }} --}}
                                    Submit
                                    <span class="spinner-border ml-2 d-none" id="loader"
                                        style="width: 1rem; height: 1rem;" role="status">
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="card">
                        <label for="first-name-vertical">Dokumentasi Lokasi</label>
                        <div class="row row-cols-1 row-cols-md-6 g-1" data-masonry='{"percentPosition": true }'>
                            @forelse ($imageActivity as $item)
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
                                    {{-- <img src="{{ asset('empty.jpg') }}" alt="" width="280" height="280"> --}}
                                    <p>Tidak ada dokumentasi lokasi</p>
                                </div>
                            @endforelse
                        </div>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#reason_diagree_element').hide();
            $('#element-option-confirm').on('change', function() {
                let selectedVal = $(this).val();

                console.log(selectedVal);
                if (selectedVal == 'disagree') {
                    $('#reason_diagree_element').show();
                } else {
                    $('#reason_diagree_element').hide();
                }
            })
        })
    </script>
@endsection
