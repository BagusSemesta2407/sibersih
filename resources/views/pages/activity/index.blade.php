@extends('layouts.base')

@section('content')
    <div class="page-content">
        <section class="row">
            <div class="card">
                <div class="card-header">
                    Data Kegiatan
                    @if (Auth::user()->getRoleNames()[0] == 'user')
                        <a href="{{ route('pengguna.activity.create') }}" class="btn btn-outline-primary block float-end">
                            Tambah
                        </a>
                    @endif
                </div>


                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">
                                Menunggu Persetujuan
                                {{-- @if ($countActivityWaitingStatus > 0)
                                    <span class="badge bg-transparant text-primary">{{ $countActivityWaitingStatus }}</span>
                                @endif --}}
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">
                                On Progress
                                {{-- @if ($countActivityOnProgressStatus > 0)
                                    <span
                                        class="badge bg-transparant text-primary">{{ $countActivityOnProgressStatus }}</span>
                                @endif --}}
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="disagree-tab" data-bs-toggle="tab" href="#disagree" role="tab"
                                aria-controls="disagree" aria-selected="false">
                                Belum Disetujui
                                {{-- @if ($countActivityDisagreeStatus > 0)
                                    <span
                                        class="badge bg-transparant text-primary">{{ $countActivityDisagreeStatus }}</span>
                                @endif --}}
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab"
                                aria-controls="contact" aria-selected="false">Bukti Kegiatan</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                                    @foreach ($activityWaitingStatus as $item)
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
                                                Kelurahan {{ $item->village->name }},
                                                <br>
                                                ({{ $item->address_details }})
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    @if (Auth::user()->getRoleNames()[0] == 'user')
                                                        <a href="{{ route('pengguna.activity.edit', $item->id) }}"
                                                            class="btn btn-sm btn-warning" title="Edit">
                                                            <i class="bi bi-pen"></i>
                                                        </a>
                                                        &nbsp;

                                                        <button class="btn btn-sm btn-danger delete"
                                                            data-url="{{ route('pengguna.activity.destroy', $item->id) }}"
                                                            title="Delete">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    @else
                                                        <a href="{{ route('operator.validate-waiting-status', $item->id) }}"
                                                            class="btn btn-sm btn-warning" title="Konfirmasi Persetujuan">
                                                            <i class="bi bi-check"></i>
                                                        </a>
                                                    @endif

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Kegiatan</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Lokasi Kegiatan</th>
                                        @if (Auth::user()->getRoleNames()[0] == 'user')
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($activityOnProgressStatus as $item)
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
                                                Kelurahan {{ $item->village->name }},
                                                <br>
                                                ({{ $item->address_details }})
                                            </td>

                                            @if (Auth::user()->getRoleNames()[0] == 'user')
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('pengguna.upload-activity', $item->id) }}"
                                                            class="btn btn-sm btn-primary" title="Upload">
                                                            <i class="bi bi-cloud-upload-fill"></i>
                                                        </a>
                                                        &nbsp;
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="disagree" role="tabpanel" aria-labelledby="disagree-tab">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Kegiatan</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Lokasi Kegiatan</th>
                                        @if (Auth::user()->getRoleNames()[0] == 'user')
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($activityDisagreeStatus as $item)
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
                                                Kelurahan {{ $item->village->name }},
                                                <br>
                                                ({{ $item->address_details }})
                                            </td>

                                            @if (Auth::user()->getRoleNames()[0] == 'user')
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('pengguna.activity.edit', $item->id) }}"
                                                            class="btn btn-sm btn-warning" title="Edit">
                                                            <i class="bi bi-pen"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
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
                                    @foreach ($activityDetail as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>

                                            <td>
                                                {{ \Carbon\Carbon::parse($item->activity->date)->translatedFormat('d F Y') }}
                                            </td>
                                            <td>
                                                {{ $item->activity->name }}
                                            </td>
                                            <td>
                                                Kelurahan {{ $item->activity->village->name }},
                                                <br>
                                                ({{ $item->activity->address_details }})
                                            </td>
                                            <td>
                                                @if ($item->status == 'waiting')
                                                    <span class="badge bg-warning">Menunggu Persetujuan</span>
                                                @elseif ($item->status == 'disagree')
                                                    <span class="badge bg-danger">Belum Disetujui</span>
                                                @else
                                                    <span class="badge bg-success">Selesai</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if (Auth::user()->getRoleNames()[0] == 'user')
                                                    @if ($item->status == 'disagree')
                                                        <div class="d-flex">
                                                            <a href="{{ route('pengguna.update-upload-activity', $item->id) }}"
                                                                class="btn btn-sm btn-warning" title="Edit">
                                                                <i class="bi bi-pen"></i>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <small><i>Tidak ada Aksi</i></small>
                                                    @endif
                                                @else
                                                    @if ($item->status == 'waiting')
                                                        <div class="d-flex">
                                                            <a href="{{ route('operator.upload-validate-activity', $item->id) }}"
                                                                class="btn btn-sm btn-warning" title="Konfirmasi">
                                                                <i class="bi bi-check"></i>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <small><i>Tidak ada Aksi</i></small>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
