@extends('layouts.base')
@section('content')
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            @if (@$activityCategory->exists)
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
                            Data Kategori Kegiatan
                        </h4>
                    </div>


                    <div class="card-content">
                        <div class="card-body">
                            @if (@$activityCategory->exists)
                                <form class="form form-vertical" enctype="multipart/form-data" method="POST"
                                    action="{{ route('operator.activity-categories.update', $activityCategory) }}" id="form">
                                    @method('PUT')
                                @else
                                    <form class="form form-vertical" enctype="multipart/form-data" method="POST"
                                        action="{{ route('operator.activity-categories.store') }}" id="form">
                            @endif
                            {{ csrf_field() }}
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
                                                value="{{ old('name', @$activityCategory->name) }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
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
