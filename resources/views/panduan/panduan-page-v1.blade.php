<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="title" content="Peta Perizinan dan Investasi DKI Jakarta">
    <meta name="description"
        content="Peta Perizinan dan Investasi oleh DKI Jakarta bekerja sama dengan DPMPTSP DKI Jakarta ">
    <meta name="og:title" content="Peta Perizinan dan Investasi DKI Jakarta">
    <meta name="og:description"
        content="Peta Perizinan dan Investasi oleh DKI Jakarta bekerja sama dengan DPMPTSP DKI Jakarta ">
    <meta name="twitter:title" content="Peta Perizinan dan Investasi DKI Jakarta">
    <meta name="twitter:description"
        content="Peta Perizinan dan Investasi oleh DKI Jakarta bekerja sama dengan DPMPTSP DKI Jakarta ">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Panduan Pengguna Pintoinvest</title>

    {{-- source css custom --}}
    <link rel="icon" href="{{ asset('assets/gambar/favicon.png') }}">

    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css" />

    <link rel="stylesheet" href="{{ asset('assets/css/panduan.css') }}">

    <style>
        h1 {
            font-size: 1.5rem !important;
        }

        h2 {
            font-size: 1.1rem !important;
        }

        h3 {
            font-size: 0.9rem !important;
        }

        ul {
            counter-reset: list;
        }

        ul>li {
            list-style: none;
            position: relative;
        }

        ul>li:before {
            counter-increment: list;
            content: counter(list, disc);
            /* margin-left: 2vw; */
            position: relative;
            left: -0.2vw;
        }
    </style>

    {{-- source --}}
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="font-['Arial']">

    <div class="flex flex-row h-screen">

        <div class="basis-[20rem] bg-[#fafafa] w-full pb-5 px-4">

            {{-- Judul --}}
            <div class="grid grid-cols-3 py-5">
                <div class="col-span-2">
                    <span class="font-bold text-[14pt] cursor-pointer">Sistem Pintoinvest</span>
                </div>
                <div class="grid">
                    @role('admin')
                    <div class="place-self-end cursor-pointer" data-modal-toggle="modal-input-menu">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </div>
                    @endrole
                </div>

            </div>

            {{-- Daftar Panduan --}}
            <div class="flex flex-col ml-1 h-[90vh] overflow-x-hidden scrollbar scrollbar-firefox">

                <ol class="relative">
                    @foreach($nama_judul as $nj)
                    <li id="trigger_judul-{{ $nj->id }}" onmouseover="boxKonten({{ $nj->id }})">
                        @if($nj->category == "Judul")
                        <span class="text-md list-group-item hover:text-indigo-600 cursor-pointer font-semibold"
                            onclick="chooseSubJudul({{ $nj->id }})">
                            {{ $nj->ordered }} {{ $nj->title }}
                        </span>

                        @role('admin')
                        <div id="trigger_action_sub-{{ $nj->id }}"
                            class="absolute -mt-[3vh] h-[3.2vh] w-[6vw] bg-gray-300 rounded-sm hideshow_btn_action right-0 mr-0.5">
                            <div class="w-full grid grid-cols-2 place-items-center">

                                <div class="mt-[0.3vh] cursor-pointer" data-modal-toggle="modal-edit-menu"
                                    onclick="editMenuPanduan({{ $nj->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </div>

                                <div class="mt-[0.3vh] cursor-pointer" onclick="deleteMenuPanduan({{ $nj->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        @endrole
                        @endif

                        <ol class="relative">
                            @if($nj->category == "SubJudul1" || $nj->category == "SubJudul2" || $nj->category ==
                            "SubJudul3")
                            <li id="trigger_judul-{{ $nj->id }}" onmouseover="boxKonten({{ $nj->id }})"
                                class="flex justify-between subjudul_custom ml-4 {{ $nj->id == 142 ? " active_menu" : ""
                                }}" id="active_menu" onclick="chooseSubJudul({{ $nj->id }})">

                                <div>
                                    <span
                                        class="text-md list-group-item hover:text-indigo-600 cursor-pointer font-medium">
                                        {{ $nj->ordered }} {{ $nj->title }}
                                    </span>
                                </div>

                                @role('admin')
                                <div id="trigger_action_sub-{{ $nj->id }}"
                                    class="h-[3.2vh] px-1 mr-0.5 bg-gray-300 rounded-sm absolute hideshow_btn_action hidden right-0">
                                    <div class="w-full grid grid-cols-1 place-items-center">
                                        <div class="w-full grid grid-cols-2 place-items-center">

                                            <div class="mt-[0.3vh] px-1 cursor-pointer"
                                                data-modal-toggle="modal-edit-menu"
                                                onclick="editMenuPanduan({{ $nj->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </div>

                                            <div class="mt-[0.3vh] cursor-pointer"
                                                onclick="deleteMenuPanduan({{ $nj->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    @endrole

                            </li>

                            @endif
                        </ol>

                    </li>
                    @endforeach
                </ol>

            </div>

            <!-- Main modal add -->
            <div id="modal-input-menu" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <h3 class="text-xl font-semibold text-black">
                                Form Input
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                                data-modal-toggle="modal-input-menu">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->

                        <div class="p-6 space-y-6">
                            <form action="{{ route('add-panduan') }}" method="POST">
                                <div class="mb-6">
                                    <label class="block mb-2 text-sm font-medium text-black">Nama Judul</label>
                                    <input type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        name="nama_judul" id="nama_judul" placeholder="Ketik disini">
                                </div>

                                <label class="block mb-2 text-sm font-medium text-gray-900 ">Kategori Judul</label>
                                <select
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-6"
                                    name="kategori">
                                    <option value="" selected disabled hidden>Piih</option>
                                    <option value="Judul">Judul</option>
                                    <option value="SubJudul1">Sub Judul 1</option>
                                    <option value="SubJudul2">Sub Judul 2</option>
                                    <option value="SubJudul3">Sub Judul 3</option>
                                </select>

                                <div class="mb-6">
                                    <label class="block mb-2 text-sm font-medium text-black">Penomoran</label>
                                    <input type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        name="penomoran" id="penomoran" placeholder="Ketik disini">
                                </div>

                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                                    onclick="add_modal()">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main modal update --}}
            <div id="modal-edit-menu" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <h3 class="text-xl font-semibold text-black">
                                Form Update
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                                data-modal-toggle="modal-edit-menu">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->

                        <div class="p-6 space-y-6">
                            <form id="formUpdatePanduan">

                                <input type="hidden" id="edit_id">

                                <div class="mb-6">
                                    <label class="block mb-2 text-sm font-medium text-black">Nama Judul</label>
                                    <input type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        name="nama_judul" id="edit_nama_judul" placeholder="Ketik disini">
                                </div>

                                <label class="block mb-2 text-sm font-medium text-gray-900 ">Kategori Judul</label>
                                <select
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-6"
                                    name="kategori" id="edit_kategori">
                                    <option value="" selected disabled hidden>Piih</option>
                                    <option value="Judul">Judul</option>
                                    <option value="SubJudul1">Sub Judul 1</option>
                                    <option value="SubJudul2">Sub Judul 2</option>
                                    <option value="SubJudul3">Sub Judul 3</option>
                                </select>

                                <div class="mb-6">
                                    <label class="block mb-2 text-sm font-medium text-black">Penomoran</label>
                                    <input type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        name="penomoran" id="edit_penomoran" placeholder="Ketik disini">
                                </div>

                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Konten --}}
        <div class="basis-[80rem] w-full scrollbar scrollbar-firefox overflow-y-auto overflow-x-hidden">

            {{-- Button Hide Show Search --}}
            {{-- Dihide pencarian untuk versi kedua --}}
            {{-- <div onclick="btn_hideshowSearch()" class="btn_hideshow_search flex flex-row py-5 px-6 hidden">
                <div class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                        stroke="currentColor" class=" w-5 h-5 text-slate-600 hover:text-slate-800">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
            </div> --}}

            {{-- Pdf --}}
            <div class="flex flex-row justify-end py-3 px-6 group">
                <a target="_blank" href="{{ asset('pdf-panduan/PanduanJakpintas.pdf') }}">
                    <div class="w-[3.3vw] flex items-stretch flex-col cursor-pointer">

                        <div class="self-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 group-hover:text-blue-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>

                        <div class="-mt-1 self-center">
                            <span class="text-[9pt] font-bold tracking-wide group-hover:text-blue-500">PDF</span>
                        </div>

                    </div>
                </a>
            </div>

            <div class="px-40">

                {{-- Pencarian --}}
                <div class="flex flex-col relative mt-2 mb-6 hidden" id="hideshowsearch">

                    <div class="relative w-full flex items-center">

                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>

                        <input type="text" id="search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                            placeholder="Pencarian...">

                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">

                            {{-- Delete --}}
                            <div id="cancel-search" onclick="cancelSearch()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                    class="w-5 h-5 text-gray-500 hover:text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>

                            {{-- Loading --}}
                            <div id="process-search" class="hidden">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-300"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </div>

                        </div>

                    </div>

                    {{-- <div
                        class="max-h-[20rem] scrollbar overflow-y-auto overflow-x-hidden w-full bg-gray-200 rounded mt-2 p-4 absolute z-[99] top-10 hidden"
                        id="container-result-search">

                        <div class="flex flex-col text-[11pt]" id="result-search">


                        </div>
                    </div> --}}

                    <div class="max-h-[20rem] scrollbar overflow-y-auto overflow-x-hidden w-full bg-white rounded mt-2 py-4 absolute z-[99] top-10 hidden"
                        id="container-result-search" style="display: block;">
                        {{-- <div
                            class="max-h-[20rem] scrollbar overflow-y-auto overflow-x-hidden w-full bg-gray-200 rounded mt-2 p-4 absolute z-[99] top-10 hidden"
                            id="container-result-search" style="display: block;"> --}}

                            <div class="flex flex-col text-[11pt]" id="result-search">

                            </div>

                        </div>

                    </div>

                    {{-- Konten Isi --}}
                    <div class="py-4" id="">

                        {{-- komponen judul --}}
                        <div class="flex col-row justify-end mt-2 mb-4 ">

                            @role('admin')
                            <div class="flex items-center">

                                <div class="cursor-pointer hidden" onclick="cancelEditKomponen()" id="cancel-editor">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>

                                <div id="save-editor" class="cursor-pointer hidden" onclick="saveEditKomponen()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </div>

                                <div onclick="editKomponen()" class="cursor-pointer" id="edit-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </div>

                            </div>
                            @endrole

                        </div>


                        <div class="komponen">

                            {{-- Template --}}
                            <div class="bg-slate-200 p-5 tracking-wide text-[12pt] hidden">Lorem ipsum dolor sit amet,
                                consectetur adipisicing elit.
                                Porro in fuga aut!
                                Voluptatum animi praesentium molestiae, facilis sunt nihil ea reprehenderit dolorem
                                alias, doloremque aspernatur enim veniam officiis omnis tenetur.</div>


                            <div class="py-6 hidden" id="content-editor">


                                <textarea id="article" cols="30" rows="10"></textarea>

                            </div>


                            {{--Komponen1 --}}
                            {{-- Tutorial 1 --}}
                            <div class="py-2 tracking-wide text-[12pt]" id="content">


                                {{-- Skeleton --}}
                                <div class="rounded-md p-4 w-full mx-auto">
                                    <div class="animate-pulse flex space-x-4">
                                        <div class="flex-1 space-y-6 py-1">
                                            <div class="grid grid-cols-3 gap-4">
                                                <div class="h-2 bg-slate-300 rounded col-span-2"></div>
                                                <div class="h-2 bg-slate-300 rounded col-span-1"></div>
                                            </div>
                                            <div class="h-2 bg-slate-300 rounded"></div>
                                        </div>
                                    </div>
                                    <div class="animate-pulse flex space-x-4 pt-4">
                                        <div class="flex-1 space-y-6">
                                            <div class="grid grid-cols-3 gap-4">
                                                <div class="h-2 bg-slate-300 rounded col-span-2"></div>
                                                <div class="h-2 bg-slate-300 rounded col-span-1"></div>
                                            </div>
                                            <div class="h-2 bg-slate-300 rounded"></div>
                                        </div>
                                    </div>
                                    <div class="animate-pulse flex space-x-4 pt-4">

                                        <div class="h-[15rem] w-[25rem] bg-slate-300"></div>


                                        <div class="flex-1 space-y-6">
                                            <div class="grid grid-cols-3 gap-4">
                                                <div class="h-2 bg-slate-300 rounded col-span-2"></div>
                                                <div class="h-2 bg-slate-300 rounded col-span-1"></div>
                                            </div>
                                            <div class="grid grid-cols-3 gap-4">
                                                <div class="h-2 bg-slate-300 rounded col-span-2"></div>
                                                <div class="h-2 bg-slate-300 rounded col-span-1"></div>
                                            </div>
                                            <div class="grid grid-cols-3 gap-4">
                                                <div class="h-2 bg-slate-300 rounded col-span-2"></div>
                                                <div class="h-2 bg-slate-300 rounded col-span-1"></div>
                                            </div>
                                            <div class="grid grid-cols-3 gap-4">
                                                <div class="h-2 bg-slate-300 rounded col-span-2"></div>
                                                <div class="h-2 bg-slate-300 rounded col-span-1"></div>
                                            </div>
                                            <div class="h-2 bg-slate-300 rounded"></div>
                                            <div class="h-2 bg-slate-300 rounded"></div>
                                            <div class="h-2 bg-slate-300 rounded"></div>
                                            <div class="h-2 bg-slate-300 rounded"></div>
                                            <div class="h-2 bg-slate-300 rounded"></div>
                                        </div>
                                    </div>
                                    <div class="animate-pulse flex space-x-4 pt-4">
                                        <div class="flex-1 space-y-6">
                                            <div class="grid grid-cols-3 gap-4">
                                                <div class="h-2 bg-slate-300 rounded col-span-2"></div>
                                                <div class="h-2 bg-slate-300 rounded col-span-1"></div>
                                            </div>
                                            <div class="h-2 bg-slate-300 rounded"></div>
                                        </div>
                                    </div>
                                    <div class="animate-pulse flex space-x-4 pt-4">
                                        <div class="flex-1 space-y-6">
                                            <div class="grid grid-cols-3 gap-4">
                                                <div class="h-2 bg-slate-300 rounded col-span-2"></div>
                                                <div class="h-2 bg-slate-300 rounded col-span-1"></div>
                                            </div>
                                            <div class="h-2 bg-slate-300 rounded"></div>
                                        </div>
                                    </div>


                                </div>



                            </div>

                        </div>


                    </div>

                    {{-- Pendahuluan --}}
                    <div class="hidden" id="">

                        {{-- komponen judul --}}
                        <p class="text-[15pt] font-bold">
                            Pendahuluan
                        </p>

                        {{-- Teks --}}
                        <p class="tracking-wide py-3 text-[12pt]">
                            PinToInvest adalah sistem pendukung pelayanan perizinan berusaha dan non
                            perizinan berusaha serta sistem yang mampu menyajikan Peta Perizinan dan Investasi
                            di wilayah Provinsi DKI Jakarta yang dikelola dan diselenggarakan oleh DPMPTSP
                            Provinsi DKI Jakarta.
                        </p>

                        {{-- Gambar --}}
                        <div class="flex py-3">
                            <div class="flex-none w-14 h-full"></div>
                            <div class="grow h-full">
                                <img class="object-fill h-[30rem] w-full"
                                    src="{{ asset('assets/panduan/jakpintas.png') }}" alt="">
                            </div>
                            <div class="flex-none w-14 h-full"></div>
                        </div>


                        {{-- Teks --}}
                        <p class="tracking-wide py-3 text-[12pt]">
                            Berdasarkan Peraturan Pemerintah Nomor 6 Tahun 2021 tentang Penyelenggaraan
                            Perizinan
                            Berusaha di Daerah, Pasal 10 ayat
                            4 bahwa Pemerintah Daerah dapat mengembangkan sistem pendukung pelaksanaan Sistem
                            OSS
                            sesuai dengan norma, standar,
                            prosedur, dan kriteria yang ditetapkan Pemerintah Pusat.
                        </p>

                        <p class="tracking-wide py-3 text-[12pt]">
                            Dengan semangat Undang-Undang Cipta Kerja, PinToInvest digunakan sebagai sarana
                            bagi SDM Pelayanan PTSP dalam
                            memberikan konsultasi dan pendampingan perizinan berusaha dan non perizinan berusaha
                            kepala para pelaku usaha, SDM
                            Pelayanan PTSP dapat mengakses PinToInvest melalui laman
                            <a href="https://jakarta.pintoinvest.com/" target="_blank">
                                <span class="text-blue-600">https://jakarta.pintoinvest.com/</span>
                            </a>
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous">
    </script>
    <script src="https://cdn.ckeditor.com/4.19.1/standard-all/ckeditor.js"></script>
    <script src="{{ asset('assets/js/bindWithDelay.js') }}"></script>
    <script src="/assets/js/panduan.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>

    <script>

    </script>

</body>

</html>