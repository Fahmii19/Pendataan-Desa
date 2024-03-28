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

    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css" />

    <link rel="stylesheet" href="{{ asset('assets/css/panduan.css') }}">

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
                        <!-- Peta Tematik Title -->
                        {{-- <div class="font-semibold text-sm mt-2">Peta Tematik</div> --}}

                        <!-- Section Transect Zone -->
                        <div class="grid grid-cols-1 gap-y-1 text-sm">

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
                                    <input id="perda-1" type="radio" value="Perda 1/2014" name="jenis-perda" class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:border-transparent focus:ring-0 hapus_focus_checkbox bg-white" />
                                    <label for="perda-1" class="ms-2 text-sm">30 hari</label>
                                </div>
                                <div class="w-full">
                                    <input id="pergub-31" type="radio" value="Pergub 31/2022" name="jenis-perda" class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:border-transparent focus:ring-0 hapus_focus_checkbox bg-white" />
                                    <label for="pergub-31" class="ms-2 text-sm">90 hari</label>
                                </div>
                                {{-- --}}
                                <div class="w-full">
                                    <input id="pergub-31" type="radio" value="Pergub 31/2022" name="jenis-perda" class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:border-transparent focus:ring-0 hapus_focus_checkbox bg-white" />
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
                                        <div style="width:55%;">
                                            <canvas class="mt-2" id="produksiPertanian" width="100" height="100"></canvas>
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









                                    {{-- --}}



                                </div>
                            </div>
                            <!-- Konten Kedua -->
                            <div class="hidden text-sm pb-2" id="content-2">




                                <div class="w-full h-[50vh] flex flex-col">

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


                                    <div class="grid grid-cols-1 mb-[2rem] mt-3">
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



                                </div>
                            </div>

                            <!-- Konten Kedelapan -->
                            <div class="hidden text-sm pb-[10rem]" id="content-8">
                                <div class="w-full h-[50vh] flex flex-col">

                                    <h5 class="mt-4 mb-3.5 font-bold text-md text-center">Informasi Persil</h5>


                                    {{-- byeeeee --}}

                                    <div class="w-full flex flex-col text-sm text-black informasi_persil">

                                        <div class="grid grid-cols-1 justify-items-center mt-2">

                                            <div class="">Tanggal 19 Maret 2024</div>

                                        </div>
                                        <div class="grid grid-cols-1 justify-items-center mt-2.5 mb-2">

                                            <div class="">
                                                <img src="{{ asset('assets/tanam_padi.png') }}" alt="" class="w-[24vw] h-[24vh]">
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Catatan</div>
                                            <div>
                                                lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                        </div>

                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Pemilik Lahan</div>

                                            <div>Kasdi</div>

                                        </div>

                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Luas (m<sup>2</sup>)</div>


                                            <div>3.000</div>
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

                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Penyewa Lahan</div>
                                            <div>Tanjungsiang</div>
                                        </div>

                                        <div class="grid grid-cols-2 mt-5">
                                            <div class="">Jumlah Penggarap</div>
                                            <div>6</div>
                                        </div>


                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Modal Kerja</div>
                                            <div>Rp 7.000.000</div>
                                        </div>
                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Sumber Pembiayaan</div>
                                            <div>Modal Sendiri</div>
                                        </div>
                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Komoditi Tanam</div>
                                            <div>Beras Cianjur</div>
                                        </div>
                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Periode Tanam</div>
                                            <div>1 Maret - 30 Juni 2024</div>
                                        </div>
                                        <div class="grid grid-cols-2 mt-5">
                                            <div class="">
                                                Tahap Tanam</div>
                                            <div class="flex flex-col">
                                                <div class="inline-flex items-center">
                                                    <img src=/assets/check.png alt="" class="w-2.5 h-2.5 object-contain mr-1">
                                                    Pembajakan</div>
                                                <div class="inline-flex items-center">
                                                    <img src=/assets/check.png alt="" class="w-2.5 h-2.5 object-contain mr-1">
                                                    Pembenihan</div>
                                                <div class="inline-flex items-center">
                                                    <img src=/assets/check.png alt="" class="w-2.5 h-2.5 object-contain mr-1">
                                                    Pembajakan 1</div>
                                                <div class="ml-[0.9rem]">Pemupukan 2</div>
                                                <div class="ml-[0.9rem]">Pemupukan 3</div>


                                            </div>

                                        </div>
                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Perkiraan Panen</div>
                                            <div>7.000 ton</div>

                                        </div>
                                        <div class="grid grid-cols-2 mt-2">
                                            <div class="">Valuasi</div>
                                            <div>Rp 50.000.000</div>

                                        </div>

                                    </div>


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
                                                <span id="progress" class="bg-teal-500 h-2 absolute left-0 top-0 rounded-full" style="width:0 km;"></span>
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

                            </div>



                        </div>

                        <!-- Konten Keempat -->
                        <div class="hidden text-sm pb-2" id="content-4">


                            <div class="h-[50vh] flex flex-col ">

                                <h5 class="mt-4 font-bold text-md text-center">Saldo Lumbung</h5>
                                <div class="mt-2">
                                    <canvas width="500" height="330" id="myChart3"></canvas>
                                </div>

                            </div>











                        </div>

                        <!-- Konten Kelima -->
                        <div class="hidden text-sm pb-2" id="content-5">

                            <div class="h-[50vh] flex flex-col mb-[4.4rem]">

                                <h5 class="font-bold text-md text-center mt-4">Persediaan Pupuk</h5>


                                <div class="mt-3">
                                    <div class="w-full text-xs text-black flex flex-col ">
                                        <div class="w-full flex justify-center">Pembaruan Terakhir</div>
                                        <div class="w-full flex justify-center">Tanggal 19 Maret 2024</div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 mt-3">

                                    <div class="grid grid-cols-[1fr,1fr,100px] font-bold text-md mt-2 mb-1">
                                        <div class="">Beras</div>
                                        <div class=" text-right">kg</div>
                                    </div>

                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Pupuk Urea</div>
                                        <div class=" text-right">200</div>
                                    </div>

                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Pupuk NPK</div>

                                        <div class=" text-right">200</div>
                                    </div>

                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Pupuk NPK Khusus</div>
                                        <div class=" text-right">180</div>
                                    </div>

                                    {{-- --}}
                                </div>
                                {{-- --}}
                                <div class="grid grid-cols-1 mt-3">


                                    <div class="grid grid-cols-[1fr,1fr,100px] font-bold text-md mt-2 mb-1">
                                        <div class="">Bawang</div>
                                        <div class=" text-right">kg</div>
                                    </div>


                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Pupuk Urea</div>
                                        <div class=" text-right">200</div>
                                    </div>

                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Pupuk NPK</div>

                                        <div class=" text-right">170</div>

                                    </div>

                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Pupuk NPK Khusus</div>

                                        <div class=" text-right">180</div>

                                    </div>

                                    {{-- --}}
                                </div>
                                {{-- --}}
                                <div class="grid grid-cols-1 mt-3">



                                    <div class="grid grid-cols-[1fr,1fr,100px] font-bold text-md mt-2 mb-1">
                                        <div class="">Cabe</div>
                                        <div class=" text-right">kg</div>
                                    </div>





                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Pupuk Urea</div>
                                        <div class=" text-right">200</div>
                                    </div>

                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Pupuk NPK</div>

                                        <div class=" text-right">170</div>

                                    </div>

                                    <div class="grid grid-cols-[1fr,1fr,100px]">
                                        <div class="">Pupuk NPK Khusus</div>

                                        <div class=" text-right">180</div>

                                    </div>

                                    {{-- --}}
                                </div>



                            </div>
                        </div>


                        <!-- Konten Keenam -->
                        <div class="hidden text-sm pb-2" id="content-6">

                            <div class="h-[50vh] flex flex-col">

                                <h5 class="font-bold text-md text-center mt-4">Distribusi Pembiayaan</h5>

                                <div class="w-full flex justify-center">
                                    <div style="width:65%;">
                                        <canvas class="mt-2" id="distribusiPembiayaan" width="100" height="100"></canvas>

                                    </div>
                                </div>





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

                                <div class="w-[39.5vw] h-[17.7vh] text-xs py-2 px-1 rounded-sm bg-white flex flex-col mr-3 legend_komoditi hidden">



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
                                            <div class="font-semibold mb-0.5 text-center">Luas Lahan (m<sup>2</sup>)</div>

                                            <div class="flex flex-col text-right">
                                                <div>11,000</div>
                                                <div>54,000</div>
                                                <div>21,000</div>
                                                <div>89,000</div>
                                                <div>12,000</div>
                                            </div>


                                        </div>
                                        <div class="flex flex-col ml-3.5">
                                            <div class="font-semibold mb-0.5 text-center">Perkiraan Panen (Ton)</div>

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
                                            <div class="font-semibold mb-0.5 text-center">Harga Pasar (Rp)</div>
                                            <div class="flex flex-col text-right">
                                                <div>25,500</div>
                                                <div>27,500</div>
                                                <div>29,500</div>
                                                <div>15,500</div>
                                                <div>13,500</div>
                                            </div>
                                            <div class="mt-0.5 text-right font-semibold">Jumlah</div>

                                        </div>
                                        <div class="flex flex-col ml-3.5">
                                            <div class="font-semibold mb-0.5 text-center">Total</div>


                                            <div class="flex flex-col text-right">

                                                <div>4,768,500,000</div>
                                                <div>17,820,000,000</div>
                                                <div>9,292,500,000</div>
                                                <div>19,313,000,000</div>
                                                <div>2,916,000,000</div>


                                            </div>

                                            <div class="font-semibold mt-0.5">54,110,000,000</div>
                                        </div>


                                    </div>




                                </div>

                                {{-- hidden --}}
                                <div class=" box_prediksi_hujan hidden w-[9.2vw] h-[17.7vh] text-xs rounded-sm bg-white flex flex-col items-center pt-2 mr-3">


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

                                <div class=" box_usia_panen hidden w-[9.2vw] h-[17.7vh] text-xs rounded-sm bg-white flex flex-col items-center pt-2 mr-3">

                                    <div class="flex flex-col w-full">

                                        <div class="w-full flex justify-center font-semibold mb-0.5">Usia Tanaman (minggu)</div>


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


                                <div class="box_kesuburan hidden w-[9.2vw] h-[17.7vh] text-xs rounded-sm bg-white flex flex-col items-center pt-2 mr-3">
                                    <div class="flex flex-col w-full">

                                        <div class="w-full flex justify-center font-semibold mb-0.5">Kesuburan Tanah (pH)</div>


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
                                <div class="w-[71vw] h-[4vh] flex justify-center items-center">
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



    {{-- KODE PENDATAAN DESA END --}}








    <form id="formSHP">
        <div class="modal fade bd-example-modal-sm" id="downloadSHP" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <div class="modal-title mb-3">
                            <h5>Unduh File SHP ?</h5>
                            <input type="text" id="nameFileSHP" class="form-control form-control-sm" placeholder="Nama File" required>
                        </div>
                        <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-download"></i>
                            Download</button>
                        <button class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>
                            Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    {{-- <div class="g-signin2" data-onsuccess="onSignIn" style="position:absolute"></div> --}}
    <!-- hide -->
    {{-- <button class="btn btn_hide_side_bar for_web" type="button" id="hide_side_bar">
        <i class="btn_icon_hide ri-arrow-left-s-fill fa-2x"></i>
    </button> --}}

    <!-- show -->
    <button class="btn btn_show_side_bar for_web" type="button" id="show_side_bar">
        <i class="btn_icon_show ri-arrow-right-s-fill fa-2x"></i>
    </button>
    <div id="sidebar-content">
        <div class="info-lokasi-detail">

        </div>

        <div class="info-survey-detail">

        </div>

        <div class="info-layer">
            <div class="container p-4">
                <button type="button" class="close" id="closeSewa" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span style="font-size: 13pt" class="title-info font-weight-bold">Sewa Kantor</span>
                <div class="list-item mt-5">

                </div>
            </div>
        </div>

        <div class="info-layer-izin-lingkungan">
            <div class="container p-4">
                <button type="button" class="close" id="closeIzinLingkungan" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span style="font-size: 13pt" class="title-info font-weight-bold">Izin Lingkungan</span>
                <div class="mt-4">
                    <ul class="nav nav-pills mb-3 d-flex justify-content-start" id="pills-tab" role="tablist" style="font-size:10pt">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active border" id="pills-searchbox-tab" data-toggle="pill" data-target="#pills-searchbox" type="button" role="tab" aria-controls="pills-searchbox" aria-selected="true">Search Box</a>
                        </li>
                        <li class="nav-item ml-2" role="presentation">
                            <a class="nav-link border" id="pills-dropdowns-tab" data-toggle="pill" data-target="#pills-dropdown" type="button" role="tab" aria-controls="pills-dropdowns" aria-selected="false">Dropdown</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-searchbox" role="tabpanel" aria-labelledby="pills-searchbox-tab">
                            <div class="for_web input-group input-group-md my-3">
                                <input type="search" id="cari_permohonan" class="form-control tombol_search py-2 border-right-0 border" placeholder="Cari No Permohonan ..." autocomplete="off" style="font-size: 8pt">

                                <div class="wm-search__dropdown">
                                    <ul class="wm-search__dropdown" role="listbox"></ul>
                                </div>

                                <ul class="wm-search__dropdown" role="listbox">

                                </ul>


                                <span class="input-group-append" style="font-size: 8pt">
                                    <button class="btn btn-secondary tombol_search border-left-0 border" style="font-size: 8pt" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-dropdown" role="tabpanel" aria-labelledby="pills-dropdowns-tab">
                            <label class="font-weight-bold" style="font-size: 10pt">Kelurahan</label>
                            <select id="kelurahanIzin" class="form-control" style="font-size: 8pt" onchange="getNamaIzin($(this).val())">

                            </select>
                            <label class="font-weight-bold mt-2" style="font-size: 10pt">Nama Izin</label>
                            <select id="namaIzin" class="form-control" style="font-size: 8pt" onchange="getListNomorPermohonan($('#kelurahanIzin').val(), $(this).val())">

                            </select>
                            <label class="font-weight-bold mt-2" style="font-size: 10pt">Nomor Permohonan</label>
                            <select id="nomorPermohonanIzin" class="form-control" style="font-size: 8pt" onchange="getDetailIzin($(this))">

                            </select>
                        </div>

                    </div>

                    <form id="formIzinLingkungan" method="post" class="w-100 mt-2">
                        <div class="mt-4 row" style="font-size: 10pt">
                            <div class="col-md-5">
                                Koordinat
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="koordinatKajian" class="w-100" style="font-size: 8pt">
                                {{-- <a href="javascript:void(0)" target="_BLANK">-</a> --}}
                            </div>
                            <div class="col-md-5">
                                Wilayah Kewenangan
                            </div>
                            <div class="col-md-7" id="wilayahKewenanganKajian">-</div>
                            <div class="col-md-5">
                                UP Kewenangan
                            </div>
                            <div class="col-md-7" id="upKewenanganKajian">-</div>
                            <div class="col-md-5">
                                No. Permohonan
                            </div>
                            <div class="col-md-7" id="noPermohonanKajian">-</div>
                            <div class="col-md-5">
                                Tipe Pengajuan
                            </div>
                            <div class="col-md-7" id="tipePengajuanKajian">-</div>
                            <div class="col-md-5">
                                Tipe Permohonan
                            </div>
                            <div class="col-md-7" id="tipePermohonanKajian">-</div>
                            <div class="col-md-5">
                                Kode Izin
                            </div>
                            <div class="col-md-7" id="kodeIzinKajian">-</div>
                            <div class="col-md-5">
                                Nama Izin
                            </div>
                            <div class="col-md-7" id="namaIzinKajian">-</div>
                            <div class="col-md-5">
                                Penanggung Jawab
                            </div>
                            <div class="col-md-7" id="penanggungJawabKajian">-</div>
                            <div class="col-md-5">
                                Perusahaan
                            </div>
                            <div class="col-md-7" id="perusahaanKajian">-</div>
                            <div class="col-md-5">
                                Alamat
                            </div>
                            <div class="col-md-7" id="alamatKajian">-</div>
                            <div class="col-md-5">
                                Kelurahan
                            </div>
                            <div class="col-md-7" id="kelurhanKajian">-</div>
                            <div class="col-md-5">
                                Kecamatan
                            </div>
                            <div class="col-md-7" id="kecamatanKajian">-</div>
                            <div class="col-md-5">
                                Tanggal Pengajuan
                            </div>
                            <div class="col-md-7" id="tanggalKajian">-</div>
                            <div class="col-md-5">
                                ETA Izin
                            </div>
                            <div class="col-md-7" id="etaIzinKajian">-</div>
                            <div class="col-md-5">
                                Waktu Permohonan
                            </div>
                            <div class="col-md-7" id="statusWaktuPermohonanKajian">-</div>
                            <div class="col-md-5">
                                Posisi Terakhir
                            </div>
                            <div class="col-md-7" id="posisiTerakhirKajian">-</div>
                            <div class="col-md-5">
                                Status Terakhir
                            </div>
                            <div class="col-md-7" id="statusTerakhirKajian">-</div>
                            <div class="col-md-12">
                                Komentar Terakhir
                            </div>
                            <div class="col-md-12" id="komentarTerakhirKajian">-</div>

                            <div class="col-md-5">
                                Status Terbaru
                            </div>
                            <div class="col-md-7">
                                <select id="statusTerbaruKajian" name="status_terbaru" class="w-100" required>
                                    <option>-</option>
                                    <option value="Berkas Sudah Terbit">Berkas Sudah Terbit</option>
                                    <option value="Berkas Sudah Ditolak">Berkas Sudah Ditolak</option>
                                    <option value="Berkas Sudah Dibatalkan Sistem">Berkas Sudah Dibatalkan Sistem
                                    </option>
                                    <option value="Berkas Sedang Diproses oleh Wilayah">Berkas Sedang Diproses oleh
                                        Wilayah
                                    </option>
                                    <option value="Berkas Perlu Disposisi Pimpinan">Berkas Perlu Disposisi Pimpinan
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                Komentar Terbaru
                            </div>
                            <div class="col-md-12 mt-2">
                                <textarea class="form-control" required name="komentar_terbaru" id="komentarTerbaruKajian" rows="3" style="font-size: 10pt"></textarea>
                            </div>
                            <div class="col-md-12 mt-2">
                                <span>Upload File/Arsip</span><br>
                                <input type="file" class="mt-2" name="file[]" id="fileIzinArsip" multiple style="font-size: 10pt">
                            </div>
                            <div class="col-md-12 my-2">
                                <div class="list-arsip-file">

                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <input type="hidden" name="nomor_permohonan" required id="fieldNomorPermohonan">
                                <button type="submit" id="btnProsesIzin" class="btn btn-success mt-3 text-white" style="font-size: 8pt; cursor: pointer;"><i class="fa fa-paper-plane"></i>
                                    Simpan</button>
                                <div class="spinner-border mt-3" role="status" id="prosesIzin" style="display: none;">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="alert alert-success text-left mt-3" id="messageSuccessIzin" role="alert" style="font-size: 10pt; display:none;">
                                    <b>Berhasil!</b> <span></span>
                                </div>
                                <div class="alert alert-danger text-left mt-3" id="messageFailedIzin" role="alert" style="font-size: 10pt;display:none;">
                                    <b>Gagal!</b> <span>Pilih Nomor Permohon atau Upload Arsip</span>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="mt-5">
                        <div class="row">
                            <div class="col-6">
                                <span class="font-weight-bold" style="font-size: 14px">Arsip File Izin</span>
                            </div>
                        </div>
                        <p align="center" class="mt-5" id="messageNoDataIzin">Tidak Ada Lokasi Yang di
                            Simpan</p>
                        <div class="list-data-izin row">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="info-layer-digitasi">
            <div class="container p-4">
                <button type="button" class="close" id="closeDigitasi" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span style="font-size: 13pt" class="title-info font-weight-bold">Data Digitasi
                    {{-- <sup class="bg-danger text-white p-1 rounded ml-2">BETA</sup> --}}
                </span>
                <div class="list-item mt-5">
                    <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert" style="font-size: 14px;">
                        <strong>Perhatian!</strong> Proses query akan memakan waktu lama, harap menunggu.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="w-100 text-center" id="loadDigitasi">
                        <div class="spinner-border text-dark" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="w-100" id="dataDigitasi" style="font-size:14px;">

                    </div>
                </div>
            </div>
        </div>

        <div class="info-layer-usaha">
            <div class="container p-4">
                <button type="button" class="close" id="closeUsaha" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span style="font-size: 13pt" class="title-info font-weight-bold">Sebaran UMKM</span>
                <div class="list-item-usaha mt-5">

                </div>
            </div>
        </div>

        <div class="info-layer-kajian-lingkungan">
            <div class="container p-4">
                <button type="button" class="close" id="closeKajian" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span style="font-size: 13pt" class="title-info font-weight-bold">Kajian Lingkungan</span>
                <div class="mt-3">
                    <form action="/saveKajianLingkungan" method="post" id="formKajianLingkungan">
                        <div class="row">
                            <div class="col-5">
                                <label style="font-size:10pt">Judul Kajian</label>
                            </div>
                            <div class="col-7">
                                <input type="text" class="form-control form-control-sm" id="judulKajian" style="font-size:8pt" placeholder="Judul Kajian" required>
                            </div>
                            <div class="col-12">
                                <label style="font-size:10pt">Opini Kajian</label>
                                <textarea class="form-control" id="opiniKajian" style="font-size:8pt" rows="5" placeholder="Tulis Opini Kajian" required></textarea>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" id="btnKajianLingkungan" class="btn btn-success mt-3 text-white" style="font-size: 8pt; cursor: pointer;"><i class="fa fa-paper-plane"></i>
                                    Simpan</button>
                                <div class="spinner-border mt-3" role="status" id="prosesKajian" style="display: none;">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="alert alert-success text-left mt-3" id="messageSuccessKajian" role="alert" style="font-size: 10pt; display:none;">
                                    <b>Berhasil!</b> <span></span>
                                </div>
                                <div class="alert alert-danger text-left mt-3" id="messageFailedKajian" role="alert" style="font-size: 10pt;display:none;">
                                    <b>Gagal!</b> <span></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mt-5">
                    <div class="row">
                        <div class="col-6">
                            <span class="font-weight-bold" style="font-size: 14px">Arsip Kajian</span>
                        </div>
                    </div>
                    <p align="center" class="mt-5" id="messageNoDataKajian" style="display:none">Tidak Ada Lokasi Yang
                        di
                        Simpan</p>
                    <div class="list-data-kajian row">

                    </div>
                </div>
            </div>

        </div>

        <div class="info-layer-investasi">
            <div class="container p-4">
                <button type="button" class="close" id="closeInvestasi" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span style="font-size: 13pt" class="title-info font-weight-bold">Proyek Potensial</span>
                <ol class="list-item-investasi mt-5">

                </ol>
            </div>
        </div>

        <div class="info-layer-budaya">
            <div class="container p-4">
                <button type="button" class="close" id="closeBudaya" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span style="font-size: 13pt" class="title-info font-weight-bold">Cagar Budaya</span>
                <div class="list-item-budaya mt-5">

                </div>
            </div>
        </div>

        <div class="info-layer-survey-perkembangan">
            <div class="container p-4">
                <button type="button" class="close" id="closeSurveyPerekmbangan" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span style="font-size: 13pt" class="title-info font-weight-bold">Verifikasi Perkembangan Wilayah</span>
                {{-- <ol class="list-item-survey-perkembangan mt-5">

                </ol> --}}
                <div class="list-item-survey-perkembangan mt-5">

                </div>
            </div>
        </div>

        {{-- NONAKTIF --}}
        {{-- @if (Auth::user()->email !== 'guest@dpmptsp-dki.com') --}}
        <div class="info-layer-nib">
            <div class="container p-4">
                <button type="button" class="close" id="closeNib" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span style="font-size: 13pt" class="title-info font-weight-bold">Sebaran NIB </span>
                <div style="font-size:13px;">
                    <br>
                    <div class="row">
                        <div class="col-md-9 d-flex align-items-center">
                            <button class="btn p-0" id="btn_filter_nib" onclick="showFilterNib()"><i class="fa fa-plus"></i></button>&nbsp;&nbsp;
                            <select id="field_filter_nib" class="w-100">
                                <option>Pilih Filter</option>
                                <option value="jenis_perusahaan">Jenis Perusahaan</option>
                                <option value="uraian_skala_usahala">Skala</option>
                                <option value="uraian_resiko_proyek">Resiko</option>
                                <option value="status_usaha">Status</option>
                                <option value="bintang">Bintang</option>
                                <option value="kbli">KBLI</option>
                                <option value="jumlah_investasi_lain">Jumlah Investasi</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-2" style="display: none;" id="filter_jenis_perusahaan">
                        <div class="col-md-4 d-flex align-items-center">
                            <span>Jenis Perusahaan</span>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <select id="field_filter_jenis_perusahaan_value" class="w-100">
                                <option value="">Pilih Jenis Perusahanan</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button class="btn p-0" id="btn_filter_nib" onclick="hideFilterNib('field_filter_jenis_perusahaan_value')"><i class="fa fa-close"></i></button>
                        </div>
                    </div>

                    <div class="row mt-2" style="display: none;" id="filter_skala">
                        <div class="col-md-4 d-flex align-items-center">
                            <span>Skala</span>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <select id="field_filter_skala_value" class="w-100">
                                <option value="">Pilih Skala</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button class="btn p-0" id="btn_filter_nib" onclick="hideFilterNib('field_filter_skala_value')"><i class="fa fa-close"></i></button>
                        </div>
                    </div>

                    <div class="row mt-2" style="display: none;" id="filter_resiko">
                        <div class="col-md-4 d-flex align-items-center">
                            <span>Resiko</span>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <select id="field_filter_resiko_value" class="w-100">
                                <option value="">Pilih Resiko</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button class="btn p-0" id="btn_filter_nib" onclick="hideFilterNib('field_filter_resiko_value')"><i class="fa fa-close"></i></button>
                        </div>
                    </div>

                    <div class="row mt-2" style="display: none;" id="filter_status">
                        <div class="col-md-4 d-flex align-items-center">
                            <span>Status</span>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <select id="field_filter_status_value" class="w-100">
                                <option value="">Pilih Status Usaha</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button class="btn p-0" id="btn_filter_nib" onclick="hideFilterNib('field_filter_status_value')"><i class="fa fa-close"></i></button>
                        </div>
                    </div>

                    <div class="row mt-2" style="display: none;" id="filter_kbli">
                        <div class="col-md-4 d-flex align-items-center">
                            <span>KBLI</span>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <input type="number" class="p-0 w-100" id="field_filter_kbli_value" class="w-100" style="font-size:13px;">
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button class="btn p-0" id="btn_filter_nib" onclick="hideFilterNib('field_filter_kbli_value')"><i class="fa fa-close"></i></button>
                        </div>
                    </div>

                    <div class="row mt-2" style="display: none;" id="filter_bintang">
                        <div class="col-md-4 d-flex align-items-center">
                            <span>Bintang</span>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="rating">
                                <label>
                                    <input type="radio" name="bintang_filter" onchange="$('#field_filter_bintang_value').val($(this).val()).trigger('change')" value="1" />
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" name="bintang_filter" onchange="$('#field_filter_bintang_value').val($(this).val()).trigger('change')" value="2" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                            </div>
                            <input type="hidden" id="field_filter_bintang_value">
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button class="btn p-0" id="btn_filter_nib" onclick="hideFilterNib('field_filter_bintang_value')"><i class="fa fa-close"></i></button>
                        </div>
                    </div>

                    <div class="row mt-2" style="display: none;" id="filter_investasi">
                        <div class="col-md-4 d-flex align-items-center">
                            <span>Jumlah Investasi</span>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <select id="field_filter_investasi_value" class="w-100">
                                <option value="">Pilih Jumlah Investasi</option>
                                <option value="<= 1 milyar">
                                    <= 1 milyar</option>
                                <option value="1 milyar s/d 5 milyar">1 milyar s/d 5 milyar</option>
                                <option value="5 milyar s/d 10 milyar">5 milyar s/d 10 milyar</option>
                                <option value="> 10 milyar">> 10 milyar</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button class="btn p-0" id="btn_filter_nib" onclick="hideFilterNib('field_filter_investasi_value')"><i class="fa fa-close"></i></button>
                        </div>
                    </div>

                    <div class="mt-4">Ditemukan <span class="inf-nib-total">0</span> Data</div>
                </div>

                <ol class="list-item-nib mt-5">

                </ol>
            </div>
        </div>
        {{-- @endif --}}

        <div class="info-layer-iprt">
            <div class="container p-4">
                <button type="button" class="close" id="closeIprt" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span style="font-size: 13pt" class="title-info font-weight-bold">Sebaran IPRT</span>
                <ol class="list-item-iprt mt-5">

                </ol>
            </div>
        </div>

        <div class="info-pin-location">
            <div class="container p-4">
                <button type="button" class="close" id="closePin" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span style="font-size: 13pt" class="title-info font-weight-bold">Pengawasan</span>
                <div class="form mt-4">
                    <div class="alert alert-danger alert-dismissible fade show" id="pesanGagal" style="font-size: 10pt" role="alert">
                        <strong>Gagal!</strong> Anda Harus Mengisi Semua Form.
                    </div>
                    <div class="alert alert-danger alert-dismissible fade show" id="pesanFoto" style="font-size: 10pt" role="alert">
                        <strong>Gagal!</strong> Maksimal 3 Foto.
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" id="pesanBerhasil" style="font-size: 10pt" role="alert">
                        <strong>Berhasil!</strong> Data Berhasil di Simpan.
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" id="pesanBerhasilEdit" style="font-size: 10pt" role="alert">
                        <strong>Berhasil!</strong> Data Berhasil di Ubah.
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" id="pesanBerhasilHapus" style="font-size: 10pt" role="alert">
                        <strong>Berhasil!</strong> Data Berhasil di Hapus.
                    </div>
                    <form id="formPinLocation" enctype="multipart/form-data">
                        <label style="font-size: 10pt">Koordinat</label>
                        <input type="text" name="kordinat" class="form-control" id="kordinatPin" style="font-size: 8pt" placeholder="Pilih Titik Lokasi" readonly>
                        <label class="mt-2" style="font-size: 10pt">Judul</label>
                        <input type="text" name="judul" class="form-control" id="judulPin" style="font-size: 8pt" placeholder="Masukan Judul Tempat">
                        <label class="mt-2" style="font-size: 10pt">Tipe</label>
                        <select name="tipe" class="form-control" id="tipePin" style="font-size: 8pt">
                            <option value="UMK">UMK</option>
                            <option value="Cagar Budaya">Cagar Budaya</option>
                            <option value="Sedang di Bangun">Sedang di Bangun</option>
                            <option value="RTH">RTH</option>
                            <option value="Pedestrian">Pedestrian</option>
                            <option value="di Jual">di Jual</option>
                            <option value="Galian & Utilitas">Galian & Utilitas</option>
                            <option value="Titik Kumpul">Titik Kumpul</option>
                            <option value="Landmark">Landmark</option>
                            <option value="Parkir Liar">Parkir Liar</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        <label class="mt-2" style="font-size: 10pt">Foto</label>
                        <div class="custom-file" style="font-size: 8pt">
                            <input type="file" name="foto[]" onchange="preview_image();" accept="image/*" multiple="multiple" class="custom-file-input" id="gambarLokasi">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <div class="row mt-3" id="previewFoto">
                        </div>
                        <label class="mt-2" style="font-size: 10pt">Catatan</label>
                        <textarea class="form-control" name="catatan" id="catatanPin" style="font-size: 8pt" placeholder="Masukan Catatan" rows="5"></textarea>
                        <button type="submit" id="pinndedLocation" class="btn btn-success mt-3 text-white" style="font-size: 8pt; cursor: pointer;"><i class="fa fa-paper-plane"></i>
                            Simpan</button>
                    </form>
                    <form id="formPinLocationEdit" enctype="multipart/form-data">
                        <label style="font-size: 10pt">Koordinat</label>
                        <input type="text" name="kordinat" class="form-control" id="kordinatPinEdit" style="font-size: 8pt" placeholder="Pilih Titik Lokasi" readonly>
                        <input type="text" class="d-none" name="id" class="form-control" id="idPinEdit">
                        <label class="mt-2" style="font-size: 10pt">Judul</label>
                        <input type="text" name="judul" class="form-control" id="judulPinEdit" style="font-size: 8pt" placeholder="Masukan Judul Tempat">
                        <label class="mt-2" style="font-size: 10pt">Tipe</label>
                        <select name="tipe" class="form-control" id="tipePinEdit" style="font-size: 8pt">
                            <option value="UMK">UMK</option>
                            <option value="Cagar Budaya">Cagar Budaya</option>
                            <option value="Sedang di Bangun">Sedang di Bangun</option>
                            <option value="RTH">RTH</option>
                            <option value="Pedestrian">Pedestrian</option>
                            <option value="di Jual">di Jual</option>
                            <option value="Galian & Utilitas">Galian & Utilitas</option>
                            <option value="Titik Kumpul">Titik Kumpul</option>
                            <option value="Landmark">Landmark</option>
                            <option value="Parkir Liar">Parkir Liar</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        <label class="mt-2" style="font-size: 10pt">Foto</label>
                        <div class="custom-file" style="font-size: 8pt">
                            <input type="file" name="foto[]" onchange="preview_image_edit();" accept="image/*" multiple="multiple" class="custom-file-input" id="gambarLokasiEdit">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <div class="row mt-3" id="previewFotoEdit">
                        </div>
                        <label class="mt-2" style="font-size: 10pt">Catatan</label>
                        <textarea class="form-control" name="catatan" id="catatanPinEdit" style="font-size: 8pt" placeholder="Masukan Catatan" rows="5"></textarea>
                        <button type="submit" id="pinndedLocation" class="btn btn-primary mt-3 text-white" style="font-size: 8pt; cursor: pointer;"><i class="fa fa-edit"></i>
                            Ubah</button>
                    </form>
                </div>

                <div class="mt-5">
                    <span class="font-weight-bold" style="font-size: 12pt">Lokasi yang di Simpan</span>
                    <p align="center" id="messageNoData" class="mt-5">Tidak Ada Lokasi Yang di Simpan</p>
                    <div class="list-item-info-location mt-2">

                    </div>
                </div>
            </div>
        </div>

        <div class="info-usaha-location">
            <div class="container p-4">
                <button type="button" class="close" id="closeUsahaLocation" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span style="font-size: 13pt" class="title-info font-weight-bold">Pendataan Usaha</span>
                <div class="form mt-4">
                    <div class="for_web input-group input-group-md my-3">
                        <input type="search" id="cari_wilayah_usaha" class="form-control tombol_search py-2 border-right-0 border" placeholder="Cari nama tempat ..." autocomplete="off" style="font-size: 8pt">


                        <!-- Ori -->
                        <div class="wm-search__dropdown">
                            <ul class="wm-search__dropdown" role="listbox"></ul>
                        </div>

                        <!-- Dummy -->
                        <ul class="wm-search__dropdown" role="listbox">

                        </ul>


                        <span class="input-group-append" style="font-size: 8pt">
                            <button class="btn btn-secondary tombol_search border-left-0 border" style="font-size: 8pt" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                            {{-- <button class="btn tombol_search border-left-0 border" type="button" id="polygonDraw">
                                <i class="ri-shape-line"></i>
                                <span class="bg-danger p-1 rounded text-white" style="font-size: 8px;margin-top: -1rem;
                                    position: absolute;">BETA</span>
                            </button> --}}
                        </span>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade show" id="pesanGagalUsaha" style="font-size: 10pt;" role="alert">
                        <strong>Gagal!</strong> Anda Harus Mengisi Semua Form.
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" id="pesanBerhasilUsaha" style="font-size: 10pt;" role="alert">
                        <strong>Berhasil!</strong> Data Berhasil di Simpan.
                    </div>
                    <div class="w-100 mt-2 text-primary" onclick="resetUsaha()" id="resetUsaha" style="font-size: 12pt; cursor: pointer;"><i class="ri-arrow-left-line"></i> <span style="
                    font-size: 13px;
                    top: -2px;
                    position: relative;
                ">Kembali</span>
                    </div>
                    <form id="formUsahaLocation" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Nama Usaha <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="nama_usaha" class="w-100" id="namaUsaha" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Nama Pemilik <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="pelaku" class="w-100" id="pelakuUsaha" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">NIK <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="nik" class="w-100" id="nikUsaha" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">NPWP </label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="npwp" class="w-100" id="npwpUsaha" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-12">
                                <label class="mt-2 text-primary" for="gambarLokasiUsaha" style="font-size: 13px;line-height:0px;cursor:pointer;"><i class="ri-upload-cloud-line font-weight-bold" style="font-size: 20px !important;position:relative;top:4px;"></i>
                                    <span>Unggah
                                        Foto</span> </label>
                                <div class="custom-file d-none" style="font-size: 8pt">
                                    <input type="file" accept="image/*" onchange="preview_foto_usaha()" multiple="multiple" class="custom-file-input" id="gambarLokasiUsaha">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <div id="previewFotoUsaha">

                                </div>
                            </div>
                            <div class="col-12">
                                <label style="font-size: 13px; line-height:0px">Alamat <sup class="text-danger font-weight-bold">*</sup></label>
                                <textarea class="form-control" name="alamat" id="alamatUsaha" style="font-size: 13px;" rows="5"></textarea>
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Koordinat <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="hidden" name="kordinat" class="w-100" id="kordinatUsaha" style="font-size: 13px; line-height:0px" placeholder="Pilih Titik Lokasi" readonly>
                                <input type="hidden" name="id" class="w-100" id="idUsaha" style="font-size: 13px; line-height:0px" placeholder="Pilih Titik Lokasi" readonly>
                                <a href="#" target="_blank" id="refrensikordinatUsaha" style="font-size: 12px; line-height:0px">-</a>
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">ID Sub Blok <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="hidden" name="id_sub_blok" id="idSubbBlokUsaha">
                                <span style="font-size: 13px; line-height:0px" id="textIdSubBlokUsaha">-</span>
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Kelurahan <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="hidden" name="kelurahan" id="kelurahanUsaha">
                                <span style="font-size: 13px; line-height:0px" id="textKelurahanUsaha">-</span>
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Kecamatan <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="hidden" name="kecamatan" id="kecamatanUsaha">
                                <span style="font-size: 13px; line-height:0px" id="textKecamatanUsaha">-</span>
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">No Perizinan <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="no_perjanjian" class="w-100" id="noPerjanjianUsaha" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Badan Usaha <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <select id="opsiBadanUsaha" class="w-100" style="font-size: 13px; line-height:0px;background:white;border:1px gray solid;">
                                    <option value="Binaan OPD Teknis">Binaan OPD Teknis</option>
                                    <option value="Binaan Jakpreneur">Binaan Jakpreneur</option>
                                    <option value="Binaan Kementerian">Binaan Kementerian</option>
                                    <option value="Non Binaan">Non Binaan</option>
                                </select>
                                <select name="badan_usaha" id="badanUsaha" class="w-100" style="font-size: 13px; line-height:0px;background:white;border:1px gray solid;">
                                    <option value="Dinas PPKUKM">Dinas PPKUKM</option>
                                    <option value="Dinas Parekraf">Dinas Parekraf</option>
                                    <option value="Dinas Sosial">Dinas Sosial</option>
                                    <option value="Dinas KPKP">Dinas KPKP</option>
                                    <option value="Dinas Tenaga Kerja">Dinas Tenaga Kerja</option>
                                    <option value="Dinas Transmigrasi dan Energi">Dinas Transmigrasi dan Energi</option>
                                    <option value="Dinas PPAPP">Dinas PPAPP</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Sektor Usaha <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <select name="sektor" id="sektorUsaha" class="w-100" style="font-size: 13px; line-height:0px;background:white;border:1px gray solid;">
                                    <option value="Kelautan dan perikanan">Kelautan dan perikanan</option>
                                    <option value="Pertanian">Pertanian</option>
                                    <option value="Lingkungan hidup dan kehutanan">Lingkungan hidup dan kehutanan
                                    </option>
                                    <option value="Energi dan sumber daya mineral">Energi dan sumber daya mineral
                                    </option>
                                    <option value="Ketenaganukliran">Ketenaganukliran</option>
                                    <option value="Perindustrian">Perindustrian</option>
                                    <option value="Perdagangan">Perdagangan</option>
                                    <option value="Pekerjaan umum dan perumahan rakyat">Pekerjaan umum dan perumahan
                                        rakyat
                                    </option>
                                    <option value="Transportasi">Transportasi</option>
                                    <option value="Kesehatan, obat, dan makanan">Kesehatan, obat, dan makanan</option>
                                    <option value="Pendidikan dan kebudayaan">Pendidikan dan kebudayaan</option>
                                    <option value="Pariwisata">Pariwisata</option>
                                    <option value="Keagamaan">Keagamaan</option>
                                    <option value="Pos, telekomunikasi, penyiaran, dan sistem dan transaksi elektronik">
                                        Pos, telekomunikasi, penyiaran, dan sistem dan transaksi elektronik</option>
                                    <option value="Pertahanan dan keamanan">Pertahanan dan keamanan</option>
                                    <option value="Ketenagakerjaan">Ketenagakerjaan</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px;">Modal Usaha (Rp.)<sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <select name="modal" class="w-50" id="modalUsaha" style="font-size: 13px; line-height:0px;background:white;border:1px gray solid;">
                                    <option value="<= 1 milyar">
                                        <= 1 Milyar</option>
                                    <option value="> 1 dan <= 5 milyar">>1 dan <= 5 milyar</option>
                                    <option value="> 5 dan <= 10 Milyar">> 5 dan <= 10 milyar</option>
                                    <option value="> 10 Milyar">> 10 milyar</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Jumlah Pekerja <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="number" class="w-50" min="0" name="jumlah_tenaga" id="jumlahTenagaUsaha" style="font-size: 13px; line-height:0px;">
                            </div>
                            <div class="col-12">
                                <p style="font-size:13px;" class="w-100 mt-2"><sup class="text-danger font-weight-bold">*</sup> Wajib di Isi</p>
                                <center>
                                    <button type="submit" id="submitUsahaLocation" class="btn btn-success mt-3 text-white" style="font-size: 13px; cursor: pointer;"><i class="fa fa-paper-plane"></i>
                                        Simpan</button>
                                    <div class="spinner-border mt-3" role="status" id="prosesUsaha" style="display: none;">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="mt-5">
                    <div class="row">
                        <div class="col-md-6">
                            <span class="font-weight-bold" style="font-size: 14px">Arsip Lokasi
                            </span>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="/printUsahaExcel" class="text-primary" style="
                position: relative;
                font-size: 13px;
                cursor:pointer;
                top:-4.5px;
                text-decoration: none;
            "><i class="ri-download-cloud-line font-weight-bold" style="font-size: 20px;position: relative;top: 4px;"></i> Unduh Arsip</a>
                        </div>
                    </div>
                    <p align="center" id="messageNoDataUsaha" style="display: none" class="mt-5">Tidak Ada Lokasi Yang
                        di Simpan</p>
                    <div class="mt-2">
                        <div class="row list-item-usaha-location">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="info-survey-location">
            <div class="container p-4">
                <button type="button" class="close" id="closeSurvey" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span style="font-size: 13pt" class="title-info font-weight-bold" id="infoSurveyLocation">Survey
                    Perkembangan Wilayah</span>
                <ul class="nav nav-pills mb-3 mt-3 d-flex justify-content-start" style="font-size:10pt" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link border active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Single Insert</a>
                    </li>
                    <li class="nav-item ml-2" role="presentation">
                        <a class="nav-link border" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Bulk Insert </a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="for_web input-group input-group-md my-3">
                            <input type="search" id="cari_wilayah_survey" class="form-control tombol_search py-2 border-right-0 border" placeholder="Cari nama tempat ..." autocomplete="off" style="font-size: 8pt">


                            <!-- Ori -->
                            <div class="wm-search__dropdown">
                                <ul class="wm-search__dropdown" role="listbox"></ul>
                            </div>

                            <!-- Dummy -->
                            <ul class="wm-search__dropdown" role="listbox">

                            </ul>


                            <span class="input-group-append" style="font-size: 8pt">
                                <button class="btn btn-secondary tombol_search border-left-0 border" style="font-size: 8pt" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                                {{-- <button class="btn tombol_search border-left-0 border" type="button"
                                    id="polygonDraw">
                                    <i class="ri-shape-line"></i>
                                    <span class="bg-danger p-1 rounded text-white" style="font-size: 8px;margin-top: -1rem;
                                        position: absolute;">BETA</span>
                                </button> --}}
                            </span>
                        </div>
                        <div class="w-100 mt-2 text-primary" onclick="resetSurvey()" style="font-size: 12pt; cursor: pointer;" id="resetSurey"><i class="ri-arrow-left-line"></i>
                            <span style="
                        font-size: 13px;
                        top: -2px;
                        position: relative;
                    ">Kembali</span>
                        </div>
                        <div class="form mt-2">
                            <form id="formSurveyLocation" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4"><label class="mt-2" style="font-size: 13px;line-height:0px;">Nama
                                            Lokasi
                                            <sup class="text-danger font-weight-bold">*</sup></label></div>
                                    <div class="col-md-8">
                                        <input type="text" class="w-100" name="name" id="nameSurvey" placeholder="Masukan Nama Tempat" style="font-size: 13px;border: #ccc 1px solid;">
                                    </div>
                                    <div class="col-md-12">
                                        <div id="previewFotoSurvey">
                                        </div>
                                        <label class="mt-2 text-primary" for="gambarLokasiSurvey" style="font-size: 13px;line-height:0px;cursor:pointer;"><i class="ri-upload-cloud-line font-weight-bold" style="font-size: 20px !important;position:relative;top:4px;"></i>
                                            <span>Unggah
                                                Foto</span> </label>
                                        <div class="custom-file d-none" style="font-size: 8pt">
                                            <input type="file" onchange="preview_foto_survey()" accept="image/*" multiple="multiple" class="custom-file-input" id="gambarLokasiSurvey">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-size: 13px;line-height:0px;">Koordinat <sup class="text-danger font-weight-bold">*</sup></label>
                                    </div>
                                    <div class="col-md-8">
                                        <span><a href="#" id="refrensiGoogleMaps" style="font-size: 13px;line-height:0px;" target="_blank">-</a></span><br>
                                        <input type="hidden" name="id" class="form-control" id="idSurvey" style="font-size: 8pt" placeholder="Pilih Titik Lokasi" readonly>
                                        <input type="hidden" name="kordinat" class="form-control" id="kordinatSurvey" style="font-size: 8pt" placeholder="Pilih Titik Lokasi" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-size: 13px;line-height:0px;">ID Sub Blok <sup class="text-danger font-weight-bold">*</sup></label>
                                    </div>
                                    <div class="col-md-8">
                                        <span><label id="textidSubblokSurvey" style="font-size: 13px;line-height:0px;" target="_blank">-</label></span><br>
                                        <input type="hidden" name="id_sublok" class="form-control" id="idSubblokSurvey" style="font-size: 8pt" placeholder="Kode ID Sub Blok" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-size: 13px;line-height:0px;">Global ID <sup class="text-danger font-weight-bold">*</sup></label>
                                    </div>
                                    <div class="col-md-8">
                                        <span><label id="textglobalidSurvey" style="font-size: 12px;width:100%" target="_blank">-</label></span><br>
                                        <input type="hidden" name="global_id" class="form-control" id="globalidSurvey" style="font-size: 8pt" placeholder="Kode ID Sub Blok" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-size: 13px;line-height:0px;">Kelurahan <sup class="text-danger font-weight-bold">*</sup></label>
                                    </div>
                                    <div class="col-md-8">
                                        <span><label id="textkelurahanSurvey" style="font-size: 13px;line-height:0px;" target="_blank">-</label></span><br>
                                        <input type="hidden" name="kelurahan" class="form-control" id="kelurahanSurvey" style="font-size: 8pt" placeholder="Nama Kelurahan" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-size: 13px;line-height:0px;">Kecamatan <sup class="text-danger font-weight-bold">*</sup></label>
                                    </div>
                                    <div class="col-md-8">
                                        <span><label id="textkecamatanSurvey" style="font-size: 13px;line-height:0px;" target="_blank">-</label></span><br>
                                        <input type="hidden" name="kecamatan" class="form-control" id="kecamatanSurvey" style="font-size: 8pt" placeholder="Nama Kecamatan" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-size: 13px;line-height:0px;">Pola Regional <sup class="text-danger font-weight-bold">*</sup></label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="regional" id="regionalSurvey" style="font-size: 8pt;width:55px;">
                                            <option value="PL">PL</option>
                                            <option value="PB-1">PB-1</option>
                                            <option value="PB-2">PB-2</option>
                                            <option value="PB-3">PB-3</option>
                                            <option value="PB-4">PB-4</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label style="font-size: 13px;line-height:0px;">Deskripsi <sup class="text-danger font-weight-bold">*</sup></label>
                                        <textarea class="form-control" name="deskripsi_regional" id="deskripsiRegionalSurvey" style="font-size: 13px" placeholder="Catatan perkembangan regional" rows="3" maxlength="255"></textarea>
                                        <span style="font-size:8pt"><span id="countTextRegional">0</span>/255</span>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-size: 13px;line-height:0px;">Pola Lingk.<sup class="text-danger font-weight-bold">*</sup></label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="neighborhood" id="neighborhoodSurvey" style="font-size: 8pt;width:55px;">
                                            <option value="-">-</option>
                                            <option value="LP-C">LP-C</option>
                                            <option value="LP-M">LP-M</option>
                                            <option value="LP-K">LP-K</option>
                                            <option value="LP-KR">LP-KR</option>
                                            <option value="LP-CR">LP-CR</option>
                                            <option value="LP-MR">LP-MR</option>
                                            <option value="LK">LK</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="mt-2" style="font-size: 13px;line-height:0px;">Deskripsi
                                            <sup class="text-danger font-weight-bold">*</sup></label>
                                        <textarea class="form-control" name="deskripsi_neighborhood" id="deskripsiNeighborhoodSurvey" style="font-size: 13px" placeholder="Catatan perkembangan lingkungan" rows="3" maxlength="255"></textarea>
                                        <span style="font-size:8pt"><span id="countTextLingkungan">0</span>/255</span>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="mt-2" style="font-size: 13px;line-height:0px;">Pola
                                            Ruang
                                            <sup class="text-danger font-weight-bold">*</sup></label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="transect_zone" id="transectZoneSurvey" style="font-size: 8pt;width:55px;">
                                            <option value="TP-1">TP-1</option>
                                            <option value="TP-2">TP-2</option>
                                            <option value="TP-2.1">TP-2.1</option>
                                            <option value="TP-2.2">TP-2.2</option>
                                            <option value="TP-3">TP-3</option>
                                            <option value="TP-4">TP-4</option>
                                            <option value="TP-5">TP-5</option>
                                            <option value="TP-6">TP-6</option>
                                            <option value="KK">KK</option>
                                            <option value="BP">BP</option>
                                            <option value="RP">RP</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label style="font-size: 13px;line-height:0px;">Deskripsi <sup class="text-danger font-weight-bold">*</sup></label>
                                        <textarea class="form-control" name="deskripsi_transect_zone" id="deskripsiTransectZoneSurvey" style="font-size: 13px" placeholder="Catatan perkembangan ruang" rows="3" maxlength="255"></textarea>
                                        <span style="font-size:8pt"><span id="countTextRuang">0</span>/255</span>
                                    </div>
                                </div>
                                <p style="font-size:13px;" class="w-100 mt-2"><sup class="text-danger font-weight-bold">*</sup> Wajib di Isi</p>
                                <center>
                                    <button type="submit" id="submitSurveyLocation" class="btn btn-success mt-2 mb-1 text-white" style="font-size: 8pt; cursor: pointer;"><i class="fa fa-paper-plane"></i>
                                        Simpan</button>
                                    <div class="spinner-border" role="status" id="prosesSurvey">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </center>
                                <div class="alert alert-danger alert-dismissible fade show" id="pesanGagalSurvey" style="font-size: 10pt" role="alert">
                                    <strong>Gagal!</strong> Periksa kembali semua kolom yang wajib diisi.
                                </div>
                                {{-- <div class="alert alert-danger alert-dismissible fade show" id="pesanFoto"
                                    style="font-size: 10pt" role="alert">
                                    <strong>Gagal!</strong> Maksimal 3 Foto.
                                </div> --}}
                                <div class="alert alert-success alert-dismissible fade show" id="pesanBerhasilSurvey" style="font-size: 10pt" role="alert">
                                    <strong>Berhasil!</strong> Data Berhasil di Simpan.
                                </div>
                                <div class="alert alert-success alert-dismissible fade show" id="pesanBerhasilEditSurvey" style="font-size: 10pt" role="alert">
                                    <strong>Berhasil!</strong> Data Berhasil di Ubah.
                                </div>
                                <div class="alert alert-success alert-dismissible fade show" id="pesanBerhasilHapusSurvey" style="font-size: 10pt" role="alert">
                                    <strong>Berhasil!</strong> Data Berhasil di Hapus.
                                </div>
                            </form>
                            {{-- <form id="formSurveyLocationEdit" enctype="multipart/form-data">
                                <label style="font-size: 10pt">Koordinat</label>
                                <input type="hidden" name="id" class="form-control" id="idSurveyEdit"
                                    style="font-size: 8pt" placeholder="Pilih Titik Lokasi" readonly>
                                <input type="text" name="kordinat" class="form-control" id="kordinatSurveyEdit"
                                    style="font-size: 8pt" placeholder="Pilih Titik Lokasi" readonly>
                                <label class="mt-2" style="font-size: 10pt">ID Sub Blok</label>
                                <input type="text" name="id_sublok" class="form-control" id="idSubblokSurveyEdit"
                                    style="font-size: 8pt" placeholder="Kode ID Sub Blok" readonly>
                                <label class="mt-2" style="font-size: 10pt">Kelurahan</label>
                                <input type="text" name="kelurahan" class="form-control" id="kelurahanSurveyEdit"
                                    style="font-size: 8pt" placeholder="Nama Kelurahan" readonly>
                                <label class="mt-2" style="font-size: 10pt">Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control" id="kecamatanSurveyEdit"
                                    style="font-size: 8pt" placeholder="Nama Kelurahan" readonly>
                                <label class="mt-2" style="font-size: 10pt">Arah perkembangan regional</label>
                                <select name="regional" class="form-control" id="regionalSurveyEdit"
                                    style="font-size: 8pt">
                                    <option value="O1">O1</option>
                                    <option value="O2">O2</option>
                                    <option value="G1">G1</option>
                                    <option value="G2">G2</option>
                                    <option value="G3">G3</option>
                                    <option value="G4">G4</option>
                                </select>
                                <label class="mt-2" style="font-size: 10pt">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi_regional"
                                    id="deskripsiRegionalSurveyEdit" style="font-size: 8pt"
                                    placeholder="Masukan Catatan perkembangan regional" rows="5"></textarea>
                                <label class="mt-2" style="font-size: 10pt">Pola perkembangan neighborhood</label>
                                <select name="neighborhood" class="form-control" id="neighborhoodSurvey"
                                    style="font-size: 8pt">
                                    <option value="CLD">CLD</option>
                                    <option value="TND">TND</option>
                                    <option value="RCD">RCD</option>
                                </select>
                                <label class="mt-2" style="font-size: 10pt">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi_neighborhood"
                                    id="deskripsiNeighborhoodSurveyEdit" style="font-size: 8pt"
                                    placeholder="Masukan Catatan perkembangan neighborhood" rows="5"></textarea>
                                <label class="mt-2" style="font-size: 10pt">Transect zone</label>
                                <select name="transect_zone" class="form-control" id="transectZoneSurveyEdit"
                                    style="font-size: 8pt">
                                    <option value="T1">T1</option>
                                    <option value="T2">T2</option>
                                    <option value="T3">T3</option>
                                    <option value="T4">T4</option>
                                    <option value="T5">T5</option>
                                    <option value="T6">T6</option>
                                    <option value="Special District">Special District</option>
                                </select>
                                <label class="mt-2" style="font-size: 10pt">Foto</label>
                                <div class="custom-file" style="font-size: 8pt">
                                    <input type="file" name="foto_survey[]" accept="image/*" multiple="multiple"
                                        class="custom-file-input" id="gambarLokasiSurveyEdit">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <div class="row mt-3" id="previewFotoSurvey">
                                </div>
                                <button type="submit" id="pinndedLocation" class="btn btn-success mt-3 text-white"
                                    style="font-size: 8pt; cursor: pointer;"><i class="fa fa-paper-plane"></i>
                                    Simpan</button>
                            </form> --}}

                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="form mt-2">
                            <div class="for_web input-group input-group-md my-3">
                                <input type="search" id="cari_wilayah_survey" class="form-control tombol_search py-2 border-right-0 border" placeholder="Cari nama tempat ..." autocomplete="off" style="font-size: 8pt">


                                <!-- Ori -->
                                <div class="wm-search__dropdown">
                                    <ul class="wm-search__dropdown" role="listbox"></ul>
                                </div>

                                <!-- Dummy -->
                                <ul class="wm-search__dropdown" role="listbox">

                                </ul>


                                <span class="input-group-append" style="font-size: 8pt">
                                    <button class="btn btn-secondary tombol_search border-left-0 border" style="font-size: 8pt" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    {{-- <button class="btn tombol_search border-left-0 border" type="button"
                                        id="polygonDraw">
                                        <i class="ri-shape-line"></i>
                                        <span class="bg-danger p-1 rounded text-white" style="font-size: 8px;margin-top: -1rem;
                                            position: absolute;">BETA</span>
                                    </button> --}}
                                </span>
                            </div>

                            <form style="font-size: 13px" id="formSurveyBulkLocation" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label style="font-size: 13px;line-height:0px;">Koordinat <sup class="text-danger font-weight-bold">*</sup></label>
                                    </div>
                                    <div class="col-md-8">
                                        <span><a href="#" id="refrensiGoogleMapsBulk" style="font-size: 13px;line-height:0px;" target="_blank">-</a></span><br>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-size: 13px;line-height:0px;">ID Sub Blok <sup class="text-danger font-weight-bold">*</sup></label>
                                    </div>
                                    <div class="col-md-8">
                                        <span><label id="textidSubblokSurveyBulk" style="font-size: 13px;line-height:0px;" target="_blank">-</label></span><br>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-size: 13px;line-height:0px;">Global ID <sup class="text-danger font-weight-bold">*</sup></label>
                                    </div>
                                    <div class="col-md-8">
                                        <span><label id="textglobalidSurveyBulk" style="font-size: 12px;line-height:0px;width:120%;" target="_blank">-</label></span><br>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-size: 13px;line-height:0px;">Kelurahan <sup class="text-danger font-weight-bold">*</sup></label>
                                    </div>
                                    <div class="col-md-8">
                                        <span><label id="textkelurahanSurveyBulk" style="font-size: 13px;line-height:0px;" target="_blank">-</label></span><br>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-size: 13px;line-height:0px;">Kecamatan <sup class="text-danger font-weight-bold">*</sup></label>
                                    </div>
                                    <div class="col-md-8">
                                        <span><label id="textkecamatanSurveyBulk" style="font-size: 13px;line-height:0px;" target="_blank">-</label></span><br>
                                    </div>
                                    <div class="col-md-12">
                                        <a href="/template_excel.xlsx" class="text-primary" style="cursor:pointer;text-decoration:none;" href=""><i class="ri-file-excel-line" style="font-size: 20px !important;position:relative;top:4px;"></i>
                                            Template
                                            Excel </a><br>
                                        <label for="fileExcel" class="text-primary" style="cursor:pointer;"><i class="ri-file-excel-line" style="font-size: 20px !important;position:relative;top:4px;"></i>
                                            Unggah
                                            Excel<span id="nameFileExcel" class="text-dark font-weight-bold ml-3"></span></label>
                                        <input class="d-none" type="file" name="excel" id="fileExcel" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                    </div>

                                    <div class="col-md-12 my-3">
                                        <div action="/upload" class="dropzone needsclick" id="fotoSurvey">
                                            <div class="dz-message needsclick">
                                                Drop Gambar Survey di Sini
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-success mt-2 mb-1 text-white" style="font-size: 8pt; cursor: pointer;" id="btnSubmitBulk"><i class="fa fa-paper-plane"></i>
                                            Simpan</button>
                                        <div class="spinner-border" role="status" id="prosesSurveyBulk">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="alert alert-danger alert-dismissible fade show" id="pesanGagalSurveyBulk" style="font-size: 10pt" role="alert">
                                            <strong>Gagal!</strong> <span id="messageErrorBulk"></span>.
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="row">
                        <div class="col-md-6">
                            <span class="font-weight-bold" style="font-size: 13px">Arsip Lokasi </span>
                        </div>
                        <div class="col-md-6 text-right">
                            <span class="w-100 d-block font-weight-bold" style="font-size: 25px;"><span id="JumlahTitikSurvey">0</span></span>
                            {{-- <a href="/printSurvey" class="text-primary" style="
                        position: relative;
                        font-size: 13px;
                        cursor:pointer;
                        text-decoration: none;
                    "><i class="ri-download-cloud-line font-weight-bold"
                                    style="font-size: 20px;position: relative;top: 4px;"></i> Unduh Pdf </a> --}}
                            {{-- NONAKTIF --}}
                            {{-- <div class="d-block text-right">
                                <select class="w-75" style="font-size:10pt" id="opsiKelurahanSurvey" onchange="getDataSurvey('{{ Auth::user()->id }}', $(this).val())">

                            </select>
                        </div> --}}
                        <a href="/printSurveyExcel" class="text-primary" style="
                        position: relative;
                        font-size: 13px;
                        cursor:pointer;
                        text-decoration: none;
                    "><i class="ri-download-cloud-line font-weight-bold" style="font-size: 20px;position: relative;top: 4px;"></i> Unduh Arsip</a>
                    </div>
                </div>
                <p align="center" id="messageNoDataSurvey" class="mt-5">Tidak Ada Arsip Lokasi</p>
                <div class="list-item-info-location-survey mt-2">

                </div>
            </div>
        </div>
    </div>

    {{-- NONAKTIF --}}
    {{-- @if(Auth::user()->email !== 'guest@dpmptsp-dki.com') --}}
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
    {{-- @endif --}}

    {{-- NONAKTIF --}}

    {{-- @if (Auth::user()->email !== 'guest@dpmptsp-dki.com') --}}
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
    {{-- @endif --}}

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

    <div class="info-pra-permohonan">
        <div class="container p-4">
            <button type="button" class="close" id="closePraPermohonan" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <span style="font-size: 13pt" class="title-info font-weight-bold">Pengajuan PraPermohonan</span>
            <div class="mt-4">

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist" style="font-size: 12px;">
                        <a class="nav-item nav-link active" id="pemilik-pemohon-tab" data-toggle="tab" href="#pemilik-pemohon" role="tab" aria-controls="pemilik-pemohon" aria-selected="true">Pemohon/Pemilik</a>
                        <a class="nav-item nav-link" id="bangunan-tab" data-toggle="tab" href="#bangunan" role="tab" aria-controls="bangunan" aria-selected="false">Bangunan</a>
                        <a class="nav-item nav-link" id="kbli-praper-tab" data-toggle="tab" href="#kbli-praper" role="tab" aria-controls="kbli" aria-selected="false">KBLI</a>
                        <a class="nav-item nav-link" id="lokasi-kegiatan-tab" data-toggle="tab" href="#lokasi-kegiatan" role="tab" aria-controls="lokasi-kegiatan" aria-selected="false">Lokasi/Kegiatan</a>
                        <a class="nav-item nav-link" id="dokumen-tab" data-toggle="tab" href="#dokumen" role="tab" aria-controls="dokumen" aria-selected="false">Dokumen</a>
                        <a class="nav-item nav-link" id="lacak-berkas-tab" data-toggle="tab" href="#lacak-berkas" role="tab" aria-controls="lacak-berkas" aria-selected="false">Lacak Berkas</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="pemilik-pemohon" role="tabpanel" aria-labelledby="pemilik-pemohon-tab">
                        <form action="" id="formPraPermohonan">
                            <div class="row mt-3">
                                <div class="col-md-5">
                                    <label style="font-size: 13px; line-height:0px">Nama Pemohon <sup class="text-danger font-weight-bold">*</sup></label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="pemohon_nama" class="w-100" style="font-size: 13px; line-height:0px">
                                </div>
                                <div class="col-md-5">
                                    <label style="font-size: 13px; line-height:0px">Nomor Identitas <sup class="text-danger font-weight-bold">*</sup></label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="pemohon_nik" class="w-100" style="font-size: 13px; line-height:0px">
                                </div>
                                <div class="col-md-5">
                                    <label style="font-size: 13px; line-height:0px">Alamat <sup class="text-danger font-weight-bold">*</sup></label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="pemohon_alamat" class="w-100" style="font-size: 13px; line-height:0px">
                                </div>
                                <div class="col-md-5">
                                    <label style="font-size: 13px; line-height:0px">Jabatan <sup class="text-danger font-weight-bold">*</sup></label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="pemohon_jabatan" class="w-100" style="font-size: 13px; line-height:0px">
                                </div>
                                <div class="col-md-5">
                                    <label style="font-size: 13px; line-height:0px">Nama Lengkap <sup class="text-danger font-weight-bold">*</sup></label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="pemilik_nama" class="w-100" style="font-size: 13px; line-height:0px">
                                </div>
                                <div class="col-md-5">
                                    <label style="font-size: 13px; line-height:0">NIB <sup class="text-danger font-weight-bold">*</sup></label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="nib" class="w-100" style="font-size: 13px; line-height:0px">
                                </div>
                                <div class="col-md-5">
                                    <label style="font-size: 13px; line-height:0">Nomor Telepon <sup class="text-danger font-weight-bold">*</sup></label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="pemilik_telp" class="w-100" style="font-size: 13px; line-height:0px">
                                </div>
                                <div class="col-md-5">
                                    <label style="font-size: 13px; line-height:0px">Nomor Identitas <sup class="text-danger font-weight-bold">*</sup></label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="pemilik_nik" class="w-100" style="font-size: 13px; line-height:0px">
                                </div>
                                <div class="col-md-5">
                                    <label style="font-size: 13px; line-height:0">NPWP<sup class="text-danger font-weight-bold">*</sup></label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="pemilik_npwp" class="w-100" style="font-size: 13px; line-height:0px">
                                </div>
                                <div class="col-md-5">
                                    <label style="font-size: 13px; line-height:0px">Alamat Pemilik <sup class="text-danger font-weight-bold">*</sup></label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="pemilik_alamat" class="w-100" style="font-size: 13px; line-height:0px">
                                </div>
                                <div class="col-md-5">
                                    <label style="font-size: 13px; line-height:0px">Alamat Email <sup class="text-danger font-weight-bold">*</sup></label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="pemilik_email" class="w-100" style="font-size: 13px; line-height:0px">
                                </div>
                            </div>
                    </div>
                    <div class="tab-pane fade" id="bangunan" role="tabpanel" aria-labelledby="bangunan-tab">
                        <div class="row mt-3">
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Nama Bangunan <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="bangunan_nama" class="w-100" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Jenis Bangunan <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <select type="text" name="bangunan_jenis" class="w-100" style="font-size: 13px; line-height:0px">
                                    <option value="hunian">Hunian</option>
                                    <option value="non-hunian">Non Hunian</option>
                                    <option value="campuran">Usaha Jenis Bangunan (Campuran)</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Fungsi Bangunan <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7 inf-prapermohonan-fungsi-bangunan">
                                <input type="text" name="bangunan_fungsi" class="w-100" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Lembaga Pengelola <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="ipb_nama_perusahaan" class="w-100" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">NPWP <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="ipb_npwp" class="w-100" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">NIB <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="ipb_nib" class="w-100" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Alamat <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="ipb_alamat" class="w-100" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Handphone <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="ipb_telpon" class="w-100" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Alamat Email <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="ipb_email" class="w-100" style="font-size: 13px; line-height:0px">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="kbli-praper" role="tabpanel" aria-labelledby="kbli-praper-tab">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-sm text-primary" style="font-size: 13px;" id="tambah-kbli-praper" onclick="kbli_list()"><i class="fa fa-plus"></i> Tambah
                                    KBLI</button>
                            </div>
                            <div class="col-md-12 inf-praper-list-kbli">
                                <div class="row mb-3">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-sm text-danger" style="font-size: 13px;" onclick="remove_kbli(this.parentNode.parentNode)"><i class="fa fa-trash"></i></button>
                                    </div>
                                    <div class="col-md-5">
                                        <label style="font-size: 13px; line-height:0px">Kode KBLI </label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="number" name="kbli_kode[]" class="w-100" style="font-size: 13px; line-height:0px">
                                    </div>
                                    <div class="col-md-5">
                                        <label style="font-size: 13px; line-height:0px">Kegiatan </label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="kbli_kegiatan[]" class="w-100" style="font-size: 13px; line-height:0px">
                                    </div>
                                    <div class="col-md-5">
                                        <label style="font-size: 13px; line-height:0px">Resiko </label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="kbli_kegiatan[]" class="w-100" style="font-size: 13px; line-height:0px">
                                    </div>
                                    <div class="col-md-5">
                                        <label style="font-size: 13px; line-height:0px">Sektor </label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="kbli_sektor[]" class="w-100" style="font-size: 13px; line-height:0px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="lokasi-kegiatan" role="tabpanel" aria-labelledby="lokasi-kegiatan-tab">
                        <div class="row mt-3">
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Alamat <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="lokasi_alamat" class="w-100" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Kelurahan <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="lokasi_kelurahan" class="w-100" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Kecamatan <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="lokasi_kecamatan" class="w-100" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Kota <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="lokasi_kota" class="w-100" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Kondisi Lokasi <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="lokasi_kondisi" class="w-100" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Jumlah Sertifikat <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="lokasi_jumlah_sertifikat" class="w-100" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Luas <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="lokasi_luas" class="w-100" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Jenis Kegiatan <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="jenis_kegiatan" class="w-100" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">No IRK <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="no_irk" class="w-100" style="font-size: 13px; line-height:0px">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:1">Status Investasi<sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <select type="text" name="status_penanaman_modal" class="w-100" style="font-size: 13px; line-height:0px">
                                    <option value="PMA">PMA</option>
                                    <option value="PMDN">PMDN</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="dokumen" role="tabpanel" aria-labelledby="dokumen-tab">
                        <div class="row mt-3">
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">IRK <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7" style="font-size: 13px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="irk" id="irk1" value="Ada" checked>
                                    <label class="form-check-label" for="irk1">Ada</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="irk" id="irk2" value="Tidak Ada">
                                    <label class="form-check-label" for="irk2">Tidak Ada</label>
                                </div>
                            </div>
                            <div class="col-md-12 inf-praper-list-file-irk">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-sm text-primary" style="font-size: 13px;" id="tambah-irk-praper" onclick="irk_list()"><i class="fa fa-plus"></i>
                                            Tambah
                                            Berkas IRK</button>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-sm text-danger" style="font-size: 13px;" onclick="remove_irk(this.parentNode.parentNode)"><i class="fa fa-trash"></i></button>
                                    </div>
                                    <div class="col-md-5">
                                        <label style="font-size: 13px; line-height:0px">Berkas IRK <sup class="text-danger font-weight-bold">*</sup></label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="file" name="dokumen_url_dokumen_irk[]" class="w-100" style="font-size: 13px;">
                                    </div>
                                    <div class="col-md-5">
                                        <label style="font-size: 13px; line-height:0px">Nomor <sup class="text-danger font-weight-bold">*</sup></label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="dokumen_nomor[]" class="w-100" style="font-size: 13px; line-height:0px">
                                    </div>
                                    <div class="col-md-5">
                                        <label style="font-size: 13px; line-height:0px">Nama <sup class="text-danger font-weight-bold">*</sup></label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="dokumen_nama[]" class="w-100" style="font-size: 13px; line-height:0px">
                                    </div>
                                    <div class="col-md-5">
                                        <label style="font-size: 13px; line-height:0px">Tanggal <sup class="text-danger font-weight-bold">*</sup></label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="dokumen_tanggal[]" class="w-100" style="font-size: 13px; line-height:0px">
                                    </div>
                                    <div class="col-md-5">
                                        <label style="font-size: 13px; line-height:0px">Luas Tanah <sup class="text-danger font-weight-bold">*</sup></label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="dokumen_luas_tanah[]" class="w-100" style="font-size: 13px; line-height:0px">
                                    </div>
                                    <div class="col-md-5">
                                        <label style="font-size: 13px; line-height:0px">Atas Nama <sup class="text-danger font-weight-bold">*</sup></label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="dokumen_atas_nama[]" class="w-100" style="font-size: 13px; line-height:0px">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Berkas Pernyataan <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="file" name="url_dokumen_pernyataan" class="w-100" style="font-size: 13px;">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Akta Pendirian <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="file" name="url_akta_pendirian" class="w-100" style="font-size: 13px; ">
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:0px">Akta Pengesahan <sup class="text-danger font-weight-bold">*</sup></label>
                            </div>
                            <div class="col-md-7">
                                <input type="file" name="url_akta_pengesahan" class="w-100" style="font-size: 13px; ">
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="submit" class="btn btn-success btn-sm" id="tambah_dokumen_praper" style="font-size: 8pt; cursor: pointer;"><i class="fa fa-paper-plane"></i> Kirim
                                    Data</button>
                                <div class="spinner-border mt-3" role="status" id="prosesPraper" style="display: none;">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="alert alert-success text-left mt-3" id="messagePraperSuccess" role="alert" style="font-size: 10pt; display:none;">
                                    <b>Berhasil!</b> <span>Permohonan Sedang di proses</span>
                                </div>
                                <div class="alert alert-danger text-left mt-3" id="messagePraperFailed" role="alert" style="font-size: 10pt; display:none;">
                                    <b>Gagal!</b> <span>Permohonan Gagal di proses</span>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="lacak-berkas" role="tabpanel" aria-labelledby="lacak-berkas-tab">
                        <form id="formLacakBerkas" method="post">
                            <div class="row mt-3">
                                <div class="col-md-5">
                                    <label style="font-size: 13px; line-height:1">NIK<sup class="text-danger font-weight-bold">*</sup></label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="nik_pemilik" id="irk_nik_pemilik" class="w-100" style="font-size: 13px; line-height:0px">
                                </div>
                                <div class="col-md-5">
                                    <label style="font-size: 13px; line-height:1">No Hp<sup class="text-danger font-weight-bold">*</sup></label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="telp_pemilik" id="irk_telp_pemilik" class="w-100" style="font-size: 13px; line-height:0px">
                                </div>
                                <div class="col-md-12 mt-2">
                                    <button type="submit" class="btn btn-success btn-sm" id="lacak_dokumen_praper" style="font-size: 8pt; cursor: pointer;"><i class="fa fa-paper-plane"></i>
                                        Lacak
                                        Berkas</button>
                                    <div class="spinner-border mt-3" role="status" id="prosesLacakPraper" style="display: none;">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>

                            <p class="text_all font-weight-bold mt-4" style="font-size:15px;">Daftar Berkas</p>
                            <div class="inf-praper-list-lacak-berkas">

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    {{-- NONAKTIF --}}

    {{-- @if (Auth::user()->email !== 'guest@dpmptsp-dki.com') --}}
    <div class="info-print-data">
        <div class="container p-4">
            <button type="button" class="close" id="closePrintData" onclick="close_print()" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <span style="font-size: 13pt" class="title-info font-weight-bold">Cetak</span>
            <div class="mt-4">
                <p class="card-title  mt-2 text-center font-weight-bold judul_utama">Opsi Cetak</p>
                <div class="alert alert-danger alert-dismissible fade show" id="pesanGagalPrint" style="font-size: 10pt" role="alert">
                    <strong>Gagal!</strong> Anda Harus Memilih Salah Satu.
                </div>

                <div class="ml-3">
                    <form action="https://api.pintoinvest.com/print" method="POST" target="_blank" id="formPrint">
                        <span class="text_all font-weight-bold">Persil</span>
                        <div class="form-check text_all">
                            <input class="form-check-input position-static" type="checkbox" name="kategori[]" id="checkboxProfil" value="profil" aria-label="..."> Profil
                        </div>
                        <div class="form-check text_all">
                            <input class="form-check-input position-static" type="checkbox" onchange="checkBoxPrint('kbli', $(this))" name="kategori[]" id="checkboxKBLI" value="kbli" aria-label="..."> KBLI
                        </div>
                        <div class="form-check text_all">
                            <input class="form-check-input position-static" type="checkbox" name="kategori[]" id="checkboxKetentuan" value="ketentuan" aria-label="...">
                            Ketentuan
                        </div>
                        <br>
                        <span class="text_all font-weight-bold">Kawasan</span>
                        <div class="form-check text_all">
                            <input class="form-check-input position-static" type="checkbox" name="kategori[]" id="checkboxAkses" value="akses" aria-label="..."> Sarpras
                        </div>
                        <div class="form-check text_all">
                            <input class="form-check-input position-static" type="checkbox" name="kategori[]" id="checkboxIndikator" value="indikator" aria-label="..."> Indikator
                        </div>
                        <div class="form-check text_all">
                            <input class="form-check-input position-static" type="checkbox" onchange="checkBoxPrint('lingkungan', $(this))" name="kategori[]" id="checkboxLingkungan" value="lingkungan" aria-label="...">
                            Lingkungan
                        </div>
                        <div class="form-check text_all">
                            <input class="form-check-input position-static" type="checkbox" name="kategori[]" id="checkboxPotensi" value="potensi" aria-label="..."> Potensi
                        </div>
                        <br>
                        <span class="text_all font-weight-bold">Format Cetak</span><br>
                        <div class="form-check text_all form-check-inline">
                            <input class="form-check-input" type="radio" name="format" value="word">
                            <label class="form-check-label">MS Word (*.docx)</label>
                        </div>
                        <div class="form-check text_all form-check-inline">
                            <input class="form-check-input" type="radio" name="format" value="pdf" checked>
                            <label class="form-check-label">PDF</label>
                        </div>
                        <div class="hidden-data">
                            <input type="hidden" name="image_map">
                            <input type="hidden" name="coordinates_print">
                            <input type="hidden" name="radius">
                            <input type="hidden" name="kbli_properties">
                            <input type="hidden" name="ketentuan_properties">
                            <input type="hidden" name="potensi_properties">
                            <input type="hidden" name="lingkungan_properties">
                        </div>
                        <center>
                            <a class="btn btn-sm text_all mt-3 btn-primary text-white" id="printAll" style="margin-right: 2.5rem;cursor:pointer;">Cetak</a>
                        </center>
                    </form>




                    <!-- <p style="font-size: 14px;" class="card-title  text-center font-weight-bold mt-2">Keterangan</p> -->
                </div>
            </div>
        </div>
    </div>
    {{-- @endif --}}
    <div class="pembungkus " id="sidebar" style="display: none;">
        <div class="dalam">

            <!-- Judul -->
            <div class="kotak_judul for_web px-2 pt-3">

                <div class="row px-3">
                    <div class="col-md-12">
                        <img src="{{ asset('assets/gambar/logo-invest-utama.png') }}" alt="" class="img-fluid">
                    </div>
                </div>

            </div>
            <!-- End Judul -->

            <div class="card-body color_card_body">

                <!-- Search -->
                <div class="search_mobile">

                    <!-- row dihapus/ yg tampilan web jd gaa responsive -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <!-- Search Mobile -->

                            <div class="tempat_search for_mobile fixed-top searchh">
                                <div class="search_box">
                                    <span class="menu">

                                        <button class="btn btn-lg tombol_search border-0 borderdropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                        </button>

                                        <!-- silent dropdown -->
                                        <div class="dropdown-menu w_checkbox_dropdown_mobile" aria-labelledby="dropdownMenuButton">

                                            <img src="./assets/gambar/logo_jakpintas.png" width="60px" class="ml-4 img-fluid" alt="Responsive image">

                                            <div class="layout_checkbox_mobile">

                                                <div class="form-check">

                                                    <ul class="list-group list-group-flush">
                                                        <li class="listgroup-cust d-flex justify-content-between align-items-center text_all">
                                                            <input type="checkbox" class="form-check-input" id="checkbox1">
                                                            <label class="form-check-label checkbox_left text_checkbox text_all" for="checkbox1">Wilayah</label>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="form-check">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="listgroup-cust d-flex justify-content-between align-items-center text_all">
                                                            <input type="checkbox" class="form-check-input" id="checkbox2">
                                                            <label class="form-check-label checkbox_left text_checkbox text_all" for="checkbox2">Total Omzet Per Kelurahan</label>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="form-check">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="listgroup-cust d-flex justify-content-between align-items-center text_all">
                                                            <input type="checkbox" class="form-check-input" id="checkbox3">
                                                            <label class="form-check-label checkbox_left text_checkbox text_all" for="checkbox3">Rencana Kota</label>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="form-check">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="listgroup-cust d-flex justify-content-between align-items-center text_all">
                                                            <input type="checkbox" class="form-check-input" id="checkbox4">
                                                            <label class="form-check-label checkbox_left text_checkbox text_all" for="checkbox4">Sebaran Usaha Mikro Kecil</label>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="form-check mb-2">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="listgroup-cust d-flex justify-content-between align-items-center text_all">
                                                            <input type="checkbox" class="form-check-input" id="checkbox4">
                                                            <label class="form-check-label checkbox_left text_checkbox text_all" for="checkbox4">Harga Sewa Kantor</label>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <hr>
                                            </div>


                                            <div class="kotak_sidebar">


                                                <span class="material-icons iconn_kotak_sidebar">
                                                    post_add
                                                </span>
                                                <div> <a href="#" title="Buat File" class="text_all_kotak_sidebarr">Buat
                                                        File</a></div>

                                                <span class="material-icons iconn_kotak_sidebar">
                                                    contact_support
                                                </span>
                                                <div>
                                                    <a href="#" title="Buat File" class="text_all_kotak_sidebarr">Konsultasi</a>
                                                </div>

                                                <span class="material-icons iconn_kotak_sidebar">
                                                    chat
                                                </span>
                                                <div> <a href="#" title="Buat File" class="text_all_kotak_sidebarr">Pesan AJIB</a></div>

                                                <span class="material-icons iconn_kotak_sidebar">
                                                    miscellaneous_services
                                                </span>
                                                <div> <a href="#" title="Buat File" class="text_all_kotak_sidebarr">Jakevo</a></div>

                                                <span style="color: #007bff;" class="material-icons iconn_kotak_sidebar">
                                                    mail
                                                </span>
                                                <div> <a href="#" title="Buat File" class="text_all_kotak_sidebarr">OSS</a></div>

                                                <span class="material-icons iconn_kotak_sidebar">
                                                    corporate_fare
                                                </span>
                                                <div> <a href="#" title="Buat File" class="text_all_kotak_sidebarr">SIMBG</a></div>

                                                <span class="material-icons iconn_kotak_sidebar">
                                                    drafts
                                                </span>
                                                <div> <a href="#" title="Buat File" class="text_all_kotak_sidebarr">PraPermohonan(IRK/KKPR)</a>
                                                </div>

                                                <span class="material-icons iconn_kotak_sidebar">
                                                    connect_without_contact
                                                </span>
                                                <div> <a href="#" title="Buat File" class="text_all_kotak_sidebarr">JakartaSatu</a></div>

                                                <span class="material-icons iconn_kotak_sidebar">
                                                    center_focus_weak
                                                </span>
                                                <div> <a href="#" title="Buat File" class="text_all_kotak_sidebarr">IRK</a></div>




                                            </div>

                                        </div>
                                    </span>

                                    <input type="text" class="input" placeholder="Cari kelurahan disini...">

                                    <span class="btn-search">
                                        <i class="ri-user-fill"></i>
                                    </span>

                                </div>
                            </div>

                            <!-- End Search Mobile -->

                            <!-- Search Web -->
                            <div class="for_web input-group input-group-md mb-1">
                                <input type="search" id="cari_wilayah" class="form-control tombol_search py-2 border-right-0 border" placeholder="Cari nama tempat ..." autocomplete="off">


                                <!-- Ori -->
                                <div class="wm-search__dropdown">
                                    <ul class="wm-search__dropdown" role="listbox"></ul>
                                </div>

                                <!-- Dummy -->
                                <ul class="wm-search__dropdown" role="listbox">

                                </ul>


                                <span class="input-group-append">
                                    <button class="btn btn-secondary tombol_search border-left-0 border" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    {{-- <button class="btn tombol_search border-left-0 border" type="button"
                                            id="polygonDraw">
                                            <i class="ri-shape-line"></i>
                                            <span class="bg-danger p-1 rounded text-white" style="font-size: 8px;margin-top: -1rem;
                                            position: absolute;">BETA</span>
                                        </button> --}}
                                </span>
                            </div>
                            <!-- End Search Web -->

                        </div>

                    </div>
                </div>


                <!-- Checkbox -->
                <div class="layout_checkbox for_web" id="menus">


                    {{-- <div class="form-check wilayah_fill" style="display: none;"><input id="wilayah_fill"
                                name="wilayah_fill" disabled="true" class="form-check-input mt-1" type="checkbox"><label
                                for="wilayah_fill" class="form-check-label text_all">Wilayah</label></div>
                        <div class="form-check zoning_fill"><input id="zoning_fill" name="zoning_fill"
                                class="form-check-input mt-1" type="checkbox"><label for="zoning_fill"
                                class="form-check-label text_all">Peta Zonasi</label></div>
                        <div class="form-check investasi_fill"><input id="investasi_fill" name="investasi_fill"
                                class="form-check-input mt-1" type="checkbox"><label for="investasi_fill"
                                class="form-check-label text_all">Proyek Potensial</label></div>
                        <div class="form-check sewa_fill"><input id="sewa_fill" name="sewa_fill"
                                class="form-check-input mt-1" type="checkbox"><label for="sewa_fill"
                                class="form-check-label text_all">Harga Sewa Kantor</label></div>
                        <div class="form-check wilayahindex_fill"><input id="wilayahindex_fill" name="wilayahindex_fill"
                                class="form-check-input mt-1" type="checkbox"><label for="wilayahindex_fill"
                                class="form-check-label text_all">Total Omzet Usaha Mikro Kecil</label></div>
                        <div class="form-check iumk_fill"><input id="iumk_fill" name="iumk_fill"
                                class="form-check-input mt-1" type="checkbox"><label for="iumk_fill"
                                class="form-check-label text_all">Sebaran Usaha Mikro Kecil</label></div>
                        <div class="form-check investasi_dot" style="display: none;"><input id="investasi_dot"
                                name="investasi_dot" class="form-check-input mt-1" type="checkbox"><label
                                for="investasi_dot" class="form-check-label text_all">Investasi2</label></div>
                        <div class="form-check investasi_line" style="display: none;"><input id="investasi_line"
                                name="investasi_line" class="form-check-input mt-1" type="checkbox"><label
                                for="investasi_line" class="form-check-label text_all">Investasi3</label></div> --}}

                    <div class="form-check zoning_fill mt-1">
                        <input type="checkbox" class="form-check-input" id="rdtr" checked>
                        <label class="form-check-label  text_all" for="zoning_fill">Zonasi</label><br>

                        <div class="form-check form-check-inline zoning_fill mt-1">
                            <input type="radio" name="rdtr" class="form-check-input" id="zoning_old_fill">
                            <label class="form-check-label  text_all" for="zoning_fill">Perda 1/2014</label>
                        </div>

                        <div class="form-check form-check-inline zoning_fill mt-1">
                            <input type="radio" name="rdtr" class="form-check-input" id="zoning_fill" checked>
                            <label class="form-check-label  text_all" for="zoning_fill">Pergub 31/2022</label>
                        </div>

                    </div>

                    <div class="form-check zoning_label mt-1 d-none">
                        <input type="checkbox" class="form-check-input" id="zoning_label" checked>
                        <label class="form-check-label  text_all" for="zoning_label">zoning</label>
                    </div>

                    <div class="form-check wilayahindex_fill mt-1 d-none">
                        <input type="checkbox" class="form-check-input" id="wilayahindex_fill">
                        <label class="form-check-label  text_all" for="wilayahindex_fill">Filter Data
                            Interaktif <sup class="text-danger">BETA</sup></label>
                    </div>

                    <div class="form-check wilayah_fill mt-1 d-none">
                        <input type="checkbox" class="form-check-input" id="wilayah_fill" checked>
                        <label class="form-check-label  text_all" for="wilayah_fill">Wilayah</label>
                    </div>


                    <div class="form-check zoning_old_label mt-1 d-none">
                        <input type="checkbox" class="form-check-input" id="zoning_old_label" checked>
                        <label class="form-check-label  text_all" for="zoning_old_label">zoning_old</label>
                    </div>

                    {{--
                        <div class="form-check pipa_multilinestring">
                            <input type="checkbox" class="form-check-input" id="pipa_multilinestring"
                                onchange="getDataSource('pipa', localStorage.getItem('kelurahan'))">
                            <label class="form-check-label  text_all" for="pipa_multilinestring">Jaringan Pipa
                                PDAM</label>
                        </div> --}}

                    <div class="form-check rw_fill mt-1">
                        <input type="checkbox" class="form-check-input" id="rw_fill" onchange="getDataSource('rw', localStorage.getItem('kelurahan'))">
                        <label class="form-check-label  text_all" for="rw_fill">Batas RW</label>
                    </div>

                    {{-- <div class="form-check tol_multilinestring mt-1">
                            <input type="checkbox" class="form-check-input" id="tol_multilinestring">
                            <label class="form-check-label  text_all" for="tol_multilinestring">Jalur Tol</label>
                        </div> --}}

                    {{--
                        <div class="form-check transportasi_multilinestring mt-1">
                            <input type="checkbox" class="form-check-input" id="transportasi_multilinestring"
                                onchange="getDataSource('transportasi', localStorage.getItem('kelurahan'))">
                            <label class="form-check-label  text_all" for="transportasi_multilinestring">Jaringan
                                Transportasi Massal</label>
                        </div> --}}

                    {{-- <div class="form-check sungai_multilinestring mt-1">
                            <input type="checkbox" class="form-check-input" id="sungai_multilinestring"
                                onchange="getDataSource('sungai', localStorage.getItem('kelurahan'))">
                            <label class="form-check-label  text_all" for="sungai_multilinestring">Aliran Sungai</label>
                        </div> --}}

                    <div class="form-check gsb_nol_multilinestring mt-1 d-none">
                        <input type="checkbox" class="form-check-input" id="gsb_nol_multilinestring" onchange="getDataSource('gsb_nol', localStorage.getItem('kelurahan'))" checked>
                        <label class="form-check-label  text_all" for="gsb_nol_multilinestring">GSB Nol</label>
                    </div>


                    {{-- <div class="form-z mt-3">
                            <label class="form-check-label font-weight-bold  text_all" for="">Transect Zone (Model
                                <i>Deep
                                    Learning</i>) </label>
                        </div> --}}

                    <div class="form-check analisa_gis mt-1">
                        <input type="checkbox" class="form-check-input" id="analisa_gis_fill" onchange="getDataSource('analisa_gis', localStorage.getItem('kelurahan'))">
                        <label class="form-check-label  text_all" for="analisa_gis">Analisis GIS <sup class="text-danger">BETA</sup></label><br>

                        <div class="form-check form-check-inline analisa_gis_fill mt-1">
                            <input type="radio" name="analisa_gis" value="knvperda1-colorc" class="form-check-input analisa_gis_fill" disabled checked>
                            <label class="form-check-label  text_all">Perda 1/2014</label>
                        </div>
                        <div class="form-check form-check-inline analisa_gis_fill mt-1">
                            <input type="radio" name="analisa_gis" value="knvprgb31a-colora" class="form-check-input analisa_gis_fill" disabled checked>
                            <label class="form-check-label  text_all">Pergub 31 Terkendali</label>
                        </div>
                        <div class="form-check form-check-inline analisa_gis_fill mt-1">
                            <input type="radio" name="analisa_gis" value="knvprgb31b-colorb" class="form-check-input analisa_gis_fill" disabled>
                            <label class="form-check-label  text_all">Pergub 31 Maksimum</label>
                        </div>
                    </div>

                    <div class="form-z mt-3">
                        <label class="form-check-label font-weight-bold  text_all" for="">Kepulauan Seribu </label>
                    </div>
                    <div class="form-check garis_kepulauan_multilinestring mt-1">
                        <input type="checkbox" class="form-check-input" id="garis_kepulauan_multilinestring" onchange="getDataSource('garis_kepulauan', localStorage.getItem('kelurahan'))">
                        <label class="form-check-label  text_all" for="garis_kepulauan_multilinestring">Garis
                            Kepulauan</label>
                    </div>
                    <div class="form-check area_kepulauan_fill mt-1">
                        <input type="checkbox" class="form-check-input" id="area_kepulauan_fill" onchange="getDataSource('area_kepulauan', localStorage.getItem('kelurahan'))">
                        <label class="form-check-label  text_all" for="area_kepulauan_fill">Area
                            Kepulauan</label>
                    </div>
                    <div class="form-check kawasan_khusus_fill mt-1">
                        <input type="checkbox" class="form-check-input" id="kawasan_khusus_fill" onchange="getDataSource('kawasan_khusus', localStorage.getItem('kelurahan'))">
                        <label class="form-check-label  text_all" for="kawasan_khusus_fill">Kawasan Khusus</label>
                    </div>
                    <div class="form-check batas_laut_fill mt-1">
                        <input type="checkbox" class="form-check-input" id="batas_laut_fill" onchange="getDataSource('batas_laut', localStorage.getItem('kelurahan'))">
                        <label class="form-check-label  text_all" for="batas_laut_fill">Batas Laut</label>
                    </div>
                    <div class="form-check sarana_prasarana_dot mt-1">
                        <input type="checkbox" class="form-check-input" id="sarana_prasarana_dot" onchange="getDataSource('sarana_prasarana', localStorage.getItem('kelurahan'))">
                        <label class="form-check-label  text_all" for="sarana_prasarana_dot">Obyek Laut</label>

                    </div>
                    {{-- <div class="form-check kontur_fill mt-1">
                            <input type="checkbox" class="form-check-input" id="kontur_fill"
                                onchange="getDataSource('kontur', localStorage.getItem('kelurahan'))">
                            <label class="form-check-label  text_all" for="kontur_fill">Kontur Tanah</label>
                        </div> --}}

                    {{-- <div class="form-check badan_jalan_fill mt-1">
                            <input type="checkbox" class="form-check-input" id="badan_jalan_fill">
                            <label class="form-check-label  text_all" for="badan_jalan_fill">Badan Jalan</label>
                        </div> --}}

                    {{-- <div class="form-check ipal_dot mt-1">
                            <input type="checkbox" class="form-check-input" id="ipal_dot">
                            <label class="form-check-label  text_all" for="ipal_dot">Pembuangan Air Limbah</label>
                        </div> --}}

                    {{-- <div class="form-check util_multilinestring mt-1">
                            <input type="checkbox" class="form-check-input" id="util_multilinestring">
                            <label class="form-check-label  text_all" for="util_multilinestring">Jaringan Pipa
                                Utilitas</label>
                        </div> --}}

                    {{-- <div class="form-check phb_multilinestring mt-1">
                            <input type="checkbox" class="form-check-input" id="phb_multilinestring">
                            <label class="form-check-label  text_all" for="phb_multilinestring">Jaringan Saluran
                                Penghubung</label>
                        </div> --}}

                    {{-- <div class="form-check banjir_fill mt-1">

                            <input type="checkbox" class="form-check-input" id="banjir_fill"
                                onchange="getDataSource('banjir', localStorage.getItem('kelurahan'))">
                            <label class="form-check-label text_all" for="banjir_fill">Terdampak
                                Banjir <span class="font_range_input" id="tahunBanjir">2015</span></label>
                            <input type="range" style="height: 6px;" class="form-control-range mt-3 w-75"
                                id="ControlTahunBanjir" min="2015" max="2020" step="1" value="2015">
                        </div> --}}

                    <div class="form-check sewa_fill d-none">
                        <ul class="list-group list-group-flush">
                            <li class="listgroup-cust d-flex justify-content-between align-items-center text_all">
                                <input type="radio" name="layer" class="form-check-input" id="sewa_fill" onchange="getDataSource('sewa', localStorage.getItem('kelurahan'))">
                                <label class="form-check-label  text_all" for="sewa_fill">Harga Sewa Kantor</label>
                            </li>
                        </ul>
                    </div>
                    <div class="form-check iumk_fill d-none">
                        <ul class="list-group list-group-flush">
                            <li class="listgroup-cust d-flex justify-content-between align-items-center text_all">
                                <input type="radio" name="layer" class="form-check-input" id="iumk_fill" onchange="getDataSource('iumk', localStorage.getItem('kelurahan'))">
                                <label class="form-check-label checkbox_left text_checkbox text_all" for="iumk_fill">Sebaran Usaha Mikro Kecil</label>
                            </li>
                        </ul>
                    </div>
                    <div class="form-check nib_dot d-none">
                        <ul class="list-group list-group-flush">
                            <li class="listgroup-cust d-flex justify-content-between align-items-center text_all">
                                <input type="radio" name="layer" class="form-check-input" id="nib_dot" onchange="getDataSource('nib', localStorage.getItem('kelurahan'))">
                                <label class="form-check-label checkbox_left text_checkbox text_all" for="nib_dot">Sebaran NIB</label>
                            </li>
                        </ul>
                    </div>
                    <div class="form-check iprt_dot d-none">
                        <ul class="list-group list-group-flush">
                            <li class="listgroup-cust d-flex justify-content-between align-items-center text_all">
                                <input type="radio" name="layer" class="form-check-input" id="iprt_dot" onchange="getDataSource('iprt', localStorage.getItem('kelurahan'))">
                                <label class="form-check-label checkbox_left text_checkbox text_all" for="iprt_dot">Sebaran NIB</label>
                            </li>
                        </ul>
                    </div>
                    <div class="form-check budaya_dot d-none">
                        <ul class="list-group list-group-flush">
                            <li class="listgroup-cust d-flex justify-content-between align-items-center text_all">
                                <input type="radio" name="layer" class="form-check-input" id="budaya_dot" onchange="getDataSource('budaya', localStorage.getItem('kelurahan'))">
                                <label class="form-check-label checkbox_left text_checkbox text_all" for="budaya_dot">Cagar Budaya</label>
                            </li>
                        </ul>
                    </div>
                    <div class="form-check survey_dot d-none">
                        <ul class="list-group list-group-flush">
                            <li class="listgroup-cust d-flex justify-content-between align-items-center text_all">
                                <input type="radio" name="layer" class="form-check-input" id="survey_dot" onchange="getDataSource('survey', localStorage.getItem('kelurahan'))">
                                <label class="form-check-label checkbox_left text_checkbox text_all" for="survey_dot">Survey Perkembangan</label>
                            </li>
                        </ul>
                    </div>
                    <div class="form-check investasi_fill d-none">
                        <ul class="list-group list-group-flush">
                            <li class="listgroup-cust d-flex justify-content-between align-items-center text_all">
                                <input type="radio" name="layer" class="form-check-input" id="investasi_fill">
                                <label class="form-check-label checkbox_left text_checkbox text_all" for="investasi_fill">Proyek</label>
                            </li>
                        </ul>
                    </div>
                    <div class="form-check investasi_dot d-none">
                        <ul class="list-group list-group-flush">
                            <li class="listgroup-cust d-flex justify-content-between align-items-center text_all">
                                <input type="checkbox" class="form-check-input" id="investasi_dot" onchange="getDataSource('investasi', localStorage.getItem('kelurahan'))">
                                <label class="form-check-label checkbox_left text_checkbox text_all" for="investasi_dot">Proyek</label>
                            </li>
                        </ul>
                    </div>
                    <div class="form-check investasi_line d-none">
                        <ul class="list-group list-group-flush">
                            <li class="listgroup-cust d-flex justify-content-between align-items-center text_all">
                                <input type="checkbox" class="form-check-input" id="investasi_line">
                                <label class="form-check-label checkbox_left text_checkbox text_all" for="investasi_line">Proyek</label>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- End Checkbox -->


                <!-- Range Inputs -->

                <!-- End Range Inputs -->


                <!-- Bahasa -->
                {{-- <div class="text-right text_all for_web margin_language">
                        <a href="#" title="Menggunakan Bahasa Indonesia">Bahasa</a> | <a href="en"
                            title="Menggunakan Bahasa Inggris">English</a>
                    </div> --}}
                <!-- End Bahasa-->


                <hr class="for_web">



                <!-- End Mengatur Menu Web -->


                <!-- Mengatur Menu Mobile -->
                <div class="container container_menu for_mobile">

                    <div style="margin-top: -6%;" class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path d="M5 11h14v2H5z" fill="rgba(211,211,211,1)" />
                        </svg>
                    </div>

                    <div class="flex_container">

                        <ul class="nav nav-pills" id="pills-tab" role="tablist">

                            <li class="col-xs-3 col-sm-3 col-md-3 col-lg-3 p-2 nav-item">
                                <a class="btn btn-outline-primary btn-md tombol_menu padding_icon_navpill" href="menu/lokasi.html" role="tab" aria-controls="pills-lokasi" aria-selected="true"><i class="fa fa-map-marker"></i></a>
                                <br>
                                <label class="size_menu size_menu_mobile">Lokasi</label>
                            </li>

                            <li class="col-xs-3 col-sm-3 col-md-3 col-lg-3 p-2 nav-item">
                                <a class=" btn btn-outline-primary btn-md tombol_menu padding_icon_navpill" href="menu/ekonomi.html" role="tab" aria-controls="pills-ekonomi" aria-selected="false"><i class="ri-funds-box-fill"></i></a>
                                <br>
                                <label class="size_menu size_menu_mobile">Ekonomi</label>
                            </li>

                            <li class="col-xs-3 col-sm-3 col-md-3 col-lg-3 p-2 nav-item">
                                <a class="btn btn-outline-primary btn-md tombol_menu padding_icon_navpill" href="menu/zonasi.html" role="tab" aria-controls="pills-zonasi" aria-selected="false"><i class="ri-map-2-fill"></i></a>
                                <br>
                                <label class="size_menu size_menu_mobile">Zonasi</label>
                            </li>

                            <li class="col-xs-3 col-sm-3 col-md-3 col-lg-3 p-2 nav-item">
                                <a class="btn btn-outline-primary btn-md tombol_menu padding_icon_navpill" href="menu/persil.html" role="tab" aria-controls="pills-persil" aria-selected="false"><i class="ri-home-4-fill"></i></a>
                                <br>
                                <label class="size_menu size_menu_mobile">Persil</label>
                            </li>

                            <li class="col-xs-3 col-sm-3 col-md-3 col-lg-3 p-2 nav-item">
                                <a class="btn btn-outline-primary btn-md tombol_menu padding_icon_navpill" href="menu/poi.html" role="tab" aria-controls="pills-poi" aria-selected="false"><i class="fa fa-crosshairs"></i></a>
                                <br>
                                <label class="size_menu size_menu_mobile">POI</label>
                            </li>

                            <li class="col-xs-3 col-sm-3 col-md-3 col-lg-3 p-2 nav-item">
                                <a class=" btn btn-outline-primary btn-md tombol_menu padding_icon_navpill" href="menu/kode-kbli.html" role="tab" aria-controls="pills-kblikeg" aria-selected="false"><i class="ri-user-search-fill"></i></a>
                                <br>
                                <label class="size_menu size_menu_mobile menu_kbli_top">Kode KBLI</label>
                            </li>

                            <!-- Pending menu pin-->

                        </ul>

                    </div>
                </div>
                <!-- End Mengatur Menu Mobile -->


                <hr class="for_web">

                <!-- Mengatur Isi Konten Menu Web -->
                <div class="tab-content for_web mb-5" id="pills-tabContent">

                    <div class="tab-pane active" id="pills-lokasi" role="tabpanel" aria-labelledby="lokasi-tab">
                        <div class="container" id="profil-print">
                            <div id="lokasi-print">
                                <p class="card-title mt-2 text-center font-weight-bold judul_utama">Lokasi</p>
                                <div class="d-flex space_judul row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Koordinat</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <p class="inf-kordinat">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Rt/Rw</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <p class="inf-rtrw">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Kelurahan</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <p class="inf-kelurahan">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Kecamatan</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <p class="inf-kecamatan">-</p>
                                    </div>
                                </div>


                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Wilayah</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <p class="inf-kota">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Luas</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <p class="inf-luasarea">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Kepadatan</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <p class="inf-kepadatan">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Rasio Gini</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <p class="inf-rasio">-</p>
                                    </div>
                                </div>
                            </div>


                            <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">Persil</p>
                            <div class="d-flex row_mid_text">
                                <div class="col-md-5 text_all">
                                    <label class="text_all_mobile">Kegiatan</label>
                                </div>
                                <div class="col-md-7 text_all">
                                    <p class="inf-eksisting">-</p>
                                </div>
                            </div>

                            <div class="d-flex space_text row_mid_text">
                                <div class="col-lg-5 text_all">
                                    <label class="text_all_mobile">Perkiraan NJOP</label>
                                </div>
                                <div class="col-lg-7 text_all">
                                    <p class="inf-harganjop">-</p>
                                </div>
                            </div>

                            <div class="d-flex space_text row_mid_text">
                                <div class="col-lg-5 text_all">
                                    <label class="text_all_mobile">Rerata NJOP</label>
                                </div>
                                <div class="col-lg-7 text_all">
                                    <p class="inf-reratanjop">-</p>
                                </div>
                            </div>

                            <div class="d-flex space_text row_mid_text">
                                <div class="col-lg-5 text_all">
                                    <label class="text_all_mobile">Tipe Hak</label>
                                </div>
                                <div class="col-lg-7 text_all">
                                    <p class="inf-tipehak">-</p>
                                </div>
                            </div>

                            <div class="d-flex space_text row_mid_text">
                                <div class="col-lg-5 text_all">
                                    <label class="text_all_mobile">Luas</label>
                                </div>
                                <div class="col-lg-7 text_all">
                                    <p class="inf-luasbpn">-</p>
                                </div>
                            </div>

                            <p class="card-title mt-2 text-center font-weight-bold judul_utama">Usaha Mikro Kecil
                            </p>

                            <div class="d-flex space_judul row_mid_judul">
                                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                    <label class="text_all_mobile">Pemilik IUMK</label>
                                </div>
                                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                    <p><span class="inf-iumk">-</span> <span>orang</span></p>
                                </div>
                            </div>

                            <div class="d-flex space_text row_mid_text">
                                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                    <label class="text_all_mobile">Total Omset</label>
                                </div>
                                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                    <p>Rp.<span class="inf-omzet">-</span> <span>per bulan</span></p>
                                </div>
                            </div>


                            <div class="all-chart" style="margin-top:-6%;">
                                <div class="d-flex margin_chart_ekonomi_mobile">
                                    <canvas id="pie-chart" width="70" height="50"></canvas>
                                </div>

                                <div class="d-flex margin_chartline_ekonomi_mobile">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  mt-4">
                                        <canvas id="bar-chart-grouped" width="90" height="120"></canvas>
                                    </div>
                                </div>
                            </div>


                            <p class="card-title mb-3 mt-4  text-center font-weight-bold judul_utama">Pendapatan
                                Rata-Rata Per Bulan</p>


                            <div class="container_grid">

                                <div class="text_all">
                                    <label>0 - 5 juta</label>
                                </div>
                                <div class="text_all col_info">
                                    <label class="inf-pen-05">-</label>
                                </div>

                                <div class="text_all">
                                    <label>6 - 10 Juta</label>
                                </div>
                                <div class="text_all col_info">
                                    <label class="inf-pen-610">-</label>
                                </div>

                                <div class="text_all">
                                    <label>11 - 15 Juta</label>
                                </div>
                                <div class="text_all col_info">
                                    <label class="inf-pen-1115">-</label>
                                </div>

                                <div class="text_all">
                                    <label>16 - 20 Juta</label>
                                </div>
                                <div class="text_all col_info">
                                    <label class="inf-pen-1620">-</label>
                                </div>

                                <div class="text_all">
                                    <label>> 20 Juta</label>
                                </div>
                                <div class="text_all col_info">
                                    <label class="inf-pen-20">-</label>
                                </div>


                                <div class="text_all">
                                    <label>Tidak Menjawab</label>
                                </div>
                                <div class="text_all col_info">
                                    <label class="inf-pen-na">-</label>
                                </div>
                            </div>

                            <div class="row" id="chart-print">
                                <div class="col-md-6">
                                    <center>
                                        <img id="pie-print" src="" width="70%">
                                    </center>
                                </div>
                                <div class="col-md-6">
                                    <center>
                                        <img id="bar-print" src="" width="70%">
                                    </center>
                                </div>
                            </div>

                            <p class="card-title text-center font-weight-bold judul_utama" style="margin-top:25%;">
                                Distribusi Sektor
                            </p>
                            <div class="d-flex margin_chart_ekonomi_mobile">
                                <canvas id="pie-chart-distribusi" width="70" height="50"></canvas>
                            </div>
                            <div class="mt-4">
                                <div id="pie-chart-distribusi-legend"></div>
                            </div>

                            <p class="card-title mt-5 text-center font-weight-bold judul_utama">
                                Investasi Per
                                Sektor
                            </p>
                            <div class="d-flex margin_chart_ekonomi_mobile">
                                <canvas id="pie-chart-investasi" width="70" height="50"></canvas>
                            </div>
                            <div class="mt-4">
                                <div id="pie-chart-investasi-legend"></div>
                            </div>

                            <p class="card-title mt-5 text-center font-weight-bold judul_utama">
                                Serapan Tenaga Kerja
                            </p>
                            <div class="d-flex margin_chart_ekonomi_mobile">
                                <canvas id="pie-chart-serapan-tk" width="70" height="50"></canvas>
                            </div>
                            <div class="mt-4">
                                <div id="pie-chart-serapan-tk-legend"></div>
                            </div>

                            <p class="card-title mb-3 mt-4  text-center font-weight-bold judul_utama">Luas Sub Zona
                                Berdasar Perda 1/2014
                            </p>


                            <div class="container_grid_wilayah" id="distribusi_wilayah_2014">



                            </div>

                            <p class="card-title mb-3 mt-4  text-center font-weight-bold judul_utama">Luas Sub Zona
                                Berdasar Pergub 31/2022
                            </p>


                            <div class="container_grid_wilayah" id="distribusi_wilayah_2022">


                            </div>

                            {{-- <p class="card-title mb-3 mt-4  text-center font-weight-bold judul_utama">Luas
                                    Transect
                                    Zone Tahun 2021</p>


                                <div class="container_grid_wilayah" id="distribusi_luas_transect_zone_2021">


                                </div> --}}

                            <p class="card-title mb-3 mt-4  text-center font-weight-bold judul_utama">Distribusi
                                Kategori Livability</p>


                            <div class="container_grid_distribusi_wilayah">
                                <div class="text_all">
                                    <label>Sangat Rendah</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-livability-luas-sangat-rendah">-</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-livability-sangat-rendah">-</label>
                                </div>

                                <div class="text_all">
                                    <label>Rendah</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-livability-luas-rendah">-</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-livability-rendah">-</label>
                                </div>

                                <div class="text_all">
                                    <label>Sedang</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-livability-luas-sedang">-</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-livability-sedang">-</label>
                                </div>

                                <div class="text_all">
                                    <label>Tinggi</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-livability-luas-tinggi">-</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-livability-tinggi">-</label>
                                </div>

                                <div class="text_all">
                                    <label>Sangat Tinggi</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-livability-luas-sangat-tinggi">-</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-livability-sangat-tinggi">-</label>
                                </div>
                            </div>

                            <p class="card-title mb-3 mt-4  text-center font-weight-bold judul_utama">Distribusi
                                Kategori Daya Dukung Lingkungan</p>


                            <div class="container_grid_distribusi_wilayah">
                                <div class="text_all">
                                    <label>Sangat Rendah</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-eci-luas-sangat-rendah">-</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-eci-sangat-rendah">-</label>
                                </div>

                                <div class="text_all">
                                    <label>Rendah</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-eci-luas-rendah">-</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-eci-rendah">-</label>
                                </div>

                                <div class="text_all">
                                    <label>Sedang</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-eci-luas-sedang">-</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-eci-sedang">-</label>
                                </div>

                                <div class="text_all">
                                    <label>Tinggi</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-eci-luas-tinggi">-</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-eci-tinggi">-</label>
                                </div>

                                <div class="text_all">
                                    <label>Sangat Tinggi</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-eci-luas-sangat-tinggi">-</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-eci-sangat-tinggi">-</label>
                                </div>
                            </div>

                            <p class="card-title mb-3 mt-4  text-center font-weight-bold judul_utama">Distribusi
                                Kategori Transect Zone Tahun 2021</p>


                            <div class="container_grid_distribusi_wilayah">
                                <div class="text_all">
                                    <label>TP-1</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-luas-tp-1">-</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-tp-1">-</label>
                                </div>

                                <div class="text_all">
                                    <label>TP-2</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-luas-tp-2">-</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-tp-2">-</label>
                                </div>

                                <div class="text_all">
                                    <label>TP-3</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-luas-tp-3">-</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-tp-3">-</label>
                                </div>

                                <div class="text_all">
                                    <label>TP-4</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-luas-tp-4">-</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-tp-4">-</label>
                                </div>

                                <div class="text_all">
                                    <label>TP-5</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-luas-tp-5">-</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-tp-5">-</label>
                                </div>

                                <div class="text_all">
                                    <label>TP-6A</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-luas-tp-6a">-</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-tp-6a">-</label>
                                </div>

                                <div class="text_all">
                                    <label>TP-6B</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-luas-tp-6b">-</label>
                                </div>
                                <div class="text_all text-right col_info">
                                    <label class="inf-distribusi-wilayah-tp-6b">-</label>
                                </div>
                            </div>


                            {{-- <div>
                                    <div class="d-flex margin_chart_ekonomi_mobile">
                                        <canvas id="pie-chart-info" width="70" height="50"
                                            style="position:absolute;z-index: -999; display:none"></canvas>
                                    </div>

                                    <div class="d-flex mt-2 margin_chartline_ekonomi_mobile">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  mt-4">
                                            <canvas id="bar-chart-grouped-info" width="90" height="80"
                                                style="display: none;position:absolute;"></canvas>
                                        </div>
                                    </div>
                                </div> --}}

                            {{-- <p class="card-title mb-3 text-center font-weight-bold judul_utama"
                                    style="margin-top: 90px">Lingkungan</p>

                                <div class="container_grid">

                                    <div class="text_all">
                                        <label>Sistem Sanitasi</label>
                                    </div>
                                    <div class="text_all col_info">
                                        <label class="inf-sanitasi">-</label>
                                    </div>

                                    <div class="text_all">
                                        <label>Penurunan Tanah</label>
                                    </div>
                                    <div class="text_all col_info">
                                        <label class="inf-p-air-tanah">-</label>
                                    </div>
                                </div>


                                <div class="inf-air-tanah">

                                </div>

                                <div class="inf-kawasan-rawan-bencana" style="display: none;">
                                    <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">Resiko
                                        Bencana
                                    </p>
                                    <div class="d-flex space_text row_mid_text">
                                        <div class="col-md-12 text_all text-center">
                                            <label class="inf-jenis-kawasan-rawan-bencana">-</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="inf-kkop" style="display: none;">
                                    <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">KKOP
                                    </p>
                                    <div class="text_all">
                                        <div class="d-flex space_text row_mid_text">
                                            <div class="col-lg-5 text_all text-center">
                                                <label class="text_all_mobile font-weight-bold">Bandara</label>
                                            </div>
                                            <div class="col-lg-7 text_all font-weight-bold text-center">
                                                <p>Kawasan</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text_all list-kkop">
                                    </div>
                                </div>

                                <div class="inf-tpz-profile" style="display: none;">
                                    <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">TPZ
                                    </p>
                                    <div class="text_all">
                                        <div class="d-flex space_text row_mid_text">
                                            <div class="col-lg-5 text_all text-center">
                                                <label class="text_all_mobile font-weight-bold">Kawasan</label>
                                            </div>
                                            <div class="col-lg-7 text_all font-weight-bold text-center">
                                                <p>Keterangan</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text_all list-tpz-profile">
                                    </div>
                                </div>

                                <div class="inf-kontur-tanah" style="display: none">
                                    <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">Kontur
                                        Tanah
                                    </p>
                                    <div class="d-flex space_text row_mid_text">
                                        <div class="col-md-12 text_all text-center">
                                            <label class="inf-detail-kontur-tanah">-</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="inf-potensi-rth-rtb" style="display: none;">
                                    <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">Potensi RTH
                                        &
                                        RTB
                                    </p>
                                    <div class="text_all list-potensi-rth-rtb">
                                    </div>
                                </div> --}}
                            <br>
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>

                    <div class="tab-pane" id="pills-ketentuan" role="tabpanel" aria-labelledby="ketentuan-tab">
                        <div class="container" id="ketentuan-new">


                            <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">Identitas
                                Zonasi
                            </p>
                            <div>
                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">Zona</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-zona">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">Sub Zona</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-subzona">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">Kode Sub Zona</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-kode-sub-zona">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">ID Blok</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-id-blok">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">ID Sub Blok</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-id-sub-blok">-</p>
                                    </div>
                                </div>


                                <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">Intensitas
                                    Pemanfaatan Ruang
                                </p>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">Luas Lahan</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-luas-lahan">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">KDB</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-kdb">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">KLB</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-klb">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">KDH</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-kdh">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">Ketinggian Bangunan</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-ketinggian-bangunan">-</p>
                                    </div>
                                </div>

                                <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">Ketentuan
                                    Kegiatan & Penggunaan Lahan
                                </p>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">Jenis Bangunan</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p>
                                            <select class="inf-jenis-bangunan w-100">
                                                <option>Pilih Jenis Bangunan...</option>
                                            </select>
                                        </p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">Definisi Bangunan</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-definisi-bangunan">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">Perizinan</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-ketentuan-perizinan">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">Keterangan</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-keterangan">-</p>
                                    </div>
                                </div>

                                <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">Ketentuan
                                    Tata
                                    Bangunan
                                </p>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-12 text_all">
                                        <label class="text_all_mobile">Garis Sempadan Non Bangunan</label>
                                        <ol class="list-ketentuan-gsnb">
                                            <li style="margin-left:-25px;">
                                                <span>Garis Sempadan Sungai (GSS)</span> :
                                                <span>Minimal 3 M</span><br>
                                                <span>Dihitung tepi luar kaki tanggul
                                                    sepanjang alur sungai
                                                </span><br>
                                            </li>
                                            <li style="margin-left:-25px;">
                                                <span>Garis Sempadan Situ, Danau, Empang, Waduk (GSSDEW)</span> :
                                                <span>Minimal 5 m
                                                </span><br>
                                                <span>Dihitung dari tepi badan situ, danau, embung dan waduk
                                                </span><br>
                                            </li>
                                            <li style="margin-left:-25px;">
                                                <span>Garis Sempadan Pantai (GSP)</span> : <span>Minimal 10 m
                                                </span><br>
                                                <span>Dihitung dari titik pasang tertinggi atau dari batas tanggul
                                                    pantai
                                                </span><br>
                                            </li>
                                        </ol>

                                        <label class="text_all_mobile">Garis Sempadan Bangunan (GSB)</label>
                                        <ol class="list-ketentuan-gsb">
                                            <li style="margin-left:-25px;">
                                                <span>GSB Terhadap Garis Sempadan Jalan (GSJ)</span><br>
                                                <span>Lebar Jalan</span>
                                                <span style="float:right;">
                                                    <select class="list-lebar-jalan" style="width:160px;"></select>
                                                </span><br>
                                                <div class="mt-2">
                                                    <span>Besaran GSB Terhadap GSJ</span> <span class="inf-besaran-gsj">-
                                                    </span><br>
                                                    <span class="inf-keterangan-gsj">-
                                                    </span>
                                                </div>
                                                <br>
                                            </li>
                                            <li style="margin-left:-25px;">
                                                <span>GSB Terhadap Garis Sempadan Sungai (GSS)</span><br>
                                                <span>Lebar Sungai </span>
                                                <span style="float:right;"><select class="list-lebar-sungai" style="width:160px;"></select>
                                                </span><br>
                                                <span>Fungsi Bangunan </span>
                                                <span style="float:right;"> <select class="list-fungsi-bangunan" style="width:160px;">
                                                        <option>Pilih Fungsi Bangunan</option>
                                                    </select>
                                                </span><br>
                                                <div class="mt-2">
                                                    <span>Besaran GSB Terhadap GSS</span><span class="inf-besaran-gss">-
                                                    </span><br>
                                                    <span class="inf-keterangan-gss">-
                                                    </span>
                                                </div>
                                                <br>
                                            </li>
                                            <li style="margin-left:-25px;">
                                                <span>GSB Terhadap Garis Sempadan Pantai (GSP)</span><br>
                                                <span>Besaran GSB Terhadap GSP</span> : <span class="inf-besaran-gsp">-
                                                </span><br>
                                                <span class="inf-keterangan-gsp">-
                                                </span><br><br>
                                            </li>
                                            <li style="margin-left:-25px;">
                                                <span>GSB Terhadap Garis Sempadan Kereta Api (GSKA)</span><br>
                                                <span>Besaran GSB Terhadap GSKA</span> : <span class="inf-besaran-gska">-
                                                </span><br>
                                                <span class="inf-keterangan-gska">-
                                                </span><br>
                                            </li>
                                            <li style="margin-left:-25px;">
                                                <label>GSB Nol : <span class="inf-gsb-availibility">-</span></label>
                                            </li>
                                        </ol>
                                    </div>
                                </div>

                                <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">Ketentuan
                                    Pelaksanaan
                                </p>

                                <div class="d-flex space_text row_mid_text mb-1">
                                    <div class="col-lg-12 text_all">
                                        <label class="text_all_mobile">A. KETENTUAN HUNIAN</label><br>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text ml-3 mb-2">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">Jenis Fungsi Hunian</label>
                                    </div>
                                    <div class="col-lg-9 text_all"><select id="list-jenis-bangunan" style="
                                        width: 150px;
                                    ">
                                            <option>Pilih Jenis Bangunan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text ml-3 mb-2">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">Tipikal</label>
                                    </div>
                                    <div class="col-lg-9 text_all"><select id="list-tipikal" style="
                                        width: 150px;
                                    ">
                                            <option>Pilih Tipikal</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text ml-3 mb-2">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">Luas Lahan</label>
                                    </div>
                                    <div class="col-lg-9 text_all"><select id="list-luas-lahan" style="
                                        width: 150px;
                                    ">
                                            <option>Pilih Luas Lahan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text ml-3 mb-1">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">KDB</label>
                                    </div>
                                    <div class="col-lg-7 text_all"><span class="inf-hunian-kdb">-</span>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text ml-3 mb-1">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">KLB</label>
                                    </div>
                                    <div class="col-lg-7 text_all"><span class="inf-hunian-klb">-</span>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text ml-3 mb-1">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">KDH</label>
                                    </div>
                                    <div class="col-lg-7 text_all"><span class="inf-hunian-kdh">-</span>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text ml-3 mb-1">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">KTB</label>
                                    </div>
                                    <div class="col-lg-7 text_all"><span class="inf-hunian-ktb">-</span>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text ml-3 mb-2">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">Tinggian Bangunan</label>
                                    </div>
                                    <div class="col-lg-7 text_all"><span class="inf-hunian-ketinggian-bangunan">-</span>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text ml-3 mb-3">
                                    <div class="col-lg-12 text_all">
                                        <ol class="inf-hunian-list-ketentuan"></ol>
                                    </div>
                                </div>

                                <div id="ketentuan-variansi">
                                    <div class="d-flex space_text row_mid_text mb-1">
                                        <div class="col-lg-12 text_all">
                                            <label class="text_all_mobile">B. VARIANSI PEMANFAATAN RUANG PADA ZONA
                                                RTH</label><br>
                                        </div>
                                    </div>

                                    <div class="d-flex space_text row_mid_text ml-3 mb-2">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">Jenis Bangunan</label>
                                        </div>
                                        <div class="col-lg-9 text_all"><select id="list-jenis-bangunan-variansi" style="
                                            width: 150px;
                                        ">
                                                <option>Pilih Jenis Bangunan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex space_text row_mid_text ml-3 mb-2">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">Fungsi Bangunan</label>
                                        </div>
                                        <div class="col-lg-9 text_all">
                                            <label class="inf-variansi-fungsi-bangunan">-</label>
                                        </div>
                                    </div>


                                    <div class="d-flex space_text row_mid_text ml-3 mb-2">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">Ketentuan Perizinan</label>
                                        </div>
                                        <div class="col-lg-9 text_all">
                                            <label class="inf-variansi-ketentuan-perizinan">-</label>
                                        </div>
                                    </div>

                                    <div class="d-flex space_text row_mid_text ml-3 mb-2">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">Jenis Variansi</label>
                                        </div>
                                        <div class="col-lg-9 text_all">
                                            <label class="inf-variansi-jenis-variansi">-</label>
                                        </div>
                                    </div>

                                    <div class="d-flex space_text row_mid_text ml-3 mb-3">
                                        <div class="col-lg-12 text_all">
                                            <ol class="inf-variansi-list-ketentuan"></ol>
                                        </div>
                                    </div>

                                </div>

                                <div class="section_ketentuan_tpz">
                                    <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">
                                        Ketentuan
                                        TPZ
                                    </p>

                                    <div class="d-flex space_text row_mid_text mb-2">
                                        <div class="col-lg-12 text_all">
                                            <label class="text_all_mobile">Lokasi ini memiliki <span class="inf-ketentuan-tpz-jumlah">0</span> ketentuan TPZ</label>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="d-flex space_text row_mid_text mb-2">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">Jenis TPZ</label>
                                        </div>
                                        <div class="col-lg-7 text_all">
                                            <select class="inf-ketentuan-tpz-list w-100">-</select>
                                        </div>
                                    </div>

                                    <div class="d-flex space_text row_mid_text mb-2">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">Nama TPZ</label>
                                        </div>
                                        <div class="col-lg-7 text_all">
                                            <span class="inf-ketentuan-tpz-nama w-100">-</span>
                                        </div>
                                    </div>

                                    <div class="d-flex space_text row_mid_text mb-2">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">Index Pengendali</label>
                                        </div>
                                        <div class="col-lg-7 text_all">
                                            <span class="inf-ketentuan-tpz-index-pengendali w-100">-</span>
                                        </div>
                                    </div>

                                    <div class="d-flex space_text row_mid_text mb-2">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">Jenis Kawasan</label>
                                        </div>
                                        <div class="col-lg-7 text_all">
                                            <span class="inf-ketentuan-tpz-jenis-kawasan w-100">-</span>
                                        </div>
                                    </div>
                                    <div class="d-flex space_text row_mid_text mb-2">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">Nama Kawasan</label>
                                        </div>
                                        <div class="col-lg-7 text_all">
                                            <span class="inf-ketentuan-tpz-nama-kawasan w-100">-</span>
                                        </div>
                                    </div>
                                    <div class="d-flex space_text row_mid_text mb-2">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">Skala Kawasan</label>
                                        </div>
                                        <div class="col-lg-7 text_all">
                                            <span class="inf-ketentuan-tpz-skala-kawasan w-100">-</span>
                                        </div>
                                    </div>
                                    <div class="d-flex space_text row_mid_text mb-2">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">Arah Pengembangan</label>
                                        </div>
                                        <div class="col-lg-7 text_all">
                                            <span class="inf-ketentuan-tpz-arah-pengembangan w-100">-</span>
                                        </div>
                                    </div>
                                    <div class="d-flex space_text row_mid_text mb-2">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">KDB Bonus</label>
                                        </div>
                                        <div class="col-lg-7 text_all">
                                            <span class="inf-ketentuan-tpz-kdb-bonus w-100">-</span>
                                        </div>
                                    </div>
                                    <div class="d-flex space_text row_mid_text mb-2">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">KTB Bonus</label>
                                        </div>
                                        <div class="col-lg-7 text_all">
                                            <span class="inf-ketentuan-tpz-ktb-bonus w-100">-</span>
                                        </div>
                                    </div>
                                    <div class="d-flex space_text row_mid_text mb-2">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">KLB Bonus</label>
                                        </div>
                                        <div class="col-lg-7 text_all">
                                            <span class="inf-ketentuan-tpz-klb-bonus w-100">-</span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="inf-ketentuan-tpz-list-link"></div>
                                </div>

                                <div class="section_ketentuan_rawan_bencana">
                                    <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">
                                        Ketentuan
                                        Rawan Bencana
                                    </p>

                                    <div class="d-flex space_text row_mid_text mb-2">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">Jenis Kawasan</label>
                                        </div>
                                        <div class="col-lg-7 text_all">
                                            <select class="inf-ketentuan-rawan-bencana-list w-100">-</select>
                                        </div>
                                    </div>
                                    <div class="d-flex space_text row_mid_text mb-2">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">Nama Kawasan</label>
                                        </div>
                                        <div class="col-lg-7 text_all">
                                            <span class="inf-ketentuan-rawan-bencana-nama-kawasan w-100">-</span>
                                        </div>
                                    </div>
                                    <div class="d-flex space_text row_mid_text mb-2">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">Resiko</label>
                                        </div>
                                        <div class="col-lg-7 text_all">
                                            <span class="inf-ketentuan-rawan-bencana-resiko-kawasan w-100">-</span>
                                        </div>
                                    </div>

                                    <div class="inf-ketentuan-rawan-bencana-list-ketentuan">

                                    </div>
                                </div>

                                <div class="inf-kkop" style="display: none;">
                                    <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">
                                        Ketentuan
                                        KKOP
                                    </p>
                                    <div class="text_all">
                                        <div class="d-flex space_text row_mid_text mb-2">
                                            <div class="col-lg-5 text_all ">
                                                <label class="text_all_mobile">Nama Bandara</label>
                                            </div>
                                            <div class="col-lg-7 text_all ">
                                                <select class="inf-ketentuan-kkop-list w-100">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-flex space_text row_mid_text mb-2">
                                            <div class="col-lg-5 text_all ">
                                                <label class="text_all_mobile">Jenis KKOP</label>
                                            </div>
                                            <div class="col-lg-7 text_all ">
                                                <span class="inf-ketentuan-kkop-jenis w-100">
                                                    -
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="inf-sempadan" style="display: none;">
                                    <p class="card-title mt-3 mb-4 text-center font-weight-bold judul_utama">
                                        Ketentuan
                                        Kawasan Sempadan
                                    </p>

                                    <div class="d-flex space_text row_mid_text mb-2">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">Jenis Sempadan</label>
                                        </div>
                                        <div class="col-lg-7 text_all">
                                            <span class="inf-ketentuan-sempadan-jenis w-100">-</span>
                                        </div>
                                    </div>
                                    <div class="d-flex space_text row_mid_text mb-2">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">Jenis Kegiatan</label>
                                        </div>
                                        <div class="col-lg-7 text_all">
                                            <select class="inf-ketentuan-sempadan-list w-100">-</select>
                                        </div>
                                    </div>
                                    <div class="d-flex space_text row_mid_text mt-3 mb-2">
                                        <div class="col-lg-12 text_all">
                                            <ol class="text_all_mobile inf-ketentuan-sempadan"></ol>
                                        </div>
                                    </div>
                                </div>

                                <div class="inf-rthrtb" style="display: none;">
                                    <p class="card-title mt-3 mb-4 text-center font-weight-bold judul_utama">
                                        Ketentuan
                                        Potensi RTH dan RTB
                                    </p>
                                    <div class="text_all">
                                        <div class="d-flex space_text row_mid_text mb-2">
                                            <div class="col-lg-5 text_all ">
                                                <label class="text_all_mobile">Jenis Potensi</label>
                                            </div>
                                            <div class="col-lg-7 text_all ">
                                                <span class="inf-ketentuan-rthrtb-jenis w-100">
                                                    -
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-flex space_text row_mid_text mb-2">
                                            <div class="col-lg-5 text_all ">
                                                <label class="text_all_mobile">Sub Zona</label>
                                            </div>
                                            <div class="col-lg-7 text_all ">
                                                <span class="inf-ketentuan-rthrtb-sub-zona w-100">
                                                    -
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="container" id="ketentuan-old" style="display:none;">


                            <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">Zonasi
                                <br><span class="w-100 text-center text_all" style="font-weight: normal">Peraturan
                                    Zonasi
                                    sesuai Perda
                                    1/2014</span>
                            </p>
                            <div>
                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">Zona</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-zona">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">Sub Zona</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-subzona">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">ID Sub Blok</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-id-sub-blok">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">Blok/Sub Blok</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-blok">-</p>
                                    </div>
                                </div>


                                {{-- <div class="d-flex space_text row_mid_text">
                                        <div class="col-lg-5 text_all">
                                            <label class="text_all_mobile">TPZ</label>
                                        </div>
                                        <div class="col-lg-7 text_all">
                                            <p class="inf-tpz"></p>
                                        </div>
                                    </div> --}}


                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">Kode TPZ</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-cdtpz">
                                            <select class="w-100" id="selectTPZ"></select>
                                        </p>
                                    </div>
                                </div>

                                <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">Intensitas
                                </p>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">KDH</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-kdh">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">KLB</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-klb">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">KDB</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-kdb">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">KB</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-kb">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">KTB</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-ktb">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">PSL</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-psl">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">Tipe Bangunan</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p class="inf-tipe-bangunan">-</p>
                                    </div>
                                </div>

                                <div class="d-flex space_text row_mid_text mt-1 mb-2">
                                    <div class="col-lg-12 text_all">
                                        <p style="text-align: justify">Pada lahan di lokasi ini dapat dikenakan
                                            ketentuan TPZ sebagai berikut:</p>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex space_text row_mid_text">
                                <div class="col-lg-12 text_all">
                                    <label class="text_all_mobile inf-k-tpz w-100">
                                        -
                                    </label>
                                </div>
                            </div>

                            {{-- <p class="card-title mt-2 text-center font-weight-bold judul_utama">Ketentuan
                                    Bangunan
                                </p>
                                <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-12 text_all">
                                        <label class="text_all_mobile inf-gsb">
                                            -
                                        </label>
                                    </div>
                                </div> --}}


                            {{-- <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">Ketentuan
                                    Khusus
                                </p>
                                <div class="text_all inf-khusus">
                                    -
                                </div> --}}

                            <div class="d-flex space_text row_mid_text">
                                <div class="col-lg-12 text_all mb-3 text-center">
                                    <label class="text_all_mobile">Kesesuaian Kegiatan Berdasar Tabel ITBX</label>
                                </div>
                            </div>
                            <div class="d-flex space_text row_mid_text">
                                <div class="col-lg-5 text_all">
                                    <label class="text_all_mobile">Kegiatan</label>
                                </div>
                                <div class="col-lg-7 text_all">
                                    <p>
                                        <select class="w-100" id="selectPSL"></select>
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex space_text row_mid_text mb-2">
                                <div class="col-lg-5 text_all">
                                    <label class="text_all_mobile">Ketentuan Perizinan</label>
                                </div>
                                <div class="col-lg-7 text_all">
                                    <span class="inf-status-ketentuan">-</span>
                                </div>
                            </div>
                            <div class="d-flex space_text row_mid_text mb-3">
                                <div class="col-lg-5 text_all">
                                    <label class="text_all_mobile">Keterangan</label>
                                </div>
                                <div class="col-lg-7 text_all">
                                    <span class="inf-keterangan-ketentuan">-</span>
                                </div>
                            </div>
                            <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">Ketentuan
                                Khusus
                            </p>
                            <div class="d-flex space_text row_mid_text text-justify mb-3">
                                <div class="col-lg-12 text_all">
                                    <label>Pada lahan di lokasi ini dimungkin untuk penerapan ketentuan khusus
                                        sebagai
                                        berikut:</label>
                                </div>
                            </div>
                            {{-- <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-5 text_all">
                                        <label class="text_all_mobile">Kegiatan</label>
                                    </div>
                                    <div class="col-lg-7 text_all">
                                        <p>
                                            <select class="w-100" id="selectPSL"></select>
                                        </p>
                                    </div>
                                </div> --}}
                            <div class="d-flex space_text row_mid_text">
                                <div class="col-lg-5 text_all">
                                    <label class="text_all_mobile">Ketentuan Khusus</label>
                                </div>
                                <div class="col-lg-7 text_all">
                                    <p>
                                        <select class="w-100" id="selectKhusus"></select>
                                    </p>
                                </div>
                            </div>
                            <div class="isi-ketentuan-khusus mt-4">

                            </div>



                            <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">
                                Tata Bangunan<br><span class="w-100 text-center text_all" style="font-weight: normal">Pedoman Tata Bangunan sesuai Pergub
                                    135/2019</span>
                            </p>
                            <div class="d-flex space_text row_mid_text text_all">
                                <div class="col-lg-12 text_all">
                                    <div>
                                        <label class="text-center w-100 text-dark font-weight-bold">Lahan
                                            Perencanaan</label><br>
                                        <label class="text-dark font-weight-bold">Definisi</label>
                                    </div>
                                    <p class="text-justify">
                                        lahan efektif yang direncanakan untuk kegiatan
                                        pemanfaatan ruang, dapat berbentuk superblok, blok,
                                        subblok Dan/atau kaveling/persil/perpetakan.
                                    </p>
                                    <div class="pdf_file">
                                        <a target="_blank" href="{{ asset('pdf_bangunan/I. PPT LAHAN PERENCANAAN.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                            Selengkapnya</a>
                                    </div>
                                    <div>
                                        <div class="p-0">
                                            <a class="text-dark font-weight-bold" data-toggle="collapse" href="#lahan_a" aria-expanded="false" aria-controls="lahan_a">
                                                <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                <span class="expanded"><i class="fa fa-minus"></i></span>
                                                Satu Intensitas
                                            </a>
                                        </div>
                                        <div id="lahan_a" class="collapse">
                                            <div class="card-body value-collapse">
                                                <p>Lahan perencanaan yang memiliki satu
                                                    intensitas pemanfaatan ruang pada satu
                                                    subzona.</p>
                                                <div class="pdf_file">
                                                    <a target="_blank" href="{{ asset('pdf_bangunan/I.1 PPT LAHAN PERENCANAAN - SATU INTENSITAS.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                        Selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="p-0">
                                            <a class="text-dark font-weight-bold" data-toggle="collapse" href="#lahan_b" aria-expanded="false" aria-controls="lahan_b">
                                                <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                <span class="expanded"><i class="fa fa-minus"></i></span>
                                                Lebih Dari Satu Intensitas
                                            </a>
                                        </div>
                                        <div id="lahan_b" class="collapse">
                                            <div class="card-body value-collapse">
                                                <p>Lahan perencanaan yang memiliki lebih
                                                    dari satu intensitas pemanfaatan ruang
                                                    pada satu subzona.</p>
                                                <div class="pdf_file">
                                                    <a target="_blank" href="{{ asset('pdf_bangunan/I.2 PPT LAHAN PERENCANAAN - LEBIH DARI SATU INTENSITAS.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                        Selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="p-0">
                                            <a class="text-dark font-weight-bold" data-toggle="collapse" href="#lahan_c" aria-expanded="false" aria-controls="lahan_b">
                                                <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                <span class="expanded"><i class="fa fa-minus"></i></span>
                                                Dipisahkan Prasarana
                                            </a>
                                        </div>
                                        <div id="lahan_c" class="collapse">
                                            <div class="card-body value-collapse">
                                                <p>Lahan Perencanaan yang masih satu
                                                    kepemilikan, yang dibatasi dan/atau
                                                    dipisahkan prasarana kota.</p>
                                                <div class="pdf_file">
                                                    <a target="_blank" href="{{ asset('pdf_bangunan/I.3 PPT LAHAN PERENCANAAN - DIPISAHKAN PRASARANA.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                        Selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="p-0">
                                            <a class="text-dark font-weight-bold" data-toggle="collapse" href="#lahan_d" aria-expanded="false" aria-controls="lahan_b">
                                                <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                <span class="expanded"><i class="fa fa-minus"></i></span>
                                                Lebih Dari Satu Zona
                                            </a>
                                        </div>
                                        <div id="lahan_d" class="collapse">
                                            <div class="card-body value-collapse">
                                                <p>Lahan perencanaan yang memiliki lebih
                                                    dari satu zona.</p>
                                                <div class="pdf_file">
                                                    <a target="_blank" href="{{ asset('pdf_bangunan/I.4 PPT LAHAN PERENCANAAN - LEBIH DARI SATU ZONA.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                        Selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="p-0">
                                            <a class="text-dark font-weight-bold" data-toggle="collapse" href="#lahan_e" aria-expanded="false" aria-controls="lahan_b">
                                                <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                <span class="expanded"><i class="fa fa-minus"></i></span>
                                                Lebih Dari Satu Zona Dipisahkan Prasarana
                                            </a>
                                        </div>
                                        <div id="lahan_e" class="collapse">
                                            <div class="card-body value-collapse">
                                                <p>Lahan perencanaan yang berada di lebih
                                                    dari satu zona, serta dibatasi dan/atau
                                                    dipisahkan prasarana kota.</p>
                                                <div class="pdf_file">
                                                    <a target="_blank" href="{{ asset('pdf_bangunan/I.5 PPT LAHAN PERENCANAAN - LEBIH DARI SATU ZONA DIPISAHKAN PRASARANA.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                        Selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="p-0">
                                            <a class="text-dark font-weight-bold" data-toggle="collapse" href="#lahan_f" aria-expanded="false" aria-controls="lahan_b">
                                                <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                <span class="expanded"><i class="fa fa-minus"></i></span>
                                                Pemecahan dan Penggabungan
                                            </a>
                                        </div>
                                        <div id="lahan_g" class="collapse">
                                            <div class="card-body value-collapse">
                                                <p>Pemecahan dan Penggabungan Lahan Perencanaan.</p>
                                                <div class="pdf_file">
                                                    <a target="_blank" href="{{ asset('pdf_bangunan/I.6 PPT LAHAN PERENCANAAN - PEMECAHAN DAN PENGGABUNGAN.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                        Selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="p-0">
                                            <a class="text-dark font-weight-bold" data-toggle="collapse" href="#lahan_h" aria-expanded="false" aria-controls="lahan_b">
                                                <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                <span class="expanded"><i class="fa fa-minus"></i></span>
                                                Ilustrasi Perhitungan Intensitas
                                            </a>
                                        </div>
                                        <div id="lahan_h" class="collapse">
                                            <div class="card-body value-collapse">
                                                <p>Perhitungan Intensitas pada Laha PerencanaanIlustrasi Perhitungan
                                                    Intensitas pada Laha Perencanaan.</p>
                                                <div class="pdf_file">
                                                    <a target="_blank" href="{{ asset('pdf_bangunan/I.8 PPT LAHAN PERENCANAAN - ILUSTRASI PERHITUNGAN INTENSITAS.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                        Selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="p-0">
                                            <a class="text-dark font-weight-bold" data-toggle="collapse" href="#lahan_g" aria-expanded="false" aria-controls="lahan_b">
                                                <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                <span class="expanded"><i class="fa fa-minus"></i></span>
                                                Perhitungan Intensitas
                                            </a>
                                        </div>
                                        <div id="lahan_f" class="collapse">
                                            <div class="card-body value-collapse">
                                                <p>Perhitungan Intensitas pada Laha Perencanaan.</p>
                                                <div class="pdf_file">
                                                    <a target="_blank" href="{{ asset('pdf_bangunan/I.7 PPT LAHAN PERENCANAAN - PERHITUNGAN INTENSITAS.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                        Selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <label class="text-center w-100 text-dark font-weight-bold">Tata Bangunan
                                            Gedung</label><br>
                                        <label class="text-dark font-weight-bold">Definisi</label>
                                    </div>
                                    <p class="text-justify">
                                        Bangunan gedung adalah wujud fisik hasil pekerjaan konstruksi yang menyatu
                                        dengan tempat kedudukannya, sebagian atau seluruhnya berada di atas dan/atau
                                        di
                                        dalam tanah dan/atau air, yang berfungsi untuk hunian atau tempat tinggal,
                                        kegiatan keagamaan, kegiatan usaha, kegiatan sosial, budaya, maupun kegiatan
                                        khusus.
                                    </p>
                                    <div class="pdf_file">
                                        <a target="_blank" href="{{ asset('pdf_bangunan/II. PPT TATA BANGUNAN GEDUNG.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                            Selengkapnya</a>
                                    </div>
                                    <div>
                                        <div class="p-0">
                                            <a class="text-dark font-weight-bold" data-toggle="collapse" href="#gsb" aria-expanded="false" aria-controls="lahan_b">
                                                <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                <span class="expanded"><i class="fa fa-minus"></i></span>
                                                Garis Sempadan Bangunan (GSB)
                                            </a>
                                        </div>
                                        <div id="gsb" class="collapse">
                                            <div class="card-body value-collapse">
                                                <p>Batas terluar bangunan gedung terhadap rencana jalan, jalan rel,
                                                    sungai, drainase, waduk, pantai dan jalur tegangan tinggi..</p>
                                                <div class="pdf_file">
                                                    <a target="_blank" href="{{ asset('pdf_bangunan/II.1 PPT TATA BANGUNAN GEDUNG - GSB.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                        Selengkapnya</a>
                                                </div>

                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#gsb-gsj" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            GSB terhadap Garis Sempadan Jalan (GSJ)
                                                        </a>
                                                    </div>
                                                    <div id="gsb-gsj" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            <p>GSJ adalah garis rencana jalan yang ditetapkan dalam
                                                                rencana kota</p>
                                                            <ol id="list-ketentuan">
                                                                <li>Rencana jalan dengan lebar ≤ 12m, maka besar GSB
                                                                    adalah 0,5 (Setengah) kali lebar rencana jalan;
                                                                </li>
                                                                <li>Rencana jalan dengan lebar 12m – 26m, maka besar
                                                                    GSB
                                                                    adalah 8m;</li>
                                                                <li>Rencana jalan dengan lebar > 26m, maka besar GSB
                                                                    adalah 10m;</li>
                                                                <li>Jalan eksisting tanpa rencana dengan lebar
                                                                    kurang
                                                                    dari 4 m, maka besar GSB adalah 0m;</li>
                                                                <li>Besar GSB pada lahan perencanaan yang berada
                                                                    pada
                                                                    sisi rencana jalan yang di dalamnya terdapat
                                                                    rencana
                                                                    kota berupa ruang terbuka hijau, ruang terbuka
                                                                    biru,
                                                                    jalan tol atau jaringan rel kereta, GSB dihitung
                                                                    berdasarkan lebar rencana jalan pada sisi muka
                                                                    lahan
                                                                    perencanaan; dan</li>
                                                                <li>Ketentuan GSB bangunan dapat ditiadakan untuk
                                                                    Kawasan Cagar Budaya atau kawasan tertentu
                                                                    dengan
                                                                    menyediakan pedestrian dan penetapannya
                                                                    dilakukan
                                                                    oleh gubernur.</li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.1.a PPT TATA BANGUNAN GEDUNG - GSB - GSJ.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#gsb-gss" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            GSB terhadap Garis Sempadan Sungai (GSS)
                                                        </a>
                                                    </div>
                                                    <div id="gsb-gss" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            <p>GSS adalah garis maya di kiri dan kanan palung sungai
                                                                yang ditetapkan sebagai batas perlindungan sungai.
                                                            </p>
                                                            <ol id="list-ketentuan">
                                                                <li>Berlaku untuk Sungai, kali dan/atau saluran air
                                                                    yang
                                                                    belum memiliki jalan inspeksi;</li>
                                                                <li>GSS adalah garis maya di kiri dan kanan palung
                                                                    sungai yang ditetapkan sebagai batas
                                                                    perlindungan
                                                                    sungai;</li>
                                                                <li>Sungai, kali dan/atau saluran air dengan lebar ≤
                                                                    18
                                                                    m, maka besar GSB adalah 0,5 (setengah) kali
                                                                    lebar
                                                                    sungai dari GSS, kecuali untuk fungsi hunian
                                                                    besar
                                                                    GSB minimum 4 m dihitung dari GSS; dan/atau</li>
                                                                <li>Sungai, kali dan/atau saluran air dengan lebar >
                                                                    18
                                                                    m, besar GSB 10 m, kecuali untuk fungsi hunian
                                                                    besar
                                                                    GSB minimum 5 m dihitung dari GSS.</li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.1.b PPT TATA BANGUNAN GEDUNG - GSB - GSS.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#gsb-gsp" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            GSB terhadap Garis Sempadan Pantai (GSP)
                                                        </a>
                                                    </div>
                                                    <div id="gsb-gsp" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            <p>GSP adalah jarak bebas atau batas wilayah pantai yang
                                                                tidak boleh dimanfaatkan untuk lahan budi daya atau
                                                                untuk didirikan bangunan</p>
                                                            <ol id="list-ketentuan">
                                                                <li>GSP diukur dari titik pasang tertinggi ke arah
                                                                    darat;</li>
                                                                <li> Penetapan GSP disesuaikan dengan karakteristik
                                                                    topografi, biofisik, hidro-oseanografi pesisir,
                                                                    kebutuhan ekonomi dan budaya, serta ketentuan
                                                                    lain;
                                                                </li>
                                                                <li>GSB pada pantai di pulau-pulau Kabupaten
                                                                    Administrasi Kepulauan Seribu harus memenuhi
                                                                    ketentuan GSP yang ditetapkan dalam RDTR dan PZ
                                                                    atau
                                                                    disesuaikan dengan kondisi pulau;</li>
                                                                <li>GSP ditetapkan sesuai kebutuhan dengan
                                                                    penghitungan
                                                                    harus mengikuti ketentuan dan mempertimbangkan
                                                                    perlindungan terhadap gempa dan/atau tsunami,
                                                                    perlindungan pantai dari erosi atau abrasi,
                                                                    perlindungan sumber daya buatan di pesisir dari
                                                                    badai, banjir, dan bencana alam lainnya,
                                                                    perlindungan terhadap ekosistem pesisir, seperti
                                                                    lahan basah, mangrove, terumbu karang, padang
                                                                    lamun,
                                                                    gumuk pasir, estuaria, dan delta, serta,
                                                                    pengaturan
                                                                    akses publik</li>
                                                                <li>GSB pada pantai di pesisir Kota Administrasi
                                                                    Jakarta
                                                                    Utara sebesar 10 m atau disesuaikan dengan
                                                                    kondisi
                                                                    lingkungan dihitung dari GSP ke arah darat</li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.1.c PPT TATA BANGUNAN GEDUNG - GSB - GSP.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#gsb-gsd" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            GSB terhadap Garis Sempadan Danau, Situ, atau Waduk
                                                            (GSD)
                                                        </a>
                                                    </div>
                                                    <div id="gsb-gsd" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            <p>GSD adalah garis maya yang mengelilingi dan berjarak
                                                                tertentu dari tepi badan danau yang berfungsi
                                                                sebagai
                                                                kawasan pelindung danau</p>
                                                            <ol id="list-ketentuan">
                                                                <li>GSB terhadap GSD sebesar 10 m (sepuluh meter)
                                                                    dihitung dari tanggul danau atau dari tinggi
                                                                    maksimum air danau ke arah darat</li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.1.d PPT TATA BANGUNAN GEDUNG - GSB - GSD.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#gsb-gska" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            GSB terhadap Garis Sempadan Kereta Api (GSKa)
                                                        </a>
                                                    </div>
                                                    <div id="gsb-gska" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            <p>GSKa merupakan garis batas luar pengamanan rel kereta
                                                                api
                                                            </p>
                                                            <ol id="list-ketentuan">
                                                                <li>Besarnya GSB terhadap GSKa sebesar 9 m (sembilan
                                                                    meter) dihitung terhadap ruang milik jalan rel
                                                                    kecuali pada bangunan stasiun</li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.1.e PPT TATA BANGUNAN GEDUNG - GSB - GSKa.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="p-0">
                                            <a class="text-dark font-weight-bold" data-toggle="collapse" href="#jbb" aria-expanded="false" aria-controls="lahan_b">
                                                <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                <span class="expanded"><i class="fa fa-minus"></i></span>
                                                Jarak bebas bangunan
                                            </a>
                                        </div>
                                        <div id="jbb" class="collapse">
                                            <div class="card-body value-collapse">
                                                <p>Jarak bebas bangunan adalah jarak minimal yang diperkenankan dari
                                                    dinding terluar bangunan gedung sampai batas lahan perencanaan.
                                                </p>
                                                <div class="pdf_file">
                                                    <a target="_blank" href="{{ asset('pdf_bangunan/II.2 PPT TATA BANGUNAN GEDUNG - JARAK BEBAS.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                        Selengkapnya</a>
                                                </div>

                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#jb-bt" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            Berdasarkan Ketinggian
                                                        </a>
                                                    </div>
                                                    <div id="jb-bt" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            <p>Jarak bebas bangunan berdasarkan ketinggian bangunan
                                                            </p>
                                                            <ol id="list-ketentuan">
                                                                <li>Paling sedikit 4 m pada lantai 1 (satu) sampai
                                                                    lantai 4 bangunan Gedung</li>
                                                                <li>dari lantai lima sampai 21 jarak bebas ditambah
                                                                    0,5
                                                                    m sampai mencapai jarak bebas 12,5 m</li>
                                                                <li>lantai dua puluh dua dan seterusnya jarak bebas
                                                                    tetap 12,5 m</li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.2.a PPT TATA BANGUNAN GEDUNG - JARAK BEBAS - BERDASARKAN KETINGGIAN.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#jb-zh" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            Berimpitan Zona Hijau
                                                        </a>
                                                    </div>
                                                    <div id="jb-zh" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            <p>Jarak bebas bangunan pada Lahan perencanaan yang
                                                                berimpitan dengan Zona Terbuka Hijau Lindung, Zona
                                                                Hutan
                                                                Kota, Zona Taman Kota, Zona Pemakaman, Zona Jalur
                                                                Hijau,
                                                                Zona Hijau Rekreasi.</p>
                                                            <ol id="list-ketentuan">
                                                                <li>1⁄2 (setengah) jarak bebas atau minimum 4 m;
                                                                </li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.2.b PPT TATA BANGUNAN GEDUNG - JARAK BEBAS - BERIMPITAN ZONA HIJAU.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#jb-zi" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            Berimpitan Zona Industri
                                                        </a>
                                                    </div>
                                                    <div id="jb-zi" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            <p>Jarak bebas bangunan pada Lahan perencanaan yang
                                                                berimpitan dengan zona industri dan pergudangan
                                                                dan/atau
                                                                bangunan dengan kegiatan industri dan pergudangan
                                                            </p>
                                                            <ol id="list-ketentuan">
                                                                <li>jarak bebas minimum 6 m;</li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.2.c PPT TATA BANGUNAN GEDUNG - JARAK BEBAS - BERIMPITAN ZONA INDUSTRI.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#jb-spbu" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            Kegiatan SPBU
                                                        </a>
                                                    </div>
                                                    <div id="jb-spbu" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            <p>Jarak bebas untuk kegiatan SPBU dan/atau SPBG dengan
                                                                kegiatan lain di luar kavling </p>
                                                            <ol id="list-ketentuan">
                                                                <li>jarak minimum 30 m (tiga puluh meter) dihitung
                                                                    dari
                                                                    bidang dinding terluar konstruksi tangki
                                                                    penyimpanan
                                                                    bahan bakar</li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.2.d PPT TATA BANGUNAN GEDUNG - JARAK BEBAS - KEGIATAN SPBU.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#jb-bbd" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            Berdasarkan Bidang Dinding
                                                        </a>
                                                    </div>
                                                    <div id="jb-bbd" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            <p>Jarak bebas bangunan berdasarkan bidang dinding
                                                                bangunan
                                                            </p>
                                                            <ol id="list-ketentuan">
                                                                <li>Jika massa bangunan membentuk sudut terhadap
                                                                    bidang
                                                                    pagar atau batas lahan perencanan, jarak bebas
                                                                    bangunan dihitung setengah dari ketentuan jarak
                                                                    bebas, kecuali ditentukan harus menyediakan
                                                                    sirkulasi mobil pemadam kebakaran</li>
                                                                <li>untuk penggunaan overstek, jika lebar overstek
                                                                    tidak
                                                                    lebih dari atau sama dengan 1,5 m, jarak bebas
                                                                    bangunan dihitung dari bidang dinding terluar
                                                                    bangunan</li>
                                                                <li>untuk penggunaan overstek, jika lebar overstek
                                                                    lebih
                                                                    dari 1,5 m, jarak bebas bangunan dihitung dari
                                                                    bidang terluar overstek</li>
                                                                <li>untuk penggunaan fasad selubung ganda, jika
                                                                    jarak
                                                                    antar fasad selubung ganda tidak lebih dari 1,5
                                                                    m,
                                                                    jarak bebas bangunan dihitung dari bidang fasad
                                                                    selubung utama bangunan gedung</li>
                                                                <li>untuk penggunaan fasad selubung ganda, jika
                                                                    jarak
                                                                    antar fasad selubung ganda lebih dari 1,5 m,
                                                                    jarak
                                                                    bebas bangunan dihitung dari bidang fasad
                                                                    selubung
                                                                    (ganda) tambahan bangunan gedung</li>
                                                                <li>untuk mekanikal elektrikal jarak bebas bangunan
                                                                    dihitung minimum setengah dari ketentuan jarak
                                                                    bebas
                                                                    dari batas lahan perencanaan</li>
                                                                <li>Pada Kawasan PSL padat dan sangat padat bangunan
                                                                    deret diperkenankan sampai dengan ketinggian 8
                                                                    lantai sedangkan lantai 9 dan seterusnya
                                                                    diberlakukan ketentuan jarak bebas</li>
                                                                <li>Pada kawasan PSL kurang padat dan tidak padat,
                                                                    bangunan deret diperkenankan sampai ketinggian 4
                                                                    lantai, sedangkan lantai 5 dan seterusnya
                                                                    diberlakukan ketentuan jarak bebas</li>
                                                                <li>Jika nilai jarak GSB ke GSJ/GSS kurang dari
                                                                    jarak
                                                                    bebas bangunan yang ditetapkan, maka jarak
                                                                    bidang
                                                                    tampak depan dengan GSJ/GSS untuk lantai
                                                                    dasar/lantai 1 sampai dengan lantai 4 sebesar
                                                                    GSB,
                                                                    sedangkan lantai 5 dan seterusnya jarak bidang
                                                                    tampak depan menggunakan ketentuan jarak bebas
                                                                    bangunan yang ditetapkan</li>
                                                                <li>JIka GSB lebih besar dari jarak bebas bangunan
                                                                    yang
                                                                    ditetapkan, maka jarak bidang tampak depan
                                                                    dengan
                                                                    GSJ/GSS paling sedikit sebesar GSB</li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.2.e PPT TATA BANGUNAN GEDUNG - JARAK BEBAS - BERDASARKAN BIDANG DINDING.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#jb-bbs" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            Jarak Bebas Samping
                                                        </a>
                                                    </div>
                                                    <div id="jb-bbs" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            {{-- <p>Jarak bebas bangunan berdasarkan bidang dinding
                                                                    bangunan
                                                                </p> --}}
                                                            <ol id="list-ketentuan">
                                                                <li>Jarak bebas samping dibebaskan untuk gedung
                                                                    dengan
                                                                    kegiatan rumah kampung, rumah sangat kecil,
                                                                    rumah
                                                                    kecil, rumah sedang, rumah besar dan rumah flat
                                                                    dengan tipe tunggal atau kopel pada luas bidang
                                                                    tapak lahan yang dapat dibangun kurang dari 36
                                                                    m2
                                                                </li>
                                                                <li>Luas bidang tapak lahan yang dapat dibangun
                                                                    dalam
                                                                    lahan perencanaan adalah luas lahan perencanaan
                                                                    yang
                                                                    dihitung setelah dikurangi GSB, prasarana kota
                                                                    dan
                                                                    jarak bebas bangunan</li>
                                                                <li>Jarak bebas samping dibebaskan untuk bangunan
                                                                    gedung
                                                                    dengan tipe tunggal atau kopel dengan lebar
                                                                    lahan
                                                                    perencanaan rata-rata sampai dengan 12 m</li>
                                                                <li>lebar lahan perencanaan rata-rata dihitung dari
                                                                    penjumlahan lebar muka lahan perencanaan
                                                                    ditambah
                                                                    lebar belakang lahan perencanaan dibagi dua</li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.2.f PPT TATA BANGUNAN GEDUNG - JARAK BEBAS - SAMPING.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#jb-bbsb" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            Jarak bebas belakang
                                                        </a>
                                                    </div>
                                                    <div id="jb-bbsb" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            {{-- <p>Jarak bebas bangunan berdasarkan bidang dinding
                                                                    bangunan
                                                                </p> --}}
                                                            <ol id="list-ketentuan">
                                                                <li>Jarak bebas belakang dapat dikecualikan untuk
                                                                    bangunan gedung untuk kegiatan rumah kampung,
                                                                    rumah
                                                                    sangat kecil, rumah kecil, rumah sedang, rumah
                                                                    besar
                                                                    dan rumah flat dengan tetap memperhatikan
                                                                    penghawaan
                                                                    dan pencahayaan alami
                                                                </li>
                                                                <li>Jarak bebas belakang dibebaskan untuk bangunan
                                                                    gedung dengan jarak lahan perencanaan antara GSB
                                                                    dengan batas tanah belakang maksimum 10 m</li>
                                                                <li>Pada bangunan gedung dengan lebar bangunan
                                                                    maksimum
                                                                    8 m , dapat mengikuti jarak bebas hingga
                                                                    intensitas
                                                                    pemanfaatan ruang dipenuhi.</li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.2.g PPT TATA BANGUNAN GEDUNG - JARAK BEBAS - BELAKANG.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#jb-bbb" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            Jarak bebas antar bangunan
                                                        </a>
                                                    </div>
                                                    <div id="jb-bbb" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            <p>Jarak bebas antar bangunan adalah jarak minimal yang
                                                                diperkenankan dari dinding terluar antar bangunan
                                                                gedung
                                                            </p>
                                                            <ol id="list-ketentuan">
                                                                <li>Jarak bebas antar bangunan dalam satu lahan
                                                                    perencanaan adalah sebesar 1⁄2 (setengah) kali
                                                                    ketentuan jarak bebas bangunan terhadap batas
                                                                    lahan
                                                                    perencanaan
                                                                </li>
                                                                <li>Jika suatu massa bangunan denahnya membentuk
                                                                    huruf U
                                                                    dan/atau huruf H (dengan lekukan), jika
                                                                    kedalaman
                                                                    lekukan melebihi jarak bebas antar bangunan
                                                                    sebagaimana dimaksud pada klausul huruf (a),
                                                                    maka
                                                                    bangunan tersebut dianggap sebagai dua massa
                                                                    bangunan dan jarak antara kedua massa bangunan
                                                                    minimum sebesar jarak antar bangunan dalam satu
                                                                    lahan perencanaan</li>
                                                                <li>suatu massa bangunan denahnya membentuk huruf U
                                                                    dan/atau huruf H (dengan lekukan), jika
                                                                    kedalaman
                                                                    lekukan kurang dari jarak bebas antar bangunan
                                                                    sebagaimana dimaksud pada klausul huruf (a),
                                                                    maka
                                                                    massa bangunan tersebut dianggap sebagai dua
                                                                    massa
                                                                    bangunan, dan jarak antar kedua massa bangunan
                                                                    tersebut minimum sebesar 1⁄2 (setengah) dari
                                                                    jarak
                                                                    antar bangunan dalam satu lahan perencanaan</li>
                                                                <li>Jika suatu massa bangunan denahnya membentuk
                                                                    huruf U
                                                                    dan/atau huruf H (dengan lekukan), jika
                                                                    kedalaman
                                                                    lekukan kurang dari jarak bebas antar bangunan
                                                                    sebagaimana dimaksud pada klausul huruf (a),
                                                                    maka
                                                                    massa bangunan tersebut dianggap sebagai dua
                                                                    massa
                                                                    bangunan, dan jarak antar kedua massa bangunan
                                                                    tersebut minimum sebesar 1⁄2 (setengah) dari
                                                                    jarak
                                                                    antar bangunan dalam satu lahan perencanaan</li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.2.h PPT TATA BANGUNAN GEDUNG - JARAK BEBAS - ANTAR BANGUNAN.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#jb-bbbs" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            Bangunan dengan fungsi khusus
                                                        </a>
                                                    </div>
                                                    <div id="jb-bbbs" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            <p>Bangunan dengan fungsi khusus adalah Bangunan yang
                                                                berfungsi untuk menggunakan, menyimpan atau
                                                                memproduksi
                                                                bahan peledak atau bahan-bahan lain yang sifatnya
                                                                mudah
                                                                meledak, bahan radioaktif, racun, mudah terbakar
                                                                atau
                                                                bahan-bahan lain yang berbahaya
                                                            </p>
                                                            <ol id="list-ketentuan">
                                                                <li>lokasi bangunan gedung terletak di luar
                                                                    lingkungan
                                                                    perumahan atau jarak minimum 50 m dari jalan
                                                                    umum,
                                                                    jalan kereta api, dan bangunan gedung lain di
                                                                    sekitarnya
                                                                </li>
                                                                <li>lokasi bangunan gedung dikelilingi pengaman
                                                                    dengan
                                                                    tinggi minimum 2,5 m dan ruang terbuka pada
                                                                    pintu
                                                                    depan harus ditutup dengan pintu yang kuat
                                                                    dengan
                                                                    diberi peringatan
                                                                </li>
                                                                <li>Bangunan fungsi khusus terletak pada jarak
                                                                    minimum
                                                                    10 m) dari batas-batas pekarangan, serta bagian
                                                                    dinding yang terlemah dari bangunan tersebut
                                                                    diarahkan ke daerah yang aman</li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.2.i PPT TATA BANGUNAN GEDUNG - JARAK BEBAS - BANGUNAN KHUSUS.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="p-0">
                                            <a class="text-dark font-weight-bold" data-toggle="collapse" href="#jbs" aria-expanded="false" aria-controls="lahan_b">
                                                <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                <span class="expanded"><i class="fa fa-minus"></i></span>
                                                Jarak Bebas Basemen
                                            </a>
                                        </div>
                                        <div id="jbs" class="collapse">
                                            <div class="card-body value-collapse">
                                                <p>Jarak bebas basemen adalah jarak minimum yang diperkenankan dari
                                                    dinding terdalam basemen ditambah 30 cm sampai batas lahan
                                                    perencanaan.</p>
                                                <ol id="list-ketentuan">
                                                    <li>Jarak bebas basemen harus berjarak minimum 3 m (tiga meter)
                                                        dari
                                                        batas lahan perencanaan</li>
                                                    <li>Jarak bebas dinding terluar bangunan basemen pada bangunan
                                                        ketinggian maksimum 4 lantai, minimum berjarak 3 m dari GSJ,
                                                        GSK, dan/atau saluran, serta minimum 1 m terhadap lahan
                                                        perencanaan lain, dan tidak menimbulkan dampak negatif
                                                        terhadap
                                                        persil/perpetakan sekitar;</li>
                                                </ol>
                                                <div class="pdf_file">
                                                    <a target="_blank" href="{{ asset('pdf_bangunan/II.3 PPT TATA BANGUNAN GEDUNG - JARAK BEBAS BASEMEN.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                        Selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="p-0">
                                            <a class="text-dark font-weight-bold" data-toggle="collapse" href="#pagar" aria-expanded="false" aria-controls="lahan_b">
                                                <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                <span class="expanded"><i class="fa fa-minus"></i></span>
                                                Pagar
                                            </a>
                                        </div>
                                        <div id="pagar" class="collapse">
                                            <div class="card-body value-collapse">
                                                <p>Pagar adalah struktur tegak yang sengaja dirancang untuk
                                                    membatasi
                                                    lahan.</p>
                                                <ol id="list-ketentuan">
                                                    <li>Posisi pagar diperkenankan terletak pada batas lahan
                                                        perencanaan
                                                    </li>
                                                    <li>Pagar tidak boleh membentuk sudut pada tikungan</li>
                                                    <li>Bangunan gedung yang ditentukan sebagai arkade tidak
                                                        diperbolehkan menggunakan pagar
                                                    </li>
                                                    <li>Letak pintu untuk kendaraan bermotor roda empat pada lahan
                                                        perencanaan yang membentuk sudut tikungan untuk fungsi
                                                        hunian
                                                        diberi jarak minimum 8 m dari titik belok, dan untuk fungsi
                                                        non-hunian dihitung 20 m dari titik belok</li>
                                                    <li>Letak pintu akses pada lahan perencanaan yang tidak memenuhi
                                                        persyaratan sebagaimana dimaksud di atas, diletakkan pada
                                                        ujung
                                                        terjauh batas lahan perencanaan terhadap titik belok</li>
                                                    <li>Tinggi pagar batas pekarangan sepanjang pekarangan samping
                                                        dan
                                                        belakang maksimum 3 m di atas permukaan tanah pekarangan
                                                        untuk
                                                        bangunan tipe tunggal</li>
                                                    <li>Jika pagar merupakan dinding bangunan fungsi hunian
                                                        bertingkat
                                                        atau berfungsi sebagai pembatas pandangan, maka tinggi
                                                        tembok/dinding diperkenankan maksimum 7 m dari permukaan
                                                        tanah
                                                        pekarangan</li>
                                                    <li>Tinggi pagar pada GSJ dan antara GSJ dengan GSB pada
                                                        bangunan
                                                        fungsi hunian maksimum 1,50 m di atas permukaan tanah
                                                        pekarangan
                                                    </li>
                                                    <li>Tinggi pagar pada GSJ dan antara GSJ dengan GSB pada
                                                        bangunan
                                                        fungsi non-hunian termasuk untuk bangunan industri maksimum
                                                        2 m
                                                        di atas permukaan tanah pekarangan</li>
                                                    <li>Pagar pada GSJ harus tembus pandang, dengan bagian bawahnya
                                                        dapat tidak tembus pandang paling tinggi 1 m (satu meter) di
                                                        atas permukaan tanah pekarangan.</li>
                                                    <li>Pagar pada bangunan fungsi khusus/perwakilan negara asing
                                                        mengikuti asas resiprositas atau asas timbal balik</li>
                                                </ol>
                                                <div class="pdf_file">
                                                    <a target="_blank" href="{{ asset('pdf_bangunan/II.4 PPT TATA BANGUNAN GEDUNG - PAGAR.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                        Selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="p-0">
                                            <a class="text-dark font-weight-bold" data-toggle="collapse" href="#arkade" aria-expanded="false" aria-controls="lahan_b">
                                                <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                <span class="expanded"><i class="fa fa-minus"></i></span>
                                                Arkade
                                            </a>
                                        </div>
                                        <div id="arkade" class="collapse">
                                            <div class="card-body value-collapse">
                                                <p>Arkade adalah bangunan yang berfungsi sebagai jalur sirkulasi
                                                    pejalan
                                                    kaki yang memiliki akses menerus antar persil.</p>
                                                <ol id="list-ketentuan">
                                                    <li>Setiap bangunan gedung yang disyaratkan menyediakan arkade,
                                                        maka
                                                        massa bangunan harus sejajar dan berhimpit dengan GSJ
                                                    </li>
                                                    <li>Bangunan gedung yang telah terbentuk arkade dan/atau
                                                        ditetapkan
                                                        mempunyai arkade, untuk lantai 2 sampai dengan lantai 4
                                                        dapat
                                                        berada di atas arkade dan untuk lantai 5 dan seterusnya
                                                        berlaku
                                                        ketentuan jarak bebas bangunan.</li>
                                                    <li>Bangunan gedung yang ditetapkan memiliki arkade, tinggi
                                                        bukaan
                                                        pada tampak arkade adalah 3 m dan harus menerus antar persil
                                                        untuk membentuk kontinuitas muka kawasan dengan lebar arkade
                                                        minimum 3 m
                                                    </li>
                                                </ol>
                                                <div class="pdf_file">
                                                    <a target="_blank" href="{{ asset('pdf_bangunan/II.5 PPT TATA BANGUNAN GEDUNG - ARKADE.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                        Selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="p-0">
                                            <a class="text-dark font-weight-bold" data-toggle="collapse" href="#ramp" aria-expanded="false" aria-controls="lahan_b">
                                                <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                <span class="expanded"><i class="fa fa-minus"></i></span>
                                                lerengan (ramp) kendaraan
                                            </a>
                                        </div>
                                        <div id="ramp" class="collapse">
                                            <div class="card-body value-collapse">
                                                <p>lerengan (ramp) kendaraan memiliki ketentuan:</p>
                                                <ol id="list-ketentuan">
                                                    <li>tidak boleh memotong jalur pedestrian/sarana pejalan kaki
                                                        umum.
                                                    </li>
                                                    <li>Ramp kendaraan menuju dan/atau dari basemen harus memiliki
                                                        ruang
                                                        datar minimum 3 m dari GSJ jalan utama.</li>
                                                    <li>ramp kendaraan menuju dan/atau dari basemen di luar bangunan
                                                        minimum berjarak 60 cm dari GSJ jalan dan batas
                                                        persil/perpetakan
                                                    </li>
                                                    <li>setiap lantai untuk fungsi parkir dengan luas diatas 5.000
                                                        m2
                                                        (lima ribu meter persegi) atau minimum 250 (dua ratus lima
                                                        puluh) SRP (Satuan Ruang Parkir) harus dilengkapi ramp
                                                        kendaraan
                                                        paling sedikit masing-masing 1 (satu) unit untuk ramp naik
                                                        dan
                                                        ramp turun.
                                                    </li>
                                                    <li>jarak bebas antara struktur ke ramp minimum 40 cm
                                                    </li>
                                                </ol>
                                                <div class="pdf_file">
                                                    <a target="_blank" href="{{ asset('pdf_bangunan/II.6 PPT TATA BANGUNAN GEDUNG - RAMP.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                        Selengkapnya</a>
                                                </div>


                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#ramp-lurus" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            Ramp kendaraan lurus
                                                        </a>
                                                    </div>
                                                    <div id="ramp-lurus" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            {{-- <p>lerengan (ramp) kendaraan memiliki ketentuan:
                                                                </p>
                                                                --}}
                                                            <ol id="list-ketentuan">
                                                                <li>kemiringan ramp kendaraan lurus minimum 1 (satu)
                                                                    berbanding 7 (tujuh) dan kemiringan ramp lurus
                                                                    dengan lantai parkir minimum 1 (satu) berbanding
                                                                    20
                                                                    (dua puluh)
                                                                </li>
                                                                <li>lebar ramp kendaraan lurus 1 (satu) arah minimum
                                                                    3
                                                                    m.</li>
                                                                <li>Lebar ramp kendaraan lurus untuk 2 (dua) arah
                                                                    harus
                                                                    diberi pemisah dengan lebar 50 cm (lima puluh
                                                                    sentimeter) sehingga lebar minimum (3,00 + 0,50
                                                                    +
                                                                    3,00) m (enam koma lima meter), dan tinggi
                                                                    pemisah
                                                                    sebesar 10 cm (sepuluh sentimeter); dan
                                                                </li>
                                                                <li>Ramp kendaraan lurus dapat dilengkapi landasan
                                                                    dasar
                                                                    dengan memperhatikan keselamatan pengendara.
                                                                </li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.6.a PPT TATA BANGUNAN GEDUNG - RAMP - LURUS.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#ramp-spiral" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            Ramp kendaraan spiral
                                                        </a>
                                                    </div>
                                                    <div id="ramp-spiral" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            {{-- <p>lerengan (ramp) kendaraan memiliki ketentuan:
                                                                </p>
                                                                --}}
                                                            <ol id="list-ketentuan">
                                                                <li>Ramp kendaraan spiral secara menerus maksimum 5
                                                                    (lima) lantai, jika lantai parkirnya lebih dari
                                                                    5
                                                                    (lima) lantai harus menggunakan sirkulasi datar
                                                                    sebelum ke lantai berikutnya
                                                                </li>
                                                                <li>lebar ramp kendaraan spiral 1 (satu) arah
                                                                    minimum
                                                                    3,5 m (tiga koma lima meter); dan.</li>
                                                                <li>lebar ramp kendaraan spiral untuk 2 (dua) arah
                                                                    diberi pemisah lebar 50 cm (lima puluh
                                                                    sentimeter)
                                                                    sehingga lebar minimum (3,50 + 0,50 + 3,50) m
                                                                    (tujuh
                                                                    koma lima meter) dan tinggi pembatas 10 cm
                                                                    (sepuluh
                                                                    sentimeter).
                                                                </li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.6.b PPT TATA BANGUNAN GEDUNG - RAMP - SPIRAL.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="p-0">
                                            <a class="text-dark font-weight-bold" data-toggle="collapse" href="#parkir" aria-expanded="false" aria-controls="lahan_b">
                                                <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                <span class="expanded"><i class="fa fa-minus"></i></span>
                                                Parkir
                                            </a>
                                        </div>
                                        <div id="parkir" class="collapse">
                                            <div class="card-body value-collapse">
                                                <p> Penyediaan parkir dapat diterapkan pada:</p>
                                                <ol id="list-ketentuan">
                                                    <li>Bagian halaman/pelataran di dalam lahan perencanaan;
                                                        dan/atau
                                                    </li>
                                                    <li>Bangunan (sebagai bangunan utama, bangunan khusus parkir
                                                        dan/atau basemen).</li>
                                                </ol>
                                                <div class="pdf_file">
                                                    <a target="_blank" href="{{ asset('pdf_bangunan/II.7 PPT TATA BANGUNAN GEDUNG - PARKIR.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                        Selengkapnya</a>
                                                </div>


                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#parkir-khusus" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            Fasilitas parkir khusus
                                                        </a>
                                                    </div>
                                                    <div id="parkir-khusus" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            <p>Fasilitas parkir khusus adalah Fasilitas Parkir yang
                                                                disediakan untuk penyandang disabilitas, orang
                                                                lanjut
                                                                usia, ibu hamil dan pengguna sepeda.</p>
                                                            <ol id="list-ketentuan">
                                                                <li>terletak pada lintasan terdekat menuju
                                                                    bangunan/fasilitas yang dituju dan/atau pintu
                                                                    parkir
                                                                    utama;
                                                                </li>
                                                                <li>mempunyai cukup ruang bebas bagi pengguna kursi
                                                                    roda
                                                                    dan mempermudah masuk dan keluar kursi roda dari
                                                                    kendaraan</li>
                                                                <li>disediakan jalur khusus bagi penyandang
                                                                    disabilitas;
                                                                    dan
                                                                </li>
                                                                <li>parkir khusus ditandai dengan simbol tanda
                                                                    parkir.
                                                                </li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.7.a PPT TATA BANGUNAN GEDUNG - PARKIR - PARKIR KHUSUS.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#parkir-dimensi" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            Tata letak dan Dimensi Parkir
                                                        </a>
                                                    </div>
                                                    <div id="parkir-dimensi" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            {{-- <p>lerengan (ramp) kendaraan memiliki ketentuan:
                                                                </p>
                                                                --}}
                                                            <ol id="list-ketentuan">
                                                                <li>Ukuran unit parkir 1 (satu) mobil (sedan/van)
                                                                    ditentukan minimum lebar 2,30 m dan panjang 4,50
                                                                    m
                                                                    pada posisi tegak lurus.
                                                                </li>
                                                                <li>khusus untuk parkir sejajar ditentukan minimum
                                                                    lebar
                                                                    2,30 m ( dan panjang 6,0 m .</li>
                                                                <li>Rasio parkir di dalam bangunan 25 m2 /mobil.
                                                                </li>
                                                                <li>Ukuran unit parkir 1 motor ditentukan minimal
                                                                    lebar
                                                                    0,75 m dan panjang 2 m.
                                                                </li>
                                                                <li>Apabila pada salah satu ujung jalan pada tempat
                                                                    parkir tersebut buntu, maka harus disediakan
                                                                    ruang
                                                                    manuver agar kendaraan dapat parkir dan keluar
                                                                    kembali dengan mudah.
                                                                </li>
                                                                <li>Apabila disediakan pedestrian pada posisi parkir
                                                                    tegak lurus/menyudut, maka lebar pedestrian
                                                                    ditentukan minimum 1,50 m.
                                                                </li>
                                                                <li>Ketentuan nomor 1 sampai dengan 6 dikecualikan
                                                                    untuk
                                                                    fasilitas parkir dengan sistem mekanikal
                                                                    bertingkat,
                                                                    dan dilengkapi dengan kajian sistem perparkiran
                                                                    tersebut.
                                                                </li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.7.b PPT TATA BANGUNAN GEDUNG - PARKIR - TATA LETAK DAN DIMENSI .pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#parkir-halaman" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            Parkir di Halaman
                                                        </a>
                                                    </div>
                                                    <div id="parkir-halaman" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            {{-- <p>lerengan (ramp) kendaraan memiliki ketentuan:
                                                                </p>
                                                                --}}
                                                            <ol id="list-ketentuan">
                                                                <li>penataan halaman parkir harus disediakan
                                                                    pohon-pohon
                                                                    peneduh dan untuk jumlah parkir lebih dari 20
                                                                    (dua
                                                                    puluh) mobil harus disediakan ruang duduk/tunggu
                                                                    untuk sopir dengan ukuran minimum 2 m (dua
                                                                    meter) x
                                                                    3 m (tiga meter).
                                                                </li>
                                                                <li>Pada ruang terbuka di antara GSJ-GSB diatur
                                                                    dengan
                                                                    ketentuan Jika Lebar Rencana Jalan < 30 m maka Luas Maksimum Lahan Parkir Diperbolehkan s/d 100 %, Jika Lebar Rencana Jalan 30 m < L < 50 m maka Luas Maksimum Lahan Parkir Diperbolehkan s/d 50 %, Jika Lebar Rencana Jalan> 50 m maka Luas
                                                                        Maksimum Lahan Parkir Mutlak harus
                                                                        dihijaukan.
                                                                </li>
                                                                <li>Terhadap sisa ruang parkir eksisting yang
                                                                    terkena
                                                                    ketentuan parkir maksimum dalam Kawasan
                                                                    berorientasi
                                                                    transit (Transit Oriented Development/TOD) dapat
                                                                    dimanfaatkan sebagai ruang terbuka hijau/taman
                                                                    dan
                                                                    sejenisnya yang ditanami pohon pelindung/peneduh
                                                                    untuk fungsi sosial dan ekologis yang dapat
                                                                    diakses
                                                                    public .
                                                                </li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.7.c PPT TATA BANGUNAN GEDUNG - PARKIR - DI HALAMAN.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#parkir-bangunan" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            Parkir di Halaman
                                                        </a>
                                                    </div>
                                                    <div id="parkir-bangunan" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            <p>Parkir dalam Bangunan adalah Penempatan fasilitas
                                                                parkir
                                                                di dalam bangunan baik pada sebagian bangunan utama,
                                                                gedung khusus parkir maupun basemen </p>
                                                            <ol id="list-ketentuan">
                                                                <li>Tinggi minimum ruang bebas struktur (head room)
                                                                    untuk ruang parkir ditentukan 2,25 m
                                                                </li>
                                                                <li>Setiap lantai parkir harus memiliki sarana
                                                                    transportasi dan atau sirkulasi vertikal untuk
                                                                    orang
                                                                    berupa tangga. Radius pelayanan tangga adalah 25
                                                                    m
                                                                    untuk yang tidak dilengkapi sprinkler dan/atau
                                                                    40 m
                                                                    untuk yang dilengkapi sprinkler.
                                                                </li>
                                                                <li>Pada setiap lantai untuk ruang parkir bila dapat
                                                                    menampung lebih dari 20 kendaraan harus
                                                                    disediakan
                                                                    ruang tunggu/kantin sopir.
                                                                </li>
                                                                <li>Pada kawasan pembatasan lalu lintas, Kawasan
                                                                    berorientasi transit dan/atau pada koridor moda
                                                                    angkutan umum massal dengan radius 400 meter
                                                                    dari
                                                                    rencana sumbu jalur angkutan umum dikenakan
                                                                    batasan
                                                                    parkir maksimum.
                                                                </li>
                                                                <li>Terhadap sisa ruang parkir eksisting yang
                                                                    terkena
                                                                    ketentuan parkir maksimum dalam Kawasan
                                                                    berorientasi
                                                                    transit (Transit Oriented Development/TOD) dapat
                                                                    dimanfaatkan secara optimal untuk kegiatan usaha
                                                                    mikro dan kecil serta kegiatan publik lainnya.
                                                                </li>
                                                            </ol>
                                                            <div class="pdf_file">
                                                                <a target="_blank" href="{{ asset('pdf_bangunan/II.7.d PPT TATA BANGUNAN GEDUNG - PARKIR - DALAM BANGUNAN.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="p-0">
                                            <a class="text-dark font-weight-bold" data-toggle="collapse" href="#bdbpt" aria-expanded="false" aria-controls="lahan_b">
                                                <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                <span class="expanded"><i class="fa fa-minus"></i></span>
                                                Bangunan di bawah Permukaan Tanah
                                            </a>
                                        </div>
                                        <div id="bdbpt" class="collapse">
                                            <div class="card-body value-collapse">
                                                {{-- <p>Jarak bebas basemen adalah jarak minimum yang diperkenankan
                                                        dari
                                                        dinding terdalam basemen ditambah 30 cm sampai batas lahan
                                                        perencanaan.</p>
                                                    <ol id="list-ketentuan">
                                                        <li>Jarak bebas basemen harus berjarak minimum 3 m (tiga meter)
                                                            dari
                                                            batas lahan perencanaan</li>
                                                        <li>Jarak bebas dinding terluar bangunan basemen pada bangunan
                                                            ketinggian maksimum 4 lantai, minimum berjarak 3 m dari GSJ,
                                                            GSK, dan/atau saluran, serta minimum 1 m terhadap lahan
                                                            perencanaan lain, dan tidak menimbulkan dampak negatif
                                                            terhadap
                                                            persil/perpetakan sekitar;</li>
                                                    </ol> --}}
                                                <div class="pdf_file">
                                                    <a target="_blank" href="{{ asset('pdf_bangunan/II.8 PPT TATA BANGUNAN GEDUNG - DI BAWAH PERMUKAAN TANAH.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                        Selengkapnya</a>
                                                </div>

                                                <div>
                                                    <div class="p-0">
                                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#bdbpt-fungsi" aria-expanded="false" aria-controls="lahan_b">
                                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                                            Fungsi ruang di bawah permukaan tanah
                                                        </a>
                                                    </div>
                                                    <div id="bdbpt-fungsi" class="collapse">
                                                        <div class="card-body value-collapse">
                                                            <p>Kegiatan yang diperbolehkan berfungsi di bawah
                                                                permukaan
                                                                tanah.</p>
                                                            <ol id="list-ketentuan">
                                                                <li>Akses/sirkulasi pejalan kaki ke stasiun angkutan
                                                                    umum massal;</li>
                                                                <li>Prasarana jalan dan utilitas kota;</li>
                                                                <li>Perkantoran, perdagangan dan jasa;</li>
                                                                <li>Fasilitas parkir;</li>
                                                                <li>Sarana penunjang kegiatan gedung di atasnya;
                                                                </li>
                                                                <li>Jaringan angkutan umum massal; dan/atau
                                                                </li>
                                                                <li>Kegiatan keamanan dan pertahanan.</li>
                                                            </ol>
                                                            {{-- <div class="pdf_file">
                                                                    <a target="_blank"
                                                                        href="{{ asset('pdf_bangunan/II.8 PPT TATA BANGUNAN GEDUNG - DI BAWAH PERMUKAAN TANAH.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                            Selengkapnya</a>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="p-0">
                                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#bdbpt-bfungsi" aria-expanded="false" aria-controls="lahan_b">
                                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                                        Bukan fungsi ruang di bawah permukaan tanah
                                                    </a>
                                                </div>
                                                <div id="bdbpt-bfungsi" class="collapse">
                                                    <div class="card-body value-collapse">
                                                        <p>Kegiatan yang tidak diperuntukan untuk berfungsi di
                                                            bawah
                                                            permukaan tanah.</p>
                                                        <ol id="list-ketentuan">
                                                            <li>hunian (seperti kamar tidur, dapur, ruang
                                                                tamu/keluarga).</li>
                                                        </ol>
                                                        {{-- <div class="pdf_file">
                                                                    <a target="_blank"
                                                                        href="{{ asset('pdf_bangunan/II.8 PPT TATA BANGUNAN GEDUNG - DI BAWAH PERMUKAAN TANAH.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                        Selengkapnya</a>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#bangun-layang" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Bangunan Layang
                                    </a>
                                </div>
                                <div id="bangun-layang" class="collapse">
                                    <div class="card-body value-collapse">
                                        <p>Bangunan layang adalah bangunan penghubung antar bangunan yang
                                            dibangun melayang di atas permukaan tanah.</p>
                                        {{-- <ol id="list-ketentuan">
                                                        <li>Jarak bebas basemen harus berjarak minimum 3 m (tiga meter)
                                                            dari
                                                            batas lahan perencanaan</li>
                                                        <li>Jarak bebas dinding terluar bangunan basemen pada bangunan
                                                            ketinggian maksimum 4 lantai, minimum berjarak 3 m dari GSJ,
                                                            GSK, dan/atau saluran, serta minimum 1 m terhadap lahan
                                                            perencanaan lain, dan tidak menimbulkan dampak negatif
                                                            terhadap
                                                            persil/perpetakan sekitar;</li>
                                                    </ol> --}}
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/II.9 PPT TATA BANGUNAN GEDUNG - BANGUNAN LAYANG.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>

                                        <div>
                                            <div class="p-0">
                                                <a class="text-dark font-weight-bold" data-toggle="collapse" href="#layang-satu" aria-expanded="false" aria-controls="lahan_b">
                                                    <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                    <span class="expanded"><i class="fa fa-minus"></i></span>
                                                    Satu Lahan
                                                </a>
                                            </div>
                                            <div id="layang-satu" class="collapse">
                                                <div class="card-body value-collapse">
                                                    <p>bangunan layang yang berada dalam satu lahan
                                                        perencanaan.
                                                    </p>
                                                    <ol id="list-ketentuan">
                                                        <li>Bangunan layang diperhitungkan dalam KDB
                                                            berdasarkan
                                                            proyeksi </li>
                                                        <li>yang berfungsi hanya sebagai sirkulasi pejalan
                                                            kaki,
                                                            lebar bangunan maksimum 4 m (empat meter) dengan
                                                            tinggi bersih minimum 5,5 m (lima koma lima
                                                            meter)
                                                            dari muka tanah tertinggi.</li>
                                                        <li>Bangunan layang yang berfungsi usaha (multiguna)
                                                            dihitung sebagai KDB dan KLB dengan lebar
                                                            minimum 7
                                                            m (tujuh meter) dan maksimum 12 m (dua belas
                                                            meter),
                                                            tinggi bersih minimum 5,5 m (lima koma lima
                                                            meter)
                                                            dari muka tanah tertinggi dan maksimum 4 (empat)
                                                            lapis.</li>
                                                        <li>Pemilihan jenis konstruksi pada bangunan layang
                                                            harus dapat menjamin keamanan dan keselamatan
                                                            pemakai maupun yang lainnya.</li>
                                                    </ol>
                                                    {{-- <div class="pdf_file">
                                                                    <a target="_blank"
                                                                        href="{{ asset('pdf_bangunan/II.8 PPT TATA BANGUNAN GEDUNG - DI BAWAH PERMUKAAN TANAH.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                    Selengkapnya</a>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="p-0">
                                            <a class="text-dark font-weight-bold" data-toggle="collapse" href="#lahan-dua" aria-expanded="false" aria-controls="lahan_b">
                                                <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                <span class="expanded"><i class="fa fa-minus"></i></span>
                                                Lebih dari satu lahan
                                            </a>
                                        </div>
                                        <div id="lahan-dua" class="collapse">
                                            <div class="card-body value-collapse">
                                                <p>bangunan layang yang berada pada lebih dari satu
                                                    lahan
                                                    perencanaan</p>
                                                <ol id="list-ketentuan">
                                                    <li>Bangunan layang diperhitungkan dalam KDB
                                                        berdasarkan
                                                        proyeksi </li>
                                                    <li>yang berfungsi hanya sebagai sirkulasi pejalan
                                                        kaki,
                                                        lebar bangunan maksimum 4 m (empat meter) dengan
                                                        tinggi bersih minimum 5,5 m (lima koma lima
                                                        meter)
                                                        dari muka tanah tertinggi.</li>
                                                    <li>Bangunan layang yang berfungsi usaha (multiguna)
                                                        dihitung sebagai KDB dan KLB dengan lebar
                                                        minimum 7
                                                        m (tujuh meter) dan maksimum 12 m (dua belas
                                                        meter),
                                                        tinggi bersih minimum 5,5 m (lima koma lima
                                                        meter)
                                                        dari muka tanah tertinggi dan maksimum 4 (empat)
                                                        lapis.</li>
                                                    <li>Pemilihan jenis konstruksi pada bangunan layang
                                                        harus dapat menjamin keamanan dan keselamatan
                                                        pemakai maupun yang lainnya.</li>
                                                </ol>
                                                {{-- <div class="pdf_file">
                                                                    <a target="_blank"
                                                                        href="{{ asset('pdf_bangunan/II.8 PPT TATA BANGUNAN GEDUNG - DI BAWAH PERMUKAAN TANAH.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="p-0">
                                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#lahan-tiga" aria-expanded="false" aria-controls="lahan_b">
                                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                                            <span class="expanded"><i class="fa fa-minus"></i></span>
                                            Di atas ruang
                                        </a>
                                    </div>
                                    <div id="lahan-tiga" class="collapse">
                                        <div class="card-body value-collapse">
                                            <p>bangunan layang yang berada di atas prasarana jalan,
                                                sungai, jalan rel, dan/atau RTH</p>
                                            <ol id="list-ketentuan">
                                                <li>Bangunan layang yang berfungsi usaha (multiguna)
                                                    dihitung sebagai KDB dan KLB dengan lebar
                                                    minimum 7
                                                    m (tujuh meter) dan maksimum 12 m (dua belas
                                                    meter),
                                                    tinggi bersih minimum 5,5 m (lima koma lima
                                                    meter)
                                                    dari muka tanah tertinggi dan maksimum 4 (empat)
                                                    lapis.</li>
                                                <li>Pemilihan jenis konstruksi pada bangunan layang
                                                    harus dapat menjamin keamanan dan keselamatan
                                                    pemakai maupun yang lainnya.</li>
                                                <li>harus mendapat persetujuan dari Gubernur melalui
                                                    BKPRD yang dituangkan dalam Surat Keputusan
                                                    gubernur.</li>
                                            </ol>
                                            {{-- <div class="pdf_file">
                                                                    <a target="_blank"
                                                                        href="{{ asset('pdf_bangunan/II.8 PPT TATA BANGUNAN GEDUNG - DI BAWAH PERMUKAAN TANAH.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                            Selengkapnya</a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div>
                    <div class="p-0">
                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#bangun-tinggi" aria-expanded="false" aria-controls="lahan_b">
                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                            <span class="expanded"><i class="fa fa-minus"></i></span>
                            Bangunan Tinggi
                        </a>
                    </div>
                    <div id="bangun-tinggi" class="collapse">
                        <div class="card-body value-collapse">
                            <p>Bangunan Tinggi atau high rise building yaitu bangunan gedung
                                yang
                                memiliki struktur tinggi.</p>
                            <div class="pdf_file">
                                <a target="_blank" href="{{ asset('pdf_bangunan/II.10 PPT TATA BANGUNAN GEDUNG - BANGUNAN TINGGI.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                    Selengkapnya</a>
                            </div>

                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#elevator" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Elevator
                                    </a>
                                </div>
                                <div id="elevator" class="collapse">
                                    <div class="card-body value-collapse">
                                        {{-- <p>bangunan layang yang berada dalam satu lahan
                                                                    perencanaan.
                                                                </p> --}}
                                        <ol id="list-ketentuan">
                                            <li>Bangunan tinggi yang karena sifat penggunaannya
                                                dan/atau ketinggian lebih dari 4 (empat) lantai
                                                harus dilengkapi elevator (lift).</li>
                                            <li>Bangunan tinggi untuk kegiatan rumah susun umum
                                                harus menyediakan elevator (lift) khusus
                                                difabel.
                                            </li>
                                        </ol>
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/II.10.a PPT TATA BANGUNAN GEDUNG - BANGUNAN TINGGI - ELEVATOR.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#eskalator" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Eskalator
                                    </a>
                                </div>
                                <div id="eskalator" class="collapse">
                                    <div class="card-body value-collapse">
                                        {{-- <p>bangunan layang yang berada pada lebih dari satu
                                                                    lahan
                                                                    perencanaan</p> --}}
                                        <ol id="list-ketentuan">
                                            <li>Penggunaan eskalator menerus hanya dapat
                                                diperkenankan untuk menghubungkan antar lantai
                                                maksimum setinggi 4 (empat) lantai.</li>
                                            <li>Penggunaan eskalator menerus lebih dari 2 (dua)
                                                lantai dilengkapi dengan dinding transparan
                                                sebagai
                                                sarana pengaman.</li>
                                        </ol>
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/II.10.b PPT TATA BANGUNAN GEDUNG - BANGUNAN TINGGI - ESKALATOR.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#refuge-floor" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Refuge Floor
                                    </a>
                                </div>
                                <div id="refuge-floor" class="collapse">
                                    <div class="card-body value-collapse">
                                        <p>Bangunan lebih dari 24 (dua puluh empat) lantai atau
                                            lebih dari 120 m (seratus dua puluh meter) harus
                                            menyediakan Lantai Berhimpun Sementara (Refuge
                                            Floor)
                                            sebesar 1 (satu) lantai penuh atau lebih</p>
                                        <ol id="list-ketentuan">
                                            <li>Paling sedikit 50% (lima puluh persen) dari area
                                                kotor (gross area) lantai penyelamatan harus
                                                dirancang sebagai area berkumpul (holding area)
                                                yang
                                                dapat dimanfaatkan sebagai ruang publik dan
                                                tidak
                                                digunakan sebagai area komersial dengan memakai
                                                material yang tidak mudah terbakar.</li>
                                            <li>Menggunakan konstruksi yang memiliki tingkat
                                                ketahanan api paling sedikit 2 jam, bebas asap,
                                                mempunyai sistem ventilasi dan penerangan yang
                                                terpisah serta selalu berfungsi dalam keadaan
                                                darurat; dan</li>
                                            <li>Tangga kebakaran harus berhenti di Lantai
                                                Berhimpun
                                                Sementara sebelum menuju jalan keluar lantai
                                                berikutnya.</li>
                                            <li>Jarak antar Lantai Berhimpun Sementara (Refuge
                                                Floor) paling jauh setiap interval maksimum 16
                                                (enam
                                                belas) lantai dan/atau setiap interval
                                                ketinggian
                                                maksimum 80 m (delapan puluh meter), dengan
                                                teknis
                                                bangunan sesuai dengan peraturan perundangan
                                            </li>
                                        </ol>
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/II.10.c PPT TATA BANGUNAN GEDUNG - BANGUNAN TINGGI - REFUGEE.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#kkop" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        KKOP
                                    </a>
                                </div>
                                <div id="kkop" class="collapse">
                                    <div class="card-body value-collapse">
                                        <p>KKOP adalah Kawasan Keselamatan Operasional
                                            Penerbangan
                                        </p>
                                        <ol id="list-ketentuan">
                                            <li>Bangunan yang dibangun dengan ketinggian
                                                melebihi
                                                batasan yang ditetapkan dalam KKOP harus
                                                mendapat
                                                izin dan/atau rekomendasi dari instansi yang
                                                berwenang.</li>
                                        </ol>
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/II.10.d PPT TATA BANGUNAN GEDUNG - BANGUNAN TINGGI - KKOP.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#helipad" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Penggunaan Helipad
                                    </a>
                                </div>
                                <div id="helipad" class="collapse">
                                    <div class="card-body value-collapse">
                                        <p>Helipad adalah Landasan helikopter
                                        </p>
                                        <ol id="list-ketentuan">
                                            <li>Pembangunan landasan helikopter atau helipad
                                                pada
                                                bangunan tinggi harus mendapat izin dan/atau
                                                rekomendasi dari Instansi yang berwenang.</li>
                                        </ol>
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/II.10.e PPT TATA BANGUNAN GEDUNG - BANGUNAN TINGGI - HELIPAD.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#medan-merdeka" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Kawasan Medan Merdeka
                                    </a>
                                </div>
                                <div id="medan-merdeka" class="collapse">
                                    <div class="card-body value-collapse">
                                        {{-- <p>Helipad adalah Landasan helikopter
                                                                </p> --}}
                                        <ol id="list-ketentuan">
                                            <li>Bangunan tinggi yang berada pada Zona Penyangga
                                                dan
                                                Zona Pelindung Taman Medan Merdeka tidak
                                                diperkenankan membangun landasan
                                                helikopter/helipad
                                                kecuali mendapat rekomendasi dari Sekretariat
                                                Presiden dan instansi berwenang.</li>
                                            <li>Bangunan tinggi yang berada pada Zona penyangga,
                                                Zona Pelindung Taman Medan Merdeka, dan pada
                                                koridor
                                                di luar Zona Pelindung Taman Medan Merdeka yang
                                                berhadapan langsung dengan Kawasan Istana
                                                Presiden
                                                dan Wakil Presiden tidak diperkenankan memiliki
                                                jendela dan/atau ruang yang berhadapan langsung
                                                kecuali berupa jalur/sirkulasi pejalan kaki.
                                            </li>
                                            <li>Bangunan tinggi yang berada pada Zona Penyangga,
                                                Zona Pelindung Taman Medan Merdeka dan pada
                                                Kawasan
                                                sekitar Istana Presiden dan Wakil Presiden
                                                sewaktu-waktu dapat digunakan untuk fungsi
                                                keamanan
                                                dan pertahanan.</li>
                                        </ol>
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/II.10.f PPT TATA BANGUNAN GEDUNG - BANGUNAN TINGGI - KAWASAN MEDAN MERDEKA.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="text-center w-100 text-dark font-weight-bold">Intensitas
                        Pemanfaatan Ruang</label><br>
                    <label class="text-dark font-weight-bold">Definisi</label>
                </div>
                <p class="text-justify">
                    Intensitas pemanfaatan ruang adalah besaran ruang untuk fungsi tertentu yang
                    ditentukan berdasarkan pengaturan Koefisien Lantai Bangunan (KLB), Koefisien
                    Dasar Bangunan (KDB), Ketinggian Bangunan, Koefisien Dasar Hijau (KDH),
                    Koefisien Tapak Basemen (KTB), tiap kawasan bagian kota sesuai dengan
                    kedudukan
                    dan fungsinya dalam pembangunan kota.
                </p>
                <div class="pdf_file">
                    <a target="_blank" href="{{ asset('pdf_bangunan/III PPT INTENSITAS PEMANFAATAN RUANG.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                        Selengkapnya</a>
                </div>

                <div>
                    <div class="p-0">
                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#kdb" aria-expanded="false" aria-controls="lahan_b">
                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                            <span class="expanded"><i class="fa fa-minus"></i></span>
                            Koefisien Dasar Bangunan (KDB)
                        </a>
                    </div>
                    <div id="kdb" class="collapse">
                        <div class="card-body value-collapse">
                            <p>Koefisien Dasar Bangunan yang selanjutnya disingkat KDB, adalah
                                angka
                                persentase perbandingan antara luas seluruh lantai dasar
                                bangunan
                                gedung dihitung berdasarkan batas dinding terluar terhadap luas
                                lahan perpetakan atau lahan perencanaan.</p>

                            <div class="pdf_file">
                                <a target="_blank" href="{{ asset('pdf_bangunan/III.1 PPT INTENSITAS PEMANFAATAN RUANG - KDB.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                    Selengkapnya</a>
                            </div>
                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#kdb-perhitungan" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Ketentuan Perhitungan KDB
                                    </a>
                                </div>
                                <div id="kdb-perhitungan" class="collapse">
                                    <div class="card-body value-collapse">
                                        {{-- <p>GSJ adalah garis rencana jalan yang ditetapkan
                                                                    dalam
                                                                    rencana kota</p> --}}
                                        <ol id="list-ketentuan">
                                            <li>luas proyeksi bangunan, bangunan layang atau
                                                kantilever pada bangunan gedung non hunian
                                                dihitung
                                                sebesar 50% (lima puluh persen) dari luas
                                                bangunan,
                                                bangunan layang atau kantilever;</li>
                                            <li>proyeksi atap atau kantilever bangunan gedung
                                                untuk
                                                kegiatan rumah kampung, rumah sangat kecil,
                                                rumah
                                                kecil, rumah sedang dan rumah besar jika lantai
                                                dasarnya digunakan untuk kegiatan, di antaranya,
                                                teras rumah, tempat berkumpul dan sejenisnya
                                                dihitung 50% luas atap atau kantilever;</li>
                                            <li>proyeksi atap atau kantilever bangunan gedung
                                                sampai
                                                dengan atap atau kantilever di lantai 8
                                                (delapan);
                                            </li>
                                            <li>kanopi yang tidak berfungsi sebagai drop
                                                off/antar
                                                jemput penumpang dan tidak digunakan sebagai
                                                fungsi
                                                usaha yang lebarnya lebih besar dari 1,5 (satu
                                                koma
                                                lima) meter;</li>
                                            <li> kanopi yang tidak berfungsi sebagai drop
                                                off/antar
                                                jemput penumpang yang digunakan sebagai fungsi
                                                usaha;</li>
                                            <li>lantai dasar pada bangunan gedung non hunian
                                                yang
                                                digunakan sebagai parkir, proyeksi dari lantai
                                                atasnya dihitung sebagai lantai parkir;</li>
                                            <li>lantai dasar pada ruang mekanikal elektrikal
                                                yang
                                                terpisah dari bangunan utama;</li>
                                            <li>lantai pada bangunan kontainer baik satuan,
                                                disusun
                                                berjejer, maupun disusun bertingkat dengan
                                                pondasi
                                                yang digunakan sebagai fungsi bangunan gedung;
                                                dan
                                            </li>
                                            <li>lantai bangunan Anjungan Tunai Mandiri (ATM).
                                            </li>
                                        </ol>
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/III.1.a PPT INTENSITAS PEMANFAATAN RUANG - KDB - Ketentuan Perhitungan KDB.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#kdb-pembebasan" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Ketentuan Pembebasan KDB
                                    </a>
                                </div>
                                <div id="kdb-pembebasan" class="collapse">
                                    <div class="card-body value-collapse">
                                        {{-- <p>GSJ adalah garis rencana jalan yang ditetapkan
                                                                    dalam
                                                                    rencana kota</p> --}}
                                        <ol id="list-ketentuan">
                                            <li>proyeksi atap atau kantilever bangunan gedung
                                                untuk
                                                kegiatan rumah kampung, rumah sangat kecil,
                                                rumah
                                                kecil, rumah sedang dan rumah besar dari
                                                overstek
                                                datar/miring yang lantai overstek dan lantai
                                                proyeksi di bawahnya tidak digunakan untuk
                                                kegiatan/aktifitas;</li>
                                            <li>kanopi yang berfungsi sebagai drop off;</li>
                                            <li>atap atau kantilever yang berada di atas lantai
                                                8
                                                (delapan);
                                            </li>
                                            <li>Proyeksi balkon yang lebarnya sampai dengan 1,5
                                                m
                                                (satu
                                                koma lima meter), apabila proyeksi balkon
                                                melebihi
                                                batasan yang ditetapkan, terhadap kelebihannya
                                                dihitung 100% (seratus persen);</li>
                                            <li>proyeksi bangunan arkade yang digunakan untuk
                                                jalur/sirkulasi pejalan kaki publik;</li>
                                            <li>lantai dasar bangunan gedung untuk kegiatan
                                                rumah
                                                kampung, rumah sangat kecil, rumah kecil, rumah
                                                sedang dan rumah besar, yang digunakan sebagai
                                                lantai parkir/carport yang beratap tidak
                                                berdinding,
                                                kecuali dinding pagar pembatas antar persil;
                                            </li>
                                            <li>lantai dasar pada ruang mekanikal elektrikal
                                                yang
                                                terpisah dari bangunan utambangunan penghubung
                                                antar
                                                bangunan gedung dan atap pedestrian di lantai
                                                dasar
                                                berbentuk selasar, beratap, dan tidak berdinding
                                                dengan lebar maksimum 4 m (empat meter), dan
                                                hanya
                                                digunakan untuk sirkulasi pejalan kaki; dan</li>
                                            <li>pemanfaatan ruang antar bangunan yang
                                                dimanfaatkan
                                                untuk kepentingan publik.
                                            </li>
                                            <li>lantai dasar pada bangunan sarana penunjang yang
                                                terpisah dari bangunan utama dan merupakan
                                                instalasi
                                                atau utilitas bangunan serta bukan sarana
                                                penunjang
                                                yang dapat dikomersilkan di antaranya:
                                                <ol type="I">
                                                    <li>gardu listrik PLN;</li>
                                                    <li>tangki air/tangki BBM;</li>
                                                    <li>dudukan chiller, ruang solar genset, dan
                                                        sejenisnya;</li>
                                                    <li>tempat pembuangan sampah;</li>
                                                    <li>garasi mobil pemadam kebakaran dan/atau
                                                        mobil ambulans;</li>
                                                    <li>gapura;</li>
                                                    <li>pos jaga dengan luas maksimum 4 m2
                                                        (empat
                                                        meter persegi); yang berada diantara GSB
                                                        dan
                                                        GSJ; dan</li>
                                                    <li>tempat pemeriksaan kendaraan (security
                                                        check);</li>
                                                    <li>ramp beratap;</li>
                                                    <li>cerobong udara (intake/exhaust) yang
                                                        menerus
                                                        dari basemen dengan luas maksimum tiap
                                                        cerobong 4 m2 (empat meter persegi);
                                                    </li>
                                                    <li>toilet umum;</li>
                                                    <li>mushola termasuk tempat wudhu;</li>
                                                    <li>ruang tunggu sopir; dan</li>
                                                    <li>bangunan shelter transportasi daring.
                                                    </li>
                                                </ol>
                                            </li>
                                            <li>lahan yang dimanfaatkan untuk kegiatan Usaha
                                                Mikro
                                                dan Kecil pada bangunan sementara dan tidak
                                                berdinding atau kontainer tunggal tanpa pondasi.
                                            </li>
                                        </ol>
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/III.1.b PPT INTENSITAS PEMANFAATAN RUANG - KDB - Ketentuan Pembebasan KDB.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="p-0">
                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#klb" aria-expanded="false" aria-controls="lahan_b">
                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                            <span class="expanded"><i class="fa fa-minus"></i></span>
                            Koefisien Lantai Bangunan (KLB)
                        </a>
                    </div>
                    <div id="klb" class="collapse">
                        <div class="card-body value-collapse">
                            <p>Koefisien Lantai Bangunan yang selanjutnya disingkat KLB, adalah
                                angka perbandingan antara luas seluruh lantai bangunan gedung
                                dihitung berdasarkan batas dinding terluar dengan luas lahan
                                perpetakan terhadap lahan perencanaan.</p>

                            <div class="pdf_file">
                                <a target="_blank" href="{{ asset('pdf_bangunan/III.2 PPT INTENSITAS PEMANFAATAN RUANG - KLB.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                    Selengkapnya</a>
                            </div>

                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#klb-perhitungan" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Ketentuan Perhitungan KLB
                                    </a>
                                </div>
                                <div id="klb-perhitungan" class="collapse">
                                    <div class="card-body value-collapse">
                                        {{-- <p>GSJ adalah garis rencana jalan yang ditetapkan
                                                                    dalam
                                                                    rencana kota</p> --}}
                                        <ol id="list-ketentuan">
                                            <li>luas balkon yang terletak pada bangunan gedung
                                                dengan lebar lebih dari 1,5 m (satu koma lima
                                                meter)
                                                dari dinding terluar bangunan dihitung 100%
                                                (seratus
                                                persen);</li>
                                            <li>Balkon yang tertutup oleh dinding atau elemen
                                                penutup lainnya;</li>
                                            <li>luas lantai mezanine atau lantai yang berada di
                                                atas
                                                toilet/ruang
                                                makan/kantor/koridor/tribun/auditorium/
                                                teater/bioskop dan lain-lain baik datar ataupun
                                                miring dengan tinggi plafon atau tribun lebih
                                                dari
                                                1,5 m (satu koma lima meter) dan lebar lebih
                                                dari 1
                                                m (satu meter);
                                            </li>
                                            <li>lantai di bawah tangga, ramp atau panggung, jika
                                                tingginya lebih dari 1,5 m (satu koma lima
                                                meter)
                                                dihitung dari lantai sampai dengan batas bawah
                                                lantai tangga/ramp/panggung;</li>
                                            <li>luas bidang mendatar pada area di bawah jendela
                                                tersembunyi dengan tinggi bersih lebih dari 1,2
                                                m
                                                (satu koma dua meter);</li>
                                            <li>luas bidang mendatar pada area kolam renang yang
                                                beratap;</li>
                                            <li>luas lantai berlubang (perforated floor) atau
                                                lantai
                                                berbentuk jala (heavy duty mesh floor);</li>
                                            <li>lantai pada bangunan penghubung antara GSB dan
                                                GSJ
                                                yang dipergunakan untuk kegiatan komersial
                                                menuju
                                                stasiun angkutan umum massal berbasis rel;
                                            </li>
                                            <li>lantai pada bangunan kontainer baik satuan,
                                                disusun
                                                berjejer, maupun disusun bertingkat dengan
                                                pondasi
                                                yang digunakan sebagai fungsi bangunan gedung;
                                                dan
                                            </li>
                                            <li>lantai bangunan Anjungan Tunai Mandiri (ATM).
                                            </li>
                                        </ol>
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/III.2.a  PPT INTENSITAS PEMANFAATAN RUANG - KLB - Ketentuan Perhitungan KLB.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#klb-pembebasan" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Ketentuan Pembebasan KLB
                                    </a>
                                </div>
                                <div id="klb-pembebasan" class="collapse">
                                    <div class="card-body value-collapse">
                                        <ol id="list-ketentuan">
                                            <li>balkon dengan overstek yang menempel pada fasad
                                                bangunan gedung apartemen/kondotel/hotel dengan
                                                lebar maksimum 1,5 m (satu koma lima meter);
                                            </li>
                                            <li>balkon yang beratap pada bangunan rumah sangat
                                                kecil, rumah kecil, rumah sedang, rumah besar
                                                dan
                                                rumah kos;</li>
                                            <li>lantai yang digunakan untuk parkir beserta
                                                sirkulasinya yang merupakan fasilitas bangunan
                                                gedung dengan syarat tidak melebihi 50% (lima
                                                puluh
                                                persen) dari batasan luas KLB yang telah
                                                ditetapkan
                                                dan kelebihannya dihitung 100 % (seratus
                                                persen);
                                            </li>
                                            <li>bangunan layang yang digunakan pejalan kaki dan
                                                tidak dipergunakan untuk kegiatan lain;</li>
                                            <li> sarana penunjang yang disediakan bangunan
                                                gedung
                                                pada bangunan bertingkat sedang dan bertingkat
                                                tinggi sampai dengan 20% (dua puluh persen) dari
                                                luas lantai bangunan dikurangi luas lantai
                                                parkir,
                                                terhadap kelebihannya dihitung 100 % (seratus
                                                persen), di antaranya:
                                                <ol type="I">
                                                    <li>shaft pemadam kebakaran;</li>
                                                    <li>elevator (lift) dan shaft elevator
                                                        (lift);
                                                    </li>
                                                    <li>ruang dan shaft mechanical electrical
                                                        plumbing (MEP);</li>
                                                    <li>mushola termasuk tempat wudhu;</li>
                                                    <li>ruang tunggu sopir;</li>
                                                    <li>ruang Fire Command Center (FCC);</li>
                                                    <li>toilet;</li>
                                                    <li>janitor;</li>
                                                    <li>IPAL;</li>
                                                    <li>tempat pengumpul sampah;</li>
                                                    <li>ruang laktasi;</li>
                                                    <li>ruang genset;</li>
                                                    <li>ruang Air Handling Unit (AHU);</li>
                                                    <li>ruang fan;</li>
                                                    <li>ruang tangga kebakaran;</li>
                                                    <li>outdoor AC; dan</li>
                                                    <li>ruang untuk usaha Mikro dan Kecil dengan
                                                        pembatas dinding permanen.</li>
                                                </ol>
                                            </li>
                                            <li>sarana penunjang yang terpisah dari bangunan
                                                utama
                                                tidak diperhitungkan sebagai KLB, di antaranya:
                                                <ol type="I">
                                                    <li>gardu listrik PLN;</li>
                                                    <li>tangki air/tangki BBM;</li>
                                                    <li>dudukan chiller, ruang solar genset, dan
                                                        sejenisnya;</li>
                                                    <li>tempat pembuangan sampah;</li>
                                                    <li>garasi mobil pemadam kebakaran dan/atau
                                                        mobil ambulans;</li>
                                                    <li>gapura;</li>
                                                    <li>pos jaga dengan luas maksimum 4 m2
                                                        (empat
                                                        meter persegi); yang berada diantara GSB
                                                        dan
                                                        GSJ; dan</li>
                                                    <li>tempat pemeriksaan kendaraan (security
                                                        check);</li>
                                                    <li>ramp beratap;</li>
                                                    <li>cerobong udara (intake/exhaust) yang
                                                        menerus
                                                        dari basemen dengan luas maksimum tiap
                                                        cerobong 4 m2 (empat meter persegi);
                                                    </li>
                                                    <li>toilet umum;</li>
                                                    <li>mushola termasuk tempat wudhu;</li>
                                                    <li>ruang tunggu sopir; dan</li>
                                                    <li>bangunan shelter transportasi daring.
                                                    </li>
                                                </ol>
                                            </li>
                                            <li>lahan yang dimanfaatkan untuk kegiatan Usaha
                                                Mikro
                                                dan Kecil pada bangunan sementara dan tidak
                                                berdinding atau kontainer tunggal tanpa pondasi;
                                            </li>
                                            <li>lantai evakuasi bencana pada bangunan;
                                            </li>
                                            <li>luas bidang mendatar ruang terbuka tidak beratap
                                                pada lantai atap bangunan gedung yang
                                                dimanfaatkan
                                                hanya sebagai fungsi atap/taman atap/kolam
                                                renang;
                                            </li>
                                            <li>lantai catwalk dalam bangunan gedung yang
                                                berfungsi
                                                untuk pemeliharaan dengan lebar kurang dari 1 m
                                                (satu meter);
                                            </li>
                                            <li> lantai pada bangunan penghubung antara GSB dan
                                                GSJ
                                                yang dipergunakan untuk jalur pedestrian/akses
                                                penghubung menuju stasiun berbasis rel;
                                            </li>
                                            <li>bidang mendatar shaft lift dan tangga apabila
                                                tidak
                                                berhenti pada satu lantai;
                                            </li>
                                            <li>void tangga lantai paling atas; dan
                                            </li>
                                            <li>ruang antar bangunan dan ruang privat yang
                                                digunakan
                                                untuk kepentingan publik selama lebih dari 15
                                                (lima
                                                belas) jam.
                                            </li>
                                        </ol>
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/III.2.b  PPT INTENSITAS PEMANFAATAN RUANG - KLB - Ketentuan Pembebasan KLB.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#klb-proporsi" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Ketentuan Proporsi pada Subzona Campuran.
                                    </a>
                                </div>
                                <div id="klb-proporsi" class="collapse">
                                    <div class="card-body value-collapse">
                                        <p>Perhitungan proporsi KLB pada sub zona campuran
                                            berdasarkan PSL dihitung dari luas seluruh lantai
                                            bangunan yang direncanakan. Proporsi KLB pada sub
                                            zona
                                            campuran berdasarkan PSL sebagai berikut:
                                        </p>
                                        <ol id="list-ketentuan">
                                            <li>PSL sangat padat dan padat, proporsi bangunan
                                                komersial paling tinggi 65 % (enam puluh lima
                                                persen) dan bangunan hunian paling kurang 35%
                                                (tiga
                                                puluh lima persen);</li>
                                            <li>PSL kurang padat dan tidak padat, proporsi
                                                bangunan
                                                komersial paling tinggi 50% (lima puluh persen)
                                                dan
                                                bangunan hunian paling kurang 50% (lima puluh
                                                persen); dan</li>
                                            <li>Pada Kawasan berorientasi transit (TOD) proporsi
                                                KLB
                                                ditetapkan lain berdasarkan karakteristik dan
                                                mengacu pada peraturan perundang-undangan.
                                            </li>
                                        </ol>
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/III.2.c  PPT INTENSITAS PEMANFAATAN RUANG - KLB - Ketentuan Proporsi pada Subzona Campuran.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#klb-pengecualian" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Pengecualian Nilai KLB terhadap RDTR PZ
                                    </a>
                                </div>
                                <div id="klb-pengecualian" class="collapse">
                                    <div class="card-body value-collapse">
                                        <p>Nilai KLB sesuai dengan yang ditetapkan dalam RDTR
                                            dan PZ
                                            kecuali pada:
                                        </p>
                                        <ol id="list-ketentuan">
                                            <li>Bangunan khusus parkir yang fungsinya bukan
                                                bangunan
                                                pelengkap dari bangunan utama diperbolehkan luas
                                                lantai bangunan parkir mencapai 150% (seratus
                                                lima
                                                puluh persen) dari luas total lantai yang
                                                diperhitungkan KLB yang telah ditetapkan pada
                                                RDTR
                                                dan PZ;</li>
                                            <li>bangunan khusus parkir yang berfungsi sebagai
                                                prasarana parkir perpindahan moda (park and
                                                ride),
                                                terintegrasi dengan angkutan umum massal, dan
                                                bukan
                                                bangunan pelengkap dari bangunan utama
                                                diperbolehkan
                                                luas lantai bangunan mencapai 200% (dua ratus
                                                persen) dari luas total lantai yang
                                                diperhitungkan
                                                dalam perhitungan KLB yang telah ditetapkan pada
                                                RDTR dan PZ; dan</li>
                                            <li>Bangunan khusus parkir mekanikal bertingkat atau
                                                parkir otomatis diperbolehkan luas lantai
                                                bangunan
                                                parkir mencapai 150% (seratus lima puluh persen)
                                                dari luas total lantai yang diperhitungkan KLB
                                                yang
                                                telah ditetapkan pada RDTR dan PZ, dan dihitung
                                                sebagai Satuan Ruang Parkir (SRP).
                                            </li>
                                        </ol>
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/III.2.d  PPT INTENSITAS PEMANFAATAN RUANG - KLB - Pengecualian KLB terhadap RDTR PZ.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="p-0">
                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#ktb" aria-expanded="false" aria-controls="lahan_b">
                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                            <span class="expanded"><i class="fa fa-minus"></i></span>
                            Koefisien Tapak Basemen (KTB)
                        </a>
                    </div>
                    <div id="ktb" class="collapse">
                        <div class="card-body value-collapse">
                            <p>Koefisien Tapak Basemen yang selanjutnya disingkat KTB, adalah
                                angka
                                persentase perbandingan antara luas tapak basemen terluas
                                dihitung
                                dari dinding terluar struktur basemen terhadap lahan
                                perencanaan.
                            </p>

                            <div class="pdf_file">
                                <a target="_blank" href="{{ asset('pdf_bangunan/III.3 PPT INTENSITAS PEMANFAATAN RUANG - KTB.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                    Selengkapnya</a>
                            </div>

                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#ktb-perhitungan" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Ketentuan Perhitungan KTB
                                    </a>
                                </div>
                                <div id="ktb-perhitungan" class="collapse">
                                    <div class="card-body value-collapse">
                                        <p>Dinding terluar bangunan basemen yang dihitung 30 cm
                                            (tiga puluh sentimeter) dari dinding perimeter sisi
                                            dalam harus berjarak minimum 3 m (tiga meter) dari
                                            batas
                                            lahan perencanaan;
                                        </p>
                                        {{-- <ol id="list-ketentuan">
                                                                    <li>Bangunan khusus parkir yang fungsinya bukan
                                                                        bangunan
                                                                        pelengkap dari bangunan utama diperbolehkan luas
                                                                        lantai bangunan parkir mencapai 150% (seratus
                                                                        lima
                                                                        puluh persen) dari luas total lantai yang
                                                                        diperhitungkan KLB yang telah ditetapkan pada
                                                                        RDTR
                                                                        dan PZ;</li>
                                                                    <li>bangunan khusus parkir yang berfungsi sebagai
                                                                        prasarana parkir perpindahan moda (park and
                                                                        ride),
                                                                        terintegrasi dengan angkutan umum massal, dan
                                                                        bukan
                                                                        bangunan pelengkap dari bangunan utama
                                                                        diperbolehkan
                                                                        luas lantai bangunan mencapai 200% (dua ratus
                                                                        persen) dari luas total lantai yang
                                                                        diperhitungkan
                                                                        dalam perhitungan KLB yang telah ditetapkan pada
                                                                        RDTR dan PZ; dan</li>
                                                                    <li>Bangunan khusus parkir mekanikal bertingkat atau
                                                                        parkir otomatis diperbolehkan luas lantai
                                                                        bangunan
                                                                        parkir mencapai 150% (seratus lima puluh persen)
                                                                        dari luas total lantai yang diperhitungkan KLB
                                                                        yang
                                                                        telah ditetapkan pada RDTR dan PZ, dan dihitung
                                                                        sebagai Satuan Ruang Parkir (SRP).
                                                                    </li>
                                                                </ol> --}}
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/III.3.a PPT INTENSITAS PEMANFAATAN RUANG - KTB - Ketentuan Perhitungan KTB.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#ktb-pembebasan" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Ketentuan Pembebasan KTB
                                    </a>
                                </div>
                                <div id="ktb-pembebasan" class="collapse">
                                    <div class="card-body value-collapse">
                                        {{-- <p>Dinding terluar bangunan basemen yang dihitung
                                                                    30 cm
                                                                    (tiga puluh sentimeter) dari dinding perimeter sisi
                                                                    dalam harus berjarak minimum 3 m (tiga meter) dari
                                                                    batas
                                                                    lahan perencanaan;
                                                                </p> --}}
                                        <ol id="list-ketentuan">
                                            <li>Bangunan basemen yang menghubungkan antar
                                                basemen
                                                yang berada di bawah prasarana umum seperti
                                                jalan
                                                dan saluran; dan</li>
                                            <li>Koridor basemen yang berada pada area 3 m (tiga
                                                meter) dari GSJ yang menghubungkan basemen
                                                bangunan
                                                gedung, halaman dan/atau ruang publik dengan
                                                prasarana dan/atau sarana stasiun transportasi
                                                bawah
                                                tanah, lebar maksimum 7 m (tujuh meter) dan
                                                hanya
                                                dimanfaatkan untuk jalur pejalan kaki.</li>
                                        </ol>
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/III.3.b PPT INTENSITAS PEMANFAATAN RUANG - KTB - Ketentuan Pembebasan KTB.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#ktb-pengecualian" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Pengecualian KTB terhadap RDTR PZ
                                    </a>
                                </div>
                                <div id="ktb-pengecualian" class="collapse">
                                    <div class="card-body value-collapse">
                                        <p>Intensitas pemanfaatan ruang berdasarkan KTB, harus
                                            sesuai dengan RDTR dan PZ, kecuali pada:
                                        </p>
                                        <ol id="list-ketentuan">
                                            <li>sub zona R.1, R.2, R.3, R.4, R.5, R.6 dan R.9,
                                                KTB
                                                paling tinggi sama dengan KDB yang telah
                                                ditetapkan,
                                                dan hanya digunakan sebagai fungsi penunjang
                                                kegiatan utama hunian;</li>
                                            <li>kegiatan rumah susun (rumah susun
                                                komersial/apartemen dan rumah susun terjangkau)
                                                dan
                                                rumah susun umum yang menggunakan ketentuan
                                                khusus
                                                sesuai RDTR dan PZ besar KTB pada PSL sangat
                                                padat
                                                paling tinggi 60% (enam puluh persen), PSL padat
                                                paling tinggi 55% (lima puluh lima Persen), PSL
                                                kurang padat paling tinggi 50% (lima puluh
                                                persen),
                                                dan PSL tidak padat paling tinggi 45% (empat
                                                puluh
                                                lima persen), sedangkan untuk sub zona KDB
                                                rendah
                                                dan sub zona rumah vertikal KDB rendah besar KTB
                                                paling tinggi 50% (lima puluh persen); dan</li>
                                            <li>sub blok dengan KTB yang tidak ditentukan dalam
                                                RDTR
                                                dan PZ, besar KTB paling tinggi sama dengan KDB
                                                yang
                                                telah ditetapkan dalam RDTR dan PZ .</li>
                                        </ol>
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/III.3.c PPT INTENSITAS PEMANFAATAN RUANG - KTB - Pengecualian KTB terhadap RDTR PZ.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="p-0">
                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#kdh" aria-expanded="false" aria-controls="lahan_b">
                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                            <span class="expanded"><i class="fa fa-minus"></i></span>
                            Koefisien Dasar Hijau (KDH)
                        </a>
                    </div>
                    <div id="kdh" class="collapse">
                        <div class="card-body value-collapse">
                            <p>Koefisien Dasar Hijau yang selanjutnya disingkat KDH, adalah
                                angka
                                persentase perbandingan antara luas seluruh ruang terbuka di
                                luar
                                bangunan gedung dan luas lahan perpetakan atau lahan perencanaan
                                yang dikuasai.
                            </p>

                            <div class="pdf_file">
                                <a target="_blank" href="{{ asset('pdf_bangunan/III.4 PPT INTENSITAS PEMANFAATAN RUANG - KDH.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                    Selengkapnya</a>
                            </div>

                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#kdh-perhitungan" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Ketentuan Perhitungan KDH
                                    </a>
                                </div>
                                <div id="kdh-perhitungan" class="collapse">
                                    <div class="card-body value-collapse">
                                        {{-- <p>Intensitas pemanfaatan ruang berdasarkan KTB,
                                                                    harus
                                                                    sesuai dengan RDTR dan PZ, kecuali pada:
                                                                </p> --}}
                                        <ol id="list-ketentuan">
                                            <li>permukaan tanah yang dimanfaatkan sebagai
                                                resapan
                                                air dan RTH di atas basemen 2 (kedua) dengan
                                                kedalaman minimum 2 m (dua meter) dan menyatu
                                                dengan
                                                tanah sekitarnya.</li>
                                            <li>perkerasan yang merupakan bagian dari lansekap
                                                atau
                                                taman yang berada di atas permukaan tanah,
                                                berupa
                                                lintasan lari (jogging track), perkerasan tepi
                                                kolam
                                                renang (pool deck) dengan lebar maksimum 1,50 m
                                                (satu koma lima meter), jalur pedestrian, dan
                                                jalur
                                                sepeda dengan menggunakan material yang dapat
                                                meresapkan air, kecuali kolam hias dan air
                                                mancur.
                                            </li>
                                            <li>prasarana parkir dengan syarat harus mempunyai
                                                fungsi resapan, dapat ditumbuhi oleh rumput,
                                                dan/atau menggunakan material yang dapat
                                                meresapkan
                                                air, dihitung maksimum 25% (dua puluh lima
                                                persen)
                                                dari batasan KDH; dengan kedalaman tanah minimum
                                                2 m
                                                (dua meter), serta diwajibkan menanam pohon
                                                peneduh
                                                dengan rasio 1 pohon peneduh tiap 3 Satuan Ruang
                                                Parkir (SRP).</li>
                                        </ol>
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/III.4.a PPT INTENSITAS PEMANFAATAN RUANG - KDH - Ketentuan Perhitungan KDH.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#kdh-damker" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Ketentuan Perhitungan KDH pada Jalur Damkar
                                    </a>
                                </div>
                                <div id="kdh-damker" class="collapse">
                                    <div class="card-body value-collapse">
                                        {{-- <p>Intensitas pemanfaatan ruang berdasarkan KTB,
                                                                    harus
                                                                    sesuai dengan RDTR dan PZ, kecuali pada:
                                                                </p> --}}
                                        <ol id="list-ketentuan">
                                            <li>tidak dimanfaatkan, dipergunakan, dan/atau
                                                bagian
                                                dari jalur sirkulasi internal untuk kegiatan
                                                operasional dan servis;</li>
                                            <li>dikhususkan hanya untuk akses pemadam kebakaran,
                                                tidak dimanfaatkan untuk kegiatan yang lain,
                                                termasuk parkir kendaraan;
                                            </li>
                                            <li>menggunakan material yang dapat meresapkan air;
                                            </li>
                                            <li>luas maksimum 50% (lima puluh persen) dari
                                                batasan
                                                KDH yang ditetapkan;</li>
                                            <li>luas maksimum 5% (lima persen) dari total lahan
                                                perencanaan dan merupakan bagian dari batasan
                                                KDH
                                                yang ditetapkan pada sub zona KDB rendah.</li>
                                        </ol>
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/III.4.b PPT INTENSITAS PEMANFAATAN RUANG - KDH - Ketentuan Perhitungan KDH pada Jalur Damkar.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#kdh-pembebasan" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Ketentuan Pembebasan KDH
                                    </a>
                                </div>
                                <div id="kdh-pembebasan" class="collapse">
                                    <div class="card-body value-collapse">
                                        {{-- <p>Intensitas pemanfaatan ruang berdasarkan KTB,
                                                                    harus
                                                                    sesuai dengan RDTR dan PZ, kecuali pada:
                                                                </p> --}}
                                        <ol id="list-ketentuan">
                                            <li>jalan kendaraan, parkir, plaza, kolam, air
                                                mancur
                                                berada di atas bangunan</li>
                                            <li>jalur pedestrian bukan merupakan bagian dari
                                                taman.
                                            </li>
                                        </ol>
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/III.4.c PPT INTENSITAS PEMANFAATAN RUANG - KDH - Ketentuan Pembebasan KDH.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#kdh-rusun" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Ketentuan Pada Rusun sesuai RDTR PZ
                                    </a>
                                </div>
                                <div id="kdh-rusun" class="collapse">
                                    <div class="card-body value-collapse">
                                        <p>kegiatan rumah susun (rumah susun komersial/apartemen
                                            dan
                                            rumah susun terjangkau) dan rumah susun umum yang
                                            menggunakan ketentuan khusus sesuai RDTR dan PZ
                                            besar
                                            KDH pada PSL sangat padat paling rendah 25% (dua
                                            puluh
                                            lima persen), PSL padat paling rendah 30% (tiga
                                            puluh
                                            persen), PSL kurang padat paling rendah 35% (tiga
                                            puluh
                                            lima persen), PSL tidak padat paling rendah 35%
                                            (tiga
                                            puluh lima persen), sedangkan untuk sub zona KDB
                                            rendah
                                            besar KDH paling rendah 45% (empat puluh lima
                                            persen).
                                        </p>
                                        {{-- <ol id="list-ketentuan">
                                                                    <li>jalan kendaraan, parkir, plaza, kolam, air
                                                                        mancur
                                                                        berada di atas bangunan</li>
                                                                    <li>jalur pedestrian bukan merupakan bagian dari
                                                                        taman.
                                                                    </li>
                                                                </ol> --}}
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/III.4.d PPT INTENSITAS PEMANFAATAN RUANG - KDH - Ketentuan Pada Rusun sesuai RDTR PZ.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="p-0">
                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#kb" aria-expanded="false" aria-controls="lahan_b">
                            <span class="collapsed"><i class="fa fa-plus"></i></span>
                            <span class="expanded"><i class="fa fa-minus"></i></span>
                            Ketinggian Bangunan
                        </a>
                    </div>
                    <div id="kb" class="collapse">
                        <div class="card-body value-collapse">
                            <p>Ketinggian bangunan adalah Ketinggian yang dihitung berdasarkan
                                jumlah lapis lantai bangunan gedung (lantai penuh) dalam suatu
                                bangunan mulai dari lantai dasar sampai dengan lantai tertinggi.
                            </p>

                            <div class="pdf_file">
                                <a target="_blank" href="{{ asset('pdf_bangunan/III.5 PPT INTENSITAS PEMANFAATAN RUANG - KB.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                    Selengkapnya</a>
                            </div>
                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#kb-ketentuan" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Ketentuan TInggi Bangunan
                                    </a>
                                </div>
                                <div id="kb-ketentuan" class="collapse">
                                    <div class="card-body value-collapse">
                                        <p>Tinggi bangunan merupakan total tinggi bangunan
                                            gedung
                                            dalam satuan meter mulai dari peil perkarangan
                                            setempat
                                            (sesuai titik koordinat KKOP jika ada KKOP) sampai
                                            dengan elemen tertinggi bangunan dihitung dengan
                                            ketentuan sebagai berikut:
                                        </p>
                                        <ol id="list-ketentuan">
                                            <li>pada bangunan fungsi non-hunian tinggi dari
                                                permukaan lantai dasar (lantai 1) ke permukaan
                                                lantai 2 (dua) maksimum 10 m (sepuluh meter),
                                                dan
                                                tidak diperhitungkan sebagai dua lantai;</li>
                                            <li>tinggi antar lantai penuh berikutnya maksimum 5
                                                m
                                                (lima meter), jika lebih dari 5 m (lima meter)
                                                maka
                                                ruangan tersebut dianggap sebagai 2 (dua)
                                                lantai;
                                            </li>
                                            <li>mezanin yang luasnya kurang dari 50% (lima puluh
                                                persen) dari luas lantai penuh di bawahnya tidak
                                                dihitung sebagai lantai bangunan;
                                            </li>
                                            <li>mezanin yang luasnya melebihi 50% (lima puluh
                                                persen) dari luas lantai penuh dibawahnya,
                                                dihitung
                                                sebagai lantai bangunan;
                                            </li>
                                            <li>pada unit hunian kegiatan rumah kos, rumah
                                                susun,
                                                dan hotel diperbolehkan lantai mezanin dengan
                                                mempertahankan tinggi antar lantai maksimum 5 m
                                                (lima meter);
                                            </li>
                                            <li>mezanin pada kegiatan rumah sangat kecil, rumah
                                                kecil, rumah sedang, rumah besar dan rumah flat
                                                diperbolehkan paling besar 1 (satu) buah;
                                            </li>
                                            <li>bangunan gedung tempat ibadah, bangunan gedung
                                                pertemuan, bangunan gedung pertunjukan, bangunan
                                                gedung prasarana pendidikan, bangunan monumental
                                                yang memiliki nilai arsitektur spesifik,
                                                bangunan
                                                gedung olahraga, bangunan gedung serba guna,
                                                bangunan gedung industri dan pergudangan serta
                                                bangunan sejenis lainnya tidak berlaku ketentuan
                                                sebagaimana dimaksudkan pada angka (1) dan (2);
                                                dan
                                            </li>
                                            <li>fungsi ruang serba guna dan ruang pertemuan yang
                                                merupakan prasarana dari kegiatan utama tidak
                                                berlaku ketentuan sebagaimana dimaksud pada
                                                angka
                                                (1) dan (2).
                                            </li>
                                            <li>Peil lantai dasar suatu lantai bangunan gedung
                                                diperkenankan mencapai paling tinggi 1,20 m
                                                (satu
                                                koma dua meter) mengikuti rata-rata jalan,
                                                dengan
                                                tetap memperhatikan keserasian lingkungan.
                                            </li>
                                        </ol>
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/III.5.a PPT INTENSITAS PEMANFAATAN RUANG - KB - Ketentuan Tinggi Bangunan.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="p-0">
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#kb-peli" aria-expanded="false" aria-controls="lahan_b">
                                        <span class="collapsed"><i class="fa fa-plus"></i></span>
                                        <span class="expanded"><i class="fa fa-minus"></i></span>
                                        Penentuan Peil Lantai Dasar
                                    </a>
                                </div>
                                <div id="kb-peli" class="collapse">
                                    <div class="card-body value-collapse">
                                        {{-- <p>Tinggi bangunan merupakan total tinggi bangunan
                                                                    gedung
                                                                    dalam satuan meter mulai dari peil perkarangan
                                                                    setempat
                                                                    (sesuai titik koordinat KKOP jika ada KKOP) sampai
                                                                    dengan elemen tertinggi bangunan dihitung dengan
                                                                    ketentuan sebagai berikut:
                                                                </p> --}}
                                        <ol id="list-ketentuan">
                                            <li>Penentuan peil lantai dasar pada
                                                pekarangan/persil
                                                berkontur pada basemen tunggal (satu tower)
                                                dihitung
                                                dari rata-rata ketinggian lahan berdasarkan
                                                batas
                                                bangunan.</li>
                                            <li>Penentuan peil lantai dasar pada
                                                pekarangan/persil
                                                berkontur pada basemen bersama (lebih dari satu
                                                tower) dihitung dari rata-rata ketinggian lahan
                                                berdasarkan batas lahan.
                                            </li>
                                            <li>Pada peil atap basemen dengan muka tanah
                                                rata-rata
                                                pekarangan/persil lebih dari 1,20 m (satu koma
                                                dua
                                                meter), maka lantai basemen dinyatakan sebagai
                                                lantai dasar.
                                            </li>
                                            <li>Tinggi tanah/pekarangan/persil yang memiliki
                                                tinggi
                                                rata-rata melebihi 1,20 (satu koma dua meter) di
                                                atas jalan, maka tinggi peil lantai dasar
                                                ditetapkan
                                                di atas lantai bangunan yang tertutup
                                                tanah/basemen.
                                            </li>
                                            <li>Pekarangan/persil yang memiliki kemiringan yang
                                                curam atau perbedaan yang besar pada tanah asli
                                                suatu pekarangan, maka tinggi peil lantai dasar
                                                ditetapkan pada akses utama pekarangan/persil.
                                            </li>
                                            <li>Pekarangan/persil yang memiliki lebih dari satu
                                                akses jalan dan memiliki kemiringan yang tidak
                                                sama,
                                                maka tinggi peil lantai dasar ditentukan dari
                                                peil
                                                rata-rata dimensi permukaan jalan yang terlebar.
                                            </li>
                                            <li>Tinggi lantai dasar bangunan gedung dapat
                                                dihitung
                                                paling tinggi 1,2 m (satu koma dua meter) dari
                                                nilai
                                                peil lantai bangunan rata-rata yang ditetapkan
                                                sebagai nilai batasan ketinggian permukaan
                                                tanah,
                                                dengan ketentuan tapak bangunan yang berada di
                                                bawah
                                                lantai dasar mengikuti ketentuan KTB.
                                            </li>
                                        </ol>
                                        <div class="pdf_file">
                                            <a target="_blank" href="{{ asset('pdf_bangunan/III.5.b PPT INTENSITAS PEMANFAATAN RUANG - KB - Penentuan Peil Lantai Dasar.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- <div id="accordion text_all" style="width: 100%">
                                        <div>
                                            <div class="p-0 pl-3">
                                                <a class="text-dark font-weight-bold" data-toggle="collapse"
                                                    href="#lahan_perencanaan" aria-expanded="true"
                                                    aria-controls="lahan_perencanaan">
                                                    <span class="collapsed"><i class="fa fa-plus"></i></span>
                                                    <span class="expanded"><i class="fa fa-minus"></i></span>
                                                    Lahan Perencanaan
                                                </a>
                                            </div>
                                            <div id="lahan_perencanaan" class="collapse show">
                                                <div class="card-body value-collapse">
                                                    <div id="accordion text_all" style="width: 100%">
                                                        <div>
                                                            <div class="p-0 pl-3">
                                                                <a class="text-dark font-weight-bold"
                                                                    data-toggle="collapse" href="#definisi_lahan"
                                                                    aria-expanded="true" aria-controls="definisi_lahan">
                                                                    <span class="collapsed"><i
                                                                            class="fa fa-plus"></i></span>
                                                                    <span class="expanded"><i
                                                                            class="fa fa-minus"></i></span>
                                                                    Definisi
                                                                </a>
                                                            </div>
                                                            <div id="definisi_lahan" class="collapse show">
                                                                <div class="card-body value-collapse">
                                                                    <p>lahan efektif yang direncanakan untuk kegiatan
                                                                        pemanfaatan ruang, dapat berbentuk superblok,
                                                                        blok,
                                                                        subblok Dan/atau kaveling/persil/perpetakan
                                                                    <div class="ml-3">
                                                                        <a target="_blank"
                                                                            href="{{ asset('pdf_bangunan/I. PPT LAHAN PERENCANAAN.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
            Selengkapnya</a>
        </div>
        </p>
        <div>
            <div class="p-0 pl-3">
                <a class="text-dark font-weight-bold" data-toggle="collapse" href="#lahan_a" aria-expanded="false" aria-controls="lahan_a">
                    <span class="collapsed"><i class="fa fa-plus"></i></span>
                    <span class="expanded"><i class="fa fa-minus"></i></span>
                    Satu Intensitas
                </a>
            </div>
            <div id="lahan_a" class="collapse">
                <div class="card-body value-collapse">
                    <p>Lahan perencanaan yang memiliki satu
                        intensitas pemanfaatan ruang pada
                        satu
                        subzona.</p>
                    <div class="ml-3">
                        <a target="_blank" href="{{ asset('pdf_bangunan/I.1 PPT LAHAN PERENCANAAN - SATU INTENSITAS.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                            Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="p-0 pl-3">
                <a class="text-dark font-weight-bold" data-toggle="collapse" href="#lahan_b" aria-expanded="false" aria-controls="lahan_b">
                    <span class="collapsed"><i class="fa fa-plus"></i></span>
                    <span class="expanded"><i class="fa fa-minus"></i></span>
                    Lebih Dari Satu Intensitas
                </a>
            </div>
            <div id="lahan_b" class="collapse">
                <div class="card-body value-collapse">
                    <p>Lahan perencanaan yang memiliki lebih
                        dari satu intensitas pemanfaatan
                        ruang
                        pada satu subzona.</p>
                    <div class="ml-3">
                        <a target="_blank" href="{{ asset('pdf_bangunan/I.2 PPT LAHAN PERENCANAAN - LEBIH DARI SATU INTENSITAS.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                            Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="p-0 pl-3">
                <a class="text-dark font-weight-bold" data-toggle="collapse" href="#lahan_c" aria-expanded="false" aria-controls="lahan_b">
                    <span class="collapsed"><i class="fa fa-plus"></i></span>
                    <span class="expanded"><i class="fa fa-minus"></i></span>
                    Dipisahkan Prasarana
                </a>
            </div>
            <div id="lahan_c" class="collapse">
                <div class="card-body value-collapse">
                    <p>Lahan Perencanaan yang masih satu
                        kepemilikan, yang dibatasi dan/atau
                        dipisahkan prasarana kota.</p>
                    <div class="ml-3">
                        <a target="_blank" href="{{ asset('pdf_bangunan/I.3 PPT LAHAN PERENCANAAN - DIPISAHKAN PRASARANA.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                            Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="p-0 pl-3">
                <a class="text-dark font-weight-bold" data-toggle="collapse" href="#lahan_d" aria-expanded="false" aria-controls="lahan_b">
                    <span class="collapsed"><i class="fa fa-plus"></i></span>
                    <span class="expanded"><i class="fa fa-minus"></i></span>
                    Lebih Dari Satu Zona
                </a>
            </div>
            <div id="lahan_d" class="collapse">
                <div class="card-body value-collapse">
                    <p>Lahan perencanaan yang memiliki lebih
                        dari satu zona.</p>
                    <div class="ml-3">
                        <a target="_blank" href="{{ asset('pdf_bangunan/I.4 PPT LAHAN PERENCANAAN - LEBIH DARI SATU ZONA.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                            Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="p-0 pl-3">
                <a class="text-dark font-weight-bold" data-toggle="collapse" href="#lahan_e" aria-expanded="false" aria-controls="lahan_b">
                    <span class="collapsed"><i class="fa fa-plus"></i></span>
                    <span class="expanded"><i class="fa fa-minus"></i></span>
                    Lebih Dari Satu Zona Dipisahkan
                    Prasarana
                </a>
            </div>
            <div id="lahan_e" class="collapse">
                <div class="card-body value-collapse">
                    <p>Lahan perencanaan yang berada di
                        lebih
                        dari satu zona, serta dibatasi
                        dan/atau
                        dipisahkan prasarana kota.</p>
                    <div class="ml-3">
                        <a target="_blank" href="{{ asset('pdf_bangunan/I.5 PPT LAHAN PERENCANAAN - LEBIH DARI SATU ZONA DIPISAHKAN PRASARANA.pdf') }}"><i class="fa fa-file-pdf-o text-danger"></i>
                            Selengkapnya</a>
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
    </div> --}}
    </div>
    {{-- <div class="d-flex space_text row_mid_text">
                                    <div class="col-lg-12 text_all">
                                        <ol>
                                            <li style="margin-left: -25px">Lahan Perencanaan</li>
                                            <li style="margin-left: -25px">Tata Bangunan
                                                <br>
                                                <ol type="a">
                                                    <li style="margin-left: -25px">GSB</li>
                                                    <li style="margin-left: -25px">Jarak Bebas</li>
                                                    <li style="margin-left: -25px">Arkade</li>
                                                    <li style="margin-left: -25px">Bangunan Tinggi</li>
                                                    <li style="margin-left: -25px">Pagar</li>
                                                    <li style="margin-left: -25px">Ramp</li>
                                                    <li style="margin-left: -25px">Parkir</li>
                                                    <li style="margin-left: -25px">Bangunan di Bawah Permukaan Tanah
                                                    </li>
                                                    <li style="margin-left: -25px">Bangunan Layang</li>
                                                </ol>
                                            </li>
                                            <li style="margin-left: -25px">Intensitas</li>
                                        </ol>
                                    </div>
                                </div> --}}

    </div>
    </div>

    <div class="tab-pane " id="pills-poi" role="tabpanel" aria-labelledby="poi-tab">
        <div class="container" id="poi-print">
            <p class="card-title mt-2 text-center font-weight-bold judul_utama">Akses</p>
            <div class="form-group for_web w-100 mt-3 mb-0 ml-2" id="radiusSlide">
                <label class="font-weight-bold font_range_input" for="formControlRange">Radius</label>
                <label class="font-weight-bold font_range_input" id="OutputControlRange">0
                    Km</label>

                <input type="range" style="height: 6px;" class="form-control-range" id="ControlRange" min="500" max="3000" step="500" value="1000">
            </div>
            <br>
            <div class="accordion tabListFasilitas" id="PoiCollabse">
                {{-- <div class="row row_mid_judul2">
                                        <div class="col-md-12 flex-column">
                                            <button type="button"
                                                class="btn btn-md btn-block text-left text_all text_poi1 tombol_search"
                                                data-toggle="collapse" data-target="#collapsePoiOne"
                                                aria-expanded="true" aria-controls="collapsePoiOne">
                                                <b class="text_all_mobile">Minimarket</b>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="collapsePoiOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#PoiCollabse">
                                        <div class="card-body text_poi2 row_mid_judul">
                                            <ul class="list-group list-group-flush PoiCollabse_mobile">

                                                <li
                                                    class="listgroup-cust d-flex justify-content-between align-items-center text_all">
                                                    Alfamidi Siaga
                                                    <span class="PoiCollabse_konten_mobile">0.185 km</span>
                                                </li>

                                                <li
                                                    class="listgroup-cust d-flex justify-content-between align-items-center text_all">
                                                    Familymart Pejaten
                                                    <span class="PoiCollabse_konten_mobile">0.575 km</span>
                                                </li>

                                                <li
                                                    class="listgroup-cust d-flex justify-content-between align-items-center text_all">
                                                    Alfamart Siaga Raya
                                                    <span class="PoiCollabse_konten_mobile">0.641 km</span>
                                                </li>

                                                <li
                                                    class="listgroup-cust d-flex justify-content-between align-items-center text_all">
                                                    Alfamidi Sawo Manilla
                                                    <span class="PoiCollabse_konten_mobile">0.715 km</span>
                                                </li>

                                            </ul>
                                        </div>
                                    </div> --}}
            </div>
        </div>
    </div>

    <div class="tab-pane " id="pills-kblikeg" role="tabpanel" aria-labelledby="kblikeg-tab">
        <div class="container" id="kbli-print">
            <p class="card-title  mt-2 text-center font-weight-bold judul_utama">KBLI</p>

            <div id="kbli-new">
                <div class="form-kbli">
                    <div class="d-flex ml-1 margin_cari_kodelbli_mobile">
                        <div class="col-md-12 text_all">
                            <label class="text_all_mobile font-weight-bold">Kode KBLI /
                                Kegiatan</label>
                            <div class="form-group input-group-sm cari_kodekbli_option_mobile">
                                <select class="form-control text_all" id="kegiatanRuangNew" style="z-index: 9999">

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex ml-1 space_text margin_cari_kodelbli_mobile">
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                            <label class="text_all_mobile">Kode KBLI</label>
                        </div>
                        <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                            <label class="inf-kbli">-</label>
                        </div>
                    </div>
                    <div class="d-flex ml-1 space_text margin_cari_kodelbli_mobile">
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                            <label class="text_all_mobile">Kegiatan</label>
                        </div>
                        <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                            <label class="inf-bangunan">-</label>
                        </div>
                    </div>
                    <div class="d-flex ml-1 margin_cari_kodelbli_mobile">
                        <div class="col-md-12 text_all">
                            <label class="text_all_mobile font-weight-bold">Rekomendasi
                                Bangunan</label>
                            <div class="form-group input-group-sm cari_kodekbli_option_mobile">
                                <select class="form-control text_all" id="kegiatan" style="z-index: 9999">

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex ml-1 margin_cari_kodelbli_mobile">
                        <div class="col-md-12 text_all">
                            <label class="text_all_mobile font-weight-bold">Ketentuan : <span class="inf-itbx"></span></label>
                            <div class="form-group input-group-sm cari_kodekbli_option_mobile">
                                <p class="w-100 kbli-ketentuan"></p>
                            </div>
                        </div>
                    </div>
                    {{-- <table style="margin:0;" class="table table-borderless mt-4 table_kbli">
                                            <thead>
                                                <tr>
                                                    <th class="text_all text-center" style="width:30%;">Kode KBLI</th>
                                                    <th class="text_all text-center">Kegiatan</th>
                                                    <th class="text_all text-center">ITBX</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text_all kbli-kode text-center">-</td>
                                                    <td class="text_all kbli-kegiatan">-</td>
                                                    <td class="text_all kbli-itbx text-center">-</td>
                                                </tr>
                                            </tbody>
                                        </table> --}}
                </div>
            </div>

            <div id="kbli-old" style="display: none;">
                <div class="form-kbli">
                    <div class="d-flex ml-1 margin_cari_kodelbli_mobile">
                        <div class="col-md-12 text_all">
                            <label class="text_all_mobile">Kegiatan Ruang</label>
                            <div class="form-group input-group-sm cari_kodekbli_option_mobile">
                                <select class="form-control text_all" id="kegiatanRuang" style="z-index: 9999">

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex ml-1 skala_kodekbli margin_cari_kodelbli_mobile">
                        <div class="col-md-12 text_all">
                            <label class="text_all_mobile">Skala</label>
                            <div class="form-group input-group-sm cari_kodekbli_option_mobile">
                                <select class="form-control" id="skala">

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex ml-1 skala_kodekbli margin_cari_kodelbli_mobile">
                        <div class="col-md-12 text_all">
                            <label class="text_all_mobile">Kegiatan Kewenangan</label>
                            <div class="form-group input-group-sm cari_kodekbli_option_mobile">
                                <select class="form-control" id="kegiatanKewenangan">

                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <table style="margin:0;" class="table table-borderless mt-4 table_kbli">
                    <thead>
                        <tr>
                            <th class="text_all text-center">Kode</th>
                            <th class="text_all text-center">Kegiatan</th>
                            <th class="text_all text-center">Resiko</th>
                            <th class="text_all text-center">ITBX</th>
                        </tr>
                    </thead>
                    <tbody class="dtKBLI">

                    </tbody>
                </table>
            </div>

            <div id="amdal-section" style="display:none">
                <p class="card-title  mt-2 text-center font-weight-bold judul_utama">AMDAL </p>

                <div id="amdal">

                    <div class="d-flex ml-1 margin_cari_kodelbli_mobile">
                        <div class="col-md-12 text_all">
                            <label class="text_all_mobile font-weight-bold">Jenis Usaha</label>
                            <div class="form-group input-group-sm cari_kodekbli_option_mobile">
                                <select class="form-control text_all" id="jenisUsahaAmdal" style="z-index: 9999">

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex ml-1 margin_cari_kodelbli_mobile">
                        <div class="col-md-12 text_all">
                            <label class="text_all_mobile font-weight-bold">Indikator A</label>
                            <div class="form-group input-group-sm cari_kodekbli_option_mobile">
                                <select class="form-control text_all" id="indikatorA" style="z-index: 9999">

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex ml-1 margin_cari_kodelbli_mobile">
                        <div class="col-md-12 text_all">
                            <label class="text_all_mobile font-weight-bold">Parameter A</label>
                            <div class="form-group input-group-sm cari_kodekbli_option_mobile">
                                <select class="form-control text_all" id="parameterA" style="z-index: 9999">

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex ml-1 margin_cari_kodelbli_mobile">
                        <div class="col-md-12 text_all">
                            <label class="text_all_mobile font-weight-bold">Indikator B</label>
                            <div class="form-group input-group-sm cari_kodekbli_option_mobile">
                                <select class="form-control text_all" id="indikatorB" style="z-index: 9999">

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex ml-1 margin_cari_kodelbli_mobile">
                        <div class="col-md-12 text_all">
                            <label class="text_all_mobile font-weight-bold">Parameter B</label>
                            <div class="form-group input-group-sm cari_kodekbli_option_mobile">
                                <select class="form-control text_all" id="parameterB" style="z-index: 9999">

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex ml-1 space_text margin_cari_kodelbli_mobile">
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                            <label class="text_all_mobile">Jenis Izin</label>
                        </div>
                        <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                            <label class="inf-amdal-jenis-izin">-</label>
                        </div>
                    </div>

                    <div class="d-flex ml-1 space_text margin_cari_kodelbli_mobile">
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                            <label class="text_all_mobile">Kategori</label>
                        </div>
                        <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                            <label class="inf-amdal-kategori">-</label>
                        </div>
                    </div>

                    <div class="d-flex ml-1 space_text margin_cari_kodelbli_mobile">
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                            <label class="text_all_mobile">Alasan</label>
                        </div>
                        <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                            <label class="inf-amdal-alasan">-</label>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>

    <div class="tab-pane " id="pills-simulasi" role="tabpanel">
        <div class="container">
            <p class="card-title  mt-2 text-center font-weight-bold judul_utama">Peruntukan Bangunan
            </p>

            <div class="d-flex space_judul row_mid_judul">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text_all">
                    <label class="text_all_mobile">Peruntukan Bangunan</label>
                    <br>
                    <select class="form-control text_all" id="selectSimulasi">
                        <option value="">Pilih</option>
                        @foreach ($option_simulasi as $os)
                        <option value="{{ $os }}">{{ $os }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <p class="card-title mt-4 mb-4 text-center font-weight-bold judul_utama">Profil Lokasi
            </p>

            <div class="simulasi-no-r1">
                <div class="d-flex space_judul row_mid_text">
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                        <label class="text_all_mobile">Luas Lahan</label>
                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                        <p class="inf-simulasi-luaslahan">-</p>
                    </div>
                </div>
                <div class="d-flex space_judul row_mid_text">
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                        <label class="text_all_mobile">KDH</label>
                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                        <p class="inf-simulasi-kdh">-</p>
                    </div>
                </div>
                <div class="d-flex space_judul row_mid_text">
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                        <label class="text_all_mobile">KLB</label>
                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                        <p class="inf-simulasi-klb">-</p>
                    </div>
                </div>
            </div>
            <div class="simulasi-r1" style="display:none;">
                <div class="d-flex space_text row_mid_text">
                    <div class="col-lg-5 text_all">
                        <label class="text_all_mobile">Luas Lahan</label>
                    </div>
                    <div class="col-lg-7 text_all">
                        <p class="inf-simulasi-luas-lahan">-</p>
                    </div>
                </div>

                <div class="d-flex space_text row_mid_text">
                    <div class="col-lg-5 text_all">
                        <label class="text_all_mobile">KDB</label>
                    </div>
                    <div class="col-lg-7 text_all">
                        <p class="inf-simulasi-kdb">-</p>
                    </div>
                </div>

                <div class="d-flex space_text row_mid_text">
                    <div class="col-lg-5 text_all">
                        <label class="text_all_mobile">KLB</label>
                    </div>
                    <div class="col-lg-7 text_all">
                        <p class="inf-simulasi-klb">-</p>
                    </div>
                </div>

                <div class="d-flex space_text row_mid_text">
                    <div class="col-lg-5 text_all">
                        <label class="text_all_mobile">KDH</label>
                    </div>
                    <div class="col-lg-7 text_all">
                        <p class="inf-simulasi-kdh">-</p>
                    </div>
                </div>
            </div>
            {{-- <div class="d-flex space_judul row_mid_text">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Perkiraan NJOP</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <p class="inf-simulasi-njop">-</p>
                                    </div>
                                </div> --}}

            <p class="card-title mt-4 mb-4 text-center font-weight-bold judul_utama">Asumsi
            </p>

            <div class="d-flex space_judul row_mid_text">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 text_all">
                    <label class="text_all_mobile">Pemakaian Air</label>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                    <p class="inf-simulasi-pmkair">-</p>
                </div>
            </div>
            <div class="d-flex space_judul row_mid_text">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 text_all">
                    <label class="text_all_mobile">Debit Air Limbah</label>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                    <p class="inf-simulasi-dbtairlimbah">-</p>
                </div>
            </div>
            <div class="d-flex space_judul row_mid_text">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 text_all">
                    <label class="text_all_mobile">Sampah</label>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                    <p class="inf-simulasi-sampah">-</p>
                </div>
            </div>
            <div class="d-flex space_judul row_mid_text" id="stdluasbangunan">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 text_all">
                    <label class="text_all_mobile">Standar Luas Bangunan</label>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                    <p class="inf-simulasi-stdluasbangunan">-</p>
                </div>
            </div>

            <div class="d-flex space_judul row_mid_text">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 text_all">
                    <label class="text_all_mobile">Kebutuhan Air Bersih</label>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                    <p class="inf-simulasi-kebutuhanairbersih">-</p>
                </div>
            </div>
            <div class="d-flex space_judul row_mid_text">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 text_all">
                    <label class="text_all_mobile">Volume Limpasan Air Hujan</label>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                    <p class="inf-simulasi-volumlimpasanairhujan">-</p>
                </div>
            </div>
            <div class="d-flex space_judul row_mid_text">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 text_all">
                    <label class="text_all_mobile">Jumlah Orang</label>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                    <p class="inf-simulasi-jmlorang">-</p>
                </div>
            </div>

            <p class="card-title mt-4 mb-4 text-center font-weight-bold judul_utama">Kalkulasi Beban
                Lingkungan
            </p>

            <div class="d-flex space_judul row_mid_text">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 text_all">
                    <label class="text_all_mobile">Luas Limpasan Air Hujan</label>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                    <p class="inf-simulasi-luaslimpahan">-</p>
                </div>
            </div>
            <div class="d-flex space_judul row_mid_text">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 text_all">
                    <label class="text_all_mobile">Luas Bangunan</label>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                    <p class="inf-simulasi-luasbangunan">-</p>
                </div>
            </div>
            <div class="d-flex space_judul row_mid_text">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 text_all">
                    <label class="text_all_mobile">Produksi Limbah Cair</label>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                    <p class="inf-simulasi-produksilimbah">-</p>
                </div>
            </div>
            <div class="d-flex space_judul row_mid_text">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 text_all">
                    <label class="text_all_mobile">Produksi Sampah</label>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                    <p class="inf-simulasi-produksisampah">-</p>
                </div>
            </div>

            <div class="d-none">
                <p class="card-title mt-4 mb-4 text-center font-weight-bold judul_utama">Kalkulasi
                    Nilai
                    Aset
                </p>

                <div class="d-flex space_judul row_mid_text">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                        <label class="text_all_mobile">Nilai Tanah</label>
                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                        <p class="inf-simulasi-nilaitanah">-</p>
                    </div>
                </div>
                <div class="d-flex space_judul row_mid_text">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                        <label class="text_all_mobile">Biaya Bangunan /m<sup>2</sup></label>
                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                        <p><input class="text-right number-separator" value="3.000.000" id="biayaBangunan" style="font-size: 11px">
                        </p>
                    </div>
                </div>
                <div class="d-flex space_judul row_mid_text">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                        <label class="text_all_mobile">Nilai Bangunan</label>
                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                        <p class="inf-simulasi-nilaibangunan">-</p>
                    </div>
                </div>
                <div class="d-flex space_judul row_mid_text">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                        <label class="text_all_mobile">Total Nilai</label>
                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                        <p class="inf-simulasi-totalnilai">-</p>
                    </div>
                </div>
            </div>


        </div>


    </div>

    <div class="tab-pane" id="pills-filter" role="tabpanel">
        @php
        $transect_zone = array("TP-1", "TP-2", "TP-3", "TP-4", "TP-5", "TP-6A", "TP-6B");
        $transect_zone_year = array(2010, 2021, 2032);
        @endphp
        <div class="container">
            <p class="card-title  mt-2 text-center font-weight-bold judul_utama">Filter
            </p>

            <div class="col-md-12 text_all">
                <input type="radio" name="option_filter" value="njop">&nbsp;Perkiraan Harga NJOP<br>
                <div class="row">
                    <div class="col-md-12">
                        <input type="number" id="njop_filter" class="w-75" disabled placeholder="Masukkan harga perkiraan...">
                    </div>
                </div>
                <input type="radio" name="option_filter" class="mt-3" value="sub_zona">&nbsp;Sub
                Zonasi Pergub 31/2022<br>
                <div class="row">
                    <div class="col-12">
                        <select id="sub_zona_filter" class="w-75 p-1" disabled>

                        </select>
                    </div><br>
                </div>

                <input type="radio" name="option_filter" class="mt-3" value="transect_zone">&nbsp;Urban Index<br>
                <div class="row">
                    <div class="col-6">
                        <select id="transect_zone_year_filter" class="w-100 p-1" disabled>
                            <option value="">Pilih Tahun</option>
                            @foreach ($transect_zone_year as $item)
                            <option value="{{$item}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <select id="transect_zone_filter" class="w-100 p-1" disabled>
                            <option value="">Pilih Kategori</option>
                            @foreach ($transect_zone as $item)
                            <option value="{{$item}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                </div>

                <input type="radio" name="option_filter" class="mt-3" value="ecci">&nbsp;Environment
                Carrying
                Capacity Index<br>
                <div class="row">
                    <div class="col-md-12">
                        <select id="ecci_filter" class="w-75 p-1" disabled>
                            <option value="">Pilih Kategori</option>
                            <option value="Sangat Rendah">Sangat Rendah</option>
                            <option value="Rendah">Rendah</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Tinggi">Tinggi</option>
                        </select>
                    </div>
                </div>

                <input type="radio" name="option_filter" class="mt-3" value="livability">&nbsp;Livability Index<br>
                <div class="row">
                    <div class="col-md-12">
                        <select id="livability_filter" class="w-75 p-1" disabled>
                            <option value="">Pilih Kategori</option>
                            <option value="Rendah">Rendah</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Tinggi">Tinggi</option>
                            <option value="Sangat Tinggi">Sangat Tinggi</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane " id="pills-andalalin" role="tabpanel">
        <div class="container">
            <p class="card-title  mt-2 text-center font-weight-bold judul_utama">Analisa Dampak Lalu
                Lintas</p>
            <div class="d-flex space_judul row_mid_judul">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text_all">
                    <div class="form-check d-none">
                        <input class="form-check-input" id="enable-direction" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label font-weight-bold" for="defaultCheck1" style="margin-top:2px">
                            Cek Lalu Lintas
                        </label>
                    </div>
                </div>
            </div>
            <div class="inf-andalalin">
                <div class="d-flex space_judul row_mid_judul">
                    <div class=" col-lg-5 text_all">
                        <label class="text_all_mobile">Titik A</label>
                    </div>
                    <div class="col-lg-7 text_all">
                        <p>
                            <input type="text" style="font-size: 11px" class="inf-titika w-100" placeholder="Pilih Titik A" readonly>
                        </p>
                    </div>
                </div>

                <div class="d-flex space_text row_mid_text">
                    <div class=" col-lg-5 text_all">
                        <label class="text_all_mobile">Titik B</label>
                    </div>
                    <div class="col-lg-7 text_all">
                        <p>
                            <input type="text" style="font-size: 11px" class="inf-titikb w-100" placeholder="Pilih Titik B" readonly>
                        </p>
                    </div>
                </div>

                <div class="d-flex space_text row_mid_text">
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                        <label class="text_all_mobile">Jarak</label>
                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                        <p class="inf-titik">-</p>
                    </div>
                </div>

                <div class="d-flex space_text row_mid_text">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text_all">
                        <table class="table-bordered mt-4 w-100">
                            <thead>
                                <tr>
                                    <td class="font-weight-bold" align="center" style="vertical-align: middle; padding:7px;">Jam
                                    </td>
                                    <td class="font-weight-bold" align="center" style="vertical-align: middle; padding:7px;">
                                        Kecepatan (km/jam)</td>
                                    <td class="font-weight-bold" align="center" style="vertical-align: middle; padding:7px;">
                                        Waktu Tempuh (menit)</td>
                                </tr>
                            </thead>
                            <tbody class="inf-direction-data">
                                <tr class="inf-direction-06">
                                    <td align="center">06:00</td>
                                    <td align="center" class="inf-kecepatan-06">-</td>
                                    <td align="center" class="inf-tempuh-06">-</td>
                                </tr>
                                <tr class="inf-direction-09">
                                    <td align="center">09:00</td>
                                    <td align="center" class="inf-kecepatan-09">-</td>
                                    <td align="center" class="inf-tempuh-09">-</td>
                                </tr>
                                <tr class="inf-direction-12">
                                    <td align="center">12:00</td>
                                    <td align="center" class="inf-kecepatan-12">-</td>
                                    <td align="center" class="inf-tempuh-12">-</td>
                                </tr>
                                <tr class="inf-direction-15">
                                    <td align="center">15:00</td>
                                    <td align="center" class="inf-kecepatan-15">-</td>
                                    <td align="center" class="inf-tempuh-15">-</td>
                                </tr>
                                <tr class="inf-direction-18">
                                    <td align="center">18:00</td>
                                    <td align="center" class="inf-kecepatan-18">-</td>
                                    <td align="center" class="inf-tempuh-18">-</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="row mt-4">
                            <div class="col-md-2 text-left">
                                <span style="margin-left: -5px">Lancar</span>
                            </div>
                            <div class="col-md-2" style="background-color: #2ecc71">

                            </div>
                            <div class="col-md-2" style="background-color: #f1c40f">

                            </div>
                            <div class="col-md-2" style="background-color: #e74c3c">

                            </div>
                            <div class="col-md-2" style="background-color: #c0392b">

                            </div>
                            <div class="col-md-2">
                                <span style="margin-left: -5px">Padat</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="tab-pane " id="pills-digitasi" role="tabpanel">
        <div class="container">
            <p class="card-title  mt-2 text-center font-weight-bold judul_utama">Opsi Digitasi</p>
            <div class="d-flex space_judul row_mid_judul">
                <form class="w-100" action="{{ route('digitasi') }}" method="POST" target="_blank" id="formDigitasi">
                    @csrf
                    <div class="ml-3">
                        <div class="alert alert-danger alert-dismissible fade show" id="pesanGagalPrintDigitasi" style="font-size: 10pt" role="alert">
                            <strong>Gagal!</strong> Polygon Digitasi Belum ada.
                        </div>
                        <div class="form-check text_all">
                            <input type="hidden" name="coordinates" id="coorddigitasi" required>
                            <input type="hidden" name="luas" id="luasdigitasi" required>
                            <input class="form-check-input position-static" type="radio" name="opsidigitasi" required value="Persil & NJOP" aria-label="...">
                            NJOP
                            & Persil
                        </div>
                        <div class="form-check text_all">
                            <input class="form-check-input position-static" type="radio" name="opsidigitasi" required value="Akses" aria-label="...">
                            Akses
                        </div>
                        <div class="form-check text_all">
                            <input class="form-check-input position-static" type="radio" name="opsidigitasi" required value="Zonasi" aria-label="...">
                            Zonasi
                        </div>
                        <center>
                            <button type="submit" class="btn btn-sm text_all mt-3 btn-primary" style="margin-right: 2.5rem;">Cetak</button>
                        </center>
                        <!-- <p style="font-size: 14px;" class="card-title  text-center font-weight-bold mt-2">Keterangan</p> -->
                    </div>
                </form>
            </div>
        </div>


    </div>

    <div class="tab-pane " id="pills-simio" role="tabpanel">
        <div class="container">
            {{-- Dampak Pendapatan Rumah Tangga --}}
            {{-- <p class="card-title  mt-2 text-center font-weight-bold judul_utama mb-4">Dampak
                                    Pendapatan
                                    Rumah Tangga</p>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Nilai Investasi</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <input class="w-100 number-separator text-right" id="nilaiInvestasi" value="0"
                                            style="font-size: 11px">
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Sektor</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <select id="sektorInput" class="w-100">
                                        </select>
                                    </div>
                                </div> --}}
            {{-- <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Dampak</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <span class="inf-dampak-io">-</span>
                                    </div>
                                </div> --}}
            {{-- <div class="all-chart">
                                    <div class="d-flex margin_chart_ekonomi_mobile">
                                        <canvas id="bar-io-individu" width="70" height="50"></canvas>
                                    </div>
                                </div> --}}
            {{-- <br> --}}
            {{-- Damapak Pendapatan Bruto --}}
            {{-- <p class="card-title  mt-2 text-center font-weight-bold judul_utama mb-4">Dampak
                                    Pendapatan
                                    Bruto</p>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Nilai Investasi</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <input class="w-100 number-separator text-right" id="nilaiInvestasiBruto"
                                            value="0" style="font-size: 11px">
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Sektor</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <select id="sektorInputBruto" class="w-100">
                                        </select>
                                    </div>
                                </div> --}}

            {{-- <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Koefisien Pendapatan</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <span class="inf-koefisien-io-bruto">-</span>
                                    </div>
                                </div> --}}
            {{-- <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Dampak</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <span class="inf-dampak-io-bruto">-</span>
                                    </div>
                                </div> --}}
            {{-- <div class="all-chart">
                                    <div class="d-flex margin_chart_ekonomi_mobile">
                                        <canvas id="bar-io-bruto" width="70" height="50"></canvas>
                                    </div>
                                </div>
                                <br> --}}
            {{-- Koefisien Tambah Bruto --}}
            {{-- <p class="card-title  mt-2 text-center font-weight-bold judul_utama mb-4">Koefisien
                                    Tambah
                                    Bruto</p>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Nilai Investasi</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <input class="w-100 number-separator text-right" id="nilaiInvestasiTambahBruto"
                                            value="0" style="font-size: 11px">
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Sektor</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <select id="sektorInputTambahBruto" class="w-100">
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Dampak</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <span class="inf-dampak-io-tambah-bruto">-</span>
                                    </div>
                                </div>
                                <br> --}}
            {{-- Koefisien Tenaga Kerja --}}
            {{-- <p class="card-title  mt-2 text-center font-weight-bold judul_utama mb-4">Koefisien
                                    Tenaga
                                    Kerja</p>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Nilai Investasi</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <input class="w-100 number-separator text-right" id="nilaiInvestasiTenagaKerja"
                                            value="0" style="font-size: 11px">
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Sektor</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <select id="sektorInputTenagaKerja" class="w-100">
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Dampak</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <span class="inf-dampak-io-tenaga-kerja">-</span>
                                    </div>
                                </div>
                                <br> --}}
            {{-- Dampak Pengganda Kerja --}}
            {{-- <p class="card-title  mt-2 text-center font-weight-bold judul_utama mb-4">Dampak
                                    Pengganda
                                    Kerja</p>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Nilai Investasi</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <input class="w-100 number-separator text-right"
                                            id="nilaiInvestasiPengadaanKerja" value="0" style="font-size: 11px">
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Sektor</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <select id="sektorInputPengadaanKerja" class="w-100">
                                        </select>
                                    </div>
                                </div>
                                <div class="all-chart">
                                    <div class="d-flex margin_chart_ekonomi_mobile">
                                        <canvas id="bar-io-pengadaan-kerja" width="70" height="50"></canvas>
                                    </div>
                                </div>
                                <br> --}}
            {{-- Koefisien Tertutup --}}
            <p class="card-title mt-2 text-center font-weight-bold judul_utama mb-4">Koefisien
                Tertutup
            </p>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <label class="text_all_mobile">Nilai Investasi</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <input class="w-100 number-separator text-right" id="nilaiInvestasiTertutup" value="0" style="font-size: 11px">
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <label class="text_all_mobile">Sektor</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <select id="sektorInputTertutup" class="w-100">
                    </select>
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <label class="text_all_mobile">Dampak</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <span class="inf-dampak-io-tertutup">-</span>
                </div>
            </div>
            <div class="all-chart">
                <div class="d-flex margin_chart_ekonomi_mobile">
                    <canvas id="bar-io-tertutup" width="70" height="50"></canvas>
                </div>
            </div>
            <br>
            {{-- Leontiff Kebalikan Terbuka --}}
            <p class="card-title text-center font-weight-bold judul_utama mb-4">Leontiff Kebalikan
                Terbuka
            </p>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <label class="text_all_mobile">Nilai Investasi</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <input class="w-100 number-separator text-right" id="nilaiInvestasiLeontiff" value="0" style="font-size: 11px">
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <label class="text_all_mobile">Sektor</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <select id="sektorInputLeontiff" class="w-100">
                    </select>
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <label class="text_all_mobile">Dampak</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <span class="inf-dampak-io-leontiff">-</span>
                </div>
            </div>
            <div class="all-chart">
                <div class="d-flex margin_chart_ekonomi_mobile">
                    <canvas id="bar-io-leontiff" width="70" height="50"></canvas>
                </div>
            </div>
            <br>
            {{-- Dampak Pendapatan--}}
            <p class="card-title text-center font-weight-bold judul_utama mb-4">Dampak Pendapatan
            </p>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <label class="text_all_mobile">Nilai Investasi</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <input class="w-100 number-separator text-right" id="nilaiInvestasiDampakPendapatan" value="0" style="font-size: 11px">
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <label class="text_all_mobile">Sektor</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <select id="sektorInputDampakPendapatan" class="w-100">
                    </select>
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <label class="text_all_mobile">Dampak</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <span class="inf-dampak-io-dampak-pendapatan">-</span>
                </div>
            </div>
            <div class="all-chart">
                <div class="d-flex margin_chart_ekonomi_mobile">
                    <canvas id="bar-io-dampak-pendapatan" width="70" height="50"></canvas>
                </div>
            </div>
            <br>
            {{-- Dampak Pendapatan Bruto --}}
            <p class="card-title text-center font-weight-bold judul_utama mb-4">Dampak Bruto
            </p>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <label class="text_all_mobile">Nilai Investasi</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <input class="w-100 number-separator text-right" id="nilaiInvestasiDampakPendapatanBruto" value="0" style="font-size: 11px">
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <label class="text_all_mobile">Sektor</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <select id="sektorInputDampakPendapatanBruto" class="w-100">
                    </select>
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <label class="text_all_mobile">Dampak</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <span class="inf-dampak-io-dampak-pendapatan-bruto">-</span>
                </div>
            </div>
            <div class="all-chart">
                <div class="d-flex margin_chart_ekonomi_mobile">
                    <canvas id="bar-io-dampak-pendapatan-bruto" width="70" height="50"></canvas>
                </div>
            </div>
            <br>
            {{-- Pengganda Dampak Kerja--}}
            <p class="card-title text-center font-weight-bold judul_utama mb-4">Pengganda Dampak
                Kerja
            </p>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <label class="text_all_mobile">Nilai Investasi</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <input class="w-100 number-separator text-right" id="nilaiInvestasiPenggandaDampakKerja" value="0" style="font-size: 11px">
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <label class="text_all_mobile">Sektor</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <select id="sektorInputPenggandaDampakKerja" class="w-100">
                    </select>
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <label class="text_all_mobile">Dampak</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <span class="inf-dampak-io-pengganda-dampak-kerja">-</span>
                </div>
            </div>
            <div class="all-chart">
                <div class="d-flex margin_chart_ekonomi_mobile">
                    <canvas id="bar-io-pengganda-dampak-kerja" width="70" height="50"></canvas>
                </div>
            </div>
            <br>
            {{-- Keterkaitan Hulu Hilir--}}
            <p class="card-title text-center font-weight-bold judul_utama mb-4">Keterkaitan
                Hulu Hilir
            </p>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <label class="text_all_mobile">Nilai Investasi</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <input class="w-100 number-separator text-right" id="nilaiInvestasiKeterkaitanHuluHilir" value="0" style="font-size: 11px">
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <label class="text_all_mobile">Sektor</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <select id="sektorInputKeterkaitanHuluHilir" class="w-100">
                    </select>
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <label class="text_all_mobile">Dampak</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <span class="inf-dampak-io-keterkaitan-hulu-hilir">-</span>
                </div>
            </div>
            <div class="all-chart">
                <div class="d-flex margin_chart_ekonomi_mobile">
                    <canvas id="bar-io-keterkaitan-hulu-hilir" width="70" height="50"></canvas>
                </div>
            </div>
            <br>
            {{-- <p class="card-title  mt-2 text-center font-weight-bold judul_utama mb-4">Dampak
                                    Pendapatan
                                    Bruto</p>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Sektor</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <select id="sektorInputBruto" class="w-100">
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Nilai Investasi</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <input class="w-100 number-separator text-right" id="nilaiInvestasiBruto"
                                            value="0" style="font-size: 11px">
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Sektor Terdampak</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <select id="sektorTerdampakInputBruto" class="w-100">
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Koefisien Pendapatan</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <span class="inf-koefisien-io-bruto">-</span>
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                                        <label class="text_all_mobile">Dampak Pendapatan</label>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <span class="inf-dampak-io-bruto">-</span>
                                    </div>
                                </div> --}}
        </div>


    </div>

    <div class="tab-pane " id="pills-index" role="tabpanel">
        <div class="container">
            <p class="card-title  mt-2 text-center font-weight-bold judul_utama">Urban Index</p>
            {{-- <h4 class="card-title mt-1 text-center font-weight-bold inf-urban-index-ml"
                                    align="center">
                                    -
                                </h4> --}}
            {{-- <div class="d-flex space_judul row_mid_text">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text_all">
                                        <p class="inf-urban-kategori-umum-ml w-100 text-center" style="
                                    font-size: 16px;
                                    font-weight: bold;
                                ">-</p>
                                        <p align="center" style="font-size: 14px;">(Analisis Citra Satelit dan
                                            Machine Learning)</p>
                                    </div>
                                </div>
                                <br> --}}
            <h4 class="card-title mt-1 text-center font-weight-bold inf-urban-index" align="center">
                -
            </h4>
            <div class="d-flex space_judul row_mid_text">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text_all">
                    <p class="inf-urban-kategori-umum w-100 text-center" style="
                                    font-size: 16px;
                                    font-weight: bold;
                                    ">-</p>
                    {{-- <p align="center" style="font-size: 14px;">(Analisis Lanjutan
                                            Aksesibilitas)</p> --}}
                </div>
            </div>

            <div class="d-flex space_judul row_mid_text mt-2">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text_all">
                    <ol class="inf-urban-deskripsi-khusus"></ol>
                    {{-- <ol>
                                            <li class="inf-urban-j_jlnarter" style="margin-left:-25px;">-</li>
                                            <li class="inf-urban-j_jlnkolek" style="margin-left:-25px;">-</li>
                                            <li class="inf-urban-j_jlnling" style="margin-left:-25px;">-</li>
                                            <li class="inf-urban-j_ttktrnst" style="margin-left:-25px;">-</li>
                                            <li class="inf-urban-jrk_mall" style="margin-left:-25px;">-</li>
                                            <li class="inf-urban-jrk_mnmrkt" style="margin-left:-25px;">-</li>
                                            <li class="inf-urban-jrk_pasar" style="margin-left:-25px;">-</li>
                                            <li class="inf-urban-mixed_use" style="margin-left:-25px;">-</li>
                                        </ol> --}}
                </div>
            </div>
            <br>
            <p class="card-title  mt-2 text-center font-weight-bold judul_utama">Environment
                Carrying
                Capacity Index</p>

            <h3 class="card-title mt-1 text-center inf-index-score" align="center">0
            </h3>
            <div class="d-flex space_judul row_mid_text">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text_all">
                    <p class="inf-index-eci w-100 text-center" style="
                                    font-size: 16px;
                                    font-weight: bold;
                                ">-</p>
                </div>
            </div>
            <div class="all-chart">
                <div class="d-flex margin_chart_ekonomi_mobile ml-3">
                    <canvas id="radar-chart" width="70" height="50"></canvas>
                </div>
            </div>
            <br>

            <div class="d-flex space_judul row_mid_text mb-2">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text_all">
                    <span class="font-weight-bold">Topografi</span>
                    <ol>
                        <li class="inf-index-topografi" style="margin-left:-25px;">-</li>
                    </ol>
                </div>
            </div>

            <div class="d-flex space_judul row_mid_text mb-2">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text_all">
                    <span class="font-weight-bold">Kebencanaan</span>
                    <ol>
                        <li class="inf-index-risk-banjir" style="margin-left:-25px;">-</li>
                        <li class="inf-index-risk-landsub" style="margin-left:-25px;">-</li>
                        <li class="inf-index-risk-kebakaran" style="margin-left:-25px;">-</li>
                    </ol>
                </div>
            </div>

            <div class="d-flex space_judul row_mid_text mb-2">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text_all">
                    <span class="font-weight-bold">Ketersediaan Air</span>
                    <ol>
                        <li class="inf-index-air-tanah" style="margin-left:-25px;">-</li>
                        <li class="inf-index-pipa-air" style="margin-left:-25px;">-</li>
                    </ol>
                </div>
            </div>

            <div class="d-flex space_judul row_mid_text mb-2">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text_all">
                    <span class="font-weight-bold">Kualitas Vegetasi</span>
                    <ol>
                        <li class="inf-index-kualitas-vegetasi" style="margin-left:-25px;">-</li>
                    </ol>
                </div>
            </div>

            <div class="d-flex space_judul row_mid_text mb-2">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text_all">
                    <span class="font-weight-bold">Pengolahan Limbah</span>
                    <ol>
                        <li class="inf-index-jaringan-ipal" style="margin-left:-25px;">-</li>
                        <li class="inf-index-ket-tps" style="margin-left:-25px;">-</li>
                    </ol>
                </div>
            </div>

            <p class="card-title  mt-2 text-center font-weight-bold judul_utama">Livability Index
            </p>
            <h3 class="card-title mt-1 text-center inf-liveability-index" align="center">0
            </h3>
            <div class="d-flex space_judul row_mid_text">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text_all">
                    <p class="w-100 text-center inf-index-livability-desc" style="
                                    font-size: 16px;
                                    font-weight: bold;
                                ">-
                    </p>
                </div>
            </div>
            <div class="all-chart ml-3" style="margin-top:-8%;">
                <div class="d-flex margin_chart_ekonomi_mobile">
                    <canvas id="radar-chart-liveability" width="70" height="50"></canvas>
                </div>

            </div>
            <br>
            <div class="d-flex space_judul row_mid_text">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text_all">
                    <ol>
                        <li class="inf-index-indeks_kon" style="margin-left:-25px;">-</li>
                        <li class="inf-index-ruang_terbuka" style="margin-left:-25px;">-</li>
                        <li class="inf-index-fasilitas" style="margin-left:-25px;">-</li>
                        <li class="inf-index-budaya" style="margin-left:-25px;">-</li>
                        <li class="inf-index-pekerjaan" style="margin-left:-25px;">-</li>
                        <li class="inf-index-pelayanan" style="margin-left:-25px;">-</li>
                        <li class="inf-index-pendidikan" style="margin-left:-25px;">-</li>
                        <li class="inf-index-transportasi" style="margin-left:-25px;">-</li>
                        <li class="inf-index-entropy" style="margin-left:-25px;">-</li>
                    </ol>
                </div>
            </div>

        </div>


    </div>

    <div class="tab-pane " id="pills-potensi" role="tabpanel">
        <div class="container">
            <p class="card-title  mt-2 text-center font-weight-bold judul_utama">Asumsi
            </p>

            <div class="d-flex row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Fungsi Bangunan</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <select id="list-potensi-bangunan" style="width: 9rem">
                        <option value="7500000">Apartemen Sewa</option>
                        <option value="7500000">Apartemen Dijual</option>
                        <option value="9000000">Perkantoran Sewa</option>
                        <option value="7500000">Perbelanjaan Sewa</option>
                        <option value="5000000">Rumah Susun Dijual</option>
                        <option value="5000000">Rumah Tapak Dijual</option>
                    </select>
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Luas Lahan (m<sup>2</sup>)</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <input type="text" onkeyup="potensi()" style="font-size: 11px; text-align: right;" class="inf-potensi-luas-lahan number-separator" value="3.000">
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Luas Lahan Efektif (%)</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <input type="number" onkeyup="potensi()" value="80" style="font-size: 11px; text-align: right;" class="inf-potensi-luas-lahan-efektif">
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">KLB</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <input type="text" onkeyup="potensi()" style="font-size: 11px; text-align: right;" class="inf-potensi-klb number-separator" value="11">
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Luas Bangunan (m<sup>2</sup>)</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <input type="text" style="font-size: 11px; text-align: right;" class="inf-potensi-luas-bangunan number-separator text-secondary" readonly>
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Perkiraan NJOP (Rp/m<sup>2</sup>)</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <input type="text" onkeyup="potensi()" style="font-size: 11px; text-align: right;" class="inf-potensi-perkiraan-njop number-separator">
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Faktor pengali (%)</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <input type="text" onkeyup="potensi()" style="font-size: 11px; text-align: right;" class="inf-potensi-faktor-pengali number-separator">
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Harga Tanah (Rp/m<sup>2</sup>)</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <input type="text" onkeyup="potensi()" style="font-size: 11px; text-align: right;" class="inf-potensi-harga-tanah number-separator">
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Harga Jual (Rp/m<sup>2</sup>)</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <input type="text" onkeyup="potensi()" value="30.000.000" style="font-size: 11px; text-align: right;" class="inf-potensi-harga-jual number-separator">
                </div>
            </div>
            <div class="d-none row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Biaya Maintenance (%)</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <input type="text" onkeyup="potensi()" value="20" style="font-size: 11px; text-align: right;" class="inf-potensi-biaya-maintenance number-separator">
                </div>
            </div>
            <div class="d-none row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Cost of Capital (%)</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <input type="text" onkeyup="potensi()" value="15" style="font-size: 11px; text-align: right;" class="inf-potensi-cost-of-capital number-separator">
                </div>
            </div>
            <div class="d-none row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Property Market Index (%)</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <input type="text" onkeyup="potensi()" value="5" style="font-size: 11px; text-align: right;" class="inf-potensi-property-market-index number-separator">
                </div>
            </div>
            <div class="d-none row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Setara Harga Jual (Rp/m<sup>2</sup>)</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <input type="text" onkeyup="potensi()" value="0" style="font-size: 11px; text-align: right;" class="inf-potensi-setara-harga-jual number-separator text-secondary" readonly>
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Durasi Proyek (thn)</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <input type="text" onkeyup="potensi()" value="5" style="font-size: 11px; text-align: right;" class="inf-potensi-durasi-proyek number-separator">
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Biaya Konstruksi (Rp/m<sup>2</sup>)</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <input type="text" onkeyup="potensi()" value="7.500.000" style="font-size: 11px; text-align: right;" class="inf-potensi-biaya-konstruksi number-separator">
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Biaya Perencanaan (%)</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <input type="number" onkeyup="potensi()" value="3" style="font-size: 11px; text-align: right;" class="inf-potensi-biaya-perencanaan">
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Kewajiban Lingkungan (%)</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all">
                    <input type="number" onkeyup="potensi()" value="20" style="font-size: 11px; text-align: right;" class="inf-potensi-kewajiban-lingkungan">
                </div>
            </div>

            <p class="card-title  mt-3 text-center font-weight-bold judul_utama">Pendapatan (Rp)</p>
            {{-- <div class="d-flex row_mid_judul">
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                                        <label class="text_all_mobile">Pendapatan Sewa</label>
                                    </div>
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all text-right">
                                        <span class="inf-potensi-penerimaan-sewa">0</span>
                                    </div>
                                </div> --}}
            <div class="d-flex row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Pendapatan Penjualan</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all text-right">
                    <span class="inf-potensi-penerimaan-penjualan">0</span>
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile font-weight-bold">Total Pendapatan</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all text-right">
                    <span class="inf-potensi-sub-jumlah-penjualan">0</span>
                </div>
            </div>

            <p class="card-title  mt-3 text-center font-weight-bold judul_utama">Pengeluaran (Rp)
            </p>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Perolehan Tanah</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all text-right">
                    <span class="inf-potensi-perolehan-tanah">0</span>
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Biaya Konstruksi</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all text-right">
                    <span class="inf-potensi-biaya-konstruksi-pengeluaran">0</span>
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile">Biaya Perencanaan</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all text-right">
                    <span class="inf-potensi-biaya-perencanaan-pengeluaran">0</span>
                </div>
            </div>
            <div class="d-flex row_mid_judul">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile font-weight-bold">Total Pengeluaran</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all text-right">
                    <span class="inf-potensi-sub-jumlah-pengeluaran">0</span>
                </div>
            </div>
            <div class="d-flex row_mid_judul mt-4">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile font-weight-bold">Kewajiban Lingkungan</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all text-right">
                    <span class="inf-potensi-kewajiban-lingkungan-pengeluaran">0</span>
                </div>
            </div>
            <div class="d-flex row_mid_judul mt-2">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile font-weight-bold">Estimasi Laba</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all text-right">
                    <span class="inf-potensi-estimasi-laba">0</span>
                </div>
            </div>
            <div class="d-flex row_mid_judul mt-2">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile font-weight-bold">ROI</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all text-right">
                    <span class="inf-potensi-return-of-invesment">0</span>
                </div>
            </div>
            <div class="d-flex row_mid_judul mt-2">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text_all">
                    <label class="text_all_mobile font-weight-bold">IRR</label>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text_all text-right">
                    <span class="inf-potensi-irr">0</span>
                </div>
            </div>
        </div>
        {{-- <div class="container">
                                <p class="card-title  mt-2 text-center font-weight-bold judul_utama">Potensi</p>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <label class="text_all_mobile">Fungsi Bangunan</label>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <select id="list-potensi-bangunan">
                                            <option>Pilih Jenis Bangunan</option>
                                            <option value="7500000">Apartemen</option>
                                            <option value="1500000">Gedung Parkir</option>
                                            <option value="5250000">Hotel Bintang 1 dan 2</option>
                                            <option value="7500000">Hotel Bintang 3</option>
                                            <option value="9750000">Hotel Bintang 4 dan 5</option>
                                            <option value="9000000">Kantor</option>
                                            <option value="7500000">Perbelanjaan</option>
                                            <option value="9750000">Perbelanjaan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <label class="text_all_mobile">Luas Lahan (m<sup>2</sup>)</label>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <span class="inf-potensi-luas-lahan">-</span>
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <label class="text_all_mobile">Luas Bangunan (m<sup>2</sup>)</label>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <span class="inf-potensi-luas-bangunan">-</span>
                                    </div>
                                </div>
                                <p class="card-title mt-3 text-center font-weight-bold judul_utama">Penerimaan (x Rp
                                    1000)
                                </p>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <label class="text_all_mobile">Harga Jual (m<sup>2</sup>)</label>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <input type="text" class="text-right number-separator inf-potensi-harga-jual"
                                            style="font-size: 11px" value="30.000.000">
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <label class="text_all_mobile">Total Penjualan</label>
                                    </div>
                                    <div class="text-right col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <span class="inf-potensi-total-penerimaan-penjualan">-</span>
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <label class="text_all_mobile">Total Penerimaan</label>
                                    </div>
                                    <div class="text-right col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <span class="inf-potensi-total-penerimaan">-</span>
                                    </div>
                                </div>
                                <p class="card-title mt-3 text-center font-weight-bold judul_utama">Pengeluaran (x Rp
                                    1000)
                                </p>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <label class="text_all_mobile">Harga NJOP</label>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <span class="inf-potensi-harga-njop">-</span>
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <label class="text_all_mobile">Biaya Perolehan Tanah</label>
                                    </div>
                                    <div class="text-right col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <span class="inf-potensi-total-biaya-perolehan-tanah">-</span>
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <label class="text_all_mobile">Biaya Konstruksi per m<sup>2</sup></label>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <span class="inf-potensi-biaya-konstruksi">-</span>
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <label class="text_all_mobile">Total Biaya Konstruksi</label>
                                    </div>
                                    <div class="text-right col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <span class="inf-potensi-total-biaya-konstruksi">-</span>
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <label class="text_all_mobile font-weight-bold">Total Pengeluaran</label>
                                    </div>
                                    <div class="text-right col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <span class="inf-potensi-total-pengeluaran">-</span>
                                    </div>
                                </div>
                                <p class="card-title mt-3 text-center font-weight-bold judul_utama"></p>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <label class="text_all_mobile">Kewajiban Lingkungan</label>
                                    </div>
                                    <div class="text-right col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <span class="inf-potensi-biaya-kewajiban-lingkungan">-</span>
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <label class="text_all_mobile font-weight-bold">ESTIMASI LABA</label>
                                    </div>
                                    <div class="text-right col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <span class="inf-potensi-estimasi-laba">-</span>
                                    </div>
                                </div>
                                <div class="d-flex row_mid_judul">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <label class="text_all_mobile font-weight-bold">ROI</label>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text_all">
                                        <span class="inf-potensi-return-on-invesment">-</span>
                                    </div>
                                </div>
                            </div> --}}
    </div>

    <div class="tab-pane " id="pills-resiko" role="tabpanel">
        <div class="container" style="height:100vh">
            <p class="card-title  mt-2 text-center font-weight-bold judul_utama">Resiko
            </p>
        </div>
    </div>


    <!-- PENDING Content Pin,Komen,kbliLokasi,Kalkulator,HBU-->


    </div>

    </div>


    </div>
    </div>
    </div>
    <!-- Peta -->


    <div class="d-flex flex-col justify-content-end">
        <div class="d-flex justify-content-end pr-3" style="z-index: 9">

            <div class="flex flex-column" style="display: none">
                <div id="legend" class="bg-white" style="float: right;margin-right:0.3rem;width:30px;margin-top:2rem; border-radius:5px">
                    <div class="dropleft" style="display: none">
                        <button id="dropdownLayer" data-toggle="dropdown" class="ri-stack-line p-1" aria-haspopup="true" aria-expanded="false" title="Peta Dasar" style="border:none;background:none;width:30px; height:30px; outline:none; font-size:14px">

                        </button>
                        <ul class="dropdown-menu keep-open p-2" id="menu" aria-labelledby="dropdownLayer" style="font-size: 12px;margin-top: 5px;border: none;">
                            <li style="margin-bottom:10px; "><b>Peta Dasar</b></li>
                            <li>
                                <div class="form-check form-check-inline mr-5">
                                    <input style="height:20px;" class="form-check-input" type="radio" name="rtoggle" id="ckp4wrapq11m117pf2lr49l5t" value="ckp4wrapq11m117pf2lr49l5t" />
                                    <label class="form-check-label pl-1" for="ckp4wrapq11m117pf2lr49l5t">Default</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check form-check-inline mr-5">
                                    <input style="height:20px;" class="form-check-input" type="radio" name="rtoggle" id="ckp6i54ay22u818lrq15ffcnr" value="ckp6i54ay22u818lrq15ffcnr" checked="checked" />
                                    <label class="form-check-label pl-1" for="ckp6i54ay22u818lrq15ffcnr">Satellite</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check form-check-inline mr-5">
                                    <input style="height:20px;" class="form-check-input" type="radio" name="rtoggle" id="ckp6i6bgp2jn217pfp6wm5syk" value="ckp6i6bgp2jn217pfp6wm5syk" />
                                    <label class="form-check-label pl-1" for="ckp6i6bgp2jn217pfp6wm5syk">Streets</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="text-center border-top">
                        {{-- @if (Auth::check()) --}}
                        {{-- <button type="button" id="btnInteractive" title="Data Interaktif" class="ri-line-chart-fill p-0" style="width:30px; height:30px; outline:none; font-size:14px; border:none; background: none;">
                        </button> --}}
                    </div>
                    {{-- <div class="dropleft text-center border-bottom border-top">
                        <button onclick="cekLoginChat()" type="button" id="btnChat" title="Konsultasi Wilayah"
                            class="ri-phone-line p-0" data-toggle="dropdown"
                            style=" width:32px; height:30px; outline:none; font-size:14px; border:none;background: none;">
                        </button>
                        <div class="dropdown-menu" id="frameChat"
                            style="background: none; width:300px; border:none; margin-top:-10px">
                        </div>
                    </div> --}}
                </div>
                <div id="legend" class="bg-white" style="float: right;margin-right: -1.9rem;width:30px;margin-top: 8rem;border-radius:5px">
                    @can('Pengawasan')
                    <div class="dropleft text-center">
                        {{-- @if (Auth::check()) --}}
                        <button type="button" onclick="pinLocation()" id="btnPin" title="Pengawasan" class="ri-pushpin-line p-0" style="width:30px; height:30px; outline:none; font-size:14px; border:none; background: none;">
                        </button>
                    </div>
                    @endcan
                    @can('Survey Perkembangan Wilayah')
                    <div class="text-center border-top">
                        {{-- @if (Auth::check()) --}}
                        <button type="button" class="ri-bookmark-line p-0" title="Survey Perkembangan Wilayah" onclick="surveyLocation()" style="width:30px; height:30px; outline:none; font-size:14px; border:none; background: none;">
                        </button>
                    </div>
                    @endcan
                    @can('Pendataan Usaha')
                    <div class="text-center border-top">
                        {{-- @if (Auth::check()) --}}
                        <button type="button" onclick="usahaLocation()" class="ri-building-2-line p-0" title="Pendataan Usaha" style="width:30px; height:30px; outline:none; font-size:14px; border:none; background: none;">
                        </button>
                    </div>
                    @endcan

                    {{-- <div class="text-center border-top">
                        <button id="createSHP" type="button" onclick="document.getElementById('btnSHP').click()"
                            title="Plot SHP" class="ri-file-code-line p-0"
                            style="width:30px; height:30px; outline:none; font-size:14px; border:none; background: none;">
                        </button>
                    </div> --}}
                    @can('Izin Lingkungan')
                    <div class="text-center border-top">
                        {{-- @if (Auth::check()) --}}
                        <button type="button" title="Izin Lingkungan" onclick="getDataIzin();" class="ri-home-2-line p-0" style="width:30px; height:30px; outline:none; font-size:14px; border:none; background: none;">
                        </button>
                    </div>
                    @endcan
                    {{-- <div class="text-center border-top">
                        <button type="button" title="PesanAJIB" class="ri-motorbike-fill p-0" onclick="pesan_ajib()" style="width:30px; height:30px; outline:none; font-size:14px; border:none; background: none;">
                        </button>
                    </div>
                    <div class="text-center border-top" id="praPermohonan">
                        <button type="button" title="PraPermohonan" class="ri-mail-settings-line p-0" style="width:30px; height:30px; outline:none; font-size:14px; border:none; background: none;">
                        </button>
                    </div> --}}
                    {{-- <button class="btn btn-sm mt-1 ">
                        <div class="container dropleft">
                            <div class="row">
                                <div id="dropdownChat" class="ri-phone-line bg-white p-1 text-secondary"
                                    data-toggle="dropdown"
                                    style="border-radius: 50%; width:30px; height:30px; font-size:15px"></div>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownChat"
                                style="position: relative;font-size: 12px;margin-top: 5px;border: none;">
                                <h1>Test</h1>
                            </div>
                        </div>
                    </button> --}}
                </div>

            </div>

        </div>

    </div>
    {{-- @can('Pendataan Usaha')
    <div id="chat-usaha">
        <a href="{{ route('konsultasi') }}" target="_blank" title="Konsultasi Usaha">
    <img src="{{ asset('assets/gambar/chat.png') }}">
    </a>
    </div>
    @endcan --}}

    <div id="legend-izin-lingkungan" class="card p-1" style="display:none;">
        <table class="card-table table-vcenter" style="font-size: 9pt">
            <tbody>
                <tr class=" p-0">
                    <td class=" p-0 hide_border_legend">
                        <div class="d-flex flex-row align-items-center  p-0">
                            <div class="avatar text-white bg-success" style="width: 8px; height:8px; border-radius:0 !important;">
                            </div>
                    </td>
                    <td class="p-1 hide_border_legend" style="line-height: normal;">Berkas
                        Sudah Terbit</td>
                </tr>
                <tr class=" p-0">
                    <td class=" p-0 hide_border_legend">
                        <div class="d-flex flex-row align-items-center  p-0">
                            <div class="avatar text-white bg-danger" style="width: 8px; height:8px; border-radius:0 !important;">
                            </div>
                        </div>
                    </td>
                    <td class="p-1 hide_border_legend" style="line-height: normal;">Berkas
                        Sudah Ditolak</td>
                </tr>
                <tr class=" p-0">
                    <td class=" p-0 hide_border_legend d-flex flex-row align-items-start" style="margin-top:7px;">
                        <div class="d-flex flex-row align-items-center  p-0">
                            <div class="avatar text-white bg-danger" style="width: 8px; height:8px; border-radius:0 !important;">
                            </div>
                        </div>
                    </td>
                    <td class="p-1 hide_border_legend" style="line-height: normal;">Berkas
                        Sudah Dibatalkan
                        Sistem</td>
                </tr>
                <tr class=" p-0">
                    <td class=" p-0 hide_border_legend d-flex flex-row align-items-start" style="margin-top:7px;">
                        <div class="d-flex flex-row align-items-center  p-0">
                            <div class="avatar text-white bg-warning" style="width: 8px; height:8px; border-radius:0 !important;">
                            </div>
                        </div>
                    </td>
                    <td class="p-1 hide_border_legend" style="line-height: normal;">
                        Berkas
                        Sedang Diproses
                        oleh
                        Wilayah</td>
                </tr>
                <tr class=" p-0">
                    <td class="p-0 hide_border_legend d-flex flex-row align-items-start" style="margin-top:7px;">
                        <div class="d-flex flex-row align-items-center  p-0">
                            <div class="avatar text-white" style="width: 8px; height:8px; border-radius:0 !important; background:orange">
                            </div>
                        </div>
                    </td>
                    <td class="p-1 hide_border_legend" style="line-height: normal;">Berkas
                        Perlu Disposisi
                        Pimpinan</td>
                </tr>
            </tbody>
        </table>
    </div>
    {{-- <div class="detail_omzet" id="legends"></div>
    <div class="detail_jumlah" id="features">
        <strong class="border-bottom">Detail Omzet</strong>
        <div id="pd">
            <p></p>
        </div>
    </div> --}}
    <!-- End Peta -->

    <!-- Detail Omzet -->
    {{-- <div class="detail_omzet">
        <div class="container">
            <div class="text_all" id="legends">

            </div>
        </div>
    </div> --}}
    <!-- End Detail Omzet -->

    {{-- Legend Layer Urban --}}


    <div class="legend-analisa-gis" style="display:none;">
        <div class="ml-2">
            <div>
                <span class="legend-key" style="background: #5C5C5C"></span><span style="font-size:12px;font-weight:bold;">SD (Special District)</span>
            </div>
            <div>
                <span class="legend-key" style="background: #38A800"></span><span style="font-size:12px;font-weight:bold;">T1 (Natural)</span>
            </div>
            <div>
                <span class="legend-key" style="background: #ffff00"></span><span style="font-size:12px;font-weight:bold;">T2 (Rural)</span>
            </div>
            <div>
                <span class="legend-key" style="background: #FFEBAF "></span><span style="font-size:12px;font-weight:bold;">T3 (Sub-Urban)</span>
            </div>
            <div>
                <span class="legend-key" style="background: #FFAA00 "></span><span style="font-size:12px;font-weight:bold;">T4 (Urban) - termasuk Kampung Kota
                </span>
            </div>
            <div>
                <span class="legend-key" style="background: #FF7F7F "></span><span style="font-size:12px;font-weight:bold;">T5 (Urban Center)</span>
            </div>
            <div>
                <span class="legend-key" style="background: #FF0000 "></span><span style="font-size:12px;font-weight:bold;">T6 (Urban Core) - termasuk T6a dan T6b</span>
            </div>
        </div>
    </div>

    <div class="legend-analisa-gis-perda" style="display:none;">
        <div class="ml-2">
            <div>
                <span class="legend-key" style="background: #5C5C5C"></span><span style="font-size:12px;font-weight:bold;">SD (Special District)</span>
            </div>
            <div>
                <span class="legend-key" style="background: #38A800"></span><span style="font-size:12px;font-weight:bold;">T1 (Natural)</span>
            </div>
            <div>
                <span class="legend-key" style="background: #ffff00"></span><span style="font-size:12px;font-weight:bold;">T2a (Rural)</span>
            </div>
            <div>
                <span class="legend-key" style="background: #ffff00"></span><span style="font-size:12px;font-weight:bold;">T2b (Kampung)</span>
            </div>
            <div>
                <span class="legend-key" style="background: #FFEBAF "></span><span style="font-size:12px;font-weight:bold;">T3 (Sub-Urban)</span>
            </div>
            <div>
                <span class="legend-key" style="background: #FFAA00 "></span><span style="font-size:12px;font-weight:bold;">T4 (Urban)</span>
            </div>
            <div>
                <span class="legend-key" style="background: #FF7F7F "></span><span style="font-size:12px;font-weight:bold;">T5 (Urban Center)</span>
            </div>
            <div>
                <span class="legend-key" style="background: #FF0000 "></span><span style="font-size:12px;font-weight:bold;">T6 (Urban Core) - termasuk T6a dan T6b</span>
            </div>
        </div>
    </div>

    <!-- Detail Jumlah -->
    <div class="detail_jumlah" style="display: none;">
        <div class="container">
            <span class="text_all font-weight-bold">Filter Data Interaktif </span>

            <div class="text_all">
                <div class="row">
                    <div class="col-md-12">
                        <select class="w-100" id="optionFilterChoro">
                            <option value="Total Omzet UMKM">(DPMPTSP) Total Omzet UMKM</option>
                            <option value="Kepadatan Bangunan">(DPMPTSP) Jumlah Bangunan</option>
                            <option value="Pekerjaan">(RBI) Pekerjaan</option>
                            <option value="Pendidikan">(RBI) Pendidikan</option>
                            <option value="Agama">(RBI) Agama</option>
                            <option value="Jumlah Penduduk">(RBI) Jumlah Penduduk</option>
                            <option value="Kepadatan Penduduk">(RBI) Kepadatan Penduduk</option>
                            <option value="Data PPAP">(DPPAPP) Kependudukan</option>
                        </select>
                    </div>
                    <div class="col-md-12" id="filterChoro">
                        <div class="row">
                            <div class="col-md-12 mt-2 mb-2">
                                {{-- <span for="amount" class="text_all font-weight-bold">Total Omzet:</span> --}}
                                <span id="amount" class="w-100" style="border:0; color:#f6931f; font-weight:bold;"></span>
                                <div id="slider-range"></div>
                            </div>
                            <div class="col-md-6">
                                <span for="amount" class="text_all font-weight-bold">Range Omzet:</span>
                                <div class="text_all" id="legends">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <span for="amount" class="text_all font-weight-bold">Nama Kelurahan:</span>
                                <div id="pd">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Detail Jumlah -->

    {{-- ScreenShoot Map --}}
    <div id="screenshotPlaceholder"></div>
    {{-- <div class="runing-text" data-duplicated='false' data-direction='left'>-</div> --}}


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
        // Function to convert string in Rupiah format to number
        // function convertToNumber(rupiah) {
        // return parseInt(rupiah.replace('Rp ', '').replace('.', '').replace('.', ''));
        // }

        // // Data dalam format Rupiah
        // const dataBerasCianjurKepala = ["Rp 14.000", "Rp 16.000.000", "Rp 18.000.000", "Rp 19.000.000", "Rp 20.000.000", "Rp 15.000.000", "Rp 17.000.000"];
        // const dataBerasCianjurSlyp = ["Rp 15.000.000", "Rp 17.000.000", "Rp 16.000.000", "Rp 18.000.000", "Rp 19.000.000", "Rp 14.000.000", "Rp 20.000.000"];
        // const dataBerasSetra = ["Rp 18.000.000", "Rp 20.000.000", "Rp 15.000.000", "Rp 17.000.000", "Rp 14.000.000", "Rp 19.000.000", "Rp 16.000.000"];
        // const dataBerasSaigon = ["Rp 16.000.000", "Rp 18.000.000", "Rp 19.000.000", "Rp 20.000.000", "Rp 17.000.000", "Rp 14.000.000", "Rp 15.000.000"];
        // const dataBerasMuncul1 = ["Rp 17.000.000", "Rp 14.000.000", "Rp 16.000.000", "Rp 20.000.000", "Rp 18.000.000", "Rp 15.000.000", "Rp 19.000.000"];
        // const dataBerasMuncul2 = ["Rp 15.000.000", "Rp 17.000.000", "Rp 19.000.000", "Rp 18.000.000", "Rp 20.000.000", "Rp 14.000.000", "Rp 16.000.000"];
        // const dataBerasMuncul3 = ["Rp 16.000.000", "Rp 18.000.000", "Rp 20.000.000", "Rp 19.000.000", "Rp 17.000.000", "Rp 14.000.000", "Rp 15.000.000"];

        // // Convert string in Rupiah format to number
        // const convertedDataBerasCianjurKepala = dataBerasCianjurKepala.map(convertToNumber);
        // const convertedDataBerasCianjurSlyp = dataBerasCianjurSlyp.map(convertToNumber);
        // const convertedDataBerasSetra = dataBerasSetra.map(convertToNumber);
        // const convertedDataBerasSaigon = dataBerasSaigon.map(convertToNumber);
        // const convertedDataBerasMuncul1 = dataBerasMuncul1.map(convertToNumber);
        // const convertedDataBerasMuncul2 = dataBerasMuncul2.map(convertToNumber);
        // const convertedDataBerasMuncul3 = dataBerasMuncul3.map(convertToNumber);



        // Setting options for the second line chart
        new Chart(document.getElementById("myChart4"), {
            type: 'line'
            , data: {
                labels: ["13/3", "14/3", "15/3", "16/3", "17/3", "18/3", "19/3"]
                , datasets: [{
                        label: 'Beras Cianjur Kepala'
                        , data: [14, 16, 18, 19, 20, 15, 17]
                        , borderColor: '#DAA520'
                        , backgroundColor: '#DAA520'
                        , borderWidth: 1
                        , pointRadius: 2
                        , spanGaps: true
                        , tension: 0.3 // Mengatur kehalusan kurva
                    }
                    , {
                        label: 'Beras Cianjur Slyp'
                        , data: [15, 17, 16, 18, 19, 14, 20]
                        , borderColor: '#FF0000'
                        , backgroundColor: '#FF0000'
                        , borderWidth: 1
                        , pointRadius: 2
                        , spanGaps: true
                        , tension: 0.3 // Mengatur kehalusan kurva
                    }
                    , {
                        label: 'Beras Setra'
                        , data: [18, 20, 15, 17, 14, 19, 16]
                        , borderColor: '#9400D3'
                        , backgroundColor: '#9400D3'
                        , borderWidth: 1
                        , pointRadius: 2
                        , spanGaps: true
                        , tension: 0.3 // Mengatur kehalusan kurva
                    }
                    , {
                        label: 'Beras Saigon'
                        , data: [16, 18, 19, 20, 17, 14, 15]
                        , borderColor: '#FFA07A'
                        , backgroundColor: '#FFA07A'
                        , borderWidth: 1
                        , pointRadius: 2
                        , spanGaps: true
                        , tension: 0.3 // Mengatur kehalusan kurva
                    }
                    , {
                        label: 'Beras Muncul 1'
                        , data: [17, 14, 16, 20, 18, 15, 19]
                        , borderColor: '#20B2AA'
                        , backgroundColor: '#20B2AA'
                        , borderWidth: 1
                        , pointRadius: 2
                        , spanGaps: true
                        , tension: 0.3 // Mengatur kehalusan kurva
                    }
                    , {
                        label: 'Beras Muncul 2'
                        , data: [15, 17, 19, 18, 20, 14, 16]
                        , borderColor: '#778899'
                        , backgroundColor: '#778899'
                        , borderWidth: 1
                        , pointRadius: 2
                        , spanGaps: true
                        , tension: 0.3 // Mengatur kehalusan kurva
                    }
                    , {
                        label: 'Beras Muncul 3'
                        , data: [16, 18, 20, 19, 17, 14, 15]
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
                    label: "Penyewa"
                    , backgroundColor: "#879fd1"
                    , data: [17, 20, 25, 20, 23]
                    , barThickness: 7 // Atur lebar bar menjadi 7 pixel
                }
                , {
                    label: "Pemilik"
                    , backgroundColor: "#ffba44"
                    , data: [31, 32, 37, 21, 45]
                    , barThickness: 7 // Atur lebar bar menjadi 7 pixel
                }
                , {
                    label: "Petani"
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
