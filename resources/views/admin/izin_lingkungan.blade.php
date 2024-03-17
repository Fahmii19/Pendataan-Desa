@extends('layouts.template_admin')
@section('content')
<style>
    .skeleton-heading {
        width: 140% !important;
    }

    /* .gambar_utama_slider_input {
        width: 27rem !important;
        margin-left: 1rem;
    } */

    /* .teks_size {
        max-height: 5rem;
        overflow-x: hidden;
        overflow-y: hidden;
    } */

    .teks_height {
        max-height: 23rem;
        overflow-x: hidden;
        margin-top: -1rem;
        /* overflow-y: hidden; */
    }

    table.dataTable tr.size_detil th {
        font-size: 0.8em;
    }

    .display table table-striped dataTable no-footer {
        margin-top: 10rem !important;
    }

    /* jgn pindah */
    .dataTables_length {
        margin-bottom: 0.5rem;
        margin-left: 1.5%;
    }

    #table-surveyer2_filter {
        margin-right: 2.2% !important;
    }

    #table-surveyer2_length {
        margin-bottom: 0.5rem !important;
        margin-left: 1.3% !important;
    }

    #table-surveyer2_info {
        margin-left: 1.5% !important;
        margin-top: 0.6% !important;
    }

    #table-surveyer2_paginate {
        margin-right: 1.4% !important;
        margin-top: 1.5% !important;
    }


    #table-surveyer3_length {
        margin-bottom: 0.5rem !important;
        margin-left: 1.3% !important;
    }

    #table-surveyer3_filter {
        margin-right: 2.3% !important;
    }

    #table-surveyer3_info {
        margin-left: 1.5% !important;
        margin-top: 1.5% !important;
    }

    #table-surveyer3_paginate {
        margin-right: 1.4% !important;
        margin-top: 2.4% !important;
    }







    #table-lingkungan2_length {
        margin-bottom: 0.5rem !important;
        margin-left: 1.3% !important;
    }


    #table-lingkungan2_info {
        margin-left: 1.5%;
        margin-top: 0.6%;
    }

    #table-lingkungan2_paginate {
        margin-right: 1.4%;
        margin-top: 1.5%
    }




    #table-lingkungan3_length {
        margin-bottom: 0.5rem !important;
        margin-left: 1.3% !important;
    }

    #table-lingkungan3_info {
        padding-top: 0 !important;
        position: relative !important;
        margin-left: 0.6rem !important;
        top: 1.5rem;
    }

    #table-lingkungan3_paginate {
        margin-right: 0.4rem !important;
    }


    .read-more-show {
        cursor: pointer;
        color: #000;
    }

    .read-more-hide {
        cursor: pointer;
        color: #000;
    }

    .hide_content {
        display: none;
    }

    .arrow_updown {
        color: rgb(41, 60, 234)
    }

    .card-horizontal {
        display: flex;
        flex: 1 1 auto;
    }


    /* jgn pindah */

    /* .data_image_space .slick-prev {
        left: -22px !important;
    }

    .data_image_space .slick-next {
        right: -10px !important;
    } */

    /* .slick-next slick-arrow {
        position: relative;
        left: 29.1rem;
        top: -8rem;
    } */

    .data_image_space .slick-prev:before {
        /* left: -22px !important; */

        font-size: 30px !important;
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        content: "\f104";

    }

    .data_image_space .slick-next:before {
        /* right: -10px !important; */

        font-size: 30px !important;
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        content: "\f105";
        /* margin-right: -130% !important; */
    }

    /* .data_image_space .slick-list {
        width: 28.8rem !important;
    } */

    .data_image_space .slick-prev {
        left: 3%;
    }

    .data_image_space .slick-next {
        right: 3%;
    }

    /* .data_image_space .slick-slide img{
        height: 350px !important;
    } */

    /* atur arrow slider */
    /* div.slick-list.draggable {
        height: 25rem !important;
    } */

    .data_image_space .slick-slide img {
        height: 26vw !important;
        width: 45vw !important;
    }





    .data_image_space .slick-prev:before {
        text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .data_image_space .slick-next:before {
        text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    /* slider kecil */

    .data_image_space2 .slick-prev:before {
        font-size: 35px !important;
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        content: "\f104";

    }

    .data_image_space2 .slick-next:before {
        font-size: 35px !important;
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        content: "\f105";
        /* margin-right: -130% !important; */
    }

    .data_image_space2 .slick-prev {
        left: 1% !important;
    }

    .data_image_space2 .slick-next {
        right: 1.6% !important;
    }

    .data_image_space2 .slick-prev,
    .slick-next {
        top: 43.6% !important;
    }








    /* .slick-prev:before,
    .slick-next:before {
        font-size: 40px;
        text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    } */

    /* .chart-pengunjung {
        width: 68.5em !important;
    } */

    .dt-buttons {
        position: relative;
        top: -1.9rem;
        right: 3rem;
    }

    .progress.progress-xs {
        position: relative;
        top: 0.4rem;
    }

    /* semua custom jgn dipindahkan */
    /* Custom Mapbox */
    .mapboxgl-ctrl-top-right .mapboxgl-ctrl {
        margin: 10.5rem 50% 0 0 !important;
    }

    .mapboxgl-ctrl-group button {
        width: 25px !important;
        height: 25px !important;
    }

    .form-control:focus {
        box-shadow: none !important;
    }

    /* indikator loading datatables */

    /* #table-lingkungan2_processing {
        top: 11px !important;
    }

    #table-lingkungan3_processing {
        top: 9px !important;
    } */

    /* hide border style legend */
    .hide_border_legend {
        border-style: none !important;
    }

    table.dataTable>thead>tr>th:not(.sorting_disabled),
    table.dataTable>thead>tr>td:not(.sorting_disabled) {
        padding-right: 10px !important;
    }
</style>



@php
$Roles = '';
@endphp





<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Izin Lingkungan
                </h2>
            </div>
            <!-- Page title actions -->

        </div>
    </div>




</div>

<div class="page-body">
    <div class="container-xl">
        <!-- konten disini -->

        {{--Box Pendataan 1 --}}
        <div class="row flex_container">

            <div class="col">
                <div class="card responsive_jarak">

                    <div class="card-status-top bg-orange"></div>

                    <div class="d-flex flex-column" style="height: 9.5rem;">
                        <div class="border_dashboard px-3 py-3"
                            style="height: 4.3rem; padding-left:1rem; padding-top:0.1rem;">

                            <div class="d-flex">

                                <div class="w-100 d-flex justify-content-start font_size_box_informasi"
                                    style="color:#f76707;">
                                    Jumlah CPNS Terdaftar
                                </div>

                                <div class="flex-shrink-1 d-flex justify-content-end">
                                    <span class="bg-orange text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-users" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                        </svg>
                                    </span>
                                </div>

                            </div>

                        </div>
                        <div class="" style="padding-left:1rem; padding-top:0.1rem;">
                            <div style="font-size:40px;" class="h2 m-0 angka_responsive">
                                {{ count($count_jumlah_cpns) - 4 }}
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col">
                <div class="card responsive_jarak card_responsive_izin_lingkungan">

                    <div class="card-status-top bg-danger"></div>

                    <div class="d-flex flex-column" style="height: 9.5rem;">
                        <div class="border_dashboard px-3 py-3"
                            style="height: 4.3rem; padding-left:1rem; padding-top:0.1rem;">

                            <div class="d-flex">

                                <div class="w-100 d-flex justify-content-start font_size_box_informasi"
                                    style="color:#d63939;">
                                    Titik Tercatat Hari Ini
                                </div>

                                <div class="flex-shrink-1 d-flex justify-content-end">
                                    <span class="bg-red text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-user" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        </svg>
                                    </span>
                                </div>

                            </div>

                        </div>
                        <div class="" style="padding-left:1rem; padding-top:0.1rem;">
                            <div style="font-size:40px;" class="h2 m-0 angka_responsive">
                                {{ $titik_tercatat_izin->count() }}
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col">
                <div class="card responsive_jarak card_responsive_izin_lingkungan">

                    <div class="card-status-top bg-success"></div>

                    <div class="d-flex flex-column" style="height: 9.5rem;">
                        <div class="border_dashboard px-3 py-3"
                            style="height: 4.3rem; padding-left:1rem; padding-top:0.1rem;">

                            <div class="d-flex">

                                <div class="w-100 d-flex justify-content-start font_size_box_informasi"
                                    style="color:#2FB344;">
                                    Total Titik Tercatat
                                </div>

                                <div class="flex-shrink-1 d-flex justify-content-end">
                                    <span class="bg-green text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-map-2" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="18" y1="6" x2="18" y2="6.01"></line>
                                            <path d="M18 13l-3.5 -5a4 4 0 1 1 7 0l-3.5 5"></path>
                                            <polyline points="10.5 4.75 9 4 3 7 3 20 9 17 15 20 21 17 21 15"></polyline>
                                            <line x1="9" y1="4" x2="9" y2="17"></line>
                                            <line x1="15" y1="15" x2="15" y2="20"></line>
                                        </svg>
                                    </span>
                                </div>

                            </div>


                        </div>
                        <div class="" style="padding-left:1rem; padding-top:0.1rem;">
                            <div style="font-size:40px;" class="h2 m-0 angka_responsive">
                                {{ $titik_tercatat }}
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col">
                <div class="card responsive_jarak card_responsive_izin_lingkungan">

                    <div class="card-status-top bg-blue"></div>

                    <div class="d-flex flex-column" style="height: 9.5rem;">
                        <div class="border_dashboard px-3 py-3"
                            style="height: 4.3rem; padding-left:1rem; padding-top:0.1rem;">

                            <div class="d-flex">

                                <div class="w-100 d-flex justify-content-start font_size_box_informasi"
                                    style="color:#206bc4;">
                                    Prosentase
                                </div>

                                <div class="flex-shrink-1d-flex justify-content-end">
                                    <span class="bg-blue text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-percentage" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="17" cy="17" r="1"></circle>
                                            <circle cx="7" cy="7" r="1"></circle>
                                            <line x1="6" y1="18" x2="18" y2="6"></line>
                                        </svg>
                                    </span>
                                </div>

                            </div>


                        </div>
                        <div class="" style="padding-left:1rem; padding-top:0.1rem;">
                            <div style="font-size:40px;" class="h2 m-0 angka_responsive">
                                {{ $get_progres_total_izin }}%
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>

        {{--Box Pendataan 1 --}}
        <div class="row flex_container" style="margin-top: 1rem;">

            <div class="col">
                <div class="card responsive_jarak card_responsive_izin_lingkungan">

                    <div class="card-status-top bg-green"></div>

                    <div class="d-flex flex-column" style="height: 9.5rem;">
                        <div class="border_dashboard px-2"
                            style="height: 4.3rem; padding-left:1rem; padding-top:0.1rem;">

                            <h3 style="color:#2FB344"
                                class="card-title w-full font_size_box_informasi_izin_lingkungan judul_center_box_kedua">
                                Berkas Sudah Terbit
                            </h3>

                        </div>
                        <div class="konten_center_box_kedua konten_padding_box_kedua">
                            <div style="font-size:40px;" class="h2 m-0 angka_responsive">
                                {{ count($data_status1)}}
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col">
                <div class="card responsive_jarak card_responsive_izin_lingkungan">

                    <div class="card-status-top bg-red"></div>

                    <div class="d-flex flex-column" style="height: 9.5rem;">
                        <div class="border_dashboard px-2"
                            style="height: 4.3rem; padding-left:1rem; padding-top:0.1rem;">

                            <h3 style="color:#d63939"
                                class="card-title w-full font_size_box_informasi_izin_lingkungan judul_center_box_kedua">
                                Berkas Sudah Ditolak
                            </h3>

                        </div>
                        <div class="konten_center_box_kedua konten_padding_box_kedua">
                            <div style="font-size:40px;" class="h2 m-0 angka_responsive">
                                {{ count($data_status2)}}
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col">
                <div class="card responsive_jarak card_responsive_izin_lingkungan">

                    <div class="card-status-top bg-red"></div>

                    <div class="d-flex flex-column" style="height: 9.5rem;">
                        <div class="border_dashboard px-2"
                            style="height: 4.3rem; padding-left:1rem; padding-top:0.1rem;">
                            <h3 style="color:#d63939"
                                class="card-title w-full font_size_box_informasi_izin_lingkungan judul_center_box_kedua">
                                Berkas Sudah Dibatalkan Sistem
                            </h3>

                        </div>
                        <div class="konten_center_box_kedua konten_padding_box_kedua">
                            <div style="font-size:40px;" class="h2 m-0 angka_responsive">
                                {{ count($data_status3)}}
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col">
                <div class="card responsive_jarak card_responsive_izin_lingkungan">

                    <div class="card-status-top bg-yellow"></div>

                    <div class="d-flex flex-column" style="height: 9.5rem;">
                        <div class="border_dashboard px-2"
                            style="height: 4.3rem; padding-left:1rem; padding-top:0.1rem;">

                            <h3 style="color:#F59F00"
                                class="card-title w-full font_size_box_informasi_izin_lingkungan judul_center_box_kedua">
                                Berkas Sedang Diproses oleh Wilayah
                            </h3>

                        </div>
                        <div class="konten_center_box_kedua konten_padding_box_kedua">
                            <div style="font-size:40px;" class="h2 m-0 angka_responsive">
                                {{ count($data_status4)}}
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col">
                <div class="card responsive_jarak card_responsive_izin_lingkungan">

                    <div class="card-status-top bg-orange"></div>

                    <div class="d-flex flex-column" style="height: 9.5rem;">
                        <div class="border_dashboard px-2"
                            style="height: 4.3rem; padding-left:1rem; padding-top:0.1rem;">

                            <h3 style="color:#f76707"
                                class="card-title w-full font_size_box_informasi_izin_lingkungan judul_center_box_kedua">
                                Berkas Perlu Disposisi Pimpinan
                            </h3>

                        </div>
                        <div class="konten_center_box_kedua konten_padding_box_kedua">
                            <div style="font-size:40px;" class="h2 m-0 angka_responsive">
                                {{ count($data_status5)}}
                            </div>
                        </div>
                    </div>


                </div>
            </div>


        </div>


        <div style="margin-top: 1rem" class="row-cards">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-status-top bg-success"></div>
                    <div class="card-header card-header-mobile">
                        <h3 class="card-title" style="font-size:14px; font-weight:400; letter-spacing:0.5px;">Kinerja CPNS</h3>

                        <div class="card-actions" style="margin-top:0.6%;  margin-right:-0.2%;">
                            <a style="font-weight:400; font-size:12px;" href="{{ route('kinerja-cpns') }}">
                                Unduh Excel
                            </a>
                        </div>

                    </div>
                    <div class="card-body px-0">
                        <div style="overflow-x: hidden !important;" class="table-responsive">
                            <table class="display table table-striped" id="table-lingkungan2" style="width: 100%">


                                <thead>
                                    <tr class="size_detil text-center" valign="middle">

                                        <th>
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Nama CPNS
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
                                                Input Hari Ini
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>
                                        <th>
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                &nbsp;&nbsp;&nbsp;&nbsp;Input Total
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

        <div style="margin-top: 1rem" class="row-cards">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-status-top bg-danger"></div>
                    <div class="card-header card-header-mobile">

                        <div class="d-flex flex-row align-items-center">
                            <div>
                                <h3 class="card-title" style="font-size:14px; font-weight:400; letter-spacing:0.5px;">Detil Input CPNS</h3>
                            </div>
                            <div class="px-2">
                                {{-- <select id="status_detil_cpns" class="form-control">
                                    <option value="">Semua</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Belum Selesai">Belum Selesai</option>
                                </select> --}}

                            </div>
                        </div>


                        <div class="card-actions d-flex" style="margin-top:0.6%; margin-right:-0.2%;">
                            <a class="px-3" style="font-weight:400; font-size:12px;"
                                href="{{ route('export-izin-lingkungan') }}">
                                Unduh Excel
                            </a>

                            <div class="dropdown">
                                <a class="dropdown-toggle text-muted" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" id="select_filter_detil_cpns">Semua
                                    <span class=""></span></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a style="display: none;" class="dropdown-item getFilter select semua"
                                        data-id="Semua" onclick="getFilter('');">Semua</a>
                                    <a class="dropdown-item getFilter select selesai" data-id="Selesai"
                                        onclick="getFilter('Selesai');">Selesai</a>
                                    <a class="dropdown-item getFilter select belum_selesai" data-id="Belum Selesai"
                                        onclick="getFilter('Belum Selesai');">Belum
                                        Selesai</a>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="card-body px-0">
                        <table class="display table table-striped" id="table-lingkungan3" style="width: 100%">

                            <thead>
                                <tr class="size_detil" valign="middle">
                                    <th class="text-center">
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Nama CPNS
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th class="text-center">
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Tanggal Input
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th class="text-center">
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            No Permohonan
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th class="text-center">
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Nama Perusahaan
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>

                                    <th class="text-center">
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Alamat
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th class="text-center">
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Kelurahan
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th class="text-center">
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Kecamatan
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th class="text-center">
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Tanggal Pengajuan
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th class="text-center">
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Status Terakhir
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th class="text-center">
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Komentar Terakhir
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th class="text-center">
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Status Terbaru
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th class="text-center">
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Komentar Terbaru
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th class="text-center">
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Status
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                for ($x = 0; $x <= 10; $x++) { echo "<tr class='hide_lazyload_kinerja'>
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
                                                                <td>
                                                                    <div class='skeleton-line'></div>
                                                                </td>
                                                                </tr>" ; } @endphp </tbody>
                        </table>
                    </div>



                </div>
            </div>
        </div>


        <div style="margin-top: 1rem;" class="row-cards d-none">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-status-top bg-success"></div>
                    <div class="card-header">
                        <h3 class="card-title">Progres Survey Per Kelurahan</h3>

                    </div>
                    <div class="card-body">
                        <div style="overflow-x: hidden !important;" class="table-responsive">
                            <table class="display table table-striped" id="table-surveyer4" style="width: 100%">


                                <thead>
                                    <tr class="size_detil" valign="middle">

                                        <th class="text-center">
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Kecamatan
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>
                                        <th class="text-center">
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Kelurahan
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>
                                        <th class="text-center">
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Total Polygon
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>
                                        <th>
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Polygon Tersurvey
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>
                                        <th>
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                &nbsp;&nbsp;&nbsp;&nbsp;Progres
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th class="text-center">
                                            Prosentase
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


        <div style="margin-top: 1rem" class="row-cards">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-status-top bg-primary"></div>
                    <div class="card-header card-header-mobile">
                        <h3 class="card-title" style="font-size:14px; font-weight:400; letter-spacing:0.5px;">Peta Titik Pengawasan</h3>
                    </div>

                    <div class="card-body p-0">
                        <div class="w-100 d-flex justify-content-end align-items-end" id="map" style="height: 83vh">

                            <div class="d-flex justify-content-end mx-3 my-3" style="z-index: 9; position:relative;">
                                <div class=" col-md-2"></div>

                                <div class="col-md-10 card">

                                    <table class="table card-table table-vcenter mx-1" style="font-size: 9pt">

                                        <tbody>
                                            <tr class=" p-0">
                                                <td class=" p-0 hide_border_legend">
                                                    <div class="d-flex flex-row align-items-center  p-0">
                                                        <div class="avatar text-white bg-green"
                                                            style="width: 8px; height:8px; border-radius:0 !important;">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="p-1 hide_border_legend"
                                                    style="line-height: normal; font-size:10pt">Berkas
                                                    Sudah Terbit</td>
                                            </tr>
                                            <tr class=" p-0">
                                                <td class=" p-0 hide_border_legend">
                                                    <div class="d-flex flex-row align-items-center  p-0">
                                                        <div class="avatar text-white bg-red"
                                                            style="width: 8px; height:8px; border-radius:0 !important;">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="p-1 hide_border_legend"
                                                    style="line-height: normal; font-size:10pt">Berkas
                                                    Sudah Ditolak</td>
                                            </tr>
                                            <tr class=" p-0">
                                                <td
                                                    class=" p-0 mt-2 hide_border_legend d-flex flex-row align-items-start">
                                                    <div class="d-flex flex-row align-items-center  p-0">
                                                        <div class="avatar text-white bg-red"
                                                            style="width: 8px; height:8px; border-radius:0 !important;">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="p-1 hide_border_legend"
                                                    style="line-height: normal; font-size:10pt">Berkas
                                                    Sudah Dibatalkan
                                                    Sistem</td>
                                            </tr>
                                            <tr class=" p-0">
                                                <td
                                                    class=" p-0 mt-2 hide_border_legend d-flex flex-row align-items-start">
                                                    <div class="d-flex flex-row align-items-center  p-0">
                                                        <div class="avatar text-white bg-yellow"
                                                            style="width: 8px; height:8px; border-radius:0 !important;">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="p-1 hide_border_legend"
                                                    style="line-height: normal; font-size:10pt">
                                                    Berkas
                                                    Sedang Diproses
                                                    oleh
                                                    Wilayah</td>
                                            </tr>
                                            <tr class=" p-0">
                                                <td
                                                    class="p-0 mt-2 hide_border_legend d-flex flex-row align-items-start">
                                                    <div class="d-flex flex-row align-items-center  p-0">
                                                        <div class="avatar text-white bg-orange"
                                                            style="width: 8px; height:8px; border-radius:0 !important;">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="p-1 hide_border_legend"
                                                    style="line-height: normal; font-size:10pt">Berkas
                                                    Perlu Disposisi
                                                    Pimpinan</td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>

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
                    url: 'get-kinerja-cpns', // script url
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
                        // As a function it is executed with the data object as an arg
                        // for manipulation. If an object is returned, it is used as the
                        // data object to submit
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

        $('#table-lingkungan2').DataTable({

            "drawCallback": function(settings) {
                $(".hide_lazyload_kinerja").hide();
                $(".lazy_name_kinerja").show();
            },

            processing: true
            , serverSide: true
                // , ajax: "{{ url('/admin/get-kinerja-petugas') }}"

            , ajax: $.fn.dataTable.pipeline({
                    url: 'get-kinerja-cpns'
                    , pages: 100, // number of pages to cache
                })


            , ordering: true
            , language: {
                search: "Pencarian:",
                processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span> '
            , }
            , order: [
                [3, "desc"]
            , ],

            columns: [{
                    data: 'name'
                    , name: 'name'
                }
                , {
                    data: 'penempatan'
                    , name: 'penempatan'
                }, {
                    data: 'lingkungan_perhari_count'
                    , name: 'lingkungan_perhari_count'
                }
                , {
                    data: 'lingkungan_total_count'
                    , name: 'lingkungan_total_count'
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
                    , className: "text-center"
                , }, {
                    orderSequence: ["asc", "desc"]
                    , targets: [3]
                    , className: "text-center"

                , }

            , ],

        });

        //Detil cpns

        $.fn.dataTable.pipeline = function(opts2) {
            // Configuration options
            var conf = $.extend({
                    pages: 100, // number of pages to cache
                    url: 'get-view-detil-cpns', // script url

                    data: function(d){
                    d.status = $('#status_detil_cpns').val()
                    console.log(d.status)
                    },

                    data: null, // function or object with parameters to send to the server
                    // matching how `ajax.data` works in DataTables
                    method: 'GET', // Ajax HTTP method

                }
                , opts2
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
                        // As a function it is executed with the data object as an arg
                        // for manipulation. If an object is returned, it is used as the
                        // data object to submit
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

        $(document).ready(function() {

            var table = $('#table-lingkungan3').DataTable({

                dom: 'lrtip',

                "drawCallback": function(settings) {
                    $(".hide_lazyload_kinerja").hide();
                    $(".lazy_name_kinerja").show();
                },


                processing: true
                , serverSide: true
                    // , ajax: "{{ url('/admin/get-view-survey') }}"

                , ajax: $.fn.dataTable.pipeline({
                        url: 'get-view-detil-cpns',

                        data: function(d){
                        d.status = $('#status_detil_cpns').val()
                        // console.log(d.status)
                        },

                        pages: 100
                    })

                , language: {
                    search: "Pencarian:",
                    processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>'
                    , }
                , ordering: false
                    // order:[0,'desc'],
                , scrollX: true
                , sScrollX: "250%"
                , sScrollXInner: "250%"
                , responsive: false
                ,

                columns: [{
                        data: 'nama_penanggung_jawab'
                        , name: 'nama_penanggung_jawab'
                    }, {
                        data: 'update_time'
                        , name: 'update_time'
                    }, {
                        data: 'nomor_permohonan'
                        , name: 'nomor_permohonan'
                    }, {
                        data: 'nama_perusahaan'
                        , name: 'nama_perusahaan'
                    }, {
                        data: 'alamat_kegiatan_izin'
                        , name: 'alamat_kegiatan_izin'
                    }, {
                        data: 'kelurahan_kegiatan'
                        , name: 'kelurahan_kegiatan'
                    }, {
                        data: 'kecamatan_kegiatan'
                        , name: 'kecamatan_kegiatan'
                    }, {
                        data: 'tanggal_pengajuan_izin'
                        , name: 'tanggal_pengajuan_izin'
                    }, {
                        data: 'status_terakhir'
                        , name: 'status_terakhir'
                    }, {
                        data: 'komentar_terakhir'
                        , name: 'komentar_terakhir'
                    }, {
                        data: 'status_terbaru'
                        , name: 'status_terbaru'
                    }, {
                        data: 'komentar_terbaru'
                        , name: 'komentar_terbaru'
                    },{
                        data: 'status',
                        name: 'status'
                    }

                , ],

                columnDefs: [{
                        orderSequence: ["asc", "desc"]
                        , targets: [0]
                    }, {
                        orderSequence: ["asc", "desc"]
                        , targets: [1]
                        , className: "text-center"
                    , }, {
                        orderSequence: ["asc", "desc"]
                        , targets: [2]
                    }, {
                        orderSequence: ["asc", "desc"]
                        , targets: [3]
                    , }, {
                        orderSequence: ["asc", "desc"]
                        , targets: [4]
                    , }, {
                        orderSequence: ["asc", "desc"]
                        , targets: [5]
                    , }, {
                        orderSequence: ["asc", "desc"]
                        , targets: [6]
                    }, {
                        orderSequence: ["asc", "desc"]
                        , targets: [7]
                        , className: "text-center"
                    , }, {
                        orderSequence: ["asc", "desc"]
                        , targets: [8]
                        , className: "text-center"
                    }, {
                        orderSequence: ["asc", "desc"]
                        , targets: [9]
                    , }, {
                        orderSequence: ["asc", "desc"]
                        , targets: [10]
                        , className: "text-center"
                    , } , { orderSequence: ["asc", "desc"]
                            , targets: [11]
                    , },  { orderSequence: ["asc", "desc"]
                            , targets: [12]
                            , className: "text-center"
                    , }, {
                        width: "7%"
                        , targets: 0
                    }, {
                        width: "5%"
                        , targets: 1
                    }, {
                        width: "5%"
                        , targets: 2
                    }, {
                        width: "7%"
                        , targets: 3
                    }, {
                        width: "15%"
                        , targets: 4
                    }, {
                        width: "5%"
                        , targets: 5
                    }, {
                        width: "5%"
                        , targets: 6
                    }, {
                        width: "7%"
                        , targets: 7
                    }, {
                        width: "7%"
                        , targets: 8
                    }, {
                        width: "12%"
                        , targets: 9
                    }, {
                        width: "7%"
                        , targets: 10
                    }, {
                        width: "14%"
                        , targets: 11
                    } , {
                        width: "12%"
                        , targets: 12
                    }
                , ],

            });

            $('#status_detil_cpns').on('change', function(){
                let val = $(this).val()
                if (val == '') {
                    table.column(12).search($(this).val()).draw();
                }else{
                    let regex =  "(^" + val + "$)"
                    table.column(12).search(regex, true, false).draw();
                }
            });

        });




        // Progres Survey Per Kelurahan

        $.fn.dataTable.pipeline = function(opts3) {
            // Configuration options
            var conf = $.extend({
                    pages: 100, // number of pages to cache
                    url: 'get-progres-survey', // script url
                    data: null, // function or object with parameters to send to the server
                    // matching how `ajax.data` works in DataTables
                    method: 'GET', // Ajax HTTP method
                }
                , opts3
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
                        // As a function it is executed with the data object as an arg
                        // for manipulation. If an object is returned, it is used as the
                        // data object to submit
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

        $(document).ready(function() {
            $('#table-surveyer4').DataTable({
                processing: false
                , serverSide: true
                , ajax: $.fn.dataTable.pipeline({
                        url: 'get-progres-survey'
                        , pages: 100, // number of pages to cache
                    })

                , ordering: true
                , language: {
                    search: "Pencarian:"
                , }
                , order: [
                    [4, "desc"]
                , ],

                columns: [{
                        data: 'nama_kec'
                        , name: 'nama_kec'

                    }, {
                        data: 'nama_kel'
                        , name: 'nama_kel'

                    }, {
                        data: 'jumlah'
                        , name: 'jumlah'

                    }, {
                        data: 'survey_count_null'
                        , name: 'survey_count_null'

                    }, {
                        data: 'progres'
                        , name: 'progres'
                    }
                    , {
                        data: 'persen'
                        , name: 'persen'
                    }
                ],

                columnDefs: [{
                        orderSequence: ["asc", "desc"]
                        , targets: [0]
                        , className: "text-left"
                    , }, {
                        orderSequence: ["asc", "desc"]
                        , targets: [1]
                        , className: "text-left"
                    , }, {
                        orderSequence: ["asc", "desc"]
                        , targets: [2]
                        , className: "text-center"
                    , }, {
                        orderSequence: ["asc", "desc"]
                        , targets: [3]
                        , className: "text-center"
                    , }, {
                        orderSequence: ["asc", "desc"]
                        , targets: [4]
                        , className: "text-center"
                    , }, {
                        orderSequence: ["asc", "desc"]
                        , targets: [5]
                        , className: "text-center"
                    , }


                , ],


            });
        });



    })

    function getFilter(val) {
        // let val = $(this).val();
        // console.log(val);

            $(".semua").hide();


            if (val == '') {
                $(".semua").hide();
                $(".belum_selesai").show();
                $("#select_filter_detil_cpns").text('Semua');
            } else if (val == 'Selesai') {
                $(".semua").show();
                $(".belum_selesai").show();
                $(".selesai").hide();
                $("#select_filter_detil_cpns").text(val);
            } else if (val == 'Belum Selesai') {
                $(".semua").show();
                $(".belum_selesai").hide();
                $(".selesai").show();
                $("#select_filter_detil_cpns").text(val);
            }



        var table = $('#table-lingkungan3').DataTable();
        if (val == '') {
        table.column(12).search(val).draw();
        }else{
        let regex = "(^" + val + "$)"
        table.column(12).search(regex, true, false).draw();
        }
    }

    // $(".getFilter").on("click", function(){
    // var dataId = $(this).attr("data-id");
    //     console.log(dataId);
    //     var select = $('select.select');
    //     select.change(function () {
    //     select.not(this).val(dataId);
    //     });
    // });

</script>
@endsection