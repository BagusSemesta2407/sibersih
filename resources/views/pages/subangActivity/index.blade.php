@extends('layouts.base')

@section('content')
    <div class="page-content">
        <section class="row">
            <div class="card">
                <div class="card-header">
                    Data Kegiatan Kecamatan Subang

                    <a href="{{ route('operator.subang-sub-district-activity.create') }}"
                        class="btn btn-outline-primary block float-end">
                        Tambah
                    </a>
                </div>

                <div class="card-body">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Kegiatan</th>
                                <th>Nama Kegiatan</th>
                                <th>Lokasi Kegiatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($subangActivity as $item)
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
                                        {{ $item->address_details }}
                                    </td>

                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('operator.subang-sub-district-activity.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pen"></i>
                                            </a>
                                            <a href="{{ route('operator.subang-sub-district-activity.show', $item->id) }}"
                                                class="btn btn-sm btn-success" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger delete"
                                                data-url="{{ route('operator.subang-sub-district-activity.destroy', $item->id) }}"
                                                title="Delete">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </div>
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
