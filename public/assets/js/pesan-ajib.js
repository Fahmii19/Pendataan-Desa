let url_pesan_ajib = `${APP_URL}/pesan-ajib`;

// Onload Event
window.onload = () => {
    get_list_izin().then((data) => {
        list_izin(data);
    });
};

const pesan_ajib = () => {
    if (localStorage.getItem("kelurahan") !== null) {
        let container = document.getElementsByClassName("info-pesan-ajib")[0];

        // Block Form
        block_form();

        //Show container
        container.style.display = "block";

        get_ajib_kelurahan()
            .then((message) => {
                list_ajib_kelurahan(message);

                // Block Form
                block_form();
            })
            .catch((err) => {
                console.log(err);
            });

        // Get Data Permohonan
        get_data_permohonan().then((data) => {
            // Block Form
            block_form();

            list_data_permohonan(data);
        });
    }
};

const close_pesan_ajib = () => {
    let container = document.getElementsByClassName("info-pesan-ajib")[0];

    //Hide container
    container.style.display = "none";
};

// Block Form
const block_form = () => {
    let date = new Date();
    let hour = date.getHours();

    if (hour <= 9 || hour >= 15) {
        document.getElementById("nama_pemohon_pesan_ajib").disabled = true;
        document.getElementById("nik_pesan_ajib").disabled = true;
        document.getElementById("no_hp_pesan_ajib").disabled = true;
        document.getElementById("alamat_pesan_ajib").disabled = true;
        document.getElementById("kelurahan_pesan_ajib").disabled = true;
        document.getElementById("kecamatan_pesan_ajib").disabled = true;
        document.getElementById("kota_pesan_ajib").disabled = true;
        document.getElementById("koordinat_pesan_ajib").disabled = true;
        document.getElementById("lat_pesan_ajib").disabled = true;
        document.getElementById("lng_pesan_ajib").disabled = true;
        document.getElementById("jenis_pesan_ajib").disabled = true;
        document.querySelector(
            "input[type='radio'][name='id_ajib']"
        ).disabled = true;
        document.getElementById("btnFormPesanAjib").disabled = true;
    }
};

const get_ajib_kelurahan = async (
    kelurahan = localStorage.getItem("kelurahan")
) => {
    let url = `${url_pesan_ajib}/getListAjib`;
    let body = {
        kelurahan: titleCase(kelurahan),
    };

    let response = await fetch(url, {
        method: "POST",
        body: JSON.stringify(body),
        headers: {
            "Content-Type": "application/json",
        },
    });

    const { message } = await response.json();

    return message;
};

const list_ajib_kelurahan = (data) => {
    let html = "";

    data.forEach((item) => {
        const { id, kelurahan, nama, nohp } = item;

        html += `
        <label class="w-100 option_list_ajib">
        <input type="radio" name="id_ajib" value="${id}" style="display: none;">
        <div class="card">
            <div class="card-body p-0">
                <div class="row">
                    <div class="d-flex align-items-center col-md-4 text-center">
                        <div style="width: 100%">
                            <span style="font-size: 60px;"><i class="fa fa-user"></i></span>
                        </div>
                    </div>
                    <div class="col-md-8 p-0" style="line-height:0.8">
                        <p class="d-flex align-items-center">
                            <div>
                                <label style="font-size: 12pt" class="font-weight-bold w-100">${nama}</label>
                                <label style="font-size: 10pt" class="font-weight-bold w-100">#${id}</label>
                                <label style="font-size: 10pt" class="font-weight-bold w-100">${nohp}</label>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </label>
        `;
    });

    document.getElementById("list-pegawai-ajib").innerHTML = html;
};

const submit_pesan_ajib = async () => {
    let form = document.getElementById("pesanAjibForm");

    let formData = new FormData(form);

    // validate form
    if (!validate_pesan_ajib()) {
        return Promise.reject("Form tidak lengkap");
    }

    let url = `${url_pesan_ajib}/savePermohonan`;

    let response = await fetch(url, {
        method: "POST",
        body: formData,
    });

    const data = await response.json();

    if (data.code == 400) {
        return Promise.reject(data);
    } else {
        return data;
    }
};

const validate_pesan_ajib = () => {
    let nama_pemohon = document.getElementById("nama_pemohon_pesan_ajib").value;
    let nik = document.getElementById("nik_pesan_ajib").value;
    let no_hp = document.getElementById("no_hp_pesan_ajib").value;
    let alamat = document.getElementById("alamat_pesan_ajib").value;
    let kelurahan = document.getElementById("kelurahan_pesan_ajib").value;
    let kecamatan = document.getElementById("kecamatan_pesan_ajib").value;
    let kota = document.getElementById("kota_pesan_ajib").value;
    let lat = document.getElementById("lat_pesan_ajib").value;
    let lng = document.getElementById("lng_pesan_ajib").value;
    let jenis = document.getElementById("jenis_pesan_ajib").value;
    let id_ajib = document.querySelector(
        "input[type='radio'][name='id_ajib']:checked"
    ).value;

    if (
        nama_pemohon !== "" &&
        nik !== "" &&
        no_hp !== "" &&
        alamat !== "" &&
        kelurahan !== "" &&
        kecamatan !== "" &&
        kota !== "" &&
        lat !== "" &&
        lng !== "" &&
        jenis !== "" &&
        id_ajib !== ""
    ) {
        return true;
    } else {
        return false;
    }
};

// Submit form PesanAjibForm
document.getElementById("pesanAjibForm").addEventListener("submit", (e) => {
    e.preventDefault();

    // Hide Button Submit and Show Loading
    document.getElementById("btnFormPesanAjib").style.display = "none";
    document.getElementById("prosesPesanAjib").style.display = "block";

    submit_pesan_ajib()
        .then((message) => {
            // Reset Form
            e.target.reset();

            // Show Button Submit and Hide Loading
            document.getElementById("prosesPesanAjib").style.display = "none";
            document.getElementById("btnFormPesanAjib").style.display = "block";

            console.log(message);

            // Show Alert Success
            document.getElementById("alertSuccessAjib").style.display = "block";
            setTimeout(() => {
                document.getElementById("alertSuccessAjib").style.display =
                    "none";
            }, 3000);

            // Get Data Permohonan
            get_data_permohonan().then((data) => {
                list_data_permohonan(data);
            });
        })
        .catch((err) => {
            // Show Button Submit and Hide Loading
            document.getElementById("prosesPesanAjib").style.display = "none";
            document.getElementById("btnFormPesanAjib").style.display = "block";

            // Show Alert Error
            document.getElementById("alertErrorPesanAjib").style.display =
                "block";

            console.log(err);

            // Change Text Error
            document.querySelector("#alertErrorPesanAjib span").innerHTML =
                err.message;

            setTimeout(() => {
                document.getElementById("alertErrorPesanAjib").style.display =
                    "none";

                document.querySelector("#alertErrorPesanAjib span").innerHTML =
                    "Semua data harus diisi";
            }, 3000);
        });
});

// Get List Izin
const get_list_izin = async () => {
    let url = `${url_pesan_ajib}/getIzinAjib`;

    let response = await fetch(url, {
        method: "POST",
    });

    const data = await response.json();

    return data;
};

// List Izin
const list_izin = (data) => {
    let html = "";

    let { message } = data;

    message.forEach((item) => {
        const { id, text } = item;

        html += `
        <option value="${id}">${text}</option>
        `;
    });

    document.getElementById("jenis_pesan_ajib").innerHTML = "";
    document.getElementById("jenis_pesan_ajib").innerHTML = html;
};

// Get Permohonan
const get_permohonan = (page = 1) => {
    // Preload
    preload_data_permohonan();
    get_data_permohonan(page)
        .then((data) => {
            list_data_permohonan(data);
        })
        .catch((err) => {
            list_data_permohonan(err);
        });
};

// Get Data Permohonan
const get_data_permohonan = async (page = 1) => {
    let url = `${url_pesan_ajib}/getDataPermohonan`;

    let response = await fetch(url, {
        method: "POST",
        body: JSON.stringify({
            page: page,
        }),
        headers: {
            "Content-Type": "application/json",
        },
    });

    const data = await response.json();

    return data;
};

// List Data Permohonan
const list_data_permohonan = (res) => {
    let html = "";

    if (res.data !== undefined) {
        let { data } = res;
        // Initial Parent
        html += `<div id="data-permhonan">`;

        data.data.forEach((item) => {
            const {
                nama,
                nama_izin,
                status_permohonan,
                no_permohonan,
                petugas,
            } = item;

            html += `
            <div style="font-size: 12.5px;">
            <div>
                <div class="row">
                    <div class="col-md-8"> 
                        <p style="line-height:1">
                            <label class="w-100">${nama_izin}&nbsp;</label> 
                            <label class="w-100">${nama}</label>
                            <label class="w-100">${no_permohonan}</label>
                            <label class="w-100">${
                                petugas.nama == undefined ? "-" : petugas.nama
                            }</label>
                            <label class="w-100">${
                                petugas.nohp == undefined ? "-" : petugas.nohp
                            }</label>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <span class="badge badge-primary">${status_permohonan}</span>
                    </div>
                </div>
                </div>
            </div>
            `;
        });

        // Close Parent
        html += `</div>`;

        html += `<center><div class="pagination-pesan-ajib">`;

        data.links.forEach((item) => {
            const { url, label, active } = item;

            let page = null;

            if (url !== null) {
                // New URL
                let url_new = new URL(url);

                // Get Value Param Page
                page = url_new.searchParams.get("page");
            }

            let new_label;

            if (label === "&laquo; Previous") {
                new_label = "&laquo;";
            } else if (label === "Next &raquo;") {
                new_label = "&raquo;";
            } else {
                new_label = label;
            }

            if (active) {
                html += `
                <a class="active" style="cursor: pointer;" onclick="get_permohonan(${page})">${new_label}</a>
                `;
            } else {
                html += `
                <a style="cursor: pointer;" onclick="get_permohonan(${page})">${new_label}</a>
                `;
            }
        });

        html += `</div></center>`;
    } else {
        html += `
        <div class="mt-3" id="data-permhonan">
            <div class="mt-5">
                <div class="row">
                    <div class="col-md-12"> 
                        <p class="text-center" style="line-height:1;font-size: 12.5px;">
                            <label class="w-100">Tidak Ada Data yang di Masukan</label>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        `;
    }

    document.getElementById("list-data-permohonan").innerHTML = "";
    document.getElementById("list-data-permohonan").innerHTML = html;
};

// Search Data Permohonan
const search_data_permohonan = async (page = 0) => {
    let url = `${url_pesan_ajib}/searchPermohonan`;
    let keyword = document.getElementById("keyword").value;

    let response = await fetch(url, {
        method: "POST",
        body: JSON.stringify({
            page: page,
            keyword: keyword,
        }),
        headers: {
            "Content-Type": "application/json",
        },
    });

    const data = await response.json();

    return data;
};

// List Search Data Permohonan
const list_search_data_permohonan = (res) => {
    let html = "";

    if (res.data !== undefined) {
        let { data, links } = res.data;

        // Initial Parent
        html += `<div id="data-permhonan">`;

        data.forEach((item) => {
            const {
                nama,
                nama_izin,
                status_permohonan,
                no_permohonan,
                petugas,
            } = item;

            html += `
            <div style="font-size: 12.5px;">
            <div>
                <div class="row">
                    <div class="col-md-8"> 
                        <p style="line-height:1">
                            <label class="w-100">${nama_izin}&nbsp;</label> 
                            <label class="w-100">${nama}</label>
                            <label class="w-100">${no_permohonan}</label>
                            <label class="w-100">${
                                petugas.nama == undefined ? "-" : petugas.nama
                            }</label>
                            <label class="w-100">${
                                petugas.nohp == undefined ? "-" : petugas.nohp
                            }</label>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <span class="badge badge-primary">${status_permohonan}</span>
                    </div>
                </div>
                </div>
            </div>
            `;
        });

        html += `</div>`;

        html += `<center><div class="pagination-pesan-ajib">`;

        links.forEach((item) => {
            const { url, label, active } = item;

            let page = null;

            if (url !== null) {
                // New URL
                let url_new = new URL(url);

                // Get Value Param Page
                page = url_new.searchParams.get("page");
            }

            let new_label;

            if (label === "&laquo; Previous") {
                new_label = "&laquo;";
            } else if (label === "Next &raquo;") {
                new_label = "&raquo;";
            } else {
                new_label = label;
            }

            if (active) {
                html += `
                <a class="active" style="cursor: pointer;" onclick="get_search_permohonan(${page})">${new_label}</a>
                `;
            } else {
                html += `
                <a style="cursor: pointer;" onclick="get_search_permohonan(${page})">${new_label}</a>
                `;
            }
        });

        html += `</div></center>`;
    } else {
        html += `
        <div class="mt-3" id="data-permhonan">
            <div class="mt-5">
                <div class="row">
                    <div class="col-md-12"> 
                        <p class="text-center" style="line-height:1;font-size: 12.5px;">
                            <label class="w-100">Data tidak ditemukan</label>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        `;
    }

    document.getElementById("list-data-permohonan").innerHTML = "";
    document.getElementById("list-data-permohonan").innerHTML = html;
};

const get_search_permohonan = async (page = 0) => {
    // Preload
    preload_data_permohonan();

    search_data_permohonan(page).then((data) => {
        list_search_data_permohonan(data);
    });
};

// Delay Function
const delay = (func, timeout = 300) => {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            func.apply(this, args);
        }, timeout);
    };
};

// Search Data Permohonan
document.getElementById("keyword").addEventListener(
    "keyup",
    delay(() => {
        // Preload
        preload_data_permohonan();

        search_data_permohonan().then((data) => {
            list_search_data_permohonan(data);
        });
    }, 500)
);

// Preload Data Permohonan
const preload_data_permohonan = () => {
    // Preload
    let preload = `
    <center style="font-size:12.5px">
        <div class="spinner-border mt-3" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </center>`;

    document.getElementById("data-permhonan").innerHTML = preload;
};
