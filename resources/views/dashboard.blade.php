@extends('layouts.base')

@section('content')
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">User</h6>
                                        <h6 class="font-extrabold mb-0">{{ $countUser }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <i class="iconly-boldActivity"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">On Progress</h6>
                                        <h6 class="font-extrabold mb-0">{{ $countActivityProgress }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            <i class="iconly-boldDiscovery"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Selesai</h6>
                                        <h6 class="font-extrabold mb-0">{{ $countActivityFinish }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Kegiatan</h6>
                                        <h6 class="font-extrabold mb-0">{{ $countActivityAll }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    @foreach ($villages as $village)
                        <div class="card">
                            <div class="card-header">{{ $village->name }}</div>
                            <div class="card-body">
                                <canvas id="barChart_{{ $village->id }}"></canvas>
                            </div>
                        </div>
                        <!-- Tambahkan script untuk memuat Chart.js -->
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            var ctx = document.getElementById('barChart_{{ $village->id }}').getContext('2d');
                            var data = {
                                labels: {!! json_encode($labels[$village->id]) !!}, // Label bulan
                                datasets: [{
                                    label: 'Jumlah Kegiatan Kebersihan Yang Sudah Dilakukan',
                                    data: {!! json_encode($values[$village->id]) !!}, // Data jumlah kegiatan
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            };

                            var myBarChart = new Chart(ctx, {
                                type: 'bar',
                                data: data,
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            min:0,
                                            max:30
                                        }
                                    }
                                }
                            });
                        </script>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                @if (isset(Auth()->user()->image_url))
                                    <img src="{{ Auth()->user()->image_url }}">
                                @else
                                    <img src="{{ asset('assets/images/faces/1.jpg') }}">
                                @endif
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                                <h6 class="text-muted mb-0">{{ Auth()->user()->getRoleNames()[0] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                @if (Auth()->user()->getRoleNames()[0] == 'operator')
                    <div class="card">
                        <div class="card-header">
                            <h4>Kegiatan Terbaru</h4>
                        </div>
                        <div class="card-content pb-4">
                            @forelse ($recentActivity as $item)
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="name ms-4">
                                        <p class="mb-1">{{ $item->village->name }}, {{ $item->address_details }}</p>
                                        <small class="text-muted mb-0">
                                            {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}</small>
                                    </div>
                                </div>
                            @empty
                                <div class="recent-message d-flex px-4 py-3">
                                    <p>
                                        Belum Ada Aktivitas Terbaru
                                    </p>
                                </div>
                            @endforelse
                            <div class="px-4">
                                <a href="{{ route('operator.activities.index') }}">
                                    <button class='btn btn-block btn-xl btn-outline-primary font-bold mt-3'>
                                        Selengkapnya ..</button>
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            <h4>Kegiatan Terbaru</h4>
                        </div>
                        <div class="card-content pb-4">
                            @forelse ($recentActivityForVillage as $item)
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="name ms-4">
                                        <p class="mb-1">{{ $item->village->name }}, {{ $item->address_details }}</p>
                                        <small class="text-muted mb-0">
                                            {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}</small>
                                    </div>
                                </div>
                            @empty
                                <div class="recent-message d-flex px-4 py-3">
                                    <p>
                                        Belum Ada Aktivitas Terbaru
                                    </p>
                                </div>
                            @endforelse

                            <div class="px-4">
                                <a href="{{ route('pengguna.index-list-activity') }}">
                                    <button class='btn btn-block btn-xl btn-outline-primary font-bold mt-3'>
                                        Selengkapnya ..</button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
