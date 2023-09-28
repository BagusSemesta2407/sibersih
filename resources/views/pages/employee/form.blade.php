@extends('layouts.base')
@section('content')
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            @if (@$employee->exists)
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
                            Data Pengguna
                        </h4>
                    </div>


                    <div class="card-content">
                        <div class="card-body">
                            @if (@$employee->exists)
                                <form class="form form-vertical" enctype="multipart/form-data" method="POST"
                                    action="{{ route('operator.employee.update', $employee) }}" id="form">
                                    @method('PUT')
                                @else
                                    <form class="form form-vertical" enctype="multipart/form-data" method="POST"
                                        action="{{ route('operator.employee.store') }}" id="form">
                            @endif
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 ">
                                        <div class="form-group">
                                            <label for="">Foto</label>
                                            <input type="file" class="form-control" name="image"
                                                placeholder="Choose image" id="image">
                                            @error('image')
                                                {{-- <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> --}}
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <small>*) Foto hanya bisa diinput dengan format JPG, JPEG, PNG</small>
                                        </div>

                                        <div class="col-md-12 mb-2 text-center border">
                                            <img id="preview-image-before-upload" src="{{ @$employee->user->image_url }}"
                                                alt="" style="max-height: 250px;">
                                        </div>


                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="form-group">
                                            <label for="">Nomor Induk</label>
                                            <input type="text"
                                                class="form-control @error('nomor_induk') is-invalid @enderror"
                                                name="nomor_induk" placeholder="Masukkan Nomor Induk"
                                                value="{{ old('nomor_induk', @$employee->user->nomor_induk) }}">
                                            @if ($errors->has('nomor_induk'))
                                                <span class="text-danger">{{ $errors->first('nomor_induk') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="">Nama</label>
                                            <input type="text"
                                                class="form-control @error('name') is-invalid
                                        @enderror"
                                                name="name" placeholder="Masukkan Nama Pengguna"
                                                value="{{ old('name', @$employee->user->name) }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="text"
                                                class="form-control @error('email')
                                            is-invalid
                                        @enderror"
                                                name="email" placeholder="Masukkan Email"
                                                value="{{ old('email', @$employee->user->email) }}">
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
                                        <div class="form-group">
                                            <label for="name" class="col-sm-3 col-form-label">
                                                Kelurahan <sup class="text-danger">*</sup>
                                            </label>

                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <select name="village_id"
                                                        class="form-control select2 @error('village_id') is-invalid @enderror">
                                                        <option value="" selected="" disabled="">
                                                            Kelurahan
                                                        </option>

                                                        @foreach ($village as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ old('village_id', @$employee->village_id) == $item->id ? 'selected' : '' }}>
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
                                            <label for="">Whatsapp</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">+62</span>
                                                <input type="text"
                                                    class="form-control @error('no_telp')
                                                    is-invalid
                                                @enderror"
                                                    placeholder="Masukkan Nomor Whatapp" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="no_telp"
                                                    value="{{ old('no_telp', @$employee->no_telp) }}">
                                            </div>
                                            @if ($errors->has('no_telp'))
                                                <span class="text-danger">{{ $errors->first('no_telp') }}</span>
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
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}

    <script type="text/javascript">
        $(document).ready(function(e) {
            $('#image').change(function() {
                let file = this.files[0];
                let fileType = file.type.toLowerCase();
                let allowedExtensions = ["image/jpg", "image/jpeg", "image/png"];

                if (allowedExtensions.indexOf(fileType) === -1) {
                    alert("Format Image tidak Valid");
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
