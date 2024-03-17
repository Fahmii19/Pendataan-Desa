@extends('layouts.template_admin')
@section('content')

<!-- Slick CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />


{{-- Pegawai Start --}}

<style>
    .dataTables_length {
        display: none;
    }

    .dataTables_filter {
        display: none;
    }


    .teks_height {
        max-height: 23rem;
        overflow-x: hidden;
        margin-top: -1rem;
        /* overflow-y: hidden; */
    }


    .img_child {
        /* width: 150px;
    height: 100px; */
        width: 11rem;
        height: 7rem;
        /* padding: 7% 11% 0 0; */
        padding-right: 4%;
        cursor: pointer;
    }

    /* slider custom */

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


    /* slide show horizontal */

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

    /* custom sorting center */
    table.dataTable>thead>tr>th:not(.sorting_disabled),
    table.dataTable>thead>tr>td:not(.sorting_disabled) {
        padding-right: 20px !important;
    }

    #table-surveyer_length {
        margin-bottom: 0.5rem !important;
    }

    #DataTables_Table_1_length {
        margin-bottom: 0.5rem !important;
        margin-left: 1.3% !important;
    }

    #DataTables_Table_1_filter {
        margin-right: 2.2% !important;
    }

    #DataTables_Table_1_info {
        margin-left: 1.5% !important;
        margin-top: 0.6% !important;
    }

    #DataTables_Table_1_paginate {
        margin-right: 1.4% !important;
        margin-top: 1.5% !important;
    }

    #table-surveyer_length {
        margin-bottom: 0.5rem !important;
        margin-left: 1.3% !important;
    }

    #table-surveyer_filter {
        margin-right: 1.2% !important;
    }

    #table-surveyer_info {
        margin-left: 1.5% !important;
        margin-top: 0.6% !important;
    }

    #table-surveyer_paginate {
        margin-right: 0.8% !important;
        margin-top: 1.5% !important;
    }
</style>

{{-- Pegawai End --}}

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <!-- <div class="page-pretitle">Overview</div> -->
                <h2 class="page-title" >Kondisi Lingkungan</h2>
            </div>
            <!-- Page title actions -->
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <!-- konten disini -->

        <div class="flex_container row">

            <div class="col">
                <div class="card responsive_jarak card_responsive_izin_lingkungan">

                    <div class="card-status-top bg-blue"></div>

                    <div class="d-flex flex-column" style="height: 9.5rem;">
                        <div class="border_dashboard px-3 py-3"
                            style="height: 4.3rem; padding-left:1rem; padding-top:0.1rem;">

                            <div class="d-flex">

                                <div class="w-100 d-flex justify-content-start font_size_box_informasi"
                                    style="color:#206bc4;">
                                    Pengunjung 7 Hari Terakhir
                                </div>

                                <div class="flex-shrink-1 d-flex justify-content-end">
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

                        <div class="" style="padding-left:1rem; padding-right:1rem; padding-top:0.1rem;">
                            <div style="font-size:40px;" class="h2 m-0 inf-pengunjung" onload="visitorToday()">
                                <div style="height:3.5rem; margin-top:3%" class="w-full skeleton-image">
                                </div>
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
                                    Titik Tercatat
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
                            <div style="font-size:40px;" class="h2 m-0">
                                {{ count($survey) }}
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col">
                <div class="card responsive_jarak">

                    <div class="card-status-top bg-orange"></div>

                    <div class="d-flex flex-column" style="height: 9.5rem;">
                        <div class="border_dashboard px-3 py-3"
                            style="height: 4.3rem; padding-left:1rem; padding-top:0.1rem;">

                            <div class="d-flex">

                                <div class="w-100 d-flex justify-content-start font_size_box_informasi"
                                    style="color:#f76707;">
                                    Pegawai Terdaftar
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
                            <div style="font-size:40px;" class="h2 m-0">
                                {{ count($register_user) }}
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>

        {{-- Input Data Terbaru --}}


        <div style="margin-top: 1rem;" class="row-cards">
            <div class="col-md-12 col-xl-12">

                <div class="card mt-3">
                    <div class="card-status-top bg-primary"></div>

                    <div class="card-header card-header-light">
                        <h3 class="card-title" style="font-size:14px; font-weight:400; letter-spacing:0.5px;">Input Data Terbaru</h3>

                        <div class="card-actions">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-body mobile_container" style="padding: 0">

                        <div class="container-fluid px-0">
                            <div class="row no-gutters">
                                <div class="col-md-6">

                                    <div style="border-style: 2px #000 solid"
                                        class="gambar_utama_slider_input2 gambar_utama_slider_input_scale data_image_space">
                                    </div>


                                </div>

                                <div sty class="col-md-6 mt-3">

                                    <div class="row">
                                        <div class="col-md-2">

                                            <div id="photo_ajib">

                                            </div>

                                            <div id="photo_ajib2"></div>

                                        </div>

                                        <div style="margin-left:-1.3rem;" class="col-md-10 mt-1">
                                            <div class="text-truncate">
                                                <span class="h4" id="name">
                                                </span>
                                            </div>
                                            <div class="mt-1">
                                                <span id="penempatan">
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                    <div style="border-bottom: 1px solid #e5e7eb; margin-top: 2.8%"></div>

                                    <div class="teks_height" style="margin-top: 2.1%">
                                        <div class="row jarak_judul">
                                            <div class="col-md-5">
                                                <label class="form-label">Judul<span style="margin-left: 3.7rem;">
                                                    </span></label>
                                            </div>
                                            <div class="col-md-7 jarak_text">
                                                <div class="col text_data_home">
                                                    <span id="judul">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row jarak_judul">
                                            <div class="col-md-5">
                                                <label class="form-label">Kategori <span style="margin-left: 2.5rem;">
                                                    </span></label>
                                            </div>
                                            <div class="col-md-7 jarak_text">
                                                <div class="col text_data_home">
                                                    <span id="kategori">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row jarak_judul">

                                            <div class="col-md-5">
                                                <label class="form-label">Deskripsi <span style="margin-left: 3.5rem;">
                                                    </span></label>
                                            </div>
                                            <div class="col-md-7 jarak_text">
                                                <div class="col text_data_home">
                                                    <span id="deskripsi">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row jarak_judul">
                                            <div class="col-md-5">
                                                <label class="form-label">Permasalahan <span
                                                        style="margin-left: 3.5rem;">
                                                    </span></label>
                                            </div>
                                            <div class="col-md-7 jarak_text">
                                                <div class="col text_data_home">
                                                    <span id="permasalahan">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row jarak_judul">
                                            <div class="col-md-5">
                                                <label class="form-label">Solusi <span style="margin-left: 3.5rem;">
                                                    </span></label>
                                            </div>
                                            <div class="col-md-7 jarak_text">
                                                <div class="col text_data_home">
                                                    <span id="solusi">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>

                            </div>

                            <div class="row jarak_inmobile pb-3 pt-2" style="padding-left: 0.6%;">
                                <div class="col-md-12">


                                    <div style="max-height:8rem;"
                                        class="image_slider_input_dashboard data_image_space2">

                                        @foreach ($slider_terbaru as $gi)
                                        <div>
                                            <img class="img_child img_child_id" data-id="{{ $gi->id }}"
                                                data-lazy="https://jakarta.pintoinvest.com/mobile/img/{{$gi->foto}}">
                                        </div>
                                        @endforeach

                                    </div>

                                </div>
                            </div>


                        </div>

                    </div>

                </div>
            </div>
        </div>


        {{-- INI Aktifin --}}
        <div style="margin-top: 1rem;" class="row row-cards">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-status-top bg-success"></div>
                    <div class="card-header px-2">
                        <h3 class="card-title" style="font-size:14px; font-weight:400; letter-spacing:0.5px;">Kinerja AJIB </h3>
                    </div>

                    <div class="card-body px-0" style="margin-right: 0.2rem !important;">

                        <div class="table-responsive">
                            <table class="display table table-striped" id="table-surveyer" style="width: 100%">

                                <thead class="text-center">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Penempatan</th>
                                        <th>Jumlah Titik</th>
                                        <th>Jarak Tempuh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($register_user as $pa)
                                    <tr>
                                        <td>{{ $pa->name }}</td>
                                        <td>{{ $pa->penempatan }}</td>
                                        <td>{{ $pa->survey_count }}</td>
                                        <td class="contractin ajib-{{ $pa->id }}" onload="addText({!! $pa->id !!})">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>

                </div>
            </div>
        </div>
        {{-- //// --}}


        {{-- Rekap Input AJIB --}}
        <div class="row row-cards" style="margin-top: 1rem; margin-bottom:0.5rem">
            <div class="col-md-12 col-xl-12">
                <div class="card">

                    <div class="card-status-top bg-orange"></div>

                    <div class="card-header px-2">

                        <div>
                            <div class="row align-items-center">

                                <div class="col" style="font-size:14px; font-weight:400; letter-spacing:0.5px;">
                                    <div style="display: none;" class="card-title lazy_name_kinerja">Rekap Input AJIB
                                    </div>
                                </div>
                                <div class="hide_lazyload_kinerja">
                                    <div style="width: 12.7rem; height:1.8rem;" class="skeleton-image"></div>
                                </div>
                            </div>
                        </div>


                        <div class="w-25 card-actions" style="margin-right: 1em;">

                            <div style="display: none;" class="lazy_name_kinerja">
                                <select class="form-select" id="selectOptionRekap">

                                    @foreach($kelurahan as $kel)
                                    <option selected value="{{ $kel[0]->kelurahan }}">{{ $kel[0]->kelurahan }}</option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="hide_lazyload_kinerja">
                                <div style="height:1.8rem;" class="w-full skeleton-image">
                                </div>
                            </div>

                        </div>


                        <div class="w-10">
                            <div style="display: none;" class="lazy_name_kinerja">
                                <a style="border-style:none;" href="/v1/dashboard/Ekspor-Kinerja" target="_blank"
                                    id="PrintKinerja" class="btn w-10">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2">
                                        </path>
                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                        <rect x="7" y="13" width="10" height="8" rx="2"></rect>
                                    </svg>
                                    Cetak PDF
                                </a>

                            </div>

                            <div class="hide_lazyload_kinerja">
                                <div style="width: 12.7rem; height:1.8rem;" class="skeleton-image">
                                </div>
                            </div>

                        </div>

                    </div>




                    <div class="card-body px-0">

                        <div class="d-flex justify-content-between">

                            <div class="col-md-6 justify-content-start">
                                <div class="hide_lazyload_kinerja">
                                    <div style="width: 12.7rem; height:1.8rem;" class="skeleton-image"></div>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex justify-content-end">
                                <div class="hide_lazyload_kinerja">
                                    <div style="width: 12.7rem; height:1.8rem;" class="skeleton-image"></div>
                                </div>
                            </div>

                        </div>



                        <div class="table-responsive">
                            <table class="table table-hover data-kinerja" style="width: 100%"
                                style="margin-top: 1rem !important;">

                                <thead class="text-center">
                                    <tr>

                                        <th width="8%">

                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Lokasi
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th width="5%">
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Kelurahan
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th width="5%">
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Kategori
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th width="13%">
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Deskripsi
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th width="13%">
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Permasalahan
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th width="10%">
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Solusi
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th width="10%">
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Foto
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    @php
                                    for ($x = 0; $x <= 9; $x++) { echo"<tr class='hide_lazyload_kinerja'>
                                        <td>
                                            <div class='skeleton-line cusotm_lazyload_konten'></div>
                                        </td>
                                        <td>
                                            <div class='skeleton-line cusotm_lazyload_konten'></div>
                                        </td>
                                        <td>
                                            <div class='skeleton-line cusotm_lazyload_konten'></div>
                                        </td>
                                        <td>
                                            <div class='skeleton-line cusotm_lazyload_konten'></div>
                                        </td>
                                        <td>
                                            <div class='skeleton-line cusotm_lazyload_konten'></div>
                                        </td>
                                        <td>
                                            <div class='skeleton-line cusotm_lazyload_konten'></div>
                                        </td>
                                        <td>
                                            <div class='skeleton-image'></div>
                                        </td>

                                        </tr>";
                                        }
                                        @endphp
                                </tfoot>

                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        {{-- Titik Lokasi Survey --}}
        <div style="margin-top: 1rem;" class="row row-cards">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-status-top bg-yellow"></div>
                    <div class="card-header">
                        <h3 class="card-title" style="font-size:14px; font-weight:400; letter-spacing:0.5px;">Titik Lokasi Survey</h3>
                    </div>
                    <div class="card-body p-0">
                        <div style="width: 100%;height:70vh" id="map">

                            <div style="z-index: 9; position:absolute;" class="container mt-2">

                                {{-- radion --}}
                                <div class="d-none">
                                    <input type="radio" id="radio_umkm" name="radio_menu" value="radio_umkm">
                                    <input type="radio" id="radio_kampung_prioritas" name="radio_menu"
                                        value="radio_kampung_prioritas">
                                    <input type="radio" id="radio_dibangun" name="radio_menu" value="radio_dibangun">
                                    <input type="radio" id="radio_pedestrian" name="radio_menu"
                                        value="radio_pedestrian">
                                    <input type="radio" id="radio_cagar" name="radio_menu" value="radio_cagar">
                                    <input type="radio" id="radio_rth" name="radio_menu" value="radio_rth">
                                    <input type="radio" id="radio_dijual" name="radio_menu" value="radio_dijual">
                                    <input type="radio" id="radio_lainnya" name="radio_menu" value="radio_lainnya">
                                </div>

                                <div class="slick_filter_menu">

                                    <div class="slick_left p-1">
                                        <div class="d-flex">

                                            <div class="on_layer_umkm">

                                                <button id="btn_umkm" class="btn btn-light btn-pill w-100">
                                                    <span class="icon material-icons text-primary">
                                                        storefront
                                                    </span>
                                                    <div style="font-weight: bold" class="text-muted">UMKM</div>
                                                </button>

                                            </div>

                                            <div class="off_layer_umkm">

                                                <button
                                                    style="background: orange; border-radius: 30px; box-shadow: 1px 1px 1px #000; border-color:orange;"
                                                    id="btn_off_layer_umkm" class="btn btn-pill w-100">

                                                    <span class="icon material-icons text-primary">
                                                        storefront
                                                    </span>

                                                    <div style="font-weight: bold" class="text-muted">UMKM</div>

                                                </button>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="slick_left p-1">
                                        <div class="d-flex">

                                            <div class="on_kampung_prioritas">

                                                <button id="btn_kampung_prioritas" class="btn btn-light btn-pill w-100">
                                                    <span class="icon material-icons text-primary">
                                                        holiday_village
                                                    </span>
                                                    <div style="font-weight: bold" class="text-muted">IMB Kampung
                                                        Prioritas</div>
                                                </button>

                                            </div>

                                            <div class="off_layer_kampung_prioritas">

                                                <button
                                                    style="background: orange; border-radius: 30px; box-shadow: 1px 1px 1px #000; border-color:orange;"
                                                    id="btn_off_layer_kampung_prioritas" class="btn btn-pill w-100">

                                                    <span class="icon material-icons text-primary">
                                                        holiday_village </span>

                                                    <div style="font-weight: bold" class="text-muted">IMB Kampung
                                                        Prioritas</div>

                                                </button>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="slick_left p-1">
                                        <div class="d-flex">

                                            <div class="on_layer_dibangun">

                                                <button id="btn_dibangun" class="btn btn-light btn-pill w-100">
                                                    <span class="icon material-icons text-primary">
                                                        more_time
                                                    </span>
                                                    <div style="font-weight: bold" class="text-muted">Sedang dibangun
                                                    </div>
                                                </button>

                                            </div>

                                            <div class="off_layer_dibangun">

                                                <button
                                                    style="background: orange; border-radius: 30px; box-shadow: 1px 1px 1px #000; border-color:orange;"
                                                    id="btn_off_layer_dibangun" class="btn btn-pill w-100">

                                                    <span class="icon material-icons text-primary">
                                                        more_time </span>

                                                    <div style="font-weight: bold" class="text-muted">Sedang dibangun
                                                    </div>

                                                </button>

                                            </div>


                                        </div>
                                    </div>


                                    <div class="slick_left p-1">
                                        <div class="d-flex">

                                            <div class="on_layer_pedestrian">

                                                <button id="btn_pedestrian" class="btn btn-light btn-pill w-100">
                                                    <span class="icon material-icons text-primary">
                                                        add_road </span>
                                                    <div style="font-weight: bold" class="text-muted">Pedestrian</div>
                                                </button>

                                            </div>


                                            <div class="off_layer_pedestrian">

                                                <button
                                                    style="background: orange; border-radius: 30px; box-shadow: 1px 1px 1px #000; border-color:orange;"
                                                    id="btn_off_layer_pedestrian" class="btn btn-pill w-100">

                                                    <span class="icon material-icons text-primary">
                                                        add_road </span>

                                                    <div style="font-weight: bold" class="text-muted">Pedestrian</div>

                                                </button>

                                            </div>


                                        </div>
                                    </div>


                                    <div class="slick_left p-1">
                                        <div class="d-flex">

                                            <div class="on_layer_cagarbudaya">

                                                <button id="btn_cagar" class="btn btn-light btn-pill w-100">
                                                    <span class="icon material-icons text-primary">
                                                        location_city </span>
                                                    <div style="font-weight: bold" class="text-muted">Cagar Budaya</div>
                                                </button>

                                            </div>

                                            <div class="off_layer_cagarbudaya">

                                                <button
                                                    style="background: orange; border-radius: 30px; box-shadow: 1px 1px 1px #000; border-color:orange;"
                                                    id="btn_off_layer_cagarbudaya" class="btn btn-pill w-100">

                                                    <span class="icon material-icons text-primary">
                                                        location_city </span>

                                                    <div style="font-weight: bold" class="text-muted">Cagar Budaya</div>

                                                </button>

                                            </div>


                                        </div>
                                    </div>

                                    <div class="slick_left p-1">
                                        <div class="d-flex">

                                            <div class="on_layer_rth">

                                                <button id="btn_rth" class="btn btn-light btn-pill w-100">
                                                    <span class="icon material-icons text-primary">
                                                        park </span>
                                                    <div style="font-weight: bold" class="text-muted">RTH</div>
                                                </button>

                                            </div>

                                            <div class="off_layer_rth">

                                                <button
                                                    style="background: orange; border-radius: 30px; box-shadow: 1px 1px 1px #000; border-color:orange;"
                                                    id="btn_off_layer_rth" class="btn btn-pill w-100">

                                                    <span class="icon material-icons text-primary">
                                                        park </span>

                                                    <div style="font-weight: bold" class="text-muted">RTH</div>

                                                </button>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="slick_left p-1">
                                        <div class="d-flex">

                                            <div class="on_layer_dijual">

                                                <button id="btn_dijual" class="btn btn-light btn-pill w-100">
                                                    <span class="icon material-icons text-primary">
                                                        real_estate_agent </span>
                                                    <div style="font-weight: bold" class="text-muted">Dijual</div>
                                                </button>

                                            </div>


                                            <div class="off_layer_dijual">

                                                <button
                                                    style="background: orange; border-radius: 30px; box-shadow: 1px 1px 1px #000; border-color:orange;"
                                                    id="btn_off_layer_dijual" class="btn btn-pill w-100">

                                                    <span class="icon material-icons text-primary">
                                                        real_estate_agent </span>

                                                    <div style="font-weight: bold" class="text-muted">Dijual</div>

                                                </button>

                                            </div>


                                        </div>
                                    </div>

                                    <div class="slick_left p-1">
                                        <div class="d-flex">

                                            <div class="on_layer_lainnya">

                                                <button id="btn_lainnya" class="btn btn-light btn-pill w-100">
                                                    <span class="icon material-icons text-primary">
                                                        more </span>
                                                    <div style="font-weight: bold" class="text-muted">Lainnya</div>
                                                </button>

                                            </div>


                                            <div class="off_layer_lainnya">

                                                <button
                                                    style="background: orange; border-radius: 30px; box-shadow: 1px 1px 1px #000; border-color:orange;"
                                                    id="btn_off_layer_lainnya" class="btn btn-pill w-100">

                                                    <span class="icon material-icons text-primary">
                                                        more </span>

                                                    <div style="font-weight: bold" class="text-muted">Lainnya</div>

                                                </button>

                                            </div>


                                        </div>
                                    </div>




                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Jquery | Slick --}}
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<!-- Slick JS -->
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>
    $(".slick_filter_menu").slick({
        dots: false
        , arrows: false
        , variableWidth: true
        , infinite: false
        , swipeToSlide: true,
        // , centerMode: true
        slidesToShow: 6
        , slidesToScroll: 1
    });



    // $('.gambar_utama_slider_input').slick({

    //     slidesToShow: 1
    //     , slidesToScroll: 1
    //     , dots: false
    //     , focusOnSelect: true
    //     , variableWidth: true
    //     , infinite: false
    //     , arrows: false,

    //     // , asNavFor: '.image_slider_input'
    // });

    $('.image_slider_input_dashboard').slick({
        slidesToShow: 7
        , lazyLoad: 'ondemand'
        , slidesToScroll: 1
            // , asNavFor: '.gambar_utama_slider_input'
        , dots: false
        , focusOnSelect: true
        , variableWidth: true
        , infinite: false
        , arrows: true
    });



</script>


{{-- Pegawai Js Start --}}

<script>
    $(document).ready(function() {

        // $(function() {

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        var table = $('.data-pegawai').DataTable({

            "drawCallback": function(settings) {
                $(".hide_lazyload_kinerja").hide();
                $(".lazy_name_kinerja").show();
                $(".dataTables_length").show();
                $(".dataTables_filter").show();
            },

            ordering: true
            , order: [
                [0, "asc"]
            ]
            , processing: false
            , serverSide: true
            , "deferRender": true
                // , "language": {
                //     processing: '<div class="loader_lazy_load"></div>'
                // }
            , ajax: "{{ url('/dashboard/register') }}"
            , columns: [{
                    data: 'name'
                    , name: 'name'
                }
                , {
                    data: 'email'
                    , name: 'email'
                },

                {
                    data: 'roles'
                    , name: 'roles'
                },

                {
                    data: 'jabatan'
                    , name: 'jabatan'
                },

                {
                    data: 'penempatan'
                    , name: 'penempatan'
                },

                {
                    data: 'aksi'
                    , name: 'aksi'
                }
            , ]
            , columnDefs: [{
                    orderSequence: ["asc", "desc"]
                    , targets: [0]
                , }
                , {
                    orderSequence: ["asc", "desc"]
                    , targets: [1]
                , }
                , {
                    orderSequence: ["asc", "desc"]
                    , targets: [2]
                , }
                , {
                    orderSequence: ["asc", "desc"]
                    , targets: [3]
                , }
            , ]
        , });


    });

</script>

{{-- Pegawai Js End --}}



{{-- Rekap Input Start --}}

<script>
    var $fileName = 'Data Export Rekap';


    document.getElementById("selectOptionRekap").onchange = function() {
        $hasil = document.getElementById("selectOptionRekap").value;
        // document.getElementById("getKec").value = hasil;
    // console.log(hasil);
    };




    var $fileTitle = 'Data Rekap Input'.$hasil;




    $(document).ready(function() {


        $('.data-kinerja').DataTable({

            ordering: true
            , processing: true
            , serverSide: true
            , order: [
                [0, "asc"]
            ]
            , ajax: "{{ url('/dashboard/kinerjaData') }}"
            , "deferRender": true
            , "responsive": true


            , language: {
            search: "Pencarian:",
            processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span> '
            , }

                // atur lazy load bawaan
                // , "language": {
                // processing: '<div class="loader_lazy_load"></div>'
                // }

                //Lazd load custom
            , "drawCallback": function(settings) {

                $("#selectOption").attr("disabled", false);
                $(".hide_lazyload_kinerja").hide();
                $(".lazy_name_kinerja").show();
                $(".dataTables_length").show();
                $(".dataTables_filter").show();
            },

            // dom: 'Bfrtip'
            // , buttons: [{
            // text: 'pdf'
            // , extend: 'pdfHtml5'
            // , filename: $fileName
            // , text: 'Data Export Rekap'
            // , orientation: 'potrait'
            // , pageSize: 'Legal'
            // , }],


            // Button default datatables
            // dom: 'lBfrtip',
            // buttons: [{
            //         extend: 'pdf'
            //         , filename: $fileName
            //         , title: $fileTitle
            //     ,
            // }

            // ,{
            // extend: 'excel'
            // , filename: $fileName
            // }

            // ],



            // Tampil Data Per pagination
            "lengthMenu": [
                [10, 25, 50, 100, 1000, -1]
                , ['10 rows', '25 rows', '50 rows', '100 rows', '1000 rows', 'All']
            ],


            // cetak table
            columns: [
                {
                    data: 'judul'
                    , name: 'judul'
                },

                {
                    data: 'kelurahan'
                    , name: 'kelurahan'
                },


                {
                    data: 'kategori'
                    , name: 'kategori'
                },

                {
                    data: 'catatan'
                    , name: 'catatan'
                },

                {
                    data: 'permasalahan'
                    , name: 'permasalahan'
                },

                {
                    data: 'solusi'
                    , name: 'solusi'
                }

                , {
                    data: 'foto'
                    , name: 'foto'
                    , sortable: false
                    , searchable: false
                }
            , ],

            // Set Asc or Desc Field Table
            columnDefs: [{
                    orderSequence: ["asc", "desc"]
                    , targets: [0]
                        // , "visible": false
                , }
                , {
                    orderSequence: ["asc", "desc"]
                    , targets: [1]
                , }
                , {
                    orderSequence: ["desc", "asc"]
                    , targets: [3]
                , }
                , {
                    orderSequence: ["desc", "asc"]
                    , targets: [4]
                , }
                , {
                    orderSequence: ["desc", "asc"]
                    , targets: [5]
                , }
                , {
                    orderSequence: ["desc", "asc"]
                    , targets: [6]
                , },

            ],


        });



    });

</script>


{{-- Rekap Input End --}}



<script>
    $(document).ready(function () {
                $("#table-surveyer").DataTable({
                    // retrieve: true,
                    ordering: true,

                    order: [[2, "desc"]],
                    columnDefs: [
                        { orderSequence: ["asc", "desc"], targets: [0] },
                        { orderSequence: ["asc", "desc"], targets: [1] },
                        {
                            orderSequence: ["asc", "desc"],
                            targets: [0],
                            width: "25%",
                        },
                        {
                            orderSequence: ["asc", "desc"],
                            targets: [1],
                            width: "25%",
                        },
                        {
                            orderSequence: ["asc", "desc"],
                            targets: [2],
                            className: "text-center",
                            width: "25%",
                        },
                        {
                            orderSequence: ["asc", "desc"],
                            targets: [3],
                            className: "text-center",
                            width: "25%",
                        },
                    ],
                });
            });
</script>



@endsection