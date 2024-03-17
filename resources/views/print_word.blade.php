<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>

    <style>
        th {
            text-align: left;
        }

        /* .img_logo {
            position: absolute;
            top: 0;
            left: 0;
        } */

        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .page-break {
            page-break-before: always;
        }

        /* th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        } */

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

    <div style="font-family:Arial;">

        <h2 style="text-align: center">Ringkasan Informasi</h2>

        <br>

        <table style="border:none !important; font-family:Arial;">
            <tr>
                <h3>Peta Lokasi</h3>
            </tr>
            <tr>
                <td style="padding: 0; text-align:center;">
                    <img width="600" height="250" class="img_logo" src="{{ $image_map }}">
                </td>
            </tr>
        </table>

        <br>

        @if (in_array('profil', $kategori))
        <h3 style="text-align: center">Profil</h3>
        <table style="font-family:Arial;">
            <tr>
                <th colspan="2" style="border-bottom: 1px solid black;">
                    <h4>
                        Lokasi
                    </h4>
                </th>
            </tr>

            <tr>
                <td>Koordinat</td>
                {{-- <td style="font-weight: lighter;">Koordinat</td> --}}
                <td><a href="https://www.google.com/maps/search/%09{{ $coordinates[0] }},{{ $coordinates[1] }}"
                        target="_blank" id="kordinat">{{ $coordinates[0] }},{{ $coordinates[1] }}</a></td>
            </tr>

            <tr>
                <td>Kelurahan</td>
                <td>{{ ucwords(strtolower($wilayah['Kelurahan'])) }}</td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>{{ ucwords(strtolower($wilayah['Kecamatan'])) }}</td>
            </tr>
            <tr>
                <td>Wilayah</td>
                <td>{{ ucwords(strtolower($wilayah['Kota'])) }}</td>
            </tr>
            <tr>
                <td>Luas Wilayah</td>
                <td>{{ number_format($wilayah['Luas'] / 10000, 2, '.', '') }} ha</td>
            </tr>
            <tr>
                <td>Kepadatan</td>
                <td>{{ number_format($wilayah['Kepadatan-Penduduk']) }} jiwa per km2</td>
            </tr>
            <tr>
                <td>Rasio Gini</td>
                <td>{{ $wilayah['Gini'] }}</td>
            </tr>
        </table>

        <br>


        {{-- Persil --}}
        <table style="font-family:Arial;">
            <tr>
                <th colspan="2" style="border-bottom: 1px solid black;">
                    <h4>Persil</h4>
                </th>
            </tr>
            <tr>
                <td>Kegiatan</td>
                <td>{{ ucwords(strtolower(isset($eksisting['Kegiatan']) ? $eksisting['Kegiatan'] : "-"))
                    }}</td>
            </tr>
            @if($njop !== null)
            <tr>
                <td>Perkiraan NJOP</td>
                <td>Rp. {{ number_format($njop['Min']) }}, Rp. {{ number_format($njop['Max']) }} per m²</td>
            </tr>
            @endif
            <tr>
                <td>Rerata NJOP</td>
                <td>Rp. {{ number_format($rerata_njop['Mean']) }} per m²</td>
            </tr>
            <tr>
                <td>Tipe Hak</td>
                <td>{{ $bpn !== null ? $bpn['Tipe'] : '-' }}</td>
            </tr>
            <tr>
                <td>Luas</td>
                <td>{{ $bpn !== null ? number_format($bpn['Luas']) . ' m²' : '-' }}</td>
            </tr>

        </table>

        <br>
        <table style="font-family:Arial;">
            <tr>
                <th colspan="2" style="border-bottom: 1px solid black;">
                    <h4>
                        Usaha Mikro Kecil
                    </h4>
                </th>
            </tr>
            <tr>
                <td>Pemilik IUMK</td>
                <td>{{ number_format($wilayah['Jumlah']) }} Orang</td>
            </tr>
            <tr>
                <td>Total Omzet</td>
                <td>Rp. {{ number_format($wilayah['Total Omzet']) }} per m²</td>
            </tr>
        </table>

        <br>
        <table style="font-family:Arial;">
            <tr>
                <th colspan="2" style="border-bottom: 1px solid black;">
                    <h4>
                        Pendapatan Rata Rata Per Bulan
                    </h4>
                </th>

            </tr>
            <tr>
                <td>Rp. 0 - 5 Juta</td>
                <td>{{ $wilayah['P1'] }} %</td>
            </tr>
            <tr>
                <td>Rp. 6 - 10 Juta</td>
                <td>{{ $wilayah['P2'] }} %</td>
            </tr>
            <tr>
                <td>Rp. 11 - 15 Juta</td>
                <td>{{ $wilayah['P3'] }} %</td>
            </tr>
            <tr>
                <td>Rp. 16 - 20 Juta</td>
                <td>{{ $wilayah['P4'] }} %</td>
            </tr>
            <tr>
                <td>Lebih dari Rp. 20 Juta</td>
                <td>{{ $wilayah['P5'] }} %</td>
            </tr>
            <tr>
                <td>Tidak Menjawab</td>
                <td>{{ $wilayah['P6'] }} %</td>
            </tr>
        </table>

        <br>
        <br>
        <table style="font-family:Arial;">
            <tr style="border-bottom: 1px solid black;">
                <td colspan="2">
                    <h4>Distribusi Usaha Mikro Kecil</h4>
                </td>
            </tr>
            <tr>
                <td style="padding: 0; text-align:center;">
                    <img width="230" height="200" class="img_logo"
                        src="https://quickchart.io/chart?width=340&;height=300&c={ type: %27pie%27, data: { labels: [%27Produksi%27, %27Perdagangan%27, %27Jasa%27], datasets: [ { label: %27Kelurahan%27, backgroundColor: [%27rgb(237, 64, 60)%27, %27rgb(248, 165, 27)%27, %27rgb(163, 33, 142)%27], data: [{{ $wilayah['Produksi'] }}, {{ $wilayah['Perdagangan'] }}, {{ $wilayah['Jasa'] }}], }, ], }, options: { title: { display: true, }, legend: { align: %27start%27, }, bezierCurve: false, } }">
                </td>
                <td style="padding: 0; text-align:center;">
                    <img width="200" height="200" class="img_logo"
                        src="https://quickchart.io/chart?width=250&;height=500&c={ type: %22bar%22, data: { labels: [%2220-29%22, %2230-39%22, %2240-49%22, %2250-59%22, %2260-69%22], datasets: [ { backgroundColor: %22rgb(3, 164, 94)%22, data: [{{ $wilayah['U1'] }},{{ $wilayah['U2'] }},{{ $wilayah['U3'] }},{{ $wilayah['U4'] }},{{ $wilayah['U5'] }}], }, ], }, options: { legend: { display: false, }, scales: { yAxes: [ { scaleLabel: { display: true, labelString: %22Jumlah%22, }, }, ], xAxes: [ { scaleLabel: { display: true, labelString: %22Usia%22, barPercentage: 0.2, categoryPercentage: 0.2, }, }, ], }, bezierCurve: false, }, }">
                </td>
            </tr>
        </table>

        <br>
        <table style="font-family:Arial;">
            <tr style="border-bottom: 1px solid black;">
                <td colspan="2">
                    <h4>Distribusi Sektor</h4>
                </td>
            </tr>
            <tr>
                <td style="padding: 0; width: 40%; text-align:center;">
                    <img width="230" height="200" class="img_logo"
                        src="https://quickchart.io/chart?width=340&;height=300&c={%20type:%20%27pie%27,%20data:%20{%20labels:%20[{{ $distribusi_nib['sektor'] }}],%20datasets:%20[%20{%20backgroundColor:%20[{{ $distribusi_nib['color'] }}],%20data:%20[{{  $distribusi_nib['jumlah'] }}]%20},%20],%20},%20options:%20{%20title:%20{%20display:%20true,%20},%20legend:%20{%20position:%20%27right%27,%20display: false},%20}%20}">
                </td>
                <td style="padding: 0; width: 60%; text-align:left;">
                    <ul class="chartjs-legend">
                        @foreach ($distribusi_nib['legend']['label'] as $index => $dl)
                        <div id="legend-{{ $index }}-item" class="legend-item">
                            <span style="background-color:
                                {{ $distribusi_nib['legend']['hex_color'][$index] }}">
                                &nbsp;&nbsp;&nbsp;&nbsp;
                            </span>
                            <span class="label">&nbsp;{{ $dl }}</span>
                        </div>
                        @endforeach
                    </ul>
                </td>
            </tr>
        </table>

        <br>
        <table style="font-family:Arial;">
            <tr style="border-bottom: 1px solid black;">
                <td colspan="2">
                    <h4>Investasi Per Sektor</h4>
                </td>
            </tr>
            <tr>
                <td style="padding: 0; width: 40%; text-align:center;">
                    <img width="230" height="200" class="img_logo"
                        src="https://quickchart.io/chart?width=340&;height=300&c={%20type:%20%27pie%27,%20data:%20{%20labels:%20[{{ $distribusi_nib['sektor'] }}],%20datasets:%20[%20{%20backgroundColor:%20[{{ $distribusi_nib['color'] }}],%20data:%20[{{  $distribusi_nib['jumlah_investasi'] }}]%20},%20],%20},%20options:%20{%20title:%20{%20display:%20true,%20},%20legend:%20{%20position:%20%27right%27,%20display: false},%20}%20}">
                </td>
                <td style="padding: 0; width: 60%; text-align:left;">
                    <ul class="chartjs-legend">
                        @foreach ($distribusi_nib['legend']['label'] as $index => $dl)
                        <div id="legend-{{ $index }}-item" class="legend-item">
                            <span style="background-color:
                                {{ $distribusi_nib['legend']['hex_color'][$index] }}">
                                &nbsp;&nbsp;&nbsp;&nbsp;
                            </span>
                            <span class="label">&nbsp;{{ $dl }}</span>
                        </div>
                        @endforeach
                    </ul>
                </td>
            </tr>
        </table>

        <br>
        <table style="font-family:Arial;">
            <tr style="border-bottom: 1px solid black;">
                <td colspan="2">
                    <h4>Serapan Tenaga Kerja</h4>
                </td>
            </tr>
            <tr>
                <td style="padding: 0; width: 40%; text-align:center;">
                    <img width="230" height="200" class="img_logo"
                        src="https://quickchart.io/chart?width=340&;height=300&c={%20type:%20%27pie%27,%20data:%20{%20labels:%20[{{ $distribusi_nib['sektor'] }}],%20datasets:%20[%20{%20backgroundColor:%20[{{ $distribusi_nib['color'] }}],%20data:%20[{{  $distribusi_nib['tenaga_kerja'] }}]%20},%20],%20},%20options:%20{%20title:%20{%20display:%20true,%20},%20legend:%20{%20position:%20%27right%27,%20display: false},%20}%20}">
                </td>
                <td style="padding: 0; width: 60%; text-align:left;">
                    <ul class="chartjs-legend">
                        @foreach ($distribusi_nib['legend']['label'] as $index => $dl)
                        <div id="legend-{{ $index }}-item" class="legend-item">
                            <span style="background-color:
                                {{ $distribusi_nib['legend']['hex_color'][$index] }}">
                                &nbsp;&nbsp;&nbsp;&nbsp;
                            </span>
                            <span class="label">&nbsp;{{ $dl }}</span>
                        </div>
                        @endforeach
                    </ul>
                </td>
            </tr>
        </table>

        <br>
        <table style="font-family:Arial;">
            <tr>
                <th colspan="3" style="border-bottom: 1px solid black;">
                    <h4>Luas Sub Zona Berdasar Perda 1/2014</h4>
                </th>
            </tr>
            @foreach ($distribusi_wilayah['2014'] as $dw)
            <tr>
                <td>{{ $dw['sub_zona'] }}</td>
                <td>{{ number_format(round($dw['luas']), 0, ",", ".") }} m<sup>2</sup></td>
                <td>{{ number_format(round((float)$dw['percent'],2), 2, ",", ".") }}%</td>
            </tr>
            @endforeach
        </table>

        <br>
        <table style="font-family:Arial;">
            <tr>
                <th colspan="3" style="border-bottom: 1px solid black;">
                    <h4>Luas Sub Zona Berdasar Pergub 31/2022</h4>
                </th>
            </tr>
            @foreach ($distribusi_wilayah['2022'] as $dw)
            <tr>
                <td>{{ $dw['sub_zona'] }}</td>
                <td>{{ number_format(round($dw['luas']), 0, ",", ".") }} m<sup>2</sup></td>
                <td>{{ number_format(round((float)$dw['percent'],2), 2, ",", ".") }}%</td>
            </tr>
            @endforeach
        </table>

        @endif
        <br>
        @if(in_array('indikator', $kategori))
        @if ($urban != null)
        <table style="font-family:Arial; border-bottom:none;">
            <tr>
                <th colspan="4" style="border-bottom: 1px solid black;">
                    <h4>
                        Indikator
                    </h4>
                </th>
            </tr>
            <tr>
                <th colspan="4">
                    <h4>
                        Urban Index ({{ $urban['urbanindex'] }} - {{
                        $urban['kategori_desk_umum'] }})
                    </h4>
                </th>
            </tr>
            @foreach (explode(", ", $urban['deskripsi_khusus']) as $i => $u)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $u }}</td>
            </tr>
            @endforeach
            <tr></tr>

            <tr>
                <th colspan="4">
                    <h4>
                        Environment Carrying Capacity Index ({{
                        number_format((float)$ddl['score_all'], 2, '.', '') }} / 5.00)
                    </h4>
                </th>
            </tr>

            @php
            $iddl = 1;
            @endphp
            @foreach ($ddl['detail'][0] as $key => $d)
            <tr>
                <td>{{ $iddl++ }}</td>
                <td>. {{ $ddl['detail'][0][$key] }}</td>
            </tr>
            @endforeach

        </table>

        <table
            style="border-left: 1px solid black; border-right: 1px solid black; border-top:none; border-bottom:none;">


            <tr>
                <td style="padding: 0; text-align: center;">
                    <img class="img_logo" width="250" height="150"
                        src="https://quickchart.io/chart?width=500&;height=500&c={ type: 'radar', data: { labels: ['Topografi', 'Kebencanaan', 'Ketersediaan Air', 'Kualitas Vegetasi', 'Pengelolaan Limbah',], datasets: [ { label: ' ', data: [ {{ $ddl['score'][0]['topografi'] }}, {{ $ddl['score'][0]['kebencanaan'] }}, {{ $ddl['score'][0]['ketersediaan_air'] }}, {{ $ddl['score'][0]['kualitas_vegetasi'] }}, {{ $ddl['score'][0]['pengolahan_limbah'] }}, ], fill: true, backgroundColor: 'rgba(255, 99, 132, 0.2)', borderColor: 'rgb(255, 99, 132)', pointBackgroundColor: 'rgb(255, 99, 132)', pointBorderColor: 'white', pointHoverBackgroundColor: 'white', pointHoverBorderColor: 'rgb(255, 99, 132)', }, ], }, options: { elements: { line: { borderWidth: 3, }, }, legend: { display: false, }, }, }">
                </td>
            </tr>
        </table>

        <table style="font-family:Arial; border-top:none; border-bottom:none;">


            <tr>
                <th colspan="4">
                    <h4>
                        Livability Index ({{ number_format((float)$livability['livability'],
                        2, '.',
                        '') }} / 9.00 - {{ $livability['deskripsi'][0]['livability'] }})
                    </h4>
                </th>
            </tr>
            @php
            $idliv = 1;
            @endphp
            @foreach($livability['deskripsi'][0] as $key => $l)
            @if($key !== 'livability')
            <tr>
                <td>{{ $idliv++ }}</td>
                <td>{{ $livability['deskripsi'][0][$key] }}</td>
            </tr>
            @endif
            @endforeach

        </table>

        <table style="border-top:none;">
            <tr>
                <td style="padding: 0; text-align: center;">
                    <img class="img_logo" width="250" height="150"
                        src="https://quickchart.io/chart?width=500&;height=500&c={ type: 'radar', data: { labels: [ ['Konektivitas', 'Pejalan Kaki'], 'Ruang Terbuka dan Publik', 'Fasilitas Komunitas', 'Aktivitas Budaya Perkotaan', 'Lokasi Bekerja', 'Pelayanan Kesehatan', 'Pendidikan', 'Transportasi Publik', 'Campuran Guna Lahan', ], datasets: [ { data: [ {{ $livability['indeks_kon'] }}, {{ $livability['ruang_terbuka'] }}, {{ $livability['fasilitas'] }}, {{ $livability['budaya'] }}, {{ $livability['pekerjaan'] }}, {{ $livability['pelayanan'] }}, {{ $livability['pendidikan'] }}, {{ $livability['transportasi'] }}, {{ $livability['entropy'] }} ], fill: true, backgroundColor: 'rgba(133, 99, 255, 0.2)', borderColor: 'rgb(133, 99, 255)', pointBackgroundColor: 'rgb(133, 99, 255)', pointBorderColor: 'white', pointHoverBackgroundColor: 'white', pointHoverBorderColor: 'rgb(133, 99, 255)', }, ], }, options: { elements: { line: { borderWidth: 3, }, }, legend: { display: false, }, scale: { ticks: { beginAtZero: true, max: 5, min: 0, stepSize: 1, }, }, }, }">
                </td>
            </tr>
        </table>
        @endif
        @endif
        {{-- Ketentuan --}}
        <br>
        @if (in_array('ketentuan', $kategori))
        <h3 style="text-align: center">Ketentuan</h3>
        <table style="font-family:Arial;">
            <tr>
                <th colspan="2" style="border-bottom: 1px solid black;">
                    <h4>
                        Identitas Zonasi
                    </h4>
                </th>

            </tr>
            <tr>
                <td>Zona</td>
                <td>{{ $ketentuan['identitas_zonasi']['zona'] }}</td>
            </tr>
            <tr>
                <td>Sub Zona</td>
                <td>{{ $ketentuan['identitas_zonasi']['sub_zona'] }}</td>
            </tr>
            <tr>
                <td>Kode Sub Zona</td>
                <td>{{ $ketentuan['identitas_zonasi']['kode_sub_zona'] }}</td>
            </tr>
            <tr>
                <td>ID Blok </td>
                <td>{{ $ketentuan['identitas_zonasi']['id_blok'] }}</td>
            </tr>
            <tr>
                <td>ID Sub Blok</td>
                <td>{{ $ketentuan['identitas_zonasi']['id_sub_blok'] }}</td>
            </tr>

        </table>

        <br>
        <table style="font-family:Arial;">
            <tr>
                <th colspan="2" style="border-bottom: 1px solid black;">
                    <h4>
                        Intensitas Pemanfaatan Ruang
                    </h4>
                </th>

            </tr>
            <tr>
                <td>Luas Lahan</td>
                <td>{{ $ketentuan['intensitas_pemanfaatan_ruang']['luas_lahan'] }}</td>
            </tr>
            <tr>
                <td>KDB</td>
                <td>{{ $ketentuan['intensitas_pemanfaatan_ruang']['kdb'] }}</td>
            </tr>
            <tr>
                <td>KLB</td>
                <td>{{ $ketentuan['intensitas_pemanfaatan_ruang']['klb'] }}</td>
            </tr>
            <tr>
                <td>KDH</td>
                <td>{{ $ketentuan['intensitas_pemanfaatan_ruang']['kdh'] }}</td>
            </tr>
            <tr>
                <td>Ketinggian Bangunan</td>
                <td>{{ $ketentuan['intensitas_pemanfaatan_ruang']['ketinggian_bangunan'] }}</td>
            </tr>

        </table>

        <br>
        <table style="font-family:Arial;">
            <tr>
                <th colspan="2" style="border-bottom: 1px solid black;">
                    <h4>
                        Ketentuan Kegiatan & Penggunaan Lahan
                    </h4>
                </th>

            </tr>
            <tr>
                <td width="50">Jenis Bangunan</td>
                <td width="50">{{ $ketentuan['ketentuan_penggunaan_lahan']['jenis_bangunan'] }}</td>
            </tr>
            <tr>
                <td width="50">Definisi Bangunan</td>
                <td width="50">
                    {{ $ketentuan['ketentuan_penggunaan_lahan']['definisi_bangunan'] }}
                </td>
            </tr>
            <tr>
                <td width="50">Perizinan</td>
                <td width="50">{{ $ketentuan['ketentuan_penggunaan_lahan']['perizinan'] }} </td>
            </tr>
            <tr>
                <td width="50">Keterangan</td>
                <td width="50">{{ $ketentuan['ketentuan_penggunaan_lahan']['keterangan'] == null ? "-" :
                    $ketentuan['ketentuan_penggunaan_lahan']['keterangan']}}</td>
            </tr>

        </table>

        <br>
        <table style="font-family:Arial;">
            <tr>
                <th style="border-bottom: 1px solid black;">
                    <h4>
                        Ketentuan Tata Bangunan (non GSB)
                    </h4>
                </th>

            </tr>
            <tr>
                <td>Garis Sempadan Non Bangunan</td>
            </tr>
            <tr>
                <td>
                    <ol>{!! $ketentuan['ketentuan_tata_bangunan']['gsnb'] !!}</ol>
                </td>
            </tr>
        </table>

        <br>
        <table style="font-family:Arial;">
            <tr>
                <th style="border-bottom: 1px solid black;">
                    <h4>
                        Ketentuan Tata Bangunan (GSB)
                    </h4>
                </th>

            </tr>
            <tr>
                <td>Garis Sempadan Bangunan</td>
            </tr>
            <tr>
                <td>
                    <ol>
                        {!! $ketentuan['ketentuan_tata_bangunan']['gsb'] !!}
                    </ol>
                </td>
            </tr>
        </table>

        <br>
        <table style="font-family:Arial; border-bottom:none;">
            <tr>
                <th colspan="2" style="border-bottom: 1px solid black;">
                    <h4>
                        Ketentuan Hunian
                    </h4>
                </th>

            </tr>
            <tr>
                <td>Jenis Fungsi Hunian </td>
                <td>{{ $ketentuan['ketentuan_hunian']['jenis_hunian'] }}</td>
            </tr>
            <tr>
                <td>Tipikal</td>
                <td>{{ $ketentuan['ketentuan_hunian']['tipikal'] }}</td>
            </tr>
            <tr>
                <td>Luas Lahan</td>
                <td>{{ $ketentuan['ketentuan_hunian']['luas_lahan'] }}</td>
            </tr>
            <tr>
                <td>KDB</td>
                <td>{{ $ketentuan['ketentuan_hunian']['etc'] == null ? '-' :
                    $ketentuan['ketentuan_hunian']['etc']['kdb'] }}</td>
            </tr>
            <tr>
                <td>KLB</td>
                <td>{{ $ketentuan['ketentuan_hunian']['etc'] == null ? '-' :
                    $ketentuan['ketentuan_hunian']['etc']['klb'] }}</td>
            </tr>
            <tr>
                <td>KDH</td>
                <td>{{ $ketentuan['ketentuan_hunian']['etc'] == null ? '-' :
                    $ketentuan['ketentuan_hunian']['etc']['kdh'] }}</td>
            </tr>
            <tr>
                <td>Tinggian Bangunan</td>
                <td>{{ $ketentuan['ketentuan_hunian']['etc'] == null ? '-' :
                    $ketentuan['ketentuan_hunian']['etc']['ktb'] }}</td>
            </tr>

        </table>
        @if($ketentuan['ketentuan_hunian']['etc'] !== null)
        <table style="font-family:Arial; border-top:none;">
            @for ($i = 1; $i <= 15; $i++) @if($ketentuan['ketentuan_hunian']['etc']["ketentuan_$i"] !=="-" ) <tr>
                <td>{{ $i }}</td>
                <td>{{
                    $ketentuan['ketentuan_hunian']['etc']["ketentuan_$i"] }}
                </td>
                </tr>
                @endif
                @endfor
        </table>
        @endif
        <br>
        @if(isset($ketentuan['ketentuan_variansi']))
        <table style="font-family:Arial;">
            <tr>
                <th colspan="2" style="border-bottom: 1px solid black;">

                    <h4>
                        Variansi Pemanfaatan Ruang Pada Zona RTH
                    </h4>
                </th>

            </tr>

            <tr>
                <td>Jenis Bangunan</td>
                <td>
                    {{ $ketentuan['ketentuan_variansi']['jenis_bangunan'] }}
                </td>
            </tr>
            <tr>
                <td>Fungsi Bangunan </td>
                <td>
                    {{ $ketentuan['ketentuan_variansi']['etc']['fungsi_bangunan'] }}
                </td>
            </tr>
            <tr>
                <td>Ketentuan Perizinan</td>
                <td>
                    {{ $ketentuan['ketentuan_variansi']['etc']['ketentuan_perizinan'] }}
                </td>
            </tr>
            <tr>
                <td>Jenis Variansi</td>
                <td>
                    {{ $ketentuan['ketentuan_variansi']['etc']['jenis_variansi'] }}
                </td>
            </tr>
            @for ($i = 1; $i <= 9; $i++) @if($ketentuan['ketentuan_variansi']['etc']["ketentuan_$i"] !==null ) <tr>
                <td>{{ $i }}.</td>
                <td>
                    {{
                    $ketentuan['ketentuan_variansi']['etc']["ketentuan_$i"] }}
                </td>
                </tr>
                @endif
                @endfor
        </table>
        @endif

        <br>
        @if(isset($ketentuan['ketentuan_tpz']))
        <table style="font-family:Arial;">
            <tr>
                <th colspan="2" style="border-bottom: 1px solid black;">
                    <h4>
                        Ketentuan TPZ
                    </h4>
                </th>

            </tr>

            @foreach ($ketentuan['ketentuan_tpz'] as $ktpz)
            @foreach ($ktpz as $key => $value)
            @if ($key == "Link_PDF" || $key == "Ketentuan")
            <tr>
                <td colspan="2">
                    <span>{!! $value !!}</span>
                </td>
            </tr>
            @elseif ($key == "List_File")
            @else
            <tr>
                <td>
                    <span>{{ str_replace("_", " ", $key) }}</span>
                </td>
                <td>
                    <span>{{ $value }}</span>
                </td>
            </tr>
            @endif
            @endforeach
            <br>
            @endforeach

        </table>
        @endif
        <br>
        @if (isset($ketentuan['ketentuan_rawan_bencana']))
        <table style="font-family:Arial;">
            <tr>
                <th colspan="2" style="border-bottom: 1px solid black;">
                    <h4>
                        Ketentuan Rawan Bencana
                    </h4>
                </th>
            </tr>
            <tr>
                <td>Jenis Kawasan</td>
                <td>{{ $ketentuan['ketentuan_rawan_bencana']['nama_kawasan'] }}</td>
            </tr>
            <tr>
                <td>Resiko</td>
                <td>{{ $ketentuan['ketentuan_rawan_bencana']['resiko'] }}</td>
            </tr>
            <tr>
                <td colspan="2">
                    <ol>{!! $ketentuan['ketentuan_rawan_bencana']['ketentuan'] !!}</ol>
                </td>
            </tr>
        </table>
        @endif
        <table style="font-family:Arial;">
            <tr>
                <th colspan="2" style="border-bottom: 1px solid black;">
                    <h4>
                        Ketentuan KKOP
                    </h4>
                </th>
            </tr>

            <tr>
                <td>Nama Bandara</td>
                <td>
                    {{ $ketentuan['ketentuan_kkop']['nama_bandara'] }}
                </td>
            </tr>
            <tr>
                <td>Jenis KKOP</td>
                <td>
                    {{ $ketentuan['ketentuan_kkop']['jenis'] }}
                </td>
            </tr>

        </table>

        @if (isset($ketentuan['ketentuan_potensi_rthrtb']))
        <table style="font-family:Arial;">
            <tr>
                <th colspan="2" style="border-bottom: 1px solid black;">
                    <h4>
                        Ketentuan Potensi RTH dan RTB
                    </h4>
                </th>
            </tr>

            <tr>
                <td>Jenis Potensi</td>
                <td>
                    {{ $ketentuan['ketentuan_potensi_rthrtb']['jenis'] }}
                </td>
            </tr>
            <tr>
                <td>Sub Zona</td>
                <td>
                    {{ $ketentuan['ketentuan_potensi_rthrtb']['sub_zona'] }}
                </td>
            </tr>

        </table>
        @endif
        @endif
        <br>
        @if (in_array('akses', $kategori))
        <h3 style="text-align: center">Akses dalam Radius {{ session('poi') / 1000 }} KM</h3>

        @if(isset($poi))
        @foreach ($poi as $key => $p)
        <table style="font-family:Arial;">
            <tr>
                <th colspan="2" style="border-bottom: 1px solid black;">
                    <h4>{!! $key !!}</h4>
                </th>
            </tr>
            @foreach ($poi[$key] as $q)
            <tr>
                <td>{{ $q['Name'] }}</td>
                <td>{{ round($q['Distance'] / 1000, 2) }} Km</td>
            </tr>
            @endforeach
        </table>

        <br>
        @endforeach
        @endif
        @endif

        <br>
        @if (in_array('kbli', $kategori))
        <h3 style="text-align: center">KBLI</h3>
        <table style="font-family:Arial;">
            <tr>
                <th colspan="2" style="border-bottom: 1px solid black;">
                    <h4>
                        Detail
                    </h4>
                </th>

            </tr>
            <tr>
                <td>Kode</td>
                <td><a href="{{ $kbli['link'] }} }}" target="_blank">{{ $kbli['kode'] }}</a></td>
            </tr>
            <tr>
                <td>Kegiatan</td>
                <td>{{ $kbli['kegiatan'] }}</td>
            </tr>
            <tr>
                <td>Rekomendasi Bangunan</td>
                <td>{{ $kbli['rekomendasi_bangunan'] }}</td>
            </tr>
            <tr>
                <td>Ketentuan</td>
                <td>{{ $kbli['ketentuan'] }}</td>
            </tr>

        </table>
        @endif

        <br>
        @if (in_array('lingkungan', $kategori))
        <h3 style="text-align: center">Lingkungan (Peruntukan Bangunan : {{
            $lingkungan['peruntukan_bangunan'] }})</h3>
        <table style="font-family:Arial;">
            <tr>
                <th colspan="2" style="border-bottom: 1px solid black;">
                    <h4>Profil Lokasi</h4>
                </th>
            </tr>
            <tr>
                <td>Luas Lahan</td>
                <td>{{ $lingkungan['luas_lahan'] }}</td>
            </tr>
            <tr>
                <td>KDH </td>
                <td>{{ $lingkungan['kdh'] }}</td>
            </tr>
            <tr>
                <td>KLB</td>
                <td>{{ $lingkungan['klb'] }}</td>
            </tr>
        </table>

        <br>
        <table style="font-family:Arial;">
            <tr>
                <th colspan="2" style="border-bottom: 1px solid black;">
                    <h4>Asumsi</h4>
                </th>
            </tr>
            <tr>
                <td>Pemakaian Air</td>
                <td>{{ $lingkungan['pemakaian_air'] }} </td>
            </tr>
            <tr>
                <td>Debit Air Limbah</td>
                <td>{{ $lingkungan['debit_air_limbah'] }}</td>
            </tr>
            <tr>
                <td>Sampah</td>
                <td>{{ $lingkungan['sampah'] }}</td>
            </tr>
            <tr>
                <td>Standar Luas Bangunan</td>
                <td>{{ $lingkungan['standar_luas_bangunan'] }}</td>
            </tr>
            <tr>
                <td>Kebutuhan Air Bersih</td>
                <td>{{ $lingkungan['kebutuhan_air_bersih'] }}</td>
            </tr>
            <tr>
                <td>Volume Limpasan Air Hujan</td>
                <td>{{ $lingkungan['volume_limpasan_air_hujan'] }}</td>
            </tr>
            <tr>
                <td>Jumlah Orang</td>
                <td>{{ $lingkungan['jumlah_orang'] }}</td>
            </tr>
        </table>

        <br>
        <table style="font-family:Arial;">
            <tr>
                <th colspan="2" style="border-bottom: 1px solid black;">
                    <h4>Kalkulasi Beban Lingkungan</h4>
                </th>
            </tr>
            <tr>
                <td>Luas Limpasan Air Hujan</td>
                <td>{{ $lingkungan['luas_limpahan_air_hujan'] }}</td>
            </tr>
            <tr>
                <td>Luas Bangunan</td>
                <td>{{ $lingkungan['luas_bangunan'] }}</td>
            </tr>
            <tr>
                <td>Produksi Limbah Cair</td>
                <td>{{ $lingkungan['produksi_limbah_cair'] }}</td>
            </tr>
            <tr>
                <td>Produksi Sampah </td>
                <td>{{ $lingkungan['produksi_sampah'] }}</td>
            </tr>
        </table>
        @endif

        <br>
        @if (in_array('potensi', $kategori))
        <h3 style="text-align: center">Potensi</h3>
        <table style="font-family:Arial;">
            <tr>
                <th colspan="4" style="border-bottom: 1px solid black;">
                    <h4>
                        Asumsi</h4>
                </th>
            </tr>

            <tr>
                <td>Fungsi Bangunan</td>
                <td>{{ $potensi['fungsi_bangunan'] }}</td>
            </tr>
            <tr>
                <td>Luas Lahan (m<sup>2</sup>)</td>
                <td>{{ $potensi['luas_lahan'] }}</td>
            </tr>
            <tr>
                <td>Luas Lahan Efektif (%)</td>
                <td>{{ $potensi['luas_lahan_efektif'] }}</td>
            </tr>
            <tr>
                <td>KLB</td>
                <td>{{ $potensi['klb'] }}</td>
            </tr>
            <tr>
                <td>Luas Bangunan (m<sup>2</sup>)</td>
                <td>{{ $potensi['luas_bangunan'] }}</td>
            </tr>
            <tr>
                <td>Perkiraan NJOP (Rp/m<sup>2</sup>)</td>
                <td>{{ $potensi['perkiraan_njop'] }}</td>
            </tr>
            <tr>
                <td>Faktor Pengali (%)</td>
                <td>{{ $potensi['faktor_pengali'] }}</td>
            </tr>
            <tr>
                <td>Harga Tanah (Rp/m<sup>2</sup>)</td>
                <td>{{ $potensi['harga_tanah'] }}</td>
            </tr>
            <tr>
                <td>Harga Sewa (Rp/m<sup>2</sup>/bulan)</td>
                <td>{{ $potensi['harga_sewa'] }}</td>
            </tr>
            <tr>
                <td>Biaya Maintenance (%)</td>
                <td>{{ $potensi['biaya_maintenance'] }}</td>
            </tr>
            <tr>
                <td>Cost of Capital (%)</td>
                <td>{{ $potensi['cost_of_capital'] }}</td>
            </tr>
            <tr>
                <td>Property Market Index (%)</td>
                <td>{{ $potensi['property_market_index'] }}</td>
            </tr>
            <tr>
                <td>Setara Harga Jual (Rp/m<sup>2</sup>)</td>
                <td>{{ $potensi['setara_harga_jual'] }}</td>
            </tr>
            <tr>
                <td>Durasi Proyek (thn)</td>
                <td>{{ $potensi['durasi_proyek'] }}</td>
            </tr>
            <tr>
                <td>Biaya Konstruksi (Rp/m<sup>2</sup>)</td>
                <td>{{ $potensi['biaya_konstruksi'] }}</td>
            </tr>
            <tr>
                <td>Biaya Perencanaan (%)</td>
                <td>{{ $potensi['biaya_perencanaan'] }}</td>
            </tr>
            <tr>
                <td>Kewajiban Lingkungan (%)</td>
                <td>{{ $potensi['kewajiban_lingkungan'] }}</td>
            </tr>

        </table>


        <br>
        <table style="font-family:Arial;">
            <tr>
                <th colspan="4" style="border-bottom: 1px solid black;">
                    <h4>
                        Pendapatan (Rp)</h4>
                </th>
            </tr>

            <tr>
                <td>Pendapatan Penjualan </td>
                <td>{{ $potensi['pendapatan_penjualan'] }}</td>
            </tr>
            <tr>
                <td>
                    <h5>Total Pendapatan</h5>
                </td>

                <td>
                    {{ $potensi['total_pendapatan'] }}
                </td>
            </tr>

        </table>

        <br>
        <table style="font-family:Arial;">
            <tr>
                <th colspan="4" style="border-bottom: 1px solid black;">
                    <h4>
                        Pengeluaran (Rp)</h4>
                </th>
            </tr>

            <tr>
                <td>Perolehan Tanah</td>
                <td>{{ $potensi['perolehan_tanah'] }}</td>
            </tr>
            <tr>
                <td>Biaya Konstruksi </td>
                <td>{{ $potensi['biaya_konstruksi_pengeluaran'] }}</td>
            </tr>
            <tr>
                <td>Biaya Perencanaan </td>
                <td>{{ $potensi['biaya_perencanaan_pengeluaran'] }}</td>
            </tr>

            <tr>
                <td>
                    <h5>Total Pengeluaran</h5>
                </td>
                <td>
                    {{ $potensi['total_pengeluaran'] }}
                </td>
            </tr>
            <tr>
                <td>
                    <h5>Kewajiban Lingkungan </h5>
                </td>
                <td>
                    {{ $potensi['kewajiban_lingkungan_pengeluaran'] }}
                </td>
            </tr>
            <tr>
                <td>
                    <h5>Estimasi Laba</h5>
                </td>
                <td>
                    {{ $potensi['estimasi_laba'] }}
                </td>
            </tr>
            <tr>
                <td>
                    <h5>ROI</h5>
                </td>
                <td>
                    {{ $potensi['roi'] }}
                </td>
            </tr>
            <tr>
                <td>
                    <h5>IRR</h5>
                </td>
                <td>
                    {{ $potensi['irr'] }}
                </td>
            </tr>

        </table>
        @endif
    </div>
    @if (isset($lampiran))
    @foreach ($lampiran as $l)
    <br clear=all style='page-break-before:always'>
    @include("ketentuan_tpz.$l")
    @endforeach
    @endif
</body>

</html>