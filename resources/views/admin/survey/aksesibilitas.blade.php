@extends('layouts.template_admin')
@section('content')
<style>
    /* .skeleton-heading {
        width: 100vw !important;
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
        max-height: 18.5rem;
        overflow-x: hidden;
        margin-top: 2vh;
        /* padding-left: 1.5vh;
        padding-right: 1.5vh; */
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

    #table-petugas_filter {
        margin-right: 2.2% !important;
    }

    #table-petugas_length {
        margin-bottom: 0.5rem !important;
        margin-left: 1.3% !important;
    }

    #table-petugas_info {
        margin-left: 1.5% !important;
        margin-top: 0.6% !important;
    }

    #table-petugas_paginate {
        margin-right: 1.4% !important;
        margin-top: 1.5% !important;
    }


    table.dataTable>thead>tr>th:not(.sorting_disabled),
    table.dataTable>thead>tr>td:not(.sorting_disabled) {
        padding-right: 10px !important;
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
        width: 100% !important;
        object-fit: revert !important;
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


    .dt-buttons {
        position: relative;
        top: -1.9rem;
        right: 3rem;
    }

    .progress.progress-xs {
        position: relative;
        top: 0.4rem;
    }

    .mapboxgl-ctrl-top-right .mapboxgl-ctrl {
        margin: 28rem 50% 0 0 !important;
    }

    /* .mapboxgl-popup-close-button:focus {
        outline: none;
        box-shadow: none;
    } */

    /* aksesibilitas */


    .data_image_space2 .slick-prev,
    .slick-next {
        /* top: 45% !important; */
        right: 5%;
    }

    .slick-prev {
        left: 4%;
    }

    .mapboxgl-popup-content {
        padding: 0px 0px 0px 0px !important;
    }

    .slick-prev:before,
    .slick-next:before {
        font-size: 27px !important;
    }

    /* untuk style peta */
    .mapboxgl-popup-close-button {
        background-color: #D3D3D3 !important;
        /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.5) !important; */
    }

    /* untuk style peta */
    .mapboxgl-popup-close-button:focus-visible {
        box-shadow: none !important;
        outline: none !important;
    }

    /* Custom Btn Slider Peta */
    .btn_slider_peta .slick-prev:before {
        /* left: -22px !important; */
        font-size: 25px !important;
        font-family: "Font Awesome 5 Free" !important;
        font-weight: 900 !important;
        content: "\f104" !important;
    }

    .btn_slider_peta .slick-next:before {
        /* right: -10px !important; */

        font-size: 25px !important;
        font-family: "Font Awesome 5 Free" !important;
        font-weight: 900 !important;
        content: "\f105" !important;
        /* margin-right: -130% !important; */
    }

    /* peta aksesibilitas */
    /* .peta_btn_aksesibilitas .slick-dots {
        margin-bottom: 10px !important;
    } */
    .slick-dotted.slick-slider {
        margin-bottom: 19px !important;
    }

    .mapboxgl-ctrl-compass {
        display: none !important;
    }

    /* Mengatur dropdown menu */
    .aksesibilitas_dropdown_menu {
        position: absolute;
        /* transform: translate3d(0px, 38px, 0px); */
        margin: 0px;
        width: 410px;
        max-height: 400px;
        overflow-y: auto;
    }

    .FixedSizeItem {
        display: flex;
        align-items: center;
        width: 400px;
        height: 35px;
        overflow: hidden;
    }

    .flex-container {
        display: flex;
        align-items: center;
    }

    .icon-tabler {
        /* margin-right: 10px;   */
        /* Jarak antara ikon SVG dan teks */
        flex-shrink: 0;
        /* Ini akan mencegah ikon SVG untuk menyusut */
    }




    /* Tombol untuk menghapus pencarian */
    .clearable-input {
        position: relative;
        /* display: inline-block; */
    }

    .clearable-input .input-clearer {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        display: none;
    }

    .clearable-input input[type="text"]:focus+.input-clearer,
    .clearable-input input[type="text"]:not(:placeholder-shown)+.input-clearer {
        display: block;
    }

    /* Progres survey perkelurahan */
    #DataTables_Table_0_filter {
        margin-right: 2vh !important;
        display: none !important;
    }

    #DataTables_Table_0_paginate {
        margin-right: 1.4% !important;
        margin-top: 1.5% !important;
    }

    #DataTables_Table_0_info {
        margin-left: 1.5% !important;
        margin-top: 0.6% !important;
    }

    /*  */
    #rdtr:focus {
        outline: none !important;
        box-shadow: none !important;
    }

    #cari_wilayah:focus {
        outline: none !important;
        box-shadow: none !important;
    }

    /* peta titik survey */
    .form-control:focus {
        border-color: #dad4d4 !important;
    }

    /* semua elemen dapat */
    input,
    select,
    textarea,
    button {
        box-shadow: none !important;
    }

    .gambar_peta_aksesibilitas .slick-dots li {
        margin: 0 -5px 0 0 !important
    }

    .custom_position {
        /* left: -5rem !important; */
        position: absolute;
    }

    .custom_width {
        width: 100%;
    }

    /* .skeleton_aksesibilitas {
        margin-left: -11.5%;
    } */

    .skeleton-heading:after {
        width: 100%;
    }

    .skeleton-heading {
        height: 1.3rem;
        margin-bottom: 0 !important;
    }

    .form-label {
        font-weight: normal !important;
        margin-bottom: 0.5rem !important;
        font-size: 0.875rem !important;

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
                    Aksesibilitas
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">

        {{-- Box Card Information --}}
        <div class="row flex_container">

            <div class="col">
                <div class="card responsive_jarak card_responsive_izin_lingkungan">

                    <div class="card-status-top bg-danger"></div>

                    <div class="d-flex flex-column" style="height: 9.5rem;">

                        <div class="border_dashboard px-3 py-3" style="height: 4.3rem; padding-left:1rem; padding-top:0.1rem;">
                            <div class="d-flex">

                                <div class="w-100 d-flex justify-content-start font_size_box_informasi" style="color:#d63939;">
                                    Titik Survey Tercatat Hari Ini
                                </div>

                                <div class="flex-shrink-1 d-flex justify-content-end">
                                    <span class="bg-red text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                {{ $survey_aksesibilitas_perhari }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col">
                <div class="card responsive_jarak card_responsive_izin_lingkungan">

                    <div class="card-status-top bg-success"></div>

                    <div class="d-flex flex-column" style="height: 9.5rem;">

                        <div class="border_dashboard px-3 py-3" style="height: 4.3rem; padding-left:1rem; padding-top:0.1rem;">
                            <div class="d-flex">

                                <div class="w-100 d-flex justify-content-start font_size_box_informasi" style="color:#2FB344;">
                                    Total Titik Survey Tercatat
                                </div>

                                <div class="flex-shrink-1 d-flex justify-content-end">
                                    <span class="bg-green text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                {{ $hitung_survey_aksesibilitas }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        {{-- Slider --}}
        <div class="row-cards">
            <div class="col-12">

                <div class="card mt-3">
                    <div class="card-status-top bg-success"></div>

                    <div class="card-header card-header-light">
                        <h3 class="card-title">Data Input Terbaru</h3>

                        <div class="card-actions">
                            <div class="row align-items-center">
                                <div class="col-auto"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body mobile_container" style="padding-left:0; padding-top:0; padding-right:0;">

                        <div class="container-fluid row no-gutters" style="padding-left:0; padding-top:0; padding-right:0;">
                            <div class="col-md-6">
                                <div class="gambar_aksesibilitas data_image_space">
                                    <img class="img_slide_survey_galian_ajib" src="https://jakarta.pintoinvest.com/v1/survey/blank_not_image.png" alt="">
                                </div>
                            </div>

                            <div class="col-md-6 mt-3" style="padding-right:0; padding-left:0;">

                                {{-- Foto dan data ajib --}}
                                <div class="container mb-2" style="padding-left: 1.5%;">
                                    <div class="row">
                                        <div class="col-md-3 d-flex justify-content-start align-items-center">
                                            <div id="photo_aksesibilitas">
                                                <div class="" style="height:21.5vh; width:9vw;"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col skeleton_aksesibilitas align-items-center " style="padding-right:0;">
                                                    <div class="container " style="padding-left:0; padding-right:0;">

                                                        <div class="cols">
                                                            <div class="col-sm">
                                                                <span class="h4" id="name_aksesibilitas">
                                                                    <div class="skeleton-heading mb-0"></div>
                                                                </span>

                                                            </div>
                                                            <div class="col-sm">
                                                                <span id="penempatan_aksesibilitas">
                                                                    <div class="skeleton-heading mb-0"></div>
                                                                </span>

                                                            </div>

                                                        </div>
                                                    </div>

                                                    {{-- <span id="name_aksesibilitas">
                                                            <div class="skeleton-heading mb-0"></div>
                                                        </span>
                                                        <span id="penempatan_aksesibilitas">
                                                            <div class="skeleton-heading mb-0"></div>
                                                        </span> --}}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                {{-- Survey Ajib --}}
                                <div class="container mb-1">
                                    <div class="row">
                                        <div class="col-md-3 d-flex justify-content-start align-items-center" style="padding-left:0;">
                                            <div class="col skeleton_aksesibilitas align-items-center" style="padding-right:2rem">
                                                <span id="label">
                                                    <div class="col skeleton_aksesibilitas align-items-center">
                                                        <span id="label_lebar_jalan_aksesibilitas">
                                                            <div class="skeleton-heading mb-0"></div>
                                                        </span>
                                                    </div>

                                                </span>
                                            </div>

                                        </div>
                                        <div class="col-md-9 " style="padding-left:0; padding-right:0;">

                                            <div class="row">
                                                <div class="col skeleton_aksesibilitas align-items-center">

                                                    <span id="lebar_jalan_aksesibilitas">
                                                        <div class="skeleton-heading mb-0"></div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="container mb-1">
                                    <div class="row">
                                        <div class="col-md-3 d-flex justify-content-start align-items-center" style="padding-left:0;">

                                            <div class="col skeleton_aksesibilitas align-items-center" style="padding-right:2rem">

                                                <span id="label_kelas_jalan_aksesibilitas">
                                                    <div class="skeleton-heading mb-0"></div>
                                                </span>
                                            </div>

                                        </div>
                                        <div class="col-md-9 " style="padding-left:0; padding-right:0;">
                                            <div class="row">
                                                <div class="col skeleton_aksesibilitas align-items-center">
                                                    <span id="kelas_jalan_aksesibilitas">
                                                        <div class="skeleton-heading mb-0"></div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="container mb-1">
                                    <div class="row">
                                        <div class="col-md-3 d-flex justify-content-start align-items-center" style="padding-left:0;">
                                            <div class="col skeleton_aksesibilitas align-items-center" style="padding-right:2rem">

                                                <span id="label_pendestrian_aksesibilitas">
                                                    <div class="skeleton-heading mb-0"></div>
                                                </span>
                                            </div>

                                        </div>
                                        <div class="col-md-9 " style="padding-left:0; padding-right:0;">

                                            <div class="row">
                                                <div class="col skeleton_aksesibilitas align-items-center">
                                                    <span id="pendestrian_aksesibilitas">
                                                        <div class="skeleton-heading mb-0"></div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container mb-1">
                                    <div class="row">
                                        <div class="col-md-3 d-flex justify-content-start align-items-center" style="padding-left:0;">
                                            <div class="col skeleton_aksesibilitas align-items-center" style="padding-right:2rem">

                                                <span id="label_kelurahan_aksesibilitas">
                                                    <div class="skeleton-heading mb-0"></div>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-9 " style="padding-left:0; padding-right:0;">
                                            <div class="row">
                                                <div class="col skeleton_aksesibilitas align-items-center">
                                                    <span id="kelurahan_aksesibilitas">
                                                        <div class="skeleton-heading mb-0"></div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container mb-1">
                                    <div class="row">
                                        <div class="col-md-3 d-flex justify-content-start align-items-center" style="padding-left:0;">

                                            <div class="col skeleton_aksesibilitas align-items-center" style="padding-right:2rem">

                                                <span id="label_kecamatan_aksesibilitas">
                                                    <div class="skeleton-heading mb-0"></div>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-9 " style="padding-left:0; padding-right:0;">

                                            <div class="row">
                                                <div class="col skeleton_aksesibilitas align-items-center">
                                                    <span id="kecamatan_aksesibilitas">
                                                        <div class="skeleton-heading mb-0"></div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container mb-1">
                                    <div class="row">
                                        <div class="col-md-3 d-flex justify-content-start align-items-center" style="padding-left:0;">
                                            <div class="col skeleton_aksesibilitas align-items-center" style="padding-right:2rem">

                                                <span id="label_kota_aksesibilitas">
                                                    <div class="skeleton-heading mb-0"></div>
                                                </span>
                                            </div>

                                        </div>
                                        <div class="col-md-9 " style="padding-left:0; padding-right:0;">

                                            <div class="row">
                                                <div class="col skeleton_aksesibilitas align-items-center">
                                                    <span id="kota_aksesibilitas">
                                                        <div class="skeleton-heading mb-0"></div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row jarak_inmobile">
                                <div class="col-md-12 mt-2">
                                    <div class="image_slider_input data_image_space2">
                                        @foreach ($data_aksesibilitas as $id)
                                        <div>
                                            <img class="img_child_survey img_child_id_aksesibilitas del_class_image" data-id="{{ $id->id }}" data-lazy="{{ count($id->image) == 0 ? 'https://jakarta.pintoinvest.com/v1/survey/not_image.png' : 'https://jakarta.pintoinvest.com:9000/aksesibilitas/' . $id->image[0]->photo }}">
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

        {{-- Table Kinerja Petugas Survey --}}
        <div style="margin-top: 1rem" class="row-cards">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-status-top bg-danger"></div>
                    <div class="card-header" style="padding-left: 0.6%;">
                        <h3 class="card-title" style="font-size:14px; font-weight:400; letter-spacing:0.5px;">Kinerja Petugas Survey</h3>

                        {{-- <div class="card-actions" style="margin-top:0.6%;  margin-right:-0.2%;">
                            <a style="font-weight:400; font-size:12px;" href="{{ route('kinerja-petugas-aksesibilitas') }}">
                        Unduh Excel
                        </a>
                    </div> --}}

                </div>
                <div class="card-body px-0">
                    <div style="overflow-x: hidden !important;" class="table-responsive">
                        <table class="display table table-striped" id="table-petugas" style="width: 100%">
                            <thead>
                                <tr class="size_detil text-center" valign="middle">
                                    <th>
                                        <div style="display: none;" class="lazy_name_kinerja">Nama Petugas Ajib</div>
                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th>
                                        <div style="display: none;" class="lazy_name_kinerja">Penempatan</div>
                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th>
                                        <div style="display: none;" class="lazy_name_kinerja">Input Hari Ini</div>
                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                    <th>
                                        <div style="display: none;" class="lazy_name_kinerja">Input Total</div>
                                        <div class="hide_lazyload_kinerja">
                                            <div class='skeleton-line'></div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($x = 0; $x <= 9; $x++) <tr class='hide_lazyload_kinerja'>
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
                                    </tr>
                                    @endfor
                            </tbody>
                        </table>


                    </div>
                </div>



            </div>
        </div>

        {{-- Table Export Per Kelurahan --}}
        <div class="row row-cards" style="margin-top: 1rem; margin-bottom:0.5rem">
            <div class="col-md-12 col-xl-12">
                <div class="card">

                    <div class="card-status-top bg-orange"></div>

                    <div class="card-header px-2">

                        <div>
                            <div class="row align-items-center">

                                <div class="col" style="font-size:14px;letter-spacing:0.5px;">
                                    <h3 class="card-title" style="font-size:14px; font-weight:400; letter-spacing:0.5px;"> Progres Survey per Kelurahan</h3>
                                </div>
                                {{-- <div class="hide_lazyload_kinerja">
                                    <div style="width: 12.7rem; height:1.8rem;" class="skeleton-image"></div>
                                </div> --}}
                            </div>
                        </div>


                        <div class="w-25 card-actions" style="margin-right: 1vh;">

                            <div style="display: none;" class="lazy_name_kinerja">
                                <select class="form-select" id="selectAksesibilitas">
                                    <option value="" selected>Semua Kelurahan</option>
                                    @foreach($kelurahan as $kel)
                                    <option value="{{ $kel[0]->kelurahan }}">{{ ucwords(strtolower($kel[0]->kelurahan)) }}</option>

                                    @endforeach

                                </select>

                            </div>

                            {{-- <div class="hide_lazyload_kinerja">
                                <div style="height:1.8rem;" class="w-full skeleton-image">
                                </div>
                            </div> --}}

                        </div>


                        {{-- <div class="w-10">
                            <div style="display: none;" class="lazy_name_kinerja">
                                <a style="border-style:none;" href="/dashboard/Ekspor-Kinerja" target="_blank"
                                    id="PrintAksesibilitas" class="btn w-10">

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

                        </div> --}}

                    </div>




                    <div class="card-body px-0">

                        <div class="d-flex justify-content-between">

                            <div class="col-md-6 justify-content-start">
                                {{-- <div class="hide_lazyload_kinerja">
                                    <div style="width: 12.7rem; height:1.8rem;" class="skeleton-image"></div>
                                </div> --}}
                            </div>

                            <div class="col-md-6 d-flex justify-content-end">
                                {{-- <div class="hide_lazyload_kinerja">
                                    <div style="width: 12.7rem; height:1.8rem;" class="skeleton-image"></div>
                                </div> --}}
                            </div>

                        </div>



                        <div class="table-responsive">
                            <table class="table table-hover data-aksesibilitas" style="width: 100%" style="margin-top: 1rem !important;">

                                <thead class="text-center">
                                    <tr>

                                        <th width="12%">

                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Nama AJIB
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th width="6%">

                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Lebar Jalan
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th width="8%">
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Jenis Jalan
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th width="6%">
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Kelas Jalan
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th width="8%">
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Pedestrian
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th width="10%">
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Kelurahan
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th width="10%">
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Kecamatan
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th width="10%">
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Kota
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
                                            <div class='skeleton-line cusotm_lazyload_konten'></div>
                                        </td>
                                        <td>
                                            <div class='skeleton-line cusotm_lazyload_konten'></div>
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

        {{-- Peta Aksesibilitas --}}
        <div style="margin-top: 1rem" class="row-cards">
            <div class="col-md-12 col-xl-12">
                <div class="card">

                    <div class="card-status-top bg-primary"></div>

                    <div class="card-header" style="padding-left: 0.6%;">
                        <h3 class="card-title" style="font-size:14px; font-weight:400; letter-spacing:0.5px;">
                            Peta Titik Survey </h3>
                    </div>

                    <div class="mt-2 d-flex align-items-center py-1" style="margin-left:1vh; margin-bottom:0.5rem;">
                        <div class="col-md-3 d-flex align-items-center">
                            <div class="form-check zoning_fill mt-2">
                                <input type="checkbox" class="form-check-input" id="rdtr">
                                <label class="form-check-label text_all" for="rdtr">Zonasi sesuai Pergub 31/2022</label>
                            </div>
                        </div>
                        <div class="col-md-5"></div>
                        <div class="col-md-4">
                            <div class="row g-2" style="margin-right: 1.8vh;">
                                <div class="col">
                                    <div class="dropdown clearable-input">
                                        <input id="cari_wilayah" type="text" class="form-control dropdown-toggle" placeholder="Cari nama tempat" data-bs-toggle="dropdown" autocomplete="off">
                                        <span class="input-clearer" onclick="clearInput()">×</span>

                                        <div class="dropdown-menu aksesibilitas_dropdown_menu" id="searchDropdown" aria-labelledby="cari_wilayah">

                                            <!-- Hasil pencarian akan muncul di sini -->
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





                    <div class="card-body p-0">
                        <div class="w-100" id="mapAksesibilitas" style="height: 70vh">
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

{{-- Table Kinerja Petugas Survey --}}
<script type="text/javascript">
    $(document).ready(function() {

        $.fn.dataTable.pipeline = function(opts1) {
            // Configuration options
            var conf = $.extend({
                    pages: 100, // number of pages to cache
                    url: 'get-kinerja-aksesibilitas', // script url
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

        $('#table-petugas').DataTable({
            "drawCallback": function(settings) {
                $(".hide_lazyload_kinerja").hide();
                $(".lazy_name_kinerja").show();
            }
            , processing: true
            , serverSide: true
            , ajax: $.fn.dataTable.pipeline({
                url: 'get-kinerja-aksesibilitas'
                , pages: 100, // number of pages to cache
            })
            , ordering: true
            , language: {
                search: "Pencarian:"
                , processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>'
            },

            order: [
                [0, "asc"]
            , ],

            columns: [{
                    data: 'user.name'
                    , name: 'user.name'
                }
                , {
                    data: 'penempatan'
                    , name: 'penempatan'
                }
                , {
                    data: 'harian_aksesibilitas_count'
                    , name: 'harian_aksesibilitas_count'
                }
                , {
                    data: 'total_aksesibilitas_count'
                    , name: 'total_aksesibilitas_count'
                }
            , ],

            //     columns: [
            //     { data: 'name', name: 'name' },
            //     { data: 'penempatan', name: 'penempatan', render: function(data, type, row) {
            //         return data ? data : 'N/A';
            //     }},
            //     { data: 'harian_aksesibilitas_count', name: 'harian_aksesibilitas_count', render: function(data, type, row) {
            //         return data ? data : '0';
            //     }},
            //     { data: 'total_aksesibilitas_count', name: 'total_aksesibilitas_count', render: function(data, type, row) {
            //         return data ? data : '0';
            //     }}
            // ],


            columnDefs: [{
                targets: [0]
            , }, {
                targets: [1]
            , }, {
                targets: [2]
                , className: "text-center"
            , }, {
                targets: [3]
                , className: "text-center"
            , }, ],

        });

    })

</script>

{{-- Export Data Aksesibilitas --}}
<script>
    // Configuration Constants
    const Nama = 'Data Export Rekap';

    // Event Listeners
    document.getElementById("selectAksesibilitas").onchange = function() {
        const selectedValue = this.value;
    };

    $(document).ready(function() {
        // Initialize DataTable
        $('.data-aksesibilitas').DataTable({
            ordering: true
            , processing: true
            , serverSide: true
            , searching: true
            , order: [
                [0, "asc"]
            ]
            , ajax: "{{ url('/dashboard/survey-aksesibilitas-perkelurahan') }}"
            , deferRender: true
            , responsive: true
            , language: {
                search: "Pencarian:"
                , processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>'
            }
            , drawCallback: function(settings) {
                $("#selectOption").attr("disabled", false);
                $(".hide_lazyload_kinerja").hide();
                $(".lazy_name_kinerja").show();
                $(".dataTables_length").show();
                $(".dataTables_filter").show();
            }
            , lengthMenu: [
                [10, 25, 50, 100, 1000, -1]
                , ['10 rows', '25 rows', '50 rows', '100 rows', '1000 rows', 'All']
            ]
            , columns: [{
                    data: 'user.name'
                    , name: 'user.name'
                }
                , {
                    data: 'lebar_jalan'
                    , name: 'lebar_jalan'
                }
                , {
                    data: 'jenis_jalan'
                    , name: 'jenis_jalan'
                }
                , {
                    data: 'kelas_jalan'
                    , name: 'kelas_jalan'
                }
                , {
                    data: 'pedestrian'
                    , name: 'pedestrian'
                }
                , {
                    data: 'kelurahan_aksesibilitas'
                    , name: 'kelurahan_aksesibilitas'
                }
                , {
                    data: 'kecamatan_aksesibilitas'
                    , name: 'kecamatan_aksesibilitas'
                }
                , {
                    data: 'kota_aksesibilitas'
                    , name: 'kota_aksesibilitas'
                }
            , ]
            , columnDefs: [{
                    orderSequence: ["asc", "desc"]
                    , targets: [0]
                }
                , {
                    orderSequence: ["asc", "desc"]
                    , targets: [1]
                    , className: "text-center"
                }
                , {
                    orderSequence: ["desc", "asc"]
                    , targets: [2]
                    , className: "text-center"
                }
                , {
                    orderSequence: ["desc", "asc"]
                    , targets: [3]
                    , className: "text-center"
                }
                , {
                    orderSequence: ["desc", "asc"]
                    , targets: [4]
                    , className: "text-center"
                }
                , {
                    orderSequence: ["desc", "asc"]
                    , targets: [5]
                }
                , {
                    orderSequence: ["desc", "asc"]
                    , targets: [6]
                }
                , {
                    orderSequence: ["desc", "asc"]
                    , targets: [6]
                }
                , {
                    orderSequence: ["desc", "asc"]
                    , targets: [6]
                }
            , ]
        });
    });

</script>

@endsection
