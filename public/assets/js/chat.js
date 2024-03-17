// let socket = io("wss://jakarta.pintoinvest.com:3500", {
//     transports: ["websocket"],
// });

// Javascript
let socket = io("wss://jakarta.pintoinvest.com:1323", {
    transports: ["websocket"],
});

// //Check Connection
socket.on("connect", function () {
    console.log("connected");
});

// Global Variable
let tmp_data_chat = {};
let tmp_data_server;
let tmp_file;
// let tmp_upload_file_thread;

console.log(tmp_file);

// Javascript

//Badge Admin
let badge_admin =
    '<div class="w-[3.5rem] h-[1.1rem] flex items-center bg-blue-600 text-white text-[7pt] ml-2 font-semibold rounded-[4px] px-0 mr-1" style="position:relative; top: -0.1rem;"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.5" stroke="currentColor" class="w-4 h-3 text-white ml-[0.1rem]"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>ADMIN</div>';

//Badge Moderator
let badge_moderator =
    '<div class="w-max h-[1.2rem] flex items-center bg-blue-600 text-white text-[7pt] ml-2 font-semibold rounded-[4px] px-2" style="position:relative; top: -0.1rem;"><img class="w-3 h-3 mr-2" src="/assets/gambar/chating/crown.png"alt="">ADMIN</div>';

let status_penting =
    '<div class="cursor-pointer -ml-1"><input type="checkbox" class="pilih_status hidden" name="get_stat[]" value="Penting" id="status_penting"><label for="status_penting"><span class="bg-gray-200 max-w-[9rem] text-gray-800 tracking-wide text-xs font-medium inline-flex items-center px-3 py-[0.25rem] rounded-[20px] mr-2 aktif_class_status"><span class="font-bold opacity-[0.8]">Penting</span></span></label></div>';

let status_tl =
    '<div class="cursor-pointer -ml-1"><input type="checkbox" class="pilih_status hidden" name="get_stat[]" value="TL" id="status_tl"><label for="status_tl"><span class="bg-gray-200 max-w-[11vw] text-gray-800 tracking-wide text-xs font-medium inline-flex items-center px-2 py-1 rounded-[20px] mr-2 aktif_class_status"><span class="font-bold opacity-[0.8]">TL</span></span></label></div>';

let icon_created_post_png = `<div class="-ml-2 pb-1.5 -mt-1.5"><img class="max-w-[8vw] max-h-[8vh]" src=" /assets/pngnew.png" alt=""></div>`;
let icon_created_post_jpg = `<div class="-ml-2 pb-1.5 -mt-1.5"><img class="max-w-[8vw] max-h-[8vh]" src=" /assets/jpgnew.png" alt=""></div>`;
let icon_created_post_pdf = `<div class="-ml-2 pb-1.5 -mt-1.5"><img class="max-w-[8vw] max-h-[8vh]" src=" /assets/pdfnew.png" alt=""></div>`;
let icon_created_post_doc = `<div class="-ml-2 pb-1.5 -mt-1.5"><img class="max-w-[8vw] max-h-[8vh]" src=" /assets/docnew.png" alt=""></div>`;

// button upload file
$(function () {
    $("#link_upload").on("click", function (e) {
        e.preventDefault();
        $("#upload_file:hidden").trigger("click");
    });
});

// link upload file post
$(function () {
    $("#link_upload_post").on("click", function (e) {
        e.preventDefault();
        $("#upload_file_post:hidden").trigger("click");
    });
});

// post thread
$(function () {
    $("#create_send_post").on("click", function (e) {
        e.preventDefault();
        $("#send_post:hidden").trigger("click");
        // uncheck all status or checkbox
        $("input[name='get_stat[]']").prop("checked", false);
        // $("input[name='get_stat[]']").val("");
        // remove class bg-gray-300 from all status
        $(".aktif_class_status").removeClass("bg-gray-300");
        checkInputs();
        // tmp_file = [];
        $("#upload_btn_create_post_thread").val("");
        // tmp_file = "";
    });
});

//Get All Sector
const GetAllSector = () => {
    let list_data = [];
    data_server.forEach(({ kategori }) => {
        kategori.forEach(({ chanel }) => {
            chanel.forEach(({ id }) => {
                list_data.push(btoa(id));
            });
        });
    });

    return list_data.sort().toString();
};

//Get All Channel
const GetChanelName = (id) => {
    let chanel_name = "";
    data_server.forEach(({ kategori }) => {
        kategori.forEach(({ chanel }) => {
            chanel.forEach((v) => {
                if (btoa(v.id) == id) {
                    chanel_name = v.name;
                }
            });
        });
    });

    return chanel_name;
};

//Tabs Server
const tabsServer = (id, inisial, name, event) => {
    // console.log(id, inisial, name);
    let list_server = ["PU", "D"];

    // $("#tabs_id_server").text(inisial);
    // console.log(inisial"-Tabs");
    //  $(`#${inisial}-tabs`).html("");
    // $("#id_tabs_channel").attr("id", inisial + `-tabs`);
    btn_dev = document.getElementById("call_dev");
    btn_pengumuman = document.getElementById("call_pengumuman");

    btn_dev.addEventListener("click", () => {
        if (inisial == "D") {
            $("#PU-tabs").attr("id", `D-tabs`);
            $("#D-tabs").css("display", "block");
            $("#PU-tabs").css("display", "none");

            setTimeout(() => {
                $(".bg_sektor_aktif #18 #aktif_menu_channel").click();
            }, 1000);
        }
    });

    btn_pengumuman.addEventListener("click", () => {
        if (inisial == "PU") {
            $("#D-tabs").attr("id", `PU-tabs`);
            $("#PU-tabs").css("display", "block");
            $("#D-tabs").css("display", "none");

            setTimeout(() => {
                $(".bg_sektor_aktif #1 #aktif_menu_channel").click();
            }, 1000);
        }
    });

    // Param 1 = 2 (as a ID Server)
    socket.emit("select_server", id, (e) => {
        // console.log(e);
        let html = ``;
        tmp_data_server = e;

        e.forEach((data) => {
            const { label, chanel } = data;

            html += `
            <div class="tabs mb-2">
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
                            class="judul_sektor_group_channel judul_sektor_group_channel_chating change_color_chanel">${label}</span>

                    </div>


                    <div class="tab-content">
                        <div class="mt-[1%] mb-[1.8%]">

                            <ul class="bg_sektor_aktif">
            `;

            $("#name_channel").append(html);

            // console.log(label);

            // TODO : Add Parrent Channel With Name Label
            chanel.forEach((item) => {
                const { id, name, id_server, types, list_admin } = item;
                // console.log(id, name, id_server, types, list_admin);
                // TODO : Add Child Channel With Name
                // console.log(id, name, id_server, types, list_admin);

                let icon_server;
                // if (name == "Pengumuman") {
                //     icon_server = "/assets/gambar/chating/speaker.png";
                // } else if (name == "Development") {
                //     icon_server = "/assets/gambar/chating/speaker.png";
                // } else {
                //     icon_server = "/assets/gambar/chating/chating.png";
                // }

                if (types == "kanal") {
                    if (name == "Pengumuman" || name == "Development") {
                        icon_server = "/assets/gambar/chating/speaker.png";
                    } else if (name == "Diskusi Umum") {
                        icon_server = "/assets/gambar/chating/chating.png";
                    }
                } else if (types == "forum") {
                    icon_server = "/assets/gambar/chating/chating.png";
                } else {
                    icon_server = "";
                }

                html += `
                <li class="" id="${id}">
                <div id="aktif_menu_channel"
                    class="box_tab_content_group_channel channel-${id} hover:bg-gray-300 px-[1.3rem]"
                    onclick="select_sector('${name}',${id},'${types}', '${btoa(
                    list_admin
                )}')">


                    <div class="h-7 grid place-items-center">
                        <img class="w-4 h-4" src="${icon_server}"
                            alt="">
                    </div>


                    <div
                        class="text_container_tab_content_group_channel text_container_tab_content_group_channel_chating">
                        <div class="grid_container_tab_content_group_channel">
                            <div class="col-span-3 pl-1 text-black">

                                <div class="inline-flex">
                                    ${name} &nbsp;
                                </div>


                            </div>
                            <div
                                class="badge_container_tab_content_group_channel absolute right-2 hidden unread-message">
                                0</div>
                        </div>

                    </div>
                </div>

            </li>
                `;
            });

            html += `
            </ul>

            </div>
        </div>

    </div>
</div>
</div>
            `;
        });
        //Set List Server

        $(`#${inisial}-tabs`).html("");
        $(`#${inisial}-tabs`).html(html);
    });

    //Set Name Server
    $("#name-server").text(name);

    // Aktif Channel Server
    list_server.forEach((label) => {
        if (inisial == label) {
            $(`.server-${label}`).addClass("rounded-[35%]");
        } else {
            $(`.server-${label}`).removeClass("rounded-[35%]");
        }
    });

    //Set Active Server
    list_server.forEach((label) => {
        if (inisial == label) {
            $(`#${label}-tabs`).show();
            $(`#${label}-border`).css("display", "block");
        } else {
            $(`#${label}-tabs`).hide();
            $(`#${label}-border`).css("display", "none");
        }
    });
};

//Auto Scrolling
const autoScroll = () => {
    let scroll_to_bottom = document.getElementById("list-message");
    scroll_to_bottom.scrollTop = scroll_to_bottom.scrollHeight;
};

// find detail post
const autoScrollPost = () => {
    let scroll_to_bottom = document.getElementById("auto-scroll-bottom");
    scroll_to_bottom.scrollTop = scroll_to_bottom.scrollHeight;
};

// scroll bar auto bottom
window.onload = (event) => {
    // console.log(user_id);
    // Param 1 = 1 (as a ID Channel)
    // Param 2 = 11 (as a ID Post)
    // socket.emit("pop_post", 3, 99, (e) => {
    //     console.log(e);
    // });

    localStorage.setItem("room", "MQ==");
    localStorage.removeItem("id_reply");
    localStorage.removeItem("channel");
    // tabsServer(3, "D", "Development");
    // setTimeout(() => {
    //     $(".bg_sektor_aktif #18 #aktif_menu_channel").click();
    // }, 1000);

    // $("#id_tabs_channel").attr("id", `PU` + `-tabs`);

    tabsServer(1, "PU", "Perizinan Usaha");
    setTimeout(() => {
        $(".bg_sektor_aktif #1 #aktif_menu_channel").click();
    }, 1000);

    $(`.container_diskusi_umum`).find(".forum_thread").removeClass("block");
    $(`.container_diskusi_umum`).find(".forum_thread").addClass("hidden");

    // select_sector("MQ==", "Pengumuman", 1, "kanal");
    // select_sector("Mw==", "Kelautan dan perikanan", 3, "forum");
    // select_sector("Pengumuman", 1, "kanal", "MjQ5OSwyNTY1LDI1NDY=");

    $(".show_list_post").removeClass("col-span-2");
    $(".show_list_post").addClass("col-span-1");
    $(".show_list_post_span").removeClass("col-span-2");
    $(".show_list_post_span").addClass("col-span-2");

    starMessage();
    // limitKontenPost();
    autoScroll();
    autoScrollPost();
    hide_show_thread();

    // Panggil Fungsi Limit Teks
    limitTeksPriotitas();
    limitTeksKonsultasi();

    viewMobile();

    // Panggil Fungsi Button Prioritas
    // btn_Prioritas();
};

// Search Message pada Chat
$("body").on("click", "div[data-toggle]", (e) => {
    $(".hideshow_search_message").css("display", "none");

    e.preventDefault();

    let selector = $(e.target).data("toggle");
    $(".box_konten_hide").hide();
    $(selector).show();
});

// Toggle Button HideShow Prioritas
$(".toggle_msg_prioritas").click((e) => {
    $(e.target)
        .parent()
        .parent()
        .parent()
        .parent()
        .parent()
        .find("#hideshow_msg_prioritas")
        .css("display", "block");

    $("#hideshow_msg_prioritas").toggle();
});

//Search Message
$("#searchMessage").bindWithDelay(
    "keyup",
    function () {
        let search = $(this).val();
        let html = "";
        if (search.length > 0) {
            //Show and Hide Element
            $(".hideshow_search_message").css("display", "block");
            $("#hideshow_msg_prioritas").css("display", "none");

            //Filter Channel Name
            let channel_name = GetChanelName(localStorage.getItem("room"));

            socket.emit("searchMessage", search, (data) => {
                if (data !== null) {
                    let result = data.reduce((r, a) => {
                        r[a.room] = [...(r[a.room] || []), a];
                        return r;
                    }, []);
                    for (let key in result) {
                        // console.log(result);
                        html += `<div class="flex  cursor-pointer rounded-md px-2 mr-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 1w-4 text-gray-400 mt-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9.243 3.03a1 1 0 01.727 1.213L9.53 6h2.94l.56-2.243a1 1 0 111.94.486L14.53 6H17a1 1 0 110 2h-2.97l-1 4H15a1 1 0 110 2h-2.47l-.56 2.242a1 1 0 11-1.94-.485L10.47 14H7.53l-.56 2.242a1 1 0 11-1.94-.485L5.47 14H3a1 1 0 110-2h2.97l1-4H5a1 1 0 110-2h2.47l.56-2.243a1 1 0 011.213-.727zM9.03 8l-1 4h2.938l1-4H9.031z" clip-rule="evenodd" />
                                        </svg>
                                        <div
                                            class="text-base tracking-wide text-gray-500 py-1 -mt-1 ml-2 w-11/12">
                                                ${channel_name}
                                        </div>
                                    </div>
                    `;
                        result[key].forEach((el) => {
                            html += `<div class="py-1 mr-5">
                                        <div class="p-2 text-sm text-gray-700 bg-gray-100 rounded-lg ">
                                            <div class="flex flex-row ">
                                                <div class="flex  w-12/12 text-gray-700 bg-gray-100  rounded-lg ">
                                                    <img class="w-8 h-8 rounded-full" src="/assets/gambar/people.png" alt="">
                                                    <div class="px-4">
                                                        <div class="text-sm mb-1">
                                                            ${
                                                                el.username
                                                            } <span class="px-1 text-xs text-slate-500">${date(
                                el.date
                            )}</span>
                                                        </div>
                                                        <div class="text-xs text-gray-400">
                                                            ${el.message}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>`;
                        });
                    }
                }
                $("#search-message").html("");
                $("#search-message").html(html);
            });
        } else {
            $("#search-message").html("");
            $("#show-btn-hapus-pencarian").css("display", "none");
            $(".hideshow_search_message").css("display", "none");
            $("#hideshow_msg_prioritas").css("display", "block");
        }
    },
    1000
);

const removeSearch = () => {
    $("#searchMessage").val("");
    $("#search-message").html("");
    $("#show-btn-hapus-pencarian").css("display", "none");
    $(".hideshow_search_message").css("display", "none");
    $("#hideshow_msg_prioritas").css("display", "block");
};

// hide show icon pencarian
$("body").on("focus", ".btn-hapus-pencarian", () => {
    $("#show-btn-hapus-pencarian").css("display", "block");
});

//Time Function
const date = (val) => {
    let date = new Date(val.slice(0, -1));
    let tahun = date.getFullYear();
    let bulan = date.getMonth();
    let tanggal = date.getDate();
    switch (bulan) {
        case 0:
            bulan = "Januari";
            break;
        case 1:
            bulan = "Februari";
            break;
        case 2:
            bulan = "Maret";
            break;
        case 3:
            bulan = "April";
            break;
        case 4:
            bulan = "Mei";
            break;
        case 5:
            bulan = "Juni";
            break;
        case 6:
            bulan = "Juli";
            break;
        case 7:
            bulan = "Agustus";
            break;
        case 8:
            bulan = "September";
            break;
        case 9:
            bulan = "Oktober";
            break;
        case 10:
            bulan = "November";
            break;
        case 11:
            bulan = "Desember";
            break;
    }
    let tampilTanggal = tanggal + " " + bulan + " " + tahun;

    return tampilTanggal;
};

const time = (val = "") => {
    let time;
    if (val == "") {
        time = new Date();
    } else {
        time = new Date(val.slice(0, -1));
    }
    let jam = time.getHours();
    let menit = time.getMinutes();

    let tamp =
        String(jam).padStart(2, "0") + ":" + String(menit).padStart(2, "0");
    return tamp;
};

//Create Tooltip
const createTooltip = (target, trigger, id_element) => {
    const options = {
        triggerType: "hover",
        onHide: () => {
            // console.log("tooltip is shown");
        },
        onShow: () => {
            // console.log("tooltip is hidden");
        },
    };
    new Tooltip(target, trigger, options);

    //Show On Hover
    $(`#message-${id_element}`).on("mouseenter", function () {
        $(this).find(".btn_reply").css("display", "block");
    });

    $(`#message-${id_element}`).on("mouseleave", function () {
        $(this).find(".btn_reply").css("display", "none");
    });
};

const replyMessage = (id) => {
    localStorage.setItem("id_reply", id);
    $("#reply-content").show();
};

// Add Indicator Active or Selected Channel (Sector)
const active_channel = (id) => {
    // data_server.forEach(({ kategori }) => {
    //     kategori.forEach(({ chanel }) => {
    //         chanel.forEach((list) => {
    //             if (list.id == id) {
    //                 $(`.channel-${id}`).addClass("bg-gray-300");
    //             } else {
    //                 $(`.channel-${list.id}`).removeClass("bg-gray-300");
    //             }
    //         });
    //     });
    // });

    // console.log(tmp_data_server);

    tmp_data_server.forEach(({ chanel }) => {
        chanel.forEach((list) => {
            if (list.id == id) {
                $(`.channel-${id}`).addClass("bg-gray-300");
            } else {
                $(`.channel-${list.id}`).removeClass("bg-gray-300");
            }
        });
    });
};

// Set Active Kanal or Forum
const active_kanal_forum = () => {
    $(`.container_diskusi_umum`).find(".kanal_diskusi_umum").addClass("block");

    $(`.container_diskusi_umum`)
        .find(".kanal_diskusi_umum")
        .removeClass("block");
};

//Select Sector
const select_sector = (name, id_channel, tipe, list_admin) => {
    // console.log(name, id_channel, tipe, list_admin);
    $(".add_border").removeClass("border-b-2 border-gray-200");
    $(".thread_right").addClass("hidden");
    $(".forum_thread ").removeClass("grid-cols-2");
    $(".forum_thread ").addClass("grid-cols-1");

    // click channel
    $(".show_list_post").removeClass("grid-cols-2");
    $(".show_list_post").addClass("grid-cols-11");

    $(".show_list_post_child_one").removeClass("col-span-2");
    $(".show_list_post_child_one").addClass("col-span-1");

    $(".show_list_post_child_one").removeClass("col-span-1");
    $(".show_list_post_child_one").addClass("col-span-2");

    $(".show_list_post_child_two").removeClass("col-span-1");
    $(".show_list_post_child_two").addClass("col-span-9");

    $(".custom_tl_ml").removeClass("-ml-[1.7vw]");

    $(".thread_left").removeClass("hidden");

    // uncheck all status or checkbox
    $("input[name='get_stat[]']").prop("checked", false);
    // remove class bg-gray-300 from all status
    $(".aktif_class_status").removeClass("bg-gray-300");

    // remove values judul post
    $("#title_post_created").val("");
    $("#konten_post_created").val("");

    //Active Sector or Channellist-message
    active_channel(id_channel);

    $("#room-sector").text(name);

    //Open Chat on Mobile
    if (window.innerWidth <= 799) {
        openChat();
        if ($(".container_group").find(".open_chating")) {
            console.log("chat dibuka");
        } else if ($(".tab_menu_mobile").find(".close_chating")) {
            console.log("menu ditutup");
            Menu();
        }

        console.log("open chat");
    }

    //Check Admin or Not
    let is_admin = atob(list_admin).includes(user_id);
    // localStorage.setItem("room", sector);
    localStorage.setItem("channel", id_channel);

    // Active Kanal dan Forum
    active_kanal_forum();

    // Untuk Menampilkan Kanal
    if (tipe == "kanal") {
        // let id_room = atob(sector);
        // console.log(id_room);
        // $(`#${id_room}`).find(".unread-message").addClass("hidden").text(0);

        socket.emit("show_chat", id_channel, (e) => {
            // console.log(e);
            if (name == "Pengumuman") {
                // for (let i = 0; i < e.length; i++) {
                if (is_admin) {
                    $(".inputan_forum").removeClass("hidden");
                } else {
                    $(".inputan_forum").addClass("hidden");
                }
                // }
                // if (!sektor_user.includes(sector)) {
                //     $(".hide_form").addClass("hidden");
                //     $(".scroling_diskusi_umum").removeClass("h-[82vh]");
                //     $(".scroling_diskusi_umum").addClass("h-[41rem]");
                // } else {
                //     $(".hide_form").removeClass("hidden");
                //     $(".scroling_diskusi_umum").addClass("h-[82vh]");
                //     $(".scroling_diskusi_umum").removeClass("h-[41rem]");
                // }
            } else {
                $(".hide_form").removeClass("hidden");
                $(".scroling_diskusi_umum").addClass("h-[82vh]");
                $(".scroling_diskusi_umum").removeClass("h-[41rem]");
                $(".inputan_forum").removeClass("hidden");
            }

            // console.log(e);
            let html = "";

            // reset data tmp_data_chat
            tmp_data_chat = {};

            if (e !== null) {
                let result = e.reduce((r, a) => {
                    r[date(a.created_at)] = [
                        ...(r[date(a.created_at)] || []),
                        a,
                    ];
                    return r;
                }, {});

                // console.log(result);

                // Assing New Value Data Chat
                tmp_data_chat = result;
                // console.log(tmp_data_chat);

                // console.log(result);

                for (let key in result) {
                    if (key.length > 0) {
                        html += `
                            <div class="w-full px-[1.7%]">

                                <div class="flex items-center">
                                    <div class="flex-grow h-[0.08rem] bg-gray-400"></div>

                                        <span class="flex-shrink text-sm text-gray-500 px-4">${key}</span>

                                    <div class="flex-grow h-[0.08rem] bg-gray-400"></div>
                                </div>
                            </div>
                            `;

                        result[key].forEach((dt) => {
                            if (dt.id_user == user_id) {
                                is_admin = badge_admin;
                            } else {
                                is_admin = "";
                            }

                            // if (dt.id_user == user_id) {
                            if (dt.message != "") {
                                if (dt.message != "file") {
                                    html += `
                                            <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg" id="message-${
                                                dt.id
                                            }">

                                            <div class="flex justify-start w-full cursor-pointer">

                                                <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">

                                                    <div class="flex flex-row px-3 py-2">

                                                        <div class="w-[3.1rem] h-10 grid items-center">
                                                            <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                                        </div>

                                                        <div class="flex flex-col w-full">
                                                            <div class="container_replay_box">

                                                                <div class="replay_box">
                                                                    <div class="flex flex-rows items-center">

                                                                        <div class="maks_username">
                                                                            <p class="truncate">
                                                                                ${
                                                                                    dt.username
                                                                                }
                                                                            </p>
                                                                        </div>

                                                                        <div class="ml-1 text-[11px] text-gray-500">
                                                                                ${time(
                                                                                    dt.created_at
                                                                                )} Wib
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="container_btn_replay">

                                                                    <div class="position_container_btn" style="display: none;">

                                                                        <div class="container_btn">

                                                                            <div class="btn_reply group"
                                                                                data-tooltip-target="balas-postingan" div="replyMessage(${
                                                                                    dt.id
                                                                                })">
                                                                                <i style="font-size: 18px;"
                                                                                    class="fa fa-reply mx-2 w-4 h-4 text-gray-700 group-hover:text-black"
                                                                                    aria-hidden="true">
                                                                                </i>

                                                                                <div id="balas-postingan" role="tooltip"
                                                                                    class="inline-block absolute z-10 py-1 px-2 text-[12px] font-medium text-gray-900
                                                                                    bg-white rounded-lg border border-gray-200 shadow-sm tooltip opacity-0 invisible"
                                                                                    style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform:      translate3d(453.6px, -200px, 0px);"
                                                                                    data-popper-placement="top">
                                                                                    Balas
                                                                                    <div class="tooltip-arrow" data-popper-arrow=""
                                                                                        style="position: absolute; left: 0px; transform: translate3d(20px, 0px, 0px);">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div
                                                                class="w-full text-sm text-gray-500 font-normal tracking-wide break-words scrollbar max-w-[60rem]">
                                                                <p>${
                                                                    dt.message
                                                                }</p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>`;
                                }
                                if (dt.attachment != null) {
                                    for (
                                        let i = 0;
                                        i < dt.attachment.length;
                                        i++
                                    ) {
                                        if (
                                            dt.attachment[i].type == "image/png"
                                        ) {
                                            html += `
                                            <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg">
                                            <div class="flex justify-start w-full cursor-pointer">
                                                <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                                    <div class="flex flex-row px-3 py-2">
                                                        <div class="w-[3.1rem] h-10 grid items-center">
                                                            <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                                        </div>
                                                        <div class="flex flex-col w-full">
                                                            <div class="container_replay_box">
                                                                <div class="replay_box">
                                                                    <div class="flex flex-rows items-center">
                                                                        <div class="maks_username">
                                                                            <p class="truncate">
                                                                                ${
                                                                                    dt.username
                                                                                }
                                                                            </p>
                                                                        </div>
                                                                        <div class="ml-1 text-[11px] text-gray-500">
                                                                                ${time(
                                                                                    dt.created_at
                                                                                )} Wib
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="w-[12vw] h-[4rem] my-1 " onclick="previewFile('${
                                                                dt.attachment[i]
                                                                    .name
                                                            }')">
                                                                <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                                    <div class="basis-2/12">
                                                                        <div class="h-full grid place-content-center">
                                                                            <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                                src=" /assets/pngnew.png" alt="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="basis-10/12">
                                                                        <div class="h-full grid content-center">
                                                                            <div
                                                                                class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                                <p class="truncate">
                                                                                    ${
                                                                                        dt
                                                                                            .attachment[
                                                                                            i
                                                                                        ]
                                                                                            .name
                                                                                    }
                                                                                </p>
                                                                                <span class="text-gray-500 text-xs">

                                                                                        ${formatBytes(
                                                                                            dt
                                                                                                .attachment[
                                                                                                i
                                                                                            ]
                                                                                                .size
                                                                                        )}

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
                                                </div>`;
                                        } else if (
                                            dt.attachment[i].type == "image/jpg"
                                        ) {
                                            html += `
                                                    <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg">
                                                    <div class="flex justify-start w-full cursor-pointer">
                                                        <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                                            <div class="flex flex-row px-3 py-2">
                                                                <div class="w-[3.1rem] h-10 grid items-center">
                                                                    <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                                                </div>
                                                                <div class="flex flex-col w-full">
                                                                    <div class="container_replay_box">
                                                                        <div class="replay_box">
                                                                            <div class="flex flex-rows items-center">
                                                                                <div class="maks_username">
                                                                                    <p class="truncate">
                                                                                        ${
                                                                                            dt.username
                                                                                        }
                                                                                    </p>
                                                                                </div>
                                                                                <div class="ml-1 text-[11px] text-gray-500">
                                                                                        ${time(
                                                                                            dt.created_at
                                                                                        )} Wib
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="w-[12vw] h-[4rem] my-1" onclick="previewFile('${
                                                                        dt
                                                                            .attachment[
                                                                            i
                                                                        ].name
                                                                    }')">
                                                                        <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                                            <div class="basis-2/12">
                                                                                <div class="h-full grid place-content-center">
                                                                                    <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                                        src="/assets/jpgnew.png" alt="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="basis-10/12">
                                                                                <div class="h-full grid content-center">
                                                                                    <div
                                                                                        class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                                        <p class="truncate">
                                                                                            ${
                                                                                                dt
                                                                                                    .attachment[
                                                                                                    i
                                                                                                ]
                                                                                                    .name
                                                                                            }
                                                                                        </p>
                                                                                        <span class="text-gray-500 text-xs">

                                                                                                ${formatBytes(
                                                                                                    dt
                                                                                                        .attachment[
                                                                                                        i
                                                                                                    ]
                                                                                                        .size
                                                                                                )}

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
                                                </div>`;
                                        } else if (
                                            dt.attachment[i].type ==
                                            "image/jpeg"
                                        ) {
                                            html += `
                                                    <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg">
                                                    <div class="flex justify-start w-full cursor-pointer">
                                                        <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                                            <div class="flex flex-row px-3 py-2">
                                                                <div class="w-[3.1rem] h-10 grid items-center">
                                                                    <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                                                </div>
                                                                <div class="flex flex-col w-full">
                                                                    <div class="container_replay_box">
                                                                        <div class="replay_box">
                                                                            <div class="flex flex-rows items-center">
                                                                                <div class="maks_username">
                                                                                    <p class="truncate">
                                                                                        ${
                                                                                            dt.username
                                                                                        }
                                                                                    </p>
                                                                                </div>
                                                                                <div class="ml-1 text-[11px] text-gray-500">
                                                                                        ${time(
                                                                                            dt.created_at
                                                                                        )} Wib
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="w-[12vw] h-[4rem] my-1 " onclick="previewFile('${
                                                                        dt
                                                                            .attachment[
                                                                            i
                                                                        ].name
                                                                    }')">
                                                                        <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                                            <div class="basis-2/12">
                                                                                <div class="h-full grid place-content-center">
                                                                                    <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                                        src="/assets/jpgnew.png" alt="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="basis-10/12">
                                                                                <div class="h-full grid content-center">
                                                                                    <div
                                                                                        class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                                        <p class="truncate">
                                                                                            ${
                                                                                                dt
                                                                                                    .attachment[
                                                                                                    i
                                                                                                ]
                                                                                                    .name
                                                                                            }
                                                                                        </p>
                                                                                        <span class="text-gray-500 text-xs">

                                                                                                ${formatBytes(
                                                                                                    dt
                                                                                                        .attachment[
                                                                                                        i
                                                                                                    ]
                                                                                                        .size
                                                                                                )}

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
                                                </div>`;
                                        } else if (
                                            dt.attachment[i].type ==
                                            "application/pdf"
                                        ) {
                                            html += `
                                                    <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg">
                                                    <div class="flex justify-start w-full cursor-pointer">
                                                        <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                                            <div class="flex flex-row px-3 py-2">
                                                                <div class="w-[3.1rem] h-10 grid items-center">
                                                                    <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                                                </div>
                                                                <div class="flex flex-col w-full">
                                                                    <div class="container_replay_box">
                                                                        <div class="replay_box">
                                                                            <div class="flex flex-rows items-center">
                                                                                <div class="maks_username">
                                                                                    <p class="truncate">
                                                                                        ${
                                                                                            dt.username
                                                                                        }
                                                                                    </p>
                                                                                </div>
                                                                                <div class="ml-1 text-[11px] text-gray-500">
                                                                                        ${time(
                                                                                            dt.created_at
                                                                                        )} Wib
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="w-[12vw] h-[4rem] my-1 " onclick="previewFile('${
                                                                        dt
                                                                            .attachment[
                                                                            i
                                                                        ].name
                                                                    }')">
                                                                        <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                                            <div class="basis-2/12">
                                                                                <div class="h-full grid place-content-center">
                                                                                    <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                                        src="/assets/pdfnew.png" alt="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="basis-10/12">
                                                                                <div class="h-full grid content-center">
                                                                                    <div
                                                                                        class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                                        <p class="truncate">
                                                                                            ${
                                                                                                dt
                                                                                                    .attachment[
                                                                                                    i
                                                                                                ]
                                                                                                    .name
                                                                                            }
                                                                                        </p>
                                                                                        <span class="text-gray-500 text-xs">

                                                                                                ${formatBytes(
                                                                                                    dt
                                                                                                        .attachment[
                                                                                                        i
                                                                                                    ]
                                                                                                        .size
                                                                                                )}

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
                                                </div>`;
                                        } else if (
                                            dt.attachment[i].type ==
                                            "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                        ) {
                                            html += `
                                                    <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg">
                                                    <div class="flex justify-start w-full cursor-pointer">
                                                        <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                                            <div class="flex flex-row px-3 py-2">
                                                                <div class="w-[3.1rem] h-10 grid items-center">
                                                                    <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                                                </div>
                                                                <div class="flex flex-col w-full">
                                                                    <div class="container_replay_box">
                                                                        <div class="replay_box">
                                                                            <div class="flex flex-rows items-center">
                                                                                <div class="maks_username">
                                                                                    <p class="truncate">
                                                                                        ${
                                                                                            dt.username
                                                                                        }
                                                                                    </p>
                                                                                </div>
                                                                                <div class="ml-1 text-[11px] text-gray-500">
                                                                                        ${time(
                                                                                            dt.created_at
                                                                                        )} Wib
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="w-[12vw] h-[4rem] my-1 " onclick="previewFile('${
                                                                        dt
                                                                            .attachment[
                                                                            i
                                                                        ].name
                                                                    }')">
                                                                        <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                                            <div class="basis-2/12">
                                                                                <div class="h-full grid place-content-center">
                                                                                    <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                                        src="/assets/docnew.png" alt="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="basis-10/12">
                                                                                <div class="h-full grid content-center">
                                                                                    <div
                                                                                        class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                                        <p class="truncate">
                                                                                            ${
                                                                                                dt
                                                                                                    .attachment[
                                                                                                    i
                                                                                                ]
                                                                                                    .name
                                                                                            }
                                                                                        </p>
                                                                                        <span class="text-gray-500 text-xs">

                                                                                                ${formatBytes(
                                                                                                    dt
                                                                                                        .attachment[
                                                                                                        i
                                                                                                    ]
                                                                                                        .size
                                                                                                )}

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
                                                </div>`;
                                        }
                                    }
                                }
                            }
                            // }
                        });
                    }
                }
            }

            // console.log(e);

            $("#list-message").html("");
            $("#list-message").html(html);

            autoScroll();
            socket.emit("read_chat", user_id, id_channel);
        });

        $(`.container_diskusi_umum`)
            .find(".kanal_diskusi_umum")
            .removeClass("hidden");
        $(`.container_diskusi_umum`).find(".forum_thread").addClass("hidden");
        $(`.container_diskusi_umum`)
            .find(".kanal_diskusi_umum")
            .addClass("block");
    }

    // Untuk Menampilkan Forum
    else if (tipe == "forum") {
        $(`.container_diskusi_umum`)
            .find(".forum_thread")
            .removeClass("hidden");
        $(`.container_diskusi_umum`)
            .find(".kanal_diskusi_umum")
            .addClass("hidden");
        $(`.container_diskusi_umum`).find(".hide_form").addClass("hidden");
        $(`.container_diskusi_umum`).find(".forum_thread").addClass("block");

        $("#judul-postingan-thread").html("");
        $("#pesan-postingan-thread").html("");

        showListPost(id_channel);
    }
};

// For Show List Post
const showListPost = (id_channel) => {
    socket.emit("show_post", id_channel, (result) => {
        // console.log(e);

        let html = "";

        if (result !== null) {
            if (result.length > 0) {
                result.forEach((dt) => {
                    let status;
                    if (
                        dt.status.includes("Penting") &&
                        dt.status.includes("TL")
                    ) {
                        status = status_penting + status_tl;
                    } else if (dt.status.includes("Penting")) {
                        status = status_penting;
                    } else if (dt.status.includes("TL")) {
                        status = status_tl;
                    } else {
                        status = "";
                    }

                    if (dt.attachment !== null) {
                        for (let i = 0; i < dt.attachment.length; i++) {
                            let icon_attchment = "";
                            if (dt.attachment[i].type == "image/png") {
                                icon_attchment = icon_created_post_png;
                            } else if (dt.attachment[i].type == "image/jpeg") {
                                icon_attchment = icon_created_post_jpg;
                            } else if (dt.attachment[i].type == "image/jpg") {
                                icon_attchment = icon_created_post_jpg;
                            } else if (
                                dt.attachment[i].type == "application/pdf"
                            ) {
                                icon_attchment = icon_created_post_pdf;
                            } else if (
                                dt.attachment[i].type ==
                                "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                            ) {
                                icon_attchment = icon_created_post_doc;
                            }

                            // console.log(dt.attachment.type);

                            html += `
                                <div
                                    class="bg-slate-50 group active_postingan py-4 px-5 rounded-[15px] flex flex-col mt-2 cursor-pointer" onclick="select_postingan(${
                                        dt.id
                                    })">

                                    <div class="flex flex-rows pt-1 pb-2">

                                        <div class="">
                                            <span
                                                class="bg-gray-200 active_postingan_badge max-w-[9rem] text-gray-800 tracking-wide text-xs font-medium inline-flex items-center px-1.5 py-1.5 rounded-[20px] mr-2" onclick="pop_post(${id_channel}, ${
                                dt.id
                            })">

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                                                    class="w-3.5 h-3.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18"></path>
                                                </svg>

                                            </span>
                                        </div>

                                        ${status}

                                    </div>

                                    <div class="grid grid-cols-1 font-bold opacity-[0.5] text-[15pt]">
                                        ${dt.title}
                                        </div>
                                    <div
                                        class="grid grid-cols-1 text-sm text-gray-500 tracking-wide text-justify pt-1 pb-2 teks_post max-h-10">
                                        <p class="truncate">
                                            ${dt.body}
                                            </p>
                                    </div>

                                    ${icon_attchment}

                                    <div class="grid grid-cols-1 text-xs text-gray-500">
                                        <div class="inline-flex">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <span class="px-1">
                                                ${dt.total_response}
                                            </span>
                                            <span class="flex items-center">
                                                <img class="w-3 h-3" src="/assets/dots.png" alt="">
                                            </span>
                                            <span class="px-1 text-[13px]">
                                                ${moment(
                                                    dt.created_at.slice(0, -1),
                                                    "YYYY-MM-DD HH:mm:ss"
                                                )
                                                    .locale("id")
                                                    .fromNow()}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                `;
                        }
                    } else {
                        html += `
                                <div
                                    class="bg-slate-50 group active_postingan py-4 px-5 rounded-[15px] flex flex-col mt-2 cursor-pointer" onclick="select_postingan(${
                                        dt.id
                                    })">

                                    <div class="flex flex-rows pt-1 pb-2">

                                        <div class="">
                                            <span
                                                class="bg-gray-200 active_postingan_badge max-w-[9rem] text-gray-800 tracking-wide text-xs font-medium inline-flex items-center px-1.5 py-1.5 rounded-[20px] mr-2" onclick="pop_post(${id_channel}, ${
                            dt.id
                        })">

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                                                    class="w-3.5 h-3.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18"></path>
                                                </svg>

                                            </span>
                                        </div>

                                        ${status}

                                    </div>

                                    <div class="grid grid-cols-1 font-bold opacity-[0.5] text-[15pt]">
                                        ${dt.title}
                                        </div>
                                    <div
                                        class="grid grid-cols-1 text-sm text-gray-500 tracking-wide text-justify pt-1 pb-2 teks_post max-h-10">
                                        <p class="truncate">
                                            ${dt.body}
                                            </p>
                                    </div>

                                    <div class="grid grid-cols-1 text-xs text-gray-500">
                                        <div class="inline-flex">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <span class="px-1">
                                                ${dt.total_response}
                                            </span>
                                            <span class="flex items-center">
                                                <img class="w-3 h-3" src="/assets/dots.png" alt="">
                                            </span>
                                            <span class="px-1 text-[13px]">
                                                ${moment(
                                                    dt.created_at.slice(0, -1),
                                                    "YYYY-MM-DD HH:mm:ss"
                                                )
                                                    .locale("id")
                                                    .fromNow()}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                `;
                    }
                });
            }
        }

        $("#list-created-post").html("");
        $("#list-created-post").html(html);

        autoScroll();

        socket.emit("read_post", user_id, id_channel);
    });
};

// For Pop Post
const pop_post = (id_channel, id_post) => {
    console.log("Pop Post");
    socket.emit("pop_post", id_channel, id_post, () => {
        showListPost(id_channel);
    });
};

//Preview File Attachment
const previewFile = (file) => {
    window.open(`https://jakarta.pintoinvest.com:9000/chat/${file}`, "_BLANK");
    // console.log(file);
};

$(".aktif_class_status").click(function () {
    $("aktif_class_status.bg-gray-300").not(this).removeClass("bg-gray-300");
    $(this).toggleClass("bg-gray-300");
});

const tabsStatusPost = (val) => {
    // let status = val;
    // console.log(status);
    // if (val == "Penting") {
    //     $(".aktif_penting").addClass("bg-gray-300");
    //     $(".aktif_tl").removeClass("bg-gray-300");
    // } else if (val == "Tindak Lanjut") {
    //     $(".aktif_penting").removeClass("bg-gray-300");
    //     $(".aktif_tl").addClass("bg-gray-300");
    // } else {
    //     $(".aktif_penting").removeClass("bg-gray-300");
    //     $(".aktif_tl").removeClass("bg-gray-300");
    // }
    // create_new_post(status);
};

let get_stat_post = [];
console.log(get_stat_post);
$("input[name='get_stat[]']").change(function () {
    if (this.checked) {
        get_stat_post.push($(this).val());
        console.log($(this).val());
    } else {
        let index = get_stat_post.indexOf($(this).val());
        // console.log(index);
        if (index > -1) {
            get_stat_post.splice(index, 1);
        }
    }
    // create_new_post(get_stat_post);
});

// For Create New Post Get Data Image
const uploaded_image_post_thread = () => {
    const uploadButton = document.getElementById(
        "upload_btn_create_post_thread"
    );
    const uploadedImage = document.getElementById("uploaded_image_post_thread");
    const removeButton = document.getElementById("remove-button");
    const HideShow = document.getElementById("hide-show-image-post");

    uploadButton.addEventListener("change", function () {
        let files_created_post = this.files;

        let upload_created_post = [];

        tmp_file = upload_created_post;

        for (let i = 0; i < files_created_post.length; i++) {
            let file = files_created_post[i];
            let fileInfo = {
                name: file.name,
                size: file.size,
                type: file.type,
            };

            upload_created_post.push(fileInfo);
        }

        // console.log(upload_created_post);

        tmp_file = files_created_post;
        // console.log(tmp_file);

        file = this.files[0];
        // console.log(file);
        // tmp_file = this.files;

        const reader = new FileReader();

        // console.log(tmp_file);

        if (file.type == "image/png") {
            let element = `<img class="w-[12vw] h-[12vh] object-cover" src="/assets/pngnew.png" alt="">`;
            $("#preview-upload-thread").html(element);
            // alert("png");
        } else if (file.type == "image/jpeg") {
            let element = `<img class="w-[12vw] h-[12vh] object-cover" src="/assets/jpgnew.png" alt="">`;
            $("#preview-upload-thread").html(element);
        } else if (file.type == "image/jpg") {
            let element = `<img class="w-[12vw] h-[12vh] object-cover" src="/assets/jpgnew.png" alt="">`;
            $("#preview-upload-thread").html(element);
        } else if (file.type == "application/pdf") {
            let element = `<img class="w-[12vw] h-[12vh] object-cover" src="/assets/pdfnew.png" alt="">`;
            $("#preview-upload-thread").html(element);
        } else if (
            file.type ==
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
        ) {
            let element = `<img class="w-[12vw] h-[12vh] object-cover" src="/assets/docnew.png" alt="">`;
            $("#preview-upload-thread").html(element);
        }
        reader.onload = function (event) {
            // uploadedImage.src = event.target.result;
            uploadedImage.style.display = "block";
            removeButton.style.display = "block";
            uploadButton.style.display = "none";
            HideShow.style.display = "none";
        };
        reader.readAsDataURL(file);

        // console.log(file);
    });

    removeButton.addEventListener("click", function () {
        // uploadedImage.src = "";
        uploadedImage.style.display = "none";
        removeButton.style.display = "none";
        uploadButton.style.display = "none";
        HideShow.style.display = "block";
        uploadButton.value = "";
    });
};
uploaded_image_post_thread();

$("#create_post_thread").submit((e) => {
    e.preventDefault();

    let title = $("#title_post_created").val();
    let content = $("#konten_post_created").val();

    // console.log(get_stat_post);
    // console.log(tmp_file);

    if (tmp_file != undefined && tmp_file.length > 0) {
        let upload_file_post_thread = new FormData();

        // console.log(attachment);

        for (let i = 0; i < tmp_file.length; i++) {
            upload_file_post_thread.append("attachments", tmp_file[i]);
            console.log(tmp_file[i]);

            let attachment = [
                {
                    name: tmp_file[i].name,
                    size: tmp_file[i].size,
                    type: tmp_file[i].type,
                },
            ];

            $.ajax({
                url: "https://jakarta.pintoinvest.com:1323/assets",
                type: "POST",
                data: upload_file_post_thread,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                },
            });

            let new_post = {
                title: title,
                body: content,
                id_user: user_id,
                content: content,
                id_channel: parseInt(localStorage.getItem("channel")),
                status: get_stat_post,
                attachment: attachment,
            };

            socket.emit("create_post", new_post);
            // send_create_new_post(tmp_file);
            // tmp_file = [];
        }
    } else {
        let new_post = {
            title: title,
            body: content,
            id_user: user_id,
            content: content,
            id_channel: parseInt(localStorage.getItem("channel")),
            status: get_stat_post,
            // attachment: "",
        };
        socket.emit("create_post", new_post);
    }

    // Hapus value pada inputan
    $("#title_post_created").val("");
    $("#konten_post_created").val("");
    // menghilangkan checkbox
    $("input[name='get_stat[]']").prop("checked", false);
    get_stat_post.length = 0;
    // menghilankan preview image
    $("#remove-button").trigger("click");
    // console.log(new_post);

    // if (tmp_file != null) {
    //     send_create_new_post(tmp_file);
    // }
});

// For Create New Post Senf File
// const send_create_new_post = (tmp_file) => {
//     // console.log(tmp_file);
//     let create_post_formData = new FormData();

//     for (let i = 0; i < tmp_file.length; i++) {
//         create_post_formData.append("attachments", tmp_file[i]);
//     }

//     console.log(create_post_formData);

//     $.ajax({
//         url: "https://jakarta.pintoinvest.com:1323/assets",
//         type: "POST",
//         data: create_post_formData,
//         contentType: false,
//         processData: false,
//         success: function (data) {
//             // console.log(data);
//         },
//     });
// };

// Kanal - Send File Diskusi Umum
const send_file_diskusi_respon = () => {
    let input_file = document.getElementById("upload_file_post");

    input_file.addEventListener("change", (e) => {
        e.preventDefault();

        let files = input_file.files;

        let upload_attachment = [];

        for (let i = 0; i < files.length; i++) {
            let file = files[i];
            let fileInfo = {
                name: file.name,
                size: file.size,
                type: file.type,
            };

            upload_attachment.push(fileInfo);
        }

        let cl = parseInt(localStorage.getItem("channel"));
        let ps = parseInt(localStorage.getItem("id_post"));

        let data = {
            id_user: user_id,
            id_channel: cl,
            id_post: ps,
            id_reply: 3,
            attachment: upload_attachment,
            message: "",
        };

        console.log(files);

        socket.emit("send_response", data);

        send_file_respon(files, data);
    });
};
send_file_diskusi_respon();

const send_file_respon = (files, data) => {
    let formData = new FormData();

    for (let i = 0; i < files.length; i++) {
        formData.append("attachments", files[i]);
    }

    // console.log(formData);

    $.ajax({
        url: "https://jakarta.pintoinvest.com:1323/assets",
        type: "POST",
        data: formData,
        beforeSend: function () {
            if (data.message != "file") {
                for (let i = 0; i < data.attachment.length; i++) {
                    if (data.attachment[i].type == "image/png") {
                        let element = `
                    <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg">
                                <div class="flex justify-start w-full cursor-pointer">
                                    <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                        <div class="flex flex-row px-3 py-2">
                                            <div class="w-[3.1rem] h-10 grid items-center">
                                                <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                            </div>
                                            <div class="flex flex-col w-full">
                                                <div class="container_replay_box">
                                                    <div class="replay_box">
                                                        <div class="flex flex-rows items-center">
                                                            <div class="maks_username">
                                                                <p class="truncate">
                                                                    ${username}
                                                                </p>
                                                            </div>
                                                            <div class="ml-1 text-[11px] text-gray-500">
                                                                ${time()} WIB
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-[12vw] h-[4rem] my-1" onclick="previewFile('${
                                                    data.attachment[i].name
                                                }')">
                                                    <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                        <div class="basis-2/12">
                                                            <div class="h-full grid place-content-center">
                                                                <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                    src=" /assets/pngnew.png" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="basis-10/12">
                                                            <div class="h-full grid content-center">
                                                                <div
                                                                    class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                    <p class="truncate">
                                                                        ${
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .name
                                                                        }
                                                                    </p>
                                                                    <span class="text-gray-500 text-xs">
                                                                        ${formatBytes(
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .size
                                                                        )} KB</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>`;
                        $("#pesan-postingan-thread").append(element);
                        autoScroll();
                    } else if (data.attachment[i].type == "image/jpeg") {
                        let element = `
                    <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg ">
                                <div class="flex justify-start w-full cursor-pointer">
                                    <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                        <div class="flex flex-row px-3 py-2">
                                            <div class="w-[3.1rem] h-10 grid items-center">
                                                <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                            </div>
                                            <div class="flex flex-col w-full">
                                                <div class="container_replay_box">
                                                    <div class="replay_box">
                                                        <div class="flex flex-rows items-center">
                                                            <div class="maks_username">
                                                                <p class="truncate">
                                                                    ${username}
                                                                </p>
                                                            </div>
                                                            <div class="ml-1 text-[11px] text-gray-500">
                                                                ${time()} WIB
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-[12vw] h-[4rem] my-1" onclick="previewFile('${
                                                    data.attachment[i].name
                                                }')">
                                                    <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                        <div class="basis-2/12">
                                                            <div class="h-full grid place-content-center">
                                                                <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                    src=" /assets/jpgnew.png" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="basis-10/12">
                                                            <div class="h-full grid content-center">
                                                                <div
                                                                    class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                    <p class="truncate">
                                                                        ${
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .name
                                                                        }
                                                                    </p>
                                                                    <span class="text-gray-500 text-xs">
                                                                        ${formatBytes(
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .size
                                                                        )} KB</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>`;
                        $("#pesan-postingan-thread").append(element);
                        autoScroll();
                    } else if (data.attachment[i].type == "image/jpg") {
                        let element = `
                    <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg ">
                                <div class="flex justify-start w-full cursor-pointer">
                                    <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                        <div class="flex flex-row px-3 py-2">
                                            <div class="w-[3.1rem] h-10 grid items-center">
                                                <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                            </div>
                                            <div class="flex flex-col w-full">
                                                <div class="container_replay_box">
                                                    <div class="replay_box">
                                                        <div class="flex flex-rows items-center">
                                                            <div class="maks_username">
                                                                <p class="truncate">
                                                                    ${username}
                                                                </p>
                                                            </div>
                                                            <div class="ml-1 text-[11px] text-gray-500">
                                                                ${time()} WIB
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-[12vw] h-[4rem] my-1" onclick="previewFile('${
                                                    data.attachment[i].name
                                                }')">
                                                    <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                        <div class="basis-2/12">
                                                            <div class="h-full grid place-content-center">
                                                                <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                    src=" /assets/jpgnew.png" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="basis-10/12">
                                                            <div class="h-full grid content-center">
                                                                <div
                                                                    class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                    <p class="truncate">
                                                                        ${
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .name
                                                                        }
                                                                    </p>
                                                                    <span class="text-gray-500 text-xs">
                                                                        ${formatBytes(
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .size
                                                                        )} KB</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>`;
                        $("#pesan-postingan-thread").append(element);
                        autoScroll();
                    } else if (data.attachment[i].type == "application/pdf") {
                        let element = `
                    <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg ">
                                <div class="flex justify-start w-full cursor-pointer">
                                    <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                        <div class="flex flex-row px-3 py-2">
                                            <div class="w-[3.1rem] h-10 grid items-center">
                                                <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                            </div>
                                            <div class="flex flex-col w-full">
                                                <div class="container_replay_box">
                                                    <div class="replay_box">
                                                        <div class="flex flex-rows items-center">
                                                            <div class="maks_username">
                                                                <p class="truncate">
                                                                    ${username}
                                                                </p>
                                                            </div>
                                                            <div class="ml-1 text-[11px] text-gray-500">
                                                                ${time()} WIB
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-[12vw] h-[4rem] my-1" onclick="previewFile('${
                                                    data.attachment[i].name
                                                }')">
                                                    <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                        <div class="basis-2/12">
                                                            <div class="h-full grid place-content-center">
                                                                <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                    src=" /assets/pdfnew.png" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="basis-10/12">
                                                            <div class="h-full grid content-center">
                                                                <div
                                                                    class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                    <p class="truncate">
                                                                        ${
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .name
                                                                        }
                                                                    </p>
                                                                    <span class="text-gray-500 text-xs">
                                                                        ${formatBytes(
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .size
                                                                        )} KB</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>`;
                        $("#pesan-postingan-thread").append(element);
                        autoScroll();
                    } else if (
                        data.attachment[i].type ==
                        "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                    ) {
                        let element = `
                    <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg ">
                                <div class="flex justify-start w-full cursor-pointer">
                                    <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                        <div class="flex flex-row px-3 py-2">
                                            <div class="w-[3.1rem] h-10 grid items-center">
                                                <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                            </div>
                                            <div class="flex flex-col w-full">
                                                <div class="container_replay_box">
                                                    <div class="replay_box">
                                                        <div class="flex flex-rows items-center">
                                                            <div class="maks_username">
                                                                <p class="truncate">
                                                                    ${username}
                                                                </p>
                                                            </div>
                                                            <div class="ml-1 text-[11px] text-gray-500">
                                                                ${time()} WIB
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-[12vw] h-[4rem] my-1" onclick="previewFile('${
                                                    data.attachment[i].name
                                                }')">
                                                    <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                        <div class="basis-2/12">
                                                            <div class="h-full grid place-content-center">
                                                                <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                    src=" /assets/docnew.png" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="basis-10/12">
                                                            <div class="h-full grid content-center">
                                                                <div
                                                                    class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                    <p class="truncate">
                                                                        ${
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .name
                                                                        }
                                                                    </p>
                                                                    <span class="text-gray-500 text-xs">
                                                                        ${formatBytes(
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .size
                                                                        )} KB</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>`;
                        $("#pesan-postingan-thread").append(element);
                        autoScroll();
                    }
                }
            }
        },
        contentType: false,
        processData: false,
        success: function (data) {
            // console.log(data);
        },
    });
};

// Kanal - Send Message Diskusi Umum
$("#sendMessage").submit((e) => {
    e.preventDefault();
    let message = $("#message").val();

    let data = {
        id_user: user_id,
        id_channel: parseInt(localStorage.getItem("channel")),
        message: message,
    };

    socket.emit("send_chat", data);

    console.log(data);

    $("#message").val("");

    $("#reply-content").hide();
    localStorage.removeItem("id_reply");
    // localStorage.removeItem("channel");
});

// Kanal - Send File Diskusi Umum
const send_file_diskusi = () => {
    let input_file = document.getElementById("upload_file");

    input_file.addEventListener("change", (e) => {
        e.preventDefault();

        let files = input_file.files;

        let upload_attachment = [];

        for (let i = 0; i < files.length; i++) {
            let file = files[i];
            let fileInfo = {
                name: file.name,
                size: file.size,
                type: file.type,
            };

            upload_attachment.push(fileInfo);
        }

        let data = {
            id_user: user_id,
            id_channel: parseInt(localStorage.getItem("channel")),
            attachment: upload_attachment,
            message: "file",
        };

        // console.log(data);

        socket.emit("send_chat", data);

        send_file(files, data);
    });
};
send_file_diskusi();

const send_file = (files, data) => {
    let formData = new FormData();

    for (let i = 0; i < files.length; i++) {
        formData.append("attachments", files[i]);
    }

    console.log(formData);

    // formData.append("attachments", files);

    // console.log(files);

    $.ajax({
        url: "https://jakarta.pintoinvest.com:1323/assets",
        type: "POST",
        data: formData,
        beforeSend: function () {
            if (data != null) {
                for (let i = 0; i < data.attachment.length; i++) {
                    if (data.attachment[i].type == "image/png") {
                        let element = `
                    <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg">
                                <div class="flex justify-start w-full cursor-pointer">
                                    <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                        <div class="flex flex-row px-3 py-2">
                                            <div class="w-[3.1rem] h-10 grid items-center">
                                                <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                            </div>
                                            <div class="flex flex-col w-full">
                                                <div class="container_replay_box">
                                                    <div class="replay_box">
                                                        <div class="flex flex-rows items-center">
                                                            <div class="maks_username">
                                                                <p class="truncate">
                                                                    ${username}
                                                                </p>
                                                            </div>
                                                            <div class="ml-1 text-[11px] text-gray-500">
                                                                ${time()} WIB
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-[12vw] h-[4rem] my-1" onclick="previewFile('${
                                                    data.attachment[i].name
                                                }')">
                                                    <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                        <div class="basis-2/12">
                                                            <div class="h-full grid place-content-center">
                                                                <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                    src=" /assets/pngnew.png" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="basis-10/12">
                                                            <div class="h-full grid content-center">
                                                                <div
                                                                    class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                    <p class="truncate">
                                                                        ${
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .name
                                                                        }
                                                                    </p>
                                                                    <span class="text-gray-500 text-xs">
                                                                        ${formatBytes(
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .size
                                                                        )} KB</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>`;
                        $("#list-message").append(element);
                        autoScroll();
                    } else if (data.attachment[i].type == "image/jpeg") {
                        let element = `
                    <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg">
                                <div class="flex justify-start w-full cursor-pointer">
                                    <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                        <div class="flex flex-row px-3 py-2">
                                            <div class="w-[3.1rem] h-10 grid items-center">
                                                <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                            </div>
                                            <div class="flex flex-col w-full">
                                                <div class="container_replay_box">
                                                    <div class="replay_box">
                                                        <div class="flex flex-rows items-center">
                                                            <div class="maks_username">
                                                                <p class="truncate">
                                                                    ${username}
                                                                </p>
                                                            </div>
                                                            <div class="ml-1 text-[11px] text-gray-500">
                                                                ${time()} WIB
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-[12vw] h-[4rem] my-1" onclick="previewFile('${
                                                    data.attachment[i].name
                                                }')">
                                                    <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                        <div class="basis-2/12">
                                                            <div class="h-full grid place-content-center">
                                                                <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                    src=" /assets/jpgnew.png" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="basis-10/12">
                                                            <div class="h-full grid content-center">
                                                                <div
                                                                    class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                    <p class="truncate">
                                                                        ${
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .name
                                                                        }
                                                                    </p>
                                                                    <span class="text-gray-500 text-xs">
                                                                        ${formatBytes(
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .size
                                                                        )} KB</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>`;
                        $("#list-message").append(element);
                        autoScroll();
                    } else if (data.attachment[i].type == "image/jpg") {
                        let element = `
                    <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg">
                                <div class="flex justify-start w-full cursor-pointer">
                                    <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                        <div class="flex flex-row px-3 py-2">
                                            <div class="w-[3.1rem] h-10 grid items-center">
                                                <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                            </div>
                                            <div class="flex flex-col w-full">
                                                <div class="container_replay_box">
                                                    <div class="replay_box">
                                                        <div class="flex flex-rows items-center">
                                                            <div class="maks_username">
                                                                <p class="truncate">
                                                                    ${username}
                                                                </p>
                                                            </div>
                                                            <div class="ml-1 text-[11px] text-gray-500">
                                                                ${time()} WIB
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-[12vw] h-[4rem] my-1" onclick="previewFile('${
                                                    data.attachment[i].name
                                                }')">
                                                    <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                        <div class="basis-2/12">
                                                            <div class="h-full grid place-content-center">
                                                                <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                    src=" /assets/jpgnew.png" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="basis-10/12">
                                                            <div class="h-full grid content-center">
                                                                <div
                                                                    class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                    <p class="truncate">
                                                                        ${
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .name
                                                                        }
                                                                    </p>
                                                                    <span class="text-gray-500 text-xs">
                                                                        ${formatBytes(
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .size
                                                                        )} KB</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>`;
                        $("#list-message").append(element);
                        autoScroll();
                    } else if (data.attachment[i].type == "application/pdf") {
                        let element = `
                    <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg">
                                <div class="flex justify-start w-full cursor-pointer">
                                    <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                        <div class="flex flex-row px-3 py-2">
                                            <div class="w-[3.1rem] h-10 grid items-center">
                                                <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                            </div>
                                            <div class="flex flex-col w-full">
                                                <div class="container_replay_box">
                                                    <div class="replay_box">
                                                        <div class="flex flex-rows items-center">
                                                            <div class="maks_username">
                                                                <p class="truncate">
                                                                    ${username}
                                                                </p>
                                                            </div>
                                                            <div class="ml-1 text-[11px] text-gray-500">
                                                                ${time()} WIB
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-[12vw] h-[4rem] my-1" onclick="previewFile('${
                                                    data.attachment[i].name
                                                }')">
                                                    <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                        <div class="basis-2/12">
                                                            <div class="h-full grid place-content-center">
                                                                <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                    src=" /assets/pdfnew.png" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="basis-10/12">
                                                            <div class="h-full grid content-center">
                                                                <div
                                                                    class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                    <p class="truncate">
                                                                        ${
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .name
                                                                        }
                                                                    </p>
                                                                    <span class="text-gray-500 text-xs">
                                                                        ${formatBytes(
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .size
                                                                        )} KB</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>`;
                        $("#list-message").append(element);
                        autoScroll();
                    } else if (
                        data.attachment[i].type ==
                        "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                    ) {
                        let element = `
                    <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg">
                                <div class="flex justify-start w-full cursor-pointer">
                                    <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                        <div class="flex flex-row px-3 py-2">
                                            <div class="w-[3.1rem] h-10 grid items-center">
                                                <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                            </div>
                                            <div class="flex flex-col w-full">
                                                <div class="container_replay_box">
                                                    <div class="replay_box">
                                                        <div class="flex flex-rows items-center">
                                                            <div class="maks_username">
                                                                <p class="truncate">
                                                                    ${username}
                                                                </p>
                                                            </div>
                                                            <div class="ml-1 text-[11px] text-gray-500">
                                                                ${time()} WIB
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-[12vw] h-[4rem] my-1" onclick="previewFile('${
                                                    data.attachment[i].name
                                                }')">
                                                    <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                        <div class="basis-2/12">
                                                            <div class="h-full grid place-content-center">
                                                                <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                    src=" /assets/docnew.png" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="basis-10/12">
                                                            <div class="h-full grid content-center">
                                                                <div
                                                                    class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                    <p class="truncate">
                                                                        ${
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .name
                                                                        }
                                                                    </p>
                                                                    <span class="text-gray-500 text-xs">
                                                                        ${formatBytes(
                                                                            data
                                                                                .attachment[
                                                                                i
                                                                            ]
                                                                                .size
                                                                        )} KB</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>`;
                        $("#list-message").append(element);
                        autoScroll();
                    }
                }
                // console.log(data);
            } else {
                console.log("data null");
            }
        },
        contentType: false,
        processData: false,
        success: function (data) {
            // console.log(data);
        },
    });
};

// Auto Scroll Chat Mobile
$("#message").on("focus", () => {
    setTimeout(() => {
        autoScroll();
    }, 1500);

    console.log("focus");
});

//Paste ScreenShot
$("#message").on("paste", (event) => {
    let items = (event.clipboardData || event.originalEvent.clipboardData)
        .items;
    for (let index in items) {
        let item = items[index];
        if (item.kind === "file") {
            let file = item.getAsFile();
            // console.log(file);
            send_file(file);
        }
    }
});

//Delete Message
const deleteMessage = (id) => {
    socket.emit("delete", id);
};

socket.on("delete", (id) => {
    $(`#message-${id}`).remove();
    starMessage();
});

//Star or Pin Priority Message
const starMessage = (id) => {
    socket.emit("priority", {
        id: id,
    });
};

socket.on("priority", (data) => {
    let html = ``;
    const date_convert = (date_input) => {
        return date(date_input);
    };

    //list color
    const list_color = ["text-red-500", "text-yellow-500", "text-green-500"];

    //count different hour
    const diff_hour = (time_message) => {
        let time = new Date(time_message.slice(0, -1));
        let now = new Date();
        let diff = Math.abs(now - time);
        let diff_hour = Math.floor(diff / (1000 * 60 * 60));
        if (diff_hour < 12) {
            return list_color[2];
        } else if (diff_hour > 12 && diff_hour < 24) {
            return list_color[1];
        } else {
            return list_color[0];
        }
    };

    if (data == null) {
        html += `<p class="text-center text-sm m-2">Tidak Ada Pesan Prioritas</p>`;
    } else {
        data.forEach((val) => {
            const { id, room, message, date } = val;
            let name_chanel = GetChanelName(room);
            html += `
            <div class="grid grid-cols-4 cursor-pointer bg_active_color hover:bg-gray-200 text-sm px-4 py-2 border-b-[1px] border-gray-200" onclick="select_sector('${room}','${name_chanel}');replyMessage(${id})" id="priority-${id}">

            <div class="col-span-4">
                <div class="flex flex-row justify-between">
                    <div class="text-sm col-span-2 mt-1 ">
                        ${date_convert(
                            date
                        )} <span class="mx-1"></span><span class="">${time(
                date
            )}
                            WIB</span>
                    </div>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" class="w-[1.1rem] h-[1.2rem] ${diff_hour(
                                date
                            )}">
                                <path fill-rule="evenodd"
                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="col-span-4 flex mt-[0.4rem]">
                <div class="content_antrian_prioritas">
                    ${message}
                </div>
            </div>
        </div>
            `;
        });
    }

    $(".list-priority").html(html);
    limitTeksPriotitas();
    limitTeksKonsultasi();
});

// upload versi1
// $("#upload_file").change(() => {
//     let files = $("#upload_file").get(0).files[0];
//     send_file(files);
// });

//Send Ticket
$("#formTicketing").on("submit", function (e) {
    e.preventDefault();
    $("#btnSubmitTicket").hide();
    $("#prosesTicket").removeClass("hidden").addClass("flex");
    let form = new FormData(this);
    $.ajax({
        url: `/ticketing`,
        type: "POST",
        data: form,
        contentType: false,
        cache: false,
        processData: false,
        dateType: "json",
        success: function (data) {
            $("#prosesTicket").removeClass("flex").addClass("hidden");
            $("#btnSubmitTicket").show();
            $("#formTicketing")[0].reset();
            $(".alert-success-ticket").find(".text-message").text(data.message);
            $(".alert-success-ticket").removeClass("hidden").addClass("flex");
            setTimeout(() => {
                $(".alert-success-ticket")
                    .removeClass("flex")
                    .addClass("hidden");
            }, 3000);
        },
        error: function (data) {
            $("#prosesTicket").removeClass("flex").addClass("hidden");
            $("#btnSubmitTicket").show();
            $(".alert-failed-ticket")
                .find(".text-message")
                .text(data.responseJSON.message);
            $(".alert-failed-ticket").removeClass("hidden").addClass("flex");
            setTimeout(() => {
                $(".alert-failed-ticket")
                    .removeClass("flex")
                    .addClass("hidden");
            }, 3000);
        },
    });
});

//Convert Size File
const formatBytes = (bytes, decimals = 2) => {
    if (bytes === 0) return "0 Bytes";

    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ["Bytes", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + " " + sizes[i];
};

//Category File
const fileCategory = (type) => {
    let word = [
        "application/msword",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    ];
    let pdf = ["application/pdf"];
    let image = [
        "image/jpeg",
        "image/jpg",
        "image/png",
        "image/gif",
        "image/bmp",
        "image/webp",
        "image/tiff",
        "image/svg+xml",
    ];

    let result = {};

    if (word.includes(type)) {
        result.type = "DOC";
        result.icon = "doc2.png";

        return result;
    } else if (pdf.includes(type)) {
        result.type = "PDF";
        result.icon = "pdf.png";

        return result;
    } else {
        result.type = "Gambar";
        result.icon = "image.png";

        return result;
    }
};

//Register Service Worker
const registerServiceWorker = () => {
    return navigator.serviceWorker
        .register("service-worker.js")
        .then((registration) => {
            console.log("Registrasi service worker berhasil.");
            return registration;
        })
        .catch((err) => {
            console.error("Registrasi service worker gagal.", err);
        });
};

// Check service worker
if (!("serviceWorker" in navigator)) {
    console.log("Service worker tidak didukung browser ini.");
} else {
    registerServiceWorker();
}

// Request Notification Permission
const requestPermission = () => {
    Notification.requestPermission().then((result) => {
        if (result === "denied") {
            console.log("Fitur notifikasi tidak diijinkan.");
            return;
        } else if (result === "default") {
            console.error("Pengguna menutup kotak dialog permintaan ijin.");
            return;
        }

        console.log("Fitur notifikasi diijinkan.");
    });
};

// Check Notification API
if ("Notification" in window) {
    requestPermission();
} else {
    console.error("Browser tidak mendukung notifikasi.");
}

const notification = (chanel = "Tidak Ada", message = "Tidak Ada") => {
    //Filter Channel Name

    const title = GetChanelName(chanel);
    const options = {
        body: message,
        icon: "/assets/gambar/logo_jakpintas2.png",
    };
    if (Notification.permission === "granted") {
        navigator.serviceWorker.ready.then((registration) => {
            registration.showNotification(title, options);
        });
    } else {
        console.error("FItur notifikasi tidak diijinkan.");
    }
};

//Batas Teks Chating Pesan Prioritas / sebanyak 3 baris
const limitTeksPriotitas = () => {
    let limitTeks = 230;
    let getTeks = document.querySelectorAll(".content_antrian_prioritas");
    getTeks.forEach((x) => {
        if (x.textContent.length < limitTeks) {
            if (x.nextElementSibling !== null) {
                x.nextElementSibling.style.display = "none";
            }
        } else {
            let teksTampil = x.textContent.slice(0, limitTeks);
            let Selanjutnya = x.textContent.slice(limitTeks);
            x.innerHTML = `${teksTampil}<span class="">...</span><span class="hide">${Selanjutnya}</span>`;
        }
    });
};

// Batas Teks Chating Pesan
const limitTeksKonsultasi = () => {
    let limitTeks = 340;
    let getTeks = document.querySelectorAll(".konten_chating_konsultasi");

    getTeks.forEach((x) => {
        if (x.textContent.length < limitTeks) {
            if (x.nextElementSibling !== null) {
                x.nextElementSibling.style.display = "none";
            }
        } else {
            let teksTampil = x.textContent.slice(0, limitTeks);
            let Selanjutnya = x.textContent.slice(limitTeks);
            x.innerHTML = `${teksTampil}<span class="">...</span><span class="hide">${Selanjutnya}</span>`;
        }
    });
};

//Open Chat On Mobile
const openChat = () => {
    // $(".main_header").css("display", "none");
    // $(".main_server").css("display", "none");
    // $(".main_channel").css("display", "none");
    // $(".main_konten").css("display", "block", "important");
    // $(".main_sidebar").css("display", "none");
    // $(".group_konten_menu").css("width", "100%").css("height", "100%");

    let style = document.createElement("style");
    style.textContent = `
        .main_header {
        display: none;
    }

    .main_server {
        display: none;
    }

    .main_channel {
        display: none;
    }

    .main_konten {
        display: block;
    }
        `;
    document.head.append(style);

    $(".container_group").addClass("open_chating");
    $(".tab_menu_mobile").addClass("close_chating");
};

// Aksi untuk kembali ke menu
const Menu = () => {
    // $(".main_header").css("display", "block");
    // $(".main_server").css("display", "block");
    // $(".main_channel").css("display", "block");
    // $(".main_konten").css("display", "block");
    // $(".main_sidebar").css("display", "block");
    // $(".group_server_chating").css("display", "flex");

    let style = document.createElement("style");
    style.textContent = `
            .main_header {
                display: block;
            }

            .main_server {
                display: block;
            }

            .main_channel {
                display: block;
            }

            .main_konten {
                display: none;
            }

            .group_server_chating {
                display: flex;
            }
        `;
    document.head.append(style);

    // $(".group_server")
    //     .css("margin-top", "0.5rem")
    //     .css("display", "flex")
    //     .css("height", "100vh")
    //     .css("width", "5rem")
    //     .css("flex-direction", "column")
    //     .css(" background-color", "rgb(209 213 219 / var(--tw-bg-opacity))")
    //     .css("padding-bottom", "0.8rem")
    //     .css("padding-left", "0px");

    $(".tab_menu_mobile").addClass("close_chating");
};

// Set responsive mobile
const viewMobile = () => {
    var root = document.documentElement;
    if (
        window.innerWidth > window.innerHeight ||
        Math.abs(this.lastHeight - window.innerHeight) > 100
    ) {
        root.style.setProperty(`--window-vh`, window.innerHeight + "px");
        this.lastHeight = window.innerHeight;
    }
};

// Judul Postingan
// const judulPost = () => {
//     let title = document.getElementById("title_post_created");
//     title.addEventListener("click", function () {
//         title.setAttribute("contenteditable", "true");
//         let phs = this.querySelector(".placeholder-span-title");
//         if (phs != null) {
//             if (!this.hasOwnProperty("placeholderSpanTitle")) {
//                 this.placeholderSpanTitle = phs;
//             }
//             phs.remove();
//             document.getSelection().setPosition(this, 0);
//         }
//     });
//     title.addEventListener("focusout", function () {
//         if (
//             this.textContent.trim().length == 0 &&
//             this.hasOwnProperty("placeholderSpanTitle")
//         ) {
//             this.replaceChildren(this.placeholderSpanTitle);
//         }
//     });
// };
// judulPost();

// Isi konten Postingan
// const kontenPost = () => {
//     let konten_post_created = document.getElementById("konten_post_created");

//     konten_post_created.addEventListener("click", function () {
//         konten_post_created.setAttribute("contenteditable", "true");
//         let phs = this.querySelector(".placeholder-span-isi-title");
//         if (phs != null) {
//             if (!this.hasOwnProperty("placeholderSpanIsiTitle")) {
//                 this.placeholderSpanIsiTitle = phs;
//             }
//             phs.remove();
//             document.getSelection().setPosition(this, 0);
//         }
//     });

//     konten_post_created.addEventListener("focusout", function () {
//         if (
//             this.textContent.trim().length == 0 &&
//             this.hasOwnProperty("placeholderSpanIsiTitle")
//         ) {
//             this.replaceChildren(this.placeholderSpanIsiTitle);
//         }
//     });
// };
// kontenPost();

// Limit text postingan create
// const limitTeksPost = () => {
//     // Excempt keys(arrows, del, backspace, home, end);
//     var excempt = [37, 38, 39, 40, 46, 8, 36, 35];
//     $("[contenteditable='true']").each(function (index, elem) {
//         var $elem = $(elem);
//         var length = $elem.data("input-length");
//         if (!isNaN(length)) {
//             $elem.on("keydown", function (evt) {
//                 if (
//                     excempt.indexOf(evt.which) === -1 &&
//                     $elem.text().length > length
//                 ) {
//                     evt.preventDefault();
//                     return false;
//                 }
//             });
//         }
//     });
// };
// limitTeksPost();

// limit text postingan konten
// const limitKontenPost = () => {
//     let limitTeks = 108;
//     let getTeks = document.querySelectorAll(".teks_post");
//     // console.log(getTeks);
//     getTeks.forEach((x) => {
//         if (x.textContent.length < limitTeks) {
//             if (x.nextElementSibling !== null) {
//                 x.nextElementSibling.style.display = "none";
//             }
//         } else {
//             let teksTampil = x.textContent.slice(0, limitTeks);
//             x.innerHTML = `${teksTampil}...`;
//         }
//     });
// };
// limitKontenPost();

// Upload Preview Image
// const uploadPreviewImage = () => {
//     var imagesPreview = function (input, placeToInsertImagePreview) {
//         if (input.files) {
//             if (input.files.length <= 3) {
//                 var filesAmount = input.files.length;

//                 for (i = 0; i < filesAmount; i++) {
//                     var reader = new FileReader();

//                     reader.onload = function (event) {
//                         $($.parseHTML("<img class='ml-2'>"))
//                             .attr("src", event.target.result)
//                             .appendTo(placeToInsertImagePreview);
//                     };

//                     reader.readAsDataURL(input.files[i]);
//                 }
//             } else {
//                 alert("Maksimal 3 Gambar");
//             }
//         }
//     };

//     $("#upload-image-post").on("change", function () {
//         imagesPreview(this, "div.preview-image-post");
//     });
// };
// uploadPreviewImage();

// Batas Karakter Judul Postingan

let box_post = document.querySelector(".created_box_post_thread");
let input_textarea_post = [...box_post.querySelectorAll(".post_post_thread")];
let btn_post = document.querySelector("#send_post");

function checkInputs() {
    if (input_textarea_post.some((input) => input.value === "")) {
        $(".btn_send_created_post").removeClass("bg-blue-500");
        $(".btn_send_created_post").addClass("bg-blue-400");
        $("#create_send_post").removeClass("cursor-pointer");
        $("#create_send_post").addClass("cursor-not-allowed");
        btn_post.disabled = true;
    } else {
        $(".btn_send_created_post").removeClass("bg-blue-400");
        $(".btn_send_created_post").addClass("bg-blue-500");
        $("#create_send_post").removeClass("cursor-not-allowed");
        $("#create_send_post").addClass("cursor-pointer");
        btn_post.disabled = false;
    }
}

box_post.addEventListener("input", checkInputs);
checkInputs();

const limitKarakterJudul = () => {
    const get_text = document.getElementById("title_post_created");
    // const remaining_words = document.getElementById("remaining_words");

    get_text.addEventListener("keyup", function () {
        // Jika panjang teks lebih dari 100, potong teks ke 50 karakter
        if (this.value.length > 100) {
            this.value = this.value.slice(0, 100);
            alert("Maksimal 100 Karakter");
        }
        // Perbarui jumlah karakter tersisa
        // remaining_words.textContent = 100 - this.value.length;
    });

    get_text.addEventListener("change", function () {
        // Jika panjang teks lebih dari 100, potong teks ke 100 karakter
        if (this.value.length > 100) {
            this.value = this.value.slice(0, 100);
        }
        // Perbarui jumlah karakter tersisa
        // remaining_words.textContent = 100 - this.value.length;
    });
};
limitKarakterJudul();

// let MaksKarakter = 100;
// let MinimalKarakter = 0;

// function checkLengthJudul(event) {
//     // console.log(event.target.textContent.length);

//     if (MinimalKarakter >= MaksKarakter) {
//         alert("Masukan Maksimal 100 Karakter");
//         event.preventDefault();
//     } else {
//         MinimalKarakter++;
//     }
// }

// select class active on click
$(".active_postingan").click(function () {
    let show_konten = document.getElementsByClassName("konten_postingan");
    show_konten[0].style.display = "block";

    $(".active_postingan").removeClass("bg-red-100");
    $(this).addClass("bg-gray-100");

    $(".active_postingan_badge").addClass("bg-gray-300");
});

// Kanal -  Disksusi Umum satu arah
socket.on("chat_received", (data) => {
    // console.log("From received", data);

    let html = "";

    if (data.id_user == user_id) {
        is_admin = badge_admin;
    } else {
        is_admin = "";
    }

    // let date = new Date(data.created_at).toLocaleString("id-ID", {
    //     day: "numeric",
    //     month: "long",
    //     year: "numeric",
    // });

    // console.log(date);

    // let data_date = [{ date_created_at: date }];

    let result = [data].reduce((object, array) => {
        // let key = array.date;
        if (!object[date(array.created_at)]) {
            object[date(array.created_at)] = [];
        }
        object[date(array.created_at)].push(array);
        return object;

        // object[array.date_created_at] = [
        //     ...(object[array.date_created_at] || []),
        //     array,
        // ];
        // return array;
    }, {});

    // console.log(tmp_data_chat);
    for (key in result) {
        // console.log(data);
        // console.log(key);
        if (tmp_data_chat != {}) {
            // console.log(tmp_data_chat.length);
            if (key in tmp_data_chat) {
                console.log("data_tgl".key);
                // console.log(data);
                continue;
            } else {
                console.log("Tanggal Belum Ada");
                tmp_data_chat[key] = result[key];

                // console.log(result[key]);
                // console.log("tgl1".tmp_data_chat);

                html += `
                        <div class="w-full px-[1.7%]">
                                            <div class="flex items-center">
                                                <div class="flex-grow h-[0.08rem] bg-gray-400"></div>
                                                    <span class="flex-shrink text-sm text-gray-500 px-4">${key}</span>
                                                <div class="flex-grow h-[0.08rem] bg-gray-400"></div>
                                            </div>
                                        </div>
                        `;
            }
        }
        if (tmp_data_chat == "") {
            html += `
                            <div class="w-full px-[1.7%]">
                                                <div class="flex items-center">
                                                    <div class="flex-grow h-[0.08rem] bg-gray-400"></div>
                                                        <span class="flex-shrink text-sm text-gray-500 px-4">${key}</span>
                                                    <div class="flex-grow h-[0.08rem] bg-gray-400"></div>
                                                </div>
                                            </div>
                            `;

            tmp_data_chat[key] = result[key];
            console.log("tgl2".tmp_data_chat);
        }
    }

    if (data.message != "file") {
        html += `
                        <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg" id="message-${
                            data.id
                        }">
                                        <div class="flex justify-start w-full cursor-pointer">

                                            <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">

                                                <div class="flex flex-row px-3 py-2">

                                                    <div class="w-[3.1rem] h-10 grid items-center">
                                                        <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                                    </div>

                                                    <div class="flex flex-col w-full">
                                                        <div class="container_replay_box">

                                                            <div class="replay_box">
                                                                <div class="flex flex-rows items-center">

                                                                    <div class="maks_username">
                                                                        <p class="truncate">
                                                                            ${
                                                                                data.username
                                                                            }
                                                                        </p>
                                                                    </div>

                                                                    <div class="ml-1 text-[11px] text-gray-500">
                                                                            ${time(
                                                                                data.created_at
                                                                            )} Wib
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="container_btn_replay">

                                                                <div class="position_container_btn" style="display: none;">

                                                                    <div class="container_btn">

                                                                        <div class="btn_reply group"
                                                                            data-tooltip-target="balas-postingan" div="replyMessage(3)">
                                                                            <i style="font-size: 18px;"
                                                                                class="fa fa-reply mx-2 w-4 h-4 text-gray-700 group-hover:text-black"
                                                                                aria-hidden="true">
                                                                            </i>

                                                                            <div id="balas-postingan" role="tooltip"
                                                                                class="inline-block absolute z-10 py-1 px-2 text-[12px] font-medium text-gray-900 bg-white rounded-lg border border-gray-200 shadow-sm tooltip opacity-0 invisible"
                                                                                style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(453.6px, -200px, 0px);"
                                                                                data-popper-placement="top">
                                                                                Balas
                                                                                <div class="tooltip-arrow" data-popper-arrow=""
                                                                                    style="position: absolute; left: 0px; transform: translate3d(20px, 0px, 0px);">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div
                                                            class="w-full text-sm text-gray-500 font-normal tracking-wide break-words scrollbar max-w-[60rem]">
                                                            <p>${
                                                                data.message
                                                            }</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                    </div>`;
    }

    // console.log(result);

    // console.log(result);

    //   let result = e.reduce((r, a) =>

    // let date = data.created_at;

    // let date_created = [date].reduce((acc, cur) => {
    //     return {
    //         date: new Date(Date.parse(cur)),
    //     };
    // }, {});

    // console.log(date_created);

    // let date_created_at = date_created.date.toLocaleString("id-ID", {
    //     day: "numeric",
    //     month: "long",
    //     year: "numeric",
    // });

    // console.log(date_created_at);

    let channel = parseInt(localStorage.getItem("channel"));

    if (channel == data.id_channel) {
        socket.emit("unread_chat", data.id_user, (e) => {
            // if (e !== null) {
            //     e.forEach((val) => {
            //         let id_channel = data.id_channel;
            //         $(`#${id_channel}`)
            //             .find(".unread-message")
            //             .removeClass("hidden")
            //             .text(val.count);
            //     });
            // }
        });

        $("#list-message").append(html);
        autoScroll();
    }
});

// Forum - Showing List Post Forum
socket.on("post_created", (data) => {
    console.log("From received", data);

    let html = "";

    if (data.id_user == user_id) {
        is_admin = badge_admin;
    } else {
        is_admin = "";
    }

    let status;
    if (data.status.includes("Penting") && data.status.includes("TL")) {
        status = status_penting + status_tl;
    } else if (data.status.includes("Penting")) {
        status = status_penting;
    } else if (data.status.includes("TL")) {
        status = status_tl;
    } else {
        status = "";
    }

    // console.log(data.attachment);

    if (data.attachment !== null) {
        for (let i = 0; i < data.attachment.length; i++) {
            let icon_attchment = "";
            if (data.attachment[i].type == "image/png") {
                icon_attchment = icon_created_post_png;
            } else if (data.attachment[i].type == "image/jpeg") {
                icon_attchment = icon_created_post_jpg;
            } else if (data.attachment[i].type == "image/jpg") {
                icon_attchment = icon_created_post_jpg;
            } else if (data.attachment[i].type == "application/pdf") {
                icon_attchment = icon_created_post_pdf;
            } else if (
                data.attachment[i].type ==
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
            ) {
                icon_attchment = icon_created_post_doc;
            }

            if (data != "" || data != null || data != undefined) {
                html += `

                                    <div
                                        class="bg-slate-50 group active_postingan py-4 px-5 rounded-[15px] flex flex-col mt-2 cursor-pointer" onclick="select_postingan(${
                                            data.id
                                        })">

                                        <div class="flex flex-rows pt-1 pb-2">

                                            <div class="">
                                                <span
                                                    class="bg-gray-200 active_postingan_badge max-w-[9rem] text-gray-800 tracking-wide text-xs font-medium inline-flex items-center px-1.5 py-1.5 rounded-[20px] mr-2">

                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                                                        class="w-3.5 h-3.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18"></path>
                                                    </svg>

                                                </span>
                                            </div>

                                                ${status}

                                        </div>

                                        <div class="grid grid-cols-1 font-bold opacity-[0.5] text-[15pt]">
                                            ${data.title}
                                            </div>
                                        <div
                                            class="grid grid-cols-1 text-sm text-gray-500 tracking-wide text-justify pt-1 pb-2 teks_post max-h-10">
                                            <p class="truncate">
                                            ${data.body}
                                            </p>
                                        </div>
                                        ${icon_attchment}


                                        <div class="grid grid-cols-1 text-xs text-gray-500">
                                            <div class="inline-flex">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z">
                                                        </path>
                                                    </svg>
                                                </span>
                                                <span class="px-1">
                                                    ${data.total_response}
                                                </span>
                                                <span class="flex items-center">
                                                    <img class="w-3 h-3" src="/assets/dots.png" alt="">
                                                </span>
                                                <span class="px-1 text-[13px]">
                                                    ${moment(
                                                        data.created_at.slice(
                                                            0,
                                                            -1
                                                        ),
                                                        "YYYY-MM-DD HH:mm:ss"
                                                    )
                                                        .locale("id")
                                                        .fromNow()}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
            `;
            }
        }
    } else {
        if (data != "" || data != null || data != undefined) {
            html += `

                                    <div
                                        class="bg-slate-50 group active_postingan py-4 px-5 rounded-[15px] flex flex-col mt-2 cursor-pointer" onclick="select_postingan(${
                                            data.id
                                        })">

                                        <div class="flex flex-rows pt-1 pb-2">

                                            <div class="">
                                                <span
                                                    class="bg-gray-200 active_postingan_badge max-w-[9rem] text-gray-800 tracking-wide text-xs font-medium inline-flex items-center px-1.5 py-1.5 rounded-[20px] mr-2">

                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                                                        class="w-3.5 h-3.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18"></path>
                                                    </svg>

                                                </span>
                                            </div>

                                                ${status}

                                        </div>

                                        <div class="grid grid-cols-1 font-bold opacity-[0.5] text-[15pt]">
                                            ${data.title}
                                            </div>
                                        <div
                                            class="grid grid-cols-1 text-sm text-gray-500 tracking-wide text-justify pt-1 pb-2 teks_post max-h-10">
                                            <p class="truncate">
                                            ${data.body}
                                            </p>
                                        </div>

                                        <div class="grid grid-cols-1 text-xs text-gray-500">
                                            <div class="inline-flex">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z">
                                                        </path>
                                                    </svg>
                                                </span>
                                                <span class="px-1">
                                                    ${data.total_response}
                                                </span>
                                                <span class="flex items-center">
                                                    <img class="w-3 h-3" src="/assets/dots.png" alt="">
                                                </span>
                                                <span class="px-1 text-[13px]">
                                                    ${moment(
                                                        data.created_at.slice(
                                                            0,
                                                            -1
                                                        ),
                                                        "YYYY-MM-DD HH:mm:ss"
                                                    )
                                                        .locale("id")
                                                        .fromNow()}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
            `;
        }
    }

    let channel = parseInt(localStorage.getItem("channel"));

    if (channel == data.id_channel) {
        $("#list-created-post").prepend(html);
        autoScrollPost();
        //Count New Post
        socket.emit("unread_post", user_id, (e) => {
            // console.log("Data".e);
        });
    }
});

//Forum - Show List Post
const select_postingan = (id_post) => {
    $(".show_list_post").removeClass("grid-cols-11");
    $(".show_list_post").addClass("grid-cols-2");

    $(".show_list_post_child_one").removeClass("col-span-2");
    $(".show_list_post_child_one").addClass("col-span-1");

    $(".show_list_post_child_two").removeClass("col-span-9");
    $(".show_list_post_child_two").addClass("col-span-1");

    $(".custom_tl_ml").addClass("-ml-[1.7vw]");

    $(".show_list_post_span").removeClass("col-span-2");
    $(".show_list_post_span").removeClass("col-span-2");

    // mengshow thread right
    $(".thread_right").removeClass("hidden");

    $(".forum_thread ").removeClass("grid-cols-1");
    $(".forum_thread ").addClass("grid-cols-2");

    $(".post_thread_judul").removeClass("box_post_thread_show");
    $(".post_thread_status").removeClass("box_status_thread_show");

    // forum - show thread right
    $(".add_border").addClass("border-b-2 border-gray-200");
    $(".input_postingan").removeClass("hidden");

    $(".post_thread_judul").addClass("box_post_thread");
    $(".post_thread_status").addClass("box_status_thread");

    let channel = parseInt(localStorage.getItem("channel"));

    // console.log(id_post, channel);

    // Menampilkan detail post
    socket.emit("find_post", id_post, channel, (e) => {
        // console.log(e);

        let id_respon_post = e.id;
        localStorage.setItem("id_post", id_respon_post);

        let status;
        if (e.status.includes("Penting") && e.status.includes("TL")) {
            status = status_penting + status_tl;
        } else if (e.status.includes("Penting")) {
            status = status_penting;
        } else if (e.status.includes("TL")) {
            status = status_tl;
        } else {
            status = "";
        }

        // console.log(e.attachment.type);
        if (e.attachment !== null) {
            for (let i = 0; i < e.attachment.length; i++) {
                // console.log(e.attachment[i].name);
                let name_file = e.attachment[i].name;
                if (e.attachment[i].type == "image/png") {
                    icon_attchment = icon_created_post_png;
                } else if (e.attachment[i].type == "image/jpeg") {
                    icon_attchment = icon_created_post_jpg;
                } else if (e.attachment[i].type == "image/jpg") {
                    icon_attchment = icon_created_post_jpg;
                } else if (e.attachment[i].type == "application/pdf") {
                    icon_attchment = icon_created_post_pdf;
                } else if (
                    e.attachment[i].type ==
                    "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                ) {
                    icon_attchment = icon_created_post_doc;
                }

                let html = "";

                html += `
                                                    <div class="w-full h-full bg-slate-50 pt-3 pb-1 flex flex-col">
                                                            <div
                                                                class="font-bold opacity-[0.5] text-[15pt] px-3.5 pb-3 tracking-wide leading-[1.2rem]">
                                                                ${e.title}
                                                            </div>

                                                            <div class="flex flex-rows px-3.5">

                                                            ${status}

                                                            </div>

                                                            <div
                                                                class="w-full bg-gray-100 hover:bg-gray-100 hover:rounded-lg">

                                                                <div class="flex justify-start w-full">

                                                                    <div
                                                                        class="px-1 bg-slate-50 w-full h-full">

                                                                        <div class="flex flex-row px-3 py-2">

                                                                            <div
                                                                                class="w-[3.1rem] h-10 grid items-center">
                                                                                <img class="w-8 h-8 rounded-full"
                                                                                    src="/assets/gambar/user.png"
                                                                                    alt="">
                                                                            </div>

                                                                            <div class="flex flex-col w-full">
                                                                                <div class="container_replay_box">

                                                                                    <div class="replay_box">
                                                                                        <div
                                                                                            class="flex flex-rows items-center">

                                                                                            <div class="maks_username">
                                                                                                <p class="truncate">
                                                                                                    ${
                                                                                                        e
                                                                                                            .user
                                                                                                            .name
                                                                                                    }
                                                                                                </p>
                                                                                            </div>

                                                                                            <div
                                                                                                class="ml-1 text-[11px] text-gray-500">
                                                                                                    ${time(
                                                                                                        e.created_at
                                                                                                    )} Wib
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="container_btn_replay">

                                                                                        <div class="position_container_btn"
                                                                                            style="display: none;">

                                                                                            <div class="container_btn">

                                                                                                <div class="btn_reply group"
                                                                                                    data-tooltip-target="balas-postingan">
                                                                                                    <i style="font-size: 18px;"
                                                                                                        class="fa fa-reply mx-2 w-4 h-4 text-gray-700 group-hover:text-black"
                                                                                                        aria-hidden="true">
                                                                                                    </i>

                                                                                                    <div id="balas-postingan"
                                                                                                        role="tooltip"
                                                                                                        class="inline-block absolute z-10 py-1 px-2 text-[12px] font-medium text-gray-900 bg-white rounded-lg border border-gray-200 shadow-sm tooltip opacity-0 invisible"
                                                                                                        style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(453.6px, -200px, 0px);"
                                                                                                        data-popper-placement="top">
                                                                                                        Balas
                                                                                                        <div class="tooltip-arrow"
                                                                                                            data-popper-arrow=""
                                                                                                            style="position: absolute; left: 0px; transform: translate3d(20px, 0px, 0px);">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>


                                                                                                <div onclick=""
                                                                                                    class="w-full h-full grid content-center group hover:bg-gray-200 hover:rounded-r-[5px]"
                                                                                                    data-tooltip-target="hapus">

                                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                        fill="none"
                                                                                                        viewBox="0 0 24 24"
                                                                                                        stroke-width="2.5"
                                                                                                        stroke="currentColor"
                                                                                                        class="w-5 h-5 text-gray-700 group-hover:text-black mx-2">
                                                                                                        <path
                                                                                                            stroke-linecap="round"
                                                                                                            stroke-linejoin="round"
                                                                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                                                                                        </path>
                                                                                                    </svg>

                                                                                                    <div id="hapus"
                                                                                                        role="tooltip"
                                                                                                        class="inline-block absolute z-10 py-1 px-2 text-[12px] font-medium text-gray-900 bg-white rounded-lg border border-gray-200 shadow-sm tooltip opacity-0 invisible"
                                                                                                        style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(490.4px, 240px, 0px);"
                                                                                                        data-popper-placement="top">
                                                                                                        Hapus
                                                                                                        <div class="tooltip-arrow"
                                                                                                            data-popper-arrow=""
                                                                                                            style="position: absolute; left: 0px; transform: translate3d(22.4px, 0px, 0px);">
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                                <div
                                                                                    class="w-full text-sm text-gray-500 font-normal tracking-wide break-words scrollbar max-w-[23rem] pb-1">
                                                                                    <p>
                                                                                        ${
                                                                                            e.body
                                                                                        }
                                                                                    </p>
                                                                                </div>
                                                                                <div class="grdi grid-cols-1 cursor-pointer" onclick="previewFile('${name_file}')">
                                                                                    ${icon_attchment}
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                </div>`;

                // sendpostRespon(id_respon_post);

                $("#judul-postingan-thread").html(html);
            }
        } else {
            let html = "";

            html += `
                                                    <div class="w-full h-full bg-slate-50 pt-3 pb-1 flex flex-col">
                                                            <div
                                                                class="font-bold opacity-[0.5] text-[15pt] px-3.5 pb-3 tracking-wide leading-[1.2rem]">
                                                                ${e.title}
                                                            </div>

                                                            <div class="flex flex-rows px-3.5">

                                                            ${status}

                                                            </div>

                                                            <div
                                                                class="w-full bg-gray-100 hover:bg-gray-100 hover:rounded-lg">

                                                                <div class="flex justify-start w-full">

                                                                    <div
                                                                        class="px-1 bg-slate-50 w-full h-full">

                                                                        <div class="flex flex-row px-3 py-2">

                                                                            <div
                                                                                class="w-[3.1rem] h-10 grid items-center">
                                                                                <img class="w-8 h-8 rounded-full"
                                                                                    src="/assets/gambar/user.png"
                                                                                    alt="">
                                                                            </div>

                                                                            <div class="flex flex-col w-full">
                                                                                <div class="container_replay_box">

                                                                                    <div class="replay_box">
                                                                                        <div
                                                                                            class="flex flex-rows items-center">

                                                                                            <div class="maks_username">
                                                                                                <p class="truncate">
                                                                                                    ${
                                                                                                        e
                                                                                                            .user
                                                                                                            .name
                                                                                                    }
                                                                                                </p>
                                                                                            </div>

                                                                                            <div
                                                                                                class="ml-1 text-[11px] text-gray-500">
                                                                                                    ${time(
                                                                                                        e.created_at
                                                                                                    )} Wib
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="container_btn_replay">

                                                                                        <div class="position_container_btn"
                                                                                            style="display: none;">

                                                                                            <div class="container_btn">

                                                                                                <div class="btn_reply group"
                                                                                                    data-tooltip-target="balas-postingan">
                                                                                                    <i style="font-size: 18px;"
                                                                                                        class="fa fa-reply mx-2 w-4 h-4 text-gray-700 group-hover:text-black"
                                                                                                        aria-hidden="true">
                                                                                                    </i>

                                                                                                    <div id="balas-postingan"
                                                                                                        role="tooltip"
                                                                                                        class="inline-block absolute z-10 py-1 px-2 text-[12px] font-medium text-gray-900 bg-white rounded-lg border border-gray-200 shadow-sm tooltip opacity-0 invisible"
                                                                                                        style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(453.6px, -200px, 0px);"
                                                                                                        data-popper-placement="top">
                                                                                                        Balas
                                                                                                        <div class="tooltip-arrow"
                                                                                                            data-popper-arrow=""
                                                                                                            style="position: absolute; left: 0px; transform: translate3d(20px, 0px, 0px);">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>


                                                                                                <div onclick=""
                                                                                                    class="w-full h-full grid content-center group hover:bg-gray-200 hover:rounded-r-[5px]"
                                                                                                    data-tooltip-target="hapus">

                                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                        fill="none"
                                                                                                        viewBox="0 0 24 24"
                                                                                                        stroke-width="2.5"
                                                                                                        stroke="currentColor"
                                                                                                        class="w-5 h-5 text-gray-700 group-hover:text-black mx-2">
                                                                                                        <path
                                                                                                            stroke-linecap="round"
                                                                                                            stroke-linejoin="round"
                                                                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                                                                                        </path>
                                                                                                    </svg>

                                                                                                    <div id="hapus"
                                                                                                        role="tooltip"
                                                                                                        class="inline-block absolute z-10 py-1 px-2 text-[12px] font-medium text-gray-900 bg-white rounded-lg border border-gray-200 shadow-sm tooltip opacity-0 invisible"
                                                                                                        style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(490.4px, 240px, 0px);"
                                                                                                        data-popper-placement="top">
                                                                                                        Hapus
                                                                                                        <div class="tooltip-arrow"
                                                                                                            data-popper-arrow=""
                                                                                                            style="position: absolute; left: 0px; transform: translate3d(22.4px, 0px, 0px);">
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                                <div
                                                                                    class="w-full text-sm text-gray-500 font-normal tracking-wide break-words scrollbar max-w-[23rem] pb-1">
                                                                                    <p>
                                                                                        ${
                                                                                            e.body
                                                                                        }
                                                                                    </p>
                                                                                </div>
                                                                                <div class="grdi grid-cols-1 cursor-pointer hidden" onclick="previewFile('')">
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                </div>`;

            $("#judul-postingan-thread").html(html);
        }
    });

    // menampilkan konten detail post
    // Param 1 = 17 (as a id_post)
    // Param 2 = 1 (as a id_channel)
    socket.emit("show_response", id_post, channel, (e) => {
        // socket.emit("show_response", 152, 3, (e) => {
        // console.log(e);

        let html = "";

        if (e !== null) {
            let detil_post = e.reduce((r, a) => {
                r[a.id] = [...(r[a.id] || []), a];
                return r;
            }, {});

            for (let key in detil_post) {
                if (key.length > 0) {
                    detil_post[key].forEach((dt) => {
                        // console.log(dt.message);

                        if (dt.message != "") {
                            html += `
                                <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg">

                                                                <div class="flex justify-start w-full cursor-pointer">

                                                                    <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">

                                                                        <div class="flex flex-row px-3 py-2">

                                                                            <div class="w-[3.1rem] h-10 grid items-center">
                                                                                <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                                                            </div>

                                                                            <div class="flex flex-col w-full">
                                                                                <div class="container_replay_box">

                                                                                    <div class="replay_box">
                                                                                        <div class="flex flex-rows items-center">

                                                                                            <div class="maks_username">
                                                                                                <p class="truncate">
                                                                                                ${
                                                                                                    dt
                                                                                                        .user
                                                                                                        .name
                                                                                                }
                                                                                                </p>
                                                                                            </div>

                                                                                            <div class="ml-1 text-[11px] text-gray-500">
                                                                                                        ${time(
                                                                                                            dt.created_at
                                                                                                        )} Wib
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="container_btn_replay">

                                                                                        <div class="position_container_btn" style="display: none;">

                                                                                            <div class="container_btn">

                                                                                                <div class="btn_reply group" data-tooltip-target="balas-postingan">
                                                                                                    <i style="font-size: 18px;" class="fa fa-reply mx-2 w-4 h-4 text-gray-700 group-hover:text-black" aria-hidden="true">
                                                                                                    </i>

                                                                                                    <div id="balas-postingan" role="tooltip" class="inline-block absolute z-10 py-1 px-2 text-[12px] font-medium text-gray-900 bg-white rounded-lg border border-gray-200 shadow-sm tooltip opacity-0 invisible" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(453.6px, -200px, 0px);" data-popper-placement="top">
                                                                                                        Balas
                                                                                                        <div class="tooltip-arrow" data-popper-arrow="" style="position: absolute; left: 0px; transform: translate3d(20px, 0px, 0px);">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>


                                                                                                <div onclick="" class="w-full h-full grid content-center group hover:bg-gray-200 hover:rounded-r-[5px]" data-tooltip-target="hapus">

                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 text-gray-700 group-hover:text-black mx-2">
                                                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                                                                                        </path>
                                                                                                    </svg>

                                                                                                    <div id="hapus" role="tooltip" class="inline-block absolute z-10 py-1 px-2 text-[12px] font-medium text-gray-900 bg-white rounded-lg border border-gray-200 shadow-sm tooltip opacity-0 invisible" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(490.4px, 240px, 0px);" data-popper-placement="top">
                                                                                                        Hapus
                                                                                                        <div class="tooltip-arrow" data-popper-arrow="" style="position: absolute; left: 0px; transform: translate3d(22.4px, 0px, 0px);">
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                                <div class="w-full text-sm text-gray-500 font-normal tracking-wide break-words scrollbar max-w-[60rem]">
                                                                                    <p>${
                                                                                        dt.message
                                                                                    }</p>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                        `;
                        } else if (dt.message == "") {
                            if (dt.attachment != null) {
                                for (let i = 0; i < dt.attachment.length; i++) {
                                    if (dt.attachment[i].type == "image/png") {
                                        html += `
                                            <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg">
                                            <div class="flex justify-start w-full cursor-pointer">
                                                <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                                    <div class="flex flex-row px-3 py-2">
                                                        <div class="w-[3.1rem] h-10 grid items-center">
                                                            <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                                        </div>
                                                        <div class="flex flex-col w-full">
                                                            <div class="container_replay_box">
                                                                <div class="replay_box">
                                                                    <div class="flex flex-rows items-center">
                                                                        <div class="maks_username">
                                                                            <p class="truncate">
                                                                                ${
                                                                                    dt
                                                                                        .user
                                                                                        .name
                                                                                }
                                                                            </p>
                                                                        </div>
                                                                        <div class="ml-1 text-[11px] text-gray-500">
                                                                                ${time(
                                                                                    dt.created_at
                                                                                )} Wib
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="w-[12vw] h-[4rem] my-1 " onclick="previewFile('${
                                                                dt.attachment[i]
                                                                    .name
                                                            }')">
                                                                <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                                    <div class="basis-2/12">
                                                                        <div class="h-full grid place-content-center">
                                                                            <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                                src=" /assets/pngnew.png" alt="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="basis-10/12">
                                                                        <div class="h-full grid content-center">
                                                                            <div
                                                                                class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                                <p class="truncate">
                                                                                    ${
                                                                                        dt
                                                                                            .attachment[
                                                                                            i
                                                                                        ]
                                                                                            .name
                                                                                    }
                                                                                </p>
                                                                                <span class="text-gray-500 text-xs">

                                                                                        ${formatBytes(
                                                                                            dt
                                                                                                .attachment[
                                                                                                i
                                                                                            ]
                                                                                                .size
                                                                                        )}

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
                                                </div>`;
                                    } else if (
                                        dt.attachment[i].type == "image/jpg"
                                    ) {
                                        html += `
                                                    <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg">
                                                    <div class="flex justify-start w-full cursor-pointer">
                                                        <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                                            <div class="flex flex-row px-3 py-2">
                                                                <div class="w-[3.1rem] h-10 grid items-center">
                                                                    <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                                                </div>
                                                                <div class="flex flex-col w-full">
                                                                    <div class="container_replay_box">
                                                                        <div class="replay_box">
                                                                            <div class="flex flex-rows items-center">
                                                                                <div class="maks_username">
                                                                                    <p class="truncate">
                                                                                        ${
                                                                                            dt
                                                                                                .user
                                                                                                .name
                                                                                        }
                                                                                    </p>
                                                                                </div>
                                                                                <div class="ml-1 text-[11px] text-gray-500">
                                                                                        ${time(
                                                                                            dt.created_at
                                                                                        )} Wib
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="w-[12vw] h-[4rem] my-1" onclick="previewFile('${
                                                                        dt
                                                                            .attachment[
                                                                            i
                                                                        ].name
                                                                    }')">
                                                                        <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                                            <div class="basis-2/12">
                                                                                <div class="h-full grid place-content-center">
                                                                                    <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                                        src="/assets/jpgnew.png" alt="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="basis-10/12">
                                                                                <div class="h-full grid content-center">
                                                                                    <div
                                                                                        class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                                        <p class="truncate">
                                                                                            ${
                                                                                                dt
                                                                                                    .attachment[
                                                                                                    i
                                                                                                ]
                                                                                                    .name
                                                                                            }
                                                                                        </p>
                                                                                        <span class="text-gray-500 text-xs">

                                                                                                ${formatBytes(
                                                                                                    dt
                                                                                                        .attachment[
                                                                                                        i
                                                                                                    ]
                                                                                                        .size
                                                                                                )}

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
                                                </div>`;
                                    } else if (
                                        dt.attachment[i].type == "image/jpeg"
                                    ) {
                                        html += `
                                                    <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg">
                                                    <div class="flex justify-start w-full cursor-pointer">
                                                        <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                                            <div class="flex flex-row px-3 py-2">
                                                                <div class="w-[3.1rem] h-10 grid items-center">
                                                                    <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                                                </div>
                                                                <div class="flex flex-col w-full">
                                                                    <div class="container_replay_box">
                                                                        <div class="replay_box">
                                                                            <div class="flex flex-rows items-center">
                                                                                <div class="maks_username">
                                                                                    <p class="truncate">
                                                                                        ${
                                                                                            dt
                                                                                                .user
                                                                                                .name
                                                                                        }
                                                                                    </p>
                                                                                </div>
                                                                                <div class="ml-1 text-[11px] text-gray-500">
                                                                                        ${time(
                                                                                            dt.created_at
                                                                                        )} Wib
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="w-[12vw] h-[4rem] my-1 " onclick="previewFile('${
                                                                        dt
                                                                            .attachment[
                                                                            i
                                                                        ].name
                                                                    }')">
                                                                        <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                                            <div class="basis-2/12">
                                                                                <div class="h-full grid place-content-center">
                                                                                    <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                                        src="/assets/jpgnew.png" alt="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="basis-10/12">
                                                                                <div class="h-full grid content-center">
                                                                                    <div
                                                                                        class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                                        <p class="truncate">
                                                                                            ${
                                                                                                dt
                                                                                                    .attachment[
                                                                                                    i
                                                                                                ]
                                                                                                    .name
                                                                                            }
                                                                                        </p>
                                                                                        <span class="text-gray-500 text-xs">

                                                                                                ${formatBytes(
                                                                                                    dt
                                                                                                        .attachment[
                                                                                                        i
                                                                                                    ]
                                                                                                        .size
                                                                                                )}

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
                                                </div>`;
                                    } else if (
                                        dt.attachment[i].type ==
                                        "application/pdf"
                                    ) {
                                        html += `
                                                    <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg">
                                                    <div class="flex justify-start w-full cursor-pointer">
                                                        <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                                            <div class="flex flex-row px-3 py-2">
                                                                <div class="w-[3.1rem] h-10 grid items-center">
                                                                    <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                                                </div>
                                                                <div class="flex flex-col w-full">
                                                                    <div class="container_replay_box">
                                                                        <div class="replay_box">
                                                                            <div class="flex flex-rows items-center">
                                                                                <div class="maks_username">
                                                                                    <p class="truncate">
                                                                                        ${
                                                                                            dt
                                                                                                .user
                                                                                                .name
                                                                                        }
                                                                                    </p>
                                                                                </div>
                                                                                <div class="ml-1 text-[11px] text-gray-500">
                                                                                        ${time(
                                                                                            dt.created_at
                                                                                        )} Wib
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="w-[12vw] h-[4rem] my-1 " onclick="previewFile('${
                                                                        dt
                                                                            .attachment[
                                                                            i
                                                                        ].name
                                                                    }')">
                                                                        <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                                            <div class="basis-2/12">
                                                                                <div class="h-full grid place-content-center">
                                                                                    <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                                        src="/assets/pdfnew.png" alt="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="basis-10/12">
                                                                                <div class="h-full grid content-center">
                                                                                    <div
                                                                                        class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                                        <p class="truncate">
                                                                                            ${
                                                                                                dt
                                                                                                    .attachment[
                                                                                                    i
                                                                                                ]
                                                                                                    .name
                                                                                            }
                                                                                        </p>
                                                                                        <span class="text-gray-500 text-xs">

                                                                                                ${formatBytes(
                                                                                                    dt
                                                                                                        .attachment[
                                                                                                        i
                                                                                                    ]
                                                                                                        .size
                                                                                                )}

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
                                                </div>`;
                                    } else if (
                                        dt.attachment[i].type ==
                                        "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                    ) {
                                        html += `
                                                    <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg">
                                                    <div class="flex justify-start w-full cursor-pointer">
                                                        <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">
                                                            <div class="flex flex-row px-3 py-2">
                                                                <div class="w-[3.1rem] h-10 grid items-center">
                                                                    <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                                                </div>
                                                                <div class="flex flex-col w-full">
                                                                    <div class="container_replay_box">
                                                                        <div class="replay_box">
                                                                            <div class="flex flex-rows items-center">
                                                                                <div class="maks_username">
                                                                                    <p class="truncate">
                                                                                        ${
                                                                                            dt
                                                                                                .user
                                                                                                .name
                                                                                        }
                                                                                    </p>
                                                                                </div>
                                                                                <div class="ml-1 text-[11px] text-gray-500">
                                                                                        ${time(
                                                                                            dt.created_at
                                                                                        )} Wib
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="w-[12vw] h-[4rem] my-1 " onclick="previewFile('${
                                                                        dt
                                                                            .attachment[
                                                                            i
                                                                        ].name
                                                                    }')">
                                                                        <div class="flex flex-row h-full bg-gray-300 rounded-[7px]">
                                                                            <div class="basis-2/12">
                                                                                <div class="h-full grid place-content-center">
                                                                                    <img class="max-w-[2.7rem] max-h-[2.7rem]"
                                                                                        src="/assets/docnew.png" alt="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="basis-10/12">
                                                                                <div class="h-full grid content-center">
                                                                                    <div
                                                                                        class="text-sm text-gray-500 font-normal tracking-wide break-words max-w-[8vw]">
                                                                                        <p class="truncate">
                                                                                            ${
                                                                                                dt
                                                                                                    .attachment[
                                                                                                    i
                                                                                                ]
                                                                                                    .name
                                                                                            }
                                                                                        </p>
                                                                                        <span class="text-gray-500 text-xs">

                                                                                                ${formatBytes(
                                                                                                    dt
                                                                                                        .attachment[
                                                                                                        i
                                                                                                    ]
                                                                                                        .size
                                                                                                )}

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
                                                </div>`;
                                    }
                                }
                            }
                        }
                    });
                }
            }
        }

        $("#pesan-postingan-thread").html("");
        $("#pesan-postingan-thread").html(html);
    });
};

// Kanal - Send Message Diskusi Umum
$("#sendPost").submit((e) => {
    e.preventDefault();

    let message_respon = $("#message_respon_post").val();
    let cl = parseInt(localStorage.getItem("channel"));
    let ps = parseInt(localStorage.getItem("id_post"));

    let data = {
        id_user: user_id,
        id_channel: cl,
        id_post: ps,
        id_reply: 3,
        attachment: [],
        message: message_respon,
    };

    socket.emit("send_response", data);

    // console.log(data);

    $("#message_respon_post").val("");
});

socket.on("response_received", (data) => {
    // console.log(data.id_post);

    let html = "";

    if (data.message != "") {
        html = `
                        <div class="w-full group bg-gray-100 hover:bg-gray-100 hover:rounded-lg ">

                                                                <div class="flex justify-start w-full cursor-pointer">

                                                                    <div class="px-1 bg-slate-50 w-full h-full group-hover:bg-gray-200">

                                                                        <div class="flex flex-row px-3 py-2">

                                                                            <div class="w-[3.1rem] h-10 grid items-center">
                                                                                <img class="w-8 h-8 rounded-full" src="/assets/gambar/user.png" alt="">
                                                                            </div>

                                                                            <div class="flex flex-col w-full">
                                                                                <div class="container_replay_box">

                                                                                    <div class="replay_box">
                                                                                        <div class="flex flex-rows items-center">

                                                                                            <div class="maks_username">
                                                                                                <p class="truncate">
                                                                                                ${
                                                                                                    data
                                                                                                        .user
                                                                                                        .name
                                                                                                }
                                                                                                </p>
                                                                                            </div>

                                                                                            <div class="ml-1 text-[11px] text-gray-500">
                                                                                                        ${time(
                                                                                                            data.created_at
                                                                                                        )} Wib
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="container_btn_replay">

                                                                                        <div class="position_container_btn" style="display: none;">

                                                                                            <div class="container_btn">

                                                                                                <div class="btn_reply group" data-tooltip-target="balas-postingan">
                                                                                                    <i style="font-size: 18px;" class="fa fa-reply mx-2 w-4 h-4 text-gray-700 group-hover:text-black" aria-hidden="true">
                                                                                                    </i>

                                                                                                    <div id="balas-postingan" role="tooltip" class="inline-block absolute z-10 py-1 px-2 text-[12px] font-medium text-gray-900 bg-white rounded-lg border border-gray-200 shadow-sm tooltip opacity-0 invisible" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(453.6px, -200px, 0px);" data-popper-placement="top">
                                                                                                        Balas
                                                                                                        <div class="tooltip-arrow" data-popper-arrow="" style="position: absolute; left: 0px; transform: translate3d(20px, 0px, 0px);">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div onclick="" class="w-full h-full grid content-center group hover:bg-gray-200 hover:rounded-r-[5px]" data-tooltip-target="hapus">

                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 text-gray-700 group-hover:text-black mx-2">
                                                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                                                                                        </path>
                                                                                                    </svg>

                                                                                                    <div id="hapus" role="tooltip" class="inline-block absolute z-10 py-1 px-2 text-[12px] font-medium text-gray-900 bg-white rounded-lg border border-gray-200 shadow-sm tooltip opacity-0 invisible" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(490.4px, 240px, 0px);" data-popper-placement="top">
                                                                                                        Hapus
                                                                                                        <div class="tooltip-arrow" data-popper-arrow="" style="position: absolute; left: 0px; transform: translate3d(22.4px, 0px, 0px);">
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                                <div class="w-full text-sm text-gray-500 font-normal tracking-wide break-words scrollbar max-w-[60rem]">
                                                                                    <p>${
                                                                                        data.message
                                                                                    }</p>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                        `;
    }

    let id_post = parseInt(localStorage.getItem("id_post"));

    // console.log(id_post);

    if (id_post == data.id_post) {
        autoScrollPost();
        $("#pesan-postingan-thread").append(html);
    }
});

const hide_show_thread = () => {
    $(".thread_right").addClass("hidden");
    $(".forum_thread ").removeClass("grid-cols-2");
    $(".forum_thread ").addClass("grid-cols-1");
};

function adjustHeight(title_post_created) {
    title_post_created.style.height = "";
    title_post_created.style.height = title_post_created.scrollHeight + "px";
}
