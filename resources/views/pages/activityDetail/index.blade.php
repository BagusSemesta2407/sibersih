@extends('layouts.base')

@section('content')
    <div class="page-content">
        <section class="row">
            <div class="card">
                <div class="card-header">
                    Data Kegiatan
                </div>
                <div class="card-body">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Status</th>
                                <th colspan="2">Daftar Kegiatan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($activity as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        @if ($item->status == 'on progress')
                                            <span class="badge bg-warning">On Progress</span>
                                        @else
                                            <span class="badge bg-success">Selesai</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }} | Kelurahan {{ $item->village->name }}, {{ $item->address_details }}
                                    </td>
                                    <td>
                                        <a href="{{ route('pengguna.get-activity', $item->id) }}"
                                            class="btn btn-sm btn-success">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </section>
    </div>

    {{-- <div class="col-12 col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-lg">
                        <thead>
                            <tr>
                                <th>List Kegiatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (@$activity as $item)
                                <tr>
                                    <td class="d-flex justify-content-between">
                                        <p class=" mb-0">
                                            {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }} | Kelurahan {{ $item->village->name }}, {{ $item->address_details }}
                                        </p>
                                        <div class="btn-group dropstart me-1 mb-1">
                                            <a href=""
                                                class="btn btn-primary">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            &nbsp;
                                            <a href="{{ route('menu-auditee.evaluasi-diri.detail-evaluasi-diri', $item->id) }}" class="btn btn-success">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <td class="text-center col-12">
                                    <img src="{{ asset('empty.svg') }}" alt="" class="m-5">
                                    <p>
                                        Belum Ada Data Kategori Unit Kerja
                                    </p>
                                    <a href="{{ route('admin.category-unit.index') }}">Klik Disini</a>
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
