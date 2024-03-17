<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    {{--
    <meta charset="utf-8"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
            margin-bottom: 2cm;
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

        header img {
            width: 100px;
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

        .chartjs-legend li {
            list-style: none;
            font-size: 13px;
        }

        .chartjs-legend li .label {
            margin-left: 5px;
        }
    </style>
</head>

<body>
    {{-- <header>
        <img src="https://jakarta.pintoinvest.com/assets/gambar/logo_jakpintas.png"><br>
        <span class="text-header">Peta Perizinan dan Investasi</span>
    </header>

    <footer>
        Di Cetak pada tanggal {{ date('d M Y') }}
    </footer> --}}
    <main>
        <center>
            <span style="font-size:25px" class="text-center font-weight-bold mb-1">Ringkasan Informasi</span>
        </center>
        <p class="font-weight-bold">Peta Lokasi</p>
        <img src="{{ $image_map }}" id="map" style="width: 100%;">
        @if (in_array('profil', $kategori))
        <p class="font-weight-bold text-center mt-2">Profil</p>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Lokasi</span>
                </div>
                <div class="column left">
                    <span>Koordinat</span>
                </div>
                <div class="column right">
                    <a href="https://www.google.com/maps/search/%09{{ $coordinates[0] }},{{ $coordinates[1] }}"
                        target="_blank" id="kordinat">{{ $coordinates[0] }},{{ $coordinates[1] }}</a>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Kelurahan</span>
                </div>
                <div class="column right">
                    <span id="kelurahan">{{ ucwords(strtolower($wilayah['Kelurahan'])) }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Kecamatan</span>
                </div>
                <div class="column right">
                    <span id="kecamatan">{{ ucwords(strtolower($wilayah['Kecamatan'])) }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Wilayah</span>
                </div>
                <div class="column right">
                    <span id="wilayah">{{ ucwords(strtolower($wilayah['Kota'])) }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Luas Wilayah</span>
                </div>
                <div class="column right">
                    <span id="luas">{{ number_format($wilayah['Luas'] / 10000, 2, '.', '') }} ha</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Kepadatan</span>
                </div>
                <div class="column right">
                    <span id="kepadatan">{{ number_format($wilayah['Kepadatan-Penduduk']) }} jiwa per km2</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Rasio Gini</span>
                </div>
                <div class="column right">
                    <span id="rasio">{{ $wilayah['Gini'] }}</span>
                </div>
            </div>
        </div>
        <br>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Persil</span>
                </div>
                <div class="column left">
                    <span>Kegiatan</span>
                </div>
                <div class="column right">
                    <span>{{ ucwords(strtolower(isset($eksisting['Kegiatan']) ? $eksisting['Kegiatan'] : "-"))
                        }}</span>
                </div>
            </div>
            @if($njop !== null)
            <div class="row-content">
                <div class="column left">
                    <span>Perkiraan NJOP</span>
                </div>
                <div class="column right">
                    <span>Rp. {{ number_format($njop['Min']) }}, Rp. {{ number_format($njop['Max']) }} per m²</span>
                </div>
            </div>
            @endif
            <div class="row-content">
                <div class="column left">
                    <span>Rerata NJOP</span>
                </div>
                <div class="column right">
                    <span>Rp. {{ number_format($rerata_njop['Mean']) }} per m²</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Tipe Hak</span>
                </div>
                <div class="column right">
                    <span>{{ $bpn !== null ? $bpn['Tipe'] : '-' }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Luas</span>
                </div>
                <div class="column right">
                    <span>{{ $bpn !== null ? number_format($bpn['Luas']) . ' m²' : '-' }}</span>
                </div>
            </div>
        </div>
        <br>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Usaha Mikro Kecil</span>
                </div>
                <div class="column left">
                    <span>Pemilik IUMK</span>
                </div>
                <div class="column right">
                    <span>{{ number_format($wilayah['Jumlah']) }} Orang</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Total Omzet</span>
                </div>
                <div class="column right">
                    <span>Rp. {{ number_format($wilayah['Total Omzet']) }} per m²</span>
                </div>
            </div>
        </div>
        <br>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Pendapatan Rata Rata Per
                        Bulan</span>
                </div>
                <div class="column left">
                    <span>Rp. 0 - 5 Juta</span>
                </div>
                <div class="column right">
                    <span>{{ $wilayah['P1'] }} %</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Rp. 6 - 10 Juta</span>
                </div>
                <div class="column right">
                    <span>{{ $wilayah['P2'] }} %</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Rp. 11 - 15 Juta</span>
                </div>
                <div class="column right">
                    <span>{{ $wilayah['P3'] }} %</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Rp. 16 - 20 Juta</span>
                </div>
                <div class="column right">
                    <span>{{ $wilayah['P4'] }} %</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Lebih dari Rp. 20 Juta</span>
                </div>
                <div class="column right">
                    <span>{{ $wilayah['P5'] }} %</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Tidak Menjawab</span>
                </div>
                <div class="column right">
                    <span>{{ $wilayah['P6'] }} %</span>
                </div>
            </div>
        </div>
        <br>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Distribusi Usaha Mikro
                        Kecil</span>
                </div>
                <br>
                <div class="column text-center w-50">
                    <br>
                    <br>
                    <img src="https://quickchart.io/chart?width=340&;height=300&c={ type: %27pie%27, data: { labels: [%27Produksi%27, %27Perdagangan%27, %27Jasa%27], datasets: [ { label: %27Kelurahan%27, backgroundColor: [%27rgb(237, 64, 60)%27, %27rgb(248, 165, 27)%27, %27rgb(163, 33, 142)%27], data: [{{ $wilayah['Produksi'] }}, {{ $wilayah['Perdagangan'] }}, {{ $wilayah['Jasa'] }}], }, ], }, options: { title: { display: true, }, legend: { align: %27start%27, }, bezierCurve: false, } }"
                        class="w-100">
                </div>
                <div class="column text-center w-50">
                    <img src="https://quickchart.io/chart?width=250&;height=500&c={ type: %22bar%22, data: { labels: [%2220-29%22, %2230-39%22, %2240-49%22, %2250-59%22, %2260-69%22], datasets: [ { backgroundColor: %22rgb(3, 164, 94)%22, data: [{{ $wilayah['U1'] }},{{ $wilayah['U2'] }},{{ $wilayah['U3'] }},{{ $wilayah['U4'] }},{{ $wilayah['U5'] }}], }, ], }, options: { legend: { display: false, }, scales: { yAxes: [ { scaleLabel: { display: true, labelString: %22Jumlah%22, }, }, ], xAxes: [ { scaleLabel: { display: true, labelString: %22Usia%22, barPercentage: 0.2, categoryPercentage: 0.2, }, }, ], }, bezierCurve: false, }, }"
                        class="w-100">
                </div>
            </div>
        </div>
        <br>
        <div class="page-break"></div>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Distribusi Sektor</span>
                </div>
                <br>
                <div class="column" style="width: 40%">
                    <img src="https://quickchart.io/chart?width=340&;height=300&c={%20type:%20%27pie%27,%20data:%20{%20labels:%20[{{ $distribusi_nib['sektor'] }}],%20datasets:%20[%20{%20backgroundColor:%20[{{ $distribusi_nib['color'] }}],%20data:%20[{{  $distribusi_nib['jumlah'] }}]%20},%20],%20},%20options:%20{%20title:%20{%20display:%20true,%20},%20legend:%20{%20position:%20%27right%27,%20display: false},%20}%20}"
                        class="w-100">
                </div>
                <div class="column" style="width: 60%">
                    <ul class="chartjs-legend">
                        @foreach ($distribusi_nib['legend']['label'] as $index => $dl)
                        <li>
                            <div id="legend-{{ $index }}-item" class="legend-item">
                                <span style="color:
                                {{ $distribusi_nib['legend']['color'][$index] }} !important">
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                </span>
                                <span class="label">{{ $dl }}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <br>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Investasi Per Sektor</span>
                </div>
                <br>
                <div class="column" style="width: 40%">
                    <img src="https://quickchart.io/chart?width=340&;height=300&c={%20type:%20%27pie%27,%20data:%20{%20labels:%20[{{ $distribusi_nib['sektor'] }}],%20datasets:%20[%20{%20backgroundColor:%20[{{ $distribusi_nib['color'] }}],%20data:%20[{{  $distribusi_nib['jumlah_investasi'] }}]%20},%20],%20},%20options:%20{%20title:%20{%20display:%20true,%20},%20legend:%20{%20position:%20%27right%27,%20display: false},%20}%20}"
                        class="w-100">
                </div>
                <div class="column" style="width: 60%">
                    <ul class="chartjs-legend">
                        @foreach ($distribusi_nib['legend']['label'] as $index => $dl)
                        <li>
                            <div id="legend-{{ $index }}-item" class="legend-item">
                                <span style="background-color:
                                {{ $distribusi_nib['legend']['color'][$index] }} !important">
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                </span>
                                <span class="label">{{ $dl }}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="page-break"></div>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Serapan Tenaga Kerja</span>
                </div>
                <br>
                <div class="column" style="width: 40%">
                    <img src="https://quickchart.io/chart?width=340&;height=300&c={%20type:%20%27pie%27,%20data:%20{%20labels:%20[{{ $distribusi_nib['sektor'] }}],%20datasets:%20[%20{%20backgroundColor:%20[{{ $distribusi_nib['color'] }}],%20data:%20[{{  $distribusi_nib['tenaga_kerja'] }}]%20},%20],%20},%20options:%20{%20title:%20{%20display:%20true,%20},%20legend:%20{%20position:%20%27right%27,%20display: false},%20}%20}"
                        class="w-100">
                </div>
                <div class="column" style="width: 60%">
                    <ul class="chartjs-legend">
                        @foreach ($distribusi_nib['legend']['label'] as $index => $dl)
                        <li>
                            <div id="legend-{{ $index }}-item" class="legend-item">
                                <span style="background-color:
                                {{ $distribusi_nib['legend']['color'][$index] }} !important">
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                </span>
                                <span class="label">{{ $dl }}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <br>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Luas Sub Zona Berdasar Perda
                        1/2014</span>
                </div>
            </div>
            @foreach ($distribusi_wilayah['2014'] as $dw)
            <div class="row-content">
                <div class="column w-25">
                    <span>{{ $dw['sub_zona'] }}</span>
                </div>
                <div class="column text-right w-25">
                    <span>{{ number_format(round($dw['luas']), 0, ",", ".") }} m<sup>2</sup></span>
                </div>
                <div class="column text-right w-25">
                    <span>{{ number_format(round((float)$dw['percent'],2), 2, ",", ".") }}%</span>
                </div>
            </div>
            @endforeach
        </div>
        <br>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Luas Sub Zona Berdasar Pergub
                        31/2022</span>
                </div>
            </div>
            @foreach ($distribusi_wilayah['2022'] as $dw)
            <div class="row-content">
                <div class="column w-25">
                    <span>{{ $dw['sub_zona'] }}</span>
                </div>
                <div class="column text-right w-25">
                    <span>{{ number_format(round($dw['luas']), 0, ",", ".") }} m<sup>2</sup></span>
                </div>
                <div class="column text-right w-25">
                    <span>{{ number_format(round((float)$dw['percent'],2), 2, ",", ".") }}%</span>
                </div>
            </div>
            @endforeach
        </div>
        <br>
        {{-- <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Lingkungan</span>
                </div>
                <div class="column left">
                    <span>Sistem Sanitasi</span>
                </div>
                <div class="column right">
                    <span>{{ session('sanitasi') }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Penurunan Tanah</span>
                </div>
                <div class="column right">
                    <span>{{ session('turun') }} cm/tahun</span>
                </div>
            </div>
            <hr>
            @if($air_tanah !== null)
            @foreach ($air_tanah as $at)
            <div class="row-content">
                <div class="column left">
                    <span>Air Tanah {{ $at['properties']['Kedalaman'] }}</span>
                </div>
                <div class="column right">
                    <span>{{ ucwords(strtolower($at['properties']['Air Tanah'])) }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Penggunaan</span>
                </div>
                <div class="column right">
                    <span>{{ $at['properties']['Penggunaan'] }} cm/tahun</span>
                </div>
            </div>
            @endforeach
            @endif

        </div> --}}
        <br>
        <br>
        @endif
        @if(in_array('indikator', $kategori))
        @if ($urban != null)
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Indikator</span>
                </div>
                <div class="w-100">
                    <span class="font-weight-bold">Urban Index ({{ $urban['urbanindex'] }} - {{
                        $urban['kategori_desk_umum'] }})</span>
                </div>
                <div class="column">
                    <ol>
                        @foreach (explode(", ", $urban['deskripsi_khusus']) as $u)
                        <li style="margin-left:-1rem;">{{ $u }}</li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="row-content">
                <div class="w-100">
                    <span class="font-weight-bold">Environment Carrying Capacity Index ({{
                        number_format((float)$ddl['score_all'], 2, '.', '') }} / 5.00)</span>
                </div>
                <div class="column">
                    <ol>
                        @foreach ($ddl['detail'][0] as $key => $d)
                        <li style="margin-left:-1rem;">{{ $ddl['detail'][0][$key] }}</li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="row-content">
                <div class="w-100 text-center">
                    <img src="https://quickchart.io/chart?width=500&;height=500&c={ type: 'radar', data: { labels: ['Topografi', 'Kebencanaan', 'Ketersediaan Air', 'Kualitas Vegetasi', 'Pengelolaan Limbah',], datasets: [ { label: ' ', data: [ {{ $ddl['score'][0]['topografi'] }}, {{ $ddl['score'][0]['kebencanaan'] }}, {{ $ddl['score'][0]['ketersediaan_air'] }}, {{ $ddl['score'][0]['kualitas_vegetasi'] }}, {{ $ddl['score'][0]['pengolahan_limbah'] }}, ], fill: true, backgroundColor: 'rgba(255, 99, 132, 0.2)', borderColor: 'rgb(255, 99, 132)', pointBackgroundColor: 'rgb(255, 99, 132)', pointBorderColor: 'white', pointHoverBackgroundColor: 'white', pointHoverBorderColor: 'rgb(255, 99, 132)', }, ], }, options: { elements: { line: { borderWidth: 3, }, }, legend: { display: false, }, }, }"
                        class="w-50">
                </div>
            </div>
            <div class="row-content">
                <div class="w-100">
                    <span class="font-weight-bold">Livability Index ({{ number_format((float)$livability['livability'],
                        2, '.',
                        '') }} / 9.00 - {{ $livability['deskripsi'][0]['livability'] }})</span>
                </div>
                <div class="column">
                    <ol>
                        @foreach($livability['deskripsi'][0] as $key => $l)
                        @if($key !== 'livability')
                        <li style="margin-left:-1rem;">{{ $livability['deskripsi'][0][$key] }}</li>
                        @endif
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="row-content">
                <div class="w-100 text-center">
                    <img src="https://quickchart.io/chart?width=500&;height=500&c={ type: 'radar', data: { labels: [ ['Konektivitas', 'Pejalan Kaki'], 'Ruang Terbuka dan Publik', 'Fasilitas Komunitas', 'Aktivitas Budaya Perkotaan', 'Lokasi Bekerja', 'Pelayanan Kesehatan', 'Pendidikan', 'Transportasi Publik', 'Campuran Guna Lahan', ], datasets: [ { data: [ {{ $livability['indeks_kon'] }}, {{ $livability['ruang_terbuka'] }}, {{ $livability['fasilitas'] }}, {{ $livability['budaya'] }}, {{ $livability['pekerjaan'] }}, {{ $livability['pelayanan'] }}, {{ $livability['pendidikan'] }}, {{ $livability['transportasi'] }}, {{ $livability['entropy'] }} ], fill: true, backgroundColor: 'rgba(133, 99, 255, 0.2)', borderColor: 'rgb(133, 99, 255)', pointBackgroundColor: 'rgb(133, 99, 255)', pointBorderColor: 'white', pointHoverBackgroundColor: 'white', pointHoverBorderColor: 'rgb(133, 99, 255)', }, ], }, options: { elements: { line: { borderWidth: 3, }, }, legend: { display: false, }, scale: { ticks: { beginAtZero: true, max: 5, min: 0, stepSize: 1, }, }, }, }"
                        class="w-50">
                </div>
            </div>
        </div>
        <br>
        @endif
        @endif

        @if (in_array('ketentuan', $kategori))
        <p class="font-weight-bold text-center mt-2">Ketentuan</p>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Identitas Zonasi</span>
                </div>
                <div class="column left">
                    <span>Zona</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['identitas_zonasi']['zona'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Sub Zona</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['identitas_zonasi']['sub_zona'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Kode Sub Zona</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['identitas_zonasi']['kode_sub_zona'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>ID Blok</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['identitas_zonasi']['id_blok'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>ID Sub Blok</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['identitas_zonasi']['id_sub_blok'] }}</span>
                </div>
            </div>
        </div>
        <br>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Intensitas Pemanfaatan Ruang</span>
                </div>
                <div class="column left">
                    <span>Luas Lahan</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['intensitas_pemanfaatan_ruang']['luas_lahan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>KDB</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['intensitas_pemanfaatan_ruang']['kdb'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>KLB</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['intensitas_pemanfaatan_ruang']['klb'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>KDH</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['intensitas_pemanfaatan_ruang']['kdh'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Ketinggian Bangunan</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['intensitas_pemanfaatan_ruang']['ketinggian_bangunan'] }}</span>
                </div>
            </div>
        </div>
        <br>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Ketentuan Kegiatan & Penggunaan
                        Lahan</span>
                </div>
                <div class="column left">
                    <span>Jenis Bangunan</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_penggunaan_lahan']['jenis_bangunan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Definisi Bangunan</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_penggunaan_lahan']['definisi_bangunan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Perizinan</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_penggunaan_lahan']['perizinan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Keterangan</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_penggunaan_lahan']['keterangan'] == null ? "-" :
                        $ketentuan['ketentuan_penggunaan_lahan']['keterangan']}}</span>
                </div>
            </div>
        </div>
        <br>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Ketentuan Tata Bangunan (non
                        GSB)</span>
                </div>
                <div class="w-100">
                    <span style="font-size: 14px;">Garis Sempadan Non Bangunan</span>
                </div>
                <div class="column">
                    <ol>
                        {!! $ketentuan['ketentuan_tata_bangunan']['gsnb'] !!}
                    </ol>
                </div>
            </div>
        </div>
        <br>
        <div class="page-break"></div>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Ketentuan Tata Bangunan (GSB)</span>
                </div>
                <div class="w-100">
                    <span style="font-size: 14px;">Garis Sempadan Bangunan</span>
                </div>
                <div class="column">
                    <ol>
                        {!! $ketentuan['ketentuan_tata_bangunan']['gsb'] !!}
                    </ol>
                </div>
            </div>
        </div>
        <br>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Ketentuan Hunian</span>
                </div>
                <div class="column left">
                    <span>Jenis Fungsi Hunian</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_hunian']['jenis_hunian'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Tipikal</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_hunian']['tipikal'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Luas Lahan</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_hunian']['luas_lahan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>KDB</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_hunian']['etc'] == null ? '-' :
                        $ketentuan['ketentuan_hunian']['etc']['kdb'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>KLB</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_hunian']['etc'] == null ? '-' :
                        $ketentuan['ketentuan_hunian']['etc']['klb'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>KDH</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_hunian']['etc'] == null ? '-' :
                        $ketentuan['ketentuan_hunian']['etc']['kdh'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>KTB</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_hunian']['etc'] == null ? '-' :
                        $ketentuan['ketentuan_hunian']['etc']['ktb'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Tinggian Bangunan</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_hunian']['etc'] == null ? '-' :
                        $ketentuan['ketentuan_hunian']['etc']['ketinggian_bangunan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                @if($ketentuan['ketentuan_hunian']['etc'] !== null)
                <div class="column">
                    <ol>
                        @for ($i = 1; $i <= 15; $i++) @if($ketentuan['ketentuan_hunian']['etc']["ketentuan_$i"] !=="-" )
                            <li style="margin-left:-1rem;">{{
                            $ketentuan['ketentuan_hunian']['etc']["ketentuan_$i"] }}
                            </li>
                            @endif
                            @endfor
                    </ol>
                </div>
                @endif
            </div>
        </div>
        <br>
        @if(isset($ketentuan['ketentuan_variansi']))
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Variansi Pemanfaatan Ruang Pada Zona
                        RTH
                    </span>
                </div>
                <div class="column left">
                    <span>Jenis Bangunan</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_variansi']['jenis_bangunan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Fungsi Bangunan</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_variansi']['etc'] == null ? '-' :
                        $ketentuan['ketentuan_variansi']['etc']['fungsi_bangunan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Ketentuan Perizinan</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_variansi']['etc'] == null ? '-'
                        :$ketentuan['ketentuan_variansi']['etc']['ketentuan_perizinan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Jenis Variansi</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_variansi']['etc'] == null ? '-'
                        :$ketentuan['ketentuan_variansi']['etc']['jenis_variansi'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column">
                    @if ($ketentuan['ketentuan_variansi']['etc'] != null)
                    <ol>
                        @for ($i = 1; $i <= 9; $i++) @if($ketentuan['ketentuan_variansi']['etc']["ketentuan_$i"] !==null
                            ) <li style="margin-left:-1rem;">{{
                            $ketentuan['ketentuan_variansi']['etc']["ketentuan_$i"] }}
                            </li>
                            @endif
                            @endfor
                    </ol>
                    @endif

                </div>
            </div>
        </div>
        <br>
        @endif
        @if(isset($ketentuan['ketentuan_tpz']))
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Ketentuan TPZ
                    </span>
                </div>
            </div>
            @foreach ($ketentuan['ketentuan_tpz'] as $ktpz)
            @foreach ($ktpz as $key => $value)
            <div class="row-content">
                @if ($key == "Link_PDF" || $key == "Ketentuan")
                <div class="column w-100">
                    <span>{!! $value !!}</span>
                </div>
                @elseif ($key == "List_File")
                @else
                <div class="column left">
                    <span>{{ str_replace("_", " ", $key) }}</span>
                </div>
                <div class="column right">
                    <span>{{ $value }}</span>
                </div>
                @endif
            </div>
            @endforeach
            <br>
            @endforeach
        </div>
        <br>
        @endif
        @if (isset($ketentuan['ketentuan_rawan_bencana']))
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Ketentuan Rawan Bencana</span>
                </div>
                <div class="column left">
                    <span>Jenis Kawasan</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_rawan_bencana']['nama_kawasan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Resiko</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_rawan_bencana']['resiko'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column w-100">
                    <ol>{!! $ketentuan['ketentuan_rawan_bencana']['ketentuan'] !!}</ol>
                </div>
            </div>
        </div>
        <br>
        @endif
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Ketentuan KKOP</span>
                </div>
                <div class="column left">
                    <span>Nama Bandara</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_kkop']['nama_bandara'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Jenis KKOP</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_kkop']['jenis'] }}</span>
                </div>
            </div>
        </div>
        <br>
        @if (isset($ketentuan['ketentuan_potensi_rthrtb']))
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Ketentuan Potensi RTH dan RTB</span>
                </div>
                <div class="column left">
                    <span>Jenis Potensi</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_potensi_rthrtb']['jenis'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Sub Zona</span>
                </div>
                <div class="column right">
                    <span>{{ $ketentuan['ketentuan_potensi_rthrtb']['sub_zona'] }}</span>
                </div>
            </div>
        </div>
        <br>
        @endif

        @endif
        <br>
        @if (in_array('akses', $kategori))
        <p class="font-weight-bold mt-2 mb-2 text-center">Akses dalam Radius {{ session('poi') / 1000 }} KM</p>

        @if(isset($poi))
        @foreach ($poi as $key => $p)
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">{!! $key !!}</span>
                </div>
            </div>
            @foreach ($poi[$key] as $q)
            <div class="row-content">
                <div class="column left">
                    <span>{{ $q['Name'] }}</span>
                </div>
                <div class="column right">
                    <span>{{ round($q['Distance'] / 1000, 2) }} Km</span>
                </div>
            </div>
            @endforeach
        </div>
        <br>
        @endforeach
        @endif
        @endif
        <br>
        @if (in_array('kbli', $kategori))
        <p class="font-weight-bold mt-2 mb-2 text-center">KBLI</p>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Detail</span>
                </div>
                <div class="column left">
                    <span>Kode</span>
                </div>
                <div class="column right">
                    <a href="{{ $kbli['link'] }} }}" target="_blank">{{ $kbli['kode'] }}</a>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Kegiatan</span>
                </div>
                <div class="column right">
                    <span>{{ $kbli['kegiatan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Rekomendasi Bangunan</span>
                </div>
                <div class="column right">
                    <span>{{ $kbli['rekomendasi_bangunan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Ketentuan</span>
                </div>
                <div class="column right">
                    <span>{{ $kbli['ketentuan'] }}</span>
                </div>
            </div>
        </div>
        <br>
        @endif
        @if (in_array('lingkungan', $kategori))
        <p class="font-weight-bold mt-2 mb-2 text-center">Lingkungan (Peruntukan Bangunan : {{
            $lingkungan['peruntukan_bangunan'] }})</p>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Profil Lokasi</span>
                </div>
                <div class="column left">
                    <span>Luas Lahan</span>
                </div>
                <div class="column right">
                    <span>{{ $lingkungan['luas_lahan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>KDH</span>
                </div>
                <div class="column right">
                    <span>{{ $lingkungan['kdh'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>KLB</span>
                </div>
                <div class="column right">
                    <span>{{ $lingkungan['klb'] }}</span>
                </div>
            </div>
        </div>
        <br>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Asumsi</span>
                </div>
                <div class="column left">
                    <span>Pemakaian Air</span>
                </div>
                <div class="column right">
                    <span>{{ $lingkungan['pemakaian_air'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Debit Air Limbah</span>
                </div>
                <div class="column right">
                    <span>{{ $lingkungan['debit_air_limbah'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Sampah</span>
                </div>
                <div class="column right">
                    <span>{{ $lingkungan['sampah'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Standar Luas Bangunan</span>
                </div>
                <div class="column right">
                    <span>{{ $lingkungan['standar_luas_bangunan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Kebutuhan Air Bersih</span>
                </div>
                <div class="column right">
                    <span>{{ $lingkungan['kebutuhan_air_bersih'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Volume Limpasan Air Hujan</span>
                </div>
                <div class="column right">
                    <span>{{ $lingkungan['volume_limpasan_air_hujan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Jumlah Orang</span>
                </div>
                <div class="column right">
                    <span>{{ $lingkungan['jumlah_orang'] }}</span>
                </div>
            </div>
        </div>
        <br>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Kalkulasi Beban Lingkungan</span>
                </div>
                <div class="column left">
                    <span>Luas Limpasan Air Hujan</span>
                </div>
                <div class="column right">
                    <span>{{ $lingkungan['luas_limpahan_air_hujan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Luas Bangunan</span>
                </div>
                <div class="column right">
                    <span>{{ $lingkungan['luas_bangunan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Produksi Limbah Cair</span>
                </div>
                <div class="column right">
                    <span>{{ $lingkungan['produksi_limbah_cair'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Produksi Sampah</span>
                </div>
                <div class="column right">
                    <span>{{ $lingkungan['produksi_sampah'] }}</span>
                </div>
            </div>
        </div>
        <br>
        @endif
        @if (in_array('potensi', $kategori))
        <p class="font-weight-bold mt-2 mb-2 text-center">Potensi</p>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Asumsi</span>
                </div>
                <div class="column left">
                    <span>Fungsi Bangunan</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['fungsi_bangunan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Luas Lahan (m<sup>2</sup>)</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['luas_lahan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Luas Lahan Efektif (%)</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['luas_lahan_efektif'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>KLB</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['klb'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Luas Bangunan (m<sup>2</sup>)</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['luas_bangunan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Perkiraan NJOP (Rp/m<sup>2</sup>)</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['perkiraan_njop'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Faktor Pengali (%)</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['faktor_pengali'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Harga Tanah (Rp/m<sup>2</sup>)</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['harga_tanah'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Harga Sewa (Rp/m<sup>2</sup>/bulan)
                    </span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['harga_sewa'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Biaya Maintenance (%)</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['biaya_maintenance'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Cost of Capital (%)</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['cost_of_capital'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Property Market Index (%)</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['property_market_index'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Setara Harga Jual (Rp/m<sup>2</sup>)</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['setara_harga_jual'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Durasi Proyek (thn)</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['durasi_proyek'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Biaya Konstruksi (Rp/m<sup>2</sup>)</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['biaya_konstruksi'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Biaya Perencanaan (%)</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['biaya_perencanaan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Kewajiban Lingkungan (%)</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['kewajiban_lingkungan'] }}</span>
                </div>
            </div>
        </div>
        <br>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Pendapatan (Rp)</span>
                </div>
                <div class="column left">
                    <span>Pendapatan Penjualan</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['pendapatan_penjualan'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span class="font-weight-bold">Total Pendapatan</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['total_pendapatan'] }}</span>
                </div>
            </div>
        </div>
        <br>
        <div class="border-container p-1">
            <div class="row-content">
                <div class="border-bottom-container w-100" style="vertical-align: middle">
                    <span class="font-weight-bold" style="vertical-align: middle">Pengeluaran (Rp)</span>
                </div>
                <div class="column left">
                    <span>Perolehan Tanah</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['perolehan_tanah'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Biaya Konstruksi</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['biaya_konstruksi_pengeluaran'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span>Biaya Perencanaan</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['biaya_perencanaan_pengeluaran'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span class="font-weight-bold">Total Pengeluaran</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['total_pengeluaran'] }}</span>
                </div>
            </div>
            <br>
            <div class="row-content">
                <div class="column left">
                    <span class="font-weight-bold">Kewajiban Lingkungan
                    </span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['kewajiban_lingkungan_pengeluaran'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span class="font-weight-bold">Estimasi Laba</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['estimasi_laba'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span class="font-weight-bold">ROI</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['roi'] }}</span>
                </div>
            </div>
            <div class="row-content">
                <div class="column left">
                    <span class="font-weight-bold">IRR</span>
                </div>
                <div class="column right">
                    <span>{{ $potensi['irr'] }}</span>
                </div>
            </div>
        </div>
        <br>
        @endif

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