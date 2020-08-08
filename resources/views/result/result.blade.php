<?php use App\DetailPokokBahasan; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Result</title>


    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        * {
            padding: 0;
            margin: 0;
            border: 0;
            outline: none;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        h1, h2, h3 {
            color: rgba(0,0,0,0.84);
            line-height: 1.5;
        }
        h4 {
            line-height: 1.5;
            color: rgba(0,0,0,0.84);
            font-size: 14pt;
            margin: 15px 0;
        }

        p {
            line-height: 1.5;
            color: rgba(0,0,0,0.64);
            font-size: 10pt;
        }

        .place-image {
            position: relative;
            width: 100%;
            padding-top: 15px;
            /* display: flex; */
        }
        .place-image .image {
            position: relative;
            display: inline-block;
            width: 250px;
            border-radius: 10px;
            margin: 15px;
        }

        table {
            width: 100%;
        }

        table {
            position: relative;
            width: 100%;
            overflow: hidden;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin-top: 10px;
            border: 1px rgba(0,0,0,0.1) solid;
            font-size: 10pt;
        }
        table thead {
            position: relative;
            width: 100%;
            background-color: #f3f3f3;
            color: rgba(0,0,0,0.64);
            border: 1px rgba(0,0,0,0.1) solid;
            font-size: 10pt;
        }
        table thead tr {
            position: relative;
            border: 1px rgba(0,0,0,0.1) solid;
        }
        table thead tr th {
            position: relative;
            padding: 15px;
            font-size: 10pt;
            font-weight: 600;
            text-transform: collapse;
            text-align: left;
            border: 1px rgba(0,0,0,0.1) solid;
        }
        table tbody {
            position: relative;
            font-size: 10pt;
        }
        /* table tbody tr:hover {
            background-color: #f5f5f5;
        } */
        table tbody tr td {
            position: relative;
            padding: 15px;
            font-size: 10pt;
            font-weight: 500;
            color: rgba(0,0,0,0.84);
            border: 1px rgba(0,0,0,0.1) solid;
        }

        ul {
            position: relative;
            line-height: 1.5;
        }
        ul li {
            position: relative;
            width: 90%;
            margin: auto;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .card {
            position: relative;
            width: 80%;
            margin: auto;
        }

        .card-header {
            position: relative;
            width: 50%;
            margin: 15px -2px;
            display: inline-block;
            vertical-align: top;
        }
        .logo {
            position: relative;
            top: 15px;
        }

        .card-body {
            margin: 15px 0;
        }

        .next-page {
            page-break-after: always;
        }

    </style>

</head>
<body class="container">
    <div class="card">
        <div class="card-header" style="text-align: left;">
            <?php $image_path = '/img/logo.png'; ?>
            <img 
                src="{{ public_path() . $image_path }}"
                style="margin-top: 30px;">
        </div>
        <div class="card-header" style="text-align: right;">
            <h1>Minutes of Meeting</h1>
            <h2>
                {{ $project[0]->nama_project }}
            </h2>
        </div>

        <div class="card-body next-page">
            <h4>Detail Agenda</h4>
            <table class="table table-bordered">
                <tbody>
                    <tr class="col">
                        <td>Agenda</td>
                        <td>: {{ $mom[0]->agenda }}</td>
                    </tr>
                    <tr class="col">
                        <td>Hari, Tanggal</td>
                        <td>: {{ $mom[0]->tanggal_waktu }}</td>
                    </tr>
                    <tr class="col">
                        <td>Lokasi</td>
                        <td>: {{ $mom[0]->lokasi }}</td>
                    </tr>
                    <tr class="col">
                        <td>MoM Oleh</td>
                        <td>: {{ $mom[0]->name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-body next-page">
            <h4>Daftar Peserta</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Instansi</th>
                        <th>Absensi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    @foreach ($daftarPeserta as $dp)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $dp->nama }}</td>
                            <td>{{ $dp->instansi }}</td>
                            <td>
                                @if ($dp->absen == 1)
                                    {{ 'Hadir' }}
                                @else
                                    {{ 'Tidak Hadir' }}
                                @endif
                            </td>
                        </tr>

                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-body">
            <h4>Pokok Bahasan</h4>
            <p>
                Berikut adalah pokok bahasan yang dibahas dan
                dirangkum dalam beberapa poin-poin bahasan
                sebagai berikut:
            </p>
            <p>
                <b>Catatan:</b>
                <br>
                {{ $mom[0]->kesimpulan }}
            </p>
        </div>

        <div class="card-body next-page">
            <h4>Poin-poin Bahasan</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pokok Bahasan</th>
                        <th>Detail Pokok Bahasan / Keterangan</th>
                        <th>Tanggal Tindak Lanjut</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    @foreach ($pokokBahasan as $pb)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $pb->pokok_bahasan }}</td>
                            <td>
                                <?php $detailPokokBahasan = DetailPokokBahasan::GetAll($pb->id_pokok_bahasan) ?>
                                <ul>
                                    @foreach ($detailPokokBahasan as $dpb)
                                        <li>
                                            {{ $dpb->detail_pokok_bahasan }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-body">
            <h4>Galeri</h4>
            <div class="place-image">
                @foreach ($gallery as $gl)
                    <?php $image_path = public_path() . '/img/gallery/covers/'; ?>
                    <img src="{{ $image_path . $gl->gambar }}" class="image" alt="image">
                @endforeach
            </div>
        </div>


    </div>
</body>
</html>
