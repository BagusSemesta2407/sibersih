@extends('layouts.base')
@section('content')

    <head>
        <link type="text/css" rel="stylesheet" href="/multiple-image/dist/image-uploader.min.css">
        <style>

        </style>
    </head>
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            @if (@$activity->exists)
                                Edit
                                @php
                                    $aksi = 'Edit';
                                @endphp
                            @else
                                Tambah
                                @php
                                    $aksi = 'Tambah';
                                @endphp
                            @endif
                            Data Kegiatan
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @if (@$activity->exists)
                                <form class="form form-vertical" enctype="multipart/form-data" method="POST"
                                    action="{{ route('operator.activities.update', $activity) }}" id="form">
                                    @method('PUT')
                                @else
                                    <form class="form form-vertical" enctype="multipart/form-data" method="POST"
                                        action="{{ route('operator.activities.store') }}" id="form">
                            @endif
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="row">
                                    {{-- {{ $errors }} --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-3 col-form-label">
                                                Kategori Kegiatan <sup class="text-danger">*</sup>
                                            </label>

                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <select name="activity_category_id"
                                                        class="form-control select2 @error('activity_category_id') is-invalid @enderror">
                                                        <option value="" selected="" disabled="">
                                                            Kategori Kegiatan
                                                        </option>

                                                        @foreach ($activityCategory as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ old('activity_category_id', @$activity->activity_category_id) == $item->id ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if ($errors->has('activity_category_id'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('activity_category_id') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-3 col-form-label">
                                                Kelurahan <sup class="text-danger">*</sup>
                                            </label>

                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <select name="village_id"
                                                        class="form-control select2 @error('village_id') is-invalid @enderror">
                                                        <option value="" selected="" disabled="">
                                                           Pilih Kelurahan
                                                        </option>

                                                        @foreach ($village as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ old('village_id', @$activity->village_id) == $item->id ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if ($errors->has('village_id'))
                                                    <span class="text-danger">{{ $errors->first('village_id') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="first-name-vertical">Tanggal Kegiatan</label>
                                            <input type="date" id="date-activity"
                                                class="form-control @error('date')
                                            is-invalid
                                        @enderror"
                                                name="date" placeholder="Masukkan Nomor Induk"
                                                value="{{ old('date', @$activity->date) }}">
                                            @if ($errors->has('date'))
                                                <span class="text-danger">{{ $errors->first('date') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="first-name-vertical">Nama Kegiatan</label>
                                            <input type="text" id="first-name-vertical"
                                                class="form-control @error('name')
                                            is-invalid
                                        @enderror"
                                                name="name" placeholder="Masukkan Nomor Induk"
                                                value="{{ old('name', @$activity->name) }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="first-name-vertical">Lokasi Lengkap Kegiatan</label>
                                            <textarea name="address_details" class="form-control @error('address_details')
                                                is-invalid
                                            @enderror">{{ @$activity->address_details }}</textarea>
                                            @if ($errors->has('address_details'))
                                                <span class="text-danger">{{ $errors->first('address_details') }}</span>
                                            @endif
                                        </div>

                                        {{-- <div class='wrapper'>
                                            <div class="upload">
                                                <div class="upload-wrapper">
                                                    <div class="upload-img">
                                                        <!-- image here -->
                                                    </div>
                                                    <div class="upload-info">
                                                        <p>
                                                            <span class="upload-info-value">0</span> file(s) uploaded.
                                                        </p>
                                                    </div>
                                                    <div class="upload-area">
                                                        <div class="upload-area-img">
                                                            <img src="/upload.png" alt="">
                                                        </div>
                                                        <p class="upload-area-text">Select images or <span>browse</span>.
                                                        </p>
                                                    </div>
                                                    <input type="file" class="visually-hidden" id="upload-input"
                                                        multiple>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="input-field">
                                            <label class="active">Poto Lokasi</label>
                                            <div class="input-images-2" style="padding-top: .5rem;">
                                                
                                            </div>
                                            <small>*) Klik kolom yang sudah disediakan untuk menambahkan gambar.</small>
                                        </div>
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
                {{ $aksi }}
                <span class="spinner-border ml-2 d-none" id="loader" style="width: 1rem; height: 1rem;" role="status">
                </span>
            </button>
        </div>
        </form>
        </form>
    </section>
@endsection

@section('script')
    <script type="text/javascript" src="/multiple-image/dist/image-uploader.min.js"></script>
    {{-- <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script> --}}
    <script>
        let images =@json(@$imageActivity);
        let imageArray=[];

        for (image in images) {
            imageArray.push({
                id : image,
                src : images[image]                
            })
        }

        // Inisialisasi imageUploader dengan gambar yang sudah ada
        $('.input-images-2').imageUploader({
            imagesInputName: 'image',
            preloadedInputName: 'old',
            maxSize: 2 * 1024 * 1024,
            maxFiles: 10,
            preloaded: imageArray // Menggunakan data gambar yang sudah ada
        });
    </script>
    
    <script>
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#date-activity').attr('min', today);
    </script>
@endsection
