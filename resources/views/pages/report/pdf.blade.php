<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>

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
            text-align: center;
        }
    </style>
</head>

<body>
    @foreach ($laporan as $item)
        <table class="table border">
            <thead>
                <tr>
                    <th>
                        Kategori Kegiatan
                    </th>
                    <th>
                        Nama Kegiatan
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {{ $item->activityCategory->name }}
                    </td>
                    <td>
                        {{ $item->name }}
                    </td>
                </tr>
            </tbody>
        </table>
    @endforeach
</body>

</html>
