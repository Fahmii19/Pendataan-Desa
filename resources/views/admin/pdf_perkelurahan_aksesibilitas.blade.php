<!DOCTYPE html>
<html>
<head>
    <title>Rekap Input Kelurahan {{ count($data) >= 1 ? $data[0]->kelurahan : '' ; }}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>


    <style type="text/css">
        table {
            page-break-inside: avoid !important;
        }

        table tr td,
        table tr th {
            font-size: 9pt;
        }

        .table_custom {
            border: 1px solid black;
            width: 100%;
            height: 10px;
            table-layout: fixed;
        }

        .table_custom td {
            border: 1px solid black;
            /* padding: 10px; */
        }

        #footer {
            position: fixed;
            right: 0px;
            bottom: 10px;
            text-align: center;
            /* border-top: 1px solid black; */
        }

        #footer .page:after {
            content: counter(page, decimal);
        }

        @page {
            margin: 20px 30px 40px 50px;
        }

        /* td div {
        height: inherit;
        width: inherit;
        } */

        td div img {
            position: relative;
            width: 200px;
            height: 160px;
            object-fit: contain;
        }

    </style>

    <div class="text-center mb-4">
        <h5>Rekap Input
            {{
                count($data) >= 1 ? "Kelurahan ".ucfirst($data[0]->kelurahan) : '' ;
            }}

        </h5>
    </div>

    @foreach ($data as $dt)

    <table class="table table_custom" cell-spacing=0>

        <tr>
            <td style="padding: 0 0 0.3rem 0.7rem;" colspan="4">
                <span class="font-weight-bold">Lebar Jalan (meter)</span>
                <br>
                <span>{{ $dt->lebar_jalan }}</span>
            </td>
            <td style="width: 32%; padding: 0 0 0.3rem 0.7rem;">
                <span class="font-weight-bold"> Jenis Jalan </span>
                <br>
                <span>{{ $dt->jenis_jalan }}</span>

            </td>
            <td style="width: 30%; padding: 0 0 0 0; margin-top:10rem;" rowspan="4">

                {{-- cara2 --}}
                @foreach ($dt->image as $ft)
                    <div><img style="top: 5px; left:6px;" src="https://jakarta.pintoinvest.com:9000/aksesibilitas/{{ $ft->photo }}" /></div>
                    @break

                @endforeach

            </td>
        </tr>

        <tr>
            <td style="padding: 0 0 0.3rem 0.7rem;" colspan="4">
                <span class="font-weight-bold"> Kelas Jalan </span>
                <br />
                <span>{{ $dt->kelas_jalan }}</span>

            </td>
            <td style="padding: 0 0 0.3rem 0.7rem;" colspan="1">
                <span class="font-weight-bold"> Pedestrian </span>
                <br />
                <span>{{ $dt->pedestrian }}</span>

            </td>
        </tr>
        <tr>
            <td style="padding: 0 0 0.3rem 0.7rem;" colspan="4">
                <span class="font-weight-bold"> Kelurahan </span>
                <br />
                <span>{{ $dt->kelurahan }}</span>

            </td>
            <td style="padding: 0 0 0.3rem 0.7rem;" colspan="1">
                <span class="font-weight-bold"> Kecamatan </span>
                <br />
                <span>{{ $dt->kecamatan }}</span>

            </td>
        </tr>
        <tr>
            <td style="padding: 0 0 0.3rem 0.7rem;" colspan="4">
                <span class="font-weight-bold"> Deskripsi </span>
                <br />
                <span>{{ $dt->catatan }}</span>

            </td>
            <td style="padding: 0 0 0.3rem 0.7rem;" colspan="1">
                <span class="font-weight-bold"> Deskripsi </span>
                <br />
                <span>{{ $dt->catatan }}</span>

            </td>
        </tr>

    </table>

    <div id="footer">
        <p class="page"></p>
    </div>

    @endforeach




</body>
</html>
