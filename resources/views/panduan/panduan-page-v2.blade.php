<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="title" content="Peta Perizinan dan Investasi DKI Jakarta">
    <meta name="description" content="Peta Perizinan dan Investasi oleh DKI Jakarta bekerja sama dengan DPMPTSP DKI Jakarta ">
    <meta name="og:title" content="Peta Perizinan dan Investasi DKI Jakarta">
    <meta name="og:description" content="Peta Perizinan dan Investasi oleh DKI Jakarta bekerja sama dengan DPMPTSP DKI Jakarta ">
    <meta name="twitter:title" content="Peta Perizinan dan Investasi DKI Jakarta">
    <meta name="twitter:description" content="Peta Perizinan dan Investasi oleh DKI Jakarta bekerja sama dengan DPMPTSP DKI Jakarta ">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Panduan-Pengguna Pintoinvest</title>


    {{-- source css custom --}}
    <link rel="icon" href="{{ asset('assets/gambar/favicon.png') }}">

    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css" />

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/panduan.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('css/panduan-new.css') }}">

    {{-- source --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: Arial, "Helvetica CY", "Nimbus Sans L", sans-serif;
        }

    </style>

</head>

<body>

    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden  focus:outline-none">
        <span class="sr-only">Open sidebar</span>
        {{-- <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg> --}}

        <img src="{{ asset('assets/gambar/menu_hamburger.png') }}" class="w-8 h-8" alt="" />



    </button>


    <div class="flex flex-row h-screen overflow-hidden">

        <aside id="default-sidebar" class="fixed top-0 left-0 z-40 basis-[20rem] h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">

            <div class="basis-[20rem] bg-[#102037] w-full pb-5 pl-4 pr-2">

                <div class="flex flex-row py-4">
                    <a href="#" class="flex items-center">
                        <img src="{{ asset('assets/gambar/logo_invest.png') }}" class="h-6 mr-3 sm:h-10" alt="Logo Jakpintas" />
                        <div class="flex flex-col">
                            <div>
                                <span class="self-center lg:text xl:text-xl font-semibold text-gray-300">Panduan Pintoinvest</span>
                            </div>
                            <div class="text-gray-400 text-xs">Versi 2.0.6</div>
                        </div>
                    </a>
                </div>


                {{-- Daftar Panduan --}}
                <div class="flex flex-col h-[90vh] overflow-x-hidden scrollbar-panduan scrollbar-firefox -mr-2 pr-2 pb-5">

                    <div id="accordion-flush" data-active-classes="bg-white dark:bg-[#102037] text-blue-500" data-inactive-classes="text-gray-500">


                        {{-- Menu Mengenal 1 --}}
                        <div id="accordion-flush-heading-1" class="accordion-header flex flex-row text-gray-300">
                            <div type="button" id="active_title_mengenal" class="flex justify-between w-full font-normal text-left text-gray-300 outline-none text-sm" data-accordion-target="#" aria-expanded="false">
                                <a class="navigation" href="#mengenal-pintoinvest" onclick="ArrowActiveMenuPanduan(1)">
                                    <div class="text-gray-300 scroll_active sub_mengenal active_mengenal pr-4">Mengenal Pintoinvest</div>

                                </a>
                            </div>
                        </div>

                        {{-- Menu Pintoinvest 2 --}}
                        <div>
                            <div id="accordion-flush-heading-2" class="accordion-header flex flex-row text-gray-300">

                                <div type="button" id="active_title_pintoinvest" class="flex justify-between w-full font-normal text-left text-gray-300 outline-none text-sm" data-accordion-target="#" aria-expanded="false">
                                    <span class="cursor-default" id="arrow_pintoinvest" onclick="ActiveMenuPanduan(2)">Memulai Pintoinvest</span>

                                </div>

                                <span class="" onclick="ArrowActiveMenuPanduan(2)">
                                    <svg data-accordion-icon class="w-5 h-5 shrink-0 cursor-pointer rotasi_open_pintoinvest" id="accordion-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">

                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>

                            </div>

                            <div id="accordion-flush-body-2" class="hidden hide_show_panduan_pintoinvest" aria-labelledby="accordion-flush-heading-2">
                                <div class="grid_subjudul pl-6 text-sm" id="sub_active_pintoinvest">

                                    <a class="navigation" href="#login-akun" onclick="ActiveMenuPanduan(2)">
                                        <div class="text-gray-300 sub_pintoinvest scroll_active active_pintoinvest pr-4">Login</div>
                                    </a>
                                    <a class="navigation" href="#aktivitas-layer" onclick="ActiveMenuPanduan(2)">
                                        <div class="text-gray-300 sub_pintoinvest scroll_active pr-4">Aktivasi layer</div>

                                    </a>

                                    <a class="navigation" href="#penamaan-komponen" onclick="ActiveMenuPanduan(2)">

                                        <div class="text-gray-300 sub_pintoinvest scroll_active pr-4">Penamaan komponen</div>

                                    </a>
                                    <a class="navigation" href="#informasi-spasial" onclick="ActiveMenuPanduan(2)">

                                        <div class="text-gray-300 sub_pintoinvest scroll_active pr-4">Menggunakan Search Box</div>

                                    </a>

                                </div>

                            </div>
                        </div>

                        {{-- Menu Layer Informasi Spasial 3 --}}
                        <div>
                            <div id="accordion-flush-heading-3" class="accordion-header flex flex-row text-gray-300">

                                <div type="button" id="active_title_informasi_spasial" class="flex justify-between w-full font-normal text-left text-gray-300 outline-none text-sm" data-accordion-target="#" aria-expanded="false">
                                    <span class="cursor-default" id="arrow_informasi_spasial" onclick="ActiveMenuPanduan(3)">Layer Informasi Spasial</span>
                                </div>

                                <span class="" onclick="ArrowActiveMenuPanduan(3)">
                                    <svg data-accordion-icon class="w-5 h-5 shrink-0 cursor-pointer rotasi_open_informasi_spasial" id="accordion-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">

                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>

                            </div>

                            <div id="accordion-flush-body-3" class="hidden hide_show_panduan_informasi_spasial" aria-labelledby="accordion-flush-heading-3">
                                <div class="grid_subjudul pl-6 text-sm" id="sub_active_informasi_spasial">
                                    <a href="#zonasi" onclick="ActiveMenuPanduan(3)">
                                        <div class="text-gray-300 sub_informasi_spasial active_informasi_spasial scroll_active">Zonasi</div>

                                    </a>
                                    <a href="#batas-rw" onclick="ActiveMenuPanduan(3)">
                                        <div class="text-gray-300 sub_informasi_spasial scroll_active">Batas RW</div>
                                    </a>
                                    <a href="#transect-zone" onclick="ActiveMenuPanduan(3)">
                                        <div class="text-gray-300 sub_informasi_spasial scroll_active">Transect Zone</div>
                                    </a>
                                    <a href="#garis-kepulauan" onclick="ActiveMenuPanduan(3)">
                                        <div class="text-gray-300 sub_informasi_spasial scroll_active">Garis Kepulauan</div>
                                    </a>
                                    <a href="#area-kepulauan" onclick="ActiveMenuPanduan(3)">
                                        <div class="text-gray-300 sub_informasi_spasial scroll_active">Area Kepulauan</div>
                                    </a>
                                    <a href="#kawasan-khusus" onclick="ActiveMenuPanduan(3)">
                                        <div class="text-gray-300 sub_informasi_spasial scroll_active">Kawasan Khusus</div>
                                    </a>
                                    <a href="#batas-laut" onclick="ActiveMenuPanduan(3)">
                                        <div class="text-gray-300 sub_informasi_spasial scroll_active">Batas Laut</div>
                                    </a>
                                    <a href="#obyek-laut" onclick="ActiveMenuPanduan(3)">
                                        <div class="text-gray-300 sub_informasi_spasial scroll_active">Obyek Laut</div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Menu Komplikasi 4 --}}
                        <div>
                            <div id="accordion-flush-heading-4" class="accordion-header flex flex-row text-gray-300">

                                <div type="button" id="active_title_kompilasi" class="flex justify-between w-full font-normal text-left text-gray-300 outline-none text-sm" data-accordion-target="#" aria-expanded="false">
                                    <span class="cursor-default" id="arrow_kompilasi" onclick="ActiveMenuPanduan(4)">Membaca kompilasi informasi</span>
                                </div>

                                <span class="" onclick="ArrowActiveMenuPanduan(4)">
                                    <svg data-accordion-icon class="w-5 h-5 shrink-0 cursor-pointer rotasi_open_kompilasi" id="accordion-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">

                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>

                            </div>

                            <div id="accordion-flush-body-4" class="hidden hide_show_panduan_kompilasi" aria-labelledby="accordion-flush-heading-4">
                                <div class="grid_subjudul pl-6 text-sm" id="sub_active_kompilasi">
                                    <a href="#profil" onclick="ActiveMenuPanduan(4)">
                                        <div class="text-gray-300 sub_kompilasi active_kompilasi scroll_active">Profil</div>
                                    </a>
                                    <a href="#ketentuan" onclick="ActiveMenuPanduan(4)">
                                        <div class="text-gray-300 sub_kompilasi scroll_active">Ketentuan</div>
                                    </a>
                                    <a href="#kbli" onclick="ActiveMenuPanduan(4)">
                                        <div class="text-gray-300 sub_kompilasi scroll_active">KBLI</div>
                                    </a>
                                    <a href="#indikator" onclick="ActiveMenuPanduan(4)">
                                        <div class="text-gray-300 sub_kompilasi scroll_active">Indikator</div>
                                    </a>
                                    <a href="#sarpras" onclick="ActiveMenuPanduan(4)">
                                        <div class="text-gray-300 sub_kompilasi scroll_active">Sarpras</div>
                                    </a>
                                    <a href="#lingkungan" onclick="ActiveMenuPanduan(4)">
                                        <div class="text-gray-300 sub_kompilasi scroll_active">Lingkungan</div>
                                    </a>
                                    <a href="#potensi" onclick="ActiveMenuPanduan(4)">
                                        <div class="text-gray-300 sub_kompilasi scroll_active">Potensi</div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{--Menu Navigasi 5 --}}
                        <div>
                            <div id="accordion-flush-heading-5" class="accordion-header flex flex-row text-gray-300">

                                <div type="button" id="active_title_navigasi" class="flex justify-between w-full font-normal text-left text-gray-300 outline-none text-sm" data-accordion-target="#" aria-expanded="false">
                                    <span class="cursor-default" id="arrow_navigasi" onclick="ActiveMenuPanduan(5)">Menggunakan panel navigasi</span>
                                </div>

                                <span class="" onclick="ArrowActiveMenuPanduan(5)">
                                    <svg data-accordion-icon class="w-5 h-5 shrink-0 cursor-pointer rotasi_open_navigasi" id="accordion-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">

                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>

                            </div>

                            <div id="accordion-flush-body-5" class="hidden hide_show_panduan_navigasi" aria-labelledby="accordion-flush-heading-5">
                                <div class="grid_subjudul pl-6 text-sm" id="sub_active_navigasi">
                                    <a href="#peta-dasar" onclick="ActiveMenuPanduan(5)">
                                        <div class="text-gray-300 sub_navigasi active_navigasi scroll_active">Peta dasar</div>

                                    </a>
                                    <a href="#data-interaktif" onclick="ActiveMenuPanduan(5)">
                                        <div class="text-gray-300 sub_navigasi scroll_active">Data interaktif</div>
                                    </a>
                                    <a href="#zoom" onclick="ActiveMenuPanduan(5)">
                                        <div class="text-gray-300 sub_navigasi scroll_active">Zoom</div>
                                    </a>
                                    <a href="#tampilan" onclick="ActiveMenuPanduan(5)">
                                        <div class="text-gray-300 sub_navigasi scroll_active">Tampilan 3D</div>
                                    </a>
                                    <a href="#plot-shp" onclick="ActiveMenuPanduan(5)">
                                        <div class="text-gray-300 sub_navigasi scroll_active">Plot SHP</div>
                                    </a>
                                    <a href="#mengukur-jarak" onclick="ActiveMenuPanduan(5)">
                                        <div class="text-gray-300 sub_navigasi scroll_active">Mengukur jarak</div>
                                    </a>
                                    <a href="#mengukur-luas" onclick="ActiveMenuPanduan(5)">
                                        <div class="text-gray-300 sub_navigasi scroll_active">Mengukur luas</div>
                                    </a>
                                    <a href="#find-location" onclick="ActiveMenuPanduan(5)">
                                        <div class="text-gray-300 sub_navigasi scroll_active">Find My Location</div>

                                    </a>

                                </div>
                            </div>
                        </div>

                        {{-- Menu Koneksi 6--}}
                        <div>
                            <div id="accordion-flush-heading-6" class="accordion-header flex flex-row text-gray-300">

                                <div type="button" id="active_title_koneksi" class="flex justify-between w-full font-normal text-left text-gray-300 outline-none text-sm" data-accordion-target="#" aria-expanded="false">
                                    <span class="cursor-default" id="arrow_koneksi" onclick="ActiveMenuPanduan(6)">Koneksi aplikasi perizinan lainnya</span>
                                </div>

                                <span class="" onclick="ArrowActiveMenuPanduan(6)">
                                    <svg data-accordion-icon class="w-5 h-5 shrink-0 cursor-pointer rotasi_open_koneksi" id="accordion-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">

                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>

                            </div>

                            <div id="accordion-flush-body-6" class="hidden hide_show_panduan_koneksi" aria-labelledby="accordion-flush-heading-6">
                                <div class="grid_subjudul pl-6 text-sm" id="sub_active_koneksi">
                                    <a href="#pesan-ajib" onclick="ActiveMenuPanduan(6)">
                                        <div class="text-gray-300 sub_koneksi active_koneksi scroll_active">Pesan AJIB</div>

                                    </a>
                                    <a href="#prapermohonan" onclick="ActiveMenuPanduan(6)">
                                        <div class="text-gray-300 sub_koneksi scroll_active">PraPermohonan</div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Menu Fitur 7 --}}
                        <div>
                            <div id="accordion-flush-heading-7" class="accordion-header flex flex-row text-gray-300">

                                <div type="button" id="active_title_fitur" class="flex justify-between w-full font-normal text-left text-gray-300 outline-none text-sm" data-accordion-target="#" aria-expanded="false">
                                    <span class="cursor-default" id="arrow_fitur" onclick="ActiveMenuPanduan(7)">Fitur Survey untuk pendataan</span>
                                </div>

                                <span class="" onclick="ArrowActiveMenuPanduan(7)">
                                    <svg data-accordion-icon class="w-5 h-5 shrink-0 cursor-pointer rotasi_open_fitur" id="accordion-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">

                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>

                            </div>

                            <div id="accordion-flush-body-7" class="hidden hide_show_panduan_fitur" aria-labelledby="accordion-flush-heading-7">
                                <div class="grid_subjudul pl-6 text-sm" id="sub_active_fitur">
                                    <a href="#pengawasan" onclick="ActiveMenuPanduan(7)">
                                        <div class="text-gray-300 sub_fitur active_fitur scroll_active">Pengawasan</div>
                                    </a>
                                    <a href="#survey-perkembangan" onclick="ActiveMenuPanduan(7)">
                                        <div class="text-gray-300 sub_fitur scroll_active">Survey perkembangan wilayah</div>
                                    </a>
                                    <a href="#pendataan-usaha" onclick="ActiveMenuPanduan(7)">
                                        <div class="text-gray-300 sub_fitur scroll_active">Pendataan usaha</div>
                                    </a>
                                    <a href="#izin-lingkungan" onclick="ActiveMenuPanduan(7)">
                                        <div class="text-gray-300 sub_fitur scroll_active">Izin lingkungan</div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Menu Filter 8 --}}
                        <div>
                            <div id="accordion-flush-heading-8" class="accordion-header flex flex-row text-gray-300">

                                <div type="button" id="active_title_filter" class="flex justify-between w-full font-normal text-left text-gray-300 outline-none text-sm" data-accordion-target="#" aria-expanded="false">
                                    <span class="cursor-default" id="arrow_filter" onclick="ActiveMenuPanduan(8)">Memfilter data dengan fitur chip</span>
                                </div>

                                <span class="" onclick="ArrowActiveMenuPanduan(8)">
                                    <svg data-accordion-icon class="w-5 h-5 shrink-0 cursor-pointer rotasi_open_filter" id="accordion-8" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">

                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>

                            </div>

                            <div id="accordion-flush-body-8" class="hidden hide_show_panduan_filter" aria-labelledby="accordion-flush-heading-8">
                                <div class="grid_subjudul pl-6 text-sm" id="sub_active_filter">
                                    <a href="#sewa-kantor" onclick="ActiveMenuPanduan(8)">
                                        <div class="text-gray-300 sub_filter active_filter scroll_active">Sewa kantor</div>
                                    </a>
                                    <a href="#sebaran-nib" onclick="ActiveMenuPanduan(8)">
                                        <div class="text-gray-300 sub_filter scroll_active">Sebaran NIB</div>
                                    </a>
                                    <a href="#sebaran-umkm" onclick="ActiveMenuPanduan(8)">
                                        <div class="text-gray-300 sub_filter scroll_active">Sebaran UMKM</div>
                                    </a>
                                    <a href="#cagar-budaya" onclick="ActiveMenuPanduan(8)">
                                        <div class="text-gray-300 sub_filter scroll_active">Cagar Budaya</div>
                                    </a>
                                    <a href="#verifikasi-wilayah" onclick="ActiveMenuPanduan(8)">
                                        <div class="text-gray-300 sub_filter scroll_active">Verifikasi Perkembangan Wilayah</div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Menu Konsultasi 9 --}}
                        <div id="accordion-flush-heading-9" class="accordion-header flex flex-row text-gray-300">
                            <div type="button" id="active_title_konsultasi" class="flex justify-between w-full font-normal text-left text-gray-300 outline-none text-sm" data-accordion-target="#" aria-expanded="false">
                                <a href="#konsultasi-usaha" onclick="ArrowActiveMenuPanduan(9)">
                                    <div class="text-gray-300 sub_konsultasi scroll_active active_konsultasi pr-4">Fitur Konsultasi</div>

                                </a>
                            </div>
                        </div>

                        {{-- Menu Cetak 10 --}}
                        <div id="accordion-flush-heading-10" class="accordion-header flex flex-row text-gray-300">
                            <div type="button" id="active_title_cetak" class="flex justify-between w-full font-normal text-left text-gray-300 outline-none text-sm" data-accordion-target="#" aria-expanded="false">
                                <a class="navigation" href="#cetak-report" onclick="ArrowActiveMenuPanduan(10)">

                                    <div class="text-gray-300 sub_cetak scroll_active active_cetak pr-4">Mencetak laporan</div>

                                </a>
                            </div>
                        </div>

                        {{-- Menu Video 11 --}}
                        <div>
                            <div id="accordion-flush-heading-11" class="accordion-header flex flex-row text-gray-300">

                                <div type="button" id="active_title_video" class="flex justify-between w-full font-normal text-left text-gray-300 outline-none text-sm" data-accordion-target="#" aria-expanded="false">
                                    <span class="cursor-default" id="arrow_video" onclick="ActiveMenuPanduan(11)">Video</span>
                                </div>

                                <span class="" onclick="ArrowActiveMenuPanduan(11)">
                                    <svg data-accordion-icon class="w-5 h-5 shrink-0 cursor-pointer rotasi_open_video" id="accordion-11" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">

                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.5136l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>

                            </div>

                            <div id="accordion-flush-body-11" class="hidden hide_show_panduan_video" aria-labelledby="accordion-flush-heading-11">
                                <div class="grid_subjudul pl-6 text-sm" id="sub_active_video">
                                    <a class="" href="#Video1" onclick="ActiveMenuPanduan(11)">
                                        <div class="text-gray-300 sub_video scroll_active active_video">
                                            Kasus 1
                                        </div>
                                    </a>

                                    <a class="" href="#Video2" onclick="ActiveMenuPanduan(11)">
                                        <div class="text-gray-300 sub_video scroll_active">
                                            Kasus 2
                                        </div>
                                    </a>

                                    <a class="" href="#Video3" onclick="ActiveMenuPanduan(11)">
                                        <div class="text-gray-300 sub_video scroll_active">
                                            Kasus 3
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>


            </div>

        </aside>

        <div class="p-4 sm:ml-64 max-w-[80rem]">
            <div class="flex flex-col">

                <div class="sm:hidden md:flex lg:flex flex-row justify-end sm:py-0 md:py-3 lg:py-3 px-6 group sticky top-0 bg-white">
                    <a target="_blank" href="{{ asset('pdf-panduan/PanduanPintoinvest.pdf') }}" class="hidden md:flex lg:flex">
                        <div class="w-[3.3vw] flex items-stretch flex-col cursor-pointer">
                            <div class="self-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:text-blue-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 006 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>
                            <div class="-mt-1 self-center">
                                <span class="text-[9pt] font-bold tracking-wide group-hover:text-blue-500">PDF</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="w-full scrollbar scrollbar-firefox overflow-y-auto overflow-x-auto max-h-[90vh]" id="scroller">

                    <div class="sm:px-0 md:px-40 lg:px-40">
                        <div id="konten_panduan">

                            {{-- Konten Mengenal Aplikasi 1 --}}
                            <div class="page-section get_number_panduan pb-4 " id="mengenal-pintoinvest" data-panduan="1" class="">

                                <div class="komponen">

                                    <div class="tracking-wide text-[12pt]">

                                        <p class="font-semibold text-2xl">Mengenal Pintoinvest</p>

                                        <p class=" text-justify mt-4">

                                            Pintoinvest adalah sistem pendukung pelayanan perizinan berusaha dan non
                                            perizinan berusaha yang dikelola dan diselenggarakan oleh Dinas Penanaman
                                            Modal dan Perizinan Terpadu Satu Pintu Pemerintah Provinsi DKI Jakarta.
                                            Pintoinvest dikembangkan sebagai alat analisa investasi untuk memudahkan
                                            pembacaan kompilasi data spasial terkait perizinan dan investasi yang
                                            dikumpulkan dari aplikasi JakartaSatu, Jakevo, dan sumber terpercaya lainnya
                                            dari dinas terkait dan lembaga pemerintah lainnya.


                                            <br>
                                            <br>
                                            Dasar hukum yang digunakan untuk pengembangan aplikasi ini adalah Peraturan
                                            Pemerintah Nomor 6 Tahun 2021 tentang Penyelenggaraan Perizinan Berusaha di
                                            Daerah, pasal 10 ayat 4 yang menyebutkan bahwa Pemerintah Daerah dapat
                                            mengembangkan sistem pendukung pelaksanaan Sistem OSS sesuai dengan norma,
                                            standar, prosedur, dan kriteria yang ditetapkan Pemerintah Pusat.
                                            <br>
                                            <br>
                                            Aplikasi Pintoinvest dapat digunakan oleh staf Pelayanan DPMPTSP untuk
                                            memberikan konsultasi dan pendampingan perizinan berusaha dan non perizinan
                                            berusaha. Pintoinvest dapat diakses baik melalui komputer atau telpon
                                            genggam melalui browser dengan alamat <a style="color: blue;" target="blank" href="https://jakarta.pintoinvest.com">https://jakarta.pintoinvest.com</a>




                                        </p>
                                        <br>

                                    </div>

                                </div>

                            </div>

                            {{-- Konten Memulai Pintoinvest 2 --}}
                            <div class="">


                                <div class="py-4 page-section" id="login-akun" data-panduan="2">

                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content">

                                            <p class="font-semibold text-2xl mb-3">Memulai Pintoinvest</p>

                                            <p class="font-semibold text-xl">Login</p>

                                            <p class="mt-3 text-justify">Untuk mulai menggunakan aplikasi Pintoinvest,
                                                setiap user memerlukan akses surel yang terdaftar. Laman untuk login
                                                adalah sebagai berikut:</p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/login/login_gambar_1.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Login Pintoinvest</div>

                                            <p class=" text-justify">

                                                User dengan surel non gmail yang telah terdaftar dapat melakukan login
                                                dengan menginput alamat email dan kata sandi pada kolom yang sudah
                                                disediakan. Sementara untuk user dengan surel gmail dapat langsung
                                                melakukan login dengan klik tombol Login dengan Google. Aksi selanjutnya
                                                adalah klik tombol untuk verifikasi akun gmail sebelum diarahkan pada
                                                laman utama Pintoinvest.

                                                User tanpa surel terdaftar tetap dapat login dengan akses fitur terbatas
                                                menggunakan akun <span class="underline underline-offset-4 text-blue-500">
                                                    guest@dpmptsp-dki.com </span> dan password <span class="italic ">
                                                    JakPintas2022</span> . Untuk user yang ingin memiliki akses dengan
                                                surel sendiri dapat mengirimkan email pendaftaran dengan format bebas ke
                                                <span class="underline underline-offset-4 text-blue-500">admin@pintoinvest.com
                                                </span>

                                            </p>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="650" src="{{ asset('assets/panduan/login/login_gambar_2.png') }}" width="650"></div>
                                            <div class="text-xs mt-1 text-center">Laman utama Pintoinvest</div>

                                        </div>
                                    </div>
                                </div>

                                <div class="py-4 page-section " id="aktivitas-layer" data-panduan="2">

                                    <div class="komponen">

                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Aktivasi layer</p>

                                            <p class="mt-4 text-justify">
                                                Informasi spasial pada Pintoinvest hanya dapat ditampilkan apabila layer
                                                yang terkait telah diaktifkan. Panel aktivasi layer spasial tersedia di
                                                sebelah kiri laman utama Pintoinvest. Layer spasial yang tersedia di
                                                panel aktivasi adalah <span class="italic">Zonasi</span> (untuk Perda
                                                1/2014 atau Pergub 31/2022), <span class="italic">Batas RW, Transect
                                                    Zone</span> (untuk tahun 2010, 2021, dan 2032). Pintoinvest
                                                memanfaatkan algoritma <span class="italic">Deep Learning</span> untuk
                                                menginterpretasi gambar satelit tahun 2010 dan 2021 sebagai layer <span class="italic">Transect Zone</span> untuk tahun 2010 dan 2021. <span class="italic">Layer Transect Zone</span> tahun 2032 adalah hasil
                                                prediksi perubahan zonasi urban yang juga dibuat dengan algoritma <span class="italic">Deep Learning</span>.




                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/login/login_gambar_3.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Panel aktivasi layer spasial
                                            </div>

                                            <p class=" text-justify">

                                                Selain layer spasial dari peta tematik, Pintoinvest juga menyediakan
                                                tampilan layer spasial untuk wilayah Kepulauan Seribu yang meliputi
                                                <span class="italic">Garis Kepulauan, Area Kepulauan, Kawasan Khusus,
                                                    Batas Laut, dan Obyek Laut.</span>

                                                Secara default, layer zonasi sudah langsung aktif sehingga bisa tampil
                                                di laman utama. Sementara layer lainnya perlu diaktifkan secara
                                                terpisah. Untuk layer spasial wilayah Kepulauan Seribu hanya akan
                                                terlihat di wilayah Kepulauan Seribu.
                                            </p>

                                        </div>

                                    </div>


                                </div>

                                <div class="py-4 page-section " id="penamaan-komponen" data-panduan="2">


                                    <div class="komponen">

                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Penamaan komponen</p>

                                            <div class="my-6 flex justify-center">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/login/login_gambar_4.jpg') }}" width="850">
                                            </div>


                                            <div class="grid grid-cols-[1fr] text-justify mt-2">

                                                <div class="grid grid-cols-[250px__1fr] text-justify pb-1">
                                                    <div class="w-full">
                                                        Search box
                                                    </div>
                                                    <div class="w-full">
                                                        Box tempat user untuk mulai pencarian. Bisa diisi nama
                                                        kelurahan, nama jalan, nama gedung, nama pusat perbelanjaan,
                                                        nama hotel, atau koordinat dengan contoh format
                                                        -6.200342707669333, 106.85949143433679.
                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-[250px__1fr] text-justify py-1">
                                                    <div class="w-full">
                                                        Aktivasi layer
                                                    </div>
                                                    <div class="w-full">
                                                        Layer spasial yang tersedia hingga saat ini adalah Zonasi, Batas
                                                        RW, Transect Zone, Garis Kepulauan, Area Kepulauan, Kawasan
                                                        Khusus, Batas Laut, dan Obyek Laut.
                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-[250px__1fr] text-justify py-1">
                                                    <div class="w-full">
                                                        Detil
                                                    </div>
                                                    <div class="w-full">
                                                        Lokasi Detil terletak di bawah panel aktivasi berupa icon yang
                                                        terbagi dalam 2 kategori: Persil dan Kawasan. Untuk kategori
                                                        Persil, ada 3 icon informasi: Profil, Ketentuan, KBLI, sedangkan
                                                        untuk kategori Kawasan, ada 4 icon informasi yang tersedia:
                                                        Indikator, Sarpras, Lingkungan, dan Potensi.
                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-[250px__1fr] text-justify py-1">
                                                    <div class="w-full">
                                                        Chip filter
                                                    </div>
                                                    <div class="w-full">
                                                        Chip filter terletak di bagian atas layar aplikasi Pintoinvest.
                                                        Kegunaan chip filter adalah untuk menampilkan informasi sesuai
                                                        dengan filter chip yang sedang aktif.

                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-[250px__1fr] text-justify py-1">
                                                    <div class="w-full">
                                                        Pustaka referensi
                                                    </div>
                                                    <div class="w-full">
                                                        Icon berupa 9 titik di sudut kanan atas layar aplikasi adalah
                                                        kumpulan tautan aplikasi-aplikasi lain yang banyak dipakai dalam
                                                        proses pengurusan izin di DPMPTSP Pemprov DKI Jakarta.
                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-[250px__1fr] text-justify py-1">
                                                    <div class="w-full">
                                                        Peta dasar
                                                    </div>
                                                    <div class="w-full">
                                                        Icon peta dasar digunakan untuk memilih jenis tampilan peta
                                                        dasar yang akan ditampilkan. Selain itu ada juga peta data
                                                        interaktif yang menunjukkan sebaran pendapatan penduduk di
                                                        wilayah DKI Jakarta.

                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-[250px__1fr] text-justify py-1">
                                                    <div class="w-full">
                                                        Form aplikasi
                                                    </div>
                                                    <div class="w-full">
                                                        Form aplikasi menghubungkan Pintoinvest dengan modul aplikasi
                                                        lain untuk pemrosesan secara langsung tanpa harus login ke
                                                        aplikasi terpisah. Hingga saat ini yang telah terkoneksi dengan
                                                        Pintoinvest adalah Pengawasan, Survey Perkembangan Wilayah,
                                                        Pendataan Usaha, Izin Lingkungan, PesanAJIB, dan PraPermohonan.
                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-[250px__1fr] text-justify py-1">
                                                    <div class="w-full">
                                                        Navigasi spasial
                                                    </div>
                                                    <div class="w-full">
                                                        Tombol yang tersedia di grup navigasi spasial digunakan untuk
                                                        zoom in/zoom out, tampilan 3-dimensi, plotting SHP, mengukur
                                                        jarak/luas, menampilkan posisi koordinat user, dan pencetakan
                                                        report.
                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-[250px__1fr] text-justify py-1">
                                                    <div class="w-full">
                                                        Konsultasi
                                                    </div>
                                                    <div class="w-full">
                                                        Posisi icon Konsultasi adalah di sudut kanan bawah layar
                                                        aplikasi. Jika user klik di icon Konsultasi, maka user akan
                                                        diarahkan pada halaman baru untuk melakukan konsultasi perizinan
                                                        dengan petugas CRO.
                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-[250px__1fr] text-justify py-1">
                                                    <div class="w-full">
                                                        Running text
                                                    </div>
                                                    <div class="w-full">
                                                        Running text di bagian bawah layer menampilkan rangkuman
                                                        informasi singkat mengenai data-data ekonomi dan keuangan yang
                                                        dirilis resmi oleh Bank Indonesia.
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="py-4 page-section" id="informasi-spasial" data-panduan="2">



                                    <div class="komponen">

                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Menggunakan Search Box</p>


                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/login/search_box.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Search box</div>


                                            <p class="mt-4 text-justify">
                                                Search Box adalah tempat untuk mulai pencarian di aplikasi Pintoinvest.
                                                Pencarian yang didukung oleh Pintoinvest adalah mencari dengan
                                                menggunakan beberapa entri sebagai berikut:
                                                <br>
                                                <br>
                                                nama jalan, contoh: “Sudirman”
                                                <br>
                                                nama gedung/hotel/mall, contoh: “Mandarin”
                                                <br>
                                                nama kelurahan, contoh: “Petojo”
                                                <br>
                                                nama sekolah, contoh: “Tarakanita”
                                                <br>
                                                koordinat lokasi dengan format (latitude, longitude), contoh:
                                                “-6.167571353685844, 106.812591437435”
                                            </p>
                                            <br>
                                            <p class="text-justify">
                                                Setelah menginput entri kata pencarian di Search Box, aplikasi akan
                                                menampilkan beberapa rekomendasi record di database yang sesuai. Klik
                                                pada salah satu dari rekomendasi yang muncul untuk menampilkan lokasi
                                                yang dimaksud beserta peta zonasi di kelurahan tersebut.
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Konten Layer Informasi Spasial 3 --}}
                            <div class="">


                                <div class="py-4 page-section" id="zonasi" data-panduan="3">

                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-2xl mb-3">Layer Informasi Spasial</p>

                                            <p class="font-semibold text-xl">Zonasi</p>

                                            <p class="text-justify mt-3">
                                                Layer zonasi secara default sudah dalam kondisi tercentang/aktif dan
                                                langsung akan tampil sebagai hasil dari pencarian. Untuk memudahkan
                                                proses analisa yang menyeluruh, layer zonasi yang ditampilkan adalah
                                                untuk setiap satu kelurahan. Contoh di bawah adalah peta zonasi untuk
                                                Kelurahan Kebon Kacang sesuai dengan Pergub 31/2022.
                                            </p>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="650" src="{{ asset('assets/panduan/informasi_spasial/zonasi.png') }}" width="650"></div>
                                            <div class="text-xs mt-1 text-center">Layer Zonasi</div>

                                        </div>
                                    </div>
                                </div>
                                <div class="py-4 page-section" id="batas-rw" data-panduan="3">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Batas RW</p>

                                            <p class="text-justify mt-4">
                                                Layer Batas RW menunjukkan garis delineasi batas di wilayah DKI Jakarta.
                                                Sebagai contoh di bawah adalah batas RW yang ditampilkan untuk Kelurahan
                                                Petojo Utara. Layer Batas RW harus diaktifkan terlebih dahulu untuk bisa
                                                menampilkan garis batas RW.
                                            </p>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="650" src="{{ asset('assets/panduan/informasi_spasial/batas-rw.png') }}" width="650"></div>
                                            <div class="text-xs mt-1 text-center">Layer Batas RW</div>


                                        </div>
                                    </div>
                                </div>
                                <div class="py-4 page-section" id="transect-zone" data-panduan="3">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Transect Zone</p>

                                            <p class="text-justify mt-4">
                                                Untuk layer transect zone ada 3 opsi yang bisa dipilih untuk aktivasi:
                                                tahun 2010, tahun 2021, dan tahun 2023.
                                            </p>
                                            <br>
                                            <p class="text-justify">
                                                Sebagai contoh untuk koordinat <span class="underline underline-offset-4 text-blue-500">-6.164915346203713,
                                                    106.81489607440534</span>, hasil interpretasi <span class="italic">Deep Learning</span> atas gambar satelit tahun 2010
                                                menunjukkan bahwa lokasi tersebut bisa digolongkan pada kategori <span class="font-bold">TP-5 (Urban Center)</span>.
                                            </p>
                                            <br>

                                            <p class="text-justify">
                                                Pintoinvest menggolongkan tingkat perkembangan kota dalam 6 kategori:
                                                <br>

                                                <div class="grid grid-cols-[150px_150px] mt-2">
                                                    <div>TP-1</div>
                                                    <div>Natural</div>
                                                    <div>TP-2</div>
                                                    <div>Kampung</div>
                                                    <div>TP-3</div>
                                                    <div>Sub-Urban</div>
                                                    <div>TP-4</div>
                                                    <div>Urban</div>
                                                    <div>TP-5</div>
                                                    <div>Urban Center</div>
                                                    <div>TP-6</div>
                                                    <div>Urban Core</div>
                                                </div>
                                            </p>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="650" src="{{ asset('assets/panduan/informasi_spasial/transect_zone_1.png') }}" width="650"></div>
                                            <div class="text-xs mt-1 text-center">Layer Transect Zone Tahun 2010</div>


                                            <p class="text-justify mt-8">
                                                Untuk <span class="italic">Transect Zone</span> tahun 2021 pada lokasi
                                                yang sama, model <span class="italic">Deep Learning</span> memberikan
                                                interpretasi sebagai berikut:
                                            </p>

                                            <div class="mt-8 flex justify-center"><img class="" alt="" height="650" src="{{ asset('assets/panduan/informasi_spasial/transect_zone_2.jpg') }}" width="650"></div>
                                            <div class="text-xs mt-1 text-center">Layer Transect Zone Tahun 2021</div>


                                            <p class="text-justify mt-8">
                                                Pada pop-up yang muncul dapat terbaca bahwa urban index pada tahun 2021
                                                tetap pada kategori TP-5
                                                (Urban Center) atau tidak ada perubahan dari interpretasi tahun 2010.
                                            </p>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="650" src="{{ asset('assets/panduan/informasi_spasial/transect_zone_3.jpg') }}" width="650"></div>
                                            <div class="text-xs mt-1 text-center">Layer Transect Zone Tahun 2032</div>

                                            <p class="text-justify mt-8">
                                                <span class="italic">Transect Zone</span> tahun 2032 adalah hasil
                                                prediksi Deep Learning untuk memperkirakan kondisi perkembangan kota
                                                pada tahun 2032 dengan mempertimbangkan 4 parameter: Pola Ruang,<span class="italic"> Liveability</span>, Daya Dukung Lingkungan, dan
                                                harga NJOP.
                                                <br>
                                                <br>
                                                Dari gambar yang ditampilkan, bisa kita pelajari bahwa model Deep
                                                Learning memprediksi pada titik lokasi yang sama tidak ada perubahan
                                                indeks urban dari tahun 2021 ke tahun 2032, yaitu tetap TP-5 (Urban
                                                Core).
                                                <br>
                                                <br>
                                                Untuk menampilkan informasi spasial di wilayah Kepulauan Seribu, pertama
                                                kali kita harus memilih wilayah Kepulauan Seribu seperti di bawah ini:
                                            </p>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="650" src="{{ asset('assets/panduan/informasi_spasial/wilayah_kepulauan1.jpg') }}" width="650"></div>
                                            <div class="text-xs mt-1 text-center">Wilayah Kepulauan Seribu</div>

                                            <p class="text-justify mt-8">
                                                Kemudian jika kita zoom in pada wilayah tersebut, kita bisa lihat peta
                                                zonasi untuk tiap pulau- pulau ditampilkan sesuai dengan Pergub 31/2022.
                                            </p>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="650" src="{{ asset('assets/panduan/informasi_spasial/wilayah_kepulauan2.jpg') }}" width="650"></div>
                                            <div class="text-xs mt-1 text-center">Layer zonasi wilayah Kepulauan Seribu
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="py-4 page-section" id="garis-kepulauan" data-panduan="3">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Garis Kepulauan</p>

                                            <p class="text-justify mt-4">
                                                Garis batas kepulauan di wilayah Kepulauan Seribu ditampilkan setelah
                                                kita aktifkan layer Garis Kepulauan di panel aktivasi. Informasi spasial
                                                dalam bentuk line ini mencakup keterangan garis batas daerah kepulauan,
                                                kabel laut, dan jalur pipa minyak
                                            </p>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="650" src="{{ asset('assets/panduan/informasi_spasial/garis_kepulauan.jpg') }}" width="650"></div>
                                            <div class="text-xs mt-1 text-center">Layer garis Kepulauan wilayah
                                                Kepulauan Seribu</div>

                                        </div>
                                    </div>
                                </div>
                                <div class="py-4 page-section" id="area-kepulauan" data-panduan="3">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Area Kepulauan</p>

                                            <br>
                                            <p class="text-justify">
                                                Layer area kepulauan apabila diaktifkan akan menampilkan lokasi batu
                                                karang dan gosong di wilayah Kepulauan Seribu.
                                            </p>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="650" src="{{ asset('assets/panduan/informasi_spasial/area_kepulauan.jpg') }}" width="650"></div>
                                            <div class="text-xs mt-1 text-center">Layer Area Kepulauan</div>

                                        </div>
                                    </div>
                                </div>
                                <div class="py-4 page-section" id="kawasan-khusus" data-panduan="3">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Kawasan Khusus</p>

                                            <p class="text-justify mt-4">
                                                Untuk layer kawasan khusus, apabila diaktifkan akan menampilkan
                                                lokasi-lokasi seperti area cagar alam laut, area dilarang berlabuh, area
                                                budidaya karang hijau dan lain-lain.
                                            </p>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="650" src="{{ asset('assets/panduan/informasi_spasial/kawasan_khusus.jpg') }}" width="650"></div>
                                            <div class="text-xs mt-1 text-center">Layer kawasan khusus Kepulauan Seribu
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="py-4 page-section" id="batas-laut" data-panduan="3">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Batas Laut</p>

                                            <p class="text-justify mt-4">
                                                Informasi kedalaman batas laut di wilayah Kepulauan Seribu ditampilkan
                                                pada layer Batas Laut. Seperti terlihat pada contoh gosong dapur di
                                                bawah, batas kedalamannya adalah 0 – 5 meter.
                                            </p>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="650" src="{{ asset('assets/panduan/informasi_spasial/batas_laut.jpg') }}" width="650"></div>
                                            <div class="text-xs mt-1 text-center">Layer batas laut Kepulauan Seribu
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="py-4 page-section" id="obyek-laut" data-panduan="3">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Obyek Laut</p>

                                            <p class="text-justify mt-4">
                                                Yang termasuk dalam kategori laut adalah rambu tanda bahaya pelayaran,
                                                pelampung penanda, tanda pelayaran suar, batu karang berbahaya, pancang
                                                memancing, dan lain-lain.
                                            </p>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="650" src="{{ asset('assets/panduan/informasi_spasial/obyek_laut.jpg') }}" width="650"></div>
                                            <div class="text-xs mt-1 text-center">Layer obyek laut wilayah Kepulauan
                                                Seribu</div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- Konten Membaca Kompilasi 4 --}}
                            <div class="">

                                <div class="py-4 page-section" data-panduan="4" id="profil">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content">

                                            <p class="font-semibold text-2xl mb-3">Membaca kompilasi informasi spasial
                                            </p>

                                            <p class="font-semibold text-xl">Profil</p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/profil.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Icon Profil</div>

                                            <p class="mt-4  text-justify">Klik icon Profil, maka kemudian akan tampil
                                                data-data terkait profil lokasi titik pin. Pada sub informasi Lokasi
                                                ditampilkan data-data koordinat titik pin, data RT/RW, nama kelurahan,
                                                nama kecamatan, nama wilayah, luas kelurahan (dalam hektar), kepadatan
                                                penduduk (dalam satuan penduduk per km persegi), dan rasio gini. Apabila
                                                koordinat titik pin diklik, maka kita akan diarahkan menuju web Google
                                                Maps pada titik koordinat yang sama.
                                            </p>
                                            <br>
                                            <p class=" text-justify">
                                                Sedangkan sub informasi Persil menampilkan data kegiatan, angka
                                                perkiraan NJOP, tipe hak tanah persil, dan luas tanah persil (dalam
                                                meter persegi) di lokasi titik pin.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi//sub_informasi_lokasi.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Sub informasi Lokasi dan Persil
                                            </div>


                                            <p class=" text-justify">
                                                Berikutnya pada sub informasi Usaha Mikro Kecil, kita bisa dapatkan
                                                data-data usaha mikro kecil di kelurahan tersebut. Di antara data yang
                                                bisa kita baca adalah jumlah pemilik IUMK, total omzet keseluruhan
                                                pemilik IUMK, dan distribusi pendapatan rata-rata per bulan.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi//sub_informasi_umkm.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center">Sub informasi Usaha Mikro Kecil</div>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi//sub_informasi_pendapatan.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center">Sub informasi Pendapatan Rata-rata per
                                                Bulan</div>

                                        </div>
                                    </div>
                                </div>

                                <div class="py-4 page-section" data-panduan="4" id="ketentuan">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content">

                                            <p class="font-semibold text-xl">Ketentuan</p>

                                            <p class="mt-4 text-justify">Icon Ketentuan berada di nomor dua dari kiri di
                                                baris Persil.</p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/icon_ketentuan.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Icon Ketentuan</div>

                                            <p class="mt-2 text-justify">
                                                Apabila kita klik icon Ketentuan, maka aplikasi Pintoinvest akan
                                                menampilkan data-data ketentuan yang detil yang berlaku di lokasi titik
                                                koordinat pin. Untuk sub informasi Identitas Zonasi, kita bisa dapatkan
                                                data mengenai zona, sub zona, kode sub zona, ID blok, dan ID sub blok.
                                                Sementara untuk sub informasi Intensitas Pemanfaatan Ruang, kita
                                                dapatkan informasi mengenai KDB, KLB, KDH dan ketinggian bangunan untuk
                                                setiap kategori luas lahan yang kita pilih.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/sub_informasi_zonasi.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Sub informasi Identitas Zonasi
                                            </div>

                                            <p class="mt-2 text-justify">
                                                Berikutnya di sub informasi Ketentuan Kegiatan & Penggunaan Lahan kita
                                                bisa menemukan informasi perizinan setelah kita memilih filter Jenis
                                                Bangunan. Sebagai contoh di bawah ini kita memilih jenis bangunan
                                                Restoran, maka kita akan dapatkan informasi mengenai definisi bangunan,
                                                jenis perizinan dan keterangan terkait dengan pilihan jenis bangunan.
                                            </p>
                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/sub_informasi_ketentuan_kegiatan.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Sub informasi Ketentuan Kegiatan
                                                & Penggunaan Lahan</div>


                                            <p class="mt-2 text-justify">
                                                Di sub informasi Ketentuan Tata Bangunan, kita dapatkan informasi
                                                mengenai definisi Garis Sempadan Non Bangunan dan Garis Sempadan
                                                Bangunan (GSB). Untuk infirmasi GSB, kita perlu memilih filter lebar
                                                jalan dan lebar sungai. Untuk contoh di bawah ini, kita ambil lebar
                                                jalan 4-8 meter dan lebar sungai <= 18 meter. </p>

                                                    <div class="mt-8 flex justify-center ">
                                                        <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/sub_informasi_ketentuan_bangunan.png') }}" width="300">
                                                    </div>
                                                    <div class="text-xs mt-1 text-center mb-8">Sub informasi Ketentuan
                                                        Tata Bangunan</div>


                                                    <p class="mt-2 indent-12 text-justify">
                                                        Berikutnya di sub informasi Ketentuan Pelaksanaan, kita
                                                        mendapatkan informasi yang detil mengenai ketentuan hunian yang
                                                        bervariasi sesuai dengan jenis fungsi, tipikal dan luas lahan
                                                        yang dipilih.
                                                    </p>
                                                    <div class="mt-8 flex justify-center ">
                                                        <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/sub_informasi_ketentuan_pelaksanaan.png') }}" width="300">
                                                    </div>
                                                    <div class="text-xs mt-1 text-center mb-8">Sub informasi Ketentuan
                                                        Pelaksanaan</div>

                                                    <p class="mt-2 indent-12 text-justify">
                                                        Sub informasi terakhir adalah Ketentuan TPZ dan Ketentuan KKOP
                                                        yang menjelaskan mengenai ketentuan-ketentuan TPZ dan KKOP yang
                                                        bersesuaian dengan lokasi yang kita pin.
                                                    </p>
                                                    <div class="mt-8 flex justify-center ">
                                                        <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/ketentuan_tpz_kkop.png') }}" width="300">
                                                    </div>
                                                    <div class="text-xs mt-1 text-center">Sub informasi Ketentuan TPZ
                                                        dan Ketentuan KKOP</div>

                                        </div>
                                    </div>

                                </div>

                                <div class="py-4 page-section" data-panduan="4" id="kbli">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content">

                                            <p class="font-semibold text-xl">KBLI</p>

                                            <p class="mt-4 text-justify">Icon ketiga di kategori Persil adalah untuk
                                                pencarian KBLI.</p>

                                            <div class="mt-6 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/kbli_icon.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center">Icon KBLI</div>

                                            <p class="mt-4 text-justify">
                                                Icon ini apabila aktif akan menampilkan informasi untuk pencarian kode
                                                KBLI. Cara penggunaannya adalah dengan mengetikkan kata yang dicari pada
                                                kolom pencarian (misal: “minimarket”) atau mengetikkan kode KBLI yang
                                                sudah diketahui (misal: 47111). Pintoinvest akan menampilkan informasi
                                                menyeluruh mengenai definisi kegiatan dan rekomendasi bangunan beserta
                                                ketentuan yang dipersyaratkan untuk kode KBLI tersebut.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/kbli_detail.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center">Informasi KBLI</div>

                                        </div>
                                    </div>

                                </div>

                                <div class="py-4 page-section" data-panduan="4" id="indikator">
                                    <div class="komponen">

                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Indikator</p>

                                            <p class="mt-4 text-justify">
                                                Pada icon Indikator kita bisa dapatkan informasi metrik terhadap
                                                beberapa parameter urban sebagai perbandingan yang lebih terukur antara
                                                satu lokasi dengan lokasi lainnya. Indikator Urban Index menunjukkan
                                                klasifikasi tingkat perkotaan pada lokasi titik pin. Indikator
                                                Livability Index mengukur tingkat kelayakan huni pada lokasi titik pin
                                                dengan memperhitungkan sembilan parameter mulai dari konektivitas hingga
                                                tingkat campuran guna lahan. Untuk indikator Environment Carrying
                                                Capacity Index, kita membaca metrik yang mengukur tingkat daya dukung
                                                lingkungan yang melihat topografi, kebencanaan, ketersedian air,
                                                kualitas vegetasi, dan pengolahan limbah.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/sub_informasi_urban_index.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Sub informasi Urban Index</div>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/sub_informasi_livability_index.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Sub informasi Livability Index
                                            </div>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/sub_informasi_env_cc_index.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Sub informasi Environment
                                                Carrying Capacity Index</div>

                                        </div>

                                    </div>
                                </div>

                                <div class="py-4 page-section" data-panduan="4" id="sarpras">
                                    <div class="komponen">

                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Sarpras</p>

                                            <p class="mt-4 text-justify">
                                                Icon Sarpras (Sarana dan Prasana) terletak di nomor 2 pada kategori
                                                Kawasan. Apabila icon ini aktif, maka aplikasi Pintoinvest akan
                                                menampilkan data-data sarana dan prasarana yang ada di sekitar lokasi
                                                titik pin pada radius yang bisa diatur pada slider yang tersedia.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/icon_sarpras.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Icon Sarpras</div>

                                            <p class=" text-justify">
                                                Titik titik sarana dan prasarana yang tersedia di sekitar lokasi
                                                direpresentasikan dalam bentuk icon yang berbeda-beda sesuai dengan
                                                kategorinya. Ada 9 kategori sarpas yang terdaftar di aplikasi
                                                Pintoinvest: gedung, minimarket, ibadah, faskes, sekolah, restoran,
                                                hotel, transportasi, dan belanja.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/membaca_kompilasi/peta_titik_lokasi_sarana_dan_prasarana.png') }}" width="650">

                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Peta titik lokasi sarana dan
                                                prasarana</div>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/kategori_sarana_dan_prasarana_pintoinvest.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-6">Kategori sarana dan prasarana
                                            </div>

                                            <p class=" text-justify">
                                                Pada detil keterangan Sarpras kita bisa dapatkan informasi jarak dari
                                                masing-masing titik sarana dan prasarana ke titik koordinat pin. Sebagai
                                                contoh bisa kita baca jarak FamilyMart Formule 1 Cikini ke titik
                                                koordinat pin adalah sejauh 0.164 km atau 164 meter.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/keterangan_jarak_titik_prasarana_dan_koordinat_pin.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center">Keterangan jarak titik sarana dan
                                                prasarana ke titik koordinat pin</div>

                                        </div>

                                    </div>
                                </div>

                                <div class="py-4 page-section" data-panduan="4" id="lingkungan">
                                    <div class="komponen">

                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Lingkungan</p>

                                            <p class="mt-4 text-justify">
                                                Untuk contoh di bawah ini, jenis bangunan yang dipilih adalah Apartemen.
                                                Setelah melanjutkan pilihan luas lahan, KDB, KLB dan KDH, maka akan
                                                ditampilkan asumsi pemakaian air dan produksi sampah untuk perkiraan
                                                jumlah orang tertentu. Di bagian paling bawah, bisa kita baca hasil
                                                kalkulasi beban lingkungan.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/icon_lingkungan.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Icon Lingkungan</div>

                                            <p class=" text-justify">
                                                Titik titik sarana dan prasarana yang tersedia di sekitar lokasi
                                                direpresentasikan dalam bentuk icon yang berbeda-beda sesuai dengan
                                                kategorinya. Ada 9 kategori sarpas yang terdaftar di aplikasi
                                                Pintoinvest: gedung, minimarket, ibadah, faskes, sekolah, restoran,
                                                hotel, transportasi, dan belanja.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/perkiraan_beban_lingkungan.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center">Perkiraan beban lingkungan</div>

                                        </div>

                                    </div>
                                </div>

                                <div class="py-4 page-section" data-panduan="4" id="potensi">
                                    <div class="komponen">

                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Potensi</p>

                                            <p class="mt-4 text-justify">
                                                Icon Potensi terletak di ujung kanan pada kategori kawasan. Icon ini
                                                aktif untuk menampilkan kalkulator potensi nilai proyek properti di
                                                titik koordinat pin.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/icon_potensi.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Icon Potensi</div>


                                            <p class=" text-justify">
                                                Bagian pertama dari kalkulator potensi adalah asumsi yang di antaranya
                                                berisi pilihan fungsi bangunan (Apartemen Sewa, Apartemen Dijual,
                                                Perkantoran Sewa, Perbelanjaan Sewa, Rumah Susun Dijual, Rumah Tapak
                                                Dijual), luas lahan, perkiraan NJOP, harga tanah dan lain-lainnya.
                                                Beberapa asumsi telah terisi (pre-populated) dengan mengambil data-data
                                                survey seperti Property Market Index, Biaya Maintenance, dan Cost
                                                Capital. Angka asumsi tersebut masih bisa diubah untuk menyesuaikan
                                                dengan angka riil yang tepat untuk lokasi di titik koordinat pin.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/asumsi_potensi.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Asumsi Potensi</div>

                                            <p class=" text-justify">
                                                Berikutnya, setelah angka asumsi terisi semua, aplikasi Pintoinvest akan
                                                melakukan perhitungan nilai pendapatan, pengeluaran, dan estimasi laba.
                                                Dari angka-angka tersebut, kemudian bisa dihitung angka ROI dan IRR.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/membaca_kompilasi/perhitungan_roi_dan_ipr.png') }}" width="300">
                                            </div>
                                            <div class="text-xs mt-1 text-center">Perhitungan ROI dan IRR</div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            {{-- Konten Navigasi 5 --}}
                            <div class="">

                                <div class="py-4 page-section" data-panduan="5" id="peta-dasar">
                                    <div class="komponen">

                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-2xl mb-3">Menggunakan panel navigasi</p>

                                            <p class="font-semibold text-xl">Peta Dasar</p>

                                            <p class="mt-3 text-justify">
                                                Di sebelah kanan layar peta Pintoinvest terdapat deretan tombol untuk
                                                mengatur tampilan data. Tombol paling atas adalah Peta Dasar untuk
                                                mengubah tampilan peta dasar.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="40" src="{{ asset('assets/panduan/panel_navigasi/tombol_peta_dasar.png') }}" width="40">
                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Tombol Peta Dasar</div>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="150" src="{{ asset('assets/panduan/panel_navigasi/opsi_peta_dasar.png') }}" width="100">
                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Opsi Peta Dasar</div>

                                            <p class=" text-justify">
                                                Ada tiga pilihan peta dasar: Default, Satellite, dan Streets.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/panel_navigasi/peta_dasar_satelite.png') }}" width="650">
                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Peta Dasar Satellite</div>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/panel_navigasi/peta_dasar_street.png') }}" width="650">
                                            </div>
                                            <div class="text-xs mt-1 text-center">Peta Dasar Street</div>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/panel_navigasi/peta_dasar_default.png') }}" width="650">
                                            </div>
                                            <div class="text-xs mt-1 text-center">Peta Dasar Default</div>

                                        </div>

                                    </div>
                                </div>

                                <div class="py-4 page-section" data-panduan="5" id="data-interaktif">
                                    <div class="komponen">

                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Data interaktif</p>

                                            <p class="mt-4 text-justify">
                                                Tombol kedua di panel navigasi adalah tombol Data Interaktif untuk
                                                menampilkan peta demografi penduduk DKI Jakarta.
                                            </p>

                                            <div class="mt-8 mb-8 flex justify-center ">
                                                <img class="" alt="" height="40" src="{{ asset('assets/panduan/panel_navigasi/tombol_data_interaktif.png') }}" width="40">
                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Tombol Data Interaktif</div>

                                            <p class=" text-justify">
                                                Setelah tombol Data Interaktif aktif, di bagian bawah layar akan muncul
                                                filter Data Interaktif untuk memilih opsi tampilan: Total Omzet UMKM,
                                                Jumlah Bangunan, Pekerjaan, Pendidikan, Agama, Jumlah Penduduk,
                                                Kepadatan Penduduk, Kependudukan. Grafis peta yang ditampilkan berbentuk
                                                choroplet dengan gradasi warna yang menunjukkan jumlah data di wilayah
                                                kelurahan tersebut. Keterangan interpretasi warna ada di bagian bawah
                                                filter Data Interaktif.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/panel_navigasi/peta_data_interaktif.png') }}" width="650">
                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Peta Data Interaktif</div>


                                        </div>

                                    </div>
                                </div>

                                <div class="py-4 page-section" data-panduan="5" id="zoom">
                                    <div class="komponen">

                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Zoom</p>

                                            <p class="mt-4 text-justify">
                                                Tombol Zoom-In dan Zoom-Out dengan simbol + dan – digunakan untuk
                                                memperbesar atau memperkecil tampilan peta.
                                            </p>

                                            <div class="mt-8 mb-8 flex justify-center ">
                                                <img class="" alt="" height="30" src="{{ asset('assets/panduan/panel_navigasi/tombol_zoomin_zoomout.png') }}" width="30">
                                            </div>
                                            <div class="text-xs mt-1 text-center">Tombol Zoom-In / Zoom-Out</div>


                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/panel_navigasi/tampilan_normal.png') }}" width="650">
                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Tampilan normal</div>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/panel_navigasi/tampilan_zoom_in.png') }}" width="650">

                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Tampilan Zoom-In </div>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/panel_navigasi/tampilan_zoom_out.png') }}" width="650">

                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Tampilan Zoom-Out</div>

                                        </div>
                                    </div>
                                </div>

                                <div class="py-4 page-section" data-panduan="5" id="tampilan">
                                    <div class="komponen">

                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Tampilan 3D</p>

                                            <p class="mt-4 text-justify">
                                                Untuk memberikan perspektif ketinggian pada peta, pada panel navigasi di
                                                sebelah kanan tersedia tombol untuk mengubah ke tampilan 3D.
                                            </p>

                                            <div class="mt-8 mb-4 flex justify-center ">
                                                <img class="" alt="" height="30" src="{{ asset('assets/panduan/panel_navigasi/icon_tombol_3d.png') }}" width="30">
                                            </div>
                                            <div class="text-xs mb-8 mt-1 text-center">Tombol 3D</div>

                                            <p class=" text-justify">
                                                Apabila tombol 3D aktif, tampilan peta di layar akan berubah menjadi
                                                tampilan 3D yang menunjukkan ketinggian bangunan di wilayah kelurahan
                                                yang sedang menjadi fokus.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/panel_navigasi/tampilan_3d.png') }}" width="650">
                                            </div>
                                            <div class="text-xs mt-1 text-center">Tampilan 3D</div>


                                        </div>
                                    </div>

                                </div>

                                <div class="py-4 page-section" data-panduan="5" id="plot-shp">
                                    <div class="komponen">

                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Plot SHP</p>

                                            <p class="mt-4 text-justify">
                                                Satu tombol yang penting yang tersedia di panel navigasi adalah tombol
                                                plot SHP dengan bentuk icon seperti di bawah ini.
                                            </p>

                                            <div class="mt-8 mb-2 flex justify-center ">
                                                <img class="" alt="" height="40" src="{{ asset('assets/panduan/panel_navigasi/icon_tombol_plot_shp.png') }}" width="40">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Tombol plot SHP</div>


                                            <p class=" text-justify">
                                                Tombol ini digunakan untuk mengaktifkan fungsi untuk membuat polygon SHP
                                                sebagai deliniasi bangunan di layar peta. Setelah tombol Plot SHP
                                                diklik, maka cursor akan berubah bentuk menjadi tanda +. Dengan kursor
                                                berbentuk +, kita bisa melakukan plotting titik titik koordinat
                                                deliniasi sesuai bentuk tanah di peta.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/panel_navigasi/titik_polygon_shp.png') }}" width="650">
                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Proses plotting titik polygon SHP
                                            </div>

                                            <p class=" text-justify">
                                                Untuk mengakhiri proses plotting polygon, klik 2 kali di titik terakhir.
                                                Ketika muncul dialog box seperti di bawah ini, ketikkan nama file lalu
                                                klik tombol Download.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="349" src="{{ asset('assets/panduan/panel_navigasi/dialog_shp.png') }}" width="300">

                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Dialog box untuk proses unduh
                                                file SHP.</div>

                                            <p class=" text-justify">
                                                Setelah proses download selesai, di folder download akan kita dapati
                                                file ZIP seperti di bawah ini. Contoh di bawah ini menggunakan nama file
                                                testing.ZIP.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" src="{{ asset('assets/panduan/panel_navigasi/zip_shp.png') }}" width="100">
                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Zip file SHP hasil download</div>

                                            <p class=" text-justify">
                                                Hasil ekstraksi atas file tersebut adalah 4 file berbentu DBF, PRJ, SHP,
                                                dan SHX yang bisa dikirim dan digunakan ke aplikasi perizinan lainnya.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" src="{{ asset('assets/panduan/panel_navigasi/paket_file_shp.png') }}" width="120">
                                            </div>
                                            <div class="text-xs mt-3 mb-8 text-center">Paket file SHP dalam folder</div>

                                        </div>

                                    </div>

                                </div>

                                <div class="py-4 page-section" data-panduan="5" id="mengukur-jarak">
                                    <div class="komponen">

                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Mengukur jarak</p>

                                            <p class="mt-4 text-justify">
                                                Aplikasi Pintoinvest menyediakan fitur untuk mengukur jarak yang mudah
                                                digunakan. Tombol Ukur Jarak tersedia di panel navigasi dengan bentuk
                                                seperti di bawah ini:
                                            </p>

                                            <div class="mt-8 mb-8 flex justify-center ">
                                                <img class="" alt="" height="40" src="{{ asset('assets/panduan/panel_navigasi/icon_tombol_ukur_jarak.png') }}" width="40">
                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Tombol Ukur Jarak</div>

                                            <p class=" text-justify">
                                                Cara menggunakannya sangat sederhana. Apabila tombol Ukur Jarak telah
                                                aktif, kursor akan berubah bentuk menjadi tanda +. Klik di posisi
                                                koordinat titik 1 yang akan diukur, kemudian klik titik 2, maka aplikasi
                                                akan secara otomatis menampilkan jarak antara titik 1 dan titik 2 dalam
                                                meter. Contoh penggunaannya seperti di bawah ini.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/panel_navigasi/proses_ukur_jarak_titik_koordinat.png') }}" width="650">
                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Proses ukur jarak antara 2 titik
                                                koordinat</div>


                                        </div>

                                    </div>
                                </div>

                                <div class="py-4 page-section" data-panduan="5" id="mengukur-luas">
                                    <div class="komponen">

                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Mengukur Luas</p>

                                            <p class="mt-4 text-justify">
                                                Di panel tersedia juga tombol untuk mengukur luas area di dalam peta.
                                                Tombol Mengukur Luas berbentuk seperti di bawah ini:
                                            </p>

                                            <div class="mt-8 mb-8 flex justify-center ">
                                                <img class="" alt="" height="40" src="{{ asset('assets/panduan/panel_navigasi/icon_mengukur_jarak.png') }}" width="40">
                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Tombol Mengukur Luas</div>

                                            <p class=" text-justify">
                                                Untuk mengukur luas, pertama-tama kita perlu menetapkan perimeter titik
                                                di area yang akan diukur luasnya. Saat tombol Mengukur Luas aktif,
                                                kursor akan berubah bentuk menjadi +. Arahkan kursor dan klik di titik
                                                koordinat area yang akan diukur luasnya. Akhiri perimeter luas dengan
                                                klik 2 kali.

                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/panel_navigasi/perimeter_area_diukur_luasnya.png') }}" width="650">
                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Perimeter area yang akan diukur
                                                luasnya</div>

                                            <p class=" text-justify">
                                                Saat klik 2 kali untuk mengakhiri perimeter luas, aplikasi akan secara
                                                otomatis menampilkan luas area di dalam perimeter. Untuk contoh di bawah
                                                ini, luas area yang diukur adalah 299.88 meter persegi
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/panel_navigasi/luas_area_dalam_perimeter.png') }}" width="650">

                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Luas area dalam perimeter</div>



                                        </div>

                                    </div>
                                </div>

                                <div class="py-4 page-section" data-panduan="5" id="find-location">
                                    <div class="komponen">

                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Find My Location</p>

                                            <p class="mt-4 text-justify">
                                                Fitur lainnya yang berguna saat berada di lapangan untuk kegiatan survey
                                                adalah Find My Location. Tombolnya berbentuk seperti di bawah ini:
                                            </p>

                                            <div class="mt-8 mb-8 flex justify-center ">
                                                <img class="" alt="" height="40" src="{{ asset('assets/panduan/panel_navigasi/icon_find_location.png') }}" width="40">
                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Tombol Find My Location</div>

                                            <p class=" text-justify">
                                                Fitur ini digunakan untuk langsung mengaktifkan peta pada titik
                                                koordinat di mana kita berada. Informasi yang bersesuaian seperti peta
                                                zonasi dan keterangan ketentuan lainnya ditampilkan pada panel sisi
                                                kiri.
                                            </p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/panel_navigasi/lokasi_peta_dengan_koordinat.png') }}" width="650">
                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">Lokasi peta Pintoinvest sesuai
                                                dengan posisi koordinat kita</div>


                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/panel_navigasi/peta_zonasi_lokasi_koordinat.png') }}" width="650">
                                            </div>
                                            <div class="text-xs mt-1 mb-8 text-center">
                                                Peta zonasi Pintoinvest sesuai dengan lokasi titik koordinat kita
                                            </div>



                                        </div>

                                    </div>

                                </div>

                            </div>

                            {{-- Konten Koneksi 6 --}}
                            <div class="">

                                <div class="py-4 page-section" data-panduan="6" id="pesan-ajib">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-2xl mb-3">Koneksi aplikasi perizinan lainnya
                                            </p>

                                            <p class=" text-justify mb-3">
                                                Untuk kemudahan pengguna, aplikasi Pintoinvest terhubung langsung dengan
                                                aplikasi lain di DPMPTSP DKI Jakarta. Dengan koneksi langsung antar
                                                aplikasi ini, pengguna Pintoinvest bisa langsung melakukan input data di
                                                Pintoinvest yang kemudian akan diteruskan ke aplikasi lain. Sebagai
                                                contoh user Pintoinvest bisa melakukan pemesanan petugas AJIB melalui
                                                Pintoinvest. Hingga saat ini telah terkoneksi 2 aplikasi dengan
                                                Pintoinvest: PesanAJIB dan PraPermohonan. Namun, fitur koneksi langsung
                                                ini hanya bisa digunakan oleh user aplikasi yang terdaftar.
                                            </p>


                                            <p class="font-semibold text-xl">Pesan AJIB</p>

                                            <p class="mt-3 text-justify">Tombol PesanAJIB tersedia di panel kanan layar
                                                dengan bentuk seperti di bawah ini:</p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="40" src="{{ asset('assets/panduan/koneksi_aplikasi/icon_pesan_ajib.png') }}" width="40">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Tombol Pesan AJIB</div>

                                            <p class=" text-justify mb-3">
                                                Setelah tombol PesanAJIB ini aktif, di panel kiri akan muncul form isian
                                                seperti tangkapan layar di bawah ini. Form ini akan menampilkan beberapa
                                                kolom wajib diisi untuk memesan petugasAJIB, yaitu Nama Pemohon, NIK,
                                                nomor HP yang bisa dihubungi, alamat, jenis izin yang akan diurus dan
                                                petugas AJIB yang dipilih. Informasi lainnya seperti koordinat,
                                                kelurahan, kecamatan, kota, dan daftar petugas AJIB tersedia otomatis
                                                sesuai dengan kelurahan yang sedang aktif di layar.
                                            </p>

                                            <p class="text-justify">
                                                Di bagian bawah tersedia pula riwayat pemesanan untuk mengetahui status
                                                terbaru dari perizinan yang sedang diurus. Untuk dicatat, fitur
                                                PesanAJIB ini hanya bisa digunakan pada jam kerja 09.00 hingga 15.00
                                                WIB.
                                            </p>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="250" src="{{ asset('assets/panduan/koneksi_aplikasi/form_input_pesan_ajib.png') }}" width="325"></div>
                                            <div class="text-xs mt-1 text-center">Form input aplikasi PesanAJIB</div>

                                        </div>
                                    </div>
                                </div>

                                <div class="py-4 page-section" data-panduan="6" id="prapermohonan">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">PraPermohonan</p>

                                            <p class="mt-3 text-justify">Aplikasi perizinan berikutnya yang terhubung
                                                dengan Pintoinvest adalah PraPermohonan. Tombol aktivasi PraPermohonan
                                                berbentuk seperti di bawah ini:</p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="40" src="{{ asset('assets/panduan/koneksi_aplikasi/tombol_prapermohonan.png') }}" width="40">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Tombol PraPermohonan</div>

                                            <p class=" text-justify">
                                                Saat tombol PraPermohonan aktif, di panel kiri akan tampil form isian
                                                PraPermohonan dengan beberapa tab sesuai dengan kategori informasi yang
                                                diperlukan: data pemohon/pemilik, informasi bangunan, data KBLI, data
                                                lokasi/kegiatan, dokumen-dokumen lain yang perlu diunggah, dan yang
                                                terakhir adalah untuk pelacakan berkas.
                                            </p>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="250" src="{{ asset('assets/panduan/koneksi_aplikasi/isian_data_pemohon.png') }}" width="325"></div>
                                            <div class="text-xs mt-1 text-center">Isian data Pemohon/Pemilik</div>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="250" src="{{ asset('assets/panduan/koneksi_aplikasi/isian_data_bangunan.png') }}" width="325"></div>
                                            <div class="text-xs mt-1 text-center">Isian data Bangunan</div>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="250" src="{{ asset('assets/panduan/koneksi_aplikasi/isian_data_kbli.png') }}" width="325"></div>
                                            <div class="text-xs mt-1 text-center">
                                                Isian data KBLI
                                            </div>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="250" src="{{ asset('assets/panduan/koneksi_aplikasi/isian_data_lokasi.png') }}" width="325"></div>
                                            <div class="text-xs mt-1 text-center">
                                                Isian data Lokasi/Kegiatan
                                            </div>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="250" src="{{ asset('assets/panduan/koneksi_aplikasi/isian_data_dokumen.png') }}" width="325"></div>
                                            <div class="text-xs mt-1 text-center">
                                                Isian data Dokumen
                                            </div>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="250" src="{{ asset('assets/panduan/koneksi_aplikasi/lacak_berkas.png') }}" width="325"></div>
                                            <div class="text-xs mt-1 text-center">
                                                Lacak Berkas
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- Konten fitur 7 --}}
                            <div class="">

                                <div class="py-4 page-section" data-panduan="7" id="pengawasan">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-2xl mb-3">Fitur survey untuk pendataan lapangan
                                            </p>

                                            <p class=" text-justify mb-3">
                                                Fitur survey banyak bermanfaat untuk petugas yang bergerak di lapangan
                                                untuk mengumpulkan data. Kegiatan pendataan yang difasilitas oleh
                                                Pintoinvest adalah kegiatan pengawasan, survey perkembangan wilayah,
                                                kegiatan pendataan usaha dan kegiatan survey izin lingkungan.
                                            </p>


                                            <p class="font-semibold text-xl">Pengawasan</p>

                                            <p class="mt-3 text-justify">Tombol pengawasan berbentuk seperti di bawah
                                                ini. Tombol ini terletak di area panel navigasi sebelah kanan layar.</p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="40" src="{{ asset('assets/panduan/fitur_survey/tombol_pengawasan.png') }}" width="40">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Tombol Pengawasan</div>

                                            <p class=" text-justify mb-3">
                                                Apabila tombol pengawasan ini aktif, maka form isian pengawasan akan
                                                ditampilkan di panel sebelah kiri. Form isian pengawasan memiliki field
                                                koordinat yang otomatis terisi sesuai dengan posisi titik koordinat pin.
                                                Untuk mengubah koordinat, kita perlu menggeser lokasi titik koordinat
                                                pin. Untuk isian tipe ada beberapa opsi yang bisa dipilih: UMK, Cagar
                                                Budaya, Sedang Dibangun, RTH, Pedestrian, Dijual, Galian Dan Utilitas,
                                                Titik Kumpul, Landmark, Parkir Liar, dan Lainnya. Selain itu ada file
                                                foto yang harus dilengkapi dengan mengunggah dokumen gambar (format JPG,
                                                PNG). Field lain yang perlu diisi adalah kolom catatan yang berisi
                                                deskripsi mengenai hasil survey pada lokasi yang sedang diobservasi.
                                            </p>


                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="250" src="{{ asset('assets/panduan/fitur_survey/forum_isian_pengawasan.png') }}" width="325"></div>
                                            <div class="text-xs mt-1 text-center">Form isian Pengawasan</div>

                                        </div>
                                    </div>
                                </div>

                                <div class="py-4 page-section" data-panduan="7" id="survey-perkembangan">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Survey Perkembangan Wilayah</p>

                                            <p class="mt-3 text-justify">Tombol Survey Perkembangan Wilayah terletak di
                                                bawah tombol Pengawasan. Bentuk tombol Survey Perkembangan Wilayah
                                                adalah seperti di bawah ini.</p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="40" src="{{ asset('assets/panduan/fitur_survey/icon_tombol_survey_perkembangan.png') }}" width="40">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Tombol Survey Perkembangan
                                                Wilayah</div>

                                            <p class=" text-justify mb-3">
                                                Apabila tombol ini diaktifkan, maka di panel sebelah kiri akan muncul
                                                form isian Survey Perkembangan Wilayah yang memiliki 2 tab, yaitu tab
                                                Single Insert dan tab Bulk Insert. Tab Single Insert digunakan untuk
                                                pengisian data satu per satu secara manual dengan mengisi setiap kolom
                                                wajib isi di form yang tersedia. Salah satu kolom wajib isi di mode
                                                Single Insert adalah kolom Nama Lokasi. Disarankan untuk mengisi dengan
                                                nama yang mudah dipahami sebagai penanda lokasi survey. Berikutnya ada
                                                kolom Koordinat, ID Sub Blok, Global ID, Kelurahan, dan Kecamatan yang
                                                otomatis terisi sesuai dengan lokasi titik koordinat pin. Untuk opsi
                                                Pola Regional, Pola Lingkungan dan Pola Ruang dan deskripsinya
                                                masing-masing diisi manual dengan pilihan yang sesuai dengan kondisi
                                                wilayah.
                                            </p>


                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="250" src="{{ asset('assets/panduan/fitur_survey/forum_isian_survey_perkembangan.png') }}" width="325"></div>
                                            <div class="text-xs mt-1 mb-8 text-center">Form isian Survey Perkembangan
                                                Wilayah (Single Insert)</div>

                                            <p class="text-justify">
                                                Pada mode Bulk Insert, petugas bisa mengunggah dokumen Excel (format
                                                XLS) untuk mengisi data sekaligus dalam jumlah banyak. Template Excel
                                                tersedia pada link yang tertera pada form isian.
                                            </p>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="250" src="{{ asset('assets/panduan/fitur_survey/bulk_insert.png') }}" width="325"></div>
                                            <div class="text-xs mt-1 mb-8 text-center">Form isian Survey Perkembangan
                                                Wilayah (Bulk Insert)</div>


                                            <p class=" text-justify">
                                                Di bagian bawah form isian mode Bulk Insert ada link untuk mengunduh
                                                arsip yang berisi data-data isian yang telah diunggah ke sistem
                                                Pintoinvest.
                                            </p>



                                        </div>
                                    </div>
                                </div>

                                <div class="py-4 page-section" data-panduan="7" id="pendataan-usaha">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Pendataan usaha</p>

                                            <p class="mt-3 text-justify">Fitur survey selanjutnya yang bermanfaat untuk
                                                validasi kegiatan usaha di lapangan adalah fitur Pendataan Usaha. Tombol
                                                Pendataan Usaha terletak di panel kanan layar dengan bentuk seperti di
                                                bawah ini:</p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="40" src="{{ asset('assets/panduan/fitur_survey/icon_pendataan_usaha.png') }}" width="40">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Tombol Pendataan Usaha</div>

                                            <p class=" text-justify mb-3">
                                                Saat tombol Pendataan Usaha aktif, form Pendataan Usaha seperti di bawah
                                                ini akan muncul di layar sebelah kiri. Semua kolom dengan tanda bintang
                                                (*) wajib diisi untuk kelengkapan data survey Pendataan Usaha. Khusus
                                                untuk koordinat, kolom ID Sub Blok, kelurahan, dan kecamatan akan
                                                otomatis terisi sesuai dengan posisi titik koordinat pin.
                                            </p>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="250" src="{{ asset('assets/panduan/fitur_survey/form_isian_pendataan_usaha.png') }}" width="325"></div>
                                            <div class="text-xs mt-1 mb-8 text-center">Form isian Pendataan Usaha</div>


                                        </div>
                                    </div>

                                </div>

                                <div class="py-4 page-section" data-panduan="7" id="izin-lingkungan">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                            <p class="font-semibold text-xl">Izin lingkungan</p>

                                            <p class="mt-3 text-justify">Fitur survey terakhir yang disediakan di
                                                aplikasi Pintoinvest adalah tombol Izin Lingkungan. Bentuk tombol Izin
                                                Lingkungan yang terletak di panel kanan adalah seperti di bawah ini:</p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="40" src="{{ asset('assets/panduan/fitur_survey/icon_izin_lingkungan.png') }}" width="40">
                                            </div>
                                            <div class="text-xs mt-1 text-center mb-8">Tombol Izin Lingkungan</div>

                                            <p class=" text-justify mb-3">
                                                Setelah tombol Izin Lingkungan aktif, maka form isian Izin Lingkungan
                                                akan ditampilkan di sisi kiri layar aplikasi. Ada 2 mode form isian:
                                                Search Box dan Dropdown dengan bentuk seperti tangkapan layar di bawah
                                                ini. Untuk mode Search Box, petugas bisa melakukan pencarian dokumen
                                                Izin Lingkungan dengan memasukkan nomor permohonan di kolom pencarian
                                                yang disediakan. Kolom-kolom lainnya akan otomatis terisi begitu nomor
                                                permohonan telah ditemukan. Selanjutnya, petugas bisa melengkapi status
                                                terbaru dan memasukkan komentar untuk dokumen permohonan perizinan
                                                tersebut.
                                            </p>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="250" src="{{ asset('assets/panduan/fitur_survey/form_isian_izin_mode_searchbox.png') }}" width="325"></div>
                                            <div class="text-xs mt-1 mb-8 text-center">Form isian Izin Lingkungan mode
                                                Search Box</div>

                                            <p class="text-justify">
                                                Untuk mode Dropdown, aplikasi Pintoinvest menyediakan kolom filter
                                                berdasar kelurahan. Apabila nama kelurahan telah dipilih, selanjutnya
                                                seluruh nama dokumen perizinan akan ditampilkan yang kemudian bisa
                                                difilter berdasarkan nomor permohonan yang dicari. Tangkapan layar Izin
                                                Lingkungan mode Dropdown adalah seperti di bawah ini.
                                            </p>

                                            <div class="mt-8 flex justify-center "><img class="" alt="" height="250" src="{{ asset('assets/panduan/fitur_survey/form_izin_dropdown.png') }}" width="325"></div>
                                            <div class="text-xs mt-1 mb-8 text-center">Form isian Izin Lingkungan mode
                                                Dropdown</div>

                                        </div>
                                    </div>

                                </div>

                            </div>

                            {{-- Konten Filter 8 --}}
                            <div class="">


                                <div class="py-4 page-section" data-panduan="8" id="sewa-kantor">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content">


                                            <p class="font-semibold text-2xl mb-3">Memfilter data dengan fitur chip</p>

                                            <p class="font-semibold text-xl">Sewa Kantor</p>


                                            <p class="mt-3 text-justify">Di bagian atas layar Pintoinvest tersedia 5
                                                chip yang bisa kita gunakan untuk memfilter data spasial yang akan
                                                ditampilkan. Chip filter pertama adalah Sewa Kantor. Apabila chip ini
                                                aktif, kita bisa melihat titik sewa kantor beserta harga sewanya untuk 1
                                                tahun di wilayah kelurahan yang sedang dipilih.</p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/memfilter_chip/chip_filter_sewa_kantor.png') }}" width="650">
                                            </div>
                                            <div class="text-xs mt-1 text-center">Chip filter Sewa Kantor</div>

                                        </div>
                                    </div>
                                </div>

                                <div class="py-4 page-section" data-panduan="8" id="sebaran-nib">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content">

                                            <p class="font-semibold text-xl">Sebaran NIB</p>

                                            <p class="mt-4  text-justify">Chip filter kedua yang bisa digunakan adalah
                                                chip Sebaran NIB. Apabila chip ini aktif, kita bisa melihat titik
                                                sebaran NIB di kelurahan yang sedang aktif. Data yang ditampilkan adalah
                                                skala usaha, resiko proyek, kode KBLI untuk usaha tersebut, beserta
                                                jumlah investasi. Untuk akun dengan role sebagai admin, ada fitur untuk
                                                melakukan edit pada titik NIB yang ditampilkan di layar.</p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/memfilter_chip/chip_filter_sebaran_nib.png') }}" width="650">
                                            </div>
                                            <div class="text-xs mt-1 text-center">Chip filter Sebaran NIB</div>

                                        </div>
                                    </div>
                                </div>

                                <div class="py-4 page-section" data-panduan="8" id="sebaran-umkm">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content">

                                            <p class="font-semibold text-xl">Sebaran UMKM</p>

                                            <p class="mt-4  text-justify">Chip Sebaran UMKM diaktifkan untuk menampilkan
                                                titik sebaran UMKM di wilayah kelurahan di mana titik koordinat pin
                                                berada. Data sebaran UMKM yang ditampilkan meliputi nama usaha, lokasi,
                                                dan jenis usahanya. Untuk akun dengan role admin, tersedia fitur edit
                                                untuk melakukan revisi data secara langsung di layar peta.</p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/memfilter_chip/chip_filter_sebaran_umkm.png') }}" width="650">
                                            </div>
                                            <div class="text-xs mt-1 text-center">Chip filter Sebaran UMKM</div>

                                        </div>
                                    </div>

                                </div>

                                <div class="py-4 page-section" data-panduan="8" id="cagar-budaya">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content">

                                            <p class="font-semibold text-xl">Cagar Budaya</p>

                                            <p class="mt-4  text-justify">Chip filter Cagar Budaya digunakan untuk
                                                aktivasi data sebaran titik cagar budaya di wilayah kelurahan di mana
                                                titik pin berada. Filter ini, apabila aktif, akan menampilkan informasi
                                                lokasi cagar budaya yang terdaftar.</p>

                                            <div class="mt-8 flex justify-center ">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/memfilter_chip/chip_filter_cagar_budaya.png') }}" width="650">
                                            </div>
                                            <div class="text-xs mt-1 text-center">Chip filter Cagar Budaya</div>

                                        </div>
                                    </div>

                                </div>

                                <div class="py-4 page-section" data-panduan="8" id="verifikasi-wilayah">
                                    <div class="komponen">
                                        <div class="py-2 tracking-wide text-[12pt]" id="off_content">

                                            <p class="font-semibold text-xl">Verifikasi Perkembangan Wilayah</p>

                                            <p class="mt-4  text-justify">Chip filter Verifikasi Perkembangan Wilayah
                                                digunakan untuk menampilkan data lapangan hasil survey perkembangan
                                                wilayah. Data hasil verifikasi perkembangan wilayah ini untuk digunakan
                                                bersamaan dengan data layer Transect Zone tahun 2021.</p>

                                            <div class="mt-8 flex justify-center">
                                                <img class="" alt="" height="650" src="{{ asset('assets/panduan/memfilter_chip/chip_filter_verifikasi_perkembangan_wilayah.png') }}" width="650">
                                            </div>
                                            <div class="text-xs mt-1 text-center">Chip filter Verifikasi Perkembangan
                                                Wilayah</div>

                                        </div>
                                    </div>

                                </div>

                            </div>

                            {{-- Konten Konsultasi 9 --}}
                            <div class="pb-4 pt-6 page-section " data-panduan="9" id="konsultasi-usaha">


                                <div class="komponen">
                                    <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                        <p class="font-semibold text-2xl mb-3">Fitur Konsultasi</p>

                                        <p class="mt-3 text-justify">Untuk memfasilitasi tanya jawab perizinan usaha
                                            antar petugas CRO, warga, dan admin sektor, aplikasi Pintoinvest
                                            menyediakan fitur percakapan yang bisa diakses melalui icon di kanan
                                            bawah layar dengan bentuk seperti di bawah ini:</p>

                                        <div class="mt-8 flex justify-center ">
                                            <img class="" alt="" height="40" src="{{ asset('assets/panduan/fitur_konsultasi/icon_konsultasi.png') }}" width="40">
                                        </div>
                                        <div class="text-xs mt-1 text-center mb-8">Icon Konsultasi</div>


                                        <p class=" text-justify mb-3">
                                            Setelah diklik, akan muncul jendela browser baru yang mengarahkan
                                            pengguna ke sub-aplikasi konsultasi Pintoinvest. Di sisi kiri layar
                                            tersedia Kanal, Forum, dan Wilayah. Kanal dibagi menjadi Pengumuman dan
                                            Diskusi Umum. Untuk Forum, aplikasi Pintoinvest membagi-bagi percakapan
                                            ke dalam sektor yang masing-masing dikelola oleh admin sektor.
                                            Diharapkan setiap percakapan mengenai usaha di sektor tersebut bisa
                                            dijawab dengan lengkap oleh admin sektor tersebut.
                                        </p>

                                        <div class="mt-8 flex justify-center "><img class="" alt="" height="250" src="{{ asset('assets/panduan/fitur_konsultasi/kanal_forum_sektor.png') }}" width="325"></div>
                                        <div class="text-xs mt-1 mb-8 text-center">Kanal dan Forum Sektor</div>

                                        <p class=" text-justify mb-3">
                                            Untuk Wilayah, aplikasi Pintoinvest membagi percakapan dalam 5 area:
                                            Jakarta Pusat, Jakarta Utara, Jakarta Selatan, Jakarta Barat, Jakarta
                                            Timur, dan Kab. Kepulauan Seribu.
                                        </p>

                                        <div class="mt-8 flex justify-center "><img class="" alt="" height="250" src="{{ asset('assets/panduan/fitur_konsultasi/kanal_wilayah.png') }}" width="325"></div>
                                        <div class="text-xs mt-1 mb-8 text-center">Kanal Wilayah</div>

                                        <p class=" text-justify mb-3">
                                            Pengguna dapat memulai percakapan dengan menuliskan pesan di jendela
                                            pesan seperti di bawah ini. Konsultasi Pintoinvest memungkinkan pengguna
                                            untuk unggah dokumen atau foto yang mendukung proses konsultasi usaha.
                                        </p>

                                        <div class="mt-8 flex justify-center "><img class="" alt="" height="250" src="{{ asset('assets/panduan/fitur_konsultasi/memulai_percakapan.png') }}" width="325"></div>
                                        <div class="text-xs mt-1 mb-8 text-center">Memulai percakapan</div>

                                        <p class=" text-justify mb-3">
                                            Detil percakapan dan jawabannya akan ditampilkan dalam format thread
                                            seperti di bawah ini.
                                        </p>

                                        <div class="mt-8 flex justify-center "><img class="" alt="" height="650" src="{{ asset('assets/panduan/fitur_konsultasi/detil_percakapan.png') }}" width="650"></div>
                                        <div class="text-xs mt-1 text-center">Detil percakapan</div>

                                    </div>
                                </div>

                            </div>

                            {{-- Konten  Cetak 10 --}}
                            <div class="page-section py-4 get_number_panduan " data-panduan="10" id="cetak-report">

                                <div class="komponen">
                                    <div class="py-2 tracking-wide text-[12pt]" id="off_content" style="">

                                        <p class="font-semibold text-2xl mb-3">Mencetak laporan</p>

                                        <p class="mt-3 text-justify">Seluruh informasi yang ditampilkan di aplikasi
                                            Pintoinvest dapat diekspor dalam bentuk dokumen MS Word (format .docx) atau
                                            PDF. Tombol untuk mengaktifkan fitur cetak terletak di panel kanan dan
                                            berbentuk seperti di bawah ini:</p>


                                        <div class="mt-8 flex justify-center ">
                                            <img class="" alt="" height="40" src="{{ asset('assets/panduan/report/tombol_cetak_laporan.png') }}" width="40">
                                        </div>
                                        <div class="text-xs mt-1 text-center mb-8">Tombol Cetak Laporan</div>

                                        <p class=" text-justify mb-3">
                                            Setelah tombol Cetak Laporan aktif, maka di panel kiri akan tampil form
                                            Cetak seperti di bawah ini. Pada form Cetak ini ada opsi yang harus dipilih
                                            sebelum mulai mencetak laporan. Dokumen laporan yang akan dicetak dibagi
                                            dalam beberapa bagian: Profil, KBLI, Ketentuan, Sarana dan Prasarana,
                                            Indikator, Lingkungan, dan Potensi. Untuk mencetak opsi KBLI, pengguna harus
                                            melakukan pilihan dulu sebelum fitur pencetakan bisa dijalankan.
                                        </p>

                                        <div class="mt-8 flex justify-center "><img class="" alt="" height="250" src="{{ asset('assets/panduan/report/form_pilihan_cetak.png') }}" width="325"></div>
                                        <div class="text-xs mt-1 text-center">Form pilihan cetak</div>

                                    </div>
                                </div>
                            </div>

                            {{-- Konten Video 11 --}}
                            <div class="">
                                <div class="py-6" id="konten_video">

                                    <div class="komponen">

                                        <div class="py-6 tracking-wide text-[12pt]" style="">

                                            <p class="font-semibold text-2xl mb-3">Video</p>

                                            <div class="py-14 page-section" data-panduan="11" id="Video1">



                                                <div class="komponen">

                                                    <p><strong>Kasus 1</strong></p>
                                                    <div class="py-2 tracking-wide text-[12pt] video_pintoinvest" id="off_content">
                                                        <video controls="" name="media">
                                                            <source src="https://jakpintas.dpmptsp-dki.com/v1/panduan-asset/Video1.mp4" type="video/mp4">
                                                        </video>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="py-14 mb-8 page-section" data-panduan="11" id="Video2">



                                                <div class="komponen">

                                                    <p><strong>Kasus 2</strong></p>
                                                    <div class="py-2 tracking-wide text-[12pt] video_pintoinvest" id="off_content"><video controls="" name="media">
                                                            <source src="https://jakpintas.dpmptsp-dki.com/v1/panduan-asset/Video2.mp4" type="video/mp4">
                                                        </video></div>
                                                </div>
                                            </div>

                                            <div class="py-14 mb-8 page-section" data-panduan="11" id="Video3">



                                                <div class="komponen">

                                                    <p><strong>Kasus 3</strong></p>

                                                    <div class="py-2 tracking-wide text-[12pt] video_pintoinvest" id="off_content"><video controls="" name="media">
                                                            <source src="https://jakpintas.dpmptsp-dki.com/v1/panduan-asset/Video3.mp4" type="video/mp4">
                                                        </video></div>
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



    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous">
    </script>



    <script>
        $(document).ready(function() {
            $('.menu_panduan a').click(function() {
                $('.menu_panduan a').removeClass("text-blue-500");
                $(this).addClass("text-blue-500");
            });

        });

    </script>

    <script src="https://cdn.ckeditor.com/4.19.1/standard-all/ckeditor.js"></script>
    <script src="{{ asset('assets/js/bindWithDelay.js') }}"></script>
    {{-- panduan new --}}
    {{-- <script src="{{ asset('assets/js/panduan-new.js') }}"></script> --}}
    <script src="{{ asset('assets/js/panduan.js') }}"></script>
    <script src="{{ asset('assets/js/waypoints.js') }}"></script>
    <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>

</body>

</html>
