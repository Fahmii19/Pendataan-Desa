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

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/jquery-filestyle.min.css') }}">

    <script src="https://cdn.tailwindcss.com"></script>

    <title>Konsultasi</title>

</head>


<body class="body">

    {{-- Header --}}
    <header class="header_hide_menu konten_chating main_header">

        <nav class=" bg-white">
            <div class="grid grid-cols-2 h-[4rem] place-items-center px-2">

                <div class="justify-self-start">
                    <div class="flex flex-row">
                        <div>
                            <img class="icon_jakpintas icon_jakpintas_chating"
                                src="{{ asset('v1/assets/gambar/logo_jakpintas.png') }}" alt="">
                        </div>
                        <div class="self-center leading-normal ml-3 hide_judul_konsultasi">
                            <h5 class="text-lg text-[#5a6474] font-semibold">Konsultasi</h5>
                        </div>
                    </div>
                </div>

                <div class="justify-self-end">
                    <div class="w-full h-12 grid place-items-center">
                        <div class="flex items-center space-x-3">
                            <img class="avatar_user avatar_user_chating" src=" {{ asset('v1/assets/gambar/user.png') }}" alt="">
                            <div class="font-medium text-black informasi_status_user">
                                <div class="text-xs tracking-wide font-normal text-[#212529]">{{ Auth::user()->name }}
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{
                                    Auth::user()->roles->pluck('name')[0]
                                    }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

    </header>


    {{-- Group Chating --}}
    <div class="container_group container_group_chating">

        {{-- Group Server --}}
        <div class="group_server group_server_chating main_server" data-tabs-toggle="#area_cursor_menu" role="tablist">

            @foreach ($server_chat as $i => $s)

            <div class="box_group_server box_group_server_chating group">

                <div class="animation_box_group_server animation_box_group_server_chating {{ $i == 0 ? "
                    channel_rounded_aktif" : "" }} bg-gray-400 transition-all ease-linear duration-[200ms]
                    group-hover:rounded-[35%] server-{{ $s->label }}"
                    onclick="tabsServer('{{ $s->label }}',
                    '{{ $s->name }}')">

                    <div class="text-white">{{ $s->label }}</div>

                    <div
                        class="animation_rectanle_group_server animation_rectanle_group_server_chating group-hover:scale-y-50 ">
                    </div>

                    <div id='{{ $s->label }}-border'
                        class="animation_rounded_group_server animation_rounded_group_server_chating"></div>

                </div>

            </div>

            @endforeach

        </div>

        {{-- Group Channel/Sektor --}}

        {{-- judul_chating_channel --}}
        <div class="group_list_sektor group_list_sektor_chating main_channel">

            {{-- judul_chating_channel --}}
            <div class="judul_chating_channel judul_chating_channel_chating" id="name-server">
                Pendataan Usaha
            </div>

            <div class="add_cursor_menu scrollbar scrollbar-firefox start-scrollbar group_channel group_channel_chating"
                id="area_cursor_menu">

                @foreach($server_chat as $i => $s)
                <div class="{{ $i > 0 ? " hidden" : "" }} padding_left_sektor" id="{{ $s->label }}-tabs"
                    role="tabpanel">
                    @foreach ($s->kategori as $k)
                    <div class="tabs mb-2">
                        <div class="tab-hide-show">

                            <div class="relative">

                                <input class="input_sektor_group_channel" checked type="checkbox"
                                    id="name_judul_sektor">

                                <div class="sektor_group_channel" for="name_judul_sektor">

                                    <div class="box_icon_group_channel tab-icon">

                                        <svg aria-hidden="true" class="" data-reactid="266" fill="none" height="24"
                                            stroke="#606F7B" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.5" viewbox="0 0 24 24" width="24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>

                                    </div>

                                    <span
                                        class="judul_sektor_group_channel judul_sektor_group_channel_chating change_color_chanel">{{
                                        $k->name
                                        }}</span>

                                </div>


                                <div class="tab-content">
                                    <div class="text-grey-darkest mt-[1%] mb-[1.8%]">

                                        <ul class="bg_sektor_aktif">

                                            @foreach($k->chanel as $c)
                                            <li class="" id="{{ $c->id }}">
                                                <div id="aktif_menu_channel"
                                                    class="box_tab_content_group_channel channel-{{ $c->id }} hover:bg-gray-300 px-[1.3rem]"
                                                    onclick="select_sector('{{ base64_encode($c->id) }}', '{{ $c->name }}')">

                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 1w-4 mt-1.5 text-[#212529] menu_channel_aktif_icon"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M9.243 3.03a1 1 0 01.727 1.213L9.53 6h2.94l.56-2.243a1 1 0 111.94.486L14.53 6H17a1 1 0 110 2h-2.97l-1 4H15a1 1 0 110 2h-2.47l-.56 2.242a1 1 0 11-1.94-.485L10.47 14H7.53l-.56 2.242a1 1 0 11-1.94-.485L5.47 14H3a1 1 0 110-2h2.97l1-4H5a1 1 0 110-2h2.47l.56-2.243a1 1 0 011.213-.727zM9.03 8l-1 4h2.938l1-4H9.031z"
                                                            clip-rule="evenodd" />
                                                    </svg>


                                                    <div
                                                        class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                                                        <div class="grid_container_tab_content_group_channel">
                                                            <div class="col-span-3 pl-1 text-black">

                                                                @if($c->name == "Selamat datang!")
                                                                <div class="inline-flex">
                                                                    Selamat datang! &nbsp; <img class="w-5 h-5"
                                                                        src="{{ asset('v1/assets/gambar/chating/hand.png') }}" alt="">
                                                                </div>
                                                                @else
                                                                {{
                                                                $c->name }}
                                                                @endif


                                                            </div>
                                                            <div
                                                                class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                                                0</div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </li>

                                            @endforeach

                                        </ul>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach

            </div>

        </div>

        {{-- Group Konten --}}
        <div class="group_konten_menu group_konten_chating main_konten">
            <div class="rounded-lg" style="background-image: url('{{ asset('assets/bg4.png') }}');">

                <div class="container_group_konten container_group_konten_chating">
                    <div class="container_group_kontens">

                        {{-- Mengatur konten chat --}}
                        <div class="container_konten_chat_group_konten">

                            {{--Judul Chating --}}
                            <div class="box_judul_group_konten">

                                <div class="tab_menu_mobile" onclick="Menu()">
                                    <img class="logo_menu_hamburger logo_menu_hamburger_chating"
                                        src="{{ asset('v1/assets/gambar/chating/menu-hamburger.png') }}" alt="">
                                </div>

                                <div class="hide_hastag_chating mx-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon_judul_group_konten icon_judul_group_konten_chating"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M9.243 3.03a1 1 0 01.727 1.213L9.53 6h2.94l.56-2.243a1 1 0 111.94.486L14.53 6H17a1 1 0 110 2h-2.97l-1 4H15a1 1 0 110 2h-2.47l-.56 2.242a1 1 0 11-1.94-.485L10.47 14H7.53l-.56 2.242a1 1 0 11-1.94-.485L5.47 14H3a1 1 0 110-2h2.97l1-4H5a1 1 0 110-2h2.47l.56-2.243a1 1 0 011.213-.727zM9.03 8l-1 4h2.938l1-4H9.031z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>

                                <img class="img_judul_group_konten close_chating hidden"
                                    src="{{ asset('v1//assets/gambar/saved-chating.png') }}" alt="">

                                <div class="flex justify-between flex-row w-full">
                                    <div class="teks_judul_group_konten teks_judul_group_konten_chating">
                                        <p class="truncate" id="room-sector">
                                            Selamat Datang
                                        </p>
                                    </div>

                                    <div class="btn_prio_search_mobile inline-flex items-center">

                                        <div class="mr-3">
                                            <svg aria-hidden="true" class="icon_search icon_search_chating" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </div>

                                        <div class="mr-1">
                                            <svg onclick="" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                class="icon_msg_prioritas icon_msg_prioritas_chating">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z">
                                                </path>
                                            </svg>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            {{-- Isi Chating --}}
                            <div class="box_konten_chat_group_konten box_konten_chat_group_konten_chating"
                                id="auto-scroll-bottom">

                                <div class="scroling-chating" id="list-message">
                                </div>

                            </div>

                            <div class="box_input_msg">

                                <form action="" method="post" class="w-full hide_form" id="sendMessage">

                                    <div class="grid grid-cols-2">

                                        <div class="col-span-2 hidden" id="reply-content">
                                            <div class="bg-gray-200 ml-5 mr-[1.1rem] rounded-t-lg mb-[-2px]">
                                                <div class="flex justify-between">

                                                    <div class="px-4 py-2 text-sm font-normal">Kutip</div>

                                                    <div class="px-4 py-2 cursor-pointer"
                                                        onclick="$('#reply-content').hide()">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-6 w-6 text-gray-400" viewBox="0 0 20 20"
                                                            fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-span-2">
                                            <div class="flex ml-5 mr-[1.1rem] bg-gray-100 rounded-lg -z-0">

                                                {{-- Upload File --}}
                                                <div class="flex items-center justify-center w-12 h-12">
                                                    <input type="file" id="upload_file"
                                                        accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/*">

                                                    <a href="" id="link_upload">
                                                        <img class="w-full w-7 h-7"
                                                            src="{{ asset('assets/icon_tambah.png') }}" alt="">
                                                    </a>
                                                </div>

                                                {{-- Input --}}
                                                <div class="grow h-12 w-full">

                                                    {{-- Input Msg --}}
                                                    {{-- <div class="h-full flex">
                                                        <input type="text" placeholder="Ketik pesan" id="message"
                                                            class="flex-grow text-sm focus:outline-none -ml-2 pr-5 rounded-lg bg-transparent text-gray-700  ">
                                                    </div> --}}

                                                    {{-- Textarea Msg --}}
                                                    <textarea
                                                        class="w-full h-[2.5rem] mt-[0.250rem] remove_all_style_textarea pr-2 scrollbar-textarea-input scrollbar scrollbar-firefox bg-gray-100 overflow-hidden leading-[1.3rem] py-[0.6rem]"
                                                        name="" id="message" placeholder="Ketik pesan"></textarea>

                                                </div>

                                                {{-- Button Kirim --}}
                                                <div class="flex w-14 h-12 items-center justify-center">
                                                    <button type="submit">
                                                        <svg class="w-5 h-5 text-gray-500 origin-center transform rotate-90"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor">
                                                            <path
                                                                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
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

        {{-- Group Pencarian & Message Prioritas --}}
        <div
            class="group_pencarian_prioritas top_group_pencarian_prioritas group_pencarian_prioritas_chating top_group_pencarian_prioritas_chating main_sidebar">

            <div class="container_group_pencarian_prioritas">
                <div class="box_group_pencarian_prioritas">

                    {{-- Button Search Message --}}
                    <div class="box_btn_search_group_pencarian_prioritas">

                        {{-- Search Message --}}
                        <div class="konten_btn_search_group_pencarian_prioritas">
                            <div class="relative block">

                                <div class="konten_left_btn_search_group_pencarian_prioritas">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>

                                <input
                                    class="btn-hapus-pencarian w-full bg-transparent placeholder:font-italitc rounded-md py-2 pl-10 pr-8 focus:outline-none text-sm "
                                    placeholder="Cari pesan" type="text" id="searchMessage" />

                                <div class="" id="show-btn-hapus-pencarian" style="display: none">
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                                        <svg onclick="removeSearch()" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </span>
                                </div>

                            </div>
                        </div>

                        {{-- Button HideShow Prioritas --}}
                        <div class="btn_hideshow_group_pencarian_prioritas" onclick="btn_Prioritas()">
                            <div class="cursor-pointer" id="close-search-ticket">
                                <svg onclick="" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                </svg>
                            </div>
                        </div>

                    </div>

                    {{-- Konten Isi dari Search Message --}}
                    <div class="box_search_message_group_pencarian_prioritas hideshow_search_message hidden">
                        <div class="konten_search_message_group_pencarian_prioritas" id="search-message">
                        </div>
                    </div>

                    {{-- Konten Button HideShow Prioritas --}}
                    <div class="box_prioritas_message_group_pencarian_prioritas box_konten_hide scrollbar-msg-prioritas scrollbar scrollbar-firefox"
                        id="hideshow_msg_prioritas">

                        <div class="judul_prioritas_group_pencarian_prioritas">
                            Pesan Prioritas
                        </div>

                        <div id="priority_msg" class="">
                            <div class="list-priority text-sm text-zinc-700 font-normal tracking-wide break-words">
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>


    {{-- Source --}}
    <script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js/bindWithDelay.js') }}"></script>

    <script>
        //Get ID User From Auth
        let user_id = parseInt("{!! Auth::user()->id !!}");
        let username = "{!! Auth::user()->name !!}";
        let data_server = JSON.parse('{!! json_encode($server_chat) !!}')
        let sektor_user = JSON.parse('{!! json_encode(Auth::user()->sektor) !!}').slice(1,-1).split(",");
    </script>

    {{-- Logical Script --}}
    <script src="/assets/js/chat.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
    <script src="{{ asset('assets/js/jquery-filestyle.min.js') }}"></script>

</body>

</html>