//Filter Data Interactive

//List Field Data
let pekerjaan = [
    "aparatur_pemerintah",
    "pertanian",
    "nelayan",
    "tenaga_kesehatan",
    "pegawai",
    "tentara",
    "kepolisian",
    "petani",
    "peternak",
    "industri",
    "konstruksi",
    "transportasi",
    "pembantu",
    "mekanik",
    "seniman",
    "tabib",
    "paraji",
    "perancang",
    "penterjemah",
    "imam_masjid",
    "pendeta",
    "pastor",
    "wartawan",
    "ustadz",
    "juru_masak",
    "promotor",
    "dosen",
    "guru",
    "pilot",
    "pengacara",
    "notaris",
    "arsitek",
    "akuntan",
    "konsultan",
    "dokter",
    "bidan",
    "perawat",
    "apoteker",
    "psikiater",
    "pelaut",
    "peneliti",
    "sopir",
    "pialang",
    "paranormal",
    "pedagang",
    "biarawati",
    "karyawan",
    "buruh",
    "tukang",
    "penyiar",
    "wiraswasta",
    "pensiunan",
    "lainnya",
    "belum_tidak_bekerja",
];

let pendidikan = [
    "tamat_sd",
    "sltp",
    "slta",
    "diploma_i",
    "diploma_ii",
    "diploma_iv",
    "strata_ii",
    "strata_iii",
];

let agama = [
    "islam",
    "kristen",
    "katolik",
    "hindu",
    "budha",
    "konghucu",
    "kepercayaan",
];

//Slider For Filter Data
const sliderRange = () => {
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 25000000000,
        values: [0, 25000000000],
        step: 10000000,
        slide: function (event, ui) {
            $("#amount").text(
                "Rp. " +
                    separatorNum(ui.values[0]) +
                    " - Rp. " +
                    separatorNum(ui.values[1])
            );
            // console.log(ui.values[0], ui.values[1]);
        },
        stop: function (event, ui) {
            // console.log(ui.values[0], ui.values[1]);
            choro(ui.values[0], ui.values[1], "omzet");
        },
    });
    $("#amount").text(
        "Rp. " +
            separatorNum($("#slider-range").slider("values", 0)) +
            " - Rp. " +
            separatorNum($("#slider-range").slider("values", 1))
    );
};

const sliderRangeKepadatan = () => {
    $("#slider-kepadatan").slider({
        range: true,
        min: 0,
        max: 100000,
        values: [0, 100000],
        step: 50,
        slide: function (event, ui) {
            $("#kepadatan").text(
                separatorNum(ui.values[0]) + " - " + separatorNum(ui.values[1])
            );
            // console.log(ui.values[0], ui.values[1]);
        },
        stop: function (event, ui) {
            // console.log(ui.values[0], ui.values[1]);
            choro(ui.values[0], ui.values[1], "kepadatan");
        },
    });
    $("#kepadatan").text(
        separatorNum($("#slider-kepadatan").slider("values", 0)) +
            " - " +
            separatorNum($("#slider-kepadatan").slider("values", 1))
    );
};

const sliderRangeJumlahPenduduk = () => {
    $("#slider-jumlah-penduduk").slider({
        range: true,
        min: 0,
        max: 200000,
        values: [0, 200000],
        step: 50,
        slide: function (event, ui) {
            $("#jumlah-penduduk").text(
                separatorNum(ui.values[0]) + " - " + separatorNum(ui.values[1])
            );
            // console.log(ui.values[0], ui.values[1]);
        },
        stop: function (event, ui) {
            // console.log(ui.values[0], ui.values[1]);
            choro(ui.values[0], ui.values[1], "jumlah_penduduk");
        },
    });
    $("#jumlah-penduduk").text(
        separatorNum($("#slider-jumlah-penduduk").slider("values", 0)) +
            " - " +
            separatorNum($("#slider-jumlah-penduduk").slider("values", 1))
    );
};

const sliderRangeKepadatanBangunan = () => {
    $("#slider-kepadatan-bangunan").slider({
        range: true,
        min: 0,
        max: 25000,
        values: [0, 25000],
        step: 50,
        slide: function (event, ui) {
            $("#kepadatan-bangunan").text(
                separatorNum(ui.values[0]) + " - " + separatorNum(ui.values[1])
            );
            // console.log(ui.values[0], ui.values[1]);
        },
        stop: function (event, ui) {
            // console.log(ui.values[0], ui.values[1]);
            choro(ui.values[0], ui.values[1], "count_polygons");
        },
    });
    $("#kepadatan-bangunan").text(
        separatorNum($("#slider-kepadatan-bangunan").slider("values", 0)) +
            " - " +
            separatorNum($("#slider-kepadatan-bangunan").slider("values", 1))
    );
};

//Event Enabale Data Interaktive
$("#btnInteractive").on("click", () => {
    if (map.getLayer("wilayahindex_fill")) {
        $("#optionFilterChoro").val("Total Omzet UMKM").trigger("change");
    } else {
        choro();
    }
    $("#wilayahindex_fill").trigger("click");
});

//Logical Change option Data Interaktive
$("#optionFilterChoro").change(() => {
    if ($("#optionFilterChoro").val() == "Total Omzet UMKM") {
        localStorage.setItem("filterCategoryChoro", "omzet");
        choro();
        $("#btn-titik").hide();
        $("#filterChoro").html("");
        $("#filterChoro").html(`
            <div class="row">
            <div class="col-md-12 mt-2 mb-2">
                <span id="amount" class="w-100"
                    style="border:0; color:#f6931f; font-weight:bold;"></span>
                <div id="slider-range" class="my-2"></div>
            </div>
            <div class="col-md-6">
                <span for="amount" class="text_all font-weight-bold">Interval (Rp milyar)</span>
                <div class="text_all" id="legends">
    
                </div>
                </div>
            <div class="col-md-6">
                <span for="amount" class="text_all font-weight-bold">Nama Kelurahan</span>
                <div id="pd">
                    <p></p>
                </div>
            </div>
        </div>
            `);
        sliderRange();
    } else if ($("#optionFilterChoro").val() == "Pekerjaan") {
        localStorage.setItem("filterChoro", 1);
        // if (localStorage.getItem("filterCategoryChoro") !== "pekerjaan") {
        //     $("#btn-titik").slick("unslick");
        //     console.log("unslick");
        // }
        localStorage.setItem("filterCategoryChoro", "pekerjaan");
        $("#btn-titik").hide();
        // $("#btn-titik").html(``);
        let pekerjaan = [
            "aparatur_pemerintah",
            "pertanian",
            "nelayan",
            "tenaga_kesehatan",
            "pegawai",
            "tentara",
            "kepolisian",
            "petani",
            "peternak",
            "industri",
            "konstruksi",
            "transportasi",
            "pembantu",
            "mekanik",
            "seniman",
            "tabib",
            "paraji",
            "perancang",
            "penterjemah",
            "imam_masjid",
            "pendeta",
            "pastor",
            "wartawan",
            "ustadz",
            "juru_masak",
            "promotor",
            "dosen",
            "guru",
            "pilot",
            "pengacara",
            "notaris",
            "arsitek",
            "akuntan",
            "konsultan",
            "dokter",
            "bidan",
            "perawat",
            "apoteker",
            "psikiater",
            "pelaut",
            "peneliti",
            "sopir",
            "pialang",
            "paranormal",
            "pedagang",
            "biarawati",
            "karyawan",
            "buruh",
            "tukang",
            "penyiar",
            "wiraswasta",
            "pensiunan",
            "lainnya",
            "belum_tidak_bekerja",
        ];
        let html = "";
        pekerjaan.forEach((item) => {
            if (item == "aparatur_pemerintah") {
                choro(0, 0, "aparatur_pemerintah");
            }
            html += `
                <div class="mb-1">
                <button class="btn btn-xs mr-2 ${
                    item == "aparatur_pemerintah" ? "active-chip" : ""
                }"
                    style="background: #fdfffc; border-radius: 30px; box-shadow: none; border:1px #ccc solid; padding:5px;" onclick="choro(0,0,'${item}')">
                    <div class="container">
                        <div class="row">
                            <span class="font-weight-bold" style="margin-top: 2px; font-size:13px;">${titleCase(
                                item.replaceAll("_", " ")
                            )}</span>
                        </div>
                    </div>
                </button>
                </div>
                `;
        });
        $("#filterChoro").html("");
        $("#filterChoro").html(`
            <div class="row">
            <div class="col-md-12 mt-2 mb-2">
                <div id="pekerjaan">${html}</div>
            </div>
            <div class="col-md-6">
                <span for="amount" class="text_all font-weight-bold">Interval (orang)</span>
                <div class="text_all" id="legends">
    
                </div>
            </div>
            <div class="col-md-6">
                <span for="amount" class="text_all font-weight-bold">Nama Kelurahan</span>
                <div id="pd">
                    <p></p>
                </div>
            </div>
        </div>
            `);
        chipOption("pekerjaan");
        activeButton("pekerjaan");
    } else if ($("#optionFilterChoro").val() == "Pendidikan") {
        let pendidikan = [
            "tamat_sd",
            "sltp",
            "slta",
            "diploma_i",
            "diploma_ii",
            "diploma_iv",
            "strata_ii",
            "strata_iii",
        ];

        localStorage.setItem("filterCategoryChoro", "pendidikan");
        // $("#btn-titik").html(``);
        choro(0, 0, "tamat_sd");
        let html = "";
        pendidikan.forEach((item) => {
            if (item == "tamat_sd") {
                choro(0, 0, "tamat_sd");
            }
            html += `
                <div class="mb-1">
                <button class="btn btn-xs mr-2 ${
                    item == "tamat_sd" ? "active-chip" : ""
                }"
                    style="background: #fdfffc; border-radius: 30px; box-shadow: none; border:1px #ccc solid; padding:5px;" onclick="choro(0,0,'${item}')">
                    <div class="container">
                        <div class="row">
                            <span class="font-weight-bold" style="margin-top: 2px; font-size:13px;">${titleCase(
                                item.replaceAll("_", " ")
                            )}</span>
                        </div>
                    </div>
                </button>
                </div>
                `;
        });

        localStorage.setItem("filterChoro", 1);
        $("#filterChoro").html("");
        $("#filterChoro").html(`
            <div class="row">
            <div class="col-md-12 mt-2 mb-2">
                <div id="pendidikan">${html}</div>
            </div>
            <div class="col-md-6">
                <span for="amount" class="text_all font-weight-bold">Interval (orang)</span>
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
            `);
        chipOption("pendidikan");
        activeButton("pendidikan");
    } else if ($("#optionFilterChoro").val() == "Agama") {
        let pendidikan = [
            "islam",
            "kristen",
            "katolik",
            "hindu",
            "budha",
            "konghucu",
            "kepercayaan",
        ];

        localStorage.setItem("filterCategoryChoro", "agama");
        // $("#btn-titik").html(``);
        choro(0, 0, "islam");
        let html = "";
        pendidikan.forEach((item) => {
            if (item == "islam") {
                choro(0, 0, "islam");
            }
            html += `
                <div class="mb-1">
                <button class="btn btn-xs mr-2 ${
                    item == "islam" ? "active-chip" : ""
                }"
                    style="background: #fdfffc; border-radius: 30px; box-shadow: none; border:1px #ccc solid; padding:5px;" onclick="choro(0,0,'${item}')">
                    <div class="container">
                        <div class="row">
                            <span class="font-weight-bold" style="margin-top: 2px; font-size:13px;">${titleCase(
                                item.replaceAll("_", " ")
                            )}</span>
                        </div>
                    </div>
                </button>
                </div>
                `;
        });

        localStorage.setItem("filterChoro", 1);
        $("#filterChoro").html("");
        $("#filterChoro").html(`
            <div class="row">
            <div class="col-md-12 mt-2 mb-2">
                <div id="agama">${html}</div>
            </div>
            <div class="col-md-6">
                <span for="amount" class="text_all font-weight-bold">Interval Orang</span>
                <div class="text_all" id="legends">
    
                </div>
            </div>
            <div class="col-md-6">
                <span for="amount" class="text_all font-weight-bold">Nama Kelurahan</span>
                <div id="pd">
                    <p></p>
                </div>
            </div>
        </div>
            `);
        chipOption("agama");
        activeButton("agama");
    } else if ($("#optionFilterChoro").val() == "Kepadatan Penduduk") {
        localStorage.setItem("filterCategoryChoro", "kepadatan");
        choro(0, 100000, "kepadatan");
        $("#btn-titik").hide();
        $("#filterChoro").html("");
        $("#filterChoro").html(`
            <div class="row">
            <div class="col-md-12 mt-2 mb-2">
                <span id="kepadatan" class="w-100"
                    style="border:0; color:#f6931f; font-weight:bold;"></span>
                <div id="slider-kepadatan" class="my-2"></div>
            </div>
            <div class="col-md-6">
                <span for="kepadatan" class="text_all font-weight-bold">Interval (Orang)</span>
                <div class="text_all" id="legends">
    
                </div>
                </div>
            <div class="col-md-6">
                <span for="kepadatan" class="text_all font-weight-bold">Nama Kelurahan</span>
                <div id="pd">
                    <p></p>
                </div>
            </div>
        </div>
            `);
        sliderRangeKepadatan();
    } else if ($("#optionFilterChoro").val() == "Jumlah Penduduk") {
        localStorage.setItem("filterCategoryChoro", "jumlah_penduduk");
        choro(0, 200000, "jumlah_penduduk");
        $("#btn-titik").hide();
        $("#filterChoro").html("");
        $("#filterChoro").html(`
            <div class="row">
            <div class="col-md-12 mt-2 mb-2">
                <span id="jumlah-penduduk" class="w-100"
                    style="border:0; color:#f6931f; font-weight:bold;"></span>
                <div id="slider-jumlah-penduduk" class="my-2"></div>
            </div>
            <div class="col-md-6">
                <span for="jumlah-penduduk" class="text_all font-weight-bold">Interval (Orang)</span>
                <div class="text_all" id="legends">
    
                </div>
                </div>
            <div class="col-md-6">
                <span for="jumlah-penduduk" class="text_all font-weight-bold">Nama Kelurahan</span>
                <div id="pd">
                    <p></p>
                </div>
            </div>
        </div>
            `);
        sliderRangeJumlahPenduduk();
    } else if ($("#optionFilterChoro").val() == "Kepadatan Bangunan") {
        localStorage.setItem("filterCategoryChoro", "count_polygons");
        choro(0, 25000, "count_polygons");
        $("#btn-titik").hide();
        $("#filterChoro").html("");
        $("#filterChoro").html(`
            <div class="row">
            <div class="col-md-12 mt-2 mb-2">
                <span id="kepadatan-bangunan" class="w-100"
                    style="border:0; color:#f6931f; font-weight:bold;"></span>
                <div id="slider-kepadatan-bangunan" class="my-2"></div>
            </div>
            <div class="col-md-6">
                <span for="kepadatan-bangunan" class="text_all font-weight-bold">Interval (Bangunan)</span>
                <div class="text_all" id="legends">
    
                </div>
                </div>
            <div class="col-md-6">
                <span for="kepadatan-bangunan" class="text_all font-weight-bold">Nama Kelurahan</span>
                <div id="pd">
                    <p></p>
                </div>
            </div>
        </div>
            `);
        sliderRangeKepadatanBangunan();
    } else if ($("#optionFilterChoro").val() == "Data PPAP") {
        localStorage.removeItem("jenis_data_dppapp");
        if (map.getLayer("wilayahindex_fill")) {
            map.removeLayer("wilayahindex_fill");
            map.removeSource("wilayahindex");
        }
        let point_center_kelurahan = [
            {
                kelurahan: "BALE KAMBANG",
                kordinat: [106.852770167453, -6.28159463356247],
            },
            {
                kelurahan: "KAMPUNG TENGAH",
                kordinat: [106.866630792338, -6.28961962906629],
            },
            {
                kelurahan: "PINANG RANTI",
                kordinat: [106.88496932948, -6.29168788121552],
            },
            {
                kelurahan: "KRAMAT JATI",
                kordinat: [106.870706806921, -6.2741117361314],
            },
            {
                kelurahan: "HALIM PERDANA KUSUMAH",
                kordinat: [106.893247548343, -6.26590800880412],
            },
            {
                kelurahan: "JATI PULO",
                kordinat: [106.803822199297, -6.17879024677216],
            },
            {
                kelurahan: "KERENDANG",
                kordinat: [106.803983753118, -6.15021453588555],
            },
            {
                kelurahan: "PAL MERIAM",
                kordinat: [106.858974192362, -6.20362318904808],
            },
            {
                kelurahan: "RAWA JATI",
                kordinat: [106.854652069397, -6.25809567543088],
            },
            {
                kelurahan: "PLUIT",
                kordinat: [106.786778860067, -6.11356825555952],
            },
            {
                kelurahan: "SLIPI",
                kordinat: [106.801376592262, -6.1939925487108],
            },
            {
                kelurahan: "ANCOL",
                kordinat: [106.833788173498, -6.12414317586525],
            },
            {
                kelurahan: "KEAGUNGAN",
                kordinat: [106.814278138902, -6.15117089568155],
            },
            {
                kelurahan: "CEMPAKA PUTIH TIMUR",
                kordinat: [106.871749153298, -6.17600021735003],
            },
            {
                kelurahan: "CIBUBUR",
                kordinat: [106.882315277541, -6.35737461973628],
            },
            {
                kelurahan: "BUNGUR",
                kordinat: [106.847971506743, -6.17157137781364],
            },
            {
                kelurahan: "BENDUNGAN HILIR",
                kordinat: [106.80904177713, -6.20863072688788],
            },
            {
                kelurahan: "SERDANG",
                kordinat: [106.861146497644, -6.15891301427754],
            },
            {
                kelurahan: "KARET KUNINGAN",
                kordinat: [106.827970245644, -6.22060362931354],
            },
            {
                kelurahan: "GANDARIA SELATAN",
                kordinat: [106.793010335675, -6.27094372372828],
            },
            {
                kelurahan: "CIPINANG",
                kordinat: [106.891260774064, -6.2075560828714],
            },
            {
                kelurahan: "CIDENG",
                kordinat: [106.808310820694, -6.1729803094658],
            },
            {
                kelurahan: "JOHAR BARU",
                kordinat: [106.857029645221, -6.18569864782619],
            },
            {
                kelurahan: "KAMAL",
                kordinat: [106.70005348037, -6.10656087716391],
            },
            {
                kelurahan: "JELAMBAR BARU",
                kordinat: [106.787226994341, -6.14909450796515],
            },
            {
                kelurahan: "GUNTUR",
                kordinat: [106.833249034146, -6.20794694901622],
            },
            {
                kelurahan: "GUNUNG SAHARI SELATAN",
                kordinat: [106.844017923919, -6.15934236207373],
            },
            {
                kelurahan: "JEMBATAN BESI",
                kordinat: [106.797751201794, -6.15186678292615],
            },
            {
                kelurahan: "MANGGA BESAR",
                kordinat: [106.818306162559, -6.14480014760434],
            },
            {
                kelurahan: "JELAMBAR",
                kordinat: [106.785762810035, -6.1593992293072],
            },
            {
                kelurahan: "KARET",
                kordinat: [106.826964737567, -6.21379969219026],
            },
            {
                kelurahan: "KEBON BARU",
                kordinat: [106.861631544954, -6.23370984627694],
            },
            {
                kelurahan: "KEBON SIRIH",
                kordinat: [106.830752573211, -6.18508688763716],
            },
            {
                kelurahan: "PALMERAH",
                kordinat: [106.789488961937, -6.20103876387042],
            },
            {
                kelurahan: "PETOGOGAN",
                kordinat: [106.811191693718, -6.24319814809799],
            },
            {
                kelurahan: "WARAKAS",
                kordinat: [106.877782261381, -6.12183006699335],
            },
            {
                kelurahan: "MENTENG ATAS",
                kordinat: [106.839537225947, -6.21816989049072],
            },
            {
                kelurahan: "PEKOJAN",
                kordinat: [106.804028794853, -6.13734495563037],
            },
            {
                kelurahan: "SELONG",
                kordinat: [106.804594510712, -6.23421581529553],
            },
            {
                kelurahan: "PISANGAN TIMUR",
                kordinat: [106.880134915709, -6.20857627951949],
            },
            {
                kelurahan: "PISANGAN BARU",
                kordinat: [106.868984142346, -6.21170402077053],
            },
            {
                kelurahan: "RAWA BARAT",
                kordinat: [106.813139014201, -6.2363621502823],
            },
            {
                kelurahan: "TANAH TINGGI",
                kordinat: [106.849248693307, -6.17922607326142],
            },
            {
                kelurahan: "SUKABUMI UTARA",
                kordinat: [106.777634785304, -6.20883629114648],
            },
            {
                kelurahan: "TAMBORA",
                kordinat: [106.808846207665, -6.14462915712309],
            },
            {
                kelurahan: "SENEN",
                kordinat: [106.839631642031, -6.17610135315747],
            },
            {
                kelurahan: "CEMPAKA BARU",
                kordinat: [106.862779174035, -6.16810842497002],
            },
            {
                kelurahan: "CAWANG",
                kordinat: [106.866895507895, -6.2508803086182],
            },
            {
                kelurahan: "BALI MESTER",
                kordinat: [106.86636534666, -6.2195453127645],
            },
            {
                kelurahan: "CEGER",
                kordinat: [106.892392768416, -6.30849411118805],
            },
            {
                kelurahan: "ANGKE",
                kordinat: [106.795794360571, -6.14552741421886],
            },
            {
                kelurahan: "BUKIT DURI",
                kordinat: [106.858147238752, -6.2213042733482],
            },
            {
                kelurahan: "CILANDAK TIMUR",
                kordinat: [106.812764394648, -6.29124715819424],
            },
            {
                kelurahan: "CILANGKAP",
                kordinat: [106.908866776889, -6.33359108245503],
            },
            {
                kelurahan: "CEMPAKA PUTIH BARAT",
                kordinat: [106.863845794914, -6.17992983112421],
            },
            {
                kelurahan: "BIDARA CINA",
                kordinat: [106.86695250674, -6.23537213639289],
            },
            {
                kelurahan: "BAMBU APUS",
                kordinat: [106.902306165264, -6.31242413412121],
            },
            {
                kelurahan: "BARU",
                kordinat: [106.847210345023, -6.32392993757224],
            },
            {
                kelurahan: "PETOJO SELATAN",
                kordinat: [106.816407973239, -6.17477076171228],
            },
            {
                kelurahan: "BANGKA",
                kordinat: [106.818322386603, -6.26321694333805],
            },
            {
                kelurahan: "BATU AMPAR",
                kordinat: [106.861052548768, -6.27910071050568],
            },
            {
                kelurahan: "HARAPAN MULIA",
                kordinat: [106.855866970375, -6.17051259201841],
            },
            {
                kelurahan: "CIPINANG BESAR UTARA",
                kordinat: [106.87958664141, -6.21863480288697],
            },
            {
                kelurahan: "CENGKARENG BARAT",
                kordinat: [106.723790997263, -6.13867707610728],
            },
            {
                kelurahan: "BINTARO",
                kordinat: [106.763618125893, -6.27037303835748],
            },
            {
                kelurahan: "CAKUNG BARAT",
                kordinat: [106.934686856088, -6.17305116144553],
            },
            {
                kelurahan: "CAKUNG TIMUR",
                kordinat: [106.955332011345, -6.17100433922291],
            },
            {
                kelurahan: "CIKOKO",
                kordinat: [106.854279825438, -6.24497535334944],
            },
            {
                kelurahan: "CILANDAK BARAT",
                kordinat: [106.797156249676, -6.29051429587967],
            },
            {
                kelurahan: "CILILITAN",
                kordinat: [106.864434633471, -6.26249132254724],
            },
            {
                kelurahan: "CIPINANG CEMPEDAK",
                kordinat: [106.873471677958, -6.236614803337],
            },
            {
                kelurahan: "CILINCING",
                kordinat: [106.944874135385, -6.11170184798334],
            },
            {
                kelurahan: "CIPAYUNG",
                kordinat: [106.893897449408, -6.32905503392006],
            },
            {
                kelurahan: "KEBON MELATI",
                kordinat: [106.815968239544, -6.1970527198445],
            },
            {
                kelurahan: "CIPEDAK",
                kordinat: [106.802083997624, -6.35369913538251],
            },
            {
                kelurahan: "CIPETE SELATAN",
                kordinat: [106.805057303387, -6.27277632781872],
            },
            {
                kelurahan: "GALUR",
                kordinat: [106.855436303918, -6.17617078785069],
            },
            {
                kelurahan: "GAMBIR",
                kordinat: [106.826707356245, -6.17638426928023],
            },
            {
                kelurahan: "TOMANG",
                kordinat: [106.796473965919, -6.17173899669378],
            },
            {
                kelurahan: "GANDARIA UTARA",
                kordinat: [106.791041341464, -6.25777973040243],
            },
            {
                kelurahan: "SETIA BUDI",
                kordinat: [106.825837937748, -6.2074199952573],
            },
            {
                kelurahan: "GEDONG",
                kordinat: [106.859966137258, -6.30147795854981],
            },
            {
                kelurahan: "DURI PULO",
                kordinat: [106.80458246441, -6.16338079999258],
            },
            {
                kelurahan: "CIPETE UTARA",
                kordinat: [106.80436442052, -6.26173014025804],
            },
            {
                kelurahan: "DURI SELATAN",
                kordinat: [106.805013188073, -6.15902781412903],
            },
            {
                kelurahan: "CIPINANG BESAR SELATAN",
                kordinat: [106.880835476944, -6.22976803272407],
            },
            {
                kelurahan: "DURI UTARA",
                kordinat: [106.804942282297, -6.15431004452012],
            },
            {
                kelurahan: "CIPINANG MELAYU",
                kordinat: [106.905831232452, -6.24955628781919],
            },
            {
                kelurahan: "CIPINANG MUARA",
                kordinat: [106.88922262661, -6.22611690718629],
            },
            {
                kelurahan: "KALI ANYAR",
                kordinat: [106.79903386743, -6.15769134700794],
            },
            {
                kelurahan: "CIPULIR",
                kordinat: [106.773155122458, -6.23793520505473],
            },
            {
                kelurahan: "CIKINI",
                kordinat: [106.839387990622, -6.19144933066517],
            },
            {
                kelurahan: "CIRACAS",
                kordinat: [106.875316693506, -6.3260630001247],
            },
            {
                kelurahan: "KARANG ANYAR",
                kordinat: [106.829135431968, -6.15397478137955],
            },
            {
                kelurahan: "DUREN SAWIT",
                kordinat: [106.915721271092, -6.23328416440598],
            },
            {
                kelurahan: "KAMPUNG BALI",
                kordinat: [106.816134579909, -6.18518775246783],
            },
            {
                kelurahan: "DUREN TIGA",
                kordinat: [106.835291283646, -6.25583615503228],
            },
            {
                kelurahan: "GONDANGDIA",
                kordinat: [106.829435891716, -6.19179611097435],
            },
            {
                kelurahan: "CENGKARENG TIMUR",
                kordinat: [106.735647170413, -6.14128196438806],
            },
            {
                kelurahan: "GROGOL",
                kordinat: [106.794325299641, -6.16184680511797],
            },
            {
                kelurahan: "DUKUH",
                kordinat: [106.877783861843, -6.29589028793787],
            },
            {
                kelurahan: "CIGANJUR",
                kordinat: [106.808670396577, -6.33635583088517],
            },
            {
                kelurahan: "DURI KEPA",
                kordinat: [106.773851647269, -6.17607223528842],
            },
            {
                kelurahan: "DURI KOSAMBI",
                kordinat: [106.719237539067, -6.17001063952574],
            },
            {
                kelurahan: "KALIBARU",
                kordinat: [106.920143984787, -6.10293345030191],
            },
            {
                kelurahan: "CIJANTUNG",
                kordinat: [106.858875780337, -6.32157098970938],
            },
            {
                kelurahan: "JOGLO",
                kordinat: [106.738901514359, -6.21913250943172],
            },
            {
                kelurahan: "KARET SEMANGGI",
                kordinat: [106.817934330794, -6.22253903163692],
            },
            {
                kelurahan: "KALIBATA",
                kordinat: [106.837658359856, -6.2633305411815],
            },
            {
                kelurahan: "KALIDERES",
                kordinat: [106.698785519767, -6.14922780474256],
            },
            {
                kelurahan: "GUNUNG SAHARI UTARA",
                kordinat: [106.838283316969, -6.14921536977911],
            },
            {
                kelurahan: "KALISARI",
                kordinat: [106.853038437807, -6.33537780768208],
            },
            {
                kelurahan: "KAMAL MUARA",
                kordinat: [106.735837814876, -6.1107651443879],
            },
            {
                kelurahan: "GELORA",
                kordinat: [106.801505339459, -6.21625888260069],
            },
            {
                kelurahan: "GLODOK",
                kordinat: [106.813214131305, -6.14497746902846],
            },
            {
                kelurahan: "GROGOL SELATAN",
                kordinat: [106.781449431273, -6.22970438540237],
            },
            {
                kelurahan: "GROGOL UTARA",
                kordinat: [106.787136887485, -6.2172202114882],
            },
            {
                kelurahan: "JEMBATAN LIMA",
                kordinat: [106.803792773857, -6.14490519052608],
            },
            {
                kelurahan: "KEBON MANGGIS",
                kordinat: [106.855346271711, -6.20727473633999],
            },
            {
                kelurahan: "GUNUNG",
                kordinat: [106.792775126678, -6.23594388650512],
            },
            {
                kelurahan: "KELAPA GADING BARAT",
                kordinat: [106.895269139883, -6.15552378967254],
            },
            {
                kelurahan: "JAGAKARSA",
                kordinat: [106.819246663845, -6.32537260793634],
            },
            {
                kelurahan: "JATI PADANG",
                kordinat: [106.831058031946, -6.28825938435036],
            },
            {
                kelurahan: "KEBON BAWANG",
                kordinat: [106.889019498519, -6.11937234424829],
            },
            {
                kelurahan: "KELAPA GADING TIMUR",
                kordinat: [106.90360715134, -6.16839916689042],
            },
            {
                kelurahan: "KARTINI",
                kordinat: [106.833118085856, -6.1532451786809],
            },
            {
                kelurahan: "JATINEGARA",
                kordinat: [106.916053416625, -6.20344802566098],
            },
            {
                kelurahan: "KAYU MANIS",
                kordinat: [106.862213831324, -6.20270408432705],
            },
            {
                kelurahan: "JATI",
                kordinat: [106.897029023734, -6.19452623737398],
            },
            {
                kelurahan: "JATINEGARA KAUM",
                kordinat: [106.901457923829, -6.20234834884718],
            },
            {
                kelurahan: "KAPUK",
                kordinat: [106.754065916163, -6.14218647017166],
            },
            {
                kelurahan: "KAPUK MUARA",
                kordinat: [106.763305628371, -6.12218961751628],
            },
            {
                kelurahan: "KEDOYA UTARA",
                kordinat: [106.760988299761, -6.16857000412445],
            },
            {
                kelurahan: "KEBON KELAPA",
                kordinat: [106.824549974903, -6.1641506144623],
            },
            {
                kelurahan: "KELAPA DUA",
                kordinat: [106.768725777381, -6.20935190181786],
            },
            {
                kelurahan: "KARET TENGSIN",
                kordinat: [106.816551514266, -6.20706662486508],
            },
            {
                kelurahan: "KELAPA DUA WETAN",
                kordinat: [106.882970880301, -6.34112582259438],
            },
            {
                kelurahan: "MELAWAI",
                kordinat: [106.802246658983, -6.2455926318479],
            },
            {
                kelurahan: "KEMANGGISAN",
                kordinat: [106.791380301514, -6.18987547785637],
            },
            {
                kelurahan: "KEMAYORAN",
                kordinat: [106.845383786804, -6.16472147763137],
            },
            {
                kelurahan: "KEMBANGAN SELATAN",
                kordinat: [106.738584691009, -6.18615808320017],
            },
            {
                kelurahan: "KEMBANGAN UTARA",
                kordinat: [106.742511600446, -6.17232398437239],
            },
            {
                kelurahan: "KAYU PUTIH",
                kordinat: [106.883693095322, -6.17940001931571],
            },
            {
                kelurahan: "KEBAGUSAN",
                kordinat: [106.830942361388, -6.30973492877673],
            },
            {
                kelurahan: "KEBON JERUK",
                kordinat: [106.772134897526, -6.19500358429678],
            },
            {
                kelurahan: "KEBON KACANG",
                kordinat: [106.817201945748, -6.19029931602392],
            },
            {
                kelurahan: "KEBON KOSONG",
                kordinat: [106.853461747615, -6.15819605535884],
            },
            {
                kelurahan: "KOTA BAMBU UTARA",
                kordinat: [106.803417613565, -6.18356522989228],
            },
            {
                kelurahan: "KEBON PALA",
                kordinat: [106.877833900441, -6.25571030595755],
            },
            {
                kelurahan: "MANGGA DUA SELATAN",
                kordinat: [106.828260256841, -6.14207490053543],
            },
            {
                kelurahan: "KEBAYORAN LAMA SELATAN",
                kordinat: [106.780148484667, -6.25456762190232],
            },
            {
                kelurahan: "KEBAYORAN LAMA UTARA",
                kordinat: [106.776848724088, -6.24614366603367],
            },
            {
                kelurahan: "KAMPUNG RAWA",
                kordinat: [106.855513229834, -6.17950356950519],
            },
            {
                kelurahan: "KEDAUNG KALI ANGKE",
                kordinat: [106.758576015288, -6.15256949605835],
            },
            {
                kelurahan: "KRAMAT",
                kordinat: [106.846320437487, -6.18348640618221],
            },
            {
                kelurahan: "KEDOYA SELATAN",
                kordinat: [106.760418286986, -6.18253392848629],
            },
            {
                kelurahan: "KWITANG",
                kordinat: [106.840193546425, -6.18318376310215],
            },
            {
                kelurahan: "KAMPUNG MELAYU",
                kordinat: [106.861277596858, -6.21738482050325],
            },
            {
                kelurahan: "KENARI",
                kordinat: [106.846683472723, -6.19356000257104],
            },
            {
                kelurahan: "MAMPANG PRAPATAN",
                kordinat: [106.828637163477, -6.24275787977454],
            },
            {
                kelurahan: "MAPHAR",
                kordinat: [106.821172338109, -6.15601257752805],
            },
            {
                kelurahan: "PEJATEN TIMUR",
                kordinat: [106.848282310615, -6.2801614064755],
            },
            {
                kelurahan: "MANGGARAI",
                kordinat: [106.851062911107, -6.2135265709077],
            },
            {
                kelurahan: "MANGGARAI SELATAN",
                kordinat: [106.848517904195, -6.21996580391261],
            },
            {
                kelurahan: "MARUNDA",
                kordinat: [106.961284401015, -6.113501852069],
            },
            {
                kelurahan: "MENTENG",
                kordinat: [106.833920591568, -6.20089669974896],
            },
            {
                kelurahan: "KRUKUT",
                kordinat: [106.814993668419, -6.15695814026878],
            },
            {
                kelurahan: "KLENDER",
                kordinat: [106.90813621644, -6.2185124197491],
            },
            {
                kelurahan: "KUNINGAN BARAT",
                kordinat: [106.822144880409, -6.23595753320787],
            },
            {
                kelurahan: "KOJA",
                kordinat: [106.899122955021, -6.10577304917311],
            },
            {
                kelurahan: "KOTA BAMBU SELATAN",
                kordinat: [106.803353901735, -6.18734974845941],
            },
            {
                kelurahan: "KRAMAT PELA",
                kordinat: [106.792442419077, -6.24472875967881],
            },
            {
                kelurahan: "KUNINGAN TIMUR",
                kordinat: [106.829512159071, -6.23158607519609],
            },
            {
                kelurahan: "LAGOA",
                kordinat: [106.910619132986, -6.11399743651156],
            },
            {
                kelurahan: "PENGADEGAN",
                kordinat: [106.855424162661, -6.24925648705767],
            },
            {
                kelurahan: "LEBAK BULUS",
                kordinat: [106.77894157624, -6.30112305479764],
            },
            {
                kelurahan: "LENTENG AGUNG",
                kordinat: [106.836903148115, -6.325664859182],
            },
            {
                kelurahan: "LUBANG BUAYA",
                kordinat: [106.903528833342, -6.29392173361504],
            },
            {
                kelurahan: "SUMUR BATU",
                kordinat: [106.871047261908, -6.16349017527244],
            },
            {
                kelurahan: "MAKASAR",
                kordinat: [106.877033587368, -6.27577224494573],
            },
            {
                kelurahan: "MALAKA JAYA",
                kordinat: [106.934862424551, -6.22336512218718],
            },
            {
                kelurahan: "MALAKA SARI",
                kordinat: [106.928425594337, -6.22384422298812],
            },
            {
                kelurahan: "MERUYA UTARA",
                kordinat: [106.738767789367, -6.1966346418424],
            },
            {
                kelurahan: "UTAN KAYU UTARA",
                kordinat: [106.868269048953, -6.19550652157989],
            },
            {
                kelurahan: "MUNJUL",
                kordinat: [106.895677726988, -6.3478093873621],
            },
            {
                kelurahan: "PADEMANGAN BARAT",
                kordinat: [106.836764588809, -6.13492677792781],
            },
            {
                kelurahan: "PADEMANGAN TIMUR",
                kordinat: [106.8478070055, -6.14232844070373],
            },
            {
                kelurahan: "PASAR MANGGIS",
                kordinat: [106.84158253741, -6.21044137484654],
            },
            {
                kelurahan: "PANCORAN",
                kordinat: [106.840707833002, -6.24744336003884],
            },
            {
                kelurahan: "PASAR MINGGU",
                kordinat: [106.839363454169, -6.28991922574007],
            },
            {
                kelurahan: "PAPANGGO",
                kordinat: [106.871108767074, -6.12900617451505],
            },
            {
                kelurahan: "PASAR BARU",
                kordinat: [106.83448401588, -6.16602947068673],
            },
            {
                kelurahan: "PASEBAN",
                kordinat: [106.852587250498, -6.19339147493744],
            },
            {
                kelurahan: "PEGADUNGAN",
                kordinat: [106.702353946773, -6.13275718918478],
            },
            {
                kelurahan: "PULO GADUNG",
                kordinat: [106.898903551917, -6.18299061865617],
            },
            {
                kelurahan: "PEGANGSAAN",
                kordinat: [106.848072167268, -6.20196460461354],
            },
            {
                kelurahan: "PETAMBURAN",
                kordinat: [106.806001685901, -6.19687566275644],
            },
            {
                kelurahan: "PESANGGRAHAN",
                kordinat: [106.758735300531, -6.25648069940373],
            },
            {
                kelurahan: "PENJARINGAN",
                kordinat: [106.800073832348, -6.12207730012579],
            },
            {
                kelurahan: "PEGANGSAAN DUA",
                kordinat: [106.914716882326, -6.16408683226957],
            },
            {
                kelurahan: "PEJAGALAN",
                kordinat: [106.784827450065, -6.13580658464833],
            },
            {
                kelurahan: "UTAN PANJANG",
                kordinat: [106.854326221795, -6.16535442511159],
            },
            {
                kelurahan: "PEJATEN BARAT",
                kordinat: [106.835282547028, -6.27299312637062],
            },
            {
                kelurahan: "PEKAYON",
                kordinat: [106.864389762062, -6.3449540953624],
            },
            {
                kelurahan: "PELA MAMPANG",
                kordinat: [106.817148578637, -6.24853909986531],
            },
            {
                kelurahan: "PENGGILINGAN",
                kordinat: [106.934844236356, -6.20484214733487],
            },
            {
                kelurahan: "PONDOK KOPI",
                kordinat: [106.942550333377, -6.22696189622745],
            },
            {
                kelurahan: "MENTENG DALAM",
                kordinat: [106.841246849809, -6.23162384487792],
            },
            {
                kelurahan: "RAWA BUNGA",
                kordinat: [106.87132709072, -6.21996193024349],
            },
            {
                kelurahan: "MERUYA SELATAN",
                kordinat: [106.733999371533, -6.20931697452601],
            },
            {
                kelurahan: "ROROTAN",
                kordinat: [106.955265105271, -6.14532208894883],
            },
            {
                kelurahan: "SEMANAN",
                kordinat: [106.702426505957, -6.16618015491114],
            },
            {
                kelurahan: "SEMPER BARAT",
                kordinat: [106.924259592784, -6.12596794345643],
            },
            {
                kelurahan: "SEMPER TIMUR",
                kordinat: [106.933252382009, -6.12061199121527],
            },
            {
                kelurahan: "PETOJO UTARA",
                kordinat: [106.815299449664, -6.16535378282879],
            },
            {
                kelurahan: "PETUKANGAN SELATAN",
                kordinat: [106.753792334275, -6.24331589603664],
            },
            {
                kelurahan: "RAWA BADAK SELATAN",
                kordinat: [106.898685331939, -6.13230665928947],
            },
            {
                kelurahan: "PETUKANGAN UTARA",
                kordinat: [106.75101122644, -6.22928815391129],
            },
            {
                kelurahan: "SUKABUMI SELATAN",
                kordinat: [106.771976700512, -6.22174513532899],
            },
            {
                kelurahan: "RAWAMANGUN",
                kordinat: [106.88244828357, -6.19590904440279],
            },
            {
                kelurahan: "PINANGSIA",
                kordinat: [106.815804282372, -6.13708249346776],
            },
            {
                kelurahan: "PULO",
                kordinat: [106.802045088624, -6.25330997702339],
            },
            {
                kelurahan: "RAWASARI",
                kordinat: [106.866046508743, -6.19044662797002],
            },
            {
                kelurahan: "PONDOK BAMBU",
                kordinat: [106.900878416204, -6.23484846645207],
            },
            {
                kelurahan: "ROA MALAKA",
                kordinat: [106.809469368255, -6.13637449343088],
            },
            {
                kelurahan: "PONDOK KELAPA",
                kordinat: [106.93188774186, -6.24342401245266],
            },
            {
                kelurahan: "RAWA BUAYA",
                kordinat: [106.736389150783, -6.16287135549716],
            },
            {
                kelurahan: "PONDOK LABU",
                kordinat: [106.797027586026, -6.30927443777828],
            },
            {
                kelurahan: "SUNGAI BAMBU",
                kordinat: [106.886224328238, -6.13074025577404],
            },
            {
                kelurahan: "RAWA BADAK UTARA",
                kordinat: [106.897893109845, -6.11961275573959],
            },
            {
                kelurahan: "PONDOK PINANG",
                kordinat: [106.778857408958, -6.27606602673475],
            },
            {
                kelurahan: "PONDOK RANGGON",
                kordinat: [106.906850499146, -6.35539148390087],
            },
            {
                kelurahan: "PULO GEBANG",
                kordinat: [106.952955214449, -6.20500706701234],
            },
            {
                kelurahan: "RAGUNAN",
                kordinat: [106.821238775704, -6.29876136130953],
            },
            {
                kelurahan: "SUSUKAN",
                kordinat: [106.86884147041, -6.31248140942556],
            },
            {
                kelurahan: "TEGAL PARANG",
                kordinat: [106.829231264862, -6.24881450103449],
            },
            {
                kelurahan: "RAMBUTAN",
                kordinat: [106.877746518795, -6.30710134491421],
            },
            {
                kelurahan: "RAWA TERATE",
                kordinat: [106.920447107467, -6.18447178921686],
            },
            {
                kelurahan: "WIJAYA KUSUMA",
                kordinat: [106.775908824205, -6.15482146991689],
            },
            {
                kelurahan: "TANAH SEREAL",
                kordinat: [106.809841852686, -6.15404585485693],
            },
            {
                kelurahan: "SRENGSENG SAWAH",
                kordinat: [106.824459905671, -6.34839794333306],
            },
            {
                kelurahan: "SUKAPURA",
                kordinat: [106.927973641205, -6.14796232979686],
            },
            {
                kelurahan: "TEBET BARAT",
                kordinat: [106.848980166044, -6.23494078590659],
            },
            {
                kelurahan: "TEBET TIMUR",
                kordinat: [106.855523101862, -6.23381945447945],
            },
            {
                kelurahan: "TEGAL ALUR",
                kordinat: [106.715919156645, -6.11649816825729],
            },
            {
                kelurahan: "TUGU SELATAN",
                kordinat: [106.910345437471, -6.13540865683343],
            },
            {
                kelurahan: "TANJUNG DUREN SELATAN",
                kordinat: [106.788595559928, -6.17935244531923],
            },
            {
                kelurahan: "TUGU UTARA",
                kordinat: [106.912344292705, -6.12427674562036],
            },
            {
                kelurahan: "TANGKI",
                kordinat: [106.823136682183, -6.14619713728914],
            },
            {
                kelurahan: "UJUNG MENTENG",
                kordinat: [106.963344812767, -6.18627604492655],
            },
            {
                kelurahan: "SENAYAN",
                kordinat: [106.810394817247, -6.22678603215109],
            },
            {
                kelurahan: "ULUJAMI",
                kordinat: [106.763183489486, -6.23628834828197],
            },
            {
                kelurahan: "SUNTER AGUNG",
                kordinat: [106.862089053746, -6.13808205169972],
            },
            {
                kelurahan: "SUNTER JAYA",
                kordinat: [106.876812601473, -6.15135381932835],
            },
            {
                kelurahan: "TAMAN SARI",
                kordinat: [106.824531240858, -6.15357668400071],
            },
            {
                kelurahan: "TANJUNG BARAT",
                kordinat: [106.847497282611, -6.30675798193156],
            },
            {
                kelurahan: "TANJUNG DUREN UTARA",
                kordinat: [106.783272459404, -6.17281865105015],
            },
            {
                kelurahan: "UTAN KAYU SELATAN",
                kordinat: [106.868934128878, -6.20349581454576],
            },
            {
                kelurahan: "TANJUNG PRIOK",
                kordinat: [106.879034604041, -6.10897877010519],
            },
            {
                kelurahan: "SETU",
                kordinat: [106.914809988355, -6.31303631772808],
            },
            {
                kelurahan: "SRENGSENG",
                kordinat: [106.755277756504, -6.20748107487523],
            },
        ];

        let list_pekerjaan = [
            {
                name: "Tidak Belum Bekerja",
                coloumn: "tdk_belum_bekerja",
            },
            {
                name: "Petani",
                coloumn: "petani",
            },
            {
                name: "Nelayan",
                coloumn: "nelayan",
            },
            {
                name: "Pedagang",
                coloumn: "pedagang",
            },
            {
                name: "Pejabat Negara",
                coloumn: "pejabat_negara",
            },
            {
                name: "PNS TNI Polri",
                coloumn: "pns_tni_polri",
            },
            {
                name: "Pegawai Swasta",
                coloumn: "peg_swasta",
            },
            {
                name: "Wiraswasta",
                coloumn: "wiraswasta",
            },
            {
                name: "Pensuinan",
                coloumn: "pensuinan",
            },
            {
                name: "Pekerja Lepas",
                coloumn: "pekerja_lepas",
            },
        ];

        let list_pendidikan = [
            {
                name: "Tidak Sekolah",
                coloumn: "tdk_belum_sekolah",
            },
            {
                name: "Masih SD",
                coloumn: "masih_sd",
            },
            {
                name: "Tamat SD",
                coloumn: "tamat_sd",
            },
            {
                name: "Tamat SMP",
                coloumn: "tamat_smp",
            },
            {
                name: "Tamat SMA",
                coloumn: "tamat_sma",
            },
            {
                name: "Tamat D1/D2",
                coloumn: "tamat_d1_d2",
            },
            {
                name: "Tamat D3",
                coloumn: "tamat_d3",
            },
            {
                name: "Tamat D4/Sarjana",
                coloumn: "tamat_d4_srjna",
            },
            {
                name: "Tamat S2",
                coloumn: "tamat_s2",
            },
            {
                name: "Tamat S3",
                coloumn: "tamat_s3",
            },
            {
                name: "Tidak Sekolah Lagi",
                coloumn: "tdk_sekolah_lagi",
            },
            {
                name: "Masih D3",
                coloumn: "masih_d3",
            },
            {
                name: "Masih SMP",
                coloumn: "masih_smp",
            },
            {
                name: "Masih D4/Sarjana",
                coloumn: "masih_d4_srjna",
            },
            {
                name: "Masih SMA",
                coloumn: "masih_sm",
            },
            {
                name: "Masih S2",
                coloumn: "masih_s2",
            },
            {
                name: "Masih D1/D2",
                coloumn: "masih_d1_d2",
            },
            {
                name: "Masih S3",
                coloumn: "masih_s3",
            },
            {
                name: "Tidak Tamat SD",
                coloumn: "tdk_tamat_sd",
            },
        ];

        let list_resiko_bencana = [
            {
                name: "Rawan Kebakaran",
                coloumn: "rmh_rawan_kebakar",
            },
            {
                name: "Pernah Banjir",
                coloumn: "rmh_pernah_banjir",
            },
            {
                name: "Pernah Kebakar",
                coloumn: "rmh_pernah_kebakar",
            },
        ];

        let optionKelurahan = "<option>Pilih Kelurahan...</option>";

        point_center_kelurahan.forEach(function (item, index) {
            optionKelurahan += `<option value="${item.kordinat[1]},${item.kordinat[0]}/${item.kelurahan}">${item.kelurahan}</option>`;
        });
        $("#filterChoro").html("");
        $("#filterChoro").html(`
            <div class="row">
            <div class="col-md-12 mt-1">
                <span class="text_all font-weight-bold">Kelurahan</span>
                <select id="selectKelurahan" class="w-100">
                    ${optionKelurahan}
                </select>
            </div>
            <div class="col-md-12 mt-1">
                <span class="text_all font-weight-bold">Kategori</span>
                <select id="selectKategori" class="w-100">
                    <option value="">Pilih Kategori...</option>
                    <option value="Jumlah Penduduk">Jumlah Penduduk</option>
                    <option value="Pekerjaan">Pekerjaan</option>
                    <option value="Pendidikan">Pendidikan</option>
                    <option value="Jumlah Rumah">Jumlah Rumah</option>
                    <option value="Resiko Bencana Kebakaran">Resiko Bencana Kebakaran</option>
                </select>
            </div>
            <div class="col-md-12 mt-2 mb-2">
                <div id="data_ppap"></div>
            </div>
            <div class="col-md-6">
                <span class="text_all font-weight-bold">Interval</span>
                <div class="text_all" id="legends">
    
                </div>
                </div>
            <div class="col-md-6">
                <span class="text_all font-weight-bold">RT/RW</span>
                <div id="pd">
                    <p></p>
                </div>
            </div>
        </div>
            `);
        $("#selectKelurahan").change(function () {
            let value = $(this).val().split("/");
            let kordinat = value[0];
            let kelurahan = value[1];
            let jenis = localStorage.getItem("jenis_data_dppapp");
            localStorage.setItem("kelurahan_dppapp", kelurahan);
            if ($("#selectKategori").val() == "") {
                localStorage.setItem("jenis_data_dppapp", "jlh_penduduk");
                $("#selectKategori").val("Jumlah Penduduk").trigger("change");
            } else {
                choroDPPAPP(jenis, kelurahan);
            }
            let split_kordinat = kordinat.split(",");
            flyToLocation(split_kordinat[0], split_kordinat[1], "", "");
        });

        $("#selectKategori").change(function () {
            let value = $(this).val();
            if (value == "Jumlah Penduduk" || value == "Jumlah Rumah") {
                // console.log("Disable Chip");
                if (value == "Jumlah Penduduk") {
                    choroDPPAPP(
                        "jlh_penduduk",
                        localStorage.getItem("kelurahan_dppapp")
                    );
                    localStorage.setItem("jenis_data_dppapp", "jlh_penduduk");
                } else {
                    choroDPPAPP(
                        "jlh_rumah",
                        localStorage.getItem("kelurahan_dppapp")
                    );
                    localStorage.setItem("jenis_data_dppapp", "jlh_rumah");
                }
                $("#data_ppap").html("");
            } else if (value == "Pekerjaan") {
                if (
                    $("div#data_ppap.slick-initialized.slick-slider").length ==
                    1
                ) {
                    $("#data_ppap").slick("unslick");
                }
                $("#data_ppap").html("");
                let html = "";
                list_pekerjaan.forEach(function (item, index) {
                    if (index == 0) {
                        choroDPPAPP(
                            item.coloumn,
                            localStorage.getItem("kelurahan_dppapp")
                        );
                        localStorage.setItem("jenis_data_dppapp", item.coloumn);
                    }
                    html += `
                <div class="mb-1">
                <button class="btn btn-xs mr-2 ${
                    index == 0 ? "active-chip" : ""
                }" onclick="choroDPPAPP('${
                        item.coloumn
                    }', '${localStorage.getItem(
                        "kelurahan_dppapp"
                    )}');localStorage.setItem('jenis_data_dppapp', '${
                        item.coloumn
                    }')"
                    style="background: #fdfffc; border-radius: 30px; box-shadow: none; border:1px #ccc solid; padding:5px;">
                    <div class="container">
                        <div class="row">
                            <span class="font-weight-bold" style="margin-top: 2px; font-size:13px;">${
                                item.name
                            }</span>
                        </div>
                    </div>
                </button>
                </div>
                `;
                });
                $("#data_ppap").html(html);
                if (
                    $("div#data_ppap.slick-initialized.slick-slider").length ==
                    0
                ) {
                    chipOption("data_ppap");
                }
                activeButton("data_ppap");
            } else if (value == "Pendidikan") {
                if (
                    $("div#data_ppap.slick-initialized.slick-slider").length ==
                    1
                ) {
                    $("#data_ppap").slick("unslick");
                }
                $("#data_ppap").html("");
                let html = "";
                list_pendidikan.forEach(function (item, index) {
                    if (index == 0) {
                        choroDPPAPP(
                            item.coloumn,
                            localStorage.getItem("kelurahan_dppapp")
                        );
                        localStorage.setItem("jenis_data_dppapp", item.coloumn);
                    }
                    html += `
                <div class="mb-1">
                <button class="btn btn-xs mr-2 ${
                    index == 0 ? "active-chip" : ""
                }" onclick="choroDPPAPP('${
                        item.coloumn
                    }', '${localStorage.getItem(
                        "kelurahan_dppapp"
                    )}');localStorage.setItem('jenis_data_dppapp', '${
                        item.coloumn
                    }')"
                    style="background: #fdfffc; border-radius: 30px; box-shadow: none; border:1px #ccc solid; padding:5px;">
                    <div class="container">
                        <div class="row">
                            <span class="font-weight-bold" style="margin-top: 2px; font-size:13px;">${
                                item.name
                            }</span>
                        </div>
                    </div>
                </button>
                </div>
                `;
                });
                $("#data_ppap").html(html);
                if (
                    $("div#data_ppap.slick-initialized.slick-slider").length ==
                    0
                ) {
                    chipOption("data_ppap");
                }
                activeButton("data_ppap");
            } else if (value == "Resiko Bencana Kebakaran") {
                if (
                    $("div#data_ppap.slick-initialized.slick-slider").length ==
                    1
                ) {
                    $("#data_ppap").slick("unslick");
                }
                $("#data_ppap").html("");
                let html = "";
                list_resiko_bencana.forEach(function (item, index) {
                    if (index == 0) {
                        choroDPPAPP(
                            item.coloumn,
                            localStorage.getItem("kelurahan_dppapp")
                        );
                        localStorage.setItem("jenis_data_dppapp", item.coloumn);
                    }
                    html += `
                <div class="mb-1">
                <button class="btn btn-xs mr-2 ${
                    index == 0 ? "active-chip" : ""
                }" onclick="choroDPPAPP('${
                        item.coloumn
                    }', '${localStorage.getItem(
                        "kelurahan_dppapp"
                    )}');localStorage.setItem('jenis_data_dppapp', '${
                        item.coloumn
                    }')"
                    style="background: #fdfffc; border-radius: 30px; box-shadow: none; border:1px #ccc solid; padding:5px;">
                    <div class="container">
                        <div class="row">
                            <span class="font-weight-bold" style="margin-top: 2px; font-size:13px;">${
                                item.name
                            }</span>
                        </div>
                    </div>
                </button>
                </div>
                `;
                });
                $("#data_ppap").html(html);
                if (
                    $("div#data_ppap.slick-initialized.slick-slider").length ==
                    0
                ) {
                    chipOption("data_ppap");
                }
                activeButton("data_ppap");
            }
        });
    }
});

const choro = (min = 0, max = 25000000000, category = "omzet") => {
    $.ajax({
        url: `${url_api}/choro`,
        method: "POST",
        dataType: "json",
        data: {
            min: min,
            max: max,
            category: category,
        },
        headers: {
            Authorization: `Bearer ${token}`,
        },
        success: (e) => {
            if (map.getSource("wilayahindex")) {
                map.removeLayer("wilayahindex_fill");
                map.removeSource("wilayahindex");
            }
            map.addSource("wilayahindex", {
                type: "geojson",
                data: e,
            });
            let min, max, average;
            let paint;
            let data = e.features;

            let borderLayer;

            if (category == "omzet") {
                min = data
                    .map(function (el) {
                        return el.properties["Total omzet"];
                    })
                    .reduce(function (prevEl, el) {
                        return Math.min(prevEl, el);
                    });
                max = data
                    .map(function (el) {
                        return el.properties["Total omzet"];
                    })
                    .reduce(function (prevEl, el) {
                        return Math.max(prevEl, el);
                    });
                average = Math.ceil((max - min) / 6);
            } else {
                min = data
                    .map(function (el) {
                        return el.properties["Jumlah"];
                    })
                    .reduce(function (prevEl, el) {
                        return Math.min(prevEl, el);
                    });
                max = data
                    .map(function (el) {
                        return el.properties["Jumlah"];
                    })
                    .reduce(function (prevEl, el) {
                        return Math.max(prevEl, el);
                    });
                average = Math.ceil((max - min) / 6);
            }
            // console.log(min, max, average);
            if (category == "omzet") {
                paint = [
                    "interpolate",
                    ["linear"],
                    ["get", "Total omzet"],
                    min + average * 1 + 1,
                    "#ffeda0",
                    min + average * 2 + 1,
                    "#ffe675",
                    min + average * 3 + 1,
                    "#ffdf52",
                    min + average * 4 + 1,
                    "#ffd61f",
                    min + average * 5 + 1,
                    "#e0b700",
                    min + average * 6 + 1,
                    "#caa502",
                ];

                borderLayer = "red";
            } else if (pekerjaan.includes(category)) {
                paint = [
                    "interpolate",
                    ["linear"],
                    ["get", "Jumlah"],
                    min + average * 1 + 1,
                    "#1cfc03",
                    min + average * 2 + 1,
                    "#22eb0c",
                    min + average * 3 + 1,
                    "#22db0d",
                    min + average * 4 + 1,
                    "#1dbd0b",
                    min + average * 5 + 1,
                    "#1aa60a",
                    min + average * 6 + 1,
                    "#198f0b",
                ];
                borderLayer = "red";
            } else if (pendidikan.includes(category)) {
                paint = [
                    "interpolate",
                    ["linear"],
                    ["get", "Jumlah"],
                    min + average * 1 + 1,
                    "#254ef5",
                    min + average * 2 + 1,
                    "#1e43d6",
                    min + average * 3 + 1,
                    "#1a3aba",
                    min + average * 4 + 1,
                    "#142f99",
                    min + average * 5 + 1,
                    "#10267d",
                    min + average * 6 + 1,
                    "#0b1a57",
                ];
                borderLayer = "red";
            } else if (agama.includes(category)) {
                paint = [
                    "interpolate",
                    ["linear"],
                    ["get", "Jumlah"],
                    min + average * 1 + 1,
                    "#a90ffc",
                    min + average * 2 + 1,
                    "#980ee3",
                    min + average * 3 + 1,
                    "#870cc9",
                    min + average * 4 + 1,
                    "#740aad",
                    min + average * 5 + 1,
                    "#650996",
                    min + average * 6 + 1,
                    "#51057a",
                ];
                borderLayer = "red";
            } else if (category == "kepadatan") {
                paint = [
                    "interpolate",
                    ["linear"],
                    ["get", "Jumlah"],
                    min + average * 1 + 1,
                    "#f7143e",
                    min + average * 2 + 1,
                    "#d61135",
                    min + average * 3 + 1,
                    "#b50e2d",
                    min + average * 4 + 1,
                    "#990c26",
                    min + average * 5 + 1,
                    "#7d091e",
                    min + average * 6 + 1,
                    "#690619",
                ];
                borderLayer = "white";
            } else if (category == "jumlah_penduduk") {
                paint = [
                    "interpolate",
                    ["linear"],
                    ["get", "Jumlah"],
                    min + average * 1 + 1,
                    "#0ce8e4",
                    min + average * 2 + 1,
                    "#0ac9c6",
                    min + average * 3 + 1,
                    "#09adab",
                    min + average * 4 + 1,
                    "#068f8d",
                    min + average * 5 + 1,
                    "#057876",
                    min + average * 6 + 1,
                    "#04615f",
                ];
                borderLayer = "red";
            } else if (category == "count_polygons") {
                paint = [
                    "interpolate",
                    ["linear"],
                    ["get", "Jumlah"],
                    min + average * 1 + 1,
                    "#ff6a14",
                    min + average * 2 + 1,
                    "#eb6010",
                    min + average * 3 + 1,
                    "#d6580f",
                    min + average * 4 + 1,
                    "#bd4f0f",
                    min + average * 5 + 1,
                    "#a8460d",
                    min + average * 6 + 1,
                    "#963e0b",
                ];
                borderLayer = "red";
            }
            // console.log(paint);
            map.addLayer({
                id: "wilayahindex_fill",
                type: "fill",
                source: "wilayahindex",
                paint: {
                    "fill-color": paint,
                    "fill-opacity": 0.7,
                    "fill-outline-color": borderLayer,
                },
                layout: {
                    visibility: "visible",
                },
            });
            onOffLayer("wilayahindex");
            map.on("mousemove", ({ point }) => {
                const states = map.queryRenderedFeatures(point, {
                    layers: ["wilayahindex_fill"],
                });

                let el = "";
                if (localStorage.getItem("filterCategoryChoro") == "omzet") {
                    el = `<strong class="d-block">Omzet (Rp milyar)</strong>`;
                } else if (
                    localStorage.getItem("filterCategoryChoro") == "kepadatan"
                ) {
                    el = `<strong class="d-block">Jumlah (Orang km<sup>3</sup>)</strong>`;
                } else if (
                    localStorage.getItem("filterCategoryChoro") ==
                    "count_polygons"
                ) {
                    el = `<strong class="d-block">Jumlah (Bangunan)</strong>`;
                } else {
                    el = `<strong class="d-block">Jumlah (Orang)</strong>`;
                }

                document.getElementById("pd").innerHTML = states.length
                    ? `<div>${titleCase(
                          states[0].properties.Kelurahan
                      )}</div><p class="mb-0 my-2">
                          ${el}<span style="font-size:15px;">
                          ${
                              localStorage.getItem("filterCategoryChoro") ==
                              "omzet"
                                  ? `Rp. ${separatorNum(
                                        states[0].properties["Total omzet"]
                                    )}`
                                  : `${separatorNum(
                                        states[0].properties["Jumlah"]
                                    )}`
                          }</span></p>`
                    : `<p class="mb-0">Arahkan kursor</p>`;
            });
            let layers;
            let minFix =
                min / 1000000000 < 1
                    ? Math.round((min / 1000000000 + Number.EPSILON) * 1000) /
                      1000
                    : Math.round((min / 1000000000 + Number.EPSILON) * 100) /
                      100;
            if (category == "omzet") {
                layers = [
                    `${minFix} - ${
                        Math.round(
                            ((min + average * 1 + 1) / 1000000000 +
                                Number.EPSILON) *
                                100
                        ) / 100
                    }`,
                    `${
                        Math.round(
                            ((min + average * 1 + 2) / 1000000000 +
                                Number.EPSILON) *
                                100
                        ) / 100
                    } - ${
                        Math.round(
                            ((min + average * 2 + 1) / 1000000000 +
                                Number.EPSILON) *
                                100
                        ) / 100
                    }`,
                    `${
                        Math.round(
                            ((min + average * 2 + 2) / 1000000000 +
                                Number.EPSILON) *
                                100
                        ) / 100
                    } - ${
                        Math.round(
                            ((min + average * 3 + 1) / 1000000000 +
                                Number.EPSILON) *
                                100
                        ) / 100
                    }`,
                    `${
                        Math.round(
                            ((min + average * 3 + 2) / 1000000000 +
                                Number.EPSILON) *
                                100
                        ) / 100
                    } - ${
                        Math.round(
                            ((min + average * 4 + 1) / 1000000000 +
                                Number.EPSILON) *
                                100
                        ) / 100
                    }`,
                    `${
                        Math.round(
                            ((min + average * 4 + 2) / 1000000000 +
                                Number.EPSILON) *
                                100
                        ) / 100
                    } - ${
                        Math.round(
                            ((min + average * 5 + 1) / 1000000000 +
                                Number.EPSILON) *
                                100
                        ) / 100
                    }`,
                    `> ${
                        Math.round(
                            ((min + average * 5 + 1) / 1000000000 +
                                Number.EPSILON) *
                                100
                        ) / 100
                    }`,
                ];
            } else {
                layers = [
                    `${min} - ${min + average * 1 + 1}`,
                    `${min + average * 1 + 2} - ${min + average * 2 + 1}`,
                    `${min + average * 2 + 2} - ${min + average * 3 + 1}`,
                    `${min + average * 3 + 2} - ${min + average * 4 + 1}`,
                    `${min + average * 4 + 2} - ${min + average * 5 + 1}`,
                    `> ${min + average * 5 + 2}`,
                ];
            }
            let colors;

            if (category == "omzet") {
                colors = [
                    "#ffeda0",
                    "#ffe675",
                    "#ffdf52",
                    "#ffd61f",
                    "#e0b700",
                    "#caa502",
                ];
            } else if (pekerjaan.includes(category)) {
                colors = [
                    "#1cfc03",
                    "#22eb0c",
                    "#22db0d",
                    "#1dbd0b",
                    "#1aa60a",
                    "#198f0b",
                ];
            } else if (pendidikan.includes(category)) {
                colors = [
                    "#254ef5",
                    "#1e43d6",
                    "#1a3aba",
                    "#142f99",
                    "#10267d",
                    "#0b1a57",
                ];
            } else if (agama.includes(category)) {
                colors = [
                    "#a90ffc",
                    "#980ee3",
                    "#870cc9",
                    "#740aad",
                    "#650996",
                    "#51057a",
                ];
            } else if (category == "kepadatan") {
                colors = [
                    "#f7143e",
                    "#d61135",
                    "#b50e2d",
                    "#990c26",
                    "#7d091e",
                    "#690619",
                ];
            } else if (category == "jumlah_penduduk") {
                colors = [
                    "#0ce8e4",
                    "#0ac9c6",
                    "#09adab",
                    "#068f8d",
                    "#057876",
                    "#04615f",
                ];
            } else if (category == "count_polygons") {
                colors = [
                    "#ff6a14",
                    "#eb6010",
                    "#d6580f",
                    "#bd4f0f",
                    "#a8460d",
                    "#963e0b",
                ];
            }
            // create legend
            const legend = document.getElementById("legends");
            legend.innerHTML = "";

            layers.forEach((layer, i) => {
                const color = colors[i];
                const item = document.createElement("div");
                const key = document.createElement("span");
                key.className = "legend-key";
                key.style.backgroundColor = color;

                const value = document.createElement("span");
                value.innerHTML = `${layer}`;
                item.appendChild(key);
                item.appendChild(value);
                legend.appendChild(item);
            });
        },
    });
};

const choroDPPAPP = (category = "jlh_penduduk", kelurahan) => {
    $.ajax({
        url: `${url_api}/ppap`,
        method: "POST",
        dataType: "json",
        data: {
            jenis: category,
            kelurahan: kelurahan,
        },
        headers: {
            Authorization: `Bearer ${token}`,
        },
        success: (e) => {
            if (map.getSource("wilayahppapp")) {
                map.removeLayer("wilayahppapp_fill");
                map.removeSource("wilayahppapp");
            }

            map.addSource("wilayahppapp", {
                type: "geojson",
                data: e,
            });

            let paint;
            let min, max, average;
            let data = e.features;
            let layers;
            let colors;

            let list_pekerjaan = [
                {
                    name: "Tidak Belum Bekerja",
                    coloumn: "tdk_belum_bekerja",
                },
                {
                    name: "Petani",
                    coloumn: "petani",
                },
                {
                    name: "Nelayan",
                    coloumn: "nelayan",
                },
                {
                    name: "Pedagang",
                    coloumn: "pedagang",
                },
                {
                    name: "Pejabat Negara",
                    coloumn: "pejabat_negara",
                },
                {
                    name: "PNS TNI Polri",
                    coloumn: "pns_tni_polri",
                },
                {
                    name: "Pegawai Swasta",
                    coloumn: "peg_swasta",
                },
                {
                    name: "Wiraswasta",
                    coloumn: "wiraswasta",
                },
                {
                    name: "Pensuinan",
                    coloumn: "pensuinan",
                },
                {
                    name: "Pekerja Lepas",
                    coloumn: "pekerja_lepas",
                },
            ];

            let list_pendidikan = [
                {
                    name: "Tidak Sekolah",
                    coloumn: "tdk_belum_sekolah",
                },
                {
                    name: "Masih SD",
                    coloumn: "masih_sd",
                },
                {
                    name: "Tamat SD",
                    coloumn: "tamat_sd",
                },
                {
                    name: "Tamat SMP",
                    coloumn: "tamat_smp",
                },
                {
                    name: "Tamat SMA",
                    coloumn: "tamat_sma",
                },
                {
                    name: "Tamat D1/D2",
                    coloumn: "tamat_d1_d2",
                },
                {
                    name: "Tamat D3",
                    coloumn: "tamat_d3",
                },
                {
                    name: "Tamat D4/Sarjana",
                    coloumn: "tamat_d4_srjna",
                },
                {
                    name: "Tamat S2",
                    coloumn: "tamat_s2",
                },
                {
                    name: "Tamat S3",
                    coloumn: "tamat_s3",
                },
                {
                    name: "Tidak Sekolah Lagi",
                    coloumn: "tdk_sekolah_lagi",
                },
                {
                    name: "Masih D3",
                    coloumn: "masih_d3",
                },
                {
                    name: "Masih SMP",
                    coloumn: "masih_smp",
                },
                {
                    name: "Masih D4/Sarjana",
                    coloumn: "masih_d4_srjna",
                },
                {
                    name: "Masih SMA",
                    coloumn: "masih_sm",
                },
                {
                    name: "Masih S2",
                    coloumn: "masih_s2",
                },
                {
                    name: "Masih D1/D2",
                    coloumn: "masih_d1_d2",
                },
                {
                    name: "Masih S3",
                    coloumn: "masih_s3",
                },
                {
                    name: "Tidak Tamat SD",
                    coloumn: "tdk_tamat_sd",
                },
            ];

            let list_resiko_bencana = [
                {
                    name: "Rawan Kebakaran",
                    coloumn: "rmh_rawan_kebakar",
                },
                {
                    name: "Pernah Banjir",
                    coloumn: "rmh_pernah_banjir",
                },
                {
                    name: "Pernah Kebakar",
                    coloumn: "rmh_pernah_kebakar",
                },
            ];

            min = data
                .map(function (el) {
                    return el.properties["Jumlah"];
                })
                .reduce(function (prevEl, el) {
                    return Math.min(prevEl, el);
                });
            max = data
                .map(function (el) {
                    return el.properties["Jumlah"];
                })
                .reduce(function (prevEl, el) {
                    return Math.max(prevEl, el);
                });
            average = Math.ceil((max - min) / 6);

            layers = [
                `${min} - ${min + average * 1 + 1}`,
                `${min + average * 1 + 2} - ${min + average * 2 + 1}`,
                `${min + average * 2 + 2} - ${min + average * 3 + 1}`,
                `${min + average * 3 + 2} - ${min + average * 4 + 1}`,
                `${min + average * 4 + 2} - ${min + average * 5 + 1}`,
                `> ${min + average * 5 + 2}`,
            ];

            if (list_pekerjaan.some((e) => e.coloumn === category)) {
                colors = [
                    "#1cfc03",
                    "#22eb0c",
                    "#22db0d",
                    "#1dbd0b",
                    "#1aa60a",
                    "#198f0b",
                ];
                paint = [
                    "interpolate",
                    ["linear"],
                    ["get", "Jumlah"],
                    min + average * 1 + 1,
                    "#1cfc03",
                    min + average * 2 + 1,
                    "#22eb0c",
                    min + average * 3 + 1,
                    "#22db0d",
                    min + average * 4 + 1,
                    "#1dbd0b",
                    min + average * 5 + 1,
                    "#1aa60a",
                    min + average * 6 + 1,
                    "#198f0b",
                ];
            } else if (list_pendidikan.some((e) => e.coloumn === category)) {
                colors = [
                    "#254ef5",
                    "#1e43d6",
                    "#1a3aba",
                    "#142f99",
                    "#10267d",
                    "#0b1a57",
                ];
                paint = [
                    "interpolate",
                    ["linear"],
                    ["get", "Jumlah"],
                    min + average * 1 + 1,
                    "#254ef5",
                    min + average * 2 + 1,
                    "#1e43d6",
                    min + average * 3 + 1,
                    "#1a3aba",
                    min + average * 4 + 1,
                    "#142f99",
                    min + average * 5 + 1,
                    "#10267d",
                    min + average * 6 + 1,
                    "#0b1a57",
                ];
            } else if (
                list_resiko_bencana.some((e) => e.coloumn === category)
            ) {
                colors = [
                    "#a90ffc",
                    "#980ee3",
                    "#870cc9",
                    "#740aad",
                    "#650996",
                    "#51057a",
                ];
                paint = [
                    "interpolate",
                    ["linear"],
                    ["get", "Jumlah"],
                    min + average * 1 + 1,
                    "#a90ffc",
                    min + average * 2 + 1,
                    "#980ee3",
                    min + average * 3 + 1,
                    "#870cc9",
                    min + average * 4 + 1,
                    "#740aad",
                    min + average * 5 + 1,
                    "#650996",
                    min + average * 6 + 1,
                    "#51057a",
                ];
            } else if (category === "jlh_penduduk") {
                colors = [
                    "#f7143e",
                    "#d61135",
                    "#b50e2d",
                    "#990c26",
                    "#7d091e",
                    "#690619",
                ];
                paint = [
                    "interpolate",
                    ["linear"],
                    ["get", "Jumlah"],
                    min + average * 1 + 1,
                    "#f7143e",
                    min + average * 2 + 1,
                    "#d61135",
                    min + average * 3 + 1,
                    "#b50e2d",
                    min + average * 4 + 1,
                    "#990c26",
                    min + average * 5 + 1,
                    "#7d091e",
                    min + average * 6 + 1,
                    "#690619",
                ];
            } else if (category === "jlh_rumah") {
                colors = [
                    "#0ce8e4",
                    "#0ac9c6",
                    "#09adab",
                    "#068f8d",
                    "#057876",
                    "#04615f",
                ];
                paint = [
                    "interpolate",
                    ["linear"],
                    ["get", "Jumlah"],
                    min + average * 1 + 1,
                    "#0ce8e4",
                    min + average * 2 + 1,
                    "#0ac9c6",
                    min + average * 3 + 1,
                    "#09adab",
                    min + average * 4 + 1,
                    "#068f8d",
                    min + average * 5 + 1,
                    "#057876",
                    min + average * 6 + 1,
                    "#04615f",
                ];
            }

            map.addLayer({
                id: "wilayahppapp_fill",
                type: "fill",
                source: "wilayahppapp",
                paint: {
                    "fill-color": paint,
                    "fill-opacity": 0.7,
                    "fill-outline-color": "white",
                },
                layout: {
                    visibility: "visible",
                },
            });

            const legend = document.getElementById("legends");
            legend.innerHTML = "";

            map.on("mousemove", ({ point }) => {
                const states = map.queryRenderedFeatures(point, {
                    layers: ["wilayahppapp_fill"],
                });

                document.getElementById("pd").innerHTML = states.length
                    ? `<div>${states[0].properties.RT}/${
                          states[0].properties.RW
                      }</div><p class="mb-0 my-2"><strong class="d-block">Jumlah</strong><span style="font-size:15px;">
                        ${separatorNum(
                            states[0].properties["Jumlah"]
                        )}</span></p>`
                    : `<p class="mb-0">Arahkan kursor</p>`;
            });

            layers.forEach((layer, i) => {
                const color = colors[i];
                const item = document.createElement("div");
                const key = document.createElement("span");
                key.className = "legend-key";
                key.style.backgroundColor = color;

                const value = document.createElement("span");
                value.innerHTML = `${layer}`;
                item.appendChild(key);
                item.appendChild(value);
                legend.appendChild(item);
            });
        },
    });
};

//Active Button for Data Interactive
const activeButton = (name) => {
    var header = document.getElementById(name);
    var btns = header.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function () {
            var current = document.getElementsByClassName("active-chip");
            console.log(current);
            current[0].className = current[0].className.replace(
                "active-chip",
                ""
            );
            this.className += " active-chip";
        });
    }
};
[];
