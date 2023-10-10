@extends('layouts.base')
@section('content')

    <head>
        <style>
            #files-area {
                width: 30%;
                /* margin: 0 auto; */
            }

            .file-block {
                border-radius: 10px;
                background-color: rgba(144, 163, 203, 0.2);
                margin: 5px;
                color: initial;
                display: inline-flex;

                &>span.name {
                    padding-right: 10px;
                    width: max-content;
                    display: inline-flex;
                }
            }

            .file-delete {
                display: flex;
                width: 24px;
                color: initial;
                background-color: #6eb4ff00;
                font-size: large;
                justify-content: center;
                margin-right: 3px;
                cursor: pointer;

                &:hover {
                    background-color: rgba(144, 163, 203, 0.2);
                    border-radius: 10px;
                }

                &>span {
                    transform: rotate(45deg);
                }
            }
        </style>
    </head>

    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Edit Data Kegiatan
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('operator.subang-sub-district-activity.update', $subangActivity) }}"
                                method="POST" enctype="multipart/form-data" class="form form-vertical" id="form">
                                @method('PUT')
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">
                                                    Kategori Kegiatan
                                                </label>

                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <select name="activity_category_id" id="activity_category_id"
                                                            class="form-control select2 @error('activity_category_id')
                                                        is-invalid
                                                    @enderror">
                                                            <option value="" selected disabled>
                                                                Kategori Kegiatan
                                                            </option>

                                                            @foreach ($activityCategory as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ old('activity_category_id', @$subangActivity->activity_category_id) == $item->id ? 'selected' : '' }}>
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
                                                <label for="">Tanggal Kegiatan</label>

                                                <input type="date" name="date" id="date"
                                                    class="form-control @error('date')
                                                    is-invalid
                                                @enderror"
                                                    value="{{ old('date', $subangActivity->date) }}">

                                                @if ($errors->has('date'))
                                                    <span class="text-danger">{{ $errors->first('date') }}</span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="">Nama Kegiatan</label>

                                                <input type="text" name="name" id="name"
                                                    placeholder="Masukan Nama Kegiatan"
                                                    class="form-control @error('name')
                                                    is-invalid
                                                @enderror"
                                                    value="{{ old('name', $subangActivity->name) }}">

                                                @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="first-name-vertical">Lokasi Lengkap Kegiatan</label>
                                                <textarea name="address_details"
                                                    class="form-control @error('address_details')
                                                    is-invalid
                                                @enderror">{{ @$subangActivity->address_details }}</textarea>
                                                @if ($errors->has('address_details'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('address_details') }}</span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="attachment">
                                                    <a class="btn btn-primary text-light" role="button"
                                                        aria-disabled="false">
                                                        + Media
                                                    </a>
                                                </label>
                                                <input type="file" name="file[]" accept="image/*,video/*"
                                                    id="attachment" style="visibility: hidden; position: absolute;"
                                                    multiple />

                                            </div>
                                            <p id="files-area">
                                                <span id="filesList">
                                                    <span id="files-names"></span>
                                                </span>
                                            </p>
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
                Edit    
                <span class="spinner-border ml-2 d-none" id="loader" style="width: 1rem; height: 1rem;" role="status">
                </span>
            </button>
        </div>
        </form>
    </section>
@endsection

@section('script')
    <script>
        // Membuat objek DataTransfer untuk mengelola unggahan file
        const dt = new DataTransfer();

        // Mendapatkan data yang sudah ada dari server (contoh data berupa array nama file)
        const existingFilesData = @json($imageSubangActivity); // Mengambil data dari server
        const existingFilesDataArray=[];

        for(existFile in existingFilesData)
        {
            existingFilesDataArray.push({
                src:existingFilesData[existFile]
            })
        }
        // Loop melalui data yang sudah ada dan menambahkannya ke tampilan
        for (let i = 0; i < existingFilesData.length; i++) {
            let fileBloc = $('<span/>', {
                class: 'file-block'
            });
            let fileName = $('<span/>', {
                class: 'name',
                text: existingFilesData[i].file_url // Menggunakan atribut 'file_url' dari data yang ada
            });
            fileBloc.append('<span class="file-delete"><span>+</span></span>')
                .append(fileName);
            $("#filesList > #files-names").append(fileBloc);

            // Mengambil nama file dari data yang sudah ada dan menambahkannya ke objek DataTransfer
            let file = new File([existingFilesData[i].file_url], existingFilesData[i].file_url);
            dt.items.add(file);
        }

        // EventListener untuk tombol penghapusan yang dibuat
        $('span.file-delete').click(function() {
            let name = $(this).next('span.name').text();
            // Menghapus tampilan nama file
            $(this).parent().remove();
            for (let i = 0; i < dt.items.length; i++) {
                // Membandingkan nama file dengan data yang ada di objek DataTransfer
                if (name === dt.items[i].getAsFile().name) {
                    // Menghapus file dari objek DataTransfer
                    dt.items.remove(i);
                    continue;
                }
            }
            // Memperbarui unggahan file input setelah penghapusan
            document.getElementById('attachment').files = dt.files;
        });

        // Menggunakan event change pada input file untuk mengatur objek DataTransfer
        $("#attachment").on('change', function(e) {
            for (var i = 0; i < this.files.length; i++) {
                let file = this.files[i];
                dt.items.add(file);
            }
            // Memperbarui unggahan file input setelah penambahan
            document.getElementById('attachment').files = dt.files;
        });
    </script>
@endsection
