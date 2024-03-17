<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Print PDF</title>
    <style>
        /**
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
        @page {
            margin: 80px 20px;
        }

        .page-break {
            page-break-after: always;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 2cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 0cm;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: -20px;
            left: 70px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            /* background-color: #03a9f4; */
            /* color: white; */
            /* text-align: center; */
            line-height: 35px;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: -20px;
            left: 0px;
            right: 5rem;
            height: 50px;

            /** Extra personal styles **/
            /* background-color: #03a9f4; */
            /* color: white; */
            text-align: right;
            line-height: 35px;
        }

        /* Create two unequal columns that floats next to each other */
        .column {
            float: left;
            font-size: 14px;
            /* padding: 10px;
            height: 300px; */
            /* Should be removed. Only for demonstration */
        }

        .left {
            width: 40%;
        }

        .right {
            width: 60%;
        }

        /* Clear floats after the columns */
        .row-content:after {
            content: "";
            display: table;
            clear: both;
        }

        .text-header {
            font-size: 12px;
            font-weight: bold;
        }

        .border-container {
            border: 1px solid rgb(211, 204, 204);
        }

        .border-bottom-container {
            border-bottom: 1px solid rgb(211, 204, 204);
        }
    </style>
</head>
@php
$no = 1;
@endphp

<body>
    <header>
        <img src="https://jakarta.pintoinvest.com/assets/gambar/logo_jakpintas.png"><br>
        <span class="text-header">Peta Perizinan dan Investasi</span>
    </header>

    <footer>
        Di Cetak pada tanggal {{ date('d M Y') }}
    </footer>
    <main>
        <center>
            <span style="font-size:20px" class="text-center font-weight-bold mb-1">LAPORAN DIGITASI LOKASI
            </span><br>
        </center>
        <p class="font-weight-bold">Peta Lokasi</p>
        <img src="{{ session('img') }}" id="map" style="width: 100%;">
        <div class="p-1">

            <div class="w-100 mt-3" style="vertical-align: middle">
                <span class="font-weight-bold" style="vertical-align: middle">Luas Area Digitasi</span>
                <span class="d-block">{{ number_format($luas) }} m<sup>2</sup></span>
            </div>
            <div class="row-content mt-3">
                <div class="w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Informasi {{ $kategori }}</span>
                </div>
                <div class="column mt-3">
                    @if ($data['features'] != null)
                    @if ($kategori == 'Persil & NJOP')
                    <table class="table table-bordered">
                        <thead>
                            <td align="center" style="vertical-align:middle;padding:5px;width: 15px;">No</td>
                            <td align="center" style="vertical-align:middle;padding:5px;width: 150px;">Tipe</td>
                            <td align="center" style="vertical-align:middle;padding:5px;width: 150px;">Luas
                                (m<sup>2</sup>)</td>
                            <td align="center" style="vertical-align:middle;padding:5px;width: 230px;">NJOP (Rp per
                                m<sup>2</sup>)
                            </td>
                        </thead>
                        <tbody>
                            @foreach ($data['features'] as $dt)
                            <tr>
                                <td align="center" style="vertical-align:middle;padding:5px;width: 15px;">{{ $no++ }}
                                </td>
                                <td style="vertical-align:middle;padding:5px;width: 150px;">{{ $dt['properties']['Tipe']
                                    }}</td>
                                <td align="center" style="vertical-align:middle;padding:5px;width: 150px;">{{
                                    number_format($dt['properties']['Luas']) }}
                                    m<sup>2</sup>
                                </td>
                                <td align="center" style="vertical-align:middle;padding:5px;width: 230px;">
                                    Rp.{{ number_format($dt['properties']['NJOP']['Min']) }}-Rp.{{
                                    number_format($dt['properties']['NJOP']['Max']) }}
                                    / m<sup>2</sup>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @elseif ($kategori == 'Zonasi')
                    <table class="table table-bordered">
                        <thead>
                            <td align="center" style="vertical-align:middle;padding:5px;width: 15px;">No</td>
                            <td align="center" style="vertical-align:middle;padding:5px;width: 150px;">Kelurahan</td>
                            <td align="center" style="vertical-align:middle;padding:5px;width: 380px;">Keterangan</td>
                        </thead>
                        <tbody>
                            @foreach ($data['features'] as $dt)
                            <tr>
                                <td align="center" style="vertical-align:middle;padding:5px;width: 15px;">{{ $no++ }}
                                </td>
                                <td style="padding:5px;width: 150px;">{{
                                    $dt['properties']['Kelurahan']
                                    }}</td>
                                <td style="vertical-align:middle;padding:5px;width: 380px;">
                                    <span class="d-block">Kode Blok/Sub Blok : {{ $dt['properties']['Kode Blok'] }}/{{
                                        $dt['properties']['Sub Blok'] }}</span>
                                    <span class="d-block">ID Sub Blok : {{ $dt['properties']['ID Sub Blok'] }}</span>
                                    <span class="d-block">Zona : {{ $dt['properties']['Zona'] }}</span>
                                    <span class="d-block">Sub Zona : {{ $dt['properties']['Sub Zona'] }}</span>
                                    <span class="d-block">TPZ : {{ $dt['properties']['TPZ'] }}</span>
                                    <span class="d-block">CD TPZ : {{ $dt['properties']['CD TPZ'] }}</span>
                                    <span class="d-block">Tipe : {{ $dt['properties']['Tipe'] }}</span>
                                    <span class="d-block">KDB : {{ $dt['properties']['KDB'] }}</span>
                                    <span class="d-block">KLB : {{ $dt['properties']['KLB'] }}</span>
                                    <span class="d-block">KDH : {{ $dt['properties']['KDH'] }}</span>
                                    <span class="d-block">KTB : {{ $dt['properties']['KTB'] }}</span>
                                    <span class="d-block">KB : {{ $dt['properties']['KB'] }}</span>
                                    <span class="d-block">PSL : {{ $dt['properties']['PSL'] }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @elseif ($kategori == 'Akses')
                    <table class="table table-bordered">
                        <thead>
                            <td align="center" style="vertical-align:middle;padding:5px;width: 15px;">No</td>
                            <td align="center" style="vertical-align:middle;padding:5px;width: 150px;">Kategori</td>
                            <td align="center" style="vertical-align:middle;padding:5px;width: 380px;">Nama</td>
                        </thead>
                        <tbody>
                            @foreach ($data['features'] as $dt)
                            <tr>
                                <td align="center" style="vertical-align:middle;padding:5px;width: 15px;">{{ $no++ }}
                                </td>
                                <td style="vertical-align:middle;padding:5px;width: 150px;">{{
                                    $dt['properties']['Kategori'] }}</td>
                                <td style="vertical-align:middle;padding:5px;width: 380px;">{{
                                    $dt['properties']['Nama'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    @else
                    <p>Tidak ada data</p>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>