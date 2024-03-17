// const { remove } = require("lodash");

const sum = (accumulator, a) => {
    return accumulator + a;
};

const logout = () => {
    $("#form-logout").submit();
};

var dataTable;

var select2Init = function () {
    // $("#selectOptionRekap").select2({
    //     dropdownAutoWidth: true,
    //     allowClear: true,
    //     placeholder: "Pilih Kelurahan",
    // });
    $("#selectOptionRekap").select2();
    $("#kegiatan").select2({
        dropdownParent: $("#modalAddUsers"),
        placeholder: "Pilih Kegiatan",
    });
    $("#sektor_list").select2({
        dropdownParent: $("#modalAddUsers"),
        placeholder: "Pilih Kegiatan",
    });
    $("#kegiatanEdit").select2({
        dropdownParent: $("#modalEditUsers"),
        placeholder: "Pilih Kegiatan",
    });
    $("#sektor_list_edit").select2({
        dropdownParent: $("#modalEditUsers"),
        placeholder: "Pilih Kegiatan",
    });

    var selectOptionRekap = document.getElementById("selectOptionRekap");

    if (selectOptionRekap) {
        selectOptionRekap = selectOptionRekap.value;

        localStorage.setItem("getKelurahan", selectOptionRekap);

        var kel = localStorage.getItem("getKelurahan");

        $("#PrintKinerja").attr("href", `/v1/dashboard/Ekspor-Kinerja/${kel}`);
    }

    // console.log(kel);
};

var dataTableInit = function () {
    dataTable = $(".data-kinerja").dataTable({
        retrieve: true,
        columnDefs: [
            {
                targets: 1,
                type: "num",
            },
        ],
    });
};

var dtSearchInit = function () {
    $("#selectOptionRekap").change(function () {
        var kel = $("#selectOptionRekap").val();

        // console.log(kel);

        $("#PrintKinerja").attr("href", `/v1/dashboard/Ekspor-Kinerja/${kel}`);

        dtSearchAction($(this), 1);
    });
};

dtSearchAction = function (selector, columnId) {
    var fv = selector.val();
    if (fv == "" || fv == null) {
        dataTable.api().column(columnId).search("", true, false).draw();
    } else {
        dataTable.api().column(columnId).search(fv, true, false).draw();
    }
};

$(document).ready(function () {
    select2Init();
    dataTableInit();
    dtSearchInit();
});

const editUser = (id, name, email, role) => {
    $("#idUser").val("");
    $("#namaUser").val("");
    $("#emailUser").val("");
    $("#roleUser").val("");

    $("#idUser").val(id);
    $("#namaUser").val(name);
    $("#emailUser").val(email);
    $("#roleUser").val(role);
};

const editPegawai = (
    id,
    name,
    email,
    penempatan,
    kegiatan,
    role,
    jabatan,
    sektor,
    allowed,
    status_pegawai
) => {
    let kegiatan_data = JSON.parse(atob(kegiatan));
    let kegiatan_list = [];
    let sektor_data = atob(sektor)
        .replace(/\{/g, "")
        .replace(/\}/g, "")
        .split(",");
    console.log(sektor_data);

    kegiatan_data.forEach((e) => {
        kegiatan_list.push(e.id_kegiatan);
    });

    $("#idUser").val("");
    $("#nameUser").val("");
    $("#emailUser").val("");
    $("#penempatanUser").val("");
    $("#kegiatanEdit").select2("val", "");
    $("#roleUser").val("");
    $("#allowedUser").val("");
    $("#statusPegawaiUser").val("");

    $("#idUser").val(id);
    $("#nameUser").val(name);
    $("#emailUser").val(email);
    $("#penempatanUser").val(penempatan);
    $("#kegiatanEdit").val(kegiatan_list).trigger("change");
    $("#sektor_list_edit").val(sektor_data).trigger("change");
    $("#roleUser").val(role);
    $("#jabatanUser").val(jabatan);
    $("#allowedUser").val(allowed);
    $("#statusPegawaiUser").val(status_pegawai);
};

let url = document.URL;
let arrURL = url.split("/");

// console.log(arrURL);

if (arrURL[4] == "kinerja") {
    $("#selectSurveyer").val(0).trigger("change");
}

// Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Nunito"),
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

const number_format = (number, decimals, dec_point, thousands_sep) => {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + "").replace(",", "").replace(" ", "");
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
        dec = typeof dec_point === "undefined" ? "." : dec_point,
        s = "",
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return "" + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || "").length < prec) {
        s[1] = s[1] || "";
        s[1] += new Array(prec - s[1].length + 1).join("0");
    }
    return s.join(dec);
};

function dataTebaruRealtime() {
    $.ajax({
        url: `/v1/dashboard/fetch-surveyer`,
        method: "GET",
        dataType: "json",

        beforeSend: function () {
            $("#name").html(
                '<div class="skeleton-heading name_pengawasan_lingkungan"></div>'
            );
            $("#judul").html('<div class="skeleton-heading"></div>');
            $("#kategori").html('<div class="skeleton-heading"></div>');
            $("#deskripsi").html('<div class="skeleton-heading"></div>');
            $("#permasalahan").html('<div class="skeleton-heading"></div>');
            $("#solusi").html('<div class="skeleton-heading"></div>');

            $("#gambar_utama").html(
                ' <div class="img_parents skeleton-image"></div>'
            );
            $("#photo_ajib").html(
                '<div style="width: 3rem; height:3.5rem;" class="skeleton-image">'
            );
            $("#penempatan").html(
                '<div class="skeleton-heading w-full penempatan_pengawasan_lingkungan"></div>'
            );
        },

        success: function (e) {
            // console.log(e.surveyer);
            $.each(e.surveyer, function (key, data) {
                // console.log(data.avatar);
                // $("#id_user").html(data.id);
                $("#name").html(data.name);
                $("#judul").html(data.judul);
                $("#kategori").html(data.kategori);

                $("#penempatan").html(
                    "<div class='name_ajib_lingkungan_mobile' style='margin-top: 0.4rem;'>AJIB " +
                        data.penempatan.substr(19) +
                        "</div>"
                );

                // if (data.kelurahan != null) {
                //     $("#kelurahan_ajib").html(
                //         data.kelurahan.charAt(0).toUpperCase() +
                //             data.kelurahan.slice(1).toLowerCase()
                //     );
                // } else {
                //     $("#kelurahan_ajib").html(data.kelurahan);
                // }

                if (data.catatan != null) {
                    $("#deskripsi").html(
                        data.catatan.charAt(0).toUpperCase() +
                            data.catatan.slice(1).toLowerCase()
                    );
                } else {
                    $("#deskripsi").html(data.catatan);
                }

                if (data.permasalahan != null) {
                    $("#permasalahan").html(
                        data.permasalahan.charAt(0).toUpperCase() +
                            data.permasalahan.slice(1).toLowerCase()
                    );
                } else {
                    $("#permasalahan").html(data.permasalahan);
                }

                $("#solusi").html(data.solusi);

                $(".gambar_utama_slider_input2").html(
                    '<img class="img_slide_dashboard" src="https://jakarta.pintoinvest.com/mobile/img/' +
                        data.foto +
                        '" /> '
                );

                $("#photo_ajib").html(
                    '<span><img style="width: 3rem; height:3.5rem; border-radius: 5px;" src="https://jakarta.pintoinvest.com/v1/photo_ajib/' +
                        data.avatar +
                        '") }}" alt="Petugas Ajib" /></span>'
                );
                selectOption(".gambar_utama_slider_input2");

                // new
                // $("#photo_ajib").html(
                //     '<span class="avatar" "><img style="border-radius:10px" src="https://jakarta.pintoinvest.com/v1/photo_ajib/' +
                //         data.name +
                //         '.jpg") }}" alt="Petugas Ajib" /></span>'
                // );

                // const koor_kelurahan = data.kordinat;
                // getAjibKelurahan(koor_kelurahan);
            });
        },
    });
}

$(document).ready(function () {
    $(".img_child_id").on("click", function () {
        $("#photo_ajib").hide();
        $("#gambar_utama").hide();

        var id_data_terbaru = $(this).attr("data-id");
        // $id_new = id_data_terbaru;
        // console.log($id_new);

        $.ajax({
            // data: { id: $id_new },
            url: `/v1/dashboard/data-terbaru/${id_data_terbaru}`,
            type: "get",
            dataType: "json",
            beforeSend: function () {
                $("#name").html(
                    '<div class="skeleton-heading name_pengawasan_lingkungan"></div>'
                );
                $("#judul").html('<div class="skeleton-heading"></div>');
                $("#kategori").html('<div class="skeleton-heading"></div>');
                $("#deskripsi").html('<div class="skeleton-heading"></div>');
                $("#permasalahan").html('<div class="skeleton-heading"></div>');
                $("#solusi").html('<div class="skeleton-heading"></div>');
                $("#gambar_utama2").html(
                    ' <div class="img_parents skeleton-image"></div>'
                );
                $("#photo_ajib2").html(
                    '<div style="width: 3rem; height:3.5rem;" class="skeleton-image">'
                );
                $("#penempatan").html(
                    '<div style="margin-top:-0.7rem;" class="skeleton-heading penempatan_pengawasan_lingkungan w-full"></div>'
                );
            },
            success: function (e) {
                // console.log(e.terbaru);
                $.each(e.terbaru, function (key, data) {
                    // $("#id_user").html(data.id);
                    $("#name").html(data.name);
                    $("#judul").html(data.judul);
                    $("#kategori").html(data.kategori);

                    $("#penempatan").html(
                        "<div class='name_ajib_lingkungan_mobile' style='margin-top: 0.4rem;'>AJIB " +
                            data.penempatan.substr(19) +
                            "</div>"
                    );

                    // if (data.kelurahan != null) {
                    //     $("#kelurahan_ajib").html(
                    //         data.kelurahan.charAt(0).toUpperCase() +
                    //             data.kelurahan.slice(1).toLowerCase()
                    //     );
                    // } else {
                    //     $("#kelurahan_ajib").html(
                    //         "<span class='badge bg-danger'>Koordinat tidak tepat</span>"
                    //     );
                    // }

                    if (data.catatan != null) {
                        $("#deskripsi").html(
                            data.catatan.charAt(0).toUpperCase() +
                                data.catatan.slice(1).toLowerCase()
                        );
                    } else {
                        $("#deskripsi").html(data.catatan);
                    }

                    if (data.permasalahan != null) {
                        $("#permasalahan").html(
                            data.permasalahan.charAt(0).toUpperCase() +
                                data.permasalahan.slice(1).toLowerCase()
                        );
                    } else {
                        $("#permasalahan").html(data.permasalahan);
                    }

                    $("#solusi").html(data.solusi);

                    $(".gambar_utama_slider_input2").html(
                        '<img class="img_slide_dashboard" src="https://jakarta.pintoinvest.com/mobile/img/' +
                            data.foto +
                            '" />'
                    );

                    // Ajib
                    // $("#photo_ajib2").html(
                    //     '<span class="avatar" "><img style="border-radius:10px" src="https://jakarta.pintoinvest.com/v1/photo_ajib/' +
                    //         data.name +
                    //         '.jpg") }}" alt="Petugas Ajib" /></span>'
                    // );
                    $("#photo_ajib2").html(
                        '<span><img style="width: 3rem; height:3.5rem; border-radius: 5px;" src="https://jakarta.pintoinvest.com/v1/photo_ajib/' +
                            data.avatar +
                            '") }}" alt="Petugas Ajib" /></span>'
                    );
                    selectOption(".gambar_utama_slider_input2");

                    // const koor_kelurahan = data.kordinat;
                    // getAjibKelurahan(koor_kelurahan);
                });
            },
        });
    });
});

const selectOption = (name) => {
    $(name).slick({
        slidesToShow: 1,
        variableWidth: true,
        slidesToScroll: 1,
        infinite: false,
        arrows: true,
        // prevArrow: '<button class="slide-arrow prev-arrow"></button>',
        // nextArrow: '<button class="slide-arrow next-arrow"></button>',
    });
};

function dataTebaruPerkembangan() {
    $(".atur_margin_gambar_utama").removeClass("atur_margin_gambar_utama2");

    $.ajax({
        url: `/v1/dashboard/fetch-perkembangan`,
        method: "GET",
        dataType: "json",

        beforeSend: function () {
            $("#name_perkembangan").html(
                '<div class="skeleton-heading"></div>'
            );

            $("#penempatan_perkembangan").html(
                '<div style="margin-top:-0.7rem;" class="skeleton-heading"></div>'
            );

            $("#kordinat").html('<div class="skeleton-heading"></div>');
            $("#name").html('<div class="skeleton-heading"></div>');
            $("#namesurvey").html('<div class="skeleton-heading"></div>');
            $("#id_sub_blok").html('<div class="skeleton-heading"></div>');
            $("#kelurahan").html('<div class="skeleton-heading"></div>');
            $("#kecamatan").html('<div class="skeleton-heading"></div>');
            $("#regional").html('<div class="skeleton-heading"></div>');
            $("#deskripsi_regional").html(
                '<div class="skeleton-heading"></div>'
            );
            $("#neighborhood").html('<div class="skeleton-heading"></div>');
            $("#deskripsi_neighborhood").html(
                '<div class="skeleton-heading"></div>'
            );
            $("#transect_zone").html('<div class="skeleton-heading"></div>');
            $("#deskripsi_transect_zone").html(
                '<div class="skeleton-heading"></div>'
            );
            $("#gambar_utama_perkembangan").html(
                ' <div style="object-fit: cover;" class="skeleton-image"></div>'
            );
            $("#photo_ajib_perkembangan").html(
                '<div style="width: 3rem; height:3.5rem;" class="skeleton-image">'
            );
        },

        success: function (e) {
            // console.log(e.perkembangan);

            let data = e.perkembangan[0];

            // $.each(e.perkembangan, function (key, data) {
            // console.log(e.perkembangan[0]);

            $("#name_perkembangan").html(data.user.name);
            $("#namesurvey").html(data.name);

            let text3 = String(data.kecamatan);
            let result3 = kapital(text3);

            function kapital(str) {
                return str.replace(/\w\S*/g, function (txt) {
                    return (
                        txt.charAt(0).toUpperCase() +
                        txt.substr(1).toLowerCase()
                    );
                });
            }

            $("#penempatan_perkembangan").html(
                "<div'>AJIB " + result3 + "</div>"
            );

            $("#kordinat").html(
                `<a class="font-weight-bold" style="text-decoration:none;" href="https://www.google.com/maps/search/%09${data.kordinat}" target="_blank">${data.kordinat}</a>`
            );

            $("#id_sub_blok").html(data.id_sub_blok);

            let text = String(data.kelurahan);
            let result = kapital(text);

            function kapital(str) {
                return str.replace(/\w\S*/g, function (txt) {
                    return (
                        txt.charAt(0).toUpperCase() +
                        txt.substr(1).toLowerCase()
                    );
                });
            }

            $("#kelurahan").html(result);

            let text2 = String(data.kecamatan);
            let result2 = kapital(text2);

            function kapital(str) {
                return str.replace(/\w\S*/g, function (txt) {
                    return (
                        txt.charAt(0).toUpperCase() +
                        txt.substr(1).toLowerCase()
                    );
                });
            }

            $("#kecamatan").html(result2);

            $("#regional").html(data.regional);
            $("#deskripsi_regional").html(data.deskripsi_regional);
            $("#neighborhood").html(data.neighborhood);
            $("#deskripsi_neighborhood").html(data.deskripsi_neighborhood);
            $("#transect_zone").html(data.transect_zone);
            $("#deskripsi_transect_zone").html(data.deskripsi_transect_zone);

            // console.log(data.image[0].name);

            $("#photo_ajib_perkembangan").html(
                '<span><img style="width: 3rem; height:3.5rem; border-radius: 5px;" src="https://jakarta.pintoinvest.com/v1/photo_ajib/' +
                    data.user.avatar +
                    '") }}" alt="Petugas Ajib" /></span>'
            );

            // $(".gambar_utama_slider_input").html(
            //     '<img class="img_parents" style="border-radius:5px;" src="https://jakarta.pintoinvest.com/survey/' +
            //         data.name +
            //         '" /> '
            // );
            // console.log(data.image);

            array = data.image;

            var datagambar = "";
            if (array.length == 0) {
                datagambar += `<div><img class="" src="https://jakarta.pintoinvest.com/v1/survey/not_image.png" alt="First slide"></div>`;
            } else {
                array.forEach((e) => {
                    datagambar += `<div><img class="" src="https://jakarta.pintoinvest.com/v1/survey/${e.name}" alt="First slide"></div>`;
                });
            }
            // console.log(array);

            $(".gambar_utama_slider_input").html(datagambar);
            selectOption(".gambar_utama_slider_input");

            // });
        },
    });
}

$(document).ready(function () {
    $(".img_child_id_perkembangan").on("click", function () {
        var id_data_terbaru = $(this).attr("data-id");

        $.ajax({
            url: `/v1/dashboard/perkembangan-terbaru/${id_data_terbaru}`,
            type: "get",
            dataType: "json",
            beforeSend: function () {
                $("#name_perkembangan").html(
                    '<div class="skeleton-heading"></div>'
                );
                $("#namesurvey").html('<div class="skeleton-heading"></div>');

                $("#penempatan_perkembangan").html(
                    '<div style="margin-top:-0.7rem;" class="skeleton-heading"></div>'
                );

                $("#kordinat").html('<div class="skeleton-heading"></div>');
                $("#id_sub_blok").html('<div class="skeleton-heading"></div>');
                $("#kelurahan").html('<div class="skeleton-heading"></div>');
                $("#kecamatan").html('<div class="skeleton-heading"></div>');
                $("#regional").html('<div class="skeleton-heading"></div>');
                $("#deskripsi_regional").html(
                    '<div class="skeleton-heading"></div>'
                );
                $("#neighborhood").html('<div class="skeleton-heading"></div>');
                $("#deskripsi_neighborhood").html(
                    '<div class="skeleton-heading"></div>'
                );
                $("#transect_zone").html(
                    '<div class="skeleton-heading"></div>'
                );
                $("#deskripsi_transect_zone").html(
                    '<div class="skeleton-heading"></div>'
                );

                $("#gambar_utama_perkembangan").html(
                    ' <div style="object-fit: cover;" class="skeleton-image"></div>'
                );
                $("#photo_ajib_perkembangan").html(
                    '<div style="width: 3rem; height:3.5rem;" class="skeleton-image">'
                );

                // $("#gambar_utama_perkembangan2").html(
                //     ' <div class="img_parents skeleton-image"></div>'
                // );

                // $("#photo_ajib_perkembangan2").html(
                //     '<div style="width: 3rem; height:3.5rem;" class="skeleton-image">'
                // );
            },
            success: function (e) {
                // console.log(e.perkembangan);
                let data = e.perkembangan;

                // console.log(data.image.name.length == 0);

                $("#name_perkembangan").html(data.user.name);

                // $("#penempatan_perkembangan").html(
                //     "<div'>AJIB " + data.kecamatan + "</div>"
                // );

                let text3 = String(data.kecamatan);
                let result3 = kapital(text3);

                function kapital(str) {
                    return str.replace(/\w\S*/g, function (txt) {
                        return (
                            txt.charAt(0).toUpperCase() +
                            txt.substr(1).toLowerCase()
                        );
                    });
                }

                $("#penempatan_perkembangan").html(
                    "<div'>AJIB " + result3 + "</div>"
                );

                $("#kordinat").html(
                    `<a class="font-weight-bold" href="https://www.google.com/maps/search/%09${data.kordinat}" target="_blank">${data.kordinat}</a>`
                );

                $("#id_sub_blok").html(data.id_sub_blok);
                $("#namesurvey").html(data.name);

                let text = String(data.kelurahan);
                let result = kapital(text);

                function kapital(str) {
                    return str.replace(/\w\S*/g, function (txt) {
                        return (
                            txt.charAt(0).toUpperCase() +
                            txt.substr(1).toLowerCase()
                        );
                    });
                }

                $("#kelurahan").html(result);

                let text2 = String(data.kecamatan);
                let result2 = kapital(text2);

                function kapital(str) {
                    return str.replace(/\w\S*/g, function (txt) {
                        return (
                            txt.charAt(0).toUpperCase() +
                            txt.substr(1).toLowerCase()
                        );
                    });
                }

                $("#kecamatan").html(result2);

                $("#regional").html(data.regional);
                $("#deskripsi_regional").html(data.deskripsi_regional);
                $("#neighborhood").html(data.neighborhood);
                $("#deskripsi_neighborhood").html(data.deskripsi_neighborhood);
                $("#transect_zone").html(data.transect_zone);
                $("#deskripsi_transect_zone").html(
                    data.deskripsi_transect_zone
                );

                // console.log(data.image[0].name);
                // console.log(data.image[1].name);
                // console.log(data.image[2].name);

                array = data.image;

                var datagambar = "";
                if (array.length == 0) {
                    datagambar += `<div><img class="" src="https://jakarta.pintoinvest.com/v1/survey/not_image.png" alt="First slide"></div>`;
                } else {
                    array.forEach((e) => {
                        datagambar += `<div><img class="" src="https://jakarta.pintoinvest.com/v1/survey/${e.name}" alt="First slide"></div>`;
                    });
                }

                // console.log(array.length);
                if (array.length > 1) {
                    $(".gambar_utama_slider_input ").removeClass(
                        "atur_margin_gambar_utama"
                    );
                    $(".gambar_utama_slider_input ").removeClass(
                        "atur_margin_gambar_utama2"
                    );
                    $(".gambar_utama_slider_input ").addClass(
                        "atur_margin_gambar_utama2"
                    );
                } else {
                    $(".gambar_utama_slider_input ").removeClass(
                        "atur_margin_gambar_utama"
                    );
                    $(".gambar_utama_slider_input ").removeClass(
                        "atur_margin_gambar_utama2"
                    );
                    $(".gambar_utama_slider_input ").addClass(
                        "atur_margin_gambar_utama"
                    );
                }

                // console.log(datagambar);

                if (
                    $(
                        "div.gambar_utama_slider_input.slick-initialized.slick-slider"
                    ).length == 0
                ) {
                    $(".gambar_utama_slider_input").html("");
                    $(".gambar_utama_slider_input").html(datagambar);
                    selectOption(".gambar_utama_slider_input");
                } else {
                    $(".gambar_utama_slider_input").slick("unslick");
                    $(".gambar_utama_slider_input").html("");
                    $(".gambar_utama_slider_input").html(datagambar);
                    selectOption(".gambar_utama_slider_input");
                }

                $("#photo_ajib_perkembangan").html(
                    '<span><img style="width: 3rem; height:3.5rem; border-radius: 5px;" src="https://jakarta.pintoinvest.com/v1/photo_ajib/' +
                        data.user.avatar +
                        '") }}" alt="Petugas Ajib" /></span>'
                );
            },
        });
    });
});

// const selectSlideFoto = (name2) => {
//     $(name2).slick({
//         slidesToShow: 5,
//         slidesToScroll: 1,
//         // asNavFor: ".gambar_utama_slider_input",
//         infinite: false,
//         arrows: true,
//     });
// };

// function slideFoto() {
//     $.ajax({
//         url: `/dashboard/slide-foto`,
//         type: "get",
//         dataType: "json",
//         beforeSend: function () {},
//         success: function (e) {
//             var datagambar = "";
//             $.each(e.slide_foto, function (key, data) {
//                 array = data.name;

//                 if (array.length == 0) {
//                     datagambar += `<div><img class="img_parents" style="width:490px !important;height: 300px; object-fit: cover;" src="https://jakarta.pintoinvest.com/v1/survey/not_image.png" alt="First slide"></div>`;
//                 } else {
//                     datagambar += `<div><img class="img_parents" style="width:490px !important;height: 300px; object-fit: cover;" src="https://jakarta.pintoinvest.com/survey/${data.name}" alt="First slide"></div>`;
//                 }
//             });

//             console.log(datagambar);

//             if (
//                 $("div.image_slider_input.slick-initialized.slick-slider")
//                     .length == 0
//             ) {
//                 $(".image_slider_input").html("");
//                 $(".image_slider_input").html(datagambar);
//                 selectSlideFoto(".image_slider_input");
//             } else {
//                 $(".image_slider_input").slick("unslick");
//                 $(".image_slider_input").html("");
//                 $(".image_slider_input").html(datagambar);
//                 selectSlideFoto(".image_slider_input");
//             }
//         },
//     });
// }

function getAjibKelurahan(koor_kelurahan) {
    var coord = koor_kelurahan.split(",");
    // console.log(coord);

    $.ajax({
        url: `https://jakarta.pintoinvest.com:3000/wilayah/${coord[1]}/${coord[0]}`,
        method: "GET",
        // success: function (e) {
        //     const dt = JSON.parse(e);
        //     console.log(dt);
        // },
        beforeSend: function () {
            $("#kelurahan_ajib").html(
                '<div style="margin-top: 0.4rem;" class="skeleton-heading"></div>'
            );
        },
        success: function (dt) {
            const dtResp = JSON.parse(dt);

            const prop = dtResp.features[0].properties;

            if (dtResp.features != null) {
                // $("#kelurahan_ajib").html(`${prop.Kelurahan}`);
                $("#kelurahan_ajib").html(
                    "<div style='margin-top: 0.4rem;'>AJIB " +
                        prop.Kelurahan.charAt(0).toUpperCase() +
                        prop.Kelurahan.slice(1).toLowerCase() +
                        "</div>"
                );
            }
        },
    });
}

// Area Chart Example

// const filterJakpintas = (periode) => {
//     $.ajax({
//         url: `/analytics/auth_log/${periode - 1}`,
//         method: "GET",
//         success: (e) => {
//             // let get_jakpintas = e;
//             // // filterAnalytics(get_jakpintas);
//             // // console.log(get_jakpintas);
//             // return get_jakpintas;
//             return e;
//         },
//     });
// };

const filterAnalytics = (periode) => {
    let jumlah_hari = periode === 6 ? 7 : periode;
    let fix_periode;
    if (periode == 6) {
        fix_periode = 6;
    } else if (periode == 30) {
        fix_periode = 30 - 1;
    } else {
        fix_periode = 90 - 1;
    }

    function updateDisplay(jumlah_hari) {
        if (jumlah_hari == 7) {
            $(".tujuh_hari").hide();
            $(".tigapuluh_hari").show();
            $(".sembilanpuluh_hari").show();
        } else if (jumlah_hari == 30) {
            $(".tujuh_hari").show();
            $(".tigapuluh_hari").hide();
            $(".sembilanpuluh_hari").show();
        } else if (jumlah_hari == 90) {
            $(".tujuh_hari").show();
            $(".tigapuluh_hari").show();
            $(".sembilanpuluh_hari").hide();
        }

        $(".jumlah_hari").text(jumlah_hari);
        localStorage.setItem("interval", periode);
    }

    $.ajax({
        url: `/v1/analytics/${fix_periode}`,
        method: "GET",
        // beforeSend: function () {
        //     $(".skeleton_chart").html(
        //         '<div class="uk_chart_skeleton skeleton-image"></div>'
        //     );
        // },
        success: (e) => {
            updateDisplay(jumlah_hari);

            let get_analytics = e;
            // console.log("analytics", get_analytics);
            // console.log("analytic", fix_periode);

            $.ajax({
                url: `/v1/analytics/auth_log/${periode}`,
                method: "GET",
                success: (e) => {
                    let get_jakpintas = e;
                    // console.log("jakpintas", get_jakpintas);

                    // console.log("internal", fix_periode);

                    const label_analytics = get_analytics.tanggal;
                    const data_analytics = get_analytics.jumlah;

                    const label_jakpintas = get_jakpintas[0];
                    const data_jakpintas = get_jakpintas[1];

                    // console.log(label_analytics, data_analytics);

                    let filtered_label_analytics = [];
                    let filtered_data_analytics = [];

                    for (let i = 0; i < data_analytics.length; i++) {
                        if (data_analytics[i] !== 0) {
                            filtered_label_analytics.push(label_analytics[i]);
                            filtered_data_analytics.push(data_analytics[i]);
                        }
                    }

                    // console.log(label_jakpintas, data_jakpintas);
                    // console.log(
                    //     filtered_label_analytics,
                    //     filtered_data_analytics
                    // );

                    var ctx =
                        document.getElementsByClassName("chart-pengunjung");

                    if (window.myLineChart) {
                        window.myLineChart.destroy();
                    }

                    window.myLineChart = new Chart(ctx, {
                        type: "line",
                        data: {
                            labels: label_jakpintas,
                            datasets: [
                                {
                                    label: "Google Analytics",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    pointHoverBorderColor:
                                        "rgba(78, 115, 223, 1)",
                                    borderColor: "blue",
                                    pointRadius: 3,
                                    pointBackgroundColor:
                                        "rgba(78, 115, 223, 1)",
                                    pointBorderColor: "rgba(78, 115, 223, 1)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor:
                                        "rgba(78, 115, 223, 1)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    fill: false,
                                    data: filtered_data_analytics,
                                },
                                {
                                    label: "Log Internal",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(223, 78, 78, 0.05)",
                                    borderColor: "red",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgb(223, 78, 78)",
                                    pointBorderColor: "rgb(223, 97, 78)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor:
                                        "rgb(223, 78, 78)",
                                    pointHoverBorderColor: "rgb(223, 78, 78)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    fill: false,
                                    data: data_jakpintas,
                                },
                            ],
                        },
                        options: {
                            tooltips: {
                                backgroundColor: "#FAFAFA",
                                // borderColor: "#206bc4",
                                borderWidth: 1,
                                titleFontColor: "black",
                                titleFontStyle: "normal",
                                displayColors: false,
                                bodyFontColor: "black",
                            },

                            maintainAspectRatio: false,
                            layout: {
                                padding: {
                                    left: 0,
                                    right: 0,
                                    top: 0,
                                    bottom: 0,
                                },
                            },
                            scales: {
                                xAxes: [
                                    {
                                        time: {
                                            unit: "date",
                                        },
                                        gridLines: {
                                            display: false,
                                            drawBorder: false,
                                        },
                                        ticks: {
                                            // maxTicksLimit: 7,
                                            display: false,
                                        },
                                    },
                                ],
                                yAxes: [
                                    {
                                        ticks: {
                                            beginAtZero: true,
                                            stepSize: 10,
                                            // maxTicksLimit: 5,
                                            // padding: 10,
                                            // // Include a dollar sign in the ticks
                                            // callback: function (value, index, values) {
                                            //     return number_format(value);
                                            // },
                                        },
                                        gridLines: {
                                            color: "rgb(234, 236, 244)",
                                            zeroLineColor: "rgb(234, 236, 244)",
                                            drawBorder: false,
                                            borderDash: [2],
                                            zeroLineBorderDash: [2],
                                        },
                                    },
                                ],
                            },
                            legend: {
                                labels: {
                                    // usePointStyle: true,
                                    boxWidth: 12,
                                    fontColor: "black",
                                },
                                display: true,
                                position: "bottom",
                            },
                        },
                    });
                },
            });

            $(".skeleton-image").hide();
        },
    });
};

// $.ajax({
//     url: `/analytics/6`,
//     method: "GET",
//     success: (e) => {
//         $(".inf-pengunjung").text(0);
//         $(".inf-pengunjung").text(e[1].reduce(sum, 0));
//     },
// });

// $.ajax({
//     url: `/analytics/0`,
//     method: "GET",
//     success: (e) => {
//         $(".inf-pengunjung-harian").text(0);
//         $(".inf-pengunjung-harian").text(e[1].reduce(sum, 0));
//     },
// });

if (arrURL[4] == undefined) {
    $(window).on("load", () => {
        filterAnalytics(6);
        // filterJakpintas(7);
    });

    setInterval(() => {
        filterAnalytics(localStorage.getItem("interval"));
        // 10 * 60 * 1000;
        // mnt * detik * ms
    }, 600000);
}

if (arrURL[5] == undefined) {
    $(window).on("load", () => {
        filterAnalytics(6);
    });

    setInterval(() => {
        filterAnalytics(localStorage.getItem("interval"));
        // 10 * 60 * 1000;
        // mnt * detik * ms
    }, 600000);
}

// Pendataan Usaha

// const pendataanUsha = (name) => {
//     $(name).slick({
//         slidesToShow: 1,
//         variableWidth: true,
//         slidesToScroll: 1,
//         infinite: false,
//         arrows: true,
//         // prevArrow: '<button class="slide-arrow prev-arrow"></button>',
//         // nextArrow: '<button class="slide-arrow next-arrow"></button>',
//     });
// };

function dataPendataanUsaha() {
    $.ajax({
        url: `/v1/dashboard/get-pendataan-usaha`,
        method: "GET",
        dataType: "json",

        beforeSend: function () {
            $("#photo_ajib_pendataan_usaha").html(
                '<div style="width: 3rem; height:3.5rem;" class="skeleton-image">'
            );

            $("#name_pendataan").html(
                '<div class="skeleton-heading name_pendataan"></div>'
            );

            $("#penempatan_pendataan").html(
                '<div class="skeleton-heading w-full penempatan_pendataan"></div>'
            );

            $("#no_perjanjian").html('<div class="skeleton-heading"></div>');
            $("#kordinat").html('<div class="skeleton-heading"></div>');
            $("#pelaku").html('<div class="skeleton-heading"></div>');
            $("#nama_usaha").html('<div class="skeleton-heading"></div>');
            $("#sektor").html('<div class="skeleton-heading"></div>');
            $("#modal").html('<div class="skeleton-heading"></div>');
            $("#jumlah_tenaga").html('<div class="skeleton-heading"></div>');
            $("#alamat").html('<div class="skeleton-heading"></div>');
            $("#id_sub_blok").html('<div class="skeleton-heading"></div>');
            $("#kelurahan").html('<div class="skeleton-heading"></div>');
            $("#kecamatan").html('<div class="skeleton-heading"></div>');
            $("#badan_usaha").html('<div class="skeleton-heading"></div>');
        },

        success: function (e) {
            let data = e.data_usaha[0];

            $("#pelaku").html(data.pelaku);

            $("#nama_usaha").html(data.nama_usaha);

            $("#kordinat").html(
                `<a class="font-weight-bold" style="text-decoration:none;" href="https://www.google.com/maps/search/%09${data.kordinat}" target="_blank">${data.kordinat}</a>`
            );

            $("#no_perjanjian").html(data.no_perjanjian);
            $("#sektor").html(data.sektor);
            $("#modal").html(data.modal);
            $("#jumlah_tenaga").html(data.jumlah_tenaga);
            $("#alamat").html(data.alamat);
            $("#id_sub_blok").html(data.id_sub_blok);

            let kel = String(data.kelurahan);
            let hasil_kelurahan = kapital(kel);

            function kapital(str) {
                return str.replace(/\w\S*/g, function (txt) {
                    return (
                        txt.charAt(0).toUpperCase() +
                        txt.substr(1).toLowerCase()
                    );
                });
            }

            $("#kelurahan").html(hasil_kelurahan);

            let kec = String(data.kecamatan);
            let hasil_kecamatan = kapital(kec);

            function kapital(str) {
                return str.replace(/\w\S*/g, function (txt) {
                    return (
                        txt.charAt(0).toUpperCase() +
                        txt.substr(1).toLowerCase()
                    );
                });
            }

            $("#kecamatan").html(hasil_kecamatan);

            $("#badan_usaha").html(data.badan_usaha);

            let text3 = String(data.kecamatan);
            let result3 = kapital(text3);

            function kapital(str) {
                return str.replace(/\w\S*/g, function (txt) {
                    return (
                        txt.charAt(0).toUpperCase() +
                        txt.substr(1).toLowerCase()
                    );
                });
            }
            $("#name_pendataan").html(data.user.name);
            $("#penempatan_pendataan").html(
                "<div class='name_ajib_pendataan_mobile' '>AJIB " +
                    result3 +
                    "</div>"
            );

            $("#photo_ajib_pendataan_usaha").html(
                '<span><img style="width: 3rem; height:3.5rem; border-radius: 5px; object-fit:cover;" src="https://jakarta.pintoinvest.com/v1/photo_ajib/' +
                    data.user.avatar +
                    '") }}" alt="Petugas Ajib" /></span>'
            );

            array = data.image;

            var datagambar = "";
            if (array.length == 0) {
                datagambar += `<div><img class="img_slide_pendataan" src="https://jakarta.pintoinvest.com/v1/usaha/not_image.png" alt="First slide"></div>`;
            } else {
                array.forEach((e) => {
                    datagambar += `<div><img class="img_slide_pendataan" src="https://jakarta.pintoinvest.com/v1/usaha/${e.name}" alt="First slide"></div>`;
                });
            }

            $(".slider_pendataan_usaha").html(datagambar);
            sliderPendataanUsaha(".slider_pendataan_usaha");
        },
    });
}

const sliderPendataanUsaha = (name) => {
    $(name).slick({
        slidesToShow: 1,
        variableWidth: true,
        slidesToScroll: 1,
        infinite: false,
        arrows: true,
        // prevArrow: '<button class="slide-arrow prev-arrow"></button>',
        // nextArrow: '<button class="slide-arrow next-arrow"></button>',
    });
};

$(document).ready(function () {
    $(".id_slider_pendataan").on("click", function () {
        var id_pendataan = $(this).attr("data-id");

        // console.log(id_pendataan);

        $.ajax({
            url: `/v1/dashboard/slider-pendataan/${id_pendataan}`,
            type: "get",
            dataType: "json",
            // beforeSend: function () {
            //     $("#name_perkembangan").html(
            //         '<div class="skeleton-heading"></div>'
            //     );
            //     $("#namesurvey").html('<div class="skeleton-heading"></div>');

            //     $("#penempatan_perkembangan").html(
            //         '<div style="margin-top:-0.7rem;" class="skeleton-heading"></div>'
            //     );

            //     $("#kordinat").html('<div class="skeleton-heading"></div>');
            //     $("#id_sub_blok").html('<div class="skeleton-heading"></div>');
            //     $("#kelurahan").html('<div class="skeleton-heading"></div>');
            //     $("#kecamatan").html('<div class="skeleton-heading"></div>');
            //     $("#regional").html('<div class="skeleton-heading"></div>');
            //     $("#deskripsi_regional").html(
            //         '<div class="skeleton-heading"></div>'
            //     );
            //     $("#neighborhood").html('<div class="skeleton-heading"></div>');
            //     $("#deskripsi_neighborhood").html(
            //         '<div class="skeleton-heading"></div>'
            //     );
            //     $("#transect_zone").html(
            //         '<div class="skeleton-heading"></div>'
            //     );
            //     $("#deskripsi_transect_zone").html(
            //         '<div class="skeleton-heading"></div>'
            //     );

            //     $("#gambar_utama_perkembangan").html(
            //         ' <div style="object-fit: cover;" class="skeleton-image"></div>'
            //     );
            //     $("#photo_ajib_perkembangan").html(
            //         '<div style="width: 3rem; height:3.5rem;" class="skeleton-image">'
            //     );
            // },
            success: function (e) {
                let data = e.data_slider_pendataan_usaha;

                // console.log(data);

                $("#pelaku").html(data.pelaku);

                $("#nama_usaha").html(data.nama_usaha);

                $("#kordinat").html(
                    `<a class="font-weight-bold" style="text-decoration:none;" href="https://www.google.com/maps/search/%09${data.kordinat}" target="_blank">${data.kordinat}</a>`
                );

                $("#no_perjanjian").html(data.no_perjanjian);
                $("#sektor").html(data.sektor);
                $("#modal").html(data.modal);
                $("#jumlah_tenaga").html(data.jumlah_tenaga);
                $("#alamat").html(data.alamat);
                $("#id_sub_blok").html(data.id_sub_blok);

                let kel = String(data.kelurahan);
                let hasil_kelurahan = kapital(kel);

                function kapital(str) {
                    return str.replace(/\w\S*/g, function (txt) {
                        return (
                            txt.charAt(0).toUpperCase() +
                            txt.substr(1).toLowerCase()
                        );
                    });
                }

                $("#kelurahan").html(hasil_kelurahan);

                let kec = String(data.kecamatan);
                let hasil_kecamatan = kapital(kec);

                function kapital(str) {
                    return str.replace(/\w\S*/g, function (txt) {
                        return (
                            txt.charAt(0).toUpperCase() +
                            txt.substr(1).toLowerCase()
                        );
                    });
                }

                $("#kecamatan").html(hasil_kecamatan);

                $("#badan_usaha").html(data.badan_usaha);

                let text3 = String(data.kecamatan);
                let result3 = kapital(text3);

                function kapital(str) {
                    return str.replace(/\w\S*/g, function (txt) {
                        return (
                            txt.charAt(0).toUpperCase() +
                            txt.substr(1).toLowerCase()
                        );
                    });
                }
                $("#name_pendataan").html(data.user.name);
                $("#penempatan_pendataan").html(
                    "<div class='name_ajib_pendataan_mobile''>AJIB " +
                        result3 +
                        "</div>"
                );

                $("#photo_ajib_pendataan_usaha").html(
                    '<span><img style="width: 3rem; height:3.5rem; border-radius: 5px; object-fit:cover;" src="https://jakarta.pintoinvest.com/v1/photo_ajib/' +
                        data.user.avatar +
                        '") }}" alt="Petugas Ajib" /></span>'
                );

                array = data.image;

                var datagambar = "";
                if (array.length == 0) {
                    datagambar += `<div><img class="img_slide_pendataan" src="https://jakarta.pintoinvest.com/v1/usaha/not_image.png" alt="First slide"></div>`;
                } else {
                    array.forEach((e) => {
                        datagambar += `<div><img class="img_slide_pendataan" src="https://jakarta.pintoinvest.com/v1/usaha/${e.name}" alt="First slide"></div>`;
                    });
                }

                $(".slider_pendataan_usaha").html(datagambar);
                sliderPendataanUsaha(".slider_pendataan_usaha");
            },
        });
    });
});

// Data Pengawasan
// function dataPengawasanDua() {
//     $(".atur_margin_gambar_utama").removeClass("atur_margin_gambar_utama2");

//     $.ajax({
//         url: `/dashboard/dataPengawasanDua`,
//         method: "GET",
//         dataType: "json",

//         beforeSend: function () {
//             $("#photo_avatar").html(
//                 '<div style="width: 3rem; height:3.5rem;" class="skeleton-image">'
//             );

//             $("#nama_pengawasan_dua").html(
//                 '<div class="skeleton-heading"></div>'
//             );

//             $("#jabatan_pengawasan_dua").html(
//                 '<div style="margin-top:-0.7rem;" class="skeleton-heading"></div>'
//             );

//             $("#judul_pengawasan").html('<div class="skeleton-heading"></div>');
//             $("#catatan_pengawasan").html(
//                 '<div class="skeleton-heading"></div>'
//             );
//             $("#kordinat_pengawasan").html(
//                 '<div class="skeleton-heading"></div>'
//             );
//             $("#kelurahan_pengawasan").html(
//                 '<div class="skeleton-heading"></div>'
//             );
//             $("#tipe_pengawasan").html('<div class="skeleton-heading"></div>');
//         },

//         success: function (e) {
//             // console.log(e.data_pengawasan);

//             let data = e.data_pengawasan[0];

//             // console.log(data.user);

//             $("#nama_pengawasan_dua").html(data.user.name);
//             $("#jabatan_pengawasan_dua").html(data.user.jabatan);
//             $("#judul_pengawasan").html(data.judul);
//             $("#tipe_pengawasan").html(data.tipe);
//             $("#catatan_pengawasan").html(data.catatan);

//             $("#kordinat_pengawasan").html(
//                 `<a class="font-weight-bold" style="text-decoration:none;" href="https://www.google.com/maps/search/%09${data.kordinat}" target="_blank">${data.kordinat}</a>`
//             );

//             let kec = String(data.kelurahan);
//             let dt_kel = kapital(kec);

//             function kapital(str) {
//                 return str.replace(/\w\S*/g, function (dt) {
//                     return (
//                         dt.charAt(0).toUpperCase() + dt.substr(1).toLowerCase()
//                     );
//                 });
//             }

//             $("#kelurahan_pengawasan").html(dt_kel);

//             $("#photo_avatar").html(
//                 '<span><img style="width: 3rem; height:3.5rem; border-radius: 5px;" src="https://jakarta.pintoinvest.com/v1/photo_ajib/' +
//                     data.user.avatar +
//                     '") }}" alt="Avatar" /></span>'
//             );

//             array = data.image;

//             var datagambar = "";
//             if (array.length == 0) {
//                 datagambar += `<div><img class="" src="https://jakarta.pintoinvest.com/v1/survey/not_image.png" alt="Foto Pengawasan"></div>`;
//             } else {
//                 array.forEach((e) => {
//                     datagambar += `<div><img class="" src="/publik/favorit/${e.name}" alt="Foto Pengawasan"></div>`;
//                 });
//             }

//             array.forEach((e) => {
//                 var img = new Image();
//                 img.src = "/publik/favorit/" + e.name;
//                 img.onload = function () {
//                     datagambar += `<div><img class="" src="/publik/favorit/${e.name}" alt="Pengawasan Tahap 2"></div>`;
//                 };
//                 img.onerror = function () {
//                     datagambar += `<div><img class="" src="https://jakarta.pintoinvest.com/v1/survey/not_image.png" alt="Pengawasan Tahap 2"></div>`;
//                 };
//             });

//             $(".gambar_utama_slider_pengawasan").html(datagambar);

//             selectOption(".gambar_utama_slider_pengawasan");
//         },
//     });

//     $(document).ready(function () {
//         $(".get_id_pengawasan").on("click", function () {
//             let id = $(this).attr("data-id");

//             $.ajax({
//                 url: `/dashboard/get-slider-pengawasan/${id}`,
//                 type: "get",
//                 dataType: "json",
//                 beforeSend: function () {
//                     $("#photo_avatar").html(
//                         '<div style="width: 3rem; height:3.5rem;" class="skeleton-image">'
//                     );
//                     $("#nama_pengawasan_dua").html(
//                         '<div class="skeleton-heading"></div>'
//                     );
//                     $("#jabatan_pengawasan_dua").html(
//                         '<div style="margin-top:-0.7rem;" class="skeleton-heading"></div>'
//                     );
//                     $("#judul_pengawasan").html(
//                         '<div class="skeleton-heading"></div>'
//                     );
//                     $("#catatan_pengawasan").html(
//                         '<div class="skeleton-heading"></div>'
//                     );
//                     $("#kordinat_pengawasan").html(
//                         '<div class="skeleton-heading"></div>'
//                     );
//                     $("#kelurahan_pengawasan").html(
//                         '<div class="skeleton-heading"></div>'
//                     );
//                     $("#tipe_pengawasan").html(
//                         '<div class="skeleton-heading"></div>'
//                     );
//                 },

//                 success: function (e) {
//                     let data = e.data_pengawasan;

//                     // console.log(data.user);

//                     // jika data user tidak ada

//                     if (data.user != null) {
//                         $("#nama_pengawasan_dua").html(data.user.name);
//                         $("#jabatan_pengawasan_dua").html(data.user.jabatan);
//                         $("#judul_pengawasan").html(data.judul);
//                         $("#tipe_pengawasan").html(data.tipe);
//                         $("#catatan_pengawasan").html(data.catatan);

//                         $("#kordinat_pengawasan").html(
//                             `<a class="font-weight-bold" style="text-decoration:none;" href="https://www.google.com/maps/search/%09${data.kordinat}" target="_blank">${data.kordinat}</a>`
//                         );

//                         let kec = String(data.kelurahan);
//                         let dt_kel = kapital(kec);

//                         function kapital(str) {
//                             return str.replace(/\w\S*/g, function (dt) {
//                                 return (
//                                     dt.charAt(0).toUpperCase() +
//                                     dt.substr(1).toLowerCase()
//                                 );
//                             });
//                         }

//                         $("#kelurahan_pengawasan").html(dt_kel);

//                         $("#photo_avatar").html(
//                             '<span><img style="width: 3rem; height:3.5rem; border-radius: 5px;" src="https://jakarta.pintoinvest.com/v1/photo_ajib/' +
//                                 data.user.avatar +
//                                 '") }}" alt="Avatar" /></span>'
//                         );

//                         array = data.image;

//                         var datagambar = "";
//                         if (array.length == 0) {
//                             datagambar += `<div><img class="" src="https://jakarta.pintoinvest.com/v1/survey/not_image.png" alt="Foto Pengawasan"></div>`;
//                         } else {
//                             array.forEach((e) => {
//                                 datagambar += `<div><img style="height: 26vw !important; width: 45vw !important; class="" src="/publik/favorit/${e.name}" alt="Foto Pengawasan"></div>`;
//                             });
//                         }

//                         array.forEach((e) => {
//                             var img = new Image();
//                             img.src = "/publik/favorit/" + e.name;
//                             img.onload = function () {
//                                 datagambar += `<div><img class="" src="/publik/favorit/${e.name}" alt="Pengawasan Tahap 2"></div>`;
//                             };
//                             img.onerror = function () {
//                                 datagambar += `<div><img class="" src="https://jakarta.pintoinvest.com/v1/survey/not_image.png" alt="Pengawasan Tahap 2"></div>`;
//                             };
//                         });

//                         $(".gambar_utama_slider_pengawasan").html(datagambar);

//                         selectOption(".gambar_utama_slider_pengawasan");
//                     } else {
//                         $("#nama_pengawasan_dua").html(
//                             "Data Pengguna Tidak Ada"
//                         );
//                         $("#jabatan_pengawasan_dua").html(
//                             "Data Pengguna Tidak Ada"
//                         );
//                         $("#judul_pengawasan").html("Data Pengguna Tidak Ada");
//                         $("#tipe_pengawasan").html("Data Pengguna Tidak Ada");
//                         $("#catatan_pengawasan").html(
//                             "Data Pengguna Tidak Ada"
//                         );

//                         $("#kordinat_pengawasan").html(
//                             "Data Pengguna Tidak Ada"
//                         );

//                         $("#kelurahan_pengawasan").html(
//                             "Data Pengguna Tidak Ada"
//                         );

//                         $("#photo_avatar").html(
//                             '<span><img style="width: 3rem; height:3.5rem; border-radius: 5px;" src="https://jakarta.pintoinvest.com/v1/photo_ajib/not_image.png") }}" alt="Avatar" /></span>'
//                         );

//                         array = data.image;

//                         var datagambar = "";
//                         if (array.length == 0) {
//                             datagambar += `<div><img class="" src="https://jakarta.pintoinvest.com/v1/survey/not_image.png" alt="First slide"></div>`;
//                         } else {
//                             array.forEach((e) => {
//                                 datagambar += `<div><img style="height: 26vw !important; width: 45vw !important; class="" src="/publik/favorit/${e.name}" alt="First slide"></div>`;
//                             });
//                         }

//                         $(".gambar_utama_slider_pengawasan").html(datagambar);

//                         selectOption(".gambar_utama_slider_pengawasan");
//                     }
//                 },
//             });
//         });
//     });

//     // get pdf pengawasan
//     // var select2InitPengawasan = function () {
//     //     select_option_pengawasan = document.getElementById(
//     //         "select_option_pengawasan"
//     //     ).value;

//     //     localStorage.setItem(
//     //         "getKelurahanPengawasan",
//     //         select_option_pengawasan
//     //     );

//     //     var kel = localStorage.getItem("getKelurahanPengawasan");
//     //     // console.log(kel);

//     //     $("#PrintKinerja").attr("href", `/dashboard/Ekspor-Kinerja/${kel}`);

//     //     // console.log(kel);
//     // };

//     // var dataTableInitPengawasan = function () {
//     //     dataTable = $(".data-pengawasan-dua").dataTable({
//     //         retrieve: true,
//     //         columnDefs: [
//     //             {
//     //                 targets: 1,
//     //                 type: "num",
//     //             },
//     //         ],
//     //     });
//     // };

//     // var dtSearchInitPengawasan = function () {
//     //     $("#select_option_pengawasan").change(function () {
//     //         var kel = $("#select_option_pengawasan").val();

//     //         // console.log(kel);

//     //         $("#PrintKinerja").attr("href", `/dashboard/Ekspor-Kinerja/${kel}`);

//     //         dtSearchActionPengawasan($(this), 1);
//     //     });
//     // };

//     // dtSearchActionPengawasan = function (selector, columnId) {
//     //     var fv = selector.val();
//     //     if (fv == "" || fv == null) {
//     //         dataTable.api().column(columnId).search("", true, false).draw();
//     //     } else {
//     //         dataTable.api().column(columnId).search(fv, true, false).draw();
//     //     }
//     // };

//     // $(document).ready(function () {
//     //     select2InitPengawasan();
//     //     dataTableInitPengawasan();
//     //     dtSearchInitPengawasan();
//     // });
// }
