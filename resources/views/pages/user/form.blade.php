@extends('layouts.base')
@section('content')
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            @if (@$user->exists)
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
                            Data Operator
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @if (@$user->exists)
                                <form class="form form-vertical" enctype="multipart/form-data" method="POST"
                                    action="{{ route('operator.user.update', $user) }}" id="form">
                                    @method('PUT')
                                @else
                                    <form class="form form-vertical" enctype="multipart/form-data" method="POST"
                                        action="{{ route('operator.user.store') }}" id="form">
                            @endif
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="row">
                                    {{-- {{ $errors }} --}}
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label for="">Foto</label>
                                            <input type="file" class="form-control" name="image"
                                                placeholder="Choose image" id="image">
                                            @error('image')
                                                {{-- <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> --}}
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-2 text-center border">
                                            <img id="preview-image-before-upload" src="{{ @$user->image_url }}"
                                                alt="" style="max-height: 250px;">
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Nomor Induk</label>
                                            <input type="text" id="nomor_induk"
                                                class="form-control @error('nomor_induk')
                                            is-invalid
                                        @enderror"
                                                name="nomor_induk" placeholder="Masukkan Nomor Induk"
                                                value="{{ old('nomor_induk', @$user->nomor_induk) }}">
                                            @if ($errors->has('nomor_induk'))
                                                <span class="text-danger">{{ $errors->first('nomor_induk') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name-vertical">Nama</label>
                                            <input type="text" id="name"
                                                class="form-control @error('name')
                                            is-invalid
                                        @enderror"
                                                name="name" placeholder="Masukkan Nama"
                                                value="{{ old('name', @$user->name) }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="first-name-vertical">Email</label>
                                            <input type="text" id="email"
                                                class="form-control @error('email')
                                            is-invalid
                                        @enderror"
                                                name="email" placeholder="Masukkan Email"
                                                value="{{ old('email', @$user->email) }}">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input type="password"
                                                class="form-control @error('password')
                                            is-invalid
                                        @enderror"
                                                name="password" autocomplete="on">
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
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
    <script type="text/javascript">
        $(document).ready(function(e) {
            $('#image').change(function() {
                let file = this.files[0];
                let fileType = file.type.toLowerCase();
                let allowedExtensions = ["image/jpg", "image/jpeg", "image/png"];

                if (allowedExtensions.indexOf(fileType) === -1) {
                    alert("Hanya file JPG, JPEG, PNG yang diperbolehkan.");
                    $('#image').val(''); // Mengosongkan input file
                    return false;
                }

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(file);

            });

        });
    </script>
@endsection
