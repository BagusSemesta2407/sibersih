<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Kegiatan</title>

    <style>
        /* Style for the content page */
        body {
            text-align: left;
            padding-top: 50px;
            font-size: 12px;
            font-family: 'Arial', serif;
            margin-bottom: 20px;
            margin-left: 30px;
            width: 80%;
            padding: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin-left: 30px;
        }

        th,
        td {
            border: 1px solid rgb(44, 44, 44);
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h4 style="text-align: center">Laporan Kegiatan Kebersihan di Lingkungan Kecamatan Subang</h4>
    @foreach ($laporan as $item)
        <table class="table border">
            <thead>
                <tr>
                    <th style="width: 100px">
                        Kategori Kegiatan
                    </th>
                    <td>
                        {{ $item->activityCategory->name }}
                    </td>
                </tr>
                <tr>
                    <th style="width: 100px">
                        Nama Kegiatan
                    </th>
                    <td>
                        {{ $item->name }}
                    </td>
                </tr>
                <tr>
                    <th style="width: 100px">
                        Tanggal Kegiatan
                    </th>
                    <td>
                        {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}
                    </td>
                </tr>

                <tr>
                    <th style="width: 100px">
                        Lokasi Kegiatan
                    </th>
                    <td>
                        Kelurahan {{ $item->village->name }}
                    </td>
                </tr>
                <tr>
                    <th style="width: 100px">
                        Alamat Lengkap
                    </th>
                    <td>
                        {{ $item->address_details }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Foto Lokasi
                    </th>
                    <td>
                        <div style="display: flex;">
                            @foreach ($imageLaporanArray[$item->id] as $value)
                                <img src="{{ $value->image_url }}" width="100px" height="100px"
                                    style="margin-right: 10px; margin-top:40px;">
                            @endforeach
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>
                        Bukti Kegiatan
                    </th>
                    <td>
                        <div style="display: flex;">
                            @foreach ($imageActivityDetailArray[$item->id] as $image)
                                @if (str_contains($image, '.jpg') || str_contains($image, '.jpeg') || str_contains($image, '.png'))
                                    <img src="{{ $image->file_url }}" width="100px" height="100px"
                                        style="margin-right: 10px; margin-top:40px;">
                                @endif
                            @endforeach
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>
                        Deskripsi
                    </th>
                    <td>
                        <p>
                            {{ $activityDetailArray[$item->id]->description }}
                        </p>
                    </td>
                </tr>



                {{-- <tr>
                    <th>
                        fbus
                    </th>
                    @foreach ($imageLaporan as $value)
                        <td>
                            <img src="{{ $value->image_url }}" alt="" srcset="">
                        </td>
                    @endforeach
                </tr> --}}
            </thead>
        </table>
    @endforeach
</body>

</html>
