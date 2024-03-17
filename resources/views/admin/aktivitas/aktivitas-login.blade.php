@extends('layouts.template_admin')
@section('content')


<style>
    .skeleton-heading {
        width: 140% !important;
    }

    table.dataTable tr.size_detil th {
        font-size: 0.8em;
    }

    .display table table-striped dataTable no-footer {
        margin-top: 10rem !important;
    }

    .dataTables_length {
        margin-bottom: 0.5rem;
        margin-left: 1.5%;
    }

    #aktivitas-login_filter {
        margin-right: 2.2% !important;
    }

    #aktivitas-login_length {
        margin-bottom: 0.5rem !important;
        margin-left: 1.3% !important;
    }

    #aktivitas-login_info {
        margin-left: 1.5% !important;
        margin-top: 0.6% !important;
    }

    #aktivitas-login_paginate {
        margin-right: 1.4% !important;
        margin-top: 1.5% !important;
    }

</style>

<div class="container-xl">
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">Aktivitas Login</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">

        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-status-top bg-primary"></div>
                    <div class="card-body px-0 py-0">

                        <div style="margin-left: 1.5%; margin-right: 1%;" class="d-flex">

                            <div class="card-header px-0" style="border-style: none; margin-left:-0.9%">
                                <h3 class="card-title" style="font-size:14px; font-weight:400; letter-spacing:0.5px;">Trafik Pengunjung Harian Selama <span class="jumlah_hari">7</span> Hari
                                    Terakhir</h3>
                            </div>

                            <div class="ms-auto mt-3">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter: <span class="jumlah_hari">7</span> hari</a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item tujuh_hari" onclick="filterAnalytics(6)">7 Hari</a>
                                        <a class="dropdown-item tigapuluh_hari" onclick="filterAnalytics(30)">30
                                            Hari</a>
                                        <a class="dropdown-item sembilanpuluh_hari" onclick="filterAnalytics(90)">90
                                            Hari</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div style="position: relative; height: 25em; width: 100%;">
                            <div class="uk_chart_skeleton skeleton-image w-100 h-full"></div>
                            <canvas class="px-2 chart-pengunjung"></canvas>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top: 0.6rem" class="row row-cards">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-status-top bg-success"></div>
                    <div class="card-header px-2">
                        <h3 class="card-title"  style="font-size:14px; font-weight:400; letter-spacing:0.5px;">User</h3>
                    </div>

                    <div class="card-body px-0" style="margin-right: 0.2rem !important;">

                        <div style="overflow-x: hidden !important;" class="table-responsive">
                            <table class="display table table-striped" id="aktivitas-login" style="width: 100%">

                                <thead>
                                    <tr class="size_detil text-center" valign="middle">

                                        <th>
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Nama User
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th>
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Penempatan
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th>
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Jabatan
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th>
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Waktu Login
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>



                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                    for ($x = 0; $x <= 9; $x++) { echo "<tr class='hide_lazyload_kinerja'>
                                                                    <td>
                                                                        <div class='skeleton-line'></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class='skeleton-line'></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class='skeleton-line'></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class='skeleton-line'></div>
                                                                    </td>
                                                                    </tr>" ; } @endphp </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        // Kinerja Petugas Survey
        $.fn.dataTable.pipeline = function(opts1) {
            // Configuration options
            var conf = $.extend({
                    pages: 100, // number of pages to cache
                    url: 'dashboard/aktivitas-login-user', // script url
                    data: null, // function or object with parameters to send to the server
                    // matching how `ajax.data` works in DataTables
                    method: 'GET', // Ajax HTTP method
                }
                , opts1
            );

            // Private variables for storing the cache
            var cacheLower = -1;
            var cacheUpper = null;
            var cacheLastRequest = null;
            var cacheLastJson = null;

            return function(request, drawCallback, settings) {
                var ajax = false;
                var requestStart = request.start;
                var drawStart = request.start;
                var requestLength = request.length;
                var requestEnd = requestStart + requestLength;

                if (settings.clearCache) {
                    // API requested that the cache be cleared
                    ajax = true;
                    settings.clearCache = false;
                } else if (cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper) {
                    // outside cached data - need to make a request
                    ajax = true;
                } else if (
                    JSON.stringify(request.order) !== JSON.stringify(cacheLastRequest.order) ||
                    JSON.stringify(request.columns) !== JSON.stringify(cacheLastRequest.columns) ||
                    JSON.stringify(request.search) !== JSON.stringify(cacheLastRequest.search)
                ) {
                    // properties changed (ordering, columns, searching)
                    ajax = true;
                }

                // Store the request for checking next time around
                cacheLastRequest = $.extend(true, {}, request);

                if (ajax) {
                    // Need data from the server
                    if (requestStart < cacheLower) {
                        requestStart = requestStart - requestLength * (conf.pages - 1);

                        if (requestStart < 0) {
                            requestStart = 0;
                        }
                    }

                    cacheLower = requestStart;
                    cacheUpper = requestStart + requestLength * conf.pages;

                    request.start = requestStart;
                    request.length = requestLength * conf.pages;

                    // Provide the same `data` options as DataTables.
                    if (typeof conf.data === 'function') {
                        var d = conf.data(request);
                        if (d) {
                            $.extend(request, d);
                        }
                    } else if ($.isPlainObject(conf.data)) {
                        // As an object, the data given extends the default
                        $.extend(request, conf.data);
                    }

                    return $.ajax({
                        type: conf.method
                        , url: conf.url
                        , data: request
                        , dataType: 'json'
                        , cache: false
                        , success: function(json) {
                            cacheLastJson = $.extend(true, {}, json);

                            if (cacheLower != drawStart) {
                                json.data.splice(0, drawStart - cacheLower);
                            }
                            if (requestLength >= -1) {
                                json.data.splice(requestLength, json.data.length);
                            }

                            drawCallback(json);
                        }
                    , });
                } else {
                    json = $.extend(true, {}, cacheLastJson);
                    json.draw = request.draw; // Update the echo for each response
                    json.data.splice(0, requestStart - cacheLower);
                    json.data.splice(requestLength, json.data.length);

                    drawCallback(json);
                }
            };
        };

        $.fn.dataTable.Api.register('clearPipeline()', function() {
            return this.iterator('table', function(settings) {
                settings.clearCache = true;
            });
        });

        $('#aktivitas-login').DataTable({

            "pageLength": 25
            , "lengthMenu": [
                [25, 50, 100, -1]
                , [25, 50, 100, "All"]
            ]
            , "drawCallback": function(settings) {
                $(".hide_lazyload_kinerja").hide();
                $(".lazy_name_kinerja").show();
            },

            processing: true
            , serverSide: true
                // , ajax: "{{ url('/dashboard/aktivitas-login-user') }}"

            , ajax: $.fn.dataTable.pipeline({
                    url: 'dashboard/aktivitas-login-user'
                    , pages: 100, // number of pages to cache
                })

            , ordering: true
            , language: {
                search: "Pencarian:"
                , processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span> '
            , }
            , order: [
                [3, "desc"]
            , ],

            columns: [{
                    data: 'user.name'
                    , name: 'user.name'
                }
                , {
                    data: 'user.penempatan'
                    , name: 'user.penempatan'
                }
                , {
                    data: 'user.jabatan'
                    , name: 'user.jabatan'
                }
                , {
                    data: 'time'
                    , name: 'time'
                }

            , ],

            columnDefs: [{
                    orderSequence: ["asc", "desc"]
                    , targets: [0]
                , }, {
                    orderSequence: ["asc", "desc"]
                    , targets: [1]
                , }, {
                    orderSequence: ["asc", "desc"]
                    , targets: [2]
                , }, {
                    orderSequence: ["asc", "desc"]
                    , targets: [3]
                    , className: "text-center"
                , }

            , ],

        });


    })

</script>

@endsection
