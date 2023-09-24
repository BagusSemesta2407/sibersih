@extends('layouts.base')

@section('content')
    <div class="page-content">
        <section class="row">
            <div class="card">
                <div class="card-header">
                    Data Kegiatan
                    <a href="{{ route('operator.activities.create') }}" class="btn btn-outline-primary block float-end">
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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($activity as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ $item->date }}
                                    </td>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>
                                        Kelurahan {{ $item->village->name }},
                                        <br>
                                        ({{ $item->address_details }})
                                    </td>
                                    <td>
                                        @if ($item->status == 'on progress')
                                            <span class="badge bg-warning">On Progress</span>
                                        @else
                                            <span class="badge bg-success">Selesai</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('operator.activities.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="bi bi-pen"></i>
                                            </a>
                                            &nbsp;

                                            <a href="{{ route('operator.activities.show', $item->id) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            &nbsp;

                                            <button class="btn btn-sm btn-danger delete"
                                                data-url="{{ route('operator.activities.destroy', $item->id) }}">
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
