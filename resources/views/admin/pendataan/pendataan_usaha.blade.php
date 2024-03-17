@extends('layouts.template_admin')
@section('content')
<style>
    /* .skeleton-heading {
        width: 140% !important;
    } */

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
        max-height: 19rem;
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
        font-size: 35px !important;
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        content: "\f104";

    }

    .data_image_space .slick-next:before {
        font-size: 35px !important;
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        content: "\f105";
    }

    .data_image_space .slick-prev {
        left: 3%;
    }

    .data_image_space .slick-next {
        right: 3%;
    }

    /* div.slick-list.draggable {
        height: 25rem !important;
    } */

    .data_image_space .slick-slide img {
        height: 26vw !important;
        width: 45vw !important;
        object-fit: cover;
    }

    .data_image_space .slick-prev:before {
        text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .data_image_space .slick-next:before {
        text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .dt-buttons {
        position: relative;
        top: -1.9rem;
        right: 3rem;
    }

    .progress.progress-xs {
        position: relative;
        top: 0.4rem;
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

    /* custom slider image */

    .ukuran_slider_anak {
        /* width: 150px;
    height: 100px; */
        width: 11rem;
        height: 7rem;
        /* padding: 7% 11% 0 0; */
        padding-right: 4%;
        cursor: pointer;
        object-fit: cover
    }


    /* datatables  */

    .dataTables_length {
        margin-bottom: 0.5rem;
        margin-left: 1.5%;
    }

    /* #table-surveyer2_filter {
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
    } */


    table.dataTable>thead>tr>th:not(.sorting_disabled),
    table.dataTable>thead>tr>td:not(.sorting_disabled) {
        padding-right: 10px !important;
    }


    #table-regis_length {
        position: relative;
        top: 41%;
    }



    #table-regis_info {
        margin-left: 1.5% !important;
        margin-top: 0.4% !important;
    }

    #table-regis_paginate {
        margin-right: 1.4% !important;
        margin-top: 2.4% !important;
        position: relative;
        top: -20% !important;
    }

    #table-regis_filter {
        margin-right: 2.2% !important;
        margin-top: 3% !important;
    }

    #table-surveyer3_filter {
        margin-right: 2.2% !important;
    }

    #table-surveyer3_paginate {
        margin-right: 1.4% !important;
        margin-top: 1.5% !important;
    }

    #table-surveyer3_info {
        margin-left: 1.5% !important;
        margin-top: 0.6% !important;
        position: relative;
        top: 7% !important;
    }
</style>



@php
$Roles = '';
@endphp





<div class="container-xl">
    <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Izin Usaha
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">

        {{-- Box Data Pendataan --}}

        <div class="flex_container row">

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
                                {{ count($akses_pendataan_usaha) }}
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col">
                <div class="card responsive_jarak">

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
                        <div class="" style="padding-left:1rem; padding-right:1rem; padding-top:0.1rem;">
                            <div style="font-size:40px;" class="h2 m-0">
                                {{ $get_pendataan_perhari->count(); }}
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col">
                <div class="card responsive_jarak">

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
                                {{ $total_tercatat_pendataan->count() }}
                            </div>
                        </div>
                    </div>


                </div>
            </div>



        </div>



        <div style="margin-top: 1rem;" class="row-cards">
            <div class="col-md-12 col-xl-12">

                <div class="card mt-3">
                    <div class="card-status-top bg-orange"></div>

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
                                        class="slider_pendataan_usaha gambar_utama_slider_input_scale data_image_space">
                                    </div>


                                </div>

                                <div sty class="col-md-6 mt-3">

                                    <div class="row">
                                        <div class="col-md-2">

                                            <div id="photo_ajib_pendataan_usaha"></div>

                                            {{-- <div id="photo_ajib2"></div> --}}

                                        </div>

                                        <div style="margin-left:-1.3rem;" class="col-md-10 mt-1">
                                            <div class="text-truncate">
                                                <span class="h4" id="name_pendataan">
                                                </span>
                                            </div>
                                            <div class="mt-1">
                                                <span id="penempatan_pendataan">
                                                </span>
                                            </div>
                                        </div>

                                    </div>


                                    <div style="border-bottom: 1px solid #e5e7eb; margin-top: 2.3%"></div>

                                    <div class="teks_height" style="margin-top: 0.3rem">
                                        <div class="row"
                                            style="max-height: 23rem; overflow-x: hidden; margin-top: 0.3rem;">
                                            <div class="col-md-5">
                                                <label class="form-label">No Perjanjian <span
                                                        style="margin-left: 2.5rem;">
                                                    </span></label>
                                            </div>
                                            <div class="col-md-7 jarak_text">
                                                <div class="col text_data_terbaru">
                                                    <span id="no_perjanjian">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row jarak_judul">
                                            <div class="col-md-5">
                                                <label class="form-label">Pelaku Usaha<span
                                                        style="margin-left: 2.5rem;">
                                                    </span></label>
                                            </div>
                                            <div class="col-md-7 jarak_text">
                                                <div class="col text_data_terbaru">
                                                    <span id="pelaku">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row jarak_judul">
                                            <div class="col-md-5">
                                                <label class="form-label">Nama Usaha <span style="margin-left: 2.5rem;">
                                                    </span></label>
                                            </div>
                                            <div class="col-md-7 jarak_text">
                                                <div class="col text_data_terbaru">
                                                    <span id="nama_usaha">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row jarak_judul">
                                            <div class="col-md-5">
                                                <label class="form-label">Koordinat <span style="margin-left: 2.5rem;">
                                                    </span></label>
                                            </div>
                                            <div class="col-md-7 jarak_text">
                                                <div class="col text_data_terbaru">
                                                    <span id="kordinat">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row jarak_judul">
                                            <div class="col-md-5">
                                                <label class="form-label">Sektor <span style="margin-left: 2.5rem;">
                                                    </span></label>
                                            </div>
                                            <div class="col-md-7 jarak_text">
                                                <div class="col text_data_terbaru">
                                                    <span id="sektor">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row jarak_judul">
                                            <div class="col-md-5">
                                                <label class="form-label">Modal <span style="margin-left: 2.2rem;">
                                                    </span></label>
                                            </div>
                                            <div class="col-md-7 jarak_text">
                                                <div class="col text_data_terbaru">
                                                    <span id="modal">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row jarak_judul">
                                            <div class="col-md-5">
                                                <label class="form-label">Jumlah Tenaga<span
                                                        style="margin-left: 3.5rem;">
                                                    </span></label>
                                            </div>
                                            <div class="col-md-7 jarak_text">
                                                <div class="col text_data_terbaru">
                                                    <span id="jumlah_tenaga">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row jarak_judul">

                                            <div class="col-md-5">
                                                <label class="form-label">Alamat <span style="margin-left: 3.5rem;">
                                                    </span></label>
                                            </div>
                                            <div class="col-md-7 jarak_text">
                                                <div class="col text_data_terbaru">
                                                    <span id="alamat">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row jarak_judul">
                                            <div class="col-md-5">
                                                <label class="form-label">ID Sub Blok<span style="margin-left: 3.5rem;">
                                                    </span></label>
                                            </div>
                                            <div class="col-md-7 jarak_text">
                                                <div class="col text_data_terbaru">
                                                    <span id="id_sub_blok">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row jarak_judul">
                                            <div class="col-md-5">
                                                <label class="form-label">Kelurahan<span style="margin-left: 3.5rem;">
                                                    </span></label>
                                            </div>
                                            <div class="col-md-7 jarak_text">
                                                <div class="col text_data_terbaru">
                                                    <span id="kelurahan">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row jarak_judul">
                                            <div class="col-md-5">
                                                <label class="form-label">Kecamatan<span style="margin-left: 3.5rem;">
                                                    </span></label>
                                            </div>
                                            <div class="col-md-7 jarak_text">
                                                <div class="col text_data_terbaru">
                                                    <span id="kecamatan">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row jarak_judul">
                                            <div class="col-md-5">
                                                <label class="form-label">Badan Usaha<span style="margin-left: 3.5rem;">
                                                    </span></label>
                                            </div>
                                            <div class="col-md-7 jarak_text">
                                                <div class="col text_data_terbaru">
                                                    <span id="badan_usaha">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>

                            </div>


                            <div class="row jarak_inmobile"
                                style="padding-left: 0.6%; padding-top:2.3%; padding-bottom:2.3%;">
                                <div class="col-md-12">


                                    <div style="max-height:8rem;" class="image_slider_pendataan data_image_space2">

                                        @foreach ($slider_pendataan as $x)
                                        <div>
                                            <img class="ukuran_slider_anak id_slider_pendataan" data-id="{{ $x->id }}"
                                                data-lazy="https://jakarta.pintoinvest.com/v1/usaha/{{ count($x->image) == 0 ? 'not_image.png' : $x->image[0]->name }}">
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

        <div style="margin-top: 1rem" class="row-cards">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-status-top bg-danger"></div>
                    <div class="card-header" style="padding-left: 0.6%;">
                        <h3 class="card-title" style="font-size:14px; font-weight:400; letter-spacing:0.5px;">Kinerja Petugas Pendataan</h3>

                        <div class="card-actions" style="margin-top:0.6%;  margin-right:-0.2%;">
                            <a style="font-weight:400; font-size:12px;" href="{{ route('kinerja-petugas-pendataan') }}">
                                Unduh Excel
                            </a>
                        </div>

                    </div>
                    <div class="card-body p-0">
                        <div class="">
                            <table class="table table-hover" id="table-regis" style="margin-top: 1rem !important;">
                                <thead class="text-center">
                                    <tr>

                                        <th>
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Petugas
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
                                                Role
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
                                                Input Total
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

        <div style="margin-top: 1rem" class="row-cards">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-status-top bg-success"></div>
                    <div class="card-header" style="padding-left:0.6%;">
                        <h3 class="card-title" style="font-size:14px; font-weight:400; letter-spacing:0.5px;">Detil Input Petugas Pendataan</h3>
                        <div class="card-actions" style="margin-top:0.6%; margin-right:-0.2%;">
                            <a style="font-weight:400; font-size:12px;" href="{{ route('detil-petugas-pendataan') }}">
                                Unduh Excel
                            </a>
                        </div>

                    </div>

                    <div class="card-body px-0">
                        <table class="display table table-striped" id="table-surveyer3" style="width: 100%">

                            <thead>
                                <tr class="size_detil text-center" valign="middle">
                                    <th>
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Petugas
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th>
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            No Perjanjian
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th>
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Pelaku Usaha
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th>
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Nama Usaha
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>

                                    <th>
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Sektor
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th>
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Modal
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th>
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Jumlah Tenaga
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th>
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Alamat
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th>
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            ID Sub Blok
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th>
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Kelurahan
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th>
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Kecamatan
                                        </div>

                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th>
                                        <div style="display: none;" class="lazy_name_kinerja">
                                            Badan Usaha
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


        <div style="margin-top: 1rem" class="row-cards">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-status-top bg-orange"></div>
                    {{-- <div class="card-header">
                        <div class="card-status-top bg-warning"></div>
                        <h3 class="card-title">Titik Lokasi Survey</h3>
                    </div> --}}

                    <div class="card-header" style="padding-left: 0.6%;">
                        <h3 class="card-title" style="font-size:14px; font-weight:400; letter-spacing:0.5px;">Peta Pendataan Usaha</h3>
                    </div>


                    <div class="card-body p-0">
                        {{-- <div style="width: 100%;height:70vh" id="map">
                        </div> --}}
                        <div class="w-100" id="map" style="height: 70vh">
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
    $('.image_slider_pendataan').slick({
        slidesToShow: 7
        , lazyLoad: 'ondemand'
        , slidesToScroll: 1
        , dots: false
        , focusOnSelect: true
        , variableWidth: true
        , infinite: false
        , arrows: true
    });

</script>


<script type="text/javascript">
    $(document).ready(function() {

        $('#table-regis').DataTable({
            processing: false
            , serverSide: true,

            "drawCallback": function(settings) {
                $(".hide_lazyload_kinerja").hide();
                $(".lazy_name_kinerja").show();
                $(".dataTables_length").show();
                $(".dataTables_filter").show();
            },

            ordering: true
            , order: [
                [4, "desc"]
            ],

            ajax: "{{ url('/dashboard/get-petugas-pendataan') }}"

            , columns: [{
                    data: 'name'
                    , name: 'name'
                }
                , {
                    data: 'penempatan'
                    , name: 'penempatan'

                }
                , {
                    data: 'roles'
                    , name: 'roles'
                }
                , {
                    data: 'input_pendataa_perhari_count'
                    , name: 'input_pendataa_perhari_count'
                }
                , {
                    data: 'pendataan_count'
                    , name: 'pendataan_count'
                }
            , ]
            , columnDefs: [{
                    orderSequence: ["asc", "desc"]
                    , targets: [0]
                , }
                , {
                    orderSequence: ["asc", "desc"]
                    , targets: [1]
                , }, {
                    orderSequence: ["asc", "desc"]
                    , targets: [2]
                    , className: "text-center"
                , }
                , {
                    orderSequence: ["asc", "desc"]
                    , targets: [3]
                    , className: "text-center"
                , }
                , {
                    orderSequence: ["asc", "desc"]
                    , targets: [4]
                    , className: "text-center"
                , }


            , ]
        , });
    })

</script>


<script type="text/javascript">
    $(document).ready(function() {

        $.fn.dataTable.pipeline = function(opts2) {
            // Configuration options
            var conf = $.extend({
                    pages: 100, // number of pages to cache
                    url: 'get-detil-pendataan', // script url
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
            $('#table-surveyer3').DataTable({

                "drawCallback": function(settings) {
                    $(".hide_lazyload_kinerja").hide();
                    $(".lazy_name_kinerja").show();
                },

                processing: false
                , serverSide: true
                    // , ajax: "{{ url('/dashboard/get-detil-pendataan') }}"

                , ajax: $.fn.dataTable.pipeline({
                        url: 'get-detil-pendataan'
                        , pages: 100, // number of pages to cache
                    })

                , language: {
                search: "Pencarian:",
                processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>'
                , }

                , ordering: false
                , scrollX: true
                , sScrollX: "250%"
                , sScrollXInner: "250%"
                , responsive: false
                , order: [
                    [0, "desc"]
                ],


                columns: [{
                        data: 'user.name'
                        , name: 'user.name'
                    }, {
                        data: 'no_perjanjian'
                        , name: 'no_perjanjian'
                    }
                    , {
                        data: 'pelaku'
                        , name: 'pelaku'
                    }, {
                        data: 'nama_usaha'
                        , name: 'nama_usaha'
                    }, {
                        data: 'sektor'
                        , name: 'sektor'
                    }, {
                        data: 'modal'
                        , name: 'modal'
                    }, {
                        data: 'jumlah_tenaga'
                        , name: 'jumlah_tenaga'
                    }, {
                        data: 'alamat'
                        , name: 'alamat'
                    }, {
                        data: 'id_sub_blok'
                        , name: 'id_sub_blok'
                    }, {
                        data: 'kelurahan'
                        , name: 'kelurahan'
                    }, {
                        data: 'kecamatan'
                        , name: 'kecamatan'
                    }, {
                        data: 'badan_usaha'
                        , name: 'badan_usaha'
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
                        , className: "text-center"
                        , targets: [4]
                    , }, {
                        orderSequence: ["asc", "desc"]
                        , targets: [5]
                        , className: "text-center"
                    , }, {
                        orderSequence: ["asc", "desc"]
                        , targets: [6]
                        , className: "text-center"
                    }, {
                        orderSequence: ["asc", "desc"]
                        , targets: [7]
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
                    , }, {
                        orderSequence: ["asc", "desc"]
                        , targets: [11]
                    , }, {
                        width: "5%"
                        , targets: 0
                    }, {
                        width: "4%"
                        , targets: 1
                    }, {
                        width: "5%"
                        , targets: 2
                    }, {
                        width: "5%"
                        , targets: 3
                    }, {
                        width: "3%"
                        , targets: 4
                    }, {
                        width: "3%"
                        , targets: 5
                    }, {
                        width: "3%"
                        , targets: 6
                    }, {
                        width: "6%"
                        , targets: 7
                    }, {
                        width: "3%"
                        , targets: 8
                    }, {
                        width: "4%"
                        , targets: 9
                    }, {
                        width: "4%"
                        , targets: 10
                    }, {
                        width: "3%"
                        , targets: 11
                    }
                , ],

            });
        });


    })

</script>








@endsection