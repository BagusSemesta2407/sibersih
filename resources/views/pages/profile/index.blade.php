@extends('layouts.base')
@section('content')
    @if (Auth::user()->getRoleNames()[0] == 'operator')
        <section id="basic-vertical-layouts">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Profile
                            </h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{ route('operator.update-profile', $user) }}" class="form form-vertical"
                                    enctype="multipart/form-data" method="POST">
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
                                                    <label for="first-name-vertical">Username</label>
                                                    <input type="text" id="username"
                                                        class="form-control @error('username')
                                        is-invalid
                                    @enderror"
                                                        name="username" placeholder="Masukkan Nomor Induk"
                                                        value="{{ old('username', @$user->username) }}">
                                                    @if ($errors->has('username'))
                                                        <span class="text-danger">{{ $errors->first('username') }}</span>
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
                    Update
                    <span class="spinner-border ml-2 d-none" id="loader" style="width: 1rem; height: 1rem;"
                        role="status">
                    </span>
                </button>
            </div>
            </form>

            {{-- </form>
    </form> --}}
        </section>
    @else
        <section id="basic-vertical-layouts">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Profile
                            </h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{ route('pengguna.update-profile', $user) }}" class="form form-vertical"
                                    enctype="multipart/form-data" method="POST">
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
                                                        <span
                                                            class="text-danger">{{ $errors->first('nomor_induk') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label for="first-name-vertical">Username</label>
                                                    <input type="text" id="username"
                                                        class="form-control @error('username')
                                        is-invalid
                                    @enderror"
                                                        name="username" placeholder="Masukkan Nomor Induk"
                                                        value="{{ old('username', @$user->username) }}">
                                                    @if ($errors->has('username'))
                                                        <span class="text-danger">{{ $errors->first('username') }}</span>
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
                    Update
                    <span class="spinner-border ml-2 d-none" id="loader" style="width: 1rem; height: 1rem;"
                        role="status">
                    </span>
                </button>
            </div>
            </form>

            {{-- </form>
    </form> --}}
        </section>
    @endif
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
