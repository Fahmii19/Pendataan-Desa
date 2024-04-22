<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @if (isMobileDevice())
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @endif
    <title>Portal Investasi Desa</title>


    {{-- <link rel="icon" href="assets/gambar/favicon.png"> --}}

    {{-- Pendataan Desa --}}

    <link rel="stylesheet" href="{{ asset('css/pandes.css') }}">



    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css" />

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/panduan.css') }}"> --}}

    <script src="https://cdn.tailwindcss.com"></script>



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <meta name="google-signin-client_id" content="{{ env('GOOGLE_CLIENT_ID') }}">

    <!-- Icon -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/remix-icon/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pitchtoggle.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    {{--
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />
    --}}



    <!-- MAPBOX -->
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />

    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v1.2.2/mapbox-gl-draw.css" type="text/css">
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    {{--
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" /> --}}


    <!-- custom -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://kenwheeler.github.io/slick/slick/slick-theme.css" />
    {{--
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="datetime" content="{{ date('Y-m-d') }}" />
    <meta name="title" content="Portal Investasi Berbasis Spasial">
    <meta name="description" content="Peta Perizinan dan Investasi oleh DKI Jakarta bekerja sama dengan DPMPTSP DKI Jakarta ">
    <meta name="og:title" content="Portal Investasi Berbasis Spasial">
    <meta name="og:description" content="Peta Perizinan dan Investasi oleh DKI Jakarta bekerja sama dengan DPMPTSP DKI Jakarta ">
    <meta name="twitter:title" content="Portal Investasi Berbasis Spasial">
    <meta name="twitter:description" content="Peta Perizinan dan Investasi oleh DKI Jakarta bekerja sama dengan DPMPTSP DKI Jakarta ">
    {{--
    <meta name="Access-Control-Allow-Headers" value="Content-Type" /> --}}

    <style>
        /* .tes_border{
            border: 1px solid #000;
        } */

    </style>

</head>

@php
$option_simulasi = ['Rumah Mewah', 'Rumah Biasa', 'Apartemen', 'Rumah Susun', 'Asrama', 'Klinik / Puskesmas', 'Rumah
sakit Mewah', 'Rumah Sakit Menengah', 'Rumah Sakit Umum', 'Sekolah Dasar', 'SLTP', 'SLTA', 'Perguruan Tinggi', 'Rumah
Toko / Rumah Kantor', 'Gedung Kantor', 'Toserba (toko serba ada, mall, department store)', 'Pabrik / Industri', 'Stasiun
/ Terminal', 'Bandara Udara *', 'Restoran', 'Gedung Pertunjukan', 'Gedung Bioskop', 'Hotel Melati s/d Bintang 2', 'Hotel
Bintang 3 ke atas', 'Gedung Peribadatan', 'Perpustakaan', 'Bar', 'Perkumpulan Sosial', 'Klab Malam', 'Gedung Pertemuan',
'Laboratorium', 'Pasar Tradisional / Modern', 'Lainnya'];
@endphp

<body>

    {{-- KODE PENDATAAN DESA START --}}

    <div class="h-[100vh] overflow-hidden grid grid-cols-1">
        <div class="w-full h-[100vh] relative">

            <div id="map" class="w-full h-full absolute">
            </div>



            <div class="w-full h-full grid grid-cols-[425px,1fr]">
                <!-- Pertama -->
                <div class="w-full bg-white flex flex-col z-10 h-screen overflow-y-auto overflow-x-hidden scrollbar">

                    <!-- logo -->
                    <div class="w-full h-[14vh] mt-[4.5vh] mb-[2.8vh]">
                        <div class="flex justify-center items-center -ml-[0.7vw]">


                            <img src="{{ asset('assets/wheat.png') }}" alt="" class="w-12 h-12 mr-3">

                            <div class="text-2xl font-semibold">Portal Investasi Desa</div>
                        </div>

                    </div>
                    <!--  -->
                    <div class="w-full px-4">

                        <div class="grid grid-cols-1 gap-y-1 text-sm">

                            <div class="grid grid-cols-[27px,1fr,39px]">
                                <div class=""></div>
                                <div class="">
                                    <div class="w-[20vw]">

                                        <div class="for_web input-group input-group-md mb-1">
                                            <input style="height:1.8rem;" type="search" id="cari_wilayah" class="form-control tombol_search py-2 border-right-0 border" placeholder="Cari nama tempat ..." autocomplete="off">


                                            <!-- Ori -->
                                            <div class="wm-search__dropdown">
                                                <ul class="wm-search__dropdown" role="listbox"></ul>
                                            </div>

                                            <!-- Dummy -->
                                            <ul class="wm-search__dropdown" role="listbox">

                                            </ul>


                                            <span class="input-group-append">
                                                <button style="height:1.8rem;" class="btn btn-secondary tombol_search border-left-0 border flex justify-center items-center" type="button">
                                                    <i class="fa fa-search"></i>
                                                </button>

                                            </span>
                                        </div>


                                    </div>

                                </div>
                                <div class=""></div>
                            </div>


                            {{-- --}}

                            <div class="flex items-center form-check transect_zone mt-1">
                                <div class="inline-flex items-center">
                                    <input type="checkbox" class="h-3.5 w-3.5 form-check-input hapus_focus_checkbox focus:border focus:ring-0 focus:ring-offset-0 text-blue-600 border-gray-300 border rounded-sm" id="urban_fill" onchange="getDataSource('urban', localStorage.getItem('kelurahan'))">

                                    <label class="form-check-label ml-2 mt-1" for="transect_zone">Peta Profitabilitas Desa</label>



                                    <div class="form-check form-check-inline urban_fill mt-1 hidden">
                                        <input type="radio" name="transect_zone" value="tp2021-color2021" class="form-check-input urban_fill w-3 h-3" disabled checked>
                                        <label class="form-check-label ">Tahun 2021</label>
                                    </div>


                                </div>
                            </div>



                        </div>

                        <!-- Section Fertility Map -->
                        <div class="grid grid-cols-1 gap-y-1 text-sm">
                            <div class="flex items-center form-check fertility_map_zone mt-1">
                                <div class="inline-flex items-center">
                                    <input type="checkbox" class="h-3.5 w-3.5 form-check-input hapus_focus_checkbox focus:border focus:ring-0 focus:ring-offset-0 text-blue-600 border-gray-300 border rounded-sm" id="fertility_kesuburan_map" onchange="toggleKesuburan()">


                                    <label class="form-check-label  ml-2 mt-1" for="fertility_kesuburan_map">Peta Kesuburan Lahan</label>

                                    <div class="form-check form-check-inline fertility_map_year mt-1 hidden">
                                        <input type="radio" name="fertility_map_zone" value="year2021-color2021" class="form-check-input fertility_map_year w-3 h-3" disabled checked>
                                        <label class="form-check-label ">Tahun 2021</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--Usia Tanaman  --}}
                        <div class="grid grid-cols-1 gap-y-1 text-sm">
                            <div class="flex items-center form-check fertility_map_zone mt-1">
                                <div class="inline-flex items-center">
                                    <input type="checkbox" class="h-3.5 w-3.5 form-check-input hapus_focus_checkbox focus:border focus:ring-0 focus:ring-offset-0 text-blue-600 border-gray-300 border rounded-sm" id="fertility_map_checkbox" onchange="toggleUsiaTanam()">
                                    <label class="form-check-label ml-2 mt-1" for="fertility_map_checkbox">Peta Usia Tanaman</label>
                                </div>

                            </div>
                        </div>



                        <!-- Section Fertility Map -->
                        <div class="grid grid-cols-1 gap-y-1 text-sm">
                            <div class="flex items-center form-check fertility_map_zone mt-1">
                                <div class="inline-flex items-center">
                                    <input type="checkbox" class="h-3.5 w-3.5 form-check-input hapus_focus_checkbox focus:border focus:ring-0 focus:ring-offset-0 text-blue-600 border-gray-300 border rounded-sm" id="fertility_map" onchange="getDataSource('fertility', localStorage.getItem('kelurahan'))">
                                    <label class="form-check-label  ml-2 mt-1" for="fertility_map">Sumber Air dan Jalur Pengairan</label>

                                    <div class="form-check form-check-inline fertility_map_year mt-1 hidden">
                                        <input type="radio" name="fertility_map_zone" value="year2021-color2021" class="form-check-input fertility_map_year w-3 h-3" disabled checked>
                                        <label class="form-check-label ">Tahun 2021</label>
                                    </div>
                                </div>
                            </div>
                        </div>






                        <!-- Section Zonasi -->
                        <div class="grid grid-cols-1 gap-y-1 text-sm">
                            <div class="flex items-center form-check transect_zone mt-1">
                                <div class="inline-flex items-center">
                                    <input type="checkbox" class="h-3.5 w-3.5 form-check-input hapus_focus_checkbox focus:border focus:ring-0 focus:ring-offset-0 text-blue-600 border-gray-300 border rounded-sm" id="prediksi_curah_hujan_checkbox" onchange="togglePrediksiCurahHujan()">
                                    <label class="form-check-label ml-2 mt-1" for="prediksi_curah_hujan_checkbox">Prediksi Rata-Rata Curah Hujan</label>
                                </div>

                            </div>

                            <div class="flex flex-row ml-[1.8vw] mt-1">

                                <div class="w-full">
                                    <input id="perda-1" type="radio" value="Perda 1/2014" name="jenis-perda" class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:border focus:ring-0 focus:ring-offset-0 bg-white radio_white cursor-pointer" />

                                    <label for="perda-1" class="ms-2 text-sm">30 hari</label>
                                </div>
                                <div class="w-full">
                                    <input id="pergub-31" type="radio" value="Pergub 31/2022" name="jenis-perda" class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:border focus:ring-0 focus:ring-offset-0 bg-white radio_white cursor-pointer" />
                                    <label for="pergub-31" class="ms-2 text-sm">90 hari</label>
                                </div>
                                {{-- --}}
                                <div class="w-full">
                                    <input id="pergub-31" type="radio" value="Pergub 31/2022" name="jenis-perda" class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:border focus:ring-0 focus:ring-offset-0 bg-white radio_white cursor-pointer" />
                                    <label for="pergub-31" class="ms-2 text-sm">180 hari</label>
                                </div>


                                {{-- --}}
                            </div>
                        </div>





                        <!--  -->
                    </div>

                    <!-- Button Grup Menu -->
                    <div class="w-full px-4 mt-[1.2rem] h-full flex flex-col ">
                        <div class="grid grid-cols-4 gap-y-7 py-4 border-b border-t">

                            <!-- Button Pertama -->
                            <div>
                                <div class="flex justify-start items-center relative">

                                    <button style="outline:none !important;" class="h-10 w-10 z-10 flex justify-center items-center border bg-blue-500 border-blue-500 rounded-full outline-none " id="btn-1" data-tooltip-target="tooltip-no-arrow" data-tooltip-placement="bottom">




                                        <svg class="text-white h-[18px]" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-map" viewBox="0 0 16 16">


                                            <path fill-rule="evenodd" d="M15.817.113A.5.5 0 0 1 16 .5v14a.5.5 0 0 1-.402.49l-5 1a.5.5 0 0 1-.196 0L5.5 15.01l-4.902.98A.5.5 0 0 1 0 15.5v-14a.5.5 0 0 1 .402-.49l5-1a.5.5 0 0 1 .196 0L10.5.99l4.902-.98a.5.5 0 0 1 .415.103M10 1.91l-4-.8v12.98l4 .8zm1 12.98 4-.8V1.11l-4 .8zm-6-.8V1.11l-4 .8v12.98z" />
                                        </svg>



                                    </button>

                                    {{-- --}}
                                    <div id="tooltip-no-arrow" role="tooltip" class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-black bg-white border rounded-lg ">
                                        Profil Desa
                                    </div>




                                </div>
                            </div>






                            <!-- Button Ketiga -->
                            <div>
                                <div class="flex justify-start items-center">
                                    <button style="outline:none !important;" class="inline-block h-10 w-10 flex justify-center items-center border border-blue-500 rounded-full" id="btn-3" data-tooltip-target="tooltip-no-arrow-3" data-tooltip-placement="bottom">


                                        <svg class="text-[#007bff] h-[17px]" xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">

                                            <path fill-rule="evenodd" d="M0 0h1v15h15v1H0zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07" />
                                        </svg>

                                    </button>
                                    <div id="tooltip-no-arrow-3" role="tooltip" class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-black bg-white border rounded-lg ">
                                        Pasar Induk
                                    </div>

                                </div>
                            </div>

                            <!-- Button Ketujuh -->
                            <div>
                                <div class="flex justify-start items-center">
                                    <button style="outline:none !important;" class="inline-block h-10 w-10 flex justify-center items-center border border-blue-500 rounded-full" id="btn-7" data-tooltip-target="tooltip-no-arrow-7" data-tooltip-placement="bottom">



                                        <svg class="text-[#007bff] h-[19px]" xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">

                                            <path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                                            <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3z" />
                                        </svg>



                                    </button>
                                    <div id="tooltip-no-arrow-7" role="tooltip" class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-black bg-white border rounded-lg ">
                                        Patokan Harga
                                    </div>

                                </div>
                            </div>

                            <!-- Button Keempat -->
                            <div>
                                <div class="flex justify-start items-center">
                                    <button style="outline:none !important;" class="inline-block h-10 w-10 flex justify-center items-center border border-blue-500 rounded-full" id="btn-4" data-tooltip-target="tooltip-no-arrow-4" data-tooltip-placement="bottom">


                                        <img src="{{ asset('assets/neww/saldo-off.png') }}" alt="" class="w-[1.4rem] h-[1.4rem] ml-0.5 object-contain">


                                    </button>
                                    <div id="tooltip-no-arrow-4" role="tooltip" class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-black bg-white border rounded-lg ">
                                        Saldo Lumbung
                                    </div>
                                </div>
                            </div>


                            <!-- Button Kedua -->
                            <div>
                                <div class="flex justify-start items-center">
                                    <button style="outline:none !important;" class="inline-block h-10 w-10 flex justify-center items-center border border-blue-500 rounded-full" id="btn-2" data-tooltip-target="tooltip-no-arrow-2" data-tooltip-placement="bottom">




                                        <svg class="text-[#007bff] h-[21px]" xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-cloud-drizzle" viewBox="0 0 16 16">
                                            <path d="M4.158 12.025a.5.5 0 0 1 .316.633l-.5 1.5a.5.5 0 0 1-.948-.316l.5-1.5a.5.5 0 0 1 .632-.317m6 0a.5.5 0 0 1 .316.633l-.5 1.5a.5.5 0 0 1-.948-.316l.5-1.5a.5.5 0 0 1 .632-.317m-3.5 1.5a.5.5 0 0 1 .316.633l-.5 1.5a.5.5 0 0 1-.948-.316l.5-1.5a.5.5 0 0 1 .632-.317m6 0a.5.5 0 0 1 .316.633l-.5 1.5a.5.5 0 1 1-.948-.316l.5-1.5a.5.5 0 0 1 .632-.317m.747-8.498a5.001 5.001 0 0 0-9.499-1.004A3.5 3.5 0 1 0 3.5 11H13a3 3 0 0 0 .405-5.973M8.5 2a4 4 0 0 1 3.976 3.555.5.5 0 0 0 .5.445H13a2 2 0 0 1 0 4H3.5a2.5 2.5 0 1 1 .605-4.926.5.5 0 0 0 .596-.329A4 4 0 0 1 8.5 2" />
                                        </svg>


                                    </button>

                                    {{-- --}}
                                    <div id="tooltip-no-arrow-2" role="tooltip" class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-black bg-white border rounded-lg ">
                                        Prakiraan Cuaca
                                    </div>


                                </div>
                            </div>

                            {{-- BUtton Kelima --}}

                            <div>
                                <div class="flex justify-start items-center">
                                    <button style="outline:none !important;" class="inline-block h-10 w-10 flex justify-center items-center border border-blue-500 rounded-full" id="btn-5" data-tooltip-target="tooltip-no-arrow-5" data-tooltip-placement="bottom">


                                        <svg class="text-[#007bff] h-[27px]" xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-flower3" viewBox="0 0 16 16">

                                            <path d="M11.424 8c.437-.052.811-.136 1.04-.268a2 2 0 0 0-2-3.464c-.229.132-.489.414-.752.767C9.886 4.63 10 4.264 10 4a2 2 0 1 0-4 0c0 .264.114.63.288 1.035-.263-.353-.523-.635-.752-.767a2 2 0 0 0-2 3.464c.229.132.603.216 1.04.268-.437.052-.811.136-1.04.268a2 2 0 1 0 2 3.464c.229-.132.489-.414.752-.767C6.114 11.37 6 11.736 6 12a2 2 0 1 0 4 0c0-.264-.114-.63-.288-1.035.263.353.523.635.752.767a2 2 0 1 0 2-3.464c-.229-.132-.603-.216-1.04-.268M9 4a2 2 0 0 1-.045.205q-.059.2-.183.484a13 13 0 0 1-.637 1.223L8 6.142l-.135-.23a13 13 0 0 1-.637-1.223 4 4 0 0 1-.183-.484A2 2 0 0 1 7 4a1 1 0 1 1 2 0M3.67 5.5a1 1 0 0 1 1.366-.366 2 2 0 0 1 .156.142q.142.15.326.4c.245.333.502.747.742 1.163l.13.232-.265.002a13 13 0 0 1-1.379-.06 4 4 0 0 1-.51-.083 2 2 0 0 1-.2-.064A1 1 0 0 1 3.67 5.5m1.366 5.366a1 1 0 0 1-1-1.732l.047-.02q.055-.02.153-.044.202-.048.51-.083a13 13 0 0 1 1.379-.06q.135 0 .266.002l-.131.232c-.24.416-.497.83-.742 1.163a4 4 0 0 1-.327.4 2 2 0 0 1-.155.142M9 12a1 1 0 0 1-2 0 2 2 0 0 1 .045-.206q.058-.198.183-.483c.166-.378.396-.808.637-1.223L8 9.858l.135.23c.241.415.47.845.637 1.223q.124.285.183.484A1.3 1.3 0 0 1 9 12m3.33-6.5a1 1 0 0 1-.366 1.366 2 2 0 0 1-.2.064q-.202.048-.51.083c-.412.045-.898.061-1.379.06q-.135 0-.266-.002l.131-.232c.24-.416.497-.83.742-1.163a4 4 0 0 1 .327-.4q.07-.074.114-.11l.041-.032a1 1 0 0 1 1.366.366m-1.366 5.366a2 2 0 0 1-.155-.141 4 4 0 0 1-.327-.4A13 13 0 0 1 9.74 9.16l-.13-.232.265-.002c.48-.001.967.015 1.379.06q.308.035.51.083.098.024.153.044l.048.02a1 1 0 1 1-1 1.732zM8 9a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                                        </svg>

                                    </button>

                                    {{-- --}}
                                    <div id="tooltip-no-arrow-5" role="tooltip" class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-black bg-white border rounded-lg ">
                                        Persediaan Pupuk
                                    </div>


                                </div>
                            </div>
                            {{-- BUtton kedelepan --}}

                            <div>
                                <div class="flex justify-start items-center">
                                    <button style="outline:none !important;" class="inline-block h-10 w-10 flex justify-center items-center border border-blue-500 rounded-full" id="btn-8" data-tooltip-target="tooltip-no-arrow-8" data-tooltip-placement="bottom">


                                        <img src="{{ asset('assets/neww/pen-off.png') }}" alt="" class="w-[1.4rem] h-[1.4rem] object-contain">



                                    </button>

                                    {{-- --}}
                                    <div id="tooltip-no-arrow-8" role="tooltip" class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-black bg-white border rounded-lg ">
                                        Informasi Persil
                                    </div>


                                </div>
                            </div>

                            {{-- Button Keenam --}}
                            <div>
                                <div class="flex justify-start items-center">
                                    <button style="outline:none !important;" class="inline-block h-10 w-10 flex justify-center items-center border border-blue-500 rounded-full" id="btn-6" data-tooltip-target="tooltip-no-arrow-6" data-tooltip-placement="bottom">

                                        <img src="{{ asset('assets/neww/rp-off.png') }}" alt="" class="w-[1.1rem] h-[1.1rem] ml-0.5 mt-0.5 object-contain">


                                    </button>

                                    {{-- --}}
                                    <div id="tooltip-no-arrow-6" role="tooltip" class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-black bg-white border rounded-lg ">
                                        Finansial
                                    </div>


                                </div>
                            </div>








                        </div>
                        <!-- konten -->

                        <div id="default-tab-content">
                            <!-- Konten Pertama -->
                            <div class="hidden text-sm pb-2" id="content-1">

                                <div class="w-full h-full">

                                    <h5 class="mt-4 mb-3.5 font-bold text-md text-center">Lokasi</h5>


                                    {{-- byeeeee --}}

                                    <div class="w-full flex flex-col text-sm text-black">

                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Luas</div>
                                            <div>3.792.700 m<sup>2</sup></div>
                                        </div>

                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Kelurahan</div>
                                            <div>Cimeuhmal</div>
                                        </div>

                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Kategori IDM</div>
                                            <div>Desa Mandiri</div>
                                        </div>

                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Kecamatan</div>
                                            <div>Tanjungsiang</div>
                                        </div>

                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Kabupaten</div>
                                            <div>Subang</div>
                                        </div>

                                    </div>




                                    <h5 class="mt-4 mb-3.5 font-bold text-md text-center">Usaha Pertanian</h5>



                                    <div class="w-full flex flex-col text-sm text-black">



                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Luas Lahan</div>
                                            <div>500.000 m<sup>2</sup></div>
                                        </div>

                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Jumlah Pemilik Lahan</div>
                                            <div>10</div>
                                        </div>

                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Jumlah Penyewa Lahan</div>
                                            <div>300</div>
                                        </div>
                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Jumlah Petani Penggarap</div>
                                            <div>300</div>
                                        </div>
                                    </div>



                                    <h5 class="mt-4 font-bold text-md text-center">Distribusi Komoditi Tanam</h5>
                                    <div class="w-full flex justify-center">
                                        <div style="width:58%;">
                                            <canvas class="mt-2" id="produksiPertanian" width="100" height="100"></canvas>
                                        </div>
                                    </div>

                                    <h5 class="mt-4 font-bold text-md text-center">Distribusi Pembiayaan</h5>
                                    <div class="w-full flex justify-center">
                                        <div style="width:60%;">
                                            <canvas class="mt-2" id="distribusiPembiayaan" width="100" height="100"></canvas>

                                        </div>
                                    </div>

                                    <h5 class="mt-4 font-bold text-md text-center">Distribusi Usia</h5>
                                    <div class="w-full flex justify-center">
                                        <div id="container" style="width: 100%;">
                                            <canvas id="canvas1"></canvas>
                                        </div>
                                    </div>

                                    <h5 class="mt-4 font-bold text-md text-center">Hasil Panen</h5>
                                    <div class="mt-2">
                                        <canvas width="700" height="330" id="myChart2"></canvas>
                                    </div>






                                    {{-- jarak ke bawah --}}
                                    {{-- --}}
                                    <div class="pb-2"></div>




                                    {{-- --}}



                                </div>
                            </div>
                            <!-- Konten Kedua -->
                            <div class="hidden text-sm pb-2" id="content-2">




                                <div class="w-full h-[40vh] flex flex-col">

                                    <h5 class="font-bold text-md text-center mt-4">Prakiraan Cuaca</h5>


                                    <div class="text-xs text-black flex justify-center mt-3 mb-2">Periode 19 - 26 Maret 2024</div>


                                    <img src="{{ asset('assets/perkiraan_cuaca.png') }}" alt="" class="w-full object-contain">

                                </div>

                            </div>

                            <!-- Konten Ketujuh -->
                            <div class="hidden text-sm pb-[10rem]" id="content-7">
                                <div class="w-full h-[50vh] flex flex-col">

                                    <h5 class="font-bold text-md text-center mt-4">Riwayat Harga</h5>


                                    <div class="mt-2">
                                        <canvas width="700" height="450" id="myChart4"></canvas>
                                    </div>




                                    <div class="mt-3">
                                        <div class="w-full text-xs text-black flex flex-col ">
                                            <div class="w-full flex justify-center">Pembaruan Terakhir</div>
                                            <div class="w-full flex justify-center">Tanggal 19 Maret 2024</div>
                                        </div>
                                    </div>


                                    <div class="grid grid-cols-1 mt-3">
                                        <div class="col-span-1 font-semibold">Badan Pangan Nasional</div>
                                        <div class="grid grid-cols-[1fr,1fr,100px]">
                                            <div class="">Beras Cianjur Kepala</div>
                                            <div class=" text-right">Rp 19.825</div>
                                        </div>
                                        <div class="grid grid-cols-[1fr,1fr,100px]">
                                            <div class="">Beras Cianjur Slyp</div>

                                            <div class=" text-right">Rp 18.333</div>
                                        </div>
                                        <div class="grid grid-cols-[1fr,1fr,100px]">
                                            <div class="">Beras Setra</div>
                                            <div class=" text-right">Rp 16.786</div>
                                        </div>
                                        {{-- --}}
                                        <div class="grid grid-cols-[1fr,1fr,100px]">
                                            <div class="">Beras Saigon</div>
                                            <div class=" text-right">Rp 16.070</div>
                                        </div>
                                        {{-- --}}
                                        <div class="grid grid-cols-[1fr,1fr,100px]">
                                            <div class="">Beras Muncul 1</div>
                                            <div class=" text-right">Rp 15.900</div>
                                        </div>
                                        {{-- --}}
                                        <div class="grid grid-cols-[1fr,1fr,100px]">
                                            <div class="">Beras Muncul 2</div>
                                            <div class=" text-right">Rp 15.333</div>
                                        </div>
                                        {{-- --}}
                                        <div class="grid grid-cols-[1fr,1fr,100px]">
                                            <div class="">Beras Muncul 3</div>
                                            <div class=" text-right">Rp 14.500</div>

                                        </div>

                                    </div>


                                    {{-- jarak ke bawah --}}
                                    {{-- --}}
                                    <div class="pb-4"></div>



                                </div>
                            </div>

                            <!-- Konten Kedelapan -->
                            <div class="hidden text-sm pb-[10rem]" id="content-8">
                                <div class="w-full h-[50vh] flex flex-col">

                                    <h5 class="mt-4 mb-3.5 font-bold text-md text-center">Informasi Persil</h5>


                                    {{-- byeeeee --}}

                                    <div class="w-full flex flex-col text-sm text-black informasi_persil">

                                        {{-- new1 --}}

                                        <div class="grid grid-cols-1 justify-items-center mt-2">
                                            <div class="w-full flex flex-row justify-center items-center">
                                                <div class="h-full flex items-center">
                                                    <div id="prev-wrapper" class="border border-red-500 rounded-full">
                                                        <img id="prev-informasi-persil" src="/assets/neww/left-off.png" alt="" class="w-5 h-5 object-contain cursor-pointer">
                                                    </div>
                                                </div>
                                                <div class="mx-2 mt-[0.1rem]" id="tgl-update-persil">19 Maret 2024</div>
                                                <div class="h-full flex items-center">
                                                    <div id="next-wrapper" class="rounded-full">
                                                        <img id="next-informasi-persil" src="/assets/neww/right-on.png" alt="" class="w-5 h-5 object-contain cursor-pointer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div id="informasi_persil_komoditi" class="flex flex-col">
                                            <div class="grid grid-cols-1 justify-items-center mt-2.5 mb-2">
                                                <div id="gambar_persil">
                                                    <img src="" alt="" class="w-[24vw] h-[24vh]">
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2 mt-2">
                                                <div id="catatan_persil">Catatan</div>
                                                <div id="catatan_isi"></div>
                                            </div>
                                        </div>





                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Luas</div>


                                            <div>3.000 m<sup>2</sup></div>

                                        </div>

                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Kesuburan Tanah</div>

                                            <div class="grid grid-cols-1">
                                                <div class="grid grid-cols-2">
                                                    <div class="grid grid-cols-[25px,1fr]">
                                                        <div>pH</div>
                                                        <div>6.3</div>
                                                    </div>
                                                    <div class="grid grid-cols-[25px,1fr]">
                                                        <div>P</div>
                                                        <div>120 ppm</div>
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-2">
                                                    <div class="grid grid-cols-[25px,1fr]">
                                                        <div>K</div>
                                                        <div>200 ppm</div>
                                                    </div>
                                                    <div class="grid grid-cols-[25px,1fr]">
                                                        <div>Mg</div>
                                                        <div>120 ppm</div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="grid grid-cols-2 mt-4">
                                            <div class="">Periode Tanam</div>
                                            <div>1 / 2024</div>
                                        </div>
                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Pemilik Lahan</div>
                                            <div>Asep Komarudi</div>
                                        </div>

                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Status Lahan</div>

                                            <div>Hak Milik</div>

                                        </div>

                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Penyewa Lahan</div>
                                            <div>Budi</div>
                                        </div>

                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Jumlah Penggarap</div>
                                            <div>6</div>
                                        </div>


                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Modal Kerja</div>
                                            <div>Rp 7.000.000</div>
                                        </div>
                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Valuasi</div>
                                            <div>Rp 50.000.000</div>

                                        </div>


                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Sumber Pembiayaan</div>
                                            <div>Modal Sendiri</div>
                                        </div>



                                        <div class="grid grid-cols-2 mt-4">
                                            <div class="">Komoditi Tanam</div>
                                            <div>Beras Cianjur</div>
                                        </div>
                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Periode Tanam</div>
                                            <div>1 Maret - 30 Juni 2024</div>
                                        </div>
                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">
                                                Tahap Tanam</div>
                                            <div class="flex flex-col">
                                                <div class="inline-flex items-center">
                                                    <img src=/assets/check.png alt="" class="w-3 h-3 object-contain mr-2.5">
                                                    Pembajakan</div>
                                                <div class="inline-flex items-center">
                                                    <img src=/assets/check.png alt="" class="w-3 h-3 object-contain mr-2.5">
                                                    Pembenihan</div>
                                                <div class="inline-flex items-center">
                                                    <img src=/assets/check.png alt="" class="w-3 h-3 object-contain mr-2.5">
                                                    Pemupukan I</div>

                                                <div class="ml-[1.4rem]">Pemupukan II</div>
                                                <div class="ml-[1.4rem]">Pemupukan III</div>


                                            </div>

                                        </div>
                                        <div class="grid grid-cols-2 mt-2 mb-2">
                                            <div class="">Perkiraan Panen</div>
                                            <div>70 ton</div>
                                        </div>

                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Realisasi Panen</div>
                                            <div>&nbsp;</div>
                                        </div>




                                    </div>

                                    {{-- jarak ke bawah --}}
                                    {{-- --}}
                                    <div class="pb-3"></div>



                                </div>
                            </div>
                        </div>



                        <!-- Konten Ketiga -->
                        <div class="hidden text-sm pb-2" id="content-3">


                            <div class="w-full h-[50vh] flex flex-col">

                                <h5 class="font-bold text-md text-center mt-4">Pasar Induk</h5>



                                <div class="flex flex-col mt-[1.5rem] relative">
                                    <div class="relative flex flex-col">
                                        <div class="px-0 w-full relative mt-[1.5rem]">

                                            <div class="font-semibold absolute -top-8">Radius</div>



                                            <input type="range" id="slider-pindes" class="w-full opacity-0" style="z-index: 20; height: 2rem; cursor: pointer;" min="0" max="4" step="1">
                                            <div class="bg-gray-300 h-2 w-full rounded-full relative mt-[-2rem]">
                                                <span id="thumb" class="bg-white h-4 w-4 absolute top-0 -ml-1 -mt-1 z-10 border rounded-full cursor-pointer"></span>
                                                <span id="progress" class="bg-blue-500 h-2 absolute left-0 top-0 rounded-full" style="width:0 km;"></span>
                                            </div>
                                            <div class="flex justify-between mt-2.5 text-xs text-black">
                                                <span class="clickable w-10 text-left" data-value="0">0 km</span>
                                                <span class="clickable w-10 text-center" data-value="1">25 km</span>
                                                <span class="clickable w-10 text-center" data-value="2">50 km</span>
                                                <span class="clickable w-10 text-center" data-value="3">75 km</span>
                                                <span class="clickable w-12 text-right" data-value="4">100 km</span>
                                            </div>
                                        </div>

                                        {{-- --}}
                                        <div class="relative flex justify-center">
                                            <div class="absolute -bottom-[3.5rem] text-xs text-black flex flex-col ">
                                                <div class="w-full flex justify-center">Pembaruan Terakhir</div>
                                                <div class="w-full flex justify-center">Tanggal 19 Maret 2024</div>
                                            </div>
                                        </div>




                                        {{-- --}}
                                    </div>
                                </div>



                                {{-- --}}
                                <div class="grid grid-cols-1 mt-[5rem] radius1">

                                    <h5 class="mt-2 mb-1 font-bold text-md text-left">Pasar Induk Terminal Kota Subang</h5>

                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Cianjur Kepala</div>
                                        <div class=" text-right">Rp 19.825</div>
                                    </div>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Cianjur Slyp</div>
                                        <div class=" text-right">Rp 18.333</div>
                                    </div>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Setra</div>
                                        <div class=" text-right">Rp 16.786</div>
                                    </div>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Saigon</div>
                                        <div class=" text-right">Rp 16.070</div>
                                    </div>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Muncul 1</div>
                                        <div class=" text-right">Rp 15.900</div>
                                    </div>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Muncul 2</div>
                                        <div class=" text-right">Rp 15.333</div>
                                    </div>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Muncul 3</div>
                                        <div class=" text-right">Rp 14.500</div>
                                    </div>


                                    {{-- --}}
                                </div>

                                <div class="grid grid-cols-1 mt-3 radius2">
                                    <h5 class="mt-1 mb-1 font-bold text-md text-left">Pasar Induk Johar Karawang</h5>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Cianjur Kepala</div>
                                        <div class="text-right">Rp 19.825</div>
                                    </div>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Cianjur Slyp</div>
                                        <div class="text-right">Rp 18.333</div>
                                    </div>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Setra</div>
                                        <div class="text-right">Rp 16.786</div>
                                    </div>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Saigon</div>
                                        <div class="text-right">Rp 16.070</div>
                                    </div>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Muncul 1</div>
                                        <div class="text-right">Rp 15.900</div>
                                    </div>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Muncul 2</div>
                                        <div class="text-right">Rp 15.333</div>
                                    </div>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Muncul 3</div>
                                        <div class="text-right">Rp 14.500</div>
                                    </div>
                                </div>


                                <div class="grid grid-cols-1 mt-3 radius3">
                                    <h5 class="mt-1 mb-1 font-bold text-md text-left">Pasar Induk Cianjur</h5>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Cianjur Kepala</div>
                                        <div class="text-right">Rp 19.825</div>
                                    </div>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Cianjur Slyp</div>
                                        <div class="text-right">Rp 18.333</div>
                                    </div>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Setra</div>
                                        <div class="text-right">Rp 16.786</div>
                                    </div>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Saigon</div>
                                        <div class="text-right">Rp 16.070</div>
                                    </div>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Muncul 1</div>
                                        <div class="text-right">Rp 15.900</div>
                                    </div>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Muncul 2</div>
                                        <div class="text-right">Rp 15.333</div>
                                    </div>
                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Beras Muncul 3</div>
                                        <div class="text-right">Rp 14.500</div>
                                    </div>
                                </div>

                                {{-- jarak ke bawah --}}
                                {{-- --}}
                                <div class="pb-6"></div>


                            </div>



                        </div>

                        <!-- Konten Keempat -->
                        <div class="hidden text-sm pb-2" id="content-4">


                            <div class="h-[41vh] flex flex-col ">

                                <h5 class="mt-4 font-bold text-md text-center">Saldo Lumbung</h5>
                                <div class="mt-2">
                                    <canvas width="500" height="330" id="myChart3"></canvas>
                                </div>

                            </div>











                        </div>

                        <!-- Konten Kelima -->
                        <div class="hidden text-sm pb-2" id="content-5">

                            <div class="h-[35vh] flex flex-col">

                                <h5 class="font-bold text-md text-center mt-4">Persediaan Pupuk</h5>


                                <div class="mt-3">
                                    <div class="w-full text-xs text-black flex flex-col ">
                                        <div class="w-full flex justify-center">Pembaruan Terakhir</div>
                                        <div class="w-full flex justify-center">Tanggal 19 Maret 2024</div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 mt-3">

                                    <div class="grid grid-cols-[1fr,100px,100px] text-md mt-2 mb-1">
                                        <div class="w-full grid grid-cols-1">
                                            <div class="">&nbsp;</div>
                                            <div class="mt-1">Pupuk Urea</div>
                                            <div class="">Pupuk NPK</div>
                                            <div class="">Pupuk NPK Khusus</div>
                                        </div>

                                        <div class="w-full grid grid-cols-1 place-items-center">
                                            <div class="font-semibold">Alokasi (kg)</div>
                                            <div class="mt-1">100</div>
                                            <div class="">200</div>
                                            <div class="">150</div>
                                        </div>
                                        <div class="w-full grid grid-cols-1 place-items-center">
                                            <div class="font-semibold">Terpakai (kg)</div>
                                            <div class="mt-1">20</div>
                                            <div class="">70</div>
                                            <div class="">50</div>


                                        </div>

                                    </div>

                                    {{-- --}}
                                </div>


                                {{-- jarak ke bawah --}}
                                {{-- --}}
                                {{-- <div class="pb-1"></div> --}}



                            </div>
                        </div>


                        <!-- Konten Keenam -->
                        <div class="hidden text-sm pb-2" id="content-6">

                            <div class="h-[80vh] flex flex-col">
                                {{-- --}}
                                {{-- --}}

                                <div class="w-full grid grid-cols-1 mt-4">
                                    <div class="flex justify-center">
                                        <h5 class="font-bold text-sm text-center ">Finansial</h5>
                                    </div>
                                </div>
                                {{-- --}}
                                <div class="w-full grid grid-cols-1 mt-2 mb-3">
                                    <div class="flex justify-end">
                                        <a target="_blank" href="{{ asset('pdf_file/Laporan_Keuangan.pdf') }}"></i>

                                            <button type="button" style="outline:none !important;" class="text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-0 focus:ring-blue-300 font-medium rounded-lg text-xs px-2.5 py-0.5 text-center">

                                                Cetak
                                            </button>
                                        </a>


                                    </div>

                                </div>


                                <div class="w-full grid grid-rows-2">
                                    <div class="w-full">
                                        <input id="radio_1" type="radio" value="radio_1" name="radio_group" class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:border focus:ring-0 focus:ring-offset-0 bg-white radio_white cursor-pointer" />
                                        <label for="radio_1" class="ms-2 text-sm">Proyeksi 1x panen luas lahan 3.000 m²</label>
                                    </div>

                                    <div class="w-full">
                                        <input id="radio_2" type="radio" value="radio_2" name="radio_group" class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:border focus:ring-0 focus:ring-offset-0 bg-white radio_white cursor-pointer" />
                                        <label for="radio_2" class="ms-2 text-sm">Asumsi 1x panen luas lahan 10.000 m²</label>
                                    </div>
                                </div>


                                {{-- panen1 --}}
                                <div id="konten_radio_1" class="w-full">


                                    <div class="w-full grid grid-cols-[200px,50px,120px]">

                                        <div class="col-span-3 w-full flex justify-beetwen mb-3">
                                            <div class="w-full grid grid-cols-[1fr,1fr] mt-3">



                                                <div class="w-full flex justify-start items-center cursor-pointer">
                                                    <span class="">Komoditi</span>
                                                </div>

                                                <div class="relative inline-block text-left flex justify-end">
                                                    <button id="xdropdown-button-pencarian2" class="inline-flex justify-between items-center pl-1 w-[9.5rem] h-[1.8rem] text-sm font-medium text-black bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-0">
                                                        <span id="xselected-item" class="pl-2">Padi Sawah</span>
                                                        <svg id="xarrow-icon-pencarian2" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 transition-transform duration-200 transform" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </button>
                                                    <div id="xdropdown-menu-pencarian2" class="hidden origin-top-right absolute !mt-[2rem] w-[9.5rem] rounded-md bg-white ring-1 ring-black ring-opacity-5 z-10">

                                                        <div class="py-2 p-2" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button-pencarian2">
                                                            <a id="xitem-padi-sawah" class="flex block rounded-md px-1 py-1 text-sm text-black hover:bg-gray-100 active:bg-blue-100 cursor-pointer" role="menuitem">
                                                                Padi Sawah
                                                            </a>
                                                            <a id="xitem-padi-ladang" class="flex block rounded-md px-1 py-1 text-sm text-black hover:bg-gray-100 active:bg-blue-100 cursor-pointer" role="menuitem">
                                                                Padi Ladang
                                                            </a>
                                                            <a id="xitem-jagung" class="flex block rounded-md px-1 py-1 text-sm text-black hover:bg-gray-100 active:bg-blue-100 cursor-pointer" role="menuitem">
                                                                Jagung
                                                            </a>
                                                            <a id="xitem-kedelai" class="flex block rounded-md px-1 py-1 text-sm text-black hover:bg-gray-100 active:bg-blue-100 cursor-pointer" role="menuitem">
                                                                Kedelai
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>

                                        </div>


                                        <div class="w-full col-span-3 flex flex-col mb-[1rem]">
                                            {{-- --}}
                                            <div class="grid grid-cols-[205px,164px] ">
                                                <div class=" h-[3.5vh] w-full  flex justify-center items-center font-semibold">&nbsp;</div>

                                                <div class="h-[3.5vh] grid grid-col">

                                                    <div class="flex flex-row">
                                                        <div class="basis-7/12 flex justify-center items-center font-semibold text-center text-xs">x Rp 1.000</div>
                                                        <div class="basis-5/12 flex items-center font-semibold relative">
                                                            <span class="absolute right-5 text-xs">%</span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- --}}
                                            <div class="grid grid-cols-[205px,164px]">

                                                {{-- Produksi a --}}
                                                <div class="w-full flex flex-col">
                                                    <div class="font-semibold">Produksi (A)</div>
                                                </div>

                                                {{-- Produksi a --}}

                                                <div class="flex flex-row">
                                                    <div id="xtotal_a" class="font-semibold flex justify-end basis-7/12">18.514.840</div>

                                                    <div id="xtotal_b" id="x" class="font-semibold flex justify-end basis-5/12">100</div>

                                                </div>

                                                {{-- Produksi a --}}

                                                <div class="w-full flex flex-col">
                                                    <div class="">Utama</div>
                                                </div>

                                                {{-- Produksi a --}}

                                                <div class="flex flex-row">
                                                    <div id="xutama_a" class=" flex justify-end basis-7/12">18.437.650


                                                    </div>

                                                    <div id="xutama_b" class=" flex justify-end basis-5/12">99,58</div>



                                                </div>


                                                {{-- Produksi a --}}

                                                <div class="w-full flex flex-col">
                                                    <div>Ikutan</div>
                                                </div>

                                                {{-- Produksi a --}}

                                                <div class="flex flex-row">
                                                    <div id="xikutan_a" class=" flex justify-end basis-7/12">
                                                        77.190



                                                    </div>

                                                    <div id="xikutan_b" class=" flex justify-end basis-5/12">
                                                        0,42</div>



                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div class="font-semibold">Ongkos Produksi (B)</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}

                                                <div class="flex flex-row">
                                                    <div id="xongkos_produksi_a" class="font-semibold flex justify-end basis-7/12">
                                                        1.355.930
                                                    </div>

                                                    <div id="xongkos_produksi_b" class="font-semibold  flex justify-end basis-5/12">100 </div>



                                                </div>


                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Benih</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="xbenih_a" class=" flex justify-end basis-7/12">
                                                        514.360
                                                    </div>
                                                    <div id="xbenih_b" class=" flex justify-end basis-5/12">
                                                        3,79</div>


                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Pupuk</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="xpupuk_a" class=" flex justify-end basis-7/12">
                                                        1.278.000
                                                    </div>
                                                    <div id="xpupuk_b" class=" flex justify-end basis-5/12">9,43</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Pestisida</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="xpestisida_a" class=" flex justify-end basis-7/12">569.550

                                                    </div>
                                                    <div id="xpestisida_b" class=" flex justify-end basis-5/12">4,20</div>


                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Tenaga kerja dan jasa pertanian</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="xtenagakerja_a" class=" flex justify-end basis-7/12">
                                                        6.615.190
                                                    </div>
                                                    <div id="xtenagakerja_b" class=" flex justify-end basis-5/12">48,79</div>


                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>a. Tenaga kerja dibayar</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="xtenagabayar_a" class=" flex justify-end basis-7/12">2.282.090




                                                    </div>
                                                    <div id="xtenagabayar_b" class=" flex justify-end basis-5/12">16,83</div>



                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>b. Tenaga kerja tidak dibayar</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="xtenagatidakdibayar_a" class=" flex justify-end basis-7/12">
                                                        1.946.970

                                                    </div>
                                                    <div id="xtenagatidakdibayar_b" class=" flex justify-end basis-5/12">14,36</div>


                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>c. Jasa pertanian</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="xjasapertanian_a" class=" flex justify-end basis-7/12">
                                                        2.386.130



                                                    </div>
                                                    <div id="xjasapertanian_b" class=" flex justify-end basis-5/12">17,60</div>


                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Sewa lahan</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="xsewalahan_a" class=" flex justify-end basis-7/12">
                                                        3.472.360



                                                    </div>
                                                    <div id="xsewalahan_b" class=" flex justify-end basis-5/12">25,61</div>


                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>PBB</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="xpbb_a" class=" flex justify-end basis-7/12">80.100



                                                    </div>
                                                    <div id="xpbb_b" class=" flex justify-end basis-5/12">0,59</div>


                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Bunga pinjaman </div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="xbunga_a" class=" flex justify-end basis-7/12">35.480



                                                    </div>
                                                    <div id="xbunga_b" class=" flex justify-end basis-5/12">0,26</div>


                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Premi asuransi</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="xpremi_a" class=" flex justify-end basis-7/12">1.770


                                                    </div>
                                                    <div id="xpremi_b" class=" flex justify-end basis-5/12">0,01</div>


                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Sewa alat</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="xsewa_a" class=" flex justify-end basis-7/12">398.810</div>



                                                    <div id="xsewa_b" class=" flex justify-end basis-5/12">2,94</div>


                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Penyusutan</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="xpenyusutan_a" class=" flex justify-end basis-7/12">
                                                        211.390



                                                    </div>
                                                    <div id="xpenyusutan_b" class=" flex justify-end basis-5/12">1,56</div>


                                                </div>


                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Lainnya</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="xlainnya_a" class=" flex justify-end basis-7/12">176.090


                                                    </div>
                                                    <div id="xlainnya_b" class=" flex justify-end basis-5/12">1,30</div>


                                                </div>


                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div class="font-semibold">Pendapatan (C)</div>

                                                </div>

                                                {{-- Ongkos Produksi --}}

                                                <div class="flex flex-row">
                                                    <div id="xpendapatan_a" class="font-semibold flex justify-end basis-7/12">4.955.540





                                                    </div>

                                                    <div id="xpendapatan_b" class="font-semibold  flex justify-end basis-5/12">0,37 </div>



                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div class="font-semibold">Rasio C/B</div>


                                                </div>

                                                {{-- Ongkos Produksi --}}

                                                <div class="flex flex-row">
                                                    <div id="xrasio_a" class="font-semibold flex justify-end basis-7/12">0,370




                                                    </div>


                                                    <div id="x" class="font-semibold  flex justify-end basis-5/12">&nbsp; </div>

                                                </div>



                                                {{-- --}}
                                                {{-- --}}
                                                {{-- --}}

                                            </div>



                                        </div>

                                        <div class="w-full col-span-3 font-bold text-sm text-center mb-3">Asumsi</div>


                                        <div class="w-full text-sm flex flex-col ">
                                            {{-- <div class="h-[4.2vh] mb-1 ">&nbsp;</div> --}}
                                            {{-- <div class="mb-1 font-bold flex justify-center">Koefisien</div> --}}
                                            <div class="mb-1">Growth rate</div>
                                            <div class="mb-1">WACC</div>
                                            <div class="mb-1">
                                                Operating profitability</div>

                                            <div class="mb-1">
                                                Capital requirement</div>

                                            <div class="mb-1">Capital</div>
                                            <div class="mb-1">NOWC</div>
                                            <div class="mb-1">Net Operating Capital</div>
                                            <div class="mb-1">Sales</div>
                                            <div class="mb-1">Net Operating Income</div>
                                            <div class="mb-1">Valuasi (Metode DCF)</div>
                                            <div class="mb-1">ROIC</div>
                                            <div class="mb-1">
                                                Economic Value Added</div>
                                        </div>


                                        <div class="w-full">&nbsp;</div>

                                        <div class="w-full flex flex-col ">


                                            {{-- <div class="flex flex-row justify-end text-sm mb-1 font-bold flex justify-center">Nilai</div> --}}


                                            <div class="flex justify-end text-sm mb-1" id="xdistribusi_g">4%</div>


                                            <div class="flex justify-end text-sm mb-1" id="xdistribusi_wacc">10,00%</div>


                                            <div class="flex justify-end text-sm mb-1" id="xdistribusi_op">56,04%</div>


                                            <div class="flex justify-end text-sm mb-1" id="xdistribusi_cr">18,44%</div>



                                            <div class="text-sm mb-1 flex flex-row justify-between">
                                                <div class="">Rp</div>
                                                <div id="xdistribusi_capital">500.000.000</div>
                                            </div>



                                            <div class="text-sm mb-1 flex flex-row justify-between">
                                                <div class="">Rp</div>
                                                <div id="xdistribusi_nowc">100.000.000</div>

                                            </div>
                                            <div class="text-sm mb-1 flex flex-row justify-between">
                                                <div class="">Rp</div>
                                                <div id="xdistribusi_netOpCap">200.000.000</div>


                                            </div>
                                            <div class="text-sm mb-1 flex flex-row justify-between">
                                                <div class="">Rp</div>
                                                <div id="xdistribusi_sales">1.000.000.000</div>


                                            </div>
                                            <div class="text-sm mb-1 flex flex-row justify-between">
                                                <div class="">Rp</div>
                                                <div id="xdistribusi_noi">150.000.000</div>


                                            </div>
                                            <div class="text-sm mb-1 flex flex-row justify-between">
                                                <div class="">Rp</div>
                                                <div id="xdistribusi_valueOp">250.000.000</div>


                                            </div>




                                            <div class="flex justify-end text-sm mb-1" id="xdistribusi_roic">5%</div>


                                            <div class="text-sm mb-1 flex flex-row justify-between">
                                                <div class="">Rp</div>
                                                <div id="xdistribusi_eva" class="text-red-500 font-bold">-50.000.000</div>
                                            </div>


                                            {{-- <div class="flex justify-end text-sm mb-1 " id="xdistribusi_eva"></div> --}}


                                        </div>
                                    </div>

                                    <h5 class="font-bold text-md text-center mt-4 mb-1">Keterangan</h5>


                                    <div class="w-full grid grid-cols-1 mt-3">


                                        {{-- --}}


                                        <div class="grid grid-cols-[140px,230px] mb-0">

                                            <div class="w-full text-xs flex flex-col ">
                                                <div class="">Capital</div>

                                            </div>


                                            <div class="w-full flex flex-col ">

                                                <div class="w-full flex justify-start text-xs mb-1 text-left relative" id="x">Operating Long Term Asset dengan asumsi harga tanah Rp 100.000 /
                                                    m²

                                                </div>

                                            </div>
                                        </div>
                                        {{-- --}}

                                        <div class="grid grid-cols-[140px,230px] mb-0">

                                            <div class="w-full text-xs flex flex-col ">
                                                <div class="">NOWC</div>

                                            </div>


                                            <div class="w-full flex flex-col ">

                                                <div class="w-full flex justify-start text-xs mb-1 text-left" id="x">Working capital per tahun</div>



                                            </div>
                                        </div>
                                        {{-- --}}




                                        <div class="grid grid-cols-[140px,230px] mb-0">

                                            <div class="w-full text-xs flex flex-col ">
                                                <div class="">Sales</div>

                                            </div>


                                            <div class="w-full flex flex-col ">

                                                <div class="w-full flex justify-start text-xs mb-1 text-left" id="x">Asumsi panen 4x per tahun</div>


                                            </div>
                                        </div>
                                        {{-- --}}



                                        <div class="grid grid-cols-[140px,230px] mb-0">

                                            <div class="w-full text-xs flex flex-col ">
                                                <div class="">ROIC</div>

                                            </div>


                                            <div class="w-full flex flex-col ">

                                                <div class="w-full flex justify-start text-xs mb-1 text-left" id="x">Return on Investment Capital</div>


                                            </div>
                                        </div>


                                        {{-- --}}

                                    </div>


                                </div>

                                {{-- panen2 --}}
                                <div id="konten_radio_2" class="w-full hidden">

                                    <div class="w-full grid grid-cols-[200px,50px,120px]">

                                        <!-- Dropdown Filter -->
                                        <div class="col-span-3 w-full flex justify-beetwen mb-3">
                                            <div class="w-full grid grid-cols-[1fr,1fr] mt-3">



                                                <div class="w-full flex justify-start items-center cursor-pointer">
                                                    <span class="">Komoditi</span>
                                                </div>

                                                <div class="relative inline-block text-left flex justify-end">
                                                    <button id="dropdown-button-pencarian" class="inline-flex justify-between items-center pl-1 w-[9.5rem] h-[1.8rem] text-sm font-medium text-black bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-0">
                                                        <span id="selected-item" class="pl-2">Padi Sawah</span>
                                                        <svg id="arrow-icon-pencarian" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 transition-transform duration-200 transform" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </button>
                                                    <div id="dropdown-menu-pencarian" class="hidden origin-top-right absolute !mt-[2rem] w-[9.5rem] rounded-md bg-white ring-1 ring-black ring-opacity-5 z-10">

                                                        <div class="py-2 p-2" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button-pencarian">
                                                            <a id="item-padi-sawah" class="flex block rounded-md px-1 py-1 text-sm text-black hover:bg-gray-100 active:bg-blue-100 cursor-pointer" role="menuitem">
                                                                Padi Sawah
                                                            </a>
                                                            <a id="item-padi-ladang" class="flex block rounded-md px-1 py-1 text-sm text-black hover:bg-gray-100 active:bg-blue-100 cursor-pointer" role="menuitem">
                                                                Padi Ladang
                                                            </a>
                                                            <a id="item-jagung" class="flex block rounded-md px-1 py-1 text-sm text-black hover:bg-gray-100 active:bg-blue-100 cursor-pointer" role="menuitem">
                                                                Jagung
                                                            </a>
                                                            <a id="item-kedelai" class="flex block rounded-md px-1 py-1 text-sm text-black hover:bg-gray-100 active:bg-blue-100 cursor-pointer" role="menuitem">
                                                                Kedelai
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>

                                        </div>

                                        <div class="w-full col-span-3 flex flex-col mb-[3rem]">
                                            {{-- --}}
                                            <div class="grid grid-cols-[205px,164px] ">
                                                <div class=" h-[3.5vh] w-full  flex justify-center items-center font-semibold">&nbsp;</div>

                                                <div class="h-[3.5vh] grid grid-col">

                                                    <div class="flex flex-row">
                                                        <div class="basis-7/12 flex justify-center items-center font-semibold text-center text-xs">x Rp 1.000</div>
                                                        <div class="basis-5/12 flex items-center font-semibold relative">
                                                            <span class="absolute right-5 text-xs">%</span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- --}}
                                            <div class="grid grid-cols-[205px,164px]">

                                                {{-- Produksi a --}}
                                                <div class="w-full flex flex-col">
                                                    <div class="font-semibold">Produksi (A)</div>
                                                </div>

                                                {{-- Produksi a --}}

                                                <div class="flex flex-row">
                                                    <div id="total_a" class="font-semibold flex justify-end basis-7/12">0</div>

                                                    <div id="total_b" id="" class="font-semibold flex justify-end basis-5/12">0 </div>


                                                </div>

                                                {{-- Produksi a --}}

                                                <div class="w-full flex flex-col">
                                                    <div class="">Utama</div>
                                                </div>

                                                {{-- Produksi a --}}

                                                <div class="flex flex-row">
                                                    <div id="utama_a" class=" flex justify-end basis-7/12">0</div>

                                                    <div id="utama_b" class=" flex justify-end basis-5/12">0</div>

                                                </div>


                                                {{-- Produksi a --}}

                                                <div class="w-full flex flex-col">
                                                    <div>Ikutan</div>
                                                </div>

                                                {{-- Produksi a --}}

                                                <div class="flex flex-row">
                                                    <div id="ikutan_a" class=" flex justify-end basis-7/12">0</div>

                                                    <div id="ikutan_b" class=" flex justify-end basis-5/12">0</div>

                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div class="font-semibold">Ongkos Produksi (B)</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}

                                                <div class="flex flex-row">
                                                    <div id="ongkos_produksi_a" class="font-semibold flex justify-end basis-7/12">0</div>

                                                    <div id="ongkos_produksi_b" class="font-semibold  flex justify-end basis-5/12">0 </div>

                                                </div>


                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Benih</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="benih_a" class=" flex justify-end basis-7/12">0</div>
                                                    <div id="benih_b" class=" flex justify-end basis-5/12">0</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Pupuk</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="pupuk_a" class=" flex justify-end basis-7/12">0</div>
                                                    <div id="pupuk_b" class=" flex justify-end basis-5/12">0</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Pestisida</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="pestisida_a" class=" flex justify-end basis-7/12">0</div>
                                                    <div id="pestisida_b" class=" flex justify-end basis-5/12">0</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Tenaga kerja dan jasa pertanian</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="tenagakerja_a" class=" flex justify-end basis-7/12">0</div>
                                                    <div id="tenagakerja_b" class=" flex justify-end basis-5/12">0</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>a. Tenaga kerja dibayar</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="tenagabayar_a" class=" flex justify-end basis-7/12">0</div>
                                                    <div id="tenagabayar_b" class=" flex justify-end basis-5/12">0</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>b. Tenaga kerja tidak dibayar</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="tenagatidakdibayar_a" class=" flex justify-end basis-7/12">0</div>
                                                    <div id="tenagatidakdibayar_b" class=" flex justify-end basis-5/12">0</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>c. Jasa pertanian</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="jasapertanian_a" class=" flex justify-end basis-7/12">0</div>
                                                    <div id="jasapertanian_b" class=" flex justify-end basis-5/12">0</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Sewa lahan</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="sewalahan_a" class=" flex justify-end basis-7/12">0</div>
                                                    <div id="sewalahan_b" class=" flex justify-end basis-5/12">0</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>PBB</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="pbb_a" class=" flex justify-end basis-7/12">0</div>
                                                    <div id="pbb_b" class=" flex justify-end basis-5/12">0</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Bunga pinjaman </div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="bunga_a" class=" flex justify-end basis-7/12">0</div>
                                                    <div id="bunga_b" class=" flex justify-end basis-5/12">0</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Premi asuransi</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="premi_a" class=" flex justify-end basis-7/12">0</div>
                                                    <div id="premi_b" class=" flex justify-end basis-5/12">0</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Sewa alat</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="sewa_a" class=" flex justify-end basis-7/12">0</div>
                                                    <div id="sewa_b" class=" flex justify-end basis-5/12">0</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Penyusutan</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="penyusutan_a" class=" flex justify-end basis-7/12">0</div>
                                                    <div id="penyusutan_b" class=" flex justify-end basis-5/12">0</div>
                                                </div>


                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div>Lainnya</div>
                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="flex flex-row">
                                                    <div id="lainnya_a" class=" flex justify-end basis-7/12">0</div>
                                                    <div id="lainnya_b" class=" flex justify-end basis-5/12">0</div>
                                                </div>


                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div class="font-semibold">Pendapatan (C)</div>

                                                </div>

                                                {{-- Ongkos Produksi --}}

                                                <div class="flex flex-row">
                                                    <div id="pendapatan_a" class="font-semibold flex justify-end basis-7/12">0</div>

                                                    <div id="pendapatan_b" class="font-semibold  flex justify-end basis-5/12">0 </div>

                                                </div>

                                                {{-- Ongkos Produksi --}}
                                                <div class="w-full flex flex-col">
                                                    <div class="font-semibold">Rasio C/B</div>


                                                </div>

                                                {{-- Ongkos Produksi --}}

                                                <div class="flex flex-row">
                                                    <div id="rasio_a" class="font-semibold flex justify-end basis-7/12">0</div>


                                                    <div id="" class="font-semibold  flex justify-end basis-5/12">&nbsp; </div>

                                                </div>



                                                {{-- --}}
                                                {{-- --}}
                                                {{-- --}}

                                            </div>



                                        </div>



                                        <div class="w-full text-sm flex flex-col ">
                                            {{-- <div class="h-[4.2vh] mb-1 ">&nbsp;</div> --}}
                                            <div class="mb-1 font-bold flex justify-center">Koefisien</div>
                                            <div class="mb-1">Growth ratee</div>
                                            <div class="mb-1">WACC</div>
                                            <div class="mb-1">
                                                Operating profitability</div>

                                            <div class="mb-1">
                                                Capital requirement</div>

                                            <div class="mb-1">Capital</div>
                                            <div class="mb-1">NOWC</div>
                                            <div class="mb-1">Net Operating Capital</div>
                                            <div class="mb-1">Sales</div>
                                            <div class="mb-1">Net Operating Income</div>
                                            <div class="mb-1">Valuasi (Metode DCF)</div>
                                            <div class="mb-1">ROIC</div>
                                            <div class="mb-1">
                                                Economic Value Added</div>
                                        </div>

                                        <div class="w-full">&nbsp;</div>

                                        <div class="w-full flex flex-col ">


                                            <div class="flex flex-row justify-end text-sm mb-1 font-bold flex justify-center">Nilai</div>


                                            <div class="flex justify-end text-sm mb-1" id="distribusi_g">0%</div>

                                            <div class="flex justify-end text-sm mb-1" id="distribusi_wacc">0%</div>

                                            <div class="flex justify-end text-sm mb-1" id="distribusi_op">0%</div>

                                            <div class="flex justify-end text-sm mb-1" id="distribusi_cr">0%</div>


                                            <div class="text-sm mb-1 flex flex-row justify-between">
                                                <div class="">Rp</div>
                                                <div id="distribusi_capital">0%</div>

                                            </div>



                                            <div class="text-sm mb-1 flex flex-row justify-between">
                                                <div class="">Rp</div>
                                                <div id="distribusi_nowc">0%</div>
                                            </div>
                                            <div class="text-sm mb-1 flex flex-row justify-between">
                                                <div class="">Rp</div>
                                                <div id="distribusi_netOpCap">0%</div>

                                            </div>
                                            <div class="text-sm mb-1 flex flex-row justify-between">
                                                <div class="">Rp</div>
                                                <div id="distribusi_sales">0%</div>

                                            </div>
                                            <div class="text-sm mb-1 flex flex-row justify-between">
                                                <div class="">Rp</div>
                                                <div id="distribusi_noi">0%</div>

                                            </div>
                                            <div class="text-sm mb-1 flex flex-row justify-between">
                                                <div class="">Rp</div>
                                                <div id="distribusi_valueOp">0%</div>

                                            </div>




                                            <div class="flex justify-end text-sm mb-1" id="distribusi_roic">0%</div>

                                            {{-- <div class="flex justify-end text-sm mb-1 text-red-500 font-bold" id="distribusi_eva">0%</div> --}}

                                            <div class="text-sm mb-1 flex flex-row justify-between">
                                                <div class="">Rp</div>
                                                <div id="distribusi_eva" class="text-red-500 font-bold">-50.000.000</div>
                                            </div>


                                        </div>
                                    </div>

                                    <h5 class="font-bold text-md text-center mt-4 mb-1">Keterangan</h5>


                                    <div class="w-full grid grid-cols-1 mt-3">


                                        {{-- --}}


                                        <div class="grid grid-cols-[140px,230px] mb-0">

                                            <div class="w-full text-xs flex flex-col ">
                                                <div class="">Capital</div>

                                            </div>


                                            <div class="w-full flex flex-col ">

                                                <div class="w-full flex justify-start text-xs mb-1 text-left relative" id="">Operating Long Term Asset dengan asumsi harga tanah Rp 100.000 /
                                                    m²

                                                </div>

                                            </div>
                                        </div>
                                        {{-- --}}

                                        <div class="grid grid-cols-[140px,230px] mb-0">

                                            <div class="w-full text-xs flex flex-col ">
                                                <div class="">NOWC</div>

                                            </div>


                                            <div class="w-full flex flex-col ">

                                                <div class="w-full flex justify-start text-xs mb-1 text-left" id="">Working capital per tahun</div>



                                            </div>
                                        </div>
                                        {{-- --}}




                                        <div class="grid grid-cols-[140px,230px] mb-0">

                                            <div class="w-full text-xs flex flex-col ">
                                                <div class="">Sales</div>

                                            </div>


                                            <div class="w-full flex flex-col ">

                                                <div class="w-full flex justify-start text-xs mb-1 text-left" id="">Asumsi panen 4x per tahun</div>


                                            </div>
                                        </div>
                                        {{-- --}}



                                        <div class="grid grid-cols-[140px,230px] mb-0">

                                            <div class="w-full text-xs flex flex-col ">
                                                <div class="">ROIC</div>

                                            </div>


                                            <div class="w-full flex flex-col ">

                                                <div class="w-full flex justify-start text-xs mb-1 text-left" id="">Return on Investment Capital</div>


                                            </div>
                                        </div>


                                        {{-- --}}

                                    </div>


                                </div>




                                {{-- TAB MENU HIDDEN --}}
                                <div class="hidden" id="tabsContainer">
                                    <ul class="flex border-b" id="tabs">
                                        <li class="tab-item mr-0 -mb-px" data-tab="1">
                                            <a href="#" class="tab-link bg-white inline-block py-2 px-2.5 font-semibold cursor-pointer text-blue-700 no-underline hover:no-underline -mb-px border-l border-t border-r rounded-t-lg text-xs">Proyeksi</a>

                                        </li>
                                        <li class="tab-item mr-0" data-tab="2">
                                            <a href="#" class="tab-link bg-white inline-block py-2 px-2.5 font-semibold cursor-pointer text-blue-700 no-underline hover:no-underline -mb-px border-l border-t border-r rounded-t-lg text-xs -ml-0.5">Asumsi</a>

                                        </li>
                                    </ul>


                                    <div class="w-full mt-2">

                                        {{-- panen1 --}}
                                        <div class="tab-content" data-content="1"></div>
                                        {{-- panen2 --}}
                                        <div class="tab-content" data-content="2"></div>

                                    </div>
                                </div>

                                {{-- jarak ke bawah --}}
                                {{-- --}}
                                <div class="pb-6"></div>



                            </div>
                        </div>



                    </div>

                    <!--  -->
                </div>

                <!-- Kedua -->

                <div class="flex flex-col justify-between">
                    <!-- Atas -->
                    <div class="w-full flex flex-col relative">
                        <!-- bug_chips -->
                        <div class="w-full flex flex-row justify-center mx-3 my-4" id="btn-titik">

                            <!--  -->


                            <div>
                                <button id="iumk" class="inline-flex justify-center items-center px-3 h-8 text-sm font-medium rounded-full shadow-sm focus:outline-none focus:ring-0 bg-white text-black mr-3">

                                    <span class="tracking-wider">Penggilingan Beras</span>
                                </button>
                            </div>
                            <!--  -->

                            <div>
                                <button id="nib" class="inline-flex justify-center items-center px-3 h-8 text-sm font-medium rounded-full shadow-sm focus:outline-none focus:ring-0 bg-white text-black mr-3">
                                    <span class="tracking-wider">Lumbung Desa</span>
                                </button>
                            </div>

                            <!--  -->

                            <div>
                                <button id="sewa_kantor" class="inline-flex justify-center items-center px-3 h-8 text-sm font-medium rounded-full shadow-sm focus:outline-none focus:ring-0 bg-white text-black mr-3">

                                    <span class="tracking-wider">Pasar Induk</span>
                                </button>
                            </div>




                            <!--  -->
                        </div>
                        <!--  -->
                    </div>

                    <!-- Bawah -->
                    <div class="w-full flex items-stretch">
                        <div class="w-full flex flex-col self-end">
                            <!-- Legend -->
                            <div class="flex flex-row w-full mb-3 ml-[1.2vw] relative">
                                {{-- hidden --}}

                                <div class="ukuran_legend_profit text-xs py-2 px-1 rounded-sm bg-white flex flex-col mr-3 legend_komoditi hidden">




                                    <div class="flex flex-row mb-2.5">


                                        <div class="flex flex-col ml-[0.45rem]">
                                            <div class="font-semibold mb-0.5 text-center">Komoditi</div>
                                            {{-- --}}
                                            <div class="flex flex-col">
                                                <div class="inline-flex items-center">
                                                    <div class="w-2.5 h-2.5 bg-[#5C5C5C] rounded-xs mr-1"></div>
                                                    <div> Beras Cianjur Kepala</div>
                                                </div>
                                                <div class="inline-flex items-center">
                                                    <div class="w-2.5 h-2.5 bg-[#C78E28] rounded-xs mr-1"></div>


                                                    <div>
                                                        Beras Setra
                                                    </div>
                                                </div>

                                                <div class="inline-flex items-center">
                                                    <div class="w-2.5 h-2.5 bg-[#38A800] rounded-xs mr-1"></div>
                                                    <div> Cabe Merah Keriting</div>
                                                </div>
                                                <div class="inline-flex items-center">
                                                    <div class="w-2.5 h-2.5 bg-[#42A097] rounded-xs mr-1"></div>
                                                    <div> Cabe Rawit Merah</div>
                                                </div>
                                                <div class="inline-flex items-center">
                                                    <div class="w-2.5 h-2.5 bg-[#46A042] rounded-xs mr-1"></div>
                                                    <div>
                                                        Bawang Merah
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="flex flex-col ml-3.5">
                                            <div class="font-semibold mb-0.5 text-center">Luas (m<sup>2</sup>)</div>

                                            <div class="flex flex-col text-right">
                                                <div>11,000</div>
                                                <div>54,000</div>
                                                <div>21,000</div>
                                                <div>89,000</div>
                                                <div>12,000</div>
                                            </div>


                                        </div>
                                        <div class="flex flex-col ml-3.5">
                                            <div class="font-semibold mb-0.5 text-center">Panen (ton)</div>

                                            <div class="flex flex-col text-center">
                                                <div>17</div>
                                                <div>12</div>
                                                <div>15</div>
                                                <div>14</div>
                                                <div>18</div>
                                            </div>
                                            {{-- --}}
                                        </div>
                                        <div class="flex flex-col ml-3.5">
                                            <div class="font-semibold mb-0.5 text-center">Harga (Rp)</div>
                                            <div class="flex flex-col text-right">
                                                <div>25,500</div>
                                                <div>27,500</div>
                                                <div>29,500</div>
                                                <div>15,500</div>
                                                <div>13,500</div>
                                            </div>
                                            <div class="mt-0.5 text-right font-semibold">Total (Rp)</div>

                                        </div>
                                        <div class="flex flex-col ml-3.5">
                                            <div class="font-semibold mb-0.5 text-center">Jumlah (Rp)</div>


                                            <div class="flex flex-col text-right">

                                                <div>4.768.500.000</div>
                                                <div>17.820.000.000</div>
                                                <div>9.292.500.000</div>
                                                <div>19.313.000.000</div>
                                                <div>2.916.000.000</div>


                                            </div>

                                            <div class="font-semibold mt-0.5">54.110.000.000</div>
                                        </div>


                                    </div>




                                </div>

                                {{-- hidden --}}
                                <div class=" box_prediksi_hujan hidden text-xs rounded-sm bg-white flex flex-col items-center pt-2 mr-3">


                                    <div class="flex flex-col w-full">

                                        <div class="w-full flex justify-center font-semibold mb-0.5">Curah Hujan (mm/hari)</div>


                                        <div class="inline-flex items-center ml-2">
                                            <div class="w-2.5 h-2.5 bg-[#99CCFF] rounded-xs mr-1"></div>
                                            <div> 0</div>
                                        </div>
                                        <div class="inline-flex items-center ml-2">
                                            <div class="w-2.5 h-2.5 bg-[#66B2FF] rounded-xs mr-1"></div>
                                            <div>
                                                0.5 – 20
                                            </div>
                                        </div>

                                        <div class="inline-flex items-center ml-2">
                                            <div class="w-2.5 h-2.5 bg-[#3399FF] rounded-xs mr-1"></div>
                                            <div>20 – 50</div>
                                        </div>
                                        <div class="inline-flex items-center ml-2">
                                            <div class="w-2.5 h-2.5 bg-[#0066FF] rounded-xs mr-1"></div>
                                            <div>50 – 100 </div>
                                        </div>
                                        <div class="inline-flex items-center ml-2">
                                            <div class="w-2.5 h-2.5 bg-[#004CFF] rounded-xs mr-1"></div>
                                            <div>
                                                100 – 150
                                            </div>
                                        </div>

                                        <div class="inline-flex items-center ml-2">
                                            <div class="w-2.5 h-2.5 bg-[#0033FF] rounded-xs mr-1"></div>
                                            <div>
                                                > 150
                                            </div>
                                        </div>


                                    </div>


                                </div>

                                <div class=" box_usia_panen hidden text-xs rounded-sm bg-white flex flex-col items-center pt-2 mr-3">

                                    <div class="flex flex-col w-full">

                                        <div class="w-full flex justify-start font-semibold mb-0.5 ml-2">

                                            Usia (minggu)


                                        </div>


                                        <div class="inline-flex items-center ml-2">
                                            <div class="w-2.5 h-2.5 bg-[#C8E6C9] rounded-xs mr-1"></div>

                                            <div>0 - 2</div>
                                        </div>
                                        <div class="inline-flex items-center ml-2">
                                            <div class="w-2.5 h-2.5 bg-[#A3D9A5] rounded-xs mr-1"></div>

                                            <div>
                                                2 – 4
                                            </div>
                                        </div>

                                        <div class="inline-flex items-center ml-2">
                                            <div class="w-2.5 h-2.5 bg-[#72C074] rounded-xs mr-1"></div>

                                            <div>4 – 6</div>
                                        </div>
                                        <div class="inline-flex items-center ml-2">
                                            <div class="w-2.5 h-2.5 bg-[#42A842] rounded-xs mr-1"></div>

                                            <div>6 – 8 </div>
                                        </div>
                                        <div class="inline-flex items-center ml-2">
                                            <div class="w-2.5 h-2.5 bg-[#008A00] rounded-xs mr-1"></div>

                                            <div>
                                                8 – 10
                                            </div>
                                        </div>

                                        <div class="inline-flex items-center ml-2">
                                            <div class="w-2.5 h-2.5 bg-[#005700] rounded-xs mr-1"></div>

                                            <div>
                                                10 - 12
                                            </div>
                                        </div>


                                    </div>


                                </div>


                                <div class="box_kesuburan hidden text-xs rounded-sm bg-white flex flex-col items-center pt-2 mr-3">
                                    <div class="flex flex-col w-full">

                                        <div class="w-full flex justify-start font-semibold mb-0.5 ml-2">

                                            pH Tanah


                                        </div>


                                        <div class="inline-flex items-center ml-2">
                                            <div class="w-2.5 h-2.5 bg-[#D7CCC8] rounded-xs mr-1"></div>


                                            <div>0 - 2</div>
                                        </div>
                                        <div class="inline-flex items-center ml-2">
                                            <div class="w-2.5 h-2.5 bg-[#BCAAA4] rounded-xs mr-1"></div>


                                            <div>
                                                2 – 4
                                            </div>
                                        </div>

                                        <div class="inline-flex items-center ml-2">
                                            <div class="w-2.5 h-2.5 bg-[#A1887F] rounded-xs mr-1"></div>


                                            <div>4 – 6</div>
                                        </div>
                                        <div class="inline-flex items-center ml-2">
                                            <div class="w-2.5 h-2.5 bg-[#8D6E63] rounded-xs mr-1"></div>


                                            <div>6 – 8 </div>
                                        </div>
                                        <div class="inline-flex items-center ml-2">
                                            <div class="w-2.5 h-2.5 bg-[#795548] rounded-xs mr-1"></div>


                                            <div>
                                                8 – 10
                                            </div>
                                        </div>

                                        <div class="inline-flex items-center ml-2">
                                            <div class="w-2.5 h-2.5 bg-[#6D4C41] rounded-xs mr-1"></div>


                                            <div>
                                                10 - 12
                                            </div>
                                        </div>


                                    </div>


                                </div>








                            </div>



                            <!-- Running Teks -->
                            <div class="w-full bg-white relative">
                                <div class="w-[71vw] h-[3.1vh] flex justify-center items-center">
                                    <div class="teks-berjalan-pencarian w-full text-sm text-black whitespace-nowrap">
                                        Dalam konteks pertanian pedesaan, kemajuan terjadi melalui adopsi teknologi modern seperti irigasi otomatis, penggunaan pupuk organik, dan pelatihan petani tentang praktik berkelanjutan. Ini memungkinkan peningkatan produksi yang berkelanjutan sambil menjaga kelestarian lingkungan dan kemandirian lokal dalam pasokan pangan

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <!--  -->
        </div>
        <!--  -->

        <!--  -->
    </div>
    </div>

    <div class="info-edit-iumk">
        <div class="container p-4">
            <button type="button" class="close" id="closeEditIUMK" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <span style="font-size: 13pt" class="title-info font-weight-bold">Detail IUMK</span>
            <div class="mt-5">
                <form action="" id="formEditIUMK">
                    <div class="row">

                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">Koordinat</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" style="font-size: 8pt" class="w-100" name="wkb_geometry" id="location_iumk">
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">Catatan</label>
                            <input type="hidden" name="ogc_fid" id="ogc_fid_iumk">
                        </div>
                        <div class="col-md-8">
                            <label style="margin-bottom:-10px;">
                                <input type="radio" class="star-choice star-green" name="star" value="green" checked><span alt="Option 1">★</span> <label style="font-size:13px;">UKM
                                    Prioritas</label>
                            </label>
                            <label style="margin-bottom:-10px;">
                                <input type="radio" class="star-choice star-yellow" name="star" value="yellow"><span alt="Option 2">★</span> <label style="font-size:13px;">UKM
                                    Perlu Pendampingan</label>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">Nama Usaha</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" style="font-size: 8pt" class="w-100" name="nama_usaha" id="nama_usaha_iumk">
                        </div>
                        {{-- <div class="col-md-4">
                                <label style="font-size: 13px;line-height:0px;">Nama Pemilik</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" style="font-size: 8pt" class="w-100" name="nama_pemilik"
                                    id="nama_pemilik_iumk">
                            </div> --}}
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">Alamat Usaha</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" style="font-size: 8pt" class="w-100" name="alamat_usaha" id="alamat_usaha_iumk">
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">NIK</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" style="font-size: 8pt" class="w-100" name="nik" id="nik_iumk">
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">NPWP</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" style="font-size: 8pt" class="w-100" name="npwp" id="npwp_iumk">
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">Penilaian</label>
                        </div>
                        <div class="col-md-8">
                            <div class="rating">
                                <label>
                                    <input type="radio" name="stars" value="1" />
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" name="stars" value="2" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" name="stars" value="3" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" name="stars" value="4" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" name="stars" value="5" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                            </div>
                            <input type="hidden" name="penilaian" id="penilaian_iumk">
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">Perizinan</label>
                        </div>
                        <div class="col-md-8">
                            <select class="w-100" name="perizinan" id="perizinan_iumk" style="font-size:11pt">
                                <option value="NIB">NIB</option>
                                <option value="Halal">Halal</option>
                                <option value="Izin Edar">Izin Edar</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            {{-- <label style="font-size: 13px;line-height:0px;">Perizinan</label> --}}
                        </div>
                        <div class="col-md-8">
                            <input type="text" style="font-size: 8pt" class="w-100" name="no_izin" id="no_izin_iumk">
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">Omzet Tahunan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" style="font-size: 8pt" class="w-100" name="omzet_tahunan" id="omzet_tahunan_iumk">
                        </div>
                        <div class="col-md-12">
                            <div class="spinner-border spinner-edit-iumk" role="status" style="display: none;">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <button type="submit" class="btn btn-success btn-send-iumk" style="margin-top: 1rem;font-size: 8pt; cursor: pointer;"><i class="fa fa-paper-plane"></i> Simpan
                                Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="info-edit-nib">
        <div class="container p-4">
            <button type="button" class="close" id="closeEditNIB" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <span style="font-size: 13pt" class="title-info font-weight-bold">Detail NIB</span>
            <div class="mt-5">
                <div class="alert alert-success" role="alert" id="alertNIB" style="font-size: 10pt; display:none;">
                    <strong>Berhasil!</strong> Data NIB Berhasil di Ubah.
                </div>
                <form action="" id="formEditNIB">
                    <div class="row">
                        {{-- <div class="col-md-4">
                                <label style="font-size: 13px;line-height:0px;">Nama</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" style="font-size: 8pt" class="w-100" name="nama_perusahaan"
                                    id="nama_perusahaan_nib">
                            </div> --}}
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">Koordinat</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" style="font-size: 8pt" class="w-100" name="wkb_geometry" id="location_nib">
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">NIB</label>
                        </div>
                        <div class="col-md-8">
                            <input type="hidden" name="ogc_fid" id="ogc_fid_nib">
                            <input type="number" style="font-size: 8pt" class="w-100" name="nib" id="nib_nib">
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">Skala Usaha</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" style="font-size: 8pt" class="w-100" name="uraian_skala_usaha" id="uraian_skala_usaha_nib">
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">KBLI</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" style="font-size: 8pt" class="w-100" name="kbli" id="kbli_nib">
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">Jumlah Investasi</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" style="font-size: 8pt" class="w-100" name="jumlah_investasi_lain" id="jumlah_investasi_lain_nib">
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">Resiko Proyek</label>
                        </div>
                        <div class="col-md-8">
                            <select type="text" style="font-size: 9.3pt" class="w-100" name="uraian_risiko_proyek" id="uraian_resiko_proyek_nib">
                                <option value="Rendah">Rendah</option>
                                <option value="Menengan Rendah">Menengan Rendah</option>
                                <option value="Tinggi">Tinggi</option>
                                <option value="Menengah Tinggi">Menengah Tinggi</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="spinner-border spinner-edit-nib" role="status" style="display: none;">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <button type="submit" class="btn btn-success btn-send-nib" style="margin-top: 1rem;font-size: 8pt; cursor: pointer;"><i class="fa fa-paper-plane"></i> Simpan
                                Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="info-pesan-ajib">
        <div class="container p-4">
            <button type="button" class="close" id="closePesanAjib" onclick="close_pesan_ajib()" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <span style="font-size: 13pt" class="title-info font-weight-bold">PesanAJIB <sup class="bg-danger text-white p-1 rounded ml-2" style="font-size: 9pt">BETA</sup></span>
            <div class="mt-4">
                <div class="alert alert-danger" id="alertErrorPesanAjib" role="alert" style="display: none; font-size: 10pt">
                    <b>Gagal</b> <span>Semua Form Wajib di Isi</span>
                </div>
                <div class="alert alert-success" id="alertSuccessAjib" role="alert" style="display: none; font-size: 10pt">
                    <b>Berhasil</b> Permohonan Anda Sedang Berhasil di Kirim
                </div>
                <div class="alert alert-secondary" role="alert" style="font-size:14px">
                    Pemesanan AJIB hanya bisa dilakukan pada jam kerja 09.00 - 15.00 WIB
                </div>
                <form action="" id="pesanAjibForm">
                    <div class="row">
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">Nama Pemohon</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" style="font-size: 8pt" class="w-100" name="nama" id="nama_pemohon_pesan_ajib">
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">NIK</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" style="font-size: 8pt" class="w-100" name="nik" id="nik_pesan_ajib">
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">No Hp</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" style="font-size: 8pt" class="w-100" name="no_hp" id="no_hp_pesan_ajib">
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">Koordinat</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" style="font-size: 8pt" class="w-100" id="koordinat_pesan_ajib" readonly>
                            <input type="hidden" name="lat" id="lat_pesan_ajib">
                            <input type="hidden" name="lng" id="lng_pesan_ajib">
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">Kelurahan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" style="font-size: 8pt" class="w-100" name="kelurahan" id="kelurahan_pesan_ajib" readonly>
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">Kecamatan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" style="font-size: 8pt" class="w-100" name="kecamatan" id="kecamatan_pesan_ajib" readonly>
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">Kota</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" style="font-size: 8pt" class="w-100" name="kota" id="kota_pesan_ajib" readonly>
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">Alamat</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" style="font-size: 8pt" class="w-100" name="alamat" id="alamat_pesan_ajib">
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 13px;line-height:0px;">Jenis</label>
                        </div>
                        <div class="col-md-8">
                            <select style="font-size: 10pt" class="w-100" name="jenis" id="jenis_pesan_ajib">

                            </select>
                        </div>
                        <div class="col-md-12">
                            <label style="font-size: 13px;line-height:0px;">Pilih Ajib</label>
                        </div>
                        <div class="col-md-12" id="list-pegawai-ajib">

                        </div>
                        <div class="col-md-12">
                            <center>
                                <div class="spinner-border mt-3" role="status" id="prosesPesanAjib" style="display: none;">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <button id="btnFormPesanAjib" type="submit" class="btn btn-success mt-3 text-white" style="font-size: 8pt; cursor: pointer;"><i class="fa fa-paper-plane"></i>
                                    Pesan</button>
                            </center>
                        </div>
                    </div>
                </form>

                <div class="mt-5">
                    <div class="row">
                        <div class="col-md-6">
                            <span style="font-size: 14px" class="title-info font-weight-bold">Riwayat
                                Pemesanan</span>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="w-100" style="font-size: 8pt" id="keyword" placeholder="Cari No Permohonan">
                        </div>
                    </div>
                    <div id="list-data-permohonan" class="mt-4">
                        <center style="font-size:12.5px">
                            <div class="spinner-border mt-3" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <!-- <script src="assets/js/popper.min.js" rel="preload"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- <script src="assets/js/bootstrap.min.js" rel="preload"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- <script src="{{ asset('assets/js/Chart.min.js') }}"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-adapter-moment/1.0.0/chartjs-adapter-moment.min.js"></script>


    <script src="{{ asset('assets/js/bindWithDelay.js') }}"></script>
    <script src='assets/js/mapbox-gl.js'></script>
    {{-- <script src="https://unpkg.com/@turf/turf@6/turf.min.js"></script> --}}
    <script src="{{ asset('assets/js/mapboxgl-draw.js') }}"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.Marquee/1.6.0/jquery.marquee.min.js" integrity="sha512-JHJv/L48s1Hod24iSI0u9bcF/JlUi+YaxliKdbasnw/U1Lp9xxWkaZ3O5OuQPMkVwOVXeFkF4n4176ouA6Py3A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    {{-- <script src="https://unpkg.com/@turf/turf@6/turf.min.js"></script> --}}
    {{-- @if (isMobileDevice())
    <script src="{{ asset('assets/js/mobile.js') }}"></script>
    @else --}}
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-46NTVGZXK4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-46NTVGZXK4');

    </script>

    <script>
        let APP_URL = {
            !!json_encode(url('/')) !!
        }
        let user_id = {
            !!json_encode(Auth::user() - > id) !!
        }

    </script>

    {{-- Pendataan Desa --}}

    <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>

    <script>
        // Running Teks

        $(document).ready(function() {
            // Initialize marquee
            $(".teks-berjalan-pencarian").marquee({
                duration: 17500
                , delayBeforeStart: 0
                , direction: "left"
                , pauseOnHover: true
            , });
        });

        document.addEventListener("DOMContentLoaded", function() {
            function activateTab(btnId) {
                const allContents = document.querySelectorAll('[id^="content-"]');
                allContents.forEach((content) => {
                    content.classList.add("hidden");
                });

                const allButtons = document.querySelectorAll('[id^="btn-"]');
                allButtons.forEach((btn) => {
                    btn.classList.add("border-blue-500", "text-blue-500");
                    btn.classList.remove("bg-blue-500", "text-white");
                    if (btn.querySelector("svg")) {
                        btn.querySelector("svg").classList.add("text-blue-500");
                        btn.querySelector("svg").classList.remove("text-white");
                    }
                    // Menangani penggantian gambar untuk tombol "btn-6" dan "btn-4"
                    if (btn.id === "btn-6") {
                        btn.querySelector("img").src = "assets/neww/rp-off.png";
                    } else if (btn.id === "btn-4") {
                        btn.querySelector("img").src = "assets/neww/saldo-off.png";
                    }
                    // Menambahkan kondisi untuk "btn-8"
                    else if (btn.id === "btn-8") {
                        btn.querySelector("img").src = "assets/neww/pen-off.png"; // Ganti dengan path gambar off yang benar
                    }
                });

                const contentId = "content-" + btnId.split("-")[1];
                document.getElementById(contentId).classList.remove("hidden");

                const activeBtn = document.getElementById(btnId);
                activeBtn.classList.add("bg-blue-500", "text-white");
                activeBtn.classList.remove("text-blue-500", "border-blue-500");
                if (activeBtn.querySelector("svg")) {
                    activeBtn.querySelector("svg").classList.remove("text-blue-500");
                    activeBtn.querySelector("svg").classList.add("text-white");
                }
                // Menangani penggantian gambar ketika tombol aktif
                if (btnId === "btn-6") {
                    activeBtn.querySelector("img").src = "assets/neww/rp-on.png";
                } else if (btnId === "btn-4") {
                    activeBtn.querySelector("img").src = "assets/neww/saldo-on.png";
                }
                // Menambahkan kondisi untuk "btn-8"
                else if (btnId === "btn-8") {
                    activeBtn.querySelector("img").src = "assets/neww/pen-on.png"; // Ganti dengan path gambar on yang benar
                }
            }

            document.querySelectorAll('[id^="btn-"]').forEach((btn) => {
                btn.addEventListener("click", function() {
                    activateTab(btn.id);
                });
            });

            activateTab("btn-1");
        });

    </script>

    {{-- Pie Chart --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var oilCanvas = document.getElementById("produksiPertanian");

            const oilData = {
                labels: ["Beras", "Cabe", "Bawang"]
                , datasets: [{
                    data: [133.3, 86.2, 52.2], // Angka dalam jutaan
                    backgroundColor: ["#FFC700", "#4CCD99", "#007F73"]
                }]
            };

            const pieChart = new Chart(oilCanvas, {
                type: 'pie'
                , data: oilData
                , options: {
                    plugins: {
                        legend: {
                            labels: {
                                usePointStyle: true
                                , boxWidth: 8
                                , font: {
                                    size: 10 // Menyesuaikan ukuran font untuk legenda
                                }
                            }
                        }
                        , tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    const value = context.parsed * 1000; // Memperbaiki akses ke nilai data
                                    label += new Intl.NumberFormat('id-ID').format(value) + ' Ton';

                                    return label;
                                }
                            }
                        }
                    }
                    , hover: {
                        mode: null, // Menonaktifkan efek hover
                        animationDuration: 0 // Menghilangkan animasi saat hover
                    }
                    , animation: {
                        duration: 0, // Opsi ini menghilangkan animasi saat load
                        hover: {
                            mode: null
                        }
                    }
                    , events: ['mousemove', 'mouseout', 'click', 'touchstart', 'touchmove'], // Menyertakan event untuk tooltip
                    interaction: {
                        mode: 'nearest'
                        , intersect: true
                        , axis: 'x'
                    }
                }
            });
        });

    </script>


    {{-- Pie Chart2 --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var oilCanvas = document.getElementById("distribusiPembiayaan");

            const oilData = {
                labels: ["Bank", "Tengkulak", "Modal Sendiri"]
                , datasets: [{
                    data: [133.3, 86.2, 52.2], // Angka dalam jutaan
                    backgroundColor: ["#5356FF", "#378CE7", "#67C6E3"]
                }]
            };

            const pieChart = new Chart(oilCanvas, {
                type: 'pie'
                , data: oilData
                , options: {
                    plugins: {
                        legend: {
                            labels: {
                                usePointStyle: true
                                , boxWidth: 8
                                , font: {
                                    size: 10 // Menyesuaikan ukuran font untuk legenda
                                }
                            }
                        }
                        , tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    const value = context.parsed * 1000000; // Memperbaiki akses ke nilai data
                                    label += ' Rp ' + new Intl.NumberFormat('id-ID').format(value);


                                    return label;
                                }
                            }
                        }
                    }
                    , hover: {
                        mode: null, // Menonaktifkan efek hover
                        animationDuration: 0 // Menghilangkan animasi saat hover
                    }
                    , animation: {
                        duration: 0, // Opsi ini menghilangkan animasi saat load
                        hover: {
                            mode: null
                        }
                    }
                    , events: ['mousemove', 'mouseout', 'click', 'touchstart', 'touchmove'], // Menyertakan event untuk tooltip
                    interaction: {
                        mode: 'nearest'
                        , intersect: true
                        , axis: 'x'
                    }
                }
            });
        });

    </script>

    <script>
        const skipped = (ctx, value) => ctx.p0.skip ||
            ctx.p1.skip ? value : undefined;
        const down = (ctx, value) => ctx.p0.parsed.y >
            ctx.p1.parsed.y ? value : undefined;

        // Setting generic options
        const genericOptions = {
            fill: false
            , interaction: {
                intersect: false
            }
            , radius: 0
        };

        // Setting options for the second line chart
        new Chart(document.getElementById("myChart2"), {
            type: 'line'
            , data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"]
                , datasets: [{
                        label: 'Beras'
                        , data: [67, 45, 60, 34, NaN, 70]
                        , borderColor: '#DAA520'
                        , backgroundColor: '#DAA520'
                        , borderWidth: 1
                        , pointRadius: 2
                        , tension: 0.3
                        , segment: {
                            borderColor: ctx => skipped(ctx, '#DAA520') || down(ctx, '#DAA520')
                            , borderDash: ctx => skipped(ctx, [3, 3])
                        }
                        , spanGaps: true
                    }
                    , {
                        label: 'Cabe'
                        , data: [54, 23, 35, 60, NaN, 95]
                        , borderColor: '#FF0000'
                        , backgroundColor: '#FF0000'
                        , borderWidth: 1
                        , pointRadius: 2
                        , tension: 0.3


                        , segment: {
                            borderColor: ctx => skipped(ctx, '#FF0000') || down(ctx, '#FF0000')
                            , borderDash: ctx => skipped(ctx, [3, 3])
                        }
                        , spanGaps: true
                    }
                    , {
                        label: 'Bawang'
                        , data: [21, 34, 45, 55, NaN, 85]
                        , borderColor: '#9400D3'
                        , backgroundColor: '#9400D3'
                        , borderWidth: 1
                        , pointRadius: 2
                        , tension: 0.3


                        , segment: {
                            borderColor: ctx => skipped(ctx, '#9400D3') || down(ctx, '#9400D3')
                            , borderDash: ctx => skipped(ctx, [3, 3])
                        }
                        , spanGaps: true
                    }
                ]
            }

            , options: {
                ...genericOptions
                , scales: {
                    y: {
                        display: true
                        , beginAtZero: true
                        , ticks: {
                            stepSize: 25
                        }
                        , title: {
                            display: true
                            , text: "Volume (ton)"
                            , font: {
                                size: 13
                                , weight: "bold"
                            }
                        }
                    }
                    , x: {
                        display: true
                        , title: {
                            display: true
                            , text: "Bulan"
                            , font: {
                                size: 12
                                , weight: "bold"
                            }
                        }
                    }
                }
                , plugins: {
                    legend: {
                        labels: {
                            usePointStyle: true
                            , boxWidth: 8
                            , generateLabels: (chart) => {
                                return chart.data.datasets.map((dataset, index) => {
                                    return {
                                        text: dataset.label
                                        , fillStyle: dataset.backgroundColor
                                        , strokeStyle: dataset.borderColor
                                        , pointStyle: 'rect'
                                        , hidden: false
                                    };
                                });
                            }
                        }
                    }
                }
            }
        });



        // Setting options for the second line chart
        new Chart(document.getElementById("myChart3"), {
            type: 'line'
            , data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"]
                , datasets: [{
                        label: 'Beras Cianjur Kepala'
                        , data: [67, 45, 60, 34, NaN, 70]
                        , borderColor: '#DAA520'
                        , backgroundColor: '#DAA520'
                        , borderWidth: 1
                        , pointRadius: 2
                        , tension: 0.3
                        , segment: {
                            borderColor: ctx => skipped(ctx, '#DAA520') || down(ctx, '#DAA520')
                            , borderDash: ctx => skipped(ctx, [3, 3])
                        }
                        , spanGaps: true
                    }
                    , {
                        label: 'Beras Setra'
                        , data: [54, 23, 35, 60, NaN, 95]
                        , borderColor: '#FF0000'
                        , backgroundColor: '#FF0000'
                        , borderWidth: 1
                        , pointRadius: 2
                        , tension: 0.3
                        , segment: {
                            borderColor: ctx => skipped(ctx, '#FF0000') || down(ctx, '#FF0000')
                            , borderDash: ctx => skipped(ctx, [3, 3])
                        }
                        , spanGaps: true
                    }
                    , {
                        label: 'Cabe Merah Keriting'
                        , data: [10, 34, 42, 55, NaN, 85]
                        , borderColor: '#9400D3'
                        , backgroundColor: '#9400D3'
                        , borderWidth: 1
                        , pointRadius: 2
                        , tension: 0.3
                        , segment: {
                            borderColor: ctx => skipped(ctx, '#9400D3') || down(ctx, '#9400D3')
                            , borderDash: ctx => skipped(ctx, [3, 3])
                        }
                        , spanGaps: true
                    },

                    // Cabe Rawit Merah

                    {
                        label: 'Cabe Rawit Merah'
                        , data: [10, 15, 21, 19, NaN, 85]
                        , borderColor: '#FF4500'
                        , backgroundColor: '#FF4500'
                        , borderWidth: 1
                        , pointRadius: 2
                        , tension: 0.3
                        , segment: {
                            borderColor: ctx => skipped(ctx, '#FF4500') || down(ctx, '#FF4500')
                            , borderDash: ctx => skipped(ctx, [3, 3])
                        }
                        , spanGaps: true
                    },

                    // Bawang Merah

                    {
                        label: 'Bawang Merah'
                        , data: [21, 34, 45, 55, NaN, 85]
                        , borderColor: '#FFD700'
                        , backgroundColor: '#FFD700'
                        , borderWidth: 1
                        , pointRadius: 2
                        , tension: 0.3
                        , segment: {
                            borderColor: ctx => skipped(ctx, '#FFD700') || down(ctx, '#FFD700')
                            , borderDash: ctx => skipped(ctx, [3, 3])
                        }
                        , spanGaps: true
                    }

                ]
            }
            , options: {
                ...genericOptions
                , scales: {
                    y: {
                        display: true
                        , beginAtZero: true
                        , ticks: {
                            stepSize: 25
                        }
                        , title: {
                            display: true
                            , text: "Volume (ton)"
                            , font: {
                                size: 13
                                , weight: "bold"
                            }
                        }
                    }
                    , x: {
                        display: true
                        , title: {
                            display: true
                            , text: "Bulan"
                            , font: {
                                size: 12
                                , weight: "bold"
                            }
                        }
                    }
                }
                , plugins: {
                    legend: {
                        labels: {
                            usePointStyle: true
                            , boxWidth: 8
                            , font: {
                                size: 9 // Menyesuaikan ukuran font untuk legenda
                            }

                            , generateLabels: (chart) => {
                                return chart.data.datasets.map((dataset, index) => {
                                    return {
                                        text: dataset.label
                                        , fillStyle: dataset.backgroundColor
                                        , strokeStyle: dataset.borderColor
                                        , pointStyle: 'rect'
                                        , hidden: false
                                    };
                                });
                            }
                        }
                    }
                }
            }
        });

    </script>

    <script>
        // Setting options for the second line chart
        new Chart(document.getElementById("myChart4"), {
            type: 'line'
            , data: {
                labels: ["13/3", "14/3", "15/3", "16/3", "17/3", "18/3", "19/3"]
                , datasets: [{
                        label: 'Beras Cianjur Kepala'
                        , data: [19.5, 19.3, 19.4, 19.6, 19.7, 19.5, 19.2]
                        , borderColor: '#DAA520'
                        , backgroundColor: '#DAA520'
                        , borderWidth: 1
                        , pointRadius: 2
                        , spanGaps: true
                        , tension: 0.3 // Mengatur kehalusan kurva
                    }
                    , {
                        label: 'Beras Cianjur Slyp'
                        , data: [18.1, 18.2, 18.3, 18.1, 18.2, 18.2, 18.1]
                        , borderColor: '#FF0000'
                        , backgroundColor: '#FF0000'
                        , borderWidth: 1
                        , pointRadius: 2
                        , spanGaps: true
                        , tension: 0.3 // Mengatur kehalusan kurva
                    }
                    , {
                        label: 'Beras Setra'
                        , data: [16.1, 16.5, 16.3, 16.6, 16.4, 16.5, 16.4]
                        , borderColor: '#9400D3'
                        , backgroundColor: '#9400D3'
                        , borderWidth: 1
                        , pointRadius: 2
                        , spanGaps: true
                        , tension: 0.3 // Mengatur kehalusan kurva
                    }
                    , {
                        label: 'Beras Saigon'
                        , data: [16, 15.9, 16, 15.8, 16, 15.9, 16]
                        , borderColor: '#FFA07A'
                        , backgroundColor: '#FFA07A'
                        , borderWidth: 1
                        , pointRadius: 2
                        , spanGaps: true
                        , tension: 0.3 // Mengatur kehalusan kurva
                    }
                    , {
                        label: 'Beras Muncul 1'
                        , data: [15.2, 15.4, 15.5, 15.6, 15.4, 15.7, 15.8]
                        , borderColor: '#20B2AA'
                        , backgroundColor: '#20B2AA'
                        , borderWidth: 1
                        , pointRadius: 2
                        , spanGaps: true
                        , tension: 0.3 // Mengatur kehalusan kurva
                    }
                    , {
                        label: 'Beras Muncul 2'
                        , data: [15, 15.2, 15.1, 15, 15.2, 15.3, 15.2]
                        , borderColor: '#778899'
                        , backgroundColor: '#778899'
                        , borderWidth: 1
                        , pointRadius: 2
                        , spanGaps: true
                        , tension: 0.3 // Mengatur kehalusan kurva
                    }
                    , {
                        label: 'Beras Muncul 3'
                        , data: [14.1, 14.2, 14.4, 14.3, 14.5, 14.3, 14.2]
                        , borderColor: '#B0C4DE'
                        , backgroundColor: '#B0C4DE'
                        , borderWidth: 1
                        , pointRadius: 2
                        , spanGaps: true
                        , tension: 0.3 // Mengatur kehalusan kurva
                    }
                ]
            }
            , options: {
                scales: {
                    y: {
                        display: true
                        , ticks: {
                            callback: function(value, index, values) {
                                if (value === 0 || value === 14 || value === 16 || value === 18 || value === 20) {
                                    return value;
                                } else {
                                    return '';
                                }
                            }
                        }
                        , title: {
                            display: true
                            , text: "Harga (x Rp 1.000)"
                            , font: {
                                size: 13
                                , weight: "bold"
                            }
                        }
                    }
                    , x: {
                        display: true
                        , title: {
                            display: true
                            , text: "Tanggal"
                            , font: {
                                size: 12
                                , weight: "bold"
                            }
                        }
                    }
                }
                , plugins: {
                    legend: {
                        labels: {
                            usePointStyle: true
                            , boxWidth: 8
                            , generateLabels: (chart) => {
                                return chart.data.datasets.map((dataset, index) => {
                                    return {
                                        text: dataset.label
                                        , fillStyle: dataset.backgroundColor
                                        , strokeStyle: dataset.borderColor
                                        , pointStyle: 'rect'
                                        , hidden: false
                                    };
                                });
                            }
                        }
                    }
                }
            }
        });

    </script>

    <script>
        const barChartData = {
            labels: ["15-20", "21-25", "26-30", "31-35", "36-40"]
            , datasets: [{
                    label: "Pemilik"
                    , backgroundColor: "#ffba44"
                    , data: [31, 32, 37, 21, 45]
                    , barThickness: 7 // Atur lebar bar menjadi 7 pixel
                }, {

                    label: "Penyewa"
                    , backgroundColor: "#879fd1"
                    , data: [17, 20, 25, 20, 23]
                    , barThickness: 7 // Atur lebar bar menjadi 7 pixel
                }

                , {
                    label: "Penggarap"
                    , backgroundColor: "#5dc8f0"
                    , data: [30, 41, 45, 46, 49]
                    , barThickness: 7 // Atur lebar bar menjadi 7 pixel
                }
            ]
        };

        const chartOptions = {
            indexAxis: 'x', // Mengatur sumbu x sebagai sumbu kategori
            scales: {
                x: {
                    display: true
                    , beginAtZero: true
                    , ticks: {
                        stepSize: 2, // Mengatur jarak antara label pada sumbu x
                    }
                    , title: {
                        display: true
                        , text: "Usia"
                        , font: {
                            size: 12
                            , weight: "bold"
                        }
                    }
                }
                , y: {
                    display: true
                    , title: {
                        display: true
                        , text: "Jumlah"
                        , font: {
                            size: 13
                            , weight: "bold"
                        }
                    }
                    , max: 50 // Mengatur nilai maksimum pada sumbu y
                }
            }
            , plugins: {
                legend: {
                    labels: {
                        usePointStyle: true
                        , boxWidth: 8
                        , generateLabels: (chart) => {
                            return chart.data.datasets.map((dataset, index) => {
                                return {
                                    text: dataset.label
                                    , fillStyle: dataset.backgroundColor
                                    , strokeStyle: dataset.borderColor
                                    , pointStyle: 'rect'
                                    , hidden: false
                                };
                            });
                        }
                    }
                }
            }
        };

        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById("canvas1").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: "bar"
                , data: barChartData
                , options: chartOptions
            });
        });

    </script>

    <script>
        document.getElementById('slider-pindes').addEventListener('input', updateSlider);

        function updateSlider() {
            const slider = document.getElementById('slider-pindes');
            const value = parseInt(slider.value, 10); // Mengonversi nilai slider ke integer

            // Mengambil referensi ke setiap elemen radius
            const radius1 = document.querySelector('.radius1');
            const radius2 = document.querySelector('.radius2');
            const radius3 = document.querySelector('.radius3');

            // Menyembunyikan semua elemen radius terlebih dahulu
            radius1.style.display = 'none';
            radius2.style.display = 'none';
            radius3.style.display = 'none';

            // Menampilkan elemen berdasarkan nilai slider
            if (value >= 0) {
                radius1.style.display = 'block'; // Selalu tampilkan radius1
            }
            if (value >= 2) {
                radius2.style.display = 'block'; // Tampilkan radius2 ketika slider ≥ 50km
            }
            if (value == 4) {
                radius3.style.display = 'block'; // Tampilkan radius3 hanya ketika slider = 100km
            }

            // Memperbarui lebar progress dan posisi thumb
            const progressPercentages = [0, 25, 50, 75, 100];
            const percentage = progressPercentages[value];
            const progress = document.getElementById('progress');
            const thumb = document.getElementById('thumb');
            progress.style.width = percentage + '%';
            thumb.style.left = `calc(${percentage}% - ${thumb.offsetWidth / 2}px)`;
        }

        // Menambahkan event listener pada setiap elemen span untuk mengatur nilai slider
        document.querySelectorAll('.clickable').forEach(span => {
            span.addEventListener('click', function() {
                const slider = document.getElementById('slider-pindes');
                slider.value = this.getAttribute('data-value');
                updateSlider();
            });
        });

        // Memicu pembaruan slider saat halaman dimuat untuk menetapkan kondisi awal
        document.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('slider-pindes').value = 0; // Menetapkan nilai awal slider
            updateSlider(); // Memperbarui slider untuk mencerminkan kondisi awal
        });

    </script>


    {{-- CheckBox --}}
    <script>
        function toggleUsiaTanam() {

            const mapContainer = document.querySelector('.box_usia_panen');

            const checkbox = document.getElementById('fertility_map_checkbox');
            if (checkbox.checked) {
                mapContainer.classList.remove('hidden');
            } else {
                mapContainer.classList.add('hidden');
            }
        }

        function toggleKesuburan() {

            const mapContainer = document.querySelector('.box_kesuburan');
            const checkbox = document.getElementById('fertility_kesuburan_map');

            if (checkbox.checked) {
                mapContainer.classList.remove('hidden');
            } else {
                mapContainer.classList.add('hidden');
            }
        }

        function togglePrediksiCurahHujan() {
            const prediksiCurahHujanContainer = document.querySelector('.box_prediksi_hujan');
            const checkbox = document.getElementById('prediksi_curah_hujan_checkbox');
            if (checkbox.checked) {
                prediksiCurahHujanContainer.classList.remove('hidden');
            } else {
                prediksiCurahHujanContainer.classList.add('hidden');
            }
        }

    </script>


    {{-- Next Persil Informasi  --}}

    <script>
        // Data untuk informasi persil
        const dataPersil = [{
                tanggal: "19 Maret 2024"
                , gambar: "/assets/neww/padi1.jpg"
                , catatan: "Hama tikus menyerang persil 1. Sebaiknya segera diatasi."
            }
            , {
                tanggal: "23 Maret 2024"
                , gambar: "/assets/neww/padi2.jpg"
                , catatan: "Kurang air untuk seminggu ini karena sungai sedang kering."
            }
            , {
                tanggal: "27 Maret 2024"
                , gambar: "/assets/neww/padi3.png"
                , catatan: "Sementara beli air dari tetangga untuk mengairi sawah."
            }
        ];

        let currentIndex = 0;

        $(document).ready(function() {
            // Fungsi untuk memperbarui informasi persil
            function updateInformasiPersil() {
                $("#tgl-update-persil").text(dataPersil[currentIndex].tanggal);
                $("#gambar_persil img").attr("src", dataPersil[currentIndex].gambar);
                $("#catatan_isi").text(dataPersil[currentIndex].catatan);

                // Update status dan gambar tombol prev
                if (currentIndex === 0) {
                    $("#prev-informasi-persil").attr("src", "/assets/neww/left-off.png");
                    $("#prev-wrapper").addClass("border border-red-500");
                } else {
                    $("#prev-informasi-persil").attr("src", "/assets/neww/left-on.png");
                    $("#prev-wrapper").removeClass("border border-red-500");
                }

                // Update status dan gambar tombol next
                if (currentIndex === dataPersil.length - 1) {
                    $("#next-informasi-persil").attr("src", "/assets/neww/right-off.png");
                    $("#next-wrapper").addClass("border border-red-500");
                } else {
                    $("#next-informasi-persil").attr("src", "/assets/neww/right-on.png");
                    $("#next-wrapper").removeClass("border border-red-500");
                }
            }

            // Memperbarui informasi persil saat dokumen siap
            updateInformasiPersil();

            // Menangani klik pada tombol "next"
            $("#next-informasi-persil").click(function() {
                if (currentIndex < dataPersil.length - 1) {
                    currentIndex++;
                    updateInformasiPersil();
                }
            });

            // Menangani klik pada tombol "prev"
            $("#prev-informasi-persil").click(function() {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateInformasiPersil();
                }
            });
        });

    </script>

    <script>
        $(document).ready(function() {
            const dataInformasi = {
                "Padi Sawah": {
                    "g": "4%"
                    , "wacc": "10,00%"
                    , "op": "56,04%"
                    , "cr": "18,44%"
                    , "capital": "500.000.000"
                    , "nowc": "100.000.000"
                    , "netOpCap": "200.000.000"
                    , "sales": "1.000.000.000"
                    , "noi": "150.000.000"
                    , "valueOp": "250.000.000"
                    , "roic": "5%"
                    , "eva": "-50.000.000",
                    //
                    "produksi": {
                        "utama": {
                            "nilaiRupiah": 1843765
                            , "persentase": 9920
                        }
                        , "ikutan": {
                            "nilaiRupiah": 7719
                            , "persentase": 042
                        }
                        , "total": {
                            "nilaiRupiah": 1851484
                            , "persentase": 100
                        }
                        //
                        , "ongkos_produksi_a": {
                            "nilaiRupiah": 1355930
                            , "persentase": 9900
                        }
                        , "benih_a": {
                            "nilaiRupiah": 51436
                            , "persentase": 379
                        }

                        , "pupuk_a": {
                            "nilaiRupiah": 127800
                            , "persentase": 943
                        }

                        , "pestisida_a": {

                            "nilaiRupiah": 569550
                            , "persentase": 420
                        }

                        , "tenagakerja_a": {

                            "nilaiRupiah": 661519
                            , "persentase": 4879
                        }

                        , "tenagabayar_a": {

                            "nilaiRupiah": 228209
                            , "persentase": 1683
                        }

                        , "tenagatidakdibayar_a": {

                            "nilaiRupiah": 194697
                            , "persentase": 1436
                        }

                        //
                        //

                        , "jasapertanian_a": {


                            "nilaiRupiah": 238613
                            , "persentase": 1760
                        }


                        , "sewalahan_a": {


                            "nilaiRupiah": 347236
                            , "persentase": 2561
                        }

                        , "pbb_a": {


                            "nilaiRupiah": 80100
                            , "persentase": 059
                        }

                        , "bunga_a": {


                            "nilaiRupiah": 35480
                            , "persentase": 026
                        }

                        , "retribusi_a": {


                            "nilaiRupiah": 78300
                            , "persentase": 058
                        }

                        , "premi_a": {
                            "nilaiRupiah": 1770
                            , "persentase": 001
                        }

                        , "sewaalat_a": {
                            "nilaiRupiah": 39881
                            , "persentase": 294
                        }

                        , "penyusutan_a": {
                            "nilaiRupiah": 21139
                            , "persentase": 156
                        }

                        , "lainnya_a": {
                            "nilaiRupiah": 17609

                            , "persentase": 130

                        }

                        , "pendapatan_a": {
                            "nilaiRupiah": 495554
                            , "persentase": 130
                        }
                        , "rasio_a": {
                            "nilaiRupiah": 1851484
                            , "persentase": 037
                        }


                    }
                , }
                , "Padi Ladang": {
                    "g": "5%"
                    , "wacc": "11,00%"
                    , "op": "57,04%"
                    , "cr": "19,44"
                    , "capital": "600.000.000"
                    , "nowc": "110.000.000"
                    , "netOpCap": "210.000.000"
                    , "sales": "1.100.000.000"
                    , "noi": "160.000.000"
                    , "valueOp": "260.000.000"
                    , "roic": "6%"
                    , "eva": "-60.000.000"
                    , "produksi": {
                        "utama": {
                            "nilaiRupiah": 1843765
                            , "persentase": 99.99
                        }
                        , "ikutan": {
                            "nilaiRupiah": 7719
                            , "persentase": 0.42
                        }
                        , "total": {
                            "nilaiRupiah": 2051484
                            , "persentase": 100
                        }
                        //
                        , "ongkos_produksi_a": {
                            "nilaiRupiah": 1355930
                            , "persentase": 99
                        }
                        , "benih_a": {
                            "nilaiRupiah": 51436
                            , "persentase": 3.79
                        }

                        , "pupuk_a": {
                            "nilaiRupiah": 127800
                            , "persentase": 9.43
                        }

                        , "pestisida_a": {

                            "nilaiRupiah": 569.55
                            , "persentase": 4.20
                        }

                        , "tenagakerja_a": {

                            "nilaiRupiah": 661519
                            , "persentase": 48.79
                        }

                        , "tenagabayar_a": {

                            "nilaiRupiah": 228209
                            , "persentase": 16.83
                        }

                        , "tenagatidakdibayar_a": {

                            "nilaiRupiah": 194697
                            , "persentase": 14.36
                        }

                        //
                        //

                        , "jasapertanian_a": {


                            "nilaiRupiah": 238613
                            , "persentase": 17.60
                        }


                        , "sewalahan_a": {


                            "nilaiRupiah": 347236
                            , "persentase": 25.61
                        }

                        , "pbb_a": {


                            "nilaiRupiah": 80.10
                            , "persentase": 0.59
                        }

                        , "bunga_a": {


                            "nilaiRupiah": 35.48
                            , "persentase": 0.26
                        }

                        , "retribusi_a": {


                            "nilaiRupiah": 78.30
                            , "persentase": 0.58
                        }

                        , "premi_a": {
                            "nilaiRupiah": 1.77
                            , "persentase": 0.01
                        }

                        , "sewaalat_a": {
                            "nilaiRupiah": 39881
                            , "persentase": 2.94
                        }

                        , "penyusutan_a": {
                            "nilaiRupiah": 21139
                            , "persentase": 1.56
                        }

                        , "lainnya_a": {
                            "nilaiRupiah": 17609

                            , "persentase": 1.30

                        }

                        , "pendapatan_a": {
                            "nilaiRupiah": 495554
                            , "persentase": 1.30
                        }
                        , "rasio_a": {
                            "nilaiRupiah": 1851484
                            , "persentase": 0.37
                        }


                    },



                }
                , "Jagung": {
                    "g": "6%"
                    , "wacc": "12,00%"
                    , "op": "58,00%"
                    , "cr": "20,50"
                    , "capital": "700.000.000"
                    , "nowc": "120.000.000"
                    , "netOpCap": "220.000.000"
                    , "sales": "1.200.000.000"
                    , "noi": "170.000.000"
                    , "valueOp": "270.000.000"
                    , "roic": "7%"
                    , "eva": "-70.000.000"
                    , "produksi": {
                        "utama": {
                            "nilaiRupiah": 1843765
                            , "persentase": 99.99
                        }
                        , "ikutan": {
                            "nilaiRupiah": 7719
                            , "persentase": 0.42
                        }
                        , "total": {
                            "nilaiRupiah": 1651484
                            , "persentase": 100
                        }
                        //
                        , "ongkos_produksi_a": {
                            "nilaiRupiah": 1355930
                            , "persentase": 99
                        }
                        , "benih_a": {
                            "nilaiRupiah": 51436
                            , "persentase": 3.79
                        }

                        , "pupuk_a": {
                            "nilaiRupiah": 127800
                            , "persentase": 9.43
                        }

                        , "pestisida_a": {

                            "nilaiRupiah": 569.55
                            , "persentase": 4.20
                        }

                        , "tenagakerja_a": {

                            "nilaiRupiah": 661519
                            , "persentase": 48.79
                        }

                        , "tenagabayar_a": {

                            "nilaiRupiah": 228209
                            , "persentase": 16.83
                        }

                        , "tenagatidakdibayar_a": {

                            "nilaiRupiah": 194697
                            , "persentase": 14.36
                        }

                        //
                        //

                        , "jasapertanian_a": {


                            "nilaiRupiah": 238613
                            , "persentase": 17.60
                        }


                        , "sewalahan_a": {


                            "nilaiRupiah": 347236
                            , "persentase": 25.61
                        }

                        , "pbb_a": {


                            "nilaiRupiah": 80.10
                            , "persentase": 0.59
                        }

                        , "bunga_a": {


                            "nilaiRupiah": 35.48
                            , "persentase": 0.26
                        }

                        , "retribusi_a": {


                            "nilaiRupiah": 78.30
                            , "persentase": 0.58
                        }

                        , "premi_a": {
                            "nilaiRupiah": 1.77
                            , "persentase": 0.01
                        }

                        , "sewaalat_a": {
                            "nilaiRupiah": 39881
                            , "persentase": 2.94
                        }

                        , "penyusutan_a": {
                            "nilaiRupiah": 21139
                            , "persentase": 1.56
                        }

                        , "lainnya_a": {
                            "nilaiRupiah": 17609

                            , "persentase": 1.30

                        }

                        , "pendapatan_a": {
                            "nilaiRupiah": 495554
                            , "persentase": 1.30
                        }
                        , "rasio_a": {
                            "nilaiRupiah": 1851484
                            , "persentase": 0.37
                        }


                    },

                }
                , "Kedelai": {
                    "g": "7%"
                    , "wacc": "13,00%"
                    , "op": "59,00%"
                    , "cr": "21,50"
                    , "capital": "800.000.000"
                    , "nowc": "130.000.000"
                    , "netOpCap": "230.000.000"
                    , "sales": "1.300.000.000"
                    , "noi": "180.000.000"
                    , "valueOp": "280.000.000"
                    , "roic": "8%"
                    , "eva": "-80.000.000"
                    , "produksi": {
                        "utama": {
                            "nilaiRupiah": 1843765
                            , "persentase": 99.99
                        }
                        , "ikutan": {
                            "nilaiRupiah": 7719
                            , "persentase": 0.42
                        }
                        , "total": {
                            "nilaiRupiah": 1851484
                            , "persentase": 100
                        }
                        //
                        , "ongkos_produksi_a": {
                            "nilaiRupiah": 1355930
                            , "persentase": 99
                        }
                        , "benih_a": {
                            "nilaiRupiah": 51436
                            , "persentase": 3.79
                        }

                        , "pupuk_a": {
                            "nilaiRupiah": 127800
                            , "persentase": 9.43
                        }

                        , "pestisida_a": {

                            "nilaiRupiah": 569.55
                            , "persentase": 4.20
                        }

                        , "tenagakerja_a": {

                            "nilaiRupiah": 661519
                            , "persentase": 48.79
                        }

                        , "tenagabayar_a": {

                            "nilaiRupiah": 228209
                            , "persentase": 16.83
                        }

                        , "tenagatidakdibayar_a": {

                            "nilaiRupiah": 194697
                            , "persentase": 14.36
                        }

                        //
                        //

                        , "jasapertanian_a": {


                            "nilaiRupiah": 238613
                            , "persentase": 17.60
                        }


                        , "sewalahan_a": {


                            "nilaiRupiah": 347236
                            , "persentase": 25.61
                        }

                        , "pbb_a": {


                            "nilaiRupiah": 80.10
                            , "persentase": 0.59
                        }

                        , "bunga_a": {


                            "nilaiRupiah": 35.48
                            , "persentase": 0.26
                        }

                        , "retribusi_a": {


                            "nilaiRupiah": 78.30
                            , "persentase": 0.58
                        }

                        , "premi_a": {
                            "nilaiRupiah": 1.77
                            , "persentase": 0.01
                        }

                        , "sewaalat_a": {
                            "nilaiRupiah": 39881
                            , "persentase": 2.94
                        }

                        , "penyusutan_a": {
                            "nilaiRupiah": 21139
                            , "persentase": 1.56
                        }

                        , "lainnya_a": {
                            "nilaiRupiah": 17609

                            , "persentase": 1.30

                        }

                        , "pendapatan_a": {
                            "nilaiRupiah": 495554
                            , "persentase": 1.30
                        }
                        , "rasio_a": {
                            "nilaiRupiah": 1851484
                            , "persentase": 0.37
                        }


                    },

                }
            };


            function tampilkanInformasi(selectedItemText) {
                $("#selected-item").text(selectedItemText);
                const data = dataInformasi[selectedItemText];
                if (data) {
                    // console.log("Data untuk", selectedItemText, "ditemukan.");
                    $("#distribusi_g").text(data.g);
                    $("#distribusi_wacc").text(data.wacc);
                    $("#distribusi_op").text(data.op);
                    $("#distribusi_cr").text(data.cr);
                    $("#distribusi_capital").text(data.capital);
                    $("#distribusi_nowc").text(data.nowc);
                    $("#distribusi_netOpCap").text(data.netOpCap);
                    $("#distribusi_sales").text(data.sales);
                    $("#distribusi_noi").text(data.noi);
                    $("#distribusi_valueOp").text(data.valueOp);
                    $("#distribusi_roic").text(data.roic);
                    $("#distribusi_eva").text(data.eva);
                    $("#utama_a").text(data.produksi.utama.nilaiRupiah.toLocaleString("id-ID"));
                    let persentaseUtama = (data.produksi.utama.persentase / 100).toFixed(2).replace('.', ',');
                    $("#utama_b").text(persentaseUtama);

                    $("#ikutan_a").text(data.produksi.ikutan.nilaiRupiah.toLocaleString("id-ID"));
                    let persentaseIkutan = (data.produksi.ikutan.persentase / 100).toFixed(2).replace('.', ',');
                    $("#ikutan_b").text(persentaseIkutan);

                    $("#total_a").text(data.produksi.total.nilaiRupiah.toLocaleString("id-ID"));
                    $("#total_b").text(data.produksi.total.persentase.toFixed(0).replace(',', ','));

                    $("#ongkos_produksi_a").text(data.produksi.ongkos_produksi_a.nilaiRupiah.toLocaleString("id-ID"));
                    let persentaseOngkosProduksi = (data.produksi.ongkos_produksi_a.persentase / 100).toFixed(2).replace('.', ',');
                    $("#ongkos_produksi_b").text(persentaseOngkosProduksi);

                    $("#benih_a").text(data.produksi.benih_a.nilaiRupiah.toLocaleString("id-ID"));
                    let persentaseBenih = data.produksi.benih_a.persentase / 100;
                    $("#benih_b").text(persentaseBenih.toFixed(2).replace('.', ','))

                    $("#pupuk_a").text(data.produksi.pupuk_a.nilaiRupiah.toLocaleString("id-ID"));
                    let persentase = data.produksi.pupuk_a.persentase / 100;
                    $("#pupuk_b").text(persentase.toFixed(2).replace('.', ','));

                    $("#pestisida_a").text(data.produksi.pestisida_a.nilaiRupiah.toLocaleString("id-ID"));
                    $("#pestisida_b").text((data.produksi.pestisida_a.persentase / 100).toFixed(2).replace('.', ','));


                    $("#tenagakerja_a").text(data.produksi.tenagakerja_a.nilaiRupiah.toLocaleString("id-ID"));
                    $("#tenagakerja_b").text((data.produksi.tenagakerja_a.persentase / 100).toFixed(2).replace('.', ','));


                    $("#tenagabayar_a").text(data.produksi.tenagabayar_a.nilaiRupiah.toLocaleString("id-ID"));
                    $("#tenagabayar_b").text((data.produksi.tenagabayar_a.persentase / 100).toFixed(2).replace('.', ','));

                    $("#tenagatidakdibayar_a").text(data.produksi.tenagatidakdibayar_a.nilaiRupiah.toLocaleString("id-ID"));
                    $("#tenagatidakdibayar_b").text((data.produksi.tenagatidakdibayar_a.persentase / 100).toFixed(2).replace('.', ','));


                    $("#jasapertanian_a").text(data.produksi.jasapertanian_a.nilaiRupiah.toLocaleString("id-ID"));
                    $("#jasapertanian_b").text((data.produksi.jasapertanian_a.persentase / 100).toFixed(2).replace('.', ','));


                    $("#sewalahan_a").text(data.produksi.sewalahan_a.nilaiRupiah.toLocaleString("id-ID"));
                    $("#sewalahan_b").text(data.produksi.sewalahan_a.persentase.toFixed(2).replace(',', ','));

                    $("#sewalahan_a").text(data.produksi.sewalahan_a.nilaiRupiah.toLocaleString("id-ID"));
                    $("#sewalahan_b").text((data.produksi.sewalahan_a.persentase / 100).toFixed(2).replace('.', ','));


                    $("#pbb_a").text(data.produksi.pbb_a.nilaiRupiah.toLocaleString("id-ID"));
                    $("#pbb_b").text((data.produksi.pbb_a.persentase / 100).toFixed(2).replace('.', ','));


                    $("#bunga_a").text(data.produksi.bunga_a.nilaiRupiah.toLocaleString("id-ID"));
                    $("#bunga_b").text((data.produksi.bunga_a.persentase / 100).toFixed(2).replace('.', ','));


                    $("#retribusi_a").text(data.produksi.retribusi_a.nilaiRupiah.toLocaleString("id-ID"));
                    $("#retribusi_b").text((data.produksi.retribusi_a.persentase / 100).toFixed(2).replace('.', ','));


                    $("#premi_a").text(data.produksi.premi_a.nilaiRupiah.toLocaleString("id-ID"));
                    $("#premi_b").text((data.produksi.premi_a.persentase / 100).toFixed(2).replace('.', ','));


                    $("#sewa_a").text(data.produksi.sewaalat_a.nilaiRupiah.toLocaleString("id-ID"));
                    $("#sewa_b").text((data.produksi.sewaalat_a.persentase / 100).toFixed(2).replace('.', ','));


                    $("#penyusutan_a").text(data.produksi.penyusutan_a.nilaiRupiah.toLocaleString("id-ID"));
                    $("#penyusutan_b").text((data.produksi.penyusutan_a.persentase / 100).toFixed(2).replace('.', ','));


                    $("#lainnya_a").text(data.produksi.lainnya_a.nilaiRupiah.toLocaleString("id-ID"));
                    $("#lainnya_b").text((data.produksi.lainnya_a.persentase / 100).toFixed(2).replace('.', ','));


                    $("#pendapatan_a").text(data.produksi.pendapatan_a.nilaiRupiah.toLocaleString("id-ID"));
                    $("#pendapatan_b").text((data.produksi.pendapatan_a.persentase / 100).toFixed(2).replace('.', ','));


                    $("#rasio_a").text((data.produksi.rasio_a.persentase / 100).toFixed(2).replace('.', ','));



                } else {
                    console.error("Data untuk", selectedItemText, "tidak ditemukan.");
                }
            }


            // Menutup dropdown jika klik diluar dropdown
            $(document).on('click', function(e) {
                var target = $(e.target);
                if (!target.closest('#dropdown-button-pencarian').length && !target.closest('#dropdown-menu-pencarian').length) {
                    $('#dropdown-menu-pencarian').hide();
                    $("#arrow-icon-pencarian").removeClass("rotate-180");
                }
            });

            $("#dropdown-button-pencarian").click(function(e) {
                $("#dropdown-menu-pencarian").toggle();
                $("#arrow-icon-pencarian").toggleClass("rotate-180");
                e.stopPropagation(); // Mencegah event click menyebar ke dokumen
            });

            $("#dropdown-menu-pencarian a").click(function() {
                var selectedItemText = $(this).text().trim();
                tampilkanInformasi(selectedItemText);
                $("#dropdown-menu-pencarian").hide();
            });

            // Memuat informasi "Padi Sawah" saat halaman dimuat
            tampilkanInformasi("Padi Sawah");



        });

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab-item');
            const tabContents = document.querySelectorAll('.tab-content');

            function changeTab(selectedTab) {
                tabs.forEach(tab => {
                    const tabLink = tab.querySelector('.tab-link');
                    if (tab.dataset.tab === selectedTab) {
                        // tab.classList.add('-mb-px', 'border-l', 'border-t', 'border-r', 'rounded-t-lg');
                        tabLink.classList.add('text-blue-700');
                        tabLink.classList.remove('text-black');
                        tabLink.classList.remove('hover:text-blue-700');
                    } else {
                        // tab.classList.remove('-mb-px', 'border-l', 'border-t', 'border-r', 'rounded-t-lg');
                        tabLink.classList.add('text-black');
                        tabLink.classList.remove('text-blue-700');
                        tabLink.classList.add('hover:text-blue-700');
                    }
                });



                tabContents.forEach(content => {
                    if (content.dataset.content === selectedTab) {
                        content.classList.remove('hidden');
                    } else {
                        content.classList.add('hidden');
                    }
                });
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault(); // Prevent the link from redirecting
                    const selectedTab = this.dataset.tab;
                    changeTab(selectedTab);
                });
            });

            // Initialize the first tab as active
            changeTab('1');
        });




        function toggleRadioBackground() {
            // Memilih semua radio buttons dengan class 'radio_white'
            const radios = document.querySelectorAll('.radio_white');

            // Iterasi melalui setiap radio button
            radios.forEach(radio => {
                // Menambahkan event listener untuk event 'change'
                radio.addEventListener('change', function() {
                    // Jika radio button ini terpilih, hapus class 'bg-white'
                    if (this.checked) {
                        this.classList.remove('bg-white');
                    }

                    // Menambahkan class 'bg-white' kembali ke radio buttons lain yang tidak terpilih
                    radios.forEach(otherRadio => {
                        if (otherRadio !== this && !otherRadio.checked) {
                            otherRadio.classList.add('bg-white');
                        }
                    });
                });
            });
        }

        // Menjalankan fungsi setelah halaman dimuat
        document.addEventListener('DOMContentLoaded', toggleRadioBackground);

    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('input[type="radio"][name="radio_group"]');

            radios.forEach(function(radio) {
                radio.addEventListener('change', onRadioChange);
            });

            // Menjalankan onRadioChange secara langsung untuk menetapkan tampilan konten sesuai dengan
            // radio button yang terpilih secara default pada saat halaman dimuat.
            onRadioChange();

            // Trigger change event untuk radio_1 secara programatik
            // Ini akan memastikan bahwa konten untuk radio_1 ditampilkan saat halaman dimuat
            let radio1 = document.getElementById('radio_1');
            if (radio1 && !radio1.checked) {
                radio1.checked = true;
                radio1.dispatchEvent(new Event('change'));
            }

            function onRadioChange() {
                // Menyembunyikan semua konten terlebih dahulu
                document.getElementById('konten_radio_1').classList.add('hidden');
                document.getElementById('konten_radio_2').classList.add('hidden');

                // Menampilkan konten berdasarkan radio button yang dipilih
                if (document.getElementById('radio_1').checked) {
                    document.getElementById('konten_radio_1').classList.remove('hidden');
                } else if (document.getElementById('radio_2').checked) {
                    document.getElementById('konten_radio_2').classList.remove('hidden');
                }
            }
        });

    </script>










    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
    <script src="{{ asset('assets/js/pitchtoggle.js') }}"></script>
    <script src="{{ asset('assets/js/circle.js') }}"></script>
    <script src="{{ asset('assets/js/shpwrite.js') }}"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js">
    </script>
    <script src="{{ asset('assets/js/jquery.masknumber.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/compressorjs/1.1.1/compressor.min.js" integrity="sha512-VaRptAfSxXFAv+vx33XixtIVT9A/9unb1Q8fp63y1ljF+Sbka+eMJWoDAArdm7jOYuLQHVx5v60TQ+t3EA8weA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="{{ asset('assets/js/web.js') }}"></script> --}}
    <script src="{{ asset('assets/js/measure-distance.js') }}"></script>
    <script src="{{ asset('assets/js/plotshp.js') }}"></script>
    <script src="{{ asset('assets/js/printToggle.js') }}"></script>
    <script src="{{ asset('assets/js/web-new.js') }}"></script>
    <script src="{{ asset('assets/js/filter-interactive.js') }}"></script>
    <script src="{{ asset('assets/js/IO.js') }}"></script>
    <script src="{{ asset('assets/js/pesan-ajib.js') }}"></script>
    <script src="{{ asset('assets/js/prapermohonan.js') }}"></script>
    {{-- @endif --}}


</body>

</html>
