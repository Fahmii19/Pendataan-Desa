let token_praper = `eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhcHBqYWtldm9wZW5nYXdhc2FuIiwiYXVkIjoicGVuZ2d1bmEiLCJpYXQiOjE2NzUwNjY1NzcsIm5iZiI6MTY3NTA2NjU3NywiZXhwIjoxNzA2NjAyNTc3LCJkYXRhIjp7InVzZXJuYW1lIjoiamFrZXZvLXBlbmdhd2FzYW4iLCJwYXNzd29yZCI6Iko0azN2byEhIn19.vnmKtXV5uG9_gtD0UA09-2jxNq7hC3S7m43pPkHsfT8`;

let url_praper = "https://dev.prapermohonan.dpmptsp-dki.com";

// Show info prapermohonan
$("#praPermohonan").on("click", () => {
    $(".info-pra-permohonan").show();
});

//close prapermohonan
$("#closePraPermohonan").on("click", () => {
    $(".info-pra-permohonan").hide();
});

// Submit prapermohonan
$("#formPraPermohonan").on("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    $("#tambah_dokumen_praper").hide();
    $("#prosesPraper").show();
    $.ajax({
        url: `${url_praper}/submit-irk-jakpintas`,
        type: "POST",
        data: formData,
        headers: {
            Authorization: `Bearer ${token_praper}`,
        },
        contentType: false,
        processData: false,
        success: function (response) {
            $("#messagePraperSuccess").show();

            $("#prosesPraper").hide();
            $("#tambah_dokumen_praper").show();

            setTimeout(() => {
                $("#messagePraperSuccess").hide();
            }, 3000);
        },
        error: function (error) {
            $("#prosesPraper").hide();
            $("#tambah_dokumen_praper").show();

            $("#messagePraperFailed").show();

            setTimeout(() => {
                $("#messagePraperFailed").hide();
            }, 3000);
        },
    });
});

// Trigger list fungsi bangunan
$("select[name='bangunan_jenis']")
    .on("change", (e) => {
        const jenis = e.target.value;
        const fungsi_bangunan = {
            hunian: [
                "Rumah Tinggal Tunggal",
                "Apartemen/Rumah Susun",
                "Perumahan Kluster",
                "Rumah Kost",
            ],
            "non-hunian": [
                "Keagamaan (Rumah Ibadah/Pesantren/Yayasan Keagamaan)",
                "Khusus (Nuklir/Pertanahan dan Keamanan)",
                "Pemerintahan - Sosial dan Budaya",
            ],
        };

        const list_fungsi_bangunan = fungsi_bangunan[jenis];

        let html = "";

        if (list_fungsi_bangunan !== undefined) {
            html += ` <select type="text" name="bangunan_fungsi" class="w-100"
        style="font-size: 13px; line-height:0px">`;

            list_fungsi_bangunan.forEach((item) => {
                html += `<option value="${item}">${item}</option>`;
            });

            html += `</select>`;

            $(".inf-prapermohonan-fungsi-bangunan").html(html);
        } else {
            html = `<input type="text" name="bangunan_fungsi" class="w-100"
        style="font-size: 13px; line-height:0px">`;
            $(".inf-prapermohonan-fungsi-bangunan").html(html);
        }
    })
    .trigger("change");

const kbli_list = () => {
    $(".inf-praper-list-kbli").append(`
        <div class="row mb-3">
            <div class="col-md-12 text-right">
                <button type="button" class="btn btn-sm text-danger"
                    style="font-size: 13px;"
                    onclick="remove_kbli(this.parentNode.parentNode)"><i
                        class="fa fa-trash"></i></button>
            </div>
            <div class="col-md-5">
                <label style="font-size: 13px; line-height:0px">Kode KBLI <sup
                        class="text-danger font-weight-bold">*</sup></label>
            </div>
            <div class="col-md-7">
                <input type="number" name="kbli_kode[]" class="w-100"
                    style="font-size: 13px; line-height:0px">
            </div>
            <div class="col-md-5">
                <label style="font-size: 13px; line-height:0px">Kegiatan <sup
                        class="text-danger font-weight-bold">*</sup></label>
            </div>
            <div class="col-md-7">
                <input type="text" name="kbli_kegiatan[]" class="w-100"
                    style="font-size: 13px; line-height:0px">
            </div>
            <div class="col-md-5">
                <label style="font-size: 13px; line-height:0px">Resiko <sup
                        class="text-danger font-weight-bold">*</sup></label>
            </div>
            <div class="col-md-7">
                <input type="text" name="kbli_kegiatan[]" class="w-100"
                    style="font-size: 13px; line-height:0px">
            </div>
            <div class="col-md-5">
                <label style="font-size: 13px; line-height:0px">Sektor <sup
                        class="text-danger font-weight-bold">*</sup></label>
            </div>
            <div class="col-md-7">
                <input type="text" name="kbli_sektor[]" class="w-100"
                    style="font-size: 13px; line-height:0px">
            </div>
        </div>
    `);
};

const remove_kbli = (e) => {
    if ($(".inf-praper-list-kbli").children().length > 1) {
        e.remove();
    }
};

// Hide/Show File IRK
$("input[name='irk']")
    .on("change", (e) => {
        let val = $("input[name='irk']:checked").val();

        if (val == "Ada") {
            $(".inf-praper-list-file-irk").show();
        } else {
            $(".inf-praper-list-file-irk").hide();
        }
    })
    .trigger("change");

// List File IRK
const irk_list = () => {
    $(".inf-praper-list-file-irk").append(`
    <div class="row my-2">
        <div class="col-md-12 text-right">
            <button type="button" class="btn btn-sm text-danger"
                style="font-size: 13px;"
                onclick="remove_irk(this.parentNode.parentNode)"><i
                    class="fa fa-trash"></i></button>
        </div>
        <div class="col-md-5">
            <label style="font-size: 13px; line-height:0px">Berkas IRK <sup
                    class="text-danger font-weight-bold">*</sup></label>
        </div>
        <div class="col-md-7">
            <input type="file" name="dokumen_url_dokumen_irk[]" class="w-100"
                style="font-size: 13px;">
        </div>
        <div class="col-md-5">
            <label style="font-size: 13px; line-height:0px">Nomor <sup
                    class="text-danger font-weight-bold">*</sup></label>
        </div>
        <div class="col-md-7">
            <input type="text" name="dokumen_nomor[]" class="w-100"
                style="font-size: 13px; line-height:0px">
        </div>
        <div class="col-md-5">
            <label style="font-size: 13px; line-height:0px">Nama <sup
                    class="text-danger font-weight-bold">*</sup></label>
        </div>
        <div class="col-md-7">
            <input type="text" name="dokumen_nama[]" class="w-100"
                style="font-size: 13px; line-height:0px">
        </div>
        <div class="col-md-5">
            <label style="font-size: 13px; line-height:0px">Tanggal <sup
                    class="text-danger font-weight-bold">*</sup></label>
        </div>
        <div class="col-md-7">
            <input type="text" name="dokumen_tanggal[]" class="w-100"
                style="font-size: 13px; line-height:0px">
        </div>
        <div class="col-md-5">
            <label style="font-size: 13px; line-height:0px">Luas Tanah <sup
                    class="text-danger font-weight-bold">*</sup></label>
        </div>
        <div class="col-md-7">
            <input type="text" name="dokumen_luas_tanah[]" class="w-100"
                style="font-size: 13px; line-height:0px">
        </div>
        <div class="col-md-5">
            <label style="font-size: 13px; line-height:0px">Atas Nama <sup
                    class="text-danger font-weight-bold">*</sup></label>
        </div>
        <div class="col-md-7">
            <input type="text" name="dokumen_atas_nama[]" class="w-100"
                style="font-size: 13px; line-height:0px">
        </div>
    </div>
    `);
};

const remove_irk = (e) => {
    if ($(".inf-praper-list-file-irk").children().length > 1) {
        e.remove();
    }
};

// Get Document
const get_document = async (id_irkp) => {
    let document = await fetch(`${url_praper}/get-irkpdocument`, {
        method: "POST",
        headers: {
            Authorization: `Bearer ${token_praper}`,
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            id_irkp: id_irkp,
        }),
    });

    document = await document.json();

    return document;
};

// Inquiry Praper
$("#formLacakBerkas").on("submit", function (e) {
    e.preventDefault();

    $("#lacak_dokumen_praper").hide();
    $("#prosesLacakPraper").show();

    $.ajax({
        url: `${url_praper}/inquiry-pengawasan`,
        type: "POST",
        dataType: "json",
        data: JSON.stringify({
            nik_pemilik: $("#irk_nik_pemilik").val().toString(),
            telp_pemilik: $("#irk_telp_pemilik").val().toString(),
        }),
        headers: {
            Authorization: `Bearer ${token_praper}`,
            "Content-Type": "application/json",
        },
        success: async (res) => {
            const { data } = res;

            $(".inf-praper-list-lacak-berkas").html("");

            data.forEach(async (item) => {
                const {
                    id_irkp,
                    tgl_pengajuan,
                    nama_pemohon,
                    nama_pemilik,
                    nik_pemilik,
                    telp_pemilik,
                    bangunan_nama,
                    bangunan_fungsi,
                    bangunan_jenis,
                    nib,
                    status,
                } = item;

                get_document(id_irkp).then((res) => {
                    const {
                        output_dokumen,
                        dokumen_dimiliki,
                        url_akta_pendirian,
                        url_akta_pengesahan,
                        url_dokumen_pernyataan,
                    } = res;
                    let irk_list = "";
                    if (dokumen_dimiliki.length == 0) {
                        irk_list = `
                        <div class="col-md-5">
                            <label style="font-size: 13px; line-height:1">IRK</label>
                        </div>
                        <div class="col-md-7">
                            <label style="font-size: 13px; line-height:1">Tidak Menyantumkan</label>
                        </div>
                        `;
                    } else {
                        irk_list += `
                        <div class="col-md-5">
                            <label style="font-size: 13px; line-height:1">IRK</label>
                        </div>
                        <div class="col-md-7">
                            <label style="font-size: 13px; line-height:1">Berjumlah ${dokumen_dimiliki.length} Dokumen</label>
                        </div>
                        `;
                        dokumen_dimiliki.forEach((item, index) => {
                            const {
                                nama,
                                nomor,
                                tanggal,
                                luas_tanah,
                                atas_nama,
                                url_dokumen_irk,
                            } = item;
                            irk_list += `
                            <div class="col-md-12 my-2">
                                <label style="font-size: 13px; line-height:1;font-weight:bold;">Dokumen IRK Ke - ${
                                    index + 1
                                } </label>
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:1">Nama</label>
                            </div>
                            <div class="col-md-7">
                                <label style="font-size: 13px; line-height:1">${nama}</label>
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:1">Nomor</label>
                            </div>
                            <div class="col-md-7">
                                <label style="font-size: 13px; line-height:1">${nomor}</label>
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:1">Tanggal</label>
                            </div>
                            <div class="col-md-7">
                                <label style="font-size: 13px; line-height:1">${tanggal}</label>
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:1">Luas Tanah</label>
                            </div>
                            <div class="col-md-7">
                                <label style="font-size: 13px; line-height:1">${luas_tanah}</label>
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:1">Atas Nama</label>
                            </div>
                            <div class="col-md-7">
                                <label style="font-size: 13px; line-height:1">${atas_nama}</label>
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:1">Atas Nama</label>
                            </div>
                            <div class="col-md-7">
                                <label style="font-size: 13px; line-height:1">${atas_nama}</label>
                            </div>
                            <div class="col-md-5">
                                <label style="font-size: 13px; line-height:1">Berkas</label>
                            </div>
                            <div class="col-md-7">
                                <a style="font-size: 13px; line-height:1" href="${url_dokumen_irk}" target="_blank">Klik Disini</a>
                            </div>
                        `;
                        });
                    }
                    $(".inf-praper-list-lacak-berkas").append(`
                    <div class="row mb-4 border rounded py-2">
                        <div class="col-md-5">
                            <label style="font-size: 13px; line-height:1">Tanggal Pengajuan</label>
                        </div>
                        <div class="col-md-7">
                            <label style="font-size: 13px; line-height:1">${tgl_pengajuan}</label>
                        </div>
                        <div class="col-md-5">
                            <label style="font-size: 13px; line-height:1">Nama Pemohon</label>
                        </div>
                        <div class="col-md-7">
                            <label style="font-size: 13px; line-height:1">${nama_pemohon}</label>
                        </div>
                        <div class="col-md-5">
                            <label style="font-size: 13px; line-height:1">Nama Pemilik</label>
                        </div>
                        <div class="col-md-7">
                            <label style="font-size: 13px; line-height:1">${nama_pemilik}</label>
                        </div>
                        <div class="col-md-5">
                            <label style="font-size: 13px; line-height:1">NIK Pemilik</label>
                        </div>
                        <div class="col-md-7">
                            <label style="font-size: 13px; line-height:1">${nik_pemilik}</label>
                        </div>
                        <div class="col-md-5">
                            <label style="font-size: 13px; line-height:1">Telp Pemilik</label>
                        </div>
                        <div class="col-md-7">
                            <label style="font-size: 13px; line-height:1">${telp_pemilik}</label>
                        </div>
                        <div class="col-md-5">
                            <label style="font-size: 13px; line-height:1">Nama Bangunan</label>
                        </div>
                        <div class="col-md-7">
                            <label style="font-size: 13px; line-height:1">${bangunan_nama}</label>
                        </div>
                        <div class="col-md-5">
                            <label style="font-size: 13px; line-height:1">Fungsi Bangunan</label>
                        </div>
                        <div class="col-md-7">
                            <label style="font-size: 13px; line-height:1">${bangunan_fungsi}</label>
                        </div>
                        <div class="col-md-5">
                            <label style="font-size: 13px; line-height:1">Jenis Bangunan</label>
                        </div>
                        <div class="col-md-7">
                            <label style="font-size: 13px; line-height:1">${bangunan_jenis}</label>
                        </div>
                        <div class="col-md-5">
                            <label style="font-size: 13px; line-height:1">NIB</label>
                        </div>
                        <div class="col-md-7">
                            <label style="font-size: 13px; line-height:1">${nib}</label>
                        </div>
                        <div class="col-md-5">
                            <label style="font-size: 13px; line-height:1">Status</label>
                        </div>
                        <div class="col-md-7">
                            <label style="font-size: 13px; line-height:1">${status}</label>
                        </div>
                        ${irk_list}
                        <div class="col-md-5">
                            <label style="font-size: 13px; line-height:1">Output Dokumen</label>
                        </div>
                        <div class="col-md-7">
                            <a style="font-size: 13px; line-height:1" href="${output_dokumen}" target="_blank">Klik disini</a>
                        </div>
                        <div class="col-md-5">
                            <label style="font-size: 13px; line-height:1">Akta Pendirian</label>
                        </div>
                        <div class="col-md-7">
                            <a style="font-size: 13px; line-height:1" href="${url_akta_pendirian}" target="_blank">Klik disini</a>
                        </div>
                        <div class="col-md-5">
                            <label style="font-size: 13px; line-height:1">Akta Pengesahan</label>
                        </div>
                        <div class="col-md-7">
                            <a style="font-size: 13px; line-height:1" href="${url_akta_pengesahan}" target="_blank">Klik disini</a>
                        </div>
                        <div class="col-md-5">
                            <label style="font-size: 13px; line-height:1">Dolumen Pernyataan</label>
                        </div>
                        <div class="col-md-7">
                            <a style="font-size: 13px; line-height:1" href="${url_dokumen_pernyataan}" target="_blank">Klik disini</a>
                        </div>
                    </div>
                        `);
                });
            });

            $("#prosesLacakPraper").hide();
            $("#lacak_dokumen_praper").show();
        },
        error: (err) => {
            console.log(err);
            $("#prosesLacakPraper").hide();
            $("#lacak_dokumen_praper").show();
        },
    });
});
