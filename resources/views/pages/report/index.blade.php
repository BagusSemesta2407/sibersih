@extends('layouts.base')

@section('content')
    <div class="page-content">
        <section class="row">
            <div class="card">
                <div class="card-header">
                    Data Kegiatan
                    {{-- <a href="{{ route('operator.activities.create') }}" class="btn btn-outline-primary block float-end">
                        Tambah
                    </a> --}}
                    <div class="float-end">
                        <a href="{{ route('operator.index-report') }}" class="btn btn-primary">Refresh</a>
                        <a href="{{ route('operator.pdf-activity',[
                            'village_id' => request('village_id'),
                            'startDate'=>   request('startDate'),
                            'endDate' =>   request('endDate')
                            ]) }}" class="btn btn-warning" target="__blank">
                            Export
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="#" class="form-horizontal"
                        style="padding-bottom: 10px;border-bottom: 1px solid #d7d6d6; margin-bottom: 20px;">
                        <div class="row align-items-center">
                            <div class="col-md-2 col-sm-12">
                                <label for="startDate" class="label-control">
                                    Tanggal Awal
                                </label>

                                <input type="date" class="form-control" name="startDate" id="startDate"
                                    value="{{ old('startDate', request()->startDate) }}" placeholder="Tanggal Awal">
                            </div>

                            <div class="col-md-2 col-sm-12">
                                <label for="endDate" class="label-control">
                                    Tanggal Akhir
                                </label>

                                <input type="date" class="form-control" name="endDate" id="endDate"
                                    value="{{ old('endDate', request()->endDate) }}" placeholder="Tanggal Akhir">
                            </div>

                            <div class="col-md-2 col-sm-12">
                                <label for="village_id" class="label-control">
                                    Kelurahan
                                </label>

                                <select name="village_id" class="form-control select2" id="village_id">
                                    <option value="" selected>
                                        Pilih Kelurahan
                                    </option>

                                    @foreach ($village as $item)
                                        <option value="{{ $item->id }}"
                                            {{ request()->village_id ? (request()->village_id == $item->id ? 'selected' : '') : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2 col-sm-12 d-flex mt-auto">
                                <button type="submit" class="btn btn-success btn-block">Filter</button>
                            </div>
                        </div>
                    </form>
                    
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Kegiatan</th>
                                <th>Nama Kegiatan</th>
                                <th>Kelurahan</th>
                                <th>Lokasi Kegiatan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($activity as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}
                                    </td>

                                    <td>
                                        {{ $item->name }}
                                    </td>

                                    <td>
                                        {{ $item->village->name }}
                                    </td>

                                    <td>
                                        {{ $item->address_details }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
