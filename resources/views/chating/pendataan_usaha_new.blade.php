<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{--
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    {{-- mobile no zoom --}}
    <meta meta name="viewport" content="width=device-width, user-scalable=no" />

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('assets/admin/img/favicon.png') }}" rel="icon">

    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome/css/font-awesome.min.css') }}">


    {{--
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('css/app-new.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/jquery-filestyle.min.css') }}">

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.4/dist/flowbite.min.css" />

    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>

    <title>Konsultasi</title>

    <style>
        .textarea_judul textarea {
            font-size: 22px;
            font-weight: 600;
            color: #5a6474;
        }

        .textarea_judul textarea::placeholder {
            font-size: 22px;
            font-weight: 600;
            color: #5a6474;
        }

        .textarea_title textarea {
            color: #697689;
        }

        .textarea_title textarea::placeholder {
            color: #697689;
        }

    </style>

</head>


<body class="body">

    {{-- Header konten1--}}
    <header class="header_hide_menu konten_chating main_header hidden">

        <nav class=" bg-white">
            <div class="grid grid-cols-2 h-[4rem] place-items-center px-2">

                <div class="justify-self-start">
                    <div class="flex flex-row">
                        <div>
                            <img class="icon_jakpintas icon_jakpintas_chating" src="{{ asset('/assets/gambar/logo_invest.png') }}" alt="">
                        </div>

                        <div class="self-center leading-normal ml-3 hide_judul_konsultasi">
                            <h5 class="text-lg text-[#5a6474] font-semibold">Konsultasi </h5>
                        </div>

                        <div class="versi_jakpintas">
                            <span class="absolute top-[2.1rem] w-[10rem] text-xs text-gray-500 font-bold">v2.0.0</span>
                        </div>

                    </div>
                </div>

                <div class="justify-self-end">
                    <div class="w-full h-12 grid place-items-center">
                        <div class="flex items-center space-x-3">
                            <img class="avatar_user avatar_user_chating" src="{{ asset('/assets/gambar/user.png') }}" alt="">
                            <div class="font-medium text-black informasi_status_user">
                                <div class="text-xs tracking-wide font-normal text-[#212529]">{{ Auth::user()->name }}
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{
                                    Auth::user()->roles->pluck('name')[0]
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

    </header>


    {{-- Group Chating --}}
    <div class="container_group container_group_chating">

        {{-- Group Server konten2--}}
        <div class="group_server group_server_chating main_server" data-tabs-toggle="#area_cursor_menu" role="tablist">


            {{-- icon jakpintas --}}
            <div class="box_group_server box_group_server_chating group">

                <div>
                    <img class="icon_jakpintas icon_jakpintas_chating" src="{{ asset('/assets/gambar/logo_invest.png') }}" alt="">
                </div>

            </div>

            <div class="box_group_server box_group_server_chating group" id="call_pengumuman">

                <div class="animation_box_group_server animation_box_group_server_chating channel_rounded_aktif bg-gray-400 transition-all ease-linear duration-[200ms] group-hover:rounded-[35%] server-PU rounded-[35%]" onclick="tabsServer(1,'PU',
                    'Perizinan Usaha')">

                    <div class="text-white">PU</div>

                    <div class="animation_rectanle_group_server animation_rectanle_group_server_chating group-hover:scale-y-50 ">
                    </div>

                    <div id="PU-border" class="animation_rounded_group_server animation_rounded_group_server_chating" style="display: block;"></div>

                </div>

            </div>

            {{-- Tata ruang --}}
            {{-- <div class="box_group_server box_group_server_chating group padding_server">

                <div class="animation_box_group_server animation_box_group_server_chating bg-gray-400 transition-all ease-linear duration-[200ms] group-hover:rounded-[35%] server-TR"
                    onclick="tabsServer('TR',
                    'Tata Ruang')">

                    <div class="text-white">TR</div>

                    <div
                        class="animation_rectanle_group_server animation_rectanle_group_server_chating group-hover:scale-y-50 ">
                    </div>

                    <div id="TR-border" class="animation_rounded_group_server animation_rounded_group_server_chating"
                        style="display: none;"></div>

                </div>

            </div> --}}


            @role('admin')

            <div class="box_group_server box_group_server_chating group padding_server" id="call_dev">

                <div class="animation_box_group_server animation_box_group_server_chating bg-gray-400 transition-all ease-linear duration-[200ms] group-hover:rounded-[35%] server-D" onclick="tabsServer(3,'D',
                    'Development')">

                    <div class="text-white">D</div>

                    <div class="animation_rectanle_group_server animation_rectanle_group_server_chating group-hover:scale-y-50 ">
                    </div>

                    <div id="D-border" class="animation_rounded_group_server animation_rounded_group_server_chating" style="display: none;"></div>

                </div>

            </div>


            @endrole

            <div class="box_group_server box_group_server_chating group padding_server" id="call_dev">

                <div class="animation_box_group_server animation_box_group_server_chating transition-all ease-linear duration-[200ms] group-hover:rounded-[35%] server-D">

                </div>

            </div>



        </div>

        {{-- judul_chating_channel konten3 --}}
        <div class="group_list_sektor group_list_sektor_chating main_channel">

            <div class="w-full flex flex-col mt-[1.8rem] ml-1">
                <div class="flex flex-row items-end border-b-[1px] border-gray-300 pt-[0.4rem]">
                    <div class="text-[17pt] text-[#5a6474] font-extrabold -mb-[0.1rem]">Konsultasi</div>
                    <div class="text-[9pt] font-bold pl-1 text-[#5a6474] mb-[0.1rem]">v2.0.0</div>
                </div>

                <div class="text-[18px] text-[#212529] tracking-wide w-11/12">

                    <div class="grid_container_tab_content_group_channel">
                        <div class="col-span-3 text-black">

                            <div class="inline-flex">
                                <div id="nama_server_menu"></div> &nbsp;
                            </div>

                        </div>
                    </div>

                </div>

            </div>


            {{-- <div
                class="w-full flex-col justify-between px-2 py-[0.4rem] border-b-[1px] border-gray-300 text-[17pt] text-[#5a6474] font-extrabold mt-[1.25rem]"
                id="name-server">

                <div>
                    Perizinan Usaha
                </div>

                <div>sadsa</div>

            </div> --}}

            <div class="add_cursor_menu scrollbar scrollbar-firefox group_channel group_channel_chating" id="area_cursor_menu">

                <div class="padding_left_sektor" id="PU-tabs" role="tabpanel">


                    {{-- <div class="tabs mb-2">
                        <div class="tab-hide-show">

                            <div class="relative">

                                <input class="input_sektor_group_channel" checked="" type="checkbox"
                                    id="name_judul_sektor">

                                <div class="sektor_group_channel" for="name_judul_sektor">

                                    <div class="box_icon_group_channel tab-icon">

                                        <svg aria-hidden="true" class="" data-reactid="266" fill="none" height="24"
                                            stroke="#606F7B" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.5" viewBox="0 0 24 24" width="24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7">
                                            </path>
                                        </svg>

                                    </div>

                                    <span
                                        class="judul_sektor_group_channel judul_sektor_group_channel_chating change_color_chanel">Forum</span>

                                </div>


                                <div class="tab-content">
                                    <div class="text-grey-darkest mt-[1%] mb-[1.8%]">

                                        <ul class="bg_sektor_aktif">

                                            <li class="" id="3">
                                                <div id="aktif_menu_channel"
                                                    class="box_tab_content_group_channel channel-3 hover:bg-gray-300 px-[1.3rem]"
                                                    onclick="select_sector('Mw==', 'Kelautan dan perikanan',3,'forum')">

                                                    <div class="h-7 grid place-items-center">
                                                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png"
                    alt="">
                </div>

                <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                    <div class="grid_container_tab_content_group_channel">
                        <div class="col-span-3 pl-1 text-black">

                            Kelautan dan perikanan


                        </div>
                        <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message-kanal">
                            0</div>
                    </div>

                </div>
            </div>

            </li>

            <li class="" id="4">
                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-4 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NA==', 'Pertanian',4,'forum')">

                    <div class="h-7 grid place-items-center">
                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                    </div>


                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                        <div class="grid_container_tab_content_group_channel">
                            <div class="col-span-3 pl-1 text-black">

                                Pertanian


                            </div>
                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                0</div>
                        </div>

                    </div>
                </div>

            </li>

            <li class="" id="5">
                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-5 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NQ==', 'Lingkungan hidup dan kehutanan',5,'forum')">

                    <div class="h-7 grid place-items-center">
                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                    </div>


                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                        <div class="grid_container_tab_content_group_channel">
                            <div class="col-span-3 pl-1 text-black">

                                Lingkungan hidup dan kehutanan


                            </div>
                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                0</div>
                        </div>

                    </div>
                </div>

            </li>

            <li class="" id="6">
                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-6 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('Ng==', 'Energi dan sumber daya mineral',6,'forum')">

                    <div class="h-7 grid place-items-center">
                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                    </div>


                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                        <div class="grid_container_tab_content_group_channel">
                            <div class="col-span-3 pl-1 text-black">

                                Energi dan sumber daya mineral


                            </div>
                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                0</div>
                        </div>

                    </div>
                </div>

            </li>

            <li class="" id="7">
                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-7 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('Nw==', 'Perindustrian',7,'forum')">

                    <div class="h-7 grid place-items-center">
                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                    </div>


                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                        <div class="grid_container_tab_content_group_channel">
                            <div class="col-span-3 pl-1 text-black">

                                Perindustrian


                            </div>
                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                0</div>
                        </div>

                    </div>
                </div>

            </li>

            <li class="" id="8">
                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-8 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('OA==', 'Perdagangan',8,'forum')">

                    <div class="h-7 grid place-items-center">
                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                    </div>


                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                        <div class="grid_container_tab_content_group_channel">
                            <div class="col-span-3 pl-1 text-black">

                                Perdagangan


                            </div>
                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                13</div>
                        </div>

                    </div>
                </div>

            </li>

            <li class="" id="9">
                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-9 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('OQ==', 'Pekerjaan umum dan perumahan rakyat',9,'forum')">

                    <div class="h-7 grid place-items-center">
                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                    </div>


                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                        <div class="grid_container_tab_content_group_channel">
                            <div class="col-span-3 pl-1 text-black">

                                Pekerjaan umum dan perumahan rakyat


                            </div>
                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                0</div>
                        </div>

                    </div>
                </div>

            </li>

            <li class="" id="10">
                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-10 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('MTA=', 'Transportasi',10,'forum')">

                    <div class="h-7 grid place-items-center">
                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                    </div>


                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                        <div class="grid_container_tab_content_group_channel">
                            <div class="col-span-3 pl-1 text-black">

                                Transportasi


                            </div>
                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                0</div>
                        </div>

                    </div>
                </div>

            </li>

            <li class="" id="11">
                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-11 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('MTE=', 'Kesehatan, obat, dan makanan',11,'forum')">

                    <div class="h-7 grid place-items-center">
                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                    </div>


                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                        <div class="grid_container_tab_content_group_channel">
                            <div class="col-span-3 pl-1 text-black">

                                Kesehatan, obat, dan makanan


                            </div>
                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                3</div>
                        </div>

                    </div>
                </div>

            </li>

            <li class="" id="12">
                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-12 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('MTI=', 'Pendidikan dan kebudayaan',12,'forum')">

                    <div class="h-7 grid place-items-center">
                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                    </div>


                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                        <div class="grid_container_tab_content_group_channel">
                            <div class="col-span-3 pl-1 text-black">

                                Pendidikan dan kebudayaan


                            </div>
                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                0</div>
                        </div>

                    </div>
                </div>

            </li>

            <li class="" id="13">
                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-13 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('MTM=', 'Pariwisata',13,'forum')">

                    <div class="h-7 grid place-items-center">
                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                    </div>


                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                        <div class="grid_container_tab_content_group_channel">
                            <div class="col-span-3 pl-1 text-black">

                                Pariwisata


                            </div>
                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                0</div>
                        </div>

                    </div>
                </div>

            </li>

            <li class="" id="14">
                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-14 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('MTQ=', 'Pos, telekomunikasi, penyiaran, dan sistem dan transaksi elektronik',14,'forum')">

                    <div class="h-7 grid place-items-center">
                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                    </div>


                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                        <div class="grid_container_tab_content_group_channel">
                            <div class="col-span-3 pl-1 text-black">

                                Pos, telekomunikasi, penyiaran, dan sistem dan transaksi
                                elektronik


                            </div>
                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                0</div>
                        </div>

                    </div>
                </div>

            </li>

            <li class="" id="15">
                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-15 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('MTU=', 'Ketenagakerjaan',15,'forum')">

                    <div class="h-7 grid place-items-center">
                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                    </div>


                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                        <div class="grid_container_tab_content_group_channel">
                            <div class="col-span-3 pl-1 text-black">

                                Ketenagakerjaan


                            </div>
                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                0</div>
                        </div>

                    </div>
                </div>

            </li>

            <li class="" id="22">
                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-16 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('MjI=', 'LKPM',16,'forum')">

                    <div class="h-7 grid place-items-center">
                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                    </div>


                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                        <div class="grid_container_tab_content_group_channel">
                            <div class="col-span-3 pl-1 text-black">

                                LKPM


                            </div>
                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                0</div>
                        </div>

                    </div>
                </div>

            </li>

            <li class="" id="25">
                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-17 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('MjU=', 'JakPintas',17,'forum')">

                    <div class="h-7 grid place-items-center">
                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                    </div>


                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                        <div class="grid_container_tab_content_group_channel">
                            <div class="col-span-3 pl-1 text-black">

                                JakPintas


                            </div>
                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                0</div>
                        </div>

                    </div>
                </div>

            </li>


            </ul>

        </div>
    </div>

    </div>
    </div>
    </div>

    <div class="tabs mb-2">
        <div class="tab-hide-show">

            <div class="relative">

                <input class="input_sektor_group_channel" checked="" type="checkbox" id="name_judul_sektor">

                <div class="sektor_group_channel" for="name_judul_sektor">

                    <div class="box_icon_group_channel tab-icon">

                        <svg aria-hidden="true" class="" data-reactid="266" fill="none" height="24" stroke="#606F7B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>

                    </div>

                    <span class="judul_sektor_group_channel judul_sektor_group_channel_chating change_color_chanel">Wilayah</span>

                </div>


                <div class="tab-content">
                    <div class="text-grey-darkest mt-[1%] mb-[1.8%]">

                        <ul class="bg_sektor_aktif">

                            <li class="" id="70">
                                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-70 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NzA=', 'UP PMPTSP Jakarta Pusat',70,'forum')">

                                    <div class="h-7 grid place-items-center">
                                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                                    </div>


                                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                        <div class="grid_container_tab_content_group_channel">
                                            <div class="col-span-3 pl-1 text-black">

                                                UP PMPTSP Jakarta Pusat


                                            </div>
                                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                2</div>
                                        </div>

                                    </div>
                                </div>

                            </li>

                            <li class="" id="71">
                                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-71 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NzE=', 'UP PMPTSP Jakarta Utara',71,'forum')">

                                    <div class="h-7 grid place-items-center">
                                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                                    </div>


                                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                        <div class="grid_container_tab_content_group_channel">
                                            <div class="col-span-3 pl-1 text-black">

                                                UP PMPTSP Jakarta Utara


                                            </div>
                                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                0</div>
                                        </div>

                                    </div>
                                </div>

                            </li>

                            <li class="" id="72">
                                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-72 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NzI=', 'UP PMPTSP Jakarta Selatan',72,'forum')">

                                    <div class="h-7 grid place-items-center">
                                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                                    </div>


                                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                        <div class="grid_container_tab_content_group_channel">
                                            <div class="col-span-3 pl-1 text-black">

                                                UP PMPTSP Jakarta Selatan


                                            </div>
                                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                0</div>
                                        </div>

                                    </div>
                                </div>

                            </li>

                            <li class="" id="73">
                                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-73 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NzM=', 'UP PMPTSP Jakarta Barat',73,'forum')">

                                    <div class="h-7 grid place-items-center">
                                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                                    </div>


                                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                        <div class="grid_container_tab_content_group_channel">
                                            <div class="col-span-3 pl-1 text-black">

                                                UP PMPTSP Jakarta Barat


                                            </div>
                                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                5</div>
                                        </div>

                                    </div>
                                </div>

                            </li>

                            <li class="" id="74">
                                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-74 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NzQ=', 'UP PMPTSP Jakarta Timur',74,'forum')">

                                    <div class="h-7 grid place-items-center">
                                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                                    </div>


                                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                        <div class="grid_container_tab_content_group_channel">
                                            <div class="col-span-3 pl-1 text-black">

                                                UP PMPTSP Jakarta Timur


                                            </div>
                                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                4</div>
                                        </div>

                                    </div>
                                </div>

                            </li>

                            <li class="" id="75">
                                <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-75 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NzU=', 'UP PMPTSP Kab. Kepulauan Seribu',75,'forum')">

                                    <div class="h-7 grid place-items-center">
                                        <img class="w-4 h-4" src="{{ asset('v1') }}/assets/gambar/chating/chating.png" alt="">
                                    </div>


                                    <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                        <div class="grid_container_tab_content_group_channel">
                                            <div class="col-span-3 pl-1 text-black">

                                                UP PMPTSP Kab. Kepulauan Seribu


                                            </div>
                                            <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                0</div>
                                        </div>

                                    </div>
                                </div>

                            </li>


                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </div> --}}
    </div>

    <div class=" hidden padding_left_sektor" id="TR-tabs" role="tabpanel" style="display: none;">
        <div class="tabs mb-2">
            <div class="tab-hide-show">

                <div class="relative">

                    <input class="input_sektor_group_channel" checked="" type="checkbox" id="name_judul_sektor">

                    <div class="sektor_group_channel" for="name_judul_sektor">

                        <div class="box_icon_group_channel tab-icon">

                            <svg aria-hidden="true" class="" data-reactid="266" fill="none" height="24" stroke="#606F7B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>

                        </div>

                        <span class="judul_sektor_group_channel judul_sektor_group_channel_chating change_color_chanel">Penting</span>

                    </div>


                    <div class="tab-content">
                        <div class="text-grey-darkest mt-[1%] mb-[1.8%]">

                            <ul class="bg_sektor_aktif">

                                <li class="" id="76">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-76 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NzY=', 'Selamat datang!')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    <div class="inline-flex">
                                                        Selamat datang! &nbsp; <img class="w-5 h-5" src="{{ asset('/assets/gambar/chating/hand.png') }}" alt="">
                                                    </div>


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="77">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-77 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('Nzc=', 'Pengumuman')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="
                                                        {{ asset('/assets/gambar/chating/chating.png') }} alt="">
                                                    </div>


                                                    <div class=" text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Pengumuman


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>


                            </ul>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="tabs mb-2">
            <div class="tab-hide-show">

                <div class="relative">

                    <input class="input_sektor_group_channel" checked="" type="checkbox" id="name_judul_sektor">

                    <div class="sektor_group_channel" for="name_judul_sektor">

                        <div class="box_icon_group_channel tab-icon">

                            <svg aria-hidden="true" class="" data-reactid="266" fill="none" height="24" stroke="#606F7B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>

                        </div>

                        <span class="judul_sektor_group_channel judul_sektor_group_channel_chating change_color_chanel">Kecamatan</span>

                    </div>


                    <div class="tab-content">
                        <div class="text-grey-darkest mt-[1%] mb-[1.8%]">

                            <ul class="bg_sektor_aktif">

                                <li class="" id="27">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-27 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('Mjc=', 'Cakung')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Cakung


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="28">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-28 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('Mjg=', 'Cempaka Putih')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Cempaka Putih


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="29">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-29 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('Mjk=', 'Cengkareng')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Cengkareng


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="30">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-30 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('MzA=', 'Cilandak')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Cilandak


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="31">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-31 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('MzE=', 'Cilincing')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Cilincing


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="32">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-32 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('MzI=', 'Cipayung')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Cipayung


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="33">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-33 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('MzM=', 'Ciracas')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Ciracas


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="34">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-34 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('MzQ=', 'Duren Sawit')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>

                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Duren Sawit


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="35">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-35 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('MzU=', 'Gambir')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Gambir


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="36">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-36 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('MzY=', 'Jagakarsa')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Jagakarsa


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="37">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-37 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('Mzc=', 'Jatinegara')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Jatinegara


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="38">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-38 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('Mzg=', 'Johar Baru')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Johar Baru


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="39">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-39 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('Mzk=', 'Kali Deres')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Kali Deres


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="40">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-40 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NDA=', 'Kebayoran Baru')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Kebayoran Baru


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="41">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-41 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NDE=', 'Kebayoran Lama')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Kebayoran Lama


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="42">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-42 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NDI=', 'Kebon Jeruk')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Kebon Jeruk


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="43">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-43 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NDM=', 'Kelapa Gading')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Kelapa Gading


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="44">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-44 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NDQ=', 'Kemayoran')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Kemayoran


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="45">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-45 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NDU=', 'Kembangan')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Kembangan


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="46">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-46 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NDY=', 'Kepulauan Seribu Selatan')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Kepulauan Seribu Selatan


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="47">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-47 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NDc=', 'Kepulauan Seribu Utara')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Kepulauan Seribu Utara


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="48">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-48 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NDg=', 'Koja')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Koja


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="49">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-49 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NDk=', 'Kramat Jati')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Kramat Jati


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="50">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-50 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NTA=', 'Makasar')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Makasar


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="51">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-51 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NTE=', 'Mampang Prapatan')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Mampang Prapatan


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="52">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-52 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NTI=', 'Matraman')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Matraman


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="53">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-53 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NTM=', 'Menteng')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Menteng


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="54">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-54 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NTQ=', 'Pademangan')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Pademangan


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="55">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-55 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NTU=', 'Palmerah')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Palmerah


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="56">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-56 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NTY=', 'Pancoran')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Pancoran


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="57">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-57 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NTc=', 'Pasar Minggu')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Pasar Minggu


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="58">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-58 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NTg=', 'Pasar Rebo')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Pasar Rebo


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="59">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-59 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NTk=', 'Penjaringan')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Penjaringan


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="60">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-60 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NjA=', 'Pesanggrahan')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Pesanggrahan


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="61">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-61 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NjE=', 'Pulo Gadung')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Pulo Gadung


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="62">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-62 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NjI=', 'Sawah Besar')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Sawah Besar


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="63">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-63 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NjM=', 'Senen')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Senen


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="64">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-64 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NjQ=', 'Setia Budi')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Setia Budi


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="65">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-65 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NjU=', 'Taman Sari')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Taman Sari


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="66">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-66 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('NjY=', 'Tambora')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Tambora


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="67">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-67 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('Njc=', 'Tanah Abang')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Tanah Abang


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="68">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-68 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('Njg=', 'Tanjung Priok')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Tanjung Priok


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                                <li class="" id="69">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-69 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('Njk=', 'Tebet')">

                                        <div class="h-7 grid place-items-center">
                                            <img class="w-4 h-4" src="{{ asset('/assets/gambar/chating/chating.png') }}" alt="">
                                        </div>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Tebet


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>


                            </ul>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- hide agar tidak bentrok D-tabs --}}
    <div class=" hidden padding_left_sektor" id="D-tabss" role="tabpanel" style="display: none;">
        <div class="tabs mb-2">
            <div class="tab-hide-show">

                <div class="relative">

                    <input class="input_sektor_group_channel" checked="" type="checkbox" id="name_judul_sektor">

                    <div class="sektor_group_channel" for="name_judul_sektor">

                        <div class="box_icon_group_channel tab-icon">

                            <svg aria-hidden="true" class="" data-reactid="266" fill="none" height="24" stroke="#606F7B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>

                        </div>

                        <span class="judul_sektor_group_channel judul_sektor_group_channel_chating change_color_chanel">Testing</span>

                    </div>


                    <div class="tab-content">
                        <div class="text-grey-darkest mt-[1%] mb-[1.8%]">

                            <ul class="bg_sektor_aktif">

                                <li class="" id="78">
                                    <div id="aktif_menu_channel" class="box_tab_content_group_channel channel-18 hover:bg-gray-300 px-[1.3rem]" onclick="select_sector('Nzg=', 'Development',18,'kanal')">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 1w-4 mt-1.5 text-[#212529] menu_channel_aktif_icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9.243 3.03a1 1 0 01.727 1.213L9.53 6h2.94l.56-2.243a1 1 0 111.94.486L14.53 6H17a1 1 0 110 2h-2.97l-1 4H15a1 1 0 110 2h-2.47l-.56 2.242a1 1 0 11-1.94-.485L10.47 14H7.53l-.56 2.242a1 1 0 11-1.94-.485L5.47 14H3a1 1 0 110-2h2.97l1-4H5a1 1 0 110-2h2.47l.56-2.243a1 1 0 011.213-.727zM9.03 8l-1 4h2.938l1-4H9.031z" clip-rule="evenodd"></path>
                                        </svg>


                                        <div class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                            <div class="grid_container_tab_content_group_channel">
                                                <div class="col-span-3 pl-1 text-black">

                                                    Chat


                                                </div>
                                                <div class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                    0</div>
                                            </div>

                                        </div>
                                    </div>

                                </li>


                            </ul>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- <div class="tabs mb-2">
                        <div class="tab-hide-show">

                            <div class="relative">

                                <input class="input_sektor_group_channel" checked="" type="checkbox"
                                    id="name_judul_sektor">

                                <div class="sektor_group_channel" for="name_judul_sektor">

                                    <div class="box_icon_group_channel tab-icon">

                                        <svg aria-hidden="true" class="" data-reactid="266" fill="none" height="24"
                                            stroke="#606F7B" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.5" viewBox="0 0 24 24" width="24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7">
                                            </path>
                                        </svg>

                                    </div>

                                    <span
                                        class="judul_sektor_group_channel judul_sektor_group_channel_chating change_color_chanel">Forum</span>

                                </div>


                                <div class="tab-content">
                                    <div class="text-grey-darkest mt-[1%] mb-[1.8%]">

                                        <ul class="bg_sektor_aktif">

                                            <li class="" id="78">
                                                <div id="aktif_menu_channel"
                                                    class="box_tab_content_group_channel channel-18 hover:bg-gray-300 px-[1.3rem]"
                                                    onclick="select_sector('Nzg=', 'Development',19,'Forum')">

                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 1w-4 mt-1.5 text-[#212529] menu_channel_aktif_icon"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M9.243 3.03a1 1 0 01.727 1.213L9.53 6h2.94l.56-2.243a1 1 0 111.94.486L14.53 6H17a1 1 0 110 2h-2.97l-1 4H15a1 1 0 110 2h-2.47l-.56 2.242a1 1 0 11-1.94-.485L10.47 14H7.53l-.56 2.242a1 1 0 11-1.94-.485L5.47 14H3a1 1 0 110-2h2.97l1-4H5a1 1 0 110-2h2.47l.56-2.243a1 1 0 011.213-.727zM9.03 8l-1 4h2.938l1-4H9.031z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>


                                                    <div
                                                        class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                                        <div class="grid_container_tab_content_group_channel">
                                                            <div class="col-span-3 pl-1 text-black">

                                                                Chat


                                                            </div>
                                                            <div
                                                                class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                                0</div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </li>


                                        </ul>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> --}}
    </div>

    </div>

    </div>

    {{-- konten4 --}}
    <div class="w-screen grid mt-2">

        {{-- Komponen --}}
        <div class="grid-rows-2">
            {{-- header_judul --}}
            <div class="h-[3.8rem] grid grid-cols-3 justify-items-start border-b-[1px]">
                {{-- judul_channel_diskusi_umum --}}
                <div class="grid content-end tracking-wide text-[15px] font-bold  text-[#5a6474] w-full py-1 pl-6 opacity-1 col-span-2">
                    <div id="room-sector"></div>
                </div>

                <div class="w-full h-full flex justify-end items-stretch px-4">
                    <div class="flex self-center space-x-3">
                        <img class="avatar_user avatar_user_chating" src="{{ asset('/assets/gambar/user.png') }}" alt="">
                        <div class="font-medium text-black informasi_status_user">
                            <div class="text-xs tracking-wide font-normal text-[#212529]">{{
                                    Auth::user()->name }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{
                                    Auth::user()->roles->pluck('name')[0]
                                    }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- komponen forum & kanal --}}
            <div class="grid grid-cols-1">
                <div class="container_diskusi_umum">

                    {{--Judul Diskusi --}}
                    <div class="box_judul_group_konten">

                        <div class="tab_menu_mobile" onclick="Menu()">
                            <img class="logo_menu_hamburger logo_menu_hamburger_chating" src="{{ asset('/vq/assets/gambar/chating/menu-hamburger.png') }}" alt="">
                        </div>

                        <div class="hide_hastag_chating mx-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon_judul_group_konten icon_judul_group_konten_chating" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.243 3.03a1 1 0 01.727 1.213L9.53 6h2.94l.56-2.243a1 1 0 111.94.486L14.53 6H17a1 1 0 110 2h-2.97l-1 4H15a1 1 0 110 2h-2.47l-.56 2.242a1 1 0 11-1.94-.485L10.47 14H7.53l-.56 2.242a1 1 0 11-1.94-.485L5.47 14H3a1 1 0 110-2h2.97l1-4H5a1 1 0 110-2h2.47l.56-2.243a1 1 0 011.213-.727zM9.03 8l-1 4h2.938l1-4H9.031z" clip-rule="evenodd"></path>
                            </svg>
                        </div>

                        <img class="img_judul_group_konten close_chating hidden" src="/assets/gambar/saved-chating.png" alt="">

                        <div class="flex justify-between flex-row w-full">
                            <div class="teks_judul_group_konten teks_judul_group_konten_chating">
                                <p class="truncate" id="room-sector">
                                    Selamat Datang
                                </p>
                            </div>

                            {{-- logo prio dan search dinonaktifkan --}}
                            <div class="btn_prio_search_mobile inline-flex items-center hidden">

                                <div class="mr-3 group hover:bg-stone-300 hover:ring-stone-300 p-[0.150rem]" onclick="chatingSearch()">
                                    {{-- icon_search_chating --}}
                                    <svg aria-hidden="true" class="icon_search w-[1.4rem] h-[1.4rem] text-gray-500 stroke-[2px] group-hover:stroke-[3px]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                                        </path>
                                    </svg>
                                </div>

                                <div class="mr-1 group hover:bg-stone-300 hover:ring-stone-300 p-[0.150rem]" onclick="chatingPrioritas();">
                                    {{-- icon_msg_prioritas_chating --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="icon_msg_prioritas w-[1.4rem] h-[1.4rem] text-gray-500 stroke-[2px] group-hover:stroke-[3px]">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z">
                                        </path>
                                    </svg>
                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- diskusi umum - kanal --}}
                    <div class="w-full h-full pb-5 pt-4 overflow-y-hidden bg-slate-50 border kanal_diskusi_umum hidden">

                        <div class="scroling_diskusi_umum h-[91vh] -mb-16" id="list-message"></div>

                        {{-- <div>
                                <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg show_btn_message-1588"
                                    id="message-1588" onmouseenter="btnMessage(1588,2565)">

                                    <div class="flex justify-start w-full cursor-pointer">

                                        <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">

                                            <div class="flex flex-row px-3 py-2">

                                                <div class="w-[3.1rem] h-10 grid items-center">
                                                    <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png"
                                                        alt="">
                                                </div>

                                                <div class="flex flex-col w-full">
                                                    <div class="container_replay_box">

                                                        <div class="replay_box">
                                                            <div class="flex flex-rows items-center">

                                                                <div class="maks_username">
                                                                    <p class="truncate">
                                                                        admin jakpintas
                                                                    </p>
                                                                </div>

                                                                <div class="w-[3.5rem] h-[1.1rem] flex items-center bg-blue-600 text-white text-[7pt] ml-2 font-semibold rounded-[4px] px-0 mr-1"
                                                                    style="position:relative; top: -0.1rem;"> <svg
                                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="3.5"
                                                                        stroke="currentColor"
                                                                        class="w-4 h-3 text-white ml-[0.1rem]">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M4.5 12.75l6 6 9-13.5"></path>
                                                                    </svg>ADMIN</div>

                                                                <div class="ml-1 text-[11px] text-gray-500">
                                                                    12:58 WIB
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="grid justify-items-end content-center">
                                                            <div>
                                                                <div id="select_delete_message-1588" class="hidden"
                                                                    style="display: none;">
                                                                    <div class="" onclick="delete_message(1588,1)">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke-width="1.5" stroke="currentColor"
                                                                            class="w-[2.7vw] h-[2.7vh] hover:text-red-500">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                                                            </path>
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="konten_send_response">
                                                        <div>
                                                            <p>halloo</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> --}}


                        {{-- input message hidden for user, display on admin --}}
                        <div class="inputan_forum">
                            <form action="" method="post" class="w-full px-3.5" id="sendMessage" autocomplete="off">

                                <div class="grid grid-cols-2">

                                    <div class="col-span-2 hidden" id="reply-content">
                                        <div class="bg-gray-200 ml-5 mr-[1.1rem] rounded-t-lg mb-[-2px]">
                                            <div class="flex justify-between">

                                                <div class="px-4 py-2 text-sm font-normal">Kutip
                                                </div>

                                                <div class="px-4 py-2 cursor-pointer" onclick="$('#reply-content').hide()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-2 h-[2.7rem]">
                                        <div class="box_input_message ">


                                            <div class="flex items-center justify-center w-12 h-10">
                                                <input type="file" id="upload_file" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/*">

                                                <a href="" id="link_upload">
                                                    <img class="w-6 h-6" src="{{ asset('assets/icon_tambah.png') }}" alt="">
                                                </a>
                                            </div>


                                            <div class="grow h-10 w-full ">

                                                <div class="h-full flex">
                                                    <input type="text" placeholder="Ketik pesan" id="message" autocomplete="off" class="flex-grow text-sm border-transparent focus:border-transparent focus:ring-0 -ml-2 pr-5 rounded-lg bg-transparent text-gray-700  ">
                                                </div>

                                                {{-- <textarea
                                                        class="w-full h-[2rem] mt-[0.250rem] remove_all_style_textarea pr-2 scrollbar-textarea-input scrollbar scrollbar-firefox bg-gray-200 overflow-hidden leading-[1.3rem] py-[0.4rem] text-[14px]"
                                                        name="" id="message" placeholder="Ketik pesan"></textarea>
                                                    --}}

                                            </div>


                                            <div class="flex w-14 h-10 items-center justify-center">
                                                <button type="submit">
                                                    <svg class="w-5 h-5 text-gray-500 origin-center transform rotate-90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </form>
                        </div>

                    </div>

                    {{-- Thread - Forum --}}
                    <div class="grid grid-cols-2 forum_thread">

                        {{-- thread left --}}
                        <div class="thread_left hidden">

                            <div style="background-image: url('{{ asset('assets/bg4.png') }}');" class="py-0 overflow-y-hidden">

                                <div class="container_thread_left ">

                                    {{-- Tampilkan ketika awal post --}}
                                    <div class="grid grid-cols-1 justify-items-start my-3 mr-1" id="create_judul">
                                        <div>
                                            <div class="flex justify-end mt-0.5 col-span-1">
                                                <div class="cursor-pointer">
                                                    <span class="bg-blue-600 text-white max-w-[9rem] inline-flex items-center px-3.5 py-[0.9vh] rounded-[20px]">

                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-5 mr-1">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                                                        </svg>
                                                        <span class="tracking-wide text-[12pt] font-medium">
                                                            Pesan baru
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Komponen Create Judul --}}
                                    {{-- Tampilan setelah klik menampilkan konten post thread --}}
                                    {{-- <div
                                            class="bg-slate-50 px-2 pt-2 pb-5 rounded-[15px] flex flex-col justify-between mb-6 mt-[1rem] hidden"
                                            id="show_post_thread">
                                            <form action="" method="post" class="w-full post_thread"
                                                id="create_post_thread" autocomplete="off">

                                                <div
                                                    class="flex flex-row py-2 px-3 mt-[0.2rem] created_box_post_thread">

                                                    <div class="mr-3 cursor-pointer" id="close_post_thread">

                                                        <img class="w-7"
                                                            src="{{ asset('assets/gambar/chating/x-mark.png') }}"
                                    alt="">
                                </div>

                                <div class="post_thread_judul box_post_thread_show">

                                    <div class="textarea_judul">
                                        <textarea class="w-full h-[1.5rem] remove_all_style_textarea scrollbar-textarea-input scrollbar scrollbar-firefox bg-slate-50 overflow-hidden leading-[1.3rem] post_post_thread" name="" id="title_post_created" placeholder="PT. ABC ..." oninput="adjustHeight(this)"></textarea>
                                    </div>

                                    <div class="textarea_title">
                                        <textarea class="w-full !h-[4rem] remove_all_style_textarea scrollbar-textarea-input scrollbar scrollbar-firefox bg-slate-50 overflow-hidden leading-[1.3rem] post_post_thread" name="" id="konten_post_created" placeholder="Ketik di sini ..." oninput="adjustHeight(this)"></textarea>
                                    </div>

                                </div>

                                <div class="basis-[8rem] grid justify-items-end hidden">

                                    <div class="absolute w-[5rem] h-[5rem] mr-[6rem]">
                                        <input type="file" multiple="" id="upload-image-post" class="hidden">
                                        <div class="preview-image-post max-w-18 h-full flex flex-row object-fill scrollbar scrollbar-upload-image">
                                        </div>
                                    </div>

                                    <label for="upload-image-post">
                                        <div class="w-[5rem] h-[5rem] rounded-[10px] mr-0.5 bg-gray-200 grid place-items-center cursor-pointer">
                                            <img class="w-8 h-8" src="{{ asset('assets/gambar/chating/upload_image.png') }}" alt="upload">
                                        </div>
                                    </label>

                                </div>

                                <div class="basis-[8rem] grid justify-items-end">

                                    <div class="absolute w-[2vw] h-[5rem] mr-[6rem]">

                                        <input type="file" id="upload_btn_create_post_thread" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/*" class="hidden">
                                        <div class="preview-image-post max-w-18 h-full flex flex-row object-fill scrollbar scrollbar-upload-image">
                                        </div>
                                    </div>

                                    <span id="hide-show-image-post">
                                        <label for="upload_btn_create_post_thread">
                                            <div class="w-[5rem] h-[5rem] rounded-[10px] mr-0.5 bg-gray-200 grid place-items-center cursor-pointer">
                                                <img class="w-10 h-10" src="{{ asset('assets/gambar/chating/upload_image.png') }}" alt="upload">
                                            </div>
                                        </label>

                                    </span>

                                    <div class="relative w-[6vw]">

                                        <div id="uploaded_image_post_thread" class="h-full grid place-content-center">
                                            <div id="preview-upload-thread"></div>
                                        </div>

                                        <div id="remove-button" class="bg-red-500 w-4 h-4 rounded-full px-0.5 py-0.5 absolute top-0 right-0 cursor-pointer" style="display: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 text-white">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </div>
                                    </div>



                                </div>

                            </div>

                            <div class="grid grid-cols-11 h-full w-full pr-2.5 pl-12 show_list_post">

                                <div class="show_list_post_child_one col col-span-2">

                                    <div class="grid grid-cols-2">

                                        <div class="cursor-pointer ">
                                            <input type="checkbox" class="pilih_status hidden" name="get_stat[]" value="Penting" id="status_penting">
                                            <label for="status_penting">
                                                <span class="bg-gray-200 max-w-[9rem] text-gray-800 tracking-wide text-xs font-medium inline-flex items-center px-3 py-[0.25rem] rounded-[20px] cursor-pointer mr-2 aktif_class_status">
                                                    <span class="font-bold opacity-[0.8]">Penting</span>
                                                </span>
                                            </label>
                                        </div>


                                        <div class="cursor-pointer custom_tl_ml">
                                            <input type="checkbox" class="pilih_status hidden" name="get_stat[]" value="TL" id="status_tl">
                                            <label for="status_tl">
                                                <span class="bg-gray-200 max-w-[11vw] text-gray-800 tracking-wide text-xs font-medium inline-flex items-center px-2 py-1 rounded-[20px] cursor-pointer mr-2 aktif_class_status">

                                                    <span class="font-bold opacity-[0.8]">TL</span>
                                                </span>
                                            </label>
                                        </div>



                                    </div>



                                </div>

                                <div class="flex justify-end mt-0.5 show_list_post_child_two col-span-9">

                                    <input type="submit" id="send_post" class="hidden">

                                    <div class="cursor-pointer" id="create_send_post">
                                        <span class="bg-blue-500 max-w-[9rem] text-white tracking-wide text-xs font-semibold inline-flex items-center px-3.5 py-[0.8vh] rounded-[20px] btn_send_created_post">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4 mr-1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5">
                                                </path>
                                            </svg>

                                            Kirim
                                        </span>
                                    </div>

                                </div>

                            </div>

                            </form>
                        </div> --}}

                        {{-- konsep lama --}}

                        <div class="bg-slate-50 px-2 pt-2 pb-5 rounded-[15px] flex flex-col justify-between mb-6 mt-[1rem] hidden" id="show_post_thread">
                            <form action="" method="post" class="w-full post_thread" id="create_post_thread" autocomplete="off">

                                <div class="flex flex-row py-2 px-3 mt-[0.2rem] created_box_post_thread">

                                    <div class="post_thread_judul box_post_thread_show">

                                        <div class="textarea_judul">
                                            <textarea class="w-full h-[1.5rem] remove_all_style_textarea scrollbar-textarea-input scrollbar scrollbar-firefox bg-slate-50 overflow-hidden leading-[1.3rem] post_post_thread" name="" id="title_post_created" placeholder="PT. ABC ..." oninput="adjustHeight(this)"></textarea>
                                        </div>

                                        <div class="textarea_title">
                                            <textarea class="w-full !h-[4rem] remove_all_style_textarea scrollbar-textarea-input scrollbar scrollbar-firefox bg-slate-50 overflow-hidden leading-[1.3rem] post_post_thread" name="" id="konten_post_created" placeholder="Ketik di sini ..." oninput="adjustHeight(this)"></textarea>
                                        </div>

                                    </div>

                                    {{-- upload file craete post forum--}}
                                    {{-- multifile --}}
                                    <div class="basis-[8rem] grid justify-items-end hidden">

                                        <div class="absolute w-[5rem] h-[5rem] mr-[6rem]">
                                            <input type="file" multiple="" id="upload-image-post" class="hidden">
                                            <div class="preview-image-post max-w-18 h-full flex flex-row object-fill scrollbar scrollbar-upload-image">
                                            </div>
                                        </div>

                                        <label for="upload-image-post">
                                            <div class="w-[5rem] h-[5rem] rounded-[10px] mr-0.5 bg-gray-200 grid place-items-center cursor-pointer">
                                                <img class="w-8 h-8" src="{{ asset('/assets/gambar/chating/upload_image.png') }}" alt="upload">
                                            </div>
                                        </label>

                                    </div>

                                    {{-- Single File --}}
                                    <div class="basis-[8rem] grid justify-items-end">

                                        <div class="absolute w-[2vw] h-[5rem] mr-[6rem]">

                                            <input type="file" id="upload_btn_create_post_thread" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/*" class="hidden">
                                            <div class="preview-image-post max-w-18 h-full flex flex-row object-fill scrollbar scrollbar-upload-image">
                                            </div>
                                        </div>

                                        <span id="hide-show-image-post">
                                            <label for="upload_btn_create_post_thread">
                                                <div class="w-[5rem] h-[5rem] rounded-[10px] mr-0.5 bg-gray-200 grid place-items-center cursor-pointer">
                                                    <img class="w-10 h-10" src="{{ asset('/assets/gambar/chating/upload_image.png') }}" alt="upload">
                                                </div>
                                            </label>

                                        </span>

                                        <div class="relative w-[6vw]">
                                            {{-- <img class="w-[12vw] h-[12vh] object-cover"
                                                                id="uploaded_image_post_thread" style="display: none;">
                                                            --}}




                                            {{-- <div class="h-full grid place-content-center"
                                                                style="display: none;" id="uploaded_image_post_thread">
                                                                <img class="max-w-[5vw]" src=" /assets/pngnew.png"
                                                                    alt="">
                                                            </div> --}}

                                            <div id="uploaded_image_post_thread" class="h-full grid place-content-center">
                                                <div id="preview-upload-thread"></div>
                                            </div>

                                            {{-- <button id="remove-button"
                                                                style="display: none;">x</button> --}}

                                            <div id="remove-button" class="bg-red-500 w-4 h-4 rounded-full px-0.5 py-0.5 absolute top-0 right-0 cursor-pointer" style="display: none;">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 text-white">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="grid grid-cols-11 h-full w-full pr-2.5 pl-2 show_list_post">

                                    <div class="show_list_post_child_one col col-span-2">

                                        <div class="grid grid-cols-2">

                                            <div class="cursor-pointer ">
                                                <input type="checkbox" class="pilih_status hidden" name="get_stat[]" value="Penting" id="status_penting">
                                                <label for="status_penting">
                                                    <span class="bg-gray-200 max-w-[9rem] text-gray-800 tracking-wide text-xs font-medium inline-flex items-center px-3 py-[0.25rem] rounded-[20px] cursor-pointer mr-2 aktif_class_status">
                                                        <span class="font-bold opacity-[0.8]">Penting</span>
                                                    </span>
                                                </label>
                                            </div>


                                            <div class="cursor-pointer custom_tl_ml">
                                                <input type="checkbox" class="pilih_status hidden" name="get_stat[]" value="TL" id="status_tl">
                                                <label for="status_tl">
                                                    <span class="bg-gray-200 max-w-[11vw] text-gray-800 tracking-wide text-xs font-medium inline-flex items-center px-2 py-1 rounded-[20px] cursor-pointer mr-2 aktif_class_status">

                                                        <span class="font-bold opacity-[0.8]">TL</span>
                                                    </span>
                                                </label>
                                            </div>



                                        </div>



                                    </div>

                                    <div class="flex justify-end mt-0.5 show_list_post_child_two col-span-9">

                                        <input type="submit" id="send_post" class="hidden">

                                        <div class="cursor-pointer" id="create_send_post">
                                            <span class="bg-blue-500 max-w-[9rem] text-white tracking-wide text-xs font-semibold inline-flex items-center px-3.5 py-[0.8vh] rounded-[20px] btn_send_created_post">

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4 mr-1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5">
                                                    </path>
                                                </svg>

                                                Kirim
                                            </span>
                                        </div>

                                    </div>

                                </div>

                            </form>
                        </div>

                        {{-- Komponen Postingan --}}

                        <div id="list-created-post"></div>


                    </div>


                    <div class="rounded-lg hidden" style="background-image: url('{{ asset('assets/bg4.png') }}');">
                    </div>

                </div>

            </div>

            {{-- Thread Right --}}
            <div class="thread_right hidden">

                <div class="container_thread_right">

                    {{-- box_post_forum --}}
                    <div class="scrollbar scrollbar-respon-post scrollbar-firefox bg-slate-50 pt-5 pl-0 pr-0 w-full h-[91vh] pb-[8vh] -mb-[7vh]" id="auto-scroll-bottom">

                        <div id="judul-postingan-thread" class="relative top-0 grid grid-cols-1 px-0 konten_postingan add_border">
                        </div>

                        <div class="relative top-0 grid grid-cols-">

                            <div id="pesan-postingan-thread"></div>

                        </div>

                    </div>


                    {{-- Komponen Input Pesan Postingan --}}
                    <div class="input_postingan bg-slate-50 relative">
                        <div class="px-3">
                            <form action="" method="post" class="w-full" id="sendPost" autocomplete="off">

                                <div class="grid grid-cols-2">

                                    <div class="col-span-2 hidden" id="reply-content">
                                        <div class="bg-gray-200 ml-5 mr-[1.1rem] rounded-t-lg mb-[-2px]">
                                            <div class="flex justify-between">

                                                <div class="px-4 py-2 text-sm font-normal">
                                                    Kutip
                                                </div>

                                                <div class="px-4 py-2 cursor-pointer" onclick="$('#reply-content').hide()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-2 h-[2.7rem]">
                                        <div class="flex bg-gray-200 rounded-lg border-2">


                                            <div class="flex items-center justify-center w-12 h-10">
                                                <input type="file" id="upload_file_post" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/*">

                                                <a href="" id="link_upload_post">
                                                    <img class="w-6 h-6" src="{{ asset('assets/icon_tambah.png') }}" alt="">
                                                </a>

                                            </div>


                                            <div class="grow h-10 w-full ">

                                                <div class="h-full flex">
                                                    <input type="text" placeholder="Ketik pesan" autocomplete="off" id="message_respon_post" class="flex-grow text-sm border-transparent focus:border-transparent focus:ring-0 -ml-2 pr-5 rounded-lg bg-transparent text-gray-700  ">
                                                </div>

                                            </div>


                                            <div class="flex w-14 h-10 items-center justify-center">
                                                <button type="submit">
                                                    <svg class="w-5 h-5 text-gray-500 origin-center transform rotate-90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>


                </div>


            </div>

        </div>

    </div>
    </div>

    </div>

    </div>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.2.0/socket.io.js"></script> --}}

    {{-- <script src="https://cdn.socket.io/socket.io-1.2.0.js"></script> --}}

    {{-- Source --}}
    <script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js/bindWithDelay.js') }}"></script>

    <script>
        //Get ID User From Auth
        let user_id = parseInt("{!! Auth::user()->id !!}");
        let username = "{!! Auth::user()->name !!}";
        let data_server = JSON.parse('{!! json_encode($server_chat) !!}')
        let sektor_user = JSON.parse('{!! json_encode(Auth::user()->sektor) !!}').slice(1, -1).split(",");

    </script>

    {{-- Logical Script --}}

    <script src="{{ asset('assets/js/chat-new.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/chat.js') }}"></script> --}}
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
    <script src="{{ asset('assets/js/jquery-filestyle.min.js') }}"></script>

    {{-- kompresi file --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/compressorjs/1.1.1/compressor.min.js" integrity="sha512-VaRptAfSxXFAv+vx33XixtIVT9A/9unb1Q8fp63y1ljF+Sbka+eMJWoDAArdm7jOYuLQHVx5v60TQ+t3EA8weA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.2.2/jszip.min.js"></script>

</body>

</html>
