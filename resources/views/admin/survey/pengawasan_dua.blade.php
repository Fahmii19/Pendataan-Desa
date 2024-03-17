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
        max-height: 18.5rem;
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

    .slide-arrow {
        position: absolute;
        top: 50%;
        margin-top: -15px;
    }

    /* mengatur tombol slider kiri pada Survey Titik Galian */
    .slick-prev-galian {
        left: 56rem;
    }

    /* mengatur tombol slider kanan pada Survey Titik Galian */
    .slick-next-galian {
        right: -22.5rem;
    }

    /* mengatur tombol slider tinggi pada Survey Titik Galian */
    .slick-prev-galian, .slick-next-galian {
        margin-top:8.5rem !important;
    }

/* .slick-prev:before{
    opacity: .25;
} */

.off_opacity_slider_galian{
    opacity: .25;
}
.on_opacity_slider_galian{
    opacity: 1;
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
        margin: 55vh 2vw 0 0 !important;
    }

    #DataTables_Table_0_length {
        display: none;
    }

    #DataTables_Table_0_filter {
        display: none;
    }

    .dataTables_filter {
        margin-right: 1.5%;
    }


    .grid_custom_first {
        display: grid;
        grid-template-columns: 270px 197px 153px 177px 112px 164px 188px;
        justify-content: center;
    }

    .grid_custom_second {
        margin-top: 2vh;
        display: grid;
        grid-template-columns: 147px 150px 120px 130px;
        justify-content: center;
    }

    #DataTables_Table_0_info {
        margin-left: 0.5vw !important;
    }

    #DataTables_Table_0_paginate {
        margin-right: 0.5vw !important;
    }


    .mapboxgl-popup-close-button {
        outline: none !important;
    }

    .mapboxgl-popup-content {
        width: 23vw !important;
    }

    #hide_scroll_peta {
        display: none;
    }

    /* Responsive */

    @media only screen and (max-width: 1498px) {

            /* mengatur tombol slider kiri pada Survey Titik Galian */
    .slick-prev-galian {
        left: 52rem !important;
    }

    /* mengatur tombol slider kanan pada Survey Titik Galian */
    .slick-next-galian {
        right: -15.5rem !important;
    }

    /* mengatur tombol slider tinggi pada Survey Titik Galian */
    .slick-prev-galian, .slick-next-galian {
        margin-top:7.5rem !important;
    }

    }

    @media only screen and (max-width: 1498px) {

            /* mengatur tombol slider kiri pada Survey Titik Galian */
    .slick-prev-galian {
        left: 54rem !important;
    }

    /* mengatur tombol slider kanan pada Survey Titik Galian */
    .slick-next-galian {
        right: -21.5rem !important;
    }

    /* mengatur tombol slider tinggi pada Survey Titik Galian */
    .slick-prev-galian, .slick-next-galian {
        margin-top:7.5rem !important;
    }
}
    @media only screen and (max-width: 1437px) {

            /* mengatur tombol slider kiri pada Survey Titik Galian */
    .slick-prev-galian {
        left: 52rem !important;
    }

    /* mengatur tombol slider kanan pada Survey Titik Galian */
    .slick-next-galian {
        right: -21.5rem !important;
    }

    /* mengatur tombol slider tinggi pada Survey Titik Galian */
    .slick-prev-galian, .slick-next-galian {
        margin-top:7.5rem !important;
    }
}

    @media only screen and (max-width: 1390px) {

            /* mengatur tombol slider kiri pada Survey Titik Galian */
    .slick-prev-galian {
        left: 48rem !important;
    }

    /* mengatur tombol slider kanan pada Survey Titik Galian */
    .slick-next-galian {
        right: -21.5rem !important;
    }

    /* mengatur tombol slider tinggi pada Survey Titik Galian */
    .slick-prev-galian, .slick-next-galian {
        margin-top:7.5rem !important;
    }

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
                    Galian
                </h2>
            </div>
            <!-- Page title actions -->

        </div>
    </div>




</div>

<div class="page-body">
    <div class="container-xl">
        <!-- konten disini -->

        {{-- Nonaktifkan --}}
        <div class="row flex_container">

            <div class="col">
                <div class="card responsive_jarak card_responsive_izin_lingkungan">

                    <div class="card-status-top bg-blue"></div>

                    <div class="d-flex flex-column" style="height: 9.5rem;">
                        <div class="border_dashboard px-3 py-3" style="height: 4.3rem; padding-left:1rem; padding-top:0.1rem;">

                            <div class="d-flex">

                                <div class="w-100 d-flex justify-content-start font_size_box_informasi" style="color:#206bc4;">
                                    Jumlah Petugas Survey
                                </div>

                                <div class="flex-shrink-1 d-flex justify-content-end">
                                    <span class="bg-blue text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-percentage" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                <div id="hitung_jumlah_ajib">0</div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col">
                <div class="card responsive_jarak">

                    <div class="card-status-top bg-orange"></div>

                    <div class="d-flex flex-column" style="height: 9.5rem;">
                        <div class="border_dashboard px-3 py-3" style="height: 4.3rem; padding-left:1rem; padding-top:0.1rem;">

                            <div class="d-flex">

                                <div class="w-100 d-flex justify-content-start font_size_box_informasi" style="color:#f76707;">
                                    Jumlah Izin Galian
                                </div>

                                <div class="flex-shrink-1 d-flex justify-content-end">
                                    <span class="bg-orange text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                <div id="hitung_izin_galian">0</div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col">
                <div class="card responsive_jarak card_responsive_izin_lingkungan">

                    <div class="card-status-top bg-danger"></div>

                    <div class="d-flex flex-column" style="height: 9.5rem;">
                        <div class="border_dashboard px-3 py-3" style="height: 4.3rem; padding-left:1rem; padding-top:0.1rem;">

                            <div class="d-flex">

                                <div class="w-100 d-flex justify-content-start font_size_box_informasi" style="color:#d63939;">
                                    Jumlah Titik Survey
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
                                <div id="hitung_izin_ajib">0</div>
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
                                    Status Proyek
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

                        <div class="" style="padding-left:1rem; padding-right:1rem; padding-top:0.5rem;">

                            <div class="d-flex justify-content-between">
                                <div class="">Proses</div>
                                <div class="">
                                    <strong>
                                        <div id="panjang_status_proses">0</div>
                                    </strong>

                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="">Hold</div>
                                <div class="">
                                    <strong>
                                        <div id="panjang_status_hold">0</div>
                                    </strong>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="">Selesai</div>
                                <div class="">
                                    <strong>
                                        <div id="panjang_status_selesai">0</div>
                                    </strong>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>


        </div>

        {{-- Slider Data--}}
        <div style="margin-top: 1rem;" class="row-cards">
            <div class="col-md-12 col-xl-12">

                <div class="card mt-3">
                    <div class="card-status-top bg-primary"></div>

                    <div class="card-header card-header-light">
                        <h3 class="card-title" style="font-size:14px; font-weight:400; letter-spacing:0.5px;">Survey Titik Galian</h3>
                        <div class="card-actions">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- <div class="slick-list draggable">
                        <div class="slick-track" style="opacity: 1; width: 963023px; transform: translate3d(-1226px, 0px, 0px);">
                            <div class="slick-slide" data-slick-index="0" aria-hidden="true" style="width: 613px;" tabindex="-1">
                                <img id="6" class="img_child_survey" data-id="6" src="https://jakarta.pintoinvest.com/survey/not_image.png" onclick="SliderTitikGalian('6')" alt="Thumbnail">
                            </div>
                            <div class="slick-slide" data-slick-index="0" aria-hidden="true" style="width: 613px;" tabindex="-1">
                                <img id="6" class="img_child_survey" data-id="7" src="https://jakarta.pintoinvest.com/survey/not_image.png" onclick="SliderTitikGalian('7')" alt="Thumbnail">
                            </div>
                        </div>
                    </div> --}}

                    <div class="container-fluid px-0">
                        <div class="row no-gutters">
                            <div class="col-md-6 slider-thumbnails">

                                <div style="border-style: 2px #000 solid" class="data_image_space2 gambar_peta">
                                    <img class="img_slide_survey_galian_ajib" src="https://jakarta.pintoinvest.com/v1/survey/blank_not_image.png" alt="">
                                </div>

                                {{-- <div><img class="img_parents" src="https://jakarta.pintoinvest.com/survey/not_image.png" alt="First slide"></div> --}}



                            </div>

                            <div sty class="col-md-6 mt-3">

                                <div class="row">
                                    <div class="col-md-2">

                                        {{-- <div id="photo_ajib">

                                            </div> --}}

                                        <div id="" class="">
                                            <img class="" src="https://jakarta.pintoinvest.com/v1/survey/not_image.png" alt="" style="width: 60%;">
                                        </div>

                                    </div>

                                    <div style="margin-left:-2.5rem;" class="col-md-10 mt-1">
                                        <div class="text-truncate" style="margin-top:-0.5rem;">
                                            <span class="h4" id="nama_petugas">
                                            </span>
                                        </div>
                                        {{-- <div class="mt-1">
                                                <span id="penempatan">
                                                </span>
                                            </div> --}}
                                    </div>

                                </div>

                                <div style="border-bottom: 1px solid #e5e7eb; margin-top: 2.8%"></div>

                                <div class="teks_height" style="margin-top: 2.1%">
                                    <div class="row jarak_judul">
                                        <div class="col-md-5">
                                            <label class="form-label">Kegiatan<span style="margin-left: 3.7rem;">
                                                </span></label>
                                        </div>
                                        <div class="col-md-7 jarak_text">
                                            <div class="col text_data_home">
                                                <span id="kegiatan_ajib">
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row jarak_judul">
                                        <div class="col-md-5">
                                            <label class="form-label">Nama Objek <span style="margin-left: 2.5rem;">
                                                </span></label>
                                        </div>
                                        <div class="col-md-7 jarak_text">
                                            <div class="col text_data_home">
                                                <span id="nama_obj">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row jarak_judul">
                                        <div class="col-md-5">
                                            <label class="form-label">Pemilik <span style="margin-left: 2.5rem;">
                                                </span></label>
                                        </div>
                                        <div class="col-md-7 jarak_text">
                                            <div class="col text_data_home">
                                                <span id="pemilik_ajib">

                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row jarak_judul">
                                        <div class="col-md-5">
                                            <label class="form-label">No Izin <span style="margin-left: 2.5rem;">
                                                </span></label>
                                        </div>
                                        <div class="col-md-7 jarak_text">
                                            <div class="col text_data_home">
                                                <span id="no_izin_ajib">

                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row jarak_judul">
                                        <div class="col-md-5">
                                            <label class="form-label">Status Proyek <span style="margin-left: 2.5rem;">
                                                </span></label>
                                        </div>
                                        <div class="col-md-7 jarak_text">
                                            <div class="col text_data_home">
                                                <span id="statusproyek">

                                                </span>
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

        {{-- Peta --}}
        <div style="margin-top: 1rem;" class="row row-cards">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-status-top bg-yellow"></div>
                    <div class="card-header">
                        <h3 class="card-title" style="font-size:14px; font-weight:400; letter-spacing:0.5px;">Titik Lokasi Galian</h3>
                    </div>
                    <div class="card-body p-0">
                        <div style="width: 100%;height:70vh" id="map">

                            <div style="z-index: 9; position:absolute;" class="container mt-3">

                                <div class="d-none">
                                    <input type="radio" id="radio_umkm" name="radio_menu" value="radio_umkm">
                                    <input type="radio" id="radio_dibangun" name="radio_menu" value="radio_dibangun">
                                </div>

                                <div class="grid_custom_first">

                                    <div class="d-flex"></div>
                                    <div class="d-flex"></div>

                                    <div class="d-flex">

                                        <div class="on_layer_umkm">

                                            <button id="btn_umkm" class="btn btn-light btn-pill w-100">
                                                <span class="icon material-icons text-primary">
                                                    <span class="material-symbols-outlined">
                                                        remove_road
                                                    </span>
                                                </span>
                                                <div style="font-weight: bold" class="text-muted">Izin Galian</div>
                                            </button>

                                        </div>

                                        <div class="off_layer_umkm" id="hide_scroll_peta">

                                            <button style="background: orange; border-radius: 30px; box-shadow: 1px 1px 1px #000; border-color:orange;" id="btn_off_layer_umkm" class="btn btn-pill w-100">

                                                <span class="icon material-icons text-primary">
                                                    <span class="material-symbols-outlined">
                                                        remove_road
                                                    </span>
                                                </span>

                                                <div style="font-weight: bold" class="text-muted">Izin Galian</div>

                                            </button>

                                        </div>

                                    </div>

                                    <div class="d-flex">

                                        <div class="on_layer_dibangun">

                                            <button id="btn_dibangun" class="btn btn-light btn-pill w-100">
                                                <span class="icon material-icons text-primary">
                                                    more_time
                                                </span>
                                                <div style="font-weight: bold" class="text-muted">Survey Galian
                                                </div>
                                            </button>

                                        </div>

                                        <div class="off_layer_dibangun" id="hide_scroll_peta">

                                            <button style="background: orange; border-radius: 30px; box-shadow: 1px 1px 1px #000; border-color:orange;" id="btn_off_layer_dibangun" class="btn btn-pill w-100">

                                                <span class="icon material-icons text-primary">
                                                    more_time </span>

                                                <div style="font-weight: bold" class="text-muted">Survey Galian
                                                </div>

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



{{-- Jquery | Slick --}}
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<!-- Slick JS -->
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


{{-- <script>
    var $fileName = 'Data Export Pengawasan';


    document.getElementById("select_option_pengawasan").onchange = function() {
        $hasil = document.getElementById("select_option_pengawasan").value;
    };


    var $fileTitle = 'Data Pengawasan'.$hasil;


    $(document).ready(function() {


        $('.data-pengawasan-dua').DataTable({

            ordering: true
            , processing: true
            , serverSide: true
            , order: [
                [0, "asc"]
            ]
            , ajax: "{{ url('/dashboard/get-data-pengawasan') }}"
, "deferRender": true
, "responsive": true


, language: {
search: "Pencarian:"
, processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span> '
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
$("#DataTables_Table_0_length").show();
$("#DataTables_Table_0_filter").show();
},


// Tampil Data Per pagination
"lengthMenu": [
[10, 25, 50, 100, 1000, -1]
, ['10 rows', '25 rows', '50 rows', '100 rows', '1000 rows', 'All']
],


// cetak table
columns: [{
data: 'user.name'
, name: 'user.name'
}
, {
data: 'judul'
, name: 'judul'
}
, {
data: 'tipe'
, name: 'tipe'
},

{
data: 'kelurahan'
, name: 'kelurahan'
},

{
data: 'catatan'
, name: 'catatan'
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
, }
, {
orderSequence: ["desc", "asc"]
, targets: [1]
, }
, {
orderSequence: ["desc", "asc"]
, targets: [2]
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
, },

{
width: "10%"
, targets: [0]
}
, {
width: "10%"
, targets: [1]
}
, {
width: "10%"
, targets: [2]
}
, {
width: "10%"
, targets: [3]
}
, {
width: "10%"
, targets: [4]
}
, {
width: "10%"
, targets: [5]
},

],


});



});

</script> --}}

{{-- slick js --}}

<script>
    // $(".slick_filter_menu").slick({
    //     dots: false
    //     , arrows: false
    //     , variableWidth: true
    //     , infinite: false
    //     , swipeToSlide: true,
    //     // , centerMode: true
    //     slidesToShow: 6
    //     , slidesToScroll: 1
    // });

</script>

@endsection
