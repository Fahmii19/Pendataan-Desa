<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengawasan {{ count($data) >= 1 ? $data[0]->kelurahan : '' ; }}</title>

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


        td div img {
            position: relative;
            width: 200px;
            height: 160px;
            object-fit: contain;
        }

    </style>

    <div class="text-center mb-4">
        <h5>Laporan Pengawasan
            {{
                count($data) >= 1 ? "Kecamatan ".ucfirst($data[0]->kelurahan) : '' ;
            }}

        </h5>
    </div>

    @foreach ($data as $dt)

    <table class="table table_custom" cell-spacing=0>

        <tr>
            <td style="padding: 0 0 0.3rem 0.7rem;" colspan="4">
                <span class="font-weight-bold">Judul</span>
                <br>
                <span>{{ $dt->judul }}</span>
            </td>
            <td style="width: 25%; padding: 0 0 0.3rem 0.7rem;">
                <span class="font-weight-bold"> Tipe </span>
                <br>
                <span>{{ $dt->tipe }}</span>

            </td>
            <td style="width: 30%; padding: 0 0 0 0; margin-top:10rem;" rowspan="4">
                <div><img style="top: 5px; left:6px;" src="/publik/favorit/{{ $dt->image[0]->name }}" /></div>
            </td>
        </tr>

        <tr>

            <td style="padding: 0 0 0.3rem 0.7rem;" colspan="5">
                <span class="font-weight-bold"> Kelurahan </span>
                <br />
                <span>{{ $dt->kelurahan }}</span>

            </td>
        </tr>

        <tr>
            <td style="padding: 0 0 0.3rem 0.7rem;" colspan="5">
                <span class="font-weight-bold"> Catatan </span>
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
