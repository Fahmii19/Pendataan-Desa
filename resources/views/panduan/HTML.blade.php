HTML
{{-- Daftar Panduan --}}
<div class="flex flex-col ml-1 h-[90vh] overflow-x-hidden scrollbar scrollbar-firefox">

    <ol class="relative">
        <li class="triger-judul-panduan" id="trigger_judul-141" onmouseover="boxKonten(141)">

            <div class="grid grid-cols-[auto_30px]">
                <span class="text-md list-group-item hover:text-indigo-600 cursor-pointer font-semibold"
                    onclick="chooseSubJudul(141)">
                    1 Pengenalan Jakpintas dan Fitur – Fitur di Dalamnya
                </span>

                <span class="triger-arrow-up">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                    </svg>
                </span>

                <span class="triger-arrow-down hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </span>

            </div>

            {{-- hideshow judul --}}
            <div id="trigger_action_sub-141"
                class="absolute -mt-[3vh] h-[3.2vh] w-[6vw] bg-gray-300 rounded-sm hideshow_btn_action right-0 mr-0.5">
                <div class="w-full grid grid-cols-2 place-items-center">

                    <div class="mt-[0.3vh] cursor-pointer" data-modal-toggle="modal-edit-menu"
                        onclick="editMenuPanduan(141)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10">
                            </path>
                        </svg>
                    </div>

                    <div class="mt-[0.3vh] cursor-pointer" onclick="deleteMenuPanduan(141)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

        </li>

        <div class="sub-showing-panduan hidden">
            <li class="triger-sub-panduan" id="trigger_judul-142" onmouseover="boxKonten(142)">

                <ol class="relative">
                    <li id="trigger_judul-142" onmouseover="boxKonten(142)"
                        class="flex justify-between subjudul_custom ml-4 active_menu text-indigo-600"
                        onclick="chooseSubJudul(142)">

                        <div class="w-full grid grid-cols-[auto_30px]">
                            <span class="text-md list-group-item hover:text-indigo-600 cursor-pointer font-medium">
                                1.1 Pendahuluan
                            </span>

                            <span class="subs-plus">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </span>

                            <span class="subs-minus hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                </svg>
                            </span>

                        </div>

                        <div id="trigger_action_sub-142"
                            class="h-[3.2vh] px-1 mr-0.5 bg-gray-300 rounded-sm absolute hideshow_btn_action hidden right-0"
                            style="display: none;">
                            <div class="w-full grid grid-cols-1 place-items-center">
                                <div class="w-full grid grid-cols-2 place-items-center">

                                    <div class="mt-[0.3vh] px-1 cursor-pointer" data-modal-toggle="modal-edit-menu"
                                        onclick="editMenuPanduan(142)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10">
                                            </path>
                                        </svg>
                                    </div>

                                    <div class="mt-[0.3vh] cursor-pointer" onclick="deleteMenuPanduan(142)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </li>

                </ol>

            </li>

            <li class="subs-showing-panduan hidden" id="trigger_judul-143" onmouseover="boxKonten(143)">

                <ol class="relative">
                    <li id="trigger_judul-143" onmouseover="boxKonten(143)"
                        class="flex justify-between subjudul_custom ml-4 " onclick="chooseSubJudul(143)">

                        <div>
                            <span class="text-md list-group-item hover:text-indigo-600 cursor-pointer font-medium">
                                1.2 Sistem Jakpintas
                            </span>
                        </div>

                        <div id="trigger_action_sub-143"
                            class="h-[3.2vh] px-1 mr-0.5 bg-gray-300 rounded-sm absolute hideshow_btn_action hidden right-0"
                            style="display: none;">
                            <div class="w-full grid grid-cols-1 place-items-center">
                                <div class="w-full grid grid-cols-2 place-items-center">

                                    <div class="mt-[0.3vh] px-1 cursor-pointer" data-modal-toggle="modal-edit-menu"
                                        onclick="editMenuPanduan(143)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10">
                                            </path>
                                        </svg>
                                    </div>

                                    <div class="mt-[0.3vh] cursor-pointer" onclick="deleteMenuPanduan(143)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </li>

                </ol>

            </li>

            {{-- new --}}

            <li class="subs-showing-panduan hidden" id="trigger_judul-143" onmouseover="boxKonten(143)">

                <ol class="relative">
                    <li id="trigger_judul-143" onmouseover="boxKonten(143)"
                        class="flex justify-between subjudul_custom ml-4 " onclick="chooseSubJudul(143)">

                        <div>
                            <span class="text-md list-group-item hover:text-indigo-600 cursor-pointer font-medium">
                                1.2 Sistem Jakpintas
                            </span>
                        </div>

                        <div id="trigger_action_sub-143"
                            class="h-[3.2vh] px-1 mr-0.5 bg-gray-300 rounded-sm absolute hideshow_btn_action hidden right-0"
                            style="display: none;">
                            <div class="w-full grid grid-cols-1 place-items-center">
                                <div class="w-full grid grid-cols-2 place-items-center">

                                    <div class="mt-[0.3vh] px-1 cursor-pointer" data-modal-toggle="modal-edit-menu"
                                        onclick="editMenuPanduan(143)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10">
                                            </path>
                                        </svg>
                                    </div>

                                    <div class="mt-[0.3vh] cursor-pointer" onclick="deleteMenuPanduan(143)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </li>

                </ol>

            </li>

        </div>

    </ol>


    {{-- <ol class="relative">
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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </div>

                    <div class="mt-[0.3vh] cursor-pointer" onclick="deleteMenuPanduan({{ $nj->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
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
                    class="flex justify-between subjudul_custom ml-4 {{ $nj->id == 142 ? " active_menu" : "" }}"
                    id="active_menu" onclick="chooseSubJudul({{ $nj->id }})">

                    <div>
                        <span class="text-md list-group-item hover:text-indigo-600 cursor-pointer font-medium">
                            {{ $nj->ordered }} {{ $nj->title }}
                        </span>
                    </div>

                    @role('admin')
                    <div id="trigger_action_sub-{{ $nj->id }}"
                        class="h-[3.2vh] px-1 mr-0.5 bg-gray-300 rounded-sm absolute hideshow_btn_action hidden right-0">
                        <div class="w-full grid grid-cols-1 place-items-center">
                            <div class="w-full grid grid-cols-2 place-items-center">

                                <div class="mt-[0.3vh] px-1 cursor-pointer" data-modal-toggle="modal-edit-menu"
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

                </li>

                @endif
            </ol>

        </li>
        @endforeach
    </ol> --}}


</div>

FUNGSI
// toggle hide show judul panduan

const toggleJudul = () => {
$(".triger-judul-panduan").on("click", function () {
$(this)
.toggleClass("block")
.next(".sub-showing-panduan")
.stop()
.slideToggle(500);

$(this).find(".triger-arrow-up").toggleClass("hidden");
$(this).find(".triger-arrow-down").toggleClass("hidden");
});
};
toggleJudul();

const subJudul = () => {
$(".triger-sub-panduan").on("click", function () {
$(this)
.toggleClass("block")
.next(".subs-showing-panduan")
.stop()
.slideToggle(500);

$(this).find(".subs-plus").toggleClass("hidden");
$(this).find(".subs-minus").toggleClass("hidden");
});
};
subJudul();